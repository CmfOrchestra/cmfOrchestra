<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Managers
 * @package    Manager
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-12-11
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Manager;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response as Response;
use Symfony\Component\Security\Core\SecurityContext;

use PiApp\AdminBundle\Builder\PiTreeManagerBuilderInterface;
use PiApp\AdminBundle\Manager\PiCoreManager;
use PiApp\AdminBundle\Entity\Widget;

/**
 * Description of the Authentication Widget manager
 *
 * @category   Admin_Managers
 * @package    Manager
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiAuthenticationManager extends PiCoreManager implements PiTreeManagerBuilderInterface 
{    
	/**
	 * Constructor.
	 *
	 * @param ContainerInterface $container The service container
	 */
	public function __construct(ContainerInterface $container)
	{
		parent::__construct($container);
	}

	/**
	 * Call the tree render source method.
	 *
	 * @param string $id
	 * @param string $lang
	 * @param string $params
	 * @return string
	 * @access	public
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-04-19
	 */
	public function renderSource($id, $lang = '', $params = null)
	{
		str_replace('~', '~', $id, $count);
		if($count == 1)
			list($entity, $method) = explode('~', $this->_Decode($id));
		else
			throw new \InvalidArgumentException("you have not configure correctly the attibute id");
		
		if(!is_array($params))
			$params				= $this->paramsDecode($params);
		else
			$this->recursive_map($params);
		
		$params['locale']	= $lang;
		
		if($method == "_connexion_default")
			return $this->defaultConnexion($params);
		elseif($method == "_reset_default")
			return $this->resetConnexion($params);		
		else
			throw new \InvalidArgumentException("you have not configure correctly the attibute id");
	}
	
	/**
	 * Return the build tree result of a gedmo tree entity, with class options.
	 *
	 * @param string	$template
	 * @access	public
	 * @return string
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public function defaultConnexion($params = null)
	{
		if(isset($params['template']) && !empty($params['template']))
			$template = $params['template'];
		else 
			$template = "PiAppTemplateBundle:Template\\Login\\Security:login.html.twig";
		
		$em	  	 = $this->container->get('doctrine')->getEntityManager();		
		$request = $this->container->get('request');
        $session = $request->getSession();
        
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
        $lastUsername 	= (null === $session) ? '' : $session->get(SecurityContext::LAST_USERNAME);
        $csrfToken 		= $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');

        $response 		=  $this->container->get('templating')->renderResponse($template, array(
            'last_username' => $lastUsername,
            'error'         => $error,
            'csrf_token' 	=> $csrfToken,
        ));
        
        $this->container->get('session')->setFlashes(array());
        return $response->getContent();
	}
	
	/**
	 * Reset user password
	 */
	public function resetConnexion($params = null)
	{
		if(isset($params['template']) && !empty($params['template']))
			$template = $params['template'];
		else
			$template = "PiAppTemplateBundle:Template\\Login\\Resetting:reset_content.html.twig";
				
		$token  = $this->container->get('request')->query->get('token');
		
		$user 	= $this->container->get('fos_user.user_manager')->findUserByConfirmationToken($token);
		if (null === $user) {
			throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException(sprintf('The user with "confirmation token" does not exist for value "%s"', $token));
		}
	
		if (!$user->isPasswordRequestNonExpired($this->container->getParameter('fos_user.resetting.token_ttl'))) {
			return new \Symfony\Component\HttpFoundation\RedirectResponse($this->container->get('router')->generate('fos_user_resetting_request'));
		}
	
		$form 			= $this->container->get('fos_user.resetting.form');
		$formHandler 	= $this->container->get('fos_user.resetting.form.handler');
		$process 		= $formHandler->process($user);
	
		if ($process) {
            $response = new \Symfony\Component\HttpFoundation\RedirectResponse($this->container->get('router')->generate('home_page'));
            $this->authenticateUser($user, $response);

            $this->container->get('session')->setFlashes(array());
			return $response;
		}
		
		$this->container->get('session')->setFlashes(array());
		return $this->container->get('templating')->renderResponse($template, array(
				'token' => $token,
				'form' => $form->createView(),
				'theme' => $this->container->getParameter('fos_user.template.theme'),
		))->getContent();
	}	
	
	/**
	 * Authenticate a user with Symfony Security
	 *
	 * @param \FOS\UserBundle\Model\UserInterface        $user
	 * @param \Symfony\Component\HttpFoundation\Response $response
	 */
	protected function authenticateUser($user, Response $response)
	{
		try {
			$this->container->get('fos_user.security.login_manager')->loginUser(
					$this->container->getParameter('fos_user.firewall_name'),
					$user,
					$response);
		} catch (\Symfony\Component\Security\Core\Exception\AccountStatusException $ex) {
			// We simply do not authenticate users which do not pass the user
			// checker (not enabled, expired, etc.).
		}
	}	
	
}