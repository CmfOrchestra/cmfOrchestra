<?php

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InactiveScopeException;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Parameter;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;

/**
 * appDevDebugProjectContainer
 *
 * This class has been auto-generated
 * by the Symfony Dependency Injection Component.
 */
class appDevDebugProjectContainer extends Container
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->parameters = $this->getDefaultParameters();

        $this->services =
        $this->scopedServices =
        $this->scopeStacks = array();

        $this->set('service_container', $this);

        $this->scopes = array('request' => 'container');
        $this->scopeChildren = array('request' => array());
    }

    /**
     * Gets the 'acme.demo.listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Acme\DemoBundle\ControllerListener A Acme\DemoBundle\ControllerListener instance.
     */
    protected function getAcme_Demo_ListenerService()
    {
        return $this->services['acme.demo.listener'] = new \Acme\DemoBundle\ControllerListener($this->get('twig.extension.acme.demo'));
    }

    /**
     * Gets the 'annotation_reader' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Doctrine\Common\Annotations\FileCacheReader A Doctrine\Common\Annotations\FileCacheReader instance.
     */
    protected function getAnnotationReaderService()
    {
        return $this->services['annotation_reader'] = new \Doctrine\Common\Annotations\FileCacheReader(new \Doctrine\Common\Annotations\AnnotationReader(), '/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/dev/annotations', true);
    }

    /**
     * Gets the 'assetic.asset_manager' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Assetic\Factory\LazyAssetManager A Assetic\Factory\LazyAssetManager instance.
     */
    protected function getAssetic_AssetManagerService()
    {
        $a = $this->get('templating.loader');

        $this->services['assetic.asset_manager'] = $instance = new \Assetic\Factory\LazyAssetManager($this->get('assetic.asset_factory'), array('twig' => new \Assetic\Factory\Loader\CachedFormulaLoader(new \Assetic\Extension\Twig\TwigFormulaLoader($this->get('twig')), new \Assetic\Cache\ConfigCache('/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/dev/assetic/config'), true)));

        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'FrameworkBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/FrameworkBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'FrameworkBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'SecurityBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/SecurityBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'SecurityBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/SecurityBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'TwigBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/TwigBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'TwigBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/TwigBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'MonologBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/MonologBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'MonologBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/MonologBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'SwiftmailerBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/SwiftmailerBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'SwiftmailerBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/SwiftmailerBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'AsseticBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/AsseticBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'AsseticBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Symfony/Bundle/AsseticBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'SensioFrameworkExtraBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/SensioFrameworkExtraBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'SensioFrameworkExtraBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sensio/Bundle/FrameworkExtraBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'JMSAopBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/JMSAopBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'JMSAopBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/JMS/AopBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'JMSSecurityExtraBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/JMSSecurityExtraBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'JMSSecurityExtraBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/JMS/SecurityExtraBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'JMSDiExtraBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/JMSDiExtraBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'JMSDiExtraBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/JMS/DiExtraBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'BeSimpleI18nRoutingBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/BeSimpleI18nRoutingBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'BeSimpleI18nRoutingBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/BeSimple/I18nRoutingBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'DoctrineBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/DoctrineBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'DoctrineBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/DoctrineBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'DoctrineFixturesBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/DoctrineFixturesBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'DoctrineFixturesBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Symfony/Bundle/DoctrineFixturesBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'StofDoctrineExtensionsBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/StofDoctrineExtensionsBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'StofDoctrineExtensionsBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Stof/DoctrineExtensionsBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'SonataAdminBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/SonataAdminBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'SonataAdminBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/AdminBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'SonataEasyExtendsBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/SonataEasyExtendsBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'SonataEasyExtendsBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/EasyExtendsBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'SonataDoctrineORMAdminBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/SonataDoctrineORMAdminBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'SonataDoctrineORMAdminBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/DoctrineORMAdminBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'SonataCacheBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/SonataCacheBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'SonataCacheBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/CacheBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'SonataBlockBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/SonataBlockBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'SonataBlockBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/BlockBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'SonataMediaBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/SonataMediaBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'SonataMediaBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/MediaBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'FOSUserBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/FOSUserBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'FOSUserBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'KnpMenuBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/KnpMenuBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'KnpMenuBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Knp/Bundle/MenuBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'KnpPaginatorBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/KnpPaginatorBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'KnpPaginatorBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Knp/Bundle/PaginatorBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'BootStrapDatabaseBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/BootStrapDatabaseBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'BootStrapDatabaseBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/BootStrap/DatabaseBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'BootStrapCacheBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/BootStrapCacheBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'BootStrapCacheBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/BootStrap/CacheBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'BootStrapWurflBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/BootStrapWurflBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'BootStrapWurflBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/BootStrap/WurflBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'BootStrapAclManagerBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/BootStrapAclManagerBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'BootStrapAclManagerBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/BootStrap/AclManagerBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'BootStrapAdminBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/BootStrapAdminBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'BootStrapAdminBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/BootStrap/AdminBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'BootStrapUserBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/BootStrapUserBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'BootStrapUserBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/BootStrap/UserBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'BootStrapTranslationBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/BootStrapTranslationBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'BootStrapTranslationBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/BootStrap/TranslationBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'BootStrapMediaBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/BootStrapMediaBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'BootStrapMediaBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/BootStrap/MediaBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'BootStrapGoogleBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/BootStrapGoogleBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'BootStrapGoogleBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/BootStrap/GoogleBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'BootStrapFacebookBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/BootStrapFacebookBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'BootStrapFacebookBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/BootStrap/FacebookBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'PiAppAdminBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/PiAppAdminBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'PiAppAdminBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/PiApp/AdminBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'PiAppGedmoBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/PiAppGedmoBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'PiAppGedmoBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/PiApp/GedmoBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'PiAppTemplateBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/PiAppTemplateBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'PiAppTemplateBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/PiApp/TemplateBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'AcmeDemoBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/AcmeDemoBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'AcmeDemoBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Acme/DemoBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'WebProfilerBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/WebProfilerBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'WebProfilerBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/WebProfilerBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'SensioDistributionBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/SensioDistributionBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'SensioDistributionBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sensio/Bundle/DistributionBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\CoalescingDirectoryResource(array(0 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'SensioGeneratorBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/SensioGeneratorBundle/views', '/\\.[^.]+\\.twig$/'), 1 => new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, 'SensioGeneratorBundle', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sensio/Bundle/GeneratorBundle/Resources/views', '/\\.[^.]+\\.twig$/'))), 'twig');
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, '', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/views', '/\\.[^.]+\\.twig$/'), 'twig');

        return $instance;
    }

    /**
     * Gets the 'assetic.controller' service.
     *
     * @return Symfony\Bundle\AsseticBundle\Controller\AsseticController A Symfony\Bundle\AsseticBundle\Controller\AsseticController instance.
     */
    protected function getAssetic_ControllerService()
    {
        return new \Symfony\Bundle\AsseticBundle\Controller\AsseticController($this->get('request'), $this->get('assetic.asset_manager'), $this->get('assetic.cache'), false, $this->get('profiler'));
    }

    /**
     * Gets the 'assetic.filter.cssrewrite' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Assetic\Filter\CssRewriteFilter A Assetic\Filter\CssRewriteFilter instance.
     */
    protected function getAssetic_Filter_CssrewriteService()
    {
        return $this->services['assetic.filter.cssrewrite'] = new \Assetic\Filter\CssRewriteFilter();
    }

    /**
     * Gets the 'assetic.filter_manager' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\AsseticBundle\FilterManager A Symfony\Bundle\AsseticBundle\FilterManager instance.
     */
    protected function getAssetic_FilterManagerService()
    {
        return $this->services['assetic.filter_manager'] = new \Symfony\Bundle\AsseticBundle\FilterManager($this, array('cssrewrite' => 'assetic.filter.cssrewrite'));
    }

    /**
     * Gets the 'assetic.request_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\AsseticBundle\EventListener\RequestListener A Symfony\Bundle\AsseticBundle\EventListener\RequestListener instance.
     */
    protected function getAssetic_RequestListenerService()
    {
        return $this->services['assetic.request_listener'] = new \Symfony\Bundle\AsseticBundle\EventListener\RequestListener();
    }

    /**
     * Gets the 'bootstrap.admin.admin.group' service.
     *
     * @return BootStrap\AdminBundle\Admin\GroupAdmin A BootStrap\AdminBundle\Admin\GroupAdmin instance.
     */
    protected function getBootstrap_Admin_Admin_GroupService()
    {
        $instance = new \BootStrap\AdminBundle\Admin\GroupAdmin('bootstrap.admin.admin.group', 'BootStrap\\UserBundle\\Entity\\Group', 'BootStrapAdminBundle:GroupAdmin');

        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.native'));
        $instance->setLabel('group');
        $instance->setTemplates(array('layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'user_block' => 'SonataAdminBundle:Core:user_block.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision' => 'SonataAdminBundle:CRUD:history_revision.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig'));
        $instance->setSecurityInformation(array('EDIT' => array(0 => 'EDIT'), 'LIST' => array(0 => 'LIST'), 'CREATE' => array(0 => 'CREATE'), 'VIEW' => array(0 => 'VIEW'), 'DELETE' => array(0 => 'DELETE'), 'OPERATOR' => array(0 => 'OPERATOR'), 'MASTER' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));

        return $instance;
    }

    /**
     * Gets the 'bootstrap.admin.admin.historicalpage' service.
     *
     * @return BootStrap\AdminBundle\Admin\HistoricalPageAdmin A BootStrap\AdminBundle\Admin\HistoricalPageAdmin instance.
     */
    protected function getBootstrap_Admin_Admin_HistoricalpageService()
    {
        $instance = new \BootStrap\AdminBundle\Admin\HistoricalPageAdmin('bootstrap.admin.admin.historicalpage', 'PiApp\\AdminBundle\\Entity\\HistoricalStatus', 'BootStrapAdminBundle:HistoricalPageCMS');

        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.native'));
        $instance->setLabel('historical page');
        $instance->setTemplates(array('layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'user_block' => 'SonataAdminBundle:Core:user_block.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision' => 'SonataAdminBundle:CRUD:history_revision.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig'));
        $instance->setSecurityInformation(array('EDIT' => array(0 => 'EDIT'), 'LIST' => array(0 => 'LIST'), 'CREATE' => array(0 => 'CREATE'), 'VIEW' => array(0 => 'VIEW'), 'DELETE' => array(0 => 'DELETE'), 'OPERATOR' => array(0 => 'OPERATOR'), 'MASTER' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));

        return $instance;
    }

    /**
     * Gets the 'bootstrap.admin.admin.permission' service.
     *
     * @return BootStrap\AdminBundle\Admin\PermissionAdmin A BootStrap\AdminBundle\Admin\PermissionAdmin instance.
     */
    protected function getBootstrap_Admin_Admin_PermissionService()
    {
        $instance = new \BootStrap\AdminBundle\Admin\PermissionAdmin('bootstrap.admin.admin.permission', 'BootStrap\\UserBundle\\Entity\\Permission', 'BootStrapAdminBundle:PermissionAdmin');

        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.native'));
        $instance->setLabel('permission');
        $instance->setTemplates(array('layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'user_block' => 'SonataAdminBundle:Core:user_block.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision' => 'SonataAdminBundle:CRUD:history_revision.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig'));
        $instance->setSecurityInformation(array('EDIT' => array(0 => 'EDIT'), 'LIST' => array(0 => 'LIST'), 'CREATE' => array(0 => 'CREATE'), 'VIEW' => array(0 => 'VIEW'), 'DELETE' => array(0 => 'DELETE'), 'OPERATOR' => array(0 => 'OPERATOR'), 'MASTER' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));

        return $instance;
    }

    /**
     * Gets the 'bootstrap.admin.admin.role' service.
     *
     * @return BootStrap\AdminBundle\Admin\RoleAdmin A BootStrap\AdminBundle\Admin\RoleAdmin instance.
     */
    protected function getBootstrap_Admin_Admin_RoleService()
    {
        $instance = new \BootStrap\AdminBundle\Admin\RoleAdmin('bootstrap.admin.admin.role', 'BootStrap\\UserBundle\\Entity\\Role', 'BootStrapAdminBundle:RoleAdmin');

        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.native'));
        $instance->setLabel('role');
        $instance->setTemplates(array('layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'user_block' => 'SonataAdminBundle:Core:user_block.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision' => 'SonataAdminBundle:CRUD:history_revision.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig'));
        $instance->setSecurityInformation(array('EDIT' => array(0 => 'EDIT'), 'LIST' => array(0 => 'LIST'), 'CREATE' => array(0 => 'CREATE'), 'VIEW' => array(0 => 'VIEW'), 'DELETE' => array(0 => 'DELETE'), 'OPERATOR' => array(0 => 'OPERATOR'), 'MASTER' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));

        return $instance;
    }

    /**
     * Gets the 'bootstrap.admin.admin.user' service.
     *
     * @return BootStrap\AdminBundle\Admin\UserAdmin A BootStrap\AdminBundle\Admin\UserAdmin instance.
     */
    protected function getBootstrap_Admin_Admin_UserService()
    {
        $instance = new \BootStrap\AdminBundle\Admin\UserAdmin('bootstrap.admin.admin.user', 'BootStrap\\UserBundle\\Entity\\User', 'BootStrapAdminBundle:UserAdmin');

        $instance->setUserManager($this->get('fos_user.user_manager'));
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.native'));
        $instance->setLabel('user');
        $instance->setTemplates(array('layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'user_block' => 'SonataAdminBundle:Core:user_block.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision' => 'SonataAdminBundle:CRUD:history_revision.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig'));
        $instance->setSecurityInformation(array('EDIT' => array(0 => 'EDIT'), 'LIST' => array(0 => 'LIST'), 'CREATE' => array(0 => 'CREATE'), 'VIEW' => array(0 => 'VIEW'), 'DELETE' => array(0 => 'DELETE'), 'OPERATOR' => array(0 => 'OPERATOR'), 'MASTER' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));

        return $instance;
    }

    /**
     * Gets the 'bootstrap.database.factory' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return BootStrap\DatabaseBundle\Manager\DatabaseFactory A BootStrap\DatabaseBundle\Manager\DatabaseFactory instance.
     */
    protected function getBootstrap_Database_FactoryService()
    {
        return $this->services['bootstrap.database.factory'] = new \BootStrap\DatabaseBundle\Manager\DatabaseFactory($this);
    }

    /**
     * Gets the 'bootstrap.entitiescontainer.listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return BootStrap\UserBundle\EventListener\EntitiesContainer A BootStrap\UserBundle\EventListener\EntitiesContainer instance.
     */
    protected function getBootstrap_Entitiescontainer_ListenerService()
    {
        return $this->services['bootstrap.entitiescontainer.listener'] = new \BootStrap\UserBundle\EventListener\EntitiesContainer($this);
    }

    /**
     * Gets the 'bootstrap.route_cache' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return BootStrap\UserBundle\Manager\Route\CacheRoute A BootStrap\UserBundle\Manager\Route\CacheRoute instance.
     */
    protected function getBootstrap_RouteCacheService()
    {
        return $this->services['bootstrap.route_cache'] = new \BootStrap\UserBundle\Manager\Route\CacheRoute($this);
    }

    /**
     * Gets the 'bootstrap.route_loader' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return BootStrap\UserBundle\Manager\Route\RouteLoader A BootStrap\UserBundle\Manager\Route\RouteLoader instance.
     */
    protected function getBootstrap_RouteLoaderService()
    {
        return $this->services['bootstrap.route_loader'] = new \BootStrap\UserBundle\Manager\Route\RouteLoader($this);
    }

    /**
     * Gets the 'bootstrap.routetranslator.factory' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return BootStrap\UserBundle\Manager\RouteTranslatorFactory A BootStrap\UserBundle\Manager\RouteTranslatorFactory instance.
     */
    protected function getBootstrap_Routetranslator_FactoryService()
    {
        return $this->services['bootstrap.routetranslator.factory'] = new \BootStrap\UserBundle\Manager\RouteTranslatorFactory($this);
    }

    /**
     * Gets the 'bootstrap.user.repository' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return BootStrap\UserBundle\Repository\Repository A BootStrap\UserBundle\Repository\Repository instance.
     */
    protected function getBootstrap_User_RepositoryService()
    {
        return $this->services['bootstrap.user.repository'] = new \BootStrap\UserBundle\Repository\Repository($this->get('doctrine.orm.default_entity_manager'));
    }

    /**
     * Gets the 'bootstrap.wurfl.listener.mobile' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return BootStrap\WurflBundle\EventListener\MobileListener A BootStrap\WurflBundle\EventListener\MobileListener instance.
     */
    protected function getBootstrap_Wurfl_Listener_MobileService()
    {
        return $this->services['bootstrap.wurfl.listener.mobile'] = new \BootStrap\WurflBundle\EventListener\MobileListener();
    }

    /**
     * Gets the 'cache_warmer' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerAggregate A Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerAggregate instance.
     */
    protected function getCacheWarmerService()
    {
        $a = $this->get('kernel');
        $b = $this->get('templating.name_parser');

        $c = new \Symfony\Bundle\FrameworkBundle\CacheWarmer\TemplateFinder($a, $b, '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources');

        return $this->services['cache_warmer'] = new \Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerAggregate(array(0 => new \Symfony\Bundle\FrameworkBundle\CacheWarmer\TemplatePathsCacheWarmer($c, $this->get('templating.locator')), 1 => new \Symfony\Bundle\AsseticBundle\CacheWarmer\AssetManagerCacheWarmer($this), 2 => new \Symfony\Bundle\FrameworkBundle\CacheWarmer\RouterCacheWarmer($this->get('i18n_routing.router')), 3 => new \Symfony\Bundle\TwigBundle\CacheWarmer\TemplateCacheCacheWarmer($this, $c), 4 => new \Symfony\Bridge\Doctrine\CacheWarmer\ProxyCacheWarmer($this->get('doctrine'))));
    }

    /**
     * Gets the 'data_collector.request' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\FrameworkBundle\DataCollector\RequestDataCollector A Symfony\Bundle\FrameworkBundle\DataCollector\RequestDataCollector instance.
     */
    protected function getDataCollector_RequestService()
    {
        return $this->services['data_collector.request'] = new \Symfony\Bundle\FrameworkBundle\DataCollector\RequestDataCollector();
    }

    /**
     * Gets the 'debug.twig.extension' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Twig_Extensions_Extension_Debug A Twig_Extensions_Extension_Debug instance.
     */
    protected function getDebug_Twig_ExtensionService()
    {
        return $this->services['debug.twig.extension'] = new \Twig_Extensions_Extension_Debug();
    }

    /**
     * Gets the 'doctrine' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\DoctrineBundle\Registry A Symfony\Bundle\DoctrineBundle\Registry instance.
     */
    protected function getDoctrineService()
    {
        return $this->services['doctrine'] = new \Symfony\Bundle\DoctrineBundle\Registry($this, array('default' => 'doctrine.dbal.default_connection'), array('default' => 'doctrine.orm.default_entity_manager'), 'default', 'default');
    }

    /**
     * Gets the 'doctrine.dbal.connection_factory' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\DoctrineBundle\ConnectionFactory A Symfony\Bundle\DoctrineBundle\ConnectionFactory instance.
     */
    protected function getDoctrine_Dbal_ConnectionFactoryService()
    {
        return $this->services['doctrine.dbal.connection_factory'] = new \Symfony\Bundle\DoctrineBundle\ConnectionFactory(array());
    }

    /**
     * Gets the 'doctrine.dbal.default_connection' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return stdClass A stdClass instance.
     */
    protected function getDoctrine_Dbal_DefaultConnectionService()
    {
        $a = $this->get('annotation_reader');

        $b = new \Doctrine\DBAL\Configuration();
        $b->setSQLLogger($this->get('doctrine.dbal.logger'));

        $c = new \Gedmo\Timestampable\TimestampableListener();
        $c->setAnnotationReader($a);

        $d = new \Gedmo\Tree\TreeListener();
        $d->setAnnotationReader($a);

        $e = new \Gedmo\Sluggable\SluggableListener();
        $e->setAnnotationReader($a);

        $f = new \Gedmo\Sortable\SortableListener();
        $f->setAnnotationReader($a);

        $g = new \Doctrine\Common\EventManager();
        $g->addEventSubscriber(new \Doctrine\DBAL\Event\Listeners\MysqlSessionInit('UTF8'));
        $g->addEventSubscriber($c);
        $g->addEventSubscriber($d);
        $g->addEventSubscriber($e);
        $g->addEventSubscriber($this->get('stof_doctrine_extensions.listener.translatable'));
        $g->addEventSubscriber($this->get('stof_doctrine_extensions.listener.loggable'));
        $g->addEventSubscriber($f);
        $g->addEventSubscriber($this->get('sonata.easy_extends.doctrine.mapper'));
        $g->addEventSubscriber($this->get('sonata.cache.orm.event_subscriber'));
        $g->addEventSubscriber($this->get('sonata.media.doctrine.event_subscriber'));
        $g->addEventSubscriber(new \FOS\UserBundle\Entity\UserListener($this));
        $g->addEventSubscriber($this->get('gedmo.listener.tree'));
        $g->addEventSubscriber($this->get('gedmo.listener.translatable'));
        $g->addEventSubscriber($this->get('gedmo.listener.timestampable'));
        $g->addEventSubscriber($this->get('gedmo.listener.sluggable'));
        $g->addEventSubscriber($this->get('gedmo.listener.loggable'));
        $g->addEventSubscriber($this->get('pi_app_admin.event_subscriber.media'));
        $g->addEventSubscriber($this->get('pi_app_admin.event_subscriber.position'));
        $g->addEventListener(array(0 => 'postGenerateSchema'), new \BeSimple\I18nRoutingBundle\Routing\Translator\DoctrineDBAL\SchemaListener());
        $g->addEventListener(array(0 => 'postLoad'), $this->get('pi_app_admin.postload_listener'));
        $g->addEventListener(array(0 => 'preRemove'), $this->get('pi_app_admin.preremove_listener'));
        $g->addEventListener(array(0 => 'postRemove'), $this->get('pi_app_admin.postremove_listener'));
        $g->addEventListener(array(0 => 'postGenerateSchema'), $this->get('pi_app_admin.schema_listener'));
        $g->addEventListener(array(0 => 'prePersist'), $this->get('pi_app_admin.prepersist_listener'));
        $g->addEventListener(array(0 => 'postPersist'), $this->get('pi_app_admin.postpersist_listener'));
        $g->addEventListener(array(0 => 'preUpdate'), $this->get('pi_app_admin.preupdate_listener'));
        $g->addEventListener(array(0 => 'postUpdate'), $this->get('pi_app_admin.postupdate_listener'));

        return $this->services['doctrine.dbal.default_connection'] = $this->get('doctrine.dbal.connection_factory')->createConnection(array('dbname' => 'symforchestra', 'host' => 'localhost', 'port' => '', 'user' => 'root', 'password' => 'pacman', 'driver' => 'pdo_mysql', 'driverOptions' => array()), $b, $g, array('enum' => 'string', 'varbinary' => 'string', 'tinyblob' => 'text'));
    }

    /**
     * Gets the 'doctrine.orm.default_entity_manager' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Doctrine\ORM\EntityManager A Doctrine\ORM\EntityManager instance.
     */
    protected function getDoctrine_Orm_DefaultEntityManagerService()
    {
        $a = $this->get('annotation_reader');

        $b = new \Doctrine\Common\Cache\ArrayCache();
        $b->setNamespace('sf2orm_default_54252d4fb98dcf38927c43721c4b5f51');

        $c = new \Doctrine\Common\Cache\ArrayCache();
        $c->setNamespace('sf2orm_default_54252d4fb98dcf38927c43721c4b5f51');

        $d = new \Doctrine\Common\Cache\ArrayCache();
        $d->setNamespace('sf2orm_default_54252d4fb98dcf38927c43721c4b5f51');

        $e = new \Symfony\Bridge\Doctrine\Mapping\Driver\XmlDriver(array(0 => '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/config/doctrine', 1 => '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/MediaBundle/Resources/config/doctrine', 2 => '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/BootStrap/MediaBundle/Resources/config/doctrine'));
        $e->setNamespacePrefixes(array('/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/config/doctrine' => 'FOS\\UserBundle\\Entity', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/MediaBundle/Resources/config/doctrine' => 'Sonata\\MediaBundle\\Entity', '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/BootStrap/MediaBundle/Resources/config/doctrine' => 'BootStrap\\MediaBundle\\Entity'));
        $e->setGlobalBasename('mapping');

        $f = new \Symfony\Bridge\Doctrine\Annotations\IndexedReader($a);

        $g = new \Doctrine\ORM\Mapping\Driver\AnnotationDriver($f, array(0 => '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/BootStrap/UserBundle/Entity', 1 => '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/PiApp/AdminBundle/Entity', 2 => '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/PiApp/GedmoBundle/Entity'));

        $h = new \Doctrine\ORM\Mapping\Driver\DriverChain();
        $h->addDriver($e, 'FOS\\UserBundle\\Entity');
        $h->addDriver($e, 'Sonata\\MediaBundle\\Entity');
        $h->addDriver($e, 'BootStrap\\MediaBundle\\Entity');
        $h->addDriver($g, 'BootStrap\\UserBundle\\Entity');
        $h->addDriver($g, 'PiApp\\AdminBundle\\Entity');
        $h->addDriver($g, 'PiApp\\GedmoBundle\\Entity');

        $i = new \Doctrine\ORM\Configuration();
        $i->setEntityNamespaces(array('FOSUserBundle' => 'FOS\\UserBundle\\Entity', 'BootStrapUserBundle' => 'BootStrap\\UserBundle\\Entity', 'PiAppAdminBundle' => 'PiApp\\AdminBundle\\Entity', 'PiAppGedmoBundle' => 'PiApp\\GedmoBundle\\Entity', 'SonataMediaBundle' => 'Sonata\\MediaBundle\\Entity', 'BootStrapMediaBundle' => 'BootStrap\\MediaBundle\\Entity'));
        $i->setMetadataCacheImpl($b);
        $i->setQueryCacheImpl($c);
        $i->setResultCacheImpl($d);
        $i->setMetadataDriverImpl($h);
        $i->setProxyDir('/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/dev/doctrine/orm/Proxies');
        $i->setProxyNamespace('Proxies');
        $i->setAutoGenerateProxyClasses(true);
        $i->setClassMetadataFactoryName('Doctrine\\ORM\\Mapping\\ClassMetadataFactory');

        return $this->services['doctrine.orm.default_entity_manager'] = call_user_func(array('Doctrine\\ORM\\EntityManager', 'create'), $this->get('doctrine.dbal.default_connection'), $i);
    }

    /**
     * Gets the 'doctrine.orm.validator.unique' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntityValidator A Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntityValidator instance.
     */
    protected function getDoctrine_Orm_Validator_UniqueService()
    {
        return $this->services['doctrine.orm.validator.unique'] = new \Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntityValidator($this->get('doctrine'));
    }

    /**
     * Gets the 'doctrine.orm.validator_initializer' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bridge\Doctrine\Validator\EntityInitializer A Symfony\Bridge\Doctrine\Validator\EntityInitializer instance.
     */
    protected function getDoctrine_Orm_ValidatorInitializerService()
    {
        return $this->services['doctrine.orm.validator_initializer'] = new \Symfony\Bridge\Doctrine\Validator\EntityInitializer($this->get('doctrine'));
    }

    /**
     * Gets the 'event_dispatcher' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\FrameworkBundle\Debug\TraceableEventDispatcher A Symfony\Bundle\FrameworkBundle\Debug\TraceableEventDispatcher instance.
     */
    protected function getEventDispatcherService()
    {
        $this->services['event_dispatcher'] = $instance = new \Symfony\Bundle\FrameworkBundle\Debug\TraceableEventDispatcher($this, $this->get('monolog.logger.event'));

        $instance->addListenerService('knp_pager.before', array(0 => 'knp_paginator.subscriber.paginate', 1 => 'before'), 0);
        $instance->addListenerService('knp_pager.pagination', array(0 => 'knp_paginator.subscriber.paginate', 1 => 'pagination'), 0);
        $instance->addListenerService('knp_pager.before', array(0 => 'knp_paginator.subscriber.sortable', 1 => 'before'), 1);
        $instance->addListenerService('knp_pager.pagination', array(0 => 'knp_paginator.subscriber.sliding_pagination', 1 => 'pagination'), 1);
        $instance->addListenerService('kernel.request', array(0 => 'router_listener', 1 => 'onEarlyKernelRequest'), 255);
        $instance->addListenerService('kernel.request', array(0 => 'router_listener', 1 => 'onKernelRequest'), 0);
        $instance->addListenerService('kernel.response', array(0 => 'response_listener', 1 => 'onKernelResponse'), 0);
        $instance->addListenerService('kernel.request', array(0 => 'session_listener', 1 => 'onKernelRequest'), 128);
        $instance->addListenerService('kernel.response', array(0 => 'profiler_listener', 1 => 'onKernelResponse'), -100);
        $instance->addListenerService('kernel.exception', array(0 => 'profiler_listener', 1 => 'onKernelException'), 0);
        $instance->addListenerService('kernel.request', array(0 => 'profiler_listener', 1 => 'onKernelRequest'), 1024);
        $instance->addListenerService('kernel.controller', array(0 => 'data_collector.request', 1 => 'onKernelController'), 0);
        $instance->addListenerService('kernel.request', array(0 => 'security.firewall', 1 => 'onKernelRequest'), 64);
        $instance->addListenerService('kernel.response', array(0 => 'security.rememberme.response_listener', 1 => 'onKernelResponse'), 0);
        $instance->addListenerService('kernel.exception', array(0 => 'twig.exception_listener', 1 => 'onKernelException'), -128);
        $instance->addListenerService('kernel.response', array(0 => 'monolog.handler.firephp', 1 => 'onKernelResponse'), 0);
        $instance->addListenerService('kernel.request', array(0 => 'assetic.request_listener', 1 => 'onKernelRequest'), 0);
        $instance->addListenerService('kernel.controller', array(0 => 'sensio_framework_extra.controller.listener', 1 => 'onKernelController'), 0);
        $instance->addListenerService('kernel.controller', array(0 => 'sensio_framework_extra.converter.listener', 1 => 'onKernelController'), 0);
        $instance->addListenerService('kernel.controller', array(0 => 'sensio_framework_extra.view.listener', 1 => 'onKernelController'), 0);
        $instance->addListenerService('kernel.view', array(0 => 'sensio_framework_extra.view.listener', 1 => 'onKernelView'), 0);
        $instance->addListenerService('kernel.response', array(0 => 'sensio_framework_extra.cache.listener', 1 => 'onKernelResponse'), 0);
        $instance->addListenerService('kernel.controller', array(0 => 'security.extra.controller_listener', 1 => 'onCoreController'), -255);
        $instance->addListenerService('security.interactive_login', array(0 => 'fos_user.security.interactive_login_listener', 1 => 'onSecurityInteractiveLogin'), 0);
        $instance->addListenerService('kernel.request', array(0 => 'knp_paginator.subscriber.sliding_pagination', 1 => 'onKernelRequest'), 0);
        $instance->addListenerService('kernel.controller', array(0 => 'bootstrap.wurfl.listener.mobile', 1 => 'onKernelController'), 64);
        $instance->addListenerService('kernel.request', array(0 => 'extension.listener', 1 => 'onLateKernelRequest'), -10);
        $instance->addListenerService('kernel.request', array(0 => 'extension.listener', 1 => 'onKernelRequest'), 0);
        $instance->addListenerService('security.interactive_login', array(0 => 'pi_app_admin.user.login_listener', 1 => 'onSecurityInteractivelogin'), 0);
        $instance->addListenerService('kernel.response', array(0 => 'pi_app_admin.logout_listener', 1 => 'onKernelResponse'), 0);
        $instance->addListenerService('kernel.controller', array(0 => 'acme.demo.listener', 1 => 'onKernelController'), 0);
        $instance->addListenerService('kernel.response', array(0 => 'web_profiler.debug_toolbar', 1 => 'onKernelResponse'), -128);

        return $instance;
    }

    /**
     * Gets the 'extension.listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return BootStrap\TranslationBundle\EventListener\DoctrineExtensionListener A BootStrap\TranslationBundle\EventListener\DoctrineExtensionListener instance.
     */
    protected function getExtension_ListenerService()
    {
        $this->services['extension.listener'] = $instance = new \BootStrap\TranslationBundle\EventListener\DoctrineExtensionListener();

        $instance->setContainer($this);

        return $instance;
    }

    /**
     * Gets the 'file_locator' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\HttpKernel\Config\FileLocator A Symfony\Component\HttpKernel\Config\FileLocator instance.
     */
    protected function getFileLocatorService()
    {
        return $this->services['file_locator'] = new \Symfony\Component\HttpKernel\Config\FileLocator($this->get('kernel'), '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources');
    }

    /**
     * Gets the 'filesystem' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Filesystem\Filesystem A Symfony\Component\Filesystem\Filesystem instance.
     */
    protected function getFilesystemService()
    {
        return $this->services['filesystem'] = new \Symfony\Component\Filesystem\Filesystem();
    }

    /**
     * Gets the 'form.csrf_provider' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Csrf\CsrfProvider\SessionCsrfProvider A Symfony\Component\Form\Extension\Csrf\CsrfProvider\SessionCsrfProvider instance.
     */
    protected function getForm_CsrfProviderService()
    {
        return $this->services['form.csrf_provider'] = new \Symfony\Component\Form\Extension\Csrf\CsrfProvider\SessionCsrfProvider($this->get('session'), '5b5a0ff57bd45284dafe7f104fc7d8e15');
    }

    /**
     * Gets the 'form.factory' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\FormFactory A Symfony\Component\Form\FormFactory instance.
     */
    protected function getForm_FactoryService()
    {
        return $this->services['form.factory'] = new \Symfony\Component\Form\FormFactory(array(0 => new \Symfony\Component\Form\Extension\DependencyInjection\DependencyInjectionExtension($this, array('field' => 'form.type.field', 'form' => 'form.type.form', 'birthday' => 'form.type.birthday', 'checkbox' => 'form.type.checkbox', 'choice' => 'form.type.choice', 'collection' => 'form.type.collection', 'country' => 'form.type.country', 'date' => 'form.type.date', 'datetime' => 'form.type.datetime', 'email' => 'form.type.email', 'file' => 'form.type.file', 'hidden' => 'form.type.hidden', 'integer' => 'form.type.integer', 'language' => 'form.type.language', 'locale' => 'form.type.locale', 'money' => 'form.type.money', 'number' => 'form.type.number', 'password' => 'form.type.password', 'percent' => 'form.type.percent', 'radio' => 'form.type.radio', 'repeated' => 'form.type.repeated', 'search' => 'form.type.search', 'textarea' => 'form.type.textarea', 'text' => 'form.type.text', 'time' => 'form.type.time', 'timezone' => 'form.type.timezone', 'url' => 'form.type.url', 'csrf' => 'form.type.csrf', 'entity' => 'form.type.entity', 'sonata_type_admin' => 'sonata.admin.form.type.admin', 'sonata_type_collection' => 'sonata.admin.form.type.collection', 'sonata_type_model' => 'sonata.admin.form.type.model', 'sonata_type_model_reference' => 'sonata.admin.form.type.model_reference', 'sonata_type_immutable_array' => 'sonata.admin.form.type.array', 'sonata_type_boolean' => 'sonata.admin.form.type.boolean', 'sonata_type_translatable_choice' => 'sonata.admin.form.type.translatable_choice', 'sonata_type_date_range' => 'sonata.admin.form.type.date_range', 'sonata_type_datetime_range' => 'sonata.admin.form.type.datetime_range', 'sonata_type_filter_number' => 'sonata.admin.form.filter.type.number', 'sonata_type_filter_choice' => 'sonata.admin.form.filter.type.choice', 'sonata_type_filter_default' => 'sonata.admin.form.filter.type.default', 'sonata_type_filter_date' => 'sonata.admin.form.filter.type.date', 'sonata_type_filter_date_range' => 'sonata.admin.form.filter.type.daterange', 'sonata_type_filter_datetime' => 'sonata.admin.form.filter.type.datetime', 'sonata_type_filter_datetime_range' => 'sonata.admin.form.filter.type.datetime_range', 'sonata_block_service_choice' => 'sonata.block.form.type.block', 'sonata_media_type' => 'sonata.media.form.type.media', 'fos_user_username' => 'fos_user.username_form_type', 'fos_user_profile' => 'fos_user.profile.form.type', 'fos_user_registration' => 'fos_user.registration.form.type', 'fos_user_change_password' => 'fos_user.change_password.form.type', 'fos_user_resetting' => 'fos_user.resetting.form.type', 'fos_user_group' => 'fos_user.group.form.type', 'bootstrap_security_roles' => 'sonata.user.form.type.security_roles', 'bootstrap_security_permissions' => 'sonata.user.form.type.security_permissions'), array('field' => array(0 => 'form.type_extension.field', 1 => 'sonata.admin.form.extension.field', 2 => 'pi.form.help_extension', 3 => 'pi.form.label_extension', 4 => 'pi.form.addinfo_extension', 5 => 'pi.form.field_error_type'), 'form' => array(0 => 'form.type_extension.csrf', 1 => 'pi.form.legend_extension', 2 => 'pi.form.error_type_extension')), array(0 => 'form.type_guesser.validator', 1 => 'form.type_guesser.doctrine'))));
    }

    /**
     * Gets the 'form.type.birthday' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Core\Type\BirthdayType A Symfony\Component\Form\Extension\Core\Type\BirthdayType instance.
     */
    protected function getForm_Type_BirthdayService()
    {
        return $this->services['form.type.birthday'] = new \Symfony\Component\Form\Extension\Core\Type\BirthdayType();
    }

    /**
     * Gets the 'form.type.checkbox' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Core\Type\CheckboxType A Symfony\Component\Form\Extension\Core\Type\CheckboxType instance.
     */
    protected function getForm_Type_CheckboxService()
    {
        return $this->services['form.type.checkbox'] = new \Symfony\Component\Form\Extension\Core\Type\CheckboxType();
    }

    /**
     * Gets the 'form.type.choice' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Core\Type\ChoiceType A Symfony\Component\Form\Extension\Core\Type\ChoiceType instance.
     */
    protected function getForm_Type_ChoiceService()
    {
        return $this->services['form.type.choice'] = new \Symfony\Component\Form\Extension\Core\Type\ChoiceType();
    }

    /**
     * Gets the 'form.type.collection' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Core\Type\CollectionType A Symfony\Component\Form\Extension\Core\Type\CollectionType instance.
     */
    protected function getForm_Type_CollectionService()
    {
        return $this->services['form.type.collection'] = new \Symfony\Component\Form\Extension\Core\Type\CollectionType();
    }

    /**
     * Gets the 'form.type.country' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Core\Type\CountryType A Symfony\Component\Form\Extension\Core\Type\CountryType instance.
     */
    protected function getForm_Type_CountryService()
    {
        return $this->services['form.type.country'] = new \Symfony\Component\Form\Extension\Core\Type\CountryType();
    }

    /**
     * Gets the 'form.type.csrf' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Csrf\Type\CsrfType A Symfony\Component\Form\Extension\Csrf\Type\CsrfType instance.
     */
    protected function getForm_Type_CsrfService()
    {
        return $this->services['form.type.csrf'] = new \Symfony\Component\Form\Extension\Csrf\Type\CsrfType($this->get('form.csrf_provider'));
    }

    /**
     * Gets the 'form.type.date' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Core\Type\DateType A Symfony\Component\Form\Extension\Core\Type\DateType instance.
     */
    protected function getForm_Type_DateService()
    {
        return $this->services['form.type.date'] = new \Symfony\Component\Form\Extension\Core\Type\DateType();
    }

    /**
     * Gets the 'form.type.datetime' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Core\Type\DateTimeType A Symfony\Component\Form\Extension\Core\Type\DateTimeType instance.
     */
    protected function getForm_Type_DatetimeService()
    {
        return $this->services['form.type.datetime'] = new \Symfony\Component\Form\Extension\Core\Type\DateTimeType();
    }

    /**
     * Gets the 'form.type.email' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Core\Type\EmailType A Symfony\Component\Form\Extension\Core\Type\EmailType instance.
     */
    protected function getForm_Type_EmailService()
    {
        return $this->services['form.type.email'] = new \Symfony\Component\Form\Extension\Core\Type\EmailType();
    }

    /**
     * Gets the 'form.type.entity' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bridge\Doctrine\Form\Type\EntityType A Symfony\Bridge\Doctrine\Form\Type\EntityType instance.
     */
    protected function getForm_Type_EntityService()
    {
        return $this->services['form.type.entity'] = new \Symfony\Bridge\Doctrine\Form\Type\EntityType($this->get('doctrine'));
    }

    /**
     * Gets the 'form.type.field' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Core\Type\FieldType A Symfony\Component\Form\Extension\Core\Type\FieldType instance.
     */
    protected function getForm_Type_FieldService()
    {
        return $this->services['form.type.field'] = new \Symfony\Component\Form\Extension\Core\Type\FieldType($this->get('validator'));
    }

    /**
     * Gets the 'form.type.file' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Core\Type\FileType A Symfony\Component\Form\Extension\Core\Type\FileType instance.
     */
    protected function getForm_Type_FileService()
    {
        return $this->services['form.type.file'] = new \Symfony\Component\Form\Extension\Core\Type\FileType();
    }

    /**
     * Gets the 'form.type.form' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Core\Type\FormType A Symfony\Component\Form\Extension\Core\Type\FormType instance.
     */
    protected function getForm_Type_FormService()
    {
        return $this->services['form.type.form'] = new \Symfony\Component\Form\Extension\Core\Type\FormType();
    }

    /**
     * Gets the 'form.type.hidden' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Core\Type\HiddenType A Symfony\Component\Form\Extension\Core\Type\HiddenType instance.
     */
    protected function getForm_Type_HiddenService()
    {
        return $this->services['form.type.hidden'] = new \Symfony\Component\Form\Extension\Core\Type\HiddenType();
    }

    /**
     * Gets the 'form.type.integer' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Core\Type\IntegerType A Symfony\Component\Form\Extension\Core\Type\IntegerType instance.
     */
    protected function getForm_Type_IntegerService()
    {
        return $this->services['form.type.integer'] = new \Symfony\Component\Form\Extension\Core\Type\IntegerType();
    }

    /**
     * Gets the 'form.type.language' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Core\Type\LanguageType A Symfony\Component\Form\Extension\Core\Type\LanguageType instance.
     */
    protected function getForm_Type_LanguageService()
    {
        return $this->services['form.type.language'] = new \Symfony\Component\Form\Extension\Core\Type\LanguageType();
    }

    /**
     * Gets the 'form.type.locale' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Core\Type\LocaleType A Symfony\Component\Form\Extension\Core\Type\LocaleType instance.
     */
    protected function getForm_Type_LocaleService()
    {
        return $this->services['form.type.locale'] = new \Symfony\Component\Form\Extension\Core\Type\LocaleType();
    }

    /**
     * Gets the 'form.type.money' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Core\Type\MoneyType A Symfony\Component\Form\Extension\Core\Type\MoneyType instance.
     */
    protected function getForm_Type_MoneyService()
    {
        return $this->services['form.type.money'] = new \Symfony\Component\Form\Extension\Core\Type\MoneyType();
    }

    /**
     * Gets the 'form.type.number' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Core\Type\NumberType A Symfony\Component\Form\Extension\Core\Type\NumberType instance.
     */
    protected function getForm_Type_NumberService()
    {
        return $this->services['form.type.number'] = new \Symfony\Component\Form\Extension\Core\Type\NumberType();
    }

    /**
     * Gets the 'form.type.password' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Core\Type\PasswordType A Symfony\Component\Form\Extension\Core\Type\PasswordType instance.
     */
    protected function getForm_Type_PasswordService()
    {
        return $this->services['form.type.password'] = new \Symfony\Component\Form\Extension\Core\Type\PasswordType();
    }

    /**
     * Gets the 'form.type.percent' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Core\Type\PercentType A Symfony\Component\Form\Extension\Core\Type\PercentType instance.
     */
    protected function getForm_Type_PercentService()
    {
        return $this->services['form.type.percent'] = new \Symfony\Component\Form\Extension\Core\Type\PercentType();
    }

    /**
     * Gets the 'form.type.radio' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Core\Type\RadioType A Symfony\Component\Form\Extension\Core\Type\RadioType instance.
     */
    protected function getForm_Type_RadioService()
    {
        return $this->services['form.type.radio'] = new \Symfony\Component\Form\Extension\Core\Type\RadioType();
    }

    /**
     * Gets the 'form.type.repeated' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Core\Type\RepeatedType A Symfony\Component\Form\Extension\Core\Type\RepeatedType instance.
     */
    protected function getForm_Type_RepeatedService()
    {
        return $this->services['form.type.repeated'] = new \Symfony\Component\Form\Extension\Core\Type\RepeatedType();
    }

    /**
     * Gets the 'form.type.search' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Core\Type\SearchType A Symfony\Component\Form\Extension\Core\Type\SearchType instance.
     */
    protected function getForm_Type_SearchService()
    {
        return $this->services['form.type.search'] = new \Symfony\Component\Form\Extension\Core\Type\SearchType();
    }

    /**
     * Gets the 'form.type.text' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Core\Type\TextType A Symfony\Component\Form\Extension\Core\Type\TextType instance.
     */
    protected function getForm_Type_TextService()
    {
        return $this->services['form.type.text'] = new \Symfony\Component\Form\Extension\Core\Type\TextType();
    }

    /**
     * Gets the 'form.type.textarea' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Core\Type\TextareaType A Symfony\Component\Form\Extension\Core\Type\TextareaType instance.
     */
    protected function getForm_Type_TextareaService()
    {
        return $this->services['form.type.textarea'] = new \Symfony\Component\Form\Extension\Core\Type\TextareaType();
    }

    /**
     * Gets the 'form.type.time' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Core\Type\TimeType A Symfony\Component\Form\Extension\Core\Type\TimeType instance.
     */
    protected function getForm_Type_TimeService()
    {
        return $this->services['form.type.time'] = new \Symfony\Component\Form\Extension\Core\Type\TimeType();
    }

    /**
     * Gets the 'form.type.timezone' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Core\Type\TimezoneType A Symfony\Component\Form\Extension\Core\Type\TimezoneType instance.
     */
    protected function getForm_Type_TimezoneService()
    {
        return $this->services['form.type.timezone'] = new \Symfony\Component\Form\Extension\Core\Type\TimezoneType();
    }

    /**
     * Gets the 'form.type.url' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Core\Type\UrlType A Symfony\Component\Form\Extension\Core\Type\UrlType instance.
     */
    protected function getForm_Type_UrlService()
    {
        return $this->services['form.type.url'] = new \Symfony\Component\Form\Extension\Core\Type\UrlType();
    }

    /**
     * Gets the 'form.type_extension.csrf' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Csrf\Type\FormTypeCsrfExtension A Symfony\Component\Form\Extension\Csrf\Type\FormTypeCsrfExtension instance.
     */
    protected function getForm_TypeExtension_CsrfService()
    {
        return $this->services['form.type_extension.csrf'] = new \Symfony\Component\Form\Extension\Csrf\Type\FormTypeCsrfExtension(true, '_token');
    }

    /**
     * Gets the 'form.type_extension.field' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Validator\Type\FieldTypeValidatorExtension A Symfony\Component\Form\Extension\Validator\Type\FieldTypeValidatorExtension instance.
     */
    protected function getForm_TypeExtension_FieldService()
    {
        return $this->services['form.type_extension.field'] = new \Symfony\Component\Form\Extension\Validator\Type\FieldTypeValidatorExtension($this->get('validator'));
    }

    /**
     * Gets the 'form.type_guesser.doctrine' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bridge\Doctrine\Form\DoctrineOrmTypeGuesser A Symfony\Bridge\Doctrine\Form\DoctrineOrmTypeGuesser instance.
     */
    protected function getForm_TypeGuesser_DoctrineService()
    {
        return $this->services['form.type_guesser.doctrine'] = new \Symfony\Bridge\Doctrine\Form\DoctrineOrmTypeGuesser($this->get('doctrine'));
    }

    /**
     * Gets the 'form.type_guesser.validator' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Extension\Validator\ValidatorTypeGuesser A Symfony\Component\Form\Extension\Validator\ValidatorTypeGuesser instance.
     */
    protected function getForm_TypeGuesser_ValidatorService()
    {
        return $this->services['form.type_guesser.validator'] = new \Symfony\Component\Form\Extension\Validator\ValidatorTypeGuesser($this->get('validator.mapping.class_metadata_factory'));
    }

    /**
     * Gets the 'fos_user.change_password.form' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Form A Symfony\Component\Form\Form instance.
     */
    protected function getFosUser_ChangePassword_FormService()
    {
        return $this->services['fos_user.change_password.form'] = $this->get('form.factory')->createNamed('fos_user_change_password_form', 'fos_user_change_password', '', array('validation_groups' => array(0 => 'ChangePassword')));
    }

    /**
     * Gets the 'fos_user.change_password.form.handler.default' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return FOS\UserBundle\Form\Handler\ChangePasswordFormHandler A FOS\UserBundle\Form\Handler\ChangePasswordFormHandler instance.
     */
    protected function getFosUser_ChangePassword_Form_Handler_DefaultService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('fos_user.change_password.form.handler.default', 'request');
        }

        return $this->services['fos_user.change_password.form.handler.default'] = $this->scopedServices['request']['fos_user.change_password.form.handler.default'] = new \FOS\UserBundle\Form\Handler\ChangePasswordFormHandler($this->get('fos_user.change_password.form'), $this->get('request'), $this->get('fos_user.user_manager'));
    }

    /**
     * Gets the 'fos_user.change_password.form.type' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return FOS\UserBundle\Form\Type\ChangePasswordFormType A FOS\UserBundle\Form\Type\ChangePasswordFormType instance.
     */
    protected function getFosUser_ChangePassword_Form_TypeService()
    {
        return $this->services['fos_user.change_password.form.type'] = new \FOS\UserBundle\Form\Type\ChangePasswordFormType();
    }

    /**
     * Gets the 'fos_user.group.form' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Form A Symfony\Component\Form\Form instance.
     */
    protected function getFosUser_Group_FormService()
    {
        return $this->services['fos_user.group.form'] = $this->get('form.factory')->createNamed('fos_user_group_form', 'fos_user_group', '', array('validation_groups' => array(0 => 'Registration')));
    }

    /**
     * Gets the 'fos_user.group.form.handler' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return FOS\UserBundle\Form\Handler\GroupFormHandler A FOS\UserBundle\Form\Handler\GroupFormHandler instance.
     */
    protected function getFosUser_Group_Form_HandlerService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('fos_user.group.form.handler', 'request');
        }

        return $this->services['fos_user.group.form.handler'] = $this->scopedServices['request']['fos_user.group.form.handler'] = new \FOS\UserBundle\Form\Handler\GroupFormHandler($this->get('fos_user.group.form'), $this->get('request'), $this->get('fos_user.group_manager'));
    }

    /**
     * Gets the 'fos_user.group.form.type' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return FOS\UserBundle\Form\Type\GroupFormType A FOS\UserBundle\Form\Type\GroupFormType instance.
     */
    protected function getFosUser_Group_Form_TypeService()
    {
        return $this->services['fos_user.group.form.type'] = new \FOS\UserBundle\Form\Type\GroupFormType('BootStrap\\UserBundle\\Entity\\Group');
    }

    /**
     * Gets the 'fos_user.group_manager' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return FOS\UserBundle\Entity\GroupManager A FOS\UserBundle\Entity\GroupManager instance.
     */
    protected function getFosUser_GroupManagerService()
    {
        return $this->services['fos_user.group_manager'] = new \FOS\UserBundle\Entity\GroupManager($this->get('fos_user.entity_manager'), 'BootStrap\\UserBundle\\Entity\\Group');
    }

    /**
     * Gets the 'fos_user.mailer' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return FOS\UserBundle\Mailer\Mailer A FOS\UserBundle\Mailer\Mailer instance.
     */
    protected function getFosUser_MailerService()
    {
        return $this->services['fos_user.mailer'] = new \FOS\UserBundle\Mailer\Mailer($this->get('mailer'), $this->get('i18n_routing.router'), $this->get('templating'), array('confirmation.template' => 'FOSUserBundle:Registration:email.txt.twig', 'resetting.template' => 'FOSUserBundle:Resetting:email.txt.twig', 'from_email' => array('confirmation' => array('etienne.delongeaux@gmail.com' => 'commercial'), 'resetting' => array('etienne.delongeaux@gmail.com' => 'admin'))));
    }

    /**
     * Gets the 'fos_user.profile.form' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Form A Symfony\Component\Form\Form instance.
     */
    protected function getFosUser_Profile_FormService()
    {
        return $this->services['fos_user.profile.form'] = $this->get('form.factory')->createNamed('fos_user_profile_form', 'fos_user_profile', '', array('validation_groups' => array(0 => 'Profile')));
    }

    /**
     * Gets the 'fos_user.profile.form.handler' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return FOS\UserBundle\Form\Handler\ProfileFormHandler A FOS\UserBundle\Form\Handler\ProfileFormHandler instance.
     */
    protected function getFosUser_Profile_Form_HandlerService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('fos_user.profile.form.handler', 'request');
        }

        return $this->services['fos_user.profile.form.handler'] = $this->scopedServices['request']['fos_user.profile.form.handler'] = new \FOS\UserBundle\Form\Handler\ProfileFormHandler($this->get('fos_user.profile.form'), $this->get('request'), $this->get('fos_user.user_manager'));
    }

    /**
     * Gets the 'fos_user.profile.form.type' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return FOS\UserBundle\Form\Type\ProfileFormType A FOS\UserBundle\Form\Type\ProfileFormType instance.
     */
    protected function getFosUser_Profile_Form_TypeService()
    {
        return $this->services['fos_user.profile.form.type'] = new \FOS\UserBundle\Form\Type\ProfileFormType('BootStrap\\UserBundle\\Entity\\User');
    }

    /**
     * Gets the 'fos_user.registration.form' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Form A Symfony\Component\Form\Form instance.
     */
    protected function getFosUser_Registration_FormService()
    {
        return $this->services['fos_user.registration.form'] = $this->get('form.factory')->createNamed('fos_user_registration_form', 'fos_user_registration', '', array('validation_groups' => array(0 => 'Registration')));
    }

    /**
     * Gets the 'fos_user.registration.form.handler' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return FOS\UserBundle\Form\Handler\RegistrationFormHandler A FOS\UserBundle\Form\Handler\RegistrationFormHandler instance.
     */
    protected function getFosUser_Registration_Form_HandlerService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('fos_user.registration.form.handler', 'request');
        }

        return $this->services['fos_user.registration.form.handler'] = $this->scopedServices['request']['fos_user.registration.form.handler'] = new \FOS\UserBundle\Form\Handler\RegistrationFormHandler($this->get('fos_user.registration.form'), $this->get('request'), $this->get('fos_user.user_manager'), $this->get('fos_user.mailer'));
    }

    /**
     * Gets the 'fos_user.registration.form.type' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return FOS\UserBundle\Form\Type\RegistrationFormType A FOS\UserBundle\Form\Type\RegistrationFormType instance.
     */
    protected function getFosUser_Registration_Form_TypeService()
    {
        return $this->services['fos_user.registration.form.type'] = new \FOS\UserBundle\Form\Type\RegistrationFormType('BootStrap\\UserBundle\\Entity\\User');
    }

    /**
     * Gets the 'fos_user.resetting.form' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Form\Form A Symfony\Component\Form\Form instance.
     */
    protected function getFosUser_Resetting_FormService()
    {
        return $this->services['fos_user.resetting.form'] = $this->get('form.factory')->createNamed('fos_user_resetting_form', 'fos_user_resetting', '', array('validation_groups' => array(0 => 'ResetPassword')));
    }

    /**
     * Gets the 'fos_user.resetting.form.handler' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return FOS\UserBundle\Form\Handler\ResettingFormHandler A FOS\UserBundle\Form\Handler\ResettingFormHandler instance.
     */
    protected function getFosUser_Resetting_Form_HandlerService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('fos_user.resetting.form.handler', 'request');
        }

        return $this->services['fos_user.resetting.form.handler'] = $this->scopedServices['request']['fos_user.resetting.form.handler'] = new \FOS\UserBundle\Form\Handler\ResettingFormHandler($this->get('fos_user.resetting.form'), $this->get('request'), $this->get('fos_user.user_manager'));
    }

    /**
     * Gets the 'fos_user.resetting.form.type' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return FOS\UserBundle\Form\Type\ResettingFormType A FOS\UserBundle\Form\Type\ResettingFormType instance.
     */
    protected function getFosUser_Resetting_Form_TypeService()
    {
        return $this->services['fos_user.resetting.form.type'] = new \FOS\UserBundle\Form\Type\ResettingFormType();
    }

    /**
     * Gets the 'fos_user.security.interactive_login_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return FOS\UserBundle\Security\InteractiveLoginListener A FOS\UserBundle\Security\InteractiveLoginListener instance.
     */
    protected function getFosUser_Security_InteractiveLoginListenerService()
    {
        return $this->services['fos_user.security.interactive_login_listener'] = new \FOS\UserBundle\Security\InteractiveLoginListener($this->get('fos_user.user_manager'));
    }

    /**
     * Gets the 'fos_user.user_checker' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Security\Core\User\UserChecker A Symfony\Component\Security\Core\User\UserChecker instance.
     */
    protected function getFosUser_UserCheckerService()
    {
        return $this->services['fos_user.user_checker'] = new \Symfony\Component\Security\Core\User\UserChecker();
    }

    /**
     * Gets the 'fos_user.user_manager' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return FOS\UserBundle\Entity\UserManager A FOS\UserBundle\Entity\UserManager instance.
     */
    protected function getFosUser_UserManagerService()
    {
        $a = $this->get('fos_user.util.email_canonicalizer');

        return $this->services['fos_user.user_manager'] = new \FOS\UserBundle\Entity\UserManager($this->get('security.encoder_factory'), $a, $a, $this->get('fos_user.entity_manager'), 'BootStrap\\UserBundle\\Entity\\User');
    }

    /**
     * Gets the 'fos_user.username_form_type' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return FOS\UserBundle\Form\Type\UsernameFormType A FOS\UserBundle\Form\Type\UsernameFormType instance.
     */
    protected function getFosUser_UsernameFormTypeService()
    {
        return $this->services['fos_user.username_form_type'] = new \FOS\UserBundle\Form\Type\UsernameFormType(new \FOS\UserBundle\Form\DataTransformer\UserToUsernameTransformer($this->get('fos_user.user_manager')));
    }

    /**
     * Gets the 'fos_user.util.email_canonicalizer' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return FOS\UserBundle\Util\Canonicalizer A FOS\UserBundle\Util\Canonicalizer instance.
     */
    protected function getFosUser_Util_EmailCanonicalizerService()
    {
        return $this->services['fos_user.util.email_canonicalizer'] = new \FOS\UserBundle\Util\Canonicalizer();
    }

    /**
     * Gets the 'fos_user.util.user_manipulator' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return FOS\UserBundle\Util\UserManipulator A FOS\UserBundle\Util\UserManipulator instance.
     */
    protected function getFosUser_Util_UserManipulatorService()
    {
        return $this->services['fos_user.util.user_manipulator'] = new \FOS\UserBundle\Util\UserManipulator($this->get('fos_user.user_manager'));
    }

    /**
     * Gets the 'fos_user.validator.password' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return FOS\UserBundle\Validator\PasswordValidator A FOS\UserBundle\Validator\PasswordValidator instance.
     */
    protected function getFosUser_Validator_PasswordService()
    {
        $this->services['fos_user.validator.password'] = $instance = new \FOS\UserBundle\Validator\PasswordValidator();

        $instance->setEncoderFactory($this->get('security.encoder_factory'));

        return $instance;
    }

    /**
     * Gets the 'fos_user.validator.unique' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return FOS\UserBundle\Validator\UniqueValidator A FOS\UserBundle\Validator\UniqueValidator instance.
     */
    protected function getFosUser_Validator_UniqueService()
    {
        return $this->services['fos_user.validator.unique'] = new \FOS\UserBundle\Validator\UniqueValidator($this->get('fos_user.user_manager'));
    }

    /**
     * Gets the 'gedmo.listener.loggable' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Gedmo\Loggable\LoggableListener A Gedmo\Loggable\LoggableListener instance.
     */
    protected function getGedmo_Listener_LoggableService()
    {
        $this->services['gedmo.listener.loggable'] = $instance = new \Gedmo\Loggable\LoggableListener();

        $instance->setAnnotationReader($this->get('annotation_reader'));

        return $instance;
    }

    /**
     * Gets the 'gedmo.listener.sluggable' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Gedmo\Sluggable\SluggableListener A Gedmo\Sluggable\SluggableListener instance.
     */
    protected function getGedmo_Listener_SluggableService()
    {
        $this->services['gedmo.listener.sluggable'] = $instance = new \Gedmo\Sluggable\SluggableListener();

        $instance->setAnnotationReader($this->get('annotation_reader'));

        return $instance;
    }

    /**
     * Gets the 'gedmo.listener.timestampable' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Gedmo\Timestampable\TimestampableListener A Gedmo\Timestampable\TimestampableListener instance.
     */
    protected function getGedmo_Listener_TimestampableService()
    {
        $this->services['gedmo.listener.timestampable'] = $instance = new \Gedmo\Timestampable\TimestampableListener();

        $instance->setAnnotationReader($this->get('annotation_reader'));

        return $instance;
    }

    /**
     * Gets the 'gedmo.listener.translatable' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Gedmo\Translatable\TranslatableListener A Gedmo\Translatable\TranslatableListener instance.
     */
    protected function getGedmo_Listener_TranslatableService()
    {
        $this->services['gedmo.listener.translatable'] = $instance = new \Gedmo\Translatable\TranslatableListener();

        $instance->setAnnotationReader($this->get('annotation_reader'));
        $instance->setDefaultLocale('en_GB');
        $instance->setTranslationFallback(false);

        return $instance;
    }

    /**
     * Gets the 'gedmo.listener.tree' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Gedmo\Tree\TreeListener A Gedmo\Tree\TreeListener instance.
     */
    protected function getGedmo_Listener_TreeService()
    {
        $this->services['gedmo.listener.tree'] = $instance = new \Gedmo\Tree\TreeListener();

        $instance->setAnnotationReader($this->get('annotation_reader'));

        return $instance;
    }

    /**
     * Gets the 'http_kernel' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\FrameworkBundle\HttpKernel A Symfony\Bundle\FrameworkBundle\HttpKernel instance.
     */
    protected function getHttpKernelService()
    {
        return $this->services['http_kernel'] = new \Symfony\Bundle\FrameworkBundle\HttpKernel($this->get('event_dispatcher'), $this, new \JMS\DiExtraBundle\HttpKernel\ControllerResolver($this, $this->get('controller_name_converter'), $this->get('monolog.logger.request')));
    }

    /**
     * Gets the 'i18n_routing.doctrine.cache' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Doctrine\Common\Cache\ArrayCache A Doctrine\Common\Cache\ArrayCache instance.
     */
    protected function getI18nRouting_Doctrine_CacheService()
    {
        return $this->services['i18n_routing.doctrine.cache'] = new \Doctrine\Common\Cache\ArrayCache();
    }

    /**
     * Gets the 'i18n_routing.router' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return BeSimple\I18nRoutingBundle\Routing\Router A BeSimple\I18nRoutingBundle\Routing\Router instance.
     */
    protected function getI18nRouting_RouterService()
    {
        return $this->services['i18n_routing.router'] = new \BeSimple\I18nRoutingBundle\Routing\Router($this->get('i18n_routing.translator'), $this, '/Users/guillaumemigeon/Sites/orchestra-cmf/app/config/routing_dev.yml', array('cache_dir' => '/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/dev', 'debug' => true, 'generator_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator', 'generator_base_class' => 'BeSimple\\I18nRoutingBundle\\Routing\\Generator\\UrlGenerator', 'generator_dumper_class' => 'Symfony\\Component\\Routing\\Generator\\Dumper\\PhpGeneratorDumper', 'generator_cache_class' => 'appdevUrlGenerator', 'matcher_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher', 'matcher_base_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher', 'matcher_dumper_class' => 'Symfony\\Component\\Routing\\Matcher\\Dumper\\PhpMatcherDumper', 'matcher_cache_class' => 'appdevUrlMatcher'));
    }

    /**
     * Gets the 'i18n_routing.translator' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return BeSimple\I18nRoutingBundle\Routing\Translator\DoctrineDBALTranslator A BeSimple\I18nRoutingBundle\Routing\Translator\DoctrineDBALTranslator instance.
     */
    protected function getI18nRouting_TranslatorService()
    {
        return $this->services['i18n_routing.translator'] = new \BeSimple\I18nRoutingBundle\Routing\Translator\DoctrineDBALTranslator($this->get('doctrine.dbal.default_connection'), $this->get('i18n_routing.doctrine.cache'));
    }

    /**
     * Gets the 'jms_aop.interceptor_loader' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return JMS\AopBundle\Aop\InterceptorLoader A JMS\AopBundle\Aop\InterceptorLoader instance.
     */
    protected function getJmsAop_InterceptorLoaderService()
    {
        return $this->services['jms_aop.interceptor_loader'] = new \JMS\AopBundle\Aop\InterceptorLoader($this, array());
    }

    /**
     * Gets the 'jms_aop.pointcut_container' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return JMS\AopBundle\Aop\PointcutContainer A JMS\AopBundle\Aop\PointcutContainer instance.
     */
    protected function getJmsAop_PointcutContainerService()
    {
        return $this->services['jms_aop.pointcut_container'] = new \JMS\AopBundle\Aop\PointcutContainer(array());
    }

    /**
     * Gets the 'jms_di_extra.metadata.converter' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return JMS\DiExtraBundle\Metadata\MetadataConverter A JMS\DiExtraBundle\Metadata\MetadataConverter instance.
     */
    protected function getJmsDiExtra_Metadata_ConverterService()
    {
        return $this->services['jms_di_extra.metadata.converter'] = new \JMS\DiExtraBundle\Metadata\MetadataConverter();
    }

    /**
     * Gets the 'jms_di_extra.metadata.metadata_factory' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Metadata\MetadataFactory A Metadata\MetadataFactory instance.
     */
    protected function getJmsDiExtra_Metadata_MetadataFactoryService()
    {
        $this->services['jms_di_extra.metadata.metadata_factory'] = $instance = new \Metadata\MetadataFactory(new \JMS\DiExtraBundle\Metadata\Driver\AnnotationDriver($this->get('annotation_reader')), 'Metadata\\ClassHierarchyMetadata', true);

        $instance->setCache(new \Metadata\Cache\FileCache('/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/dev/diextra/metadata'));

        return $instance;
    }

    /**
     * Gets the 'kernel' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @throws \RuntimeException always since this service is expected to be injected dynamically
     */
    protected function getKernelService()
    {
        throw new \RuntimeException('You have requested a synthetic service ("kernel"). The DIC does not know how to construct this service.');
    }

    /**
     * Gets the 'knp_menu.factory' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Knp\Menu\Silex\RouterAwareFactory A Knp\Menu\Silex\RouterAwareFactory instance.
     */
    protected function getKnpMenu_FactoryService()
    {
        return $this->services['knp_menu.factory'] = new \Knp\Menu\Silex\RouterAwareFactory($this->get('i18n_routing.router'));
    }

    /**
     * Gets the 'knp_menu.menu_provider' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Knp\Menu\Provider\ChainProvider A Knp\Menu\Provider\ChainProvider instance.
     */
    protected function getKnpMenu_MenuProviderService()
    {
        return $this->services['knp_menu.menu_provider'] = new \Knp\Menu\Provider\ChainProvider(array(0 => new \Knp\Bundle\MenuBundle\Provider\ContainerAwareProvider($this, array()), 1 => new \Knp\Bundle\MenuBundle\Provider\BuilderAliasProvider($this->get('kernel'), $this, $this->get('knp_menu.factory'))));
    }

    /**
     * Gets the 'knp_menu.renderer.list' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Knp\Menu\Renderer\ListRenderer A Knp\Menu\Renderer\ListRenderer instance.
     */
    protected function getKnpMenu_Renderer_ListService()
    {
        return $this->services['knp_menu.renderer.list'] = new \Knp\Menu\Renderer\ListRenderer('UTF-8');
    }

    /**
     * Gets the 'knp_menu.renderer.twig' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Knp\Menu\Renderer\TwigRenderer A Knp\Menu\Renderer\TwigRenderer instance.
     */
    protected function getKnpMenu_Renderer_TwigService()
    {
        return $this->services['knp_menu.renderer.twig'] = new \Knp\Menu\Renderer\TwigRenderer($this->get('twig'), 'knp_menu.html.twig');
    }

    /**
     * Gets the 'knp_menu.renderer_provider' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Knp\Bundle\MenuBundle\Renderer\ContainerAwareProvider A Knp\Bundle\MenuBundle\Renderer\ContainerAwareProvider instance.
     */
    protected function getKnpMenu_RendererProviderService()
    {
        return $this->services['knp_menu.renderer_provider'] = new \Knp\Bundle\MenuBundle\Renderer\ContainerAwareProvider($this, 'twig', array('list' => 'knp_menu.renderer.list', 'twig' => 'knp_menu.renderer.twig'));
    }

    /**
     * Gets the 'knp_paginator' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Knp\Component\Pager\Paginator A Knp\Component\Pager\Paginator instance.
     */
    protected function getKnpPaginatorService()
    {
        $this->services['knp_paginator'] = $instance = new \Knp\Component\Pager\Paginator($this->get('event_dispatcher'));

        $instance->setDefaultPaginatorOptions(array('pageParameterName' => 'page', 'sortFieldParameterName' => 'sort', 'sortDirectionParameterName' => 'direction', 'distinct' => true));

        return $instance;
    }

    /**
     * Gets the 'knp_paginator.subscriber.paginate' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Knp\Component\Pager\Event\Subscriber\Paginate\PaginationSubscriber A Knp\Component\Pager\Event\Subscriber\Paginate\PaginationSubscriber instance.
     */
    protected function getKnpPaginator_Subscriber_PaginateService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('knp_paginator.subscriber.paginate', 'request');
        }

        return $this->services['knp_paginator.subscriber.paginate'] = $this->scopedServices['request']['knp_paginator.subscriber.paginate'] = new \Knp\Component\Pager\Event\Subscriber\Paginate\PaginationSubscriber();
    }

    /**
     * Gets the 'knp_paginator.subscriber.sliding_pagination' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Knp\Bundle\PaginatorBundle\Subscriber\SlidingPaginationSubscriber A Knp\Bundle\PaginatorBundle\Subscriber\SlidingPaginationSubscriber instance.
     */
    protected function getKnpPaginator_Subscriber_SlidingPaginationService()
    {
        return $this->services['knp_paginator.subscriber.sliding_pagination'] = new \Knp\Bundle\PaginatorBundle\Subscriber\SlidingPaginationSubscriber($this->get('templating'), $this->get('templating.helper.router'), $this->get('translator.default'), array('defaultPaginationTemplate' => 'KnpPaginatorBundle:Pagination:sliding.html.twig', 'defaultSortableTemplate' => 'KnpPaginatorBundle:Pagination:sortable_link.html.twig', 'defaultPageRange' => 5));
    }

    /**
     * Gets the 'knp_paginator.subscriber.sortable' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Knp\Component\Pager\Event\Subscriber\Sortable\SortableSubscriber A Knp\Component\Pager\Event\Subscriber\Sortable\SortableSubscriber instance.
     */
    protected function getKnpPaginator_Subscriber_SortableService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('knp_paginator.subscriber.sortable', 'request');
        }

        return $this->services['knp_paginator.subscriber.sortable'] = $this->scopedServices['request']['knp_paginator.subscriber.sortable'] = new \Knp\Component\Pager\Event\Subscriber\Sortable\SortableSubscriber();
    }

    /**
     * Gets the 'logger' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bridge\Monolog\Logger A Symfony\Bridge\Monolog\Logger instance.
     */
    protected function getLoggerService()
    {
        $this->services['logger'] = $instance = new \Symfony\Bridge\Monolog\Logger('app');

        $instance->pushHandler($this->get('monolog.handler.main'));
        $instance->pushHandler($this->get('monolog.handler.firephp'));
        $instance->pushHandler($this->get('monolog.handler.debug'));

        return $instance;
    }

    /**
     * Gets the 'mailer' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Swift_Mailer A Swift_Mailer instance.
     */
    protected function getMailerService()
    {
        return $this->services['mailer'] = new \Swift_Mailer($this->get('swiftmailer.transport'));
    }

    /**
     * Gets the 'monolog.handler.debug' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bridge\Monolog\Handler\DebugHandler A Symfony\Bridge\Monolog\Handler\DebugHandler instance.
     */
    protected function getMonolog_Handler_DebugService()
    {
        return $this->services['monolog.handler.debug'] = new \Symfony\Bridge\Monolog\Handler\DebugHandler(100, true);
    }

    /**
     * Gets the 'monolog.handler.firephp' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bridge\Monolog\Handler\FirePHPHandler A Symfony\Bridge\Monolog\Handler\FirePHPHandler instance.
     */
    protected function getMonolog_Handler_FirephpService()
    {
        return $this->services['monolog.handler.firephp'] = new \Symfony\Bridge\Monolog\Handler\FirePHPHandler(200, true);
    }

    /**
     * Gets the 'monolog.handler.main' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Monolog\Handler\StreamHandler A Monolog\Handler\StreamHandler instance.
     */
    protected function getMonolog_Handler_MainService()
    {
        return $this->services['monolog.handler.main'] = new \Monolog\Handler\StreamHandler('/Users/guillaumemigeon/Sites/orchestra-cmf/app/logs/dev.log', 100, true);
    }

    /**
     * Gets the 'monolog.logger.doctrine' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bridge\Monolog\Logger A Symfony\Bridge\Monolog\Logger instance.
     */
    protected function getMonolog_Logger_DoctrineService()
    {
        $this->services['monolog.logger.doctrine'] = $instance = new \Symfony\Bridge\Monolog\Logger('doctrine');

        $instance->pushHandler($this->get('monolog.handler.main'));
        $instance->pushHandler($this->get('monolog.handler.firephp'));
        $instance->pushHandler($this->get('monolog.handler.debug'));

        return $instance;
    }

    /**
     * Gets the 'monolog.logger.event' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bridge\Monolog\Logger A Symfony\Bridge\Monolog\Logger instance.
     */
    protected function getMonolog_Logger_EventService()
    {
        $this->services['monolog.logger.event'] = $instance = new \Symfony\Bridge\Monolog\Logger('event');

        $instance->pushHandler($this->get('monolog.handler.main'));
        $instance->pushHandler($this->get('monolog.handler.firephp'));
        $instance->pushHandler($this->get('monolog.handler.debug'));

        return $instance;
    }

    /**
     * Gets the 'monolog.logger.profiler' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bridge\Monolog\Logger A Symfony\Bridge\Monolog\Logger instance.
     */
    protected function getMonolog_Logger_ProfilerService()
    {
        $this->services['monolog.logger.profiler'] = $instance = new \Symfony\Bridge\Monolog\Logger('profiler');

        $instance->pushHandler($this->get('monolog.handler.main'));
        $instance->pushHandler($this->get('monolog.handler.firephp'));
        $instance->pushHandler($this->get('monolog.handler.debug'));

        return $instance;
    }

    /**
     * Gets the 'monolog.logger.request' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bridge\Monolog\Logger A Symfony\Bridge\Monolog\Logger instance.
     */
    protected function getMonolog_Logger_RequestService()
    {
        $this->services['monolog.logger.request'] = $instance = new \Symfony\Bridge\Monolog\Logger('request');

        $instance->pushHandler($this->get('monolog.handler.main'));
        $instance->pushHandler($this->get('monolog.handler.firephp'));
        $instance->pushHandler($this->get('monolog.handler.debug'));

        return $instance;
    }

    /**
     * Gets the 'monolog.logger.router' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bridge\Monolog\Logger A Symfony\Bridge\Monolog\Logger instance.
     */
    protected function getMonolog_Logger_RouterService()
    {
        $this->services['monolog.logger.router'] = $instance = new \Symfony\Bridge\Monolog\Logger('router');

        $instance->pushHandler($this->get('monolog.handler.main'));
        $instance->pushHandler($this->get('monolog.handler.firephp'));
        $instance->pushHandler($this->get('monolog.handler.debug'));

        return $instance;
    }

    /**
     * Gets the 'monolog.logger.security' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bridge\Monolog\Logger A Symfony\Bridge\Monolog\Logger instance.
     */
    protected function getMonolog_Logger_SecurityService()
    {
        $this->services['monolog.logger.security'] = $instance = new \Symfony\Bridge\Monolog\Logger('security');

        $instance->pushHandler($this->get('monolog.handler.main'));
        $instance->pushHandler($this->get('monolog.handler.firephp'));
        $instance->pushHandler($this->get('monolog.handler.debug'));

        return $instance;
    }

    /**
     * Gets the 'monolog.logger.templating' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bridge\Monolog\Logger A Symfony\Bridge\Monolog\Logger instance.
     */
    protected function getMonolog_Logger_TemplatingService()
    {
        $this->services['monolog.logger.templating'] = $instance = new \Symfony\Bridge\Monolog\Logger('templating');

        $instance->pushHandler($this->get('monolog.handler.main'));
        $instance->pushHandler($this->get('monolog.handler.firephp'));
        $instance->pushHandler($this->get('monolog.handler.debug'));

        return $instance;
    }

    /**
     * Gets the 'php_memcache' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Memcache A Memcache instance.
     */
    protected function getPhpMemcacheService()
    {
        return $this->services['php_memcache'] = new \Memcache();
    }

    /**
     * Gets the 'pi.acl_manager' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return BootStrap\AclManagerBundle\Domain\AclManager A BootStrap\AclManagerBundle\Domain\AclManager instance.
     */
    protected function getPi_AclManagerService()
    {
        return $this->services['pi.acl_manager'] = new \BootStrap\AclManagerBundle\Domain\AclManager($this->get('security.acl.provider'), $this->get('security.context'));
    }

    /**
     * Gets the 'pi.form.addinfo_extension' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Form\Extension\AddinfoFieldTypeExtension A PiApp\AdminBundle\Form\Extension\AddinfoFieldTypeExtension instance.
     */
    protected function getPi_Form_AddinfoExtensionService()
    {
        return $this->services['pi.form.addinfo_extension'] = new \PiApp\AdminBundle\Form\Extension\AddinfoFieldTypeExtension();
    }

    /**
     * Gets the 'pi.form.error_type_extension' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Form\Extension\ErrorTypeFormTypeExtension A PiApp\AdminBundle\Form\Extension\ErrorTypeFormTypeExtension instance.
     */
    protected function getPi_Form_ErrorTypeExtensionService()
    {
        return $this->services['pi.form.error_type_extension'] = new \PiApp\AdminBundle\Form\Extension\ErrorTypeFormTypeExtension(array('error_type' => 'inline'));
    }

    /**
     * Gets the 'pi.form.field_error_type' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Form\Extension\ErrorTypeFieldTypeExtension A PiApp\AdminBundle\Form\Extension\ErrorTypeFieldTypeExtension instance.
     */
    protected function getPi_Form_FieldErrorTypeService()
    {
        return $this->services['pi.form.field_error_type'] = new \PiApp\AdminBundle\Form\Extension\ErrorTypeFieldTypeExtension();
    }

    /**
     * Gets the 'pi.form.help_extension' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Form\Extension\HelpFieldTypeExtension A PiApp\AdminBundle\Form\Extension\HelpFieldTypeExtension instance.
     */
    protected function getPi_Form_HelpExtensionService()
    {
        return $this->services['pi.form.help_extension'] = new \PiApp\AdminBundle\Form\Extension\HelpFieldTypeExtension();
    }

    /**
     * Gets the 'pi.form.label_extension' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Form\Extension\LabelFieldTypeExtension A PiApp\AdminBundle\Form\Extension\LabelFieldTypeExtension instance.
     */
    protected function getPi_Form_LabelExtensionService()
    {
        return $this->services['pi.form.label_extension'] = new \PiApp\AdminBundle\Form\Extension\LabelFieldTypeExtension();
    }

    /**
     * Gets the 'pi.form.legend_extension' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Form\Extension\LegendFormTypeExtension A PiApp\AdminBundle\Form\Extension\LegendFormTypeExtension instance.
     */
    protected function getPi_Form_LegendExtensionService()
    {
        return $this->services['pi.form.legend_extension'] = new \PiApp\AdminBundle\Form\Extension\LegendFormTypeExtension(array('show_legend' => true, 'show_child_legend' => false));
    }

    /**
     * Gets the 'pi_app_admin.array_manager' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiArrayManager A PiApp\AdminBundle\Util\PiArrayManager instance.
     */
    protected function getPiAppAdmin_ArrayManagerService()
    {
        return $this->services['pi_app_admin.array_manager'] = new \PiApp\AdminBundle\Util\PiArrayManager();
    }

    /**
     * Gets the 'pi_app_admin.caching' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Twig\PiTwigCache A PiApp\AdminBundle\Twig\PiTwigCache instance.
     */
    protected function getPiAppAdmin_CachingService()
    {
        return $this->services['pi_app_admin.caching'] = new \PiApp\AdminBundle\Twig\PiTwigCache($this->get('pi_app_admin.twig'), $this);
    }

    /**
     * Gets the 'pi_app_admin.date_manager' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiDateManager A PiApp\AdminBundle\Util\PiDateManager instance.
     */
    protected function getPiAppAdmin_DateManagerService()
    {
        return $this->services['pi_app_admin.date_manager'] = new \PiApp\AdminBundle\Util\PiDateManager();
    }

    /**
     * Gets the 'pi_app_admin.event_subscriber.media' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\GedmoBundle\EventSubscriber\EventSubscriberMedia A PiApp\GedmoBundle\EventSubscriber\EventSubscriberMedia instance.
     */
    protected function getPiAppAdmin_EventSubscriber_MediaService()
    {
        return $this->services['pi_app_admin.event_subscriber.media'] = new \PiApp\GedmoBundle\EventSubscriber\EventSubscriberMedia($this);
    }

    /**
     * Gets the 'pi_app_admin.event_subscriber.position' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\GedmoBundle\EventSubscriber\EventSubscriberPosition A PiApp\GedmoBundle\EventSubscriber\EventSubscriberPosition instance.
     */
    protected function getPiAppAdmin_EventSubscriber_PositionService()
    {
        return $this->services['pi_app_admin.event_subscriber.position'] = new \PiApp\GedmoBundle\EventSubscriber\EventSubscriberPosition($this);
    }

    /**
     * Gets the 'pi_app_admin.file_manager' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiFileManager A PiApp\AdminBundle\Util\PiFileManager instance.
     */
    protected function getPiAppAdmin_FileManagerService()
    {
        return $this->services['pi_app_admin.file_manager'] = new \PiApp\AdminBundle\Util\PiFileManager($this);
    }

    /**
     * Gets the 'pi_app_admin.formbuilder_manager.model.block' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\GedmoBundle\Manager\FormBuilder\PiModelWidgetBlock A PiApp\GedmoBundle\Manager\FormBuilder\PiModelWidgetBlock instance.
     */
    protected function getPiAppAdmin_FormbuilderManager_Model_BlockService()
    {
        return $this->services['pi_app_admin.formbuilder_manager.model.block'] = new \PiApp\GedmoBundle\Manager\FormBuilder\PiModelWidgetBlock($this);
    }

    /**
     * Gets the 'pi_app_admin.formbuilder_manager.model.content' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\GedmoBundle\Manager\FormBuilder\PiModelWidgetContent A PiApp\GedmoBundle\Manager\FormBuilder\PiModelWidgetContent instance.
     */
    protected function getPiAppAdmin_FormbuilderManager_Model_ContentService()
    {
        return $this->services['pi_app_admin.formbuilder_manager.model.content'] = new \PiApp\GedmoBundle\Manager\FormBuilder\PiModelWidgetContent($this);
    }

    /**
     * Gets the 'pi_app_admin.formbuilder_manager.model.slide' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\GedmoBundle\Manager\FormBuilder\PiModelWidgetSlide A PiApp\GedmoBundle\Manager\FormBuilder\PiModelWidgetSlide instance.
     */
    protected function getPiAppAdmin_FormbuilderManager_Model_SlideService()
    {
        return $this->services['pi_app_admin.formbuilder_manager.model.slide'] = new \PiApp\GedmoBundle\Manager\FormBuilder\PiModelWidgetSlide($this);
    }

    /**
     * Gets the 'pi_app_admin.formbuilder_manager.model.snippet' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\GedmoBundle\Manager\FormBuilder\PiModelWidgetSnippet A PiApp\GedmoBundle\Manager\FormBuilder\PiModelWidgetSnippet instance.
     */
    protected function getPiAppAdmin_FormbuilderManager_Model_SnippetService()
    {
        return $this->services['pi_app_admin.formbuilder_manager.model.snippet'] = new \PiApp\GedmoBundle\Manager\FormBuilder\PiModelWidgetSnippet($this);
    }

    /**
     * Gets the 'pi_app_admin.jquery_manager.backstretch' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiJquery\PiBackstretchManager A PiApp\AdminBundle\Util\PiJquery\PiBackstretchManager instance.
     */
    protected function getPiAppAdmin_JqueryManager_BackstretchService()
    {
        return $this->services['pi_app_admin.jquery_manager.backstretch'] = new \PiApp\AdminBundle\Util\PiJquery\PiBackstretchManager($this);
    }

    /**
     * Gets the 'pi_app_admin.jquery_manager.contextmenu' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiJquery\PiContextMenuManager A PiApp\AdminBundle\Util\PiJquery\PiContextMenuManager instance.
     */
    protected function getPiAppAdmin_JqueryManager_ContextmenuService()
    {
        return $this->services['pi_app_admin.jquery_manager.contextmenu'] = new \PiApp\AdminBundle\Util\PiJquery\PiContextMenuManager($this);
    }

    /**
     * Gets the 'pi_app_admin.jquery_manager.flexslider' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiJquery\PiFlexSliderManager A PiApp\AdminBundle\Util\PiJquery\PiFlexSliderManager instance.
     */
    protected function getPiAppAdmin_JqueryManager_FlexsliderService()
    {
        return $this->services['pi_app_admin.jquery_manager.flexslider'] = new \PiApp\AdminBundle\Util\PiJquery\PiFlexSliderManager($this);
    }

    /**
     * Gets the 'pi_app_admin.jquery_manager.formsimple' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiJquery\PiFormSimpleManager A PiApp\AdminBundle\Util\PiJquery\PiFormSimpleManager instance.
     */
    protected function getPiAppAdmin_JqueryManager_FormsimpleService()
    {
        return $this->services['pi_app_admin.jquery_manager.formsimple'] = new \PiApp\AdminBundle\Util\PiJquery\PiFormSimpleManager($this);
    }

    /**
     * Gets the 'pi_app_admin.jquery_manager.gridsimple' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiJquery\PiGridSimpleManager A PiApp\AdminBundle\Util\PiJquery\PiGridSimpleManager instance.
     */
    protected function getPiAppAdmin_JqueryManager_GridsimpleService()
    {
        return $this->services['pi_app_admin.jquery_manager.gridsimple'] = new \PiApp\AdminBundle\Util\PiJquery\PiGridSimpleManager($this);
    }

    /**
     * Gets the 'pi_app_admin.jquery_manager.gridtable' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiJquery\PiGridTableManager A PiApp\AdminBundle\Util\PiJquery\PiGridTableManager instance.
     */
    protected function getPiAppAdmin_JqueryManager_GridtableService()
    {
        return $this->services['pi_app_admin.jquery_manager.gridtable'] = new \PiApp\AdminBundle\Util\PiJquery\PiGridTableManager($this);
    }

    /**
     * Gets the 'pi_app_admin.jquery_manager.languagechoice' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiJquery\PiLanguageChoiceManager A PiApp\AdminBundle\Util\PiJquery\PiLanguageChoiceManager instance.
     */
    protected function getPiAppAdmin_JqueryManager_LanguagechoiceService()
    {
        return $this->services['pi_app_admin.jquery_manager.languagechoice'] = new \PiApp\AdminBundle\Util\PiJquery\PiLanguageChoiceManager($this);
    }

    /**
     * Gets the 'pi_app_admin.jquery_manager.orgchartpage' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiJquery\PiOrgChartPageManager A PiApp\AdminBundle\Util\PiJquery\PiOrgChartPageManager instance.
     */
    protected function getPiAppAdmin_JqueryManager_OrgchartpageService()
    {
        return $this->services['pi_app_admin.jquery_manager.orgchartpage'] = new \PiApp\AdminBundle\Util\PiJquery\PiOrgChartPageManager($this);
    }

    /**
     * Gets the 'pi_app_admin.jquery_manager.orgsemantique' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiJquery\PiOrgSemantiquePageManager A PiApp\AdminBundle\Util\PiJquery\PiOrgSemantiquePageManager instance.
     */
    protected function getPiAppAdmin_JqueryManager_OrgsemantiqueService()
    {
        return $this->services['pi_app_admin.jquery_manager.orgsemantique'] = new \PiApp\AdminBundle\Util\PiJquery\PiOrgSemantiquePageManager($this);
    }

    /**
     * Gets the 'pi_app_admin.jquery_manager.orgtreepage' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiJquery\PiOrgTreePageManager A PiApp\AdminBundle\Util\PiJquery\PiOrgTreePageManager instance.
     */
    protected function getPiAppAdmin_JqueryManager_OrgtreepageService()
    {
        return $this->services['pi_app_admin.jquery_manager.orgtreepage'] = new \PiApp\AdminBundle\Util\PiJquery\PiOrgTreePageManager($this);
    }

    /**
     * Gets the 'pi_app_admin.jquery_manager.prototypebytabs' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiJquery\PiPrototypeByTabsManager A PiApp\AdminBundle\Util\PiJquery\PiPrototypeByTabsManager instance.
     */
    protected function getPiAppAdmin_JqueryManager_PrototypebytabsService()
    {
        return $this->services['pi_app_admin.jquery_manager.prototypebytabs'] = new \PiApp\AdminBundle\Util\PiJquery\PiPrototypeByTabsManager($this);
    }

    /**
     * Gets the 'pi_app_admin.jquery_manager.searchlucene' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiJquery\PiSearchLuceneManager A PiApp\AdminBundle\Util\PiJquery\PiSearchLuceneManager instance.
     */
    protected function getPiAppAdmin_JqueryManager_SearchluceneService()
    {
        return $this->services['pi_app_admin.jquery_manager.searchlucene'] = new \PiApp\AdminBundle\Util\PiJquery\PiSearchLuceneManager($this);
    }

    /**
     * Gets the 'pi_app_admin.jquery_manager.sessionflash' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiJquery\PiSessionFlashManager A PiApp\AdminBundle\Util\PiJquery\PiSessionFlashManager instance.
     */
    protected function getPiAppAdmin_JqueryManager_SessionflashService()
    {
        return $this->services['pi_app_admin.jquery_manager.sessionflash'] = new \PiApp\AdminBundle\Util\PiJquery\PiSessionFlashManager($this);
    }

    /**
     * Gets the 'pi_app_admin.jquery_manager.tinyaccordeon' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiJquery\PiTinyAccordeonManager A PiApp\AdminBundle\Util\PiJquery\PiTinyAccordeonManager instance.
     */
    protected function getPiAppAdmin_JqueryManager_TinyaccordeonService()
    {
        return $this->services['pi_app_admin.jquery_manager.tinyaccordeon'] = new \PiApp\AdminBundle\Util\PiJquery\PiTinyAccordeonManager($this);
    }

    /**
     * Gets the 'pi_app_admin.jquery_manager.twitter' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiJquery\PiTwitterManager A PiApp\AdminBundle\Util\PiJquery\PiTwitterManager instance.
     */
    protected function getPiAppAdmin_JqueryManager_TwitterService()
    {
        return $this->services['pi_app_admin.jquery_manager.twitter'] = new \PiApp\AdminBundle\Util\PiJquery\PiTwitterManager($this);
    }

    /**
     * Gets the 'pi_app_admin.jquery_manager.veneer' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiJquery\PiVeneerManager A PiApp\AdminBundle\Util\PiJquery\PiVeneerManager instance.
     */
    protected function getPiAppAdmin_JqueryManager_VeneerService()
    {
        return $this->services['pi_app_admin.jquery_manager.veneer'] = new \PiApp\AdminBundle\Util\PiJquery\PiVeneerManager($this);
    }

    /**
     * Gets the 'pi_app_admin.jquery_manager.widgetadmin' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiJquery\PiWidgetAdminManager A PiApp\AdminBundle\Util\PiJquery\PiWidgetAdminManager instance.
     */
    protected function getPiAppAdmin_JqueryManager_WidgetadminService()
    {
        return $this->services['pi_app_admin.jquery_manager.widgetadmin'] = new \PiApp\AdminBundle\Util\PiJquery\PiWidgetAdminManager($this);
    }

    /**
     * Gets the 'pi_app_admin.jquery_manager.widgetimport' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiJquery\PiwidgetimportManager A PiApp\AdminBundle\Util\PiJquery\PiwidgetimportManager instance.
     */
    protected function getPiAppAdmin_JqueryManager_WidgetimportService()
    {
        return $this->services['pi_app_admin.jquery_manager.widgetimport'] = new \PiApp\AdminBundle\Util\PiJquery\PiwidgetimportManager($this);
    }

    /**
     * Gets the 'pi_app_admin.jquery_manager.wizard' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiJquery\PiWizardManager A PiApp\AdminBundle\Util\PiJquery\PiWizardManager instance.
     */
    protected function getPiAppAdmin_JqueryManager_WizardService()
    {
        return $this->services['pi_app_admin.jquery_manager.wizard'] = new \PiApp\AdminBundle\Util\PiJquery\PiWizardManager($this);
    }

    /**
     * Gets the 'pi_app_admin.locale_manager' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiLocaleManager A PiApp\AdminBundle\Util\PiLocaleManager instance.
     */
    protected function getPiAppAdmin_LocaleManagerService()
    {
        return $this->services['pi_app_admin.locale_manager'] = new \PiApp\AdminBundle\Util\PiLocaleManager($this);
    }

    /**
     * Gets the 'pi_app_admin.logout_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\EventListener\LogoutListener A PiApp\AdminBundle\EventListener\LogoutListener instance.
     */
    protected function getPiAppAdmin_LogoutListenerService()
    {
        return $this->services['pi_app_admin.logout_listener'] = new \PiApp\AdminBundle\EventListener\LogoutListener($this->get('i18n_routing.router'), $this);
    }

    /**
     * Gets the 'pi_app_admin.manager.formbuilder' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Manager\PiFormBuilderManager A PiApp\AdminBundle\Manager\PiFormBuilderManager instance.
     */
    protected function getPiAppAdmin_Manager_FormbuilderService()
    {
        return $this->services['pi_app_admin.manager.formbuilder'] = new \PiApp\AdminBundle\Manager\PiFormBuilderManager($this);
    }

    /**
     * Gets the 'pi_app_admin.manager.jqext' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Manager\PiJqextManager A PiApp\AdminBundle\Manager\PiJqextManager instance.
     */
    protected function getPiAppAdmin_Manager_JqextService()
    {
        return $this->services['pi_app_admin.manager.jqext'] = new \PiApp\AdminBundle\Manager\PiJqextManager($this);
    }

    /**
     * Gets the 'pi_app_admin.manager.listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Manager\PiListenerManager A PiApp\AdminBundle\Manager\PiListenerManager instance.
     */
    protected function getPiAppAdmin_Manager_ListenerService()
    {
        return $this->services['pi_app_admin.manager.listener'] = new \PiApp\AdminBundle\Manager\PiListenerManager($this);
    }

    /**
     * Gets the 'pi_app_admin.manager.page' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Manager\PiPageManager A PiApp\AdminBundle\Manager\PiPageManager instance.
     */
    protected function getPiAppAdmin_Manager_PageService()
    {
        return $this->services['pi_app_admin.manager.page'] = new \PiApp\AdminBundle\Manager\PiPageManager($this);
    }

    /**
     * Gets the 'pi_app_admin.manager.search_lucene' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Manager\PiLuceneManager A PiApp\AdminBundle\Manager\PiLuceneManager instance.
     */
    protected function getPiAppAdmin_Manager_SearchLuceneService()
    {
        return $this->services['pi_app_admin.manager.search_lucene'] = new \PiApp\AdminBundle\Manager\PiLuceneManager($this);
    }

    /**
     * Gets the 'pi_app_admin.manager.slider' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Manager\PiSliderManager A PiApp\AdminBundle\Manager\PiSliderManager instance.
     */
    protected function getPiAppAdmin_Manager_SliderService()
    {
        return $this->services['pi_app_admin.manager.slider'] = new \PiApp\AdminBundle\Manager\PiSliderManager($this);
    }

    /**
     * Gets the 'pi_app_admin.manager.transwidget' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Manager\PiTransWidgetManager A PiApp\AdminBundle\Manager\PiTransWidgetManager instance.
     */
    protected function getPiAppAdmin_Manager_TranswidgetService()
    {
        return $this->services['pi_app_admin.manager.transwidget'] = new \PiApp\AdminBundle\Manager\PiTransWidgetManager($this);
    }

    /**
     * Gets the 'pi_app_admin.manager.tree' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Manager\PiTreeManager A PiApp\AdminBundle\Manager\PiTreeManager instance.
     */
    protected function getPiAppAdmin_Manager_TreeService()
    {
        return $this->services['pi_app_admin.manager.tree'] = new \PiApp\AdminBundle\Manager\PiTreeManager($this);
    }

    /**
     * Gets the 'pi_app_admin.manager.widget' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Manager\PiWidgetManager A PiApp\AdminBundle\Manager\PiWidgetManager instance.
     */
    protected function getPiAppAdmin_Manager_WidgetService()
    {
        return $this->services['pi_app_admin.manager.widget'] = new \PiApp\AdminBundle\Manager\PiWidgetManager($this);
    }

    /**
     * Gets the 'pi_app_admin.postload_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\EventListener\PostLoadListener A PiApp\AdminBundle\EventListener\PostLoadListener instance.
     */
    protected function getPiAppAdmin_PostloadListenerService()
    {
        return $this->services['pi_app_admin.postload_listener'] = new \PiApp\AdminBundle\EventListener\PostLoadListener($this);
    }

    /**
     * Gets the 'pi_app_admin.postpersist_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\EventListener\PostPersistListener A PiApp\AdminBundle\EventListener\PostPersistListener instance.
     */
    protected function getPiAppAdmin_PostpersistListenerService()
    {
        return $this->services['pi_app_admin.postpersist_listener'] = new \PiApp\AdminBundle\EventListener\PostPersistListener($this);
    }

    /**
     * Gets the 'pi_app_admin.postremove_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\EventListener\PostRemoveListener A PiApp\AdminBundle\EventListener\PostRemoveListener instance.
     */
    protected function getPiAppAdmin_PostremoveListenerService()
    {
        return $this->services['pi_app_admin.postremove_listener'] = new \PiApp\AdminBundle\EventListener\PostRemoveListener($this);
    }

    /**
     * Gets the 'pi_app_admin.postupdate_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\EventListener\PostUpdateListener A PiApp\AdminBundle\EventListener\PostUpdateListener instance.
     */
    protected function getPiAppAdmin_PostupdateListenerService()
    {
        return $this->services['pi_app_admin.postupdate_listener'] = new \PiApp\AdminBundle\EventListener\PostUpdateListener($this);
    }

    /**
     * Gets the 'pi_app_admin.prepersist_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\EventListener\PrePersistListener A PiApp\AdminBundle\EventListener\PrePersistListener instance.
     */
    protected function getPiAppAdmin_PrepersistListenerService()
    {
        return $this->services['pi_app_admin.prepersist_listener'] = new \PiApp\AdminBundle\EventListener\PrePersistListener($this);
    }

    /**
     * Gets the 'pi_app_admin.preremove_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\EventListener\PreRemoveListener A PiApp\AdminBundle\EventListener\PreRemoveListener instance.
     */
    protected function getPiAppAdmin_PreremoveListenerService()
    {
        return $this->services['pi_app_admin.preremove_listener'] = new \PiApp\AdminBundle\EventListener\PreRemoveListener($this);
    }

    /**
     * Gets the 'pi_app_admin.preupdate_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\EventListener\PreUpdateListener A PiApp\AdminBundle\EventListener\PreUpdateListener instance.
     */
    protected function getPiAppAdmin_PreupdateListenerService()
    {
        return $this->services['pi_app_admin.preupdate_listener'] = new \PiApp\AdminBundle\EventListener\PreUpdateListener($this);
    }

    /**
     * Gets the 'pi_app_admin.regex_manager' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiRegexManager A PiApp\AdminBundle\Util\PiRegexManager instance.
     */
    protected function getPiAppAdmin_RegexManagerService()
    {
        return $this->services['pi_app_admin.regex_manager'] = new \PiApp\AdminBundle\Util\PiRegexManager($this);
    }

    /**
     * Gets the 'pi_app_admin.repository' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Repository\Repository A PiApp\AdminBundle\Repository\Repository instance.
     */
    protected function getPiAppAdmin_RepositoryService()
    {
        return $this->services['pi_app_admin.repository'] = new \PiApp\AdminBundle\Repository\Repository($this->get('doctrine.orm.default_entity_manager'));
    }

    /**
     * Gets the 'pi_app_admin.schema_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\EventListener\SchemaListener A PiApp\AdminBundle\EventListener\SchemaListener instance.
     */
    protected function getPiAppAdmin_SchemaListenerService()
    {
        return $this->services['pi_app_admin.schema_listener'] = new \PiApp\AdminBundle\EventListener\SchemaListener($this);
    }

    /**
     * Gets the 'pi_app_admin.string_cut_manager' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiStringCutManager A PiApp\AdminBundle\Util\PiStringCutManager instance.
     */
    protected function getPiAppAdmin_StringCutManagerService()
    {
        return $this->services['pi_app_admin.string_cut_manager'] = new \PiApp\AdminBundle\Util\PiStringCutManager();
    }

    /**
     * Gets the 'pi_app_admin.string_manager' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiStringManager A PiApp\AdminBundle\Util\PiStringManager instance.
     */
    protected function getPiAppAdmin_StringManagerService()
    {
        return $this->services['pi_app_admin.string_manager'] = new \PiApp\AdminBundle\Util\PiStringManager();
    }

    /**
     * Gets the 'pi_app_admin.templating' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\TwigBundle\TwigEngine A Symfony\Bundle\TwigBundle\TwigEngine instance.
     */
    protected function getPiAppAdmin_TemplatingService()
    {
        return $this->services['pi_app_admin.templating'] = new \Symfony\Bundle\TwigBundle\TwigEngine($this->get('pi_app_admin.twig'), $this->get('templating.name_parser'), $this->get('templating.globals'));
    }

    /**
     * Gets the 'pi_app_admin.twig' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Twig_Environment A Twig_Environment instance.
     */
    protected function getPiAppAdmin_TwigService()
    {
        $this->services['pi_app_admin.twig'] = $instance = new \Twig_Environment($this->get('pi_app_admin.twig.loader'), array('exception_controller' => 'Symfony\\Bundle\\TwigBundle\\Controller\\ExceptionController::showAction', 'charset' => 'utf-8', 'debug' => true, 'strict_variables' => true, 'auto_reload' => NULL, 'cache' => '/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/dev/twig'));

        $instance->addExtension($this->get('twig.extension.security'));
        $instance->addExtension($this->get('twig.extension.trans'));
        $instance->addExtension($this->get('twig.extension.assets'));
        $instance->addExtension($this->get('twig.extension.actions'));
        $instance->addExtension($this->get('twig.extension.code'));
        $instance->addExtension($this->get('twig.extension.routing'));
        $instance->addExtension($this->get('twig.extension.yaml'));
        $instance->addExtension($this->get('twig.extension.form'));
        $instance->addExtension($this->get('assetic.twig_extension'));
        $instance->addExtension($this->get('sonata.admin.twig.extension'));
        $instance->addExtension($this->get('sonata.block.twig.extension'));
        $instance->addExtension($this->get('sonata.media.twig.extension'));
        $instance->addExtension($this->get('knp_menu.twig.extension'));
        $instance->addExtension($this->get('pi_google.twig.extension.analytics'));
        $instance->addExtension($this->get('pi_facebook.twig.extension.analytics'));
        $instance->addExtension($this->get('twig.extension.text'));
        $instance->addExtension($this->get('twig.extension.intl'));
        $instance->addExtension($this->get('debug.twig.extension'));
        $instance->addExtension($this->get('pi_app_admin.twig.extension.forward'));
        $instance->addExtension($this->get('pi_app_admin.twig.extension.service'));
        $instance->addExtension($this->get('pi_app_admin.twig.extension.jquery'));
        $instance->addExtension($this->get('pi_app_admin.twig.extension.widget'));
        $instance->addExtension($this->get('pi_app_admin.twig.extension.date'));
        $instance->addExtension($this->get('pi_app_admin.twig.extension.tool'));
        $instance->addExtension($this->get('pi_app_admin.twig.extension.route'));
        $instance->addExtension($this->get('pi_app_admin.twig.extension.layouthead'));
        $instance->addExtension($this->get('twig.extension.acme.demo'));

        return $instance;
    }

    /**
     * Gets the 'pi_app_admin.twig.extension.date' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Twig\Extension\PiDateExtension A PiApp\AdminBundle\Twig\Extension\PiDateExtension instance.
     */
    protected function getPiAppAdmin_Twig_Extension_DateService()
    {
        return $this->services['pi_app_admin.twig.extension.date'] = new \PiApp\AdminBundle\Twig\Extension\PiDateExtension($this);
    }

    /**
     * Gets the 'pi_app_admin.twig.extension.forward' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Twig\Extension\PiForwardExtension A PiApp\AdminBundle\Twig\Extension\PiForwardExtension instance.
     */
    protected function getPiAppAdmin_Twig_Extension_ForwardService()
    {
        return $this->services['pi_app_admin.twig.extension.forward'] = new \PiApp\AdminBundle\Twig\Extension\PiForwardExtension($this);
    }

    /**
     * Gets the 'pi_app_admin.twig.extension.jquery' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Twig\Extension\PiJqueryExtension A PiApp\AdminBundle\Twig\Extension\PiJqueryExtension instance.
     */
    protected function getPiAppAdmin_Twig_Extension_JqueryService()
    {
        return $this->services['pi_app_admin.twig.extension.jquery'] = new \PiApp\AdminBundle\Twig\Extension\PiJqueryExtension($this);
    }

    /**
     * Gets the 'pi_app_admin.twig.extension.layouthead' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Twig\Extension\PiLayoutHeadExtension A PiApp\AdminBundle\Twig\Extension\PiLayoutHeadExtension instance.
     */
    protected function getPiAppAdmin_Twig_Extension_LayoutheadService()
    {
        return $this->services['pi_app_admin.twig.extension.layouthead'] = new \PiApp\AdminBundle\Twig\Extension\PiLayoutHeadExtension($this);
    }

    /**
     * Gets the 'pi_app_admin.twig.extension.route' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Twig\Extension\PiRouteExtension A PiApp\AdminBundle\Twig\Extension\PiRouteExtension instance.
     */
    protected function getPiAppAdmin_Twig_Extension_RouteService()
    {
        return $this->services['pi_app_admin.twig.extension.route'] = new \PiApp\AdminBundle\Twig\Extension\PiRouteExtension($this);
    }

    /**
     * Gets the 'pi_app_admin.twig.extension.service' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Twig\Extension\PiServiceExtension A PiApp\AdminBundle\Twig\Extension\PiServiceExtension instance.
     */
    protected function getPiAppAdmin_Twig_Extension_ServiceService()
    {
        return $this->services['pi_app_admin.twig.extension.service'] = new \PiApp\AdminBundle\Twig\Extension\PiServiceExtension($this);
    }

    /**
     * Gets the 'pi_app_admin.twig.extension.tool' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Twig\Extension\PiToolExtension A PiApp\AdminBundle\Twig\Extension\PiToolExtension instance.
     */
    protected function getPiAppAdmin_Twig_Extension_ToolService()
    {
        return $this->services['pi_app_admin.twig.extension.tool'] = new \PiApp\AdminBundle\Twig\Extension\PiToolExtension($this);
    }

    /**
     * Gets the 'pi_app_admin.twig.extension.widget' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Twig\Extension\PiWidgetExtension A PiApp\AdminBundle\Twig\Extension\PiWidgetExtension instance.
     */
    protected function getPiAppAdmin_Twig_Extension_WidgetService()
    {
        return $this->services['pi_app_admin.twig.extension.widget'] = new \PiApp\AdminBundle\Twig\Extension\PiWidgetExtension($this);
    }

    /**
     * Gets the 'pi_app_admin.twig.loader' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Twig\PiTwigLoader A PiApp\AdminBundle\Twig\PiTwigLoader instance.
     */
    protected function getPiAppAdmin_Twig_LoaderService()
    {
        return $this->services['pi_app_admin.twig.loader'] = new \PiApp\AdminBundle\Twig\PiTwigLoader($this->get('pi_app_admin.manager.page'), $this->get('pi_app_admin.manager.widget'), $this->get('pi_app_admin.manager.transwidget'), $this->get('pi_app_admin.manager.tree'), $this->get('pi_app_admin.manager.listener'), $this->get('pi_app_admin.manager.slider'), $this->get('pi_app_admin.manager.jqext'), $this->get('pi_app_admin.manager.search_lucene'), $this->get('twig.loader'));
    }

    /**
     * Gets the 'pi_app_admin.user.login_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\EventListener\LoginListener A PiApp\AdminBundle\EventListener\LoginListener instance.
     */
    protected function getPiAppAdmin_User_LoginListenerService()
    {
        return $this->services['pi_app_admin.user.login_listener'] = new \PiApp\AdminBundle\EventListener\LoginListener($this->get('i18n_routing.router'), $this->get('security.context'), $this->get('event_dispatcher'), $this->get('doctrine'), $this);
    }

    /**
     * Gets the 'pi_app_admin.validator.collectionof' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Validator\Constraints\CollectionOfValidator A PiApp\AdminBundle\Validator\Constraints\CollectionOfValidator instance.
     */
    protected function getPiAppAdmin_Validator_CollectionofService()
    {
        return $this->services['pi_app_admin.validator.collectionof'] = new \PiApp\AdminBundle\Validator\Constraints\CollectionOfValidator();
    }

    /**
     * Gets the 'pi_app_admin.validator.unique' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Validator\Constraints\UniqueValidator A PiApp\AdminBundle\Validator\Constraints\UniqueValidator instance.
     */
    protected function getPiAppAdmin_Validator_UniqueService()
    {
        return $this->services['pi_app_admin.validator.unique'] = new \PiApp\AdminBundle\Validator\Constraints\UniqueValidator($this);
    }

    /**
     * Gets the 'pi_app_admin.widget_manager.content.jqext' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiWidget\PiContentManager A PiApp\AdminBundle\Util\PiWidget\PiContentManager instance.
     */
    protected function getPiAppAdmin_WidgetManager_Content_JqextService()
    {
        return $this->services['pi_app_admin.widget_manager.content.jqext'] = new \PiApp\AdminBundle\Util\PiWidget\PiContentManager($this, 'jqext');
    }

    /**
     * Gets the 'pi_app_admin.widget_manager.content.media' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiWidget\PiContentManager A PiApp\AdminBundle\Util\PiWidget\PiContentManager instance.
     */
    protected function getPiAppAdmin_WidgetManager_Content_MediaService()
    {
        return $this->services['pi_app_admin.widget_manager.content.media'] = new \PiApp\AdminBundle\Util\PiWidget\PiContentManager($this, 'media');
    }

    /**
     * Gets the 'pi_app_admin.widget_manager.content.snippet' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiWidget\PiContentManager A PiApp\AdminBundle\Util\PiWidget\PiContentManager instance.
     */
    protected function getPiAppAdmin_WidgetManager_Content_SnippetService()
    {
        return $this->services['pi_app_admin.widget_manager.content.snippet'] = new \PiApp\AdminBundle\Util\PiWidget\PiContentManager($this, 'snippet');
    }

    /**
     * Gets the 'pi_app_admin.widget_manager.content.text' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiWidget\PiContentManager A PiApp\AdminBundle\Util\PiWidget\PiContentManager instance.
     */
    protected function getPiAppAdmin_WidgetManager_Content_TextService()
    {
        return $this->services['pi_app_admin.widget_manager.content.text'] = new \PiApp\AdminBundle\Util\PiWidget\PiContentManager($this, 'text');
    }

    /**
     * Gets the 'pi_app_admin.widget_manager.gedmo.listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiWidget\PiGedmoManager A PiApp\AdminBundle\Util\PiWidget\PiGedmoManager instance.
     */
    protected function getPiAppAdmin_WidgetManager_Gedmo_ListenerService()
    {
        return $this->services['pi_app_admin.widget_manager.gedmo.listener'] = new \PiApp\AdminBundle\Util\PiWidget\PiGedmoManager($this, 'listener');
    }

    /**
     * Gets the 'pi_app_admin.widget_manager.gedmo.navigation' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiWidget\PiGedmoManager A PiApp\AdminBundle\Util\PiWidget\PiGedmoManager instance.
     */
    protected function getPiAppAdmin_WidgetManager_Gedmo_NavigationService()
    {
        return $this->services['pi_app_admin.widget_manager.gedmo.navigation'] = new \PiApp\AdminBundle\Util\PiWidget\PiGedmoManager($this, 'navigation');
    }

    /**
     * Gets the 'pi_app_admin.widget_manager.gedmo.organigram' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiWidget\PiGedmoManager A PiApp\AdminBundle\Util\PiWidget\PiGedmoManager instance.
     */
    protected function getPiAppAdmin_WidgetManager_Gedmo_OrganigramService()
    {
        return $this->services['pi_app_admin.widget_manager.gedmo.organigram'] = new \PiApp\AdminBundle\Util\PiWidget\PiGedmoManager($this, 'organigram');
    }

    /**
     * Gets the 'pi_app_admin.widget_manager.gedmo.slider' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiWidget\PiGedmoManager A PiApp\AdminBundle\Util\PiWidget\PiGedmoManager instance.
     */
    protected function getPiAppAdmin_WidgetManager_Gedmo_SliderService()
    {
        return $this->services['pi_app_admin.widget_manager.gedmo.slider'] = new \PiApp\AdminBundle\Util\PiWidget\PiGedmoManager($this, 'slider');
    }

    /**
     * Gets the 'pi_app_admin.widget_manager.gedmo.snippet' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiWidget\PiGedmoManager A PiApp\AdminBundle\Util\PiWidget\PiGedmoManager instance.
     */
    protected function getPiAppAdmin_WidgetManager_Gedmo_SnippetService()
    {
        return $this->services['pi_app_admin.widget_manager.gedmo.snippet'] = new \PiApp\AdminBundle\Util\PiWidget\PiGedmoManager($this, 'snippet');
    }

    /**
     * Gets the 'pi_app_admin.widget_manager.search.lucene' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\AdminBundle\Util\PiWidget\PiSearchManager A PiApp\AdminBundle\Util\PiWidget\PiSearchManager instance.
     */
    protected function getPiAppAdmin_WidgetManager_Search_LuceneService()
    {
        return $this->services['pi_app_admin.widget_manager.search.lucene'] = new \PiApp\AdminBundle\Util\PiWidget\PiSearchManager($this, 'lucene');
    }

    /**
     * Gets the 'pi_app_gedmo.repository' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return PiApp\GedmoBundle\Repository\Repository A PiApp\GedmoBundle\Repository\Repository instance.
     */
    protected function getPiAppGedmo_RepositoryService()
    {
        return $this->services['pi_app_gedmo.repository'] = new \PiApp\GedmoBundle\Repository\Repository($this->get('doctrine.orm.default_entity_manager'));
    }

    /**
     * Gets the 'pi_facebook.client.analytics' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return BootStrap\FacebookBundle\Manager\Client\AnalyticsClient A BootStrap\FacebookBundle\Manager\Client\AnalyticsClient instance.
     */
    protected function getPiFacebook_Client_AnalyticsService()
    {
        return $this->services['pi_facebook.client.analytics'] = new \BootStrap\FacebookBundle\Manager\Client\AnalyticsClient($this, 'analytics');
    }

    /**
     * Gets the 'pi_facebook.helper.analytics' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return BootStrap\FacebookBundle\Helper\AnalyticsHelper A BootStrap\FacebookBundle\Helper\AnalyticsHelper instance.
     */
    protected function getPiFacebook_Helper_AnalyticsService()
    {
        return $this->services['pi_facebook.helper.analytics'] = new \BootStrap\FacebookBundle\Helper\AnalyticsHelper($this->get('pi_facebook.client.analytics'));
    }

    /**
     * Gets the 'pi_facebook.twig.extension.analytics' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return BootStrap\FacebookBundle\Extension\AnalyticsExtension A BootStrap\FacebookBundle\Extension\AnalyticsExtension instance.
     */
    protected function getPiFacebook_Twig_Extension_AnalyticsService()
    {
        return $this->services['pi_facebook.twig.extension.analytics'] = new \BootStrap\FacebookBundle\Extension\AnalyticsExtension($this->get('pi_facebook.helper.analytics'));
    }

    /**
     * Gets the 'pi_filecache' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return BootStrap\CacheBundle\Manager\CacheFactory A BootStrap\CacheBundle\Manager\CacheFactory instance.
     */
    protected function getPiFilecacheService()
    {
        $this->services['pi_filecache'] = $instance = new \BootStrap\CacheBundle\Manager\CacheFactory();

        $instance->setContainer($this);
        $instance->setClient($this->get('pi_filecache.client'));

        return $instance;
    }

    /**
     * Gets the 'pi_filecache.client' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return BootStrap\CacheBundle\Manager\Client\FilecacheClient A BootStrap\CacheBundle\Manager\Client\FilecacheClient instance.
     */
    protected function getPiFilecache_ClientService()
    {
        return $this->services['pi_filecache.client'] = new \BootStrap\CacheBundle\Manager\Client\FilecacheClient();
    }

    /**
     * Gets the 'pi_google.client.adwords' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return BootStrap\GoogleBundle\Manager\Client\AdwordsClient A BootStrap\GoogleBundle\Manager\Client\AdwordsClient instance.
     */
    protected function getPiGoogle_Client_AdwordsService()
    {
        return $this->services['pi_google.client.adwords'] = new \BootStrap\GoogleBundle\Manager\Client\AdwordsClient($this, 'adwords');
    }

    /**
     * Gets the 'pi_google.client.analytics' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return BootStrap\GoogleBundle\Manager\Client\AnalyticsClient A BootStrap\GoogleBundle\Manager\Client\AnalyticsClient instance.
     */
    protected function getPiGoogle_Client_AnalyticsService()
    {
        return $this->services['pi_google.client.analytics'] = new \BootStrap\GoogleBundle\Manager\Client\AnalyticsClient($this, 'analytics');
    }

    /**
     * Gets the 'pi_google.client.maps' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return BootStrap\GoogleBundle\Manager\Client\MapsClient A BootStrap\GoogleBundle\Manager\Client\MapsClient instance.
     */
    protected function getPiGoogle_Client_MapsService()
    {
        return $this->services['pi_google.client.maps'] = new \BootStrap\GoogleBundle\Manager\Client\MapsClient($this, 'maps');
    }

    /**
     * Gets the 'pi_google.factory.adwords' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return BootStrap\GoogleBundle\Manager\GoogleFactory A BootStrap\GoogleBundle\Manager\GoogleFactory instance.
     */
    protected function getPiGoogle_Factory_AdwordsService()
    {
        $this->services['pi_google.factory.adwords'] = $instance = new \BootStrap\GoogleBundle\Manager\GoogleFactory($this);

        $instance->setClient($this->get('pi_google.client.adwords'));

        return $instance;
    }

    /**
     * Gets the 'pi_google.factory.analytics' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return BootStrap\GoogleBundle\Manager\GoogleFactory A BootStrap\GoogleBundle\Manager\GoogleFactory instance.
     */
    protected function getPiGoogle_Factory_AnalyticsService()
    {
        $this->services['pi_google.factory.analytics'] = $instance = new \BootStrap\GoogleBundle\Manager\GoogleFactory($this);

        $instance->setClient($this->get('pi_google.client.analytics'));

        return $instance;
    }

    /**
     * Gets the 'pi_google.factory.maps' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return BootStrap\GoogleBundle\Manager\GoogleFactory A BootStrap\GoogleBundle\Manager\GoogleFactory instance.
     */
    protected function getPiGoogle_Factory_MapsService()
    {
        $this->services['pi_google.factory.maps'] = $instance = new \BootStrap\GoogleBundle\Manager\GoogleFactory($this);

        $instance->setClient($this->get('pi_google.client.maps'));

        return $instance;
    }

    /**
     * Gets the 'pi_google.helper.analytics' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return BootStrap\GoogleBundle\Helper\AnalyticsHelper A BootStrap\GoogleBundle\Helper\AnalyticsHelper instance.
     */
    protected function getPiGoogle_Helper_AnalyticsService()
    {
        return $this->services['pi_google.helper.analytics'] = new \BootStrap\GoogleBundle\Helper\AnalyticsHelper($this->get('pi_google.client.analytics'));
    }

    /**
     * Gets the 'pi_google.twig.extension.analytics' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return BootStrap\GoogleBundle\Extension\AnalyticsExtension A BootStrap\GoogleBundle\Extension\AnalyticsExtension instance.
     */
    protected function getPiGoogle_Twig_Extension_AnalyticsService()
    {
        return $this->services['pi_google.twig.extension.analytics'] = new \BootStrap\GoogleBundle\Extension\AnalyticsExtension($this->get('pi_google.helper.analytics'));
    }

    /**
     * Gets the 'pi_memcache' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return BootStrap\CacheBundle\Manager\CacheFactory A BootStrap\CacheBundle\Manager\CacheFactory instance.
     */
    protected function getPiMemcacheService()
    {
        $this->services['pi_memcache'] = $instance = new \BootStrap\CacheBundle\Manager\CacheFactory();

        $instance->setContainer($this);
        $instance->setClient($this->get('pi_memcache.client'));

        return $instance;
    }

    /**
     * Gets the 'pi_memcache.client' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return BootStrap\CacheBundle\Manager\Client\MemcacheClient A BootStrap\CacheBundle\Manager\Client\MemcacheClient instance.
     */
    protected function getPiMemcache_ClientService()
    {
        $this->services['pi_memcache.client'] = $instance = new \BootStrap\CacheBundle\Manager\Client\MemcacheClient($this->get('php_memcache'));

        $instance->addServers(array('127.0.0.1' => 11211));

        return $instance;
    }

    /**
     * Gets the 'profiler' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\HttpKernel\Profiler\Profiler A Symfony\Component\HttpKernel\Profiler\Profiler instance.
     */
    protected function getProfilerService()
    {
        $a = $this->get('monolog.logger.profiler');
        $b = $this->get('kernel');

        $c = new \Symfony\Component\HttpKernel\DataCollector\EventDataCollector();
        $c->setEventDispatcher($this->get('event_dispatcher'));

        $this->services['profiler'] = $instance = new \Symfony\Component\HttpKernel\Profiler\Profiler(new \Symfony\Component\HttpKernel\Profiler\SqliteProfilerStorage('sqlite:/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/dev/profiler.db', '', '', 86400), $a);

        $instance->add(new \Symfony\Component\HttpKernel\DataCollector\ConfigDataCollector($b));
        $instance->add($this->get('data_collector.request'));
        $instance->add(new \Symfony\Component\HttpKernel\DataCollector\ExceptionDataCollector());
        $instance->add($c);
        $instance->add(new \Symfony\Component\HttpKernel\DataCollector\LoggerDataCollector($a));
        $instance->add(new \Symfony\Bundle\FrameworkBundle\DataCollector\TimerDataCollector($b));
        $instance->add(new \Symfony\Component\HttpKernel\DataCollector\MemoryDataCollector());
        $instance->add(new \Symfony\Bundle\SecurityBundle\DataCollector\SecurityDataCollector($this->get('security.context')));
        $instance->add(new \Symfony\Bundle\SwiftmailerBundle\DataCollector\MessageDataCollector($this, false));
        $instance->add(new \Symfony\Bridge\Doctrine\DataCollector\DoctrineDataCollector($this->get('doctrine'), $this->get('doctrine.dbal.logger')));

        return $instance;
    }

    /**
     * Gets the 'profiler_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\HttpKernel\EventListener\ProfilerListener A Symfony\Component\HttpKernel\EventListener\ProfilerListener instance.
     */
    protected function getProfilerListenerService()
    {
        return $this->services['profiler_listener'] = new \Symfony\Component\HttpKernel\EventListener\ProfilerListener($this->get('profiler'), NULL, false, false);
    }

    /**
     * Gets the 'request' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @throws \RuntimeException always since this service is expected to be injected dynamically
     */
    protected function getRequestService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('request', 'request');
        }

        throw new \RuntimeException('You have requested a synthetic service ("request"). The DIC does not know how to construct this service.');
    }

    /**
     * Gets the 'response_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\HttpKernel\EventListener\ResponseListener A Symfony\Component\HttpKernel\EventListener\ResponseListener instance.
     */
    protected function getResponseListenerService()
    {
        return $this->services['response_listener'] = new \Symfony\Component\HttpKernel\EventListener\ResponseListener('UTF-8');
    }

    /**
     * Gets the 'router_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\FrameworkBundle\EventListener\RouterListener A Symfony\Bundle\FrameworkBundle\EventListener\RouterListener instance.
     */
    protected function getRouterListenerService()
    {
        return $this->services['router_listener'] = new \Symfony\Bundle\FrameworkBundle\EventListener\RouterListener($this->get('i18n_routing.router'), 80, 443, $this->get('monolog.logger.request'));
    }

    /**
     * Gets the 'routing.loader' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\FrameworkBundle\Routing\DelegatingLoader A Symfony\Bundle\FrameworkBundle\Routing\DelegatingLoader instance.
     */
    protected function getRouting_LoaderService()
    {
        $a = $this->get('file_locator');
        $b = $this->get('annotation_reader');

        $c = new \Sensio\Bundle\FrameworkExtraBundle\Routing\AnnotatedRouteControllerLoader($b);

        $d = new \Symfony\Component\Config\Loader\LoaderResolver();
        $d->addLoader(new \BeSimple\I18nRoutingBundle\Routing\Loader\XmlFileLoader($a));
        $d->addLoader(new \BeSimple\I18nRoutingBundle\Routing\Loader\YamlFileLoader($a));
        $d->addLoader(new \Symfony\Component\Routing\Loader\PhpFileLoader($a));
        $d->addLoader(new \Symfony\Bundle\AsseticBundle\Routing\AsseticLoader($this->get('assetic.asset_manager')));
        $d->addLoader(new \Symfony\Component\Routing\Loader\AnnotationDirectoryLoader($a, $c));
        $d->addLoader(new \Symfony\Component\Routing\Loader\AnnotationFileLoader($a, $c));
        $d->addLoader($c);
        $d->addLoader($this->get('sonata.admin.route_loader'));
        $d->addLoader($this->get('bootstrap.route_loader'));

        return $this->services['routing.loader'] = new \Symfony\Bundle\FrameworkBundle\Routing\DelegatingLoader($this->get('controller_name_converter'), $this->get('monolog.logger.router'), $d);
    }

    /**
     * Gets the 'security.access.method_interceptor' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return JMS\SecurityExtraBundle\Security\Authorization\Interception\MethodSecurityInterceptor A JMS\SecurityExtraBundle\Security\Authorization\Interception\MethodSecurityInterceptor instance.
     */
    protected function getSecurity_Access_MethodInterceptorService()
    {
        return $this->services['security.access.method_interceptor'] = new \JMS\SecurityExtraBundle\Security\Authorization\Interception\MethodSecurityInterceptor($this->get('security.context'), $this->get('security.authentication.manager'), $this->get('security.access.decision_manager'), new \JMS\SecurityExtraBundle\Security\Authorization\AfterInvocation\AfterInvocationManager(array(0 => new \JMS\SecurityExtraBundle\Security\Authorization\AfterInvocation\AclAfterInvocationProvider($this->get('security.acl.provider'), $this->get('security.acl.object_identity_retrieval_strategy'), $this->get('security.acl.security_identity_retrieval_strategy'), $this->get('security.acl.permission.map')))), new \JMS\SecurityExtraBundle\Security\Authorization\RunAsManager('RunAsToken', 'ROLE_'), $this->get('logger'));
    }

    /**
     * Gets the 'security.acl.provider' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Security\Acl\Dbal\MutableAclProvider A Symfony\Component\Security\Acl\Dbal\MutableAclProvider instance.
     */
    protected function getSecurity_Acl_ProviderService()
    {
        return $this->services['security.acl.provider'] = new \Symfony\Component\Security\Acl\Dbal\MutableAclProvider($this->get('doctrine.dbal.default_connection'), new \Symfony\Component\Security\Acl\Domain\PermissionGrantingStrategy(), array('class_table_name' => 'acl_classes', 'entry_table_name' => 'acl_entries', 'oid_table_name' => 'acl_object_identities', 'oid_ancestors_table_name' => 'acl_object_identity_ancestors', 'sid_table_name' => 'acl_security_identities'), NULL);
    }

    /**
     * Gets the 'security.context' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Security\Core\SecurityContext A Symfony\Component\Security\Core\SecurityContext instance.
     */
    protected function getSecurity_ContextService()
    {
        return $this->services['security.context'] = new \Symfony\Component\Security\Core\SecurityContext($this->get('security.authentication.manager'), $this->get('security.access.decision_manager'), false);
    }

    /**
     * Gets the 'security.encoder_factory' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Security\Core\Encoder\EncoderFactory A Symfony\Component\Security\Core\Encoder\EncoderFactory instance.
     */
    protected function getSecurity_EncoderFactoryService()
    {
        return $this->services['security.encoder_factory'] = new \Symfony\Component\Security\Core\Encoder\EncoderFactory(array('BootStrap\\UserBundle\\Entity\\User' => array('class' => 'Symfony\\Component\\Security\\Core\\Encoder\\MessageDigestPasswordEncoder', 'arguments' => array(0 => 'sha512', 1 => true, 2 => 5000))));
    }

    /**
     * Gets the 'security.extra.controller_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return JMS\SecurityExtraBundle\Controller\ControllerListener A JMS\SecurityExtraBundle\Controller\ControllerListener instance.
     */
    protected function getSecurity_Extra_ControllerListenerService()
    {
        return $this->services['security.extra.controller_listener'] = new \JMS\SecurityExtraBundle\Controller\ControllerListener($this, $this->get('annotation_reader'));
    }

    /**
     * Gets the 'security.firewall' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Security\Http\Firewall A Symfony\Component\Security\Http\Firewall instance.
     */
    protected function getSecurity_FirewallService()
    {
        return $this->services['security.firewall'] = new \Symfony\Component\Security\Http\Firewall(new \Symfony\Bundle\SecurityBundle\Security\FirewallMap($this, array('security.firewall.map.context.main' => new \Symfony\Component\HttpFoundation\RequestMatcher('.*'), 'security.firewall.map.context.dev' => new \Symfony\Component\HttpFoundation\RequestMatcher('^/(_(profiler|wdt)|css|images|js)/'), 'security.firewall.map.context.login' => new \Symfony\Component\HttpFoundation\RequestMatcher('^/demo/secured/login$'), 'security.firewall.map.context.secured_area' => new \Symfony\Component\HttpFoundation\RequestMatcher('^/demo/secured/'))), $this->get('event_dispatcher'));
    }

    /**
     * Gets the 'security.firewall.map.context.dev' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\SecurityBundle\Security\FirewallContext A Symfony\Bundle\SecurityBundle\Security\FirewallContext instance.
     */
    protected function getSecurity_Firewall_Map_Context_DevService()
    {
        return $this->services['security.firewall.map.context.dev'] = new \Symfony\Bundle\SecurityBundle\Security\FirewallContext(array(), NULL);
    }

    /**
     * Gets the 'security.firewall.map.context.login' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\SecurityBundle\Security\FirewallContext A Symfony\Bundle\SecurityBundle\Security\FirewallContext instance.
     */
    protected function getSecurity_Firewall_Map_Context_LoginService()
    {
        return $this->services['security.firewall.map.context.login'] = new \Symfony\Bundle\SecurityBundle\Security\FirewallContext(array(), NULL);
    }

    /**
     * Gets the 'security.firewall.map.context.main' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\SecurityBundle\Security\FirewallContext A Symfony\Bundle\SecurityBundle\Security\FirewallContext instance.
     */
    protected function getSecurity_Firewall_Map_Context_MainService()
    {
        $a = $this->get('security.context');
        $b = $this->get('fos_user.user_manager');
        $c = $this->get('monolog.logger.security');
        $d = $this->get('event_dispatcher');
        $e = $this->get('security.http_utils');
        $f = $this->get('security.authentication.manager');

        $g = new \Symfony\Component\Security\Http\RememberMe\TokenBasedRememberMeServices(array(0 => $b), '5b5a0ff57bd45284dafe7f104fc7d8e15', 'main', array('name' => 'REMEMBERME', 'lifetime' => 31536000, 'path' => '/', 'domain' => NULL, 'secure' => false, 'httponly' => true, 'always_remember_me' => false, 'remember_me_parameter' => '_remember_me'), $c);

        $h = new \Symfony\Component\Security\Http\Firewall\LogoutListener($a, $e, '/logout', '/', NULL);
        $h->addHandler($this->get('security.logout.handler.session'));
        $h->addHandler($g);

        $i = new \Symfony\Component\Security\Http\Firewall\UsernamePasswordFormAuthenticationListener($a, $f, $this->get('security.authentication.session_strategy'), $e, 'main', array('check_path' => '/login_check', 'login_path' => '/login', 'use_forward' => false, 'failure_path' => NULL, 'always_use_default_target_path' => false, 'default_target_path' => '/', 'target_path_parameter' => '_target_path', 'use_referer' => false, 'failure_forward' => false, 'username_parameter' => '_username', 'password_parameter' => '_password', 'csrf_parameter' => '_csrf_token', 'intention' => 'authenticate', 'post_only' => true), NULL, NULL, $c, $d);
        $i->setRememberMeServices($g);

        return $this->services['security.firewall.map.context.main'] = new \Symfony\Bundle\SecurityBundle\Security\FirewallContext(array(0 => $this->get('security.channel_listener'), 1 => new \Symfony\Component\Security\Http\Firewall\ContextListener($a, array(0 => $this->get('security.user.provider.concrete.in_memory'), 1 => $b), 'main', $c, $d), 2 => $h, 3 => $i, 4 => new \Symfony\Component\Security\Http\Firewall\RememberMeListener($a, $g, $f, $c, $d), 5 => new \Symfony\Component\Security\Http\Firewall\AnonymousAuthenticationListener($a, '508ac52290a86', $c), 6 => $this->get('security.access_listener')), new \Symfony\Component\Security\Http\Firewall\ExceptionListener($a, $this->get('security.authentication.trust_resolver'), $e, new \Symfony\Component\Security\Http\EntryPoint\FormAuthenticationEntryPoint($this->get('http_kernel'), $e, '/login', false), '/unauthorized', NULL, $c));
    }

    /**
     * Gets the 'security.firewall.map.context.secured_area' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\SecurityBundle\Security\FirewallContext A Symfony\Bundle\SecurityBundle\Security\FirewallContext instance.
     */
    protected function getSecurity_Firewall_Map_Context_SecuredAreaService()
    {
        $a = $this->get('security.context');
        $b = $this->get('monolog.logger.security');
        $c = $this->get('event_dispatcher');
        $d = $this->get('security.http_utils');

        $e = new \Symfony\Component\Security\Http\Firewall\LogoutListener($a, $d, '/demo/secured/logout', '/demo/', NULL);
        $e->addHandler($this->get('security.logout.handler.session'));

        return $this->services['security.firewall.map.context.secured_area'] = new \Symfony\Bundle\SecurityBundle\Security\FirewallContext(array(0 => $this->get('security.channel_listener'), 1 => new \Symfony\Component\Security\Http\Firewall\ContextListener($a, array(0 => $this->get('security.user.provider.concrete.in_memory'), 1 => $this->get('fos_user.user_manager')), 'secured_area', $b, $c), 2 => $e, 3 => new \Symfony\Component\Security\Http\Firewall\UsernamePasswordFormAuthenticationListener($a, $this->get('security.authentication.manager'), $this->get('security.authentication.session_strategy'), $d, 'secured_area', array('check_path' => '/demo/secured/login_check', 'login_path' => '/demo/secured/login', 'use_forward' => false, 'always_use_default_target_path' => false, 'default_target_path' => '/', 'target_path_parameter' => '_target_path', 'use_referer' => false, 'failure_path' => NULL, 'failure_forward' => false, 'username_parameter' => '_username', 'password_parameter' => '_password', 'csrf_parameter' => '_csrf_token', 'intention' => 'authenticate', 'post_only' => true), NULL, NULL, $b, $c), 4 => $this->get('security.access_listener')), new \Symfony\Component\Security\Http\Firewall\ExceptionListener($a, $this->get('security.authentication.trust_resolver'), $d, new \Symfony\Component\Security\Http\EntryPoint\FormAuthenticationEntryPoint($this->get('http_kernel'), $d, '/demo/secured/login', false), '/unauthorized', NULL, $b));
    }

    /**
     * Gets the 'security.rememberme.response_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\SecurityBundle\EventListener\ResponseListener A Symfony\Bundle\SecurityBundle\EventListener\ResponseListener instance.
     */
    protected function getSecurity_Rememberme_ResponseListenerService()
    {
        return $this->services['security.rememberme.response_listener'] = new \Symfony\Bundle\SecurityBundle\EventListener\ResponseListener();
    }

    /**
     * Gets the 'sensio.distribution.webconfigurator' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sensio\Bundle\DistributionBundle\Configurator\Configurator A Sensio\Bundle\DistributionBundle\Configurator\Configurator instance.
     */
    protected function getSensio_Distribution_WebconfiguratorService()
    {
        return $this->services['sensio.distribution.webconfigurator'] = new \Sensio\Bundle\DistributionBundle\Configurator\Configurator('/Users/guillaumemigeon/Sites/orchestra-cmf/app');
    }

    /**
     * Gets the 'sensio_framework_extra.cache.listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sensio\Bundle\FrameworkExtraBundle\EventListener\CacheListener A Sensio\Bundle\FrameworkExtraBundle\EventListener\CacheListener instance.
     */
    protected function getSensioFrameworkExtra_Cache_ListenerService()
    {
        return $this->services['sensio_framework_extra.cache.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\CacheListener();
    }

    /**
     * Gets the 'sensio_framework_extra.controller.listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return JMS\DiExtraBundle\EventListener\ControllerListener A JMS\DiExtraBundle\EventListener\ControllerListener instance.
     */
    protected function getSensioFrameworkExtra_Controller_ListenerService()
    {
        return $this->services['sensio_framework_extra.controller.listener'] = new \JMS\DiExtraBundle\EventListener\ControllerListener($this->get('annotation_reader'));
    }

    /**
     * Gets the 'sensio_framework_extra.converter.doctrine.orm' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\DoctrineParamConverter A Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\DoctrineParamConverter instance.
     */
    protected function getSensioFrameworkExtra_Converter_Doctrine_OrmService()
    {
        return $this->services['sensio_framework_extra.converter.doctrine.orm'] = new \Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\DoctrineParamConverter($this->get('doctrine'));
    }

    /**
     * Gets the 'sensio_framework_extra.converter.listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sensio\Bundle\FrameworkExtraBundle\EventListener\ParamConverterListener A Sensio\Bundle\FrameworkExtraBundle\EventListener\ParamConverterListener instance.
     */
    protected function getSensioFrameworkExtra_Converter_ListenerService()
    {
        return $this->services['sensio_framework_extra.converter.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\ParamConverterListener($this->get('sensio_framework_extra.converter.manager'));
    }

    /**
     * Gets the 'sensio_framework_extra.converter.manager' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterManager A Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterManager instance.
     */
    protected function getSensioFrameworkExtra_Converter_ManagerService()
    {
        $this->services['sensio_framework_extra.converter.manager'] = $instance = new \Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterManager();

        $instance->add($this->get('sensio_framework_extra.converter.doctrine.orm'), 0);

        return $instance;
    }

    /**
     * Gets the 'sensio_framework_extra.view.listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return JMS\DiExtraBundle\EventListener\TemplateListener A JMS\DiExtraBundle\EventListener\TemplateListener instance.
     */
    protected function getSensioFrameworkExtra_View_ListenerService()
    {
        return $this->services['sensio_framework_extra.view.listener'] = new \JMS\DiExtraBundle\EventListener\TemplateListener($this);
    }

    /**
     * Gets the 'service_container' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @throws \RuntimeException always since this service is expected to be injected dynamically
     */
    protected function getServiceContainerService()
    {
        throw new \RuntimeException('You have requested a synthetic service ("service_container"). The DIC does not know how to construct this service.');
    }

    /**
     * Gets the 'session' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\HttpFoundation\Session A Symfony\Component\HttpFoundation\Session instance.
     */
    protected function getSessionService()
    {
        return $this->services['session'] = new \Symfony\Component\HttpFoundation\Session($this->get('session.storage'), 'en_GB');
    }

    /**
     * Gets the 'session.storage' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\HttpFoundation\SessionStorage\NativeSessionStorage A Symfony\Component\HttpFoundation\SessionStorage\NativeSessionStorage instance.
     */
    protected function getSession_StorageService()
    {
        return $this->services['session.storage'] = new \Symfony\Component\HttpFoundation\SessionStorage\NativeSessionStorage(array());
    }

    /**
     * Gets the 'session_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\FrameworkBundle\EventListener\SessionListener A Symfony\Bundle\FrameworkBundle\EventListener\SessionListener instance.
     */
    protected function getSessionListenerService()
    {
        return $this->services['session_listener'] = new \Symfony\Bundle\FrameworkBundle\EventListener\SessionListener($this, true);
    }

    /**
     * Gets the 'sonata.admin.audit.manager' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Model\AuditManager A Sonata\AdminBundle\Model\AuditManager instance.
     */
    protected function getSonata_Admin_Audit_ManagerService()
    {
        return $this->services['sonata.admin.audit.manager'] = new \Sonata\AdminBundle\Model\AuditManager($this);
    }

    /**
     * Gets the 'sonata.admin.audit.orm.reader' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\DoctrineORMAdminBundle\Model\AuditReader A Sonata\DoctrineORMAdminBundle\Model\AuditReader instance.
     */
    protected function getSonata_Admin_Audit_Orm_ReaderService()
    {
        return $this->services['sonata.admin.audit.orm.reader'] = new \Sonata\DoctrineORMAdminBundle\Model\AuditReader(NULL);
    }

    /**
     * Gets the 'sonata.admin.block.admin_list' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Block\AdminListBlockService A Sonata\AdminBundle\Block\AdminListBlockService instance.
     */
    protected function getSonata_Admin_Block_AdminListService()
    {
        return $this->services['sonata.admin.block.admin_list'] = new \Sonata\AdminBundle\Block\AdminListBlockService('sonata.admin.block.admin_list', $this->get('templating'), $this->get('sonata.admin.pool'));
    }

    /**
     * Gets the 'sonata.admin.builder.filter.factory' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Filter\FilterFactory A Sonata\AdminBundle\Filter\FilterFactory instance.
     */
    protected function getSonata_Admin_Builder_Filter_FactoryService()
    {
        return $this->services['sonata.admin.builder.filter.factory'] = new \Sonata\AdminBundle\Filter\FilterFactory($this, array('doctrine_orm_boolean' => 'sonata.admin.orm.filter.type.boolean', 'doctrine_orm_callback' => 'sonata.admin.orm.filter.type.callback', 'doctrine_orm_choice' => 'sonata.admin.orm.filter.type.choice', 'doctrine_orm_model' => 'sonata.admin.orm.filter.type.model', 'doctrine_orm_string' => 'sonata.admin.orm.filter.type.string', 'doctrine_orm_number' => 'sonata.admin.orm.filter.type.number'));
    }

    /**
     * Gets the 'sonata.admin.builder.orm_datagrid' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\DoctrineORMAdminBundle\Builder\DatagridBuilder A Sonata\DoctrineORMAdminBundle\Builder\DatagridBuilder instance.
     */
    protected function getSonata_Admin_Builder_OrmDatagridService()
    {
        return $this->services['sonata.admin.builder.orm_datagrid'] = new \Sonata\DoctrineORMAdminBundle\Builder\DatagridBuilder($this->get('form.factory'), $this->get('sonata.admin.builder.filter.factory'), $this->get('sonata.admin.guesser.orm_datagrid_chain'));
    }

    /**
     * Gets the 'sonata.admin.builder.orm_form' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\DoctrineORMAdminBundle\Builder\FormContractor A Sonata\DoctrineORMAdminBundle\Builder\FormContractor instance.
     */
    protected function getSonata_Admin_Builder_OrmFormService()
    {
        return $this->services['sonata.admin.builder.orm_form'] = new \Sonata\DoctrineORMAdminBundle\Builder\FormContractor($this->get('form.factory'));
    }

    /**
     * Gets the 'sonata.admin.builder.orm_list' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\DoctrineORMAdminBundle\Builder\ListBuilder A Sonata\DoctrineORMAdminBundle\Builder\ListBuilder instance.
     */
    protected function getSonata_Admin_Builder_OrmListService()
    {
        return $this->services['sonata.admin.builder.orm_list'] = new \Sonata\DoctrineORMAdminBundle\Builder\ListBuilder($this->get('sonata.admin.guesser.orm_list_chain'), array('array' => 'SonataAdminBundle:CRUD:list_array.html.twig', 'boolean' => 'SonataAdminBundle:CRUD:list_boolean.html.twig', 'date' => 'SonataAdminBundle:CRUD:list_date.html.twig', 'time' => 'SonataAdminBundle:CRUD:list_time.html.twig', 'datetime' => 'SonataAdminBundle:CRUD:list_datetime.html.twig', 'text' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'trans' => 'SonataAdminBundle:CRUD:list_trans.html.twig', 'string' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'smallint' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'bigint' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'integer' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'decimal' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'identifier' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'currency' => 'SonataAdminBundle:CRUD:list_currency.html.twig', 'percent' => 'SonataAdminBundle:CRUD:list_percent.html.twig'));
    }

    /**
     * Gets the 'sonata.admin.builder.orm_show' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\DoctrineORMAdminBundle\Builder\ShowBuilder A Sonata\DoctrineORMAdminBundle\Builder\ShowBuilder instance.
     */
    protected function getSonata_Admin_Builder_OrmShowService()
    {
        return $this->services['sonata.admin.builder.orm_show'] = new \Sonata\DoctrineORMAdminBundle\Builder\ShowBuilder($this->get('sonata.admin.guesser.orm_show_chain'), array('array' => 'SonataAdminBundle:CRUD:show_array.html.twig', 'boolean' => 'SonataAdminBundle:CRUD:show_boolean.html.twig', 'date' => 'SonataAdminBundle:CRUD:show_date.html.twig', 'time' => 'SonataAdminBundle:CRUD:show_time.html.twig', 'datetime' => 'SonataAdminBundle:CRUD:show_datetime.html.twig', 'text' => 'SonataAdminBundle:CRUD:base_show_field.html.twig', 'trans' => 'SonataAdminBundle:CRUD:show_trans.html.twig', 'string' => 'SonataAdminBundle:CRUD:base_show_field.html.twig', 'smallint' => 'SonataAdminBundle:CRUD:base_show_field.html.twig', 'bigint' => 'SonataAdminBundle:CRUD:base_show_field.html.twig', 'integer' => 'SonataAdminBundle:CRUD:base_show_field.html.twig', 'decimal' => 'SonataAdminBundle:CRUD:base_show_field.html.twig', 'currency' => 'SonataAdminBundle:CRUD:base_currency.html.twig', 'percent' => 'SonataAdminBundle:CRUD:base_percent.html.twig'));
    }

    /**
     * Gets the 'sonata.admin.controller.admin' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Controller\HelperController A Sonata\AdminBundle\Controller\HelperController instance.
     */
    protected function getSonata_Admin_Controller_AdminService()
    {
        return $this->services['sonata.admin.controller.admin'] = new \Sonata\AdminBundle\Controller\HelperController($this->get('twig'), $this->get('sonata.admin.pool'), $this->get('sonata.admin.helper'));
    }

    /**
     * Gets the 'sonata.admin.exporter' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Export\Exporter A Sonata\AdminBundle\Export\Exporter instance.
     */
    protected function getSonata_Admin_ExporterService()
    {
        return $this->services['sonata.admin.exporter'] = new \Sonata\AdminBundle\Export\Exporter();
    }

    /**
     * Gets the 'sonata.admin.form.extension.field' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Form\Extension\Field\Type\FormTypeFieldExtension A Sonata\AdminBundle\Form\Extension\Field\Type\FormTypeFieldExtension instance.
     */
    protected function getSonata_Admin_Form_Extension_FieldService()
    {
        return $this->services['sonata.admin.form.extension.field'] = new \Sonata\AdminBundle\Form\Extension\Field\Type\FormTypeFieldExtension(array('email' => 'sonata-medium', 'textarea' => 'sonata-medium', 'text' => 'sonata-medium', 'choice' => 'sonata-medium', 'integer' => 'sonata-medium', 'datetime' => 'sonata-medium-date', 'date' => 'sonata-medium-date'));
    }

    /**
     * Gets the 'sonata.admin.form.filter.type.choice' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Form\Type\Filter\ChoiceType A Sonata\AdminBundle\Form\Type\Filter\ChoiceType instance.
     */
    protected function getSonata_Admin_Form_Filter_Type_ChoiceService()
    {
        return $this->services['sonata.admin.form.filter.type.choice'] = new \Sonata\AdminBundle\Form\Type\Filter\ChoiceType($this->get('translator.default'));
    }

    /**
     * Gets the 'sonata.admin.form.filter.type.date' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Form\Type\Filter\DateType A Sonata\AdminBundle\Form\Type\Filter\DateType instance.
     */
    protected function getSonata_Admin_Form_Filter_Type_DateService()
    {
        return $this->services['sonata.admin.form.filter.type.date'] = new \Sonata\AdminBundle\Form\Type\Filter\DateType($this->get('translator.default'));
    }

    /**
     * Gets the 'sonata.admin.form.filter.type.daterange' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Form\Type\Filter\DateRangeType A Sonata\AdminBundle\Form\Type\Filter\DateRangeType instance.
     */
    protected function getSonata_Admin_Form_Filter_Type_DaterangeService()
    {
        return $this->services['sonata.admin.form.filter.type.daterange'] = new \Sonata\AdminBundle\Form\Type\Filter\DateRangeType($this->get('translator.default'));
    }

    /**
     * Gets the 'sonata.admin.form.filter.type.datetime' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Form\Type\Filter\DateTimeType A Sonata\AdminBundle\Form\Type\Filter\DateTimeType instance.
     */
    protected function getSonata_Admin_Form_Filter_Type_DatetimeService()
    {
        return $this->services['sonata.admin.form.filter.type.datetime'] = new \Sonata\AdminBundle\Form\Type\Filter\DateTimeType($this->get('translator.default'));
    }

    /**
     * Gets the 'sonata.admin.form.filter.type.datetime_range' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Form\Type\Filter\DateTimeRangeType A Sonata\AdminBundle\Form\Type\Filter\DateTimeRangeType instance.
     */
    protected function getSonata_Admin_Form_Filter_Type_DatetimeRangeService()
    {
        return $this->services['sonata.admin.form.filter.type.datetime_range'] = new \Sonata\AdminBundle\Form\Type\Filter\DateTimeRangeType($this->get('translator.default'));
    }

    /**
     * Gets the 'sonata.admin.form.filter.type.default' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Form\Type\Filter\DefaultType A Sonata\AdminBundle\Form\Type\Filter\DefaultType instance.
     */
    protected function getSonata_Admin_Form_Filter_Type_DefaultService()
    {
        return $this->services['sonata.admin.form.filter.type.default'] = new \Sonata\AdminBundle\Form\Type\Filter\DefaultType();
    }

    /**
     * Gets the 'sonata.admin.form.filter.type.number' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Form\Type\Filter\NumberType A Sonata\AdminBundle\Form\Type\Filter\NumberType instance.
     */
    protected function getSonata_Admin_Form_Filter_Type_NumberService()
    {
        return $this->services['sonata.admin.form.filter.type.number'] = new \Sonata\AdminBundle\Form\Type\Filter\NumberType($this->get('translator.default'));
    }

    /**
     * Gets the 'sonata.admin.form.type.admin' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Form\Type\AdminType A Sonata\AdminBundle\Form\Type\AdminType instance.
     */
    protected function getSonata_Admin_Form_Type_AdminService()
    {
        return $this->services['sonata.admin.form.type.admin'] = new \Sonata\AdminBundle\Form\Type\AdminType();
    }

    /**
     * Gets the 'sonata.admin.form.type.array' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Form\Type\ImmutableArrayType A Sonata\AdminBundle\Form\Type\ImmutableArrayType instance.
     */
    protected function getSonata_Admin_Form_Type_ArrayService()
    {
        return $this->services['sonata.admin.form.type.array'] = new \Sonata\AdminBundle\Form\Type\ImmutableArrayType();
    }

    /**
     * Gets the 'sonata.admin.form.type.boolean' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Form\Type\BooleanType A Sonata\AdminBundle\Form\Type\BooleanType instance.
     */
    protected function getSonata_Admin_Form_Type_BooleanService()
    {
        return $this->services['sonata.admin.form.type.boolean'] = new \Sonata\AdminBundle\Form\Type\BooleanType($this->get('translator.default'));
    }

    /**
     * Gets the 'sonata.admin.form.type.collection' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Form\Type\CollectionType A Sonata\AdminBundle\Form\Type\CollectionType instance.
     */
    protected function getSonata_Admin_Form_Type_CollectionService()
    {
        return $this->services['sonata.admin.form.type.collection'] = new \Sonata\AdminBundle\Form\Type\CollectionType();
    }

    /**
     * Gets the 'sonata.admin.form.type.date_range' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Form\Type\DateRangeType A Sonata\AdminBundle\Form\Type\DateRangeType instance.
     */
    protected function getSonata_Admin_Form_Type_DateRangeService()
    {
        return $this->services['sonata.admin.form.type.date_range'] = new \Sonata\AdminBundle\Form\Type\DateRangeType($this->get('translator.default'));
    }

    /**
     * Gets the 'sonata.admin.form.type.datetime_range' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Form\Type\DateTimeRangeType A Sonata\AdminBundle\Form\Type\DateTimeRangeType instance.
     */
    protected function getSonata_Admin_Form_Type_DatetimeRangeService()
    {
        return $this->services['sonata.admin.form.type.datetime_range'] = new \Sonata\AdminBundle\Form\Type\DateTimeRangeType($this->get('translator.default'));
    }

    /**
     * Gets the 'sonata.admin.form.type.model' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Form\Type\ModelType A Sonata\AdminBundle\Form\Type\ModelType instance.
     */
    protected function getSonata_Admin_Form_Type_ModelService()
    {
        return $this->services['sonata.admin.form.type.model'] = new \Sonata\AdminBundle\Form\Type\ModelType();
    }

    /**
     * Gets the 'sonata.admin.form.type.model_reference' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Form\Type\ModelReferenceType A Sonata\AdminBundle\Form\Type\ModelReferenceType instance.
     */
    protected function getSonata_Admin_Form_Type_ModelReferenceService()
    {
        return $this->services['sonata.admin.form.type.model_reference'] = new \Sonata\AdminBundle\Form\Type\ModelReferenceType();
    }

    /**
     * Gets the 'sonata.admin.form.type.translatable_choice' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Form\Type\TranslatableChoiceType A Sonata\AdminBundle\Form\Type\TranslatableChoiceType instance.
     */
    protected function getSonata_Admin_Form_Type_TranslatableChoiceService()
    {
        return $this->services['sonata.admin.form.type.translatable_choice'] = new \Sonata\AdminBundle\Form\Type\TranslatableChoiceType($this->get('translator.default'));
    }

    /**
     * Gets the 'sonata.admin.guesser.orm_datagrid' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\DoctrineORMAdminBundle\Guesser\FilterTypeGuesser A Sonata\DoctrineORMAdminBundle\Guesser\FilterTypeGuesser instance.
     */
    protected function getSonata_Admin_Guesser_OrmDatagridService()
    {
        return $this->services['sonata.admin.guesser.orm_datagrid'] = new \Sonata\DoctrineORMAdminBundle\Guesser\FilterTypeGuesser($this->get('doctrine'));
    }

    /**
     * Gets the 'sonata.admin.guesser.orm_datagrid_chain' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Guesser\TypeGuesserChain A Sonata\AdminBundle\Guesser\TypeGuesserChain instance.
     */
    protected function getSonata_Admin_Guesser_OrmDatagridChainService()
    {
        return $this->services['sonata.admin.guesser.orm_datagrid_chain'] = new \Sonata\AdminBundle\Guesser\TypeGuesserChain(array(0 => $this->get('sonata.admin.guesser.orm_datagrid')));
    }

    /**
     * Gets the 'sonata.admin.guesser.orm_list' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\DoctrineORMAdminBundle\Guesser\TypeGuesser A Sonata\DoctrineORMAdminBundle\Guesser\TypeGuesser instance.
     */
    protected function getSonata_Admin_Guesser_OrmListService()
    {
        return $this->services['sonata.admin.guesser.orm_list'] = new \Sonata\DoctrineORMAdminBundle\Guesser\TypeGuesser($this->get('doctrine'));
    }

    /**
     * Gets the 'sonata.admin.guesser.orm_list_chain' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Guesser\TypeGuesserChain A Sonata\AdminBundle\Guesser\TypeGuesserChain instance.
     */
    protected function getSonata_Admin_Guesser_OrmListChainService()
    {
        return $this->services['sonata.admin.guesser.orm_list_chain'] = new \Sonata\AdminBundle\Guesser\TypeGuesserChain(array(0 => $this->get('sonata.admin.guesser.orm_list')));
    }

    /**
     * Gets the 'sonata.admin.guesser.orm_show' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\DoctrineORMAdminBundle\Guesser\TypeGuesser A Sonata\DoctrineORMAdminBundle\Guesser\TypeGuesser instance.
     */
    protected function getSonata_Admin_Guesser_OrmShowService()
    {
        return $this->services['sonata.admin.guesser.orm_show'] = new \Sonata\DoctrineORMAdminBundle\Guesser\TypeGuesser($this->get('doctrine'));
    }

    /**
     * Gets the 'sonata.admin.guesser.orm_show_chain' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Guesser\TypeGuesserChain A Sonata\AdminBundle\Guesser\TypeGuesserChain instance.
     */
    protected function getSonata_Admin_Guesser_OrmShowChainService()
    {
        return $this->services['sonata.admin.guesser.orm_show_chain'] = new \Sonata\AdminBundle\Guesser\TypeGuesserChain(array(0 => $this->get('sonata.admin.guesser.orm_show')));
    }

    /**
     * Gets the 'sonata.admin.helper' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Admin\AdminHelper A Sonata\AdminBundle\Admin\AdminHelper instance.
     */
    protected function getSonata_Admin_HelperService()
    {
        return $this->services['sonata.admin.helper'] = new \Sonata\AdminBundle\Admin\AdminHelper($this->get('sonata.admin.pool'));
    }

    /**
     * Gets the 'sonata.admin.label.strategy.bc' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Translator\BCLabelTranslatorStrategy A Sonata\AdminBundle\Translator\BCLabelTranslatorStrategy instance.
     */
    protected function getSonata_Admin_Label_Strategy_BcService()
    {
        return $this->services['sonata.admin.label.strategy.bc'] = new \Sonata\AdminBundle\Translator\BCLabelTranslatorStrategy();
    }

    /**
     * Gets the 'sonata.admin.label.strategy.form_component' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Translator\FormLabelTranslatorStrategy A Sonata\AdminBundle\Translator\FormLabelTranslatorStrategy instance.
     */
    protected function getSonata_Admin_Label_Strategy_FormComponentService()
    {
        return $this->services['sonata.admin.label.strategy.form_component'] = new \Sonata\AdminBundle\Translator\FormLabelTranslatorStrategy();
    }

    /**
     * Gets the 'sonata.admin.label.strategy.native' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Translator\NativeLabelTranslatorStrategy A Sonata\AdminBundle\Translator\NativeLabelTranslatorStrategy instance.
     */
    protected function getSonata_Admin_Label_Strategy_NativeService()
    {
        return $this->services['sonata.admin.label.strategy.native'] = new \Sonata\AdminBundle\Translator\NativeLabelTranslatorStrategy();
    }

    /**
     * Gets the 'sonata.admin.label.strategy.noop' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Translator\NoopLabelTranslatorStrategy A Sonata\AdminBundle\Translator\NoopLabelTranslatorStrategy instance.
     */
    protected function getSonata_Admin_Label_Strategy_NoopService()
    {
        return $this->services['sonata.admin.label.strategy.noop'] = new \Sonata\AdminBundle\Translator\NoopLabelTranslatorStrategy();
    }

    /**
     * Gets the 'sonata.admin.label.strategy.underscore' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Translator\UnderscoreLabelTranslatorStrategy A Sonata\AdminBundle\Translator\UnderscoreLabelTranslatorStrategy instance.
     */
    protected function getSonata_Admin_Label_Strategy_UnderscoreService()
    {
        return $this->services['sonata.admin.label.strategy.underscore'] = new \Sonata\AdminBundle\Translator\UnderscoreLabelTranslatorStrategy();
    }

    /**
     * Gets the 'sonata.admin.manager.orm' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\DoctrineORMAdminBundle\Model\ModelManager A Sonata\DoctrineORMAdminBundle\Model\ModelManager instance.
     */
    protected function getSonata_Admin_Manager_OrmService()
    {
        return $this->services['sonata.admin.manager.orm'] = new \Sonata\DoctrineORMAdminBundle\Model\ModelManager($this->get('doctrine'));
    }

    /**
     * Gets the 'sonata.admin.manipulator.acl.admin' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Util\AdminAclManipulator A Sonata\AdminBundle\Util\AdminAclManipulator instance.
     */
    protected function getSonata_Admin_Manipulator_Acl_AdminService()
    {
        return $this->services['sonata.admin.manipulator.acl.admin'] = new \Sonata\AdminBundle\Util\AdminAclManipulator('Sonata\\AdminBundle\\Security\\Acl\\Permission\\MaskBuilder');
    }

    /**
     * Gets the 'sonata.admin.manipulator.acl.object.orm' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\DoctrineORMAdminBundle\Util\ObjectAclManipulator A Sonata\DoctrineORMAdminBundle\Util\ObjectAclManipulator instance.
     */
    protected function getSonata_Admin_Manipulator_Acl_Object_OrmService()
    {
        return $this->services['sonata.admin.manipulator.acl.object.orm'] = new \Sonata\DoctrineORMAdminBundle\Util\ObjectAclManipulator();
    }

    /**
     * Gets the 'sonata.admin.orm.filter.type.boolean' service.
     *
     * @return Sonata\DoctrineORMAdminBundle\Filter\BooleanFilter A Sonata\DoctrineORMAdminBundle\Filter\BooleanFilter instance.
     */
    protected function getSonata_Admin_Orm_Filter_Type_BooleanService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\BooleanFilter();
    }

    /**
     * Gets the 'sonata.admin.orm.filter.type.callback' service.
     *
     * @return Sonata\DoctrineORMAdminBundle\Filter\CallbackFilter A Sonata\DoctrineORMAdminBundle\Filter\CallbackFilter instance.
     */
    protected function getSonata_Admin_Orm_Filter_Type_CallbackService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\CallbackFilter();
    }

    /**
     * Gets the 'sonata.admin.orm.filter.type.choice' service.
     *
     * @return Sonata\DoctrineORMAdminBundle\Filter\ChoiceFilter A Sonata\DoctrineORMAdminBundle\Filter\ChoiceFilter instance.
     */
    protected function getSonata_Admin_Orm_Filter_Type_ChoiceService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\ChoiceFilter();
    }

    /**
     * Gets the 'sonata.admin.orm.filter.type.model' service.
     *
     * @return Sonata\DoctrineORMAdminBundle\Filter\ModelFilter A Sonata\DoctrineORMAdminBundle\Filter\ModelFilter instance.
     */
    protected function getSonata_Admin_Orm_Filter_Type_ModelService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\ModelFilter();
    }

    /**
     * Gets the 'sonata.admin.orm.filter.type.number' service.
     *
     * @return Sonata\DoctrineORMAdminBundle\Filter\NumberFilter A Sonata\DoctrineORMAdminBundle\Filter\NumberFilter instance.
     */
    protected function getSonata_Admin_Orm_Filter_Type_NumberService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\NumberFilter();
    }

    /**
     * Gets the 'sonata.admin.orm.filter.type.string' service.
     *
     * @return Sonata\DoctrineORMAdminBundle\Filter\StringFilter A Sonata\DoctrineORMAdminBundle\Filter\StringFilter instance.
     */
    protected function getSonata_Admin_Orm_Filter_Type_StringService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\StringFilter();
    }

    /**
     * Gets the 'sonata.admin.pool' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Admin\Pool A Sonata\AdminBundle\Admin\Pool instance.
     */
    protected function getSonata_Admin_PoolService()
    {
        $this->services['sonata.admin.pool'] = $instance = new \Sonata\AdminBundle\Admin\Pool($this, 'Sonata Project', '/bundles/piappadmin/images/logo/logo-orchestra-white.png');

        $instance->setTemplates(array('layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'user_block' => 'SonataAdminBundle:Core:user_block.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision' => 'SonataAdminBundle:CRUD:history_revision.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig'));
        $instance->setAdminServiceIds(array(0 => 'sonata.media.admin.media', 1 => 'sonata.media.admin.gallery', 2 => 'sonata.media.admin.gallery_has_media', 3 => 'bootstrap.admin.admin.group', 4 => 'bootstrap.admin.admin.user', 5 => 'bootstrap.admin.admin.role', 6 => 'bootstrap.admin.admin.permission', 7 => 'bootstrap.admin.admin.historicalpage'));
        $instance->setAdminGroups(array('sonata_media' => array('label' => 'sonata_media', 'items' => array(0 => 'sonata.media.admin.media', 1 => 'sonata.media.admin.gallery')), 'gestion_utilisateur' => array('label' => 'gestion_utilisateur', 'items' => array(0 => 'bootstrap.admin.admin.group', 1 => 'bootstrap.admin.admin.user', 2 => 'bootstrap.admin.admin.role', 3 => 'bootstrap.admin.admin.permission')), 'gestion_cms' => array('label' => 'gestion_cms', 'items' => array(0 => 'bootstrap.admin.admin.historicalpage'))));
        $instance->setAdminClasses(array('BootStrap\\MediaBundle\\Entity\\Media' => 'sonata.media.admin.media', 'BootStrap\\MediaBundle\\Entity\\Gallery' => 'sonata.media.admin.gallery', 'BootStrap\\MediaBundle\\Entity\\GalleryHasMedia' => 'sonata.media.admin.gallery_has_media', 'BootStrap\\UserBundle\\Entity\\Group' => 'bootstrap.admin.admin.group', 'BootStrap\\UserBundle\\Entity\\User' => 'bootstrap.admin.admin.user', 'BootStrap\\UserBundle\\Entity\\Role' => 'bootstrap.admin.admin.role', 'BootStrap\\UserBundle\\Entity\\Permission' => 'bootstrap.admin.admin.permission', 'PiApp\\AdminBundle\\Entity\\HistoricalStatus' => 'bootstrap.admin.admin.historicalpage'));

        return $instance;
    }

    /**
     * Gets the 'sonata.admin.route.default_generator' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Route\DefaultRouteGenerator A Sonata\AdminBundle\Route\DefaultRouteGenerator instance.
     */
    protected function getSonata_Admin_Route_DefaultGeneratorService()
    {
        return $this->services['sonata.admin.route.default_generator'] = new \Sonata\AdminBundle\Route\DefaultRouteGenerator($this->get('i18n_routing.router'));
    }

    /**
     * Gets the 'sonata.admin.route.path_info' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Route\PathInfoBuilder A Sonata\AdminBundle\Route\PathInfoBuilder instance.
     */
    protected function getSonata_Admin_Route_PathInfoService()
    {
        return $this->services['sonata.admin.route.path_info'] = new \Sonata\AdminBundle\Route\PathInfoBuilder($this->get('sonata.admin.audit.manager'));
    }

    /**
     * Gets the 'sonata.admin.route.query_string' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Route\QueryStringBuilder A Sonata\AdminBundle\Route\QueryStringBuilder instance.
     */
    protected function getSonata_Admin_Route_QueryStringService()
    {
        return $this->services['sonata.admin.route.query_string'] = new \Sonata\AdminBundle\Route\QueryStringBuilder($this->get('sonata.admin.audit.manager'));
    }

    /**
     * Gets the 'sonata.admin.route_loader' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Route\AdminPoolLoader A Sonata\AdminBundle\Route\AdminPoolLoader instance.
     */
    protected function getSonata_Admin_RouteLoaderService()
    {
        return $this->services['sonata.admin.route_loader'] = new \Sonata\AdminBundle\Route\AdminPoolLoader($this->get('sonata.admin.pool'), array(0 => 'sonata.media.admin.media', 1 => 'sonata.media.admin.gallery', 2 => 'sonata.media.admin.gallery_has_media', 3 => 'bootstrap.admin.admin.group', 4 => 'bootstrap.admin.admin.user', 5 => 'bootstrap.admin.admin.role', 6 => 'bootstrap.admin.admin.permission', 7 => 'bootstrap.admin.admin.historicalpage'), $this);
    }

    /**
     * Gets the 'sonata.admin.security.handler' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Security\Handler\RoleSecurityHandler A Sonata\AdminBundle\Security\Handler\RoleSecurityHandler instance.
     */
    protected function getSonata_Admin_Security_HandlerService()
    {
        return $this->services['sonata.admin.security.handler'] = new \Sonata\AdminBundle\Security\Handler\RoleSecurityHandler($this->get('security.context'), array(0 => 'ROLE_SUPER_ADMIN'));
    }

    /**
     * Gets the 'sonata.admin.twig.extension' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Twig\Extension\SonataAdminExtension A Sonata\AdminBundle\Twig\Extension\SonataAdminExtension instance.
     */
    protected function getSonata_Admin_Twig_ExtensionService()
    {
        return $this->services['sonata.admin.twig.extension'] = new \Sonata\AdminBundle\Twig\Extension\SonataAdminExtension();
    }

    /**
     * Gets the 'sonata.admin.validator.inline' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\AdminBundle\Validator\InlineValidator A Sonata\AdminBundle\Validator\InlineValidator instance.
     */
    protected function getSonata_Admin_Validator_InlineService()
    {
        return $this->services['sonata.admin.validator.inline'] = new \Sonata\AdminBundle\Validator\InlineValidator($this, $this->get('validator.validator_factory'));
    }

    /**
     * Gets the 'sonata.admin_doctrine_orm.block.audit' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\DoctrineORMAdminBundle\Block\AuditBlockService A Sonata\DoctrineORMAdminBundle\Block\AuditBlockService instance.
     */
    protected function getSonata_AdminDoctrineOrm_Block_AuditService()
    {
        return $this->services['sonata.admin_doctrine_orm.block.audit'] = new \Sonata\DoctrineORMAdminBundle\Block\AuditBlockService('sonata.admin_doctrine_orm.block.audit', $this->get('templating'), NULL);
    }

    /**
     * Gets the 'sonata.block.form.type.block' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\BlockBundle\Form\Type\ServiceListType A Sonata\BlockBundle\Form\Type\ServiceListType instance.
     */
    protected function getSonata_Block_Form_Type_BlockService()
    {
        return $this->services['sonata.block.form.type.block'] = new \Sonata\BlockBundle\Form\Type\ServiceListType($this->get('sonata.block.manager'), array('admin' => array(0 => 'sonata.admin.block.admin_list'), 'cms' => array(0 => 'sonata.block.service.text', 1 => 'sonata.block.service.action', 2 => 'sonata.block.service.rss')));
    }

    /**
     * Gets the 'sonata.block.loader.chain' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\BlockBundle\Block\BlockLoaderChain A Sonata\BlockBundle\Block\BlockLoaderChain instance.
     */
    protected function getSonata_Block_Loader_ChainService()
    {
        return $this->services['sonata.block.loader.chain'] = new \Sonata\BlockBundle\Block\BlockLoaderChain(array(0 => $this->get('sonata.block.loader.service')));
    }

    /**
     * Gets the 'sonata.block.loader.service' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\BlockBundle\Block\Loader\ServiceLoader A Sonata\BlockBundle\Block\Loader\ServiceLoader instance.
     */
    protected function getSonata_Block_Loader_ServiceService()
    {
        return $this->services['sonata.block.loader.service'] = new \Sonata\BlockBundle\Block\Loader\ServiceLoader(array('sonata.admin.block.admin_list' => array(), 'sonata.block.service.text' => array(), 'sonata.block.service.action' => array(), 'sonata.block.service.rss' => array()));
    }

    /**
     * Gets the 'sonata.block.renderer' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\BlockBundle\Block\BlockRenderer A Sonata\BlockBundle\Block\BlockRenderer instance.
     */
    protected function getSonata_Block_RendererService()
    {
        return $this->services['sonata.block.renderer'] = new \Sonata\BlockBundle\Block\BlockRenderer($this->get('sonata.block.manager'), $this->get('logger'), true);
    }

    /**
     * Gets the 'sonata.block.service.action' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\BlockBundle\Block\Service\ActionBlockService A Sonata\BlockBundle\Block\Service\ActionBlockService instance.
     */
    protected function getSonata_Block_Service_ActionService()
    {
        return $this->services['sonata.block.service.action'] = new \Sonata\BlockBundle\Block\Service\ActionBlockService('sonata.block.action', $this->get('templating'), $this->get('http_kernel'));
    }

    /**
     * Gets the 'sonata.block.service.rss' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\BlockBundle\Block\Service\RssBlockService A Sonata\BlockBundle\Block\Service\RssBlockService instance.
     */
    protected function getSonata_Block_Service_RssService()
    {
        return $this->services['sonata.block.service.rss'] = new \Sonata\BlockBundle\Block\Service\RssBlockService('sonata.block.rss', $this->get('templating'));
    }

    /**
     * Gets the 'sonata.block.service.text' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\BlockBundle\Block\Service\TextBlockService A Sonata\BlockBundle\Block\Service\TextBlockService instance.
     */
    protected function getSonata_Block_Service_TextService()
    {
        return $this->services['sonata.block.service.text'] = new \Sonata\BlockBundle\Block\Service\TextBlockService('sonata.block.text', $this->get('templating'));
    }

    /**
     * Gets the 'sonata.cache.invalidation.simple' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\CacheBundle\Invalidation\SimpleCacheInvalidation A Sonata\CacheBundle\Invalidation\SimpleCacheInvalidation instance.
     */
    protected function getSonata_Cache_Invalidation_SimpleService()
    {
        return $this->services['sonata.cache.invalidation.simple'] = new \Sonata\CacheBundle\Invalidation\SimpleCacheInvalidation($this->get('logger'));
    }

    /**
     * Gets the 'sonata.cache.manager' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\CacheBundle\Cache\CacheManager A Sonata\CacheBundle\Cache\CacheManager instance.
     */
    protected function getSonata_Cache_ManagerService()
    {
        $this->services['sonata.cache.manager'] = $instance = new \Sonata\CacheBundle\Cache\CacheManager($this->get('sonata.cache.invalidation.simple'), array('sonata.cache.noop' => $this->get('sonata.cache.noop')));

        $instance->setRecorder($this->get('sonata.cache.recorder'));

        return $instance;
    }

    /**
     * Gets the 'sonata.cache.model_identifier' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\CacheBundle\Invalidation\ModelCollectionIdentifiers A Sonata\CacheBundle\Invalidation\ModelCollectionIdentifiers instance.
     */
    protected function getSonata_Cache_ModelIdentifierService()
    {
        return $this->services['sonata.cache.model_identifier'] = new \Sonata\CacheBundle\Invalidation\ModelCollectionIdentifiers(array());
    }

    /**
     * Gets the 'sonata.cache.noop' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\CacheBundle\Adapter\NoopCache A Sonata\CacheBundle\Adapter\NoopCache instance.
     */
    protected function getSonata_Cache_NoopService()
    {
        return $this->services['sonata.cache.noop'] = new \Sonata\CacheBundle\Adapter\NoopCache();
    }

    /**
     * Gets the 'sonata.cache.orm.event_subscriber' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\CacheBundle\Invalidation\DoctrineORMListenerContainerAware A Sonata\CacheBundle\Invalidation\DoctrineORMListenerContainerAware instance.
     */
    protected function getSonata_Cache_Orm_EventSubscriberService()
    {
        return $this->services['sonata.cache.orm.event_subscriber'] = new \Sonata\CacheBundle\Invalidation\DoctrineORMListenerContainerAware($this, 'sonata.cache.orm.event_subscriber.default');
    }

    /**
     * Gets the 'sonata.cache.orm.event_subscriber.default' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\CacheBundle\Invalidation\DoctrineORMListener A Sonata\CacheBundle\Invalidation\DoctrineORMListener instance.
     */
    protected function getSonata_Cache_Orm_EventSubscriber_DefaultService()
    {
        return $this->services['sonata.cache.orm.event_subscriber.default'] = new \Sonata\CacheBundle\Invalidation\DoctrineORMListener($this->get('sonata.cache.model_identifier'), array('sonata.cache.noop' => $this->get('sonata.cache.noop')));
    }

    /**
     * Gets the 'sonata.cache.recorder' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\CacheBundle\Invalidation\Recorder A Sonata\CacheBundle\Invalidation\Recorder instance.
     */
    protected function getSonata_Cache_RecorderService()
    {
        return $this->services['sonata.cache.recorder'] = new \Sonata\CacheBundle\Invalidation\Recorder($this->get('sonata.cache.model_identifier'));
    }

    /**
     * Gets the 'sonata.easy_extends.doctrine.mapper' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\EasyExtendsBundle\Mapper\DoctrineORMMapper A Sonata\EasyExtendsBundle\Mapper\DoctrineORMMapper instance.
     */
    protected function getSonata_EasyExtends_Doctrine_MapperService()
    {
        $this->services['sonata.easy_extends.doctrine.mapper'] = $instance = new \Sonata\EasyExtendsBundle\Mapper\DoctrineORMMapper($this->get('doctrine'), array());

        $instance->addAssociation('BootStrap\\MediaBundle\\Entity\\Media', 'mapOneToMany', array(0 => array('fieldName' => 'galleryHasMedias', 'targetEntity' => 'BootStrap\\MediaBundle\\Entity\\GalleryHasMedia', 'cascade' => array(0 => 'persist'), 'mappedBy' => 'media', 'orphanRemoval' => false)));
        $instance->addAssociation('BootStrap\\MediaBundle\\Entity\\GalleryHasMedia', 'mapManyToOne', array(0 => array('fieldName' => 'gallery', 'targetEntity' => 'BootStrap\\MediaBundle\\Entity\\Gallery', 'cascade' => array(0 => 'persist'), 'mappedBy' => NULL, 'inversedBy' => 'galleryHasMedias', 'joinColumns' => array(0 => array('name' => 'gallery_id', 'referencedColumnName' => 'id')), 'orphanRemoval' => false), 1 => array('fieldName' => 'media', 'targetEntity' => 'BootStrap\\MediaBundle\\Entity\\Media', 'cascade' => array(0 => 'persist'), 'mappedBy' => NULL, 'inversedBy' => 'galleryHasMedias', 'joinColumns' => array(0 => array('name' => 'media_id', 'referencedColumnName' => 'id')), 'orphanRemoval' => false)));
        $instance->addAssociation('BootStrap\\MediaBundle\\Entity\\Gallery', 'mapOneToMany', array(0 => array('fieldName' => 'galleryHasMedias', 'targetEntity' => 'BootStrap\\MediaBundle\\Entity\\GalleryHasMedia', 'cascade' => array(0 => 'persist'), 'mappedBy' => 'gallery', 'orphanRemoval' => true, 'orderBy' => array('position' => 'ASC'))));

        return $instance;
    }

    /**
     * Gets the 'sonata.easy_extends.generator.bundle' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\EasyExtendsBundle\Generator\BundleGenerator A Sonata\EasyExtendsBundle\Generator\BundleGenerator instance.
     */
    protected function getSonata_EasyExtends_Generator_BundleService()
    {
        return $this->services['sonata.easy_extends.generator.bundle'] = new \Sonata\EasyExtendsBundle\Generator\BundleGenerator();
    }

    /**
     * Gets the 'sonata.easy_extends.generator.odm' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\EasyExtendsBundle\Generator\OdmGenerator A Sonata\EasyExtendsBundle\Generator\OdmGenerator instance.
     */
    protected function getSonata_EasyExtends_Generator_OdmService()
    {
        return $this->services['sonata.easy_extends.generator.odm'] = new \Sonata\EasyExtendsBundle\Generator\OdmGenerator();
    }

    /**
     * Gets the 'sonata.easy_extends.generator.orm' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\EasyExtendsBundle\Generator\OrmGenerator A Sonata\EasyExtendsBundle\Generator\OrmGenerator instance.
     */
    protected function getSonata_EasyExtends_Generator_OrmService()
    {
        return $this->services['sonata.easy_extends.generator.orm'] = new \Sonata\EasyExtendsBundle\Generator\OrmGenerator();
    }

    /**
     * Gets the 'sonata.media.adapter.filesystem.local' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Gaufrette\Adapter\Local A Gaufrette\Adapter\Local instance.
     */
    protected function getSonata_Media_Adapter_Filesystem_LocalService()
    {
        return $this->services['sonata.media.adapter.filesystem.local'] = new \Gaufrette\Adapter\Local('/Users/guillaumemigeon/Sites/orchestra-cmf/app/../web/uploads/media', false);
    }

    /**
     * Gets the 'sonata.media.adapter.image.gd' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Imagine\Gd\Imagine A Imagine\Gd\Imagine instance.
     */
    protected function getSonata_Media_Adapter_Image_GdService()
    {
        return $this->services['sonata.media.adapter.image.gd'] = new \Imagine\Gd\Imagine();
    }

    /**
     * Gets the 'sonata.media.adapter.image.gmagick' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Imagine\Gmagick\Imagine A Imagine\Gmagick\Imagine instance.
     */
    protected function getSonata_Media_Adapter_Image_GmagickService()
    {
        return $this->services['sonata.media.adapter.image.gmagick'] = new \Imagine\Gmagick\Imagine();
    }

    /**
     * Gets the 'sonata.media.adapter.image.imagick' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Imagine\Imagick\Imagine A Imagine\Imagick\Imagine instance.
     */
    protected function getSonata_Media_Adapter_Image_ImagickService()
    {
        return $this->services['sonata.media.adapter.image.imagick'] = new \Imagine\Imagick\Imagine();
    }

    /**
     * Gets the 'sonata.media.adapter.service.s3' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return AmazonS3 A AmazonS3 instance.
     */
    protected function getSonata_Media_Adapter_Service_S3Service()
    {
        return $this->services['sonata.media.adapter.service.s3'] = new \AmazonS3(array());
    }

    /**
     * Gets the 'sonata.media.admin.gallery' service.
     *
     * @return Sonata\MediaBundle\Admin\GalleryAdmin A Sonata\MediaBundle\Admin\GalleryAdmin instance.
     */
    protected function getSonata_Media_Admin_GalleryService()
    {
        $instance = new \Sonata\MediaBundle\Admin\GalleryAdmin('sonata.media.admin.gallery', 'BootStrap\\MediaBundle\\Entity\\Gallery', 'SonataMediaBundle:GalleryAdmin', $this->get('sonata.media.pool'));

        $instance->setTranslationDomain('SonataMediaBundle');
        $instance->setTemplates(array('layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'list' => 'SonataMediaBundle:GalleryAdmin:list.html.twig'));
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.underscore'));
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabel('gallery');
        $instance->setSecurityInformation(array('EDIT' => array(0 => 'EDIT'), 'LIST' => array(0 => 'LIST'), 'CREATE' => array(0 => 'CREATE'), 'VIEW' => array(0 => 'VIEW'), 'DELETE' => array(0 => 'DELETE'), 'OPERATOR' => array(0 => 'OPERATOR'), 'MASTER' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));

        return $instance;
    }

    /**
     * Gets the 'sonata.media.admin.gallery_has_media' service.
     *
     * @return Sonata\MediaBundle\Admin\GalleryHasMediaAdmin A Sonata\MediaBundle\Admin\GalleryHasMediaAdmin instance.
     */
    protected function getSonata_Media_Admin_GalleryHasMediaService()
    {
        $instance = new \Sonata\MediaBundle\Admin\GalleryHasMediaAdmin('sonata.media.admin.gallery_has_media', 'BootStrap\\MediaBundle\\Entity\\GalleryHasMedia', 'SonataAdminBundle:CRUD');

        $instance->setTranslationDomain('SonataMediaBundle');
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.underscore'));
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabel('gallery_has_media');
        $instance->setTemplates(array('layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'user_block' => 'SonataAdminBundle:Core:user_block.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision' => 'SonataAdminBundle:CRUD:history_revision.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig'));
        $instance->setSecurityInformation(array('EDIT' => array(0 => 'EDIT'), 'LIST' => array(0 => 'LIST'), 'CREATE' => array(0 => 'CREATE'), 'VIEW' => array(0 => 'VIEW'), 'DELETE' => array(0 => 'DELETE'), 'OPERATOR' => array(0 => 'OPERATOR'), 'MASTER' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));

        return $instance;
    }

    /**
     * Gets the 'sonata.media.admin.media' service.
     *
     * @return Sonata\MediaBundle\Admin\ORM\MediaAdmin A Sonata\MediaBundle\Admin\ORM\MediaAdmin instance.
     */
    protected function getSonata_Media_Admin_MediaService()
    {
        $instance = new \Sonata\MediaBundle\Admin\ORM\MediaAdmin('sonata.media.admin.media', 'BootStrap\\MediaBundle\\Entity\\Media', 'SonataMediaBundle:MediaAdmin', $this->get('sonata.media.pool'));

        $instance->setModelManager($this->get('sonata.media.admin.media.manager'));
        $instance->setTranslationDomain('SonataMediaBundle');
        $instance->setTemplates(array('layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'list' => 'SonataMediaBundle:MediaAdmin:list.html.twig'));
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.underscore'));
        $instance->setManagerType('orm');
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator.default'));
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabel('media');
        $instance->setSecurityInformation(array('EDIT' => array(0 => 'EDIT'), 'LIST' => array(0 => 'LIST'), 'CREATE' => array(0 => 'CREATE'), 'VIEW' => array(0 => 'VIEW'), 'DELETE' => array(0 => 'DELETE'), 'OPERATOR' => array(0 => 'OPERATOR'), 'MASTER' => array(0 => 'MASTER')));
        $instance->initialize();
        $instance->setFormTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => 'SonataDoctrineORMAdminBundle:Form:filter_admin_fields.html.twig'));

        return $instance;
    }

    /**
     * Gets the 'sonata.media.admin.media.manager' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\MediaBundle\Admin\Manager\DoctrineORMManager A Sonata\MediaBundle\Admin\Manager\DoctrineORMManager instance.
     */
    protected function getSonata_Media_Admin_Media_ManagerService()
    {
        return $this->services['sonata.media.admin.media.manager'] = new \Sonata\MediaBundle\Admin\Manager\DoctrineORMManager($this->get('doctrine'), $this->get('sonata.media.manager.media'));
    }

    /**
     * Gets the 'sonata.media.block.feature_media' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\MediaBundle\Block\FeatureMediaBlockService A Sonata\MediaBundle\Block\FeatureMediaBlockService instance.
     */
    protected function getSonata_Media_Block_FeatureMediaService()
    {
        return $this->services['sonata.media.block.feature_media'] = new \Sonata\MediaBundle\Block\FeatureMediaBlockService('sonata.media.block.feature_media', $this->get('templating'), $this, $this->get('sonata.media.manager.media'));
    }

    /**
     * Gets the 'sonata.media.block.gallery' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\MediaBundle\Block\GalleryBlockService A Sonata\MediaBundle\Block\GalleryBlockService instance.
     */
    protected function getSonata_Media_Block_GalleryService()
    {
        return $this->services['sonata.media.block.gallery'] = new \Sonata\MediaBundle\Block\GalleryBlockService('sonata.media.block.gallery', $this->get('templating'), $this, $this->get('sonata.media.manager.gallery'));
    }

    /**
     * Gets the 'sonata.media.block.media' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\MediaBundle\Block\MediaBlockService A Sonata\MediaBundle\Block\MediaBlockService instance.
     */
    protected function getSonata_Media_Block_MediaService()
    {
        return $this->services['sonata.media.block.media'] = new \Sonata\MediaBundle\Block\MediaBlockService('sonata.media.block.media', $this->get('templating'), $this, $this->get('sonata.media.manager.media'));
    }

    /**
     * Gets the 'sonata.media.buzz.browser' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Buzz\Browser A Buzz\Browser instance.
     */
    protected function getSonata_Media_Buzz_BrowserService()
    {
        return $this->services['sonata.media.buzz.browser'] = new \Buzz\Browser($this->get('sonata.media.buzz.connector.file_get_contents'));
    }

    /**
     * Gets the 'sonata.media.buzz.connector.curl' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Buzz\Client\Curl A Buzz\Client\Curl instance.
     */
    protected function getSonata_Media_Buzz_Connector_CurlService()
    {
        return $this->services['sonata.media.buzz.connector.curl'] = new \Buzz\Client\Curl();
    }

    /**
     * Gets the 'sonata.media.buzz.connector.file_get_contents' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Buzz\Client\FileGetContents A Buzz\Client\FileGetContents instance.
     */
    protected function getSonata_Media_Buzz_Connector_FileGetContentsService()
    {
        return $this->services['sonata.media.buzz.connector.file_get_contents'] = new \Buzz\Client\FileGetContents();
    }

    /**
     * Gets the 'sonata.media.cdn.server' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\MediaBundle\CDN\Server A Sonata\MediaBundle\CDN\Server instance.
     */
    protected function getSonata_Media_Cdn_ServerService()
    {
        return $this->services['sonata.media.cdn.server'] = new \Sonata\MediaBundle\CDN\Server('/uploads/media');
    }

    /**
     * Gets the 'sonata.media.doctrine.event_subscriber' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\MediaBundle\Listener\ORM\MediaEventSubscriber A Sonata\MediaBundle\Listener\ORM\MediaEventSubscriber instance.
     */
    protected function getSonata_Media_Doctrine_EventSubscriberService()
    {
        return $this->services['sonata.media.doctrine.event_subscriber'] = new \Sonata\MediaBundle\Listener\ORM\MediaEventSubscriber($this);
    }

    /**
     * Gets the 'sonata.media.filesystem.local' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Gaufrette\Filesystem A Gaufrette\Filesystem instance.
     */
    protected function getSonata_Media_Filesystem_LocalService()
    {
        return $this->services['sonata.media.filesystem.local'] = new \Gaufrette\Filesystem($this->get('sonata.media.adapter.filesystem.local'));
    }

    /**
     * Gets the 'sonata.media.form.type.media' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\MediaBundle\Form\Type\MediaType A Sonata\MediaBundle\Form\Type\MediaType instance.
     */
    protected function getSonata_Media_Form_Type_MediaService()
    {
        return $this->services['sonata.media.form.type.media'] = new \Sonata\MediaBundle\Form\Type\MediaType($this->get('sonata.media.pool'), 'BootStrap\\MediaBundle\\Entity\\Media');
    }

    /**
     * Gets the 'sonata.media.generator.default' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\MediaBundle\Generator\DefaultGenerator A Sonata\MediaBundle\Generator\DefaultGenerator instance.
     */
    protected function getSonata_Media_Generator_DefaultService()
    {
        return $this->services['sonata.media.generator.default'] = new \Sonata\MediaBundle\Generator\DefaultGenerator();
    }

    /**
     * Gets the 'sonata.media.manager.gallery' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\MediaBundle\Entity\GalleryManager A Sonata\MediaBundle\Entity\GalleryManager instance.
     */
    protected function getSonata_Media_Manager_GalleryService()
    {
        return $this->services['sonata.media.manager.gallery'] = new \Sonata\MediaBundle\Entity\GalleryManager($this->get('doctrine.orm.default_entity_manager'), 'BootStrap\\MediaBundle\\Entity\\Gallery');
    }

    /**
     * Gets the 'sonata.media.manager.media' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\MediaBundle\Entity\MediaManager A Sonata\MediaBundle\Entity\MediaManager instance.
     */
    protected function getSonata_Media_Manager_MediaService()
    {
        return $this->services['sonata.media.manager.media'] = new \Sonata\MediaBundle\Entity\MediaManager($this->get('sonata.media.pool'), $this->get('doctrine.orm.default_entity_manager'), 'BootStrap\\MediaBundle\\Entity\\Media');
    }

    /**
     * Gets the 'sonata.media.pool' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\MediaBundle\Provider\Pool A Sonata\MediaBundle\Provider\Pool instance.
     */
    protected function getSonata_Media_PoolService()
    {
        $this->services['sonata.media.pool'] = $instance = new \Sonata\MediaBundle\Provider\Pool('default');

        $instance->addContext('default', array(0 => 'sonata.media.provider.dailymotion', 1 => 'sonata.media.provider.youtube', 2 => 'sonata.media.provider.image', 3 => 'sonata.media.provider.file'), array('default_small' => array('width' => 100, 'quality' => 70, 'height' => false, 'format' => 'jpg', 'constraint' => true), 'default_big' => array('width' => 500, 'quality' => 70, 'height' => false, 'format' => 'jpg', 'constraint' => true)), array('strategy' => 'sonata.media.security.user_strategy', 'mode' => 'http'));
        $instance->addDownloadSecurity('sonata.media.security.user_strategy', $this->get('sonata.media.security.user_strategy'));
        $instance->addProvider('sonata.media.provider.image', $this->get('sonata.media.provider.image'));
        $instance->addProvider('sonata.media.provider.file', $this->get('sonata.media.provider.file'));
        $instance->addProvider('sonata.media.provider.youtube', $this->get('sonata.media.provider.youtube'));
        $instance->addProvider('sonata.media.provider.dailymotion', $this->get('sonata.media.provider.dailymotion'));
        $instance->addProvider('sonata.media.provider.vimeo', $this->get('sonata.media.provider.vimeo'));

        return $instance;
    }

    /**
     * Gets the 'sonata.media.provider.dailymotion' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\MediaBundle\Provider\DailyMotionProvider A Sonata\MediaBundle\Provider\DailyMotionProvider instance.
     */
    protected function getSonata_Media_Provider_DailymotionService()
    {
        $this->services['sonata.media.provider.dailymotion'] = $instance = new \Sonata\MediaBundle\Provider\DailyMotionProvider('sonata.media.provider.dailymotion', $this->get('sonata.media.filesystem.local'), $this->get('sonata.media.cdn.server'), $this->get('sonata.media.generator.default'), $this->get('sonata.media.thumbnail.format'), $this->get('sonata.media.buzz.browser'));

        $instance->setTemplates(array('helper_thumbnail' => 'SonataMediaBundle:Provider:thumbnail.html.twig', 'helper_view' => 'SonataMediaBundle:Provider:view_dailymotion.html.twig'));
        $instance->addFormat('default_small', array('width' => 100, 'quality' => 70, 'height' => false, 'format' => 'jpg', 'constraint' => true));
        $instance->addFormat('default_big', array('width' => 500, 'quality' => 70, 'height' => false, 'format' => 'jpg', 'constraint' => true));
        $instance->setResizer($this->get('sonata.media.resizer.simple'));
        $instance->addFormat('admin', array('quality' => 80, 'width' => 100, 'format' => 'jpg', 'height' => false, 'constraint' => true));

        return $instance;
    }

    /**
     * Gets the 'sonata.media.provider.file' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\MediaBundle\Provider\FileProvider A Sonata\MediaBundle\Provider\FileProvider instance.
     */
    protected function getSonata_Media_Provider_FileService()
    {
        $this->services['sonata.media.provider.file'] = $instance = new \Sonata\MediaBundle\Provider\FileProvider('sonata.media.provider.file', $this->get('sonata.media.filesystem.local'), $this->get('sonata.media.cdn.server'), $this->get('sonata.media.generator.default'), $this->get('sonata.media.thumbnail.format'), array(0 => 'pdf', 1 => 'txt', 2 => 'rtf', 3 => 'doc', 4 => 'docx', 5 => 'xls', 6 => 'xlsx', 7 => 'ppt', 8 => 'pttx', 9 => 'odt', 10 => 'odg', 11 => 'odp', 12 => 'ods', 13 => 'odc', 14 => 'odf', 15 => 'odb', 16 => 'csv', 17 => 'xml'), array(0 => 'application/pdf', 1 => 'application/x-pdf', 2 => 'application/rtf', 3 => 'text/html', 4 => 'text/rtf', 5 => 'text/plain', 6 => 'application/excel', 7 => 'application/msword', 8 => 'application/vnd.ms-excel', 9 => 'application/vnd.ms-powerpoint', 10 => 'application/vnd.ms-powerpoint', 11 => 'application/vnd.oasis.opendocument.text', 12 => 'application/vnd.oasis.opendocument.graphics', 13 => 'application/vnd.oasis.opendocument.presentation', 14 => 'application/vnd.oasis.opendocument.spreadsheet', 15 => 'application/vnd.oasis.opendocument.chart', 16 => 'application/vnd.oasis.opendocument.formula', 17 => 'application/vnd.oasis.opendocument.database', 18 => 'application/vnd.oasis.opendocument.image', 19 => 'text/comma-separated-values', 20 => 'text/xml', 21 => 'application/zip'));

        $instance->setTemplates(array('helper_thumbnail' => 'SonataMediaBundle:Provider:thumbnail.html.twig', 'helper_view' => 'SonataMediaBundle:Provider:view_file.html.twig'));
        $instance->addFormat('default_small', array('width' => 100, 'quality' => 70, 'height' => false, 'format' => 'jpg', 'constraint' => true));
        $instance->addFormat('default_big', array('width' => 500, 'quality' => 70, 'height' => false, 'format' => 'jpg', 'constraint' => true));
        $instance->addFormat('admin', array('quality' => 80, 'width' => 100, 'format' => 'jpg', 'height' => false, 'constraint' => true));

        return $instance;
    }

    /**
     * Gets the 'sonata.media.provider.image' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\MediaBundle\Provider\ImageProvider A Sonata\MediaBundle\Provider\ImageProvider instance.
     */
    protected function getSonata_Media_Provider_ImageService()
    {
        $this->services['sonata.media.provider.image'] = $instance = new \Sonata\MediaBundle\Provider\ImageProvider('sonata.media.provider.image', $this->get('sonata.media.filesystem.local'), $this->get('sonata.media.cdn.server'), $this->get('sonata.media.generator.default'), $this->get('sonata.media.thumbnail.format'), array(0 => 'gif', 1 => 'jpg', 2 => 'png', 3 => 'jpeg'), array(0 => 'image/gif', 1 => 'image/pjpeg', 2 => 'image/jpeg', 3 => 'image/png', 4 => 'image/x-png'), $this->get('sonata.media.adapter.image.gd'));

        $instance->setTemplates(array('helper_thumbnail' => 'SonataMediaBundle:Provider:thumbnail.html.twig', 'helper_view' => 'SonataMediaBundle:Provider:view_image.html.twig'));
        $instance->addFormat('default_small', array('width' => 100, 'quality' => 70, 'height' => false, 'format' => 'jpg', 'constraint' => true));
        $instance->addFormat('default_big', array('width' => 500, 'quality' => 70, 'height' => false, 'format' => 'jpg', 'constraint' => true));
        $instance->setResizer($this->get('sonata.media.resizer.simple'));
        $instance->addFormat('admin', array('quality' => 80, 'width' => 100, 'format' => 'jpg', 'height' => false, 'constraint' => true));

        return $instance;
    }

    /**
     * Gets the 'sonata.media.provider.vimeo' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\MediaBundle\Provider\VimeoProvider A Sonata\MediaBundle\Provider\VimeoProvider instance.
     */
    protected function getSonata_Media_Provider_VimeoService()
    {
        $this->services['sonata.media.provider.vimeo'] = $instance = new \Sonata\MediaBundle\Provider\VimeoProvider('sonata.media.provider.vimeo', $this->get('sonata.media.filesystem.local'), $this->get('sonata.media.cdn.server'), $this->get('sonata.media.generator.default'), $this->get('sonata.media.thumbnail.format'), $this->get('sonata.media.buzz.browser'));

        $instance->setTemplates(array('helper_thumbnail' => 'SonataMediaBundle:Provider:thumbnail.html.twig', 'helper_view' => 'SonataMediaBundle:Provider:view_vimeo.html.twig'));
        $instance->setResizer($this->get('sonata.media.resizer.simple'));
        $instance->addFormat('admin', array('quality' => 80, 'width' => 100, 'format' => 'jpg', 'height' => false, 'constraint' => true));

        return $instance;
    }

    /**
     * Gets the 'sonata.media.provider.youtube' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\MediaBundle\Provider\YouTubeProvider A Sonata\MediaBundle\Provider\YouTubeProvider instance.
     */
    protected function getSonata_Media_Provider_YoutubeService()
    {
        $this->services['sonata.media.provider.youtube'] = $instance = new \Sonata\MediaBundle\Provider\YouTubeProvider('sonata.media.provider.youtube', $this->get('sonata.media.filesystem.local'), $this->get('sonata.media.cdn.server'), $this->get('sonata.media.generator.default'), $this->get('sonata.media.thumbnail.format'), $this->get('sonata.media.buzz.browser'));

        $instance->setTemplates(array('helper_thumbnail' => 'SonataMediaBundle:Provider:thumbnail.html.twig', 'helper_view' => 'SonataMediaBundle:Provider:view_youtube.html.twig'));
        $instance->addFormat('default_small', array('width' => 100, 'quality' => 70, 'height' => false, 'format' => 'jpg', 'constraint' => true));
        $instance->addFormat('default_big', array('width' => 500, 'quality' => 70, 'height' => false, 'format' => 'jpg', 'constraint' => true));
        $instance->setResizer($this->get('sonata.media.resizer.simple'));
        $instance->addFormat('admin', array('quality' => 80, 'width' => 100, 'format' => 'jpg', 'height' => false, 'constraint' => true));

        return $instance;
    }

    /**
     * Gets the 'sonata.media.resizer.simple' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\MediaBundle\Resizer\SimpleResizer A Sonata\MediaBundle\Resizer\SimpleResizer instance.
     */
    protected function getSonata_Media_Resizer_SimpleService()
    {
        return $this->services['sonata.media.resizer.simple'] = new \Sonata\MediaBundle\Resizer\SimpleResizer($this->get('sonata.media.adapter.image.gd'), 'inset');
    }

    /**
     * Gets the 'sonata.media.resizer.square' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\MediaBundle\Resizer\SquareResizer A Sonata\MediaBundle\Resizer\SquareResizer instance.
     */
    protected function getSonata_Media_Resizer_SquareService()
    {
        return $this->services['sonata.media.resizer.square'] = new \Sonata\MediaBundle\Resizer\SquareResizer($this->get('sonata.media.adapter.image.gd'), 'inset');
    }

    /**
     * Gets the 'sonata.media.security.connected_strategy' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\MediaBundle\Security\RolesDownloadStrategy A Sonata\MediaBundle\Security\RolesDownloadStrategy instance.
     */
    protected function getSonata_Media_Security_ConnectedStrategyService()
    {
        return $this->services['sonata.media.security.connected_strategy'] = new \Sonata\MediaBundle\Security\RolesDownloadStrategy($this->get('translator.default'), $this->get('security.context'), array(0 => 'IS_AUTHENTICATED_FULLY', 1 => 'IS_AUTHENTICATED_REMEMBERED'));
    }

    /**
     * Gets the 'sonata.media.security.forbidden_strategy' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\MediaBundle\Security\ForbiddenDownloadStrategy A Sonata\MediaBundle\Security\ForbiddenDownloadStrategy instance.
     */
    protected function getSonata_Media_Security_ForbiddenStrategyService()
    {
        return $this->services['sonata.media.security.forbidden_strategy'] = new \Sonata\MediaBundle\Security\ForbiddenDownloadStrategy($this->get('translator.default'));
    }

    /**
     * Gets the 'sonata.media.security.public_strategy' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\MediaBundle\Security\PublicDownloadStrategy A Sonata\MediaBundle\Security\PublicDownloadStrategy instance.
     */
    protected function getSonata_Media_Security_PublicStrategyService()
    {
        return $this->services['sonata.media.security.public_strategy'] = new \Sonata\MediaBundle\Security\PublicDownloadStrategy($this->get('translator.default'));
    }

    /**
     * Gets the 'sonata.media.security.superadmin_strategy' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\MediaBundle\Security\RolesDownloadStrategy A Sonata\MediaBundle\Security\RolesDownloadStrategy instance.
     */
    protected function getSonata_Media_Security_SuperadminStrategyService()
    {
        return $this->services['sonata.media.security.superadmin_strategy'] = new \Sonata\MediaBundle\Security\RolesDownloadStrategy($this->get('translator.default'), $this->get('security.context'), array(0 => 'ROLE_SUPER_ADMIN', 1 => 'ROLE_ADMIN'));
    }

    /**
     * Gets the 'sonata.media.security.user_strategy' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\MediaBundle\Security\RolesDownloadStrategy A Sonata\MediaBundle\Security\RolesDownloadStrategy instance.
     */
    protected function getSonata_Media_Security_UserStrategyService()
    {
        return $this->services['sonata.media.security.user_strategy'] = new \Sonata\MediaBundle\Security\RolesDownloadStrategy($this->get('translator.default'), $this->get('security.context'), array(0 => 'ROLE_USER'));
    }

    /**
     * Gets the 'sonata.media.thumbnail.format' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\MediaBundle\Thumbnail\FormatThumbnail A Sonata\MediaBundle\Thumbnail\FormatThumbnail instance.
     */
    protected function getSonata_Media_Thumbnail_FormatService()
    {
        return $this->services['sonata.media.thumbnail.format'] = new \Sonata\MediaBundle\Thumbnail\FormatThumbnail();
    }

    /**
     * Gets the 'sonata.media.twig.extension' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Sonata\MediaBundle\Twig\Extension\MediaExtension A Sonata\MediaBundle\Twig\Extension\MediaExtension instance.
     */
    protected function getSonata_Media_Twig_ExtensionService()
    {
        return $this->services['sonata.media.twig.extension'] = new \Sonata\MediaBundle\Twig\Extension\MediaExtension($this->get('sonata.media.pool'), $this->get('sonata.media.manager.media'));
    }

    /**
     * Gets the 'sonata.user.form.type.security_permissions' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return BootStrap\AdminBundle\Form\Type\SecurityPermissionsType A BootStrap\AdminBundle\Form\Type\SecurityPermissionsType instance.
     */
    protected function getSonata_User_Form_Type_SecurityPermissionsService()
    {
        return $this->services['sonata.user.form.type.security_permissions'] = new \BootStrap\AdminBundle\Form\Type\SecurityPermissionsType($this->get('sonata.admin.pool'));
    }

    /**
     * Gets the 'sonata.user.form.type.security_roles' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return BootStrap\AdminBundle\Form\Type\SecurityRolesType A BootStrap\AdminBundle\Form\Type\SecurityRolesType instance.
     */
    protected function getSonata_User_Form_Type_SecurityRolesService()
    {
        return $this->services['sonata.user.form.type.security_roles'] = new \BootStrap\AdminBundle\Form\Type\SecurityRolesType($this->get('sonata.admin.pool'));
    }

    /**
     * Gets the 'stof_doctrine_extensions.event_listener.locale' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Stof\DoctrineExtensionsBundle\EventListener\LocaleListener A Stof\DoctrineExtensionsBundle\EventListener\LocaleListener instance.
     */
    protected function getStofDoctrineExtensions_EventListener_LocaleService()
    {
        return $this->services['stof_doctrine_extensions.event_listener.locale'] = new \Stof\DoctrineExtensionsBundle\EventListener\LocaleListener($this->get('stof_doctrine_extensions.listener.translatable'));
    }

    /**
     * Gets the 'stof_doctrine_extensions.event_listener.logger' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Stof\DoctrineExtensionsBundle\EventListener\LoggerListener A Stof\DoctrineExtensionsBundle\EventListener\LoggerListener instance.
     */
    protected function getStofDoctrineExtensions_EventListener_LoggerService()
    {
        return $this->services['stof_doctrine_extensions.event_listener.logger'] = new \Stof\DoctrineExtensionsBundle\EventListener\LoggerListener($this->get('stof_doctrine_extensions.listener.loggable'), $this->get('security.context'));
    }

    /**
     * Gets the 'swiftmailer.plugin.messagelogger' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\SwiftmailerBundle\Logger\MessageLogger A Symfony\Bundle\SwiftmailerBundle\Logger\MessageLogger instance.
     */
    protected function getSwiftmailer_Plugin_MessageloggerService()
    {
        return $this->services['swiftmailer.plugin.messagelogger'] = new \Symfony\Bundle\SwiftmailerBundle\Logger\MessageLogger();
    }

    /**
     * Gets the 'swiftmailer.transport' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Swift_Transport_EsmtpTransport A Swift_Transport_EsmtpTransport instance.
     */
    protected function getSwiftmailer_TransportService()
    {
        $this->services['swiftmailer.transport'] = $instance = new \Swift_Transport_EsmtpTransport(new \Swift_Transport_StreamBuffer(new \Swift_StreamFilters_StringReplacementFilterFactory()), array(0 => new \Swift_Transport_Esmtp_AuthHandler(array(0 => new \Swift_Transport_Esmtp_Auth_CramMd5Authenticator(), 1 => new \Swift_Transport_Esmtp_Auth_LoginAuthenticator(), 2 => new \Swift_Transport_Esmtp_Auth_PlainAuthenticator()))), new \Swift_Events_SimpleEventDispatcher());

        $instance->setHost('localhost');
        $instance->setPort(25);
        $instance->setEncryption(NULL);
        $instance->setUsername('');
        $instance->setPassword('');
        $instance->setAuthMode(NULL);
        $instance->registerPlugin($this->get('swiftmailer.plugin.messagelogger'));

        return $instance;
    }

    /**
     * Gets the 'templating' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\TwigBundle\TwigEngine A Symfony\Bundle\TwigBundle\TwigEngine instance.
     */
    protected function getTemplatingService()
    {
        return $this->services['templating'] = new \Symfony\Bundle\TwigBundle\TwigEngine($this->get('twig'), $this->get('templating.name_parser'), $this->get('templating.globals'));
    }

    /**
     * Gets the 'templating.asset.package_factory' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\FrameworkBundle\Templating\Asset\PackageFactory A Symfony\Bundle\FrameworkBundle\Templating\Asset\PackageFactory instance.
     */
    protected function getTemplating_Asset_PackageFactoryService()
    {
        return $this->services['templating.asset.package_factory'] = new \Symfony\Bundle\FrameworkBundle\Templating\Asset\PackageFactory($this);
    }

    /**
     * Gets the 'templating.globals' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables A Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables instance.
     */
    protected function getTemplating_GlobalsService()
    {
        return $this->services['templating.globals'] = new \Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables($this);
    }

    /**
     * Gets the 'templating.helper.actions' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\FrameworkBundle\Templating\Helper\ActionsHelper A Symfony\Bundle\FrameworkBundle\Templating\Helper\ActionsHelper instance.
     */
    protected function getTemplating_Helper_ActionsService()
    {
        return $this->services['templating.helper.actions'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\ActionsHelper($this->get('http_kernel'));
    }

    /**
     * Gets the 'templating.helper.assets' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Templating\Helper\CoreAssetsHelper A Symfony\Component\Templating\Helper\CoreAssetsHelper instance.
     */
    protected function getTemplating_Helper_AssetsService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('templating.helper.assets', 'request');
        }

        return $this->services['templating.helper.assets'] = $this->scopedServices['request']['templating.helper.assets'] = new \Symfony\Component\Templating\Helper\CoreAssetsHelper(new \Symfony\Bundle\FrameworkBundle\Templating\Asset\PathPackage($this->get('request'), NULL, NULL), array());
    }

    /**
     * Gets the 'templating.helper.code' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\FrameworkBundle\Templating\Helper\CodeHelper A Symfony\Bundle\FrameworkBundle\Templating\Helper\CodeHelper instance.
     */
    protected function getTemplating_Helper_CodeService()
    {
        return $this->services['templating.helper.code'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\CodeHelper(NULL, '/Users/guillaumemigeon/Sites/orchestra-cmf/app', 'UTF-8');
    }

    /**
     * Gets the 'templating.helper.form' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\FrameworkBundle\Templating\Helper\FormHelper A Symfony\Bundle\FrameworkBundle\Templating\Helper\FormHelper instance.
     */
    protected function getTemplating_Helper_FormService()
    {
        $a = new \Symfony\Bundle\FrameworkBundle\Templating\PhpEngine($this->get('templating.name_parser'), $this, $this->get('templating.loader'), $this->get('templating.globals'));
        $a->setCharset('UTF-8');
        $a->setHelpers(array('slots' => 'templating.helper.slots', 'assets' => 'templating.helper.assets', 'request' => 'templating.helper.request', 'session' => 'templating.helper.session', 'router' => 'templating.helper.router', 'actions' => 'templating.helper.actions', 'code' => 'templating.helper.code', 'translator' => 'templating.helper.translator', 'form' => 'templating.helper.form', 'security' => 'templating.helper.security', 'assetic' => 'assetic.helper.dynamic', 'pi_google_analytics' => 'pi_google.helper.analytics', 'pi_facebook_analytics' => 'pi_facebook.helper.analytics'));

        return $this->services['templating.helper.form'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\FormHelper($a, array(0 => 'FrameworkBundle:Form'));
    }

    /**
     * Gets the 'templating.helper.request' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\FrameworkBundle\Templating\Helper\RequestHelper A Symfony\Bundle\FrameworkBundle\Templating\Helper\RequestHelper instance.
     */
    protected function getTemplating_Helper_RequestService()
    {
        return $this->services['templating.helper.request'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\RequestHelper($this->get('request'));
    }

    /**
     * Gets the 'templating.helper.router' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\FrameworkBundle\Templating\Helper\RouterHelper A Symfony\Bundle\FrameworkBundle\Templating\Helper\RouterHelper instance.
     */
    protected function getTemplating_Helper_RouterService()
    {
        return $this->services['templating.helper.router'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\RouterHelper($this->get('i18n_routing.router'));
    }

    /**
     * Gets the 'templating.helper.security' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\SecurityBundle\Templating\Helper\SecurityHelper A Symfony\Bundle\SecurityBundle\Templating\Helper\SecurityHelper instance.
     */
    protected function getTemplating_Helper_SecurityService()
    {
        return $this->services['templating.helper.security'] = new \Symfony\Bundle\SecurityBundle\Templating\Helper\SecurityHelper($this->get('security.context'));
    }

    /**
     * Gets the 'templating.helper.session' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\FrameworkBundle\Templating\Helper\SessionHelper A Symfony\Bundle\FrameworkBundle\Templating\Helper\SessionHelper instance.
     */
    protected function getTemplating_Helper_SessionService()
    {
        return $this->services['templating.helper.session'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\SessionHelper($this->get('request'));
    }

    /**
     * Gets the 'templating.helper.slots' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Templating\Helper\SlotsHelper A Symfony\Component\Templating\Helper\SlotsHelper instance.
     */
    protected function getTemplating_Helper_SlotsService()
    {
        return $this->services['templating.helper.slots'] = new \Symfony\Component\Templating\Helper\SlotsHelper();
    }

    /**
     * Gets the 'templating.helper.translator' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\FrameworkBundle\Templating\Helper\TranslatorHelper A Symfony\Bundle\FrameworkBundle\Templating\Helper\TranslatorHelper instance.
     */
    protected function getTemplating_Helper_TranslatorService()
    {
        return $this->services['templating.helper.translator'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\TranslatorHelper($this->get('translator.default'));
    }

    /**
     * Gets the 'templating.loader' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\FrameworkBundle\Templating\Loader\FilesystemLoader A Symfony\Bundle\FrameworkBundle\Templating\Loader\FilesystemLoader instance.
     */
    protected function getTemplating_LoaderService()
    {
        return $this->services['templating.loader'] = new \Symfony\Bundle\FrameworkBundle\Templating\Loader\FilesystemLoader($this->get('templating.locator'));
    }

    /**
     * Gets the 'templating.name_parser' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\FrameworkBundle\Templating\TemplateNameParser A Symfony\Bundle\FrameworkBundle\Templating\TemplateNameParser instance.
     */
    protected function getTemplating_NameParserService()
    {
        return $this->services['templating.name_parser'] = new \Symfony\Bundle\FrameworkBundle\Templating\TemplateNameParser($this->get('kernel'));
    }

    /**
     * Gets the 'translation.loader.php' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Translation\Loader\PhpFileLoader A Symfony\Component\Translation\Loader\PhpFileLoader instance.
     */
    protected function getTranslation_Loader_PhpService()
    {
        return $this->services['translation.loader.php'] = new \Symfony\Component\Translation\Loader\PhpFileLoader();
    }

    /**
     * Gets the 'translation.loader.xliff' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Translation\Loader\XliffFileLoader A Symfony\Component\Translation\Loader\XliffFileLoader instance.
     */
    protected function getTranslation_Loader_XliffService()
    {
        return $this->services['translation.loader.xliff'] = new \Symfony\Component\Translation\Loader\XliffFileLoader();
    }

    /**
     * Gets the 'translation.loader.yml' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Translation\Loader\YamlFileLoader A Symfony\Component\Translation\Loader\YamlFileLoader instance.
     */
    protected function getTranslation_Loader_YmlService()
    {
        return $this->services['translation.loader.yml'] = new \Symfony\Component\Translation\Loader\YamlFileLoader();
    }

    /**
     * Gets the 'translator.default' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\FrameworkBundle\Translation\Translator A Symfony\Bundle\FrameworkBundle\Translation\Translator instance.
     */
    protected function getTranslator_DefaultService()
    {
        $this->services['translator.default'] = $instance = new \Symfony\Bundle\FrameworkBundle\Translation\Translator($this, new \Symfony\Component\Translation\MessageSelector(), array('translation.loader.php' => 'php', 'translation.loader.yml' => 'yml', 'translation.loader.xliff' => 'xliff'), array('cache_dir' => '/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/dev/translations', 'debug' => true), $this->get('session'));

        $instance->setFallbackLocale('en_GB');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.ca.xliff', 'ca', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.cs.xliff', 'cs', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.da.xliff', 'da', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.de.xliff', 'de', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.es.xliff', 'es', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.et.xliff', 'et', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.eu.xliff', 'eu', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.fa.xliff', 'fa', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.fi.xliff', 'fi', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.fr.xliff', 'fr', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.he.xliff', 'he', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.hr.xliff', 'hr', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.hu.xliff', 'hu', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.hy.xliff', 'hy', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.id.xliff', 'id', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.it.xliff', 'it', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.ja.xliff', 'ja', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.lb.xliff', 'lb', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.lt.xliff', 'lt', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.mn.xliff', 'mn', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.nl.xliff', 'nl', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.pl.xliff', 'pl', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.pt_BR.xliff', 'pt_BR', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.pt_PT.xliff', 'pt_PT', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.ro.xliff', 'ro', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.ru.xliff', 'ru', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.sk.xliff', 'sk', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.sl.xliff', 'sl', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.sr.xliff', 'sr', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.sv.xliff', 'sv', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.ua.xliff', 'ua', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/translations/validators.zh_CN.xliff', 'zh_CN', 'validators');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/AdminBundle/Resources/translations/SonataAdminBundle.ca.xliff', 'ca', 'SonataAdminBundle');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/AdminBundle/Resources/translations/SonataAdminBundle.de.xliff', 'de', 'SonataAdminBundle');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/AdminBundle/Resources/translations/SonataAdminBundle.en.xliff', 'en', 'SonataAdminBundle');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/AdminBundle/Resources/translations/SonataAdminBundle.es.xliff', 'es', 'SonataAdminBundle');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/AdminBundle/Resources/translations/SonataAdminBundle.fr.xliff', 'fr', 'SonataAdminBundle');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/AdminBundle/Resources/translations/SonataAdminBundle.hr.xliff', 'hr', 'SonataAdminBundle');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/AdminBundle/Resources/translations/SonataAdminBundle.it.xliff', 'it', 'SonataAdminBundle');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/AdminBundle/Resources/translations/SonataAdminBundle.ja.xliff', 'ja', 'SonataAdminBundle');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/AdminBundle/Resources/translations/SonataAdminBundle.lb.xliff', 'lb', 'SonataAdminBundle');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/AdminBundle/Resources/translations/SonataAdminBundle.nl.xliff', 'nl', 'SonataAdminBundle');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/AdminBundle/Resources/translations/SonataAdminBundle.pl.xliff', 'pl', 'SonataAdminBundle');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/AdminBundle/Resources/translations/SonataAdminBundle.pt_BR.xliff', 'pt_BR', 'SonataAdminBundle');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/AdminBundle/Resources/translations/SonataAdminBundle.pt_PT.xliff', 'pt_PT', 'SonataAdminBundle');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/AdminBundle/Resources/translations/SonataAdminBundle.ru.xliff', 'ru', 'SonataAdminBundle');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/AdminBundle/Resources/translations/SonataAdminBundle.sk.xliff', 'sk', 'SonataAdminBundle');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/AdminBundle/Resources/translations/SonataAdminBundle.sl.xliff', 'sl', 'SonataAdminBundle');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/AdminBundle/Resources/translations/SonataAdminBundle.uk.xliff', 'uk', 'SonataAdminBundle');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/MediaBundle/Resources/translations/SonataMediaBundle.de.xliff', 'de', 'SonataMediaBundle');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/MediaBundle/Resources/translations/SonataMediaBundle.en.xliff', 'en', 'SonataMediaBundle');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/MediaBundle/Resources/translations/SonataMediaBundle.es.xliff', 'es', 'SonataMediaBundle');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/MediaBundle/Resources/translations/SonataMediaBundle.fr.xliff', 'fr', 'SonataMediaBundle');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/MediaBundle/Resources/translations/SonataMediaBundle.sl.xliff', 'sl', 'SonataMediaBundle');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/FOSUserBundle.ar_SA.yml', 'ar_SA', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/FOSUserBundle.bg.yml', 'bg', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/FOSUserBundle.ca.yml', 'ca', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/FOSUserBundle.cs.yml', 'cs', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/FOSUserBundle.da.yml', 'da', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/FOSUserBundle.de.yml', 'de', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/FOSUserBundle.en.yml', 'en', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/FOSUserBundle.es.yml', 'es', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/FOSUserBundle.et.yml', 'et', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/FOSUserBundle.fi.yml', 'fi', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/FOSUserBundle.fr.yml', 'fr', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/FOSUserBundle.hr.yml', 'hr', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/FOSUserBundle.hu.yml', 'hu', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/FOSUserBundle.it.yml', 'it', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/FOSUserBundle.ja.yml', 'ja', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/FOSUserBundle.lb.yml', 'lb', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/FOSUserBundle.nl.yml', 'nl', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/FOSUserBundle.pl.yml', 'pl', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/FOSUserBundle.pt_BR.yml', 'pt_BR', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/FOSUserBundle.pt_PT.yml', 'pt_PT', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/FOSUserBundle.ro.yml', 'ro', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/FOSUserBundle.ru.yml', 'ru', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/FOSUserBundle.sk.yml', 'sk', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/FOSUserBundle.sl.yml', 'sl', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/FOSUserBundle.sr_Latn.yml', 'sr_Latn', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/FOSUserBundle.sv.yml', 'sv', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/FOSUserBundle.tr.yml', 'tr', 'FOSUserBundle');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/validators.ar_SA.yml', 'ar_SA', 'validators');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/validators.bg.yml', 'bg', 'validators');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/validators.cs.yml', 'cs', 'validators');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/validators.de.yml', 'de', 'validators');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/validators.en.yml', 'en', 'validators');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/validators.es.yml', 'es', 'validators');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/validators.fi.yml', 'fi', 'validators');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/validators.fr.yml', 'fr', 'validators');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/validators.hr.yml', 'hr', 'validators');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/validators.it.yml', 'it', 'validators');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/validators.ja.yml', 'ja', 'validators');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/validators.nl.yml', 'nl', 'validators');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/validators.pl.yml', 'pl', 'validators');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/validators.pt_BR.yml', 'pt_BR', 'validators');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/validators.ru.yml', 'ru', 'validators');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/validators.sk.yml', 'sk', 'validators');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/validators.sl.yml', 'sl', 'validators');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/validators.sr_Latn.yml', 'sr_Latn', 'validators');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/translations/validators.tr.yml', 'tr', 'validators');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/BootStrap/AdminBundle/Resources/translations/group.en.yml', 'en', 'group');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/BootStrap/AdminBundle/Resources/translations/group.fr.yml', 'fr', 'group');
        $instance->addResource('xliff', '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/BootStrap/FacebookBundle/Resources/translations/messages.fr.xliff', 'fr', 'messages');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/PiApp/AdminBundle/Resources/translations/messages.ar.yml', 'ar', 'messages');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/PiApp/AdminBundle/Resources/translations/messages.en_GB.yml', 'en_GB', 'messages');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/PiApp/AdminBundle/Resources/translations/messages.fr_FR.yml', 'fr_FR', 'messages');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/PiApp/AdminBundle/Resources/translations/validators.ar.yml', 'ar', 'validators');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/PiApp/AdminBundle/Resources/translations/validators.en_GB.yml', 'en_GB', 'validators');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/PiApp/AdminBundle/Resources/translations/validators.fr_FR.yml', 'fr_FR', 'validators');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/PiApp/GedmoBundle/Resources/translations/messages.ar.yml', 'ar', 'messages');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/PiApp/GedmoBundle/Resources/translations/messages.en_GB.yml', 'en_GB', 'messages');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/PiApp/GedmoBundle/Resources/translations/messages.fr_FR.yml', 'fr_FR', 'messages');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/PiApp/GedmoBundle/Resources/translations/validators.en_GB.yml', 'en_GB', 'validators');
        $instance->addResource('yml', '/Users/guillaumemigeon/Sites/orchestra-cmf/src/Orchestra/PiApp/GedmoBundle/Resources/translations/validators.fr_FR.yml', 'fr_FR', 'validators');

        return $instance;
    }

    /**
     * Gets the 'twig' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Twig_Environment A Twig_Environment instance.
     */
    protected function getTwigService()
    {
        $this->services['twig'] = $instance = new \Twig_Environment($this->get('twig.loader'), array('exception_controller' => 'Symfony\\Bundle\\TwigBundle\\Controller\\ExceptionController::showAction', 'charset' => 'utf-8', 'debug' => true, 'strict_variables' => true, 'auto_reload' => NULL, 'cache' => '/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/dev/twig'));

        $instance->addExtension($this->get('twig.extension.security'));
        $instance->addExtension($this->get('twig.extension.trans'));
        $instance->addExtension($this->get('twig.extension.assets'));
        $instance->addExtension($this->get('twig.extension.actions'));
        $instance->addExtension($this->get('twig.extension.code'));
        $instance->addExtension($this->get('twig.extension.routing'));
        $instance->addExtension($this->get('twig.extension.yaml'));
        $instance->addExtension($this->get('twig.extension.form'));
        $instance->addExtension($this->get('assetic.twig_extension'));
        $instance->addExtension($this->get('sonata.admin.twig.extension'));
        $instance->addExtension($this->get('sonata.block.twig.extension'));
        $instance->addExtension($this->get('sonata.media.twig.extension'));
        $instance->addExtension($this->get('knp_menu.twig.extension'));
        $instance->addExtension($this->get('pi_google.twig.extension.analytics'));
        $instance->addExtension($this->get('pi_facebook.twig.extension.analytics'));
        $instance->addExtension($this->get('twig.extension.text'));
        $instance->addExtension($this->get('twig.extension.intl'));
        $instance->addExtension($this->get('debug.twig.extension'));
        $instance->addExtension($this->get('pi_app_admin.twig.extension.forward'));
        $instance->addExtension($this->get('pi_app_admin.twig.extension.service'));
        $instance->addExtension($this->get('pi_app_admin.twig.extension.jquery'));
        $instance->addExtension($this->get('pi_app_admin.twig.extension.widget'));
        $instance->addExtension($this->get('pi_app_admin.twig.extension.date'));
        $instance->addExtension($this->get('pi_app_admin.twig.extension.tool'));
        $instance->addExtension($this->get('pi_app_admin.twig.extension.route'));
        $instance->addExtension($this->get('pi_app_admin.twig.extension.layouthead'));
        $instance->addExtension($this->get('twig.extension.acme.demo'));

        return $instance;
    }

    /**
     * Gets the 'twig.exception_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\HttpKernel\EventListener\ExceptionListener A Symfony\Component\HttpKernel\EventListener\ExceptionListener instance.
     */
    protected function getTwig_ExceptionListenerService()
    {
        return $this->services['twig.exception_listener'] = new \Symfony\Component\HttpKernel\EventListener\ExceptionListener('Symfony\\Bundle\\TwigBundle\\Controller\\ExceptionController::showAction', $this->get('monolog.logger.request'));
    }

    /**
     * Gets the 'twig.extension.intl' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Twig_Extensions_Extension_Intl A Twig_Extensions_Extension_Intl instance.
     */
    protected function getTwig_Extension_IntlService()
    {
        return $this->services['twig.extension.intl'] = new \Twig_Extensions_Extension_Intl();
    }

    /**
     * Gets the 'twig.extension.text' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Twig_Extensions_Extension_Text A Twig_Extensions_Extension_Text instance.
     */
    protected function getTwig_Extension_TextService()
    {
        return $this->services['twig.extension.text'] = new \Twig_Extensions_Extension_Text();
    }

    /**
     * Gets the 'twig.loader' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\TwigBundle\Loader\FilesystemLoader A Symfony\Bundle\TwigBundle\Loader\FilesystemLoader instance.
     */
    protected function getTwig_LoaderService()
    {
        $this->services['twig.loader'] = $instance = new \Symfony\Bundle\TwigBundle\Loader\FilesystemLoader($this->get('templating.locator'), $this->get('templating.name_parser'));

        $instance->addPath('/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bridge/Twig/Resources/views/Form');
        $instance->addPath('/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/Knp-menu/src/Knp/Menu/Resources/views');

        return $instance;
    }

    /**
     * Gets the 'validator' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Component\Validator\Validator A Symfony\Component\Validator\Validator instance.
     */
    protected function getValidatorService()
    {
        return $this->services['validator'] = new \Symfony\Component\Validator\Validator($this->get('validator.mapping.class_metadata_factory'), $this->get('validator.validator_factory'), array(0 => $this->get('doctrine.orm.validator_initializer')));
    }

    /**
     * Gets the 'web_profiler.debug_toolbar' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return Symfony\Bundle\WebProfilerBundle\EventListener\WebDebugToolbarListener A Symfony\Bundle\WebProfilerBundle\EventListener\WebDebugToolbarListener instance.
     */
    protected function getWebProfiler_DebugToolbarService()
    {
        return $this->services['web_profiler.debug_toolbar'] = new \Symfony\Bundle\WebProfilerBundle\EventListener\WebDebugToolbarListener($this->get('templating'), false, 2);
    }

    /**
     * Gets the database_connection service alias.
     *
     * @return stdClass An instance of the doctrine.dbal.default_connection service
     */
    protected function getDatabaseConnectionService()
    {
        return $this->get('doctrine.dbal.default_connection');
    }

    /**
     * Gets the debug.event_dispatcher service alias.
     *
     * @return Symfony\Bundle\FrameworkBundle\Debug\TraceableEventDispatcher An instance of the event_dispatcher service
     */
    protected function getDebug_EventDispatcherService()
    {
        return $this->get('event_dispatcher');
    }

    /**
     * Gets the doctrine.orm.entity_manager service alias.
     *
     * @return Doctrine\ORM\EntityManager An instance of the doctrine.orm.default_entity_manager service
     */
    protected function getDoctrine_Orm_EntityManagerService()
    {
        return $this->get('doctrine.orm.default_entity_manager');
    }

    /**
     * Gets the fos_user.change_password.form.handler service alias.
     *
     * @return FOS\UserBundle\Form\Handler\ChangePasswordFormHandler An instance of the fos_user.change_password.form.handler.default service
     */
    protected function getFosUser_ChangePassword_Form_HandlerService()
    {
        return $this->get('fos_user.change_password.form.handler.default');
    }

    /**
     * Gets the fos_user.util.username_canonicalizer service alias.
     *
     * @return FOS\UserBundle\Util\Canonicalizer An instance of the fos_user.util.email_canonicalizer service
     */
    protected function getFosUser_Util_UsernameCanonicalizerService()
    {
        return $this->get('fos_user.util.email_canonicalizer');
    }

    /**
     * Gets the router service alias.
     *
     * @return BeSimple\I18nRoutingBundle\Routing\Router An instance of the i18n_routing.router service
     */
    protected function getRouterService()
    {
        return $this->get('i18n_routing.router');
    }

    /**
     * Gets the security.acl.dbal.connection service alias.
     *
     * @return stdClass An instance of the doctrine.dbal.default_connection service
     */
    protected function getSecurity_Acl_Dbal_ConnectionService()
    {
        return $this->get('doctrine.dbal.default_connection');
    }

    /**
     * Gets the sonata.media.entity_manager service alias.
     *
     * @return Doctrine\ORM\EntityManager An instance of the doctrine.orm.default_entity_manager service
     */
    protected function getSonata_Media_EntityManagerService()
    {
        return $this->get('doctrine.orm.default_entity_manager');
    }

    /**
     * Gets the translator service alias.
     *
     * @return Symfony\Bundle\FrameworkBundle\Translation\Translator An instance of the translator.default service
     */
    protected function getTranslatorService()
    {
        return $this->get('translator.default');
    }

    /**
     * Gets the 'assetic.asset_factory' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Symfony\Bundle\AsseticBundle\Factory\AssetFactory A Symfony\Bundle\AsseticBundle\Factory\AssetFactory instance.
     */
    protected function getAssetic_AssetFactoryService()
    {
        $this->services['assetic.asset_factory'] = $instance = new \Symfony\Bundle\AsseticBundle\Factory\AssetFactory($this->get('kernel'), $this, new \Symfony\Component\DependencyInjection\ParameterBag\ParameterBag($this->getDefaultParameters()), '/Users/guillaumemigeon/Sites/orchestra-cmf/app/../web', true);

        $instance->addWorker(new \Symfony\Bundle\AsseticBundle\Factory\Worker\UseControllerWorker());

        return $instance;
    }

    /**
     * Gets the 'assetic.cache' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Assetic\Cache\FilesystemCache A Assetic\Cache\FilesystemCache instance.
     */
    protected function getAssetic_CacheService()
    {
        return $this->services['assetic.cache'] = new \Assetic\Cache\FilesystemCache('/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/dev/assetic/assets');
    }

    /**
     * Gets the 'assetic.twig_extension' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Symfony\Bundle\AsseticBundle\Twig\AsseticExtension A Symfony\Bundle\AsseticBundle\Twig\AsseticExtension instance.
     */
    protected function getAssetic_TwigExtensionService()
    {
        return $this->services['assetic.twig_extension'] = new \Symfony\Bundle\AsseticBundle\Twig\AsseticExtension($this->get('assetic.asset_factory'), true, array());
    }

    /**
     * Gets the 'controller_name_converter' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Symfony\Bundle\FrameworkBundle\Controller\ControllerNameParser A Symfony\Bundle\FrameworkBundle\Controller\ControllerNameParser instance.
     */
    protected function getControllerNameConverterService()
    {
        return $this->services['controller_name_converter'] = new \Symfony\Bundle\FrameworkBundle\Controller\ControllerNameParser($this->get('kernel'));
    }

    /**
     * Gets the 'doctrine.dbal.logger' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Symfony\Bridge\Doctrine\Logger\DbalLogger A Symfony\Bridge\Doctrine\Logger\DbalLogger instance.
     */
    protected function getDoctrine_Dbal_LoggerService()
    {
        return $this->services['doctrine.dbal.logger'] = new \Symfony\Bridge\Doctrine\Logger\DbalLogger($this->get('monolog.logger.doctrine'));
    }

    /**
     * Gets the 'fos_user.entity_manager' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Doctrine\ORM\EntityManager A Doctrine\ORM\EntityManager instance.
     */
    protected function getFosUser_EntityManagerService()
    {
        return $this->services['fos_user.entity_manager'] = $this->get('doctrine')->getEntityManager(NULL);
    }

    /**
     * Gets the 'knp_menu.twig.extension' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Knp\Menu\Twig\MenuExtension A Knp\Menu\Twig\MenuExtension instance.
     */
    protected function getKnpMenu_Twig_ExtensionService()
    {
        return $this->services['knp_menu.twig.extension'] = new \Knp\Menu\Twig\MenuExtension(new \Knp\Menu\Twig\Helper($this->get('knp_menu.renderer_provider'), $this->get('knp_menu.menu_provider')));
    }

    /**
     * Gets the 'security.access.decision_manager' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Symfony\Component\Security\Core\Authorization\AccessDecisionManager A Symfony\Component\Security\Core\Authorization\AccessDecisionManager instance.
     */
    protected function getSecurity_Access_DecisionManagerService()
    {
        return $this->services['security.access.decision_manager'] = new \Symfony\Component\Security\Core\Authorization\AccessDecisionManager(array(0 => new \Symfony\Component\Security\Core\Authorization\Voter\RoleHierarchyVoter($this->get('security.role_hierarchy')), 1 => new \Symfony\Component\Security\Core\Authorization\Voter\AuthenticatedVoter($this->get('security.authentication.trust_resolver')), 2 => new \Symfony\Component\Security\Acl\Voter\AclVoter($this->get('security.acl.provider'), $this->get('security.acl.object_identity_retrieval_strategy'), $this->get('security.acl.security_identity_retrieval_strategy'), $this->get('security.acl.permission.map'), $this->get('monolog.logger.security'), true)), 'unanimous', false, true);
    }

    /**
     * Gets the 'security.access_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Symfony\Component\Security\Http\Firewall\AccessListener A Symfony\Component\Security\Http\Firewall\AccessListener instance.
     */
    protected function getSecurity_AccessListenerService()
    {
        return $this->services['security.access_listener'] = new \Symfony\Component\Security\Http\Firewall\AccessListener($this->get('security.context'), $this->get('security.access.decision_manager'), $this->get('security.access_map'), $this->get('security.authentication.manager'), $this->get('monolog.logger.security'));
    }

    /**
     * Gets the 'security.access_map' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Symfony\Component\Security\Http\AccessMap A Symfony\Component\Security\Http\AccessMap instance.
     */
    protected function getSecurity_AccessMapService()
    {
        $this->services['security.access_map'] = $instance = new \Symfony\Component\Security\Http\AccessMap();

        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/_wdt/'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/_profiler/'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/js/'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/css/'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), NULL);
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/login$'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), 'http');
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/login_check$'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), 'http');
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/user/change-password$'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), 'http');
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/user/profile$'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), 'http');
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/user/profile/edit$'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), 'http');
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/user/register$'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), 'http');
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/user/register/check-email$'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), 'http');
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/user/register/confirm/'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), 'http');
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/user/register/confirmed$'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), 'http');
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/user/resseting/request$'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), 'http');
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/user/resseting/send-email$'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), 'http');
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/user/resseting/check-email$'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), 'http');
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/user/resseting/reset/'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), 'http');
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/admin/'), array(0 => 'ROLE_USER'), 'http');
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/adminsonata/'), array(0 => 'ROLE_SUPER_ADMIN'), 'http');
        $instance->add(new \Symfony\Component\HttpFoundation\RequestMatcher('^/.*'), array(0 => 'IS_AUTHENTICATED_ANONYMOUSLY'), 'http');

        return $instance;
    }

    /**
     * Gets the 'security.acl.object_identity_retrieval_strategy' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Symfony\Component\Security\Acl\Domain\ObjectIdentityRetrievalStrategy A Symfony\Component\Security\Acl\Domain\ObjectIdentityRetrievalStrategy instance.
     */
    protected function getSecurity_Acl_ObjectIdentityRetrievalStrategyService()
    {
        return $this->services['security.acl.object_identity_retrieval_strategy'] = new \Symfony\Component\Security\Acl\Domain\ObjectIdentityRetrievalStrategy();
    }

    /**
     * Gets the 'security.acl.permission.map' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Sonata\AdminBundle\Security\Acl\Permission\AdminPermissionMap A Sonata\AdminBundle\Security\Acl\Permission\AdminPermissionMap instance.
     */
    protected function getSecurity_Acl_Permission_MapService()
    {
        return $this->services['security.acl.permission.map'] = new \Sonata\AdminBundle\Security\Acl\Permission\AdminPermissionMap();
    }

    /**
     * Gets the 'security.acl.security_identity_retrieval_strategy' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Symfony\Component\Security\Acl\Domain\SecurityIdentityRetrievalStrategy A Symfony\Component\Security\Acl\Domain\SecurityIdentityRetrievalStrategy instance.
     */
    protected function getSecurity_Acl_SecurityIdentityRetrievalStrategyService()
    {
        return $this->services['security.acl.security_identity_retrieval_strategy'] = new \Symfony\Component\Security\Acl\Domain\SecurityIdentityRetrievalStrategy($this->get('security.role_hierarchy'), $this->get('security.authentication.trust_resolver'));
    }

    /**
     * Gets the 'security.authentication.manager' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Symfony\Component\Security\Core\Authentication\AuthenticationProviderManager A Symfony\Component\Security\Core\Authentication\AuthenticationProviderManager instance.
     */
    protected function getSecurity_Authentication_ManagerService()
    {
        $a = $this->get('fos_user.user_checker');
        $b = $this->get('security.encoder_factory');

        return $this->services['security.authentication.manager'] = new \Symfony\Component\Security\Core\Authentication\AuthenticationProviderManager(array(0 => new \Symfony\Component\Security\Core\Authentication\Provider\DaoAuthenticationProvider($this->get('fos_user.user_manager'), $a, 'main', $b, true), 1 => new \Symfony\Component\Security\Core\Authentication\Provider\RememberMeAuthenticationProvider($a, '5b5a0ff57bd45284dafe7f104fc7d8e15', 'main'), 2 => new \Symfony\Component\Security\Core\Authentication\Provider\AnonymousAuthenticationProvider('508ac52290a86'), 3 => new \Symfony\Component\Security\Core\Authentication\Provider\DaoAuthenticationProvider($this->get('security.user.provider.concrete.in_memory'), $a, 'secured_area', $b, true)));
    }

    /**
     * Gets the 'security.authentication.session_strategy' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Symfony\Component\Security\Http\Session\SessionAuthenticationStrategy A Symfony\Component\Security\Http\Session\SessionAuthenticationStrategy instance.
     */
    protected function getSecurity_Authentication_SessionStrategyService()
    {
        return $this->services['security.authentication.session_strategy'] = new \Symfony\Component\Security\Http\Session\SessionAuthenticationStrategy('migrate');
    }

    /**
     * Gets the 'security.authentication.trust_resolver' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Symfony\Component\Security\Core\Authentication\AuthenticationTrustResolver A Symfony\Component\Security\Core\Authentication\AuthenticationTrustResolver instance.
     */
    protected function getSecurity_Authentication_TrustResolverService()
    {
        return $this->services['security.authentication.trust_resolver'] = new \Symfony\Component\Security\Core\Authentication\AuthenticationTrustResolver('Symfony\\Component\\Security\\Core\\Authentication\\Token\\AnonymousToken', 'Symfony\\Component\\Security\\Core\\Authentication\\Token\\RememberMeToken');
    }

    /**
     * Gets the 'security.channel_listener' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Symfony\Component\Security\Http\Firewall\ChannelListener A Symfony\Component\Security\Http\Firewall\ChannelListener instance.
     */
    protected function getSecurity_ChannelListenerService()
    {
        return $this->services['security.channel_listener'] = new \Symfony\Component\Security\Http\Firewall\ChannelListener($this->get('security.access_map'), new \Symfony\Component\Security\Http\EntryPoint\RetryAuthenticationEntryPoint(80, 443), $this->get('monolog.logger.security'));
    }

    /**
     * Gets the 'security.http_utils' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Symfony\Component\Security\Http\HttpUtils A Symfony\Component\Security\Http\HttpUtils instance.
     */
    protected function getSecurity_HttpUtilsService()
    {
        return $this->services['security.http_utils'] = new \Symfony\Component\Security\Http\HttpUtils($this->get('i18n_routing.router'));
    }

    /**
     * Gets the 'security.logout.handler.session' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Symfony\Component\Security\Http\Logout\SessionLogoutHandler A Symfony\Component\Security\Http\Logout\SessionLogoutHandler instance.
     */
    protected function getSecurity_Logout_Handler_SessionService()
    {
        return $this->services['security.logout.handler.session'] = new \Symfony\Component\Security\Http\Logout\SessionLogoutHandler();
    }

    /**
     * Gets the 'security.role_hierarchy' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Symfony\Component\Security\Core\Role\RoleHierarchy A Symfony\Component\Security\Core\Role\RoleHierarchy instance.
     */
    protected function getSecurity_RoleHierarchyService()
    {
        return $this->services['security.role_hierarchy'] = new \Symfony\Component\Security\Core\Role\RoleHierarchy(array('ROLE_USER' => array(0 => 'ROLE_ALLOWED_TO_SWITCH'), 'ROLE_SUBSCRIBER' => array(0 => 'ROLE_USER', 1 => 'ROLE_ALLOWED_TO_SWITCH'), 'ROLE_EDITOR' => array(0 => 'ROLE_USER', 1 => 'ROLE_ALLOWED_TO_SWITCH'), 'ROLE_MODERATOR' => array(0 => 'ROLE_EDITOR', 1 => 'ROLE_ALLOWED_TO_SWITCH'), 'ROLE_DESIGNER' => array(0 => 'ROLE_USER', 1 => 'ROLE_ALLOWED_TO_SWITCH'), 'ROLE_CONTENT_MANAGER' => array(0 => 'ROLE_DESIGNER', 1 => 'ROLE_MODERATOR', 2 => 'ROLE_ALLOWED_TO_SWITCH'), 'ROLE_ADMIN' => array(0 => 'ROLE_CONTENT_MANAGER', 1 => 'ROLE_ALLOWED_TO_SWITCH'), 'SONATA' => array(0 => 'ROLE_SONATA_PAGE_ADMIN_PAGE_EDIT ', 1 => 'ROLE_SONATA_PAGE_ADMIN_BLOCK_EDIT', 2 => 'ROLE_ALLOWED_TO_SWITCH'), 'ROLE_SUPER_ADMIN' => array(0 => 'ROLE_ADMIN', 1 => 'ROLE_ALLOWED_TO_SWITCH', 2 => 'ROLE_SONATA_ADMIN', 3 => 'SONATA')));
    }

    /**
     * Gets the 'security.user.provider.concrete.in_memory' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Symfony\Component\Security\Core\User\InMemoryUserProvider A Symfony\Component\Security\Core\User\InMemoryUserProvider instance.
     */
    protected function getSecurity_User_Provider_Concrete_InMemoryService()
    {
        $this->services['security.user.provider.concrete.in_memory'] = $instance = new \Symfony\Component\Security\Core\User\InMemoryUserProvider();

        $instance->createUser(new \Symfony\Component\Security\Core\User\User('etienne', 'coincoin', array(0 => 'ROLE_USER')));
        $instance->createUser(new \Symfony\Component\Security\Core\User\User('admin', 'adminpsw', array(0 => 'ROLE_ADMIN')));

        return $instance;
    }

    /**
     * Gets the 'sonata.block.manager' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Sonata\BlockBundle\Block\BlockServiceManager A Sonata\BlockBundle\Block\BlockServiceManager instance.
     */
    protected function getSonata_Block_ManagerService()
    {
        $this->services['sonata.block.manager'] = $instance = new \Sonata\BlockBundle\Block\BlockServiceManager($this, true, $this->get('logger'));

        $instance->add('sonata.admin.block.admin_list', 'sonata.admin.block.admin_list');
        $instance->add('sonata.admin_doctrine_orm.block.audit', 'sonata.admin_doctrine_orm.block.audit');
        $instance->add('sonata.block.service.text', 'sonata.block.service.text');
        $instance->add('sonata.block.service.action', 'sonata.block.service.action');
        $instance->add('sonata.block.service.rss', 'sonata.block.service.rss');
        $instance->add('sonata.media.block.media', 'sonata.media.block.media');
        $instance->add('sonata.media.block.feature_media', 'sonata.media.block.feature_media');
        $instance->add('sonata.media.block.gallery', 'sonata.media.block.gallery');

        return $instance;
    }

    /**
     * Gets the 'sonata.block.twig.extension' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Sonata\BlockBundle\Twig\Extension\BlockExtension A Sonata\BlockBundle\Twig\Extension\BlockExtension instance.
     */
    protected function getSonata_Block_Twig_ExtensionService()
    {
        return $this->services['sonata.block.twig.extension'] = new \Sonata\BlockBundle\Twig\Extension\BlockExtension($this->get('sonata.block.manager'), $this->get('sonata.cache.manager'), array('sonata.admin.block.admin_list' => 'sonata.cache.noop', 'sonata.block.service.text' => 'sonata.cache.noop', 'sonata.block.service.action' => 'sonata.cache.noop', 'sonata.block.service.rss' => 'sonata.cache.noop'), $this->get('sonata.block.loader.chain'), $this->get('sonata.block.renderer'));
    }

    /**
     * Gets the 'stof_doctrine_extensions.listener.loggable' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Gedmo\Loggable\LoggableListener A Gedmo\Loggable\LoggableListener instance.
     */
    protected function getStofDoctrineExtensions_Listener_LoggableService()
    {
        $this->services['stof_doctrine_extensions.listener.loggable'] = $instance = new \Gedmo\Loggable\LoggableListener();

        $instance->setAnnotationReader($this->get('annotation_reader'));

        return $instance;
    }

    /**
     * Gets the 'stof_doctrine_extensions.listener.translatable' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Gedmo\Translatable\TranslatableListener A Gedmo\Translatable\TranslatableListener instance.
     */
    protected function getStofDoctrineExtensions_Listener_TranslatableService()
    {
        $this->services['stof_doctrine_extensions.listener.translatable'] = $instance = new \Gedmo\Translatable\TranslatableListener();

        $instance->setAnnotationReader($this->get('annotation_reader'));
        $instance->setDefaultLocale('en_GB');
        $instance->setTranslatableLocale('en_GB');
        $instance->setTranslationFallback(true);
        $instance->setPersistDefaultLocaleTranslation(false);

        return $instance;
    }

    /**
     * Gets the 'templating.locator' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Symfony\Bundle\FrameworkBundle\Templating\Loader\TemplateLocator A Symfony\Bundle\FrameworkBundle\Templating\Loader\TemplateLocator instance.
     */
    protected function getTemplating_LocatorService()
    {
        return $this->services['templating.locator'] = new \Symfony\Bundle\FrameworkBundle\Templating\Loader\TemplateLocator($this->get('file_locator'), '/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/dev');
    }

    /**
     * Gets the 'twig.extension.acme.demo' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Acme\DemoBundle\Twig\Extension\DemoExtension A Acme\DemoBundle\Twig\Extension\DemoExtension instance.
     */
    protected function getTwig_Extension_Acme_DemoService()
    {
        return $this->services['twig.extension.acme.demo'] = new \Acme\DemoBundle\Twig\Extension\DemoExtension($this->get('twig.loader'));
    }

    /**
     * Gets the 'twig.extension.actions' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Symfony\Bundle\TwigBundle\Extension\ActionsExtension A Symfony\Bundle\TwigBundle\Extension\ActionsExtension instance.
     */
    protected function getTwig_Extension_ActionsService()
    {
        return $this->services['twig.extension.actions'] = new \Symfony\Bundle\TwigBundle\Extension\ActionsExtension($this);
    }

    /**
     * Gets the 'twig.extension.assets' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Symfony\Bundle\TwigBundle\Extension\AssetsExtension A Symfony\Bundle\TwigBundle\Extension\AssetsExtension instance.
     */
    protected function getTwig_Extension_AssetsService()
    {
        return $this->services['twig.extension.assets'] = new \Symfony\Bundle\TwigBundle\Extension\AssetsExtension($this);
    }

    /**
     * Gets the 'twig.extension.code' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Symfony\Bundle\TwigBundle\Extension\CodeExtension A Symfony\Bundle\TwigBundle\Extension\CodeExtension instance.
     */
    protected function getTwig_Extension_CodeService()
    {
        return $this->services['twig.extension.code'] = new \Symfony\Bundle\TwigBundle\Extension\CodeExtension($this);
    }

    /**
     * Gets the 'twig.extension.form' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Symfony\Bridge\Twig\Extension\FormExtension A Symfony\Bridge\Twig\Extension\FormExtension instance.
     */
    protected function getTwig_Extension_FormService()
    {
        return $this->services['twig.extension.form'] = new \Symfony\Bridge\Twig\Extension\FormExtension(array(0 => 'form_div_layout.html.twig'));
    }

    /**
     * Gets the 'twig.extension.routing' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Symfony\Bridge\Twig\Extension\RoutingExtension A Symfony\Bridge\Twig\Extension\RoutingExtension instance.
     */
    protected function getTwig_Extension_RoutingService()
    {
        return $this->services['twig.extension.routing'] = new \Symfony\Bridge\Twig\Extension\RoutingExtension($this->get('i18n_routing.router'));
    }

    /**
     * Gets the 'twig.extension.security' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Symfony\Bundle\SecurityBundle\Twig\Extension\SecurityExtension A Symfony\Bundle\SecurityBundle\Twig\Extension\SecurityExtension instance.
     */
    protected function getTwig_Extension_SecurityService()
    {
        return $this->services['twig.extension.security'] = new \Symfony\Bundle\SecurityBundle\Twig\Extension\SecurityExtension($this->get('security.context'));
    }

    /**
     * Gets the 'twig.extension.trans' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Symfony\Bridge\Twig\Extension\TranslationExtension A Symfony\Bridge\Twig\Extension\TranslationExtension instance.
     */
    protected function getTwig_Extension_TransService()
    {
        return $this->services['twig.extension.trans'] = new \Symfony\Bridge\Twig\Extension\TranslationExtension($this->get('translator.default'));
    }

    /**
     * Gets the 'twig.extension.yaml' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Symfony\Bridge\Twig\Extension\YamlExtension A Symfony\Bridge\Twig\Extension\YamlExtension instance.
     */
    protected function getTwig_Extension_YamlService()
    {
        return $this->services['twig.extension.yaml'] = new \Symfony\Bridge\Twig\Extension\YamlExtension();
    }

    /**
     * Gets the 'validator.mapping.class_metadata_factory' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Symfony\Component\Validator\Mapping\ClassMetadataFactory A Symfony\Component\Validator\Mapping\ClassMetadataFactory instance.
     */
    protected function getValidator_Mapping_ClassMetadataFactoryService()
    {
        return $this->services['validator.mapping.class_metadata_factory'] = new \Symfony\Component\Validator\Mapping\ClassMetadataFactory(new \Symfony\Component\Validator\Mapping\Loader\LoaderChain(array(0 => new \Symfony\Component\Validator\Mapping\Loader\AnnotationLoader($this->get('annotation_reader')), 1 => new \Symfony\Component\Validator\Mapping\Loader\StaticMethodLoader(), 2 => new \Symfony\Component\Validator\Mapping\Loader\XmlFilesLoader(array(0 => '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Component/Form/Resources/config/validation.xml', 1 => '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/MediaBundle/Resources/config/validation.xml', 2 => '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/config/validation.xml')), 3 => new \Symfony\Component\Validator\Mapping\Loader\YamlFilesLoader(array()))), NULL);
    }

    /**
     * Gets the 'validator.validator_factory' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * This service is private.
     * If you want to be able to request this service from the container directly,
     * make it public, otherwise you might end up with broken code.
     *
     * @return Symfony\Bundle\FrameworkBundle\Validator\ConstraintValidatorFactory A Symfony\Bundle\FrameworkBundle\Validator\ConstraintValidatorFactory instance.
     */
    protected function getValidator_ValidatorFactoryService()
    {
        return $this->services['validator.validator_factory'] = new \Symfony\Bundle\FrameworkBundle\Validator\ConstraintValidatorFactory($this, array('doctrine.orm.validator.unique' => 'doctrine.orm.validator.unique', 'sonata.admin.validator.inline' => 'sonata.admin.validator.inline', 'fos_user.validator.unique' => 'fos_user.validator.unique', 'fos_user.validator.password' => 'fos_user.validator.password', 'pi_app_admin.validator.unique' => 'pi_app_admin.validator.unique', 'pi_app_admin.validator.collectionof' => 'pi_app_admin.validator.collectionof'));
    }

    /**
     * {@inheritdoc}
     */
    public function getParameter($name)
    {
        $name = strtolower($name);

        if (!array_key_exists($name, $this->parameters)) {
            throw new \InvalidArgumentException(sprintf('The parameter "%s" must be defined.', $name));
        }

        return $this->parameters[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function hasParameter($name)
    {
        return array_key_exists(strtolower($name), $this->parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function setParameter($name, $value)
    {
        throw new \LogicException('Impossible to call set() on a frozen ParameterBag.');
    }

    /**
     * {@inheritDoc}
     */
    public function getParameterBag()
    {
        if (null === $this->parameterBag) {
            $this->parameterBag = new FrozenParameterBag($this->parameters);
        }

        return $this->parameterBag;
    }
    /**
     * Gets the default parameters.
     *
     * @return array An array of the default parameters
     */
    protected function getDefaultParameters()
    {
        return array(
            'kernel.root_dir' => '/Users/guillaumemigeon/Sites/orchestra-cmf/app',
            'kernel.environment' => 'dev',
            'kernel.debug' => true,
            'kernel.name' => 'app',
            'kernel.cache_dir' => '/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/dev',
            'kernel.logs_dir' => '/Users/guillaumemigeon/Sites/orchestra-cmf/app/logs',
            'kernel.bundles' => array(
                'FrameworkBundle' => 'Symfony\\Bundle\\FrameworkBundle\\FrameworkBundle',
                'SecurityBundle' => 'Symfony\\Bundle\\SecurityBundle\\SecurityBundle',
                'TwigBundle' => 'Symfony\\Bundle\\TwigBundle\\TwigBundle',
                'MonologBundle' => 'Symfony\\Bundle\\MonologBundle\\MonologBundle',
                'SwiftmailerBundle' => 'Symfony\\Bundle\\SwiftmailerBundle\\SwiftmailerBundle',
                'AsseticBundle' => 'Symfony\\Bundle\\AsseticBundle\\AsseticBundle',
                'SensioFrameworkExtraBundle' => 'Sensio\\Bundle\\FrameworkExtraBundle\\SensioFrameworkExtraBundle',
                'JMSAopBundle' => 'JMS\\AopBundle\\JMSAopBundle',
                'JMSSecurityExtraBundle' => 'JMS\\SecurityExtraBundle\\JMSSecurityExtraBundle',
                'JMSDiExtraBundle' => 'JMS\\DiExtraBundle\\JMSDiExtraBundle',
                'BeSimpleI18nRoutingBundle' => 'BeSimple\\I18nRoutingBundle\\BeSimpleI18nRoutingBundle',
                'DoctrineBundle' => 'Symfony\\Bundle\\DoctrineBundle\\DoctrineBundle',
                'DoctrineFixturesBundle' => 'Symfony\\Bundle\\DoctrineFixturesBundle\\DoctrineFixturesBundle',
                'StofDoctrineExtensionsBundle' => 'Stof\\DoctrineExtensionsBundle\\StofDoctrineExtensionsBundle',
                'SonataAdminBundle' => 'Sonata\\AdminBundle\\SonataAdminBundle',
                'SonataEasyExtendsBundle' => 'Sonata\\EasyExtendsBundle\\SonataEasyExtendsBundle',
                'SonataDoctrineORMAdminBundle' => 'Sonata\\DoctrineORMAdminBundle\\SonataDoctrineORMAdminBundle',
                'SonataCacheBundle' => 'Sonata\\CacheBundle\\SonataCacheBundle',
                'SonataBlockBundle' => 'Sonata\\BlockBundle\\SonataBlockBundle',
                'SonataMediaBundle' => 'Sonata\\MediaBundle\\SonataMediaBundle',
                'FOSUserBundle' => 'FOS\\UserBundle\\FOSUserBundle',
                'KnpMenuBundle' => 'Knp\\Bundle\\MenuBundle\\KnpMenuBundle',
                'KnpPaginatorBundle' => 'Knp\\Bundle\\PaginatorBundle\\KnpPaginatorBundle',
                'BootStrapDatabaseBundle' => 'BootStrap\\DatabaseBundle\\BootStrapDatabaseBundle',
                'BootStrapCacheBundle' => 'BootStrap\\CacheBundle\\BootStrapCacheBundle',
                'BootStrapWurflBundle' => 'BootStrap\\WurflBundle\\BootStrapWurflBundle',
                'BootStrapAclManagerBundle' => 'BootStrap\\AclManagerBundle\\BootStrapAclManagerBundle',
                'BootStrapAdminBundle' => 'BootStrap\\AdminBundle\\BootStrapAdminBundle',
                'BootStrapUserBundle' => 'BootStrap\\UserBundle\\BootStrapUserBundle',
                'BootStrapTranslationBundle' => 'BootStrap\\TranslationBundle\\BootStrapTranslationBundle',
                'BootStrapMediaBundle' => 'BootStrap\\MediaBundle\\BootStrapMediaBundle',
                'BootStrapGoogleBundle' => 'BootStrap\\GoogleBundle\\BootStrapGoogleBundle',
                'BootStrapFacebookBundle' => 'BootStrap\\FacebookBundle\\BootStrapFacebookBundle',
                'PiAppAdminBundle' => 'PiApp\\AdminBundle\\PiAppAdminBundle',
                'PiAppGedmoBundle' => 'PiApp\\GedmoBundle\\PiAppGedmoBundle',
                'PiAppTemplateBundle' => 'PiApp\\TemplateBundle\\PiAppTemplateBundle',
                'AcmeDemoBundle' => 'Acme\\DemoBundle\\AcmeDemoBundle',
                'WebProfilerBundle' => 'Symfony\\Bundle\\WebProfilerBundle\\WebProfilerBundle',
                'SensioDistributionBundle' => 'Sensio\\Bundle\\DistributionBundle\\SensioDistributionBundle',
                'SensioGeneratorBundle' => 'Sensio\\Bundle\\GeneratorBundle\\SensioGeneratorBundle',
            ),
            'kernel.charset' => 'UTF-8',
            'kernel.container_class' => 'appDevDebugProjectContainer',
            'kernel.http_host' => '',
            'database_driver' => 'pdo_mysql',
            'database_host' => 'localhost',
            'database_port' => '',
            'database_name' => 'symforchestra',
            'database_user' => 'root',
            'database_password' => 'pacman',
            'mailer_transport' => 'smtp',
            'mailer_host' => 'localhost',
            'mailer_user' => '',
            'mailer_password' => '',
            'locale' => 'en_GB',
            'secret' => '5b5a0ff57bd45284dafe7f104fc7d8e15',
            'security.acl.permission.map.class' => 'Sonata\\AdminBundle\\Security\\Acl\\Permission\\AdminPermissionMap',
            'router_listener.class' => 'Symfony\\Bundle\\FrameworkBundle\\EventListener\\RouterListener',
            'controller_resolver.class' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\ControllerResolver',
            'controller_name_converter.class' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\ControllerNameParser',
            'response_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\ResponseListener',
            'event_dispatcher.class' => 'Symfony\\Bundle\\FrameworkBundle\\ContainerAwareEventDispatcher',
            'http_kernel.class' => 'Symfony\\Bundle\\FrameworkBundle\\HttpKernel',
            'filesystem.class' => 'Symfony\\Component\\Filesystem\\Filesystem',
            'cache_warmer.class' => 'Symfony\\Component\\HttpKernel\\CacheWarmer\\CacheWarmerAggregate',
            'file_locator.class' => 'Symfony\\Component\\HttpKernel\\Config\\FileLocator',
            'translator.class' => 'Symfony\\Bundle\\FrameworkBundle\\Translation\\Translator',
            'translator.identity.class' => 'Symfony\\Component\\Translation\\IdentityTranslator',
            'translator.selector.class' => 'Symfony\\Component\\Translation\\MessageSelector',
            'translation.loader.php.class' => 'Symfony\\Component\\Translation\\Loader\\PhpFileLoader',
            'translation.loader.yml.class' => 'Symfony\\Component\\Translation\\Loader\\YamlFileLoader',
            'translation.loader.xliff.class' => 'Symfony\\Component\\Translation\\Loader\\XliffFileLoader',
            'debug.event_dispatcher.class' => 'Symfony\\Bundle\\FrameworkBundle\\Debug\\TraceableEventDispatcher',
            'debug.container.dump' => '/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/dev/appDevDebugProjectContainer.xml',
            'kernel.secret' => '5b5a0ff57bd45284dafe7f104fc7d8e15',
            'kernel.trust_proxy_headers' => false,
            'session.class' => 'Symfony\\Component\\HttpFoundation\\Session',
            'session.storage.native.class' => 'Symfony\\Component\\HttpFoundation\\SessionStorage\\NativeSessionStorage',
            'session.storage.filesystem.class' => 'Symfony\\Component\\HttpFoundation\\SessionStorage\\FilesystemSessionStorage',
            'session_listener.class' => 'Symfony\\Bundle\\FrameworkBundle\\EventListener\\SessionListener',
            'session.default_locale' => 'en_GB',
            'session.storage.options' => array(

            ),
            'form.extension.class' => 'Symfony\\Component\\Form\\Extension\\DependencyInjection\\DependencyInjectionExtension',
            'form.factory.class' => 'Symfony\\Component\\Form\\FormFactory',
            'form.type_guesser.validator.class' => 'Symfony\\Component\\Form\\Extension\\Validator\\ValidatorTypeGuesser',
            'form.csrf_provider.class' => 'Symfony\\Component\\Form\\Extension\\Csrf\\CsrfProvider\\SessionCsrfProvider',
            'form.type_extension.csrf.enabled' => true,
            'form.type_extension.csrf.field_name' => '_token',
            'validator.class' => 'Symfony\\Component\\Validator\\Validator',
            'validator.mapping.class_metadata_factory.class' => 'Symfony\\Component\\Validator\\Mapping\\ClassMetadataFactory',
            'validator.mapping.cache.apc.class' => 'Symfony\\Component\\Validator\\Mapping\\Cache\\ApcCache',
            'validator.mapping.cache.prefix' => '',
            'validator.mapping.loader.loader_chain.class' => 'Symfony\\Component\\Validator\\Mapping\\Loader\\LoaderChain',
            'validator.mapping.loader.static_method_loader.class' => 'Symfony\\Component\\Validator\\Mapping\\Loader\\StaticMethodLoader',
            'validator.mapping.loader.annotation_loader.class' => 'Symfony\\Component\\Validator\\Mapping\\Loader\\AnnotationLoader',
            'validator.mapping.loader.xml_files_loader.class' => 'Symfony\\Component\\Validator\\Mapping\\Loader\\XmlFilesLoader',
            'validator.mapping.loader.yaml_files_loader.class' => 'Symfony\\Component\\Validator\\Mapping\\Loader\\YamlFilesLoader',
            'validator.validator_factory.class' => 'Symfony\\Bundle\\FrameworkBundle\\Validator\\ConstraintValidatorFactory',
            'validator.mapping.loader.xml_files_loader.mapping_files' => array(
                0 => '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Component/Form/Resources/config/validation.xml',
                1 => '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/MediaBundle/Resources/config/validation.xml',
                2 => '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/config/validation.xml',
            ),
            'validator.mapping.loader.yaml_files_loader.mapping_files' => array(

            ),
            'profiler.class' => 'Symfony\\Component\\HttpKernel\\Profiler\\Profiler',
            'profiler_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\ProfilerListener',
            'data_collector.config.class' => 'Symfony\\Component\\HttpKernel\\DataCollector\\ConfigDataCollector',
            'data_collector.request.class' => 'Symfony\\Bundle\\FrameworkBundle\\DataCollector\\RequestDataCollector',
            'data_collector.exception.class' => 'Symfony\\Component\\HttpKernel\\DataCollector\\ExceptionDataCollector',
            'data_collector.events.class' => 'Symfony\\Component\\HttpKernel\\DataCollector\\EventDataCollector',
            'data_collector.logger.class' => 'Symfony\\Component\\HttpKernel\\DataCollector\\LoggerDataCollector',
            'data_collector.timer.class' => 'Symfony\\Bundle\\FrameworkBundle\\DataCollector\\TimerDataCollector',
            'data_collector.memory.class' => 'Symfony\\Component\\HttpKernel\\DataCollector\\MemoryDataCollector',
            'profiler_listener.only_exceptions' => false,
            'profiler_listener.only_master_requests' => false,
            'profiler.storage.dsn' => 'sqlite:/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/dev/profiler.db',
            'profiler.storage.username' => '',
            'profiler.storage.password' => '',
            'profiler.storage.lifetime' => 86400,
            'router.class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\Router',
            'routing.loader.class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\DelegatingLoader',
            'routing.resolver.class' => 'Symfony\\Component\\Config\\Loader\\LoaderResolver',
            'routing.loader.xml.class' => 'BeSimple\\I18nRoutingBundle\\Routing\\Loader\\XmlFileLoader',
            'routing.loader.yml.class' => 'BeSimple\\I18nRoutingBundle\\Routing\\Loader\\YamlFileLoader',
            'routing.loader.php.class' => 'Symfony\\Component\\Routing\\Loader\\PhpFileLoader',
            'router.options.generator_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator',
            'router.options.generator_base_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator',
            'router.options.generator_dumper_class' => 'Symfony\\Component\\Routing\\Generator\\Dumper\\PhpGeneratorDumper',
            'router.options.matcher_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher',
            'router.options.matcher_base_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher',
            'router.options.matcher_dumper_class' => 'Symfony\\Component\\Routing\\Matcher\\Dumper\\PhpMatcherDumper',
            'router.cache_warmer.class' => 'Symfony\\Bundle\\FrameworkBundle\\CacheWarmer\\RouterCacheWarmer',
            'router.options.matcher.cache_class' => 'appdevUrlMatcher',
            'router.options.generator.cache_class' => 'appdevUrlGenerator',
            'router.resource' => '/Users/guillaumemigeon/Sites/orchestra-cmf/app/config/routing_dev.yml',
            'request_listener.http_port' => 80,
            'request_listener.https_port' => 443,
            'templating.engine.delegating.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\DelegatingEngine',
            'templating.name_parser.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\TemplateNameParser',
            'templating.cache_warmer.template_paths.class' => 'Symfony\\Bundle\\FrameworkBundle\\CacheWarmer\\TemplatePathsCacheWarmer',
            'templating.locator.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Loader\\TemplateLocator',
            'templating.loader.filesystem.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Loader\\FilesystemLoader',
            'templating.loader.cache.class' => 'Symfony\\Component\\Templating\\Loader\\CacheLoader',
            'templating.loader.chain.class' => 'Symfony\\Component\\Templating\\Loader\\ChainLoader',
            'templating.finder.class' => 'Symfony\\Bundle\\FrameworkBundle\\CacheWarmer\\TemplateFinder',
            'templating.engine.php.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\PhpEngine',
            'templating.helper.slots.class' => 'Symfony\\Component\\Templating\\Helper\\SlotsHelper',
            'templating.helper.assets.class' => 'Symfony\\Component\\Templating\\Helper\\CoreAssetsHelper',
            'templating.helper.actions.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\ActionsHelper',
            'templating.helper.router.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\RouterHelper',
            'templating.helper.request.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\RequestHelper',
            'templating.helper.session.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\SessionHelper',
            'templating.helper.code.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\CodeHelper',
            'templating.helper.translator.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\TranslatorHelper',
            'templating.helper.form.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\FormHelper',
            'templating.globals.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\GlobalVariables',
            'templating.asset.path_package.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Asset\\PathPackage',
            'templating.asset.url_package.class' => 'Symfony\\Component\\Templating\\Asset\\UrlPackage',
            'templating.asset.package_factory.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Asset\\PackageFactory',
            'templating.helper.code.file_link_format' => NULL,
            'templating.helper.form.resources' => array(
                0 => 'FrameworkBundle:Form',
            ),
            'templating.debugger.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Debugger',
            'templating.loader.cache.path' => NULL,
            'templating.engines' => array(
                0 => 'twig',
            ),
            'annotations.reader.class' => 'Doctrine\\Common\\Annotations\\AnnotationReader',
            'annotations.cached_reader.class' => 'Doctrine\\Common\\Annotations\\CachedReader',
            'annotations.file_cache_reader.class' => 'Doctrine\\Common\\Annotations\\FileCacheReader',
            'security.context.class' => 'Symfony\\Component\\Security\\Core\\SecurityContext',
            'security.user_checker.class' => 'Symfony\\Component\\Security\\Core\\User\\UserChecker',
            'security.encoder_factory.generic.class' => 'Symfony\\Component\\Security\\Core\\Encoder\\EncoderFactory',
            'security.encoder.digest.class' => 'Symfony\\Component\\Security\\Core\\Encoder\\MessageDigestPasswordEncoder',
            'security.encoder.plain.class' => 'Symfony\\Component\\Security\\Core\\Encoder\\PlaintextPasswordEncoder',
            'security.user.provider.entity.class' => 'Symfony\\Bridge\\Doctrine\\Security\\User\\EntityUserProvider',
            'security.user.provider.in_memory.class' => 'Symfony\\Component\\Security\\Core\\User\\InMemoryUserProvider',
            'security.user.provider.in_memory.user.class' => 'Symfony\\Component\\Security\\Core\\User\\User',
            'security.user.provider.chain.class' => 'Symfony\\Component\\Security\\Core\\User\\ChainUserProvider',
            'security.authentication.trust_resolver.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\AuthenticationTrustResolver',
            'security.authentication.trust_resolver.anonymous_class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Token\\AnonymousToken',
            'security.authentication.trust_resolver.rememberme_class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Token\\RememberMeToken',
            'security.authentication.manager.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\AuthenticationProviderManager',
            'security.authentication.session_strategy.class' => 'Symfony\\Component\\Security\\Http\\Session\\SessionAuthenticationStrategy',
            'security.access.decision_manager.class' => 'Symfony\\Component\\Security\\Core\\Authorization\\AccessDecisionManager',
            'security.access.simple_role_voter.class' => 'Symfony\\Component\\Security\\Core\\Authorization\\Voter\\RoleVoter',
            'security.access.authenticated_voter.class' => 'Symfony\\Component\\Security\\Core\\Authorization\\Voter\\AuthenticatedVoter',
            'security.access.role_hierarchy_voter.class' => 'Symfony\\Component\\Security\\Core\\Authorization\\Voter\\RoleHierarchyVoter',
            'security.firewall.class' => 'Symfony\\Component\\Security\\Http\\Firewall',
            'security.firewall.map.class' => 'Symfony\\Bundle\\SecurityBundle\\Security\\FirewallMap',
            'security.firewall.context.class' => 'Symfony\\Bundle\\SecurityBundle\\Security\\FirewallContext',
            'security.matcher.class' => 'Symfony\\Component\\HttpFoundation\\RequestMatcher',
            'security.role_hierarchy.class' => 'Symfony\\Component\\Security\\Core\\Role\\RoleHierarchy',
            'security.http_utils.class' => 'Symfony\\Component\\Security\\Http\\HttpUtils',
            'security.authentication.retry_entry_point.class' => 'Symfony\\Component\\Security\\Http\\EntryPoint\\RetryAuthenticationEntryPoint',
            'security.channel_listener.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\ChannelListener',
            'security.authentication.form_entry_point.class' => 'Symfony\\Component\\Security\\Http\\EntryPoint\\FormAuthenticationEntryPoint',
            'security.authentication.listener.form.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\UsernamePasswordFormAuthenticationListener',
            'security.authentication.listener.basic.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\BasicAuthenticationListener',
            'security.authentication.basic_entry_point.class' => 'Symfony\\Component\\Security\\Http\\EntryPoint\\BasicAuthenticationEntryPoint',
            'security.authentication.listener.digest.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\DigestAuthenticationListener',
            'security.authentication.digest_entry_point.class' => 'Symfony\\Component\\Security\\Http\\EntryPoint\\DigestAuthenticationEntryPoint',
            'security.authentication.listener.x509.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\X509AuthenticationListener',
            'security.authentication.listener.anonymous.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\AnonymousAuthenticationListener',
            'security.authentication.switchuser_listener.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\SwitchUserListener',
            'security.logout_listener.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\LogoutListener',
            'security.logout.handler.session.class' => 'Symfony\\Component\\Security\\Http\\Logout\\SessionLogoutHandler',
            'security.logout.handler.cookie_clearing.class' => 'Symfony\\Component\\Security\\Http\\Logout\\CookieClearingLogoutHandler',
            'security.access_listener.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\AccessListener',
            'security.access_map.class' => 'Symfony\\Component\\Security\\Http\\AccessMap',
            'security.exception_listener.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\ExceptionListener',
            'security.context_listener.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\ContextListener',
            'security.authentication.provider.dao.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Provider\\DaoAuthenticationProvider',
            'security.authentication.provider.pre_authenticated.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Provider\\PreAuthenticatedAuthenticationProvider',
            'security.authentication.provider.anonymous.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Provider\\AnonymousAuthenticationProvider',
            'security.authentication.provider.rememberme.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Provider\\RememberMeAuthenticationProvider',
            'security.authentication.listener.rememberme.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\RememberMeListener',
            'security.rememberme.token.provider.in_memory.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\RememberMe\\InMemoryTokenProvider',
            'security.authentication.rememberme.services.persistent.class' => 'Symfony\\Component\\Security\\Http\\RememberMe\\PersistentTokenBasedRememberMeServices',
            'security.authentication.rememberme.services.simplehash.class' => 'Symfony\\Component\\Security\\Http\\RememberMe\\TokenBasedRememberMeServices',
            'security.rememberme.response_listener.class' => 'Symfony\\Bundle\\SecurityBundle\\EventListener\\ResponseListener',
            'templating.helper.security.class' => 'Symfony\\Bundle\\SecurityBundle\\Templating\\Helper\\SecurityHelper',
            'data_collector.security.class' => 'Symfony\\Bundle\\SecurityBundle\\DataCollector\\SecurityDataCollector',
            'security.access.denied_url' => '/unauthorized',
            'security.authentication.session_strategy.strategy' => 'migrate',
            'security.access.always_authenticate_before_granting' => false,
            'security.authentication.hide_user_not_found' => true,
            'security.role_hierarchy.roles' => array(
                'ROLE_USER' => array(
                    0 => 'ROLE_ALLOWED_TO_SWITCH',
                ),
                'ROLE_SUBSCRIBER' => array(
                    0 => 'ROLE_USER',
                    1 => 'ROLE_ALLOWED_TO_SWITCH',
                ),
                'ROLE_EDITOR' => array(
                    0 => 'ROLE_USER',
                    1 => 'ROLE_ALLOWED_TO_SWITCH',
                ),
                'ROLE_MODERATOR' => array(
                    0 => 'ROLE_EDITOR',
                    1 => 'ROLE_ALLOWED_TO_SWITCH',
                ),
                'ROLE_DESIGNER' => array(
                    0 => 'ROLE_USER',
                    1 => 'ROLE_ALLOWED_TO_SWITCH',
                ),
                'ROLE_CONTENT_MANAGER' => array(
                    0 => 'ROLE_DESIGNER',
                    1 => 'ROLE_MODERATOR',
                    2 => 'ROLE_ALLOWED_TO_SWITCH',
                ),
                'ROLE_ADMIN' => array(
                    0 => 'ROLE_CONTENT_MANAGER',
                    1 => 'ROLE_ALLOWED_TO_SWITCH',
                ),
                'SONATA' => array(
                    0 => 'ROLE_SONATA_PAGE_ADMIN_PAGE_EDIT ',
                    1 => 'ROLE_SONATA_PAGE_ADMIN_BLOCK_EDIT',
                    2 => 'ROLE_ALLOWED_TO_SWITCH',
                ),
                'ROLE_SUPER_ADMIN' => array(
                    0 => 'ROLE_ADMIN',
                    1 => 'ROLE_ALLOWED_TO_SWITCH',
                    2 => 'ROLE_SONATA_ADMIN',
                    3 => 'SONATA',
                ),
            ),
            'security.acl.permission_granting_strategy.class' => 'Symfony\\Component\\Security\\Acl\\Domain\\PermissionGrantingStrategy',
            'security.acl.voter.class' => 'Symfony\\Component\\Security\\Acl\\Voter\\AclVoter',
            'security.acl.object_identity_retrieval_strategy.class' => 'Symfony\\Component\\Security\\Acl\\Domain\\ObjectIdentityRetrievalStrategy',
            'security.acl.security_identity_retrieval_strategy.class' => 'Symfony\\Component\\Security\\Acl\\Domain\\SecurityIdentityRetrievalStrategy',
            'security.acl.cache.doctrine.class' => 'Symfony\\Component\\Security\\Acl\\Domain\\DoctrineAclCache',
            'security.acl.collection_cache.class' => 'Symfony\\Component\\Security\\Acl\\Domain\\AclCollectionCache',
            'security.acl.dbal.provider.class' => 'Symfony\\Component\\Security\\Acl\\Dbal\\MutableAclProvider',
            'security.acl.dbal.class_table_name' => 'acl_classes',
            'security.acl.dbal.entry_table_name' => 'acl_entries',
            'security.acl.dbal.oid_table_name' => 'acl_object_identities',
            'security.acl.dbal.oid_ancestors_table_name' => 'acl_object_identity_ancestors',
            'security.acl.dbal.sid_table_name' => 'acl_security_identities',
            'twig.class' => 'Twig_Environment',
            'twig.loader.class' => 'Symfony\\Bundle\\TwigBundle\\Loader\\FilesystemLoader',
            'templating.engine.twig.class' => 'Symfony\\Bundle\\TwigBundle\\TwigEngine',
            'twig.cache_warmer.class' => 'Symfony\\Bundle\\TwigBundle\\CacheWarmer\\TemplateCacheCacheWarmer',
            'twig.extension.trans.class' => 'Symfony\\Bridge\\Twig\\Extension\\TranslationExtension',
            'twig.extension.assets.class' => 'Symfony\\Bundle\\TwigBundle\\Extension\\AssetsExtension',
            'twig.extension.actions.class' => 'Symfony\\Bundle\\TwigBundle\\Extension\\ActionsExtension',
            'twig.extension.code.class' => 'Symfony\\Bundle\\TwigBundle\\Extension\\CodeExtension',
            'twig.extension.routing.class' => 'Symfony\\Bridge\\Twig\\Extension\\RoutingExtension',
            'twig.extension.yaml.class' => 'Symfony\\Bridge\\Twig\\Extension\\YamlExtension',
            'twig.extension.form.class' => 'Symfony\\Bridge\\Twig\\Extension\\FormExtension',
            'twig.exception_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\ExceptionListener',
            'twig.exception_listener.controller' => 'Symfony\\Bundle\\TwigBundle\\Controller\\ExceptionController::showAction',
            'twig.form.resources' => array(
                0 => 'form_div_layout.html.twig',
            ),
            'twig.options' => array(
                'exception_controller' => 'Symfony\\Bundle\\TwigBundle\\Controller\\ExceptionController::showAction',
                'charset' => 'utf-8',
                'debug' => true,
                'strict_variables' => true,
                'auto_reload' => NULL,
                'cache' => '/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/dev/twig',
            ),
            'monolog.logger.class' => 'Symfony\\Bridge\\Monolog\\Logger',
            'monolog.handler.stream.class' => 'Monolog\\Handler\\StreamHandler',
            'monolog.handler.fingers_crossed.class' => 'Monolog\\Handler\\FingersCrossedHandler',
            'monolog.handler.group.class' => 'Monolog\\Handler\\GroupHandler',
            'monolog.handler.buffer.class' => 'Monolog\\Handler\\BufferHandler',
            'monolog.handler.rotating_file.class' => 'Monolog\\Handler\\RotatingFileHandler',
            'monolog.handler.syslog.class' => 'Monolog\\Handler\\SyslogHandler',
            'monolog.handler.null.class' => 'Monolog\\Handler\\NullHandler',
            'monolog.handler.test.class' => 'Monolog\\Handler\\TestHandler',
            'monolog.handler.firephp.class' => 'Symfony\\Bridge\\Monolog\\Handler\\FirePHPHandler',
            'monolog.handler.debug.class' => 'Symfony\\Bridge\\Monolog\\Handler\\DebugHandler',
            'monolog.handler.swift_mailer.class' => 'Monolog\\Handler\\SwiftMailerHandler',
            'monolog.handler.native_mailer.class' => 'Monolog\\Handler\\NativeMailerHandler',
            'swiftmailer.class' => 'Swift_Mailer',
            'swiftmailer.transport.sendmail.class' => 'Swift_Transport_SendmailTransport',
            'swiftmailer.transport.mail.class' => 'Swift_Transport_MailTransport',
            'swiftmailer.transport.failover.class' => 'Swift_Transport_FailoverTransport',
            'swiftmailer.plugin.redirecting.class' => 'Swift_Plugins_RedirectingPlugin',
            'swiftmailer.plugin.impersonate.class' => 'Swift_Plugins_ImpersonatePlugin',
            'swiftmailer.plugin.messagelogger.class' => 'Symfony\\Bundle\\SwiftmailerBundle\\Logger\\MessageLogger',
            'swiftmailer.plugin.antiflood.class' => 'Swift_Plugins_AntiFloodPlugin',
            'swiftmailer.plugin.antiflood.threshold' => 99,
            'swiftmailer.plugin.antiflood.sleep' => 0,
            'swiftmailer.data_collector.class' => 'Symfony\\Bundle\\SwiftmailerBundle\\DataCollector\\MessageDataCollector',
            'swiftmailer.transport.smtp.class' => 'Swift_Transport_EsmtpTransport',
            'swiftmailer.transport.smtp.encryption' => NULL,
            'swiftmailer.transport.smtp.port' => 25,
            'swiftmailer.transport.smtp.host' => 'localhost',
            'swiftmailer.transport.smtp.username' => '',
            'swiftmailer.transport.smtp.password' => '',
            'swiftmailer.transport.smtp.auth_mode' => NULL,
            'swiftmailer.spool.enabled' => false,
            'swiftmailer.sender_address' => NULL,
            'swiftmailer.single_address' => NULL,
            'assetic.asset_factory.class' => 'Symfony\\Bundle\\AsseticBundle\\Factory\\AssetFactory',
            'assetic.asset_manager.class' => 'Assetic\\Factory\\LazyAssetManager',
            'assetic.asset_manager_cache_warmer.class' => 'Symfony\\Bundle\\AsseticBundle\\CacheWarmer\\AssetManagerCacheWarmer',
            'assetic.cached_formula_loader.class' => 'Assetic\\Factory\\Loader\\CachedFormulaLoader',
            'assetic.config_cache.class' => 'Assetic\\Cache\\ConfigCache',
            'assetic.config_loader.class' => 'Symfony\\Bundle\\AsseticBundle\\Factory\\Loader\\ConfigurationLoader',
            'assetic.config_resource.class' => 'Symfony\\Bundle\\AsseticBundle\\Factory\\Resource\\ConfigurationResource',
            'assetic.coalescing_directory_resource.class' => 'Symfony\\Bundle\\AsseticBundle\\Factory\\Resource\\CoalescingDirectoryResource',
            'assetic.directory_resource.class' => 'Symfony\\Bundle\\AsseticBundle\\Factory\\Resource\\DirectoryResource',
            'assetic.filter_manager.class' => 'Symfony\\Bundle\\AsseticBundle\\FilterManager',
            'assetic.worker.ensure_filter.class' => 'Assetic\\Factory\\Worker\\EnsureFilterWorker',
            'assetic.node.paths' => array(

            ),
            'assetic.cache_dir' => '/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/dev/assetic',
            'assetic.bundles' => array(
                0 => 'FrameworkBundle',
                1 => 'SecurityBundle',
                2 => 'TwigBundle',
                3 => 'MonologBundle',
                4 => 'SwiftmailerBundle',
                5 => 'AsseticBundle',
                6 => 'SensioFrameworkExtraBundle',
                7 => 'JMSAopBundle',
                8 => 'JMSSecurityExtraBundle',
                9 => 'JMSDiExtraBundle',
                10 => 'BeSimpleI18nRoutingBundle',
                11 => 'DoctrineBundle',
                12 => 'DoctrineFixturesBundle',
                13 => 'StofDoctrineExtensionsBundle',
                14 => 'SonataAdminBundle',
                15 => 'SonataEasyExtendsBundle',
                16 => 'SonataDoctrineORMAdminBundle',
                17 => 'SonataCacheBundle',
                18 => 'SonataBlockBundle',
                19 => 'SonataMediaBundle',
                20 => 'FOSUserBundle',
                21 => 'KnpMenuBundle',
                22 => 'KnpPaginatorBundle',
                23 => 'BootStrapDatabaseBundle',
                24 => 'BootStrapCacheBundle',
                25 => 'BootStrapWurflBundle',
                26 => 'BootStrapAclManagerBundle',
                27 => 'BootStrapAdminBundle',
                28 => 'BootStrapUserBundle',
                29 => 'BootStrapTranslationBundle',
                30 => 'BootStrapMediaBundle',
                31 => 'BootStrapGoogleBundle',
                32 => 'BootStrapFacebookBundle',
                33 => 'PiAppAdminBundle',
                34 => 'PiAppGedmoBundle',
                35 => 'PiAppTemplateBundle',
                36 => 'AcmeDemoBundle',
                37 => 'WebProfilerBundle',
                38 => 'SensioDistributionBundle',
                39 => 'SensioGeneratorBundle',
            ),
            'assetic.twig_extension.class' => 'Symfony\\Bundle\\AsseticBundle\\Twig\\AsseticExtension',
            'assetic.twig_formula_loader.class' => 'Assetic\\Extension\\Twig\\TwigFormulaLoader',
            'assetic.helper.dynamic.class' => 'Symfony\\Bundle\\AsseticBundle\\Templating\\DynamicAsseticHelper',
            'assetic.helper.static.class' => 'Symfony\\Bundle\\AsseticBundle\\Templating\\StaticAsseticHelper',
            'assetic.php_formula_loader.class' => 'Symfony\\Bundle\\AsseticBundle\\Factory\\Loader\\AsseticHelperFormulaLoader',
            'assetic.debug' => true,
            'assetic.use_controller' => true,
            'assetic.enable_profiler' => false,
            'assetic.read_from' => '/Users/guillaumemigeon/Sites/orchestra-cmf/app/../web',
            'assetic.write_to' => '/Users/guillaumemigeon/Sites/orchestra-cmf/app/../web',
            'assetic.java.bin' => '/usr/bin/java',
            'assetic.node.bin' => '/usr/bin/node',
            'assetic.ruby.bin' => '/usr/bin/ruby',
            'assetic.sass.bin' => '/usr/bin/sass',
            'assetic.filter.cssrewrite.class' => 'Assetic\\Filter\\CssRewriteFilter',
            'assetic.twig_extension.functions' => array(

            ),
            'assetic.controller.class' => 'Symfony\\Bundle\\AsseticBundle\\Controller\\AsseticController',
            'assetic.routing_loader.class' => 'Symfony\\Bundle\\AsseticBundle\\Routing\\AsseticLoader',
            'assetic.cache.class' => 'Assetic\\Cache\\FilesystemCache',
            'assetic.use_controller_worker.class' => 'Symfony\\Bundle\\AsseticBundle\\Factory\\Worker\\UseControllerWorker',
            'assetic.request_listener.class' => 'Symfony\\Bundle\\AsseticBundle\\EventListener\\RequestListener',
            'sensio_framework_extra.controller.listener.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\EventListener\\ControllerListener',
            'sensio_framework_extra.routing.loader.annot_dir.class' => 'Symfony\\Component\\Routing\\Loader\\AnnotationDirectoryLoader',
            'sensio_framework_extra.routing.loader.annot_file.class' => 'Symfony\\Component\\Routing\\Loader\\AnnotationFileLoader',
            'sensio_framework_extra.routing.loader.annot_class.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\Routing\\AnnotatedRouteControllerLoader',
            'sensio_framework_extra.converter.listener.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\EventListener\\ParamConverterListener',
            'sensio_framework_extra.converter.manager.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\Request\\ParamConverter\\ParamConverterManager',
            'sensio_framework_extra.converter.doctrine.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\Request\\ParamConverter\\DoctrineParamConverter',
            'sensio_framework_extra.view.listener.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\EventListener\\TemplateListener',
            'jms_aop.cache_dir' => '/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/dev/jms_aop',
            'jms_aop.interceptor_loader.class' => 'JMS\\AopBundle\\Aop\\InterceptorLoader',
            'security.secured_services' => array(

            ),
            'security.access.method_interceptor.class' => 'JMS\\SecurityExtraBundle\\Security\\Authorization\\Interception\\MethodSecurityInterceptor',
            'security.access.run_as_manager.class' => 'JMS\\SecurityExtraBundle\\Security\\Authorization\\RunAsManager',
            'security.authentication.provider.run_as.class' => 'JMS\\SecurityExtraBundle\\Security\\Authentication\\Provider\\RunAsAuthenticationProvider',
            'security.run_as.key' => 'RunAsToken',
            'security.run_as.role_prefix' => 'ROLE_',
            'security.access.after_invocation_manager.class' => 'JMS\\SecurityExtraBundle\\Security\\Authorization\\AfterInvocation\\AfterInvocationManager',
            'security.access.after_invocation.acl_provider.class' => 'JMS\\SecurityExtraBundle\\Security\\Authorization\\AfterInvocation\\AclAfterInvocationProvider',
            'security.extra.controller_listener.class' => 'JMS\\SecurityExtraBundle\\Controller\\ControllerListener',
            'security.access.iddqd_voter.class' => 'JMS\\SecurityExtraBundle\\Security\\Authorization\\Voter\\IddqdVoter',
            'security.extra.secure_all_services' => false,
            'jms_di_extra.metadata.driver.annotation_driver.class' => 'JMS\\DiExtraBundle\\Metadata\\Driver\\AnnotationDriver',
            'jms_di_extra.metadata.metadata_factory.class' => 'Metadata\\MetadataFactory',
            'jms_di_extra.metadata.cache.file_cache.class' => 'Metadata\\Cache\\FileCache',
            'jms_di_extra.metadata.converter.class' => 'JMS\\DiExtraBundle\\Metadata\\MetadataConverter',
            'jms_di_extra.controller_resolver.class' => 'JMS\\DiExtraBundle\\HttpKernel\\ControllerResolver',
            'jms_di_extra.template_listener.class' => 'JMS\\DiExtraBundle\\EventListener\\TemplateListener',
            'jms_di_extra.controller_listener.class' => 'JMS\\DiExtraBundle\\EventListener\\ControllerListener',
            'jms_di_extra.all_bundles' => false,
            'jms_di_extra.bundles' => array(

            ),
            'jms_di_extra.directories' => array(

            ),
            'jms_di_extra.cache_dir' => '/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/dev/diextra',
            'i18n_routing.router.class' => 'BeSimple\\I18nRoutingBundle\\Routing\\Router',
            'i18n_routing.generator_base.class' => 'BeSimple\\I18nRoutingBundle\\Routing\\Generator\\UrlGenerator',
            'i18n_routing.translator.doctrine.class' => 'BeSimple\\I18nRoutingBundle\\Routing\\Translator\\DoctrineDBALTranslator',
            'i18n_routing.translator.doctrine.schemalistener.class' => 'BeSimple\\I18nRoutingBundle\\Routing\\Translator\\DoctrineDBAL\\SchemaListener',
            'i18n_routing.translator.translation.class' => 'BeSimple\\I18nRoutingBundle\\Routing\\Translator\\TranslationTranslator',
            'doctrine.dbal.logger.debug.class' => 'Doctrine\\DBAL\\Logging\\DebugStack',
            'doctrine.dbal.logger.class' => 'Symfony\\Bridge\\Doctrine\\Logger\\DbalLogger',
            'doctrine.dbal.configuration.class' => 'Doctrine\\DBAL\\Configuration',
            'doctrine.data_collector.class' => 'Symfony\\Bridge\\Doctrine\\DataCollector\\DoctrineDataCollector',
            'doctrine.dbal.connection.event_manager.class' => 'Doctrine\\Common\\EventManager',
            'doctrine.dbal.connection_factory.class' => 'Symfony\\Bundle\\DoctrineBundle\\ConnectionFactory',
            'doctrine.dbal.events.mysql_session_init.class' => 'Doctrine\\DBAL\\Event\\Listeners\\MysqlSessionInit',
            'doctrine.dbal.events.oracle_session_init.class' => 'Doctrine\\DBAL\\Event\\Listeners\\OracleSessionInit',
            'doctrine.class' => 'Symfony\\Bundle\\DoctrineBundle\\Registry',
            'doctrine.entity_managers' => array(
                'default' => 'doctrine.orm.default_entity_manager',
            ),
            'doctrine.default_entity_manager' => 'default',
            'doctrine.dbal.connection_factory.types' => array(

            ),
            'doctrine.connections' => array(
                'default' => 'doctrine.dbal.default_connection',
            ),
            'doctrine.default_connection' => 'default',
            'doctrine.orm.configuration.class' => 'Doctrine\\ORM\\Configuration',
            'doctrine.orm.entity_manager.class' => 'Doctrine\\ORM\\EntityManager',
            'doctrine.orm.cache.array.class' => 'Doctrine\\Common\\Cache\\ArrayCache',
            'doctrine.orm.cache.apc.class' => 'Doctrine\\Common\\Cache\\ApcCache',
            'doctrine.orm.cache.memcache.class' => 'Doctrine\\Common\\Cache\\MemcacheCache',
            'doctrine.orm.cache.memcache_host' => 'localhost',
            'doctrine.orm.cache.memcache_port' => 11211,
            'doctrine.orm.cache.memcache_instance.class' => 'Memcache',
            'doctrine.orm.cache.xcache.class' => 'Doctrine\\Common\\Cache\\XcacheCache',
            'doctrine.orm.metadata.driver_chain.class' => 'Doctrine\\ORM\\Mapping\\Driver\\DriverChain',
            'doctrine.orm.metadata.annotation.class' => 'Doctrine\\ORM\\Mapping\\Driver\\AnnotationDriver',
            'doctrine.orm.metadata.annotation_reader.class' => 'Symfony\\Bridge\\Doctrine\\Annotations\\IndexedReader',
            'doctrine.orm.metadata.xml.class' => 'Symfony\\Bridge\\Doctrine\\Mapping\\Driver\\XmlDriver',
            'doctrine.orm.metadata.yml.class' => 'Symfony\\Bridge\\Doctrine\\Mapping\\Driver\\YamlDriver',
            'doctrine.orm.metadata.php.class' => 'Doctrine\\ORM\\Mapping\\Driver\\PHPDriver',
            'doctrine.orm.metadata.staticphp.class' => 'Doctrine\\ORM\\Mapping\\Driver\\StaticPHPDriver',
            'doctrine.orm.proxy_cache_warmer.class' => 'Symfony\\Bridge\\Doctrine\\CacheWarmer\\ProxyCacheWarmer',
            'form.type_guesser.doctrine.class' => 'Symfony\\Bridge\\Doctrine\\Form\\DoctrineOrmTypeGuesser',
            'doctrine.orm.validator.unique.class' => 'Symfony\\Bridge\\Doctrine\\Validator\\Constraints\\UniqueEntityValidator',
            'doctrine.orm.validator_initializer.class' => 'Symfony\\Bridge\\Doctrine\\Validator\\EntityInitializer',
            'doctrine.orm.auto_generate_proxy_classes' => true,
            'doctrine.orm.proxy_dir' => '/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/dev/doctrine/orm/Proxies',
            'doctrine.orm.proxy_namespace' => 'Proxies',
            'stof_doctrine_extensions.event_listener.locale.class' => 'Stof\\DoctrineExtensionsBundle\\EventListener\\LocaleListener',
            'stof_doctrine_extensions.event_listener.logger.class' => 'Stof\\DoctrineExtensionsBundle\\EventListener\\LoggerListener',
            'stof_doctrine_extensions.default_locale' => 'en_GB',
            'stof_doctrine_extensions.translation_fallback' => true,
            'stof_doctrine_extensions.persist_default_translation' => false,
            'stof_doctrine_extensions.listener.translatable.class' => 'Gedmo\\Translatable\\TranslatableListener',
            'stof_doctrine_extensions.listener.timestampable.class' => 'Gedmo\\Timestampable\\TimestampableListener',
            'stof_doctrine_extensions.listener.sluggable.class' => 'Gedmo\\Sluggable\\SluggableListener',
            'stof_doctrine_extensions.listener.tree.class' => 'Gedmo\\Tree\\TreeListener',
            'stof_doctrine_extensions.listener.loggable.class' => 'Gedmo\\Loggable\\LoggableListener',
            'stof_doctrine_extensions.listener.sortable.class' => 'Gedmo\\Sortable\\SortableListener',
            'stof_doctrine_extensions.listener.softdeleteable.class' => 'Gedmo\\SoftDeleteable\\SoftDeleteableListener',
            'sonata.admin.configuration.templates' => array(
                'layout' => 'SonataAdminBundle::standard_layout.html.twig',
                'ajax' => 'SonataAdminBundle::ajax_layout.html.twig',
                'list' => 'SonataAdminBundle:CRUD:list.html.twig',
                'show' => 'SonataAdminBundle:CRUD:show.html.twig',
                'edit' => 'SonataAdminBundle:CRUD:edit.html.twig',
                'user_block' => 'SonataAdminBundle:Core:user_block.html.twig',
                'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig',
                'history' => 'SonataAdminBundle:CRUD:history.html.twig',
                'history_revision' => 'SonataAdminBundle:CRUD:history_revision.html.twig',
                'action' => 'SonataAdminBundle:CRUD:action.html.twig',
            ),
            'sonata.admin.configuration.admin_services' => array(

            ),
            'sonata.admin.configuration.dashboard_groups' => array(

            ),
            'sonata.admin.configuration.dashboard_blocks' => array(
                0 => array(
                    'position' => 'left',
                    'settings' => array(

                    ),
                    'type' => 'sonata.admin.block.admin_list',
                ),
            ),
            'sonata.admin.configuration.security.information' => array(
                'EDIT' => array(
                    0 => 'EDIT',
                ),
                'LIST' => array(
                    0 => 'LIST',
                ),
                'CREATE' => array(
                    0 => 'CREATE',
                ),
                'VIEW' => array(
                    0 => 'VIEW',
                ),
                'DELETE' => array(
                    0 => 'DELETE',
                ),
                'OPERATOR' => array(
                    0 => 'OPERATOR',
                ),
                'MASTER' => array(
                    0 => 'MASTER',
                ),
            ),
            'sonata.admin.configuration.security.admin_permissions' => array(
                0 => 'CREATE',
                1 => 'LIST',
                2 => 'DELETE',
                3 => 'UNDELETE',
                4 => 'OPERATOR',
                5 => 'MASTER',
            ),
            'sonata.admin.configuration.security.object_permissions' => array(
                0 => 'VIEW',
                1 => 'EDIT',
                2 => 'DELETE',
                3 => 'UNDELETE',
                4 => 'OPERATOR',
                5 => 'MASTER',
                6 => 'OWNER',
            ),
            'sonata.admin.security.handler.noop.class' => 'Sonata\\AdminBundle\\Security\\Handler\\NoopSecurityHandler',
            'sonata.admin.security.handler.role.class' => 'Sonata\\AdminBundle\\Security\\Handler\\RoleSecurityHandler',
            'sonata.admin.security.handler.acl.class' => 'Sonata\\AdminBundle\\Security\\Handler\\AclSecurityHandler',
            'sonata.admin.security.mask.builder.class' => 'Sonata\\AdminBundle\\Security\\Acl\\Permission\\MaskBuilder',
            'sonata.admin.manipulator.acl.admin.class' => 'Sonata\\AdminBundle\\Util\\AdminAclManipulator',
            'sonata.admin.manipulator.acl.object.orm.class' => 'Sonata\\DoctrineORMAdminBundle\\Util\\ObjectAclManipulator',
            'sonata_doctrine_orm_admin.entity_manager' => NULL,
            'sonata.block.service.text.class' => 'Sonata\\BlockBundle\\Block\\Service\\TextBlockService',
            'sonata.block.service.action.class' => 'Sonata\\BlockBundle\\Block\\Service\\ActionBlockService',
            'sonata.block.service.rss.class' => 'Sonata\\BlockBundle\\Block\\Service\\RssBlockService',
            'sonata.media.provider.image.class' => 'Sonata\\MediaBundle\\Provider\\ImageProvider',
            'sonata.media.provider.file.class' => 'Sonata\\MediaBundle\\Provider\\FileProvider',
            'sonata.media.provider.youtube.class' => 'Sonata\\MediaBundle\\Provider\\YouTubeProvider',
            'sonata.media.provider.dailymotion.class' => 'Sonata\\MediaBundle\\Provider\\DailyMotionProvider',
            'sonata.media.provider.vimeo.class' => 'Sonata\\MediaBundle\\Provider\\VimeoProvider',
            'sonata.media.thumbnail.format' => 'Sonata\\MediaBundle\\Thumbnail\\FormatThumbnail',
            'sonata.media.thumbnail.liip_imagine' => 'Sonata\\MediaBundle\\Thumbnail\\LiipImagineThumbnail',
            'sonata.media.pool.class' => 'Sonata\\MediaBundle\\Provider\\Pool',
            'sonata.media.resizer.simple.class' => 'Sonata\\MediaBundle\\Resizer\\SimpleResizer',
            'sonata.media.resizer.square.class' => 'Sonata\\MediaBundle\\Resizer\\SquareResizer',
            'sonata.media.block.media.class' => 'Sonata\\MediaBundle\\Block\\MediaBlockService',
            'sonata.media.block.feature_media.class' => 'Sonata\\MediaBundle\\Block\\FeatureMediaBlockService',
            'sonata.media.block.gallery.class' => 'Sonata\\MediaBundle\\Block\\GalleryBlockService',
            'sonata.media.manager.media.class' => 'Sonata\\MediaBundle\\Entity\\MediaManager',
            'sonata.media.manager.gallery.class' => 'Sonata\\MediaBundle\\Entity\\GalleryManager',
            'sonata.media.admin.media.class' => 'Sonata\\MediaBundle\\Admin\\ORM\\MediaAdmin',
            'sonata.media.admin.media.controller' => 'SonataMediaBundle:MediaAdmin',
            'sonata.media.admin.media.translation_domain' => 'SonataMediaBundle',
            'sonata.media.admin.gallery.class' => 'Sonata\\MediaBundle\\Admin\\GalleryAdmin',
            'sonata.media.admin.gallery.controller' => 'SonataMediaBundle:GalleryAdmin',
            'sonata.media.admin.gallery.translation_domain' => 'SonataMediaBundle',
            'sonata.media.admin.gallery_has_media.class' => 'Sonata\\MediaBundle\\Admin\\GalleryHasMediaAdmin',
            'sonata.media.admin.gallery_has_media.controller' => 'SonataAdminBundle:CRUD',
            'sonata.media.admin.gallery_has_media.translation_domain' => 'SonataMediaBundle',
            'sonata.media.resizer.simple.adapter.mode' => 'inset',
            'sonata.media.resizer.square.adapter.mode' => 'inset',
            'sonata.media.admin.media.entity' => 'BootStrap\\MediaBundle\\Entity\\Media',
            'sonata.media.admin.gallery.entity' => 'BootStrap\\MediaBundle\\Entity\\Gallery',
            'sonata.media.admin.gallery_has_media.entity' => 'BootStrap\\MediaBundle\\Entity\\GalleryHasMedia',
            'sonata.media.media.class' => 'BootStrap\\MediaBundle\\Entity\\Media',
            'sonata.media.gallery.class' => 'BootStrap\\MediaBundle\\Entity\\Gallery',
            'fos_user.validator.password.class' => 'FOS\\UserBundle\\Validator\\PasswordValidator',
            'fos_user.validator.unique.class' => 'FOS\\UserBundle\\Validator\\UniqueValidator',
            'fos_user.security.interactive_login_listener.class' => 'FOS\\UserBundle\\Security\\InteractiveLoginListener',
            'fos_user.resetting.email.template' => 'FOSUserBundle:Resetting:email.txt.twig',
            'fos_user.registration.confirmation.template' => 'FOSUserBundle:Registration:email.txt.twig',
            'fos_user.firewall_name' => 'main',
            'fos_user.model_manager_name' => NULL,
            'fos_user.model.user.class' => 'BootStrap\\UserBundle\\Entity\\User',
            'fos_user.template.engine' => 'twig',
            'fos_user.profile.form.type' => 'fos_user_profile',
            'fos_user.profile.form.name' => 'fos_user_profile_form',
            'fos_user.profile.form.validation_groups' => array(
                0 => 'Profile',
            ),
            'fos_user.registration.confirmation.from_email' => array(
                'etienne.delongeaux@gmail.com' => 'commercial',
            ),
            'fos_user.registration.confirmation.enabled' => false,
            'fos_user.registration.form.type' => 'fos_user_registration',
            'fos_user.registration.form.name' => 'fos_user_registration_form',
            'fos_user.registration.form.validation_groups' => array(
                0 => 'Registration',
            ),
            'fos_user.change_password.form.type' => 'fos_user_change_password',
            'fos_user.change_password.form.name' => 'fos_user_change_password_form',
            'fos_user.change_password.form.validation_groups' => array(
                0 => 'ChangePassword',
            ),
            'fos_user.resetting.email.from_email' => array(
                'etienne.delongeaux@gmail.com' => 'admin',
            ),
            'fos_user.resetting.token_ttl' => 86400,
            'fos_user.resetting.form.type' => 'fos_user_resetting',
            'fos_user.resetting.form.name' => 'fos_user_resetting_form',
            'fos_user.resetting.form.validation_groups' => array(
                0 => 'ResetPassword',
            ),
            'fos_user.group_manager.class' => 'FOS\\UserBundle\\Entity\\GroupManager',
            'fos_user.model.group.class' => 'BootStrap\\UserBundle\\Entity\\Group',
            'fos_user.group.form.type' => 'fos_user_group',
            'fos_user.group.form.name' => 'fos_user_group_form',
            'fos_user.group.form.validation_groups' => array(
                0 => 'Registration',
            ),
            'knp_menu.factory.class' => 'Knp\\Menu\\Silex\\RouterAwareFactory',
            'knp_menu.helper.class' => 'Knp\\Menu\\Twig\\Helper',
            'knp_menu.menu_provider.chain.class' => 'Knp\\Menu\\Provider\\ChainProvider',
            'knp_menu.menu_provider.container_aware.class' => 'Knp\\Bundle\\MenuBundle\\Provider\\ContainerAwareProvider',
            'knp_menu.menu_provider.builder_alias.class' => 'Knp\\Bundle\\MenuBundle\\Provider\\BuilderAliasProvider',
            'knp_menu.renderer_provider.class' => 'Knp\\Bundle\\MenuBundle\\Renderer\\ContainerAwareProvider',
            'knp_menu.renderer.list.class' => 'Knp\\Menu\\Renderer\\ListRenderer',
            'knp_menu.twig.extension.class' => 'Knp\\Menu\\Twig\\MenuExtension',
            'knp_menu.renderer.twig.class' => 'Knp\\Menu\\Renderer\\TwigRenderer',
            'knp_menu.renderer.twig.template' => 'knp_menu.html.twig',
            'knp_menu.default_renderer' => 'twig',
            'knp_paginator.class' => 'Knp\\Component\\Pager\\Paginator',
            'knp_paginator.template.pagination' => 'KnpPaginatorBundle:Pagination:sliding.html.twig',
            'knp_paginator.template.sortable' => 'KnpPaginatorBundle:Pagination:sortable_link.html.twig',
            'knp_paginator.page_range' => 5,
            'bootstrap.database.factory.class' => 'BootStrap\\DatabaseBundle\\Manager\\DatabaseFactory',
            'php_memcache.class' => 'Memcache',
            'pi_cache.factory.class' => 'BootStrap\\CacheBundle\\Manager\\CacheFactory',
            'pi_cache.client.memcache.class' => 'BootStrap\\CacheBundle\\Manager\\Client\\MemcacheClient',
            'pi_cache.client.memcache.servers' => array(
                '127.0.0.1' => 11211,
            ),
            'pi_cache.client.filecache.class' => 'BootStrap\\CacheBundle\\Manager\\Client\\FilecacheClient',
            'bootstrap.wurfl.listener.mobile.class' => 'BootStrap\\WurflBundle\\EventListener\\MobileListener',
            'bootstrap.user.repository.class' => 'BootStrap\\UserBundle\\Repository\\Repository',
            'bootstrap.routetranslator.factory.class' => 'BootStrap\\UserBundle\\Manager\\RouteTranslatorFactory',
            'bootstrap.route_loader.class' => 'BootStrap\\UserBundle\\Manager\\Route\\RouteLoader',
            'bootstrap.route_cache.class' => 'BootStrap\\UserBundle\\Manager\\Route\\CacheRoute',
            'bootstrap.entitiescontainer.listener.class' => 'BootStrap\\UserBundle\\EventListener\\EntitiesContainer',
            'pi_google.factory.class' => 'BootStrap\\GoogleBundle\\Manager\\GoogleFactory',
            'pi_google.client.analytics.class' => 'BootStrap\\GoogleBundle\\Manager\\Client\\AnalyticsClient',
            'pi_google.client.adwords.class' => 'BootStrap\\GoogleBundle\\Manager\\Client\\AdwordsClient',
            'pi_google.client.maps.class' => 'BootStrap\\GoogleBundle\\Manager\\Client\\MapsClient',
            'pi_google.twig.extension.analytics.class' => 'BootStrap\\GoogleBundle\\Extension\\AnalyticsExtension',
            'pi_google.helper.analytics.class' => 'BootStrap\\GoogleBundle\\Helper\\AnalyticsHelper',
            'pi_google.analytics' => array(
                'api' => array(
                    'email' => 'adel.oustad@gmail.com',
                    'pass' => 'oustadel',
                    'id' => 61436126,
                ),
                'trackers' => array(
                    'default' => array(
                        'name' => 'pi',
                        'accountId' => 'UA-32931986-1',
                        'domain' => '.novedia-agency.com',
                        'trackPageLoadTime' => true,
                        'allowHash' => false,
                        'allowLinker' => true,
                    ),
                ),
            ),
            'pi_facebook.client.analytics.class' => 'BootStrap\\FacebookBundle\\Manager\\Client\\AnalyticsClient',
            'pi_facebook.twig.extension.analytics.class' => 'BootStrap\\FacebookBundle\\Extension\\AnalyticsExtension',
            'pi_facebook.helper.analytics.class' => 'BootStrap\\FacebookBundle\\Helper\\AnalyticsHelper',
            'pi_facebook.analytics' => array(
                'api' => array(
                    'appId' => 333501983393855,
                    'secret' => '186c7f8b3c1980cfe9d9d18abf4be176',
                    'permissions_basique' => array(
                        0 => 'email',
                        1 => 'user_birthday',
                        2 => 'user_location',
                    ),
                    'permissions_publish' => array(
                        0 => 'email',
                        1 => 'user_birthday',
                        2 => 'user_location',
                        3 => 'publish_stream',
                    ),
                    'permissions_read' => array(
                        0 => 'email',
                        1 => 'user_birthday',
                        2 => 'user_location',
                        3 => 'read_stream',
                    ),
                    'alias' => 'Orchestra',
                    'cookie' => true,
                ),
            ),
            'piapp.twig.extension.forward.class' => 'PiApp\\AdminBundle\\Twig\\Extension\\PiForwardExtension',
            'piapp.twig.extension.service.class' => 'PiApp\\AdminBundle\\Twig\\Extension\\PiServiceExtension',
            'piapp.twig.extension.jquery.class' => 'PiApp\\AdminBundle\\Twig\\Extension\\PiJqueryExtension',
            'piapp.twig.extension.widget.class' => 'PiApp\\AdminBundle\\Twig\\Extension\\PiWidgetExtension',
            'piapp.twig.extension.date.class' => 'PiApp\\AdminBundle\\Twig\\Extension\\PiDateExtension',
            'piapp.twig.extension.tool.class' => 'PiApp\\AdminBundle\\Twig\\Extension\\PiToolExtension',
            'piapp.twig.extension.route.class' => 'PiApp\\AdminBundle\\Twig\\Extension\\PiRouteExtension',
            'piapp.twig.extension.layouthead.class' => 'PiApp\\AdminBundle\\Twig\\Extension\\PiLayoutHeadExtension',
            'piapp.manager.array.class' => 'PiApp\\AdminBundle\\Util\\PiArrayManager',
            'piapp.manager.string.class' => 'PiApp\\AdminBundle\\Util\\PiStringManager',
            'piapp.manager.stringcut.class' => 'PiApp\\AdminBundle\\Util\\PiStringCutManager',
            'piapp.manager.date.class' => 'PiApp\\AdminBundle\\Util\\PiDateManager',
            'piapp.manager.file.class' => 'PiApp\\AdminBundle\\Util\\PiFileManager',
            'piapp.manager.locale.class' => 'PiApp\\AdminBundle\\Util\\PiLocaleManager',
            'piapp.manager.regex.class' => 'PiApp\\AdminBundle\\Util\\PiRegexManager',
            'piapp.manager.jquery.languagechoice.class' => 'PiApp\\AdminBundle\\Util\\PiJquery\\PiLanguageChoiceManager',
            'piapp.manager.jquery.gridsimple.class' => 'PiApp\\AdminBundle\\Util\\PiJquery\\PiGridSimpleManager',
            'piapp.manager.jquery.gridtable.class' => 'PiApp\\AdminBundle\\Util\\PiJquery\\PiGridTableManager',
            'piapp.manager.jquery.formsimple.class' => 'PiApp\\AdminBundle\\Util\\PiJquery\\PiFormSimpleManager',
            'piapp.manager.jquery.prototypebytabs.class' => 'PiApp\\AdminBundle\\Util\\PiJquery\\PiPrototypeByTabsManager',
            'piapp.manager.jquery.sessionflash.class' => 'PiApp\\AdminBundle\\Util\\PiJquery\\PiSessionFlashManager',
            'piapp.manager.jquery.orgchartpage.class' => 'PiApp\\AdminBundle\\Util\\PiJquery\\PiOrgChartPageManager',
            'piapp.manager.jquery.orgsemantique.class' => 'PiApp\\AdminBundle\\Util\\PiJquery\\PiOrgSemantiquePageManager',
            'piapp.manager.jquery.orgtreepage.class' => 'PiApp\\AdminBundle\\Util\\PiJquery\\PiOrgTreePageManager',
            'piapp.manager.jquery.contextmenu.class' => 'PiApp\\AdminBundle\\Util\\PiJquery\\PiContextMenuManager',
            'piapp.manager.jquery.backstretch.class' => 'PiApp\\AdminBundle\\Util\\PiJquery\\PiBackstretchManager',
            'piapp.manager.jquery.veneer.class' => 'PiApp\\AdminBundle\\Util\\PiJquery\\PiVeneerManager',
            'piapp.manager.jquery.tinyaccordeon.class' => 'PiApp\\AdminBundle\\Util\\PiJquery\\PiTinyAccordeonManager',
            'piapp.manager.jquery.wizard.class' => 'PiApp\\AdminBundle\\Util\\PiJquery\\PiWizardManager',
            'piapp.manager.jquery.widgetadmin.class' => 'PiApp\\AdminBundle\\Util\\PiJquery\\PiWidgetAdminManager',
            'piapp.manager.jquery.flexslider.class' => 'PiApp\\AdminBundle\\Util\\PiJquery\\PiFlexSliderManager',
            'piapp.manager.jquery.twitter.class' => 'PiApp\\AdminBundle\\Util\\PiJquery\\PiTwitterManager',
            'piapp.manager.jquery.searchlucene.class' => 'PiApp\\AdminBundle\\Util\\PiJquery\\PiSearchLuceneManager',
            'piapp.manager.jquery.widgetimport.class' => 'PiApp\\AdminBundle\\Util\\PiJquery\\PiwidgetimportManager',
            'piapp.manager.widget.content.class' => 'PiApp\\AdminBundle\\Util\\PiWidget\\PiContentManager',
            'piapp.manager.widget.gedmo.class' => 'PiApp\\AdminBundle\\Util\\PiWidget\\PiGedmoManager',
            'piapp.manager.widget.search.class' => 'PiApp\\AdminBundle\\Util\\PiWidget\\PiSearchManager',
            'piapp.admin.repository.class' => 'PiApp\\AdminBundle\\Repository\\Repository',
            'piapp.admin.manager.page.class' => 'PiApp\\AdminBundle\\Manager\\PiPageManager',
            'piapp.admin.manager.widget.class' => 'PiApp\\AdminBundle\\Manager\\PiWidgetManager',
            'piapp.admin.manager.transwidget.class' => 'PiApp\\AdminBundle\\Manager\\PiTransWidgetManager',
            'piapp.admin.manager.listener.class' => 'PiApp\\AdminBundle\\Manager\\PiListenerManager',
            'piapp.admin.manager.tree.class' => 'PiApp\\AdminBundle\\Manager\\PiTreeManager',
            'piapp.admin.manager.slider.class' => 'PiApp\\AdminBundle\\Manager\\PiSliderManager',
            'piapp.admin.manager.jqext.class' => 'PiApp\\AdminBundle\\Manager\\PiJqextManager',
            'piapp.admin.manager.search_lucene.class' => 'PiApp\\AdminBundle\\Manager\\PiLuceneManager',
            'piapp.admin.manager.formbuilder.class' => 'PiApp\\AdminBundle\\Manager\\PiFormBuilderManager',
            'piapp.twig.loader.class' => 'PiApp\\AdminBundle\\Twig\\PiTwigLoader',
            'piapp.twig.caching.class' => 'PiApp\\AdminBundle\\Twig\\PiTwigCache',
            'pi_app_admin.validator.unique.class' => 'PiApp\\AdminBundle\\Validator\\Constraints\\UniqueValidator',
            'pi_app_admin.validator.collectionof.class' => 'PiApp\\AdminBundle\\Validator\\Constraints\\CollectionOfValidator',
            'piapp.admin.listener.login.class' => 'PiApp\\AdminBundle\\EventListener\\LoginListener',
            'piapp.admin.listener.logout.class' => 'PiApp\\AdminBundle\\EventListener\\LogoutListener',
            'piapp.admin.listener.postload.class' => 'PiApp\\AdminBundle\\EventListener\\PostLoadListener',
            'piapp.admin.listener.loadclassmetadata.class' => 'PiApp\\AdminBundle\\EventListener\\loadClassMetadataListener',
            'piapp.admin.listener.onflush.class' => 'PiApp\\AdminBundle\\EventListener\\OnFlushListener',
            'piapp.admin.listener.preremove.class' => 'PiApp\\AdminBundle\\EventListener\\PreRemoveListener',
            'piapp.admin.listener.postremove.class' => 'PiApp\\AdminBundle\\EventListener\\PostRemoveListener',
            'piapp.admin.listener.prepersist.class' => 'PiApp\\AdminBundle\\EventListener\\PrePersistListener',
            'piapp.admin.listener.postpersist.class' => 'PiApp\\AdminBundle\\EventListener\\PostPersistListener',
            'piapp.admin.listener.preupdate.class' => 'PiApp\\AdminBundle\\EventListener\\PreUpdateListener',
            'piapp.admin.listener.postupdate.class' => 'PiApp\\AdminBundle\\EventListener\\PostUpdateListener',
            'piapp.admin.listener.schema.class' => 'PiApp\\AdminBundle\\EventListener\\SchemaListener',
            'pi_app_admin.admin.context_menu_theme' => 'pi2',
            'pi_app_admin.admin.grid_index_css' => 'bundles/piappadmin/css/grid/style-grid-1.css',
            'pi_app_admin.admin.grid_show_css' => 'bundles/piappadmin/css/grid/style-grid-1.css',
            'pi_app_admin.admin.grid_theme_css' => 'bundles/piappadmin/css/themes/aristo/jquery-wijmo.css',
            'pi_app_admin.page.homepage_deletewidget' => true,
            'pi_app_admin.page.management_by_user_only' => true,
            'pi_app_admin.page.single_slug' => false,
            'pi_app_admin.page.refresh_allpage_containing_snippet' => true,
            'pi_app_admin.page.indexation_authorized_automatically' => false,
            'pi_app_admin.page.switch_layout_mobile_authorized' => false,
            'pi_app_admin.page.switch_layout_init_redirection_authorized' => false,
            'pi_app_admin.page.switch_language_browser_authorized' => false,
            'pi_app_admin.page.memcache_enable' => false,
            'pi_app_admin.page.media_pixel' => 'Translucent_50%_white.png',
            'pi_app_admin.page.google_analytic' => true,
            'pi_app_admin.page.google_analytic_tracker' => 'default',
            'pi_app_admin.page.google_analytic_template' => 'BootStrapGoogleBundle:Analytics:default.html.twig',
            'pi_app_admin.page.google_analytic_template2' => 'BootStrapGoogleBundle:Analytics:api.html.twig',
            'pi_app_admin.form.show_legend' => true,
            'pi_app_admin.form.show_child_legend' => false,
            'pi_app_admin.form.error_type' => 'inline',
            'pi_app_admin.layout.init.pc.template' => 'layout-pi-page1.html.twig',
            'pi_app_admin.layout.init.pc.redirection' => 'home_page',
            'pi_app_admin.layout.init.mobile.template' => 'Default',
            'pi_app_admin.layout.init.mobile.redirection' => 'home_page',
            'pi_app_admin.layout.login.admin_redirect' => 'admin_homepage',
            'pi_app_admin.layout.login.user_redirect' => 'admin_homepage',
            'pi_app_admin.layout.login.subscriber_redirect' => 'home_page',
            'pi_app_admin.layout.login.admin_template' => 'layout-pi-admin.html.twig',
            'pi_app_admin.layout.login.user_template' => 'layout-pi-admin.html.twig',
            'pi_app_admin.layout.login.subscriber_template' => 'layout-pi-page.html.twig',
            'pi_app_admin.layout.template.connexion' => 'PiAppTemplateBundle::Template\\Layout\\Connexion\\layout-security.html.twig',
            'pi_app_admin.layout.template.form' => 'PiAppTemplateBundle:Template\\Form:fields.html.twig',
            'pi_app_admin.layout.template.grid' => 'PiAppTemplateBundle:Template\\Grid:grid.theme.html.twig',
            'pi_app_admin.layout.template.flash' => 'PiAppTemplateBundle:Template\\Flash:flash.html.twig',
            'pi_app_admin.layout.meta.author' => 'Orchestra',
            'pi_app_admin.layout.meta.copyright' => 'http://www.cmf-orchestra.net/',
            'pi_app_admin.layout.meta.og_type' => 'Orchestra',
            'pi_app_admin.layout.meta.og_image' => 'bundles/piappadmin/images/logo/logo-orchestra-white.png',
            'pi_app_admin.layout.meta.og_site_name' => 'http://www.cmf-orchestra.com/',
            'pi_app_admin.layout.meta.title' => 'Orchestra',
            'pi_app_admin.layout.meta.description' => 'Based in Europe with operational offices in Switzerland, France, Russia, West and South Africa, Singapore.',
            'pi_app_admin.layout.meta.keywords' => 'Orchestra, symfony 2, framework, CMF, CMS, PHP web applications',
            'js_files' => array(

            ),
            'css_files' => array(

            ),
            'piapp.gedmo.repository.class' => 'PiApp\\GedmoBundle\\Repository\\Repository',
            'piapp.gedmo.event_subscriber.media.class' => 'PiApp\\GedmoBundle\\EventSubscriber\\EventSubscriberMedia',
            'piapp.gedmo.event_subscriber.position.class' => 'PiApp\\GedmoBundle\\EventSubscriber\\EventSubscriberPosition',
            'piapp.manager.formbuilder.model.snippet.class' => 'PiApp\\GedmoBundle\\Manager\\FormBuilder\\PiModelWidgetSnippet',
            'piapp.manager.formbuilder.model.block.class' => 'PiApp\\GedmoBundle\\Manager\\FormBuilder\\PiModelWidgetBlock',
            'piapp.manager.formbuilder.model.content.class' => 'PiApp\\GedmoBundle\\Manager\\FormBuilder\\PiModelWidgetContent',
            'piapp.manager.formbuilder.model.slide.class' => 'PiApp\\GedmoBundle\\Manager\\FormBuilder\\PiModelWidgetSlide',
            'web_profiler.debug_toolbar.class' => 'Symfony\\Bundle\\WebProfilerBundle\\EventListener\\WebDebugToolbarListener',
            'web_profiler.debug_toolbar.intercept_redirects' => false,
            'web_profiler.debug_toolbar.mode' => 2,
            'sensio.distribution.webconfigurator.class' => 'Sensio\\Bundle\\DistributionBundle\\Configurator\\Configurator',
            'data_collector.templates' => array(
                'data_collector.config' => array(
                    0 => 'config',
                    1 => 'WebProfilerBundle:Collector:config',
                ),
                'data_collector.request' => array(
                    0 => 'request',
                    1 => 'WebProfilerBundle:Collector:request',
                ),
                'data_collector.exception' => array(
                    0 => 'exception',
                    1 => 'WebProfilerBundle:Collector:exception',
                ),
                'data_collector.events' => array(
                    0 => 'events',
                    1 => 'WebProfilerBundle:Collector:events',
                ),
                'data_collector.logger' => array(
                    0 => 'logger',
                    1 => 'WebProfilerBundle:Collector:logger',
                ),
                'data_collector.timer' => array(
                    0 => 'timer',
                    1 => 'WebProfilerBundle:Collector:timer',
                ),
                'data_collector.memory' => array(
                    0 => 'memory',
                    1 => 'WebProfilerBundle:Collector:memory',
                ),
                'data_collector.security' => array(
                    0 => 'security',
                    1 => 'SecurityBundle:Collector:security',
                ),
                'swiftmailer.data_collector' => array(
                    0 => 'swiftmailer',
                    1 => 'SwiftmailerBundle:Collector:swiftmailer',
                ),
                'data_collector.doctrine' => array(
                    0 => 'db',
                    1 => 'DoctrineBundle:Collector:db',
                ),
            ),
        );
    }
}
