<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Form
 * @package    Extension
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-01-09
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormBuilder;

 
class LabelFieldTypeExtension extends AbstractTypeExtension
{
	public function buildForm(FormBuilder $builder, array $options)
	{
        $builder->setAttribute('label_attr', $options['label_attr']);
        $builder->setAttribute('label_render', $options['label_render']);
	}
	
	public function buildView(FormView $view, FormInterface $form)
	{
	    $view->set('label_attr', $form->getAttribute('label_attr'));
	    $view->set('label_render', $form->getAttribute('label_render'));
	}
    public function getDefaultOptions(array $options)
    {
        return array(
            'label_attr' => array(),
            'label_render' => true,
        );
    }
	public function getExtendedType()
	{
		return 'field';
	}
}