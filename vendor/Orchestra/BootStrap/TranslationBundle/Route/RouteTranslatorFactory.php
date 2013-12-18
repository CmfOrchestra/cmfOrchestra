<?php
/**
 * This file is part of the <Translation> project.
 *
 * @category   BootStrap_Manager
 * @package    Route
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-02-03
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\TranslationBundle\Route;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RequestContext;

use BootStrap\TranslationBundle\Route\AbstractFactory;
use BootStrap\TranslationBundle\Builder\RouteTranslatorFactoryInterface;

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
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
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
     * Return the referer url translated to the locale value and record the language in session..
     * 
	 * <code>
	 *     $match = $this->container->get('bootstrap.RouteTranslator.factory')->getRefererRoute($this->container->get('session')->getLocale(), array('result' => 'match'));
	 *     $url   = $this->container->get('bootstrap.RouteTranslator.factory')->getRefererRoute($this->container->get('session')->getLocale());
	 * </code>
	 * 
     * @param string $langue
     * @param array $options
     * @return string the url translated to the locale value.
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-23
     */
    public function getRefererRoute($langue = '', $options = null, $setLocale = false)
    {
        $request = $this->getContainer()->get('request');
		//        
        if ($langue == '')    {
            $langue = $request->getLocale();
        }
        if ($setLocale)    {
        	// Record the language
        	$request->setLocale('_locale', $langue);
        }        
        // It tries to redirect to the original page.
        $old_url_path     = $request->headers->get('referer');
        $old_url           = str_replace($request->getUriForPath(''), '', $old_url_path);
        
        $old_info = explode('?', $old_url);
        $data            = $this->getRouterTranslator()->match($old_info[0]);    
        
        try {
            $new_url     = $this->getContainer()->get('router')->generate($data['_route'], array('locale' => $langue));
        } catch (\Exception $e) {
            $new_url    = $old_url_path;
        }
        
        if (empty($new_url) || ($new_url == "/")) {
            $new_url = $this->getContainer()->get('router')->generate('home_page');
        }
        
    	if (isset($options['result']) && ($options['result'] == 'match')) {
			return	$data;
		} else {
		    return $new_url;
		}
    }
    
    /**
     * Return the current url translated to the locale value.
     * 
	 * <code>
	 *     $match	= $this->container->get('bootstrap.RouteTranslator.factory')->getLocaleRoute($this->container->get('session')->getLocale(), array('result' => 'match'));
	 *     $url    	= $this->container->get('bootstrap.RouteTranslator.factory')->getLocaleRoute($this->container->get('session')->getLocale(), array('result' => 'string'));
	 * </code> 
     * 
     * @param string $langue
     * @param array $options
     * @return string the url translated to the locale value.
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-23
     */
    public function getLocaleRoute($langue = '', $options = null)
    {
        if ($langue == '')    {
            $langue = $this->getContainer()->get('request')->getLocale();
        }
    
        $data            = $this->getRouterTranslator()->match($this->getContainer()->get('request')->getPathInfo());
        try {
            $new_url     = $this->getContainer()->get('router')->generate($data['_route'], array('locale' => $langue));
        } catch (\Exception $e) {
            $new_url    = $this->getContainer()->get('request')->getRequestUri();
        }
    
        if (empty($new_url) || ($new_url == "/")) {
            $new_url    = $this->getContainer()->get('router')->generate('home_page');
        }
    
        if (isset($options['result']) && ($options['result'] == 'match')) {
			return	$data;
		} else {
		    return $new_url;
		}
    }    
    
    /**
	 * Return the url translated by route name to the locale value.
	 * 
	 * <code>
	 *     $url		= $this->container->get('bootstrap.RouteTranslator.factory')->getRoute("page_lamelee_connexion", array('locale'=> $this->container->get('session')->getLocale()));
	 * </code>
     *
     * @param string $route_name
     * @param array     $params
     * @return string the url translated to the locale value.
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-04-11
     */
    public function getRoute($route_name = null, $params = null)
    {
        if ( !isset($params['locale']) || empty($params['locale']))    {
            $params['locale'] = $this->getContainer()->get('request')->getLocale();
        }
        
        if (is_null($route_name))    {
            $route_name = $this->getContainer()->get('request')->get('_route');
        }

        try {
            $new_url     = $this->getContainer()->get('router')->generate($route_name, $params);
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
	 * Return the value of the parameter of the current or the referer url.
	 * 
	 * <code>
	 *     $slug = $this->container->get('bootstrap.RouteTranslator.factory')->getMatchParamOfRoute('slug', $this->container->get('session')->getLocale(), 0);
	 *     $route = $this->container->get('bootstrap.RouteTranslator.factory')->getMatchParamOfRoute('_route', $this->container->get('session')->getLocale(), 1); 
	 * </code>
	 * 
	 * @param array	 $params
	 * @param string $langue
	 * @param boolean $isGetReferer
     * @return string the url translated to the locale value.
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-04-11
     */
    public function getMatchParamOfRoute($param = null, $langue = '', $isGetReferer = false)
    {
        if ($langue == '')    {
            $langue = $this->getContainer()->get('request')->getLocale();
        }
                
        if (isset($_GET[$param])  && !empty($_GET[$param]))
            $value = $_GET[$param];
        else
            $value = null;
        
        if (is_null($value)){

            if ($isGetReferer){            
                try {
                        $match     = $this->getRefererRoute($langue, array('result' => 'match'), false);
                        $value    = $match[$param];
                } catch (\Exception $e) {}
            } else {
                try {
                    // $slug    = $this->container->get('request')->getPathInfo();
                    $match     = $this->getLocaleRoute($langue, array('result' => 'match'));
                    $value    = $match[$param];
                } catch (\Exception $e) {}                
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
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-27
     */
    public function addAllRoutePageCollections()
    {
        $all_route_values = $this->getDoctrineRoute()->getAllRouteValues();
        
        if (is_null($all_route_values)){
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
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-27
     */    
    public function parseRoutePages()
    {
        $all_routes = array();
        $results    = $this->getDoctrineRoute()->getConnection()->fetchAll("SELECT id,route,locales,defaults,requirements FROM pi_routing");
        foreach($results as $key => $values){
            $all_routes[ $values['route'] ]['id']                = $values['id'];
            $all_routes[ $values['route'] ]['locales']         = $values['locales'];
            $all_routes[ $values['route'] ]['defaults']        = $values['defaults'];
            $all_routes[ $values['route'] ]['requirements']    = $values['requirements'];
        }
        
        $all_pages     = $this->getEntityManager()->getRepository('PiAppAdminBundle:Page')->getAllPageHtml()->getQuery()->getResult();
        foreach($all_pages as $key => $page){
            if ( ($page instanceof Page) && $page->getEnabled() ){
                if ( !$page->getTranslations()->isEmpty() ){                    
                    // we get the page manager
                    $locales          = $this->getContainer()->get('pi_app_admin.manager.page')->getUrlByPage($page);
                    $route            = $page->getRouteName();
                    
                    if (!isset($all_routes[ $route ]) || empty($all_routes[ $route ]['defaults']))
                        $defaults        = array('_controller'=>'PiAppAdminBundle:Frontend:page');
                    else
                        $defaults        = json_decode($all_routes[ $route ]['defaults'], true);
                    
                    $requirements         = array('_method'=>'GET|POST');
                    
//                     if (isset($GLOBALS['ROUTE']['SLUGGABLE'][ $route ]) && !empty($GLOBALS['ROUTE']['SLUGGABLE'][ $route ])){
//                         $sluggable_field_search = $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['field_search'];                        
//                         $requirements             = array_merge(array($sluggable_field_search=>"(.*)"), $requirements);
//                     }                    

//                     if (preg_match_all('#{(?P<var>(.*))}#sU', $page->getUrl(), $matches_vars)){
//                         foreach($matches_vars['var'] as $key => $var){
//                             $requirements    = array_merge(array($var=>"(.*)"), $requirements);
//                         }
//                     }

                    if (isset($all_routes[ $route ])){
                        $this->getDoctrineRoute()->addRoute($route, $all_routes[ $route ], $locales, $defaults, $requirements);
//                        print_r($all_routes[ $route ]);print_r(' - ');print_r($requirements);
//                        print_r("<br />");
                    } else {
                        $this->getDoctrineRoute()->addRoute($route, null, $locales, $defaults, $requirements);
                    }
                    
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
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-23
     */    
    public function getGenerate($name, array $locales, array $defaults = array(), array $requirements = array(), array $options = array())
    {
        $routeCollections     = $this->addRouteCollections($name, $locales, $defaults, $requirements, $options);
        return    $this->getGenerator($routeCollections);
    
//         foreach ($locales as $locale => $pattern) {
//             $this->assertEquals($pattern, $generator->generateI18n($name, $locale));
//         }
    }    

    /**
     *
     * @param \Symfony\Component\Routing\RouteCollection $collection
     * @return \BeSimple\I18nRoutingBundle\Routing\Generator\UrlGenerator
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
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
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
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
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-23
     * 
     * // googd: 'home_page' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'PiApp\\AdminBundle\\Controller\\FrontendController::pageAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/',    ),  ),  4 =>   array (  ),),
     * // bad :  'home_page' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'PiApp\\AdminBundle\\Controller\\FrontendController::pageAction',  ),  2 =>   array (    '_method' => 'GET|POST',  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/',    ),  ),  4 =>   array (    0 =>     array (      0 => 'text',      1 => '1',    ),  ),),
     */    
    private function addRouteCollections($name, array $locales, array $defaults = array(), array $requirements = array(), array $options = array())
    {
        $I18Route =  new I18nRoute($name, $locales, $defaults, $requirements, $options);
        return $I18Route->getCollection();
    }
}