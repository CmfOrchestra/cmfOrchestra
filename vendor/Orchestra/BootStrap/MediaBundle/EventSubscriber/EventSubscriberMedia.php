<?php
/**
 * This file is part of the <Media> project.
 *
 * @category   BootStrap_EventSubscriber
 * @package    EventSubscriber
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-07-20
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\MediaBundle\EventSubscriber;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\EventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\DependencyInjection\ContainerInterface;

use BootStrap\TranslationBundle\EventListener\abstractListener;

/**
 * Media entity Subscriber.
 *
 * @category   BootStrap_EventSubscriber
 * @package    EventSubscriber
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class EventSubscriberMedia  extends abstractListener implements EventSubscriber
{
    /**
     * @return array
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
     * @return
     */
    public function postUpdate(EventArgs $eventArgs)
    {
    }
    
    /**
     * @param \Doctrine\Common\EventArgs $args
     * @return
     */
    public function postRemove(EventArgs $eventArgs)
    {
    }
    
    /**
     * @param \Doctrine\Common\EventArgs $args
     * @return
     */
    public function postPersist(EventArgs $eventArgs)
    {    	
    }
    
    /**
     * @param \Doctrine\Common\EventArgs $args
     * @return
     */
    public function preRemove(EventArgs $eventArgs)
    {
    }    
    
    /**
     * @param \Doctrine\Common\EventArgs $args
     * @return
     */
    public function preUpdate(EventArgs $eventArgs)
    {
    	$this->_MediaGedmo($eventArgs);   
    }
    
    /**
     * @param \Doctrine\Common\EventArgs $args
     * @return
     */
    public function prePersist(EventArgs $eventArgs)
    {
    	$this->_MediaGedmo($eventArgs);
    }    
    
    /**
     * We are setting the Gedmo Media to null if removing the Media was checked. 
     *
     * @param $eventArgs
     *
     * @return void
     * @access private
     * @final
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    private function _MediaGedmo($eventArgs)
    {
        $entity			= $eventArgs->getEntity();
    	$entityManager 	= $eventArgs->getEntityManager();
    	
    	if ( $this->isUsernamePasswordToken() && ($entity instanceof \Proxies\__CG__\PiApp\GedmoBundle\Entity\Media) && !$this->isRestrictionByRole($entity) && ($entity->getMediadelete() == true) )
    	{
    		try {
    			$entity_table = $this->getOwningTable($eventArgs, $entity);
    			$query = "UPDATE $entity_table mytable SET mytable.media = null WHERE mytable.id = ?";
    			$this->_connexion($eventArgs)->executeUpdate($query, array($entity->getId()));
    			
    			$this->_container()->get('sonata.media.provider.image')->preRemove($entity->getImage());
    			$this->_connexion($eventArgs)->delete($this->getOwningTable($eventArgs, $entity->getImage()), array('id'=>$entity->getImage()->getId()));
    			$this->_container()->get('sonata.media.provider.image')->postRemove($entity->getImage());    			
    		} catch (\Exception $e) {
    		}
    		
    		$entity->setImage(null);
    	} 
    	
    	// we clean the filename.
    	if ( $this->isUsernamePasswordToken() && ($entity instanceof \Proxies\__CG__\BootStrap\MediaBundle\Entity\Media) ){
    		$entity->setName($this->_cleanName($entity->getName()));
    	}    	
    }

    /**
     * We return the clean of a string.
     *
     * @param	string	$string
     * @return 	string	name
     * @access private
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    private function _cleanName($string){
    	$string = \PiApp\AdminBundle\Util\PiStringManager::minusculesSansAccents($string);
    	$string = \PiApp\AdminBundle\Util\PiStringManager::cleanFilename($string);
    	 
    	return $string;
    }    
}