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
namespace OrApp\OrAdminBundle\EventListener;

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

use PiApp\AdminBundle\EventListener\HandlerLogin as baseLoginHandler;


/**
 * Custom login handler.
 * This allow you to execute code right after the user succefully logs in.
 * 
 * @category   Admin_Eventlistener
 * @package    EventListener
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class HandlerLogin extends baseLoginHandler
{
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
        parent::__construct($security, $dispatcher, $doctrine, $container);
    }
}