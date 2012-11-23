<?php
/**
 * This file is part of the <User> project.
 *
 * @category   BootStrap_Manager
 * @package    Route
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-02-27
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\UserBundle\Manager\Route;

use Symfony\Component\DependencyInjection\ContainerInterface;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Loader\LoaderResolver;
use Symfony\Component\Routing\Matcher\Dumper\ApacheMatcherDumper;
use Symfony\Component\Config\ConfigCache;

/**
 * route cache management.
 *
 * @category   BootStrap_Manager
 * @package    Route
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class CacheRoute
{
	/**
	 * @var \Symfony\Component\DependencyInjection\ContainerInterface
	 */
	private $container;
	
	/**
	 * @var \Symfony\Component\Routing\RouteCollection
	 */
	private $collection;
	
	/**
	 * @var string
	 */	
	private $environment;
			
	/**
	 * @var array
	 */	
	private $options = array(
			'cache_dir'              => null,
			'generator_class'        => 'BeSimple\I18nRoutingBundle\Routing\Generator\UrlGenerator', // 'Symfony\\Component\\Routing\\Generator\\UrlGenerator',
			'generator_base_class'   => 'BeSimple\I18nRoutingBundle\Routing\Generator\UrlGenerator', // 'Symfony\\Component\\Routing\\Generator\\UrlGenerator',
			'generator_dumper_class' => 'Symfony\\Component\\Routing\\Generator\\Dumper\\PhpGeneratorDumper',
			'generator_cache_class'  => 'UrlGenerator',
			'matcher_class'          => 'Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher', // 'Symfony\\Component\\Routing\\Matcher\\UrlMatcher',
			'matcher_base_class'     => 'Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher', // 'Symfony\\Component\\Routing\\Matcher\\UrlMatcher',
			'matcher_dumper_class'   => 'Symfony\\Component\\Routing\\Matcher\\Dumper\\PhpMatcherDumper',
			'matcher_cache_class'    => 'UrlMatcher',
			'resource_type'          => null,
	);

    /**
	 * Constructor.
	 *
	 * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
	 * @param \PiApp\AdminBundle\Entity\Page $page
	 */
	public function __construct(ContainerInterface $container)
	{
        $this->container    		= $container;
        $this->options['cache_dir'] = $container->get("kernel")->getCacheDir();
        $this->environment			= $container->get("kernel")->getEnvironment();
        // we get all routes existed
        $this->collection			= $container->get('router')->getRouteCollection();
    }

    /**
     * Gets the UrlMatcher instance associated with this Router.
     *
     * @return UrlMatcherInterface A UrlMatcherInterface instance
     */
    public function setGenerator()
    {
    	$class 				= "app".$this->environment . $this->options['generator_cache_class'];
    	$this->file 		= realpath($this->options['cache_dir'].'/'.$class.'.php');
    	
    	$cache		= new ConfigCache($this->file, false);
    	//if (!$cache->isFresh($class)) {
	    	$dumper 	= new $this->options['generator_dumper_class']($this->collection);
	    
	    	$options 	= array(
	    			'class'      => $class,
	    			'base_class' => $this->options['generator_base_class'],
	    	);
	    	
	    	try {
	    		$cache->write($dumper->dump($options), $this->collection->getResources());
	    	} catch (\Exception $e) {
	    	}
    	//}
    }
    
    /**
     * Gets the UrlMatcher instance associated with this Router.
     *
     * @return UrlMatcherInterface A UrlMatcherInterface instance
     */
    public function setMatcher()
    {
    	$class		= "app".$this->environment . $this->options['matcher_cache_class'];
    	$this->file = $this->options['cache_dir'].'/'.$class.'.php';
    
    	$cache 		= new ConfigCache($this->file, false);  // //if (!$cache->isFresh($class))
    	//if (!$cache->isFresh($class)) {
	    	$dumper 	= new $this->options['matcher_dumper_class']($this->collection);
	    
	    	$options 	= array(
	    			'class'      => $class,
	    			'base_class' => $this->options['matcher_base_class'],
	    	);
	    	try {
	    		$cache->write($dumper->dump($options), $this->collection->getResources());
	    	} catch (\Exception $e) {
	    	}
    	//}
    }
    
   	/**
   	 * Checks if the cache is still fresh.
   	 *
   	 * This method always returns true when debug is off and the
   	 * cache file exists.
   	 *
   	 * @return Boolean true if the cache is fresh, false otherwise
 	 */
    private function isFresh()
    {
    	if (!file_exists($this->file)) {
    		return false;
    	}
    	
    	$metadata = $this->file.'.meta';
    	if (!file_exists($metadata)) {
    		return false;
    	}
    	
    	$time = filemtime($this->file);
    	$meta = unserialize(file_get_contents($metadata));
    	foreach ($meta as $resource) {
    		//$resource->isFresh($time) :: Returns true if the resource has not been updated since the given timestamp.
    		if (!$resource->isFresh($time)) {
    			return false;
    		}
    	}
    	return true;
    }    
}