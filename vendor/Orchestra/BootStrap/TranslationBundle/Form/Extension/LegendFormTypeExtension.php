<?php
/**
 * This file is part of the <Translation> project.
 *
 * @category   Admin_Form
 * @package    Extension
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-09
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\TranslationBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\OptionsResolver\Options;
 
class LegendFormTypeExtension extends AbstractTypeExtension
{
    private $show_legend;
    private $show_child_legend;
    
    public function __construct(array $options){
        $this->show_legend = $options['show_legend'];
        $this->show_child_legend = $options['show_child_legend'];
    }
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
        $builder->setAttribute('show_legend', $options['show_legend']);
        $builder->setAttribute('show_child_legend', $options['show_child_legend']);
	}
	
	public function buildView(FormView $view, FormInterface $form, array $options)
	{
	    $view->set('show_legend', $form->getAttribute('show_legend'));
	    $view->set('show_child_legend', $form->getAttribute('show_child_legend'));
	}
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
    	$resolver->setDefaults(array(
            'show_legend' 		=> $this->show_legend,
            'show_child_legend' => $this->show_child_legend,
        ));
    }
	public function getExtendedType()
	{
		return 'form';
	}
}