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
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use PiApp\AdminBundle\Repository\PageRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of the PageByBlockType form.
 *
 * @category   Admin_Form
 * @package    CMS_Form
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PageByBlockType extends AbstractType
{

    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $_container;
    
    /**
     * @var array
     */
    protected $_roles_user;
    
    /**
     * Constructor.
     *
     * @param array $roles_user
     * @return void
     */
    public function __construct(ContainerInterface $container, $roles_user = array('ROLE_ADMIN', 'ROLE_SUPER_ADMIN', 'ROLE_CONTENT_MANAGER'))
    {
        $this->_roles_user = $roles_user;
        $this->_container     = $container;
    }
        
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (in_array('ROLE_ADMIN', $this->_roles_user) || in_array('ROLE_SUPER_ADMIN', $this->_roles_user) || in_array('ROLE_CONTENT_MANAGER', $this->_roles_user))
            $read_only = false;
        else
            $read_only = true;
                
        $builder
            ->add('enabled', 'checkbox', array(
                    'data'  => true,
                    'label'    => 'pi.form.label.field.enabled',
            ))
            ->add('user', 'entity', array(
                    'class'     => 'BootStrapUserBundle:User',
                    'read_only'    => $read_only,
                    'label'    => 'pi.form.label.field.user',
                    "attr"         => array(
                            "class"=>"pi_simpleselect",
                    ),
            ))
            ->add('rubrique', 'entity', array(
                    'class' => 'PiAppAdminBundle:Rubrique',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('k')
                        ->select('k')
                        ->where('k.enabled = :enabled')
                        ->orderBy('k.lft', 'ASC')
                        ->setParameter('enabled', 1);
                    },
                    'empty_value' => 'Choose an option',
                    'multiple'    => false,
                    'required'  => false,
                    "attr" => array(
                            "class"=>"pi_simpleselect",
                    ),                    
            ))
            ->add('layout', 'entity', array(
                    'class' => 'PiAppAdminBundle:Layout',
                    "attr" => array(
                            "class"=>"pi_simpleselect",
                    ),
            ))
            ->add('page_css', 'entity', array(
                    'class' => 'PiAppAdminBundle:Page',
                    'query_builder' => function(EntityRepository $er) {
                            return $er->getAllPageCss();
                    },
                    'property' => 'url',
                    'multiple'    => true,
                    'required'  => false,
                    "attr" => array(
                            "class"=>"pi_multiselect",
                    ),
            ))
            ->add('page_js', 'entity', array(
                    'class' => 'PiAppAdminBundle:Page',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->getAllPageJs();
                    },
                    'property' => 'url',
                    'multiple'    => true,
                    'required'  => false,
                    "attr" => array(
                            "class"=>"pi_multiselect",
                    ),
            ))            
            ->add('keywords', 'entity', array(
                    'class' => 'PiAppAdminBundle:KeyWord',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('k')
                            ->select('k')
                            ->where('k.enabled = :enabled')
                            ->orderBy('k.groupname', 'ASC')
                            ->setParameter('enabled', 1);
                    },
                    'multiple'    => true,
                    'required'  => false,
                    "attr" => array(
                            "class"=>"pi_multiselect",
                    ),
            ))        
            ->add('meta_content_type', 'choice', array(
                    'choices'   => PageRepository::getAvailableContentTypes(),
                    'required'  => true,
                    'multiple'    => false,
                    'expanded'  => true,
                    'read_only'    => true,
            ))
            ->add('cacheable', 'checkbox', array(
                    'label'     => 'pi.page.form.cacheable',
                    'required'  => false,
                    //'help_block' => 'Returns a 304 "not modified" status, when the template has not changed since last visit.',
                    'help_block' => $this->_container->get('translator')->trans('pi.page.form.field.cacheable'),
            ))
            ->add('public', 'checkbox', array(
                    'label'     => 'pi.page.form.public',
                    'required'  => false,
                    //'help_block' => 'Allows proxies to cache the same content for different visitors.'
                    'help_block' => $this->_container->get('translator')->trans('pi.page.form.field.public'),
            ))
            ->add('lifetime', 'number', array(
                    'label'     => 'pi.page.form.lifetime',
                    'required'  => false,
                    //'help_block' => 'Does a full content caching during the specified lifetime. Leave empty for no cache.'
                    'help_block' => $this->_container->get('translator')->trans('pi.page.form.field.lifetime'),
            ))
            ->add('route_name')
            ->add('url')
            ->add('blocks', 'collection', array(
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype'    => true,
                    // Post update
                    'by_reference' => true,                    
                    'type'   => new BlockType,
                    'options'  => array(
                            'attr'      => array('class' => 'block_widget')
                    ),    
                    'label'    => ' '
            )) 
         ;
    }

    public function getName()
    {
        return 'piapp_adminbundle_pagetype';
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'PiApp\AdminBundle\Entity\Page',
        ));
    }     
}