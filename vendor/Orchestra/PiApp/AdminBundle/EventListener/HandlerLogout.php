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

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;

/**
 * Custom logout handler.
 *
 * @category   Admin_Eventlistener
 * @package    EventListener
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class HandlerLogout implements LogoutSuccessHandlerInterface 
{
	/**
	 * @var \Symfony\Component\Routing\Router $router
	 */
	protected $router;
		
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;
    
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;    
    
    /**
     * @var \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected $redirection = '';    
    
    /**
     * @var \Symfony\Component\HttpFoundation\Request $request
     */
    protected $request;    
    
    /**
     * @var $layout
     */
    protected $layout;    
    
    /**
     * @var layout init params
     */    
    protected $date_expire;
    protected $date_interval;
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
    public function __construct(ContainerInterface $container, Doctrine $doctrine)
    {
    	$this->router        = $container->get('bootstrap.RouteTranslator.factory');
    	$this->container     = $container;
    	$this->em            = $doctrine->getManager();
    }
    
    /**
     * Sets the information in cookies (orchestra-layout, orchestra-browser)
     * and redirects with the right url.
     * 
     * Invoked after the response has been created.
     * Invoked to allow the system to modify or replace the Response object after its creation.
     *
     * @param FilterResponseEvent $event The event
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function onLogoutSuccess(Request $request)
    {
    	//print_r('priority 3-bis');
    	// set request
    	$this->request = $request;
        // Sets parameter template values.
        $this->setParams();
        // Sets init.
        $this->setValues();   
        // set redirection
        return $this->Redirection();  
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
        $this->init_pc_layout               = $this->container->getParameter('pi_app_admin.layout.init.pc.template');
        $this->init_pc_redirection          = $this->container->getParameter('pi_app_admin.layout.init.pc.redirection');
        $this->init_mobile_layout           = $this->container->getParameter('pi_app_admin.layout.init.mobile.template');
        $this->init_mobile_redirection      = $this->container->getParameter('pi_app_admin.layout.init.mobile.redirection');
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
    	try {
    		// we get the best role of the user.
    		$BEST_ROLE_NAME = $this->container->get('bootstrap.Role.factory')->getBestRoleUser();
    		if (!empty($BEST_ROLE_NAME)) {
    			$role         = $this->em->getRepository("BootStrapUserBundle:Role")->findOneBy(array('name' => $BEST_ROLE_NAME));
    			if ($role instanceof \BootStrap\UserBundle\Entity\Role) {
    				$this->redirection = $role->getRouteLogout();
    			}
    		}    		
    	} catch (\Exception $e) {
    	}
    }    
    
    /**
     * Set logout redirection value in order to the role deconnected user
     *
     * @param FilterResponseEvent $event The event
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function Redirection()
    {
    	if (!empty($this->redirection)) {
    		return new RedirectResponse($this->router->getRoute($this->redirection));
    	} else {
    		return new RedirectResponse($this->router->getRoute('home_page'));
    	}
    }    
    
}