<?php
/**
 * This file is part of the <Gedmo> project.
 *
 * @category   Gedmo_EventSubscriber
 * @package    EventSubscriber
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-10-08
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\GedmoBundle\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\EventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;

use BootStrap\TranslationBundle\EventListener\abstractListener;

/**
 * Bundle Subscriber.
 *
 * @category   Gedmo_EventSubscriber
 * @package    EventSubscriber
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class EventSubscriberBundle  extends abstractListener implements EventSubscriber
{
    /**
     * @return array
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function getSubscribedEvents()
    {
        return array(
            Events::prePersist,
            Events::preUpdate,
            Events::preRemove,
            Events::postUpdate,
            Events::postRemove,
            Events::postPersist,
        );
    }

    /**
     * @param \Doctrine\Common\EventArgs $args
     * @return void
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function recomputeSingleEntityChangeSet(EventArgs $args)
    {
        $em = $args->getEntityManager();

        $em->getUnitOfWork()->recomputeSingleEntityChangeSet(
            $em->getClassMetadata(get_class($args->getEntity())),
            $args->getEntity()
        );
    }
    
    /**
     * @param \Doctrine\Common\EventArgs $args
     * @return void
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function postUpdate(EventArgs $eventArgs)
    {
        //$entity			= $eventArgs->getEntity();
        //$entityManager 	= $eventArgs->getEntityManager();        
    }
    
    /**
     * @param \Doctrine\Common\EventArgs $args
     * @return void
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function postRemove(EventArgs $eventArgs)
    {
        //$entity			= $eventArgs->getEntity();
        //$entityManager 	= $eventArgs->getEntityManager();
    }
    
    /**
     * @param \Doctrine\Common\EventArgs $args
     * @return void
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function postPersist(EventArgs $eventArgs)
    {
        //$entity			= $eventArgs->getEntity();
        //$entityManager 	= $eventArgs->getEntityManager();
    }
    
    /**
     * @param \Doctrine\Common\EventArgs $args
     * @return void
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function preUpdate(PreUpdateEventArgs $eventArgs)
    {
        //$entity			= $eventArgs->getEntity();
        //$entityManager 	= $eventArgs->getEntityManager();
    }
    
    /**
     * @param \Doctrine\Common\EventArgs $args
     * @return void
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function preRemove(EventArgs $eventArgs)
    {
    	//$entity			= $eventArgs->getEntity();
        //$entityManager 	= $eventArgs->getEntityManager();
    }
    
    /**
     * @param \Doctrine\Common\EventArgs $args
     * @return void
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function prePersist(EventArgs $eventArgs)
    {
    	//$entity			= $eventArgs->getEntity();
        //$entityManager 	= $eventArgs->getEntityManager();
    }    
 
}