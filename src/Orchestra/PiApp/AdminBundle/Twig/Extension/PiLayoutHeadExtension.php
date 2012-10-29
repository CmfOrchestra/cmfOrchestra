<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Twig
 * @package    Extension_layoutHead 
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-01-11
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;

use PiApp\AdminBundle\Twig\TokenParser\StyleSheetsTokenParser;
use PiApp\AdminBundle\Twig\TokenParser\StyleSheetTokenParser;
use PiApp\AdminBundle\Twig\TokenParser\JavascriptsTokenParser;
use PiApp\AdminBundle\Twig\TokenParser\JavascriptTokenParser;

/**
 * stylesheet and javascript tags used in twig
 * This extension lets you save the CSS and JS files with tags.
 *
 * @category   Admin_Twig
 * @package    Extension_layoutHead 
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class PiLayoutHeadExtension extends \Twig_Extension
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;
     
    /**
     * Constructor.
     *
     * @param ContainerInterface $container The service container
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
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */    
    public function getName()
    {
    	return 'pi_app_admin';
    }    
    
    /**
     * Returns the token parsers
     *
     * <code>
     * 	{% stylesheet "/path/to/css/file" %} to add a css file
     *  {% stylesheets %} to render all css files
     * 	{% javascript "/path/to/css/file" %} to add a js file
     *  {% javascripts %} to render all js files
     * </code>
     *
     * @return string The extension name
     * @access public
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */    
    public function getTokenParsers()
    {
        return array(
            new StyleSheetTokenParser($this->getName()),
            new StyleSheetsTokenParser($this->getName()),
            new JavascriptTokenParser($this->getName()),
            new JavascriptsTokenParser($this->getName()),     		
        );
    }
    
    /**
     * Callbacks
     */
        
    /**
     * Add CSS file in the contener.
     *
     * @param string $file
     * @param string $order		['append', 'prepend']
     *
     * @return void
     * @access public
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */    
    public function addCssFile($file, $order = "append")
    {
        $css_files = ($this->container->has('css_files')) ? $this->container->get('css_files') : array();
        $is_order  = explode(':', $file);
        
        if(isset($is_order[1]) && !empty($is_order[1])){
        	if(in_array($is_order[1], array('append', 'prepend'))){
        		$file  = $is_order[0];
        		$order = $is_order[1];
        	}
        }
        
        // On empile l'élément à la fin du tableau
        if($order == "append")
        	array_push($css_files, $file);
        elseif($order == "prepend"){
        	array_unshift($css_files, $file);
        } 
        	
        // On dédoublonne le tableau
        $css_files = array_unique($css_files);
        
        $this->container->set('css_files', $css_files);
    }
    
    /**
     * Add JS file in the contener.
     *
     * @param string $file
     * @param string $order		['append', 'prepend']
     *
     * @return void
     * @access public
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function addJsFile($file, $order = "append")
    {
    	$js_files = ($this->container->has('js_files')) ? $this->container->get('js_files') : array();
    	
    	if(isset($is_order[1]) && !empty($is_order[1])){
    		if(in_array($is_order[1], array('append', 'prepend'))){
    			$file  = $is_order[0];
    			$order = $is_order[1];
    		}
    	}    	
    
    	// On empile l'élément à la fin du tableau
    	if($order == "append")
    		array_push($js_files, $file);
    	elseif($order == "prepend"){
    		array_unshift($js_files, $file);
    	}    	
    	
    	// On dédoublonne le tableau
    	$js_files = array_unique($js_files);
    
    	$this->container->set('js_files', $js_files);
    }    
    
    /**
     * Return all CSS files in the container in links.
     *
     * @param string $file
     *
     * @return string
     * @access public
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function renderLink()
    {
        if(!$this->container->has('css_files'))
            return ;
        
        $links = array();
        $all_stylesheets = array_reverse($this->container->get('css_files'));
        foreach($all_stylesheets as $stylesheet)
        {
            //$stylesheet = trim(str_replace('\\', '_', $stylesheet));
            //$stylesheet = trim(str_replace('/', '_', $stylesheet));
            //$stylesheet = trim(str_replace('.css', '__css', $stylesheet));
            
        	$stylesheet = trim($stylesheet);
        	
            if(empty($stylesheet)) 
            	continue;
            
            
            str_replace('http://', 'http', $stylesheet, $nb_http);
            str_replace('https://', 'https', $stylesheet, $nb_https);
            
            //$links[] = '<link type="text/css" rel="stylesheet" href="' . $this->container->get('router')->generate('public_head_file', array('file' => $stylesheet, 'filetype' => 'css')) . '" />';
			if($nb_http == 0)
            	$links[] = '	<link type="text/css" rel="stylesheet" href="' . $this->container->get('Request')->getBasePath() . '/' . $stylesheet.'" />';
			else
				$links[] = '	<link type="text/css" rel="stylesheet" href="' . $stylesheet.'" />';
        }
        
        return implode("\n", $links);
    }
    
    /**
     * Return all JS files in the container in links.
     *
     * @param string $file
     *
     * @return string
     * @access public
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */    
    public function renderScript()
    {
    	if(!$this->container->has('js_files'))
    		return ;
    
    	$scripts = array();
    	$all_javascripts = array_reverse($this->container->get('js_files'));
		foreach($all_javascripts as $javascript)
   		{
   			//$javascript = trim(str_replace('\\', '_', $javascript));
   			//$javascript = trim(str_replace('/', '_', $javascript));
   			//$javascript = trim(str_replace('.js', '__js', $javascript));
   			
   			$javascript = trim($javascript);

   			if(empty($javascript))
   				continue;

   			str_replace('http://', 'http', $javascript, $nb_http);
   			str_replace('https://', 'https', $javascript, $nb_https);
   			
   			//$scripts[] = '<script type="text/javascript" src="' . $this->container->get('router')->generate('public_head_file', array('file' => $javascript)) . '" ></script>';
   			if($nb_http == 0)
   				$scripts[] = '	<script type="text/javascript" src="' . $this->container->get('Request')->getBasePath() . '/' . $javascript.'" ></script>';
   			else
   				$scripts[] = '	<script type="text/javascript" src="' . $javascript.'" ></script>';
   		}
    
    	return implode("\n", $scripts);
    
    }    

}