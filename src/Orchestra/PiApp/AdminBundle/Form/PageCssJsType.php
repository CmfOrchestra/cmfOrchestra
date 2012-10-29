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

use PiApp\AdminBundle\Repository\PageRepository;
use Doctrine\ORM\EntityRepository;

/**
 * Description of the PageCssJsType form.
 *
 * @category   Admin_Form
 * @package    CMS_Form
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class PageCssJsType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('user', 'entity', array(
            		'class' => 'BootStrapUserBundle:User',
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
				    'multiple'	=> true,
				    'required'  => false,
				    "attr" => array(
				    		"class"=>"pi_multiselect",
				    ),
			))        
            ->add('meta_content_type', 'choice', array(
            		'choices'   => PageRepository::getAvailableCssJsContentTypes(),
            		'required'  => true,
            		'multiple'	=> false,
            		'expanded'  => true,
            ))
            ->add('enabled')
        	->add('cacheable', 'checkbox', array(
    				'label'     => 'Static Content?',
        			'required'  => false,
        			'help_block' => 'Returns a 304 "not modified" status, when the template has not changed since last visit.'
        	))
            ->add('public', 'checkbox', array(
    				'label'     => 'Visitor-independant content?',
            		'required'  => false,
            		'help_block' => 'Allows proxies to cache the same content for different visitors.'
        	))
            ->add('lifetime', 'number', array(
            		'label'     => 'Cache Lifetime',
            		'required'  => false,
            		'help_block' => 'Does a full content caching during the specified lifetime. Leave empty for no cache.'
            ))
            ->add('url', 'text', array(
            		'help_block' => 'css/js file path (ex: bundles/piappadmin/css/screen.css)'
            ))
			->add('translations', 'collection', array(
            		'allow_add' => true,
            		'allow_delete' => true,
            		'prototype'	=> true,
					// Post update
					'by_reference' => true,					
            		'type'   => new TranslationCssJsPageType,
					'options'  => array(
							'attr'      => array('class' => 'translation_widget')
					),					
            )) 
         ;
    }

    public function getName()
    {
        return 'piapp_adminbundle_pagetype';
    }
    
    public function getDefaultOptions(array $options)
    {
    	return array(
    			'data_class' => 'PiApp\AdminBundle\Entity\Page',
    	);
    }    
    
}
