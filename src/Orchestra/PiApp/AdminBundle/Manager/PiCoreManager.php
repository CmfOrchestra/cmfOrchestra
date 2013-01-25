<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Managers
 * @package    Page
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-23
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Manager;

use Symfony\Component\Locale\Locale;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

use PiApp\AdminBundle\Builder\PiCoreManagerBuilderInterface;
use PiApp\AdminBundle\Manager\PiCoreManager;
use PiApp\AdminBundle\Entity\Page;
use PiApp\AdminBundle\Entity\TranslationPage;
use PiApp\AdminBundle\Entity\Widget;
use PiApp\AdminBundle\Entity\TranslationWidget;

/**
 * Description of the Page manager
 *
 * @category   Admin_Managers
 * @package    Page
 * @abstract
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
abstract class PiCoreManager implements PiCoreManagerBuilderInterface 
{  
	/**
	 * @var array
	 * @static
	 */
	static $types = array('page', 'widget', 'transwidget', 'listener', 'navigation', 'organigram', 'slider', 'jqext', 'lucene');
	
	/**
	 * @var array
	 * @static
	 */
	static $global_blocks = array('global_script_js', 'global_script_css', 'global_script_divers', 'global_title', 'global_meta', 'title', 'global_layout', 'global_flashes');
	
	/**
	 * @var array
	 * @static
	 */
	static $scriptType = array('js', 'css', 'init');	

	/**
	 * @var array
	 */
	protected $script = array();	
		
	/**
	 * @var array of \PiApp\AdminBundle\Entity\Page
	 */
	protected $pages 		= array();
	
	/**
	 * @var \PiApp\AdminBundle\Entity\TransaltionPage
	 */
	protected $translations;
	
	/**
	 * @var \PiApp\AdminBundle\Entity\TranslationWidget
	 */
	protected $translationsWidget;	
	
	/**
	 * @var array of \PiApp\AdminBundle\Entity\Block
	 */
	protected $blocks 		= array();
	
	/**
	 * @var array of \PiApp\AdminBundle\Entity\Widget
	 */
	protected $widgets 		= array();
	
	/**
	 * @var array of \Symfony\Component\HttpFoundation\Response
	 */
	protected $responses;	
	
	/**
	 * @var \PiApp\AdminBundle\Entity\Page
	 */
	protected $currentPage;
	
	/**
	 * @var \PiApp\AdminBundle\Entity\Widget
	 */	
	protected $currentWidget;
	
	/**
	 * @var \PiApp\AdminBundle\Entity\TranslationWidget
	 */	
	protected $currentTransWidget;
	
	/**
	 * @var \PiApp\AdminBundle\Twig\Extension\PiWidgetExtension
	 */	
	protected $extensionWidget;
	
	/**
	 * @var \Symfony\Component\DependencyInjection\ContainerInterface
	 */
	protected $container;

	/**
	 * @var RepositoryBuilderInterface
	 */	
	protected $repository;
	
	/**
	 * @var \Symfony\Component\Locale\Locale 
	 */	
	protected $language;
	
	/**
	 * @var string
	 */
	protected $Etag = "";	
	
	/**
	 * Constructor.
	 *
	 * @param ContainerInterface $container The service container
	 */
	public function __construct(ContainerInterface $container)
	{
		$this->container 		= $container;
		$this->language			= $this->container->get('session')->getLocale();
		$this->extensionWidget  = $this->container->get('pi_app_admin.twig.extension.widget');
		
		$this->script['js'] 	= array();
		$this->script['css'] 	= array();
		$this->script['init'] 	= array();
	}
	
	/**
	 * Cretae the Etag and returns the render source it.
	 *
	 * @param string	$tag
	 * @param string	$id
	 * @param string	$lang
	 * @param array		$params
	 *
	 * @return string	translation widget content
	 * @access	public
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-04-19
	 */
	public function run($tag, $id, $lang, $params = null)
	{
		// We cretae and set the Etag value
		if(!is_null($params)){
			// we sort an array by key in reverse order
			krsort($params);
			$params		= $this->paramsEncode($params);
			$id			= $this->_Encode($id, false);
			$this->setEtag("$tag:$id:$lang:$params");
			
			//print_r($this->Etag);
		}else
			$this->setEtag("$tag:$id:$lang");
		
		// we return the render (cache or not)
		return $this->render($lang);
	}

	protected function paramsEncode($params){
		$string	= json_encode($params);
		return $this->_Encode($string);	
	}


	protected function _Encode($string, $complet = true){
		$string = str_replace('\\\\', '\\', $string);
		if($complet)
			$string = str_replace('\\', "@@", $string);
		return str_replace(':', '#', $string);
	}
		
	protected function paramsDecode($params){
		$params	= $this->_Decode($params);	
		$params = json_decode($params, true);
		
		if(is_array($params))
			$this->container->get('pi_app_admin.array_manager')->recursive_method($params, 'krsort');
		
		return $params;
	}
	
	protected function _Decode($string){
		$string = str_replace("@@", '\\', $string);
		$string = str_replace('\\\\', '\\', $string);
		$string = str_replace('#', ':', $string);
		$string	= str_replace("$$$", "&", $string);
		return $string;
	}
		
	protected function recursive_map(array &$array, $curlevel=0) {
		foreach ($array as $k=>$v) {
			if (is_array($v)) {
				$this->recursive_map($v, $curlevel+1);
			} else {
				$v = str_replace("@@@@", '\\', $v);
				$v = str_replace("@@", '\\', $v);
				$v = str_replace('\\\\', '\\', $v);
				$v = str_replace("$$$", "&", $v);
				$array[$k] =  mb_convert_encoding($v, "UTF-8", "HTML-ENTITIES");
			}
		}
	}	
	
	/**
	 * Sets Etag
	 *
	 * @return void
	 * @access protected
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-03-20
	 */
	protected function setEtag($Etag)
	{
		$this->Etag = $Etag;
	}	
	
	/**
	 * Call the render method by default.
	 *
	 * @param string $lang
	 * 
	 * @return string
	 * @access	public
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-04-18
	 */
	public function render($lang = ''){
		// 	Initialize response
		$response = $this->getResponseByIdAndType('default', $this->Etag);
		
		// Create a Response with a Last-Modified header.
		$response = $this->configureCache(null, $response);
		
		// Check that the Response is not modified for the given Request
		if ($response->isNotModified($this->container->get('request'))){
			// We set the reponse
			$this->setResponse($this->Etag, $response);
		
			// return the 304 Response immediately
			return $response;
		} else {
			// or render a template with the $response you've already started
			$response = $this->container->get('pi_app_admin.caching')->renderResponse($this->Etag, array(), $response);
		
			// We set the reponse
			$this->setResponse($this->Etag, $response);
		
			// we don't send the header but the content only.
			return $response->getContent();
		}		
	}
	
	/**
	 * Call the render source method of the child class called by service.
	 *
	 * @param string $id
	 * @param string $lang
	 * @param array	 $params
	 * 
	 * @return string
	 * @access	public
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-01-31
	 */
	public function renderSource($id, $lang = '', $params = null){}
	
	/**
	 * Configure the caching settings of the response
	 *
	 * @param object $object
	 * @param Response $response
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 * @access protected
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-01-05
	 */
	protected function configureCache($object, Response $response)
	{
		if(empty($this->Etag))
			throw new \InvalidArgumentException("you have to config the attibute Etag");
	
		if( !method_exists($object, 'getPublic') && method_exists($object, 'getWidget') )
			$object = $object->getWidget();
	
		// Allows proxies to cache the same content for different visitors.
		if(method_exists($object, 'getPublic') && $object->getPublic()) {
			$response->setPublic();
		}
	
		if(method_exists($object, 'getLifeTime') && $object->getLifeTime()) {
			$response->setSharedMaxAge($object->getLifeTime());
			$response->setMaxAge($object->getLifeTime());
		}
	
		// Returns a 304 "not modified" status, when the template has not changed since last visit.
		if (method_exists($object, 'getCacheable') &&  $object->getCacheable()) {
			$response->setLastModified($object->getUpdatedAt());
		}else{
			$response->setLastModified(new \DateTime());
		}
	
		//$response->setETag(md5($response->getContent()));
		$response->setETag($this->Etag);
	
		return $response;
	}
	
	/**
	 * Refresh the cache by name
	 *
	 * @param string $name	the name of the cache file.
	 * @return string
	 * @access public
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-04-03
	 */
	public function cacheRefreshByname($name)
	{
		$name = str_replace('\\\\', '\\', $name);
		
		// Delete the cache filename of the template.
		try {
			$this->container->get('pi_app_admin.caching')->invalidate($name);
		} catch (\Exception $e) {
		}
	
		// Loads and warms up a template by name.
		try {
			$this->container->get('pi_app_admin.caching')->warmup($name);
		} catch (\Exception $e) {
		}
	}	
		
	/**
	 * Sets the response to one tree.
	 *
	 * @param strgin $Etag
	 * @param \Symfony\Component\HttpFoundation\Response $response
	 *
	 * @return void
	 * @access private
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-04-19
	 */
	private function setResponse($Etag, Response $response)
	{
		$this->responses['default'][$Etag] = $response;
	}	
	
	/**
	 * Gets the container instance.
	 *
	 * @return \Symfony\Component\DependencyInjection\ContainerInterface
	 * @access public
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public function getContainer()
	{
		return $this->container;
	}	
	
	/**
	 * Returns the current page
	 *
	 * @return \PiApp\AdminBundle\Entity\Page
	 * @access public
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-01-23
	 */
	public function getCurrentPage()
	{
		return $this->currentPage;
	}
	
	/**
	 * Sets the current page.
	 * 
	 * @param null\PiApp\AdminBundle\Entity\Page $page
	 *
	 * @return void
	 * @access public
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-01-23
	 */
	public function setCurrentPage(Page $page = null)
	{
		$this->currentPage = $page;
	}

	/**
	 * Returns the current Widget
	 *
	 * @param int $id	id widget
	 * @return \PiApp\AdminBundle\Entity\Widget
	 * @access public
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-01-31
	 */
	public function getCurrentWidget()
	{
		return $this->currentWidget;
	}
	
	/**
	 * Sets the current Widget.
	 *
	 * @param null\PiApp\AdminBundle\Entity\Widget $widget
	 *
	 * @return void
	 * @access public
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-01-31
	 */
	public function setCurrentWidget(Widget $widget = null)
	{
		$this->currentWidget = $widget;
		
		// we set the widget.
		$this->setWidgetTranslations($widget);
	}	
	
	/**
	 * Returns the current Widget
	 *
	 * @return \PiApp\AdminBundle\Entity\TranslationWidget
	 * @access public
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-02-15
	 */
	public function getCurrentTransWidget()
	{
		return $this->currentTransWidget;
	}
	
	/**
	 * Sets the current Widget.
	 *
	 * @param null\PiApp\AdminBundle\Entity\TranslationWidget $transWidget
	 *
	 * @return void
	 * @access public
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-02-15
	 */
	public function setCurrentTransWidget(TranslationWidget $transWidget = null)
	{
		$this->currentTransWidget = $transWidget;
	}	
	
	/**
	 * Sets widget translations.
	 *
	 * @param \PiApp\AdminBundle\Entity\Widget $widget
	 *
	 * @return void
	 * @access protected
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-02-13
	 */
	protected function setWidgetTranslations(Widget $widgets){}
	
	/**
	 * Returns the page with this id.
	 *
	 * @param int	$idpage	id page
	 * @param bool	$isForce
	 * 
	 * @return \PiApp\AdminBundle\Entity\Page
	 * @access public
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-01-31
	 */
	public function getPageById($idpage, $isForce = false)
	{
		if(isset($this->pages[$idpage]) && !empty($this->pages[$idpage]))
			return $this->pages[$idpage];
		elseif($isForce){
			$page = $this->getRepository('Page')->findOneById($idpage);
			$this->setCurrentPage($page);
			return $page;
		}else
			return false;
		
	}	
	
	/**
	 * Returns the blocks of a page.
	 *
	 * @param int $idpage	id page
	 * 
	 * @return array of \PiApp\AdminBundle\Entity\Block
	 * @access public
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-01-23
	 */
	public function getBlocksByPageId($idpage)
	{
		if(isset($this->blocks[$idpage]) && !empty($this->blocks[$idpage]))
			return $this->blocks[$idpage];
		else
			return false;
	}
	
	/**
	 * Returns the widget with this id.
	 *
	 * @param int $idWidget	id widget
	 *
	 * @return \PiApp\AdminBundle\Entity\Widget
	 * @access public
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-01-31
	 */
	public function getWidgetById($idWidget)
	{
		if(isset($this->widgets[$idWidget]) && !empty($this->widgets[$idWidget]))
			return $this->widgets[$idWidget];
		else{
			$widget = $this->getRepository('Widget')->findOneById($idWidget);
			$this->setCurrentWidget($widget);
			return $widget;
		}
	}	
	
	/**
	 * Returns the block with this id.
	 *
	 * @param int $id	id block
	 *
	 * @return \PiApp\AdminBundle\Entity\Block
	 * @access public
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-05-09
	 */
	public function getBlockById($idBlock)
	{
		return $this->getRepository('Block')->findOneById($idBlock);
	}	
	
	/**
	 * Returns the translation of a page.
	 *
	 * @param int 		$idpage		id page
	 * @param string 	$lang
	 * 
	 * @return \PiApp\AdminBundle\Entity\TranslationPage
	 * @access public
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-01-23
	 */
	public function getTranslationByPageId($idpage, $lang = '')
	{
		if(isset($this->translations[$idpage]) && !empty($this->translations[$idpage])){
			if( !empty($lang) && isset($this->translations[$idpage][$lang]) && !empty($this->translations[$idpage][$lang]) ){
				$result 		= $this->translations[$idpage][$lang];
				$this->language = $lang;
			}elseif( !empty($this->language) && isset($this->translations[$idpage][$this->language]) && !empty($this->translations[$idpage][$this->language]) ){
				$result 		= $this->translations[$idpage][$this->language];
			}else{
				$result 		=  end($this->translations[$idpage]);
				if($result instanceof TranslationPage)
					$this->language = $result->getLangCode()->getId();
				else 
					$result = false;
			}
		}else
			$result = false;
		
		return $result;
	}
	
	/**
	 * Returns the translation of a widget.
	 *
	 * @param int 		$idwidget		id widget
	 * @param string 	$lang
	 *
	 * @return \PiApp\AdminBundle\Entity\TranslationWidget
	 * @access public
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-02-13
	 */
	public function getTranslationByWidgetId($idwidget, $lang = '')
	{
		// we set the langue
		if(empty($lang))	$lang = $this->language;
		
		if(isset($this->translationsWidget[$idwidget]) && !empty($this->translationsWidget[$idwidget])){
			if( !empty($lang) && isset($this->translationsWidget[$idwidget][$lang]) && !empty($this->translationsWidget[$idwidget][$lang]) )
				$result = $this->translationsWidget[$idwidget][$lang];
			elseif( !empty($this->language) && isset($this->translationsWidget[$idwidget][$this->language]) && !empty($this->translationsWidget[$idwidget][$this->language]) )
				$result = $this->translationsWidget[$idwidget][$this->language];
			else
				$result =  $this->translationsWidget[$idwidget];
		}else{
			$result = $this->getRepository('TranslationWidget')->getTranslationById($idwidget, $lang);
		}
		
		// we secure if the result is an array of translation object.
		if(is_array($result))
			$result = end($result);
		
		// Initialize Locale
		if($result instanceof TranslationWidget){
			$this->language = $result->getLangCode()->getId();
			// we set the result
			$this->setCurrentTransWidget($result);
		}		
		
		return $result;
	}	

	/**
	 * Returns the response given in param.
	 *
	 * @param string 	$type	values = ['layout', 'page', 'widget']
	 * @param int		$id		id of the type entity given in param
	 * 
	 * @return \Symfony\Component\HttpFoundation\Response
	 * @access public
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-01-31
	 */
	public function getResponseByIdAndType($type, $id)
	{
		if(isset($this->responses[$type][$id]) && !empty($this->responses[$type][$id]))
			return $this->responses[$type][$id];
		else
			return new Response();
	}	
	
	/**
	 * Returns the params given in the render response of the service template.
	 *
	 * @param string 	$RenderResponseParam
	 * 
	 * @return array
	 * @access public
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-01-31
	 */	
	public function parseTemplateParam($RenderResponseParam)
	{
		$name_parts = explode(':', $RenderResponseParam);
		if (count($name_parts) < 2)
			return false;
	
		$type = $name_parts[0];
		if (!in_array($type, self::$types))
			return false;
	
		$idPage = $name_parts[1];
		$lang	= $name_parts[2];
		
		if(isset($name_parts[3]) && !empty($name_parts[3]))
			$params = $name_parts[3];
		else
			$params = null;
	
		return array($type, $idPage, $lang, $params);
	}

	/**
	 * Returns the script due to the type. Return false if script argument is empty or script param doesn't exist.
	 *
	 * @param string $script
	 * @param string $type		= ['array', 'implode', 'collection']
	 * @return array
	 * @access public
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-02-16
	 */
	public function getScript($script, $type = 'string')
	{
		if (!in_array($script, self::$scriptType))
			return false;
	
		if($type == "implode")
			return implode("\n", array_unique($this->script[$script]));
		elseif($type == "array")
		return array_unique($this->script[$script]);
		else
			return false;
	}	
		
	/**
	 * Sets the repository service.
	 * 
	 * @return void
	 * @access protected
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-01-23
	 */
	protected function setRepository()
	{
		$this->repository = $this->container->get('pi_app_admin.repository');
	}
	
	/**
	 * Gets the repository service of the entity given in param.
	 * 
	 * @return ObjectRepository
	 * @access protected
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-01-23
	 */
	protected function getRepository($nameEntity = '')
	{
		if(empty($this->repository))
			$this->setRepository();
	
		if(!empty($nameEntity))
			return $this->repository->getRepository($nameEntity);
		else
			throw new \Doctrine\ORM\EntityNotFoundException();
	}
	
	/**
	 * Return the token object.
	 *
	 * @return \BootStrap\UserBundle\Entity\user
	 * @access protected
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	protected function getToken()
	{
		return  $this->container->get('security.context')->getToken();
	}

	/**
	 * Return if yes or no the user is anonymous token.
	 *
	 * @return boolean
	 * @access protected
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	protected function isAnonymousToken()
	{
		if ($this->getToken() instanceof \Symfony\Component\Security\Core\Authentication\Token\AnonymousToken)
			return true;
		else
			return false;
	}
	
	/**
	 * Return if yes or no the user is UsernamePassword token.
	 *
	 * @return boolean
	 * @access protected
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	protected function isUsernamePasswordToken()
	{
		if ($this->getToken() instanceof \Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken)
			return true;
		else
			return false;
	}	
	
	/**
	 * Return the user roles.
	 *
	 * @return array	user roles
	 * @access protected
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	protected function getUserRoles()
	{
		return $this->getToken()->getUser()->getRoles();
	}	
	
	/**
	 * Return if yes or no the widget given in param is supported.
	 *
	 * @param \PiApp\AdminBundle\Entity\Widget $widget
	 * 
	 * @return boolean
	 * @access protected
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	protected function isWidgetSupported(Widget $widget)
	{
		if(isset($GLOBALS['WIDGET'][strtoupper($widget->getPlugin())][strtolower($widget->getAction())]) )
			return true;
		else
			return false;
	}
	
	/**
	 * Sets the flash message.
	 *
	 * @param string $message
	 * @param string $type
	 *
	 * @return void
	 * @access protected
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	protected function setFlash($message, $type = "")
	{
		$this->container->get('session')->setFlash('notice', $message);
	
		if(!empty($type))
			$this->container->get('session')->setFlash($type, $message);
	}		
}