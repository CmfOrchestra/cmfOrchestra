<?php
/**
 * This file is part of the <PI_CRUD> project.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-04-11
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\GedmoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Description of the SliderType form.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class SliderType extends AbstractType
{
	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	protected $_em;
	
	/**
	 * Constructor.
	 *
	 * @param \Doctrine\ORM\EntityManager $em
	 * @return void
	 */
	public function __construct(EntityManager $em)
	{
		$this->_em = $em;
	}
		
    public function buildForm(FormBuilder $builder, array $options)
    {
    	$choiceList = $this->_em->getRepository("PiAppGedmoBundle:Slider")->getArrayAllCategory();
    	if(!isset($choiceList) || !count($choiceList))
    		$choiceList = array();
    	    	
        $builder  
        	->add('enabled', 'checkbox', array(
	        		'data'  => true,
	        ))
	        ->add('published_at', 'date', array(
	        		'widget' => 'single_text', // choice, text, single_text
	        		'input' => 'datetime',
	        		'format' => 'MM/dd/yyyy',
	        		'empty_value' => array('year' => 'Année', 'month' => 'Mois', 'day' => 'Jour'),
	        		//'pattern' => "{{ day }}/{{ month }}/{{ year }}",
	        		//'data_timezone' => "Europe/Paris",
	        		//'user_timezone' => "Europe/Paris",
	        		"attr" => array(
	        				"class"=>"pi_datepicker",
	        		),
	        		'label'	=> 'pi.form.label.date.publication',
	        ))
// 	        ->add('archive_at', 'date', array(
// 	        		'widget' => 'single_text', // choice, text, single_text
// 	        		'input' => 'datetime',
// 	        		'format' => 'MM/dd/yyyy',
// 	        		'empty_value' => array('year' => 'Année', 'month' => 'Mois', 'day' => 'Jour'),
// 	        		//'pattern' => "{{ day }}/{{ month }}/{{ year }}",
// 	        		//'data_timezone' => "Europe/Paris",
// 	        		//'user_timezone' => "Europe/Paris",
// 	        		"attr" => array(
// 	        				"class"=>"pi_datepicker",
// 	        		),
// 	        		'label'	=> 'pi.form.label.date.archivage',
// 	        ))
	        
	        ->add('media', new \PiApp\GedmoBundle\Form\MediaType($this->_em, 'image', 'image_collection', "simpleLink", 'pi.menu.form.picture'))
	        
	        ->add('title', 'text', array(
	        		"label" => 'Title',
	        		'required'  => false,
	        ))	              
	        
	        
	        
	        ->add('category', 'choice', array(
	        		'choices'   => $choiceList,
	        		'multiple'	=> false,
	        		'required'  => false,
	        		'empty_value' => 'Choose a type',
	        		"attr" => array(
	        				"class"=>"pi_simpleselect",
	        		),
	        		"label_attr" => array(
	        				"class"=>"category_collection",
	        		),
	        ))
	        ->add('categoryother', 'text', array(
	        		'label'=>'ou',
	        		'required'  => false,
	        		"label_attr" => array(
	        				"class"=>"category_collection",
	        		),
	        )) 	

	        
//	        ->add('CssClass')
           
	        ->add('subtitle', 'text', array(
            		"label" => 'Sub title',
            		"label_attr" => array(
            				"class"=>"detail_collection",
            		),
            		'required'  => false,
            ))   
	        ->add('descriptifleft', 'textarea', array(
 					'required'  => false,
            		"label" => 'Description Left resume',
 					"label_attr" => array(
 							"class"=>"detail_collection",
 					),
            ))
	        ->add('descriptifright', 'textarea', array(
 					'required'  => false,
            		"label" => 'Description Right resume',
 					"label_attr" => array(
 							"class"=>"detail_collection",
 					),
            ))
            
            
            ->add('page', 'entity', array(
            		'class' => 'PiAppAdminBundle:Page',
            		'query_builder' => function(EntityRepository $er) {
            			return $er->getAllPageHtml();
		            },
		            'property' => 'route_name',
		            'empty_value' => 'Choose an option',
		            'multiple'	=> false,
		            'required'  => false,
		            "attr" => array(
		            		"class"=>"pi_simpleselect",
		            ),
		            "label_attr" => array(
		            		"class"=>"link_collection",
		            ),
            )) 
            ->add('pagetitle', 'text', array(
            		"label" => 'Page title',
            		"label_attr" => array(
            				"class"=>"link_collection",
            		),
            		'required'  => false,
            ))            
            ->add('meta_keywords', 'textarea', array(
            		"label" => 'Meta Keywords',
            		"label_attr" => array(
            				"class"=>"meta_definition",
            		),
            		'required'  => false,
            ))
            ->add('meta_description', 'textarea', array(
            		"label" => 'Meta description',
            		"label_attr" => array(
            				"class"=>"meta_definition",
            		),
            		'required'  => false,
            ))            
//            ->add('pagecssclass')
        ;
    }

    public function getName()
    {
        return 'piapp_gedmobundle_slidertype';
    }
        
}
