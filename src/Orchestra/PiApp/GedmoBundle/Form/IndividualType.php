<?php
/**
 * This file is part of the <PI_CRUD> project.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 20XX-XX-XX
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
 * Description of the IndividualType form.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class IndividualType extends AbstractType
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
	 * @param string	$locale
	 * @return void
	 */
	public function __construct(EntityManager $em, ContainerInterface $container)
	{
		$this->_em 			= $em;
		$this->_locale		= $container->get('session')->getLocale();
		$this->_container 	= $container;
	}
		
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder 			   				
 			->add('enabled', 'checkbox', array(
 					'data'  => true,
 					'label'	=> 'pi.form.label.field.enabled',
 			))
 			
 			->add('pageurl', 'entity', array(
 					'class' => 'PiAppAdminBundle:Page',
 					'query_builder' => function(EntityRepository $er) {
 						return $er->getAllPageHtml();
 					},
 					'property' => 'route_name',
 					'empty_value' => 'pi.form.label.select.choose.option',
 					"label" 	=> "pi.form.label.field.url",
 					"label_attr" => array(
 							"class"=>"page_collection",
 					),
 					"attr" => array(
 							"class"=>"pi_simpleselect",
 					),
 					'multiple'	=> false,
 					'required'  => false,
 			)) 	
 			->add('url', 'text', array(
 					"label" 	=> "pi.form.label.field.or",
 					"label_attr" => array(
 							"class"=>"page_collection",
 					),
 					'required'  => false,
 			)) 					
 			->add('media', new \PiApp\GedmoBundle\Form\MediaType($this->_em, 'image', 'image_collection', "simpleLink", 'pi.form.label.media.picture'))

 			->add('InscrName','text', array(
          'required'  	=> true,
 			))
      ->add('InscrUserName','text', array(
 					'label'  => 'Identifiant',
          'required'  	=> true,        
 			))
 			->add('InscrNickname','text', array(
          'required'  	=> true,        
 			))
 			->add('InscrPhone')
 			->add('InscrJob','text', array(
 			))
      ->add('InscrEmail','text', array(
 					'required'  => true,        
 			))
 			->add('EntrCompany','text', array(
 					'required'  => true,        
 			))
 			->add('EntrActivity', 'choice', array(
 					'required'  => true,        
          'choices'   => array('0' => 'Activité*', '1' => 'TIC', '2' => '2', '3' => '3', '4' => '4', '5' => '5'),
 					"attr" => array(
 							"class"=>"pi_simpleselect",
 					),
 			))            
 			->add('EntrStaff', 'choice', array(
 					'required'  => true,        
          'choices'   => array('0' => 'Effectif*', '1' => '0-10', '2' => '11-50', '3' => '51-500', '4' => '501-2000', '5' => '>2000'),
         	"attr" => array(
 							"class"=>"pi_simpleselect",
 					),
 			))
      ->add('InscrCp','text', array(
 					'required'  => true,        
 			))
      ->add('InscrFacebook','text', array(   
          'required'  => false,     
 					"attr" => array(
 							"class"=>"social_collection",
 					),
 			))
      ->add('InscrGooglePlus','text', array( 
          'required'  => false,        
 					"attr" => array(
 							"class"=>"social_collection",
 					),
 			))
      ->add('InscrTwitter','text', array(    
          'required'  => false,        
 					"attr" => array(
 							"class"=>"social_collection",
 					),
 			))
      ->add('InscrLinkedIn','text', array(     
          'required'  => false,        
 					"attr" => array(
 							"class"=>"social_collection",
 					),
 			))
      ->add('InscrViadeo','text', array(       
          'required'  => false,        
 					"attr" => array(
 							"class"=>"social_collection",
 					),
 			))        
        ;
    }

    public function getName()
    {
        return 'piapp_gedmobundle_individualtype';
    }
        
}
