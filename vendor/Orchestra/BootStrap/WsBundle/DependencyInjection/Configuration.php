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

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * @category Ws_DependencyInjection
 * @package DependencyInjection
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class Configuration implements ConfigurationInterface {

    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder() {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('boot_strap_ws');
        $this->addAuthConfig($rootNode);

        return $treeBuilder;
    }

    /**
     * Socloz config
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition
     * @return void
     * @access protected
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function addAuthConfig(ArrayNodeDefinition $rootNode) {
        $rootNode
                ->children()
                    ->arrayNode('auth')
                        ->children()
                        
                            ->arrayNode('log')
                            ->isRequired()
                                ->children()
                                        ->scalarNode('dev')->isRequired()->end()
                                        ->scalarNode('test')->isRequired()->end()
                                        ->scalarNode('prod')->isRequired()->end()
                                ->end()
                            ->end()
                                                
                            ->arrayNode('handlers')
                            ->isRequired()
                            ->prototype('array')
                                ->children()
                                    ->scalarNode('key')->isRequired()->end()
                                    ->scalarNode('method')->isRequired()->end()
                                    ->scalarNode('api')->isRequired()->end()
                                    ->scalarNode('format')->isRequired()->end()
                                ->end()
                            ->end()
                            
                            
                            
                        ->end()
                    ->end()
                ->end();
    }
    
}