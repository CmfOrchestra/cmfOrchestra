<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Form
 * @package    CMS_Form
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-02-10
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * Description of the TranslationPageType form.
 *
 * @category   Admin_Form
 * @package    CMS_Form
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class TranslationWidgetType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
        	->add('enabled')
        	->add('langCode', 'entity', array(
        			'class' => 'PiAppAdminBundle:Langue',
        			"attr" => array(
        					"class"=>"pi_simpleselect",
        			),
        	))        	
	        ->add('published_at', 'date', array(
	        		'widget' => 'single_text', // choice, text, single_text
	        		'input' => 'datetime',
	        		'format' => 'MM/dd/yyyy',
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
	        		'format' => 'MM/dd/yyyy',
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
