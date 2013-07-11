<?php
/**
 * This file is part of the <Cache> project.
 *
 * @category   BootStrap_Manager
 * @package    Cache
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-02-03
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\CacheBundle\Manager;

use BootStrap\CacheBundle\Builder\CacheInterface;
use BootStrap\CacheBundle\Builder\CacheClientInterface;

/**
 * cache factory.
 *
 * @category   BootStrap_Manager
 * @package    Cache
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class CacheFactory implements CacheInterface
{
	public $dic = false;

	protected $client = null;
	protected $safe = false;

	/**
	 * Prep the cache
	 * 
	 * @param CacheClientInterface $client Optional cache object/service
	 * @access public
	 * @return void
	 */
	public function __construct( CacheClientInterface $client = null )
	{
		if ( !empty( $client ) )
		{
			if ( is_object( $client ) && ( $client instanceof CacheClientInterface ) )
				$this->client = $client;
			else
			{
				throw new \Exception( 'Invalid Cache Client Interface' );
			}
		}
	}

	/**
	 * Inject a dependency injection container (optional)
	 * 
	 * @param mixed $dic The container
	 * @access public
	 * @return void
	 */
	public function setContainer( $dic )
	{
		$this->dic = $dic;
	}

	/**
	 * Inject a cache client interface to interact with a custom cache service
	 * 
	 * @param CacheClientInterface $client The client object or service
	 * @access public
	 * @return void
	 */
	public function setClient( CacheClientInterface $client )
	{
		if ( is_object( $client ) && ( $client instanceof CacheClientInterface ) )
			$this->client = $client;
		else
		{
			throw new \Exception( 'Invalid Cache Client Interface' );
		}
	}
	
	/**
	 * Return service client
	 *
	 * @param CacheClientInterface $client The client object or service
	 * @access public
	 * @return void
	 */
	public function getClient()
	{
			return $this->client;
	}	

	/**
	 * Retrieve a value from the cache using the provided key
	 * 
	 * @param string $key The unique key identifying the data to be retrieved.
	 * @access public
	 * @return mixed The requested data, or false if there is an error
	 */
	public function get( $key )
	{
		if ( $this->isSafe() && !empty( $key ) )
		{
			return $this->client->get( $key );
		}

		return false;
	}

	/**
	 * Add a key/value to the cache
	 * 
	 * @param string $key A unique key to identify the data you want to store
	 * @param string $value The value you want to store in the cache
	 * @param int $ttl Optional: Lifetime of the data (default: 300 seconds - five minutes)
	 * @access public
	 * @return mixed Whatever the CacheClientObject returns, or false.
	 */
	public function set( $key, $value, $ttl = 300 )
	{
		if ( $this->isSafe() && !empty( $key ) )
		{
			return $this->client->set( $key, $value, $ttl );
		}

		return false;
	}

	/**
	 * Checks if the cache is in a usable state
	 * 
	 * @access public
	 * @return boolean True if the cache is usable, otherwise false
	 */
	public function isSafe()
	{
		if ( $this->client instanceof CacheClientInterface )
		{
			return $this->client->isSafe();
		}

		return $this->safe;
	}
	
	
	/**
	 * Delete a value to the cache under a unique key
	 *
	 * @param string $key Unique key to identify the data
	 * @access public
	 * @return boolean
	 */
	public function clear($key)
	{
		if ( $this->isSafe() && !empty( $key ) )
		{
			return $this->client->clear($key);
		}
	}	
	
}
