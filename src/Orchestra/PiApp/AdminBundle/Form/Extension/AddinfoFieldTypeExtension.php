<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Form
 * @package    Extension
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
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

class AddinfoFieldTypeExtension extends AbstractTypeExtension
{

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->setAttribute('widget_prefix', $options['widget_prefix']);
        $builder->setAttribute('widget_suffix', $options['widget_suffix']);
        $builder->setAttribute('widget_remove_btn', $options['widget_remove_btn']);
    }

    public function buildView(FormView $view, FormInterface $form)
    {
        $view->set('widget_prefix', $form->getAttribute('widget_prefix'));
        $view->set('widget_suffix', $form->getAttribute('widget_suffix'));
        $view->set('widget_remove_btn', $form->getAttribute('widget_remove_btn'));
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'widget_prefix' => null,
            'widget_suffix' => null,
            'widget_remove_btn' => null,
        );
    }
    public function getExtendedType()
    {
        return 'field';
    }
}