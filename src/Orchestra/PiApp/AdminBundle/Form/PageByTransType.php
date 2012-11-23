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
use Symfony\Component\DependencyInjection\ContainerInterface;

use PiApp\AdminBundle\Repository\PageRepository;
use Doctrine\ORM\EntityRepository;

/**
 * Description of the PageByTransType form.
 *
 * @category   Admin_Form
 * @package    CMS_Form
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PageByTransType extends AbstractType 
{
	/**
	 * @var array
	 */
	protected $_roles_user;
	
	/**
	 * @var \Symfony\Component\DependencyInjection\ContainerInterface
	 */
	protected $_container;	
	
	/**
	 * @var string
	 */
	protected $_locale;	
	
	/**
	 * Constructor.
	 *
	 * @param array $roles_user
	 * @return void
	 */
	public function __construct($locale, $roles_user = array('ROLE_ADMIN', 'ROLE_SUPER_ADMIN', 'ROLE_CONTENT_MANAGER'), ContainerInterface $container)
	{
		$this->_roles_user 	= $roles_user;
		$this->_container 	= $container;
		$this->_locale		= $locale;
	}
		
    public function buildForm(FormBuilder $builder, array $options)
    {
    	if(in_array('ROLE_ADMIN', $this->_roles_user) || in_array('ROLE_SUPER_ADMIN', $this->_roles_user) || in_array('ROLE_CONTENT_MANAGER', $this->_roles_user))
    		$read_only = false;
    	else
    		$read_only = true;
    	
        $builder
        	->add('enabled', 'checkbox', array(
        			'data'  => true,
        			'label'	=> 'pi.form.label.field.enabled',
        	))
            ->add('user', 'entity', array(
            		'class' 	=> 'BootStrapUserBundle:User',
            		'read_only'	=> $read_only,
            		'label'	=> 'pi.form.label.field.user',
            		"attr" 		=> array(
            				"class"=>"pi_simpleselect",
            		),
            ))
            ->add('rubrique', 'entity', array(
            		'class' => 'PiAppAdminBundle:Rubrique',
            		'query_builder' => function(EntityRepository $er) {
	            		return $er->getAllPageRubrique();
		            },
		            'property' => 'titre',
		            'empty_value' => 'pi.form.label.select.choose.option',
		            'label'     => 'pi.page.form.rubrique',
		            'multiple'	=> false,
		            'required'  => false,
		            "attr" => array(
		            		"class"=>"pi_simpleselect",
		            ),		            
            ))
            ->add('layout', 'entity', array(
            		'class' => 'PiAppAdminBundle:Layout',
            		'label'     => 'pi.page.form.layout',
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
		            'multiple'	=> true,
		            'required'  => false,
		            'empty_value' => 'pi.form.label.select.choose.option',
		            'label'     => 'pi.page.form.page_css',
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
		            'multiple'	=> true,
		            'required'  => false,
		            'empty_value' => 'pi.form.label.select.choose.option',
		            'label'     => 'pi.page.form.page_js',
		            "attr" => array(
		            		"class"=>"pi_multiselect",
		            ),
            ))            
            ->add('keywords', 'entity', array(
				    'class' => 'PiAppAdminBundle:KeyWord',
				    'query_builder' => function(EntityRepository $er) {
				        return $er->getAllPageKeyWords();
				    },
				    'multiple'	=> true,
				    'required'  => false,
				    'empty_value' => 'pi.form.label.select.choose.option',
				    'label'     => 'pi.page.form.keywords',
				    "attr" => array(
				    		"class"=>"pi_multiselect",
				    ),
			))      
            ->add('meta_content_type', 'choice', array(
            		'choices'   => PageRepository::getAvailableContentTypes(),
            		'label'     => 'pi.page.form.meta_content_type',
            		'required'  => true,
            		'multiple'	=> false,
            		'expanded'  => true,
            		'read_only'	=> true,
            ))
        	->add('cacheable', 'checkbox', array(
    				'label'     => 'pi.page.form.cacheable',
        			'required'  => false,
        			'help_block' => 'Returns a 304 "not modified" status, when the template has not changed since last visit.'
        	))
            ->add('public', 'checkbox', array(
    				'label'     => 'pi.page.form.public',
            		'required'  => false,
            		'help_block' => 'Allows proxies to cache the same content for different visitors.'
        	))
            ->add('lifetime', 'number', array(
            		'label'     => 'pi.page.form.lifetime',
            		'required'  => false,
            		'help_block' => 'Does a full content caching during the specified lifetime. Leave empty for no cache.'
            ))
            ->add('route_name', 'text', array(
            		'label'	=> 'pi.page.form.route_name'
            ))
            ->add('url', 'text', array(
            		'label'	=> 'pi.page.form.url'
            ))
			->add('translations', 'collection', array(
            		'allow_add' => true,
            		'allow_delete' => true,
            		'prototype'	=> true,
					// Post update
					'by_reference' => true,					
            		'type'   => new TranslationPageType($this->_locale, $this->_container),
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
