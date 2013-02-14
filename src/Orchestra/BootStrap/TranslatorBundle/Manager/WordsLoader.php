<?php
/**
 * This file is part of the <Translator> project.
 *
 * @category   BootStrap_Manager
 * @package    translator
 * @author Riad HELLAL <r.hellal@novediagroup.com>
 * @author etienne de Longeaux <etienne.delongeaux@gmail.com>
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
 * @author Riad HELLAL <r.hellal@novediagroup.com>
 * @author etienne de Longeaux <etienne.delongeaux@gmail.com>
 * 
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
	 * @author Riad HELLAL <r.hellal@novediagroup.com>
     * @author etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-11-14
	 */	
	public function load($resource, $userLocale, $domain = 'messages')
	{
		// get a new instance of the catalogue
		$catalogue  = new MessageCatalogue($userLocale);
		
		// set the cache file path of all translations words of the locale.
		$foundBundle	= $this->container->get('kernel')->getBundle('BootStrapTranslatorBundle');
		$basePath		= $foundBundle->getPath() . "/Resources/translations/";
		$filepath 		= $basePath."messages.".$userLocale.".yml";
	    
	    if(!file_exists($filepath)){
	      $this->wordsTranslation();
	    }
	    $path_message 	= realpath($filepath);    

	    // get all bundles translaions in user locale
	    $bundles 	= $this->container->get("kernel")->getBundles();
	    
		if(is_array($bundles)){
			foreach($bundles as $bundle){
				$dir_path = realpath($bundle->getPath() . '/Resources/translations/');
				
				if($dir_path){					
					$files = \JMS\TranslationBundle\Util\FileUtils::findTranslationFiles($dir_path);
					foreach ($files as $domain => $locales) {
						foreach ($locales as $locale => $data) {
							if ($locale !== $userLocale) {
								continue;
							}							
							list($format, $file) = $data;
							
              				// merge catalogues
              				$loader = $this->loadFile($file, $format, $locale, $domain);
							$catalogue->addCatalogue($loader);
						}
					}
				}	
			}		
		}		
    
	    // add words translations here
	    $loader = $this->loadFile($path_message, 'yml', $userLocale, 'messages');
	    $catalogue->addCatalogue($loader);
		
		return $catalogue;
	}
	
	/**
   	 * @param $format
	 * @throws \InvalidArgumentException
	 * @return \BootStrap\TranslatorBundle\Manager\Loader\LoaderInterface
	 * @access private
	 * 
	 * @author Riad HELLAL <r.hellal@novediagroup.com>
	 */
	private function getLoader($format)
	{
		if ($format == 'yml') {
			$loader = $this->container->get('translation.loader.yml');
		}
		elseif ($format == 'php'){
			$loader = $this->container->get('translation.loader.php');
		}
		elseif ($format == 'xliff'){
			$loader = $this->container->get('translation.loader.xliff');
		}
		elseif ($format == 'csv'){
			$loader = $this->container->get('translation.loader.csv');
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
	 * @access private
	 * 
	 * @author Riad HELLAL <r.hellal@novediagroup.com>
	 */
	private function loadFile($file, $format, $locale, $domain = 'messages')
	{
		$loader = $this->getLoader($format);
    	return $loader->load($file, $locale, $domain);
	}  
  
    /**
     * Sets the specific sortOrders.
     *
     * @return void
     * @access private
     *
     * @author Riad HELLAL <r.hellal@novediagroup.com>
     */
    public function wordsTranslation()
    {
    	$entityManager 	= $this->container->get('doctrine')->getEntityManager();
    	$locale	= $this->container->get('session')->getLocale();

    	$foundBundle	= $this->container->get('kernel')->getBundle('BootStrapTranslatorBundle');
    	$basePath		= $foundBundle->getPath() . "/Resources/translations/";
    	$dir 			= \PiApp\AdminBundle\Util\PiFileManager::mkdirr($basePath);

    	$languages 		= $entityManager->getRepository("PiAppAdminBundle:Langue")->findAllByEntity($locale, 'object', false);
    	 
    	$array = array();
    	foreach($languages as $language){
    		$filename 	= $basePath."messages.".$language->getId().".yml";
    		$Words 		= $entityManager->getRepository("BootStrapTranslatorBundle:Word")->findAllByEntity($language->getId(), 'object', false);
    		foreach ($Words as $word){
    			$array["{$word->getKeyword()}"] = $word->translate($language->getId())->getLabel()? $word->translate($language->getId())->getLabel():' ';
    		}
    		$yaml = \Symfony\Component\Yaml\Yaml::dump($array, 2);
    		file_put_contents($filename, $yaml);
    	}
    }  
}