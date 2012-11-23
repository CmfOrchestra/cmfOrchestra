<?php
/**
 * This file is part of the <Google> project.
 *
 * @category   Bundle
 * @package    DependencyInjection
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-04-23
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\GoogleBundle\DependencyInjection;

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
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class BootStrapGoogleExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        
        $config = $configs[0];        
        
        /**
         * Analytics config parameter
         */
        if(isset($config['analytics'])){
        		$container->setParameter('pi_google.analytics', $config['analytics']);
        }
        
        /**
         * Adwords config parameter
         */        
        if(isset($config['adwords'])){
        	$container->setParameter('pi_google.adwords', $config['adwords']);
        }
        
        /**
         * Maps config parameter
         */
        if(isset($config['maps'])){
        	$container->setParameter('pi_google.maps', $config['maps']);
        }        
        
    }    
    
    public function getAlias()
    {
    	return 'boot_strap_google';
    }    
}
