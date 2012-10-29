<?php
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InactiveScopeException;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Parameter;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;
class appProdProjectContainer extends Container
{
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
    protected function getAnnotationReaderService()
    {
        return $this->services['annotation_reader'] = new \Doctrine\Common\Annotations\FileCacheReader(new \Doctrine\Common\Annotations\AnnotationReader(), '/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/prod/annotations', false);
    }
    protected function getAssetic_AssetManagerService()
    {
        $a = $this->get('templating.loader');
        $this->services['assetic.asset_manager'] = $instance = new \Assetic\Factory\LazyAssetManager($this->get('assetic.asset_factory'), array('twig' => new \Assetic\Factory\Loader\CachedFormulaLoader(new \Assetic\Extension\Twig\TwigFormulaLoader($this->get('twig')), new \Assetic\Cache\ConfigCache('/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/prod/assetic/config'), false)));
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
        $instance->addResource(new \Symfony\Bundle\AsseticBundle\Factory\Resource\DirectoryResource($a, '', '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources/views', '/\\.[^.]+\\.twig$/'), 'twig');
        return $instance;
    }
    protected function getAssetic_Filter_CssrewriteService()
    {
        return $this->services['assetic.filter.cssrewrite'] = new \Assetic\Filter\CssRewriteFilter();
    }
    protected function getAssetic_FilterManagerService()
    {
        return $this->services['assetic.filter_manager'] = new \Symfony\Bundle\AsseticBundle\FilterManager($this, array('cssrewrite' => 'assetic.filter.cssrewrite'));
    }
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
    protected function getBootstrap_Database_FactoryService()
    {
        return $this->services['bootstrap.database.factory'] = new \BootStrap\DatabaseBundle\Manager\DatabaseFactory($this);
    }
    protected function getBootstrap_Entitiescontainer_ListenerService()
    {
        return $this->services['bootstrap.entitiescontainer.listener'] = new \BootStrap\UserBundle\EventListener\EntitiesContainer($this);
    }
    protected function getBootstrap_RouteCacheService()
    {
        return $this->services['bootstrap.route_cache'] = new \BootStrap\UserBundle\Manager\Route\CacheRoute($this);
    }
    protected function getBootstrap_RouteLoaderService()
    {
        return $this->services['bootstrap.route_loader'] = new \BootStrap\UserBundle\Manager\Route\RouteLoader($this);
    }
    protected function getBootstrap_Routetranslator_FactoryService()
    {
        return $this->services['bootstrap.routetranslator.factory'] = new \BootStrap\UserBundle\Manager\RouteTranslatorFactory($this);
    }
    protected function getBootstrap_User_RepositoryService()
    {
        return $this->services['bootstrap.user.repository'] = new \BootStrap\UserBundle\Repository\Repository($this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getBootstrap_Wurfl_Listener_MobileService()
    {
        return $this->services['bootstrap.wurfl.listener.mobile'] = new \BootStrap\WurflBundle\EventListener\MobileListener();
    }
    protected function getCacheWarmerService()
    {
        $a = $this->get('kernel');
        $b = $this->get('templating.name_parser');
        $c = new \Symfony\Bundle\FrameworkBundle\CacheWarmer\TemplateFinder($a, $b, '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources');
        return $this->services['cache_warmer'] = new \Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerAggregate(array(0 => new \Symfony\Bundle\FrameworkBundle\CacheWarmer\TemplatePathsCacheWarmer($c, $this->get('templating.locator')), 1 => new \Symfony\Bundle\AsseticBundle\CacheWarmer\AssetManagerCacheWarmer($this), 2 => new \Symfony\Bundle\FrameworkBundle\CacheWarmer\RouterCacheWarmer($this->get('i18n_routing.router')), 3 => new \Symfony\Bundle\TwigBundle\CacheWarmer\TemplateCacheCacheWarmer($this, $c), 4 => new \Symfony\Bundle\AsseticBundle\CacheWarmer\AssetWriterCacheWarmer($this, new \Assetic\AssetWriter('/Users/guillaumemigeon/Sites/orchestra-cmf/app/../web')), 5 => new \Symfony\Bridge\Doctrine\CacheWarmer\ProxyCacheWarmer($this->get('doctrine'))));
    }
    protected function getDebug_Twig_ExtensionService()
    {
        return $this->services['debug.twig.extension'] = new \Twig_Extensions_Extension_Debug();
    }
    protected function getDoctrineService()
    {
        return $this->services['doctrine'] = new \Symfony\Bundle\DoctrineBundle\Registry($this, array('default' => 'doctrine.dbal.default_connection'), array('default' => 'doctrine.orm.default_entity_manager'), 'default', 'default');
    }
    protected function getDoctrine_Dbal_ConnectionFactoryService()
    {
        return $this->services['doctrine.dbal.connection_factory'] = new \Symfony\Bundle\DoctrineBundle\ConnectionFactory(array());
    }
    protected function getDoctrine_Dbal_DefaultConnectionService()
    {
        $a = $this->get('annotation_reader');
        $b = new \Gedmo\Timestampable\TimestampableListener();
        $b->setAnnotationReader($a);
        $c = new \Gedmo\Tree\TreeListener();
        $c->setAnnotationReader($a);
        $d = new \Gedmo\Sluggable\SluggableListener();
        $d->setAnnotationReader($a);
        $e = new \Gedmo\Sortable\SortableListener();
        $e->setAnnotationReader($a);
        $f = new \Doctrine\Common\EventManager();
        $f->addEventSubscriber(new \Doctrine\DBAL\Event\Listeners\MysqlSessionInit('UTF8'));
        $f->addEventSubscriber($b);
        $f->addEventSubscriber($c);
        $f->addEventSubscriber($d);
        $f->addEventSubscriber($this->get('stof_doctrine_extensions.listener.translatable'));
        $f->addEventSubscriber($this->get('stof_doctrine_extensions.listener.loggable'));
        $f->addEventSubscriber($e);
        $f->addEventSubscriber($this->get('sonata.easy_extends.doctrine.mapper'));
        $f->addEventSubscriber($this->get('sonata.cache.orm.event_subscriber'));
        $f->addEventSubscriber($this->get('sonata.media.doctrine.event_subscriber'));
        $f->addEventSubscriber(new \FOS\UserBundle\Entity\UserListener($this));
        $f->addEventSubscriber($this->get('gedmo.listener.tree'));
        $f->addEventSubscriber($this->get('gedmo.listener.translatable'));
        $f->addEventSubscriber($this->get('gedmo.listener.timestampable'));
        $f->addEventSubscriber($this->get('gedmo.listener.sluggable'));
        $f->addEventSubscriber($this->get('gedmo.listener.loggable'));
        $f->addEventSubscriber($this->get('pi_app_admin.event_subscriber.media'));
        $f->addEventSubscriber($this->get('pi_app_admin.event_subscriber.position'));
        $f->addEventListener(array(0 => 'postGenerateSchema'), new \BeSimple\I18nRoutingBundle\Routing\Translator\DoctrineDBAL\SchemaListener());
        $f->addEventListener(array(0 => 'postLoad'), $this->get('pi_app_admin.postload_listener'));
        $f->addEventListener(array(0 => 'preRemove'), $this->get('pi_app_admin.preremove_listener'));
        $f->addEventListener(array(0 => 'postRemove'), $this->get('pi_app_admin.postremove_listener'));
        $f->addEventListener(array(0 => 'postGenerateSchema'), $this->get('pi_app_admin.schema_listener'));
        $f->addEventListener(array(0 => 'prePersist'), $this->get('pi_app_admin.prepersist_listener'));
        $f->addEventListener(array(0 => 'postPersist'), $this->get('pi_app_admin.postpersist_listener'));
        $f->addEventListener(array(0 => 'preUpdate'), $this->get('pi_app_admin.preupdate_listener'));
        $f->addEventListener(array(0 => 'postUpdate'), $this->get('pi_app_admin.postupdate_listener'));
        return $this->services['doctrine.dbal.default_connection'] = $this->get('doctrine.dbal.connection_factory')->createConnection(array('dbname' => 'symforchestra', 'host' => 'localhost', 'port' => '', 'user' => 'root', 'password' => 'pacman', 'driver' => 'pdo_mysql', 'logging' => false, 'driverOptions' => array()), new \Doctrine\DBAL\Configuration(), $f, array('enum' => 'string', 'varbinary' => 'string', 'tinyblob' => 'text'));
    }
    protected function getDoctrine_Orm_DefaultEntityManagerService()
    {
        $a = $this->get('annotation_reader');
        $b = new \Doctrine\Common\Cache\ArrayCache();
        $b->setNamespace('sf2orm_default_ac626430ed02a434e352f692db2edd9b');
        $c = new \Doctrine\Common\Cache\ArrayCache();
        $c->setNamespace('sf2orm_default_ac626430ed02a434e352f692db2edd9b');
        $d = new \Doctrine\Common\Cache\ArrayCache();
        $d->setNamespace('sf2orm_default_ac626430ed02a434e352f692db2edd9b');
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
        $i->setProxyDir('/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/prod/doctrine/orm/Proxies');
        $i->setProxyNamespace('Proxies');
        $i->setAutoGenerateProxyClasses(false);
        $i->setClassMetadataFactoryName('Doctrine\\ORM\\Mapping\\ClassMetadataFactory');
        return $this->services['doctrine.orm.default_entity_manager'] = call_user_func(array('Doctrine\\ORM\\EntityManager', 'create'), $this->get('doctrine.dbal.default_connection'), $i);
    }
    protected function getDoctrine_Orm_Validator_UniqueService()
    {
        return $this->services['doctrine.orm.validator.unique'] = new \Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntityValidator($this->get('doctrine'));
    }
    protected function getDoctrine_Orm_ValidatorInitializerService()
    {
        return $this->services['doctrine.orm.validator_initializer'] = new \Symfony\Bridge\Doctrine\Validator\EntityInitializer($this->get('doctrine'));
    }
    protected function getEventDispatcherService()
    {
        $this->services['event_dispatcher'] = $instance = new \Symfony\Bundle\FrameworkBundle\ContainerAwareEventDispatcher($this);
        $instance->addListenerService('knp_pager.before', array(0 => 'knp_paginator.subscriber.paginate', 1 => 'before'), 0);
        $instance->addListenerService('knp_pager.pagination', array(0 => 'knp_paginator.subscriber.paginate', 1 => 'pagination'), 0);
        $instance->addListenerService('knp_pager.before', array(0 => 'knp_paginator.subscriber.sortable', 1 => 'before'), 1);
        $instance->addListenerService('knp_pager.pagination', array(0 => 'knp_paginator.subscriber.sliding_pagination', 1 => 'pagination'), 1);
        $instance->addListenerService('kernel.request', array(0 => 'router_listener', 1 => 'onEarlyKernelRequest'), 255);
        $instance->addListenerService('kernel.request', array(0 => 'router_listener', 1 => 'onKernelRequest'), 0);
        $instance->addListenerService('kernel.response', array(0 => 'response_listener', 1 => 'onKernelResponse'), 0);
        $instance->addListenerService('kernel.request', array(0 => 'session_listener', 1 => 'onKernelRequest'), 128);
        $instance->addListenerService('kernel.request', array(0 => 'security.firewall', 1 => 'onKernelRequest'), 64);
        $instance->addListenerService('kernel.response', array(0 => 'security.rememberme.response_listener', 1 => 'onKernelResponse'), 0);
        $instance->addListenerService('kernel.exception', array(0 => 'twig.exception_listener', 1 => 'onKernelException'), -128);
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
        return $instance;
    }
    protected function getExtension_ListenerService()
    {
        $this->services['extension.listener'] = $instance = new \BootStrap\TranslationBundle\EventListener\DoctrineExtensionListener();
        $instance->setContainer($this);
        return $instance;
    }
    protected function getFileLocatorService()
    {
        return $this->services['file_locator'] = new \Symfony\Component\HttpKernel\Config\FileLocator($this->get('kernel'), '/Users/guillaumemigeon/Sites/orchestra-cmf/app/Resources');
    }
    protected function getFilesystemService()
    {
        return $this->services['filesystem'] = new \Symfony\Component\Filesystem\Filesystem();
    }
    protected function getForm_CsrfProviderService()
    {
        return $this->services['form.csrf_provider'] = new \Symfony\Component\Form\Extension\Csrf\CsrfProvider\SessionCsrfProvider($this->get('session'), '5b5a0ff57bd45284dafe7f104fc7d8e15');
    }
    protected function getForm_FactoryService()
    {
        return $this->services['form.factory'] = new \Symfony\Component\Form\FormFactory(array(0 => new \Symfony\Component\Form\Extension\DependencyInjection\DependencyInjectionExtension($this, array('field' => 'form.type.field', 'form' => 'form.type.form', 'birthday' => 'form.type.birthday', 'checkbox' => 'form.type.checkbox', 'choice' => 'form.type.choice', 'collection' => 'form.type.collection', 'country' => 'form.type.country', 'date' => 'form.type.date', 'datetime' => 'form.type.datetime', 'email' => 'form.type.email', 'file' => 'form.type.file', 'hidden' => 'form.type.hidden', 'integer' => 'form.type.integer', 'language' => 'form.type.language', 'locale' => 'form.type.locale', 'money' => 'form.type.money', 'number' => 'form.type.number', 'password' => 'form.type.password', 'percent' => 'form.type.percent', 'radio' => 'form.type.radio', 'repeated' => 'form.type.repeated', 'search' => 'form.type.search', 'textarea' => 'form.type.textarea', 'text' => 'form.type.text', 'time' => 'form.type.time', 'timezone' => 'form.type.timezone', 'url' => 'form.type.url', 'csrf' => 'form.type.csrf', 'entity' => 'form.type.entity', 'sonata_type_admin' => 'sonata.admin.form.type.admin', 'sonata_type_collection' => 'sonata.admin.form.type.collection', 'sonata_type_model' => 'sonata.admin.form.type.model', 'sonata_type_model_reference' => 'sonata.admin.form.type.model_reference', 'sonata_type_immutable_array' => 'sonata.admin.form.type.array', 'sonata_type_boolean' => 'sonata.admin.form.type.boolean', 'sonata_type_translatable_choice' => 'sonata.admin.form.type.translatable_choice', 'sonata_type_date_range' => 'sonata.admin.form.type.date_range', 'sonata_type_datetime_range' => 'sonata.admin.form.type.datetime_range', 'sonata_type_filter_number' => 'sonata.admin.form.filter.type.number', 'sonata_type_filter_choice' => 'sonata.admin.form.filter.type.choice', 'sonata_type_filter_default' => 'sonata.admin.form.filter.type.default', 'sonata_type_filter_date' => 'sonata.admin.form.filter.type.date', 'sonata_type_filter_date_range' => 'sonata.admin.form.filter.type.daterange', 'sonata_type_filter_datetime' => 'sonata.admin.form.filter.type.datetime', 'sonata_type_filter_datetime_range' => 'sonata.admin.form.filter.type.datetime_range', 'sonata_block_service_choice' => 'sonata.block.form.type.block', 'sonata_media_type' => 'sonata.media.form.type.media', 'fos_user_username' => 'fos_user.username_form_type', 'fos_user_profile' => 'fos_user.profile.form.type', 'fos_user_registration' => 'fos_user.registration.form.type', 'fos_user_change_password' => 'fos_user.change_password.form.type', 'fos_user_resetting' => 'fos_user.resetting.form.type', 'fos_user_group' => 'fos_user.group.form.type', 'bootstrap_security_roles' => 'sonata.user.form.type.security_roles', 'bootstrap_security_permissions' => 'sonata.user.form.type.security_permissions'), array('field' => array(0 => 'form.type_extension.field', 1 => 'sonata.admin.form.extension.field', 2 => 'pi.form.help_extension', 3 => 'pi.form.label_extension', 4 => 'pi.form.addinfo_extension', 5 => 'pi.form.field_error_type'), 'form' => array(0 => 'form.type_extension.csrf', 1 => 'pi.form.legend_extension', 2 => 'pi.form.error_type_extension')), array(0 => 'form.type_guesser.validator', 1 => 'form.type_guesser.doctrine'))));
    }
    protected function getForm_Type_BirthdayService()
    {
        return $this->services['form.type.birthday'] = new \Symfony\Component\Form\Extension\Core\Type\BirthdayType();
    }
    protected function getForm_Type_CheckboxService()
    {
        return $this->services['form.type.checkbox'] = new \Symfony\Component\Form\Extension\Core\Type\CheckboxType();
    }
    protected function getForm_Type_ChoiceService()
    {
        return $this->services['form.type.choice'] = new \Symfony\Component\Form\Extension\Core\Type\ChoiceType();
    }
    protected function getForm_Type_CollectionService()
    {
        return $this->services['form.type.collection'] = new \Symfony\Component\Form\Extension\Core\Type\CollectionType();
    }
    protected function getForm_Type_CountryService()
    {
        return $this->services['form.type.country'] = new \Symfony\Component\Form\Extension\Core\Type\CountryType();
    }
    protected function getForm_Type_CsrfService()
    {
        return $this->services['form.type.csrf'] = new \Symfony\Component\Form\Extension\Csrf\Type\CsrfType($this->get('form.csrf_provider'));
    }
    protected function getForm_Type_DateService()
    {
        return $this->services['form.type.date'] = new \Symfony\Component\Form\Extension\Core\Type\DateType();
    }
    protected function getForm_Type_DatetimeService()
    {
        return $this->services['form.type.datetime'] = new \Symfony\Component\Form\Extension\Core\Type\DateTimeType();
    }
    protected function getForm_Type_EmailService()
    {
        return $this->services['form.type.email'] = new \Symfony\Component\Form\Extension\Core\Type\EmailType();
    }
    protected function getForm_Type_EntityService()
    {
        return $this->services['form.type.entity'] = new \Symfony\Bridge\Doctrine\Form\Type\EntityType($this->get('doctrine'));
    }
    protected function getForm_Type_FieldService()
    {
        return $this->services['form.type.field'] = new \Symfony\Component\Form\Extension\Core\Type\FieldType($this->get('validator'));
    }
    protected function getForm_Type_FileService()
    {
        return $this->services['form.type.file'] = new \Symfony\Component\Form\Extension\Core\Type\FileType();
    }
    protected function getForm_Type_FormService()
    {
        return $this->services['form.type.form'] = new \Symfony\Component\Form\Extension\Core\Type\FormType();
    }
    protected function getForm_Type_HiddenService()
    {
        return $this->services['form.type.hidden'] = new \Symfony\Component\Form\Extension\Core\Type\HiddenType();
    }
    protected function getForm_Type_IntegerService()
    {
        return $this->services['form.type.integer'] = new \Symfony\Component\Form\Extension\Core\Type\IntegerType();
    }
    protected function getForm_Type_LanguageService()
    {
        return $this->services['form.type.language'] = new \Symfony\Component\Form\Extension\Core\Type\LanguageType();
    }
    protected function getForm_Type_LocaleService()
    {
        return $this->services['form.type.locale'] = new \Symfony\Component\Form\Extension\Core\Type\LocaleType();
    }
    protected function getForm_Type_MoneyService()
    {
        return $this->services['form.type.money'] = new \Symfony\Component\Form\Extension\Core\Type\MoneyType();
    }
    protected function getForm_Type_NumberService()
    {
        return $this->services['form.type.number'] = new \Symfony\Component\Form\Extension\Core\Type\NumberType();
    }
    protected function getForm_Type_PasswordService()
    {
        return $this->services['form.type.password'] = new \Symfony\Component\Form\Extension\Core\Type\PasswordType();
    }
    protected function getForm_Type_PercentService()
    {
        return $this->services['form.type.percent'] = new \Symfony\Component\Form\Extension\Core\Type\PercentType();
    }
    protected function getForm_Type_RadioService()
    {
        return $this->services['form.type.radio'] = new \Symfony\Component\Form\Extension\Core\Type\RadioType();
    }
    protected function getForm_Type_RepeatedService()
    {
        return $this->services['form.type.repeated'] = new \Symfony\Component\Form\Extension\Core\Type\RepeatedType();
    }
    protected function getForm_Type_SearchService()
    {
        return $this->services['form.type.search'] = new \Symfony\Component\Form\Extension\Core\Type\SearchType();
    }
    protected function getForm_Type_TextService()
    {
        return $this->services['form.type.text'] = new \Symfony\Component\Form\Extension\Core\Type\TextType();
    }
    protected function getForm_Type_TextareaService()
    {
        return $this->services['form.type.textarea'] = new \Symfony\Component\Form\Extension\Core\Type\TextareaType();
    }
    protected function getForm_Type_TimeService()
    {
        return $this->services['form.type.time'] = new \Symfony\Component\Form\Extension\Core\Type\TimeType();
    }
    protected function getForm_Type_TimezoneService()
    {
        return $this->services['form.type.timezone'] = new \Symfony\Component\Form\Extension\Core\Type\TimezoneType();
    }
    protected function getForm_Type_UrlService()
    {
        return $this->services['form.type.url'] = new \Symfony\Component\Form\Extension\Core\Type\UrlType();
    }
    protected function getForm_TypeExtension_CsrfService()
    {
        return $this->services['form.type_extension.csrf'] = new \Symfony\Component\Form\Extension\Csrf\Type\FormTypeCsrfExtension(true, '_token');
    }
    protected function getForm_TypeExtension_FieldService()
    {
        return $this->services['form.type_extension.field'] = new \Symfony\Component\Form\Extension\Validator\Type\FieldTypeValidatorExtension($this->get('validator'));
    }
    protected function getForm_TypeGuesser_DoctrineService()
    {
        return $this->services['form.type_guesser.doctrine'] = new \Symfony\Bridge\Doctrine\Form\DoctrineOrmTypeGuesser($this->get('doctrine'));
    }
    protected function getForm_TypeGuesser_ValidatorService()
    {
        return $this->services['form.type_guesser.validator'] = new \Symfony\Component\Form\Extension\Validator\ValidatorTypeGuesser($this->get('validator.mapping.class_metadata_factory'));
    }
    protected function getFosUser_ChangePassword_FormService()
    {
        return $this->services['fos_user.change_password.form'] = $this->get('form.factory')->createNamed('fos_user_change_password_form', 'fos_user_change_password', '', array('validation_groups' => array(0 => 'ChangePassword')));
    }
    protected function getFosUser_ChangePassword_Form_Handler_DefaultService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('fos_user.change_password.form.handler.default', 'request');
        }
        return $this->services['fos_user.change_password.form.handler.default'] = $this->scopedServices['request']['fos_user.change_password.form.handler.default'] = new \FOS\UserBundle\Form\Handler\ChangePasswordFormHandler($this->get('fos_user.change_password.form'), $this->get('request'), $this->get('fos_user.user_manager'));
    }
    protected function getFosUser_ChangePassword_Form_TypeService()
    {
        return $this->services['fos_user.change_password.form.type'] = new \FOS\UserBundle\Form\Type\ChangePasswordFormType();
    }
    protected function getFosUser_Group_FormService()
    {
        return $this->services['fos_user.group.form'] = $this->get('form.factory')->createNamed('fos_user_group_form', 'fos_user_group', '', array('validation_groups' => array(0 => 'Registration')));
    }
    protected function getFosUser_Group_Form_HandlerService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('fos_user.group.form.handler', 'request');
        }
        return $this->services['fos_user.group.form.handler'] = $this->scopedServices['request']['fos_user.group.form.handler'] = new \FOS\UserBundle\Form\Handler\GroupFormHandler($this->get('fos_user.group.form'), $this->get('request'), $this->get('fos_user.group_manager'));
    }
    protected function getFosUser_Group_Form_TypeService()
    {
        return $this->services['fos_user.group.form.type'] = new \FOS\UserBundle\Form\Type\GroupFormType('BootStrap\\UserBundle\\Entity\\Group');
    }
    protected function getFosUser_GroupManagerService()
    {
        return $this->services['fos_user.group_manager'] = new \FOS\UserBundle\Entity\GroupManager($this->get('fos_user.entity_manager'), 'BootStrap\\UserBundle\\Entity\\Group');
    }
    protected function getFosUser_MailerService()
    {
        return $this->services['fos_user.mailer'] = new \FOS\UserBundle\Mailer\Mailer($this->get('mailer'), $this->get('i18n_routing.router'), $this->get('templating'), array('confirmation.template' => 'FOSUserBundle:Registration:email.txt.twig', 'resetting.template' => 'FOSUserBundle:Resetting:email.txt.twig', 'from_email' => array('confirmation' => array('etienne.delongeaux@gmail.com' => 'commercial'), 'resetting' => array('etienne.delongeaux@gmail.com' => 'admin'))));
    }
    protected function getFosUser_Profile_FormService()
    {
        return $this->services['fos_user.profile.form'] = $this->get('form.factory')->createNamed('fos_user_profile_form', 'fos_user_profile', '', array('validation_groups' => array(0 => 'Profile')));
    }
    protected function getFosUser_Profile_Form_HandlerService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('fos_user.profile.form.handler', 'request');
        }
        return $this->services['fos_user.profile.form.handler'] = $this->scopedServices['request']['fos_user.profile.form.handler'] = new \FOS\UserBundle\Form\Handler\ProfileFormHandler($this->get('fos_user.profile.form'), $this->get('request'), $this->get('fos_user.user_manager'));
    }
    protected function getFosUser_Profile_Form_TypeService()
    {
        return $this->services['fos_user.profile.form.type'] = new \FOS\UserBundle\Form\Type\ProfileFormType('BootStrap\\UserBundle\\Entity\\User');
    }
    protected function getFosUser_Registration_FormService()
    {
        return $this->services['fos_user.registration.form'] = $this->get('form.factory')->createNamed('fos_user_registration_form', 'fos_user_registration', '', array('validation_groups' => array(0 => 'Registration')));
    }
    protected function getFosUser_Registration_Form_HandlerService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('fos_user.registration.form.handler', 'request');
        }
        return $this->services['fos_user.registration.form.handler'] = $this->scopedServices['request']['fos_user.registration.form.handler'] = new \FOS\UserBundle\Form\Handler\RegistrationFormHandler($this->get('fos_user.registration.form'), $this->get('request'), $this->get('fos_user.user_manager'), $this->get('fos_user.mailer'));
    }
    protected function getFosUser_Registration_Form_TypeService()
    {
        return $this->services['fos_user.registration.form.type'] = new \FOS\UserBundle\Form\Type\RegistrationFormType('BootStrap\\UserBundle\\Entity\\User');
    }
    protected function getFosUser_Resetting_FormService()
    {
        return $this->services['fos_user.resetting.form'] = $this->get('form.factory')->createNamed('fos_user_resetting_form', 'fos_user_resetting', '', array('validation_groups' => array(0 => 'ResetPassword')));
    }
    protected function getFosUser_Resetting_Form_HandlerService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('fos_user.resetting.form.handler', 'request');
        }
        return $this->services['fos_user.resetting.form.handler'] = $this->scopedServices['request']['fos_user.resetting.form.handler'] = new \FOS\UserBundle\Form\Handler\ResettingFormHandler($this->get('fos_user.resetting.form'), $this->get('request'), $this->get('fos_user.user_manager'));
    }
    protected function getFosUser_Resetting_Form_TypeService()
    {
        return $this->services['fos_user.resetting.form.type'] = new \FOS\UserBundle\Form\Type\ResettingFormType();
    }
    protected function getFosUser_Security_InteractiveLoginListenerService()
    {
        return $this->services['fos_user.security.interactive_login_listener'] = new \FOS\UserBundle\Security\InteractiveLoginListener($this->get('fos_user.user_manager'));
    }
    protected function getFosUser_UserCheckerService()
    {
        return $this->services['fos_user.user_checker'] = new \Symfony\Component\Security\Core\User\UserChecker();
    }
    protected function getFosUser_UserManagerService()
    {
        $a = $this->get('fos_user.util.email_canonicalizer');
        return $this->services['fos_user.user_manager'] = new \FOS\UserBundle\Entity\UserManager($this->get('security.encoder_factory'), $a, $a, $this->get('fos_user.entity_manager'), 'BootStrap\\UserBundle\\Entity\\User');
    }
    protected function getFosUser_UsernameFormTypeService()
    {
        return $this->services['fos_user.username_form_type'] = new \FOS\UserBundle\Form\Type\UsernameFormType(new \FOS\UserBundle\Form\DataTransformer\UserToUsernameTransformer($this->get('fos_user.user_manager')));
    }
    protected function getFosUser_Util_EmailCanonicalizerService()
    {
        return $this->services['fos_user.util.email_canonicalizer'] = new \FOS\UserBundle\Util\Canonicalizer();
    }
    protected function getFosUser_Util_UserManipulatorService()
    {
        return $this->services['fos_user.util.user_manipulator'] = new \FOS\UserBundle\Util\UserManipulator($this->get('fos_user.user_manager'));
    }
    protected function getFosUser_Validator_PasswordService()
    {
        $this->services['fos_user.validator.password'] = $instance = new \FOS\UserBundle\Validator\PasswordValidator();
        $instance->setEncoderFactory($this->get('security.encoder_factory'));
        return $instance;
    }
    protected function getFosUser_Validator_UniqueService()
    {
        return $this->services['fos_user.validator.unique'] = new \FOS\UserBundle\Validator\UniqueValidator($this->get('fos_user.user_manager'));
    }
    protected function getGedmo_Listener_LoggableService()
    {
        $this->services['gedmo.listener.loggable'] = $instance = new \Gedmo\Loggable\LoggableListener();
        $instance->setAnnotationReader($this->get('annotation_reader'));
        return $instance;
    }
    protected function getGedmo_Listener_SluggableService()
    {
        $this->services['gedmo.listener.sluggable'] = $instance = new \Gedmo\Sluggable\SluggableListener();
        $instance->setAnnotationReader($this->get('annotation_reader'));
        return $instance;
    }
    protected function getGedmo_Listener_TimestampableService()
    {
        $this->services['gedmo.listener.timestampable'] = $instance = new \Gedmo\Timestampable\TimestampableListener();
        $instance->setAnnotationReader($this->get('annotation_reader'));
        return $instance;
    }
    protected function getGedmo_Listener_TranslatableService()
    {
        $this->services['gedmo.listener.translatable'] = $instance = new \Gedmo\Translatable\TranslatableListener();
        $instance->setAnnotationReader($this->get('annotation_reader'));
        $instance->setDefaultLocale('en_GB');
        $instance->setTranslationFallback(false);
        return $instance;
    }
    protected function getGedmo_Listener_TreeService()
    {
        $this->services['gedmo.listener.tree'] = $instance = new \Gedmo\Tree\TreeListener();
        $instance->setAnnotationReader($this->get('annotation_reader'));
        return $instance;
    }
    protected function getHttpKernelService()
    {
        return $this->services['http_kernel'] = new \Symfony\Bundle\FrameworkBundle\HttpKernel($this->get('event_dispatcher'), $this, new \JMS\DiExtraBundle\HttpKernel\ControllerResolver($this, $this->get('controller_name_converter'), $this->get('monolog.logger.request')));
    }
    protected function getI18nRouting_Doctrine_CacheService()
    {
        return $this->services['i18n_routing.doctrine.cache'] = new \Doctrine\Common\Cache\ArrayCache();
    }
    protected function getI18nRouting_RouterService()
    {
        return $this->services['i18n_routing.router'] = new \BeSimple\I18nRoutingBundle\Routing\Router($this->get('i18n_routing.translator'), $this, '/Users/guillaumemigeon/Sites/orchestra-cmf/app/config/routing.yml', array('cache_dir' => '/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/prod', 'debug' => false, 'generator_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator', 'generator_base_class' => 'BeSimple\\I18nRoutingBundle\\Routing\\Generator\\UrlGenerator', 'generator_dumper_class' => 'Symfony\\Component\\Routing\\Generator\\Dumper\\PhpGeneratorDumper', 'generator_cache_class' => 'appprodUrlGenerator', 'matcher_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher', 'matcher_base_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher', 'matcher_dumper_class' => 'Symfony\\Component\\Routing\\Matcher\\Dumper\\PhpMatcherDumper', 'matcher_cache_class' => 'appprodUrlMatcher'));
    }
    protected function getI18nRouting_TranslatorService()
    {
        return $this->services['i18n_routing.translator'] = new \BeSimple\I18nRoutingBundle\Routing\Translator\DoctrineDBALTranslator($this->get('doctrine.dbal.default_connection'), $this->get('i18n_routing.doctrine.cache'));
    }
    protected function getJmsAop_InterceptorLoaderService()
    {
        return $this->services['jms_aop.interceptor_loader'] = new \JMS\AopBundle\Aop\InterceptorLoader($this, array());
    }
    protected function getJmsAop_PointcutContainerService()
    {
        return $this->services['jms_aop.pointcut_container'] = new \JMS\AopBundle\Aop\PointcutContainer(array());
    }
    protected function getJmsDiExtra_Metadata_ConverterService()
    {
        return $this->services['jms_di_extra.metadata.converter'] = new \JMS\DiExtraBundle\Metadata\MetadataConverter();
    }
    protected function getJmsDiExtra_Metadata_MetadataFactoryService()
    {
        $this->services['jms_di_extra.metadata.metadata_factory'] = $instance = new \Metadata\MetadataFactory(new \JMS\DiExtraBundle\Metadata\Driver\AnnotationDriver($this->get('annotation_reader')), 'Metadata\\ClassHierarchyMetadata', false);
        $instance->setCache(new \Metadata\Cache\FileCache('/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/prod/diextra/metadata'));
        return $instance;
    }
    protected function getKernelService()
    {
        throw new \RuntimeException('You have requested a synthetic service ("kernel"). The DIC does not know how to construct this service.');
    }
    protected function getKnpMenu_FactoryService()
    {
        return $this->services['knp_menu.factory'] = new \Knp\Menu\Silex\RouterAwareFactory($this->get('i18n_routing.router'));
    }
    protected function getKnpMenu_MenuProviderService()
    {
        return $this->services['knp_menu.menu_provider'] = new \Knp\Menu\Provider\ChainProvider(array(0 => new \Knp\Bundle\MenuBundle\Provider\ContainerAwareProvider($this, array()), 1 => new \Knp\Bundle\MenuBundle\Provider\BuilderAliasProvider($this->get('kernel'), $this, $this->get('knp_menu.factory'))));
    }
    protected function getKnpMenu_Renderer_ListService()
    {
        return $this->services['knp_menu.renderer.list'] = new \Knp\Menu\Renderer\ListRenderer('UTF-8');
    }
    protected function getKnpMenu_Renderer_TwigService()
    {
        return $this->services['knp_menu.renderer.twig'] = new \Knp\Menu\Renderer\TwigRenderer($this->get('twig'), 'knp_menu.html.twig');
    }
    protected function getKnpMenu_RendererProviderService()
    {
        return $this->services['knp_menu.renderer_provider'] = new \Knp\Bundle\MenuBundle\Renderer\ContainerAwareProvider($this, 'twig', array('list' => 'knp_menu.renderer.list', 'twig' => 'knp_menu.renderer.twig'));
    }
    protected function getKnpPaginatorService()
    {
        $this->services['knp_paginator'] = $instance = new \Knp\Component\Pager\Paginator($this->get('event_dispatcher'));
        $instance->setDefaultPaginatorOptions(array('pageParameterName' => 'page', 'sortFieldParameterName' => 'sort', 'sortDirectionParameterName' => 'direction', 'distinct' => true));
        return $instance;
    }
    protected function getKnpPaginator_Subscriber_PaginateService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('knp_paginator.subscriber.paginate', 'request');
        }
        return $this->services['knp_paginator.subscriber.paginate'] = $this->scopedServices['request']['knp_paginator.subscriber.paginate'] = new \Knp\Component\Pager\Event\Subscriber\Paginate\PaginationSubscriber();
    }
    protected function getKnpPaginator_Subscriber_SlidingPaginationService()
    {
        return $this->services['knp_paginator.subscriber.sliding_pagination'] = new \Knp\Bundle\PaginatorBundle\Subscriber\SlidingPaginationSubscriber($this->get('templating'), $this->get('templating.helper.router'), $this->get('translator.default'), array('defaultPaginationTemplate' => 'KnpPaginatorBundle:Pagination:sliding.html.twig', 'defaultSortableTemplate' => 'KnpPaginatorBundle:Pagination:sortable_link.html.twig', 'defaultPageRange' => 5));
    }
    protected function getKnpPaginator_Subscriber_SortableService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('knp_paginator.subscriber.sortable', 'request');
        }
        return $this->services['knp_paginator.subscriber.sortable'] = $this->scopedServices['request']['knp_paginator.subscriber.sortable'] = new \Knp\Component\Pager\Event\Subscriber\Sortable\SortableSubscriber();
    }
    protected function getLoggerService()
    {
        $this->services['logger'] = $instance = new \Symfony\Bridge\Monolog\Logger('app');
        $instance->pushHandler($this->get('monolog.handler.main'));
        return $instance;
    }
    protected function getMailerService()
    {
        return $this->services['mailer'] = new \Swift_Mailer($this->get('swiftmailer.transport'));
    }
    protected function getMonolog_Handler_MainService()
    {
        return $this->services['monolog.handler.main'] = new \Monolog\Handler\FingersCrossedHandler($this->get('monolog.handler.nested'), 400, 0, true, true);
    }
    protected function getMonolog_Handler_NestedService()
    {
        return $this->services['monolog.handler.nested'] = new \Monolog\Handler\StreamHandler('/Users/guillaumemigeon/Sites/orchestra-cmf/app/logs/prod.log', 100, true);
    }
    protected function getMonolog_Logger_DoctrineService()
    {
        $this->services['monolog.logger.doctrine'] = $instance = new \Symfony\Bridge\Monolog\Logger('doctrine');
        $instance->pushHandler($this->get('monolog.handler.main'));
        return $instance;
    }
    protected function getMonolog_Logger_RequestService()
    {
        $this->services['monolog.logger.request'] = $instance = new \Symfony\Bridge\Monolog\Logger('request');
        $instance->pushHandler($this->get('monolog.handler.main'));
        return $instance;
    }
    protected function getMonolog_Logger_RouterService()
    {
        $this->services['monolog.logger.router'] = $instance = new \Symfony\Bridge\Monolog\Logger('router');
        $instance->pushHandler($this->get('monolog.handler.main'));
        return $instance;
    }
    protected function getMonolog_Logger_SecurityService()
    {
        $this->services['monolog.logger.security'] = $instance = new \Symfony\Bridge\Monolog\Logger('security');
        $instance->pushHandler($this->get('monolog.handler.main'));
        return $instance;
    }
    protected function getPhpMemcacheService()
    {
        return $this->services['php_memcache'] = new \Memcache();
    }
    protected function getPi_AclManagerService()
    {
        return $this->services['pi.acl_manager'] = new \BootStrap\AclManagerBundle\Domain\AclManager($this->get('security.acl.provider'), $this->get('security.context'));
    }
    protected function getPi_Form_AddinfoExtensionService()
    {
        return $this->services['pi.form.addinfo_extension'] = new \PiApp\AdminBundle\Form\Extension\AddinfoFieldTypeExtension();
    }
    protected function getPi_Form_ErrorTypeExtensionService()
    {
        return $this->services['pi.form.error_type_extension'] = new \PiApp\AdminBundle\Form\Extension\ErrorTypeFormTypeExtension(array('error_type' => 'inline'));
    }
    protected function getPi_Form_FieldErrorTypeService()
    {
        return $this->services['pi.form.field_error_type'] = new \PiApp\AdminBundle\Form\Extension\ErrorTypeFieldTypeExtension();
    }
    protected function getPi_Form_HelpExtensionService()
    {
        return $this->services['pi.form.help_extension'] = new \PiApp\AdminBundle\Form\Extension\HelpFieldTypeExtension();
    }
    protected function getPi_Form_LabelExtensionService()
    {
        return $this->services['pi.form.label_extension'] = new \PiApp\AdminBundle\Form\Extension\LabelFieldTypeExtension();
    }
    protected function getPi_Form_LegendExtensionService()
    {
        return $this->services['pi.form.legend_extension'] = new \PiApp\AdminBundle\Form\Extension\LegendFormTypeExtension(array('show_legend' => true, 'show_child_legend' => false));
    }
    protected function getPiAppAdmin_ArrayManagerService()
    {
        return $this->services['pi_app_admin.array_manager'] = new \PiApp\AdminBundle\Util\PiArrayManager();
    }
    protected function getPiAppAdmin_CachingService()
    {
        return $this->services['pi_app_admin.caching'] = new \PiApp\AdminBundle\Twig\PiTwigCache($this->get('pi_app_admin.twig'), $this);
    }
    protected function getPiAppAdmin_DateManagerService()
    {
        return $this->services['pi_app_admin.date_manager'] = new \PiApp\AdminBundle\Util\PiDateManager();
    }
    protected function getPiAppAdmin_EventSubscriber_MediaService()
    {
        return $this->services['pi_app_admin.event_subscriber.media'] = new \PiApp\GedmoBundle\EventSubscriber\EventSubscriberMedia($this);
    }
    protected function getPiAppAdmin_EventSubscriber_PositionService()
    {
        return $this->services['pi_app_admin.event_subscriber.position'] = new \PiApp\GedmoBundle\EventSubscriber\EventSubscriberPosition($this);
    }
    protected function getPiAppAdmin_FileManagerService()
    {
        return $this->services['pi_app_admin.file_manager'] = new \PiApp\AdminBundle\Util\PiFileManager($this);
    }
    protected function getPiAppAdmin_FormbuilderManager_Model_BlockService()
    {
        return $this->services['pi_app_admin.formbuilder_manager.model.block'] = new \PiApp\GedmoBundle\Manager\FormBuilder\PiModelWidgetBlock($this);
    }
    protected function getPiAppAdmin_FormbuilderManager_Model_ContentService()
    {
        return $this->services['pi_app_admin.formbuilder_manager.model.content'] = new \PiApp\GedmoBundle\Manager\FormBuilder\PiModelWidgetContent($this);
    }
    protected function getPiAppAdmin_FormbuilderManager_Model_SlideService()
    {
        return $this->services['pi_app_admin.formbuilder_manager.model.slide'] = new \PiApp\GedmoBundle\Manager\FormBuilder\PiModelWidgetSlide($this);
    }
    protected function getPiAppAdmin_FormbuilderManager_Model_SnippetService()
    {
        return $this->services['pi_app_admin.formbuilder_manager.model.snippet'] = new \PiApp\GedmoBundle\Manager\FormBuilder\PiModelWidgetSnippet($this);
    }
    protected function getPiAppAdmin_JqueryManager_BackstretchService()
    {
        return $this->services['pi_app_admin.jquery_manager.backstretch'] = new \PiApp\AdminBundle\Util\PiJquery\PiBackstretchManager($this);
    }
    protected function getPiAppAdmin_JqueryManager_ContextmenuService()
    {
        return $this->services['pi_app_admin.jquery_manager.contextmenu'] = new \PiApp\AdminBundle\Util\PiJquery\PiContextMenuManager($this);
    }
    protected function getPiAppAdmin_JqueryManager_FlexsliderService()
    {
        return $this->services['pi_app_admin.jquery_manager.flexslider'] = new \PiApp\AdminBundle\Util\PiJquery\PiFlexSliderManager($this);
    }
    protected function getPiAppAdmin_JqueryManager_FormsimpleService()
    {
        return $this->services['pi_app_admin.jquery_manager.formsimple'] = new \PiApp\AdminBundle\Util\PiJquery\PiFormSimpleManager($this);
    }
    protected function getPiAppAdmin_JqueryManager_GridsimpleService()
    {
        return $this->services['pi_app_admin.jquery_manager.gridsimple'] = new \PiApp\AdminBundle\Util\PiJquery\PiGridSimpleManager($this);
    }
    protected function getPiAppAdmin_JqueryManager_GridtableService()
    {
        return $this->services['pi_app_admin.jquery_manager.gridtable'] = new \PiApp\AdminBundle\Util\PiJquery\PiGridTableManager($this);
    }
    protected function getPiAppAdmin_JqueryManager_LanguagechoiceService()
    {
        return $this->services['pi_app_admin.jquery_manager.languagechoice'] = new \PiApp\AdminBundle\Util\PiJquery\PiLanguageChoiceManager($this);
    }
    protected function getPiAppAdmin_JqueryManager_OrgchartpageService()
    {
        return $this->services['pi_app_admin.jquery_manager.orgchartpage'] = new \PiApp\AdminBundle\Util\PiJquery\PiOrgChartPageManager($this);
    }
    protected function getPiAppAdmin_JqueryManager_OrgsemantiqueService()
    {
        return $this->services['pi_app_admin.jquery_manager.orgsemantique'] = new \PiApp\AdminBundle\Util\PiJquery\PiOrgSemantiquePageManager($this);
    }
    protected function getPiAppAdmin_JqueryManager_OrgtreepageService()
    {
        return $this->services['pi_app_admin.jquery_manager.orgtreepage'] = new \PiApp\AdminBundle\Util\PiJquery\PiOrgTreePageManager($this);
    }
    protected function getPiAppAdmin_JqueryManager_PrototypebytabsService()
    {
        return $this->services['pi_app_admin.jquery_manager.prototypebytabs'] = new \PiApp\AdminBundle\Util\PiJquery\PiPrototypeByTabsManager($this);
    }
    protected function getPiAppAdmin_JqueryManager_SearchluceneService()
    {
        return $this->services['pi_app_admin.jquery_manager.searchlucene'] = new \PiApp\AdminBundle\Util\PiJquery\PiSearchLuceneManager($this);
    }
    protected function getPiAppAdmin_JqueryManager_SessionflashService()
    {
        return $this->services['pi_app_admin.jquery_manager.sessionflash'] = new \PiApp\AdminBundle\Util\PiJquery\PiSessionFlashManager($this);
    }
    protected function getPiAppAdmin_JqueryManager_TinyaccordeonService()
    {
        return $this->services['pi_app_admin.jquery_manager.tinyaccordeon'] = new \PiApp\AdminBundle\Util\PiJquery\PiTinyAccordeonManager($this);
    }
    protected function getPiAppAdmin_JqueryManager_TwitterService()
    {
        return $this->services['pi_app_admin.jquery_manager.twitter'] = new \PiApp\AdminBundle\Util\PiJquery\PiTwitterManager($this);
    }
    protected function getPiAppAdmin_JqueryManager_VeneerService()
    {
        return $this->services['pi_app_admin.jquery_manager.veneer'] = new \PiApp\AdminBundle\Util\PiJquery\PiVeneerManager($this);
    }
    protected function getPiAppAdmin_JqueryManager_WidgetadminService()
    {
        return $this->services['pi_app_admin.jquery_manager.widgetadmin'] = new \PiApp\AdminBundle\Util\PiJquery\PiWidgetAdminManager($this);
    }
    protected function getPiAppAdmin_JqueryManager_WidgetimportService()
    {
        return $this->services['pi_app_admin.jquery_manager.widgetimport'] = new \PiApp\AdminBundle\Util\PiJquery\PiwidgetimportManager($this);
    }
    protected function getPiAppAdmin_JqueryManager_WizardService()
    {
        return $this->services['pi_app_admin.jquery_manager.wizard'] = new \PiApp\AdminBundle\Util\PiJquery\PiWizardManager($this);
    }
    protected function getPiAppAdmin_LocaleManagerService()
    {
        return $this->services['pi_app_admin.locale_manager'] = new \PiApp\AdminBundle\Util\PiLocaleManager($this);
    }
    protected function getPiAppAdmin_LogoutListenerService()
    {
        return $this->services['pi_app_admin.logout_listener'] = new \PiApp\AdminBundle\EventListener\LogoutListener($this->get('i18n_routing.router'), $this);
    }
    protected function getPiAppAdmin_Manager_FormbuilderService()
    {
        return $this->services['pi_app_admin.manager.formbuilder'] = new \PiApp\AdminBundle\Manager\PiFormBuilderManager($this);
    }
    protected function getPiAppAdmin_Manager_JqextService()
    {
        return $this->services['pi_app_admin.manager.jqext'] = new \PiApp\AdminBundle\Manager\PiJqextManager($this);
    }
    protected function getPiAppAdmin_Manager_ListenerService()
    {
        return $this->services['pi_app_admin.manager.listener'] = new \PiApp\AdminBundle\Manager\PiListenerManager($this);
    }
    protected function getPiAppAdmin_Manager_PageService()
    {
        return $this->services['pi_app_admin.manager.page'] = new \PiApp\AdminBundle\Manager\PiPageManager($this);
    }
    protected function getPiAppAdmin_Manager_SearchLuceneService()
    {
        return $this->services['pi_app_admin.manager.search_lucene'] = new \PiApp\AdminBundle\Manager\PiLuceneManager($this);
    }
    protected function getPiAppAdmin_Manager_SliderService()
    {
        return $this->services['pi_app_admin.manager.slider'] = new \PiApp\AdminBundle\Manager\PiSliderManager($this);
    }
    protected function getPiAppAdmin_Manager_TranswidgetService()
    {
        return $this->services['pi_app_admin.manager.transwidget'] = new \PiApp\AdminBundle\Manager\PiTransWidgetManager($this);
    }
    protected function getPiAppAdmin_Manager_TreeService()
    {
        return $this->services['pi_app_admin.manager.tree'] = new \PiApp\AdminBundle\Manager\PiTreeManager($this);
    }
    protected function getPiAppAdmin_Manager_WidgetService()
    {
        return $this->services['pi_app_admin.manager.widget'] = new \PiApp\AdminBundle\Manager\PiWidgetManager($this);
    }
    protected function getPiAppAdmin_PostloadListenerService()
    {
        return $this->services['pi_app_admin.postload_listener'] = new \PiApp\AdminBundle\EventListener\PostLoadListener($this);
    }
    protected function getPiAppAdmin_PostpersistListenerService()
    {
        return $this->services['pi_app_admin.postpersist_listener'] = new \PiApp\AdminBundle\EventListener\PostPersistListener($this);
    }
    protected function getPiAppAdmin_PostremoveListenerService()
    {
        return $this->services['pi_app_admin.postremove_listener'] = new \PiApp\AdminBundle\EventListener\PostRemoveListener($this);
    }
    protected function getPiAppAdmin_PostupdateListenerService()
    {
        return $this->services['pi_app_admin.postupdate_listener'] = new \PiApp\AdminBundle\EventListener\PostUpdateListener($this);
    }
    protected function getPiAppAdmin_PrepersistListenerService()
    {
        return $this->services['pi_app_admin.prepersist_listener'] = new \PiApp\AdminBundle\EventListener\PrePersistListener($this);
    }
    protected function getPiAppAdmin_PreremoveListenerService()
    {
        return $this->services['pi_app_admin.preremove_listener'] = new \PiApp\AdminBundle\EventListener\PreRemoveListener($this);
    }
    protected function getPiAppAdmin_PreupdateListenerService()
    {
        return $this->services['pi_app_admin.preupdate_listener'] = new \PiApp\AdminBundle\EventListener\PreUpdateListener($this);
    }
    protected function getPiAppAdmin_RegexManagerService()
    {
        return $this->services['pi_app_admin.regex_manager'] = new \PiApp\AdminBundle\Util\PiRegexManager($this);
    }
    protected function getPiAppAdmin_RepositoryService()
    {
        return $this->services['pi_app_admin.repository'] = new \PiApp\AdminBundle\Repository\Repository($this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getPiAppAdmin_SchemaListenerService()
    {
        return $this->services['pi_app_admin.schema_listener'] = new \PiApp\AdminBundle\EventListener\SchemaListener($this);
    }
    protected function getPiAppAdmin_StringCutManagerService()
    {
        return $this->services['pi_app_admin.string_cut_manager'] = new \PiApp\AdminBundle\Util\PiStringCutManager();
    }
    protected function getPiAppAdmin_StringManagerService()
    {
        return $this->services['pi_app_admin.string_manager'] = new \PiApp\AdminBundle\Util\PiStringManager();
    }
    protected function getPiAppAdmin_TemplatingService()
    {
        return $this->services['pi_app_admin.templating'] = new \Symfony\Bundle\TwigBundle\TwigEngine($this->get('pi_app_admin.twig'), $this->get('templating.name_parser'), $this->get('templating.globals'));
    }
    protected function getPiAppAdmin_TwigService()
    {
        $this->services['pi_app_admin.twig'] = $instance = new \Twig_Environment($this->get('pi_app_admin.twig.loader'), array('exception_controller' => 'Symfony\\Bundle\\TwigBundle\\Controller\\ExceptionController::showAction', 'charset' => 'utf-8', 'debug' => false, 'strict_variables' => false, 'auto_reload' => NULL, 'cache' => '/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/prod/twig'));
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
        return $instance;
    }
    protected function getPiAppAdmin_Twig_Extension_DateService()
    {
        return $this->services['pi_app_admin.twig.extension.date'] = new \PiApp\AdminBundle\Twig\Extension\PiDateExtension($this);
    }
    protected function getPiAppAdmin_Twig_Extension_ForwardService()
    {
        return $this->services['pi_app_admin.twig.extension.forward'] = new \PiApp\AdminBundle\Twig\Extension\PiForwardExtension($this);
    }
    protected function getPiAppAdmin_Twig_Extension_JqueryService()
    {
        return $this->services['pi_app_admin.twig.extension.jquery'] = new \PiApp\AdminBundle\Twig\Extension\PiJqueryExtension($this);
    }
    protected function getPiAppAdmin_Twig_Extension_LayoutheadService()
    {
        return $this->services['pi_app_admin.twig.extension.layouthead'] = new \PiApp\AdminBundle\Twig\Extension\PiLayoutHeadExtension($this);
    }
    protected function getPiAppAdmin_Twig_Extension_RouteService()
    {
        return $this->services['pi_app_admin.twig.extension.route'] = new \PiApp\AdminBundle\Twig\Extension\PiRouteExtension($this);
    }
    protected function getPiAppAdmin_Twig_Extension_ServiceService()
    {
        return $this->services['pi_app_admin.twig.extension.service'] = new \PiApp\AdminBundle\Twig\Extension\PiServiceExtension($this);
    }
    protected function getPiAppAdmin_Twig_Extension_ToolService()
    {
        return $this->services['pi_app_admin.twig.extension.tool'] = new \PiApp\AdminBundle\Twig\Extension\PiToolExtension($this);
    }
    protected function getPiAppAdmin_Twig_Extension_WidgetService()
    {
        return $this->services['pi_app_admin.twig.extension.widget'] = new \PiApp\AdminBundle\Twig\Extension\PiWidgetExtension($this);
    }
    protected function getPiAppAdmin_Twig_LoaderService()
    {
        return $this->services['pi_app_admin.twig.loader'] = new \PiApp\AdminBundle\Twig\PiTwigLoader($this->get('pi_app_admin.manager.page'), $this->get('pi_app_admin.manager.widget'), $this->get('pi_app_admin.manager.transwidget'), $this->get('pi_app_admin.manager.tree'), $this->get('pi_app_admin.manager.listener'), $this->get('pi_app_admin.manager.slider'), $this->get('pi_app_admin.manager.jqext'), $this->get('pi_app_admin.manager.search_lucene'), $this->get('twig.loader'));
    }
    protected function getPiAppAdmin_User_LoginListenerService()
    {
        return $this->services['pi_app_admin.user.login_listener'] = new \PiApp\AdminBundle\EventListener\LoginListener($this->get('i18n_routing.router'), $this->get('security.context'), $this->get('event_dispatcher'), $this->get('doctrine'), $this);
    }
    protected function getPiAppAdmin_Validator_CollectionofService()
    {
        return $this->services['pi_app_admin.validator.collectionof'] = new \PiApp\AdminBundle\Validator\Constraints\CollectionOfValidator();
    }
    protected function getPiAppAdmin_Validator_UniqueService()
    {
        return $this->services['pi_app_admin.validator.unique'] = new \PiApp\AdminBundle\Validator\Constraints\UniqueValidator($this);
    }
    protected function getPiAppAdmin_WidgetManager_Content_JqextService()
    {
        return $this->services['pi_app_admin.widget_manager.content.jqext'] = new \PiApp\AdminBundle\Util\PiWidget\PiContentManager($this, 'jqext');
    }
    protected function getPiAppAdmin_WidgetManager_Content_MediaService()
    {
        return $this->services['pi_app_admin.widget_manager.content.media'] = new \PiApp\AdminBundle\Util\PiWidget\PiContentManager($this, 'media');
    }
    protected function getPiAppAdmin_WidgetManager_Content_SnippetService()
    {
        return $this->services['pi_app_admin.widget_manager.content.snippet'] = new \PiApp\AdminBundle\Util\PiWidget\PiContentManager($this, 'snippet');
    }
    protected function getPiAppAdmin_WidgetManager_Content_TextService()
    {
        return $this->services['pi_app_admin.widget_manager.content.text'] = new \PiApp\AdminBundle\Util\PiWidget\PiContentManager($this, 'text');
    }
    protected function getPiAppAdmin_WidgetManager_Gedmo_ListenerService()
    {
        return $this->services['pi_app_admin.widget_manager.gedmo.listener'] = new \PiApp\AdminBundle\Util\PiWidget\PiGedmoManager($this, 'listener');
    }
    protected function getPiAppAdmin_WidgetManager_Gedmo_NavigationService()
    {
        return $this->services['pi_app_admin.widget_manager.gedmo.navigation'] = new \PiApp\AdminBundle\Util\PiWidget\PiGedmoManager($this, 'navigation');
    }
    protected function getPiAppAdmin_WidgetManager_Gedmo_OrganigramService()
    {
        return $this->services['pi_app_admin.widget_manager.gedmo.organigram'] = new \PiApp\AdminBundle\Util\PiWidget\PiGedmoManager($this, 'organigram');
    }
    protected function getPiAppAdmin_WidgetManager_Gedmo_SliderService()
    {
        return $this->services['pi_app_admin.widget_manager.gedmo.slider'] = new \PiApp\AdminBundle\Util\PiWidget\PiGedmoManager($this, 'slider');
    }
    protected function getPiAppAdmin_WidgetManager_Gedmo_SnippetService()
    {
        return $this->services['pi_app_admin.widget_manager.gedmo.snippet'] = new \PiApp\AdminBundle\Util\PiWidget\PiGedmoManager($this, 'snippet');
    }
    protected function getPiAppAdmin_WidgetManager_Search_LuceneService()
    {
        return $this->services['pi_app_admin.widget_manager.search.lucene'] = new \PiApp\AdminBundle\Util\PiWidget\PiSearchManager($this, 'lucene');
    }
    protected function getPiAppGedmo_RepositoryService()
    {
        return $this->services['pi_app_gedmo.repository'] = new \PiApp\GedmoBundle\Repository\Repository($this->get('doctrine.orm.default_entity_manager'));
    }
    protected function getPiFacebook_Client_AnalyticsService()
    {
        return $this->services['pi_facebook.client.analytics'] = new \BootStrap\FacebookBundle\Manager\Client\AnalyticsClient($this, 'analytics');
    }
    protected function getPiFacebook_Helper_AnalyticsService()
    {
        return $this->services['pi_facebook.helper.analytics'] = new \BootStrap\FacebookBundle\Helper\AnalyticsHelper($this->get('pi_facebook.client.analytics'));
    }
    protected function getPiFacebook_Twig_Extension_AnalyticsService()
    {
        return $this->services['pi_facebook.twig.extension.analytics'] = new \BootStrap\FacebookBundle\Extension\AnalyticsExtension($this->get('pi_facebook.helper.analytics'));
    }
    protected function getPiFilecacheService()
    {
        $this->services['pi_filecache'] = $instance = new \BootStrap\CacheBundle\Manager\CacheFactory();
        $instance->setContainer($this);
        $instance->setClient($this->get('pi_filecache.client'));
        return $instance;
    }
    protected function getPiFilecache_ClientService()
    {
        return $this->services['pi_filecache.client'] = new \BootStrap\CacheBundle\Manager\Client\FilecacheClient();
    }
    protected function getPiGoogle_Client_AdwordsService()
    {
        return $this->services['pi_google.client.adwords'] = new \BootStrap\GoogleBundle\Manager\Client\AdwordsClient($this, 'adwords');
    }
    protected function getPiGoogle_Client_AnalyticsService()
    {
        return $this->services['pi_google.client.analytics'] = new \BootStrap\GoogleBundle\Manager\Client\AnalyticsClient($this, 'analytics');
    }
    protected function getPiGoogle_Client_MapsService()
    {
        return $this->services['pi_google.client.maps'] = new \BootStrap\GoogleBundle\Manager\Client\MapsClient($this, 'maps');
    }
    protected function getPiGoogle_Factory_AdwordsService()
    {
        $this->services['pi_google.factory.adwords'] = $instance = new \BootStrap\GoogleBundle\Manager\GoogleFactory($this);
        $instance->setClient($this->get('pi_google.client.adwords'));
        return $instance;
    }
    protected function getPiGoogle_Factory_AnalyticsService()
    {
        $this->services['pi_google.factory.analytics'] = $instance = new \BootStrap\GoogleBundle\Manager\GoogleFactory($this);
        $instance->setClient($this->get('pi_google.client.analytics'));
        return $instance;
    }
    protected function getPiGoogle_Factory_MapsService()
    {
        $this->services['pi_google.factory.maps'] = $instance = new \BootStrap\GoogleBundle\Manager\GoogleFactory($this);
        $instance->setClient($this->get('pi_google.client.maps'));
        return $instance;
    }
    protected function getPiGoogle_Helper_AnalyticsService()
    {
        return $this->services['pi_google.helper.analytics'] = new \BootStrap\GoogleBundle\Helper\AnalyticsHelper($this->get('pi_google.client.analytics'));
    }
    protected function getPiGoogle_Twig_Extension_AnalyticsService()
    {
        return $this->services['pi_google.twig.extension.analytics'] = new \BootStrap\GoogleBundle\Extension\AnalyticsExtension($this->get('pi_google.helper.analytics'));
    }
    protected function getPiMemcacheService()
    {
        $this->services['pi_memcache'] = $instance = new \BootStrap\CacheBundle\Manager\CacheFactory();
        $instance->setContainer($this);
        $instance->setClient($this->get('pi_memcache.client'));
        return $instance;
    }
    protected function getPiMemcache_ClientService()
    {
        $this->services['pi_memcache.client'] = $instance = new \BootStrap\CacheBundle\Manager\Client\MemcacheClient($this->get('php_memcache'));
        $instance->addServers(array('127.0.0.1' => 11211));
        return $instance;
    }
    protected function getRequestService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('request', 'request');
        }
        throw new \RuntimeException('You have requested a synthetic service ("request"). The DIC does not know how to construct this service.');
    }
    protected function getResponseListenerService()
    {
        return $this->services['response_listener'] = new \Symfony\Component\HttpKernel\EventListener\ResponseListener('UTF-8');
    }
    protected function getRouterListenerService()
    {
        return $this->services['router_listener'] = new \Symfony\Bundle\FrameworkBundle\EventListener\RouterListener($this->get('i18n_routing.router'), 80, 443, $this->get('monolog.logger.request'));
    }
    protected function getRouting_LoaderService()
    {
        $a = $this->get('file_locator');
        $b = $this->get('annotation_reader');
        $c = new \Sensio\Bundle\FrameworkExtraBundle\Routing\AnnotatedRouteControllerLoader($b);
        $d = new \Symfony\Component\Config\Loader\LoaderResolver();
        $d->addLoader(new \BeSimple\I18nRoutingBundle\Routing\Loader\XmlFileLoader($a));
        $d->addLoader(new \BeSimple\I18nRoutingBundle\Routing\Loader\YamlFileLoader($a));
        $d->addLoader(new \Symfony\Component\Routing\Loader\PhpFileLoader($a));
        $d->addLoader(new \Symfony\Component\Routing\Loader\AnnotationDirectoryLoader($a, $c));
        $d->addLoader(new \Symfony\Component\Routing\Loader\AnnotationFileLoader($a, $c));
        $d->addLoader($c);
        $d->addLoader($this->get('sonata.admin.route_loader'));
        $d->addLoader($this->get('bootstrap.route_loader'));
        return $this->services['routing.loader'] = new \Symfony\Bundle\FrameworkBundle\Routing\DelegatingLoader($this->get('controller_name_converter'), $this->get('monolog.logger.router'), $d);
    }
    protected function getSecurity_Access_MethodInterceptorService()
    {
        return $this->services['security.access.method_interceptor'] = new \JMS\SecurityExtraBundle\Security\Authorization\Interception\MethodSecurityInterceptor($this->get('security.context'), $this->get('security.authentication.manager'), $this->get('security.access.decision_manager'), new \JMS\SecurityExtraBundle\Security\Authorization\AfterInvocation\AfterInvocationManager(array(0 => new \JMS\SecurityExtraBundle\Security\Authorization\AfterInvocation\AclAfterInvocationProvider($this->get('security.acl.provider'), $this->get('security.acl.object_identity_retrieval_strategy'), $this->get('security.acl.security_identity_retrieval_strategy'), $this->get('security.acl.permission.map')))), new \JMS\SecurityExtraBundle\Security\Authorization\RunAsManager('RunAsToken', 'ROLE_'), $this->get('logger'));
    }
    protected function getSecurity_Acl_ProviderService()
    {
        return $this->services['security.acl.provider'] = new \Symfony\Component\Security\Acl\Dbal\MutableAclProvider($this->get('doctrine.dbal.default_connection'), new \Symfony\Component\Security\Acl\Domain\PermissionGrantingStrategy(), array('class_table_name' => 'acl_classes', 'entry_table_name' => 'acl_entries', 'oid_table_name' => 'acl_object_identities', 'oid_ancestors_table_name' => 'acl_object_identity_ancestors', 'sid_table_name' => 'acl_security_identities'), NULL);
    }
    protected function getSecurity_ContextService()
    {
        return $this->services['security.context'] = new \Symfony\Component\Security\Core\SecurityContext($this->get('security.authentication.manager'), $this->get('security.access.decision_manager'), false);
    }
    protected function getSecurity_EncoderFactoryService()
    {
        return $this->services['security.encoder_factory'] = new \Symfony\Component\Security\Core\Encoder\EncoderFactory(array('BootStrap\\UserBundle\\Entity\\User' => array('class' => 'Symfony\\Component\\Security\\Core\\Encoder\\MessageDigestPasswordEncoder', 'arguments' => array(0 => 'sha512', 1 => true, 2 => 5000))));
    }
    protected function getSecurity_Extra_ControllerListenerService()
    {
        return $this->services['security.extra.controller_listener'] = new \JMS\SecurityExtraBundle\Controller\ControllerListener($this, $this->get('annotation_reader'));
    }
    protected function getSecurity_FirewallService()
    {
        return $this->services['security.firewall'] = new \Symfony\Component\Security\Http\Firewall(new \Symfony\Bundle\SecurityBundle\Security\FirewallMap($this, array('security.firewall.map.context.main' => new \Symfony\Component\HttpFoundation\RequestMatcher('.*'), 'security.firewall.map.context.dev' => new \Symfony\Component\HttpFoundation\RequestMatcher('^/(_(profiler|wdt)|css|images|js)/'), 'security.firewall.map.context.login' => new \Symfony\Component\HttpFoundation\RequestMatcher('^/demo/secured/login$'), 'security.firewall.map.context.secured_area' => new \Symfony\Component\HttpFoundation\RequestMatcher('^/demo/secured/'))), $this->get('event_dispatcher'));
    }
    protected function getSecurity_Firewall_Map_Context_DevService()
    {
        return $this->services['security.firewall.map.context.dev'] = new \Symfony\Bundle\SecurityBundle\Security\FirewallContext(array(), NULL);
    }
    protected function getSecurity_Firewall_Map_Context_LoginService()
    {
        return $this->services['security.firewall.map.context.login'] = new \Symfony\Bundle\SecurityBundle\Security\FirewallContext(array(), NULL);
    }
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
        return $this->services['security.firewall.map.context.main'] = new \Symfony\Bundle\SecurityBundle\Security\FirewallContext(array(0 => $this->get('security.channel_listener'), 1 => new \Symfony\Component\Security\Http\Firewall\ContextListener($a, array(0 => $this->get('security.user.provider.concrete.in_memory'), 1 => $b), 'main', $c, $d), 2 => $h, 3 => $i, 4 => new \Symfony\Component\Security\Http\Firewall\RememberMeListener($a, $g, $f, $c, $d), 5 => new \Symfony\Component\Security\Http\Firewall\AnonymousAuthenticationListener($a, '508d050527c79', $c), 6 => $this->get('security.access_listener')), new \Symfony\Component\Security\Http\Firewall\ExceptionListener($a, $this->get('security.authentication.trust_resolver'), $e, new \Symfony\Component\Security\Http\EntryPoint\FormAuthenticationEntryPoint($this->get('http_kernel'), $e, '/login', false), '/unauthorized', NULL, $c));
    }
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
    protected function getSecurity_Rememberme_ResponseListenerService()
    {
        return $this->services['security.rememberme.response_listener'] = new \Symfony\Bundle\SecurityBundle\EventListener\ResponseListener();
    }
    protected function getSensioFrameworkExtra_Cache_ListenerService()
    {
        return $this->services['sensio_framework_extra.cache.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\CacheListener();
    }
    protected function getSensioFrameworkExtra_Controller_ListenerService()
    {
        return $this->services['sensio_framework_extra.controller.listener'] = new \JMS\DiExtraBundle\EventListener\ControllerListener($this->get('annotation_reader'));
    }
    protected function getSensioFrameworkExtra_Converter_Doctrine_OrmService()
    {
        return $this->services['sensio_framework_extra.converter.doctrine.orm'] = new \Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\DoctrineParamConverter($this->get('doctrine'));
    }
    protected function getSensioFrameworkExtra_Converter_ListenerService()
    {
        return $this->services['sensio_framework_extra.converter.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\ParamConverterListener($this->get('sensio_framework_extra.converter.manager'));
    }
    protected function getSensioFrameworkExtra_Converter_ManagerService()
    {
        $this->services['sensio_framework_extra.converter.manager'] = $instance = new \Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterManager();
        $instance->add($this->get('sensio_framework_extra.converter.doctrine.orm'), 0);
        return $instance;
    }
    protected function getSensioFrameworkExtra_View_ListenerService()
    {
        return $this->services['sensio_framework_extra.view.listener'] = new \JMS\DiExtraBundle\EventListener\TemplateListener($this);
    }
    protected function getServiceContainerService()
    {
        throw new \RuntimeException('You have requested a synthetic service ("service_container"). The DIC does not know how to construct this service.');
    }
    protected function getSessionService()
    {
        return $this->services['session'] = new \Symfony\Component\HttpFoundation\Session($this->get('session.storage'), 'en_GB');
    }
    protected function getSession_StorageService()
    {
        return $this->services['session.storage'] = new \Symfony\Component\HttpFoundation\SessionStorage\NativeSessionStorage(array());
    }
    protected function getSessionListenerService()
    {
        return $this->services['session_listener'] = new \Symfony\Bundle\FrameworkBundle\EventListener\SessionListener($this, true);
    }
    protected function getSonata_Admin_Audit_ManagerService()
    {
        return $this->services['sonata.admin.audit.manager'] = new \Sonata\AdminBundle\Model\AuditManager($this);
    }
    protected function getSonata_Admin_Audit_Orm_ReaderService()
    {
        return $this->services['sonata.admin.audit.orm.reader'] = new \Sonata\DoctrineORMAdminBundle\Model\AuditReader(NULL);
    }
    protected function getSonata_Admin_Block_AdminListService()
    {
        return $this->services['sonata.admin.block.admin_list'] = new \Sonata\AdminBundle\Block\AdminListBlockService('sonata.admin.block.admin_list', $this->get('templating'), $this->get('sonata.admin.pool'));
    }
    protected function getSonata_Admin_Builder_Filter_FactoryService()
    {
        return $this->services['sonata.admin.builder.filter.factory'] = new \Sonata\AdminBundle\Filter\FilterFactory($this, array('doctrine_orm_boolean' => 'sonata.admin.orm.filter.type.boolean', 'doctrine_orm_callback' => 'sonata.admin.orm.filter.type.callback', 'doctrine_orm_choice' => 'sonata.admin.orm.filter.type.choice', 'doctrine_orm_model' => 'sonata.admin.orm.filter.type.model', 'doctrine_orm_string' => 'sonata.admin.orm.filter.type.string', 'doctrine_orm_number' => 'sonata.admin.orm.filter.type.number'));
    }
    protected function getSonata_Admin_Builder_OrmDatagridService()
    {
        return $this->services['sonata.admin.builder.orm_datagrid'] = new \Sonata\DoctrineORMAdminBundle\Builder\DatagridBuilder($this->get('form.factory'), $this->get('sonata.admin.builder.filter.factory'), $this->get('sonata.admin.guesser.orm_datagrid_chain'));
    }
    protected function getSonata_Admin_Builder_OrmFormService()
    {
        return $this->services['sonata.admin.builder.orm_form'] = new \Sonata\DoctrineORMAdminBundle\Builder\FormContractor($this->get('form.factory'));
    }
    protected function getSonata_Admin_Builder_OrmListService()
    {
        return $this->services['sonata.admin.builder.orm_list'] = new \Sonata\DoctrineORMAdminBundle\Builder\ListBuilder($this->get('sonata.admin.guesser.orm_list_chain'), array('array' => 'SonataAdminBundle:CRUD:list_array.html.twig', 'boolean' => 'SonataAdminBundle:CRUD:list_boolean.html.twig', 'date' => 'SonataAdminBundle:CRUD:list_date.html.twig', 'time' => 'SonataAdminBundle:CRUD:list_time.html.twig', 'datetime' => 'SonataAdminBundle:CRUD:list_datetime.html.twig', 'text' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'trans' => 'SonataAdminBundle:CRUD:list_trans.html.twig', 'string' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'smallint' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'bigint' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'integer' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'decimal' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'identifier' => 'SonataAdminBundle:CRUD:base_list_field.html.twig', 'currency' => 'SonataAdminBundle:CRUD:list_currency.html.twig', 'percent' => 'SonataAdminBundle:CRUD:list_percent.html.twig'));
    }
    protected function getSonata_Admin_Builder_OrmShowService()
    {
        return $this->services['sonata.admin.builder.orm_show'] = new \Sonata\DoctrineORMAdminBundle\Builder\ShowBuilder($this->get('sonata.admin.guesser.orm_show_chain'), array('array' => 'SonataAdminBundle:CRUD:show_array.html.twig', 'boolean' => 'SonataAdminBundle:CRUD:show_boolean.html.twig', 'date' => 'SonataAdminBundle:CRUD:show_date.html.twig', 'time' => 'SonataAdminBundle:CRUD:show_time.html.twig', 'datetime' => 'SonataAdminBundle:CRUD:show_datetime.html.twig', 'text' => 'SonataAdminBundle:CRUD:base_show_field.html.twig', 'trans' => 'SonataAdminBundle:CRUD:show_trans.html.twig', 'string' => 'SonataAdminBundle:CRUD:base_show_field.html.twig', 'smallint' => 'SonataAdminBundle:CRUD:base_show_field.html.twig', 'bigint' => 'SonataAdminBundle:CRUD:base_show_field.html.twig', 'integer' => 'SonataAdminBundle:CRUD:base_show_field.html.twig', 'decimal' => 'SonataAdminBundle:CRUD:base_show_field.html.twig', 'currency' => 'SonataAdminBundle:CRUD:base_currency.html.twig', 'percent' => 'SonataAdminBundle:CRUD:base_percent.html.twig'));
    }
    protected function getSonata_Admin_Controller_AdminService()
    {
        return $this->services['sonata.admin.controller.admin'] = new \Sonata\AdminBundle\Controller\HelperController($this->get('twig'), $this->get('sonata.admin.pool'), $this->get('sonata.admin.helper'));
    }
    protected function getSonata_Admin_ExporterService()
    {
        return $this->services['sonata.admin.exporter'] = new \Sonata\AdminBundle\Export\Exporter();
    }
    protected function getSonata_Admin_Form_Extension_FieldService()
    {
        return $this->services['sonata.admin.form.extension.field'] = new \Sonata\AdminBundle\Form\Extension\Field\Type\FormTypeFieldExtension(array('email' => 'sonata-medium', 'textarea' => 'sonata-medium', 'text' => 'sonata-medium', 'choice' => 'sonata-medium', 'integer' => 'sonata-medium', 'datetime' => 'sonata-medium-date', 'date' => 'sonata-medium-date'));
    }
    protected function getSonata_Admin_Form_Filter_Type_ChoiceService()
    {
        return $this->services['sonata.admin.form.filter.type.choice'] = new \Sonata\AdminBundle\Form\Type\Filter\ChoiceType($this->get('translator.default'));
    }
    protected function getSonata_Admin_Form_Filter_Type_DateService()
    {
        return $this->services['sonata.admin.form.filter.type.date'] = new \Sonata\AdminBundle\Form\Type\Filter\DateType($this->get('translator.default'));
    }
    protected function getSonata_Admin_Form_Filter_Type_DaterangeService()
    {
        return $this->services['sonata.admin.form.filter.type.daterange'] = new \Sonata\AdminBundle\Form\Type\Filter\DateRangeType($this->get('translator.default'));
    }
    protected function getSonata_Admin_Form_Filter_Type_DatetimeService()
    {
        return $this->services['sonata.admin.form.filter.type.datetime'] = new \Sonata\AdminBundle\Form\Type\Filter\DateTimeType($this->get('translator.default'));
    }
    protected function getSonata_Admin_Form_Filter_Type_DatetimeRangeService()
    {
        return $this->services['sonata.admin.form.filter.type.datetime_range'] = new \Sonata\AdminBundle\Form\Type\Filter\DateTimeRangeType($this->get('translator.default'));
    }
    protected function getSonata_Admin_Form_Filter_Type_DefaultService()
    {
        return $this->services['sonata.admin.form.filter.type.default'] = new \Sonata\AdminBundle\Form\Type\Filter\DefaultType();
    }
    protected function getSonata_Admin_Form_Filter_Type_NumberService()
    {
        return $this->services['sonata.admin.form.filter.type.number'] = new \Sonata\AdminBundle\Form\Type\Filter\NumberType($this->get('translator.default'));
    }
    protected function getSonata_Admin_Form_Type_AdminService()
    {
        return $this->services['sonata.admin.form.type.admin'] = new \Sonata\AdminBundle\Form\Type\AdminType();
    }
    protected function getSonata_Admin_Form_Type_ArrayService()
    {
        return $this->services['sonata.admin.form.type.array'] = new \Sonata\AdminBundle\Form\Type\ImmutableArrayType();
    }
    protected function getSonata_Admin_Form_Type_BooleanService()
    {
        return $this->services['sonata.admin.form.type.boolean'] = new \Sonata\AdminBundle\Form\Type\BooleanType($this->get('translator.default'));
    }
    protected function getSonata_Admin_Form_Type_CollectionService()
    {
        return $this->services['sonata.admin.form.type.collection'] = new \Sonata\AdminBundle\Form\Type\CollectionType();
    }
    protected function getSonata_Admin_Form_Type_DateRangeService()
    {
        return $this->services['sonata.admin.form.type.date_range'] = new \Sonata\AdminBundle\Form\Type\DateRangeType($this->get('translator.default'));
    }
    protected function getSonata_Admin_Form_Type_DatetimeRangeService()
    {
        return $this->services['sonata.admin.form.type.datetime_range'] = new \Sonata\AdminBundle\Form\Type\DateTimeRangeType($this->get('translator.default'));
    }
    protected function getSonata_Admin_Form_Type_ModelService()
    {
        return $this->services['sonata.admin.form.type.model'] = new \Sonata\AdminBundle\Form\Type\ModelType();
    }
    protected function getSonata_Admin_Form_Type_ModelReferenceService()
    {
        return $this->services['sonata.admin.form.type.model_reference'] = new \Sonata\AdminBundle\Form\Type\ModelReferenceType();
    }
    protected function getSonata_Admin_Form_Type_TranslatableChoiceService()
    {
        return $this->services['sonata.admin.form.type.translatable_choice'] = new \Sonata\AdminBundle\Form\Type\TranslatableChoiceType($this->get('translator.default'));
    }
    protected function getSonata_Admin_Guesser_OrmDatagridService()
    {
        return $this->services['sonata.admin.guesser.orm_datagrid'] = new \Sonata\DoctrineORMAdminBundle\Guesser\FilterTypeGuesser($this->get('doctrine'));
    }
    protected function getSonata_Admin_Guesser_OrmDatagridChainService()
    {
        return $this->services['sonata.admin.guesser.orm_datagrid_chain'] = new \Sonata\AdminBundle\Guesser\TypeGuesserChain(array(0 => $this->get('sonata.admin.guesser.orm_datagrid')));
    }
    protected function getSonata_Admin_Guesser_OrmListService()
    {
        return $this->services['sonata.admin.guesser.orm_list'] = new \Sonata\DoctrineORMAdminBundle\Guesser\TypeGuesser($this->get('doctrine'));
    }
    protected function getSonata_Admin_Guesser_OrmListChainService()
    {
        return $this->services['sonata.admin.guesser.orm_list_chain'] = new \Sonata\AdminBundle\Guesser\TypeGuesserChain(array(0 => $this->get('sonata.admin.guesser.orm_list')));
    }
    protected function getSonata_Admin_Guesser_OrmShowService()
    {
        return $this->services['sonata.admin.guesser.orm_show'] = new \Sonata\DoctrineORMAdminBundle\Guesser\TypeGuesser($this->get('doctrine'));
    }
    protected function getSonata_Admin_Guesser_OrmShowChainService()
    {
        return $this->services['sonata.admin.guesser.orm_show_chain'] = new \Sonata\AdminBundle\Guesser\TypeGuesserChain(array(0 => $this->get('sonata.admin.guesser.orm_show')));
    }
    protected function getSonata_Admin_HelperService()
    {
        return $this->services['sonata.admin.helper'] = new \Sonata\AdminBundle\Admin\AdminHelper($this->get('sonata.admin.pool'));
    }
    protected function getSonata_Admin_Label_Strategy_BcService()
    {
        return $this->services['sonata.admin.label.strategy.bc'] = new \Sonata\AdminBundle\Translator\BCLabelTranslatorStrategy();
    }
    protected function getSonata_Admin_Label_Strategy_FormComponentService()
    {
        return $this->services['sonata.admin.label.strategy.form_component'] = new \Sonata\AdminBundle\Translator\FormLabelTranslatorStrategy();
    }
    protected function getSonata_Admin_Label_Strategy_NativeService()
    {
        return $this->services['sonata.admin.label.strategy.native'] = new \Sonata\AdminBundle\Translator\NativeLabelTranslatorStrategy();
    }
    protected function getSonata_Admin_Label_Strategy_NoopService()
    {
        return $this->services['sonata.admin.label.strategy.noop'] = new \Sonata\AdminBundle\Translator\NoopLabelTranslatorStrategy();
    }
    protected function getSonata_Admin_Label_Strategy_UnderscoreService()
    {
        return $this->services['sonata.admin.label.strategy.underscore'] = new \Sonata\AdminBundle\Translator\UnderscoreLabelTranslatorStrategy();
    }
    protected function getSonata_Admin_Manager_OrmService()
    {
        return $this->services['sonata.admin.manager.orm'] = new \Sonata\DoctrineORMAdminBundle\Model\ModelManager($this->get('doctrine'));
    }
    protected function getSonata_Admin_Manipulator_Acl_AdminService()
    {
        return $this->services['sonata.admin.manipulator.acl.admin'] = new \Sonata\AdminBundle\Util\AdminAclManipulator('Sonata\\AdminBundle\\Security\\Acl\\Permission\\MaskBuilder');
    }
    protected function getSonata_Admin_Manipulator_Acl_Object_OrmService()
    {
        return $this->services['sonata.admin.manipulator.acl.object.orm'] = new \Sonata\DoctrineORMAdminBundle\Util\ObjectAclManipulator();
    }
    protected function getSonata_Admin_Orm_Filter_Type_BooleanService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\BooleanFilter();
    }
    protected function getSonata_Admin_Orm_Filter_Type_CallbackService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\CallbackFilter();
    }
    protected function getSonata_Admin_Orm_Filter_Type_ChoiceService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\ChoiceFilter();
    }
    protected function getSonata_Admin_Orm_Filter_Type_ModelService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\ModelFilter();
    }
    protected function getSonata_Admin_Orm_Filter_Type_NumberService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\NumberFilter();
    }
    protected function getSonata_Admin_Orm_Filter_Type_StringService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\StringFilter();
    }
    protected function getSonata_Admin_PoolService()
    {
        $this->services['sonata.admin.pool'] = $instance = new \Sonata\AdminBundle\Admin\Pool($this, 'Sonata Project', '/bundles/piappadmin/images/logo/logo-orchestra-white.png');
        $instance->setTemplates(array('layout' => 'SonataAdminBundle::standard_layout.html.twig', 'ajax' => 'SonataAdminBundle::ajax_layout.html.twig', 'list' => 'SonataAdminBundle:CRUD:list.html.twig', 'show' => 'SonataAdminBundle:CRUD:show.html.twig', 'edit' => 'SonataAdminBundle:CRUD:edit.html.twig', 'user_block' => 'SonataAdminBundle:Core:user_block.html.twig', 'dashboard' => 'SonataAdminBundle:Core:dashboard.html.twig', 'history' => 'SonataAdminBundle:CRUD:history.html.twig', 'history_revision' => 'SonataAdminBundle:CRUD:history_revision.html.twig', 'action' => 'SonataAdminBundle:CRUD:action.html.twig'));
        $instance->setAdminServiceIds(array(0 => 'sonata.media.admin.media', 1 => 'sonata.media.admin.gallery', 2 => 'sonata.media.admin.gallery_has_media', 3 => 'bootstrap.admin.admin.group', 4 => 'bootstrap.admin.admin.user', 5 => 'bootstrap.admin.admin.role', 6 => 'bootstrap.admin.admin.permission', 7 => 'bootstrap.admin.admin.historicalpage'));
        $instance->setAdminGroups(array('sonata_media' => array('label' => 'sonata_media', 'items' => array(0 => 'sonata.media.admin.media', 1 => 'sonata.media.admin.gallery')), 'gestion_utilisateur' => array('label' => 'gestion_utilisateur', 'items' => array(0 => 'bootstrap.admin.admin.group', 1 => 'bootstrap.admin.admin.user', 2 => 'bootstrap.admin.admin.role', 3 => 'bootstrap.admin.admin.permission')), 'gestion_cms' => array('label' => 'gestion_cms', 'items' => array(0 => 'bootstrap.admin.admin.historicalpage'))));
        $instance->setAdminClasses(array('BootStrap\\MediaBundle\\Entity\\Media' => 'sonata.media.admin.media', 'BootStrap\\MediaBundle\\Entity\\Gallery' => 'sonata.media.admin.gallery', 'BootStrap\\MediaBundle\\Entity\\GalleryHasMedia' => 'sonata.media.admin.gallery_has_media', 'BootStrap\\UserBundle\\Entity\\Group' => 'bootstrap.admin.admin.group', 'BootStrap\\UserBundle\\Entity\\User' => 'bootstrap.admin.admin.user', 'BootStrap\\UserBundle\\Entity\\Role' => 'bootstrap.admin.admin.role', 'BootStrap\\UserBundle\\Entity\\Permission' => 'bootstrap.admin.admin.permission', 'PiApp\\AdminBundle\\Entity\\HistoricalStatus' => 'bootstrap.admin.admin.historicalpage'));
        return $instance;
    }
    protected function getSonata_Admin_Route_DefaultGeneratorService()
    {
        return $this->services['sonata.admin.route.default_generator'] = new \Sonata\AdminBundle\Route\DefaultRouteGenerator($this->get('i18n_routing.router'));
    }
    protected function getSonata_Admin_Route_PathInfoService()
    {
        return $this->services['sonata.admin.route.path_info'] = new \Sonata\AdminBundle\Route\PathInfoBuilder($this->get('sonata.admin.audit.manager'));
    }
    protected function getSonata_Admin_Route_QueryStringService()
    {
        return $this->services['sonata.admin.route.query_string'] = new \Sonata\AdminBundle\Route\QueryStringBuilder($this->get('sonata.admin.audit.manager'));
    }
    protected function getSonata_Admin_RouteLoaderService()
    {
        return $this->services['sonata.admin.route_loader'] = new \Sonata\AdminBundle\Route\AdminPoolLoader($this->get('sonata.admin.pool'), array(0 => 'sonata.media.admin.media', 1 => 'sonata.media.admin.gallery', 2 => 'sonata.media.admin.gallery_has_media', 3 => 'bootstrap.admin.admin.group', 4 => 'bootstrap.admin.admin.user', 5 => 'bootstrap.admin.admin.role', 6 => 'bootstrap.admin.admin.permission', 7 => 'bootstrap.admin.admin.historicalpage'), $this);
    }
    protected function getSonata_Admin_Security_HandlerService()
    {
        return $this->services['sonata.admin.security.handler'] = new \Sonata\AdminBundle\Security\Handler\RoleSecurityHandler($this->get('security.context'), array(0 => 'ROLE_SUPER_ADMIN'));
    }
    protected function getSonata_Admin_Twig_ExtensionService()
    {
        return $this->services['sonata.admin.twig.extension'] = new \Sonata\AdminBundle\Twig\Extension\SonataAdminExtension();
    }
    protected function getSonata_Admin_Validator_InlineService()
    {
        return $this->services['sonata.admin.validator.inline'] = new \Sonata\AdminBundle\Validator\InlineValidator($this, $this->get('validator.validator_factory'));
    }
    protected function getSonata_AdminDoctrineOrm_Block_AuditService()
    {
        return $this->services['sonata.admin_doctrine_orm.block.audit'] = new \Sonata\DoctrineORMAdminBundle\Block\AuditBlockService('sonata.admin_doctrine_orm.block.audit', $this->get('templating'), NULL);
    }
    protected function getSonata_Block_Form_Type_BlockService()
    {
        return $this->services['sonata.block.form.type.block'] = new \Sonata\BlockBundle\Form\Type\ServiceListType($this->get('sonata.block.manager'), array('admin' => array(0 => 'sonata.admin.block.admin_list'), 'cms' => array(0 => 'sonata.block.service.text', 1 => 'sonata.block.service.action', 2 => 'sonata.block.service.rss')));
    }
    protected function getSonata_Block_Loader_ChainService()
    {
        return $this->services['sonata.block.loader.chain'] = new \Sonata\BlockBundle\Block\BlockLoaderChain(array(0 => $this->get('sonata.block.loader.service')));
    }
    protected function getSonata_Block_Loader_ServiceService()
    {
        return $this->services['sonata.block.loader.service'] = new \Sonata\BlockBundle\Block\Loader\ServiceLoader(array('sonata.admin.block.admin_list' => array(), 'sonata.block.service.text' => array(), 'sonata.block.service.action' => array(), 'sonata.block.service.rss' => array()));
    }
    protected function getSonata_Block_RendererService()
    {
        return $this->services['sonata.block.renderer'] = new \Sonata\BlockBundle\Block\BlockRenderer($this->get('sonata.block.manager'), $this->get('logger'), false);
    }
    protected function getSonata_Block_Service_ActionService()
    {
        return $this->services['sonata.block.service.action'] = new \Sonata\BlockBundle\Block\Service\ActionBlockService('sonata.block.action', $this->get('templating'), $this->get('http_kernel'));
    }
    protected function getSonata_Block_Service_RssService()
    {
        return $this->services['sonata.block.service.rss'] = new \Sonata\BlockBundle\Block\Service\RssBlockService('sonata.block.rss', $this->get('templating'));
    }
    protected function getSonata_Block_Service_TextService()
    {
        return $this->services['sonata.block.service.text'] = new \Sonata\BlockBundle\Block\Service\TextBlockService('sonata.block.text', $this->get('templating'));
    }
    protected function getSonata_Cache_Invalidation_SimpleService()
    {
        return $this->services['sonata.cache.invalidation.simple'] = new \Sonata\CacheBundle\Invalidation\SimpleCacheInvalidation($this->get('logger'));
    }
    protected function getSonata_Cache_ManagerService()
    {
        $this->services['sonata.cache.manager'] = $instance = new \Sonata\CacheBundle\Cache\CacheManager($this->get('sonata.cache.invalidation.simple'), array('sonata.cache.noop' => $this->get('sonata.cache.noop')));
        $instance->setRecorder($this->get('sonata.cache.recorder'));
        return $instance;
    }
    protected function getSonata_Cache_ModelIdentifierService()
    {
        return $this->services['sonata.cache.model_identifier'] = new \Sonata\CacheBundle\Invalidation\ModelCollectionIdentifiers(array());
    }
    protected function getSonata_Cache_NoopService()
    {
        return $this->services['sonata.cache.noop'] = new \Sonata\CacheBundle\Adapter\NoopCache();
    }
    protected function getSonata_Cache_Orm_EventSubscriberService()
    {
        return $this->services['sonata.cache.orm.event_subscriber'] = new \Sonata\CacheBundle\Invalidation\DoctrineORMListenerContainerAware($this, 'sonata.cache.orm.event_subscriber.default');
    }
    protected function getSonata_Cache_Orm_EventSubscriber_DefaultService()
    {
        return $this->services['sonata.cache.orm.event_subscriber.default'] = new \Sonata\CacheBundle\Invalidation\DoctrineORMListener($this->get('sonata.cache.model_identifier'), array('sonata.cache.noop' => $this->get('sonata.cache.noop')));
    }
    protected function getSonata_Cache_RecorderService()
    {
        return $this->services['sonata.cache.recorder'] = new \Sonata\CacheBundle\Invalidation\Recorder($this->get('sonata.cache.model_identifier'));
    }
    protected function getSonata_EasyExtends_Doctrine_MapperService()
    {
        $this->services['sonata.easy_extends.doctrine.mapper'] = $instance = new \Sonata\EasyExtendsBundle\Mapper\DoctrineORMMapper($this->get('doctrine'), array());
        $instance->addAssociation('BootStrap\\MediaBundle\\Entity\\Media', 'mapOneToMany', array(0 => array('fieldName' => 'galleryHasMedias', 'targetEntity' => 'BootStrap\\MediaBundle\\Entity\\GalleryHasMedia', 'cascade' => array(0 => 'persist'), 'mappedBy' => 'media', 'orphanRemoval' => false)));
        $instance->addAssociation('BootStrap\\MediaBundle\\Entity\\GalleryHasMedia', 'mapManyToOne', array(0 => array('fieldName' => 'gallery', 'targetEntity' => 'BootStrap\\MediaBundle\\Entity\\Gallery', 'cascade' => array(0 => 'persist'), 'mappedBy' => NULL, 'inversedBy' => 'galleryHasMedias', 'joinColumns' => array(0 => array('name' => 'gallery_id', 'referencedColumnName' => 'id')), 'orphanRemoval' => false), 1 => array('fieldName' => 'media', 'targetEntity' => 'BootStrap\\MediaBundle\\Entity\\Media', 'cascade' => array(0 => 'persist'), 'mappedBy' => NULL, 'inversedBy' => 'galleryHasMedias', 'joinColumns' => array(0 => array('name' => 'media_id', 'referencedColumnName' => 'id')), 'orphanRemoval' => false)));
        $instance->addAssociation('BootStrap\\MediaBundle\\Entity\\Gallery', 'mapOneToMany', array(0 => array('fieldName' => 'galleryHasMedias', 'targetEntity' => 'BootStrap\\MediaBundle\\Entity\\GalleryHasMedia', 'cascade' => array(0 => 'persist'), 'mappedBy' => 'gallery', 'orphanRemoval' => true, 'orderBy' => array('position' => 'ASC'))));
        return $instance;
    }
    protected function getSonata_EasyExtends_Generator_BundleService()
    {
        return $this->services['sonata.easy_extends.generator.bundle'] = new \Sonata\EasyExtendsBundle\Generator\BundleGenerator();
    }
    protected function getSonata_EasyExtends_Generator_OdmService()
    {
        return $this->services['sonata.easy_extends.generator.odm'] = new \Sonata\EasyExtendsBundle\Generator\OdmGenerator();
    }
    protected function getSonata_EasyExtends_Generator_OrmService()
    {
        return $this->services['sonata.easy_extends.generator.orm'] = new \Sonata\EasyExtendsBundle\Generator\OrmGenerator();
    }
    protected function getSonata_Media_Adapter_Filesystem_LocalService()
    {
        return $this->services['sonata.media.adapter.filesystem.local'] = new \Gaufrette\Adapter\Local('/Users/guillaumemigeon/Sites/orchestra-cmf/app/../web/uploads/media', false);
    }
    protected function getSonata_Media_Adapter_Image_GdService()
    {
        return $this->services['sonata.media.adapter.image.gd'] = new \Imagine\Gd\Imagine();
    }
    protected function getSonata_Media_Adapter_Image_GmagickService()
    {
        return $this->services['sonata.media.adapter.image.gmagick'] = new \Imagine\Gmagick\Imagine();
    }
    protected function getSonata_Media_Adapter_Image_ImagickService()
    {
        return $this->services['sonata.media.adapter.image.imagick'] = new \Imagine\Imagick\Imagine();
    }
    protected function getSonata_Media_Adapter_Service_S3Service()
    {
        return $this->services['sonata.media.adapter.service.s3'] = new \AmazonS3(array());
    }
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
    protected function getSonata_Media_Admin_Media_ManagerService()
    {
        return $this->services['sonata.media.admin.media.manager'] = new \Sonata\MediaBundle\Admin\Manager\DoctrineORMManager($this->get('doctrine'), $this->get('sonata.media.manager.media'));
    }
    protected function getSonata_Media_Block_FeatureMediaService()
    {
        return $this->services['sonata.media.block.feature_media'] = new \Sonata\MediaBundle\Block\FeatureMediaBlockService('sonata.media.block.feature_media', $this->get('templating'), $this, $this->get('sonata.media.manager.media'));
    }
    protected function getSonata_Media_Block_GalleryService()
    {
        return $this->services['sonata.media.block.gallery'] = new \Sonata\MediaBundle\Block\GalleryBlockService('sonata.media.block.gallery', $this->get('templating'), $this, $this->get('sonata.media.manager.gallery'));
    }
    protected function getSonata_Media_Block_MediaService()
    {
        return $this->services['sonata.media.block.media'] = new \Sonata\MediaBundle\Block\MediaBlockService('sonata.media.block.media', $this->get('templating'), $this, $this->get('sonata.media.manager.media'));
    }
    protected function getSonata_Media_Buzz_BrowserService()
    {
        return $this->services['sonata.media.buzz.browser'] = new \Buzz\Browser($this->get('sonata.media.buzz.connector.file_get_contents'));
    }
    protected function getSonata_Media_Buzz_Connector_CurlService()
    {
        return $this->services['sonata.media.buzz.connector.curl'] = new \Buzz\Client\Curl();
    }
    protected function getSonata_Media_Buzz_Connector_FileGetContentsService()
    {
        return $this->services['sonata.media.buzz.connector.file_get_contents'] = new \Buzz\Client\FileGetContents();
    }
    protected function getSonata_Media_Cdn_ServerService()
    {
        return $this->services['sonata.media.cdn.server'] = new \Sonata\MediaBundle\CDN\Server('/uploads/media');
    }
    protected function getSonata_Media_Doctrine_EventSubscriberService()
    {
        return $this->services['sonata.media.doctrine.event_subscriber'] = new \Sonata\MediaBundle\Listener\ORM\MediaEventSubscriber($this);
    }
    protected function getSonata_Media_Filesystem_LocalService()
    {
        return $this->services['sonata.media.filesystem.local'] = new \Gaufrette\Filesystem($this->get('sonata.media.adapter.filesystem.local'));
    }
    protected function getSonata_Media_Form_Type_MediaService()
    {
        return $this->services['sonata.media.form.type.media'] = new \Sonata\MediaBundle\Form\Type\MediaType($this->get('sonata.media.pool'), 'BootStrap\\MediaBundle\\Entity\\Media');
    }
    protected function getSonata_Media_Generator_DefaultService()
    {
        return $this->services['sonata.media.generator.default'] = new \Sonata\MediaBundle\Generator\DefaultGenerator();
    }
    protected function getSonata_Media_Manager_GalleryService()
    {
        return $this->services['sonata.media.manager.gallery'] = new \Sonata\MediaBundle\Entity\GalleryManager($this->get('doctrine.orm.default_entity_manager'), 'BootStrap\\MediaBundle\\Entity\\Gallery');
    }
    protected function getSonata_Media_Manager_MediaService()
    {
        return $this->services['sonata.media.manager.media'] = new \Sonata\MediaBundle\Entity\MediaManager($this->get('sonata.media.pool'), $this->get('doctrine.orm.default_entity_manager'), 'BootStrap\\MediaBundle\\Entity\\Media');
    }
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
    protected function getSonata_Media_Provider_FileService()
    {
        $this->services['sonata.media.provider.file'] = $instance = new \Sonata\MediaBundle\Provider\FileProvider('sonata.media.provider.file', $this->get('sonata.media.filesystem.local'), $this->get('sonata.media.cdn.server'), $this->get('sonata.media.generator.default'), $this->get('sonata.media.thumbnail.format'), array(0 => 'pdf', 1 => 'txt', 2 => 'rtf', 3 => 'doc', 4 => 'docx', 5 => 'xls', 6 => 'xlsx', 7 => 'ppt', 8 => 'pttx', 9 => 'odt', 10 => 'odg', 11 => 'odp', 12 => 'ods', 13 => 'odc', 14 => 'odf', 15 => 'odb', 16 => 'csv', 17 => 'xml'), array(0 => 'application/pdf', 1 => 'application/x-pdf', 2 => 'application/rtf', 3 => 'text/html', 4 => 'text/rtf', 5 => 'text/plain', 6 => 'application/excel', 7 => 'application/msword', 8 => 'application/vnd.ms-excel', 9 => 'application/vnd.ms-powerpoint', 10 => 'application/vnd.ms-powerpoint', 11 => 'application/vnd.oasis.opendocument.text', 12 => 'application/vnd.oasis.opendocument.graphics', 13 => 'application/vnd.oasis.opendocument.presentation', 14 => 'application/vnd.oasis.opendocument.spreadsheet', 15 => 'application/vnd.oasis.opendocument.chart', 16 => 'application/vnd.oasis.opendocument.formula', 17 => 'application/vnd.oasis.opendocument.database', 18 => 'application/vnd.oasis.opendocument.image', 19 => 'text/comma-separated-values', 20 => 'text/xml', 21 => 'application/zip'));
        $instance->setTemplates(array('helper_thumbnail' => 'SonataMediaBundle:Provider:thumbnail.html.twig', 'helper_view' => 'SonataMediaBundle:Provider:view_file.html.twig'));
        $instance->addFormat('default_small', array('width' => 100, 'quality' => 70, 'height' => false, 'format' => 'jpg', 'constraint' => true));
        $instance->addFormat('default_big', array('width' => 500, 'quality' => 70, 'height' => false, 'format' => 'jpg', 'constraint' => true));
        $instance->addFormat('admin', array('quality' => 80, 'width' => 100, 'format' => 'jpg', 'height' => false, 'constraint' => true));
        return $instance;
    }
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
    protected function getSonata_Media_Provider_VimeoService()
    {
        $this->services['sonata.media.provider.vimeo'] = $instance = new \Sonata\MediaBundle\Provider\VimeoProvider('sonata.media.provider.vimeo', $this->get('sonata.media.filesystem.local'), $this->get('sonata.media.cdn.server'), $this->get('sonata.media.generator.default'), $this->get('sonata.media.thumbnail.format'), $this->get('sonata.media.buzz.browser'));
        $instance->setTemplates(array('helper_thumbnail' => 'SonataMediaBundle:Provider:thumbnail.html.twig', 'helper_view' => 'SonataMediaBundle:Provider:view_vimeo.html.twig'));
        $instance->setResizer($this->get('sonata.media.resizer.simple'));
        $instance->addFormat('admin', array('quality' => 80, 'width' => 100, 'format' => 'jpg', 'height' => false, 'constraint' => true));
        return $instance;
    }
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
    protected function getSonata_Media_Resizer_SimpleService()
    {
        return $this->services['sonata.media.resizer.simple'] = new \Sonata\MediaBundle\Resizer\SimpleResizer($this->get('sonata.media.adapter.image.gd'), 'inset');
    }
    protected function getSonata_Media_Resizer_SquareService()
    {
        return $this->services['sonata.media.resizer.square'] = new \Sonata\MediaBundle\Resizer\SquareResizer($this->get('sonata.media.adapter.image.gd'), 'inset');
    }
    protected function getSonata_Media_Security_ConnectedStrategyService()
    {
        return $this->services['sonata.media.security.connected_strategy'] = new \Sonata\MediaBundle\Security\RolesDownloadStrategy($this->get('translator.default'), $this->get('security.context'), array(0 => 'IS_AUTHENTICATED_FULLY', 1 => 'IS_AUTHENTICATED_REMEMBERED'));
    }
    protected function getSonata_Media_Security_ForbiddenStrategyService()
    {
        return $this->services['sonata.media.security.forbidden_strategy'] = new \Sonata\MediaBundle\Security\ForbiddenDownloadStrategy($this->get('translator.default'));
    }
    protected function getSonata_Media_Security_PublicStrategyService()
    {
        return $this->services['sonata.media.security.public_strategy'] = new \Sonata\MediaBundle\Security\PublicDownloadStrategy($this->get('translator.default'));
    }
    protected function getSonata_Media_Security_SuperadminStrategyService()
    {
        return $this->services['sonata.media.security.superadmin_strategy'] = new \Sonata\MediaBundle\Security\RolesDownloadStrategy($this->get('translator.default'), $this->get('security.context'), array(0 => 'ROLE_SUPER_ADMIN', 1 => 'ROLE_ADMIN'));
    }
    protected function getSonata_Media_Security_UserStrategyService()
    {
        return $this->services['sonata.media.security.user_strategy'] = new \Sonata\MediaBundle\Security\RolesDownloadStrategy($this->get('translator.default'), $this->get('security.context'), array(0 => 'ROLE_USER'));
    }
    protected function getSonata_Media_Thumbnail_FormatService()
    {
        return $this->services['sonata.media.thumbnail.format'] = new \Sonata\MediaBundle\Thumbnail\FormatThumbnail();
    }
    protected function getSonata_Media_Twig_ExtensionService()
    {
        return $this->services['sonata.media.twig.extension'] = new \Sonata\MediaBundle\Twig\Extension\MediaExtension($this->get('sonata.media.pool'), $this->get('sonata.media.manager.media'));
    }
    protected function getSonata_User_Form_Type_SecurityPermissionsService()
    {
        return $this->services['sonata.user.form.type.security_permissions'] = new \BootStrap\AdminBundle\Form\Type\SecurityPermissionsType($this->get('sonata.admin.pool'));
    }
    protected function getSonata_User_Form_Type_SecurityRolesService()
    {
        return $this->services['sonata.user.form.type.security_roles'] = new \BootStrap\AdminBundle\Form\Type\SecurityRolesType($this->get('sonata.admin.pool'));
    }
    protected function getStofDoctrineExtensions_EventListener_LocaleService()
    {
        return $this->services['stof_doctrine_extensions.event_listener.locale'] = new \Stof\DoctrineExtensionsBundle\EventListener\LocaleListener($this->get('stof_doctrine_extensions.listener.translatable'));
    }
    protected function getStofDoctrineExtensions_EventListener_LoggerService()
    {
        return $this->services['stof_doctrine_extensions.event_listener.logger'] = new \Stof\DoctrineExtensionsBundle\EventListener\LoggerListener($this->get('stof_doctrine_extensions.listener.loggable'), $this->get('security.context'));
    }
    protected function getSwiftmailer_Plugin_MessageloggerService()
    {
        return $this->services['swiftmailer.plugin.messagelogger'] = new \Symfony\Bundle\SwiftmailerBundle\Logger\MessageLogger();
    }
    protected function getSwiftmailer_TransportService()
    {
        $this->services['swiftmailer.transport'] = $instance = new \Swift_Transport_EsmtpTransport(new \Swift_Transport_StreamBuffer(new \Swift_StreamFilters_StringReplacementFilterFactory()), array(0 => new \Swift_Transport_Esmtp_AuthHandler(array(0 => new \Swift_Transport_Esmtp_Auth_CramMd5Authenticator(), 1 => new \Swift_Transport_Esmtp_Auth_LoginAuthenticator(), 2 => new \Swift_Transport_Esmtp_Auth_PlainAuthenticator()))), new \Swift_Events_SimpleEventDispatcher());
        $instance->setHost('localhost');
        $instance->setPort(25);
        $instance->setEncryption(NULL);
        $instance->setUsername('');
        $instance->setPassword('');
        $instance->setAuthMode(NULL);
        return $instance;
    }
    protected function getTemplatingService()
    {
        return $this->services['templating'] = new \Symfony\Bundle\TwigBundle\TwigEngine($this->get('twig'), $this->get('templating.name_parser'), $this->get('templating.globals'));
    }
    protected function getTemplating_Asset_PackageFactoryService()
    {
        return $this->services['templating.asset.package_factory'] = new \Symfony\Bundle\FrameworkBundle\Templating\Asset\PackageFactory($this);
    }
    protected function getTemplating_GlobalsService()
    {
        return $this->services['templating.globals'] = new \Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables($this);
    }
    protected function getTemplating_Helper_ActionsService()
    {
        return $this->services['templating.helper.actions'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\ActionsHelper($this->get('http_kernel'));
    }
    protected function getTemplating_Helper_AssetsService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('templating.helper.assets', 'request');
        }
        return $this->services['templating.helper.assets'] = $this->scopedServices['request']['templating.helper.assets'] = new \Symfony\Component\Templating\Helper\CoreAssetsHelper(new \Symfony\Bundle\FrameworkBundle\Templating\Asset\PathPackage($this->get('request'), NULL, NULL), array());
    }
    protected function getTemplating_Helper_CodeService()
    {
        return $this->services['templating.helper.code'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\CodeHelper(NULL, '/Users/guillaumemigeon/Sites/orchestra-cmf/app', 'UTF-8');
    }
    protected function getTemplating_Helper_FormService()
    {
        $a = new \Symfony\Bundle\FrameworkBundle\Templating\PhpEngine($this->get('templating.name_parser'), $this, $this->get('templating.loader'), $this->get('templating.globals'));
        $a->setCharset('UTF-8');
        $a->setHelpers(array('slots' => 'templating.helper.slots', 'assets' => 'templating.helper.assets', 'request' => 'templating.helper.request', 'session' => 'templating.helper.session', 'router' => 'templating.helper.router', 'actions' => 'templating.helper.actions', 'code' => 'templating.helper.code', 'translator' => 'templating.helper.translator', 'form' => 'templating.helper.form', 'security' => 'templating.helper.security', 'assetic' => 'assetic.helper.static', 'pi_google_analytics' => 'pi_google.helper.analytics', 'pi_facebook_analytics' => 'pi_facebook.helper.analytics'));
        return $this->services['templating.helper.form'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\FormHelper($a, array(0 => 'FrameworkBundle:Form'));
    }
    protected function getTemplating_Helper_RequestService()
    {
        return $this->services['templating.helper.request'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\RequestHelper($this->get('request'));
    }
    protected function getTemplating_Helper_RouterService()
    {
        return $this->services['templating.helper.router'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\RouterHelper($this->get('i18n_routing.router'));
    }
    protected function getTemplating_Helper_SecurityService()
    {
        return $this->services['templating.helper.security'] = new \Symfony\Bundle\SecurityBundle\Templating\Helper\SecurityHelper($this->get('security.context'));
    }
    protected function getTemplating_Helper_SessionService()
    {
        return $this->services['templating.helper.session'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\SessionHelper($this->get('request'));
    }
    protected function getTemplating_Helper_SlotsService()
    {
        return $this->services['templating.helper.slots'] = new \Symfony\Component\Templating\Helper\SlotsHelper();
    }
    protected function getTemplating_Helper_TranslatorService()
    {
        return $this->services['templating.helper.translator'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\TranslatorHelper($this->get('translator.default'));
    }
    protected function getTemplating_LoaderService()
    {
        return $this->services['templating.loader'] = new \Symfony\Bundle\FrameworkBundle\Templating\Loader\FilesystemLoader($this->get('templating.locator'));
    }
    protected function getTemplating_NameParserService()
    {
        return $this->services['templating.name_parser'] = new \Symfony\Bundle\FrameworkBundle\Templating\TemplateNameParser($this->get('kernel'));
    }
    protected function getTranslation_Loader_PhpService()
    {
        return $this->services['translation.loader.php'] = new \Symfony\Component\Translation\Loader\PhpFileLoader();
    }
    protected function getTranslation_Loader_XliffService()
    {
        return $this->services['translation.loader.xliff'] = new \Symfony\Component\Translation\Loader\XliffFileLoader();
    }
    protected function getTranslation_Loader_YmlService()
    {
        return $this->services['translation.loader.yml'] = new \Symfony\Component\Translation\Loader\YamlFileLoader();
    }
    protected function getTranslator_DefaultService()
    {
        $this->services['translator.default'] = $instance = new \Symfony\Bundle\FrameworkBundle\Translation\Translator($this, new \Symfony\Component\Translation\MessageSelector(), array('translation.loader.php' => 'php', 'translation.loader.yml' => 'yml', 'translation.loader.xliff' => 'xliff'), array('cache_dir' => '/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/prod/translations', 'debug' => false), $this->get('session'));
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
    protected function getTwigService()
    {
        $this->services['twig'] = $instance = new \Twig_Environment($this->get('twig.loader'), array('exception_controller' => 'Symfony\\Bundle\\TwigBundle\\Controller\\ExceptionController::showAction', 'charset' => 'utf-8', 'debug' => false, 'strict_variables' => false, 'auto_reload' => NULL, 'cache' => '/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/prod/twig'));
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
        return $instance;
    }
    protected function getTwig_ExceptionListenerService()
    {
        return $this->services['twig.exception_listener'] = new \Symfony\Component\HttpKernel\EventListener\ExceptionListener('Symfony\\Bundle\\TwigBundle\\Controller\\ExceptionController::showAction', $this->get('monolog.logger.request'));
    }
    protected function getTwig_Extension_IntlService()
    {
        return $this->services['twig.extension.intl'] = new \Twig_Extensions_Extension_Intl();
    }
    protected function getTwig_Extension_TextService()
    {
        return $this->services['twig.extension.text'] = new \Twig_Extensions_Extension_Text();
    }
    protected function getTwig_LoaderService()
    {
        $this->services['twig.loader'] = $instance = new \Symfony\Bundle\TwigBundle\Loader\FilesystemLoader($this->get('templating.locator'), $this->get('templating.name_parser'));
        $instance->addPath('/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Bridge/Twig/Resources/views/Form');
        $instance->addPath('/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/Knp-menu/src/Knp/Menu/Resources/views');
        return $instance;
    }
    protected function getValidatorService()
    {
        return $this->services['validator'] = new \Symfony\Component\Validator\Validator($this->get('validator.mapping.class_metadata_factory'), $this->get('validator.validator_factory'), array(0 => $this->get('doctrine.orm.validator_initializer')));
    }
    protected function getDatabaseConnectionService()
    {
        return $this->get('doctrine.dbal.default_connection');
    }
    protected function getDoctrine_Orm_EntityManagerService()
    {
        return $this->get('doctrine.orm.default_entity_manager');
    }
    protected function getFosUser_ChangePassword_Form_HandlerService()
    {
        return $this->get('fos_user.change_password.form.handler.default');
    }
    protected function getFosUser_Util_UsernameCanonicalizerService()
    {
        return $this->get('fos_user.util.email_canonicalizer');
    }
    protected function getRouterService()
    {
        return $this->get('i18n_routing.router');
    }
    protected function getSecurity_Acl_Dbal_ConnectionService()
    {
        return $this->get('doctrine.dbal.default_connection');
    }
    protected function getSonata_Media_EntityManagerService()
    {
        return $this->get('doctrine.orm.default_entity_manager');
    }
    protected function getTranslatorService()
    {
        return $this->get('translator.default');
    }
    protected function getAssetic_AssetFactoryService()
    {
        return $this->services['assetic.asset_factory'] = new \Symfony\Bundle\AsseticBundle\Factory\AssetFactory($this->get('kernel'), $this, new \Symfony\Component\DependencyInjection\ParameterBag\ParameterBag($this->getDefaultParameters()), '/Users/guillaumemigeon/Sites/orchestra-cmf/app/../web', false);
    }
    protected function getAssetic_TwigExtensionService()
    {
        return $this->services['assetic.twig_extension'] = new \Symfony\Bundle\AsseticBundle\Twig\AsseticExtension($this->get('assetic.asset_factory'), false, array());
    }
    protected function getControllerNameConverterService()
    {
        return $this->services['controller_name_converter'] = new \Symfony\Bundle\FrameworkBundle\Controller\ControllerNameParser($this->get('kernel'));
    }
    protected function getFosUser_EntityManagerService()
    {
        return $this->services['fos_user.entity_manager'] = $this->get('doctrine')->getEntityManager(NULL);
    }
    protected function getKnpMenu_Twig_ExtensionService()
    {
        return $this->services['knp_menu.twig.extension'] = new \Knp\Menu\Twig\MenuExtension(new \Knp\Menu\Twig\Helper($this->get('knp_menu.renderer_provider'), $this->get('knp_menu.menu_provider')));
    }
    protected function getSecurity_Access_DecisionManagerService()
    {
        return $this->services['security.access.decision_manager'] = new \Symfony\Component\Security\Core\Authorization\AccessDecisionManager(array(0 => new \Symfony\Component\Security\Core\Authorization\Voter\RoleHierarchyVoter($this->get('security.role_hierarchy')), 1 => new \Symfony\Component\Security\Core\Authorization\Voter\AuthenticatedVoter($this->get('security.authentication.trust_resolver')), 2 => new \Symfony\Component\Security\Acl\Voter\AclVoter($this->get('security.acl.provider'), $this->get('security.acl.object_identity_retrieval_strategy'), $this->get('security.acl.security_identity_retrieval_strategy'), $this->get('security.acl.permission.map'), $this->get('monolog.logger.security'), true)), 'unanimous', false, true);
    }
    protected function getSecurity_AccessListenerService()
    {
        return $this->services['security.access_listener'] = new \Symfony\Component\Security\Http\Firewall\AccessListener($this->get('security.context'), $this->get('security.access.decision_manager'), $this->get('security.access_map'), $this->get('security.authentication.manager'), $this->get('monolog.logger.security'));
    }
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
    protected function getSecurity_Acl_ObjectIdentityRetrievalStrategyService()
    {
        return $this->services['security.acl.object_identity_retrieval_strategy'] = new \Symfony\Component\Security\Acl\Domain\ObjectIdentityRetrievalStrategy();
    }
    protected function getSecurity_Acl_Permission_MapService()
    {
        return $this->services['security.acl.permission.map'] = new \Sonata\AdminBundle\Security\Acl\Permission\AdminPermissionMap();
    }
    protected function getSecurity_Acl_SecurityIdentityRetrievalStrategyService()
    {
        return $this->services['security.acl.security_identity_retrieval_strategy'] = new \Symfony\Component\Security\Acl\Domain\SecurityIdentityRetrievalStrategy($this->get('security.role_hierarchy'), $this->get('security.authentication.trust_resolver'));
    }
    protected function getSecurity_Authentication_ManagerService()
    {
        $a = $this->get('fos_user.user_checker');
        $b = $this->get('security.encoder_factory');
        return $this->services['security.authentication.manager'] = new \Symfony\Component\Security\Core\Authentication\AuthenticationProviderManager(array(0 => new \Symfony\Component\Security\Core\Authentication\Provider\DaoAuthenticationProvider($this->get('fos_user.user_manager'), $a, 'main', $b, true), 1 => new \Symfony\Component\Security\Core\Authentication\Provider\RememberMeAuthenticationProvider($a, '5b5a0ff57bd45284dafe7f104fc7d8e15', 'main'), 2 => new \Symfony\Component\Security\Core\Authentication\Provider\AnonymousAuthenticationProvider('508d050527c79'), 3 => new \Symfony\Component\Security\Core\Authentication\Provider\DaoAuthenticationProvider($this->get('security.user.provider.concrete.in_memory'), $a, 'secured_area', $b, true)));
    }
    protected function getSecurity_Authentication_SessionStrategyService()
    {
        return $this->services['security.authentication.session_strategy'] = new \Symfony\Component\Security\Http\Session\SessionAuthenticationStrategy('migrate');
    }
    protected function getSecurity_Authentication_TrustResolverService()
    {
        return $this->services['security.authentication.trust_resolver'] = new \Symfony\Component\Security\Core\Authentication\AuthenticationTrustResolver('Symfony\\Component\\Security\\Core\\Authentication\\Token\\AnonymousToken', 'Symfony\\Component\\Security\\Core\\Authentication\\Token\\RememberMeToken');
    }
    protected function getSecurity_ChannelListenerService()
    {
        return $this->services['security.channel_listener'] = new \Symfony\Component\Security\Http\Firewall\ChannelListener($this->get('security.access_map'), new \Symfony\Component\Security\Http\EntryPoint\RetryAuthenticationEntryPoint(80, 443), $this->get('monolog.logger.security'));
    }
    protected function getSecurity_HttpUtilsService()
    {
        return $this->services['security.http_utils'] = new \Symfony\Component\Security\Http\HttpUtils($this->get('i18n_routing.router'));
    }
    protected function getSecurity_Logout_Handler_SessionService()
    {
        return $this->services['security.logout.handler.session'] = new \Symfony\Component\Security\Http\Logout\SessionLogoutHandler();
    }
    protected function getSecurity_RoleHierarchyService()
    {
        return $this->services['security.role_hierarchy'] = new \Symfony\Component\Security\Core\Role\RoleHierarchy(array());
    }
    protected function getSecurity_User_Provider_Concrete_InMemoryService()
    {
        $this->services['security.user.provider.concrete.in_memory'] = $instance = new \Symfony\Component\Security\Core\User\InMemoryUserProvider();
        $instance->createUser(new \Symfony\Component\Security\Core\User\User('etienne', 'coincoin', array(0 => 'ROLE_USER')));
        $instance->createUser(new \Symfony\Component\Security\Core\User\User('admin', 'adminpsw', array(0 => 'ROLE_ADMIN')));
        return $instance;
    }
    protected function getSonata_Block_ManagerService()
    {
        $this->services['sonata.block.manager'] = $instance = new \Sonata\BlockBundle\Block\BlockServiceManager($this, false, $this->get('logger'));
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
    protected function getSonata_Block_Twig_ExtensionService()
    {
        return $this->services['sonata.block.twig.extension'] = new \Sonata\BlockBundle\Twig\Extension\BlockExtension($this->get('sonata.block.manager'), $this->get('sonata.cache.manager'), array('sonata.admin.block.admin_list' => 'sonata.cache.noop', 'sonata.block.service.text' => 'sonata.cache.noop', 'sonata.block.service.action' => 'sonata.cache.noop', 'sonata.block.service.rss' => 'sonata.cache.noop'), $this->get('sonata.block.loader.chain'), $this->get('sonata.block.renderer'));
    }
    protected function getStofDoctrineExtensions_Listener_LoggableService()
    {
        $this->services['stof_doctrine_extensions.listener.loggable'] = $instance = new \Gedmo\Loggable\LoggableListener();
        $instance->setAnnotationReader($this->get('annotation_reader'));
        return $instance;
    }
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
    protected function getTemplating_LocatorService()
    {
        return $this->services['templating.locator'] = new \Symfony\Bundle\FrameworkBundle\Templating\Loader\TemplateLocator($this->get('file_locator'), '/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/prod');
    }
    protected function getTwig_Extension_ActionsService()
    {
        return $this->services['twig.extension.actions'] = new \Symfony\Bundle\TwigBundle\Extension\ActionsExtension($this);
    }
    protected function getTwig_Extension_AssetsService()
    {
        return $this->services['twig.extension.assets'] = new \Symfony\Bundle\TwigBundle\Extension\AssetsExtension($this);
    }
    protected function getTwig_Extension_CodeService()
    {
        return $this->services['twig.extension.code'] = new \Symfony\Bundle\TwigBundle\Extension\CodeExtension($this);
    }
    protected function getTwig_Extension_FormService()
    {
        return $this->services['twig.extension.form'] = new \Symfony\Bridge\Twig\Extension\FormExtension(array(0 => 'form_div_layout.html.twig'));
    }
    protected function getTwig_Extension_RoutingService()
    {
        return $this->services['twig.extension.routing'] = new \Symfony\Bridge\Twig\Extension\RoutingExtension($this->get('i18n_routing.router'));
    }
    protected function getTwig_Extension_SecurityService()
    {
        return $this->services['twig.extension.security'] = new \Symfony\Bundle\SecurityBundle\Twig\Extension\SecurityExtension($this->get('security.context'));
    }
    protected function getTwig_Extension_TransService()
    {
        return $this->services['twig.extension.trans'] = new \Symfony\Bridge\Twig\Extension\TranslationExtension($this->get('translator.default'));
    }
    protected function getTwig_Extension_YamlService()
    {
        return $this->services['twig.extension.yaml'] = new \Symfony\Bridge\Twig\Extension\YamlExtension();
    }
    protected function getValidator_Mapping_ClassMetadataFactoryService()
    {
        return $this->services['validator.mapping.class_metadata_factory'] = new \Symfony\Component\Validator\Mapping\ClassMetadataFactory(new \Symfony\Component\Validator\Mapping\Loader\LoaderChain(array(0 => new \Symfony\Component\Validator\Mapping\Loader\AnnotationLoader($this->get('annotation_reader')), 1 => new \Symfony\Component\Validator\Mapping\Loader\StaticMethodLoader(), 2 => new \Symfony\Component\Validator\Mapping\Loader\XmlFilesLoader(array(0 => '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/symfony/src/Symfony/Component/Form/Resources/config/validation.xml', 1 => '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/Sonata/MediaBundle/Resources/config/validation.xml', 2 => '/Users/guillaumemigeon/Sites/orchestra-cmf/vendor/bundles/FOS/UserBundle/Resources/config/validation.xml')), 3 => new \Symfony\Component\Validator\Mapping\Loader\YamlFilesLoader(array()))), NULL);
    }
    protected function getValidator_ValidatorFactoryService()
    {
        return $this->services['validator.validator_factory'] = new \Symfony\Bundle\FrameworkBundle\Validator\ConstraintValidatorFactory($this, array('doctrine.orm.validator.unique' => 'doctrine.orm.validator.unique', 'sonata.admin.validator.inline' => 'sonata.admin.validator.inline', 'fos_user.validator.unique' => 'fos_user.validator.unique', 'fos_user.validator.password' => 'fos_user.validator.password', 'pi_app_admin.validator.unique' => 'pi_app_admin.validator.unique', 'pi_app_admin.validator.collectionof' => 'pi_app_admin.validator.collectionof'));
    }
    public function getParameter($name)
    {
        $name = strtolower($name);
        if (!array_key_exists($name, $this->parameters)) {
            throw new \InvalidArgumentException(sprintf('The parameter "%s" must be defined.', $name));
        }
        return $this->parameters[$name];
    }
    public function hasParameter($name)
    {
        return array_key_exists(strtolower($name), $this->parameters);
    }
    public function setParameter($name, $value)
    {
        throw new \LogicException('Impossible to call set() on a frozen ParameterBag.');
    }
    public function getParameterBag()
    {
        if (null === $this->parameterBag) {
            $this->parameterBag = new FrozenParameterBag($this->parameters);
        }
        return $this->parameterBag;
    }
    protected function getDefaultParameters()
    {
        return array(
            'kernel.root_dir' => '/Users/guillaumemigeon/Sites/orchestra-cmf/app',
            'kernel.environment' => 'prod',
            'kernel.debug' => false,
            'kernel.name' => 'app',
            'kernel.cache_dir' => '/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/prod',
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
            ),
            'kernel.charset' => 'UTF-8',
            'kernel.container_class' => 'appProdProjectContainer',
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
            'router.options.matcher.cache_class' => 'appprodUrlMatcher',
            'router.options.generator.cache_class' => 'appprodUrlGenerator',
            'router.resource' => '/Users/guillaumemigeon/Sites/orchestra-cmf/app/config/routing.yml',
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
                'debug' => false,
                'strict_variables' => false,
                'auto_reload' => NULL,
                'cache' => '/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/prod/twig',
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
            'assetic.cache_dir' => '/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/prod/assetic',
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
            ),
            'assetic.twig_extension.class' => 'Symfony\\Bundle\\AsseticBundle\\Twig\\AsseticExtension',
            'assetic.twig_formula_loader.class' => 'Assetic\\Extension\\Twig\\TwigFormulaLoader',
            'assetic.helper.dynamic.class' => 'Symfony\\Bundle\\AsseticBundle\\Templating\\DynamicAsseticHelper',
            'assetic.helper.static.class' => 'Symfony\\Bundle\\AsseticBundle\\Templating\\StaticAsseticHelper',
            'assetic.php_formula_loader.class' => 'Symfony\\Bundle\\AsseticBundle\\Factory\\Loader\\AsseticHelperFormulaLoader',
            'assetic.debug' => false,
            'assetic.use_controller' => false,
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
            'assetic.asset_writer_cache_warmer.class' => 'Symfony\\Bundle\\AsseticBundle\\CacheWarmer\\AssetWriterCacheWarmer',
            'assetic.asset_writer.class' => 'Assetic\\AssetWriter',
            'sensio_framework_extra.controller.listener.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\EventListener\\ControllerListener',
            'sensio_framework_extra.routing.loader.annot_dir.class' => 'Symfony\\Component\\Routing\\Loader\\AnnotationDirectoryLoader',
            'sensio_framework_extra.routing.loader.annot_file.class' => 'Symfony\\Component\\Routing\\Loader\\AnnotationFileLoader',
            'sensio_framework_extra.routing.loader.annot_class.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\Routing\\AnnotatedRouteControllerLoader',
            'sensio_framework_extra.converter.listener.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\EventListener\\ParamConverterListener',
            'sensio_framework_extra.converter.manager.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\Request\\ParamConverter\\ParamConverterManager',
            'sensio_framework_extra.converter.doctrine.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\Request\\ParamConverter\\DoctrineParamConverter',
            'sensio_framework_extra.view.listener.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\EventListener\\TemplateListener',
            'jms_aop.cache_dir' => '/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/prod/jms_aop',
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
            'jms_di_extra.cache_dir' => '/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/prod/diextra',
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
            'doctrine.orm.auto_generate_proxy_classes' => false,
            'doctrine.orm.proxy_dir' => '/Users/guillaumemigeon/Sites/orchestra-cmf/app/cache/prod/doctrine/orm/Proxies',
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
        );
    }
}
