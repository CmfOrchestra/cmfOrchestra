<?php
/**
 * This file is part of the <Admin> project.
 * 
 * @category   Admin_Twig
 * @package    Extension
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-11
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Routing Functions used in twig
 *
 * @category   Admin_Twig
 * @package    Extension
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiRouteExtension extends \Twig_Extension
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */    
    private $container;

    /**
     * Constructor.
     *
     * @param Containe service Manager
     */    
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    
    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function getName()
    {
    	return 'admin_route_extension';
    }    

    /**
     * Returns a list of functions to add to the existing list.
     *
	 * <code>
	 *  {{ media_url(id, 'default_small') }}
	 * </code>
	 * 
     * @return array An array of functions
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function getFunctions()
    {
        return array(
            'media_url'			=> new \Twig_Function_Method($this, 'getMediaUrlFunction'),
        	'path_url' 			=> new \Twig_Function_Method($this, 'getUrlByRouteFunction'),
        	'match_url' 		=> new \Twig_Function_Method($this, 'getMatchUrlFunction'),
        );
    }
    
    /**
     * Callbacks
     */    

    /**
     * Return the url of a media (and put the result in cache).
     *
     * @param string $id
     * @param string $format		["default_small", "default_big", "reference"]
     * @param string $cachable
     *
     * @return string
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */    
    public function getMediaUrlFunction($id, $format = "default_small", $cachable = true, $modifdate = false, $pattern = "media_")
    {
    	if ($modifdate)
    		$timestamp = $modifdate->getTimestamp();
    	else
    		$timestamp = 0;    	
    	
    	try {
    		if (!$cachable){
    			$url_public_media = $this->container->get('sonata.media.twig.extension')->path($id, $format);
    		} else {
    			$dossier = $this->container->getParameter("kernel.root_dir")."/cache/media/";
    			if (!is_dir($dossier)){
    				mkdir($dossier);
    			}
    			$this->container->get("pi_filecache")->getClient()->setPath($dossier);
    			if (!$this->container->get("pi_filecache")->get($format.$pattern.$id.'_'.$timestamp)){
    				$url_public_media = $this->container->get('sonata.media.twig.extension')->path($id, $format);
    				$this->container->get("pi_filecache")->set($format.$pattern.$id.'_'.$timestamp,$url_public_media);
    			} else {
    				$url_public_media = $this->container->get("pi_filecache")->get($format.$pattern.$id.'_'.$timestamp);
    			}    			 
    		}    		
    	} catch (\Exception $e) {
    		$url_public_media = "";
    	}
   		return $url_public_media;
    }
   
    
    /**
     * Return the url of a route, with or without a locale value
     *
     * @param string $routeName
     * @param string $params
     *
     * @return string
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function getUrlByRouteFunction($routeName, $params = null)
    {
    	try {
    		$url_route = $this->container->get('bootstrap.RouteTranslator.factory')->getRoute($routeName, $params);
    	} catch (\Exception $e) {
    		$url_route = "";
    	}
   		return $url_route;
    }
    
    /**
     * Return the url of a route, with or without a locale value
     *
     * @param string $pathInfo
     * @param string $params
     *
     * @return array
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function getMatchUrlFunction($pathInfo)
    {
    	try {
    		$match	= $this->container->get('be_simple_i18n_routing.router')->match($pathInfo);
    	} catch (\Exception $e) {
    		$match	= array();
    	}
   		return $match;
    }    
}