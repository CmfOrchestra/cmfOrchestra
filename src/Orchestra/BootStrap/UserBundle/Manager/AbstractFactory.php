<?php
/**
 * This file is part of the <User> project.
 *
 * @category   BootStrap_Manager
 * @package    Database
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-02-03
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\UserBundle\Manager;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Cache\ArrayCache;

use BootStrap\UserBundle\Exception\UserException;
use BootStrap\UserBundle\Manager\Route\DoctrineRoute;
use BeSimple\I18nRoutingBundle\Routing\Router;
use BeSimple\I18nRoutingBundle\Routing\Translator\DoctrineDBALTranslator;

/**
 * Database factory for backup database.
 *
 * @category   BootStrap_Manager
 * @package    Database
 * @abstract
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
abstract class AbstractFactory
{
	/**
	 * @var \Symfony\Component\DependencyInjection\ContainerInterface
	 */
	private $_container;
	
	/**
	 * @var \Doctrine\DBAL\Connection
	 */
	private $_connection;
	
	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	private $_em;	
    
	/**
	 * @var \BootStrap\UserBundle\Manager\Route\DoctrineRoute
	 */	
	private $_DoctrineRoute;
	
	/**
	 * @var \BeSimple\I18nRoutingBundle\Routing\Translator\DoctrineDBALTranslator
	 */
	private $_DoctrineTranslator;	
	
	/**
	 * @var \BeSimple\I18nRoutingBundle\Routing\Router
	 */
	private $_RouterTranslator;
		
	/**
	 * Constructor.
	 *
	 * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
	 */
	public function __construct(ContainerInterface $container)
	{
		$this->_container = $container;
		
		//$services_list =  $this->container->getServiceIds();
		//print_r('<PRE>');
		//print_r(var_dump($services_list));
		//print_r('</PRE>');
    	
    }

    /**
     * Sets the connection service.
     *
     * @return void
     * @access private
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */
    private function setConnection()
    {
    	$this->_connection = $this->getContainer()->get('doctrine.dbal.default_connection');
    }
    
    /**
     * Gets the connection service
     *
     * @return \Doctrine\DBAL\Connection
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */
    protected function getConnection()
    {
    	if(empty($this->_connection))
    		$this->setConnection();
    
    	if ($this->_connection instanceof Connection)
    		return $this->_connection;
    	else
    		throw UserException::serviceNotSupported();
    }
    
    /**
     * Gets the getDatabasePlatform service of the connexion
     *
     * @return \Doctrine\DBAL\Platforms\AbstractPlatform
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */
    protected function getDatabasePlatform()
    {
    	return $this->getConnection()->getDatabasePlatform();
    }    
    
    /**
     * Sets the EntityManager service.
     *
     * @return void
     * @access private
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */
    private function setEntityManager()
    {
    	$this->_em = $this->getContainer()->get('doctrine.orm.default_entity_manager');
    }
    
    /**
     * Gets the EntityManager service
     *
     * @return \Doctrine\ORM\EntityManager
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     *@since 2012-02-03
     */
    protected function getEntityManager()
    {
    	if(empty($this->_em))
    		$this->setEntityManager();
    
    	if ($this->_em instanceof EntityManager)
    		return $this->_em;
    	else
    		throw UserException::serviceNotSupported();
    } 

    /**
     * Gets the container instance.
     *
     * @return \Symfony\Component\DependencyInjection\ContainerInterface
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function getContainer()
    {
    	return $this->_container;
    } 

    /**
     * Sets the DoctrineDBALTranslator service.
     *
     * @return void
     * @access private
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */
    private function setDoctrineTranslator()
    {
    	$this->_DoctrineTranslator = $this->getContainer()->get('i18n_routing.translator');
    }
    
    /**
     * Gets the DoctrineDBALTranslator service
     *
     * @return \BeSimple\I18nRoutingBundle\Routing\Translator\DoctrineDBALTranslator
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */
    protected function getDoctrineTranslator()
    {
    	if(empty($this->_DoctrineTranslator))
    		$this->setDoctrineTranslator();
    
    	if ($this->_DoctrineTranslator instanceof DoctrineDBALTranslator)
    		return $this->_DoctrineTranslator;
    	else
    		throw UserException::serviceNotSupported();
    }
    
    /**
     * Sets the DoctrineRoute service.
     *
     * @return void
     * @access private
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */
    private function setDoctrineRoute()
    {
    	//$cache = $this->getContainer()->get('router.cache_warmer');
    	$cache = new ArrayCache;
    	$this->_DoctrineRoute = new DoctrineRoute($this->getConnection(), $cache, true);
    }
    
    /**
     * Gets the DoctrineRoute service
     *
     * @return \BootStrap\UserBundle\Manager\Route\DoctrineRoute
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */
    protected function getDoctrineRoute()
    {
    	if(empty($this->_DoctrineRoute))
    		$this->setDoctrineRoute();
    
    	if ($this->_DoctrineRoute instanceof DoctrineRoute)
    		return $this->_DoctrineRoute;
    	else
    		throw UserException::serviceNotSupported();
    }    
    
    /**
     * Sets the Router Translator service.
     *
     * @return void
     * @access private
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */
    private function setRouterTranslator()
    {
    	$this->_RouterTranslator = $this->getContainer()->get('i18n_routing.router');
    }
    
    /**
     * Gets the Router Translator service
     *
     * @return \BeSimple\I18nRoutingBundle\Routing\Router
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */
    protected function getRouterTranslator()
    {
    	if(empty($this->_RouterTranslator))
    		$this->setRouterTranslator();
    
    	if ($this->_RouterTranslator instanceof Router)
    		return $this->_RouterTranslator;
    	else
    		throw UserException::serviceNotSupported();
    }    
}