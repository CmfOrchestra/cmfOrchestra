ORCHESTRA Bundles
=====================


Orchestra is not just the description you just read above. It also allows you to create your own CMS. 
It's a CMF easy to use, build your own template (layout), add your own custom block with your own logic, 
build all the widget you need. That it what Orcherstra is made for.


## Structure of the framework

The bundle has been split into 2 directories :

**BootStrap**

``` bash
* AclManagerBundle : A bundle which provides classes to run ACL Manager`s utilities for Symfony2
* AdminBundle : A bundle which overload the SonataAdminBundle
* CacheBundle : A bundle which provides classes to cache handlers (memcache, files)
* DatabaseBundle : A bundle which provides classes and commands to run DB vendor`s utilities to backup and restore databases. 
* FacebookBundle : A bundle which provides a factory of classes allowing to work and develop utilities of facebook API.
* GoogleBundle : A bundle which provides a factory of classes allowing to work and develop utilities of google API.
* MediaBundle : A bundle which overload the SonataMediaBundle.
* TranslationBundle : A bundle which provides models of classes allowing to work and develop with Gedmo translation and Gedmo tree, and a command to
generate orchestra bundle with a CRUD system of an entity
* UserBundle : the current one, contains core libraries and services
* WurflBundle : the current one, contains core libraries and services
```

**PiApp**

``` bash
* AdminBundle : A bundle which construct all the CMF with all managers of the creation of page with blocks and widgets.
* GedmoBundle : A bundle which is used to create a project with the CMF.
* TemplateBundle :  A bundle which is used to stock all template of layout and others.
```

## Dependencies

Register all bundle in your `app/AppKernel.php` file:

``` php
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
        	new Sonata\AdminBundle\SonataAdminBundle(), //
        	new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(), //
        	new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(), //
        	new Sonata\CacheBundle\SonataCacheBundle(),
        	new Sonata\BlockBundle\SonataBlockBundle(),
        	new Sonata\MediaBundle\SonataMediaBundle(), //
        
        	# tools
        	new FOS\UserBundle\FOSUserBundle(), // gestion user/groupe
        	new Knp\Bundle\MenuBundle\KnpMenuBundle(), // gestion menu
        	new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(), // gestion pagination        	
        	
        	# boostrap
        	new BootStrap\DatabaseBundle\BootStrapDatabaseBundle(), 
        	new BootStrap\CacheBundle\BootStrapCacheBundle(),
        	new BootStrap\WurflBundle\BootStrapWurflBundle(),
        	new BootStrap\AclManagerBundle\BootStrapAclManagerBundle(),
        	new BootStrap\AdminBundle\BootStrapAdminBundle(),
        	new BootStrap\UserBundle\BootStrapUserBundle(),
        	new BootStrap\TranslationBundle\BootStrapTranslationBundle(),
        	new BootStrap\MediaBundle\BootStrapMediaBundle(),
        	new BootStrap\GoogleBundle\BootStrapGoogleBundle(),
        	new BootStrap\FacebookBundle\BootStrapFacebookBundle(),
        		
        	# trades
        	new PiApp\AdminBundle\PiAppAdminBundle(),
        	new PiApp\GedmoBundle\PiAppGedmoBundle(),
        	new PiApp\TemplateBundle\PiAppTemplateBundle(),
        );
```

## autoload.php

Register all namespace before using the bundle. Add the following line to your `app/autoload.php` 

