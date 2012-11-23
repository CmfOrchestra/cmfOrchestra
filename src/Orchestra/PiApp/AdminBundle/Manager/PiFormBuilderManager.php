<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Managers
 * @package    Manager
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-06-26
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Manager;  

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\RedirectResponse;

use PiApp\AdminBundle\Builder\PiFormBuilderManagerInterface;
use PiApp\AdminBundle\Exception\FormbuilderException;

/**
* Description of the Abstract Form builder manager
*
* @category   Admin_Managers
* @package    Manager
*
* @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
*/
class PiFormBuilderManager extends AbstractType implements PiFormBuilderManagerInterface
{
	/**
	 * Variable names of the various blocks of the form.
	 */	
	const CONTENT_RENDER_TITLE	= 'renderTitle';
	const CONTENT_RENDER_DESC	= 'renderDescriptif';	
	const CONTENT_RENDER_FORM	= 'renderForm';
	const SCRIPT_RENDER_FORM	= 'renderScript';
	
	/**
	 * @var \Symfony\Component\DependencyInjection\ContainerInterface
	 */
	protected $container;	
	
	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	protected $_em;	
	
	/**
	 * @var string locale value
	 */
	protected $_locale;	
	
	/**
	 * @var \
	 */	
	protected $_form;
	protected $_data;
	protected $_createentity;
	
	protected $_view;
	protected $_id_widget;
	protected $_id_block;
	protected $_id_form;
	protected $_performName;
	protected $_message;
	protected $_xmlconfig;
	
	protected $_form_template;
	protected $_form_name;
	
	/**
	 * @var \
	 */	
	protected $_controls;
	
	/**
	 * Type of the form
	 *
	 * @var string
	 * @access  protected
	 */
	protected $_type_form;	
	
	/**
	 * @var array
	 * @static
	 */
	protected static $_types_form = array('zend', 'symfony');	
	
	/**
	 * @var ARRAY
	 */
	protected static $_content = array();	
	
	/**
	 * Constructor.
	 *
	 * @param ContainerInterface $container The service container
     * @param  string 		$container			name of formbuiler container.
     * @param  string 		$actionName			name of action.
     * 
     * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-06-26
	 */
	public function __construct(ContainerInterface $containerService, $container = '', $actionName = '', $type_form = '', $form_template = 'model_form_builder.html.twig', $form_name = "myform")
	{
		$this->container		= $containerService;
		$this->_em				= $this->container->get('doctrine')->getEntityManager();
		$this->_locale			= $this->container->get('session')->getLocale();
		$this->_id_widget		= $this->container->get('request')->get('id_widget', null);
		$this->_id_block		= $this->container->get('request')->get('id_block', null);
		$this->_id_form			= $this->container->get('request')->get('id_form', null);
		$this->_form_template	= $form_template;
		$this->_form_name		= $form_name;
		
		if(!empty($container) && !empty($actionName) && $this->isServiceSupported($container, $actionName)){
			$this->_type_form = $type_form;
		}
	}	

	/**
	 * Create the render script.
	 *
	 * @access private
	 * @return void
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 */
	public function renderScript(array $option){}	
	
	/**
	 *
	 *
	 * @access public
	 * @return void
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-09-11
	 */
	public function preEventBindRequest(){}
	
	/**
	 *
	 *
	 * @access public
	 * @return void
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-09-11
	 */
	public function preEventActionForm(array $data){}
	
	/**
	 *
	 *
	 * @access public
	 * @return void
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-09-11
	 */
	public function postEventActionForm(array $data){}	
	
	/**
	 *
	 *
	 * @access public
	 * @return void
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-09-11
	 */
	public function XmlConfigWidget(array $data){
		throw FormbuilderException::MethodUnDefined('createXmlConfig');
	}	
	
	/**
	 * Sets the service and the action names and return true if the service is supported.
	 *
	 * @param  string 		$container			name of widget container.
	 * @param  string 		$actionName			name of action.
	 * @return boolean
	 * @access private
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-06-26
	 */
	private function isServiceSupported($container, $actionName)
	{
		if (!isset($GLOBALS['FORM'][strtoupper($container)][strtolower($actionName)]))
			throw FormbuilderException::serviceUndefined(strtolower($actionName), 'FORM', __CLASS__);
		elseif(!$this->container->has($GLOBALS['FORM'][strtoupper($container)][strtolower($actionName)]))
			throw FormbuilderException::serviceNotSupported($GLOBALS['FORM'][strtoupper($container)][strtolower($actionName)]);
	
		return true;
	}

