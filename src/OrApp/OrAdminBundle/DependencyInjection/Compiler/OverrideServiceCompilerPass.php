<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Bundle
 * @package    DependencyInjection
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-11
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace OrApp\OrAdminBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * Adds tagged twig.extension services to the pi_app_admin twig service
 *
 * @category   Bundle
 * @package    DependencyInjection
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class OverrideServiceCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('pi_app_admin.user.login_listener');
        $definition->setClass('OrApp\OrAdminBundle\EventListener\LoginListener');
        
        //$definition = $container->getDefinition('pi_app_admin.jquery_manager.contextmenu');
        //$definition->setClass('OrApp\OrAdminBundle\Util\PiJquery\PiContextMenuManager');      

        //http://blog.nicolashachet.com/niveaux/confirme/surcharger-vos-entites-doctrine-en-symfony-2-exemple-avec-le-fosuserbundle/
        //http://symfony.com/doc/master/cookbook/bundles/override.html#entities-entity-mapping
    }
}