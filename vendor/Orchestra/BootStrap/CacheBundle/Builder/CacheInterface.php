<?php

namespace BootStrap\CacheBundle\Builder;

use BootStrap\CacheBundle\Builder\CacheClientInterface;

/**
 * CacheInterface 
 * 
 * @package 
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
interface CacheInterface
{
    public function __construct( CacheClientInterface $client = null );
    public function get( $key );
    public function set( $key, $value, $ttl );
    public function isSafe();
    public function clear($key);
}
