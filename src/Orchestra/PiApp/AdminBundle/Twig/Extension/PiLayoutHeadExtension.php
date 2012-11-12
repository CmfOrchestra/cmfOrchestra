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
     *  absolute path to YUI jar file.
     */    
    private $JAR_PATH;
    private $TEMP_FILES_DIR;
    private $options = array('type' => 'js',
    		'linebreak' => false,
    		'verbose' => false,
    		'nomunge' => false,
    		'semi' => false,
    		'nooptimize' => false);  
    private $files = array();
     
    /**
     * Constructor.
     *
     * @param ContainerInterface $container The service container
     */
    public function __construct(ContainerInterface $container)
    {
    	$this->container 		= $container;
    	$this->JAR_PATH 		= realpath($container->getParameter("kernel.root_dir") . "/Resources/java/yuicompressor-2.4.7.jar");
    	$this->TEMP_FILES_DIR 	= $container->getParameter("kernel.root_dir") . "/../web/yui";
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
     * Returns a list of functions to add to the existing list.
     *
     * <code>
     *  {{ link(label, path, array('style' = >'width:11px')) }}
     * </code>
     *
     * @return array An array of functions
     * @access public
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function getFunctions() {
    	return array(
    			'CMFstylesheetsFunc'		=> new \Twig_Function_Method($this, 'renderLink'),
    			'CMFjavascriptsFunc'		=> new \Twig_Function_Method($this, 'renderScript'),
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
     * @param string $compressor		['php', 'yui', 'file', 'array']
     *
     * @return string
     * @access public
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function renderLink($compressor = "yui")
    {
        if(!$this->container->has('css_files'))
            return ;
        
        $links 			 = array();
        $linksPath 		 = array();
        $this->files	 = array();
        
        $all_stylesheets = array_reverse($this->container->get('css_files'));
        foreach($all_stylesheets as $stylesheet)
        {
        	$stylesheet = trim($stylesheet);
        	
            if(empty($stylesheet)) 
            	continue;            
            
            str_replace('http://', 'http', $stylesheet, $nb_http);
            str_replace('https://', 'https', $stylesheet, $nb_https);
            
            //$links[] = '<link type="text/css" rel="stylesheet" href="' . $this->container->get('router')->generate('public_head_file', array('file' => $stylesheet, 'filetype' => 'css')) . '" />';
			if($nb_http == 0){
            	$links[] = '	<link type="text/css" rel="stylesheet" href="' . $this->container->get('Request')->getBasePath() . '/' . $stylesheet.'" />';
            	$this->files[] 	= $this->container->getParameter("kernel.root_dir") . '/../web/' . $stylesheet;
            	$linksPath[]	= $this->container->get('Request')->getBasePath() . '/' . $stylesheet;
			}else{
				$links[] = '	<link type="text/css" rel="stylesheet" href="' . $stylesheet.'" />';
				$this->files[]	= $stylesheet;
				$linksPath[]	= $stylesheet;
			}
        }
        
        if($compressor == 'file'){
        	return implode("\n", $links);
        }elseif($compressor == 'php'){
        	$this->options['type'] = "css";
        	//return '<link type="text/css" rel="stylesheet" href="/css/app_cache_yui_css_'.$this->compress("path", "php_css").'__css" />';
        	return '<link type="text/css" rel="stylesheet" href="/yui/css' . $this->container->get('Request')->getBasePath() . '/' . $this->compress("path", "php_css").'.css'.'" />';
   		}elseif($compressor == 'yui'){
        	$this->options['type'] = "css";
        	//return '<link type="text/css" rel="stylesheet" href="/css/app_cache_yui_css_'.$this->compress("path", "yui").'__css" />';
        	return '<link type="text/css" rel="stylesheet" href="/yui/css' . $this->container->get('Request')->getBasePath() . '/' . $this->compress("path", "yui").'.css'.'" />';
   		}elseif($compressor == 'array'){
        	return $linksPath;
   		}
    }
    
    /**
     * Return all JS files in the container in links.
     *
     * @param string $compressor		['php', 'yui', 'file', 'array']
     *
     * @return string
     * @access public
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */    
    public function renderScript($compressor = 'yui')
    {
    	if(!$this->container->has('js_files'))
    		return ;
    
    	$scripts 		 = array();
    	$linksPath 		 = array();
    	$this->files	 = array();
    	
    	$all_javascripts = array_reverse($this->container->get('js_files'));
		foreach($all_javascripts as $javascript)
   		{
   			$javascript = trim($javascript);

   			if(empty($javascript))
   				continue;

   			str_replace('http://', 'http', $javascript, $nb_http);
   			str_replace('https://', 'https', $javascript, $nb_https);
   			
   			//$scripts[] = '<script type="text/javascript" src="' . $this->container->get('router')->generate('public_head_file', array('file' => $javascript)) . '" ></script>';
   			if($nb_http == 0){
				$scripts[]  = '	<script type="text/javascript" src="' . $this->container->get('Request')->getBasePath() . '/' . $javascript.'" ></script>';
				$this->files[]	= $this->container->getParameter("kernel.root_dir") . '/../web/' . $javascript;
				$linksPath[]	= $this->container->get('Request')->getBasePath() . '/' . $javascript;
  			}else{
				$scripts[]  = '	<script type="text/javascript" src="' . $javascript.'" ></script>';
				$this->files[]	= $javascript;
				$linksPath[]	= $javascript;
   			}
   		}
   		
   		if($compressor == 'file'){
    		return implode("\n", $scripts);
   		}elseif($compressor == 'php'){
   			$this->options['type'] = "js";
   			//return '<script type="text/javascript" src="/js/app_cache_yui_js_'.$this->compress("path", "php_js").'__js" ></script>';
   			return '<script type="text/javascript" src="/yui/js' . $this->container->get('Request')->getBasePath() . '/' . $this->compress("path", "php_js").'.js'.'" ></script>';
   		}elseif($compressor == 'yui'){
   			$this->options['type'] = "js";
   			//return '<script type="text/javascript" src="/js/app_cache_yui_js_'.$this->compress("path", "yui").'__js" ></script>';
   			return '<script type="text/javascript" src="/yui/js' . $this->container->get('Request')->getBasePath() . '/' . $this->compress("path", "yui").'.js'.'" ></script>';
   		}elseif($compressor == 'array'){
        	return $linksPath;
   		}    
    }  

    /**
     * Executes the compression command in shell
     *
     * @param string $result			['path', 'content']
     * @param string $compressor		['yui', 'php_js', 'php_css']
     *
     * @return string	file path result
     * @access public
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */    
    private function compress($result = "path", $compressor = "yui")
    {    
    	// create the input
    	foreach ($this->files as $file) {    		
    		$basePath		= str_replace($this->container->getParameter("kernel.root_dir"). '/../web/', '', dirname($file));
    		
    		if(strtolower($this->options['type']) == "css"){
    			$content_file	= str_replace(array('url("', "url('", "')", '")'), array('url(', 'url(', ')', ')'), file_get_contents($file)) or die("Cannot read from uploaded file");
    			$this->string  .= str_replace(array('url('), array('url(../../'.$basePath.'/'), $content_file);
    		}else
    			$this->string  .=  file_get_contents($file) or die("Cannot read from uploaded file");
    	}    	
    	// create single file from all input
    	$input_hash = sha1($this->string);
    	// create path file
    	$nameFile	= strtolower($this->options['type']) . '/' . $input_hash . '.' . strtolower($this->options['type']);
    	$file 		= $this->TEMP_FILES_DIR . '/' . $nameFile;
    	
    	$is_refresh_css_js_cache_file = $this->container->getParameter("pi_app_admin.page.refresh_css_js_cache_file");
    	
    	// we compress the content
    	if( ($is_refresh_css_js_cache_file || !file_exists($file)) && $this->container->get('pi_app_admin.file_manager')->save($file, $this->string, 0777)){    	
    		switch (true) {
    			case ($compressor == "yui"):
    				// start with basic command
    				$cmd = "java -Xmx32m -jar " . escapeshellarg($this->JAR_PATH) . ' ' . escapeshellarg($file) . " --charset UTF-8";
    				
    				// set the file type
    				$cmd .= " --type " . (strtolower($this->options['type']) == "css" ? "css" : "js");
    				
    				// and add options as needed
    				if ($this->options['linebreak'] && intval($this->options['linebreak']) > 0) {
    					$cmd .= ' --line-break ' . intval($this->options['linebreak']);
    				}
    				
    				if ($this->options['verbose']) {
    					$cmd .= " -v";
    				}
    				
    				if ($this->options['nomunge']) {
    					$cmd .= ' --nomunge';
    				}
    				
    				if ($this->options['semi']) {
    					$cmd .= ' --preserve-semi';
    				}
    				
    				if ($this->options['nooptimize']) {
    					$cmd .= ' --disable-optimizations';
    				}
    				
    				// execute the command
    				exec($cmd . ' 2>&1', $raw_output);
    				
    				// add line breaks to show errors in an intelligible manner
    				$flattened_output = implode("\n", $raw_output);    		
    				// we put the compressor content in the file.
    				file_put_contents($file, $flattened_output);
    				// we initialize the content.
    				$this->string = "";
    				break;
    			case ($compressor == "php_js"):
    				$flattened_output = str_replace("/*\n", "\n\n /*\n", $this->string);
    				$flattened_output = str_replace("/*!\n", "\n\n /*!\n", $flattened_output);
    				// we put the compressor content in the file.
    				file_put_contents($file, $flattened_output);
    				// we initialize the content.
    				$this->string = "";
    				break;
    			case ($compressor == "php_css"):
    				// Remove comments
    				$flattened_output = $this->container->get('pi_app_admin.string_manager')->remove_comment_in_css_file($this->string);
    				// Remove space after colons
    				$flattened_output = str_replace(': ', ':', $flattened_output);
    				// Remove whitespace
    				$flattened_output = $this->container->get('pi_app_admin.string_manager')->cleanWhitespace($flattened_output);
    				// we put the compressor content in the file.
    				file_put_contents($file, $flattened_output);
    				// we initialize the content.
    				$this->string = "";
    				break;
    			default:
    				// use default
    				break;
    		}
    	}
    	
    	switch (true) {
    		case ($result == "content"):
    			return $flattened_output;
    		case ($result == "path"):
    			return $input_hash;
    		default:
    			return "";
    	}    	
    }    

}