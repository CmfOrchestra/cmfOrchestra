<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Eventlistener
 * @package    EventListener
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2011-01-25
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\EventListener;

use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Symfony\Component\HttpKernel\KernelEvents;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;


/**
 * Custom login listener.
 * This allow you to execute code right after the user succefully logs in.
 * 
 * @category   Admin_Eventlistener
 * @package    EventListener
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class LoginListener
{
	/**
	 * @var Router $router
	 */
	protected $router;
		
	/** 
	 * @var \Symfony\Component\Security\Core\SecurityContext $security
	 */
	protected $security;
	
	/**
	 * @var \Symfony\Component\EventDispatcher\Event\EventDispatcher $dispatcher
	 */
	protected $dispatcher;	

	/** 
	 * @var \Doctrine\ORM\EntityManager
	 */
	protected $em;

	/**
	 * @var Symfony\Component\Security\Http\Event\InteractiveLoginEvent
	 */
	protected $event;
	
	/**
	 * @var \Symfony\Component\DependencyInjection\ContainerInterface
	 */
	protected $container;	
	
	/**
	 * @var $redirect		route name of the redirection
	 */	
	protected $redirect = "";
	
	/**
	 * @var $template		layout file name
	 */	
	protected $template = "";

	
	/**
	 * Constructs a new instance of SecurityListener.
	 * 
	 * @param Router $router The router
     * @param SecurityContext $security The security context
     * @param EventDispatcher $dispatcher The event dispatcher
	 * @param Doctrine        $doctrine
	 */
	public function __construct(Router $router, SecurityContext $security, EventDispatcher $dispatcher, Doctrine $doctrine, ContainerInterface $container)
	{
		$this->router		= $router;
		$this->security 	= $security;
		$this->dispatcher 	= $dispatcher;
		$this->em      		= $doctrine->getEntityManager();
		$this->container 	= $container;
	}

	/**
	 * Invoked after a successful login.
	 * 
	 * @param InteractiveLoginEvent $event The event
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public function onSecurityInteractiveLogin(InteractiveLoginEvent  $event)
	{
		// Sets event.
		$this->event	= $event;
		
		// Sets the user local value.
		$this->setLocaleUser();
		
		// Sets the state of the redirection.
		$this->setParams();
		
		// Sets the layout based on user role.
		$this->setLayout();
		
		// Associate to the dispatcher the onKernelResponse event.
		$this->dispatcher->addListener(KernelEvents::RESPONSE, array($this, 'onKernelResponse'));
		
		// Return the success connecion flash message.		
		//$this->setFlash($this->getSession(), $this->getUser()->getUsername());		
	}	
	
	/**
	 * Invoked after the response has been created.
	 * Invoked to allow the system to modify or replace the Response object after its creation.
	 *
	 * @param FilterResponseEvent $event The event
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public function onKernelResponse(FilterResponseEvent $event)
	{
		/*     	$response = $event->getResponse();
		 // .. modify the response object */
		
		if(!empty($this->redirect))
			$event->setResponse( new RedirectResponse($this->router->generate($this->redirect)) );
		elseif( $this->security->isGranted('ROLE_CONTENT_MANAGER') || $this->security->isGranted('ROLE_ADMIN') || $this->security->isGranted('ROLE_SUPER_ADMIN') )
			$event->setResponse( new RedirectResponse($this->router->generate($this->redirect_admin)) );
		elseif( $this->security->isGranted('ROLE_USER') )
			$event->setResponse( new RedirectResponse($this->router->generate($this->redirect_user)) );
		else
			$event->setResponse( new RedirectResponse($this->router->generate($this->redirect_subscriber)) );
	}	
	
	/**
	 * Invoked to modify the controller that should be executed.
	 *
	 * @param FilterControllerEvent $event The event
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */	
	public function onKernelController(FilterControllerEvent $event)
	{
/* 		$request = $event->getRequest();
		//$controller = $event->getController();
		
		//...
		
		// the controller can be changed to any PHP callable
		$event->setController($controller); */	
	}
		
	/**
	 * Invoked to allow some other return value to be converted into a Response.
	 *
	 * @param FilterControllerEvent $event The event
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */	
	public function onKernelView(GetResponseForControllerResultEvent $event)
	{
		/*     	$val = $event->getControllerResult();
		 $response = new Response();
		// some how customize the Response from the return value
	
		$event->setResponse($response); */
	}
	
	/**
	 * Invoked to allow to create and set a Response object, create and set a new Exception object, or do nothing.
	 *
	 * @param FilterControllerEvent $event The event
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */	
	public function onKernelException(GetResponseForExceptionEvent $event)
	{
		/*     	$exception = $event->getException();
		 $response = new Response();
		// setup the Response object based on the caught exception
		$event->setResponse($response); */
	
		// you can alternatively set a new Exception
		// $exception = new \Exception('Some special exception');
		// $event->setException($exception);
	}
	
	/**
	 * Sets the state of the redirection.
	 *
	 * @return void
	 * @access protected
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	protected function setParams()
	{
		// we get the best role of of all user roles.
		$BEST_ROLE_NAME = $this->getBestRoleUser();
		if(!empty($BEST_ROLE_NAME)){
			$role 		= $this->em->getRepository("BootStrapUserBundle:Role")->findOneBy(array('name' => $BEST_ROLE_NAME));
			if($role instanceof \BootStrap\UserBundle\Entity\Role){
				$this->redirect = $role->getRouteName();
				
				if($role->getLayout() instanceof \PiApp\AdminBundle\Entity\Layout)
					$this->template = $role->getLayout()->getFilePc();
			}
		}
		
		$this->redirect_admin		= $this->container->getParameter('pi_app_admin.layout.login.admin_redirect');
		$this->redirect_user 		= $this->container->getParameter('pi_app_admin.layout.login.user_redirect');
		$this->redirect_subscriber	= $this->container->getParameter('pi_app_admin.layout.login.subscriber_redirect');
		
		$this->template_admin		= $this->container->getParameter('pi_app_admin.layout.login.admin_template');
		$this->template_user		= $this->container->getParameter('pi_app_admin.layout.login.user_template');
		$this->template_subscriber	= $this->container->getParameter('pi_app_admin.layout.login.subscriber_template');		
	}	
	
	/**
	 * Sets the layout based on user role.
	 *
	 * @return void
	 * @access protected
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	protected function setLayout()
	{
		$request	= $this->event->getRequest();
		$session	= $this->getSession();
		
		// Sets layout
		if ($request->server->has('HTTP_USER_AGENT') && preg_match('/(iphone|ipad|android)/i', $request->server->get('HTTP_USER_AGENT'))) {
			if($session->has('wurfl-screen'))	$WurflScreen = $session->get('wurfl-screen'); else	$WurflScreen = 'layout-medium';
			$request->setRequestFormat('mobile');
			
			// 	we calculate the layout to be applied.
			if( $this->security->isGranted('ROLE_CONTENT_MANAGER') || $this->security->isGranted('ROLE_ADMIN') || $this->security->isGranted('ROLE_SUPER_ADMIN') )
				$layout	= 'PiAppTemplateBundle::Template\\Layout\\Mobile\\Admin\\'. $WurflScreen . '.html.twig';
			elseif( $this->security->isGranted('ROLE_USER') )
				$layout	= 'PiAppTemplateBundle::Template\\Layout\\Mobile\\User\\'. $WurflScreen . '.html.twig';
			else
				$layout	= 'PiAppTemplateBundle::Template\\Layout\\Mobile\\Default\\'. $WurflScreen . '.html.twig';
		}else{
			// 	we calculate the layout to be applied.
			if(!empty($this->template))
				$layout	= 'PiAppTemplateBundle::Template\\Layout\\Pc\\'.$this->template;
			elseif( $this->security->isGranted('ROLE_CONTENT_MANAGER') || $this->security->isGranted('ROLE_ADMIN') || $this->security->isGranted('ROLE_SUPER_ADMIN') )
				$layout	= 'PiAppTemplateBundle::Template\\Layout\\Pc\\'.$this->template_admin;
			elseif( $this->security->isGranted('ROLE_USER') )
				$layout	= 'PiAppTemplateBundle::Template\\Layout\\Pc\\'.$this->template_user;
			else
				$layout	= 'PiAppTemplateBundle::Template\\Layout\\Pc\\'.$this->template_subscriber;
		}
		
		// Record the layout variable in session.	
		$session->set('wurfl-layout', $layout);
	}	
	
	/**
	 * Return the session object.
	 *
	 * @return object ymfony\Component\HttpFoundation\Session
	 * @access protected
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */	
	protected function getSession()
	{
		return $this->event->getRequest()->getSession();
	}
	
	/**
	 * Return the connected user entity object.
	 *
	 * @return object BootStrap\UserBundle\Entity\user
	 * @access protected
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */	
	protected function getUser()
	{
		return $this->event->getAuthenticationToken()->getUser();
	}
	
	/**
	 * Sets the user local value.
	 *
	 * @return void
	 * @access protected
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	protected function setLocaleUser()
	{
		if(method_exists($this->event->getAuthenticationToken()->getUser()->getLangCode(), 'getId'))
			$this->getSession()->setLocale($this->event->getAuthenticationToken()->getUser()->getLangCode()->getId());
		else
			$this->getSession()->setLocale($this->container->get('pi_app_admin.locale_manager')->parseDefaultLanguage());
	}	
	
	/**
	 * Sets the welcome flash message.
	 *
	 * @param Symfony\Component\HttpFoundation\Session $session
	 * @param string $username
	 * 
	 * @return void
	 * @access protected
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */	
	protected function setFlash($session, $username)
	{
		$session->setFlash('notice', "pi.session.flash.welcom");
		//$session->setFlash('success', "Mrs/Mlle " . ucfirst($username));
	}	
	
	/**
	 * Gets the best role of all user roles.
	 *
	 * @return string	the best role of all user roles.
	 * @access protected
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */	
	protected function getBestRoleUser()
	{
		// we get all user roles.
		$ROLES_USER	= $this->event->getAuthenticationToken()->getUser()->getRoles();
		
		// we get the map of all roles.
		$roleMap = $this->buildRoleMap();		
		
		foreach($roleMap as $role => $heritage){
			if(in_array($role, $ROLES_USER)){
				$intersect	= array_intersect($heritage, $ROLES_USER);
				$ROLES_USER	= array_diff($ROLES_USER, $intersect);  // =  $ROLES_USER -  $intersect
			}	
		}
		return end($ROLES_USER);
	}		

	/**
	 * Sets the map of all roles.
	 *
	 * @return array	role map
	 * @access protected
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	protected function buildRoleMap()
	{
		$hierarchy 	= $this->container->getParameter('security.role_hierarchy.roles');
		$map		= array();
		foreach ($hierarchy as $main => $roles) {
			$map[$main] = $roles;
			$visited = array();
			$additionalRoles = $roles;
			while ($role = array_shift($additionalRoles)) {
				if (!isset($hierarchy[$role])) {
					continue;
				}
	
				$visited[] = $role;
				$map[$main] = array_unique(array_merge($map[$main], $hierarchy[$role]));
				$additionalRoles = array_merge($additionalRoles, array_diff($hierarchy[$role], $visited));
			}
		}
		return $map;
	}	
}