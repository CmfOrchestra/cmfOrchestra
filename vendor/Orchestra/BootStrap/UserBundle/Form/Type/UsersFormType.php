<?php

namespace BootStrap\UserBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class UsersFormType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
                    ->add('username','text',array('label' => 'users.username'))
                    ->add('email','email',array('label' => 'users.email'))  
                    ->add('lang_code','entity',array(
                                        'label' => 'users.language',
                                        'class' => 'PiAppAdminBundle:Langue',
                                        'property' => 'id'
                     ))
                    ->add('groups','entity', array(
 					'class' => 'BootStrapUserBundle:Group',
 					'query_builder' => function(EntityRepository $er) {
 						return $er->createQueryBuilder('k')
 						->select('k')
 						->where('k.enabled = :enabled')
 						->orderBy('k.name', 'ASC')
 						->setParameter('enabled', 1);
 					},
 					'property' => 'name',
 					'empty_value' => 'pi.form.label.select.choose.category',
 					'multiple'	=> true,
                                        'expanded'  => true,
 					'required'  => true,
                    ))
                    ->add('enabled', 'checkbox', array(
            		    'data'  => true,
                        'label'	=> 'pi.form.label.field.enabled',
            	)); 	   

	}
	public function getName()
	{
		return 'users_form';
	}
}