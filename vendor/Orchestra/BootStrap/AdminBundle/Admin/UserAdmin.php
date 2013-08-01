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

use FOS\UserBundle\Model\UserManagerInterface;

/**
 * User Sonata Admin Controle
 *
 * @category   BootStrap_sonataAdmin
 * @package    sonataAdmin
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class UserAdmin extends Admin
{
    protected $translationDomain = 'user';
    
    protected $baseRoutePattern        = '/user';
    
    
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
            ->add('groups')
            ->add('username')
            ->add('email')
            ->add('enabled')
            ->add('locked')
            ->add('createdAt')
            ->add('id')
        ;
    }
        
    /**
     * {@inheritdoc}
     */    
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('groups')
            ->addIdentifier('username')
            ->add('email')
            ->add('langCode')
            ->add('roles')
            ->add('enabled')
            ->add('locked')
            
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
            ->add('groups')
            ->add('username')
            ->add('locked')
            ->add('email')
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
                ->add('langCode', 'entity',array(
                        'class' => 'PiAppAdminBundle:Langue',
                        'query_builder' => function($er) {
                            return $er->createQueryBuilder('k')
                            ->select('k')
                            ->where('k.enabled = :enabled')
                            ->orderBy('k.label', 'ASC')
                            ->setParameter('enabled', 1);
                        },
                        "label"    => "Language",
                ))
                ->add('username')
                ->add('email')
                ->add('plainPassword', 'text', array('required' => false))
            ->end()
            ->with('Groups')
                ->add('groups', 'sonata_type_model', array(
                	'required' => false,
                	'multiple' => true,
                	'expanded' => true,
                ))
            ->end()
            ->with('Management')
                ->add('roles', 'bootstrap_security_roles', array( 'multiple' => true, 'required' => false))
                ->add('locked', null, array('required' => false))
                ->add('expired', null, array('required' => false))
                ->add('enabled', null, array('required' => false))
                ->add('credentialsExpired', null, array('required' => false))
            ->end()
            ->with('Permissions')
                ->add('permissions', 'bootstrap_security_permissions', array( 'multiple' => true, 'required' => false))
                ->add('locked', null, array('required' => false))
                ->add('expired', null, array('required' => false))
                ->add('credentialsExpired', null, array('required' => false))
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
        ->with('username')
            ->assertNotNull()
            ->assertNotBlank()
            ->assertMaxLength(array('limit' => 35))
        ->end()
        ->with('plainPassword')
        ->end()        
        ;
    }    

    /**
     * {@inheritdoc}
     */    
    public function preUpdate($object)
    {
        $this->getUserManager()->updateCanonicalFields($object);
        $this->getUserManager()->updatePassword($object);
    }

    /**
     * {@inheritdoc}
     */       
    public function setUserManager(UserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @return UserManagerInterface
     */    
    public function getUserManager()
    {
        return $this->userManager;
    }
    
}