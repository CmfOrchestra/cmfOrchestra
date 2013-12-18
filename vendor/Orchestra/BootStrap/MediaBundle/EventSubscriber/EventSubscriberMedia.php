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
        $this->_cropImage($eventArgs);
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
        $entity            = $eventArgs->getEntity();
        $entityManager     = $eventArgs->getEntityManager();
        
        if ( $this->isUsernamePasswordToken() 
        		&& ( ($entity instanceof \Proxies\__CG__\PiApp\GedmoBundle\Entity\Media) || ($entity instanceof \PiApp\GedmoBundle\Entity\Media) ) 
        		&& !$this->isRestrictionByRole($entity) 
        		&& ($entity->getMediadelete() == true) )
        {
            try {
                $entity_table = $this->getOwningTable($eventArgs, $entity);
                $query = "UPDATE $entity_table mytable SET mytable.media = null WHERE mytable.id = ?";
                $this->_connexion($eventArgs)->executeUpdate($query, array($entity->getId()));
                
                $this->_container()->get('bootstrap.media.provider.image')->preRemove($entity->getImage());
                $this->_connexion($eventArgs)->delete($this->getOwningTable($eventArgs, $entity->getImage()), array('id'=>$entity->getImage()->getId()));
                $this->_container()->get('bootstrap.media.provider.image')->postRemove($entity->getImage());                
            } catch (\Exception $e) {
            }
            $entity->setImage(null);
        } 
        // we clean the filename.
        if ( $this->isUsernamePasswordToken() 
        		&& ( ($entity instanceof \Proxies\__CG__\PiApp\GedmoBundle\Entity\Media) || ($entity instanceof \PiApp\GedmoBundle\Entity\Media) ) 
        ){
        	if ( $entity->getImage() instanceof \BootSTrap\MediaBundle\Entity\Media) {
            	$entity->getImage()->setName($this->_cleanName($entity->getImage()->getName()));
        	}
        }        
    }

    /**
     * We return the clean of a string.
     *
     * @param    string    $string
     * @return     string    name
     * @access private
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    private function _cleanName($string)
    {
        $string = \PiApp\AdminBundle\Util\PiStringManager::minusculesSansAccents($string);
        $string = \PiApp\AdminBundle\Util\PiStringManager::cleanFilename($string);
         
        return $string;
    }   

    /**
     * We link the entity widget type to the page.
     *
     * @param $eventArgs
     *
     * @return void
     * @access protected
     * @final
     *
     * @author (c) <Adel Oustad> <a.oustad@gmail.com>
     */
    private function _cropImage($eventArgs) 
    {
    	if ($this->_container()->isScopeActive('request') && isset($_SERVER['REQUEST_URI']) && !empty($_SERVER['REQUEST_URI'])) {
	    	$entityManager = $eventArgs->getEntityManager();
	    	$tab_post = $this->_container()->get('request')->request->all();
	    	if (!empty($tab_post['img_crop']) && $tab_post['img_crop'] == '1') {
	    		$entity = $eventArgs->getEntity();
	    		$getMedia = "getMedia";
	    		$setMedia = "setMedia";
	    		if ($this->isUsernamePasswordToken() && method_exists($entity, $getMedia) && method_exists($entity, $setMedia)&& ( ($entity->$getMedia() instanceof \PiApp\GedmoBundle\Entity\Media) ) ) {
	    			$mediaPath = $this->_container()->get('sonata.media.twig.extension')->path($entity->$getMedia()->getImage()->getId(), 'reference');
	    			$src = $this->_container()->get('kernel')->getRootDir() . '/../web/' . $mediaPath;
	    			if (file_exists($src)) {
	    				$extension =  pathinfo($src, PATHINFO_EXTENSION);
	    				$mediaCrop = $this->_container()->get('sonata.media.twig.extension')->path($entity->$getMedia()->getImage()->getId(), $tab_post['img_name']);
	    				$targ_w = $tab_post['img_width']; //$globals['tailleWidthEdito1'];
	    				$targ_h = $tab_post['img_height'];
	    				$jpeg_quality = $tab_post['img_quality'];
	    				switch ($extension) {
	    					case 'jpg':
	    						$img_r = imagecreatefromjpeg($src);
	    						break;
	    					case 'jpeg':
	    						$img_r = imagecreatefromjpeg($src);
	    						break;
	    					case 'gif':
	    						$img_r = imagecreatefromgif($src);
	    						break;
	    					case 'png':
	    						$img_r = imagecreatefrompng($src);
	    						break;
	    					default:
	    						echo "L'image n'est pas dans un format reconnu. Extensions autorisÃ©es : jpg, jpeg, gif, png";
	    						break;
	    				}
	    
	    				$dst_r = imagecreatetruecolor($targ_w, $targ_h);
	    				imagecopyresampled($dst_r, $img_r, 0, 0, $tab_post['x'], $tab_post['y'], $targ_w, $targ_h, $tab_post['w'], $tab_post['h']);
	    				switch ($extension) {
	    					case 'jpg':
	    						imagejpeg($dst_r, $this->_container()->get('kernel')->getRootDir() . '/../web/' . $mediaCrop, $jpeg_quality);
	    						break;
	    					case 'jpeg':
	    						imagejpeg($dst_r, $this->_container()->get('kernel')->getRootDir() . '/../web/' . $mediaCrop, $jpeg_quality);
	    						break;
	    					case 'gif':
	    						imagegif($dst_r, $this->_container()->get('kernel')->getRootDir() . '/../web/' . $mediaCrop);
	    						break;
	    					case 'png':
	    						imagepng($dst_r, $this->_container()->get('kernel')->getRootDir() . '/../web/' . $mediaCrop);
	    						break;
	    					default:
	    						echo "L'image n'est pas dans un format reconnu. Extensions autorisÃ©es : jpg, gif, png";
	    						break;
	    				}
	    				@chmod($this->_container()->get('kernel')->getRootDir() . '/../web/' . $mediaCrop, 0777);
	    			}
	    		}
	    	}elseif(!empty($tab_post['img_crop']) && $tab_post['img_crop'] > '1'){
	    		if ($this->isUsernamePasswordToken() ) {
                    foreach($tab_post['img_crop'] as $media_id => $value){
                        $mediaPath = $this->_container()->get('sonata.media.twig.extension')->path($media_id, 'reference');
                        $src = $this->_container()->get('kernel')->getRootDir() . '/../web/' . $mediaPath;
                        if (file_exists($src)) {
                            $extension =  pathinfo($src, PATHINFO_EXTENSION);
                            $mediaCrop = $this->_container()->get('sonata.media.twig.extension')->path($media_id, $tab_post['img_name_'.$media_id]);
                            $targ_w = $tab_post['img_width_'.$media_id]; //$globals['tailleWidthEdito1'];
                            $targ_h = $tab_post['img_height_'.$media_id];
                            $jpeg_quality = $tab_post['img_quality_'.$media_id];
                            switch ($extension) {
                                case 'jpg':
                                    $img_r = imagecreatefromjpeg($src);
                                    break;
                                case 'jpeg':
                                    $img_r = imagecreatefromjpeg($src);
                                    break;
                                case 'gif':
                                    $img_r = imagecreatefromgif($src);
                                    break;
                                case 'png':
                                    $img_r = imagecreatefrompng($src);
                                    break;
                                default:
                                    echo "L'image n'est pas dans un format reconnu. Extensions autorisÃ©es : jpg, jpeg, gif, png";
                                    break;
                            }

                            $dst_r = imagecreatetruecolor($targ_w, $targ_h);
                            imagecopyresampled($dst_r, $img_r, 0, 0, $tab_post['x_'.$media_id], $tab_post['y_'.$media_id], $targ_w, $targ_h, $tab_post['w_'.$media_id], $tab_post['h_'.$media_id]);
                            switch ($extension) {
                                case 'jpg':
                                    imagejpeg($dst_r, $this->_container()->get('kernel')->getRootDir() . '/../web/' . $mediaCrop, $jpeg_quality);
                                    break;
                                case 'jpeg':
                                    imagejpeg($dst_r, $this->_container()->get('kernel')->getRootDir() . '/../web/' . $mediaCrop, $jpeg_quality);
                                    break;
                                case 'gif':
                                    imagegif($dst_r, $this->_container()->get('kernel')->getRootDir() . '/../web/' . $mediaCrop);
                                    break;
                                case 'png':
                                    imagepng($dst_r, $this->_container()->get('kernel')->getRootDir() . '/../web/' . $mediaCrop);
                                    break;
                                default:
                                    echo "L'image n'est pas dans un format reconnu. Extensions autorisÃ©es : jpg, gif, png";
                                    break;
                            }
                            @chmod($this->_container()->get('kernel')->getRootDir() . '/../web/' . $mediaCrop, 0777);
                        }                    

                    }                    
	    			
	    		}
	    	            
            }
    	}
    }
}