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
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use FOS\UserBundle\Model\UserInterface;

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
	const SESSION_EMAIL = 'fos_user_send_resetting_email/email';
	
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
		
		if(empty($lang))
			$lang		= $this->container->get('session')->getLocale();
		
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
		
		if(empty($params['locale']))
			$params['locale']		= $this->container->get('session')->getLocale();		
		
		$em	  	 = $this->container->get('doctrine')->getEntityManager();		
		$request = $this->container->get('request');
        $session = $request->getSession();
        
        //$this->container->get('session')->remove('referer_redirection');
        //print_r($referer_url = $this->container->get('session')->get('referer_redirection'));
        
        if(isset($params['referer_redirection']) && !empty($params['referer_redirection']) && ($params['referer_redirection'] == "true")){
	        $referer_url = $this->container->get('request')->headers->get('referer');
        }else{
        	$referer_url = "";
        }      
        
        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        }elseif(null !== $session && $session->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }else{
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
        	'referer_url'   => $referer_url,
        ));
        
        $this->container->get('session')->clearFlashes();
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
		
		if(isset($params['url_redirection']) && !empty($params['url_redirection']))
			$url_redirection = $params['url_redirection'];
		else
			$url_redirection = $this->container->get('router')->generate("home_page");
				
		$token  	 = $this->container->get('request')->query->get('token');
		
		// if a user is connected, we generate automatically the token if it is not given in parameter.
		if(empty($token) && $this->isUsernamePasswordToken()){
			$token = $this->tokenUser($this->getToken()->getUser());
			$user  = $this->getToken()->getUser();
		}else{
			$user 	= $this->container->get('fos_user.user_manager')->findUserByConfirmationToken($token);
			if (null === $user) {
				throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException(sprintf('The user with "confirmation token" does not exist for value "%s"', $token));
			}
			
			// 		if (!$user->isPasswordRequestNonExpired($this->container->getParameter('fos_user.resetting.token_ttl'))) {
			// 			return new \Symfony\Component\HttpFoundation\RedirectResponse($this->container->get('router')->generate('fos_user_resetting_request'));
			// 		}
		}
	
		$form 			= $this->container->get('fos_user.resetting.form');
		$formHandler 	= $this->container->get('fos_user.resetting.form.handler');
		$process 		= $formHandler->process($user);
	
		if ($process) {
			$response = new \Symfony\Component\HttpFoundation\RedirectResponse($url_redirection);
			$this->authenticateUser($user, $response);
			
			$this->container->get('session')->clearFlashes();
			return $response;
		}
		
		$this->container->get('session')->clearFlashes();
		return $this->container->get('templating')->renderResponse($template, array(
				'token' => $token,
				'form'  => $form->createView(),
				'theme' => $this->container->getParameter('fos_user.template.theme'),
				'route' => $this->container->get('bootstrap.RouteTranslator.factory')->getMatchParamOfRoute('_route', $this->container->get('session')->getLocale())
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
		
	/**
	 * Send mail to reset user password
	 */	
    public function sendResettingEmailMessage(UserInterface $user, $route_reset_connexion)
    {
    	$user->generateConfirmationToken();
    	$this->container->get('session')->set(static::SESSION_EMAIL, $this->getObfuscatedEmail($user));
    	
    	$url 	  = $this->container->get('bootstrap.RouteTranslator.factory')->getRoute($route_reset_connexion, array('token' => $user->getConfirmationToken()));
    	$html_url = 'http://'.$this->container->get('Request')->getHttpHost() . $this->container->get('Request')->getBasePath().$url;
    	$html_url = "<a href='$html_url'>" . $html_url . "</a>";
    	return $html_url;
    }	
    
    /**
     * return confirmation token to reset user password
     */
    public function tokenUser(UserInterface $user)
    {
    	$user->generateConfirmationToken();
    	$this->container->get('session')->set(static::SESSION_EMAIL, $this->getObfuscatedEmail($user));
    	 
    	return $user->getConfirmationToken();
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
	
}