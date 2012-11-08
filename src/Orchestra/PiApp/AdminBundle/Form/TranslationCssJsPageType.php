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
 * Description of the TranslationCssJsPageType form.
 *
 * @category   Admin_Form
 * @package    CMS_Form
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class TranslationCssJsPageType extends AbstractType
{
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
        	->add('langStatus', 'choice', array(
        			'choices'   => TranslationPageRepository::getAvailableLangStatus(),
        			'required'  => true,
        			'multiple'	=> false,
        			'expanded' => true,
        			"attr" => array(
        					"class"=>"greyarrow",
        			),
        	))
        	->add('status', 'choice', array(
        			'choices'   => TranslationPageRepository::getAvailableStatus(),
        			'required'  => true,
        			'multiple'	=> false,
        			'expanded' => true,
        	))
        	
            ->add('texte', 'textarea', array(
            		"attr" => array(
            				"class"	=>"pi_editor",
            		),
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
    			'data_class' => 'PiApp\AdminBundle\Entity\TranslationPage',
    	);
    }    
}