	/**
	 * Return the name form.
	 *
	 * @access public
	 * @return string
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-09-11
	 */	
	final public function getName()
	{
		return strtolower(str_replace("\\", "", get_class($this)));
	}
	
	/**
	 * Get $_type_form attribut
	 *
	 * @access public
	 * @final
	 * @return string
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-09-11
	 */
	final public function getTypeForm()
	{
		return $this->_type_form;
	}	
	
	/**
	 * Set the block index
	 *
	 * @param string	index of a block of a page.
	 * @access public
	 * @final
	 * @return void
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-09-11
	 */
	final public function setIndexBlock($index)
	{
		$this->_id_block = $index;
	}	
	
	/**
	 * Set the widget index
	 *
	 * @param string	index of a block of a page.
	 * @access public
	 * @final
	 * @return void
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-09-11
	 */
	final public function setIndexWidget($index)
	{
		$this->_id_widget = $index;
	}	
	
	/**
	 * Set the form name
	 *
	 * @param string	form name wgich has been submit.
	 * @access public
	 * @final
	 * @return void
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-09-11
	 */
	final public function setIndexForm($index)
	{
		$this->_id_form = $index;
	}	
	
	/**
	 * Execute the form manager for all models of a container.
	 *
	 * @param  string 		$container			name of widget container.
	 * @return boolean
	 * @access public
	 * @final
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-06-26
	 */	
	final public function executeAllFormByContainer($container)
	{
		if (!isset($GLOBALS['FORM'][strtoupper($container)]))
			throw FormbuilderException::serviceUndefined(strtolower($container), 'FORM', __CLASS__);
		
		$results_form = null;				  
		$all_services = $GLOBALS['FORM'][strtoupper($container)];
		
		foreach($all_services as $key => $service){
			if($this->container->has($service)){
				$options = array(
						'formName'		=> $this->_form_name,
						'formAction'	=> $this->container->get('router')->generate('public_importmanagement_widget', array('NoLayout' => true)),
						'formTitle'		=> $this->container->get('translator')->trans('pi.title'),
						'formSubmit'	=> $this->container->get('translator')->trans('pi.register'),
						//'formDecorator'	=> 'ElementFormGenerate.phtml',
						'DisplayGroup'	=> true,
						//     				'populate'		=> array(
								//     									  'name1'	=> 'Mon nom',
								//     									  'name2'	=> 'Mon prénom',
								//     									  'date'	=> App_Tools_Date::dayDatetime()
								//     								   ),
				);
				$this->container->get($service)->setIndexWidget($this->_id_widget);
				$this->container->get($service)->setIndexBlock($this->_id_block);
				$this->container->get($service)->setIndexForm($this->_id_form);
				$results_form[$key]		= $this->container->get($service)->getContents();
				$results_form[$key][PiFormBuilderManager::CONTENT_RENDER_FORM]	= $this->container->get($service)->execute($options);
				$results_form[$key][PiFormBuilderManager::SCRIPT_RENDER_FORM]	= $this->container->get($service)->renderScript($options);
			}else
				throw FormbuilderException::serviceNotSupported($service);
		}
		
		return $results_form;
	}	

	/**
	 * Execute the form builder.
	 *
	 * <code>
	 *  $options = array(
	 * 			'formName'		=> 'myform',
	 * 			'formAction'	=> '/admin/acl/add/type/role',
     *     		'formTitle'		=> $this->container->get('translator')->trans('List Roles'),
     *     		'formSubmit'	=> $this->container->get('translator')->trans('Register'),
	 * 			'formDecorator'	=> 'ElementForm.phtml',
	 * 			'DisplayGroup'	=> true,
	 *			'populate'		=> array(
	 *								  'name1'	=> 'Mon nom',
	 *								  'name2'	=> 'Mon prénom',
	 *								  'date'	=> App_Tools_Date::dayDatetime()
	 *							   ),
     *    );
     *   $resultform	= $this->container->get('pi_app_admin.formbuilder_manager.model.activity')->run($options);
     * </code>
     * 
     * @param  array		$options	validator options.
     * @return string					form builder result
	 * @access public
	 * @final
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-06-26
	 */	
	final public function execute($options)
	{
		// Chargement de l'action du formulaire.
		if(!isset($options['formAction']) || empty($options['formAction']))
			throw FormbuilderException::optionValueNotSpecified($options['formAction']);
			
		self::$_content = $options;
		
		return $this->_execute();
		
// 		try{
// 			return $this->_execute();
// 		} catch (\Exception $e) {
// 			throw FormbuilderException::formbuilderNotConfiguredCorrectly();
// 		}
	}	

