<?php
/**
 * This file is part of the <User> project.
 *
 * @category   BootStrap_Manager
 * @package    Route
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-02-03
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\UserBundle\Manager;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RequestContext;

use BootStrap\UserBundle\Manager\AbstractFactory;
use BootStrap\UserBundle\Builder\RouteTranslatorFactoryInterface;

use BeSimple\I18nRoutingBundle\Routing\Generator\UrlGenerator;
use BeSimple\I18nRoutingBundle\Routing\I18nRoute;

use PiApp\AdminBundle\Entity\TranslationPage;
use PiApp\AdminBundle\Entity\Page;


/**
 * route factory.
 *
 * @category   BootStrap_Manager
 * @package    Route
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class RouteTranslatorFactory extends AbstractFactory implements RouteTranslatorFactoryInterface
{
	/**
	 * Constructor.
	 *
	 * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
	 */
	public function __construct(ContainerInterface $container)
	{
		parent::__construct($container);
	}
	
	/**
	 * Return the referer url translated to the locale value.
	 *
	 * @param string $langue
	 * @param array $options
	 * @return string the url translated to the locale value.
	 * @access public
	 *
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 * @since 2012-02-23
	 */
	public function getRefererRoute($langue = '', $options = null)
	{
		if($langue != '')	{
			// Record the language in session.
			$this->getContainer()->get('session')->setLocale($langue);
		}else{
			$langue = $this->getContainer()->get('session')->getLocale();
		}
		
		// It tries to redirect to the original page.
		$old_url_path 	= $this->getContainer()->get('request')->headers->get('referer');
		$old_url 	  	= str_replace($this->getContainer()->get('request')->getUriForPath(''), '', $old_url_path);
		
		$old_info = explode('?', $old_url);
		$data			= $this->getRouterTranslator()->match($old_info[0]);	
		
		try {
			$new_url 	= $this->getContainer()->get('router')->generate($data['_route'], array('locale' => $langue));
		} catch (\Exception $e) {
			$new_url    = $old_url_path;
		}
		
		if(empty($new_url) || ($new_url == "/")) {
			$new_url = $this->getContainer()->get('router')->generate('admin_homepage');
		}
		
		if(is_null($options)){
			return $new_url;
		}elseif(isset($options['result']) && !empty($options['result'])){
			if($options['result'] == 'match')
				return	$data;
		}
	}
	
	/**
	 * Return the original url translated to the locale value.
	 *
	 * @param string $langue
	 * @param array $options
	 * @return string the url translated to the locale value.
	 * @access public
	 *
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 * @since 2012-02-23
	 */
	public function getLocaleRoute($langue = '', $options = null)
	{
		if($langue == '')	{
			$langue = $this->getContainer()->get('session')->getLocale();
		}
	
		$data			= $this->getRouterTranslator()->match($this->getContainer()->get('request')->getPathInfo());
		try {
			$new_url 	= $this->getContainer()->get('router')->generate($data['_route'], array('locale' => $langue));
		} catch (\Exception $e) {
			$new_url    = $this->getContainer()->get('request')->getRequestUri();
		}
	
		if(empty($new_url) || ($new_url == "/")) {
			$new_url	= $this->getContainer()->get('router')->generate('admin_homepage');
		}
	
		if(is_null($options)){
			return $new_url;
		}elseif(isset($options['result']) && !empty($options['result'])){
			if($options['result'] == 'match')
				return	$data;
		}
	}	
	
	/**
	 * Return the original url translated to the locale value.
	 *
	 * @param string $route_name
	 * @param array	 $params
	 * @return string the url translated to the locale value.
	 * @access public
	 *
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 * @since 2012-04-11
	 */
	public function getRoute($route_name = null, $params = null)
	{
		if( !isset($params['locale']) || empty($params['locale']))	{
			$params['locale'] = $this->getContainer()->get('session')->getLocale();
		}
		
		if(is_null($route_name))	{
			$route_name = $this->getContainer()->get('request')->get('_route');
		}

		try {
			$new_url 	= $this->getContainer()->get('router')->generate($route_name, $params);
		} catch (\Exception $e) {
			unset($params['locale']);
			try {
				$new_url = $this->getContainer()->get('router')->generate($route_name, $params);
			} catch (\Exception $e) {
				try {
					$new_url = $this->getContainer()->get('router')->generate($route_name);
				} catch (\Exception $e) {
					$new_url = $this->getContainer()->get('router')->generate('home_page');
				}
			}			
		}
		
		return $new_url;
	}	
	
	/**
	 * Return the original url translated to the locale value.
	 *
	 * @param string $route_name
	 * @param array	 $params
	 * @return string the url translated to the locale value.
	 * @access public
	 *
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 * @since 2012-04-11
	 */
	public function getMatchParamOfRoute($param = null, $langue = '')
	{
		if($langue == '')	{
			$langue = $this->getContainer()->get('session')->getLocale();
		}
				
		if(isset($_GET[$param])  && !empty($_GET[$param]))
			$value = $_GET[$param];
		else
			$value = null;
		
		if(is_null($value)){
			try {
				// $slug	= $this->container->get('request')->getPathInfo();
				$match 	= $this->getLocaleRoute($langue, array('result' => 'match'));
				$value	= $match[$param];
			} catch (\Exception $e) {
				try {
					$match 	= $this->getRefererRoute($langue, array('result' => 'match'), false);
					$value	= $match[$param];
				} catch (\Exception $e) {
				}
			}
		}		
		return $value;		
	}	
	
	/**
	 * Add in the route collection all routes of all pages.
	 *
	 * @return \Symfony\Component\Routing\RouteCollection
	 * @access public
	 *
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 * @since 2012-02-27
	 */
	public function addAllRoutePageCollections()
	{
		$all_route_values = $this->getDoctrineRoute()->getAllRouteValues();
		
		if(is_null($all_route_values)){
			//exit;
			$this->parseRoutePages();
			$all_route_values = $this->getDoctrineRoute()->getAllRouteValues();
		}
		
		//print_r($all_route_values);exit;
		
		return $all_route_values;
	}	
	
	/**
	 * Parse all routes of all pages and add them in the database and in the cache.
	 *
	 * @return \Symfony\Component\Routing\RouteCollection
	 * @access public
	 *
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 * @since 2012-02-27
	 */	
	public function parseRoutePages()
	{
		$all_routes = array();
		$results	= $this->getDoctrineRoute()->getConnection()->fetchAll("SELECT id,route,locales FROM pi_routing");
		foreach($results as $key => $values){
			$all_routes[ $values['route'] ]['id'] 	   = $values['id'];
			$all_routes[ $values['route'] ]['locales'] = $values['locales'];
		}
		
		$all_pages 	= $this->getEntityManager()->getRepository('PiAppAdminBundle:Page')->getAllPageHtml()->getQuery()->getResult();
		foreach($all_pages as $key => $page){
			if( ($page instanceof Page) && $page->getEnabled() ){
				if( !$page->getTranslations()->isEmpty() ){					
					// we get the page manager
					$locales  		= $this->getContainer()->get('pi_app_admin.manager.page')->getUrlByPage($page);
					$route			= $page->getRouteName();
					
					$defaults		= array('_controller'=>'PiAppAdminBundle:Frontend:page');
					$requirements 	= array('_method'=>'get|post');
					
					if(isset($GLOBALS['ROUTE']['SLUGGABLE'][ $route ]) && !empty($GLOBALS['ROUTE']['SLUGGABLE'][ $route ])){
						$sluggable_field_search = $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['field_search'];						
						$requirements 			= array_merge(array($sluggable_field_search=>"(.*)"), $requirements);
					}					

// 					if (preg_match_all('#{(?P<var>(.*))}#sU', $page->getUrl(), $matches_vars)){
// 						foreach($matches_vars['var'] as $key => $var){
// 							$requirements	= array_merge(array($var=>"(.*)"), $requirements);
// 						}
// 					}
					
					if(isset($all_routes[ $route ]))
						$this->getDoctrineRoute()->addRoute($route, $all_routes[ $route ], $locales, $defaults, $requirements);
					else
						$this->getDoctrineRoute()->addRoute($route, null, $locales, $defaults, $requirements);
					
				}
			}
		}
	}	
	
	/**
	 *
	 * <code>
	 *  $names = 'page_metiers_conseil_marketing_strategie';
	 *  $locales =  array(
     *              'en' => '/business/consulting',
     *              'fr' => '/business/conseil',
     *           );
     *  $defaults = array('_controller' => 'PiAppAdminBundle:Frontend:page');
     *  $requirements = array('_method' => 'get|post');
	 * <code>
	 *
	 * @param string  $name         The route name
	 * @param array   $locales      An array with keys locales and values patterns
	 * @param array   $defaults     An array of default parameter values
	 * @param array   $requirements An array of requirements for parameters (regexes)
	 * @param array   $options      An array of options
	 * @return \BeSimple\I18nRoutingBundle\Routing\Generator\UrlGenerator
	 * @access public
	 *
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 * @since 2012-02-23
	 */	
	public function getGenerate($name, array $locales, array $defaults = array(), array $requirements = array(), array $options = array())
	{
		$routeCollections 	= $this->addRouteCollections($name, $locales, $defaults, $requirements, $options);
		return	$this->getGenerator($routeCollections);
	
// 		foreach ($locales as $locale => $pattern) {
// 			$this->assertEquals($pattern, $generator->generateI18n($name, $locale));
// 		}
	}	

	/**
	 *
	 * @param \Symfony\Component\Routing\RouteCollection $collection
	 * @return \BeSimple\I18nRoutingBundle\Routing\Generator\UrlGenerator
	 * @access public
	 *
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 * @since 2012-02-23
	 */	
	public function getGenerator(RouteCollection $collection = null)
	{
		$collection = $collection ?: $this->getCollection();
	
		return new UrlGenerator($collection, new RequestContext());
	}
	
	/**
	 * Gets a new RouteCollection instance.
	 *
	 * @return \Symfony\Component\Routing\RouteCollection
	 * @access public
	 *
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 * @since 2012-02-23
	 */	
	private function getCollection()
	{
		return new RouteCollection();
	}
	
	/**
	 * Add in RouteCollection.
	 *
	 * <code>
	 *  $names = 'public_homepage';
	 *  $locales =  array(
     *              'en' => '/welcome',
     *              'fr' => '/bienvenue',
     *              'de' => '/willkommen',
     *           ),
	 * <code>
	 * 
	 * @param string  $name         The route name
	 * @param array   $locales      An array with keys locales and values patterns
	 * @param array   $defaults     An array of default parameter values
	 * @param array   $requirements An array of requirements for parameters (regexes)
	 * @param array   $options      An array of options
	 * 
	 * @return \Symfony\Component\Routing\RouteCollection
	 * @access private
	 * 
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 * @since 2012-02-23
	 */	
	private function addRouteCollections($name, array $locales, array $defaults = array(), array $requirements = array(), array $options = array())
	{
		$I18Route =  new I18nRoute($name, $locales, $defaults, $requirements, $options);
		return $I18Route->getCollection();
	}	
}