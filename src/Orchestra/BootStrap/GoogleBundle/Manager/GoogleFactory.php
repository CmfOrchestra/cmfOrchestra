<?php
/**
 * This file is part of the <Google> project.
 *
 * @category   BootStrap_Manager
 * @package    Google
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-04-23
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\GoogleBundle\Manager;

use Symfony\Component\DependencyInjection\ContainerInterface;

use BootStrap\GoogleBundle\Builder\GoogleFactoryInterface;
use BootStrap\GoogleBundle\Builder\GoogleClientInterface;

/**
 * Google factory.
 *
 * @category   BootStrap_Manager
 * @package    Google
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class GoogleFactory implements GoogleFactoryInterface
{
	/**
	 * @var \Symfony\Component\DependencyInjection\ContainerInterface
	 */
	private $_container;
	
	private $_client;

	/**
	 * Constructor.
	 *
	 * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
	 */
	public function __construct(ContainerInterface $container)
	{
		$this->_container = $container;
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
	 * Inject a google client
	 * 
	 * @param GoogleClientInterface $client The client object or service
	 * @access public
	 * @return void
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public function setClient( GoogleClientInterface $client )
	{
		if ( is_object( $client ) && ( $client instanceof GoogleClientInterface ) )
			$this->_client = $client;
		else
		{
			throw new \Exception( 'Invalid Google Client Interface' );
		}
	}	
	
	/**
	 * get the google client.
	 *
	 * @param CacheClientInterface $client The client object or service
	 * @access public
	 * @return void
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public function getClient()
	{
		return $this->_client;
	}	
	
}
