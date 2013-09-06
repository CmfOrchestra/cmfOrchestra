ORCHESTRA Bundles
=====================


Orchestra is not just the description you just read above. It also allows you to create your own CMS. 
It's a CMF easy to use, build your own template (layout), add your own custom block with your own logic, 
build all the widget you need. That it what Orcherstra is made for.


## Structure of the framework

The bundle has been split into 2 directories :

**BootStrap**

``` bash
* AclManagerBundle : A bundle which provides classes to run ACL Manager`s utilities for Symfony2.
* AdminBundle : A bundle which overload the SonataAdminBundle.
* CacheBundle : A bundle which provides classes to cache handlers (memcache, files).
* DatabaseBundle : A bundle which provides classes and commands to run DB vendor`s utilities to backup and restore databases. 
* MediaBundle : A bundle which overload the SonataMediaBundle.
* TranslationBundle : A bundle which provides models of classes allowing to work and develop with Gedmo translation and Gedmo tree, and a command to generate orchestra bundle with a CRUD system of an entity, contains core libraries and services of route, etc.
* TranslatorBundle : A bundle which provides entity and models of classes allowing to work with translation words.
* UserBundle : A bundle which overload the FOSUserBundle.
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
                new Sonata\AdminBundle\SonataNotificationBundle(),
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
        
```

## composer.json

Register all namespace before using the bundle. Add the following line to your `app/autoload.php` 

``` json

    {
        "name": "symfony/framework-standard-edition",
        "license": "MIT",
        "type": "project",
        "description": "The \"Symfony Standard Edition\" distribution",
        "repositories": [
        {
            "type":"vcs",
            "url":"https://github.com/vincecore/BeSimpleI18nRoutingBundle.git"
        }
        ],
        "require": {
            "php": ">=5.3.3",
            "symfony/symfony": "2.2.4",
            "doctrine/orm": "2.3",
            "doctrine/doctrine-bundle": "1.2.0",
            "twig/extensions": "1.0.0",
            "symfony/assetic-bundle": "2.1.3",
            "symfony/swiftmailer-bundle": "2.2.4",
            "symfony/monolog-bundle": "2.2.0",
            "sensio/distribution-bundle": "2.2.4",
            "sensio/framework-extra-bundle": "2.2.4",
            "sensio/generator-bundle": "2.2.4",
            
            "jms/translation-bundle": "1.1.*@dev",
            "jms/security-extra-bundle": "1.4.*",
            "jms/di-extra-bundle": "1.3.*",
            
            "gedmo/doctrine-extensions": "2.3.*@dev",
            "doctrine/data-fixtures": "1.0.*@dev",
            "doctrine/doctrine-fixtures-bundle": "2.1.*@dev",
            "stof/doctrine-extensions-bundle": "1.1.0",
            
            "friendsofsymfony/user-bundle": "2.0.*@dev",
            "friendsofsymfony/facebook-bundle": "1.2.*",
            "besimple/i18n-routing-bundle": "2.2.x-dev",
            
            "imagine/Imagine": "*@stable",
            "kriswallsmith/buzz": "0.*",        
            
            "knplabs/knp-menu-bundle": ">=1.1,<2.0",
            "knplabs/knp-menu": "1.1.*",
            "knplabs/knp-components": "1.2.2",
            "knplabs/knp-paginator-bundle": "2.3.*@dev",        
            "knplabs/knp-snappy": "dev-master",
            "knplabs/knp-snappy-bundle": "dev-master",        
            
            "sonata-project/intl-bundle": "2.1.*",
            "sonata-project/exporter": "1.*",
            "sonata-project/admin-bundle": "2.2.*@dev",
            "sonata-project/block-bundle": ">=2.2.1,<3.0",
            "sonata-project/cache-bundle": "2.1.*@dev",
            "sonata-project/doctrine-orm-admin-bundle": "2.2.*@dev",
            "sonata-project/easy-extends-bundle": "2.1.*@dev",
            "sonata-project/jquery-bundle": "1.8.*@dev",
            "sonata-project/media-bundle": "2.2.*@dev",
            "sonata-project/notification-bundle": "2.2.*@dev"
        },
        "scripts": {
            "post-install-cmd": [
                "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::buildBootstrap",
                "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::clearCache",
                "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::installAssets",
                "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::installRequirementsFile"
            ],
            "post-update-cmd": [
                "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::buildBootstrap",
                "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::clearCache",
                "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::installAssets",
                "Sensio\\Bundle\\DistributionBundle\\Composer\\ScriptHandler::installRequirementsFile"
            ]
        },
        "config": {
            "bin-dir": "bin"
        },
        "minimum-stability": "dev",
        "extra": {
            "symfony-app-dir": "app",
            "symfony-web-dir": "web",
            "branch-alias": {
                "dev-master": "2.2-dev"
            }
        },
        "autoload": {
            "psr-0": {
                "PiApp": "vendor/Orchestra",
                "BootStrap": "vendor/Orchestra",
                "Zend_": "vendor/Zend/library"
            }
        }    
    }
    
```

