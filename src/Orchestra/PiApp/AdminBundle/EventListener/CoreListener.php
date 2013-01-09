<?php
/**
 * This file is part of the <User> project.
 *
 * @category   BootStrap_Eventlistener
 * @package    EventListener
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2011-01-30
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\Common\Cache\ArrayCache;
use Symfony\Component\DependencyInjection\ContainerInterface;

use BootStrap\UserBundle\EventListener\abstractListener;
use BootStrap\MediaBundle\Entity\Media;
use PiApp\AdminBundle\Exception\ExtensionException;
use PiApp\AdminBundle\Entity\Block;
use PiApp\AdminBundle\Entity\TranslationPage;
use PiApp\AdminBundle\Entity\HistoricalStatus;
use PiApp\AdminBundle\Repository\PageRepository;

use PiApp\AdminBundle\Manager\PiSearchLuceneManager;
use PiApp\AdminBundle\Manager\SearchLucene\Indexation;

/**
 * abstract listener manager.
 * This event is called after an entity is constructed by the EntityManager.
 *
 * @category   BootStrap_Eventlistener
 * @package    EventListener
 * @abstract
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
abstract class CoreListener extends abstractListener
{
	/**
	 * We create the cached file of Roles.
	 *
	 * @param \Doctrine\ORM\Event\LifecycleEventArgs $eventArgs
	 *
	 * @return void
	 * @access protected
	 * @final
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */	
	final protected function _Heritage_roles(LifecycleEventArgs $eventArgs){
		$entity 		= $eventArgs->getEntity();
		$entityManager 	= $eventArgs->getEntityManager();
		
		// If  autentication user, we set the persist of the Page entity
		if($this->isUsernamePasswordToken() && ($entity instanceof \BootStrap\UserBundle\Entity\Role)){
			// we register the hierarchy roles in the heritage.jon file in the cache
			$roles 		= $entityManager->getRepository('BootStrapUserBundle:role')->getAllHeritageRoles();
			$roles_json	= json_encode(array('HERITAGE_ROLES'=>$roles));
			
			// we set the heritage.jon file
			$path_heritages_file = realpath($this->_container()->getParameter("kernel.root_dir") . "/cache/heritage.json");
			if($path_heritages_file)
				$result	 = file_put_contents($path_heritages_file, $roles_json);
			else 
				$result	 = file_put_contents($this->_container()->getParameter("kernel.root_dir") . "/cache/heritage.json", $roles_json);
			
			if($result)
				$this->setFlash('pi.session.flash.rolecache.created');
			
			$path_files[] = realpath($this->_container()->getParameter("kernel.root_dir") . "/cache/dev/appDevDebugProjectContainer.php");
			$path_files[] = realpath($this->_container()->getParameter("kernel.root_dir") . "/cache/dev/appDevDebugProjectContainer.php.meta");
			$path_files[] = realpath($this->_container()->getParameter("kernel.root_dir") . "/cache/dev/appDevDebugProjectContainer.xml");
			$path_files[] = realpath($this->_container()->getParameter("kernel.root_dir") . "/cache/dev/appDevDebugProjectContainerCompiler.log");
			$path_files[] = realpath($this->_container()->getParameter("kernel.root_dir") . "/cache/prod/appProdProjectContainer.php");
			$path_files = array_unique($path_files);
			
			foreach($path_files as $key=>$file){
				if(!empty($file))
					unlink($file);
			}			
		}
	}	
	
	/**
	 * We remove twig cached file of Page, Widget and translationWidget template.
	 *
	 * @param \Doctrine\ORM\Event\LifecycleEventArgs $eventArgs
	 *
	 * @return void
	 * @access protected
	 * @final
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	final protected function _TwigCache($eventArgs)
	{
		$entity		= $eventArgs->getEntity();
		
		if($this->isUsernamePasswordToken() && 
			(
				$entity instanceof \PiApp\AdminBundle\Entity\Page ||
				$entity instanceof \PiApp\AdminBundle\Entity\Widget ||
				$entity instanceof \PiApp\AdminBundle\Entity\TranslationWidget
			)
		){
			$all_lang	= $this->getRepository('Langue')->findByEnabled(true);
			$names		= $this->_recursive($eventArgs, $entity, $all_lang);
		
// 	 		if($names && is_array($names)){
// 	 			krsort($names);
// 	 			print_r($names);
// 	 		}
// 			exit;
		}
	}	
	
	/**
	 * We find all template names of a page and these nodes.
	 *
	 * @param \Doctrine\ORM\Event\LifecycleEventArgs $eventArgs
	 *
	 * @return void
	 * @access private
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */	
	private function _recursive($eventArgs, $entity, $all_lang)
	{
		// we set the persist of the Page entity
		if($entity instanceof \PiApp\AdminBundle\Entity\Page){
			$type = 'page:';
		}elseif($entity instanceof \PiApp\AdminBundle\Entity\Widget){
			$type = 'widget:';
		}elseif($entity instanceof \PiApp\AdminBundle\Entity\TranslationWidget){
			$type = 'transwidget:';
		}else
			return false;
				
		$names = array();
		foreach($all_lang as $key => $lang){
			
			if (!method_exists($entity, 'getLayout') || ($entity->getLayout() instanceof \PiApp\AdminBundle\Entity\Layout) ) {
				// we create the cache name
				$name 			= $type.$entity->getId().':'.$lang->getId();
				$names[$name] 	= $name;
				
				// we refresh the cache
				$this->_container()->get('pi_app_admin.manager.page')->cacheRefreshByname($name);
				
				// we refresh the cache of all widgets of the page
				if( ($entity instanceof \PiApp\AdminBundle\Entity\Page) && (!is_null($entity->getId())) ){
					$this->_container()->get('pi_app_admin.manager.page')->setPageByRoute($entity->getRouteName());
					$this->_container()->get('pi_app_admin.manager.page')->cacheRefresh();
				}
				
				if($entity instanceof \PiApp\AdminBundle\Entity\Widget){
					
					// we have to warm up all translations which are linked to it.
					if(!$entity->getTranslations()->isEmpty()){
						foreach($entity->getTranslations()->toArray() as $key => $translationWidget){
							if($translationWidget->getLangCode()->getId() == $lang->getId()){
								$name_trans			= 'transwidget:'.$translationWidget->getId().':'.$lang->getId();
								$names[$name_trans] = $name_trans;
								
								// we refresh the cache
								$this->_container()->get('pi_app_admin.manager.page')->cacheRefreshByname($name_trans);
							}
						}
					}
					
					if( ($entity->getPlugin() == "gedmo") && ($entity->getAction() == "snippet") ){
						// we get all widgets which use the gedmo snippet
						$all_widget_used_snippet = $this->getRepository('Widget')->getWidgetByOptions('gedmo', 'snippet', '<id>'.$entity->getId().'</id>')->getQuery()->getResult();
						
						if( is_array($all_widget_used_snippet) ){
							foreach($all_widget_used_snippet as $k => $widget){
								// if the entity is linked to a page
								if($widget->getBlock() instanceof \PiApp\AdminBundle\Entity\Block){
									$names = array_merge($names, $this->_recursive($eventArgs, $widget->getBlock()->getPage(), $all_lang));
								}
							}
						}					
					}
					
					// if the entity is linked to a page
					if($entity->getBlock() instanceof \PiApp\AdminBundle\Entity\Block){
						$names = array_merge($names, $this->_recursive($eventArgs, $entity->getBlock()->getPage(), $all_lang));
					}
				}
				
				// if the entity is a translation, we have to warm up the widget which is linked to it.
				if($entity instanceof \PiApp\AdminBundle\Entity\TranslationWidget
						&& ($entity->getWidget() instanceof \PiApp\AdminBundle\Entity\Widget)){
						
						// if the widget of the TranslationWidget is a snippet,
						// and if the language of the TranslationWidget has been changed or not,
						// we have to warm up all pages which are used by the snippet 
						if(!($entity->getWidget()->getBlock() instanceof \PiApp\AdminBundle\Entity\Block) ){							
							// We check the permission in config.
							$is_refresh_authorized = $this->_container()->getParameter('pi_app_admin.page.refresh_allpage_containing_snippet');
							if($is_refresh_authorized){
								// we get all widgets which use the content snippet 
								$all_widget_used_snippet = $this->getRepository('Widget')->getWidgetByOptions('content', 'snippet', '<id>'.$entity->getWidget()->getId().'</id>')->getQuery()->getResult();
								
								if( is_array($all_widget_used_snippet) ){
									foreach($all_widget_used_snippet as $k => $widget){
										// if the entity is linked to a page
										if($widget->getBlock() instanceof \PiApp\AdminBundle\Entity\Block){
											$names = array_merge($names, $this->_recursive($eventArgs, $widget->getBlock()->getPage(), $all_lang));
										}									
									}
								}
							}
							
						}else
							$names = array_merge($names, $this->_recursive($eventArgs, $entity->getWidget(), $all_lang));						
				}
				
			}
			
		}
		return $names;		
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
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	final protected function _widgetListener($eventArgs)
	{
		$entity 		= $eventArgs->getEntity();
		$entityManager 	= $eventArgs->getEntityManager();
		
		if( $entity instanceof \PiApp\AdminBundle\Entity\Widget ){
			// If  autentication user
			if ($this->isUsernamePasswordToken()) {
				$plugin		= strtolower($entity->getPlugin());
				$action		= strtolower($entity->getAction());
				$xmlConfig	= $entity->getConfigXml();
				
				if( ($plugin == "gedmo") && ($action == "listener") ){
					// if the configXml field of the widget isn't configured correctly.
					try {
						$xmlConfig	= new \Zend_Config_Xml($xmlConfig);
					} catch (\Exception $e) {
						return null;
					}

					try {
						$controller		= $xmlConfig->widgets->gedmo->controller;
						$params			= $xmlConfig->widgets->gedmo->params->toArray();
						$id   			= $params["id"];
					} catch (\Exception $e) {
						return null;
					}
					
					try {
						$values 			= explode(':', $controller);
						$entity_widget_name = str_replace('\\\\', '\\', strtolower($values[1]));
						$method_widget_name	= strtolower($values[2]);
						
						$entity_widget 			= $this->_container()->get('pi_app_gedmo.repository')->getRepository($entity_widget_name)->find($id);
						//$entity_widget_table	= $this->_container()->get('pi_app_gedmo.repository')->getRepository($entity_widget_name)->getClassName();
						$entity_widget_table	= $this->getOwningTable($eventArgs, $entity_widget);
						
						if( is_object($entity_widget) 
							&& method_exists($entity_widget, 'getPage') 
							&& method_exists($entity_widget, 'setPage')
							//&& !($entity_widget->getPage() instanceof \PiApp\AdminBundle\Entity\Page)
							&& ($entity->getBlock() instanceof \PiApp\AdminBundle\Entity\Block)
							&& ($entity->getBlock()->getPage() instanceof \PiApp\AdminBundle\Entity\Page) ){
								
								$page_id	= $entity->getBlock()->getPage()->getId();
								try {
									$query = "UPDATE $entity_widget_table mytable SET mytable.page_id ='$page_id' WHERE mytable.id = ?";
									$this->_connexion($eventArgs)->executeUpdate($query, array($id));
									
									//$table 		= $this->_container()->get('pi_app_gedmo.repository')->getRepository(get_class($entity))->getClassName();
									//$query = "UPDATE $table mytable SET mytable.page_id='$page_id' WHERE mytable.id = ?";
									//$this->_container()->get('pi_app_gedmo.repository')->getRepository(get_class($entity))
									//->getEntityManager()->createQuery($query)->getSingleScalarResult();
								} catch (\Exception $e) {
									return null;
								}
						}
					} catch (\Exception $e) {
						return null;
					}

				}
			}
		}
	}	
	
    /**
     * We create the xml content about all layout block information.
     *
     * @param $eventArgs
     * 
     * @return void
     * @access protected
     * @final
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    final protected function _Layout($eventArgs)
    {
    	$entity 		= $eventArgs->getEntity();
    	$entityManager 	= $eventArgs->getEntityManager();
    
    	// we set the persist of the Page entity
    	if($entity instanceof \PiApp\AdminBundle\Entity\Layout){
    		// If  autentication user
    		if ($this->isUsernamePasswordToken()) {
    				$init_pc_layout		= str_replace("\\", "/", $entity->getFilePc());
    				$init_mobile_layout	= str_replace("\\", "/", $entity->getFileMobile());
    				$root_url			= $this->_container()->get('kernel')->getBundle('PiAppTemplateBundle')->getPath() . '/Resources/views/Template/Layout';
    
    				if(empty($init_pc_layout))
    					$init_pc_layout 	= $this->_container()->getParameter('pi_app_admin.layout.init.pc.template');
    				if(empty($init_mobile_layout))
    					$init_mobile_layout = $this->_container()->getParameter('pi_app_admin.layout.init.mobile.template');
    
    				$path_pc_layout		= realpath($root_url . '/Pc/' . $init_pc_layout);
    				$path_mobile_layout	= realpath($root_url . '/Mobile/' . $init_mobile_layout . '/' . 'modele.html.twig');
    				
    				//print_r($root_url . '/Pc/' . $init_pc_layout);exit;
    				
    				// if the both path layout exist.
    				if(!empty($path_pc_layout) && !empty($path_mobile_layout)){
    					$content_file_pc 		= $this->_container()->get('pi_app_admin.file_manager')->getFileContent($path_pc_layout);
    					$content_file_mobile 	= $this->_container()->get('pi_app_admin.file_manager')->getFileContent($path_mobile_layout);
    
    					// Gets the different blocks from Twig layout
    					if (preg_match_all('#{% block (?P<block_name>(.*)) %}#sU', $content_file_pc, $matches_pc)
    						&&
    						preg_match_all('#{% block (?P<block_name>(.*)) %}#sU', $content_file_mobile, $matches_mobile))
    					{
    						$tabs = array_unique(array_merge($matches_pc['block_name'], $matches_mobile['block_name']));
    					} else {
    						$tabs = array();
    					}
    					
    					$tabs = $this->_container()->get('pi_app_admin.array_manager')->TrimArray($tabs);
    					
    					// we get the list of all global blocks.
    					$pageManager  	= $this->_container()->get('pi_app_admin.manager.page');
    					$unset_values	= $pageManager::$global_blocks;
    					
    					// we create the xml content about all layout block information.
    					$source_xml  = "<?xml version=\"1.0\"?>\n";
    					$source_xml .= "<config>\n";
    					$source_xml .= "	<blocks>\n";
    					foreach($tabs as $key=>$block_name){
    						if(!in_array($block_name, $unset_values))
    							$source_xml .= "		<name>$block_name</name>\n";
    					}
    					$source_xml .= "	</blocks>\n";
    					$source_xml .= "</config>\n";
    					
    					// we insert the config_xml value.
    					$entity->setConfigXml($source_xml);
    					
    				}else
    					$this->setFlash('pi.session.flash.layout.notexist', 'warning');
    		}
    	}
    }
    
    /**
     * We try to update the route name of the home page.
     *
     * @param \Doctrine\ORM\Event\PreUpdateEventArgs $eventArgs
     *
     * @return void
     * @access protected
     * @final
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    final protected function _NoUpdate_RouteName_HomePage(PreUpdateEventArgs $eventArgs)
    {
    	$entity_page	= $eventArgs->getEntity();
    	$entityManager 	= $eventArgs->getEntityManager();
    
    	// we set the persist of the Page entity
    	if($entity_page instanceof \PiApp\AdminBundle\Entity\Page){
    		$isflash = false;
    		if($eventArgs->hasChangedField('route_name') && ($eventArgs->getOldValue('route_name') == 'home_page') ){
    			$eventArgs->setNewValue('route_name', 'home_page');
    
    			if($eventArgs->hasChangedField('enabled')){
    				$eventArgs->setNewValue('enabled', '1');
    			}
    
    			if($eventArgs->hasChangedField('meta_content_type')){
    				$eventArgs->setNewValue('meta_content_type', PageRepository::TYPE_TEXT_HTML);
    			}
    
    			$isflash = true;
    		}
    
    		if($isflash)
    			$this->setFlash('pi.session.flash.right.homepage.notchange', 'warning');
    	}
    }
    
    /**
     * we delete the home page
     * or a translation of this one,
     * or a block of this one,
     * or a widget of this one.
     *
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $eventArgs
     *
     * @return void
     * @access protected
     * @final
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    final protected function _Undelete_HomePage(LifecycleEventArgs $eventArgs)
    {
    	$entity			= $eventArgs->getEntity();
    	$entityManager 	= $eventArgs->getEntityManager();
    
    	if( ($entity instanceof \PiApp\AdminBundle\Entity\Page)
    			&& ($entity->getRouteName() == 'home_page' )){
    		$entityManager->getUnitOfWork()->detach($entity);
    		$this->setFlash('pi.session.flash.right.homepage.undelete');
    	}
    
    	if( ($entity instanceof \PiApp\AdminBundle\Entity\TranslationPage)
    			&& ($entity->getPage()->getRouteName() == 'home_page' ) ){
    		$entityManager->getUnitOfWork()->detach($entity);
    		$this->setFlash('pi.session.flash.right.homepage.undelete');
    	}
    
    	if( ($entity instanceof \PiApp\AdminBundle\Entity\Block)
    			&& ($entity->getPage() instanceof \PiApp\AdminBundle\Entity\Page)
    			&& ($entity->getPage()->getRouteName() == 'home_page' )){
    		$entityManager->getUnitOfWork()->detach($entity);
    		$this->setFlash('pi.session.flash.right.homepage.undelete');
    	}
    
    	$is_permission_delete_widget_homepage = $this->_container()->getParameter('pi_app_admin.page.homepage_deletewidget');
    
    	// if we want to undelete all widgets of the home page
    	if( !$is_permission_delete_widget_homepage
    			&& ($entity instanceof \PiApp\AdminBundle\Entity\Widget)
    			&& ($entity->getBlock() instanceof \PiApp\AdminBundle\Entity\Block)
    			&& ($entity->getBlock()->getPage() instanceof \PiApp\AdminBundle\Entity\Page)
    			&& ($entity->getBlock()->getPage()->getRouteName() == 'home_page' )){
    		$entityManager->getUnitOfWork()->detach($entity);
    		$this->setFlash('pi.session.flash.right.homepage.undelete');
    	}
    }    
    
    /**
     * We delete all caches of the page and the row in relation with the pi_routing table.
     *
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $eventArgs
     *
     * @return void
     * @access protected
     * @final
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    final protected function _Delete_Permission_Page_ByUser(LifecycleEventArgs $eventArgs){
    	$entity 		= $eventArgs->getEntity();
    	$entityManager 	= $eventArgs->getEntityManager();
    
   		// If  autentication user and the user has the permission to delete a page
   		if( $this->isUsernamePasswordToken() && (in_array('DELETE', $this->getUserPermissions()) || in_array('ROLE_SUPER_ADMIN', $this->getUserRoles())) ) {
   			
   			$no_permission  = $this->_permission_management_Page_ByUser($eventArgs);
   			
   			if($no_permission){
   				$entityManager->getUnitOfWork()->detach($entity);    			
   				$this->setFlash('pi.session.flash.right.page.management_by_user_only', 'only');
   			}else{	
   				if($entity instanceof \PiApp\AdminBundle\Entity\Page){    			
	    			// if we try to delete a page other than the home page.
	    			if($entity->getRouteName() != 'home_page' ){
	    				// we delete the row in relation with the pi_routing table
	    				$query 	= "SELECT id FROM pi_routing WHERE route = ?";
	    				$id 	= $this->_connexion($eventArgs)->fetchColumn($query, array($entity->getRouteName()));
	    				$this->_connexion($eventArgs)->delete('pi_routing', array('id'=>$id));
	    
	    				// we delete all caches of the page
	    				$all_lang	= $this->getRepository('Langue')->findByEnabled(true);
	    				foreach($all_lang as $key => $lang){
	    					$name 	= "page:" .$entity->getId() . ':' . $lang->getId();
	    					try {
	    						$this->_container()->get('pi_app_admin.caching')->invalidate($name);
	    					} catch (\Exception $e) {
	    					}
	    				}
	    			}
   				}
   			}
   
   		}
    }        
    
    /**
     * we detach the permission of update a page.
     *
     * @param \Doctrine\ORM\Event\PreUpdateEventArgs $eventArgs
     *
     * @return void
     * @access protected
     * @final
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    final protected function _Update_Permission_Page_ByUser($eventArgs)
    {
    	$entity			= $eventArgs->getEntity();
    	$entityManager 	= $eventArgs->getEntityManager();    	
    	$no_permission  = $this->_permission_management_Page_ByUser($eventArgs);
    	
    	if($no_permission){
    		$class = $entityManager->getClassMetadata(get_class($entity));
    		$entityManager->getUnitOfWork()->computeChangeSet($class, $entity);
    	
    		$this->setFlash('pi.session.flash.right.page.management_by_user_only', 'only');
    	}
    }
    
    /**
     * we detach the permission of update a page.
     *
     * @param \Doctrine\ORM\Event\PreUpdateEventArgs $eventArgs
     *
     * @return void
     * @access protected
     * @final
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    final protected function _Persist_Permission_Page_ByUser($eventArgs)
    {
    	$entity			= $eventArgs->getEntity();
    	$entityManager 	= $eventArgs->getEntityManager();    	
   		$no_permission  = $this->_permission_management_Page_ByUser($eventArgs);
    
    	if($no_permission){
    		$entityManager->getUnitOfWork()->scheduleOrphanRemoval($entity);
    		$this->setFlash('pi.session.flash.right.page.management_by_user_only', 'only');
    	}
    }    

    /**
     * we detach the permission of a page.
     *
     * @param \Doctrine\ORM\Event\PreUpdateEventArgs $eventArgs
     *
     * @return void
     * @access protected
     * @final
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    private function _permission_management_Page_ByUser($eventArgs)
    {
        $entity			= $eventArgs->getEntity();
    	$entityManager 	= $eventArgs->getEntityManager();
    	
    	$is_permission_management_page_by_user_only = $this->_container()->getParameter('pi_app_admin.page.management_by_user_only');
    	
    	if ($this->isUsernamePasswordToken()) {
	    	switch (true) {
		    	case ( ($entity instanceof \PiApp\AdminBundle\Entity\Page)
		    			&& !(in_array('ROLE_ADMIN', $this->getUserRoles()) || in_array('ROLE_SUPER_ADMIN', $this->getUserRoles()) || in_array('ROLE_CONTENT_MANAGER', $this->getUserRoles()))
		    			&& $is_permission_management_page_by_user_only
		    			&& ($entity->getUser() instanceof \BootStrap\UserBundle\Entity\User)
		    			&& ($entity->getUser()->getId() != $this->getToken()->getUser()->getId() )) :
		    		
			    		$entity->setUpdatedAt(new \DateTime());
		    			$no_permission = true;
		    			break;
		    	case ( ($entity instanceof \PiApp\AdminBundle\Entity\TranslationPage)
		    			&& !(in_array('ROLE_ADMIN', $this->getUserRoles()) || in_array('ROLE_SUPER_ADMIN', $this->getUserRoles()) || in_array('ROLE_CONTENT_MANAGER', $this->getUserRoles()))
		    			&& $is_permission_management_page_by_user_only
		    			&& ($entity->getPage()->getUser() instanceof \BootStrap\UserBundle\Entity\User)
		    			&& ($entity->getPage()->getUser()->getId() != $this->getToken()->getUser()->getId() )) :
		    	
		    			$entity->setUpdatedAt(new \DateTime());
		    			$no_permission = true;
		    			break;
		    	case ( ($entity instanceof \PiApp\AdminBundle\Entity\Block)
		    			&& !(in_array('ROLE_ADMIN', $this->getUserRoles()) || in_array('ROLE_SUPER_ADMIN', $this->getUserRoles()) || in_array('ROLE_CONTENT_MANAGER', $this->getUserRoles()))
		    			&& $is_permission_management_page_by_user_only
		    			&& ($entity->getPage()->getUser() instanceof \BootStrap\UserBundle\Entity\User)
		    			&& ($entity->getPage()->getUser()->getId() != $this->getToken()->getUser()->getId() )) :
		    			
		    			$entity->setUpdatedAt(new \DateTime());
		    			$no_permission = true;
		    			break;
		    	case ( ($entity instanceof \PiApp\AdminBundle\Entity\Widget)
		    			&& !(in_array('ROLE_ADMIN', $this->getUserRoles()) || in_array('ROLE_SUPER_ADMIN', $this->getUserRoles()) || in_array('ROLE_CONTENT_MANAGER', $this->getUserRoles()))
		    			&& $is_permission_management_page_by_user_only
		    			&& (method_exists($this->getToken(), 'getUser'))
		    			&& ($entity->getBlock()->getPage()->getUser() instanceof \BootStrap\UserBundle\Entity\User)
		    			&& ($entity->getBlock()->getPage()->getUser()->getId() != $this->getToken()->getUser()->getId() )) :
		    		
		    			$entity->setUpdatedAt(new \DateTime());
		    			$no_permission = true;
		    			break;
		    	case ( ($entity instanceof \PiApp\AdminBundle\Entity\TranslationWidget)
		    			&& !(in_array('ROLE_ADMIN', $this->getUserRoles()) || in_array('ROLE_SUPER_ADMIN', $this->getUserRoles()) || in_array('ROLE_CONTENT_MANAGER', $this->getUserRoles()))
		    			&& $is_permission_management_page_by_user_only
		    			&& ($entity->getWidget()->getBlock()->getPage()->getUser() instanceof \BootStrap\UserBundle\Entity\User)
		    			&& ($entity->getWidget()->getBlock()->getPage()->getUser()->getId() != $this->getToken()->getUser()->getId() )) :
		    	
		    			$entity->setUpdatedAt(new \DateTime());
		    			$no_permission = true;
		    			break;
		    	default:
		    			$no_permission = false;
		    			break;	    			
	    	} 
    	}else
    		$no_permission = false;
   	
		return $no_permission;
    }    
    
    /**
     * We create all layout block in terms of the layout information.
     *
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $eventArgs
     *
     * @return void
     * @access protected
     * @final
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    final protected function _Create_Block_Page(LifecycleEventArgs $eventArgs)
    {
    	$entity_page	= $eventArgs->getEntity();
    	$entityManager 	= $eventArgs->getEntityManager();
    
    	// If  autentication user
    	if( $this->isUsernamePasswordToken() 
    		&& ($entity_page instanceof \PiApp\AdminBundle\Entity\Page) 
    		&& ($entity_page->getLayout() instanceof \PiApp\AdminBundle\Entity\Layout)){
    
    				$layout_blocks	= (string) $entity_page->getLayout()->getConfigXml();
    				
    				// if the configXml field of the layout entity isn't configured correctly.
    				try {
    					$layout_blocks	= new \Zend_Config_Xml($layout_blocks);
    				} catch (\Exception $e) {
    					$layout_blocks = null;
    				}    				
    				
    				if($layout_blocks->get('blocks') && $layout_blocks->blocks->get('name')){
    					$layout_blocks	= $layout_blocks->blocks->name->toArray();
    				}else 
    					$layout_blocks = null;

    				if(!is_null($layout_blocks)){
    					// we get all block names information of the page entity.
    					$page_blocks	= $entity_page->getBlocks()->toArray();
    					$page_blocks_name = array();
    					foreach($page_blocks as $k=>$v){
    						$page_blocks_name[] = $v->getName();
    					}    						
	    				// we create all the blocks that have not already been created.
	    				foreach($layout_blocks as $key => $block_name){
	    					if(!in_array($block_name, $page_blocks_name)){
	    						$entity_block = new Block();
	    						$entity_block->setCreatedAt(new \DateTime(date('Y-m-d')));
	    						$entity_block->setUpdatedAt(new \DateTime(date('Y-m-d')));
	    						$entity_block->setPage($entity_page);
	    						$entity_block->setName($block_name);
	    						$entity_block->setPosition($key);
	    						$entity_block->setConfigCssClass('block_'.$block_name);
	    						$entity_block->setEnabled(true);
	    
	    						// we add the entity to be persisted.
	    						$this->_addPersistEntities($entity_block);
	    					}
	    				}
    				}
   		} // endif
    }  
    
    /**
     * We check if the url of the page does not already exist.
     *
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $eventArgs
     *
     * @return void
     * @access protected
     * @final
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    final protected function _single_SlugByPage($eventArgs)
    {
    	$entity			= $eventArgs->getEntity();
    	$entityManager 	= $eventArgs->getEntityManager();
    	$no_permission	= false;
    	
    	// If  autentication user
    	if( $this->isUsernamePasswordToken() ){
    		switch (true) {
    			default:
    				$page = null;
    			break;
    			case ( $entity instanceof \PiApp\AdminBundle\Entity\Page ) :
    				$page = $entity;
    				break;
    			case ( $entity instanceof \PiApp\AdminBundle\Entity\TranslationPage ) :
    				$page = $entity->getPage();
    				break;
    		} // end switch
    		
    		if (is_null($page))
    			return $no_permission;
    		
    		if( ($page instanceof \PiApp\AdminBundle\Entity\Page) 
    				&& ( !$page->getTranslations()->isEmpty() )){
					
    				// we delete all references of the page in the index file.
    				$this->_container()->get('pi_app_admin.manager.search_lucene')->deletePage($page);    				
    				
					// we get all urls of a page
					$locales  			= $this->_container()->get('pi_app_admin.manager.page')->getUrlByPage($page, 'sql');
					$no_permission_urls = null;
					$route_page 		= $page->getRouteName();
					// we select all rows which contain the url value
					foreach($locales as $key => $value){
						// if the urls of the page are not those of the home page.
						if(!empty($value)){
							$query 	= "SELECT id, locales FROM pi_routing WHERE locales LIKE '%$value%' AND route != '$route_page' ";
							$rows 	= $this->_connexion($eventArgs)->fetchAll($query);
							
							foreach($rows as $row){
								$locales = json_decode($row['locales']);
								foreach($locales as $lang => $slug){
									$value	= str_replace("\\\\\\\\\/", "/", $value);
									if($slug == $value){
										$no_permission			= true;
										$no_permission_urls[] 	= '« ' . str_replace("\\\\\\\\\/", "/", $value) . ' »';
									}									
								}
							}
						}
					}
			} // endif
    		
    	} // endif
    	
    	// If one of the urls of the page already existe, we forbid those registrations.
    	if($no_permission){
	    	switch (true) {
	    		case( ($entity instanceof \PiApp\AdminBundle\Entity\Page) && ($eventArgs instanceof PreUpdateEventArgs) ):
	    			if ($eventArgs->hasChangedField('url')) {
	    				$entity->setUrl('undefined-value');
	    			}
	    			break;
	    		case ($entity instanceof \PiApp\AdminBundle\Entity\TranslationPage) :
    				$entity->setSlug('undefined-value');
    			break;
    		} 		
    	
    		$urls = implode(', ', $no_permission_urls);
    		$message = $this->_container()->get('translator')->trans('pi.session.flash.page.slug.exist', array('url'=> $urls));
    		$this->setFlash($message, 'only');
    	}
    	
    }   
    
    /**
     * we manage the search lucene.
     *
     * @param $eventArgs
     *
     * @return void
     * @access protected
     * @final
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */    
    final protected function _Search_lucene(LifecycleEventArgs $eventArgs, $action)
    {
    	$entity			= $eventArgs->getEntity();
    	$entityManager 	= $eventArgs->getEntityManager();
    	
    	// We check the permission in config.
    	$is_indexation_authorized = $this->_container()->getParameter('pi_app_admin.page.indexation_authorized_automatically');
    	
    	if ($this->isUsernamePasswordToken() && $is_indexation_authorized) {
	        switch (true) {
	        	default:
	        			$page = null;
	        			break;        	
		    	case ( $entity instanceof \PiApp\AdminBundle\Entity\Page ) :
			    		$page = $entity;
		    			break;
		    	case ( $entity instanceof \PiApp\AdminBundle\Entity\TranslationPage ) :
		    			$page = $entity->getPage();
		    			break;
		    	case ( $entity instanceof \PiApp\AdminBundle\Entity\Block) :
		    			$page = $entity->getPage();
		    			break;
		    	case ( $entity instanceof \PiApp\AdminBundle\Entity\Widget) :
		    			if(!is_null($entity->getBlock()))
		    				$page = $entity->getBlock()->getPage();
		    			else
		    				$page = null;
		    			break;
		    	case ( $entity instanceof \PiApp\AdminBundle\Entity\TranslationWidget ) :
		    			if(!is_null($entity->getBlock()))
		    				$page = $entity->getWidget()->getBlock()->getPage();
		    			else
		    				$page = null;		    			
		    			break;
	    	} 
	    	
	    	if (is_null($page))
	    		return false;    	
	
	    	switch ($action) {
	    		case ('insert') :
	    			$this->_container()->get('pi_app_admin.manager.search_lucene')->indexPage($page);
	    			break;
	    		case ('update') :
	    			$this->_container()->get('pi_app_admin.manager.search_lucene')->indexPage($page);
	    			break;
	    		case ('delete') :
	    			$this->_container()->get('pi_app_admin.manager.search_lucene')->deletePage($page);
	    			break;
	    		default:
	    			// deafault
	    			break; 
	    	}
    	}

    }
  
    
    /**
     * We register in the cache the route of the page
     *
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $eventArgs
     *
     * @return void
     * @access protected
     * @final
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    final protected function _updateCacheUrlGenerator(LifecycleEventArgs $eventArgs)
    {
    	$entity			= $eventArgs->getEntity();
    	
    	if( $this->isUsernamePasswordToken() 
    			&& ($entity instanceof \PiApp\AdminBundle\Entity\Page) 
    			&& $entity->getEnabled() 
    			&& !$entity->getTranslations()->isEmpty() ){
    	}elseif($entity instanceof \PiApp\AdminBundle\Entity\TranslationPage){
    	}else
    		return false;
    	
    	$routeCacheManager = $this->_container()->get('bootstrap.route_cache');
        $routeCacheManager->setGenerator();
    	$routeCacheManager->setMatcher();
    }
    
    /**
     * we create the historic change of TranslationPage status.
     *
     * @param \Doctrine\ORM\Event\PreUpdateEventArgs $eventArgs
     *
     * @return void
     * @access protected
     * @final
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */    
    final protected function _TranslationPage(PreUpdateEventArgs $eventArgs)
    {
    	$entity			= $eventArgs->getEntity();
    	$entityManager 	= $eventArgs->getEntityManager();
    	
    	// we set the persist of the Page entity
    	if( $this->isUsernamePasswordToken() && $entity instanceof TranslationPage){
    		if ($eventArgs->hasChangedField('status')) {
    			$historicalStatus = new HistoricalStatus();
    			$historicalStatus->setCreatedAt(new \DateTime(date('Y-m-d')));
    			$historicalStatus->setPageTranslation($entity);
    			$historicalStatus->setStatus($entity->getStatus());
    			$historicalStatus->setComment('Historical status change');
    			$historicalStatus->setCreatedAt(new \DateTime());
    			$historicalStatus->setEnabled(true);
    			
    			// we add the entity to be persisted.
    			$this->_addPersistEntities($historicalStatus);
    		}
    	}
    }
}