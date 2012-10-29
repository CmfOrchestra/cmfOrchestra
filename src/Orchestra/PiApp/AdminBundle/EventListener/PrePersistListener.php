<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Eventlistener
 * @package    EventListener
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2011-01-27
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;

use PiApp\AdminBundle\EventListener\CoreListener;

/**
 * Custom pre persist entities listener.
 * The prePersist event occurs for a given entity before the respective EntityManager
 * persist operation for that entity is executed.
 *
 * @category   Admin_Eventlistener
 * @package    EventListener
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class PrePersistListener extends CoreListener
{
	/**
	 * Constructs a new instance of SecurityListener.
	 *
	 * @param ContainerInterface        $container
	 */
	public function __construct(ContainerInterface $container)
	{
		parent::__construct($container);
	}
		
	/**
	 * Methos which will be called when the event is thrown.
	 *
	 * @param \Doctrine\ORM\Event\LifecycleEventArgs $eventArgs
	 *
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 */	
    public function PrePersist(LifecycleEventArgs $eventArgs)
    {
    	// we set the PrePersist layout management
    	$this->_Layout($eventArgs);
    	
    	// we set the PrePersist widget management
    	$this->_widgetListener($eventArgs);
    	
    	// Method which will be called when we check if the url of the page does not already exist.
    	$this->_single_SlugByPage($eventArgs);    	
    	
    	// Method which will be called when we detach the permission of Persist a page.
    	$this->_Persist_Permission_Page_ByUser($eventArgs);    	
    	
    	// we set the PrePersist management
    	// BE CAREFUL !!! this method has to be used in the last of your LifecycleEvent management.
    	$this->_prePersist($eventArgs);
    }
    
}