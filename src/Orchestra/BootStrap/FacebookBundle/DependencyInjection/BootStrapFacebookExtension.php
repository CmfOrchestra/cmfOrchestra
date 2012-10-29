<?php
/**
 * This file is part of the <Facebook> project.
 *
 * @category   Bundle
 * @package    DependencyInjection
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-04-23
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\FacebookBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension,
	Symfony\Component\DependencyInjection\ContainerBuilder,
	Symfony\Component\DependencyInjection\Loader,
	Symfony\Component\Config\FileLocator;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * @category   Bundle
 * @package    DependencyInjection
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class BootStrapFacebookExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        
        $configs = $configs[0];
        
        /**
         * Analytics config parameter
         */
        if(isset($configs['analytics'])){
        		$container->setParameter('pi_facebook.analytics', $configs['analytics']);
        }   
        
    }
    
    
    public function getAlias()
    {
    	return 'boot_strap_facebook';
    }    
}
