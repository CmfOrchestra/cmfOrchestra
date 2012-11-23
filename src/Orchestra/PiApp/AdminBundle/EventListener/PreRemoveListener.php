<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Eventlistener
 * @package    EventListener
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
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
 * Custom pre remove entities listener.
 * The preRemove event occurs for a given entity before the respective EntityManager 
 * remove operation for that entity is executed.
 * It is not called for a DQL DELETE statement.
 *
 * @category   Admin_Eventlistener
 * @package    EventListener
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PreRemoveListener extends CoreListener
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
	 * Method which will be called when the event is thrown.
	 *
	 *
	 * @param \Doctrine\ORM\Event\LifecycleEventArgs $eventArgs
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */	
    public function PreRemove(LifecycleEventArgs $eventArgs)
    {
    	// we set the pre remove management
    	// BE CAREFUL !!! this method has to be used in the last of your LifecycleEvent management.
    	$this->_preRemove($eventArgs);

    	// Method which will be called when we try to delete the home page.
    	$this->_Undelete_HomePage($eventArgs);    	
    	
    	// Method which will be called when we delete all caches of the page and the row in relation with the pi_routing table.
    	$this->_Delete_Permission_Page_ByUser($eventArgs);
    	
    	// we set the PostPersist search lucene management
    	$this->_Search_lucene($eventArgs, 'delete');
    }  
    
}