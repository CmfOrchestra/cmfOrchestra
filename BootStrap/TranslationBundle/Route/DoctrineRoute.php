<?php
/**
 * This file is part of the <Translation> project.
 *
 * @category   BootStrap_Manager
 * @package    Route
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-02-27
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\TranslationBundle\Route;

use BootStrap\TranslationBundle\Builder\DoctrineRouteInterface;
use Doctrine\Common\Cache\Cache;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\Schema;

/**
 * route cache management.
 *
 * @category   BootStrap_Manager
 * @package    Route
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class DoctrineRoute implements DoctrineRouteInterface
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    private $connection;

    /**
     *
     * @var \Doctrine\Common\Cache\Cache
     */
    private $cache;

    /**
     * Prime the cache when using {@see addRoute()} yes or no.
     *
     * @var bool
     */
    private $primeCache;    

    /**
     * Constructor.
     *
     * @param \Doctrine\DBAL\Connection
     * @param \Doctrine\Common\Cache\Cache
     * @param bool
     */    
    public function __construct(Connection $connection, Cache $cache, $primeCache = true)
    {
        $this->connection = $connection;
        $this->cache      = $cache;
        $this->primeCache = $primeCache;
    }

    /**
     * Gets the connection service
     *
     * @return \Doctrine\DBAL\Connection
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */
    public function getConnection()
    {
           return $this->connection;
    }   
    
    /**
     * Returns all route values of all pages which are saved in the doctrine cache.
     *
     * @return array
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-27
     */    
    public function getAllRouteValues()
    {
        $all_route_names    = $this->getAllRouteNames();
        
        if (is_null($all_route_names)){
            return null;
        } else {
            $routes = array();
            foreach($all_route_names as $key => $route){
                 $routes[] = $this->getRoute($route);
            }
            return $routes;
        }
    }
    
    /**
     * Returns all route names of all pages which are saved in the doctrine cache otherwise in the database.
     *
     * @return array
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-27
     */    
    public function getAllRouteNames()
    {
        $cache_all_routes    = $this->cache->fetch('pi_all_routes');
        
        if (!$cache_all_routes){
            return null;
        }else
            return $cache_all_routes;
    }    
    
    /**
     * Return all information of a route name which are save in the cache otherwise in the database.
     *
     * @param string  $route         The route name
     * @return array
     * @access public
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-27
     */
    public function getRoute($route)
    {
        // values can potentially be large, so we hash them and prevent collisions
        $hashKey         = sha1($route);
        $cacheKey        = "pi_route__" . $hashKey;
        $RouteValues     = $this->cache->fetch($cacheKey);
        if ($RouteValues && isset($RouteValues[$hashKey])) {
            //print_r($RouteValues[$hashKey]);exit;
            return $RouteValues[$hashKey];
        }

        $value = array();
        if ($RouteValues = $this->connection->fetchColumn("SELECT id FROM pi_routing WHERE route = ?", array($route))) {
            return $RouteValues;
        }else 
            return null;
    }

    /**
     * Translate using Doctrine DBAL and a cache layer around it.
     *
     * @param string  $route        The route name
     * @param array      $fieldEntity  All fields information
     * @param array   $locales      An array with keys locales and values patterns
     * @param array   $defaults     An array of default parameter values
     * @param array   $requirements An array of requirements for parameters (regexes)
     * @return void
     * @access public
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-27
     */ 
    public function addRoute($route, $fieldEntity, array $locales, array $defaults = array(), array $requirements = array())
    {
        if (is_array($fieldEntity)) {
            if ( ( $fieldEntity['locales'] != json_encode($locales) ) || ( $fieldEntity['requirements'] != json_encode($requirements) ) ) {
                
//                 print_r($fieldEntity['id']);print_r(' - ');
//                 print_r($route);print_r(' - ');               
//                 print_r($fieldEntity['locales']);print_r(' - ');
//                 print_r(json_encode($locales));print_r(' - ');
                
                $this->connection->update('pi_routing', array(
                    'locales'         => json_encode($locales),
                    'defaults'         => json_encode($defaults),
                    'requirements'     => json_encode($requirements),
                ), array('id' => $fieldEntity['id']));
                
                //print_r('<br />');
            }
        } else {
            $this->connection->insert('pi_routing', array(
                'route'          => $route,
                'locales'         => json_encode($locales),
                'defaults'         => json_encode($defaults),
                'requirements'     => json_encode($requirements),
            ));
            
            //print_r($route);
            //print_r('<br />');
        }
        
        // prime the cache!
        if ($this->primeCache) {
            $hashKey          = sha1($route);
            $cacheKey         = "pi_route__" . $hashKey;
            $RouteValues     = $this->cache->fetch($cacheKey);
            if (!$RouteValues) {
                $RouteValues = array();
            }
            $RouteValues[$hashKey]['route']         = $route;
            $RouteValues[$hashKey]['locales']         = $locales;
            $RouteValues[$hashKey]['defaults']         = $defaults;
            $RouteValues[$hashKey]['requirements']     = $requirements;
            $this->cache->save($cacheKey, $RouteValues);
            
            // we save the route name in the global cache values
            $cache_all_routes    = $this->cache->fetch('pi_all_routes');
            if (!$cache_all_routes) {
                $cache_all_routes = array();
            }
            $cache_all_routes[]    = $route;
            $this->cache->save('pi_all_routes', $cache_all_routes, 0);
        }
    }
}