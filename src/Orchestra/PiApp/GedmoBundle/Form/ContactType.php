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
 * Description of the ContactType form.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class ContactType extends AbstractType
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
 			->add('category', 'entity', array(
 					'class' => 'PiAppGedmoBundle:Category',
 					'query_builder' => function(EntityRepository $er) {
 						return $er->createQueryBuilder('k')
	            		->select('k')
	            		->where('k.type = :type')
	            		->orderBy('k.name', 'ASC')
	            		->setParameter('type', 0);
 					},
 					'property' => 'name',
 					'empty_value' => 'pi.form.label.select.choose.category',
 					'label'	=> "pi.form.label.field.category",
 					'multiple'	=> false,
 					'required'  => false,
 					"attr" => array(
 							"class"=>"pi_simpleselect",
 					),
 			)) 			
 			->add('title', 'text', array(
 					'label'		=> "pi.form.label.field.title",
 					'required'  => false,
 			))
 			->add('descriptif', 'textarea', array(
 					'label'	=> "pi.form.label.field.description",
 					"label_attr" => array(
 							"class"=>"block_collection",
 					),
 					"attr" => array(
 							"class"	=>"pi_editor_simple",
 					),
 					'required'  => false,
 			))	
 			->add('coordinates', 'text', array(
 					"label" => 'pi.form.label.field.adress.coordinates',
 					'required'  => false,
 			))
 			->add('name','text', array(
 					'required'  	=> false,
 			))
 			->add('nickname','text', array(
 					'required'  	=> false,
 			)) 			
 			
 			
 			->add('address', 'textarea', array(
 					"label" => 'pi.form.label.field.adress.main',
 					"label_attr" => array(
 							"class"=>"address_collection",
 					),
 					"attr" => array(
 							"class"	=>"pi_editor_simple",
 					),
 					'required'  => false,
 			))
 			->add('phone', 'text', array(
 					"label" => 'pi.form.label.field.adress.phone',
 					"label_attr" => array(
 							"class"=>"address_collection",
 					),
 					'required'  => false,
 			))
 			->add('fax', 'text', array(
 					"label" => 'pi.form.label.field.adress.fax',
 					"label_attr" => array(
 							"class"=>"address_collection",
 					),
 					'required'  => false,
 			))
 				
 			
 			->add('email', 'text', array(
 					"label" => 'pi.form.label.field.email',
 					"label_attr" => array(
 							"class"=>"email_collection",
 					),
 					'required'  => false,
 			))
 			->add('email_subject', 'text', array(
 					"label" => 'pi.form.label.field.email.subject',
 					"label_attr" => array(
 							"class"=>"email_collection",
 					),
 					'required'  => false,
 			))
 			->add('email_body', 'textarea', array(
 					"label" => 'pi.form.label.field.email.body',
 					"label_attr" => array(
 							"class"=>"email_collection",
 					),
 					'required'  => false,
 			))
 			->add('email_cc', 'textarea', array(
 					"label" => 'pi.form.label.field.email.cc',
 					"label_attr" => array(
 							"class"=>"email_collection",
 					),
 					'required'  => false,
 			))
 			->add('email_bcc', 'textarea', array(
 					"label" => 'pi.form.label.field.email.bcc',
 					"label_attr" => array(
 							"class"=>"email_collection",
 					),
 					'required'  => false,
 			))
 			
 			 
 			->add('url', 'text', array(
 					"label" => 'pi.form.label.field.url',
 					"label_attr" => array(
 							"class"=>"url_collection",
 					),
 					'required'  => false,
 			))
 			->add('url_title', 'text', array(
 					"label" => 'pi.form.label.field.title',
 					"label_attr" => array(
 							"class"=>"url_collection",
 					),
 					'required'  => false,
 			))
 			
 			->add('media', new \PiApp\GedmoBundle\Form\MediaType($this->_em, 'image', 'pictures', "simpleLink", 'pi.contact.form.picture.left'))
 			->add('media1', new \PiApp\GedmoBundle\Form\MediaType($this->_em, 'image', 'pictures', "simpleLink",'pi.contact.form.picture.right'))
        ;
    }

    public function getName()
    {
        return 'piapp_gedmobundle_contacttype';
    }
        
}
