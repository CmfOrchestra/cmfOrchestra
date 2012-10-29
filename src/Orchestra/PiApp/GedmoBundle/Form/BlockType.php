<?php
/**
 * This file is part of the <PI_CRUD> project.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-07-31
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
 * Description of the BlockType form.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class BlockType extends AbstractType
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
        $builder            
 			->add('enabled', 'checkbox', array(
            		'data'  => true,
 					"label_attr" => array(
 							"class"=>"block_collection",
 					),
            ))           
 			->add('published_at', 'date', array(
	        		'widget' => 'single_text', // choice, text, single_text
	        		'input' => 'datetime',
	        		'format' => 'MM/dd/yyyy',
 					'required'  => false,
	        		'empty_value' => array('year' => 'Année', 'month' => 'Mois', 'day' => 'Jour'),
	        		//'pattern' => "{{ day }}/{{ month }}/{{ year }}",
	        		//'data_timezone' => "Europe/Paris",
	        		//'user_timezone' => "Europe/Paris",
	        		"attr" => array(
	        				"class"=>"pi_datepicker",
	        		),
 					'label'	=> 'pi.form.label.date.publication',
 					"label_attr" => array(
 							"class"=>"block_collection",
 					),
	        ))          
 			->add('category', 'entity', array(
	        		'class' => 'PiAppGedmoBundle:Category',
	        		'property' => 'name',
	        		'empty_value' => 'Choose an option',
	        		'multiple'	=> false,
	        		'required'  => false,
	        		"attr" => array(
	        				"class"=>"pi_simpleselect",
	        		),
 					"label_attr" => array(
 							"class"=>"block_collection",
 					),
	        ))   
 			->add('title', 'text', array(
 					"label_attr" => array(
 							"class"=>"block_collection",
 					),
 			))            
 			->add('descriptif', 'textarea', array(
 					'label'	=> 'pi.form.label.field.description',
 					"label_attr" => array(
 							"class"=>"block_collection",
 					),
 			))            
 			->add('content', 'textarea', array(
 					'required'  => false,
            		"attr" => array(
            				"class"	=>"pi_editor",
            		),
 					"label_attr" => array(
 							"class"=>"block_collection",
 					),
            ))             
 			->add('author', 'text', array(
 					'required'  => false,
 					"label_attr" => array(
 							"class"=>"block_collection",
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
 							"class"=>"block_collection",
 					),
 			)) 			           
 			->add('url', 'text', array(
 					'required'  => false,
 					"label" 	=> "Or",
 					"label_attr" => array(
 							"class"=>"block_collection",
 					), 					
 			))  
 			->add('media', new \PiApp\GedmoBundle\Form\MediaType($this->_em, 'image', 'image_collection', "simpleLink", 'pi.menu.form.picture')) 			                     
        ;
    }

    public function getName()
    {
        return 'piapp_gedmobundle_blocktype';
    }
    
    public function getDefaultOptions(array $options)
    {
    	return array(
    			'data_class' => 'PiApp\GedmoBundle\Entity\Block',
    	);
    }   
        
}
