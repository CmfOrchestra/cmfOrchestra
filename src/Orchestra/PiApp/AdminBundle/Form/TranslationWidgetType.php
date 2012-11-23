<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Form
 * @package    CMS_Form
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-02-10
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of the TranslationPageType form.
 *
 * @category   Admin_Form
 * @package    CMS_Form
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class TranslationWidgetType extends AbstractType
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
	public function __construct(ContainerInterface $container)
	{
		$this->_container 	= $container;
		$this->_locale		= $container->get('session')->getLocale();
	}	
		
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
        	->add('enabled', 'checkbox', array(
        			'data'  => true,
        			'label'	=> 'pi.form.label.field.enabled',
        	))
        	->add('langCode', 'entity', array(
        			'class' => 'PiAppAdminBundle:Langue',
        			"label"	=> "pi.form.label.field.language",
        			"attr" => array(
        					"class"=>"pi_simpleselect",
        			),
        	))        	
	        ->add('published_at', 'date', array(
	        		'widget' => 'single_text', // choice, text, single_text
	        		'input' => 'datetime',
	        		'format' => $this->_container->get('pi_app_admin.twig.extension.tool')->getDatePatternByLocalFunction($this->_locale),// 'dd/MM/yyyy', 'MM/dd/yyyy',
	        		'empty_value' => array('year' => 'Année', 'month' => 'Mois', 'day' => 'Jour'),
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
	        		'format' => $this->_container->get('pi_app_admin.twig.extension.tool')->getDatePatternByLocalFunction($this->_locale),// 'dd/MM/yyyy', 'MM/dd/yyyy',
	        		'empty_value' => array('year' => 'Année', 'month' => 'Mois', 'day' => 'Jour'),
	        		//'pattern' => "{{ day }}/{{ month }}/{{ year }}",
	        		//'data_timezone' => "Europe/Paris",
	        		//'user_timezone' => "Europe/Paris",
	        		"attr" => array(
	        				"class"=>"pi_datepicker",
	        		),
	        		'label'	=> 'pi.form.label.date.archivage',
	        ))
        	->add('content', 'textarea', array(
            		"attr" => array(
            				"class"	=>"pi_editor",
            		),
            ))
        ;
    }

    public function getName()
    {
        return 'piapp_adminbundle_translationwidgettype';
    }
    
    public function getDefaultOptions(array $options)
    {
    	return array(
    			'data_class' => 'PiApp\AdminBundle\Entity\TranslationWidget',
    	);
    }    
}
