<?php

/**
 * This file is part of the <web service> project.
 *
 * @category Ws_Builders
 * @package Builder
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @copyright Copyright (c) 2013, Mappy
 * @since 2013-03-26
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BootStrap\WsBundle\Builder;

use BootStrap\WsBundle\Builder\WsClientInterface;

/**
 * MappyWs Factory Interface
 *
 * @category Ws_Builders
 * @package Builder
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
interface WsFactoryInterface {

    public function setClient(WsClientInterface $client);

    public function getClient();
}