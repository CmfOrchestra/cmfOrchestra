<?php
/**
 * This file is part of the <Facebook> project.
 *
 * @category   BootStrap_Manager
 * @package    Facebook
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-04-23
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\FacebookBundle\Manager\Client;

use Symfony\Component\DependencyInjection\ContainerInterface;
use BootStrap\FacebookBundle\Builder\FacebookClientInterface;
use BootStrap\FacebookBundle\Exception\ClientException;

/**
 * Abstract class of all facebook client.
 *
 * @category   BootStrap_Manager
 * @package    Facebook
 * @abstract
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
abstract class AbstractClient implements FacebookClientInterface
{
	/**
	 * @var array
	 * @static
	 */
	static $clients = array('analytics', 'adwords', 'maps');
	
	/**
	 * @var string
	 */
	private $client = "";	
	
	/**
	 * @var array
	 */
	protected $config = array();	
		
	/**
	 * @var \Symfony\Component\DependencyInjection\ContainerInterface
	 */
	private $container;
    
	/**
	 * Constructor.
	 *
	 * @param \Symfony\Component\DependencyInjection\ContainerInterface		$container
	 * @param string	$clientName
	 */
    public function __construct(ContainerInterface $container, $clientName)
    {
    	$this->container = $container;
    	
    	if(!$this->isClientSupported($clientName))
    		throw ClientException::clientNotSupported($clientName, __CLASS__);
    	else
    		$this->setConfig($clientName);
    }
    
    /**
     * Gets container.
     *
     * @return \Symfony\Component\DependencyInjection\ContainerInterface
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    protected function getContainer()
    {
    	return $this->container;
    }
    
    /**
     * Gets client.
     *
     * @return string
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    protected function getClient()
    {
    	return $this->client;
    }    

    /**
     * Gets if the client name is supported or not.
     *
     * @param  string 	$clientName			name of a client.
     * 
     * @return boolean
     * @access private
     *
     * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     */    
    private function isClientSupported($clientName)
    {
		if (!in_array($clientName, self::$clients))
			return false;
		else
    		return true;
    }

    /**
     * Sets the client name
     *
     * @param  string 	$clientName			name of a client.
     *
     * @return void
     * @access private
     *
     * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     */
    private function setConfig($clientName)
    {
    	// we set the client name applyed
    	$this->client = $clientName;
    	
    	// we set the client config
    	$config_service = 'pi_facebook.'.$clientName;
    	if($this->getContainer()->getParameter($config_service))
    		$this->config[$clientName] = $this->getContainer()->getParameter($config_service);    	
    }   
   
    
}