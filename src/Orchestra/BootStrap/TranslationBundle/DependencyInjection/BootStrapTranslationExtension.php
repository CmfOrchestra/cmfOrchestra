<?php
/**
 * This file is part of the <Translation> project.
 *
 * @category   BootStrap_dependencyInjection
 * @package    Extension
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-01-11
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\TranslationBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension,
    Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\DependencyInjection\Loader,
    Symfony\Component\Config\FileLocator;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * @category   BootStrap_dependencyInjection
 * @package    Extension
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class BootStrapTranslationExtension extends Extension{

    public function load(array $config, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services_doctrine_extensions.yml');
    }

}
