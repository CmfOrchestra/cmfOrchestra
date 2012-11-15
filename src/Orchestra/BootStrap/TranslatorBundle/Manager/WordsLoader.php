<?php
/**
 * This file is part of the <Translator> project.
 *
 * @category   BootStrap_Manager
 * @package    translator
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-11-14
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\TranslatorBundle\Manager;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Translation\Loader\LoaderInterface;
use Symfony\Component\Translation\MessageCatalogue;


/**
 * Words translator management.
 *
 * @category   BootStrap_Manager
 * @package    translator
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class WordsLoader implements LoaderInterface
{
	/**
	 * @var \Symfony\Component\DependencyInjection\ContainerInterface
	 */
	private $container;
		
	/**
	 * Constructor.
	 *
	 * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
	 */
	public function __construct(ContainerInterface $container)
	{
		$this->container    	= $container;
	}
		
	/**
	 * @param string $resource
	 * @param null $type
	 * @return \Symfony\Component\Routing\RouteCollection
	 * @access public
	 *
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 * @since 2012-11-14
	 */	
	public function load($resource, $locale, $domain = 'messages')
	{
		$info_locale = explode("_", $locale);
		$lang	     = $info_locale[0];
				
		$catalogue  = new MessageCatalogue($locale);
		$finder 	= new \Symfony\Component\Finder\Finder();

		$basePath	= $this->container->getParameter("kernel.cache_dir"). '/../translation/';
		$paths_messages[] 	= realpath($basePath."messages.".$locale.".yml");
		
		$bundles 	= $this->container->get("kernel")->getBundles();		
		if(is_array($bundles)){
			foreach($bundles as $key => $bundle){
				$dir_path = realpath($bundle->getPath() . '/Resources/translations/');
				
				if($dir_path){
					$files = $finder->files()->name("*messages.{$lang}.yml")->in($dir_path);
					foreach ($files as $file) {
						$paths_messages[] = $file->getPathname();
					}
					
// 					$files = $finder->files()->name("*messages.{$locale}.yml")->in($dir_path);	
// 					foreach ($files as $file) {
// 						$paths_messages[] = $file->getPathname();
// 					}
					
					$files = $finder->files()->name("*validators.{$lang}.yml")->in($dir_path);
					foreach ($files as $file) {
						$paths_validators[] = $file->getPathname();
					}
						
// 					$files = $finder->files()->name("*validators.{$locale}.yml")->in($dir_path);
// 					foreach ($files as $file) {
// 						$paths_validators[] = $file->getPathname();
// 					}					
				}	
			}			
		}		
		
		$paths_messages = array_unique($paths_messages);		
		if(is_array($paths_messages)){
			foreach($paths_messages as $key => $path){
				$yaml = \Symfony\Component\Yaml\Yaml::parse($path);
	
				if(is_array($yaml)){
					foreach($yaml as $keywords => $words){
						$catalogue->set($keywords, $words, "messages");
					}
				}
			}
		}
		
		$paths_validators = array_unique($paths_validators);
		if(is_array($paths_validators)){
			foreach($paths_validators as $key => $path){
				$yaml = \Symfony\Component\Yaml\Yaml::parse($path);
		
				if(is_array($yaml)){
					foreach($yaml as $keywords => $words){
						$catalogue->set($keywords, $words, "validators");
					}
				}
			}
		}		

// 		print_r($paths_messages);
// 		print_r($paths_validators);
// 		exit;
		
// 		print_r($catalogue->getDomains());exit;
		
		return $catalogue;
	}
}