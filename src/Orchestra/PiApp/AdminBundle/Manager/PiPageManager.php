<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Managers
 * @package    Manager
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-23
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Manager;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response as Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use PiApp\AdminBundle\Builder\PiPageManagerBuilderInterface;
use PiApp\AdminBundle\Repository\TranslationPageRepository;
use PiApp\AdminBundle\Manager\PiCoreManager;
use PiApp\AdminBundle\Entity\Page;
use PiApp\AdminBundle\Entity\TranslationPage;
use PiApp\AdminBundle\Entity\Block;
use PiApp\AdminBundle\Entity\Widget;

/**
 * Description of the Page manager
 *
 * @category   Admin_Managers
 * @package    Manager
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiPageManager extends PiCoreManager implements PiPageManagerBuilderInterface 
{    
	/**
	 * @var \PiApp\AdminBundle\Manager\PiWidgetManager
	 */	
	protected $widgetManager;	
	
	/**
	 * Constructor.
	 *
	 * @param ContainerInterface $container The service container
	 */
	public function __construct(ContainerInterface $container)
	{
		parent::__construct($container);
	}
	
	/**
	 * Returns the render of the current page.
	 * 
	 * @param string $lang
	 * @param bool		$isSetPage
	 * 
	 * @return string
	 * @access	public
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-01-23
	 */
	public function render($lang = '', $isSetPage = false)
	{
		// we set the langue
		if(empty($lang))	$lang = $this->language;
		
		// 	Initialize page
		if ($this->getCurrentPage()){
			// we get the current page.
			$page = $this->getCurrentPage();
			// we set the page.
			if($isSetPage)
				$this->setPage($page);
		}else{
			if ($this->isAnonymousToken()) {
				// We inform that the page does not exist fi the user is connected.
				$this->setFlash("pi.session.flash.page.notexist", 'notice');
			}
			// we redirect to the public url home page.
			return $this->redirectHomePublicPage();
		}
		
		// if the page is enabled.
		if($page && $page->getEnabled()){
			// 	Initialize response
			$response = $this->getResponseByIdAndType('page', $page->getId());			
			
			// we register only the translation page asked in the $lang value.
			$this->setTranslations($page, $lang);
			
			// we get the translation of the current page in terms of the lang value.
			$pageTrans		= $this->getTranslationByPageId($page->getId(), $lang);
			
			// If the translation page is secure and the user is not connected, we return to the home page.
			if($pageTrans && $pageTrans->getSecure() && $this->isAnonymousToken()){
				return $this->redirectHomePublicPage();
			}	

			// If the translation page is not authorized to publish, we return to the home page.
			if($pageTrans && ($pageTrans->getStatus() != TranslationPageRepository::STATUS_PUBLISH) && $this->isAnonymousToken()){
				return $this->redirectHomePublicPage();
			}		

			// If the translation page is secure and the user is not authorized, we return to the home page.
			if($pageTrans && $pageTrans->getSecure() && $this->isUsernamePasswordToken()){
				// Gets all user roles.
				$user_roles 			= array_unique(array_merge($this->getAllHeritageByRoles($this->getBestRoles($this->getUserRoles())), $this->getUserRoles()));
				// Gets the best role authorized to access to the page.
				$authorized_page_roles 	= $this->getBestRoles($pageTrans->getHeritage());
				
				$right = false;
				if(is_null($authorized_page_roles))
					$right = true;
				else{
					foreach($authorized_page_roles as $key=>$role_page){
						if(in_array($role_page, $user_roles))
							$right = true;
					}
				}
				
				if(!$right)
					return $this->redirectHomePublicPage();
			}			
			
			// Handle 404
			// We don't show the page if :
			// * The page doesn't have a translation set.
			// * the translation doesn't have a published status.
			if (!$pageTrans) {
				// we register all translations page linked to one page.
				$this->setTranslations($page);
				// we get the translation of the current page in another language if it exists.
				$pageTrans		= $this->getTranslationByPageId($page->getId(), $lang);
				
				if (!$pageTrans) {
					$page 			= $this->getRepository('page')->getPageByUrlAndSlug('error', 'error404-'.$this->language);
					if (!$page)
						throw new \InvalidArgumentException("We haven't set in the data fixtures the error page message in the $lang locale !");
			
					// we set the page.
					$this->setPage($page);
									
					$response->setStatusCode(404);
				}
			}
			
			// We set the Etag value
			$id 				= $page->getId();
			$lang_				= $this->language;
			$this->setEtag("page:$id:$lang_");

			// Create a Response with a Last-Modified header.
			$response = $this->configureCache($page, $response);
			
			// Check that the Response is not modified for the given Request.
			if ($response->isNotModified($this->container->get('request'))){
				// We set the reponse
				$this->setResponse($page, $response);
				// return the 304 Response immediately
				return $response;
			} else {
				// or render a template with the $response you've already started
				$response->headers->set('Content-Type', $page->getMetaContentType());
				$response = $this->container->get('pi_app_admin.caching')->renderResponse($this->Etag, array('page' => $page), $response);
				// We set the reponse
				$this->setResponse($page, $response);
				// return the Response
				return $response;
			}
		}else
			return $this->redirectHomePublicPage();
	}
	
	/**
	 * Returns the render source of one page.
	 *
	 * @param string $id
	 * @param string $lang
	 * @param array	 $params
	 * @return string
	 * @access	public
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-01-31
	 */
	public function renderSource($id, $lang = '', $params = null)
	{
		if(!$this->getPageById($id)){
			// we set the page.
			$this->setPageById($id);
		}
		
		// we set the langue
		if(empty($lang))	$lang = $this->language;
		
		$init_pc_layout		= str_replace("/", "\\\\", $this->getPageById($id)->getLayout()->getFilePc());
		$init_pc_layout		= str_replace("\\", "\\\\", $init_pc_layout);
		$init_mobile_layout	= str_replace("\\", "\\\\", $this->getPageById($id)->getLayout()->getFileMobile());
		
		$request 			= $this->container->get('request');
		$session			= $request->getSession();
		
		if(empty($init_pc_layout))
			$init_pc_layout 	= $this->container->getParameter('pi_app_admin.layout.init.pc.template');
		if(empty($init_mobile_layout))
			$init_mobile_layout = $this->container->getParameter('pi_app_admin.layout.init.mobile.template');

		// we get the translation of the current page in terms of the lang value.
		$pageTrans	 = $this->getTranslationByPageId($id, $lang);	//if($lang == 'fr') print_r($pageTrans->getLangCode()->getId());
		if($pageTrans instanceof TranslationPage){
			$description = $pageTrans->getMetaDescription();
			$keywords	 = $pageTrans->getMetaKeywords();
			$title		 = $pageTrans->getMetaTitle();
		}else{
			$description = "";
			$keywords	 = "";		
			$title       = "";
		}

		// we get the css file of the page.
		$styleshette = $this->getPageById($id)->getPageCss();
		// we get the js file of the page.
		$javascript  = $this->getPageById($id)->getPageJs();
		
		// we create the source page.
		$source  = "{% set layout_screen = app.session.get('wurfl-screen') %}\n";
		$source .= "{% set is_switch_layout_mobile_authorized = getParameter('pi_app_admin.page.switch_layout_mobile_authorized') %}";
		$source .= "{% if layout_screen is empty or not is_switch_layout_mobile_authorized  %}\n";
		$source .= "{% 	set layout_screen = 'layout' %}\n";
		$source .= "{% endif %}\n";
		$source .= "{% if layout_screen in ['layout-poor', 'layout-medium', 'layout-high', 'layout-ultra'] %}\n";
		$source .= "{% 	set layout_nav = 'PiAppTemplateBundle::Template\\\Layout\\\Mobile\\\\".$init_mobile_layout."\\\'~ layout_screen ~'.html.twig' %}\n";
		$source .= "{% else %}\n";
		$source .= "{% 	set layout_nav = 'PiAppTemplateBundle::Template\\\Layout\\\Pc\\\\".$init_pc_layout."' %}\n";
		$source .= "{% endif %}\n";
		$source .= "{% extends layout_nav %}\n";		
		
		if($styleshette instanceof \Doctrine\ORM\PersistentCollection){
			foreach($styleshette as $s){
				$source 	.= "{% stylesheet '".$s->getUrl()."' %} \n";
			}
		}
		if($javascript instanceof \Doctrine\ORM\PersistentCollection){
			foreach($javascript as $s){
				$source 	.= "{% javascript '".$s->getUrl()."' %} \n";
			}
		}

		$source 	.= "{% block global_title %}";
		$source 	.= "{{ parent() }} \n";
		$source 	.= "{{ title_page('{$title}') }} \n";
		$source 	.= "{% endblock %} \n";
		
		$source 	.= "{% set global_local_language = '".$this->language."' %} \n";
		$source 	.= " \n";
		
		$source 	.= "{% block global_meta %} \n";
		$source 	.= "{{ parent() }}	\n";

		$source 	.= "	{{ metas_page({'description':'{$description}','keywords':'{$keywords}','title':'{$title}'})|raw }} \n";
		$source 	.= "{% endblock %} \n";
		
		if(isset($this->blocks[$id]) && !empty($this->blocks[$id])){
			
			$all_blocks = $this->blocks[$id];
			foreach ($all_blocks as $block) {
				// if the block is not disabled.				
				if($block->getEnabled()) {
					$source 	.= "{% block ".$block->getName()." %} \n";
					$source 	.= "{{ parent() }}	\n";
					$source 	.= "<orchestra id='block__".$block->getId()."' data-id='".$block->getId()."' data-name='".$block->getName()."' > \n";
					
					if(isset($this->widgets[$id][$block->getId()]) && !empty($this->widgets[$id][$block->getId()])){
						$all_widgets 	 = $this->widgets[$id][$block->getId()];
						$widget_position = array();
						foreach ($all_widgets as $widget) {
							if($widget->getEnabled()) {
								if(isset($this->widgets[$id][$block->getId()][$widget->getId()]) && !empty($this->widgets[$id][$block->getId()][$widget->getId()])){
									
							    	// we get the widget manager
							    	$widgetManager  	= $this->getWidgetManager();
							    	
							    	// we set the result
							    	$widgetManager->setCurrentWidget($this->widgets[$id][$block->getId()][$widget->getId()]);
							    	
							    	// we initialize js and css script of the widget
							    	$widgetManager->setScript();
							    	
							    	// we initialize init of the widget
							    	$widgetManager->setInit();				

							    	if($widget->getPosition() && ($widget->getPosition() != 0)){
							    		$pos = $widget->getPosition();
							    		
							    		// we return the render (cache or not)
							    		$widget_position[ $pos ]	 = "<orchestra id='widget__".$widget->getId()."' data-id='".$widget->getId()."' > \n";
 							    		$widget_position[ $pos ] 	.= $widgetManager->render($this->language). " \n";
 							    		$widget_position[ $pos ] 	.= "</orchestra> \n";
							    	}else{
							    		// we return the render (cache or not)
							    		$widget_position[]	 		 = "<orchestra id='widget__".$widget->getId()."' data-id='".$widget->getId()."' > \n";
 							    		$widget_position[] 			.= $widgetManager->render($this->language) . " \n";
 							    		$widget_position[] 			.= "</orchestra> \n";
							    	} 
							    	
							    	// we set the js and css scripts.
							    	$container  = strtoupper($widget->getPlugin());
							    	$this->script['js']		= array_merge($this->script['js'], $widgetManager->getScript('js', 'array'));
							    	$this->script['css']	= array_merge($this->script['css'], $widgetManager->getScript('css', 'array'));
							    	$this->script['init']	= array_merge($this->script['init'], $widgetManager->getScript('init', 'array'));
								}
							}
						}
						ksort($widget_position);
						$source		.= implode(" \n", $widget_position);
					}
					$source 	.= " </orchestra> \n";
					$source 	.= " {% endblock %} \n";
				}
			}			
		}
		
		// we set the js and css script of the widget
		$source 	.= "{% block global_script_js %} \n";
		$source		.= " {{ parent() }} \n"; 
		$source 	.= " <script type=\"text/javascript\"> \n";
		$source 	.= " //<![CDATA[ \n";
		$source 	.= $this->getScript('js', 'implode') . " \n";
		$source 	.= " //]]> \n";
		$source 	.= " </script> \n";
		$source 	.= "{% endblock %} \n";
		
		$source 	.= "{% block global_script_css %} \n";
		$source		.= " {{ parent() }} \n";
		$source 	.= " <style type=\"txt/css\"> \n<!-- \n";
		$source 	.= $this->getScript('css', 'implode') . " \n";
		$source 	.= " \n--> \n</style> \n";
		$source 	.= "{% endblock %} \n";
		
		// we set all initWidget
		$source		= $this->getScript('init', 'implode') . "\n" . $source;
		
		//print_r($source);
		//print_r("<br /><br /><br />");
		//exit;
		
		return $source;
	}
	
	/**
	 * Sets and return a page by id.
	 *
	 * @param int	$idPage
	 *
	 * @return void
	 * @access public
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-02-16
	 */
	public function setPageById($idPage)
	{
		$page = $this->getRepository('Page')->find($idPage);
		
		if($page instanceof Page) {
			// we set the result
			$this->setCurrentPage($page);
			// we set the page.
			$this->setPage($page);
			// we return the setting page.
			return $page;			
		}else
			return false;
	}	
	
	/**
	 * Sets and return a page by url and slug.
	 *
	 * @param string	$url	url value of a page
	 * @param string	$slug	slug value of a translation of a page
	 * @param bool		$isSetPage
	 * 
	 * @return \PiApp\AdminBundle\Entity\Page
	 * @access public
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-01-23
	 */
	public function setPageByParams($url, $slug, $isSetPage = false) 
	{
	    // Get corresponding page
    	if(!$slug && !$url) {
    		$page = $this->getRepository('page')->getHomepage();
    	}
    	else {
    		$slug = explode('/', $slug);
    		$slug = $slug[count($slug) - 1];
    		$page = $this->getRepository('page')->getPageByUrlAndSlug($url, $slug);
    	}
    	
    	if($page instanceof Page) {
    		// we set the result
    		$this->setCurrentPage($page);
			// we set the page.
			if($isSetPage)
				$this->setPage($page);
			// we return the setting page.
			return $page;
		}else
			return false;
	}

	/**
	 * Sets and return a page by a route name.
	 *
	 * @param string	$route		route page
	 * @param bool		$isSetPage
	 *
	 * @return \PiApp\AdminBundle\Entity\Page
	 * @access public
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-01-23
	 */
	public function setPageByRoute($route = '', $isSetPage = false)
	{
		// Get corresponding page
		if(!$route || empty($route)) {
			$page = $this->getRepository('page')->getHomepage();
		}
		else {
			$page = $this->getRepository('page')->findOneBy(array('route_name' => $route));
		}
		
		if($page instanceof Page) {
			// we set the result
			$this->setCurrentPage($page);
			// we set the page.
			if($isSetPage)
				$this->setPage($page);
			// we return the setting page.
			return $page;
		}else
			return false;
	}	

	/**
	 * Sets a page and construct all it information.
	 *
	 * @param \PiApp\AdminBundle\Entity\Page $page
	 *
	 * @return void
	 * @access private
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-01-31
	 */
	private function setPage(Page $page)
	{
		$id = $page->getId();
		if(!$this->getPageById($id)){
			// we register all translations page linked to one page.
			$this->setTranslations($page);
			// we register all blocks linked to one page.
			$this->setBlocks($page);	
			// we register all widgets linked to one page
			$this->setWidgets($page);		
			// we register the page
			$this->pages[$id] = $page;
		}
	}	
	
	/**
	 * Sets all the related translations linked to one page.
	 *
	 * @param \PiApp\AdminBundle\Entity\Page $page
	 *
	 * @return void
	 * @access private
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-01-23
	 */
	private function setTranslations(Page $page, $locale = false)
	{
		if(!isset($this->translations[$page->getId()]) || empty($this->translations[$page->getId()])){			
			if(!$locale){
				// records all translations
				$all_translations = $page->getTranslations();
				foreach ($all_translations as $translation) {
					$this->translations[$page->getId()][$translation->getLangCode()->getId()] = $translation;
				}
			}else{
				$translationPage = $this->getRepository('translationPage')->findOneBy(array('page' => $page->getId(), 'langCode'=>$locale));
				
				if($translationPage instanceof \PiApp\AdminBundle\Entity\TranslationPage)
					$this->translations[$page->getId()][$locale] = $translationPage;
			}
		}
	}	
	
	/**
	 * Sets all the related block linked to one page.
	 *
	 * @param \PiApp\AdminBundle\Entity\Page $page
	 * 
	 * @return void
	 * @access private
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-01-23
	 */
	private function setBlocks(Page $page)
	{
		if(!isset($this->blocks[$page->getId()]) || empty($this->blocks[$page->getId()])){
			$all_blocks = $page->getBlocks();
		
			// records all blocks
			foreach ($all_blocks as $block) {
				$this->blocks[$page->getId()][$block->getId()] = $block;
			}
		}
	}
	
	/**
	 * Sets all the related block linked to one page.
	 *
	 * @param \PiApp\AdminBundle\Entity\Page $page
	 *
	 * @return void
	 * @access private
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-01-31
	 */
	private function setWidgets(Page $page)
	{
		if(isset($this->blocks[$page->getId()]) && !empty($this->blocks[$page->getId()])) {
			$all_blocks = $this->blocks[$page->getId()];
		
			// records all widgets
			foreach ($all_blocks as $block) {
				$all_widgets = $block->getWidgets();
				foreach ($all_widgets as $widget) {
					$this->widgets[$page->getId()][$block->getId()][$widget->getId()] = $widget;
				}			
			}
		}
	}	
	
	/**
	 * Sets the response to one page.
	 * 
	 * @param \PiApp\AdminBundle\Entity\Page $page
	 * @param \Symfony\Component\HttpFoundation\Response $response
	 *
	 * @return void
	 * @access private
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-01-31
	 */
	private function setResponse($page, Response $response)
	{
		$this->responses['page'][$page->getId()] = $response;
	}	
	
	/**
	 * Sets the Widget manager service.
	 *
	 * @return void
	 * @access private
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-01-31
	 */
	private function setWidgetManager()
	{
		$this->widgetManager = $this->container->get('pi_app_admin.manager.widget');
	}
	
	/**
	 * Gets the Widget manager service
	 *
	 * @return \PiApp\AdminBundle\Manager\PiWidgetManager
	 * @access private
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-01-31
	 */
	private function getWidgetManager()
	{
		if(empty($this->widgetManager))
			$this->setWidgetManager();
	
		return $this->widgetManager;
	}	
	
	/**
	 * It redirects to the public url home page.
	 *
	 * @return void
	 * @access private
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-02-14
	 */
	private function redirectHomePublicPage(){
		// It tries to redirect to the original page.
		$url = $this->container->get('request')->headers->get('referer');
		if(empty($url)) {
			$url = $this->container->get('router')->generate('home_page');
		}
		return new RedirectResponse($url);
	}	
	
	/**
	 * Return the ChildrenHierarchy result of the rubrique entity.
	 *
	 * @return string
	 * @access public
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-02-29
	 */
	public function getChildrenHierarchyRub()
	{
		$_em = $this->container->get('pi_app_admin.repository');
	
		$options = array(
				'decorate' => true,
				'rootOpen' => "\n <ul> \n",
				'rootClose' => "\n </ul> \n",
				'childOpen' => "	<li class='collapsed' > \n",		// 'childOpen' => "	<li class='collapsed' > \n",
				'childClose' => "	</li> \n",
				'nodeDecorator' => function($node) {
					return  '<a data-rub="'.$node['id'].'" >'.$node["titre"].'</a><p class="pi_tree_desc">'.$node["descriptif"]."</p>";
				}
		);
		$htmlTree = $_em->getRepository('Rubrique')->childrenHierarchy(
				null, /* starting from root nodes */
				false, /* load all children, not only direct */
				$options
		);
	
		return $htmlTree;
	}
	
	/**
	 * Modify the tree result with the pages blocks.
	 *
	 * @return string
	 * @access public
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-02-29
	 */
	public function setTreeWithPages($htmlTree)
	{
		if(empty($htmlTree))
			return $htmlTree;
	
		$htmlTree = $this->container->get('pi_app_admin.string_manager')->trimUltime($htmlTree);
		if (preg_match_all('#<a data-rub="(?P<id_rubrique>(.*))" >(?P<titre>(.*))</a><p class="pi_tree_desc">(?P<descriptif>(.*))</p>#sU', $htmlTree, $matches_rubs)){
			foreach($matches_rubs['id_rubrique'] as $key => $idRubrique){
				$result_simple  	= preg_split('#<a data-rub="'.$idRubrique.'" >(.*)</a><p class="pi_tree_desc">(.*)</p>#sU', $htmlTree);
				$result_multiple  	= preg_split('#<a data-rub="'.$idRubrique.'" >(.*)</a><p class="pi_tree_desc">(.*)</p>(.*)<ul>#sU', $htmlTree);
	
				if(count($result_simple) == 2){
					$allRubriquePages = $this->getPagesByRub($idRubrique);
					if(!empty($allRubriquePages))
						$htmlTree = $result_simple[0]
						. '<a data-rub="'.$idRubrique.'" >'.$matches_rubs['titre'][$key].'</a><p class="pi_tree_desc">'.$matches_rubs['descriptif'][$key].'</p>'
						. '<ul>'
						. $allRubriquePages
						. '</ul>'
						. $result_simple[1];
				}
				if(count($result_multiple) == 2){
					$allRubriquePages = $this->getPagesByRub($idRubrique);
	
					if(!empty($allRubriquePages))
						$htmlTree = $result_multiple[0]
						. '<a data-rub="'.$idRubrique.'" >'.$matches_rubs['titre'][$key].'</a><p class="pi_tree_desc">'.$matches_rubs['descriptif'][$key].'</p>'
						. '<ul>'
						. $allRubriquePages
						. $result_multiple[1];
				}
			} // end foreach
		}
	
		return $htmlTree;
	}
	
	/**
	 * Sets the home page.
	 *
	 * @return string
	 * @access public
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-02-29
	 */
	public function setHomePage($htmlTree)
	{
		$pages_content	= "";
		$page	 		=  $this->container->get('pi_app_admin.repository')->getRepository('Page')->getHomePage();
	
		if($page instanceof Page){
	
			if( !$page->getTranslations()->isEmpty() ){
				$locales = array();
				$pages_content .= "<li><p>Home Page ".$page->getId()."</p><a href='#'>url : ".$page->getUrl()."</a><p></p><ul>";
				foreach($page->getTranslations() as $key=>$translationPage){
					if($translationPage instanceof TranslationPage){
						$local = $translationPage->getLangCode()->getId();
						try {
							$route = $this->container->get('router')->generate( $page->getRouteName(), array('locale' => $local) );
						} catch (\Exception $e) {
							$route = $this->container->get('router')->generate( $page->getRouteName());
						}
						$pages_content .= "<li>";
						$pages_content .= "<p>local ".$local."</p><a href='".$route."'>slug : ".$translationPage->getSlug()."</a><p class='pi_tree_title'>".$translationPage->getTitre()."</p><p class='pi_tree_desc'>".$translationPage->getDescriptif()."</p>";
						$pages_content .= "</li>";
					}
				}
				$pages_content .= "</ul></li>";
			}
	
		}
	
		$pages_content  	= preg_replace('#<ul>#sU', '<ul>'.$pages_content, $htmlTree, 1);
		return $pages_content;
	}
	
	/**
	 * Gets all page of a rubrique.
	 *
	 * @return string
	 * @access private
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-02-28
	 */
	private function getPagesByRub($idRubrique)
	{
		$pages_content		= "";
		$pagesByRubrique 	=  $this->container->get('pi_app_admin.repository')->getRepository('Page')->getAllPageByRubriqueId($idRubrique)->getQuery()->getResult();
	
		if(is_array($pagesByRubrique)){
			foreach($pagesByRubrique as $key => $page){
				if($page instanceof Page){
	
					if( !$page->getTranslations()->isEmpty() ){
						$locales = array();
						$pages_content .= "<li><p>Page ".$page->getId()."</p><a href='#'>url : ".$page->getUrl()."</a><p></p><ul>";
						foreach($page->getTranslations() as $key=>$translationPage){
							if($translationPage instanceof TranslationPage){
								$local = $translationPage->getLangCode()->getId();
								try {
									$route = $this->container->get('router')->generate( $page->getRouteName(), array('locale' => $local) );
								} catch (\Exception $e) {

									try {
										$route = $this->container->get('router')->generate( $page->getRouteName() );
									} catch (\Exception $e) {
										$route = "";
									}
									
								}
								$pages_content .= "<li class='css-transform-rotate dhtmlgoodies_sheet.gif' >";
								$pages_content .= "<p>local ".$local."</p><a href='".$route."'>slug : ".$translationPage->getSlug()."</a><p class='pi_tree_title'>".$translationPage->getTitre()."</p><p class='pi_tree_desc'>".$translationPage->getDescriptif()."</p>";
								$pages_content .= "</li>";
							}
						} // end foreach
						$pages_content .= "</ul></li>";
					}
	
				}
			} // end foreach
		}
	
		return $pages_content;
	}	
	
	/**
	 * Add node numeber in the <li>.
	 *
	 * @return string
	 * @access public
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-02-29
	 */
	public function setNode($htmlTree)
	{
		if(empty($htmlTree))
			return $htmlTree;
		
		//print_r($htmlTree);
	
		$htmlTree 			= $this->container->get('pi_app_admin.string_manager')->trimUltime($htmlTree);
		$matches_balise_rub	= preg_split('#<li>(?P<num>(.*))#sU', $htmlTree);
		$max_key			= 1;
		if ($matches_balise_rub){
			
			//print_r($matches_balise_il);
			$htmlTree = '';
			$max_key = count($matches_balise_rub)-1;
			foreach($matches_balise_rub as $key => $value){
				if($max_key != $key)
					$htmlTree .= $value . '<li id="node'.($key+1).'">';
				else
					$htmlTree .= $value;
			}
		}
		
		$matches_balise_page 	= preg_split("#<li class='dhtmlgoodies_sheet.gif'>(?P<num>(.*))#sU", $htmlTree);
		$max_key				= 1;
		if ($matches_balise_page){
		
			//print_r($matches_balise_il);
			$htmlTree = '';
			$max_key = count($matches_balise_page)-1;
			foreach($matches_balise_page as $key => $value){
				if($max_key != $key)
					$htmlTree .= $value . '<li id="node'.($key+1).'" class=\'dhtmlgoodies_sheet.gif\'>';
				else
					$htmlTree .= $value;
			}
		}		
		
		//print_r($htmlTree);exit;
	
		return $htmlTree;
	}

	/**
	 * Refresh the cache of the tree Chart page.
	 *
	 * @return string
	 * @access public
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-05-11
	 */
	public function cacheTreeChartPageRefresh()
	{
		// we manage the "tree chart page"
		$params_treechart = array();
		$params_treechart['action']  = "renderByClick";
		$params_treechart['id']	 	 = ".org-chart-page";
		$params_treechart['menu'] 	 = "page";
		// we sort an array by key in reverse order
		krsort($params_treechart);
		// we create de Etag cache
		$params_treechart 	 = json_encode($params_treechart);
		$params_treechart	 = str_replace(':', '#', $params_treechart);
		
		$all_lang	= $this->getRepository('Langue')->findByEnabled(true);
		foreach($all_lang as $key => $lang){
			$id_lang = $lang->getId();
			$Etag_treechart = "organigram:Rubrique~org-chart-page:$id_lang:$params_treechart";
			// we refresh the cache
			$this->cacheRefreshByname($Etag_treechart);
		}
	}	
	
	
	/**
	 * Refresh the cache of all elements of a page (TranslationPages, widgets, translationWidgets)
	 *
	 * @return string
	 * @access public
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-04-03
	 */	
	public function cacheRefresh()
	{
		// we refresh the cache of the tree Chart page.
		$this->cacheTreeChartPageRefresh();
		
		// we get the current page.
		$page = $this->getCurrentPage();
		
		if(!is_null($page) && !is_null($this->translations[$page->getId()])){
			foreach ($this->translations[$page->getId()] as $translation) {
				// we get the lang page
				$lang_page = $translation->getLangCode()->getId();
				
				// we create the cache name
				$name_page	= 'page:'.$page->getId().':'.$lang_page;
	
				if(isset($this->widgets[$page->getId()]) && is_array($this->widgets[$page->getId()])){
					foreach ($this->widgets[$page->getId()] as $key_block=>$widgets) {
						
						if(isset($this->widgets[$page->getId()][$key_block]) && is_array($this->widgets[$page->getId()][$key_block])){
							foreach ($this->widgets[$page->getId()][$key_block] as $key_widget => $widget) {
								
// 								print_r($this->container->get('session')->getLocale());
// 								print_r(' - id : ' . $widget->getId());
// 								print_r(' - plugin : ' . $widget->getPlugin());
// 								print_r(' - action : ' . $widget->getAction());
// 								print_r('<br />');
								
								
								// we create the cache name of the widget
								$Etag_widget	= 'widget:'.$widget->getId().':'.$lang_page;					
	
								// we manage the "transwidget"
								$widget_translations = $this->getWidgetManager()->setWidgetTranslations($widget);
								
								if(is_array($widget_translations)){
									foreach ($widget_translations as $translang => $translationWidget) {
										// we create the cache name of the transwidget
										$Etag_transwidget	= 'transwidget:'.$translationWidget->getId().':'.$translang;
										// we refresh the cache of the transwidget
										$this->cacheRefreshByname($Etag_transwidget);
									}
								}
								
								// If the widget is a "content snippet"
								if( ($widget->getPlugin() == 'content') && ($widget->getAction() == 'snippet') )	{
									$xmlConfig	= $widget->getConfigXml();

									// if the configXml field of the widget is configured correctly.
									try {
										$xmlConfig	= new \Zend_Config_Xml($xmlConfig);
										if($xmlConfig->widgets->get('content'))
										{
											$id_snippet	= $xmlConfig->widgets->content->id;
											// we create the cache name of the snippet
											$Etag_snippet	= 'transwidget:'.$id_snippet.':'.$lang_page;
											// we refresh the cache of the snippet
											$this->cacheRefreshByname($Etag_snippet);
										}
									} catch (\Exception $e) {
									}
								}
								
								// If the widget is a tree a "jqext"
								if( ($widget->getPlugin() == 'content') && ($widget->getAction() == 'jqext') )	{
								
									$xmlConfig			= $widget->getConfigXml();
								
									// if the configXml field of the widget is configured correctly.
									try {
										$xmlConfig	= new \Zend_Config_Xml($xmlConfig);
										if($xmlConfig->widgets->get('content') && $xmlConfig->widgets->content->get('controller') && $xmlConfig->widgets->content->get('params'))
										{
											$controller	= $xmlConfig->widgets->content->controller;
								    		$params		= $xmlConfig->widgets->content->params->toArray();
								    		
								    		if($xmlConfig->widgets->content->params->get('cachable'))
								    			$params['cachable'] = $xmlConfig->widgets->content->params->cachable;
								    		else
								    			$params['cachable'] = 'true';
								
								    		$values 	= explode(':', $controller);
								    		$JQcontainer= strtoupper($values[0]);
								    		$JQservice	= strtolower($values[1]);
								
											// we sort an array by key in reverse order
											$this->container->get('pi_app_admin.array_manager')->recursive_method($params, 'krsort');
											// we create de Etag cache
											$params 	= $this->container->get('pi_app_admin.string_manager')->json_encodeDecToUTF8($params);
											$params		= $this->_Encode($params);
											$Etag_jqext	= $widget->getAction() . ":$JQcontainer~$JQservice:$lang_page:$params";
								
											// we refresh the cache of the jqext
											$this->cacheRefreshByname($Etag_jqext);
										}
									} catch (\Exception $e) {
									}
								}							
								
								// If the widget is a "gedmo snippet"
								if( ($widget->getPlugin() == 'gedmo') && ($widget->getAction() == 'snippet') )	{
									$xmlConfig	= $widget->getConfigXml();
									$new_widget = null;
									
									// if the configXml field of the widget is configured correctly.
									try {
										$xmlConfig	= new \Zend_Config_Xml($xmlConfig);
										if($xmlConfig->widgets->get('gedmo'))
										{
											$id_snippet	= $xmlConfig->widgets->gedmo->id;
											// we create the cache name of the snippet
											$Etag_snippet	= 'widget:'.$id_snippet.':'.$lang_page;
											
											// we refresh the cache of the snippet
											$this->cacheRefreshByname($Etag_snippet);
											
											// we allow to refresh the cache of the widget of the snippet
											$new_widget = $this->getWidgetById($id_snippet);
										}
									} catch (\Exception $e) {
									}
									
									if(!is_null($new_widget) && ($new_widget instanceof Widget) )
										$widget = $new_widget;
								}													
								
								// If the widget is a tree a "listener"
								if( ($widget->getPlugin() == 'gedmo') && ($widget->getAction() == 'listener') )	{
									
									$xmlConfig			= $widget->getConfigXml();
									
									// if the configXml field of the widget is configured correctly.
									try {
										$xmlConfig	= new \Zend_Config_Xml($xmlConfig);
										if($xmlConfig->widgets->get('gedmo') && $xmlConfig->widgets->gedmo->get('controller') && $xmlConfig->widgets->gedmo->get('params'))
										{
											$controller	= $xmlConfig->widgets->gedmo->controller;
											$params		= $xmlConfig->widgets->gedmo->params->toArray();
											
											if($xmlConfig->widgets->gedmo->params->get('cachable'))
												$params['cachable'] = $xmlConfig->widgets->gedmo->params->cachable;
											else
												$params['cachable'] = 'true';

											// we sort an array by key in reverse order
											$this->container->get('pi_app_admin.array_manager')->recursive_method($params, 'krsort');
											// we create de Etag cache
											$params 	= $this->container->get('pi_app_admin.string_manager')->json_encodeDecToUTF8($params);
											$params		= $this->_Encode($params);
											$controller	= str_replace(':', '#', $controller);
											$Etag_listener	= $widget->getAction() . ":$controller:$lang_page:$params";
											
											// we refresh the cache of the listener
											$this->cacheRefreshByname($Etag_listener);	
										}
									} catch (\Exception $e) {
									}						
								}							
								
								// If the widget is a "tree"
								if( ($widget->getPlugin() == 'gedmo') && (($widget->getAction() == 'navigation') || ($widget->getAction() == 'organigram')) )	{
									
									$xmlConfig			= $widget->getConfigXml();
								
									// if the configXml field of the widget is configured correctly.
									try {
										$xmlConfig	= new \Zend_Config_Xml($xmlConfig);
										if($xmlConfig->widgets->get('gedmo') && $xmlConfig->widgets->gedmo->get('controller') && $xmlConfig->widgets->gedmo->get('params'))
										{
											$values 	= explode(':', $xmlConfig->widgets->gedmo->controller);
											$entity 	= $values[1];
											$method 	= strtolower($values[2]);
											$params		= array();
																					
											if($xmlConfig->widgets->gedmo->params->get('category'))
												$category = $xmlConfig->widgets->gedmo->params->category;
											else
												$category = "";
											
											if($xmlConfig->widgets->gedmo->params->get('node'))
												$params['node'] = $xmlConfig->widgets->gedmo->params->node;
											else
												$params['node'] = "";
	
											if($xmlConfig->widgets->gedmo->params->get('enabledonly'))
												$params['enabledonly'] = $xmlConfig->widgets->gedmo->params->enabledonly;
											else
												$params['enabledonly'] = "true";
											
											if($xmlConfig->widgets->gedmo->params->get('cachable'))
												$params['cachable'] = $xmlConfig->widgets->gedmo->params->cachable;
											else
												$params['cachable'] = 'true';
	
											if($xmlConfig->widgets->gedmo->params->get('template'))
												$template = $xmlConfig->widgets->gedmo->params->template;
											else
												$template = "";
											
											$params['entity'] 	= $entity;
											$params['category'] = $category;
											$params['template'] = $template;
											
											if($xmlConfig->widgets->gedmo->params->get('navigation')){											
												if($xmlConfig->widgets->gedmo->params->navigation->get('separatorClass'))
													$params['separatorClass'] = $xmlConfig->widgets->gedmo->params->navigation->separatorClass;
												else
													$params['separatorClass'] = "";
												
												if($xmlConfig->widgets->gedmo->params->navigation->get('separatorText'))
													$params['separatorText'] = $xmlConfig->widgets->gedmo->params->navigation->separatorText;
												else
													$params['separatorText'] = "";

												if($xmlConfig->widgets->gedmo->params->navigation->get('separatorFirst'))
													$params['separatorFirst'] = $xmlConfig->widgets->gedmo->params->navigation->separatorFirst;
												else
													$params['separatorFirst'] = "false";
												
												if($xmlConfig->widgets->gedmo->params->navigation->get('separatorLast'))
													$params['separatorLast'] = $xmlConfig->widgets->gedmo->params->navigation->separatorLast;
												else
													$params['separatorLast'] = "false";												
												
												if($xmlConfig->widgets->gedmo->params->navigation->get('ulClass'))
													$params['ulClass'] = $xmlConfig->widgets->gedmo->params->navigation->ulClass;
												else
													$params['ulClass'] = "";
												
												if($xmlConfig->widgets->gedmo->params->navigation->get('liClass'))
													$params['liClass'] = $xmlConfig->widgets->gedmo->params->navigation->liClass;
												else
													$params['liClass'] = "";
												
												if($xmlConfig->widgets->gedmo->params->navigation->get('counter'))
													$params['counter'] = $xmlConfig->widgets->gedmo->params->navigation->counter;
												else
													$params['counter'] = "";
												
												if($xmlConfig->widgets->gedmo->params->navigation->get('routeActifMenu'))
													$params['routeActifMenu'] = $xmlConfig->widgets->gedmo->params->navigation->routeActifMenu->toArray();
												
												if($xmlConfig->widgets->gedmo->params->navigation->get('lvlActifMenu'))
													$params['lvlActifMenu'] = $xmlConfig->widgets->gedmo->params->navigation->lvlActifMenu->toArray();
											}
											elseif($xmlConfig->widgets->gedmo->params->get('organigram')){											
												if($xmlConfig->widgets->gedmo->params->organigram->get('params'))
													$params = array_merge($params, $xmlConfig->widgets->gedmo->params->organigram->params->toArray());
											
												if($xmlConfig->widgets->gedmo->params->organigram->get('fields') && $xmlConfig->widgets->gedmo->params->organigram->fields->get('field'))
												{
													$params['fields'] = $xmlConfig->widgets->gedmo->params->organigram->fields->field->toArray();
												}
											}										
	
											// we sort an array by key in reverse order
											$this->container->get('pi_app_admin.array_manager')->recursive_method($params, 'krsort');
											// we create de Etag cache
											$params 	= $this->container->get('pi_app_admin.string_manager')->json_encodeDecToUTF8($params);
											$params		= $this->_Encode($params);
											$entity		= $this->_Encode($entity, false);
												
											$Etag_tree	= $widget->getAction() . ":$entity~$method~$category:$lang_page:$params";
											
											// we refresh the cache of the tree
											$this->cacheRefreshByname($Etag_tree);
										}
									} catch (\Exception $e) {
									}
								}
								
								// If the widget is a tree a "slider"
								if( ($widget->getPlugin() == 'gedmo') && ($widget->getAction() == 'slider') )	{
									
									$xmlConfig			= $widget->getConfigXml();
									
									// if the configXml field of the widget is configured correctly.
									try {
										$xmlConfig	= new \Zend_Config_Xml($xmlConfig);
										if($xmlConfig->widgets->get('gedmo') && $xmlConfig->widgets->gedmo->get('controller') && $xmlConfig->widgets->gedmo->get('params'))
										{
											$values 	= explode(':', $xmlConfig->widgets->gedmo->controller);
											$entity 	= $values[1];
											$method 	= strtolower($values[2]);
											$params		= array();
																					
											if($xmlConfig->widgets->gedmo->params->get('category'))
												$category = $xmlConfig->widgets->gedmo->params->category;
											else
												$category = "";
											
											if($xmlConfig->widgets->gedmo->params->get('template'))
												$template = $xmlConfig->widgets->gedmo->params->template;
											else
												$template = "";			
	
											$params = array();
											if($xmlConfig->widgets->gedmo->params->get('slider')){										
												
												$params = $xmlConfig->widgets->gedmo->params->slider->toArray();
												$params['entity'] 	 = $entity;
												$params['category']  = $category;
												$params['template']  = $template;
												
												if($xmlConfig->widgets->gedmo->params->get('cachable'))
													$params['cachable'] = $xmlConfig->widgets->gedmo->params->cachable;
												else
													$params['cachable'] = 'true';											
																							
												if($xmlConfig->widgets->gedmo->params->slider->get('params')){
													$params['params'] = $xmlConfig->widgets->gedmo->params->slider->params->toArray();
												}
												
												if(!isset($params['action']) || empty($params['action']))
													$params['action']   = 'renderDefault';
												if(!isset($params['menu']) || empty($params['menu']))
													$params['menu']     = 'entity';
											}
											
											// we sort an array by key in reverse order
											$this->container->get('pi_app_admin.array_manager')->recursive_method($params, 'krsort');
											// we create de Etag cache
											$params 	= $this->container->get('pi_app_admin.string_manager')->json_encodeDecToUTF8($params);	
											$params		= $this->_Encode($params);
											$entity		= $this->_Encode($entity, false);
											$Etag_slider = $widget->getAction() . ":$entity~$method~$category:$lang_page:$params";
											
											// we refresh the cache of the listener
											$this->cacheRefreshByname($Etag_slider);	
										}
									} catch (\Exception $e) {
									}							
								}						
								
								// we refresh the cache of the widget
								$this->cacheRefreshByname($Etag_widget);
							}
						}
					}
				}
				// we refresh the cache
				$this->cacheRefreshByname($name_page);
				
				//print_r('<br />');print_r('<br />');
			}
		}
		//exit;
	}
	
	/**
	 * Refresh the cache of all elements of a page (TranslationPages, widgets, translationWidgets)
	 *
	 * @param  string	$type		['page', 'block', 'widget']
	 * @param  string	$entity
	 * @return string				Returns the requested url.
	 * @access public
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-04-03
	 */
	public function getUrlByType($type, $entity = null)
	{
		$Url	= null;
		
		switch ($type) {
			case 'page':
				if(is_int($entity))
					$entity = $this->getPageById($entity);
			
				if($entity instanceof Page){
					$Url['edit'] 		= $this->container->get('router')->generate('admin_pagebytrans_edit', array('id' => $entity->getId(), 'NoLayout' => true));
				}
				
				$Url['new'] 		= $this->container->get('router')->generate('admin_pagebytrans_new', array('NoLayout' => true));
			
				break;			
			case 'block':
				if(is_int($entity))
					$entity = $this->getBlockById($entity);
				
				if($entity instanceof Block){				
					$Url['admin'] 	= $this->container->get('router')->generate('admin_blockbywidget_edit', array('id' => $entity->getId(), 'NoLayout' => true));
					$Url['import']	= $this->container->get('router')->generate('public_importmanagement_widget', array('id_block' => $entity->getId(), 'NoLayout' => true));
				}
				
				break;
			case 'widget':
				if(is_null($entity))
					$entity = $this->getCurrentWidget();
				
				if(is_int($entity))
					$entity	= $pageManager->getWidgetById($entity);
				
				if($entity instanceof Widget){
					$Url['move_up']		= $this->container->get('router')->generate('admin_widget_move_ajax', array('id' => $entity->getId(), 'type' => 'up'));
					$Url['move_down'] 	= $this->container->get('router')->generate('admin_widget_move_ajax', array('id' => $entity->getId(), 'type' => 'down'));
					$Url['delete']	 	= $this->container->get('router')->generate('admin_widget_delete_ajax', array('id' => $entity->getId()));
					$Url['admin'] 		= $this->container->get('router')->generate('admin_widget_edit', array('id' => $entity->getId(), 'NoLayout' => true));
					$Url['edit'] 		= $this->container->get('router')->generate('admin_homepage');
					$Url['import']		= $this->container->get('router')->generate('public_importmanagement_widget', array('id_widget' => $entity->getId(), 'NoLayout' => true));
					
					try {
						$xmlConfig	= $entity->getConfigXml();
						$xmlConfig	= new \Zend_Config_Xml($xmlConfig);
					
						////////////////// url management of gedmo snippet ///////////////////////////
						if( ($entity->getPlugin() == "gedmo") && $xmlConfig->widgets->get('gedmo') && $xmlConfig->widgets->gedmo->get('snippet') && $xmlConfig->widgets->gedmo->get('id') ){
							$id_snippet = $xmlConfig->widgets->gedmo->get('id');
							$is_snippet = $xmlConfig->widgets->gedmo->get('snippet');
							if($is_snippet && !empty($id_snippet)){
								$entity = $this->getWidgetById($id_snippet);
								$xmlConfig	= $entity->getConfigXml();
								$xmlConfig	= new \Zend_Config_Xml($xmlConfig);								
							}
						}
						
						////////////////// url management of all gedmo widget ///////////////////////////
						if( ($entity->getPlugin() == "gedmo") && $xmlConfig->widgets->get('gedmo') && $xmlConfig->widgets->gedmo->get('controller'))
						{
							$infos	 		= explode(':', $xmlConfig->widgets->gedmo->controller);
							$infos_entity	= strtolower(str_replace('\\\\', '\\', $infos[1]));
							$infos_method	= strtolower($infos[2]);
							$getAvailable 	= "getAvailable" . ucfirst(strtolower($entity->getAction()));
							
							try {
								$Lists	= \PiApp\AdminBundle\Util\PiWidget\PiGedmoManager::$getAvailable();
							} catch (\Exception $e) {
								$Lists = null;
							}
							
// 							if( $xmlConfig->widgets->gedmo->get('params') && $xmlConfig->widgets->gedmo->params->get('id') )
// 								$params['id']		= $xmlConfig->widgets->gedmo->params->id;
// 							if( $xmlConfig->widgets->gedmo->get('params') && $xmlConfig->widgets->gedmo->params->get('category') )
// 								$params['category']	= $xmlConfig->widgets->gedmo->params->category;

							$params['NoLayout']	= true;
							if( $xmlConfig->widgets->gedmo->get('params'))
								$params	= array_merge($xmlConfig->widgets->gedmo->params->toArray(), $params);							
							
							//if(isset($Lists[$infos_entity][$infos_method]['edit']))
							//	$Url['edit'] 		= $this->container->get('router')->generate($Lists[$infos_entity][$infos_method]['edit'], $params);
							
							if(isset($Lists[$infos_entity][$infos_method]) && is_array($Lists[$infos_entity][$infos_method])){
								foreach($Lists[$infos_entity][$infos_method] as $action => $route_name){
									$Url[$action]	= $this->container->get('router')->generate($route_name, $params);
								}
							}
						}
						
						////////////////// url management of translation content widget ///////////////////////////
						if( ($entity->getPlugin() == "content") && $xmlConfig->widgets->get('content') )
						{
							if( $xmlConfig->widgets->content->get('snippet') && $xmlConfig->widgets->content->get('id') ){
								$Url['edit'] 		= $this->container->get('router')->generate('admin_widget_edit', array('id' => $xmlConfig->widgets->content->get('id'), 'NoLayout' => true));
							}
						}
						
						////////////////// url management of all content widget ///////////////////////////
						if( ($entity->getPlugin() == "content") && $xmlConfig->widgets->get('content') && $xmlConfig->widgets->content->get('controller') )
						{
							$infos 			= $xmlConfig->widgets->content->controller;
							$getAvailable 	= "getAvailable" . ucfirst(strtolower($entity->getAction()));
							
							if($xmlConfig->widgets->content->get('params') && $xmlConfig->widgets->content->params->get('action'))
				    			$infos_method = $xmlConfig->widgets->content->params->action;
							
							try {
								$Lists	= \PiApp\AdminBundle\Util\PiWidget\PiContentManager::$getAvailable();
							} catch (\Exception $e) {
								$Lists = null;
							}
							
							$params['NoLayout']	= true;
							if( $xmlConfig->widgets->content->get('params'))
								$params	= array_merge($xmlConfig->widgets->content->params->toArray(), $params);						
							
							if(isset($Lists[$infos][$infos_method]) && is_array($Lists[$infos][$infos_method])){
								foreach($Lists[$infos][$infos_method] as $action => $route_name){
									$Url[$action]	= $this->container->get('router')->generate($route_name, $params);
								}
							}
						}						
						
					} catch (\Exception $e) {
					}
				}
				break;
		} // end switch
				
		return $Url;
	}	
	
	/**
	 * Return all urls of a page
	 * 
	 * @param  \PiApp\AdminBundle\Entity\Page
	 * @param  string	$type		['sql']
	 * @return array
	 * @access public
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-06-21
	 */
	public function getUrlByPage(\PiApp\AdminBundle\Entity\Page $page, $type = '')
	{		
		$urls = array();
		// we register all urls of the page
		foreach($page->getTranslations() as $key=>$translationPage){
			if($translationPage instanceof TranslationPage){
				$locale	= $translationPage->getLangCode()->getId();
				$url	= $page->getUrl();
				$slug	= $translationPage->getSlug();
				switch (true) {
					case ( !empty($url) && !empty($slug) ):
						$urls[$locale] = $url . "/" .$slug;
						break;
					case (!empty($url) && empty($slug)) :
						$urls[$locale] = $url;
						break;
					case (empty($url) && !empty($slug)) :
						$urls[$locale] = $slug;
						break;
					case (empty($url) && empty($slug)) :
						$urls[$locale] = "";
						break;
				}
				$urls[$locale] 	 = str_replace("//","/",$urls[$locale]);
				
				if($type == 'sql')
					$urls[$locale] 	 = str_replace("/","\\\\\\\\\/",$urls[$locale]);
			}
		}

		return $urls;
	}	
	
	/**
	 * Gets the best roles of many of roles.
	 *
	 * @param  array 	$ROLES
	 * @return array	the best roles of all roles.
	 * @access protected
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	protected function getBestRoles($ROLES)
	{
		if(is_null($ROLES))
			return null;
		
		// we get the map of all roles.
		$roleMap = $this->buildRoleMap();
	
		foreach($roleMap as $role => $heritage){
			if(in_array($role, $ROLES)){
				$intersect	= array_intersect($heritage, $ROLES);
				$ROLES		= array_diff($ROLES, $intersect);  // =  $ROLES_USER -  $intersect
			}
		}
		return $ROLES;
	}	
	
	/**
	 * Gets all heritage roles of many of roles.
	 *
	 * @param array 	$ROLES
	 * @return array	the best roles of all user roles.
	 * @access protected
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	protected function getAllHeritageByRoles($ROLES)
	{
		if(is_null($ROLES))
			return null;
		
		$results = array();
		
		// we get the map of all roles.
		$roleMap = $this->buildRoleMap();
		
		foreach($ROLES as $key => $role){
			if(isset($roleMap[$role]))
				$results = array_unique(array_merge($results, $roleMap[$role]));
		}
		
		return $results;
	}	

	/**
	 * Sets the map of all roles.
	 *
	 * @return array	role map
	 * @access protected
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	protected function buildRoleMap()
	{
		$hierarchy 	= $this->container->getParameter('security.role_hierarchy.roles');
		$map		= array();
		foreach ($hierarchy as $main => $roles) {
			$map[$main] = $roles;
			$visited = array();
			$additionalRoles = $roles;
			while ($role = array_shift($additionalRoles)) {
				if (!isset($hierarchy[$role])) {
					continue;
				}
	
				$visited[] = $role;
				$map[$main] = array_unique(array_merge($map[$main], $hierarchy[$role]));
				$additionalRoles = array_merge($additionalRoles, array_diff($hierarchy[$role], $visited));
			}
		}
		return $map;
	}	
}