<?php

/**
 * This file is part of the <web service> project.
 *
 * @category Ws_Manager
 * @package  Manager
 * @author   Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @copyright Copyright (c) 2013, Mappy
 * @since 2013-03-26
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BootStrap\WsBundle\Manager\Client;

use Symfony\Component\DependencyInjection\ContainerInterface;
use BootStrap\WsBundle\Builder\WsClientInterface;
use BootStrap\WsBundle\Exception\ClientException;

/**
 * Abstract class of all mappy shopping client.
 *
 * @category Ws_Manager
 * @package Manager
 * @abstract
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
abstract class AbstractClient implements WsClientInterface
{
    /**
     * @var array
     * @static
     */
    static $clients = array('auth');

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
     * @var \PiApp\AdminBundle\Util\PiRestManager
     */
    private $rest;

    /**
     * Constructor.
     *
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     * @param string $clientName
     * @access public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function __construct(ContainerInterface $container, $clientName)
    {
        $this->container = $container;
        if (!$this->isClientSupported($clientName)) {
            throw ClientException::clientNotSupported($clientName, __CLASS__);
        } else {
            $this->setConfig($clientName);
        }
        
        $this->rest = $this->getContainer()->get('pi_app_admin.rest_manager');
    }

    /**
     * Gets container.
     *
     * @return \Symfony\Component\DependencyInjection\ContainerInterface
     * @access protected
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function getContainer()
    {
        return $this->container;
    }

    /**
     * Gets rest manager.
     *
     * @return \PiApp\AdminBundle\Util\PiRestManager
     * @access protected
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function getRest()
    {
        return $this->rest;
    }

    /**
     * Gets client.
     *
     * @return string
     * @access protected
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function getClient()
    {
        return $this->client;
    }

    /**
     * Gets if the client name is supported or not.
     *
     * @param string $clientName name of a client.
     * @return boolean
     * @access private
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    private function isClientSupported($clientName)
    {
        if (!in_array($clientName, self::$clients)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Sets the client name.
     *
     * @param string $clientName name of a client.
     * @return void
     * @access private
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    private function setConfig($clientName)
    {
        // we set the client name applyed
        $this->client = $clientName;
        // we set the client config
        $configservice = 'ws.' . $clientName;
        if ($this->getContainer()->getParameter($configservice)) {
            $this->config[$clientName] = $this->getContainer()->getParameter($configservice);
        }
    }
}