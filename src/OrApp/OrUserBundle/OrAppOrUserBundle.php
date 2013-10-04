<?php

namespace OrApp\OrUserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use OrApp\OrUserBundle\DependencyInjection\Compiler\OverrideServiceCompilerPass;

class OrAppOrUserBundle extends Bundle
{
    const HTTP_TYPE = "http";
    
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'BootStrapUserBundle';
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
        
        
        // array('path' => '^/provider/', 'role' => 'ROLE_PROVIDER', 'requires_channel' => self::HTTP_TYPE),
        // array('path' => '^/admin/', 'role' => 'ROLE_ADMIN', 'requires_channel' => self::HTTP_TYPE),
        // array('path' => '^/adminsonata/', 'role' => 'ROLE_SUPER_ADMIN', 'requires_channel' => self::HTTP_TYPE),
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
