<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Bundle
 * @package    PiApp
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2011-12-28
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use PiApp\AdminBundle\DependencyInjection\Compiler\PiTwigEnvironmentPass;

/**
 * CMS managment Bundle.
 *
 * @category   Bundle
 * @package    PiApp
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiAppAdminBundle extends Bundle
{
    /**
     * Builds the bundle.
     *
     * It is only ever called once when the cache is empty.
     *
     * This method can be overridden to register compilation passes,
     * other extensions, ...
     *
     * @param ContainerBuilder $container A ContainerBuilder instance
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        //print_r('MyApptest1');
        
        $container->addCompilerPass(new PiTwigEnvironmentPass());
    }
    
    /**
     * Boots the Bundle.
     */
    public function boot()
    {
        //print_r('MyApptest2');
    }
    
    /**
     * Shutdowns the Bundle.
     */
    public function shutdown()
    {
    }    
}
