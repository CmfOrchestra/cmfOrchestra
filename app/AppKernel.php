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
	            new JMS\DiExtraBundle\JMSDiExtraBundle($this),
	            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),  
        		new JMS\TranslationBundle\JMSTranslationBundle(),
        		
        		# doctrine
        		new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
        		new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
        		new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),        		
        		
        		# route
        		new BeSimple\I18nRoutingBundle\BeSimpleI18nRoutingBundle(),        		
        		
        		# sonata admin
        		new Sonata\AdminBundle\SonataAdminBundle(),
                new Sonata\NotificationBundle\SonataNotificationBundle(),
        		new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
        		new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
        		new Sonata\CacheBundle\SonataCacheBundle(),
        		new Sonata\BlockBundle\SonataBlockBundle(),
        		new Sonata\jQueryBundle\SonatajQueryBundle(),
        		new Sonata\MediaBundle\SonataMediaBundle(),        		

        		# tools
        		new FOS\UserBundle\FOSUserBundle(),
                new FOS\FacebookBundle\FOSFacebookBundle(),
	            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
	            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),  
	            new Knp\Bundle\SnappyBundle\KnpSnappyBundle(),
        		
        		# boostrap
        		new BootStrap\DatabaseBundle\BootStrapDatabaseBundle(),
        		new BootStrap\CacheBundle\BootStrapCacheBundle(),
        		new BootStrap\AclManagerBundle\BootStrapAclManagerBundle(),
        		new BootStrap\AdminBundle\BootStrapAdminBundle(),
        		new BootStrap\UserBundle\BootStrapUserBundle(),
        		new BootStrap\TranslationBundle\BootStrapTranslationBundle(),
        		new BootStrap\TranslatorBundle\BootStrapTranslatorBundle(),
        		new BootStrap\MediaBundle\BootStrapMediaBundle(),
        		
        		# trades
        		new PiApp\AdminBundle\PiAppAdminBundle(),
        		new PiApp\GedmoBundle\PiAppGedmoBundle(),
        		new PiApp\TemplateBundle\PiAppTemplateBundle(),        		
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
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

    /**
     * For example to manual create scope "request" in CLI you may overload initializeContainer kernel metod.
     * 
     * @see \Symfony\Component\HttpKernel\Kernel::initializeContainer()
     */
    protected function initializeContainer() {
        parent::initializeContainer();
        if (PHP_SAPI == 'cli') {
            $this->getContainer()->enterScope('request');
            $this->getContainer()->set('request', new \Symfony\Component\HttpFoundation\Request(), 'request');
        }
    }     
}