	/**
	 * Execute all steps of the form builder.
	 * 
	 * @access private
	 * @return
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-06-26
	 */
	private function _execute()
	{
		if($this->getTypeForm() == "zend"){
			// Loading of view
			$this->setView();					
			// Set the perform.
			$this->setPerformControls();
		}elseif($this->getTypeForm() == "symfony"){
			// Initialisation du formulaire
			$this->setForm();
		}
		
		// Execute the populate or the actions of the form builder validated.
		$this->setControlAction();	
		// Create the render form.
		$this->renderForm();
		 
		// It returns the content of the form builder.
		return self::$_content['_form_'];
	}	
	
	/**
	 * Loading of view zend_view
	 *
	 * @access private
	 * @return void
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-06-26
	 */
	private function setView()
	{
		if($this->getTypeForm() == "zend"){
			$foundBundle 	= $this->container->get('kernel')->getBundle('PiAppTemplateBundle');
			$path 			= $foundBundle->getPath() . '/Resources/views/Template/';
			
			$this->_view  	= new \Zend_View(array('basePath' => $path));
			$viewRenderer 	= \Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
			$viewRenderer->setView($this->_view);
		}			
	}	

	/**
	 * Set the perform.
	 * 
	 * @access private
	 * @return
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-06-26
	 */
	private function setPerformControls()
	{
		// Set configuration
		$this->setConfig();
		
		// Loading controls of type "piControl" a form template.
		$this->setControls();
		
		// Form initialization
		$this->setForm();
		
		// Loading Decorator
		$this->setDecorators();		
		
		// Loading form.
		$this->setFormByControls();		
	}
	
	/**
	 * Set Configuration.
	 *
	 * @access private
	 * @return void
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-06-26
	 */
	private function setConfig()
	{
		// Chargement du titre du formulaire.
		if(isset(self::$_content['formTitle']) && !empty(self::$_content['formTitle']))
			$this->_view->formTitle = self::$_content['formTitle'];		
	
		// Chargement du nom du bouton submit.
		if(isset(self::$_content['formSubmit']) && !empty(self::$_content['formSubmit']))			
			$this->_view->formSubmit = self::$_content['formSubmit'];
		
		//$this->_view->translate = $this->container->get('translator');
	}	
	
	/**
	 * Loading controls of type "piControl" a form template.
	 *
	 * @access private
	 * @return void
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-06-26
	 */
	private function setControls()
	{
		if($this->getTypeForm() == "zend")
			$this->_controls = $this->getControls();
	}	
	
	/**
	 * Loading controls of type "piControl" a form template.
	 *
	 * @access private
	 * @return string	$template	Chemin du template du formulaire Ã  générer.
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-06-26
	 */
	private function getControls()
	{
		$template = $this->load();
		return $template->xpath('//piControl');
	}
	
	/**
	 * Loading a template form.
	 *
	 * @access	private
	 * @return	SimpleXMLElement 	Objet comportant tous les contrÃ´les du template Ã  parser.
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-06-26
	 */
	private function load()
	{
		$buildFormContents 	= $this->buildFormZend();
		$cleanContent 		= preg_replace('/(<\?{1}[pP\s]{1}.+\?>)/', '', $buildFormContents);
		return simplexml_load_string($cleanContent);
	}

	/**
	 * Form initialization.
	 *
	 * @access private
	 * @return void
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-06-26
	 */
	private function setForm()
	{
		if($this->getTypeForm() == "zend")
			$this->_form	 = new \Zend_Form();
		elseif($this->getTypeForm() == "symfony"){
			$parent_class	= "\\" . get_class($this);
			$this->_form	= $this->container->get('form.factory')->create(new $parent_class($this->container));			
		}
	}	

