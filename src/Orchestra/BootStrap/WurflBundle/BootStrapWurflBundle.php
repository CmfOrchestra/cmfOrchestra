<?php
/**
 * This file is part of the <User> project.
 * 
 * @category   Bundle
 * @package    BootStrap
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\WurflBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Wurfl managment Bundle
 *
 * @category   Bundle
 * @package    BootStrap
 * 
 * @author <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class BootStrapWurflBundle extends Bundle
{

	/**
	 * Builds the bundle.
	 *
	 * It is only ever called once when the cache is empty.
	 *
	 * This method can be overridden to register compilation passes,
	 * other extensions, ...
	 *
	 * @param ContainerBuilder $container A ContainerBuilder instance
	 * 
	 * @author <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 */
	public function build(ContainerBuilder $container)
	{
		parent::build($container);
		//print_r('PiApptest1');
	}
	
	/**
	 * 
	 * Boots the Bundle.
	 * 
	 * @link http://sourceforge.net/projects/wurfl/files/WURFL/2.3/
	 * 
	 * @author <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 */
	public function boot()
	{
		// Wurfl config
		$resourcesLib  = realpath(dirname(__FILE__) . '/../../../../vendor/wurfl');
		$resourcesConf = realpath(dirname(__FILE__) . '/Resources/config');
		
		if(!empty($resourcesConf)) {
			$config = array(
					'wurflapi' => array(
							'wurfl_config_array' => array(
									'wurfl' => array(
											'main-file' => realpath($resourcesConf . '/wurfl.xml'),
											'patches'	=> realpath($resourcesConf . '/web_browsers_patch.xml'),
									),
		
									'persistence' => array(
											'provider'	=> 'file',
											'dir'		=> $resourcesLib . '/cache/',
									),
		
									'cache' => null,
							),
		
							'wurfl_lib_dir'		=> $resourcesLib  . '/library/WURFL/',
							'wurfl_api_version' => '1.1',
					),
			);
		
			// instance of userAgent
			$userAgent		 =  new \Zend_Http_UserAgent($config);
			$userAgentDevice = $userAgent->getDevice();
		
			// save the device object in the registry
			\Zend_Registry::set('wurflDevice', $userAgentDevice);
			\Zend_Registry::set('wurflAgent', $userAgent);
		}
	}
	
	/**
	 * Shutdowns the Bundle.
	 */
	public function shutdown()
	{
	}	
	
}
