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
use PiApp\AdminBundle\Exception\ExtensionException;

/**
 * Tool Filters and Functions used in twig
 *
 * @category   Admin_Twig
 * @package    Extension
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiToolExtension extends \Twig_Extension
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
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
	public function getName() {
		return 'admin_tool_extension';
	}
		
	/**
	 * Returns a list of filters to add to the existing list.
	 * 
	 * <code>
	 * 	{{ comment.content|html }}
	 *  {{ 'pi.page.translation.title'|trans|limite('0', 25) }}
	 *  {{ "%s Result"|translate_plural("%s Results", entitiesByMonth|count)}}
	 * </code> 
	 * 
	 * @return array An array of filters
	 * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */	
	public function getFilters() {
		return array(
				
				// default
				'php_funct'		=> new \Twig_Filter_Method($this, 'phpFilter'),
				
				// debug
				'dump' 			=> new \Twig_Filter_Method($this, 'dumpFilter'),
				'print_r' 		=> new \Twig_Filter_Method($this, 'print_rFilter'),
				'get_class' 	=> new \Twig_Filter_Method($this, 'get_classFilter'),
	
				// markup
				'nl2br' 		=> new \Twig_Filter_Method($this, 'nl2brFilter'),
				'join' 			=> new \Twig_Filter_Method($this, 'joinFilter'),
	
				// escape
				'htmlspecialchars' 	=> new \Twig_Filter_Method($this, 'htmlspecialcharsFilter'),
				'addslashes' 		=> new \Twig_Filter_Method($this, 'addslashesFilter'),
				'htmlentities'		=> new \Twig_Filter_Method($this, 'htmlentitiesFilter'),
				
				// text
				'substr'			=> new \Twig_Filter_Method($this, 'substrFilter'),
				'ucfirst'			=> new \Twig_Filter_Method($this, 'ucfirstFilter'),
				'ucwords'			=> new \Twig_Filter_Method($this, 'ucwordsFilter'),
				'sanitize'			=> new \Twig_Filter_Method($this, 'sanitizeFilter'),	
				'slugify'			=> new \Twig_Filter_Method($this, 'slugifyFilter'),

				'limite'			=> new \Twig_Filter_Method($this, 'limitecaractereFilter'),
				'splitText' 		=> new \Twig_Filter_Method($this, 'splitTextFilter'),
				'splitHtml' 		=> new \Twig_Filter_Method($this, 'splitHtmlFilter'),
				'truncateText'		=> new \Twig_Filter_Method($this, 'truncateFilter'),
				'cutText'			=> new \Twig_Filter_Method($this, 'cutTextFilter'),
				
				//array
				'count'				=> new \Twig_Filter_Method($this, 'countFilter'),
				'reset'				=> new \Twig_Filter_Method($this, 'resetFilter'),
				'steps'				=> new \Twig_Filter_Method($this, 'stepsFilter'),
				'sliceTab'			=> new \Twig_Filter_Method($this, 'arraysliceFilter'),
				'end'				=> new \Twig_Filter_Method($this, 'endFilter'),
				'XmlString2array'	=> new \Twig_Filter_Method($this, 'XmlString2arrayFilter'),
				
				//translation
				'translate_plural'	=> new \Twig_Filter_Method($this, 'translatepluralFilter'),
				'pluralize'			=> new \Twig_Filter_Method($this, 'pluralizeFilter'),
				'depluralize'		=> new \Twig_Filter_Method($this, 'depluralizeFilter'),
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
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public function getFunctions() {
		return array(
				'link' 						=> new \Twig_Function_Method($this, 'linkFunction'),
				'in_paths' 					=> new \Twig_Function_Method($this, 'inPathsFunction'),
				'get_img_flag_By_country' 	=> new \Twig_Function_Method($this, 'getImgFlagByCountryFunction'),
				'metas_page'				=> new \Twig_Function_Method($this, 'getMetaPageFunction'),
				'title_page'				=> new \Twig_Function_Method($this, 'getTitlePageFunction'),
				'picture_form'				=> new \Twig_Function_Method($this, 'getPictureFormFunction'),
				'file_form'					=> new \Twig_Function_Method($this, 'getFileFormFunction'),
				'get_pattern_by_local'		=> new \Twig_Function_Method($this, 'getDatePatternByLocalFunction'),				
		);
	}	
	
	/**
	 * Functions
	 */
	
	/**
	 * moving an image.
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public function getPictureFormFunction($media, $nameForm, $format = 'reference', $style = "display: block; text-align:center;margin: 30px auto;", $idImg = "") {
		if($media instanceof \BootStrap\MediaBundle\Entity\Media){
			$id 		= $media->getId();
			
			try {
				$img_balise = $this->container->get('sonata.media.twig.extension')->media($media, $format, array(
						'title'	=> $media->getAuthorname(),
						'alt'	=> $media->getAuthorname(),
						'style'	=> $style,
						'id'	=> $idImg,
				));
			} catch (\Exception $e) {
				return "";
			}			
			
			$content	 = "<div id='picture_{$id}_{$format}'> \n";
			$content	.= $img_balise;
			$content	.= "</div> \n";
			
			$content	.= "<script type='text/javascript'> \n";
			$content	.= "//<![CDATA[ \n";
			$content	.= "$('#picture_{$id}_{$format}').detach().appendTo('#{$nameForm}'); \n";
			$content	.= "//]]> \n";
			$content	.= "</script> \n";
			
			return $content;
		}
	}

	/**
	 * moving a file.
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public function getFileFormFunction($media, $nameForm, $style = "display: block; text-align:center;margin: 30px auto;z-index:99999999999", $is_by_mimetype = true) {
		if($media instanceof \BootStrap\MediaBundle\Entity\Media){
			$id 		= $media->getId();
				
			try {
					$file_url = $this->container->get('sonata.media.twig.extension')->path($id, "reference");
					
			        if($is_by_mimetype){
			           $mime = str_replace('/','-',$media->getContentType());
			           $picto = '/bundles/piappadmin/images/icons/mimetypes/'.$mime.'.png';
			        }else{
			            $ext = substr(strtolower(strrchr(basename($file_url), ".")), 1);  
			            $picto = '/bundles/piappadmin/images/icons/form/download-'.$ext.'.png';
			        }
			
			        if (!file_exists('.'.$picto)) {
			            $picto = '/bundles/piappadmin/images/icons/form/download-32.png';
			        }
			} catch (\Exception $e) {
				return "";
			}
				
			$content	 = "<div id='file_$id'> \n";
			$content	.= "<a href='{$file_url}' target='_blanc' style='{$style}'> <img src='$picto' /> ".$media->getName()."</a>";
			$content	.= "</div> \n";
				
			$content	.= "<script type='text/javascript'> \n";
			$content	.= "//<![CDATA[ \n";
			$content	.= "$('#file_$id').detach().appendTo('#{$nameForm}'); \n";
			$content	.= "//]]> \n";
			$content	.= "</script> \n";
				
			return $content;
		}
	}	
		
	/**
	 * Creating a link.
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */	
	public function linkFunction( $label, $path, $options = array() ) {
		$attributes = '';
		foreach( $options as $key=>$value )
			$attributes .= ' ' . $key . '="' . $value . '"';

		return '<a href="' . $path . '"' . $attributes . '>' . $label . '</a>';
	}
	
	/**
	 * Return the $returnTrue value if the route of the page is include in $paths value, else return the $returnFalse value.
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */	
	public function inPathsFunction($paths, $returnTrue = '', $returnFalse = '')
	{
		$route = (string) $this->container->get('request')->get('_route');
		$names = explode(':', $paths);
		$is_true = false;
		
		if(is_array($names)){
			foreach($names as $k => $path){
				if($route == $path)
					$is_true = true;
			}
			if($is_true)
				return $returnTrue;
			else
				return $returnFalse;			
		}else{
			if($route == $paths)
				return $returnTrue;
			else
				return $returnFalse;			
		}
	}	
	
	/**
	 * Return the image flag of a country.
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */	
	public function getImgFlagByCountryFunction($country, $type ="img", $taille="16")
	{
		$locale				= $this->container->get('session')->getLocale();
		$all_countries 		= $this->container->get('pi_app_admin.string_manager')->allCountries($locale);       
		$all_countries_en 	= $this->container->get('pi_app_admin.string_manager')->allCountries("en_GB");
		
        if(isset($all_countries[strtolower($country)])){
        	$img_country  = str_replace(' ', '-', $all_countries_en[strtolower($country)]) . "-Flag-".$taille.".png";
        	$name_country = $all_countries[strtolower($country)]; // locale_get_display_name(strtolower($entity->getCountry()), strtolower($locale))
        	$src		  = $this->container->getParameter('kernel.http_host') . "/bundles/piappadmin/images/flags/png/" . $img_country;
        }else{
        	$img_country  = "Default-Flag-".$taille.".png";
        	$name_country = $country;
        	$src		  = $this->container->getParameter('kernel.http_host') . "/bundles/piappadmin/images/flags/default/Default-flag-".$taille.".png";
        }


        if($type == "img_counry") return $img_country;
        elseif($type == "name_country") return $name_country;
        elseif($type == "balise") {
        	return "<img src='{$src}' alt='{$name_country} flag' title='{$name_country} flag'/>";
        }
        
	}	
	
	/**
	 * Return the meta title of a page.
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */	
	public function getTitlePageFunction($title)
	{
		if(empty($title))
			$title 	= $this->container->getParameter('pi_app_admin.layout.meta.title');
				
		try {
			$lang  		= $this->container->get('session')->getLocale();
			$pathInfo	= str_replace($this->container->get('request')->getUriForPath(''), '', $this->container->get('request')->getUri());
			$match		= $this->container->get('i18n_routing.router')->match($pathInfo);
			$route		= $match['_route'];
			
			if(isset($GLOBALS['ROUTE']['SLUGGABLE'][ $route ]) && !empty($GLOBALS['ROUTE']['SLUGGABLE'][ $route ])){
				$sluggable_entity 		= $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['entity'];
				$sluggable_field_search = $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['field_search'];
				$sluggable_title 		= $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['field_title'];
				$sluggable_resume 		= $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['field_resume'];
				$sluggable_keywords		= $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['field_keywords'];
				
				$sluggable_title_tab = array_map(function($value) {
					return ucwords($value);
				}, array_values(explode('_', $sluggable_title)));
				$sluggable_resume_tab = array_map(function($value) {
					return ucwords($value);
				}, array_values(explode('_', $sluggable_resume)));
				$sluggable_keywords_tab = array_map(function($value) {
					return ucwords($value);
				}, array_values(explode('_', $sluggable_keywords)));					
				
				$method_title	 	= "get".implode('', $sluggable_title_tab);
				$method_resume 		= "get".implode('', $sluggable_resume_tab);
				$method_keywords 	= "get".implode('', $sluggable_keywords_tab);				
				
				if( ($sluggable_field_search == 'id') && isset($match['id']) ){
					$entity 		= $this->container->get('doctrine')->getEntityManager()->getRepository($sluggable_entity)->findOneByEntity($lang, $match['id'], 'object');
					if(is_object($entity) && method_exists($entity, $method_title))
						$title = $entity->$method_title();
				}elseif(array_key_exists($sluggable_field_search, $match)){
					$result = $this->container->get('doctrine')->getEntityManager()->getRepository($sluggable_entity)->getContentByField($lang, array('content_search' => array($sluggable_field_search =>$match[$sluggable_field_search]), 'field_result'=>$sluggable_title), false);
					if(is_object($result))
						$title = $result->getContent();
				}
			}			
		} catch (\Exception $e) {
		}
		
		return $title;
	}
	
	/**
	 * Return the metas of a page.
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */	
	public function getMetaPageFunction(array $options)
	{
		// we get the param.
		$lang  		 	= $this->container->get('session')->getLocale();
		$Uri		 	= $this->container->get('request')->getUri();
		$BasePath		= $this->container->get('request')->getUriForPath('');
		$author		 	= str_replace('"', "'", $this->container->getParameter('pi_app_admin.layout.meta.author'));
		$copyright		= str_replace('"', "'", $this->container->getParameter('pi_app_admin.layout.meta.copyright'));
		$description 	= str_replace('"', "'", $this->container->getParameter('pi_app_admin.layout.meta.description'));
		$keywords	 	= str_replace('"', "'", $this->container->getParameter('pi_app_admin.layout.meta.keywords'));
		$og_type		= str_replace('"', "'", $this->container->getParameter('pi_app_admin.layout.meta.og_type'));
		$og_image		= str_replace('"', "'", $this->container->getParameter('pi_app_admin.layout.meta.og_image'));
		$og_site_name 	= str_replace('"', "'", $this->container->getParameter('pi_app_admin.layout.meta.og_site_name'));
		
		// if the file doesn't exist, we call an exception
		$is_file_exist = realpath($this->container->get('kernel')->getRootDir(). '/../web/' . $og_image);
		if(!$is_file_exist)
			throw ExtensionException::FileUnDefined('img', __CLASS__);		
		$og_image = $this->container->get('templating.helper.assets')->getUrl($og_image);
		
		// we create all meta tags.
		if(isset($copyright) && !empty($copyright))
			$metas[] = "<link rel='copyright' href=\"".$copyright."\"/>";

		$metas[] = "	<meta property='og:url' content=\"{$Uri}\"/>";
		
		try {
			// title management
			$pathInfo	= str_replace($this->container->get('request')->getUriForPath(''), '', $this->container->get('request')->getUri());
			$match		= $this->container->get('i18n_routing.router')->match($pathInfo);
			$route		= $match['_route'];
			if(isset($GLOBALS['ROUTE']['SLUGGABLE'][ $route ]) && !empty($GLOBALS['ROUTE']['SLUGGABLE'][ $route ])){
				$sluggable_entity 		= $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['entity'];
				$sluggable_field_search = $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['field_search'];
				$sluggable_title 		= $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['field_title'];
				$sluggable_resume 		= $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['field_resume'];
				$sluggable_keywords		= $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['field_keywords'];
				
				$sluggable_title_tab = array_map(function($value) {
					return ucwords($value);
				}, array_values(explode('_', $sluggable_title)));
				$sluggable_resume_tab = array_map(function($value) {
					return ucwords($value);
				}, array_values(explode('_', $sluggable_resume)));
				$sluggable_keywords_tab = array_map(function($value) {
					return ucwords($value);
				}, array_values(explode('_', $sluggable_keywords)));					
				
				$method_title	 	= "get".implode('', $sluggable_title_tab);
				$method_resume 		= "get".implode('', $sluggable_resume_tab);
				$method_keywords 	= "get".implode('', $sluggable_keywords_tab);				
				
				if( ($sluggable_field_search == 'id') && isset($match['id']) ){
					$entity = $this->container->get('doctrine')->getEntityManager()->getRepository($sluggable_entity)->findOneByEntity($lang, $match['id'], 'object');
					if(is_object($entity) && method_exists($entity, $method_title) && method_exists($entity, $method_resume) && method_exists($entity, $method_keywords)){
						$og_title = str_replace('"', "'", $entity->$method_title());
						$new_meta				= "	<meta property='og:title' content=\"{$og_title}\"/>";
						$options['description'] = str_replace('"', "'", $entity->$method_resume());
						$options['keywords']	= str_replace('"', "'", $entity->$method_keywords());
					}
				}elseif(array_key_exists($sluggable_field_search, $match)){
					$meta_title						= $this->container->get('doctrine')->getEntityManager()->getRepository($sluggable_entity)->getContentByField($lang, array('content_search' => array($sluggable_field_search =>$match[$sluggable_field_search]), 'field_result'=>$sluggable_title), false);
					$meta_resume					= $this->container->get('doctrine')->getEntityManager()->getRepository($sluggable_entity)->getContentByField($lang, array('content_search' => array($sluggable_field_search =>$match[$sluggable_field_search]), 'field_result'=>$sluggable_resume), false);
					$meta_keywords					= $this->container->get('doctrine')->getEntityManager()->getRepository($sluggable_entity)->getContentByField($lang, array('content_search' => array($sluggable_field_search =>$match[$sluggable_field_search]), 'field_result'=>$sluggable_keywords), false);
					
					if(is_object($meta_title)){
						$og_title = str_replace('"', "'", $meta_title->getContent());
						$new_meta					= "<meta property='og:title' content=\"{$og_title}\"/>";
					}
					if(is_object($meta_resume))
						$options['description'] 	= str_replace('"', "'", $meta_resume->getContent());
					if(is_object($meta_keywords))
						$options['keywords']		= str_replace('"', "'", $meta_keywords->getContent());
				}
			}
			
			if(empty($new_meta) && isset($options['title']) && !empty($options['title'])){
				$options['title'] = str_replace('"', "'", $options['title']);
				$metas[] = "	<meta property='og:title' content=\"{$options['title']}\"/>";
			}elseif(!empty($new_meta))
				$metas[] = $new_meta;
			
		} catch (\Exception $e) {
			if(isset($options['title']) && !empty($options['title'])){
				$options['title'] = str_replace('"', "'", $options['title']);
				$metas[] 		  = "	<meta property='og:title' content=\"{$options['title']}\"/>";
			}			
		}
		
		if(isset($og_type) && !empty($og_type))
			$metas[] = "	<meta property='og:type' content=\"{$og_type}\"/>";
		if(isset($og_image) && !empty($og_image))
			$metas[] = "	<meta property='og:image' content=\"{$BasePath}{$og_image}\"/>";
		if(isset($og_site_name) && !empty($og_site_name)){
			$og_site_name = str_replace('https://', '', $og_site_name);
			$og_site_name = str_replace('http://', '', $og_site_name);
			$metas[] = "	<meta property='og:site_name' content=\"{$og_site_name}\"/>";
		}
		
		// description management
		$metas[] = "	<meta charset='".$this->container->get('twig')->getCharset()."'/>";
		$metas[] = "	<meta http-equiv='Content-Type'/>";
		$metas[] = "	<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'/>";
		$metas[] = "	<meta name='generator' content=\"Orchestra\"/>";
		
		if(isset($author) && !empty($author))
			$metas[] = "	<meta name='author' content=\"".$author."\"/>";
		
		if(isset($options['description']) && !empty($options['description']))
			$metas[] = "	<meta name='description' content=\"".$options['description']."\"/>";
		elseif(isset($description) && !empty($description))
			$metas[] = "	<meta name='description' content=\"".$description."\"/>";
		
		if(isset($options['keywords']) && !empty($options['keywords']))
			$metas[] = "	<meta name='keywords' content=\"".$options['keywords']."\"/>";
		elseif(isset($keywords) && !empty($keywords))
			$metas[] = "	<meta name='keywords' content=\"".$keywords."\"/>";
		
		
		// mobile management
		//$metas[] = "<meta name='apple-mobile-web-app-capable' content='yes'/>";
		//$metas[] = "<meta name='apple-mobile-web-app-status-bar-style' content='black'/>";
		//$metas[] = "<meta name='viewport'	id='viewport'  content='target-densitydpi=device-dpi, user-scalable=no' />";
		//$metas[] = "<meta name='viewport' content='initial-scale=1.0; user-scalable=0; minimum-scale=1.0; maximum-scale=1.0;' />";
		
		$metas[] = "<!-- Mobile viewport optimized: h5bp.com/viewport -->";
		$metas[] = "<meta name='viewport' content='width=device-width,initial-scale=1,maximum-scale=1'>";

		//Empécher Microsoft de générer des "smart tags" sur notre page web.
		//$metas[] = "meta name='MSSmartTagsPreventParsing' content='TRUE'/>";
		
		// robot management
		$metas[] = "	<meta name='robots' content='ALL'/>";
		$metas[] = "	<meta name='robots' content='index, follow'/>";
		$metas[] = "	<meta name='robots' content='noodp'/>";
				
		return implode(" \n", $metas);
	}
	
	/**
	 * translation of date.
	 *
	 * @author riad hellal <r.hellal@novediagroup.com>
	 */
	public function getDatePatternByLocalFunction($locale, $dir='/web/bundles/piappadmin/js/wijmo/external/cultures/', $fileName = 'cultures_date.json')
	{
		// $isGood = $this->updateCulturesJsFilesFunction($dir, $fileName);
	
		$dates 		= array();
		$root_file  = $this->container->get("kernel")->getRootDir() .'/../'. $dir . $fileName;
		$dates		= json_decode(file_get_contents($root_file));
	
		if(isset($dates->{$locale}))
			return $dates->{$locale};
		else
			return "MM/dd/yyyy";
	}
	
	/**
	 * parsing translaion js files.
	 *
	 * @author riad hellal <r.hellal@novediagroup.com>
	 */
	private function updateCulturesJsFilesFunction($dir='/web/bundles/piappadmin/js/wijmo/external/cultures/', $fileName = 'cultures_date.json')
	{
		$root_dir = $this->container->get("kernel")->getRootDir() .'/../'. $dir;
	
		$MyDirectory = opendir($root_dir) or die('Erreur');
		$fp = fopen($root_dir.$fileName, 'w');
		while($Entry = @readdir($MyDirectory)) {
			if($Entry != '.' && $Entry != '..') {
				$ch = file_get_contents($root_dir.$Entry, FILE_USE_INCLUDE_PATH);
					
				preg_match('/Globalize.addCultureInfo\(((.+)\})\);/is', $ch, $match);
	
				$strm = $match[1];
				preg_match('/(.+), (\{(.+)\})/is', $strm, $tabres);
				$str = $tabres[2];
				preg_match('/d: \"(.+)\"/', $str, $es);
	
				$tabln =  explode( ',', $tabres[1] ) ;
				if($es){
					$ln =  trim(str_replace('"', '', $tabln[0])) ;
					$ln =  str_replace('-', '_', $ln) ;
					$posts[$ln] =  $es[1];
	
				}
					
			}
		}
	
		fwrite($fp, json_encode($posts));
		fclose($fp);
		closedir($MyDirectory);
			
		return true;
	}	
		
	
	/**
	 * divers Filters
	 */
		
	public function phpFilter($var, $function) {
		return $function($var);
	}
		
	public function joinFilter( $objects, $glue = ', ', $lastGlue = null ) {
		null === $lastGlue && $lastGlue = $glue;
	
		$last = '';
		if ( 2 < count($objects) )
			$last = $lastGlue . array_pop($objects);
	
		return implode($glue, $objects) . $last;
	}
	
	public function dumpFilter($var) {
		var_dump($var);
		return '';
	}
	
	public function print_rFilter($var) {
		return print_r($var, 1);
	}
	
	public function get_classFilter($object) {
		return get_class($object);		
	}
	
	public function nl2brFilter($string) {
		return nl2br($string);
	}

	public function htmlspecialcharsFilter( $string ) {
		$flags = ENT_COMPAT;
		defined('ENT_HTML5') && $flags |= ENT_HTML5;
	
		return htmlspecialchars($string, $flags, 'UTF-8');
	}
	
	public function htmlentitiesFilter( $string ) {
		$flags = ENT_COMPAT;
		defined('ENT_HTML5') && $flags |= ENT_HTML5;
		
		return htmlentities($string, $flags, 'UTF-8');
	}
	
	public function addslashesFilter( $string ) {
		return addslashes($string);
	}	
	
	public function substrFilter( $string, $first, $last = null){
		if(is_null($last))
			return substr($string, $first);
		else
			return substr($string, $first, $last);
	}
	
	/**
	 * array filters
	 */	
	public function countFilter($array) {
		return count($array);
	}
	
	public function resetFilter($array) {
		reset($array);
		return $array;
	}

	public function endFilter($array) {
		end($array);
		return $array;
	}	

	public function stepsFilter($array, $step) {
		$count = count($array);
		
		if($count >= $step){
			reset($array);
			for ($i=1; $i<=$step; $i++) {
				next($array);
			}
			return current($array);
		}else
			return '';
	}	
	
	public function arraysliceFilter($array, $first, $last = null) {
		if(is_null($last))
			$result = array_slice($array, $first); 
		else
			$result = array_slice($array, $first, $last);
		
		if(count($result) >= 1)
			return $result;
		else
			return '';
	}

	public function XmlString2arrayFilter($string){
		return $this->container->get('pi_app_admin.array_manager')->XmlString2array($string);
	}
	
	/**
	 * translation filters
	 */	
	public function translatepluralFilter($single, $plural, $number, $domain = "messages") {
		if($number > 1) 
			return $this->container->get('translator')->trans(sprintf($plural, $number), array('%s'=>$number), $domain);
		else
			return $this->container->get('translator')->trans(sprintf($single, $number), array('%s'=>$number), $domain);
	}	
	
	public function pluralizeFilter($string, $number = null) {
		if ($number && ($number == 1))
			return $string;
		else
			return $this->container->get('pi_app_admin.string_manager')->pluralize($string);
	}	
	
	public function depluralizeFilter($string, $number = null) {
		if ($number && ($number > 1))
			return $string;
		else
			return $this->container->get('pi_app_admin.string_manager')->depluralize($string);
	}	
	
	
	/**
	 * text filters
	 */
	public function ucfirstFilter($string) {
		return ucfirst($string);
	}

	public function ucwordsFilter($string) {
		return ucwords($string);
	}
	
	public function sanitizeFilter($string, $force_lowercase = true, $anal = false, $trunc = 100) {
		return $this->container->get('pi_app_admin.string_manager')->sanitize($string, $force_lowercase, $anal, $trunc);
	}
	
	public function slugifyFilter($string) {
		return $this->container->get('pi_app_admin.string_manager')->slugify($string);
	}
	
	public function limitecaractereFilter($string, $mincara, $nbr_cara) {
		return $this->container->get('pi_app_admin.string_manager')->LimiteCaractere($string, $mincara, $nbr_cara);
	}	
	
	public function splitTextFilter($string){
		return $this->container->get('pi_app_admin.string_manager')->splitText($string);
	}
	public function splitHtmlFilter($string){
		return $this->container->get('pi_app_admin.string_manager')->splitHtml($string);
	}
	
	public function truncateFilter($string, $length = 100, $ending = "...", $exact = false, $html = true) {
		return $this->container->get('pi_app_admin.string_manager')->truncate($string, $length, $ending, $exact, $html);
	}	
	
	public function cutTextFilter($string, $intCesurePos, $otherText = false, $strCaractereCesure = ' ', $intDecrementationCesurePos = 5){
		$HtmlCutter	= $this->container->get('pi_app_admin.string_cut_manager');
		$HtmlCutter->setOptions($string, $intCesurePos, $otherText);
		$HtmlCutter->setParams($strCaractereCesure, $intDecrementationCesurePos);
		return $HtmlCutter->run();
	}
	
}