	/**
	 * Create the render form.
	 *
	 * @access private
	 * @return void
	 * 
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 */
	private function renderForm()
	{
		if($this->getTypeForm() == "zend"){
			self::$_content['_form_'] = $this->_form->render();
		}elseif($this->getTypeForm() == "symfony"){
			$response	= $this->container->get('templating')->renderResponse("PiAppTemplateBundle:Template\\Form:{$this->_form_template}", array(
					'form'		=> $this->_form->createView(),
					'id_form'	=> $this->_form->getName(),
					'id_block'	=> $this->_id_block,
					'id_widget'	=> $this->_id_widget,
					'form_name' => $this->_form_name,
			));
			self::$_content['_form_'] = $response->getContent();			
		}
	}	
	
	/**
	 * Initialisation du formulaire
	 *
	 * @access private
	 * @return void
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-06-26
	 */	
	private function setDecorators()
	{
		if(isset(self::$_content['formDecorator']) && !empty(self::$_content['formDecorator']))
			$this->_form->setDecorators( array( array('ViewScript', array('viewScript' => 'Form/'. self::$_content['formDecorator']))));
		else
			$this->_form->setDecorators( array( array('ViewScript', array('viewScript' => 'Form/'. $this->_form_template))));		
	}
	
	/**
	 * Chargement des contrÃ´les via un template de formulaire.
	 *
	 * @access	private
	 * @return	Zend_Form 	Objet du formulaire une foix le template parsé et le formulaire initialisé.
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-06-26
	 */
	private function setFormByControls()
	{
		//set instance
		$Allgroup			= array();
		
// 		$instance 			= $this->_session->_addInstance();
// 		$instanceElement 	= $this->_form->createElement('hidden', 'form_instance');
// 		$instanceElement->setValue($instance);
// 		$this->_form->addElement($instanceElement);
	
		if($this->_controls) {
			foreach ($this->_controls as $control) {
				$attribs 	= $control->attributes();
				$id 		= (string)$attribs['id'];
				$type 		= (string)$attribs['type'];
					
				$this->_AllTypesControls[$type] = $type;
	
				if( ($type == "select")) {
					$opts			= explode(';', (string)$attribs['opt']);
					foreach ($opts as $opts => $values) {
						$v	= explode('_', $values);
						$_o = $v[0];
						$_v = $v[1];
						$options[$_o] 		= $_v;
					}
				}
	
				unset($attribs['id']);
				unset($attribs['type']);
	
				if (isset($attribs['label'])) {
					$label = (string)$attribs['label'];
					unset($attribs['label']);
				} else {
					$label = $id; // $view->getTranslation($id);
					$label = str_replace('_', '_', $label);
				}
	
				$elet_attrib = array();
				if (isset($attribs['size'])) {
					$elet_attrib['size'] = (string)$attribs['size'];
				}
	
				$control = $this->_form->createElement($type, $id, $elet_attrib);
				$control->setLabel($this->container->get('translator')->trans($label))
				->addFilter('StripTags')
				->addFilter('StringTrim');
					
				if(isset($attribs['desc']) && ((string)$attribs['desc'] != '')) {
					$control->setDescription((string)$attribs['desc']);
				}
					
				if(isset($attribs['required']) && ((string)$attribs['required'] == 'true')) {
					$control->setAttrib('required', 'required');
					$control->setRequired(true);
				}
					
				if(isset($attribs['pattern']))
					$control->setAttrib('pattern', (string)$attribs['pattern']);
				if(isset($attribs['maxlength']))
					$control->setAttrib('maxlength', (string)$attribs['maxlength']);
				if(isset($attribs['minlength']))
					$control->setAttrib('minlength', (string)$attribs['minlength']);
				if(isset($attribs['data-equals']))
					$control->setAttrib('data-equals', (string)$attribs['data-equals']);
				if(isset($attribs['rows']))
					$control->setAttrib('rows', (string)$attribs['rows']);
				if(isset($attribs['cols']))
					$control->setAttrib('cols', (string)$attribs['cols']);
				if(isset($attribs['width']))
					$control->setAttrib('width', (string)$attribs['width']);
				if(isset($attribs['class']) && ((string)$attribs['class'] != ''))
					$control->setAttrib('class', (string)$attribs['class']);
				if(isset($attribs['step']))
					$control->setAttrib('step', (string)$attribs['step']);
	
				if($type == "select")
					$control->addMultiOptions($options);
	
				if(isset($attribs['value']))
					$control->setValue($attribs['value']);
	
				$control->setAttrib('rel', isset($attribs['group']) ? (string)$attribs['group'] : 'main');
					
				$this->_form->addElement($control);
					
				if(isset(self::$_content['DisplayGroup']) && (self::$_content['DisplayGroup'] == true )) {
					// set the display group
					$NameGroup = (isset($attribs['group']))? (string)$attribs['group'] : 'main';
					//$this->_form->addDisplayGroup(array($id), $NameGroup, array('legend' => 'Role'));
					if(isset($Allgroup[$NameGroup]) && !empty($Allgroup[$NameGroup]))
						$Allgroup[$NameGroup] = array_merge(array($id), $Allgroup[$NameGroup]);
					else
						$Allgroup[$NameGroup] = array($id);
				}
			}
		} else
			throw new \Zend_Exception("Les controls du formulaire n'ont pas pu Ãªtre chargés !");
			
		foreach ($Allgroup as $Name => $elements) {
			$elements = array_reverse($elements);
			$this->_form->addDisplayGroup($elements, $Name, array('legend' => 'Role'));
		}
	}

