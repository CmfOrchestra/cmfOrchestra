<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Managers
 * @package    Manager
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-23
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Manager;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response as Response;

use PiApp\AdminBundle\Builder\PiWidgetManagerBuilderInterface;
use PiApp\AdminBundle\Manager\PiCoreManager;
use PiApp\AdminBundle\Entity\Widget;

/**
 * Description of the Widget manager
 *
 * @category   Admin_Managers
 * @package    Manager
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiWidgetManager extends PiCoreManager implements PiWidgetManagerBuilderInterface 
{    
	/**
	 * Constructor.
	 *
	 * @param ContainerInterface $container The service container
	 */
	public function __construct(ContainerInterface $container)
	{
		parent::__construct($container);
	}
	
	/**
	 * Returns the render source of a widget.
	 *
	 * @param int 		$id		id widget
	 * @param string 	$lang	language
	 *
	 * @return string	widget content
	 * @access	public
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-02-15
	 */
	public function exec($id, $lang = "")
	{
		if(!empty($lang))
			$this->language = $lang;
		
		// we get the current Widget.
		$widget	 = $this->getRepository('Widget')->findOneById($id);
		
		// we set the current result
		$this->setCurrentWidget($widget);
	
		// we return the render (cache or not)
		return $this->render($this->language);
	}	
	
	/**
	 * Returns the render of the current widget.
	 *
	 * @param string $lang
	 * 
	 * @return string
	 * @access	public
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-01-23
	 */
	public function render($lang = '')
	{
		// we set the langue
		if(empty($lang))	$lang = $this->language;
		
		// 	Initialize widget
		if ($this->getCurrentWidget())
			$widget = $this->getCurrentWidget();
		else
			throw new \InvalidArgumentException("you don't have set the current widget !");
		
		// 	Initialize response
		$response = $this->getResponseByIdAndType('widget', $widget->getId());
		
		// we get the translation of the current widget in terms of the lang value.
		//$widgetTrans		= $this->getTranslationByWidgetId($widget->getId(), $lang);		
		
		// Handle 404
		// We don't show the widget if :
		// * the widget doesn't exist.
		// * The widget doesn't have a translation set.
		if (!$widget || !$this->isWidgetSupported($widget)) {
			$transWidgetError 	= $this->getRepository('translationWidget')->getTranslationByParams(1, 'content', 'error', $lang);
			if (!$transWidgetError)
				throw new \InvalidArgumentException("We haven't set in the data fixtures the error widget message in the $lang locale !");
			
			$response->setStatusCode(404);
			
			// We set the Etag value
			$id			= $transWidgetError->getId();
			$this->setEtag("transwidget:$id:$lang");
			
			// create a Response with a Last-Modified header
			$response	= $this->configureCache($transWidgetError, $response);			
		}else{
			// We set the Etag value
			$id			= $widget->getId();
			$this->setEtag("widget:$id:$lang");
			
			// create a Response with a Last-Modified header
			$response	= $this->configureCache($widget, $response);			
		}
		
		// Check that the Response is not modified for the given Request
		if ($response->isNotModified($this->container->get('request'))){
			// return the 304 Response immediately
			return $response;
		} else {
			// if the widget has translation OR if the widget calls a snippet
			if( $widget && $this->isWidgetSupported($widget) ){
				$response = $this->container->get('pi_app_admin.caching')->renderResponse($this->Etag, array('widget' => $widget), $response);
				// We set the reponse
				$this->setResponse($widget, $response);
			}else{
				// or render the error template with the $response you've already started
				$response = $this->container->get('pi_app_admin.caching')->renderResponse($this->Etag, array('transwidget' => $transWidgetError), $response);
			}

			// we don't send the header but the content only.
			return $response->getContent();
		}
	}
	
	/**
	 * Returns the render source of one widget.
	 *
	 * @param string $id
	 * @param string $lang
	 * @param array	 $params
	 * @return string
	 * @access	public
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-01-31
	 */
	public function renderSource($id, $lang = '', $params = null)
	{
		// we get the translation of the current page in terms of the lang value.
		$this->getWidgetById($id);	
		
		$container 		= $this->getCurrentWidget()->getPlugin();
		$NameAction		= $this->getCurrentWidget()->getAction();
		$id				= $this->getCurrentWidget()->getId();
		$cssClass		= $this->getCurrentWidget()->getConfigCssClass();
		//$configureXml	= $this->container->get('pi_app_admin.string_manager')->filtreString($this->getCurrentWidget()->getConfigXml());
		
// 		$options = array(
// 			'widget-id' => $id
// 		);
// 		$source = $this->extensionWidget->FactoryFunction(strtoupper($container), strtolower($NameAction), $options);

		if(!empty($cssClass))
			$source  = " <orchestra class=\"{$cssClass}\"> \n";
		else
			$source  = " <orchestra> \n";
		
		$source .= "     {% set options = {'widget-id': '$id', 'widget-lang': '$lang'} %} \n";
		$source .= "     {{ renderWidget('".strtoupper($container)."', '".strtolower($NameAction)."', options )|raw }} \n";
		
		if(!empty($cssClass))
			$source .= " </orchestra> \n";
		else
			$source .= " </orchestra> \n";
		
		return $source;
	}
	
	/**
	 * Sets js and css script of the widget.
	 *
	 * @return void
	 * @access	public
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-02-16
	 */
	public function setScript()
	{
		$container  = strtoupper($this->getCurrentWidget()->getPlugin());
		$NameAction	= strtolower($this->getCurrentWidget()->getAction());
		
		// If the widget is a "gedmo snippet"
		if( ($container == 'CONTENT') && ($NameAction == 'snippet') )	{
			// if the configXml field of the widget is configured correctly.
			try {
				$xmlConfig	= new \Zend_Config_Xml($this->getCurrentWidget()->getConfigXml());
				if($xmlConfig->widgets->get('content')){
					$snippet_widget = $this->getWidgetById($xmlConfig->widgets->content->id);
					$container  	= strtoupper($snippet_widget->getPlugin());
					$NameAction		= strtolower($snippet_widget->getAction());
				}
			} catch (\Exception $e) {
			}			 
		}
		// If the widget is a "gedmo snippet"
		elseif( ($container == 'GEDMO') && ($NameAction == 'snippet') )	{
			// if the configXml field of the widget is configured correctly.
			try {
				$xmlConfig	= new \Zend_Config_Xml($this->getCurrentWidget()->getConfigXml());
				if($xmlConfig->widgets->get('gedmo')){
					$snippet_widget = $this->getWidgetById($xmlConfig->widgets->gedmo->id);
					$container  	= strtoupper($snippet_widget->getPlugin());
					$NameAction		= strtolower($snippet_widget->getAction());
				}
			} catch (\Exception $e) {
			}
		}		
	
		$this->script['js'][$container.$NameAction]		= $this->extensionWidget->ScriptJsFunction($container, $NameAction);
		$this->script['css'][$container.$NameAction]	= $this->extensionWidget->ScriptCssFunction($container, $NameAction);
	}

	/**
	 * Sets init the widget.
	 *
	 * @return string
	 * @access	public
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-02-16
	 */
	public function setInit()
	{
		$container  = strtoupper($this->getCurrentWidget()->getPlugin());
		$NameAction	= strtolower($this->getCurrentWidget()->getAction());
		$method     = ":";
		
		$xmlConfig	= $this->getCurrentWidget()->getConfigXml();
		
		// if the configXml field of the widget isn't configured correctly.
		try {
			$xmlConfig	= new \Zend_Config_Xml($xmlConfig);
		} catch (\Exception $e) {
			return "  \n";
		}
		
		if( $xmlConfig->widgets->get('gedmo') && $xmlConfig->widgets->gedmo->get('controller') ){
			$controller	= $xmlConfig->widgets->gedmo->controller;
			$values 	= explode(':', $controller);
			$entity 	= strtolower($values[1]);
			$method    .= strtolower($values[2]);
			$this->script['init'][$container.$NameAction.$method]	=  "{% initWidget('". $container . ":" . $NameAction . $method ."') %}";
		}elseif( $xmlConfig->widgets->get('content') && $xmlConfig->widgets->content->get('controller') ){
			$controller	= $xmlConfig->widgets->content->controller;
			str_replace(':', ':', $controller, $count);
			if($count == 1)
				$this->script['init'][$container.$NameAction.$method]	=  "{% initWidget('". $container . ":" . $NameAction . ":" . $controller ."') %}";
		}elseif( $xmlConfig->widgets->get('search') && $xmlConfig->widgets->search->get('controller') ){
			$controller	= $xmlConfig->widgets->search->controller;
			str_replace(':', ':', $controller, $count);
			if($count == 1)
				$this->script['init'][$container.$NameAction.$method]	=  "{% initWidget('". $container . ":" . $NameAction . ":" . $controller ."') %}";
		}else
			$this->script['init'][$container.$NameAction.$method]	=  "{% initWidget('". $container . ":" . $NameAction . $method ."') %}";
	}	
	
	/**
	 * Sets widget translations.
	 *
	 * @param \PiApp\AdminBundle\Entity\Widget $widget
	 *
	 * @return array\PiApp\AdminBundle\Entity\TranslationWidget
	 * @access protected
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-02-13
	 */
	protected function setWidgetTranslations(Widget $widget)
	{
		$all_translations = $widget->getTranslations();
				
		$this->translationsWidget[$widget->getId()] = null;
		if($all_translations instanceof \Doctrine\ORM\PersistentCollection){
			// records all translations
			foreach ($all_translations as $translation) {
				$this->translationsWidget[$widget->getId()][$translation->getLangCode()->getId()] = $translation;
			}
		}		
		return $this->translationsWidget[$widget->getId()];
	}	
	
	/**
	 * Sets the response to one widget.
	 * 
	 * @param \PiApp\AdminBundle\Entity\Widget $widget
	 * @param \Symfony\Component\HttpFoundation\Response $response
	 *
	 * @return void
	 * @access private
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-01-31
	 */
	private function setResponse($widget, Response $response)
	{
		$this->responses['widget'][$widget->getId()] = $response;
	}		
}