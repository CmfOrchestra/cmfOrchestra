<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Util
 * @package    Extension_widget 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-03-11
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Util\PiWidget;

use Doctrine\ORM\Query\AST\InstanceOfExpression;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

use PiApp\AdminBundle\Twig\Extension\PiWidgetExtension;
use PiApp\AdminBundle\Exception\ExtensionException;

/**
 * Gedmo Widget plugin
 *
 * @category   Admin_Util
 * @package    Extension_widget 
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiGedmoManager extends PiWidgetExtension
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
		parent::__construct($container, 'GEDMO', $action);
	}
	
	/**
	 * Return list of available snippet.
	 *
	 * @return array
	 * @access public
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-04-27
	 */
	public static function getAvailableSnippet()
	{
		return null;
	}	
	
	/**
	 * Return list of available listener.
	 *
	 * @return array
	 * @access public
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-03-11
	 */
	public static function getAvailableListener()
	{
		$result = array();
		
		if(isset($GLOBALS['GEDMO_WIDGET_LISTENER']))
			return array_merge($result, $GLOBALS['GEDMO_WIDGET_LISTENER']);
		else
			return $result;		
	}	
	
	/**
	 * Return list of available navigation.
	 *
	 * @return array
	 * @access public
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-03-11
	 */
	public static function getAvailableNavigation()
	{
		$result =  array();
		
		if(isset($GLOBALS['GEDMO_WIDGET_NAVIGATION']))
			return array_merge($result, $GLOBALS['GEDMO_WIDGET_NAVIGATION']);
		else
			return $result;		
	}

	/**
	 * Return list of available organigram.
	 *
	 * @return array
	 * @access public
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-03-11
	 */
	public static function getAvailableOrganigram()
	{
		$result = array();
		
		if(isset($GLOBALS['GEDMO_WIDGET_ORGANIGRAM']))
			return array_merge($result, $GLOBALS['GEDMO_WIDGET_ORGANIGRAM']);
		else
			return $result;		
	}
	
	/**
	 * Return list of available slider.
	 *
	 * @return array
	 * @access public
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-03-11
	 */
	public static function getAvailableSlider()
	{
		$result = array();
		
		if(isset($GLOBALS['GEDMO_WIDGET_SLIDER']))
			return array_merge($result, $GLOBALS['GEDMO_WIDGET_SLIDER']);
		else
			return $result;		
	}	
	
	/**
	 * checks if the controller  and the action are in the container.
	 *
	 * @param string	$controller
	 * @access protected
	 * @return BooleanType
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-03-11
	 */		
	protected function isAvailableAction($controller)
	{
   		$values 	= explode(':', $controller);
   		$entity 	= str_replace('\\\\', '\\', strtolower($values[1]));
   		$method 	= strtolower($values[2]);
   		
   		$getAvailable 	= "getAvailable" . ucfirst($this->action);
   		$Lists 		= self::$getAvailable();
   		
   		if( $entity && !isset($Lists[$entity]) )
   			return false;
   		elseif( $entity && !in_array($method, $Lists[$entity]['method']) )
   			return false;
   		
   		$this->entity = $values[1];
   		$this->setMethod($method);
   		   			
   		return true;
	}
	
	/**
	 * Sets init.
	 *
	 * @access protected
	 * @return void
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-03-11
	 */	
	protected function init()
	{
		//$this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile('bundles/piappadmin/css/form/form.css');
		if( ($this->action == "organigram") && !empty($this->method)){
				return $this->container->get('pi_app_admin.twig.extension.jquery')->initJquery('MENU:'.$this->method);
		}
		if( ($this->action == "slider") && !empty($this->method)){
			return $this->container->get('pi_app_admin.twig.extension.jquery')->initJquery('SLIDER:'.$this->method);
		}		
	}

	/**
	 * Sets the render of the snippet action.
	 *
	 * <code>
	 *	<?xml version="1.0"?>
	 *	<config>
	 *		<widgets>
	 *			<gedmo>
	 *				<id>1</id>
	 *				<snippet>true</snippet>
	 *			</gedmo>
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
	
		// if the gedmo widget is defined correctly as a "listener"
		if( ($this->action == "snippet") && $xmlConfig->widgets->get('gedmo') && $xmlConfig->widgets->gedmo->get('snippet') && $xmlConfig->widgets->gedmo->get('id') )
		{
			if( $xmlConfig->widgets->gedmo->snippet ){
				$idWidget = intval($xmlConfig->widgets->gedmo->id);		
				
				try {
					//return " {{ getService('pi_app_admin.manager.widget').exec(".$idWidget.", '$lang')|raw }} \n";
					return $this->container->get('pi_app_admin.manager.widget')->exec($idWidget, $lang);
				} catch (\Exception $e) {
					return "the gedmo snippet doesn't exist";
				}
			}
		}else
			throw ExtensionException::optionValueNotSpecified("gedmo", __CLASS__);
	}	
	
	/**
	 * Sets the render of the Listener action.
	 *
	 * <code>
	 *	<?xml version="1.0"?>
	 *	<config>
	 *		<widgets>
	 *			<gedmo>
	 *				<controller>PiAppGedmoBundle:Activity:_template_list</controller>
	 *				<params>
	 *					<id></id>
	 *					<category></category>
	 *	                <MaxResults>5</MaxResults>
	 *	                <template>_tmp_list_homepage.html.twig</template>
	 *					<order>DESC</order>
	 *					<cachable>true</cachable>
	 *				</params>
	 *			</gedmo>
	 *		</widgets>
	 *	</config>
	 * </code>
	 *
	 * @param	array $options
	 * @access public
	 * @return void
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-03-11
	 */
	public function renderListener($options = null)
	{
		$xmlConfig			= $this->getConfigXml();
		$lang				= $options['widget-lang'];
		
    	// if the configXml field of the widget isn't configured correctly.
    	try {
    		$xmlConfig	= new \Zend_Config_Xml($xmlConfig);
    	} catch (\Exception $e) {
    		return "  \n";
    	}
    	
    	// if the gedmo widget is defined correctly as a "listener"
    	if( ($this->action == "listener") && $xmlConfig->widgets->get("gedmo") && $xmlConfig->widgets->gedmo->get('controller') && $xmlConfig->widgets->gedmo->get('params') )
    	{
    		$controller	= $xmlConfig->widgets->gedmo->controller;
    		$params		= $xmlConfig->widgets->gedmo->params->toArray();
    		
    		if($xmlConfig->widgets->gedmo->params->get('cachable'))
    			$params['cachable'] = $xmlConfig->widgets->gedmo->params->cachable;
    		else
    			$params['cachable'] = 'true';    		

    		if($this->isAvailableAction($controller)){
	    		if($params['cachable'] == 'true')
	    			return $this->runByExtension('pi_app_admin.manager.listener', $this->action, $controller, $lang, $params);
	    		else
	    			return $this->runByService('pi_app_admin.manager.listener', $controller, $lang, $params);
    		}
    	}else
    		throw ExtensionException::optionValueNotSpecified("gedmo", __CLASS__);	
	}
	
	/**
	 * Sets the render of the Menu action.
	 *
	 * <code>
	 *	<?xml version="1.0"?>
	 *	<config>
	 *		<widgets>
	 *			<gedmo>
	 *				<controller>PiAppGedmoBundle:Menu:_navigation_default</controller>
	 *				<params>
	 *					<category>Menuwrapper</category>
	 *					<node>6</node>
	 *					<enabledonly>true</enabledonly>
	 *					<cachable>true</cachable>
     *                  <navigation>
     *                       <separatorClass>separateur</separatorClass>
     *                       <separatorText>&ndash;</separatorText>
     *                       <separatorFirst>false</separatorFirst>
     *                       <separatorLast>false</separatorLast>
     *                       <ulClass>infoCaption</ulClass>
     *                       <liClass>menuContainer</liClass>
     *                       <counter>true</counter>                       
     *                       <routeActifMenu>
     *                       	<liActiveClass>menuContainer_highlight</liActiveClass>
     *                       	<liInactiveClass></liInactiveClass>
     *                       	<aActiveClass>tblanc</aActiveClass>
     *                       	<aInactiveClass>tnoir</aInactiveClass>
     *                       	<enabledonly>true</enabledonly>
     *                       </routeActifMenu>
     *                       <lvlActifMenu>
     *                       	<liActiveClass></liActiveClass>
     *                       	<liInactiveClass></liInactiveClass>
     *                       	<aActiveClass>tnoir</aActiveClass>
     *                       	<aInactiveClass>tnoir</aInactiveClass>
     * 		                    <enabledonly>false</enabledonly>
     *                       </lvlActifMenu>
     *                  </navigation>
	 *				</params>
	 *			</gedmo>
	 *		</widgets>
	 *	</config>
	 * </code>
	 * 
	 * @param	array $options
	 * @access public
	 * @return void
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-04-19
	 */
	public function renderNavigation($options = null)
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
    	
    	// if the gedmo widget is defined correctly as a "navigation"
    	if( ($this->action == "navigation") && $xmlConfig->widgets->get('gedmo') && $xmlConfig->widgets->gedmo->get('controller') && $xmlConfig->widgets->gedmo->get('params') )
    	{
    		$controller	= $xmlConfig->widgets->gedmo->controller;
    		
    		if($this->isAvailableAction($controller)){
    			//$render_navigation = $this->method . "Action";
    			
    			if($xmlConfig->widgets->gedmo->params->get('category'))
    				$category = $xmlConfig->widgets->gedmo->params->category;
    			else
    				$category = ""; 

    			if($xmlConfig->widgets->gedmo->params->get('node'))
    				$params['node'] = $xmlConfig->widgets->gedmo->params->node;
    			else
    				$params['node'] = "";   
    			
    			if($xmlConfig->widgets->gedmo->params->get('enabledonly'))
    				$params['enabledonly'] = $xmlConfig->widgets->gedmo->params->enabledonly;
    			else
    				$params['enabledonly'] = "true";    
    			
    			if($xmlConfig->widgets->gedmo->params->get('cachable'))
    				$params['cachable'] = $xmlConfig->widgets->gedmo->params->cachable;
    			else
    				$params['cachable'] = 'true';

    			if($xmlConfig->widgets->gedmo->params->get('template'))
    				$template = $xmlConfig->widgets->gedmo->params->template;
    			else
    				$template = "";

    			$params['entity'] 	= $this->entity;
    			$params['category'] = $category;
    			$params['template'] = $template;

    			if($xmlConfig->widgets->gedmo->params->get('navigation')){
	    			if($xmlConfig->widgets->gedmo->params->navigation->get('separatorClass'))
	    				$params['separatorClass'] = $xmlConfig->widgets->gedmo->params->navigation->separatorClass;
	    			else
	    				$params['separatorClass'] = "";
	    			
	    			if($xmlConfig->widgets->gedmo->params->navigation->get('separatorText'))
	    				$params['separatorText'] = $xmlConfig->widgets->gedmo->params->navigation->separatorText;
	    			else
	    				$params['separatorText'] = "";	

	    			if($xmlConfig->widgets->gedmo->params->navigation->get('separatorFirst'))
	    				$params['separatorFirst'] = $xmlConfig->widgets->gedmo->params->navigation->separatorFirst;
	    			else
	    				$params['separatorFirst'] = "false";
	    			
	    			if($xmlConfig->widgets->gedmo->params->navigation->get('separatorLast'))
	    				$params['separatorLast'] = $xmlConfig->widgets->gedmo->params->navigation->separatorLast;
	    			else
	    				$params['separatorLast'] = "false";	    			
	    			
	    			if($xmlConfig->widgets->gedmo->params->navigation->get('ulClass'))
	    				$params['ulClass'] = $xmlConfig->widgets->gedmo->params->navigation->ulClass;
	    			else
	    				$params['ulClass'] = "";
	    			
	    			if($xmlConfig->widgets->gedmo->params->navigation->get('liClass'))
	    				$params['liClass'] = $xmlConfig->widgets->gedmo->params->navigation->liClass;
	    			else
	    				$params['liClass'] = "";
	    			
	    			if($xmlConfig->widgets->gedmo->params->navigation->get('counter'))
	    				$params['counter'] = $xmlConfig->widgets->gedmo->params->navigation->counter;
	    			else
	    				$params['counter'] = "";
	    			
	    			if($xmlConfig->widgets->gedmo->params->navigation->get('routeActifMenu'))
	    				$params['routeActifMenu'] = $xmlConfig->widgets->gedmo->params->navigation->routeActifMenu->toArray();
	    			
	    			if($xmlConfig->widgets->gedmo->params->navigation->get('lvlActifMenu'))
	    				$params['lvlActifMenu'] = $xmlConfig->widgets->gedmo->params->navigation->lvlActifMenu->toArray();
	    			
    				if($params['cachable'] == 'true')
    					return $this->runByExtension('pi_app_admin.manager.tree', $this->action, "$this->entity~$this->method~$category", $lang, $params);
    				else
    					return $this->runByService('pi_app_admin.manager.tree', "$this->entity~$this->method~$category", $lang, $params);
    					//return $this->runByjqueryExtension("MENU", "$this->entity~$this->method~$category", $lang, $params);
	    				    			
    			}else
    				throw ExtensionException::optionValueNotSpecified("gedmo navigation", __CLASS__);
    		}else
	    		throw ExtensionException::optionValueNotSpecified("gedmo template", __CLASS__);
    	}else
    		throw ExtensionException::optionValueNotSpecified("gedmo params or controller", __CLASS__);			
	}
	
	/**
	 * Sets the render of the organigram action.
	 *
	 * <code>
	 *  Pour appeler un organigramme
	 *	<?xml version="1.0"?>
	 *	<config>
	 *		<widgets>
	 *			<gedmo>
	 *				<controller>PiAppGedmoBundle:Organigram:org-chart-page</controller>
	 *				<params>
	 *					<category>BO</category>
	 *					<node>3</node>
	 *					<cachable>true</cachable>
     *                  <organigram>
     *		                <params>
     *		                  	<action>renderDefault</action>
     *							<menu>organigram</menu>
     *							<id>orga</id>
     *                    	</params>
     *		                <fields>
     *							<field>
     *								<content>title</content>
     *								<class>pi_tree_desc</class>
     *							</field>
     *							<field>
     *								<content>descriptif</content>
     *								<class></class>
     *							</field>
     *                     	</fields>
     *                  </organigram>
	 *				</params>
	 *			</gedmo>
	 *		</widgets>
	 *	</config>
	 *
	 *
	 *  Pour appeler un arbre semantique
	 *	<?xml version="1.0"?>
	 *	<config>
	 *		<widgets>
	 *			<gedmo>
	 *				<controller>PiAppGedmoBundle:Organigram:org-tree-semantique</controller>
	 *				<params>
	 *					<enabledonly>true</enabledonly>
	 *					<category>Quand le déménagament doit-il avoir lieu ?</category>
	 *					<template>organigram-semantique.html.twig</template>
	 *	                <cachable>false</cachable>
	 *					<organigram>
	 *						<params>
	 *							<action>renderDefault</action>
	 *							<menu>tree</menu>
	 *							<id>orga</id>
	 *						</params>
	 *					</organigram>
	 *				</params>
	 *			</gedmo>
	 *		</widgets>
	 *		<advanced>
	 *			<roles>
	 *				<role>ROLE_VISITOR</role>
	 *				<role>ROLE_USER</role>
	 *				<role>ROLE_ADMIN</role>
	 *				<role>ROLE_SUPER_ADMIN</role>
	 *			</roles>
	 *		</advanced>
	 *	</config>	 
	 *
	 * </code>
	 * 
	 * @param	array $options
	 * @access public
	 * @return void
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-04-20
	 */
	public function renderOrganigram($options = null)
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
	
		// if the gedmo widget is defined correctly as an "organigram"
		if( ($this->action == "organigram") && $xmlConfig->widgets->get('gedmo') && $xmlConfig->widgets->gedmo->get('controller') && $xmlConfig->widgets->gedmo->get('params')  )
		{
			$controller	= $xmlConfig->widgets->gedmo->controller;
			
			if($this->isAvailableAction($controller)){
				//$render_navigation = $this->method . "Action";
			
				if($xmlConfig->widgets->gedmo->params->get('category'))
					$category = $xmlConfig->widgets->gedmo->params->category;
				else
					$category = "";
				
				if($xmlConfig->widgets->gedmo->params->get('node'))
					$params['node'] = $xmlConfig->widgets->gedmo->params->node;
				else
					$params['node'] = "";
				
				if($xmlConfig->widgets->gedmo->params->get('enabledonly'))
					$params['enabledonly'] = $xmlConfig->widgets->gedmo->params->enabledonly;
				else
					$params['enabledonly'] = "true";
				
				if($xmlConfig->widgets->gedmo->params->get('cachable'))
					$params['cachable'] = $xmlConfig->widgets->gedmo->params->cachable;
				else
					$params['cachable'] = 'true';

				if($xmlConfig->widgets->gedmo->params->get('template'))
					$template = $xmlConfig->widgets->gedmo->params->template;
				else
					$template = "";
				
				$params['entity'] 	= $this->entity;
				$params['category'] = $category;
				$params['template'] = $template;
			
				if($xmlConfig->widgets->gedmo->params->get('organigram')){

					if($xmlConfig->widgets->gedmo->params->organigram->get('params'))
						$params = array_merge($params, $xmlConfig->widgets->gedmo->params->organigram->params->toArray());
					
					if($xmlConfig->widgets->gedmo->params->organigram->get('fields') && $xmlConfig->widgets->gedmo->params->organigram->fields->get('field'))
					{
						$params['fields'] = $xmlConfig->widgets->gedmo->params->organigram->fields->field->toArray();
					}
					
					if($params['cachable'] == 'true')
						return $this->runByExtension('pi_app_admin.manager.tree', $this->action, "$this->entity~$this->method~$category", $lang, $params);
					else
						return $this->runByjqueryExtension("MENU", "$this->entity~$this->method~$category", $lang, $params);
				}else
					throw ExtensionException::optionValueNotSpecified("gedmo navigation", __CLASS__);
			}else
				throw ExtensionException::optionValueNotSpecified("gedmo template", __CLASS__);			
		}else
			throw ExtensionException::optionValueNotSpecified("gedmo", __CLASS__);
	}	

	/**
	 * Sets the render of the slider action.
	 *
	 * <code>
	 *	<?xml version="1.0"?>
	 *	<config>
	 *		<widgets>
	 *			<gedmo>
	 *				<controller>PiAppGedmoBundle:Slider:slide-default</controller>
	 *				<params>
	 *					<category>new</category>
	 *					<template>slide.html.twig</template>
	 *					<cachable>true</cachable>
     *                  <slider>
 	 *                  	<action>renderDefault</action>
     *						<menu>entity</menu>
     *						<id>flexslider</id>
	 *	                  	<orderby_date></orderby_date>
     *	                  	<orderby_position>ASC</orderby_position>
     *		                <params>
     *		                  	<animation>slide</animation>
     *							<slideDirection>horizontal</slideDirection>
     *							<slideshow>true</slideshow>
     *							<slideToStart>0</slideToStart>
     *							<redirection>false</redirection>
     *							<slideshowSpeed>6000</slideshowSpeed>
     *							<animationDuration>800</animationDuration>
     *							<directionNav>true</directionNav>
     *							<pauseOnAction>true</pauseOnAction>
     *							<pausePlay>true</pausePlay>
     *							<controlNav>true</controlNav>
     *                    	</params>
     *                  </slider>
	 *				</params>
	 *			</gedmo>
	 *		</widgets>
	 *	</config>
	 * </code>
	 * 
	 * @param	$options	tableau d'options.
	 * @access public
	 * @return void
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public function renderSlider($options = null)
	{
		$xmlConfig			= $this->getConfigXml();
		$lang				= $options['widget-lang'];
	
		// if the configXml field of the widget isn't configured correctly.
		try {
			$xmlConfig	= new \Zend_Config_Xml($xmlConfig);
		} catch (\Exception $e) {
			return "  \n";
		}
	
		// if the gedmo widget is defined correctly as an "organigram"
		if( ($this->action == "slider") && $xmlConfig->widgets->get('gedmo') && $xmlConfig->widgets->gedmo->get('controller') && $xmlConfig->widgets->gedmo->get('params')  )
		{
			$controller	= $xmlConfig->widgets->gedmo->controller;
			
			if($this->isAvailableAction($controller)){
			
				if($xmlConfig->widgets->gedmo->params->get('category'))
					$category = $xmlConfig->widgets->gedmo->params->category;
				else
					$category = "";
				
				if($xmlConfig->widgets->gedmo->params->get('template'))
					$template = $xmlConfig->widgets->gedmo->params->template;
				else
					$template = "";		

				$params = array();
				if($xmlConfig->widgets->gedmo->params->get('slider')){

					$params = $xmlConfig->widgets->gedmo->params->slider->toArray();
					$params['entity'] 	 = $this->entity;
					$params['category']  = $category;
					$params['template']  = $template;
					
					if($xmlConfig->widgets->gedmo->params->get('cachable'))
						$params['cachable'] = $xmlConfig->widgets->gedmo->params->cachable;
					else
						$params['cachable'] = 'true';					
					
					if($xmlConfig->widgets->gedmo->params->slider->get('params'))
					{
						$params['params'] = $xmlConfig->widgets->gedmo->params->slider->params->toArray();
					}					
					
					if(!isset($params['action']) || empty($params['action']))
						$params['action']   = 'renderDefault';
					if(!isset($params['menu']) || empty($params['menu']))
						$params['menu']     = 'entity';
					
					if($params['cachable'] == 'true')
						return $this->runByExtension('pi_app_admin.manager.slider', $this->action, $this->entity."~".$this->method."~".$category, $lang, $params);
					else
						return $this->runByService('pi_app_admin.manager.slider', $this->entity."~".$this->method."~".$category, $lang, $params);
										
				}else
					throw ExtensionException::optionValueNotSpecified("gedmo navigation", __CLASS__);
			}else
				throw ExtensionException::optionValueNotSpecified("gedmo template", __CLASS__);			
		}else
			throw ExtensionException::optionValueNotSpecified("gedmo", __CLASS__);
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