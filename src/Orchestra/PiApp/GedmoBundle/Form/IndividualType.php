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
 			->add('archive_at', 'date', array(
 					'widget' => 'single_text', // choice, text, single_text
 					'input' => 'datetime',
 					'format' => $this->_container->get('pi_app_admin.twig.extension.tool')->getDatePatternByLocalFunction($this->_locale),// 'dd/MM/yyyy', 'MM/dd/yyyy',
 					'required'  => false,
 					"attr" => array(
 							"class"=>"pi_datepicker",
 					),
 					'label'	=> 'pi.form.label.date.archivage',
 			))        	
 			->add('user', new \BootStrap\UserBundle\Form\Type\RegistrationFormType('collection')) 			
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
 					"label" 	=> "pi.form.label.field.url",
 					"label_attr" => array(
 							"class"=>"page_collection",
 					),
 					'required'  => false,
 			)) 		
 			->add('InscrName')
 			->add('InscrNickname')
 			->add('InscrPhone')
 			->add('InscrJob')
 			->add('EntrCompany')
 			->add('EntrActivity')
 			->add('EntrBusiness')
 			->add('EntrStaff') 		
 							
 			->add('media', new \PiApp\GedmoBundle\Form\MediaType($this->_em, 'image', 'image_collection', "simpleLink", 'pi.form.label.media.picture'))
        ;
    }

    public function getName()
    {
        return 'piapp_gedmobundle_individualtype';
    }
        
}
