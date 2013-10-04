<?php

/**
 * This file is part of the <web service> project.
 *
 * @category Ws_DependencyInjection
 * @package DependencyInjection
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @copyright Copyright (c) 2013, Mappy
 * @since 2013-03-26
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BootStrap\WsBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension,
    Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\DependencyInjection\Loader,
    Symfony\Component\Config\FileLocator;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * @category Ws_DependencyInjection
 * @package DependencyInjection
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class BootStrapWsExtension extends Extension {

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container) {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
        
        /**
         * Socloz config parameter
         */
        if (isset($config['auth'])) {
            $container->setParameter('ws.auth', $config['auth']);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getAlias() {
        return 'boot_strap_ws';
    }
}