## Installation


### Step 0: Configuring Serveur

Before starting coding, make sure that your local system is properly
configured for Symfony.

Execute the `check.php` script from the command line:

``` bash

    php app/check.php

```

**Required** : 

- PHP with at least version 5.3.2 of PHP
- Sqlite3 must be enabled
- JSON must be enabled
- Ctype must be enabled
- PHP-XML module must be installed
- Installtion the gd library (for images): apt-get install php5-gd [command linux]
- PHP.ini must have the extensions:

    - date.timezone
    - php_fileinfo.dll
    - PDO_SQLITE.dll
    - php_intl.dll
    - php_memcache.dll (facultatif pour une gestion performante de cache de doctrine)
    - php_curl.dll
    
**Doctrine** : 

To use Doctrine, you will need to have installed PDO. And you must have installed the PDO driver for the database server you want to use.    

### Step 1: Configuring parameters  BDD and mailer

* Open the file orchestra_project / app / config / parameters.ini.
* Give the name "mydatabase" for example in the database and choose the type pdo_mysql to use a MySQL database.
* Give your user and password of your Gmail count.
* Change the secret code that will be used to protect your application from XSS attacks.

``` bash
[parameters]
    database_driver="pdo_mysql"
    database_host="localhost"
    database_port=""
    database_name="mydatabase"
    database_user="root"
    database_password=""
    mailer_transport="gmail"
    mailer_host=""
    mailer_user="MyUserGMAIL"
    mailer_password="MyPswGMAIL"
    locale="en_GB"
    secret="5b5a0ff57bd45284dafe7f104fc7d8e15"
```

### Step 2: Setting up Permissions

* The directories app / cache app / logs should be writable by both the web server and the user.
* On a UNIX system, if your web server is different from your user, you can run the following commands once in your project to ensure that the permissions are correctly installed. 
* We must change www-data on your web server.

Many systems allow you to use ACL chmod a +.
**For more information** : http://symfony.com/doc/current/book/installation.html

Then you must add the uploads/media folder to allow specific users to load :

``` bash
mkdir app/cache/ Backup
mkdir app/cache/ Indexation
mkdir app/cache/ media
chmod –R 0777 app / cache
chmod –R 0777 app / log
chmod –R 0777 Orcehstra / BootStrap/TranslatorBundle/Resources/translations

mkdir web/uploads
mkdir web/uploads/media
mkdir web/yui
chmod –R 0777 web/uploads
chmod –R 0777 web/yui
```

### Step 4: Installing the vendor

As Symfony uses [Composer][2] to manage its dependencies, the recommended way
to create a new project is to use it.

If you don't have Composer yet, download it following the instructions on
http://getcomposer.org/ or just run the following command:

``` bash

    curl -s http://getcomposer.org/installer | php
    
```    
    
**Setting vendor with composer.json**
``` bash

    php  composer.phar selfupdate
    php  composer.phar install -v

```

### Step 5: Create database, tables and fixtures

- There's no way to configure these defaults inside Doctrine, as it tries to be as agnostic as possible in terms of environment configuration. 
- One way to solve this problem is to configure server-level defaults.

**Setting UTF8 defaults for MySQL is as simple as adding a few lines to your configuration file (typically my.cnf)**

``` bash

    [mysqld]
    collation-server     = utf8_general_ci
    character-set-server = utf8

```

**or open file \Doctrine\DBAL\Platforms\AbstractPlatform in getCreateTableSQL method and add this following line**

``` bash
    
    $options = $table->getOptions();
    ...
    $options['charset'] = 'utf8';
    $options['collate'] = 'utf8_general_ci';

```


- Open your console (cmd) or Putty.
- Go to the root of the application orchestra_project.

**Type the following command to create the database**

``` bash

    php  app/console  doctrine:database:create

```

**Type the following command to create the tables**

``` bash

    php  app/console  doctrine:schema:create

```

**Type the following command to install fixtures of the tables**

``` bash

    php  app/console  doctrine:fixtures:load

```

**For more information** : http://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html

### Step 6: Connexion on /login

To connect as default super administrator:

``` bash

    Username: superadmin
    Password: superadmin

```

**The password must be changed at the first use.**