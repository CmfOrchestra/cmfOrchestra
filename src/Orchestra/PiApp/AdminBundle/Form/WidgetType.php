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

use PiApp\AdminBundle\Twig\Extension\PiWidgetExtension;

/**
 * Description of the TranslationPageType form.
 *
 * @category   Admin_Form
 * @package    CMS_Form
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class WidgetType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
	        $builder
            ->add('enabled', 'checkbox', array(
        			'data'  => true,
        			'label'	=> 'pi.form.label.field.enabled',
        	))
//             ->add('cacheable', 'checkbox', array(
//             		'label'     => 'Static Content?',
//             		'required'  => false,
//             		'help_block' => 'Returns a 304 "not modified" status, when the template has not changed since last visit.'
//             ))
//             ->add('public', 'checkbox', array(
//             		'label'     => 'Visitor-independant content?',
//             		'required'  => false,
//             		'help_block' => 'Allows proxies to cache the same content for different visitors.'
//             ))
//             ->add('lifetime', 'number', array(
//             		'label'     => 'Cache Lifetime',
//             		'required'  => false,
//             		'help_block' => 'Does a full content caching during the specified lifetime. Leave empty for no cache.',
//             		'data'		=> '84600',
//             ))
        	->add('plugin', 'choice', array(
            		'choices'   => PiWidgetExtension::getAvailableWidgetPlugins(),
            		'required'  => true,
            		'multiple'	=> false,
            		'expanded'  => false,
//         			"attr" => array(
//         					"class"=>"pi_simpleselect",
//         			),        			
            ))
            ->add('action')
            ->add('configCssClass')
            ->add('configXml', 'textarea', array(
            		'data'  => PiWidgetExtension::getDefaultConfigXml(),
            ))
            ->add('position')
        ;
    }

    public function getName()
    {
        return 'piapp_adminbundle_widgettype';
    }
    
    public function getDefaultOptions(array $options)
    {
    	return array(
    			'data_class' => 'PiApp\AdminBundle\Entity\Widget',
    	);
    }    
}
