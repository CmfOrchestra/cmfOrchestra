<?php

namespace OrApp\OrGedmoBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use OrApp\OrGedmoBundle\DependencyInjection\Compiler\OverrideServiceCompilerPass;

class OrAppOrGedmoBundle extends Bundle
{
     /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'PiAppGedmoBundle';
    }   

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
        $container->addCompilerPass(new OverrideServiceCompilerPass());
    }
    
    /**
     * Boots the Bundle.
     */
    public function boot()
    {
        //print_r('PiApptest2');
    }    
    
    /**
     * Shutdowns the Bundle.
     */
    public function shutdown()
    {
    }     
}
