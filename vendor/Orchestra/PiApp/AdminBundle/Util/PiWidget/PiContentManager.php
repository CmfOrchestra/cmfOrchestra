<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Util
 * @package    Extension_widget 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-02-10
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Util\PiWidget;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

use PiApp\AdminBundle\Twig\Extension\PiWidgetExtension;
use PiApp\AdminBundle\Exception\ExtensionException;

/**
 * Content Widget plugin
 *
 * @category   Admin_Util
 * @package    Extension_widget 
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiContentManager extends PiWidgetExtension
{
	/**
	 * Constructor.
	 *
	 * @param \Symfony\Component\DependencyInjection\ContainerInterface
	 * @param string	action name
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public function __construct(ContainerInterface $container, $action)
	{
		parent::__construct($container, 'CONTENT', $action);
	}
	
	/**
	 * Return list of available jqext.
	 *
	 * @return array
	 * @access public
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-07-23
	 */
	public static function getAvailableJqext()
	{
		$result = array(
				'TWITTER:tweets_blog'	=> array(
							'method' => array('rendertwitter', 'renderblog'),
							'rendertwitter'	 => array(
									'edit'		=> 'admin_gedmo_sociallink_edit',
							),
							'renderblog'	 => array(
									'edit'		=> 'admin_gedmo_sociallink',
							),
				),	
		);
		
		if (isset($GLOBALS['CONTENT_WIDGET_JQEXT']))
			return array_merge($result, $GLOBALS['CONTENT_WIDGET_JQEXT']);
		else
			return $result;
	}

	/**
	 * checks if the jquery container and the jquery service exist.
	 *
	 * @param string	$JQcontainer
	 * @param string	$JQservice
	 * @access protected
	 * @return BooleanType
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	protected function isAvailableJqueryExtension($JQcontainer, $JQservice)
	{
		if ( isset($GLOBALS['JQUERY'][$JQcontainer][$JQservice]) && $this->container->has($GLOBALS['JQUERY'][$JQcontainer][$JQservice]) ){
			return true;
		}else
			return false;
	}	
	
	/**
	 * Sets init.
	 *
	 * @access protected
	 * @return void
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */	
	protected function init()
	{
		if ( ($this->action == "jqext") && !empty($this->method)){
			return $this->container->get('pi_app_admin.twig.extension.jquery')->initJquery($this->method);
		}
	}	
	
    /**
      * Sets the render of the text action.
      *
      * @param	$options	tableau d'options.
      * @access protected
      * @return void
      *
      * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
      */
	public function renderText($options = null)
	{        
		$lang				= $options['widget-lang'];
		
		// if the gedmo widget is defined correctly as a "text"
		if ( ($this->action == "text" ) && $this->getTranslationWidget())
		{	
			return $this->runByExtension('pi_app_admin.manager.transwidget', 'transwidget', $this->getTranslationWidget()->getId(), $lang);
		}else
			return " no translation widget setting : {{ getService('pi_app_admin.string_manager').random(8)|raw }} \n";
	}
	
	/**
	 * Sets the render of the media action.
	 * 
	 * <code>
	 *	<?xml version="1.0"?>
	 *	<config>
	 *		<widgets>
	 *			<content>
	 *				<id>1</id>
	 *				<media>
	 *					<format>default_small</format>
	 *					<align>right</align>
	 *					<class>maclass</class>
	 *					<link>MonImage</link>
	 *				</media>
	 *			</content>
	 *		</widgets>
	 *	</config>
	 * </code>
	 * 
	 * @param	$options	tableau d'options.
	 * @access protected
	 * @return void
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public function renderMedia($options = null)
	{
		$xmlConfig			= $this->getConfigXml();
		$lang				= $options['widget-lang'];
		
		// if the configXml field of the widget isn't configured correctly.
		try {
			$xmlConfig	= new \Zend_Config_Xml($xmlConfig);
		} catch (\Exception $e) {
			return "  \n";
		}
		
		// if the gedmo widget is defined correctly as a "media"
		if ( ($this->action == "media") && $xmlConfig->widgets->get('content') && $xmlConfig->widgets->content->get('media')  )
		{
			if ( $xmlConfig->widgets->content->get('id') ){
				$idMedia		= $xmlConfig->widgets->content->id;
				
				// FORMAT
				if ($xmlConfig->widgets->content->media->get('format'))
					$format = $xmlConfig->widgets->content->media->format;
				else
					$format = "default_small"; // reference, default_small
				
				// ALIGN
				if (!is_null($xmlConfig->widgets->content->media->align)){					
					if (in_array($xmlConfig->widgets->content->media->align, array('left', 'right'))){
						$align_start	= "<section style=' display: inline-block; margin:0; padding: 0; position: relative; float:" . $xmlConfig->widgets->content->media->align . "' > \n";
						$align_end		= "</section> \n";
					}elseif ($xmlConfig->widgets->content->media->align == "center"){
						$align_start	= "<section style='clear:both; display: block; position: relative; text-align:center; margin: 0 auto;' > \n";
						$align_end		= "</section> \n";
					}
				} else {
					$align 		= "";
					$align_end 	= "";
				}
				
				$classDiv_start = "";
				$classDiv_end   = "";
				// CLASS
				if (!empty($xmlConfig->widgets->content->media->class)){
					$classDiv_start	= "<section class='".$xmlConfig->widgets->content->media->class."' > \n";
					$classDiv_end	= "</section> \n";
				}				

				// RESULT
				if (is_null($xmlConfig->widgets->content->media->link)){
					try {
						$img_balise = $this->container->get('sonata.media.twig.extension')->media($idMedia, $format, array('alt'=>''));
						return  $classDiv_start . $align_start . $img_balise . $align_end . $classDiv_end;
					} catch (\Exception $e) {
						return "the media doesn't exist";
					}
				}elseif (!empty($xmlConfig->widgets->content->media->link)){
					try {
						//$url = $this->container->get('bootstrap.RouteTranslator.factory')->getRoute('sonata_media_download', array('id'=>$idMedia, 'format'=>$format));
						$url = $this->container->get('sonata.media.twig.extension')->path($idMedia, $format);
						return  $classDiv_start . $align_start 
								. "<a href='$url' target='_blanc' title='' > \n"
									. $xmlConfig->widgets->content->media->link  . " \n"
								. '</a>' . " \n" 
								. $align_end . $classDiv_end;
					} catch (\Exception $e) {
						return "the media doesn't exist";
					}					
				}
				
			}else
				throw ExtensionException::optionValueNotSpecified("content", __CLASS__);	
		}else
			throw ExtensionException::optionValueNotSpecified("content", __CLASS__);	
	}	
	
	/**
	 * Sets the render of the snippet action.
	 *
	 * <code>
	 *	<?xml version="1.0"?>
	 *	<config>
	 *		<widgets>
	 *			<content>
	 *				<id>1</id>
	 *				<snippet>true</snippet>
	 *			</content>
	 *		</widgets>
	 *	</config>
	 * </code>
	 * 
	 * @param	$options	tableau d'options.
	 * @access protected
	 * @return void
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public function renderSnippet($options = null)
	{
		$xmlConfig			= $this->getConfigXml();
		$lang				= $options['widget-lang'];
		
		// if the configXml field of the widget isn't configured correctly.
		try {
			$xmlConfig	= new \Zend_Config_Xml($xmlConfig);
		} catch (\Exception $e) {
			return "  \n";
		}
		
		// if the gedmo widget is defined correctly as a "snippet"
		if ( ($this->action == "snippet") && $xmlConfig->widgets->get('content') && $xmlConfig->widgets->content->get('snippet') && $xmlConfig->widgets->content->get('id') )
		{
			if ( $xmlConfig->widgets->content->snippet ){
				$idWidget		= $xmlConfig->widgets->content->id;
				
				try {
					$TranslationWidget 	= $this->getRepository()->getRepository('TranslationWidget')->getTranslationById((int) $idWidget, $lang);
					return $this->runByExtension('pi_app_admin.manager.transwidget', 'transwidget', $TranslationWidget->getId(), $lang);
				} catch (\Exception $e) {
					return "the snippet doesn't exist";
				}
			}
		}else
			throw ExtensionException::optionValueNotSpecified("content", __CLASS__);	
	}
	
	/**
	 * Sets the render of the Jqext action.
	 *
	 * <code>
	 * 
	 * 	 // Extending jQuery to insert and call tweets of a user name.
	 *   <?xml version="1.0"?>
	 *   <config>
	 * 		<widgets>
	 * 			<content>
	 * 				<controller>TWITTER:tweets_blog</controller>
	 * 				<params>
	 * 					<cachable>false</cachable>
	 *					<action>rendertwitter</action>
	 *					<twitter_id>novediaGroup</twitter_id>
	 *					<template>twitter.html.twig</template>
	 *	 			</params>
	 * 			</content>
	 *	 	</widgets>
	 *   </config>
	 *   
	 *   // jquery extension to insert and call blog of an entity.
	 *   <?xml version="1.0"?>
	 *   <config>
	 * 		<widgets>
	 * 			<content>
	 * 				<controller>TWITTER:tweets_blog</controller>
	 * 				<params>
	 * 					<cachable>false</cachable>
	 *					<action>renderblog</action>
	 *					<maxResults>15</maxResults>
	 *					<template>blog.html.twig</template>
	 *					<listenerentity>Sociallink</listenerentity>
	 *	 			</params>
	 * 			</content>
	 *	 	</widgets>
	 *   </config>
	 *   
 	 * </code>
 	 * 
	 * @param	$options	tableau d'options.
	 * @access protected
	 * @return void
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public function renderJqext($options = null)
	{
		$xmlConfig	= $this->getConfigXml();
		$lang		= $options['widget-lang'];
		$params 	= array();
		
    	// if the configXml field of the widget isn't configured correctly.
    	try {
    		$xmlConfig	= new \Zend_Config_Xml($xmlConfig);
    	} catch (\Exception $e) {
    		return "  \n";
    	}
    	
    	// if the gedmo widget is defined correctly as a "jqext"
    	if ( ($this->action == "jqext") && $xmlConfig->widgets->get('content') && $xmlConfig->widgets->content->get('controller') && $xmlConfig->widgets->content->get('params')  )
    	{
    	    $controller	= $xmlConfig->widgets->content->controller;
    		$params		= $xmlConfig->widgets->content->params->toArray();
    		
    		if ($xmlConfig->widgets->content->params->get('cachable'))
    			$params['cachable'] = $xmlConfig->widgets->content->params->cachable;
    		else
    			$params['cachable'] = 'true';
    		
    		$values 	= explode(':', $controller);
    		$JQcontainer= strtoupper($values[0]);
    		$JQservice	= strtolower($values[1]);    		

    		if ($this->isAvailableJqueryExtension($JQcontainer, $JQservice)){
				if ($params['cachable'] == 'true')
					return $this->runByExtension('pi_app_admin.manager.jqext', $this->action, "$JQcontainer~$JQservice", $lang, $params);
				else
					return $this->runByjqueryExtension($JQcontainer, $JQservice, $lang, $params);
    		}    		
    	}else
    		throw ExtensionException::optionValueNotSpecified("content", __CLASS__);    	
	}

	/**
	 * Sets JS script.
	 *
	 * @param	array $options
	 * @access public
	 * @return void
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */	
	public function scriptJs($options = null) {
		// We open the buffer.
		ob_start ();
		?>
			
		<?php
		// We retrieve the contents of the buffer.
		$_content = ob_get_contents ();
		// We clean the buffer.
		ob_clean ();
		// We close the buffer.
		ob_end_flush ();
		
		return $_content;
	}
	
	/**
	 * Sets Css script.
	 *
	 * @param array $options
	 * @access public
	 * @return void
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */	
	public function scriptCss($options = null) {
		// We open the buffer.
		ob_start ();
		?>
		
		<?php
		// We retrieve the contents of the buffer.
		$_content = ob_get_contents ();
		// We clean the buffer.
		ob_clean ();
		// We close the buffer.
		ob_end_flush ();
		
		return $_content;
	}
	
	/**
	 * Sets Editor script.
	 *
	 * @param array $options
	 * @access public
	 * @return void
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public function scriptEditor($options = null) {
		// We open the buffer.
		ob_start ();
		?>
		
		<?php
		// We retrieve the contents of the buffer.
		$_content = ob_get_contents ();
		// We clean the buffer.
		ob_clean ();
		// We close the buffer.
		ob_end_flush ();
		
		return $_content;
	}	
}