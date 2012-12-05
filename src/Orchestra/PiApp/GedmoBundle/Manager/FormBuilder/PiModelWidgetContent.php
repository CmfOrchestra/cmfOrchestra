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
class PiModelWidgetContent extends PiFormBuilderManager
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
		parent::__construct($containerService, 'WIDGET', 'content', $this::FORM_TYPE_NAME, $this::FORM_DECORATOR, $this::FORM_NAME);
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
				PiFormBuilderManager::CONTENT_RENDER_TITLE	=> "Widget Content",
				PiFormBuilderManager::CONTENT_RENDER_DESC   => "Call for inserting or creating a content.",
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
    	$query		= $this->_em->getRepository("PiAppGedmoBundle:Content")->getAllByCategory('', null, "DESC", '', true)->getQuery();
    	$choiceList = $this->_em->getRepository("PiAppGedmoBundle:Content")->findTranslationsByQuery($this->_locale, $query, 'object', false);
    	
    	$result 	= array();
    	$categories = array();
    	if(is_array($choiceList)) {
    		foreach ($choiceList as $key => $field) {
    			$desc = $field->getDescriptif();
    			$cat  = $field->getCategory();
    			
    			if($cat instanceof \PiApp\GedmoBundle\Entity\Category)
    				$categories[ $cat->getId() ] = $cat->getName();
    			
    			if(!empty($desc) && !empty($cat))
    				$result[ $field->getId() ] = $field->getCategory() .  " >> " . $field->getDescriptif() . ' ('.$field->getId().')';
    			elseif(!empty($desc))
    				$result[ $field->getId() ] = $field->getDescriptif() . ' ('.$field->getId().')';
    		}
    	}

        $builder
        	->add('choice', 'choice', array(
            		'choices'   => array("insert"=>"Insert", "create"=>"Create"),
        			'data'  => "insert",
            		'required'  => false,
            		'multiple'	=> false,
            		'expanded' => true,
        			'label'	=> "pi.form.label.field.choice",
        			"label_attr" => array(
        					"class"=>"select_choice",
        			),
            )) 
        	->add('id_content', 'choice', array(
	        		'choices'   => $result,
			        'multiple'	=> false,
			        'required'  => false,
			        'empty_value' => 'pi.form.label.select.choose.content',
			        "attr" => array(
			        		"class"=>"pi_simpleselect",
		        	),
        			"label_attr" => array(
        					"class"=>"insert_collection",
        			),
	        ))
        	->add('template', 'choice', array(
	        		'choices'   => array(
	        				'_tmp_show-content-simple.html.twig'			=> 'pi.content.formbuilder.template.choice0',
	        				'_tmp_show-content-p.html.twig'					=> 'pi.content.formbuilder.template.choice1',
	        				'_tmp_show-content-div.html.twig'				=> 'pi.content.formbuilder.template.choice2',
	        				'_tmp_show-content-span.html.twig'				=> 'pi.content.formbuilder.template.choice3',
	        				'_tmp_show-content-h1.html.twig'				=> 'pi.content.formbuilder.template.choice4',
	        				'_tmp_show-content-h2.html.twig'				=> 'pi.content.formbuilder.template.choice5',
	        				'_tmp_show-content-h3.html.twig'				=> 'pi.content.formbuilder.template.choice6',
	        		),
	        		'multiple'	=> false,
	        		'required'  => true,
	        		'empty_value' => 'Choose a template',
	        		"attr" => array(
	        				"class"=>"pi_simpleselect",
	        		),
        			'empty_value' => 'pi.form.label.select.choose.template',
        			"label_attr" => array(
        					"class"=>"select_choice",
        			),
	        ))
	        ->add('category', 'choice', array(
	        		'choices'   => $categories,
			        'multiple'	=> false,
			        'required'  => false,
			        'empty_value' => 'pi.form.label.select.choose.category',
			        "attr" => array(
			        		"class"=>"pi_simpleselect",
		        	),
	        		'label'	=> "pi.form.label.field.category",
	        		"label_attr" => array(
	        				"class"=>"content_collection",
	        		),
	        ))
	        ->add('categoryother', 'text', array(
	        		'label'=>'pi.form.label.field.or',
	        		'required'  => false,
	        		"label_attr" => array(
	        				"class"=>"content_collection",
	        		),
	        ))
	        ->add('descriptif', 'text', array(
 					'label'	=> 'pi.form.label.field.description',
	        		"label_attr" => array(
	        				"class"=>"content_collection",
	        		),
 			))  
 			->add('content', 'textarea', array(
            		"attr" => array(
            				"class"	=>"pi_editor",
            		),
 					'required'  => false,
 					'label'	=> "pi.form.label.field.content",
 					"label_attr" => array(
 							"class"=>"content_collection",
 					),
            ))  
        	;
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
	public function renderScript(array $option) {
		// We open the buffer.
		ob_start ();
		?>						
			<script type="text/javascript">
			// <![CDATA[
			jQuery(document).ready(function(){		
				var  create_content_form  = $(".content_collection");
				var  insert_content_form  = $(".insert_collection");

				create_content_form.parents('.clearfix').hide();
				$("#piappgedmobundlemanagerformbuilderpimodelwidgetcontent_id_content").attr("required", "required");
				$("#piappgedmobundlemanagerformbuilderpimodelwidgetcontent_descriptif").removeAttr("required");

				$("input[id='piappgedmobundlemanagerformbuilderpimodelwidgetcontent_choice_insert']").change(function () {
					if($(this).is(':checked')){
						create_content_form.parents('.clearfix').hide();
						insert_content_form.parents('.clearfix').show();

						$("#piappgedmobundlemanagerformbuilderpimodelwidgetcontent_id_content").attr("required", "required");
						$("#piappgedmobundlemanagerformbuilderpimodelwidgetcontent_descriptif").removeAttr("required");
					}else{
						create_content_form.parents('.clearfix').show();
						insert_content_form.parents('.clearfix').hide();

						$("#piappgedmobundlemanagerformbuilderpimodelwidgetcontent_id_content").removeAttr("required");
						$("#piappgedmobundlemanagerformbuilderpimodelwidgetcontent_descriptif").attr("required", "required");
					}
		       	});
				$("input[id='piappgedmobundlemanagerformbuilderpimodelwidgetcontent_choice_create']").change(function () {
					if($(this).is(':checked')){
						create_content_form.parents('.clearfix').show();
						insert_content_form.parents('.clearfix').hide();

						$("#piappgedmobundlemanagerformbuilderpimodelwidgetcontent_id_content").removeAttr("required");
						$("#piappgedmobundlemanagerformbuilderpimodelwidgetcontent_descriptif").attr("required", "required");
					}else{
						create_content_form.parents('.clearfix').hide();
						insert_content_form.parents('.clearfix').show();

						$("#piappgedmobundlemanagerformbuilderpimodelwidgetcontent_id_content").attr("required", "required");
						$("#piappgedmobundlemanagerformbuilderpimodelwidgetcontent_descriptif").removeAttr("required");
					}
		       	});
		       			       	
			});
			// ]]>
			</script> 
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
	 *
	 *
	 * @access public
	 * @return void
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-09-11
	 */
	public function preEventBindRequest(){
		$this->_createentity	= 	new  \PiApp\GedmoBundle\Entity\Content();
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
	public function preEventActionForm(array $data){
		if($data["choice"] == "create"){
			$this->_createentity->setEnabled(true);
			
			if(!empty($this->_data['category']) || !is_null($this->_data['category'])){
				$category = $this->_em->getRepository("PiAppGedmoBundle:Category")->findOneByEntity($this->_locale, $this->_data['category'], 'object');
				
				if($category instanceof \PiApp\GedmoBundle\Entity\Category)
					$this->_createentity->setCategory();
			}
			
			$this->_createentity->setDescriptif($this->_data['descriptif']);
			$this->_createentity->setContent($this->_data['content']);
			$this->_createentity->setPublishedAt(new \DateTime());
			$this->_createentity->setCreatedAt(new \DateTime());			
			
			$this->_createentity->setTranslatableLocale($this->_locale);
			$this->_em->persist($this->_createentity);
			$this->_em->flush();
			
			$this->_data['id_content'] = $this->_createentity->getId();
		}
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
	public function postEventActionForm(array $data){}	

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
										"controller"	=> 'PiAppGedmoBundle:Content:_template_show',
										"params"		=> Array (
												"id" 		=> $data['id_content'],
												"template"	=> $data['template']
										)
								)
						)
				),
		);
	}	

}
