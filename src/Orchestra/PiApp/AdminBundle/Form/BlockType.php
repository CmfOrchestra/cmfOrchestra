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

use PiApp\AdminBundle\Form\WidgetType;

/**
 * Description of the PageByBlockType form.
 *
 * @category   Admin_Form
 * @package    CMS_Form
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class BlockType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
			->add('enabled')
        	->add('name')
            ->add('configCssClass')
            ->add('configXml')
            ->add('position')           
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