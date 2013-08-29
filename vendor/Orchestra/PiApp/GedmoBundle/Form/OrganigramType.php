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
 * Description of the OrganigramType form.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class OrganigramType extends AbstractType
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
        $choiceList = $this->_em->getRepository("PiAppGedmoBundle:Organigram")->getArrayAllByField('category');
        if (!isset($choiceList) || !count($choiceList))
            $choiceList = array();
        
        $builder            
             ->add('enabled', 'checkbox', array(
                    'data'  => true,
            ))          
            //->add('slug')            
            ->add('page', 'entity', array(
                    'class' => 'PiAppAdminBundle:Page',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->getAllPageHtml();
                    },
                    'property' => 'route_name',
                    'empty_value' => 'pi.form.label.select.choose.option',
                    "label"     => "pi.form.label.field.url",
                    'multiple'    => false,
                    'required'  => false,
                    "attr" => array(
                            "class"=>"pi_simpleselect",
                    ),                    
            ))
            ->add('category', 'choice', array(
                    'choices'   => $choiceList,
                    'multiple'    => false,
                    'required'  => false,
                    'empty_value' => 'pi.form.label.select.choose.category',
                    'label'    => "pi.form.label.field.category",
                    "attr" => array(
                            "class"=>"pi_simpleselect",
                    ),
            ))
            ->add('categoryother', 'text', array(
                    "label"     => "pi.form.label.field.or",
                    'required'  => false,
            ))           
             ->add('parent', 'entity', array(
                    'class' => 'PiAppGedmoBundle:Organigram',
                    'query_builder' => function(EntityRepository $er) {
                        $translatableListener = $this->_container->get('gedmo.listener.translatable');
                        $translatableListener->setTranslationFallback(true);
                        return $er->createQueryBuilder('k')
                        ->select('k')
                        ->orderBy('k.lft', 'ASC');
                    },
                    'empty_value' => 'pi.form.label.select.choose.option',
                    'multiple'    => false,
                    'required'  => false,
                    "attr" => array(
                            "class"=>"pi_simpleselect",
                    ),
            ))
            ->add('title', 'text', array(
                     'label'    => "pi.form.label.field.title",
             ))            
             ->add('descriptif', 'textarea', array(
                     'label'    => 'pi.form.label.field.description',
             ))   
            ->add('question')
            ->add('content', 'textarea', array(
                    'label'    => "pi.form.label.field.content",
                    "attr" => array(
                            "class"    =>"pi_editor_simple_easy",
                    ),
            ))            
            ->add('media', new \PiApp\GedmoBundle\Form\MediaType($this->_container, $this->_em, 'image', 'image_collection', "simpleLink", 'pi.form.label.media.picture'))
        ;
    }

    public function getName()
    {
        return 'piapp_gedmobundle_organigramtype';
    }
        
}
