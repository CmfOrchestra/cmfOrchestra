<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Twig
 * @package    Extension_widget
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-11
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;

use PiApp\AdminBundle\Twig\TokenParser\StyleSheetWidgetTokenParser;
use PiApp\AdminBundle\Exception\ExtensionException;
use PiApp\AdminBundle\Entity\TranslationWidget;

// Matrix des differents validateurs définis.
$GLOBALS['WIDGET']['CONTENT'] = array(
		'snippet'		=> 'pi_app_admin.widget_manager.content.snippet',
		'text' 			=> 'pi_app_admin.widget_manager.content.text',
		'media'			=> 'pi_app_admin.widget_manager.content.media',
		'jqext'			=> 'pi_app_admin.widget_manager.content.jqext',
);

$GLOBALS['WIDGET']['GEDMO'] = array(
		'snippet'		=> 'pi_app_admin.widget_manager.gedmo.snippet',
		'listener'		=> 'pi_app_admin.widget_manager.gedmo.listener',
		'navigation'	=> 'pi_app_admin.widget_manager.gedmo.navigation',
		'organigram'	=> 'pi_app_admin.widget_manager.gedmo.organigram',
		'slider'		=> 'pi_app_admin.widget_manager.gedmo.slider',
);

$GLOBALS['WIDGET']['SEARCH'] = array(
		'lucene'		=> 'pi_app_admin.widget_manager.search.lucene',
);

$GLOBALS['WIDGET']['USER'] = array(
		'connexion'		=> 'pi_app_admin.widget_manager.user.connexion',
);

$GLOBALS['WIDGET']['TAB'] = array(
);

