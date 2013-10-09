<?php
/**
 * This file is part of the <Translation> project.
 *
 * @category   BootStrap_Eventlistener
 * @package    EventListener
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2013-04-18
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\TranslationBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Translation listener manager.
 *
 * @category   BootStrap_Eventlistener
 * @package    EventListener
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class LocaleListener implements EventSubscriberInterface
{
   private $defaultLocale;

   public function __construct($defaultLocale = 'en')
   {
       $this->defaultLocale = $defaultLocale;
   }

   public function onKernelRequest(GetResponseEvent $event)
   {
       $request = $event->getRequest();
       if (!$request->hasPreviousSession()) {
           return;
       }

       if ($locale = $request->cookies->has('_locale')) {
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
           KernelEvents::REQUEST => array(array('onKernelRequest', 1)),
       );
   }
}