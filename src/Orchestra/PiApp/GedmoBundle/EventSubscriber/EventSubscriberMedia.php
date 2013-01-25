<?php
/**
 * This file is part of the <Gedmo> project.
 *
 * @category   Gedmo_EventSubscriber
 * @package    EventSubscriber
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-07-20
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\GedmoBundle\EventSubscriber;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\EventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\DependencyInjection\ContainerInterface;

use BootStrap\UserBundle\EventListener\abstractListener;

/**
 * Media entity Subscriber.
 *
 * @category   Gedmo_EventSubscriber
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
    	$entity			= $eventArgs->getEntity();
    	$entityManager 	= $eventArgs->getEntityManager();
    	    	
    	$this->_PostMediaGedmo($eventArgs);
    }
    
    /**
     * @param \Doctrine\Common\EventArgs $args
     * @return
     */
    public function preUpdate(EventArgs $eventArgs)
    {
    	$this->_MediaGedmo($eventArgs);    	
    	$this->_PostMediaGedmo($eventArgs);
    	$this->_deleteOldMedia($eventArgs);
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
    public function prePersist(EventArgs $eventArgs)
    {
    	$this->_MediaGedmo($eventArgs);
    	$this->_MediaSonata($eventArgs);
    	$this->_PostMediaGedmo($eventArgs);
    }    
    
    /**
     * We delete the old picture before change it.
     *
     * @param \Doctrine\ORM\Event\PreUpdateEventArgs $eventArgs
     *
     * @return void
     * @access private
     * @final
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */    
    private function _deleteOldMedia(PreUpdateEventArgs $eventArgs)
    {
    	$entity			= $eventArgs->getEntity();
    	$entityManager 	= $eventArgs->getEntityManager();    

    	if (!$this->isRestrictionByRole($entity) && $this->isUsernamePasswordToken() && ($entity instanceof \BootStrap\MediaBundle\Entity\Media) ){
	    	if ($eventArgs->hasChangedField('name')) {
	    		$old_entity = clone($entity);
	    		$old_entity->setProviderReference($eventArgs->getOldValue('providerReference'));
	    		$path = $this->_container()->get('sonata.media.provider.image')->getReferenceImage($old_entity);
	    		
	    		if ($this->_container()->get('sonata.media.provider.image')->getFilesystem()->has($path)) {
	    			$this->_container()->get('sonata.media.provider.image')->getFilesystem()->delete($path);
	    		}
	    	}
    	}
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
    	
    	$default_pixel_name = $this->_cleanName($this->_container()->getParameter("pi_app_admin.page.media_pixel"));
    	
    	if ( $this->isUsernamePasswordToken() && ($entity instanceof \PiApp\GedmoBundle\Entity\Media) && !$this->isRestrictionByRole($entity) && (($entity->getMediadelete() == true) || ($entity->getImage()->getName() == $default_pixel_name)) )
    	{
    		$getMedia 				= "getMedia";
    		$setMedia 				= "setMedia";
    		$MediaId 				= "media_id";
    		
    		if($entity->getIndividual() instanceof \PiApp\GedmoBundle\Entity\Individual){
    			$entity_parent_table	= $this->getOwningTable($eventArgs, $entity->getIndividual());
    			$parent_id				= $entity->getIndividual()->getId();
    		}
    		if($entity->getCorporation() instanceof \PiApp\GedmoBundle\Entity\Corporation){
    			$entity_parent_table	= $this->getOwningTable($eventArgs, $entity->getCorporation());
    			$parent_id				= $entity->getCorporation()->getId();
    		}
    		if($entity->getCorporation2() instanceof \PiApp\GedmoBundle\Entity\getCorporation2){
    			$entity_parent_table	= $this->getOwningTable($eventArgs, $entity->getCorporation2());
    			$parent_id				= $entity->getCorporation2()->getId();
    			$getMedia 				= "getMedia2";
    			$setMedia 				= "setMedia2";
    			$MediaId 				= "media2_id";
    		}
    		if($entity->getNewsletter() instanceof \PiApp\GedmoBundle\Entity\Newsletter){
    			$entity_parent_table	= $this->getOwningTable($eventArgs, $entity->getNewsletter());
    			$parent_id				= $entity->getNewsletter()->getId();
    		}
    		if($entity->getRss() instanceof \PiApp\GedmoBundle\Entity\Rss){
    			$entity_parent_table	= $this->getOwningTable($eventArgs, $entity->getRss());
    			$parent_id				= $entity->getRss()->getId();
    		}
    		if($entity->getAds() instanceof \PiApp\GedmoBundle\Entity\Ads){
    			$entity_parent_table	= $this->getOwningTable($eventArgs, $entity->getAds());
    			$parent_id				= $entity->getAds()->getId();
    		} 		    		
    		if($entity->getPartner() instanceof \PiApp\GedmoBundle\Entity\Partner){
    			$entity_parent_table	= $this->getOwningTable($eventArgs, $entity->getPartner());
    			$parent_id				= $entity->getPartner()->getId();
    		}    		
    		if($entity->getPressrelease() instanceof \PiApp\GedmoBundle\Entity\Pressrelease){
    			$entity_parent_table	= $this->getOwningTable($eventArgs, $entity->getPressrelease());
    			$parent_id				= $entity->getPressrelease()->getId();
    		}    		
    		if($entity->getNews() instanceof \PiApp\GedmoBundle\Entity\News){
    			$entity_parent_table	= $this->getOwningTable($eventArgs, $entity->getNews());
    			$parent_id				= $entity->getNews()->getId();
    		}
    		if($entity->getContact1() instanceof \PiApp\GedmoBundle\Entity\Contact){
    			$entity_parent_table	= $this->getOwningTable($eventArgs, $entity->getContact1());
    			$parent_id				= $entity->getContact1()->getId();
    		}
    		if($entity->getContact2() instanceof \PiApp\GedmoBundle\Entity\Contact){
    			$entity_parent_table	= $this->getOwningTable($eventArgs, $entity->getContact2());
    			$parent_id				= $entity->getContact2()->getId();
    			$getMedia 				= "getMedia1";
    			$setMedia 				= "setMedia1";
    			$MediaId 				= "media1_id";
    		}    		
    		if($entity->getMenu() instanceof \PiApp\GedmoBundle\Entity\Menu){
    			$entity_parent_table	= $this->getOwningTable($eventArgs, $entity->getMenu());
    			$parent_id				= $entity->getMenu()->getId();
    		}  
    		if($entity->getSlider() instanceof \PiApp\GedmoBundle\Entity\Slider){
    			$entity_parent_table	= $this->getOwningTable($eventArgs, $entity->getSlider());
    			$parent_id				= $entity->getSlider()->getId();
    		}
    		if($entity->getBlock() instanceof \PiApp\GedmoBundle\Entity\Block){
    			$entity_parent_table	= $this->getOwningTable($eventArgs, $entity->getBlock());
    			$parent_id				= $entity->getBlock()->getId();
    		}
    		if($entity->getBlock2() instanceof \PiApp\GedmoBundle\Entity\Block){
    			$entity_parent_table	= $this->getOwningTable($eventArgs, $entity->getBlock2());
    			$parent_id				= $entity->getBlock2()->getId();
    			$getMedia 				= "getMedia1";
    			$setMedia 				= "setMedia1";
    			$MediaId 				= "media1_id";
    		}    		
    		if($entity->getOrganigram() instanceof \PiApp\GedmoBundle\Entity\Organigram){
    			$entity_parent_table	= $this->getOwningTable($eventArgs, $entity->getOrganigram());
    			$parent_id				= $entity->getOrganigram()->getId();
    		}  
    		if($entity->getEntitycategory() instanceof \PiApp\GedmoBundle\Entity\Category){
    			$entity_parent_table	= $this->getOwningTable($eventArgs, $entity->getEntitycategory());
    			$parent_id				= $entity->getEntitycategory()->getId();
    		}  
    		if($entity->getTeam() instanceof \PiApp\GedmoBundle\Entity\Team){
    			$entity_parent_table	= $this->getOwningTable($eventArgs, $entity->getTeam());
    			$parent_id				= $entity->getTeam()->getId();
    		}    		  		  		    		

    		try {
    			$query = "UPDATE $entity_parent_table mytable SET mytable.{$MediaId} = null WHERE mytable.id = ?";
    			$this->_connexion($eventArgs)->executeUpdate($query, array($parent_id));
    				
    			$this->_container()->get('sonata.media.provider.image')->preRemove($entity->getImage());
    			$this->_connexion($eventArgs)->delete($this->getOwningTable($eventArgs, $entity), array('id'=>$entity->getId()));
    			$this->_connexion($eventArgs)->delete($this->getOwningTable($eventArgs, $entity->getImage()), array('id'=>$entity->getImage()->getId()));
    			$this->_container()->get('sonata.media.provider.image')->postRemove($entity->getImage());	    			
    		} catch (\Exception $e) {
    		}
    	}    
    
    	for($i=0;$i<=6;$i++){
    		if($i==0) $i = "";
    		$getMedia = "getMedia{$i}";
    		$setMedia = "setMedia{$i}";
	    	if ( $this->isUsernamePasswordToken() && method_exists($entity, $getMedia) && method_exists($entity, $setMedia)
	    			&&
	    			(  ($entity->$getMedia() instanceof \PiApp\GedmoBundle\Entity\Media) )
	    	){
	    		if(($entity->$getMedia()->getImage() instanceof \BootStrap\MediaBundle\Entity\Media) && ($entity->$getMedia()->getImage()->getName() == "")){
	    			$entity->$setMedia(null);
	    		}
	    	}
    	}
    }
    
    /**
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $eventArgs
     *
     * @return void
     * @access private
     * @final
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    private function _PostMediaGedmo(EventArgs $eventArgs)
    {
    	$entity			= $eventArgs->getEntity();
    	$entityManager 	= $eventArgs->getEntityManager();
    
    	for($i=0;$i<=6;$i++){
    		if($i==0) $i = "";
    		$getMedia = "getMedia{$i}";
    		$setMedia = "setMedia{$i}";
    		if ( $this->isUsernamePasswordToken() && method_exists($entity, $getMedia) && method_exists($entity, $setMedia)
    				&&
    				(  ($entity->$getMedia() instanceof \PiApp\GedmoBundle\Entity\Media) )
    		){
    			$mediaId = null;
    			if(($entity->$getMedia()->getImage() instanceof \BootStrap\MediaBundle\Entity\Media) && !is_null($entity->$getMedia()->getImage()->getId())){
    				$mediaId = $entity->$getMedia()->getImage()->getId();
    			}
    
    			if(!is_null($mediaId)){
    				$entity_table	= $this->getOwningTable($eventArgs, $entity->$getMedia());
    				$query 			= "UPDATE $entity_table mytable SET mytable.mediaId = ? WHERE mytable.id = ?";
    				$result = $this->_connexion($eventArgs)->executeUpdate($query, array($mediaId, $entity->$getMedia()->getId()));
    			}
    		}
    	}
    }    
    
    /**
     * We are setting the default picture to all methods which are named like
     * getImage, getImage1, getImage2, getImage3, getImage4
     * and which are an instance of Media.
     *
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $eventArgs
     *
     * @return void
     * @access private
     * @final
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    private function _MediaSonata($eventArgs)
    {
    	$entity			= $eventArgs->getEntity();
    	$entityManager 	= $eventArgs->getEntityManager();
    	
    	for($i=0;$i<=6;$i++){
    		if($i==0) $i = "";
    		$getImage = "getImage{$i}";
    		$setImage = "setImage{$i}";
    		if ( $this->isUsernamePasswordToken() && method_exists($entity, $getImage) && ($entity->$getImage() instanceof \BootStrap\MediaBundle\Entity\Media) ){
    			$name = $entity->$getImage()->getName();
    			if(empty($name) && !($eventArgs instanceof PreUpdateEventArgs)){
    				$entity->$setImage($this->_DefaultMediaPixel($eventArgs));
    				
    				$this->_container()->get('sonata.media.provider.image')->preRemove($entity->$getImage());
    				try {
    					$this->_connexion($eventArgs)->delete($this->getOwningTable($eventArgs, $entity->$getImage()), array('id'=>$entity->$getImage()->getId()));
    				} catch (\Exception $e) {
    				}
    				$this->_container()->get('sonata.media.provider.image')->postRemove($entity->$getImage());
    			}
    		}
    	}
    
    	for($i=0;$i<=6;$i++){
    		if($i==0) $i = "";
    		$getFile  = "getFile{$i}";
    		$setFile  = "setFile{$i}";
    		if ( $this->isUsernamePasswordToken() && method_exists($entity, $getFile) && ($entity->$getFile() instanceof \BootStrap\MediaBundle\Entity\Media) ){
    			$name = $entity->$getImage()->getName();
    			if(empty($name) && !($eventArgs instanceof PreUpdateEventArgs)){
    				$entity->$setFile($this->_DefaultMediaPixel($eventArgs));

    				$this->_container()->get('sonata.media.provider.image')->preRemove($entity->$getImage());
    				try {
    					$this->_connexion($eventArgs)->delete($this->getOwningTable($eventArgs, $entity->$getImage()), array('id'=>$entity->$getImage()->getId()));
    				} catch (\Exception $e) {
    				}
    				$this->_container()->get('sonata.media.provider.image')->postRemove($entity->$getImage());
    			}
    		}
    	}
    	
    	// we clean the filename.
    	if ( $this->isUsernamePasswordToken() && ($entity instanceof \BootStrap\MediaBundle\Entity\Media) ){
    		$entity->setName($this->_cleanName($entity->getName()));
    	}  	
    }
    
    /**
     * We return the default media.
     *
     * @return boolean
     * @access private
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    private function _DefaultMediaPixel($eventArgs)
    {
    	$param_media_pixel	= $this->_container()->getParameter("pi_app_admin.page.media_pixel");
    	 
    	$is_file_exist = realpath($this->_container()->get('kernel')->getRootDir(). '/../web/bundles/piappadmin/images/pixel/'.$param_media_pixel);
    	if(!$is_file_exist)
    		throw ExtensionException::FileUnDefined('img', __CLASS__);
    
    	$media_pixel = new \BootStrap\MediaBundle\Entity\Media();
    	$media_pixel->setProviderName('sonata.media.provider.image');
    	$media_pixel->setContext("default");
    	$media_pixel->setBinaryContent($is_file_exist);
    
    	$this->_container()->get('sonata.media.provider.image')->transform($media_pixel);
    	$this->_container()->get('sonata.media.provider.image')->prePersist($media_pixel);
    
    	// we add the entity to be persisted.
    	$this->_addPersistEntities($media_pixel);
    	$this->_persistEntities($eventArgs);
    
    	$media_pixel_new  = $this->_container()->get('doctrine')->getEntityManager()->getRepository('BootStrapMediaBundle:Media')->findOneBy(array('name'=>$param_media_pixel));
    	$media_pixel->setId($media_pixel_new->getId());
    
    	$this->_container()->get('sonata.media.provider.image')->postPersist($media_pixel);
    
    	return $media_pixel;
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