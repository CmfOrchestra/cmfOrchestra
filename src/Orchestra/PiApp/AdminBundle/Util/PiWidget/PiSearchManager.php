<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Util
 * @package    Extension_widget 
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-06-13
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
 * Search Widget plugin
 *
 * @category   Admin_Util
 * @package    Extension_widget 
 * 
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class PiSearchManager extends PiWidgetExtension
{
	/**
	 * Constructor.
	 *
	 * @param \Symfony\Component\DependencyInjection\ContainerInterface
	 * @param string	action name
	 * 
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 */
	public function __construct(ContainerInterface $container, $action)
	{
		parent::__construct($container, 'SEARCH', $action);
	}
	
	/**
	 * Sets init.
	 *
	 * @access protected
	 * @return void
	 *
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 */	
	protected function init()
	{
		if( ($this->action == "lucene") && !empty($this->method)){
			return $this->container->get('pi_app_admin.twig.extension.jquery')->initJquery($this->method);
		}
	}		

	/**
	 * checks if the jquery container and the jquery service exist.
	 *
	 * @param string	$JQcontainer
	 * @param string	$JQservice
	 * @access protected
	 * @return BooleanType
	 *
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 */
	protected function isAvailableJqueryExtension($JQcontainer, $JQservice)
	{
		if( isset($GLOBALS['JQUERY'][$JQcontainer][$JQservice]) && $this->container->has($GLOBALS['JQUERY'][$JQcontainer][$JQservice]) ){
			return true;
		}else
			return false;
	}
		

	/**
	 * Sets the render of the lucene action.
	 *
	 * <code>
	 *   <?xml version="1.0"?>
	 *   <config>
	 * 		<widgets>
	 * 			<search>
	 * 				<controller>LUCENE:search-lucene</controller>
	 * 				<params>
	 * 					<cachable>false</cachable>
	 *					<template>searchlucene-result.html.twig</template>
	 *					<MaxResults></MaxResults>
     *                  <lucene>
 	 *                  	<action>renderDefault</action>
     *						<menu>searchlucene</menu>
     *						<searchBool>true</searchBool>
     *						<searchBoolType>AND</searchBoolType>
     *						<searchByMotif>true</searchByMotif>
     *						<setMinPrefixLength>0</setMinPrefixLength>
     *						<getResultSetLimit>0</getResultSetLimit>
     *						<searchFields>
     *							<sortField>Contents</sortField>
     *							<sortType>SORT_STRING</sortType>
     *							<sortOrder>SORT_ASC</sortOrder>
     *						</searchFields>
     *						<searchFields>
     *							<sortField>Key</sortField>
     *							<sortType>SORT_NUMERIC</sortType>
     *							<sortOrder>SORT_DESC</sortOrder>
     *						</searchFields>
     *                  </lucene>
     *	 			</params>
	 * 			</search>
	 *	 	</widgets>
	 *   </config>
 	 * </code>
 	 * 
	 * @param	$options	tableau d'options.
	 * @access protected
	 * @return void
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 */
	public function renderLucene($options = null)
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
    	
    	// if the gedmo widget is defined correctly as a "lucene"
    	if( ($this->action == "lucene") && $xmlConfig->widgets->get('search') && $xmlConfig->widgets->search->get('controller') && $xmlConfig->widgets->search->get('params')  )
    	{
    	    $controller	= $xmlConfig->widgets->search->controller;
    		
    		if($xmlConfig->widgets->search->params->get('cachable'))
    			$params['cachable'] = $xmlConfig->widgets->search->params->cachable;
    		else
    			$params['cachable'] = 'true';
    		
    		if($xmlConfig->widgets->search->params->get('template'))
    			$params['template'] = $xmlConfig->widgets->search->params->template;
    		else
    			$params['template'] = "";

    		if($xmlConfig->widgets->search->params->get('MaxResults'))
    			$params['MaxResults'] = $xmlConfig->widgets->search->params->MaxResults;
    		else
    			$params['MaxResults'] = 0;    		
    		
    		if($xmlConfig->widgets->search->params->get('lucene')){
    		
   				$params = array_merge($params, $xmlConfig->widgets->search->params->lucene->toArray());
    		
   				$values 	= explode(':', $controller);
   				$JQcontainer= strtoupper($values[0]);
   				$JQservice	= strtolower($values[1]);
   				
//    				print_r($this->runByExtension('pi_app_admin.manager.search_lucene', $this->action, "$JQcontainer~$JQservice", $lang, $params));
//    				krsort($params); // array_multisort
//    				print_r($params);exit;  				
   				
   				if($this->isAvailableJqueryExtension($JQcontainer, $JQservice)){
   					if($params['cachable'] == 'true')
   						return $this->runByExtension('pi_app_admin.manager.search_lucene', $this->action, "$JQcontainer~$JQservice", $lang, $params);
   					else
   						return $this->runByjqueryExtension($JQcontainer, $JQservice, $lang, $params);
   				}
   				
    		}else
    			throw ExtensionException::optionValueNotSpecified("gedmo navigation", __CLASS__);    		
 		
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
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
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
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
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
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
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