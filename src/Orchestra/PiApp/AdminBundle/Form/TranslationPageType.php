<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Form
 * @package    CMS_Form
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-01-07
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;

use PiApp\AdminBundle\Repository\TranslationPageRepository;
use Doctrine\ORM\EntityRepository;

/**
 * Description of the TranslationPageType form.
 *
 * @category   Admin_Form
 * @package    CMS_Form
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class TranslationPageType extends AbstractType
{
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
	 * @return void
	 */
	public function __construct($locale, ContainerInterface $container)
	{
		$this->_container 	= $container;
		$this->_locale		= $locale;
	}	
		
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('enabled', 'checkbox', array(
        			'data'  => true,
        			'label'	=> 'pi.form.label.field.enabled',
        	))
        	->add('secure', 'checkbox', array(
        			'label'	=> 'pi.page.form.secure',
        			'required' => false,
        	))
        	->add('heritage', 'bootstrap_security_roles', array(
        			'multiple' => true,
        			'required' => false,
        			'label'	=> 'pi.page.form.heritage'
        	))
        	->add('indexable', 'hidden', array(
        			'label'	=> 'pi.page.form.indexable',
        			'required' => false,
        	))        	
        	->add('published_at', 'date', array(
	        		'widget' => 'single_text', // choice, text, single_text
	        		'input' => 'datetime',
	        		'format' => $this->_container->get('pi_app_admin.twig.extension.tool')->getDatePatternByLocalFunction($this->_locale),// 'dd/MM/yyyy', 'MM/dd/yyyy',
	        		//'empty_value' => array('year' => 'Année', 'month' => 'Mois', 'day' => 'Jour'),
	        		//'pattern' => "{{ day }}/{{ month }}/{{ year }}",
	        		//'data_timezone' => "Europe/Paris",
	        		//'user_timezone' => "Europe/Paris",
	        		"attr" => array(
	        				"class"=>"pi_datepicker",
	        		),
        			'label'	=> 'pi.form.label.date.publication',
	        ))
	        ->add('archive_at', 'date', array(
	        		'widget' => 'single_text', // choice, text, single_text
	        		'input' => 'datetime',
	        		'format' => $this->_container->get('pi_app_admin.twig.extension.tool')->getDatePatternByLocalFunction("fr_FR"),// 'dd/MM/yyyy', 'MM/dd/yyyy',
	        		//'empty_value' => array('year' => 'Année', 'month' => 'Mois', 'day' => 'Jour'),
	        		//'pattern' => "{{ day }}/{{ month }}/{{ year }}",
	        		//'data_timezone' => "Europe/Paris",
	        		//'user_timezone' => "Europe/Paris",
	        		"attr" => array(
	        				"class"=>"pi_datepicker",
	        		),
	        		'label'	=> 'pi.form.label.date.archivage',
	        ))
        	->add('langCode', 'entity', array(
					'class' => 'PiAppAdminBundle:Langue',
        			"label"	=> "pi.form.label.field.language",
        			"attr" => array(
        					"class"=>"pi_simpleselect",
        			),        	
        	))
//             ->add('langStatus', 'choice', array(
//             		'choices'   => TranslationPageRepository::getAvailableLangStatus(),
//             		'required'  => true,
//             		'multiple'	=> false,
//             		'expanded' => true,
//             ))            
            ->add('status', 'choice', array(
            		'choices'   => TranslationPageRepository::getAvailableStatus(),
            		'label'	=> 'pi.page.form.status',
            		'required'  => true,
            		'multiple'	=> false,
            		'expanded' => true,
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
		            'multiple'	=> true,
		            'required'  => false,
		            'label'	=> 'pi.page.form.tags',
		            "attr" => array(
		            		"class"=>"pi_multiselect",
		            ),
            ))
            ->add('breadcrumb', 'hidden', array(
            		'label'	=> 'pi.page.form.breadcrumb',
            		'required' => false,
            ))
            ->add('slug', 'text', array(
            		'label'	=> 'pi.page.form.slug',
            		'required' => false,
            ))
            ->add('meta_title', 'text', array(
            		"label" => "pi.form.label.field.meta_title",
            		'required' => false,
            ))
            ->add('meta_keywords', 'text', array(
            		"label" => "pi.form.label.field.meta_keywords",
            		'required' => false,
            ))
            ->add('meta_description', 'text', array(
            		"label" => "pi.form.label.field.meta_description",
            		'required' => false,
            ))
        ;
    }

    public function getName()
    {
        return 'piapp_adminbundle_translationpagetype';
    }
    
    public function getDefaultOptions(array $options)
    {
    	return array(
    			'data_class' => 'PiApp\AdminBundle\Entity\TranslationPage', // Ni de modifier la classe ici.
    	);
    }    
}
