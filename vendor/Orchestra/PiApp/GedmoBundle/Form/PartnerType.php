<?php
/**
 * This file is part of the <PI_CRUD> project.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-11-15
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
 * Description of the PartenairesType form.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PartnerType extends AbstractType
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
            ->add('highlighted1', 'checkbox', array(
                    'required'  => false,
                    'data'  => true,
                    'label'    => 'pi.partner.form.field.highlighted1',
            ))
            ->add('highlighted2', 'checkbox', array(
                    'required'  => false,
                    'data'  => true,
                    'label'    => 'pi.partner.form.field.highlighted2',
            ))
            ->add('highlighted3', 'checkbox', array(
                    'required'  => false,
                    'data'  => true,
                    'label'    => 'pi.partner.form.field.highlighted3',
            ))
//             ->add('published_at', 'date', array(
//                     'widget' => 'single_text', // choice, text, single_text
//                     'input' => 'datetime',
//                     'format' => $this->_container->get('pi_app_admin.twig.extension.tool')->getDatePatternByLocalFunction($this->_locale),// 'dd/MM/yyyy', 'MM/dd/yyyy',
//                     'required'  => false,
//                     "attr" => array(
//                             "class"=>"pi_datepicker",
//                     ),
//                     'label'    => 'pi.form.label.date.publication',
//             ))
//             ->add('archive_at', 'date', array(
//                     'widget' => 'single_text', // choice, text, single_text
//                     'input' => 'datetime',
//                     'format' => $this->_container->get('pi_app_admin.twig.extension.tool')->getDatePatternByLocalFunction($this->_locale),// 'dd/MM/yyyy', 'MM/dd/yyyy',
//                     'required'  => false,
//                     "attr" => array(
//                             "class"=>"pi_datepicker",
//                     ),
//                     'label'    => 'pi.form.label.date.archivage',
//             ))
            
            
            ->add('category', 'entity', array(
                     'class' => 'PiAppGedmoBundle:Category',
                     'query_builder' => function(EntityRepository $er) {
                         return $er->createQueryBuilder('k')
                         ->select('k')
                         ->where('k.type = :type')
                         ->orderBy('k.name', 'ASC')
                         ->setParameter('type', 8);
                     },
                     'property' => 'name',
                     'empty_value' => 'pi.form.label.select.choose.category',
                     'label'    => "pi.form.label.field.category",
                     'multiple'    => false,
                     'required'  => false,
                     "attr" => array(
                             "class"=>"pi_simpleselect",
                     ),
                     "label_attr" => array(
                             "class"=>"category_collection",
                     ),
             ))
            
            
            ->add('title', 'text', array(
                    'label'    => "pi.form.label.field.title",
            ))
            
//             ->add('subtitle', 'text', array(
//                     'label'    => "pi.form.label.field.subtitle",
//             ))            
//             ->add('descriptif', 'textarea', array(
//                     'label'    => 'pi.form.label.field.description',
//                     "label_attr" => array(
//                             "class"=>"text_collection",
//                     ),
//             ))
//             ->add('content', 'textarea', array(
//                     'required'  => false,
//                     "attr" => array(
//                             "class"    =>"pi_editor",
//                     ),
//                     'label'    => "pi.form.label.field.content",
//                     "label_attr" => array(
//                             "class"=>"text_collection",
//                     ),
//             ))            
                          
//             ->add('pageurl', 'entity', array(
//                      'class' => 'PiAppAdminBundle:Page',
//                      'query_builder' => function(EntityRepository $er) {
//                          return $er->getAllPageHtml();
//                      },
//                      'property' => 'route_name',
//                      'empty_value' => 'pi.form.label.select.choose.option',
//                      'multiple'    => false,
//                      'required'  => false,
//                      "label"     => "pi.form.label.field.url",
//                      "attr" => array(
//                              "class"=>"pi_simpleselect",
//                      ),
//                      "label_attr" => array(
//                              "class"=>"page_collection",
//                      ),                     
//              ))
             ->add('url', 'text', array(
                     'required'  => false,
                     "label"     => "pi.form.label.field.url",
                     "label_attr" => array(
                             "class"=>"page_collection",
                     ),
             ))        
                         
             ->add('media', new \PiApp\GedmoBundle\Form\MediaType($this->_container, $this->_em, 'image', 'image_collection', "simpleLink", 'pi.form.label.media.picture'))        
        ;
    }

    public function getName()
    {
        return 'piapp_gedmobundle_partnertype';
    }
        
}