	/**
	 * Execute the populate or the actions of the form builder validated.
	 *
	 * @access private
	 * @return Void
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-09-11
	 */
	private function setControlAction()
	{
		// if the form builder is validated after validation.
		if( ($this->isSubmitted()) ) {
			// We execute the actions after submitting the form.
			$this->actionSubmit();	
			// Redirection
			$new_url 	= $this->container->get('bootstrap.RouteTranslator.factory')->getRoute();
			return new RedirectResponse($new_url);
		} else {
			// we create the form builder with populated form values.
			$this->populateForm();
		}
	}		

	/**
	 * Checks whether the form builder is validated after validation.
	 *
	 * @access	private
	 * @return	boolean
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-09-11
	 */
	private function isSubmitted()
	{
		if($this->getName() == $this->_id_form){
			if($this->getTypeForm() == "zend"){
				$form_instance = $this->container->get('request')->query->get('form_instance');
					
				if ($form_instance) {
					$instance = App_Tools_Post::get('form_instance');
					if ($this->_session->_isValidInstance($instance)) {
						// IMPORTANT :: permet d'éviter qu'une instance soit utilisé par un robot pour lancer x fois un même formulaire
						$this->_session->_removeInstance($instance);
						return true;
					}
				}
				return false;
			}elseif($this->getTypeForm() == "symfony"){
				$request = $this->container->get('request');
				if ($request->getMethod() == 'POST') {
					// we apply the pre event bind request
					$this->preEventBindRequest();
					
					// we bind the form
					$this->_form->bindRequest($request);
					
					if($this->_form->isValid())
						return true;
					else
						return false;
				}
				return false;
			}
		}
		return false;
	}	

	/**
	 * Execute the actions after submitting the form.
	 *
	 * @access private
	 * @return void
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-06-26
	 */
	private function actionSubmit()
	{
		// Checks whether the widget has been to be created or updated.
		$this->getPerformName();
	
		// Execute the actions of the form builder validated.
		$this->dispatchAction();
		
		// we set the succes message
		$this->setFlash($this->_message);
	}
	
	/**
	 * Checks whether the widget has been to be created or updated.
	 *
	 * @access private
	 * @return void
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-06-26
	 */
	private function getPerformName()
	{
		$is_Index_exist = $this->is_Index_exist();
		
		if( $is_Index_exist && ($this->_performName == '') ) {
			$this->_performName = 'update';
		}elseif(!$is_Index_exist) {
			$this->_performName = 'insert';
		}
	}
	
