<?php
/**
 * This file is part of the <Translation> project.
 *
 * @category   Bundle
 * @package    BootStrap
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
namespace BootStrap\TranslationBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * BootStrap configuration and managment of the translation Bundle
 *
 * @category   Bundle
 * @package    BootStrap
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class BootStrapTranslationBundle extends Bundle
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
	 */
	public function build(ContainerBuilder $container)
	{
		parent::build($container);
		//print_r('PiApptest1');
	}
	
	/**
	 * Boots the Bundle.
	 */
	public function boot()
	{
		//print_r('PiApptest2');
	}	
	
	/**
	 * Shutdowns the Bundle.
	 */
	public function shutdown()
	{
	}	
			
}
