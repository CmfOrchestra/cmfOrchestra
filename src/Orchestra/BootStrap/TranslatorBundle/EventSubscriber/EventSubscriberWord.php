<?php
/**
 * This file is part of the <Translator> project.
 *
 * @category   Translator_EventSubscriber
 * @package    EventSubscriber
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-11-14
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\TranslatorBundle\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\EventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;

use BootStrap\UserBundle\EventListener\abstractListener;

/**
 * Word entity Subscriber.
 *
 * @category   Translator_EventSubscriber
 * @package    EventSubscriber
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class EventSubscriberWord  extends abstractListener implements EventSubscriber
{
    /**
     * @return array
     * 
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
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
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
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
     * @author (c) <riad hellal> <r.helal@novediagroup.com>
     */
    public function postUpdate(EventArgs $eventArgs)
    {
    	$entity			= $eventArgs->getEntity();
    	$entityManager 	= $eventArgs->getEntityManager();
    	
    	if ( $this->isUsernamePasswordToken() && ($entity instanceof \BootStrap\TranslatorBundle\Entity\Word) ){
    		$this->_wordsTranslation($eventArgs);
    	}
    }
    
    /**
     * @param \Doctrine\Common\EventArgs $args
     * @return void
     * 
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function postRemove(EventArgs $eventArgs)
    {
    }
    
    /**
     * @param \Doctrine\Common\EventArgs $args
     * @return void
     * 
     * @author (c) <riad hellal> <r.helal@novediagroup.com>
     */
    public function postPersist(EventArgs $eventArgs)
    {
        $entity			= $eventArgs->getEntity();
    	$entityManager 	= $eventArgs->getEntityManager();
    	
    	if ( $this->isUsernamePasswordToken() && ($entity instanceof \BootStrap\TranslatorBundle\Entity\Word) ){
    		$this->_wordsTranslation($eventArgs);
    	}
    }
    
    /**
     * @param \Doctrine\Common\EventArgs $args
     * @return void
     * 
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function preUpdate(PreUpdateEventArgs $eventArgs)
    {
    }
    
    /**
     * @param \Doctrine\Common\EventArgs $args
     * @return void
     * 
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function preRemove(EventArgs $eventArgs)
    {
    }
    
    /**
     * @param \Doctrine\Common\EventArgs $args
     * @return void
     * 
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function prePersist(EventArgs $eventArgs)
    {
    }    
    
    /**
     * Sets the specific sortOrders.
     *
     * @param EventArgs		$eventArgs
     * @access private
     * @return array
     *
     * @author (c) <riad hellal> <r.helal@novediagroup.com>
     */    
    private function _wordsTranslation($eventArgs)
    {
    	$entity			= $eventArgs->getEntity();
    	$entityManager 	= $eventArgs->getEntityManager();
    	
    	$locale 		= $this->_container()->get('session')->getLocale();
    	$basePath 		= $this->_container()->getParameter("kernel.cache_dir"). '/../translation/';
    	$dir 			= \PiApp\AdminBundle\Util\PiFileManager::mkdirr($basePath);
    	$all_files 		= \PiApp\AdminBundle\Util\PiFileManager::getFilesByType($basePath, "yml");
    	$languages 		= $entityManager->getRepository("PiAppAdminBundle:Langue")->findAllByEntity($locale, 'object', false);
    	
    	$array = array();    	
    	foreach($languages as $language){
    		$filename 	= $basePath."messages.".$language->getId().".yml";
    		$Words 		= $entityManager->getRepository("BootStrapTranslatorBundle:Word")->findAllByEntity($language->getId(), 'object', false);
    		foreach ($Words as $word){
    			$array["{$word->getKeyword()}"] = $word->translate($language->getId())->getLabel()? $word->translate($language->getId())->getLabel():' ';
    		}
    		$yaml = \Symfony\Component\Yaml\Yaml::dump($array, 2);
    		file_put_contents($filename, $yaml);
    	}
    	
    	//$this->_executeClearCache();
    }
    
    
    /**
     * Execute the clear cache command
     *
     * @return string		status of the executed command
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-11-14
     */
    private function _executeClearCache()
    {
    	return exec(sprintf('php app/console cache:clear'));
    }    
    
}
