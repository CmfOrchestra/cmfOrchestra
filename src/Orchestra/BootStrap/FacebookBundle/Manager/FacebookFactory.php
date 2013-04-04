<?php
/**
 * This file is part of the <Facebook> project.
 *
 * @category   BootStrap_Manager
 * @package    Facebook
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-04-23
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\FacebookBundle\Manager;

use Symfony\Component\DependencyInjection\ContainerInterface;

use BootStrap\FacebookBundle\Builder\FacebookFactoryInterface;
use BootStrap\FacebookBundle\Builder\FacebookClientInterface;

/**
 * Google factory.
 *
 * @category   BootStrap_Manager
 * @package    Google
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class FacebookFactory implements FacebookFactoryInterface
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
	 * Inject a cache client interface to interact with a custom cache service
	 * 
	 * @param CacheClientInterface $client The client object or service
	 * @access public
	 * @return void
	 */
	public function setClient( FacebookClientInterface $client )
	{
		if ( is_object( $client ) && ( $client instanceof FacebookClientInterface ) )
			$this->_client = $client;
		else
		{
			throw new \Exception( 'Invalid Facebook Client Interface' );
		}
	}	
	
	/**
	 * get the client.
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
