<?php
/**
 * This file is part of the <User> project.
 *
 * @category   User_Form
 * @package    Form
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-11-14
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints;

class UsersFormType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
            ->add('enabled', 'checkbox', array(
            		'data'  => true,
            		'label'	=> 'pi.form.label.field.enabled',
            ))      
            ->add('username', 'text', array(
                    'label' => 'pi.form.label.field.username',
                    'constraints' => array(
                    		new Constraints\NotBlank(),
                    ),
            ))
            ->add('email', 'email', array(
                    'label' => 'pi.form.label.field.email',
                    'constraints' => array(
                    		new Constraints\NotBlank(),
                    		new Constraints\Email(),
                    ),
            ))
            ->add('langCode', 'entity', array(
             		'class' => 'PiAppAdminBundle:Langue',
             		'query_builder' => function(EntityRepository $er) {
             			return $er->createQueryBuilder('k')
             			->select('k')
             			->where('k.enabled = :enabled')
             			->orderBy('k.label', 'ASC')
             			->setParameter('enabled', 1);
             		},
             		'property' => 'label',
             		"label"    => "pi.form.label.field.language",
             		"attr" => array(
             				"class"=>"pi_simpleselect",
             		),
            ))     
            ->add('name', 'text', array(
                    'label' => 'pi.form.label.field.name',
                    'constraints' => array(
                    		new Constraints\NotBlank(),
                    ),
            ))
            ->add('nickname', 'text', array(
                    'label' => 'pi.form.label.field.nickname',
                    'constraints' => array(
                    		new Constraints\NotBlank(),
                    ),
            ))
            ->add('groups','entity', array(
                    'label' => 'pi.form.label.field.usergroup',
 					'class' => 'BootStrapUserBundle:Group',
 					'query_builder' => function(EntityRepository $er) {
 						return $er->createQueryBuilder('k')
 						->select('k')
 						->where('k.enabled = :enabled')
 						->orderBy('k.name', 'ASC')
 						->setParameter('enabled', 1);
 					},
 					'property' => 'name',
 					'multiple'	=> true,
                    'expanded'  => false,
 					'required'  => true,
            ))
            ->add('permissions', 'bootstrap_security_permissions', array( 'multiple' => true, 'required' => false))
          ; 	   

	}
	public function getName()
	{
		return 'users_form';
	}
}