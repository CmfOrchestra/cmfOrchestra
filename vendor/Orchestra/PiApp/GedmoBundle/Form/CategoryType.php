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
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;

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
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $_container;    
    
    /**
     * Constructor.
     *
     * @param \Doctrine\ORM\EntityManager $em
     * @return void
     */
    public function __construct(ContainerInterface $container, EntityManager $em)
    {
        $this->_em = $em;
        $this->_container     = $container;
    }
        
    public function buildForm(FormBuilderInterface $builder, array $options)
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
                                    ),
                    'label'    => 'pi.page.form.status',
                    'required'  => true,
                    'multiple'    => false,
                    'expanded' => true,
            ))
             ->add('name', 'text', array(
                 'label' => "pi.form.label.field.name"
             ))
             ->add('subtitle', 'text', array(
                     'label'    => "pi.form.label.field.subtitle",
                     'required'  => false,
             ))
             ->add('descriptif', 'textarea', array(
                     'label'    => "pi.form.label.field.description",
                     "label_attr" => array(
                             "class"=>"text_collection",
                     ),
                     "attr" => array(
                             "class"    =>"pi_editor_simple_easy",
                     ),
                     'required'  => false,
             ))
             ->add('media', new \PiApp\GedmoBundle\Form\MediaType($this->_container, $this->_em, 'image', 'image_collection', "simpleLink", 'pi.form.label.media.picture'))
        ;
    }

    public function getName()
    {
        return 'piapp_gedmobundle_categorytype';
    }
        
}
