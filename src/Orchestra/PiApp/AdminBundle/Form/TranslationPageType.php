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
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('enabled')
        	->add('published_at', 'date', array(
	        		'widget' => 'single_text', // choice, text, single_text
	        		'input' => 'datetime',
	        		'format' => 'MM/dd/yyyy',
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
	        		'format' => 'MM/dd/yyyy',
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
            		'required'  => true,
            		'multiple'	=> false,
            		'expanded' => true,
            ))     
            ->add('secure')
            ->add('heritage', 'bootstrap_security_roles', array( 'multiple' => true, 'required' => false))
            ->add('indexable')
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
		            "attr" => array(
		            		"class"=>"pi_multiselect",
		            ),
            ))
            ->add('breadcrumb')
            ->add('slug')
            ->add('meta_title')
            ->add('meta_keywords')
            ->add('meta_description')
//             ->add('surtitre')
//             ->add('titre')
//             ->add('soustitre')
//             ->add('descriptif')
//             ->add('chapo')
//             ->add('ps')
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
