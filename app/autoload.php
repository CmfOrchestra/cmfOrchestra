<?php

use Symfony\Component\ClassLoader\UniversalClassLoader;
use Doctrine\Common\Annotations\AnnotationRegistry;

$loader = new UniversalClassLoader();
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
		'Knp\\Snappy'      => __DIR__.'/../vendor/snappy/src',
		
		'Imagine'		   => __DIR__.'/../vendor/imagine/lib', // dependency : sonata Media
		'Gaufrette'        => __DIR__.'/../vendor/gaufrette/src', // dependency : sonata Media
		'Buzz'             => __DIR__.'/../vendor/buzz/lib', // dependency : sonata Media
		
		// ORCHESTRA BUNDLES
		'BootStrap'  	  	=> __DIR__.'/../src/Orchestra',
		'PiApp'    			=> __DIR__.'/../src/Orchestra',
				
));
$loader->registerPrefixes(array(
    'Twig_Extensions_' => __DIR__.'/../vendor/twig-extensions/lib',
    'Twig_'            => __DIR__.'/../vendor/twig/lib',
	'Zend_'            => __DIR__.'/../vendor/Zend/library',
	'WURFL_'           => __DIR__.'/../vendor/wurfl/library',		
));

// intl
if (!function_exists('intl_get_error_code')) {
    require_once __DIR__.'/../vendor/symfony/src/Symfony/Component/Locale/Resources/stubs/functions.php';

    $loader->registerPrefixFallbacks(array(__DIR__.'/../vendor/symfony/src/Symfony/Component/Locale/Resources/stubs'));
}

$loader->registerNamespaceFallbacks(array(
    __DIR__.'/../src',
));
$loader->register();
set_include_path(__DIR__.'/../vendor/wurfl/library'.PATH_SEPARATOR.__DIR__.'/../vendor/facebook/src'.PATH_SEPARATOR.__DIR__.'/../vendor/Zend/library'.PATH_SEPARATOR.get_include_path());

AnnotationRegistry::registerLoader(function($class) use ($loader) {
    $loader->loadClass($class);
    return class_exists($class, false);
});
AnnotationRegistry::registerFile(__DIR__.'/../vendor/doctrine/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php');

require __DIR__.'/../vendor/swiftmailer/lib/swift_required.php';
