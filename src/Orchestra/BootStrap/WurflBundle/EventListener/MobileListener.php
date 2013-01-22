<?php
/**
 * This file is part of the <Wurfl> project.
 *
 * @category   BootStrap_Eventlistener
 * @package    EventListener
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2011-01-25
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\WurflBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpFoundation\Request;

/**
 * Custom mobile listener.
 * Register the mobile format.
 *
 * @category   BootStrap_Eventlistener
 * @package    EventListener
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class MobileListener
{
    /**
     * Constructor.
     */
    public function __construct()
    {
    	    	
    }

    /**
     * Invoked to modify the controller that should be executed.
     *
	 * <code>
	 * 		$browser = \Zend_Registry::get('wurflDevice')->getAllGroups();
	 * 		$browser = \Zend_Registry::get('wurflDevice')->getGroup("group_name");
	 * 
	 * 		$browser = \Zend_Registry::get('wurflDevice')->getAllFeatures();
	 * 		$browser = \Zend_Registry::get('wurflDevice')->hasFeature("feature_name");
	 * 		$browser = \Zend_Registry::get('wurflDevice')->getFeature("feature_name");
	 * 	
	 * 		$browser = \Zend_Registry::get('wurflDevice')->getBrowser();
	 * 		$browser = \Zend_Registry::get('wurflDevice')->getBrowserVersion();
	 * 
	 * 		$browser = \Zend_Registry::get('wurflDevice')->getImageFormatSupport();
	 * 		$browser = \Zend_Registry::get('wurflDevice')->getImages();
	 * 		$browser = \Zend_Registry::get('wurflDevice')->getMaxImageHeight();
	 * 		$browser = \Zend_Registry::get('wurflDevice')->getMaxImageWidth();
	 * 		$browser = \Zend_Registry::get('wurflDevice')->getPhysicalScreenHeight();
	 * 		$browser = \Zend_Registry::get('wurflDevice')->getPhysicalScreenWidth();
	 * 
	 * 		$browser = \Zend_Registry::get('wurflDevice')->getPreferredMarkup();
	 * 		$browser = \Zend_Registry::get('wurflDevice')->getUserAgent();
	 * 		$browser = \Zend_Registry::get('wurflDevice')->getXhtmlSupportLevel();
	 * 		$browser = \Zend_Registry::get('wurflDevice')->hasFlashSupport();
	 * 		$browser = \Zend_Registry::get('wurflDevice')->hasPdfSupport();
	 * 		$browser = \Zend_Registry::get('wurflDevice')->hasPhoneNumber();
	 * 		$browser = \Zend_Registry::get('wurflDevice')->httpsSupport();
	 * 
	 * 		$agent = \Zend_Registry::get('wurflAgent')->getBrowserType();  // ['mobile', 'desktop']
	 * 		$agent = \Zend_Registry::get('wurflAgent')->getConfig();
	 * </code
	 * 
     * @param FilterControllerEvent $event The event
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */    
    public function onKernelController(FilterControllerEvent $event)
    {
		$request 	= $event->getRequest($event);
		$session 	= $request->getSession();
		
		// It records the input screen of the customer's site.
		if(!$session->has('wurfl-screen')) {
			
	        $width = \Zend_Registry::get('wurflDevice')->getPhysicalScreenWidth();
	        switch (true) {
	        	case ($width <= 0):
	        		$session->set('wurfl-screen', 'layout');
	        		break;
	        	case ($width <= 128):
	        		$session->set('wurfl-screen', 'layout-poor');
	        		break;
	        	case ($width <= 176):
	        		$session->set('wurfl-screen', 'layout-medium');
	        		break;
	        	case ($width <= 240):
	        		$session->set('wurfl-screen', 'layout-high');
	        		break;
	        	case ($width <= 320):
	        		$session->set('wurfl-screen', 'layout-ultra');
	        		break;
	        	default:
	        		// use default
	        		break;
	        }  
		} 
    }
     
}