	/**
	 * Execute the actions of the form builder validated.
	 *
	 * @access private
	 * @return void
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-09-11
	 */
	private function dispatchAction()
	{
		// we get the values of the form builder validated. 
		if($this->getTypeForm() == "zend"){
			$this->_data = null;
		}elseif($this->getTypeForm() == "symfony"){
			$this->_data = $this->_form->getData();
		}
		
		// we only Execute the actions of the form builder validated. 
		if($this->getName() == $this->_id_form){
			// we Execute the pre event action of the form builder validated.
			$this->preEventActionForm($this->_data);
			
			// we create the xml config value if it is defined in the form builder validated.
			try {
				$XmlConfigWidget = $this->XmlConfigWidget($this->_data);
				if( is_array($XmlConfigWidget) && (count($XmlConfigWidget)>=1) ){					
					\PiApp\AdminBundle\Util\PiArrayManager::init('1.0', 'UTF-8');
					$this->_xmlconfig = \PiApp\AdminBundle\Util\PiArrayManager::createXML('config', $XmlConfigWidget['xml'])->saveXML();
				}else
					$this->_xmlconfig = null;
			} catch (\Exception $e) {
				$this->_xmlconfig = null;
			}
			
			// we create/update a widget if the xml config value is defined.
			try {
				if(!is_null($this->_xmlconfig) && $this->_performName == "insert")
					$this->insertWidget($XmlConfigWidget['plugin'], $XmlConfigWidget['action']);
				elseif(!is_null($this->_xmlconfig) && $this->_performName == "update") {
					$this->updateWidget($XmlConfigWidget['plugin'], $XmlConfigWidget['action']);
				}				
			} catch (\Exception $e) {
			}
			
			// we throw the post event action of the form builder validated.
			$this->postEventActionForm($this->_data);
		}
	}
	
	/**
	 * Sets the flash message.
	 *
	 * @param string $message
	 * @param string $type
	 *
	 * @return void
	 * @access private
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-09-11
	 */
	private function setFlash($message, $type = "")
	{
		$this->container->get('session')->setFlash('notice', $message);
		//$this->_container()->get('session')->setFlash('success', "Mrs/Mlle " . ucfirst($this->getUserName()));
		 
		if(!empty($type))
			$this->container->get('session')->setFlash($type, $message);
	}	
	
	/**
	 * Checks whether the identifier of a widget is blank.
	 *
	 * @access private
	 * @return boolean
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-09-11
	 */
	private function is_Index_exist()
	{
		if(is_null($this->_id_widget) || empty($this->_id_widget))
			return false;
		else
			return true;
	}	

	/**
	 * Populate the form builder validated.
	 *
	 * @access private
	 * @return void
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-06-26
	 */		
	private function populateForm(){}	
	
	/**
	 * Insert widget.
	 *
	 * @param string		$plugin
	 * @param string		$action
	 * @param string		$message
	 * @access private
	 * @return boolean		if the insertion is correct.
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-09-11
	 */
	private function insertWidget($plugin, $action, $message = "pi.session.flash.right.create")
	{
		try {
			$entity  = new \PiApp\AdminBundle\Entity\Widget();
			$block   = $this->_em->getRepository('PiAppAdminBundle:Block')->find($this->_id_block);
			
			if($block instanceof \PiApp\AdminBundle\Entity\BLock){
				$entity->setPlugin($plugin);
				$entity->setAction($action);
				$entity->setBlock($block);
				$entity->setConfigXml($this->_xmlconfig);
			
				$this->_em->persist($entity);
				$this->_em->flush();
			}
			
			$this->_message = $message;		
			return true;
		} catch (\Exception $e) {
			return false;
		}
	}
	
	/**
	 * Update widget.
	 *
	 * @param string		$plugin
	 * @param string		$action
	 * @param string		$message
	 * @access private
	 * @return boolean		if the updated is correct.
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-09-11
	 */
	private function updateWidget($plugin, $action, $message = "pi.session.flash.right.update")
	{
		$widget   = $this->_em->getRepository('PiAppAdminBundle:Widget')->find($this->_id_widget);
		
		try {
			if($widget instanceof \PiApp\AdminBundle\Entity\Widget){
				$widget->setPlugin($plugin);
				$widget->setAction($action);
				$widget->setConfigXml($this->_xmlconfig);
			
				$this->_em->persist($widget);
				$this->_em->flush();
			}			
			$this->_message = $message;
			
			return true;			
		} catch (\Exception $e) {
			return false;
		}				
	}	
}