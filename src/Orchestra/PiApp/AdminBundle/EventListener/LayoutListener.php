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
namespace PiApp\AdminBundle\EventListener;

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
class LayoutListener
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
			$session->set('wurfl-screen', 'layout');			
		} 
    }
     
}