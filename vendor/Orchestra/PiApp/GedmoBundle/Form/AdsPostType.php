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
 * Description of the AdsPostType form.
 *
 * @category   PI_CRUD_Form
 * @package    Form
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class AdsPostType extends AbstractType
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
        
             ->add('user', 'entity', array(
                    'class'     => 'BootStrapUserBundle:User',
                    'label'    => 'pi.form.label.field.user',
                    "attr"         => array(
                            "class"=>"pi_simpleselect",
                    ),
            ))     

             ->add('tags', 'entity', array(
                     'class' => 'PiAppAdminBundle:Tag',
                     'query_builder' => function(EntityRepository $er) {
                         return $er->createQueryBuilder('k')
                         ->select('k')
                         ->where('k.enabled = :enabled')
                         ->orderBy('k.groupname', 'ASC')
                         ->setParameter('enabled', 1);
                     },
                    "attr" => array(
                             "class"    =>"list_tags",
                     ),
                     'multiple'    => true,
                     'required'  => false,
             ))
             ->add('content', 'textarea', array(
                     'label'    => "pi.form.label.field.description",
                     'required'  => false,
                     "attr" => array(
                             "class"=>"full required",
                     ),                     
             ))
             ->add('typology', 'choice', array(
                     'choices'   => array(
                             'pi.ads.form.type.market'    =>"pi.ads.form.type.market",
                             'pi.ads.form.type.job'         =>"pi.ads.form.type.job",
                     ),
                    'empty_value' => 'pi.form.label.select.choose.typologie',
                    'attr'         => array(
                            'class'=>'resetP required',
                    ),      
                    'label'    => 'Espace',
                     'required'  => false,
                     'multiple'    => false,
                     'expanded' => true,
             ))
             ->add('status', 'choice', array(
                     'choices'   => array(
                             'pi.ads.form.type.search'    =>"pi.ads.form.type.post.search",
                             'pi.ads.form.type.propose'  =>"pi.ads.form.type.post.propose",
                     ),
                      'empty_value' => 'pi.form.label.select.choose.type',
                     'attr'         => array(
                              'class'=>'required',
                      ),        
                     'label'    => 'Catégorie',
                     'required'  => false,
                     'multiple'    => false,
                     'expanded' => true,
             ))            
             ->add('title', 'text', array(
                     'label'    => "pi.form.label.field.title",
                     "attr" => array(
                             "class"=>"required text",
                     ),
                     'required'  => false,
             ))    
            ->add('media', new \PiApp\GedmoBundle\Form\MediaType(
            $this->_container,
              $this->_em, 
              'file', 
              '', 
              "simple", 
              'Téléchargez une pièce jointe'))
        ;
    }

    public function getName()
    {
        return 'piapp_gedmobundle_ads_posttype';
    }
        
}
