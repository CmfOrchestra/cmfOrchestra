<?php

namespace BootStrap\CacheBundle\Manager\Client;

use BootStrap\CacheBundle\Builder\CacheClientInterface;

/**
 * Completely untested and undocumented. Use at your own risk!
 *
 * Fixes appreciated!
 * 
 * @uses ClientCacheInterface
 * @package 
 * 
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class FilecacheClient implements CacheClientInterface
{
	protected $path = null;
	public $dic = null;

	public function __construct()
	{
	}

	public function setContainer( $dic )
	{
		$this->dic = $dic;
	}

	public function get( $key )
	{
		if ( !$this->isSafe() || empty( $key ) ){
			return false;
		}

		if ( file_exists( $this->buildFilename( $key ) ) ){
			$file = file_get_contents( $this->buildFilename( $key ) );
			$file = unserialize( $file );

			if ( !is_array( $file ) ){
				return false;
			}elseif ( $file[ 'key' ] != $key ){
				return false;
			}elseif ( time() - $file[ 'ctime' ] > $file[ 'ttl' ] ){
				return false;
			}else{
				return unserialize( $file[ 'value' ] );
			}
		}else{
			return false;
		}
	}

	public function set( $key, $value, $ttl = 300 )
	{
		$file = array();
		$file[ 'key' ] = $key;

		$file[ 'value' ] = serialize( $value );

		$file[ 'ttl' ] = $ttl;
		$file[ 'ctime' ] = time();

		if ( $this->isSafe() && !empty( $key ) ){
			return file_put_contents( $this->buildFilename( $key ), serialize( $file ) );
		}else{
			return false;
		}
	}
	
	/**
	 * Delete a value to the cache under a unique key
	 *
	 * @param string $key Unique key to identify the data
	 * @access public
	 * @return void
	 */
	
	public function clear($key)
	{
	}	

	public function setPath( $path )
	{
		if ( !empty( $path ) && is_dir( $path ) && is_writable( $path ) ){
			$this->path = $path;
			return true;
		}else{ 
			$this->path = null;
			return false;
		}
	}

	public function isSafe()
	{
		if ( is_null( $this->path ) ){
			return false;
		}

		return is_dir( $this->path ) && is_writable( $this->path );
	}

	public function isFull()
	{
		//Check if the cache has exceeded its alotted size
	}

	protected function buildFilename( $key )
	{
		return $this->path . md5( $key ) . '_file.cache';
	}
}
