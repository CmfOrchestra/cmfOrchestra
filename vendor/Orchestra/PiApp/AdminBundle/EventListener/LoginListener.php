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

use BeSimple\I18nRoutingBundle\Routing\Router as Router;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
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
     * @var \BootStrap\TranslationBundle\Route\RouteTranslatorFactory $router
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
     * @var $redirect        route name of the redirection
     */    
    protected $redirect = "";
    
    /**
     * @var $template        layout file name
     */    
    protected $template = "";
    
    /**
     * @var $layout
     */
    protected $layout;

    
    /**
     * Constructs a new instance of SecurityListener.
     * 
     * @param SecurityContext $security The security context
     * @param EventDispatcher $dispatcher The event dispatcher
     * @param Doctrine        $doctrine
     * @param Container        $container
     */
    public function __construct(SecurityContext $security, EventDispatcher $dispatcher, Doctrine $doctrine, ContainerInterface $container)
    {
        $this->security     = $security;
        $this->dispatcher     = $dispatcher;
        $this->em              = $doctrine->getManager();
        $this->container     = $container;
        $this->router        = $this->container->get('bootstrap.RouteTranslator.factory');
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
        $this->event    = $event;
        
        // Sets the user local value.
        $this->setLocaleUser();
        
        // Sets the state of the redirection.
        $this->setParams();
        
        // Sets the layout based on user role.
        $this->setLayout();
        
        // Associate to the dispatcher the onKernelResponse event.
        $this->dispatcher->addListener(KernelEvents::RESPONSE, array($this, 'onKernelResponse'));
        
        // Return the success connecion flash message.        
        $this->getFlashBag()->clear();
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
        /*         $response = $event->getResponse();
        // .. modify the response object */
        if (!empty($this->redirect)){
            $response = new RedirectResponse($this->router->getRoute($this->redirect));
        }elseif ( $this->security->isGranted('ROLE_CONTENT_MANAGER') || $this->security->isGranted('ROLE_ADMIN') || $this->security->isGranted('ROLE_SUPER_ADMIN') ){
            $response = new RedirectResponse($this->router->getRoute($this->redirect_admin));
            $this->redirect = $this->redirect_admin;
        }elseif ( $this->security->isGranted('ROLE_USER') ){
            $response = new RedirectResponse($this->router->getRoute($this->redirect_user));
            $this->redirect = $this->redirect_user;
        } else {
            $response = new RedirectResponse($this->router->getRoute($this->redirect_subscriber));
            $this->redirect = $this->redirect_subscriber;
        }
        // Record the layout variable in cookies.
        if ($this->date_expire && !empty($this->date_interval)){
            $dateExpire = new \DateTime("NOW");
            $dateExpire->add(new \DateInterval($this->date_interval)); // we add 4 hour
        }else {
            $dateExpire = 0;
        }
        $response->headers->setCookie(new \Symfony\Component\HttpFoundation\Cookie('orchestra-layout', $this->layout, $dateExpire));
        $response->headers->setCookie(new \Symfony\Component\HttpFoundation\Cookie('orchestra-redirection', $this->redirect, $dateExpire));
        $event->setResponse($response);
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
/*         $request = $event->getRequest();
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
        /*         $val = $event->getControllerResult();
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
        /*         $exception = $event->getException();
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
        // we get the best role of the user.
        $BEST_ROLE_NAME = $this->container->get('bootstrap.Role.factory')->getBestRoleUser();
        if (!empty($BEST_ROLE_NAME)) {
            $role         = $this->em->getRepository("BootStrapUserBundle:Role")->findOneBy(array('name' => $BEST_ROLE_NAME));
            if ($role instanceof \BootStrap\UserBundle\Entity\Role) {
                $this->redirect = $role->getRouteName();
                
                if ($role->getLayout() instanceof \PiApp\AdminBundle\Entity\Layout) {
                    $this->template = $role->getLayout()->getFilePc();
                }
            }
        }
        $this->date_expire            = $this->container->getParameter('pi_app_admin.cookies.date_expire');
        $this->date_interval        = $this->container->getParameter('pi_app_admin.cookies.date_interval');
        // 
        $this->redirect_admin        = $this->container->getParameter('pi_app_admin.layout.login.admin_redirect');
        $this->redirect_user         = $this->container->getParameter('pi_app_admin.layout.login.user_redirect');
        $this->redirect_subscriber    = $this->container->getParameter('pi_app_admin.layout.login.subscriber_redirect');
        // 
        $this->template_admin        = $this->container->getParameter('pi_app_admin.layout.login.admin_template');
        $this->template_user        = $this->container->getParameter('pi_app_admin.layout.login.user_template');
        $this->template_subscriber    = $this->container->getParameter('pi_app_admin.layout.login.subscriber_template');        
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
        // init
        $request    = $this->getRequest();
        // we get browser info
        $browser = $request->attributes->get('orchestra-browser');
        // Sets layout
        if ($browser->isMobileDevice) {
            if ($request->attributes->has('orchestra-screen')) {    
                $OrchestraScreen = $request->attributes->get('orchestra-screen'); 
            } else {
                $OrchestraScreen = 'layout-medium';
            }
            $request->setRequestFormat('mobile');
            //     we calculate the layout to be applied.
            if ( $this->security->isGranted('ROLE_CONTENT_MANAGER') || $this->security->isGranted('ROLE_ADMIN') || $this->security->isGranted('ROLE_SUPER_ADMIN') ) {
                $layout    = 'PiAppTemplateBundle::Template\\Layout\\Mobile\\Admin\\'. $OrchestraScreen . '.html.twig';
            } elseif ( $this->security->isGranted('ROLE_USER') ) {
                $layout    = 'PiAppTemplateBundle::Template\\Layout\\Mobile\\User\\'. $OrchestraScreen . '.html.twig';
            } else {
                $layout    = 'PiAppTemplateBundle::Template\\Layout\\Mobile\\Default\\'. $OrchestraScreen . '.html.twig';
            }
        } else {
            //     we calculate the layout to be applied.
            if (!empty($this->template)) {
                $layout    = 'PiAppTemplateBundle::Template\\Layout\\Pc\\'.$this->template;
            } elseif ( $this->security->isGranted('ROLE_CONTENT_MANAGER') || $this->security->isGranted('ROLE_ADMIN') || $this->security->isGranted('ROLE_SUPER_ADMIN') ) {
                $layout    = 'PiAppTemplateBundle::Template\\Layout\\Pc\\'.$this->template_admin;
            } elseif ( $this->security->isGranted('ROLE_USER') ) {
                $layout    = 'PiAppTemplateBundle::Template\\Layout\\Pc\\'.$this->template_user;
            } else {
                $layout    = 'PiAppTemplateBundle::Template\\Layout\\Pc\\'.$this->template_subscriber;
            }
        }
        // Record the layout variable in attributes.    
        $request->attributes->set('orchestra-layout', $layout);
        $this->layout =  $layout;
    }    
    
    /**
     * Return the request object.
     *
     * @return \Symfony\Component\HttpFoundation\Request
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */    
    protected function getRequest()
    {
        return $this->event->getRequest();
    }
    
    /**
     * Return the connected user entity object.
     *
     * @return \BootStrap\UserBundle\Entity\user
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
        if (method_exists($this->event->getAuthenticationToken()->getUser()->getLangCode(), 'getId')) {
            $this->getRequest()->setLocale($this->event->getAuthenticationToken()->getUser()->getLangCode()->getId());
        } else {
            $this->getRequest()->setLocale($this->container->get('pi_app_admin.locale_manager')->parseDefaultLanguage());
        }
    }    
    
    /**
     * Gets the flash bag.
     *
     * @return \Symfony\Component\HttpFoundation\Session\Flash\FlashBag
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function getFlashBag()
    {
        return $this->getRequest()->getSession()->getFlashBag();
    }    
    
    /**
     * Sets the welcome flash message.
     *
     * @return void
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */    
    protected function setFlash()
    {
        $this->getFlashBag()->add('notice', "pi.session.flash.welcom");
    }    
}