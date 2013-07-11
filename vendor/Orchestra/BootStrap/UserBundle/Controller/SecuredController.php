<?php
namespace BootStrap\UserBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * @Route("/front/secured")
 */
class SecuredController extends ContainerAware
{
    /**
     * @Route("/login", name="_front_security_login")
     * @Template()
     */
    public function loginAction()
    {
    	$request = $this->container->get('request');
    	/* @var $request \Symfony\Component\HttpFoundation\Request */
    	$session = $request->getSession();
    	/* @var $session \Symfony\Component\HttpFoundation\Session */
    
    	// get the error if any (works with forward and redirect -- see below)
    	if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
    		$error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
    	} elseif (null !== $session && $session->has(SecurityContext::AUTHENTICATION_ERROR)) {
    		$error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
    		$session->remove(SecurityContext::AUTHENTICATION_ERROR);
    	} else {
    		$error = '';
    	}
    
    	if ($error) {
    		// TODO: this is a potential security risk (see http://trac.symfony-project.org/ticket/9523)
    		$error = $error->getMessage();
    	}
    	// last username entered by the user
    	$lastUsername = (null === $session) ? '' : $session->get(SecurityContext::LAST_USERNAME);
    
    	$csrfToken = $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');
    
    	return $this->container->get('templating')->renderResponse("PiAppTemplateBundle:Template\\Login\\Security:connexion.html.twig", array(
    			'last_username' => $lastUsername,
    			'error'         => $error,
    			'csrf_token' => $csrfToken,
    	));
    }
    
    /**
     * @Route("/login_check", name="_front_security_check")
     */
    public function checkAction()
    {
    	//throw new \RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
    }   

    /**
     * @Route("/logout", name="_front_security_logout")
     */
    public function logoutAction()
    {
    	//throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }    
}
