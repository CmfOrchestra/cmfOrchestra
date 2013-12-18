<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BootStrap\UserBundle\Controller;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Controller managing the resetting of the password
 *
 * @author Thibault Duplessis <thibault.duplessis@gmail.com>
 * @author Christophe Coevoet <stof@notk.org>
 */
class ResettingController extends ContainerAware
{
    const SESSION_EMAIL = 'fos_user_send_resetting_email/email';

    /**
     * Request reset user password: show form
     */
    public function requestAction()
    {
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        
        return $this->container->get('templating')->renderResponse('PiAppTemplateBundle:Template\\Login\\Resetting:request.html.twig', array('NoLayout' => $NoLayout));
    }

    /**
     * Request reset user password: submit form and send email
     */
    public function sendEmailAction(Request $request)
    {
        $username   = $request->get('username');
        $template   = $request->get('template');
        $routereset = $request->get('routereset');
        $type = $request->get('type');
        //
        if (empty($template)) {
            $template = 'PiAppTemplateBundle:Template\\Login\\Resetting:request.html.twig';
        }

        $user  =  $this->container->get('doctrine')->getEntityManager()->getRepository('BootStrapUserBundle:User')->findOneBy(array('username' => $username));

        $request   = $this->container->get('request');

        if($request->isXmlHttpRequest()){
            $response = new JsonResponse();
            if (null === $user) {
                return $response->setData(json_encode(array('text'=> 'Identifiant inconnu', 'error' => true, 'type' => 'unknown' )));
            }
            else if ($user->isPasswordRequestNonExpired($this->container->getParameter('fos_user.resetting.token_ttl')) && $type == 'send') {
                return $response->setData(json_encode(array('text'=> 'Vous devez au préalable activer votre compte en cliquant sur le mail de Confirmation d\'inscription reçu', 'error' => true, 'type' => '24h' )));
            }
            else {
                $tokenGenerator = $this->container->get('fos_user.util.token_generator');
                $user->setConfirmationToken($tokenGenerator->generateToken());
                $em = $this->container->get('doctrine')->getEntityManager();
                $em->persist($user);
                $em->flush();

                $this->container->get('session')->set(static::SESSION_EMAIL, $this->getObfuscatedEmail($user));
                $this->sendResettingEmailMessage($user, $routereset);
                $user->setPasswordRequestedAt(new \DateTime());
                $this->container->get('fos_user.user_manager')->updateUser($user);

                return $response->setData(json_encode(array('text'=> 'Un email vous a été envoyé pour créer un nouveau mot de passe sur le site', 'error' => false)));
            }

        }
        else {
            if (null === $user) {
                return $this->container->get('templating')->renderResponse($template, array('invalid_username' => $username));
            }
            if ($user->isPasswordRequestNonExpired($this->container->getParameter('fos_user.resetting.token_ttl'))) {
                return $this->container->get('templating')->renderResponse('PiAppTemplateBundle:Template\\Login\\Resetting:passwordAlreadyRequested.html.twig');
            }
            $tokenGenerator = $this->container->get('fos_user.util.token_generator');
            $user->setConfirmationToken($tokenGenerator->generateToken());
            $em = $this->container->get('doctrine')->getEntityManager();
            $em->persist($user);
            $em->flush();
            //
            $this->container->get('session')->set(static::SESSION_EMAIL, $this->getObfuscatedEmail($user));
            $this->sendResettingEmailMessage($user, $routereset);
            $user->setPasswordRequestedAt(new \DateTime());
            $this->container->get('fos_user.user_manager')->updateUser($user);

            try {
                return $this->container->get('templating')->renderResponse('PiAppTemplateBundle:Template\\Login\\Resetting:request.html.twig', array('success' => true));
            } catch (\Exception $e) {
                $response     = new RedirectResponse($this->container->get('router')->generate('fos_user_resetting_check_email'));
            }

            return $response->getContent();
        }

    }

    /**
     * Send mail to reset user password
     */
    public function sendResettingEmailMessage(UserInterface $user, $route_reset_connexion)
    {
        $url       = $this->container->get('bootstrap.RouteTranslator.factory')->getRoute($route_reset_connexion, array('token' => $user->getConfirmationToken()));
        $html_url = 'http://'.$this->container->get('request')->getHttpHost() . $this->container->get('request')->getBasePath().$url;
        $html_url = "<a href='$html_url'>" . $html_url . "</a>";
        $rendered = $this->container->get('templating')->render('PiAppTemplateBundle:Template\\Login\\Resetting:email.txt.twig', array(
            'user'                 => $user,
            'confirmationUrl'     => $html_url,
        ));
        $this->container->get("pi_app_admin.mailer_manager")->send("administrator@gmail.com", $user->getEmail(), "Changement de mot de passe", $rendered);
    }

    /**
     * Tell the user to check his email provider
     */
    public function checkEmailAction()
    {
        $session = $this->container->get('request')->getSession();
        $email = $session->get(static::SESSION_EMAIL);
        $session->remove(static::SESSION_EMAIL);

        if (empty($email)) {
            // the user does not come from the sendEmail action
            return new RedirectResponse($this->container->get('router')->generate('fos_user_resetting_request'));
        }

        return $this->container->get('templating')->renderResponse('PiAppTemplateBundle:Template\\Login\\Resetting:checkEmail.html.twig', array(
            'email' => $email,
        ));
    }

    /**
     * Reset user password
     */
    public function resetAction(Request $request, $token)
    {
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->container->get('fos_user.resetting.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->container->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');

        $user = $userManager->findUserByConfirmationToken($token);

        if (null === $user) {
            throw new NotFoundHttpException(sprintf('The user with "confirmation token" does not exist for value "%s"', $token));
        }

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::RESETTING_RESET_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $formFactory->createForm();
        $form->setData($user);

        if ('POST' === $request->getMethod()) {
            $form->bind($request);

            if ($form->isValid()) {
                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::RESETTING_RESET_SUCCESS, $event);

                $userManager->updateUser($user);

                if (null === $response = $event->getResponse()) {
                    $url = $this->container->get('router')->generate('fos_user_profile_show');
                    $response = new RedirectResponse($url);
                }

                $dispatcher->dispatch(FOSUserEvents::RESETTING_RESET_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }
        }

        return $this->container->get('templating')->renderResponse('PiAppTemplateBundle:Template\\Login\\Resetting:reset.html.twig', array(
            'token' => $token,
            'form'  => $form->createView(),
        ));
    }

    /**
     * Get the truncated email displayed when requesting the resetting.
     *
     * The default implementation only keeps the part following @ in the address.
     *
     * @param \FOS\UserBundle\Model\UserInterface $user
     *
     * @return string
     */
    protected function getObfuscatedEmail(UserInterface $user)
    {
        $email = $user->getEmail();
        if (false !== $pos = strpos($email, '@')) {
            $email = '...' . substr($email, $pos);
        }

        return $email;
    }

    protected function setFlash($action, $value)
    {
        $this->container->get('request')->getSession()->getFlashBag()->add($action, $value);
    }

    protected function getEngine()
    {
        return $this->container->getParameter('fos_user.template.engine');
    }
}