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
 * Description of the MediaType form.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class MediaType extends AbstractType
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
    protected $_status;    
    
    /**
     * @var string
     */
    protected $_class;    
    
    /**
     * @var string
     */
    protected $_simpleLink;    
    
    /**
     * @var string
     */
    protected $_labelLink;    

    /**
     * @var string
     */
    protected $_context;
    
    /**
     * Constructor.
     *
     * @param \Doctrine\ORM\EntityManager $em
     * @param string $status    ['file', 'image', 'youtube', 'dailymotion']
     * @return void
     */
    public function __construct(ContainerInterface $container, EntityManager $em, $status = "image", $class =  "media_collection", $simpleLink = "all", $labelLink = "", $context = "")
    {
        $this->_em            = $em;
        $this->_container     = $container;
        $this->_status        = $status;
        $this->_class        = $class;
        $this->_simpleLink    = $simpleLink;
        $this->_labelLink    = $labelLink;
        $this->_context        = $context;
    }
        
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('status', 'hidden', array(
                    "data"        => $this->_status,
                    "label_attr" => array(
                            "class"=> $this->_class,
                    ),
                    'required'  => false,
                ))
        ;
        
        if ($this->_simpleLink == "all"){
            $builder            
                 ->add('enabled', 'checkbox', array(
                        //'data'  => true,
                         'label'    => 'pi.form.label.field.enabled',
                         "label_attr" => array(
                                 "class"=> $this->_class,
                         ),
                ))           
                 ->add('category', 'entity', array(
                        'class'         => 'PiAppGedmoBundle:Category',
                         'query_builder' => function(EntityRepository $er) {
                             return $er->createQueryBuilder('k')
                             ->select('k')
                             ->where('k.type = :type')
                             ->orderBy('k.name', 'ASC')
                             ->setParameter('type', 2);
                         },
                        'property'         => 'name',
                        'empty_value'     => 'pi.form.label.select.choose.category',
                        'multiple'        => false,
                        'required'      => false,
                        "attr" => array(
                                "class"=>"pi_simpleselect",
                        ),
                         'label'    => "pi.form.label.field.category",
                         "label_attr" => array(
                                 "class"=> $this->_class,
                         ),
                ))               
                 ->add('title', 'text', array(
                         'label'            => "pi.form.label.field.title",
                         "label_attr"     => array(
                                 "class"=> $this->_class,
                         ),
                         'required'      => false,
                 ))            
                 ->add('url', 'text', array(
                         "label"     => "pi.form.label.field.url",
                         "label_attr" => array(
                                 "class"=> $this->_class,
                         ),
                         'required'  => false,
                 ))                     
            ;
        }elseif ($this->_simpleLink == "simpleCategory"){
            $builder
                ->add('enabled', 'hidden', array(
                        'data'  => true,
                         "label_attr" => array(
                                 "class"=> $this->_class,
                         ),
                ))   
                ->add('category', 'entity', array(
                            'class' => 'PiAppGedmoBundle:Category',
                            'property' => 'name',
                            'empty_value' => 'pi.form.label.select.choose.category',
                            'multiple'    => false,
                            'required'  => false,
                            "attr" => array(
                                    "class"=>"pi_simpleselect",
                            ),
                            'label'    => "pi.form.label.field.category",
                             "label_attr" => array(
                                     "class"=> $this->_class,
                             ),
                ))
            ;    
        }elseif ( ($this->_simpleLink == "simpleLink") || ($this->_simpleLink == "hidden") || ($this->_simpleLink == "simple") ){
            $builder
            ->add('enabled', 'hidden', array(
                        'data'  => true,
                         "label_attr" => array(
                                 "class"=> $this->_class,
                         ),
                ))
            ;
        }
        
        if ($this->_simpleLink == "hidden"){
            $style = "display:none";
        }else 
            $style = "";
          
          if ($this->_status == "file"){
            if ($this->_labelLink == "")    $this->_labelLink    = 'pi.form.label.media.file';
            if ($this->_context == "")    $this->_context        = 'file';
             $builder->add('image', 'sonata_media_type', array(
                     'provider'  => 'sonata.media.provider.file',
                     'context'   => $this->_context,
                     'label'        => $this->_labelLink,
                     "label_attr" => array(
                             "class"=> $this->_class,
                             "style"=> $style,
                     ),
                     "attr"    => array("style"=> $style),
                     'required'  => false,
             ));        
         }elseif ($this->_status == "image"){
             if ($this->_labelLink == "") $this->_labelLink = 'pi.form.label.media.picture';     
             if ($this->_context == "")    $this->_context        = 'image';
             $builder->add('image', 'sonata_media_type', array(
                     'provider'     => 'sonata.media.provider.image',
                     'context'      => $this->_context,
                     'label'        => $this->_labelLink,
                     "label_attr" => array(
                             "class"=> $this->_class,
                             "style"=> $style,
                     ),
                     "attr"    => array("style"=> $style),
                     'required'  => false,
             ));            
         }elseif ($this->_status == "youtube"){
             if ($this->_labelLink == "") $this->_labelLink     = 'pi.form.label.media.youtube';
             if ($this->_context == "")    $this->_context        = 'youtube';
             $builder->add('image', 'sonata_media_type', array(
                     'provider'     => 'sonata.media.provider.youtube',
                     'context'      => $this->_context,
                     'label'        => $this->_labelLink,
                     "label_attr" => array(
                             "class"=> $this->_class,
                             "style"=> $style,
                     ),
                     "attr"    => array("style"=> $style),
                     'required'  => false,
             ));
         }elseif ($this->_status == "dailymotion"){
             if ($this->_labelLink == "") $this->_labelLink     = 'pi.form.label.media.dailymotion';
             if ($this->_context == "")    $this->_context        = 'dailymotion';
             $builder->add('image', 'sonata_media_type', array(
                     'provider'     => 'sonata.media.provider.dailymotion',
                     'context'      => $this->_context,
                     'label'        => $this->_labelLink,
                     "label_attr" => array(
                             "class"=> $this->_class,
                             "style"=> $style,
                     ),
                     "attr"    => array("style"=> $style),
                     'required'  => false,
             ));
         }     


         if (($this->_simpleLink != "hidden") && ($this->_simpleLink != "simple"))
             $builder
                 ->add('mediadelete', 'checkbox', array(
                     'data'  => false,
                     'required'  => false,
                     'help_block' => $this->_container->get('translator')->trans('pi.media.form.field.mediadelete', array('%s'=>$this->_status)),
                     'label'        => "pi.delete",
                     "label_attr" => array(
                             "class"=> $this->_class,
                     ),
                     "attr"    => array("style"=> $style),
                 ));         
         
    }

    public function getName()
    {
        return 'piapp_gedmobundle_mediatype';
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
                'data_class' => 'PiApp\GedmoBundle\Entity\Media',
        );
    }       
}