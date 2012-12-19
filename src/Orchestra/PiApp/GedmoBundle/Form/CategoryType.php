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
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Description of the CategoryType form.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class CategoryType extends AbstractType
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
	        ->add('type', 'choice', array(
	        		'choices'   => array(
	        							0=>"pi.category.type.0", 
	        							1=>"pi.category.type.1",
	        							2=>"pi.category.type.2",
	        							3=>"pi.category.type.3", 
	        							4=>"pi.category.type.4", 
	        							5=>"pi.category.type.5", 
	        							6=>"pi.category.type.6", 
	        							7=>"pi.category.type.7", 
	        							8=>"pi.category.type.8", 
	        							9=>"pi.category.type.9"
	        						),
	        		'label'	=> 'pi.page.form.status',
	        		'required'  => true,
	        		'multiple'	=> false,
	        		'expanded' => true,
	        ))
 			->add('name', 'text', array(
 				'label' => "pi.form.label.field.name"
 			))
 			->add('descriptif', 'textarea', array(
 					'label'	=> "pi.form.label.field.description",
 					"label_attr" => array(
 							"class"=>"text_collection",
 					),
 					"attr" => array(
 							"class"	=>"pi_editor_simple",
 					),
 					'required'  => false,
 			))
 			->add('media', new \PiApp\GedmoBundle\Form\MediaType($this->_em, 'image', 'image_collection', "simpleLink", 'pi.form.label.media.picture')) 			
        ;
    }

    public function getName()
    {
        return 'piapp_gedmobundle_categorytype';
    }
        
}