/**
 * Widget Matrix used in twig
 *
 * @category   Admin_Twig
 * @package    Extension_widget 
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiWidgetExtension extends \Twig_Extension
{
	/**
	 * Content de rendu du script.
	 *
	 * @static
	 * @var int
	 * @access  private
	 */
	protected static $_content;	
	
	/**
	 * @var \Symfony\Component\DependencyInjection\ContainerInterface
	 * @access  protected
	 */
	protected $container;
	
	/**
	 * @var \PiApp\AdminBundle\Manager\PiWidgetManager
	 */
	protected $widgetManager;	
	
	/**
	 * @var \PiApp\AdminBundle\Manager\PiTransWidgetManager
	 */
	protected $transWidgetManager;
	
	/**
	 * @var \PiApp\AdminBundle\Entity\TranslationWidget
	 */
	protected $translationsWidget;	
	
	/**
	 * @var service widget extension manager called
	 */	
	protected $serviceWidget;
	
	/**
	 * @var String Entity Name
	 * @access  protected
	 */
	protected $entity;

	/**
	 * @var String Method Name
	 * @access  protected
	 */
	protected $method;	
	
	/**
	 * @var String Action Name
	 * @access  protected
	 */
	protected $action;
	
	/**
	 * @var int	id widget value
	 */
	protected $id;	

	/**
	 * @var string configXml widget value
	 */	
	protected $configXml;

	/**
	 * @var string service name
	 */	
	private $service;
	
	/**
	 * @var \Symfony\Component\Locale\Locale
	 */
	protected $language;	
	
	/**
	 * Return list of available widget plugins.
	 *
	 * @return array
	 * @access public
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2011-12-28
	 */
	public static function getAvailableWidgetPlugins()
	{
		return array(
			'content'		=>'Content',
			'gedmo'			=>'Gedmo',
 			'search'		=>'Search',
 			'user'			=>'User',
// 			'tab'			=>'Tab',
		);
	}	
	
	/**
	 * Return list of available widget plugins.
	 *
	 * @return array
	 * @access public
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2011-12-28
	 */
	public static function getDefaultConfigXml()
	{
		$source  =  "<?xml version=\"1.0\"?>\n";
		$source .=  "<config>\n";
		$source .=  "	<widgets>\n";
		
		/////////// USER WIDGET
		$source .=  "		<user>\n";
		$source .=  "			<controller>BootStrapUserBundle:User:_connexion_default</controller>\n";
		$source .=  "			<template>FOSUserBundle:Security:login.html.twig</template>\n";
		$source .=  "		</user>\n";
				
		/////////// CONTENT WIDGET
		$source .=  "		<content>\n";
		// snippet parameters
		$source .=  "			<id></id>\n";
		$source .=  "			<snippet>false</snippet>\n";		
		// jquery extenstion parameters 
		$source .=  "			<controller>TWITTER:tweets_blog</controller>\n";
		$source .=  "			<params>\n";
		$source .=  "				<cachable>true</cachable>\n";
		$source .=  "				<template></template>\n"; 
		$source .=  "				<enabledonly>true</enabledonly>\n";
		$source .=  "			</params>\n";
		// media parameters
		$source .=  "			<media>\n";
		$source .=  "				<format>default_small</format>\n";
		$source .=  "				<align>right</align>\n";
		$source .=  "				<class>maclass</class>\n";
		$source .=  "				<link>MonImage</link>\n";
		$source .=  "			</media>\n";
		$source .=  "		</content>\n";
		
		/////////// SEARCH WIDGET
		$source .=  "		<search>\n";
		$source .=  "			<controller>LUCENE:search-lucene</controller>\n";
		$source .=  "			<params>\n";
		$source .=  "				<cachable>false</cachable>\n";
		$source .=  "				<template>searchlucene-result.html.twig</template>\n";
		$source .=  "				<MaxResults></MaxResults>\n";
		// lucene parameters
		$source .=  "				<lucene>\n";
		$source .=  "					<action>renderDefault</action>\n";
		$source .=  "					<menu>searchlucene</menu>\n";
		$source .=  "					<searchBool>true</searchBool>\n";
		$source .=  "					<searchBoolType>AND</searchBoolType>\n";
		$source .=  "					<searchByMotif>true</searchByMotif>\n";
		$source .=  "					<setMinPrefixLength>0</setMinPrefixLength>\n";
		$source .=  "					<getResultSetLimit>0</getResultSetLimit>\n";
		$source .=  "					<searchFields>\n";
		$source .=  "						<sortField>Contents</sortField>\n";
		$source .=  "						<sortType>SORT_STRING</sortType>\n";
		$source .=  "						<sortOrder>SORT_ASC</sortOrder>\n";
		$source .=  "					</searchFields>\n";
		$source .=  "					<searchFields>\n";
		$source .=  "						<sortField>Key</sortField>\n";
		$source .=  "						<sortType>SORT_NUMERIC</sortType>\n";
		$source .=  "						<sortOrder>SORT_DESC</sortOrder>\n";
		$source .=  "					</searchFields>\n";
		$source .=  "				</lucene>\n";
		$source .=  "			</params>\n";
		$source .=  "		</search>\n";	
		
		/////////// GEDMO WIDGET
		$source .=  "		<gedmo>\n";
		// snippet parameters
		$source .=  "			<id></id>\n";
		$source .=  "			<snippet>false</snippet>\n";
		// navigation and organigram and slider common parameters				
		$source .=  "			<controller>PiAppGedmoBundle:Activity:_template_list</controller>\n";
		$source .=  "			<params>\n";
		$source .=  "				<id></id>\n";
		$source .=  "				<node></node>\n";
		$source .=  "				<enabledonly>true</enabledonly>\n";
		$source .=  "				<category></category>\n";
		$source .=  "				<template></template>\n"; 
		$source .=  "				<MaxResults></MaxResults>\n";
		$source .=  "				<order>DESC</order>\n";
		$source .=  "				<cachable>true</cachable>\n";
		// navigation parameters		
		$source .=  "				<navigation>\n";
		$source .=  "					<separatorClass>separateur</separatorClass>\n";
		$source .=  "					<separatorText><![CDATA[ &ndash; ]]></separatorText>\n";
		$source .=  "					<separatorFirst>false</separatorFirst>\n";
		$source .=  "					<separatorLast>false</separatorLast>\n";
		$source .=  "					<ulClass>infoCaption</ulClass>\n";
		$source .=  "					<liClass>menuContainer</liClass>\n";
		$source .=  "					<counter>true</counter>\n";
		$source .=  "					<routeActifMenu>\n";
		$source .=  "						<liActiveClass></liActiveClass>\n";
		$source .=  "						<liInactiveClass></liInactiveClass>\n";
		$source .=  "						<aActiveClass></aActiveClass>\n";
		$source .=  "						<aInactiveClass></aInactiveClass>\n";
		$source .=  "						<enabledonly>true</enabledonly>\n";
		$source .=  "					</routeActifMenu>\n";
		$source .=  "					<lvlActifMenu>\n";
		$source .=  "						<liActiveClass></liActiveClass>\n";
		$source .=  "						<liInactiveClass></liInactiveClass>\n";
		$source .=  "						<aActiveClass></aActiveClass>\n";
		$source .=  "						<aInactiveClass></aInactiveClass>\n";
		$source .=  "						<enabledonly>true</enabledonly>\n";
		$source .=  "					</lvlActifMenu>\n";
		$source .=  "				</navigation>\n";
		// organigram parameters
		$source .=  "				<organigram>\n";
		$source .=  "					<params>\n";
		$source .=  "						<action>renderDefault</action>\n";
		$source .=  "						<menu>organigram</menu>\n";
		$source .=  "						<id>orga</id>\n";
		$source .=  "					</params>\n";
		$source .=  "					<fields>\n";
		$source .=  "						<field>\n";
		$source .=  "							<content>title</content>\n";
		$source .=  "							<class>pi_tree_desc</class>\n";
		$source .=  "						</field>\n";
		$source .=  "						<field>\n";
		$source .=  "							<content>descriptif</content>\n";
		$source .=  "						</field>\n";
		$source .=  "					</fields>\n";
		$source .=  "				</organigram>\n";
		// slider parameters
		$source .=  "				<slider>\n";
		$source .=  "					<action>renderDefault</action>\n";
		$source .=  "					<menu>entity</menu>\n";
		$source .=  "					<id>flexslider</id>\n";
		$source .=  "					<boucle_array>false</boucle_array>\n";
		$source .=  "					<orderby_date></orderby_date>\n";
		$source .=  "					<orderby_position>ASC</orderby_position>\n";
		$source .=  "					<MaxResults>4</MaxResults>\n";
		$source .=  "					<searchFields>\n";
		$source .=  "                      	<nameField>field1</nameField>\n";
		$source .=  "                      	<valueField>value1</valueField>\n";
		$source .=  "                   </searchFields>\n";
		$source .=  "					<searchFields>\n";
		$source .=  "                      	<nameField>field2</nameField>\n";
		$source .=  "                      	<valueField>value2</valueField>\n";
		$source .=  "                   </searchFields>\n";
		$source .=  "					<params>\n";
		$source .=  "						<animation>slide</animation>\n";
		$source .=  "						<direction>horizontal</slideDirection>\n";
		$source .=  "						<slideshow>true</slideshow>\n";
		$source .=  "						<redirection>false</redirection>\n";
		$source .=  "						<startAt>0</slideToStart>\n";
		//$source .=  "						<easing>swing</easing>\n";
		$source .=  "						<slideshowSpeed>6000</slideshowSpeed>\n";
		$source .=  "						<animationSpeed>800</animationDuration>\n";
		$source .=  "						<directionNav>true</directionNav>\n";
		$source .=  "						<pauseOnAction>false</pauseOnAction>\n";
		$source .=  "						<pauseOnHover>true</pauseOnHover>\n";
		$source .=  "						<pausePlay>true</pausePlay>\n";
		$source .=  "						<controlNav>true</controlNav>\n";
		$source .=  "						<minItems>1</minItems>\n";
		$source .=  "						<maxItems>1</maxItems>\n";
		$source .=  "					</params>\n";
		$source .=  "				</slider>\n";
		$source .=  "			</params>\n";
		$source .=  "		</gedmo>\n";
		
		$source .=  "	</widgets>\n";
		$source .=  "	<advanced>\n";
		$source .=  "		<roles>\n";
		$source .=  "			<role>ROLE_VISITOR</role>\n";
		$source .=  "			<role>ROLE_USER</role>\n";
		$source .=  "			<role>ROLE_ADMIN</role>\n";
		$source .=  "			<role>ROLE_SUPER_ADMIN</role>\n";
		$source .=  "		</roles>\n";
		$source .=  "	</advanced>\n";
		$source .=  "</config>\n";
		
		return $source;
	}	
	
	/**
	 * Constructor.
	 *
	 * @param ContainerInterface $container The service container
     * @param  string 		$container			name of widget container.
     * @param  string 		$actionName			name of action.
     * 
     * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 */
	public function __construct(ContainerInterface $containerService, $container = 'CONTENT', $action = 'text')
	{
		$this->container = $containerService;
		$this->language	 = $this->container->get('session')->getLocale();
		
		if (isset($GLOBALS['WIDGET'][strtoupper($container)][strtolower($action)]))
			$this->action 	 = $action;
		else
			throw ExtensionException::serviceNotConfiguredCorrectly();
	}	
	
    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     * @access public
     * @final
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
	final public function getName()
	{
		return 'admin_widget_extension';
	}
	
	/**
	 * Returns the name of the extension.
	 *
	 * @return string The extension name
	 * @access public
	 * @final
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	final public function getAction()
	{
		return $this->action;
	}	
	
	/**
	 * Sets the method
	 *
	 * @return string The extension name
	 * @access public
	 * @final
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	final public function setMethod($method)
	{
		$this->method = $method;
	}	
		
    /**
     * Returns a list of functions to add to the existing list.
     *
     * <code>
     *  {% set options = {'widget-id': 1} %}
	 *  {{ renderWidget('CONTENT', 'text', options )|raw }}
     * </code>
     *
     * @return array An array of functions
     * @access public
     * @final
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    final public function getFunctions()
    {
    	return array(
    			'renderWidget'  	=> new \Twig_Function_Method($this, 'FactoryFunction'),
    			'renderJs'  		=> new \Twig_Function_Method($this, 'ScriptJsFunction'),
    			'renderCss'  		=> new \Twig_Function_Method($this, 'ScriptCssFunction'),
    	);
    }
    
    /**
     * Returns the token parsers
     *
     * <code>
     * 	{%  initWidget 'CONTENT:text' %} to execute the init method of the service.
     * </code>
     *
     * @return string The extension name
     * @access public
     * @final
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    final public function getTokenParsers()
    {
    	return array(
    			new StyleSheetWidgetTokenParser($this->getName()),
    	);
    }    
    
    /**
     * Callbacks
     */
    
    /**
     * Factory ! We check that the requested class is a valid service.
     *
     * @param  string 		$container			name of widget container.
     * @param  string 		$actionName			name of action.
     * @param  array		$options			validator options.
     * @return service
     * @access public
     * @final
     * 
     * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     */
    final public function FactoryFunction($container, $actionName, $options = null)
    {
    	if($this->isServiceSupported($container, $actionName)){
	    	// Gestion des options
	    	if(!isset($options['widget-id']) || empty($options['widget-id']))
	    		throw ExtensionException::optionValueNotSpecified('widget-id', __CLASS__);
	    	if(!isset($options['widget-lang']) || empty($options['widget-lang']))
	    		throw ExtensionException::optionValueNotSpecified('widget-lang', __CLASS__);
	    	
	    	// we set params
	    	$this->setParams($options);
	    	
	    	$method = "render" . ucfirst($this->action);
	    	
	    	//print_r($method);
	    	//print_r($this->getServiceWidget()->getAction());
	    	//print_r($this->action);
	    	//print_r($this->service);
	    	//print_r($container);
	    	//print_r($actionName);
	    	
	    	if(method_exists($this->serviceWidget, $method))
	    		return $this->getServiceWidget()->$method($options);
	    	elseif(method_exists($this->serviceWidget, 'render'))
	    		return $this->getServiceWidget()->run($options);
	    	else 
	    		throw ExtensionException::MethodWidgetUnDefined($method);
    	}
    }
    
    /**
     * Sets the Widget translation and the id of the util widget service manager called.
     *
     * @return void
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-14
     */
    protected function setParams($options)
    {
    	// we set the id widget.
    	$this->getServiceWidget()->setId($options['widget-id']);
    	// we get the widget manager
    	$widgetManager  = $this->getServiceWidget()->getWidgetManager();
    	// we get the widget entity
    	$widget			= $this->getRepository()->findOneById($this->getServiceWidget()->getId(), 'Widget');
    
    	// we set the current widget entity
    	if($widget instanceof \PiApp\AdminBundle\Entity\Widget){
    		$widgetManager->setCurrentWidget($widget);
    		$this->getServiceWidget()->setConfigXml($widget->getConfigXml());
    	}else
    		throw ExtensionException::IdWidgetUnDefined($this->getServiceWidget()->getId());
    
    	// we set the translation of the current widget
    	$widgetTranslation = $widgetManager->getTranslationByWidgetId($widget->getId(), $options['widget-lang']);
    	if($widgetTranslation instanceof TranslationWidget)
    		$this->getServiceWidget()->setTranslationWidget($widgetTranslation);
    }    
    
    /**
     * Factory ! We check that the requested class is a valid service.
     *
     * @param  string 		$container			name of widget container.
     * @param  string 		$actionName			name of action.
     * @param  array		$options			validator options.
     * @return service
     * @access public
     * @final
     *
     * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     */
    final public function ScriptJsFunction($container, $actionName, $options = null)
    {
    	if($this->isServiceSupported($container, $actionName))
    		if(method_exists($this->getServiceWidget(), 'scriptJs'))
    			return $this->getServiceWidget()->runJs($options);
    }
    
    /**
     * Factory ! We check that the requested class is a valid service.
     *
     * @param  string 		$container			name of widget container.
     * @param  string 		$actionName			name of action.
     * @param  array		$options			validator options.
     * @return service
     * @access public
     * @final
     *
     * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     */
    final public function ScriptCssFunction($container, $actionName, $options = null)
    {
    	if($this->isServiceSupported($container, $actionName))
    		if(method_exists($this->getServiceWidget(), 'scriptCss'))
	    		return $this->getServiceWidget()->runCss($options);
    }    
    
    /**
     * execute the Widget service init method.
     *
     * @param  string 		$InfoService	service information ex : "contenaireName:actionName"
     * @return void
     * @access public
     * @final
     * 
     * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     */
    final public function initWidget($InfoService)
    {
    	$method     = "";
    	$infos 		= explode(":", $InfoService);
    	
    	if(count($infos) <=1)
    		throw ExtensionException::initParameterUndefined($InfoService);
    	
    	$container 	= $infos[0];
    	$actionName	= $infos[1];
    	
    	if(count($infos) == 3)
    		$method	= $infos[2];
    	
    	if(count($infos) == 4)
    		$method	= $infos[2] . ":" . $infos[3];    	
    	
    	if($this->isServiceSupported($container, $actionName)){
    		if(method_exists($this->getServiceWidget(), 'init')){
    			$this->getServiceWidget()->setMethod($method);
    	    	$this->getServiceWidget()->init();
    		}
    	}
    }    

    /**
     * Sets the service and the action names and return true if the service is supported.
     *
     * @param  string 		$container			name of widget container.
     * @param  string 		$actionName			name of action.
     * 
     * @return boolean
     * @access private
     *
     * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     */    
    private function isServiceSupported($container, $actionName)
    {
    	if (!isset($GLOBALS['WIDGET'][strtoupper($container)][strtolower($actionName)]))
    		throw ExtensionException::serviceUndefined(strtolower($actionName), 'WIDGET', __CLASS__);
    	elseif(!$this->container->has($GLOBALS['WIDGET'][strtoupper($container)][strtolower($actionName)]))
    		throw ExtensionException::serviceNotSupported($GLOBALS['WIDGET'][strtoupper($container)][strtolower($actionName)]);
    	
    	$this->service	= $GLOBALS['WIDGET'][strtoupper($container)][strtolower($actionName)];
    	$this->action	= strtolower($actionName);

    	return true;
    }
    
    /**
     * Call the render function of the child class called by service.
     *
     * @return string
     * @access	public
     * @final
     *
     * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     */
    final public function run($options = null)
    {
    	try{
    		return $this->render($options);
    	} catch (\Exception $e) {
    		throw ExtensionException::renderWidgetMethodUndefined('WIDGET');
    	}
    }
    public function render($options = null) {}   
    
    /**
     * Call the render function of the child class called by service.
     *
     * @return string
     * @access public
     * @final
     *
     * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     */
    final public function runJs($options = null)
    {
    	try{
    		return $this->scriptJs($options);
    	} catch (\Exception $e) {
    		throw ExtensionException::renderWidgetMethodUndefined('WIDGET');
    	}
    }
    public function scriptJs($options = null) {
    }

    /**
     * Call the render function of the child class called by service.
     *
     * @return string
     * @access	public
     * @final
     *
     * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     */
    final public function runCss($options = null)
    {
    	try{
    		return $this->scriptCss($options);
    	} catch (\Exception $e) {
    		throw ExtensionException::renderWidgetMethodUndefined('WIDGET');
    	}
    }
    public function scriptCss($options = null) {
    } 
    
    
    /**
     * Sets the id widget.
     *
     * @param int $id	id widget
     * @return void
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function setId($id)
    {
    	$this->id = $id;
    }   

    /**
     * Gets the id widget.
     *
     * @return id widget value
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function getId()
    {
    	return $this->id;
    }
    
    /**
     * Sets the ConfigXml widget.
     *
     * @param string $configXml		configXml widget
     * @return void
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function setConfigXml($configXml)
    {
    	$this->configXml = $configXml;
    }
    
    /**
     * Gets the ConfigXml widget.
     *
     * @return ConfigXml widget value
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function getConfigXml()
    {
    	return $this->configXml;
    }

    /**
     * Gets the language locale.
     *
     * @return language value
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function getLanguage()
    {
    	return $this->language;
    }    

    /**
     * Sets the Widget manager service.
     *
     * @return void
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-14
     */
    protected function setWidgetManager()
    {
    	$this->widgetManager = $this->container->get('pi_app_admin.manager.widget');
    }
    
    /**
     * Gets the Widget manager service
     *
     * @return \PiApp\AdminBundle\Manager\PiWidgetManager
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-14
     */
    protected function getWidgetManager()
    {
    	if(empty($this->widgetManager))
    		$this->setWidgetManager();
    
    	return $this->widgetManager;
    } 
    
    /**
     * Sets the Translation Widget manager service.
     *
     * @return void
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-14
     */
    protected function setTransWidgetManager()
    {
    	$this->transWidgetManager = $this->container->get('pi_app_admin.manager.transwidget');
    }
    
    /**
     * Gets the Translation Widget manager service
     *
     * @return \PiApp\AdminBundle\Manager\PiTransWidgetManager
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-14
     */
    protected function getTransWidgetManager()
    {
    	if(empty($this->transWidgetManager))
    		$this->setTransWidgetManager();
    
    	return $this->transWidgetManager;
    }

    /**
     * Gets the container instance.
     *
     * @return \Symfony\Component\DependencyInjection\ContainerInterface
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function getContainer()
    {
    	return $this->container;
    }    
    
    /**
     * Sets the repository service.
     *
     * @return void
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-14
     */
    protected function setRepository()
    {
    	$this->repository = $this->container->get('pi_app_admin.repository');
    }
    
    /**
     * Gets the repository service.
     *
     * @return ObjectRepository
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-14
     */
    protected function getRepository()
    {
    	if(empty($this->repository))
    		$this->setRepository();
    
    	return $this->repository;
    }    
    
    /**
     * Sets the widget service.
     *
     * @return void
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-14
     */
    protected function setServiceWidget()
    {
    	if(!empty($this->service) && $this->container->has($this->service))
    		$this->serviceWidget = $this->container->get($this->service);
    }
    
    /**
     * Gets the widget service.
     *
     * @return Widget service object
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-14
     */
    protected function getServiceWidget()
    {
    	$this->setServiceWidget();
    	return $this->serviceWidget;
    }   
   
    
    /**
     * Sets the Widget translation.
     *
     * @param \PiApp\AdminBundle\Entity\TranslationWidget	$widgetTranslation
     * @return void
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-14
     */    
    public function setTranslationWidget(TranslationWidget $widgetTranslation)
    {
    	$this->translationsWidget = $widgetTranslation;
    }
    
    /**
     * Gets the Widget translation.
     *
     * @return \PiApp\AdminBundle\Entity\TranslationWidget
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-14
     */
    public function getTranslationWidget()
    {
    	if($this->translationsWidget instanceof TranslationWidget)
    		return $this->translationsWidget;
    	else
    		return false;
    }
    
    /**
     * Returns the render source of a tag by the service extension.
     *
     * @param string	$tag
     * @param string	$id
     * @param string	$lang
     * @param array		$params
     *
     * @return string	extension twig result
     * @access	protected
     *
     * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     * @since 2012-04-19
     */
    protected function runByExtension($serviceName, $tag, $id, $lang, $params = null)
    {
    	if(!is_null($params)){
    		krsort($params);
    		$json = $this->container->get('pi_app_admin.string_manager')->json_encodeDecToUTF8($params);
    		
    		//$tmp = "$tag:$id:$lang:$json";
    		//print_r($tmp);
    		//print_r("<br /<br />");
    		
    		$set  = "{% set widget_render_params = $json %} \n";
    		$set .= " {{ getService('$serviceName').run('$tag', '$id', '$lang', widget_render_params)|raw }} \n";
    	}else
    		$set = " {{ getService('$serviceName').run('$tag', '$id', '$lang')|raw }} \n";	
    	
    	return $set;
    }
    
    /**
     * Returns the render source of a service manager.
     *
     * @param string	$id
     * @param string	$lang
     * @param array		$params
     *
     * @return string	extension twig result
     * @access	protected
     *
     * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     * @since 2012-04-19
     */
    protected function runByService($serviceName, $id, $lang, $params = null)
    {
    	if(!is_null($params)){
    		krsort($params);
    		$json = $this->container->get('pi_app_admin.string_manager')->json_encodeDecToUTF8($params);
    
    		$set  = "{% set widget_service_params = $json %} \n";
    		$set .= " {{ getService('$serviceName').renderSource('$id', '$lang', widget_service_params)|raw }} \n";
    	}else
    		$set = " {{ getService('$serviceName').renderSource('$id', '$lang')|raw }} \n";
    
    	return $set;
    } 

    /**
     * Returns the render source of a jquery extension.
     *
     * @param string	$JQcontainer
     * @param string	$id
     * @param string	$lang
     * @param array		$params
     *
     * @return string	extension twig result
     * @access	protected
     *
     * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     * @since 2012-06-01
     */
    protected function runByjqueryExtension($JQcontainer, $id, $lang, $params = null)
    {
    	str_replace('~', '~', $id, $count);
    	if($count == 2)
    		list($entity, $method, $category) = explode('~', $id);
    	elseif($count == 1)
    		list($entity, $method) = explode('~', $id);
    	elseif($count == 0)
    		$method = $id;
    	else
    		throw new \InvalidArgumentException("you have not configure correctly the attibute id");
    	
    	$params['locale']	= $lang;
    	    	
    	if(!is_null($params)){
    		krsort($params);
		    $json = $this->container->get('pi_app_admin.string_manager')->json_encodeDecToUTF8($params);
		    
    		$set  = "{% set widget_render_params = $json %} \n";
    		$set .= " {{ getService(\"pi_app_admin.twig.extension.jquery\").FactoryFunction(\"$JQcontainer\", \"$method\", widget_render_params)|raw }} \n";
    	}else
    		$set  = " {{ getService(\"pi_app_admin.twig.extension.jquery\").FactoryFunction(\"$JQcontainer\", \"$method\")|raw }} \n";
    
    	return $set;
    }    
}