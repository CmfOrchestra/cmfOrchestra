<?php
/**
 * This file is part of the <User> project.
 *
 * @category   BootStrap_Manager
 * @package    Route
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-02-27
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\UserBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * route cache management.
 *
 * @category   BootStrap_Manager
 * @package    Route
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class AddDependencyRoute implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
    	$routeLoader = $container->getDefinition('bootstrap.route_loader');
    }
}