<?php
/**
 * This file is part of the <Translator> project.
 *
 * @category   Translator_Form
 * @package    Form
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-11-14
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\TranslatorBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Description of the WordType form.
 *
 * @category   Translator_Form
 * @package    Form
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class WordTranslateType extends AbstractType
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
    public function __construct(EntityManager $em, $locale, ContainerInterface $container)
    {
        $this->_em             = $em;
        $this->_locale        = $locale;
        $this->_container     = $container;
    }
        
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder     
                 ->add('keyword', 'text', array(
                         'read_only'  => true,
                 ))     
                 ->add('label', 'textarea', array(
                         'required'  => false,
                         "attr" => array(
                                 "class"    =>"pi_editor_simple",
                         ),
                         'label'    => "pi.form.label.field.content",
                         "label_attr" => array(
                                 "class"=>"block_collection",
                         ),
                 ))            
        ;
    }

    public function getName()
    {
        return 'piapp_TranslatorBundle_word_translatetype';
    }        
}