<?php

/**
 * This file is part of the <web service> project.
 *
 * @category Ws_Helper
 * @package  Helper
 * @author   Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @copyright Copyright (c) 2013, Mappy
 * @since 2013-03-26
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BootStrap\WsBundle\Helper;

use Symfony\Component\Templating\Helper\Helper;
use BootStrap\WsBundle\Manager\Client\AuthClient;

/**
 * Socloz Helper
 * 
 * @category Ws_Helper
 * @package Helper 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class AuthHelper extends Helper
{

    /**
     * @var \BootStrap\WsBundle\Manager\Client\AuthClient
     */
    private $client;

    /**
     * Constructor.
     *
     * @param \BootStrap\WsBundle\Manager\Client\AuthClient $auth
     * @access public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function __construct(AuthClient $auth)
    {
        $this->client = $auth;
    }

    /**
     * Gets Authentication request with parameters.
     *
     * @param string $handler
     * @param string $method
     * @param array $GetParams
     * @return mixed
     * @access public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function getPermission($handler, $GetParams = null) {
        return $this->client->getPermission($handler, $GetParams);
    }

    /**
     * Gets the name helper use in twig file.
     *
     * @return string
     * @access public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function getName() {
        return 'ws_auth';
    }

}