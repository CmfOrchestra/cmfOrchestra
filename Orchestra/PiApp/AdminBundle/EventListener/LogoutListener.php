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
use Symfony\Component\DependencyInjection\ContainerInterface;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;


/**
 * Custom mobile listener.
 * Register the mobile format.
 *
 * @category   Admin_Eventlistener
 * @package    EventListener
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class LogoutListener
{
    /**
     * @var \Symfony\Component\HttpKernel\Event\FilterResponseEvent
     */
    protected $event;
    
    /**
     * @var \Symfony\Component\Routing\Router $router
     */
    protected $router;
    
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;
    
    /**
     * @var \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected $redirection;    
    
    /**
     * @var $layout
     */
    protected $layout;    
    
    /**
     * @var layout init params
     */    
    protected $init_pc_layout;
    protected $init_pc_redirection;    
    protected $init_mobile_layout;
    protected $init_mobile_redirection;
    protected $is_switch_language_browser_authorized;
    protected $is_init_redirection_authorized;
    
    /**
     * Constructs a new instance of SecurityListener.
     * 
     * @param Router $router The router
     * @param ContainerInterface $container The service container
     */
    public function __construct(Router $router, ContainerInterface $container)
    {
        $this->router        = $router;        
        $this->container     = $container;
    }
    
    /**
     * Sets the wurfl information in session (orchestra-layout, orchestra-form, orchestra-grid, orchestra-flash, orchestra-connection)
     * and redirects with the right url.
     * 
     * Invoked after the response has been created.
     * Invoked to allow the system to modify or replace the Response object after its creation.
     *
     * @param FilterResponseEvent $event The event
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function onKernelResponse(FilterResponseEvent $event)
    {
        // Sets event.
        $this->event    = $event;
        
        // Sets parameter template values.
        $this->setParams();
        
        // Sets the user local value.
        $this->setLocaleNavigator();
        
        // Sets init.
        $this->setValues();        
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
     * Sets parameter template values.
     *
     * @return void
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function setParams()
    {
        $this->date_expire                                = $this->container->getParameter('pi_app_admin.cookies.date_expire');
        $this->date_interval                            = $this->container->getParameter('pi_app_admin.cookies.date_interval');
        
        $this->init_pc_layout                            = $this->container->getParameter('pi_app_admin.layout.init.pc.template');
        $this->init_pc_redirection                         = $this->container->getParameter('pi_app_admin.layout.init.pc.redirection');
        $this->init_mobile_layout                        = $this->container->getParameter('pi_app_admin.layout.init.mobile.template');
        $this->init_mobile_redirection                     = $this->container->getParameter('pi_app_admin.layout.init.mobile.redirection');
        
        $this->is_switch_language_browser_authorized    = $this->container->getParameter('pi_app_admin.page.switch_language_browser_authorized');
        $this->is_init_redirection_authorized             = $this->container->getParameter('pi_app_admin.page.switch_layout_init_redirection_authorized');
    }    
    
    /**
     * Sets values.
     *
     * @return void
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function setValues()
    {
        // init
        $request         = $this->event->getRequest();
        $session         = $this->getSession();
        $isFirstPage     = $session->has('isFirstPage');
        $route             = $this->container->get('request')->get('_route');

        // we get browser info
        if ($request->attributes->has('orchestra-browser')) {
            $browser = $request->attributes->get('orchestra-browser');        
            // set layout value
            if ($browser->isMobileDevice) {
                if ($request->attributes->has('orchestra-screen'))    $WurflScreen = $request->attributes->get('orchestra-screen'); else    $WurflScreen = 'layout-medium';
                $this->layout        = 'PiAppTemplateBundle::Template\\Layout\\Mobile\\'.$this->init_mobile_layout.'\\' . $WurflScreen . '.html.twig';
                $this->redirection    = new RedirectResponse($this->router->generate($this->init_mobile_redirection));
            } else {
                $this->layout        = 'PiAppTemplateBundle::Template\\Layout\\Pc\\'.$this->init_pc_layout;
                $this->redirection    = new RedirectResponse($this->router->generate($this->init_pc_redirection));
            }
            // if layout value is not created
            if (!$request->cookies->has('orchestra-layout')) {
                // if the user is logged in, it disconnects.
                if ($this->isUsernamePasswordToken()) {
                    $this->redirection     = new \Symfony\Component\HttpFoundation\RedirectResponse($this->router->generate("fos_user_security_logout"));
                } else {
                    $this->redirection     = new \Symfony\Component\HttpFoundation\RedirectResponse($request->getUri());
                }                    
                if ($this->date_expire && !empty($this->date_interval)) {
                    $dateExpire = new \DateTime("NOW");
                    $dateExpire->add(new \DateInterval($this->date_interval)); // we add 4 hour
                } else {
                    $dateExpire = 0;
                }
                $this->redirection->headers->setCookie(new \Symfony\Component\HttpFoundation\Cookie('orchestra-layout', $this->layout, $dateExpire));
                $this->event->setResponse( $this->redirection );
            } else {
                // Sets layout and redirection init
                if (!$isFirstPage) {
                    $session->set('isHomePage', false);
                }
                // Sets redirection.
                if (($route == 'fos_user_security_login') && $this->isUsernamePasswordToken()) {
                    $this->redirection = new RedirectResponse($this->router->generate("admin_homepage"));
                    $this->event->setResponse( $this->redirection );
                }elseif (is_object($this->redirection) && $this->is_init_redirection_authorized) {
                    $this->event->setResponse( $this->redirection );
                }
            }                    
        } else {
            throw new \Exception('something wrong in your "orchestra-browser" attribute value');
        }
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
     * Return if yes or no the user is UsernamePassword token.
     *
     * @return boolean
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function isUsernamePasswordToken()
    {
        if ($this->container->get('security.context')->getToken() instanceof \Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken)
            return true;
        else
            return false;
    }    
    
    
    /**
     * Sets the user local value.
     *
     * @return void
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function setLocaleNavigator()
    {
        $session         = $this->getSession();
        $isFirstPage     = $session->has('isFirstPage');
        
        if ($this->is_switch_language_browser_authorized && (!$isFirstPage || ($session->get('isFirstPage') == false)) ) {
            $lang_value = $this->container->get('pi_app_admin.locale_manager')->parseDefaultLanguage();
            $this->getSession()->setLocale($lang_value);
        }
    }    
}