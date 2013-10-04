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
namespace OrApp\OrUserBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Reference;
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
        //$definition = $container->getDefinition('sonata.media.form.type.media');
        //$definition->setClass('BootStrap\MediaBundle\Form\Type\MediaType');
    }
}