<?php
/**
 * This file is part of the <User> project.
 *
 * @category   BootStrap_Eventlistener
 * @package    EventListener
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2011-01-30
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\UserBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Tools\Event\GenerateSchemaEventArgs;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * abstract listener manager.
 * This event is called after an entity is constructed by the EntityManager.
 *
 * @category   BootStrap_Eventlistener
 * @package    EventListener
 * @abstract
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
abstract class abstractListener
{
	/**
	 * @var \BootStrap\UserBundle\EventListener\EntitiesContainer
	 */
	private $EntitiesContainer;
	
	/**
	 * @var \Symfony\Component\DependencyInjection\ContainerInterface
	 */
	private $container;	

	/**
	 * Constructor
	 * 
	 * @param ContainerInterface        $container
	 */
	public function __construct(ContainerInterface $container)
	{
		$this->container				= $container;
		$this->EntitiesContainer		= $container->get('bootstrap.EntitiesContainer.listener');
	}
	
	/**
	 * Create the pi_routing table for the route management.
	 *
	 * @return ObjectRepository
	 * @access protected
	 *
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 * @since 2012-02-27
	 */
	protected function _addRoutingTable(GenerateSchemaEventArgs $eventArgs)
	{
		$schema 	= $eventArgs->getSchema();
		
		$table = $schema->createTable('pi_routing');
		$table->addColumn('id', 'integer')->setAutoincrement(true);
		//$table->addColumn('page_id', 'bigint')->setNotnull(false);
		$table->addColumn('route', 'string')->setNotnull(false);
		$table->addColumn('locales', 'array');
		$table->addColumn('defaults', 'array');
		$table->addColumn('requirements', 'array');
		$table->setPrimaryKey(array('id'), true);
		$table->addUniqueIndex(array('route'));
		//$table->addIndex(array('page_id'));
		//$table->addNamedForeignKeyConstraint('FK_ID_PAGE', 'pi_page', $localColumnNames = array('page_id'), $foreignColumnNames = array('id'));
	}	
	
	/**
	 * prePersist default.
	 * BE CAREFUL !!! this method has to be used in the last of your LifecycleEvent management.
	 *
	 * @param \Doctrine\ORM\Event\LifecycleEventArgs $eventArgs
	 * @param boolean	$isAnonymousToken			true to activate the anonymous token control.
	 * @param boolean	$isUsernamePasswordToken	true to activate the user token control.
	 * @param boolean	$isAllPermissions			true to enable full permission regardless of the user.
	 * 
	 * @return boolean
	 * @access protected
	 * @final
	 *
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 */
	final protected function _prePersist(LifecycleEventArgs $eventArgs, $isAnonymousToken = true, $isUsernamePasswordToken = true, $isAllPermissions = false)
	{    	
        $entity 		= $eventArgs->getEntity();
        $entityManager 	= $eventArgs->getEntityManager();

        //update updated_at field when method setUpdatedAt exists in entity object
        if (method_exists($entity, 'setUpdatedAt')) {
        	// we modify the Update_at value
            $entity->setUpdatedAt(new \DateTime());
        }
        
        //update created_at field when method setCreatedAt exists in entity object
        if (method_exists($entity, 'setCreatedAt')) {
        	// we modify the Update_at value
            $entity->setCreatedAt(new \DateTime());
        }
        
        // If AnonymousToken user,
        if ($isAnonymousToken && $this->isAnonymousToken()) {
        	// we schedules the orphaned entity for removal
        	$entityManager->getUnitOfWork()->scheduleOrphanRemoval($entity);
        	       		
       		// we throw the message.
       		$this->setFlash('pi.session.flash.right.anonymous');
       		return false;
        }
        
        // If  autentication user
        if ($isUsernamePasswordToken && $this->isUsernamePasswordToken()) {
        	// if user have the create right
        	if( in_array('CREATE', $this->getUserPermissions()) || in_array('ROLE_SUPER_ADMIN', $this->getUserRoles()) || $isAllPermissions) {
        		//ini_set('memory_limit', '-1');
        		
        		// IMPORTANT !!! sinon ne fonctionne pas avec les collection links :
        		$entityManager->initializeObject($entity);
        		
        		// ATTENTION !!! fonctionne sauf avec les collection links :
        		//$class = $entityManager->getClassMetadata(get_class($entity));
        		//$entityManager->getUnitOfWork()->computeChangeSet($class, $entity);
        		
        		// we throw the message.
        		if($entity instanceof \PiApp\AdminBundle\Entity\HistoricalStatus){
        		}else
        			$this->setFlash('pi.session.flash.right.create');
        		
        		return true;
        	}else{
        		// we schedules the orphaned entity for removal
        		$entityManager->getUnitOfWork()->scheduleOrphanRemoval($entity);
        		
        		// we throw the message.
        		$this->setFlash('pi.session.flash.right.uncreate');
        		return false;
        	}
        }
                
	}

	/**
	 * preUpdate default.
	 * BE CAREFUL !!! this method has to be used in the last of your LifecycleEvent management.
	 *
	 * @param \Doctrine\ORM\Event\LifecycleEventArgs $eventArgs
	 * @param boolean	$isAnonymousToken			true to activate the anonymous token control.
	 * @param boolean	$isUsernamePasswordToken	true to activate the user token control.
	 * @param boolean	$isAllPermissions			true to enable full permission regardless of the user.
	 * 
	 * @return boolean
	 * @access protected
	 * @final
	 *
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 */
	final protected function _preUpdate(LifecycleEventArgs $eventArgs, $isAnonymousToken = true, $isUsernamePasswordToken = true, $isAllPermissions = false)
	{
        $entity 		= $eventArgs->getEntity();
        $entityManager 	= $eventArgs->getEntityManager();

        if (method_exists($entity, 'setUpdatedAt')) {
        	// we modify the Update_at value
            $entity->setUpdatedAt(new \DateTime());
        }
        
        if($entity instanceof \BootStrap\UserBundle\Entity\User){
        	$this->setFlash('pi.session.flash.right.update');
        }else{        	
        	// If AnonymousToken user,
        	if ($isAnonymousToken && $this->isAnonymousToken()) {
        		
        		// just for register in data the change do in this class listener :
        		$class = $entityManager->getClassMetadata(get_class($entity));
        		$entityManager->getUnitOfWork()->computeChangeSet($class, $entity);
        		
        		// we throw the message.
        		$this->setFlash('pi.session.flash.right.anonymous');
        		return false;
        	}
        	
        	// If  autentication user
        	if ($isUsernamePasswordToken && $this->isUsernamePasswordToken()) {
       			// if user have the edit right
       			if( in_array('EDIT', $this->getUserPermissions()) || in_array('ROLE_SUPER_ADMIN', $this->getUserRoles()) || $isAllPermissions) {

       				// we persist the values of the entity
       				$class = $entityManager->getClassMetadata(get_class($entity));
       				$entityManager->getUnitOfWork()->recomputeSingleEntityChangeSet($class, $entity);
       				
       				// we throw the message.
       				$this->setFlash('pi.session.flash.right.update');
       				return true;
       			}else{
       				// just for register in data the change do in this class listener :
       				$class = $entityManager->getClassMetadata(get_class($entity));
       				$entityManager->getUnitOfWork()->computeChangeSet($class, $entity);
       				
       				// we throw the message.
       				$this->setFlash('pi.session.flash.right.unupdate');
       				return false;
       			}
        	}
        }
	}	
	
	/**
	 * PreRemove default.
	 * BE CAREFUL !!! this method has to be used in the last of your LifecycleEvent management.
	 *
	 * @param \Doctrine\ORM\Event\LifecycleEventArgs $eventArgs
	 * @param boolean	$isAnonymousToken			true to activate the anonymous token control.
	 * @param boolean	$isUsernamePasswordToken	true to activate the user token control.
	 * @param boolean	$isAllPermissions			true to enable full permission regardless of the user.
	 * 
	 * @return boolean
	 * @access protected
	 * @final
	 *
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 */
	final protected function _preRemove(LifecycleEventArgs $eventArgs, $isAnonymousToken = true, $isUsernamePasswordToken = true, $isAllPermissions = false)
	{
		// get the order entity
		$entity 		= $eventArgs->getEntity();
		$entityManager 	= $eventArgs->getEntityManager();
	
		// If AnonymousToken user,
		if ($isAnonymousToken && $this->isAnonymousToken()) {
			//  we stop the remove method.
			$entityManager->getUnitOfWork()->detach($entity);
			// we throw the message.
			$this->setFlash('pi.session.flash.right.anonymous');
			return false;
		}
	
		// If  autentication user
		if ($isUsernamePasswordToken && $this->isUsernamePasswordToken()) {
			// if user have the delete right
			if( in_array('DELETE', $this->getUserPermissions()) || in_array('ROLE_SUPER_ADMIN', $this->getUserRoles()) || $isAllPermissions) {
				// we throw the message.
				$this->setFlash('pi.session.flash.right.delete');
				return true;
			}else{
				//  we stop the remove method.
				$entityManager->getUnitOfWork()->detach($entity);
				
				// we throw the message.
				$this->setFlash('pi.session.flash.right.undelete');
				return false;
			}
		}
		// we persist the values of the entity
		//$class = $entityManager->getClassMetadata(get_class($entity));
		//$entityManager->getUnitOfWork()->recomputeSingleEntityChangeSet($class, $entity);
	
		/*
	
		just for register in data the change do in this class listener :
		$class = $entityManager->getClassMetadata(get_class($entity));
		$entityManager->getUnitOfWork()->computeChangeSet($class, $entity);
	
		To get a field value:
		$eventArgs->getNewValue('Fieldname');
	
		To know if a field has changed
		$eventArgs->hasChangedField('creditCard')
	
		*/
	}	
	
	/**
	 * Gets the name of the table.
	 *
	 * @return string the name of the table entity that we have to insert.
	 * @access private
	 *
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 */
	protected function getOwningTable($eventArgs, $entity)
	{
		return $this->EntitiesContainer->getOwningTable($eventArgs, $entity);
	}
		
	/**
	 * Update a entity
	 *
	 * @param \Doctrine\ORM\Event\LifecycleEventArgs $eventArgs
     * @param	object	$entity
     * @param 	array $identifier The update criteria. An associative array containing column-value pairs.
	 *
	 * @return void
	 * @access protected
	 *
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 */
	protected function _updateEntity($eventArgs, $entity, $Identifier)
	{
		return $this->EntitiesContainer->executeUpdate($eventArgs, $entity, $Identifier);
	}	
	
	/**
	 * Persist all entities which are in the persistEntities container.
	 *
	 * @param \Doctrine\ORM\Event\LifecycleEventArgs $eventArgs
	 *
	 * @return void
	 * @access protected
	 *
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 */
	protected function _persistEntities($eventArgs)
	{
		$this->EntitiesContainer->persistEntities($eventArgs);
	}

    /**
     * Add an entity in the persistEntities container.
     *
     * @param Object $entity
     *
     * @return void
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
	protected function _addPersistEntities($entity)
	{
		$this->EntitiesContainer->addPersistEntities($entity);
	}

	/**
	 * Gets the connexion of the database.
	 *
	 * @param \Doctrine\ORM\Event\LifecycleEventArgs $eventArgs
	 * 
	 * @return \Doctrine\DBAL\Connection
	 * @access protected
	 *
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 */
	protected function _connexion(LifecycleEventArgs $eventArgs)
	{
		return $this->EntitiesContainer->getConnection($eventArgs);
	}	
	
	/**
	 * Gets the container instance.
	 *
	 * @return \Symfony\Component\DependencyInjection\ContainerInterface
	 * @access protected
	 *
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 */
	protected function _container()
	{
		return $this->container;
	}	
	
    /**
     * Return the token object.
     *
     * @return \Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    protected function getToken()
    {
    	return  $this->_container()->get('security.context')->getToken();
    }

    /**
     * Return the connected user name.
     *
     * @return string	user name
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    protected function getUserName()
    {
    	return $this->getToken()->getUser()->getUsername();
    }    
    
    /**
     * Return the user permissions.
     *
     * @return array	user permissions
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    protected function getUserPermissions()
    {
    	return $this->getToken()->getUser()->getPermissions();
    }  

    /**
     * Return the user roles.
     *
     * @return array	user roles
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    protected function getUserRoles()
    {
    	return $this->getToken()->getUser()->getRoles();
    }    
    
    /**
     * Sets the flash message.
     *
     * @param string $message
     * @param string $type
     *
     * @return void
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    protected function setFlash($message, $type = "")
    {
    	$this->_container()->get('session')->setFlash('notice', $message);
    	//$this->_container()->get('session')->setFlash('success', "Mrs/Mlle " . ucfirst($this->getUserName()));
    	
    	if(!empty($type))
    		$this->_container()->get('session')->setFlash($type, $message);
    }

    /**
     * Return if yes or no the user is anonymous token.
     *
     * @return boolean
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    protected function isAnonymousToken()
    {
    	if ($this->getToken() instanceof \Symfony\Component\Security\Core\Authentication\Token\AnonymousToken)
    		return true;
		else
    		return false;
    }    
    
    /**
     * Return if yes or no the user is UsernamePassword token.
     *
     * @return boolean
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    protected function isUsernamePasswordToken()
    {
    	if ($this->getToken() instanceof \Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken)
    		return true;
    	else
    		return false;
    }

    /**
     * Persist the entity if the create permission is done.
     *
     * @return boolean
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    protected function isPersistRight()
    {
    	if( in_array('CREATE', $this->getUserPermissions()) || in_array('ROLE_SUPER_ADMIN', $this->getUserRoles()) )
    		return true;
    	else
    		return false;
    }
    
    /**
     * Update the entity if the edit permission is done.
     *
     * @return boolean
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    protected function isUpdateRight()
    {
    	if( in_array('EDIT', $this->getUserPermissions()) || in_array('ROLE_SUPER_ADMIN', $this->getUserRoles()) )
    		return true;
    	else
    		return false;
    }
    
    /**
     * Remove the entity if the delete permission is done.
     *
     * @return boolean
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    protected function isDeleteRight()
    {
    	if( in_array('DELETE', $this->getUserPermissions()) || in_array('ROLE_SUPER_ADMIN', $this->getUserRoles()) )
    		return true;
    	else
    		return false;
    }    
    
    /**
     * Sets the repository service.
     *
     * @return void
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-01-23
     */
    protected function setRepository()
    {
    	$this->repository = $this->_container()->get('pi_app_admin.repository');
    }
    
    /**
     * Gets the repository service of the entity given in param.
     *
     * @return ObjectRepository
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-01-23
     */
    protected function getRepository($nameEntity = '')
    {
    	if(empty($this->repository))
    		$this->setRepository();
    
    	if(!empty($nameEntity))
    		return $this->repository->getRepository($nameEntity);
    	else
    		throw new \Doctrine\ORM\EntityNotFoundException();
    }    
    
}