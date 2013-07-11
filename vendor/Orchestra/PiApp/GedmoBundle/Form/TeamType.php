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
 * Description of the TeamType form.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class TeamType extends AbstractType
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
     * @param string    $locale
     * @return void
     */
    public function __construct(EntityManager $em, ContainerInterface $container)
    {
        $this->_em             = $em;
        $this->_locale        = $container->get('request')->getLocale();
        $this->_container     = $container;
    }
        
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder             
             ->add('enabled', 'checkbox', array(
                    'data'  => true,
                     'label'    => 'pi.form.label.field.enabled',
            ))         
            ->add('category', 'choice', array(
                 'choices'   => array(
                                         "Le bureau" =>"Le bureau",
                                          "Le conseil d'administration" => "Le conseil d'administration",
                                         "Les permanents" => "Les permanents"
                                 ),
                 'empty_value' => 'pi.form.label.select.choose.category',
                 'label'    => "pi.form.label.field.category",
                 "attr" => array(
                         "class"=>"pi_simpleselect",
                 ),
                 "label_attr" => array(
                         "class"=>"category_collection",
                 ),
                 'multiple'    => false,
                 'required'  => false,
            ))                
            ->add('name', 'text', array(
                     'label'        => "pi.form.label.field.name",
                     'required'  => false,
             ))            
             ->add('nickname', 'text', array(
                     'label'        => "Prénom",
                     'required'  => false,
             ))             
             ->add('InscrJob', 'text', array(
                     'label'        => "Poste",
                     'required'  => false,
             ))             
             ->add('email')             

             ->add('media', new \PiApp\GedmoBundle\Form\MediaType($this->_container, $this->_em, 'image', 'image_collection', "simpleLink", 'pi.form.label.media.picture'))
        ;
    }

    public function getName()
    {
        return 'piapp_gedmobundle_teamtype';
    }
        
}
