<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   BootStrap_sonataAdmin
 * @package    sonataAdmin
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2011-12-30
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Validator\ErrorElement;

use FOS\UserBundle\Model\UserManagerInterface;

/**
 * Role Sonata Admin Controle
 *
 * @category   BootStrap_sonataAdmin
 * @package    sonataAdmin
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class RoleAdmin extends Admin
{
	protected $translationDomain = 'role';
	
	protected $baseRoutePattern		= '/role';
	
	
    protected $formOptions = array(
        'validation_groups' => 'admin'
    );
    
    protected $userManager;
    
    /**
     * {@inheritdoc}
     */    
    protected function configureShowField(ShowMapper $showMapper)
    {
    	$showMapper
            ->add('label')
            ->add('name')
            ->add('comment')
            ->add('Heritage')
            ->add('route_name')
            ->add('layout')
            ->add('enabled')
            ->add('id')
    	;
    }

    /**
     * {@inheritdoc}
     */    
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('label')
            ->addIdentifier('name')
            ->add('comment')
            ->add('enabled')
            ->add('_action', 'actions', array( 'actions' => array(  
					 'edit'   => array(),
	            	 'view'   => array(),
	            	 'delete' => array(),
	            	 // autre action specifique ::: 'unpublish' => array('template' => 'MyBundle:Admin:action_unpublish.html.twig'),
	            	))
	            );
    }

    /**
     * {@inheritdoc}
     */    
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            ->add('label')
            ->add('name')
            ->add('comment')
            ->add('id')
        ;
    }

    /**
     * {@inheritdoc}
     */    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
            	->add('enabled', null, array('required' => false))
                ->add('label')
                ->add('name')
            ->end()
            ->with('Groups')
                ->add('comment')
            ->end()
            ->with('Heritage')
                ->add('heritage', 'bootstrap_security_roles', array( 'multiple' => true, 'required' => false))
            ->end()
            ->with('Redirection')
            	->add('route_name', 'bootstrap_routes', array( 'multiple' => false, 'required' => false))
            	->add('layout', null, array('required' => false))
            ->end()            
        ;
    }
    
    /**
     * @param \Sonata\AdminBundle\Validator\ErrorElement $errorElement
     * @param $object
     * @return void
     */
    public function validate(ErrorElement $errorElement, $object)
    {
    	$errorElement
    	->with('name')
    	->assertNotNull()
    	->assertNotBlank()
    	->assertMaxLength(array('limit' => 35))
    	->end()
    	;
    }
    
}