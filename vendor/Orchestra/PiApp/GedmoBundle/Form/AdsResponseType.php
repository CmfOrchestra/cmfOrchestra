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
use Symfony\Component\Form\FormBuilderInterface;
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
class AdsResponseType extends AbstractType
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
		$this->_locale		= $container->get('request')->getLocale();
		$this->_container 	= $container;
	}
		
    public function buildForm(FormBuilderInterface $builder, array $options)
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
 			)) 			
 			->add('name','text', array(
 					'required'  	=> false,
 			))
 			->add('nickname','text', array(
 					'required'  	=> false,
 			)) 			
 			->add('email', 'text', array(
 					"label" => 'pi.form.label.field.email',
 					'required'  => false,
 			))
 			->add('descriptif', 'textarea', array(
 					'label'	=> "pi.form.label.field.description",
 					"attr" => array(
 							"class"	=>"full required",
 							"data-validate"=>"Message *",
 					),
 					'required'  => false,
 			)) 			
        ;
    }

    public function getName()
    {
        return 'piapp_gedmobundle_contacttype';
    }
        
}
