<?php
/**
 * This file is part of the <PI_CRUD> project.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-04-11
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\GedmoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Description of the SliderType form.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class SliderType extends AbstractType
{
	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	protected $_em;
	
	/**
	 * @var \Symfony\Component\DependencyInjection\ContainerInterface
	 */
	protected $_container;
	
	/**
	 * @var string
	 */
	protected $_locale;	
	
	/**
	 * Constructor.
	 *
	 * @param \Doctrine\ORM\EntityManager $em
	 * @return void
	 */
	public function __construct(EntityManager $em, $locale, ContainerInterface $container)
	{
		$this->_em 			= $em;
		$this->_container 	= $container;
		$this->_locale		= $locale;		
	}
		
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder  
        	->add('enabled', 'checkbox', array(
	        		'data'  => true,
        			'label'	=> 'pi.form.label.field.enabled',
	        ))
	        ->add('published_at', 'date', array(
	        		'widget' 	=> 'single_text', // choice, text, single_text
	        		'input' 	=> 'datetime',
	        		'format' 	=> $this->_container->get('pi_app_admin.twig.extension.tool')->getDatePatternByLocalFunction($this->_locale),// 'dd/MM/yyyy', 'MM/dd/yyyy',
	        		"attr" 	=> array(
	        				"class"=>"pi_datepicker",
	        		),
	        		'label'	=> 'pi.form.label.date.publication',
	        ))
	        ->add('category', 'entity', array(
	        		'class' => 'PiAppGedmoBundle:Category',
	        		'query_builder' => function(EntityRepository $er) {
	        			return $er->createQueryBuilder('k')
	        			->select('k')
	        			->where('k.type = :type')
	        			->orderBy('k.name', 'ASC')
	        			->setParameter('type', 4);
	        		},
	        		'property' => 'name',
	        		'empty_value' => 'pi.form.label.select.choose.category',
	        		'label'	=> "pi.form.label.field.category",
	        		'multiple'	=> false,
	        		'required'  => false,
	        		"attr" => array(
	        				"class"=>"pi_simpleselect",
	        		),
	        		"label_attr" => array(
	        				"class"=>"category_collection",
	        		),	        		
	        ))	  
	        ->add('title', 'text', array(
	        		'label'		=> "pi.form.label.field.title",
	        		'required'  => false,
	        ))

	        
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
	        		"attr" => array(
	        				"class"	=>"pi_editor_simple",
	        		),
            ))
	        ->add('descriptifright', 'textarea', array(
 					'required'  => false,
            		"label" => 'Description Right resume',
 					"label_attr" => array(
 							"class"=>"detail_collection",
 					),
	        		"attr" => array(
	        				"class"	=>"pi_editor_simple",
	        		),
            ))
            
            
            ->add('page', 'entity', array(
            		'class' => 'PiAppAdminBundle:Page',
            		'query_builder' => function(EntityRepository $er) {
            			return $er->getAllPageHtml();
		            },
		            'property' => 'route_name',
		            'empty_value' => 'pi.form.label.select.choose.option',
		            "label" 	=> "pi.form.label.field.url",
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
            		"label" => "pi.form.label.field.meta_keywords",
            		"label_attr" => array(
            				"class"=>"meta_definition",
            		),
            		'required'  => false,
            ))
            ->add('meta_description', 'textarea', array(
            		"label" => "pi.form.label.field.meta_description",
            		"label_attr" => array(
            				"class"=>"meta_definition",
            		),
            		'required'  => false,
            ))            

            
            ->add('media', new \PiApp\GedmoBundle\Form\MediaType($this->_em, 'image', 'image_collection', "simpleLink", 'pi.form.label.media.picture'))
        ;
    }

    public function getName()
    {
        return 'piapp_gedmobundle_slidertype';
    }
        
}
