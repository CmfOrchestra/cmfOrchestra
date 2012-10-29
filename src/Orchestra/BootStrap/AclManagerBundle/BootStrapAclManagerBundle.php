<?php
/**
 * This file is part of the <Acl> project.
 *
 * @category   Bundle
 * @package    BootStrap
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\AclManagerBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Acl managment Bundle
 *
 * @category   Bundle
 * @package    BootStrap
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class BootStrapAclManagerBundle extends Bundle 
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
		
		// app/config/security.php
		# any name configured in doctrine.dbal section
		# $container->loadFromExtension('security', 'acl', array(
		#		'connection' => 'default',
		# ));		
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
