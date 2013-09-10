<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
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
        

class UsersNewFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('enabled', 'checkbox', array(
            		'data'  => true,
            		'label'	=> 'pi.form.label.field.enabled',
            ))      
            ->add('username', 'text', array('label' => 'users.username'))
            ->add('email', 'email', array('label' => 'users.email'))
            ->add('lang_code','entity',array(
                    'label' => 'users.language',
                    'class' => 'PiAppAdminBundle:Langue',
                    'property' => 'id'
                     ))
            ->add('groups','entity', array(
                                        'label' => 'users.groups',
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
                                        'expanded'  => true,
 					'required'  => true,
                    ))
            ->add('plainPassword', 'repeated', array(
                    'type' => 'password',
                    'options' => array('translation_domain' => 'FOSUserBundle'),
                    'first_options' => array('label' => 'form.password'),
                    'second_options' => array('label' => 'form.password_confirmation'),
                    'invalid_message' => 'fos_user.password.mismatch',
            ))
        ;
    }


    public function getName()
    {
        return 'fos_user_registration';
    }
}
