<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Managers
 * @package    Page
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-09-11
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\GedmoBundle\Manager\FormBuilder;  

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormBuilderInterface;

use PiApp\AdminBundle\Manager\PiFormBuilderManager;
use Doctrine\ORM\EntityRepository;
        
/**
* Description of the Form builder manager
*
* @category   Admin_Managers
* @package    Page
*
* @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
*/
class PiModelWidgetBlock extends PiFormBuilderManager
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
	const FORM_NAME = 'formbuilder';	
	
	/**
	 * Constructor.
	 *
	 * @param \Symfony\Component\DependencyInjection\ContainerInterface
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public function __construct(ContainerInterface $containerService)
	{
		parent::__construct($containerService, 'WIDGET', 'block', $this::FORM_TYPE_NAME, $this::FORM_DECORATOR, $this::FORM_NAME);
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
	 */
	public static function getContents()
	{
		return array(
				PiFormBuilderManager::CONTENT_RENDER_TITLE	=> "Widget Block",
				PiFormBuilderManager::CONTENT_RENDER_DESC   => "Call for inserting or creating a block.",
		);
	}

	/**
	 * Chargement du template de formulaire.
	 *
	 * @access protected
	 * @return string
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 */	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
    	$query		= $this->_em->getRepository("PiAppGedmoBundle:Block")->getAllByCategory('', null, "DESC", '', true)->getQuery();
    	$choiceList = $this->_em->getRepository("PiAppGedmoBundle:Block")->findTranslationsByQuery($this->_locale, $query, 'object', false);
    	
    	$result = array();
    	if (is_array($choiceList)) {
    		foreach ($choiceList as $key => $field) {
    			$title = $field->getTitle();
    			if (!empty($title) && is_object($field->getCategory()))
    				$result[ $field->getId() ] = $field->getCategory()->getName() .  " >> " . $field->getTitle() . ' ('.$field->getId().')';
    			elseif (!empty($title))
    				$result[ $field->getId() ] = $field->getTitle() . ' ('.$field->getId().')';
    		}
    	}
    	sort($result);

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
        	->add('id_block', 'choice', array(
	        		'choices'   => $result,
			        'multiple'	=> false,
			        'required'  => true,
			        'empty_value' => 'pi.form.label.select.choose.block',
			        "attr" => array(
			        		"class"=>"pi_simpleselect",
		        	),
        			"label_attr" => array(
        					"class"=>"insert_collection",
        			),        			
	        ))
        	->add('template', 'choice', array(
	        		'choices'   => array(
	        				'_tmp_show-block-descriptif-left-picture.html.twig'	=> 'pi.block.formbuilder.template.choice1',
	        				'_tmp_show-block-descriptif-right-picture.html.twig'=> 'pi.block.formbuilder.template.choice2',
	        				'_tmp_show-block-tpl1.html.twig'		   			=> 'pi.block.formbuilder.template.choice3',
	        				'_tmp_show-block-tpl2.html.twig'		   			=> 'pi.block.formbuilder.template.choice4',
	        				'_tmp_show-block-tpl3.html.twig'		   			=> 'pi.block.formbuilder.template.choice5',
	        				'_tmp_show-block-tpl4.html.twig'		   			=> 'pi.block.formbuilder.template.choice6',
	        				'_tmp_show-block-tpl5.html.twig'		   			=> 'pi.block.formbuilder.template.choice9',
	        				'_tmp_show-block-video-left.html.twig'				=> 'pi.block.formbuilder.template.choice7',
	        				'_tmp_show-block-video-right.html.twig'				=> 'pi.block.formbuilder.template.choice8',
	        		),
	        		'multiple'	=> false,
	        		'required'  => true,
	        		'empty_value' => 'pi.form.label.select.choose.template',
	        		"attr" => array(
	        				"class"=>"pi_simpleselect",
	        		),
	        ))
	        ->add('category', 'entity', array(
	        		'class' => 'PiAppGedmoBundle:Category',
	        		'query_builder' => function(EntityRepository $er) {
	        			return $er->createQueryBuilder('k')
	        			->select('k')
	        			->where('k.type = :type')
	        			->orderBy('k.name', 'ASC')
	        			->setParameter('type', 1);
	        		},
	        		'property' => 'name',
	        		'empty_value' => 'pi.form.label.select.choose.category',
	        		'multiple'	=> false,
	        		'required'  => false,
	        		"attr" => array(
	        				"class"=>"pi_simpleselect",
	        		),
	        		'label'	=> "pi.form.label.field.category",
	        		"label_attr" => array(
	        				"class"=>"block_collection",
	        		),
	        ))
	        ->add('title', 'text', array(
	        		'label'	=> "pi.form.label.field.title",
	        		"label_attr" => array(
	        				"class"=>"block_collection",
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
				var  create_content_form  = $(".block_collection");
				var  insert_content_form  = $(".insert_collection");

				create_content_form.parents('.clearfix').hide();

				$("#piappgedmobundlemanagerformbuilderpimodelwidgetblock_id_block").attr("required", "required");
				$("#piappgedmobundlemanagerformbuilderpimodelwidgetblock_title").removeAttr("required");

				$("input[id='piappgedmobundlemanagerformbuilderpimodelwidgetblock_choice_0']").change(function () {
					if ($(this).is(':checked')){
						create_content_form.parents('.clearfix').hide();
						insert_content_form.parents('.clearfix').show();

						$("#piappgedmobundlemanagerformbuilderpimodelwidgetblock_id_block").attr("required", "required");
						$("#piappgedmobundlemanagerformbuilderpimodelwidgetblock_title").removeAttr("required");
					} else {
						create_content_form.parents('.clearfix').show();
						insert_content_form.parents('.clearfix').hide();

						$("#piappgedmobundlemanagerformbuilderpimodelwidgetblock_id_block").removeAttr("required");
						$("#piappgedmobundlemanagerformbuilderpimodelwidgetblock_title").attr("required", "required");
					}
		       	});
				$("input[id='piappgedmobundlemanagerformbuilderpimodelwidgetblock_choice_1']").change(function () {
					if ($(this).is(':checked')){
						create_content_form.parents('.clearfix').show();
						insert_content_form.parents('.clearfix').hide();

						$("#piappgedmobundlemanagerformbuilderpimodelwidgetblock_id_block").removeAttr("required");
						$("#piappgedmobundlemanagerformbuilderpimodelwidgetblock_title").attr("required", "required");
					} else {
						create_content_form.parents('.clearfix').hide();
						insert_content_form.parents('.clearfix').show();

						$("#piappgedmobundlemanagerformbuilderpimodelwidgetblock_id_block").attr("required", "required");
						$("#piappgedmobundlemanagerformbuilderpimodelwidgetblock_title").removeAttr("required");
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
	 */
	public function preEventBindRequest(){
		$this->_createentity	= 	new  \PiApp\GedmoBundle\Entity\Block();
		//$this->_form    		= $this->container->get('form.factory')->create(new PiModelWidgetBlock($this->container));
	}	

	/**
	 *
	 *
	 * @access public
	 * @return void
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 */
	public function preEventActionForm(array $data){
		if ($data["choice"] == "create"){
			$this->_createentity->setEnabled(true);			
			
			if (!empty($this->_data['category']) || !is_null($this->_data['category'])){
				$category = $this->_em->getRepository("PiAppGedmoBundle:Category")->findOneByEntity($this->_locale, $this->_data['category'], 'object');
				
				if ($category instanceof \PiApp\GedmoBundle\Entity\Category)
					$this->_createentity->setCategory($category);
			}
			
			$this->_createentity->setTitle($this->_data['title']);
			$this->_createentity->setPublishedAt(new \DateTime());
			$this->_createentity->setCreatedAt(new \DateTime());
				
			$this->_createentity->setTranslatableLocale($this->_locale);
			$this->_em->persist($this->_createentity);
			$this->_em->flush();
			
			$this->_data['id_block'] = $this->_createentity->getId();
		}
	}
	
	/**
	 *
	 *
	 * @access public
	 * @return void
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 */
	public function postEventActionForm(array $data){}	
	
	/**
	 *
	 *
	 * @access public
	 * @return array		Xml config in array format.
	 *
	 * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
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
										"controller"	=> 'PiAppGedmoBundle:Block:_template_show',
										"params"		=> Array (
												"id" 		=> $data['id_block'],
												"template"	=> $data['template']
										)
								)
						)
				),
		);
	}	

}