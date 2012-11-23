<?php
/**
 * This file is part of the <Admin> project.
 * 
 * @category   BootStrap_sonataAdmin
 * @package    sonataAdmin
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2011-11-17
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

/**
 * Group Sonata Admin Controle
 *
 * @category   BootStrap_sonataAdmin
 * @package    sonataAdmin
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class GroupAdmin extends Admin
{
	protected $translationDomain	= 'group';
	
	protected $baseRoutePattern		= '/group';

	/**
	 * {@inheritdoc}
	 */	
    public function getNewInstance()
    {
        $class = $this->getClass();

        return new $class('', array());
    }
    
    /**
     * {@inheritdoc}
     */    
    protected function configureShowField(ShowMapper $showMapper)
    {
    	$showMapper
    	->add('name')
    	->with('Roles')
    		->add('roles', 'array')
    	->end();
    }
        
    /**
     * {@inheritdoc}
     */    
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('roles')            
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
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
        ;
    }
    
    /**
     * {@inheritdoc}
     */    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', null, array('required' => true, 'label' => $this->trans('field.group.name') ))
            ->add('roles', 'bootstrap_security_roles', array( 'multiple' => true, 'required' => false))
            
            // you can define help messages like this
            ->setHelps(array(
            		'roles' => $this->trans('help.group.name')
            ));            
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
                ->assertMaxLength(array('limit' => 25))
            ->end()
        ;
    }        
    
}