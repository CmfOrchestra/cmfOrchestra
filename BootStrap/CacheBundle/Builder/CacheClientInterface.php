<?php

namespace BootStrap\CacheBundle\Builder;

/**
 * Minimum requirements for interfacing with a typical key-value store
 * 
 * @package 
 * @version $id$
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
interface CacheClientInterface
{
    /**
     * Retrieve the value corresponding to a provided key
     * 
     * @param string $key Unique identifier 
     * @access public
     * @return mixed Result from the cache
     */
    public function get( $key );

    /**
     * Add a value to the cache under a unique key
     * 
     * @param string $key Unique key to identify the data
     * @param mixed $value Data to store in the cache
     * @param int $ttl Lifetime for stored data (in seconds)
     * @access public
     * @return void
     */
    public function set( $key, $value, $ttl );

    /**
     * Check the state of the cache
     * 
     * @access public
     * @return boolean True if the cache is in a usable state, otherwise false
     */
    public function isSafe();
    
    /**
     * Delete a value to the cache under a unique key
     *
     * @param string $key Unique key to identify the data
     * @access public
     * @return boolean
     */    
    public function clear($key);
}
