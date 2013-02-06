<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Managers
 * @package    Page
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-06-26
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\GedmoBundle\Manager\FormBuilder;  

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormBuilder;
use PiApp\AdminBundle\Manager\PiFormBuilderManager;
        
/**
* Description of the Form builder manager
*
* @category   Admin_Managers
* @package    Page
*
* @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
*/
class PiModelWidgetContact extends PiFormBuilderManager
{
	/**
	 * Type form name.
	 */
	const FORM_TYPE_NAME = 'symfony';
	
	/**
	 * Template form name.
	 */
	const FORM_DECORATOR = 'model_form_builder.html.twig';

	/**
	 * Form name.
	 */
	const FORM_NAME = 'myform';	
	
	/**
	 * Constructor.
	 *
	 * @param \Symfony\Component\DependencyInjection\ContainerInterface
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public function __construct(ContainerInterface $containerService)
	{
		parent::__construct($containerService, 'WIDGET', 'contact', $this::FORM_TYPE_NAME, $this::FORM_DECORATOR, $this::FORM_NAME);
	}
	
	/**
	 * Return list of available content types for all type pages.
	 *
	 * @param  array	$options
	 * @return array
	 * @access public
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-09-11
	 */
	public static function getContents()
	{
		return array(
				PiFormBuilderManager::CONTENT_RENDER_TITLE	=> "Widget: Contact general",
				PiFormBuilderManager::CONTENT_RENDER_DESC   => "Create a general contact button. <br /> For solution contact buttons, go to solution admin.",
		);
	}

	/**
	 * Chargement du template de formulaire.
	 *
	 * @access protected
	 * @return string
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-09-11
	 */	
    public function buildForm(FormBuilder $builder, array $options)
    {   
    	$query		= $this->_em->getRepository("PiAppGedmoBundle:Contact")->getAllByCategory('', null, "DESC", '', true)->getQuery();
    	$choiceList = $this->_em->getRepository("PiAppGedmoBundle:Contact")->findTranslationsByQuery($this->_locale, $query, 'object', false);
    	
    	$result = array();
    	if(is_array($choiceList)) {
    		foreach ($choiceList as $key => $field) {
    			$title = $field->getTitle();
    			if(!empty($title) && method_exists($field, 'getCategory') && is_object($field->getCategory()))
    				$result[ $field->getId() ] = $field->getCategory()->getName() .  " >> " . $field->getTitle() . ' ('.$field->getId().')';
    			elseif(!empty($title))
    				$result[ $field->getId() ] = $field->getTitle() . ' ('.$field->getId().')';
    		}
    	}
    	sort($result);

        $builder
        	->add('id_contact', 'choice', array(
	        		'choices'   => $result,
			        'multiple'	=> false,
			        'required'  => true,
			        'empty_value' => 'Choice a contact',
			        "attr" => array(
			        		"class"=>"pi_simpleselect",
		        	),
	        ))
        	->add('template', 'choice', array(
	        		'choices'   => array(
	        				'_tmp_show-default.html.twig'			=> 'pi.contact.formbuilder.template.choice0',
	        		),
	        		'multiple'	=> false,
	        		'required'  => true,
	        		'empty_value' => 'Choose a template',
	        		"attr" => array(
	        				"class"=>"pi_simpleselect",
	        		),
	        ));
    }
	
	/**
	 *
	 *
	 * @access public
	 * @return array		Xml config in array format to create/update a widget.
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-09-11
	 */	
	public function XmlConfigWidget(array $data)
	{
		return 
			array(				
				'plugin'	=> 'gedmo',
				'action'	=> 'listener',
				'xml' 		=> Array ( 
								"widgets" 	=> Array ( 
												"gedmo"		=> Array ( 
																"controller"	=> 'PiAppGedmoBundle:Contact:_template_show',
																"params"		=> Array ( 
																					"id" 		=> $data['id_contact'],
																					"template"	=> $data['template']
																				) 
															)
											)
					 		),
			);
	}
	
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

}
