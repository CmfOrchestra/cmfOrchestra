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
 * Description of the PageCssJsType form.
 *
 * @category   Admin_Form
 * @package    CMS_Form
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PageCssJsType extends AbstractType
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $_container;
    
    /**
     * Constructor.
     *
     * @param array $roles_user
     * @return void
     */
    public function __construct(ContainerInterface $container)
    {
        $this->_container     = $container;
    }    
        
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('enabled', 'checkbox', array(
                    'data'  => true,
                    'label'    => 'pi.form.label.field.enabled',
            ))
            ->add('user', 'entity', array(
                    'class' => 'BootStrapUserBundle:User',
                    'label'    => 'pi.form.label.field.user',
                    "attr" => array(
                            "class"=>"pi_simpleselect",
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
                    'choices'   => PageRepository::getAvailableCssJsContentTypes(),
                    'required'  => true,
                    'multiple'    => false,
                    'expanded'  => true,
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
            ->add('url', 'text', array(
                    'help_block' => 'css/js file path (ex: bundles/piappadmin/css/screen.css)'
            ))
            ->add('translations', 'collection', array(
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype'    => true,
                    // Post update
                    'by_reference' => true,                    
                    'type'   => new TranslationCssJsPageType,
                    'options'  => array(
                            'attr'      => array('class' => 'translation_widget')
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