``` php

    $loader->registerNamespaces(array(
		'Symfony'          => array(__DIR__.'/../vendor/symfony/src', __DIR__.'/../vendor/bundles'),
		'Sensio'           => __DIR__.'/../vendor/bundles',
		
		// JMS
		'JMS'              => __DIR__.'/../vendor/bundles',
		
		// generate code library
		'CG'               => __DIR__.'/../vendor/cg-library/src',
		
		// doctrine extension
		'Doctrine\\Common\\DataFixtures'	=> __DIR__.'/../vendor/doctrine-fixtures/lib',
		'Doctrine\\Common' 					=> __DIR__.'/../vendor/doctrine-common/lib',
		'Doctrine\\DBAL\\Migrations'        => __DIR__.'/../vendor/doctrine-migrations/lib',
		'Doctrine\\DBAL'   					=> __DIR__.'/../vendor/doctrine-dbal/lib',
		'Doctrine'         					=> __DIR__.'/../vendor/doctrine/lib',
		'Stof'             					=> __DIR__.'/../vendor/bundles',
		'Gedmo'            					=> __DIR__.'/../vendor/gedmo-doctrine-extensions/library/lib',
		
		'Monolog'          => __DIR__.'/../vendor/monolog/src',
		'Assetic'          => __DIR__.'/../vendor/assetic/src',
		'Metadata'         => __DIR__.'/../vendor/metadata/src',
		
		// BUNDLES
		'FOS' 			   => __DIR__.'/../vendor/bundles',
		'Genemu'		   => __DIR__.'/../vendor/bundles',
		'Exporter'   	   => __DIR__.'/../vendor/exporter/lib',
		'Sonata'		   => __DIR__.'/../vendor/bundles',  // dependency :  Knp\Bundle and Knp\Menu
		'BeSimple'		   => __DIR__.'/../vendor/bundles', // Route - WSDL
		
		
		'Knp\\Bundle'	   => __DIR__.'/../vendor/bundles',
		'Knp\\Menu'   	   => __DIR__.'/../vendor/Knp-menu/src',
		'Knp\\Component'   => __DIR__.'/../vendor/knp-components/src',
		
		'Imagine'		   => __DIR__.'/../vendor/imagine/lib', // dependency : sonata Media
		'Gaufrette'        => __DIR__.'/../vendor/gaufrette/src', // dependency : sonata Media
		'Buzz'             => __DIR__.'/../vendor/buzz/lib', // dependency : sonata Media
		
		// ORCHESTRA BUNDLES
		'BootStrap'  	  	=> __DIR__.'/../src/Orchestra',
		'PiApp'    			=> __DIR__.'/../src/Orchestra',
				
));
```

## Installation

### Step 0: Configuring Serveur

**Required** : 

- PHP avec au minimum la version 5.3.2 de PHP
- Sqlite3 doit être activé
- JSON doit être activé
- ctype doit être activé
- Le module PHP-XML doit être installé
- Installtion de la bibliothèque gd (pour les sessions) : apt-get install php5-gd [command linux]
- PHP.ini doit avoir les extensions:

    - date.timezone
    - php_fileinfo.dll
    - PDO_SQLITE.dll
    - php_intl.dll
    - php_memcache.dll
    - php_curl.dll
    
**Doctrine** : 

To use Doctrine, you will need to have installed PDO. And you must have installed the PDO driver for the database server you want to use.    

### Step 1: Configuring BDD

* Open the file orchestra_project / app / config / parameters.ini.
* Give the name "mydatabase" for example in the database and choose the type pdo_mysql to use a MySQL database.
* Change the secret code that will be used to protect your application from XSS attacks.

``` bash
[parameters]
    database_driver="pdo_mysql"
    database_host="localhost"
    database_port=""
    database_name="mydatabase"
    database_user="root"
    database_password=""
    mailer_transport="smtp"
    mailer_host="localhost"
    mailer_user=""
    mailer_password=""
    locale="fr"
    secret="5b5a0ff57bd45284dafe7f104fc7d8e15"
```

### Step 2: Setting up Permissions

* Les répertoires app / cache et app / logs doivent être accessibles en écriture à la fois par le serveur web et l'utilisateur.
* On a UNIX system, if your web server is different from your user, you can run the following commands once in your project to ensure that the permissions are correctly installed. 
* We must change www-data on your web server.

Many systems allow you to use ACL chmod a + :

``` bash
rm -rf app/cache/Backup*
rm -rf app/cache/Indexation*
rm -rf app/cache/media*
rm -rf app/logs/*

sudo chmod +a "www-data allow delete,write,append,file_inherit,directory_inherit" app/cache app/logs
sudo chmod +a "`whoami` allow delete,write,append,file_inherit,directory_inherit" app/cache app/logs
```

**For more information** : http://symfony.com/doc/current/book/installation.html

Then you must add the uploads/media folder to allow specific users to load :

``` bash
mkdir web/uploads
mkdir web/uploads/media
chmod –R 0777 web/uploads

mkdir web/yui
chmod –R 0777 web/yui
```

### Step 3: Create database, tables and fixtures

- Open your console (cmd) or Putty.
- Go to the root of the application orchestra_project.

**Type the following command to create the database**

``` bash

	php  app/console  **doctrine:database:create**

```

**Type the following command to create the tables**

``` bash

	php  app/console  **doctrine:schema:create**

```

**Type the following command to install fixtures of the tables**

``` bash

	php  app/console  **doctrine:fixtures:load**

```

**For more information** : http://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html