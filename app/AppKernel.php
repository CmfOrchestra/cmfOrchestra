<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
        		
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
        	
        	# secure
       		new JMS\AopBundle\JMSAopBundle(),
       		new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
       		new JMS\DiExtraBundle\JMSDiExtraBundle($this),  
       		
        	# route
        	new BeSimple\I18nRoutingBundle\BeSimpleI18nRoutingBundle(),

        	# doctrine
            new Symfony\Bundle\DoctrineBundle\DoctrineBundle(),
        	new Symfony\Bundle\DoctrineFixturesBundle\DoctrineFixturesBundle(),
        	new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
        		
        	# sonata admin
        	new Sonata\AdminBundle\SonataAdminBundle(),
        	new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
        	new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
        	new Sonata\CacheBundle\SonataCacheBundle(),
        	new Sonata\BlockBundle\SonataBlockBundle(),
        	new Sonata\MediaBundle\SonataMediaBundle(),
        
        	# tools
        	new FOS\UserBundle\FOSUserBundle(),
        	new Knp\Bundle\MenuBundle\KnpMenuBundle(),
        	new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),  
        	new Knp\Bundle\SnappyBundle\KnpSnappyBundle(),
        	
        	# boostrap
        	new BootStrap\DatabaseBundle\BootStrapDatabaseBundle(), 
        	new BootStrap\CacheBundle\BootStrapCacheBundle(),
        	new BootStrap\WurflBundle\BootStrapWurflBundle(),
        	new BootStrap\AclManagerBundle\BootStrapAclManagerBundle(),
        	new BootStrap\AdminBundle\BootStrapAdminBundle(),
        	new BootStrap\UserBundle\BootStrapUserBundle(),
        	new BootStrap\TranslationBundle\BootStrapTranslationBundle(),
        	new BootStrap\TranslatorBundle\BootStrapTranslatorBundle(),
        	new BootStrap\MediaBundle\BootStrapMediaBundle(),
        	new BootStrap\GoogleBundle\BootStrapGoogleBundle(),
        	new BootStrap\FacebookBundle\BootStrapFacebookBundle(),
        		
        	# trades
        	new PiApp\AdminBundle\PiAppAdminBundle(),
        	new PiApp\GedmoBundle\PiAppGedmoBundle(),
        	new PiApp\TemplateBundle\PiAppTemplateBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Acme\DemoBundle\AcmeDemoBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}