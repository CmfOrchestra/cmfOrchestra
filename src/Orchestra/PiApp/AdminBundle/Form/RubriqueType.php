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

use Doctrine\ORM\EntityRepository;

/**
 * Description of the RubriqueType form.
 *
 * @category   Admin_Form
 * @package    CMS_Form
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class RubriqueType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
        	->add('enabled', 'checkbox', array(
        			'data'  => true,
        			'label'	=> 'pi.form.label.field.enabled',
        	))
	        ->add('parent', 'entity', array(
	        		'class' => 'PiAppAdminBundle:Rubrique',
	        		'query_builder' => function(EntityRepository $er) {
	        		return $er->createQueryBuilder('k')
		        		->select('k')
		        		->where('k.enabled = :enabled')
		        		->orderBy('k.lft', 'ASC')
		        		->setParameter('enabled', 1);
			        },
			        'empty_value' => 'Choose an option',
			        'multiple'	=> false,
			        'required'  => false,
			        "attr" => array(
			        		"class"=>"pi_simpleselect",
			        ),
	        ))
            ->add('titre', 'text', array(
            		'label'	=> "pi.form.label.field.title",
            ))
            ->add('descriptif', 'text', array(
 					'label'	=> 'pi.form.label.field.description',
 			))  
            ->add('texte');
    }

    public function getName()
    {
        return 'piapp_adminbundle_rubriquetype';
    }
}
