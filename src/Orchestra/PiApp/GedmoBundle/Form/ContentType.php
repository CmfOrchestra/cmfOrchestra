<?php
/**
 * This file is part of the <PI_CRUD> project.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-07-02
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
 * Description of the ContentType form.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class ContentType extends AbstractType
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
    	$choiceList = $this->_em->getRepository("PiAppGedmoBundle:Content")->getArrayAllCategory();
    	if(!isset($choiceList) || !count($choiceList))
    		$choiceList = array();
    	
        $builder   
	        ->add('enabled', 'checkbox', array(
	        		'data'  => true,
	        		"label_attr" => array(
	        				"class"=>"content_collection",
	        		),
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
	        		"label_attr" => array(
	        				"class"=>"content_collection",
	        		),
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
	        ->add('category', 'choice', array(
	        		'choices'   => $choiceList,
			        'multiple'	=> false,
			        'required'  => false,
			        'empty_value' => 'Choose a type',
			        "attr" => array(
			        		"class"=>"pi_simpleselect",
		        	),
	        		"label_attr" => array(
	        				"class"=>"content_collection",
	        		),
	        ))
	        ->add('categoryother', 'text', array(
	        		'label'=>'ou',
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
	        ->add('pageurl', 'entity', array(
 					'class' => 'PiAppAdminBundle:Page',
 					'query_builder' => function(EntityRepository $er) {
 						return $er->getAllPageHtml();
 					},
 					'property' => 'route_name',
 					'empty_value' => 'Choose an option',
 					'multiple'	=> false,
 					'required'  => false,
 					"label" 	=> "Link page",
 					"attr" => array(
 							"class"=>"pi_simpleselect",
 					),
 					"label_attr" => array(
 							"class"=>"content_collection",
 					),
 			)) 			           
 			->add('url', 'text', array(
 					'required'  => false,
 					"label" 	=> "Or",
 					"label_attr" => array(
 							"class"=>"content_collection",
 					), 					
 			))         
 			->add('content', 'textarea', array(
            		"attr" => array(
            				"class"	=>"pi_editor",
            		),
 					'required'  => false,
 					"label_attr" => array(
 							"class"=>"content_collection",
 					),
            ))  
//          ->add('pagecssclass')
        ;
    }

    public function getName()
    {
        return 'piapp_gedmobundle_contenttype';
    }
        
}
