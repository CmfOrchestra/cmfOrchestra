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
//use Symfony\Component\Translation\MessageCatalogue;
use BootStrap\TranslatorBundle\Model\MessageCatalogue;
//use BootStrap\TranslatorBundle\Manager\Loader\LoaderInterface;


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
		$targetLocale = $locale;
		//$catalogue  = new MessageCatalogue($locale);
		$catalogue = new MessageCatalogue();
		$catalogue->setLocale($targetLocale);
		$finder 	= new \Symfony\Component\Finder\Finder();

		$basePath	= $this->container->getParameter("kernel.cache_dir"). '/../translation/';
		$paths_messages[] 	= realpath($basePath."messages.".$locale.".yml");
		//print_r($locale);die;
		$bundles 	= $this->container->get("kernel")->getBundles();		
		if(is_array($bundles)){
			foreach($bundles as $key => $bundle){
				$dir_path = realpath($bundle->getPath() . '/Resources/translations/');
				
				if($dir_path){
					
					$files = \JMS\TranslationBundle\Util\FileUtils::findTranslationFiles($dir_path);

					foreach ($files as $domain => $locales) {
						foreach ($locales as $locale => $data) {
							if ($locale !== $targetLocale) {
								continue;
							}
							
							list($format, $file) = $data;
							
							//print_r(get_class($this->loadFile($file, $format, $locale, $domain)));
							//$catalogue->merge($this->loadFile($file, $format, $locale, $domain));exit;
					//print_r($catalogue);die;
						}
					}
					//
					//return $catalogue;
					
					
					
					
					
					
					
					/*$files = $finder->files()->name("*messages.{$lang}.yml")->in($dir_path);
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
					}*/
						
// 					$files = $finder->files()->name("*validators.{$locale}.yml")->in($dir_path);
// 					foreach ($files as $file) {
// 						$paths_validators[] = $file->getPathname();
// 					}					
				
					//$translationsDir = $this->configFactory->getConfig($config, 'en')->getTranslationsDir();
					/*$files = \JMS\TranslationBundle\Util\FileUtils::findTranslationFiles($dir_path);
					if (empty($files)) {
						throw new RuntimeException('There are no translation files for this config, please run the translation:extract command first.');
					}
					
					$domains = array_keys($files);
					$domain = reset($domains);
					if (!isset($files[$domain])) {
						$domain = reset($domains);
					}
					
					$locales = array_keys($files[$domain]);
					print_r($locale);
					if (!$locale || !isset($files[$domain][$locale])) {
						$locale = reset($locales);
					}
					print_r($locale);
					
					if($files[$domain][$locale][0] == "yml"){
						$messages = \Symfony\Component\Yaml\Yaml::parse($files[$domain][$locale][1]->getPathName());
			
					die();
					}*/
				//print_r($catalogue);
				
				
				
				}	
			}			
		}		
		
		/*$paths_messages = array_unique($paths_messages);		
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
		}		*/

// 		print_r($paths_messages);
// 		print_r($paths_validators);
// 		exit;
		
// 		print_r($catalogue->getDomains());exit;
		
		return $catalogue;
	}
	
	/**
	 * @param $format
	 * @return mixed
	 * @throws \InvalidArgumentException
	 * @return \BootStrap\TranslatorBundle\Manager\Loader\LoaderInterface
	 */
	protected function getLoader($format)
	{
		$loader;
		if ($format == 'yml') {
			$loader = $this->container->get('translation.loader.yml');
		}
		elseif ($format == 'php'){
			$loader = $this->container->get('translation.loader.php');
		}
		elseif ($format == 'xliff'){
			$loader = $this->container->get('translation.loader.xliff');
		}
		else{
				throw new InvalidArgumentException(sprintf('The format "%s" does not exist.', $format));
		}
		
		return $loader;
	}
	

	/**
	 * @param $file
	 * @param $format
	 * @param $locale
	 * @param string $domain
	 * @return mixed
	 */
	public function loadFile($file, $format, $locale, $domain = 'messages')
	{
		return $this->getLoader($format)->load($file, $locale, $domain);
	}
	
}