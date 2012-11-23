<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Form
 * @package    CMS_Form
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-07
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use PiApp\AdminBundle\Form\WidgetType;

/**
 * Description of the PageByBlockType form.
 *
 * @category   Admin_Form
 * @package    CMS_Form
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class BlockByWidgetType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
			->add('enabled', 'checkbox', array(
            		'data'  => true,
 					'label'	=> 'pi.form.label.field.enabled',
            )) 
        	->add('name', 'text', array(
 				'label' => "pi.form.label.field.name"
 			))
            ->add('configCssClass')
            ->add('configXml')
            ->add('position')
            ->add('widgets', 'collection', array(
            		'allow_add' => true,
            		'allow_delete' => true,
            		'prototype'	=> true,
            		// Post update
            		'by_reference' => true,
            		'type'   => new WidgetType(),
            		'options'  => array(
            				'attr'      => array('class' => 'block_widget')
            		),
            ))            
        ;
    }

    public function getName()
    {
        return 'piapp_adminbundle_blocktype';
    }
    
    public function getDefaultOptions(array $options)
    {
    	return array(
    			'data_class' => 'PiApp\AdminBundle\Entity\Block',
    	);
    }    
}