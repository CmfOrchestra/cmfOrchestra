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

use Doctrine\ORM\Event\OnFlushEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;
use PiApp\AdminBundle\EventListener\CoreListener;

/**
 * Custom post load entities listener.
 * The onFlush event occurs after the change-sets of all managed entities are computed.
 * This event is not a lifecycle callback.
 *
 * @category   Admin_Eventlistener
 * @package    EventListener
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class OnFlushListener extends CoreListener
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
	 * OnFlush is a very powerful event. It is called inside EntityManager#flush() after 
	 * the changes to all the managed entities and their associations have been computed.
	 * This means, the onFlush event has access to the sets of:
	 *  	Entities scheduled for insert
	 *		Entities scheduled for update
	 *		Entities scheduled for removal
	 *		Collections scheduled for update
	 *		Collections scheduled for removal
	 *
	 * @param \Doctrine\ORM\Event\LifecycleEventArgs $eventArgs
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */	
    public function onFlush(OnFlushEventArgs  $eventArgs)
    {
        $entityManager 	= $eventArgs->getEntityManager();
        $uow 			= $entityManager->getUnitOfWork();
        
        
        
/*     	foreach ($uow->getScheduledEntityInsertions() AS $entity) {
    		// we persist the values of the entity
    		$class = $entityManager->getClassMetadata(get_class($entity));
    		$entityManager->getUnitOfWork()->recomputeSingleEntityChangeSet($class, $entity);
        }

        foreach ($uow->getScheduledEntityUpdates() AS $entity) {
        	// we persist the values of the entity
        	$class = $entityManager->getClassMetadata(get_class($entity));
        	$entityManager->getUnitOfWork()->recomputeSingleEntityChangeSet($class, $entity);
        }

        foreach ($uow->getScheduledEntityDeletions() AS $entity) {

        }

        foreach ($uow->getScheduledCollectionDeletions() AS $col) {

        }

        foreach ($uow->getScheduledCollectionUpdates() AS $col) {

        } */
        
        
        
        
        /*
        
        just for register in data the change do in this class listener :
        $class = $entityManager->getClassMetadata(get_class($entity));
        $entityManager->getUnitOfWork()->computeChangeSet($class, $entity);
        
        To get a field value:
        $eventArgs->getNewValue('Fieldname');
        
        To know if a field has changed
        $eventArgs->hasChangedField('creditCard')
        
        */        
    }
    
}