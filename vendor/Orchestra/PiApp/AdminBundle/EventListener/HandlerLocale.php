<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Eventlistener
 * @package    EventListener
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2013-04-18
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Custom locale handler.
 *
 * @category   Admin_Eventlistener
 * @package    EventListener
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class HandlerLocale implements EventSubscriberInterface
{
   private $defaultLocale;

   /**
    * Constructor.
    *
    * @param string $defaultLocale	Locale value
    */   
   public function __construct($defaultLocale = 'en')
   {
       $this->defaultLocale = $defaultLocale;
   }

   /**
    * Invoked to modify the controller that should be executed.
    *
    * @param FilterControllerEvent $event The event
    *
    * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
    */   
   public function onKernelRequest(GetResponseEvent $event)
   {
   	   //print_r('priority 1');
       $request = $event->getRequest();
       if (!$request->hasPreviousSession()) {
           return;
       }
       // we set locale
       $locale = $request->cookies->has('_locale');
       if ($locale && !empty($locale)) {
           $request->attributes->set('_locale', $request->cookies->get('_locale'));
           $request->setLocale($request->cookies->get('_locale'));
       } else {
           $request->setLocale($this->defaultLocale);
       }
   }
   
   static public function getSubscribedEvents()
   {
	   return array(
	   		// must be registered before the default Locale listener
	   		KernelEvents::REQUEST => array(array('onKernelRequest', 66)),
	   );
   }   

}