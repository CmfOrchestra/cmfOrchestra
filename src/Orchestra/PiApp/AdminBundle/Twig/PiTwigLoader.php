<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Twig
 * @package    Loader
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-01-03
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Twig;

use PiApp\AdminBundle\Builder\PiPageManagerBuilderInterface;
use PiApp\AdminBundle\Builder\PiWidgetManagerBuilderInterface;
use PiApp\AdminBundle\Builder\PiTransWidgetManagerBuilderInterface;
use PiApp\AdminBundle\Builder\PiTreeManagerBuilderInterface;
use PiApp\AdminBundle\Builder\PiListenerManagerBuilderInterface;
use PiApp\AdminBundle\Builder\PiSliderManagerBuilderInterface;
use PiApp\AdminBundle\Builder\PiJqextManagerBuilderInterface;
use PiApp\AdminBundle\Builder\PiSearchLuceneManagerBuilderInterface;

/**
 * Loads a template from a repository.
 *
 * @category   Admin_Twig
 * @package    Loader
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class PiTwigLoader implements \Twig_LoaderInterface
{
    /**
     * @var \PiApp\AdminBundle\Manager\PiPageManager
     */
    protected $page_manager = null;
    
    /**
     * @var \PiApp\AdminBundle\Manager\PiWidgetManager
     */
    protected $widget_manager = null;    

    /**
     * @var Twig_LoaderInterface
     */
    protected $fallback_loader = null;

    /**
     * Constructor.
     * 
     * @param RepositoryBuilderInterface $content_repository
     * @param Twig_LoaderInterface $fallback_loader
     */
    public function __construct(
    			PiPageManagerBuilderInterface $page_manager, 
    			PiWidgetManagerBuilderInterface $widget_manager, 
    			PiTransWidgetManagerBuilderInterface $transwidget_manager, 
    			PiTreeManagerBuilderInterface $tree_manager,
    			PiListenerManagerBuilderInterface $listener_manager,
    			PiSliderManagerBuilderInterface $slider_manager,
    			PiJqextManagerBuilderInterface $jqext_manager,
    			PiSearchLuceneManagerBuilderInterface $searchlucene_manager,
    			\Twig_LoaderInterface $loader = null)
    {
        $this->page_manager			= $page_manager;
        $this->widget_manager		= $widget_manager;
        $this->transwidget_manager 	= $transwidget_manager;
        $this->tree_manager			= $tree_manager;
        $this->listener_manager		= $listener_manager;
        $this->slider_manager		= $slider_manager;
        $this->jqext_manager		= $jqext_manager;
        $this->searchlucene_manager	= $searchlucene_manager;
        $this->loader				= $loader;
    }

    /**
     * Gets the source code of a translation page.
     *
     * @param  string $RenderResponseParam The param of the page/layout/widget to load
     *
     * @return string The template source code
     */
    public function getSource($name)
    {
        $parsed_info = $this->page_manager->parseTemplateParam($name) ; //self::parseName($idPage);
        
        if ($parsed_info === false)
            return $this->loader->getSource($name);
        else
            list($type, $id, $lang, $params) = $parsed_info;
        
        if(!empty($id) && ($type == 'page')){
        	$source = $this->page_manager->renderSource($id, $lang, $params);
        }elseif(!empty($id) && ($type == 'widget')){
        	$source = $this->widget_manager->renderSource($id, $lang, $params);
        }elseif(!empty($id) && ($type == 'transwidget')){
        	$source = $this->transwidget_manager->renderSource($id, $lang, $params);
        }elseif(!empty($id) && (in_array($type,array('navigation', 'organigram')))){
        	$source = $this->tree_manager->renderSource($id, $lang, $params);
        }elseif(!empty($id) && ($type == 'listener')){
        	$source = $this->listener_manager->renderSource($id, $lang, $params);
        }elseif(!empty($id) && ($type == 'slider')){
        	$source = $this->slider_manager->renderSource($id, $lang, $params);
        }elseif(!empty($id) && ($type == 'jqext')){
        	$source = $this->jqext_manager->renderSource($id, $lang, $params);
        }elseif(!empty($id) && ($type == 'lucene')){
        	$source = $this->searchlucene_manager->renderSource($id, $lang, $params);
        }
        
        // Check source
        if (!$source)
            //throw new \Twig_Error_Loader('Id "'.$id.'" not found in the database for type: '.$type);
        	return '';
		else
			return $source;
    }
    
    /**
     * Gets the cache key to use for the cache for a given template name.
     *
     * @param  string $name The name of the template to load
     *
     * @return string The cache key
     */
    public function getCacheKey($name)
    {
        if ($this->page_manager->parseTemplateParam($name) === false) {
            return $this->loader->getCacheKey($name);
        }
        return $name;
    }

    /**
     * Returns true if the template is still fresh.
     *
     * @param string    $name The template name
     * @param timestamp $time The last modification time of the cached template
     */
    public function isFresh($name, $time)
    {
        if ($this->page_manager->parseTemplateParam($name) === false) {
            return $this->loader->isFresh($name, $time);
        }
        return true; // isFresh is handled by cache invalidation
    }
}
