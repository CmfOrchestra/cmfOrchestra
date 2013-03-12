<?php
/**
 * This file is part of the <User> project.
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
namespace BootStrap\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use BootStrap\UserBundle\DependencyInjection\Compiler\AddDependencyRoute;

/**
 * BootStrap configuration and managment Bundle
 *
 * @category   Bundle
 * @package    BootStrap
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class BootStrapUserBundle extends Bundle
{
	const HTTP_TYPE = "http";
	
	public function getParent()
	{
		return 'FOSUserBundle';
	}	
	
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
		//print_r('UserBundle-PiApptest1   ');
		
		// we add all route pages.
		$container->addCompilerPass(new AddDependencyRoute());
		
		// we get the heritage.jon file if it's created
		$path_heritages_file 		= realpath($container->getParameter("kernel.cache_dir"). '/../heritage.json');
		if($path_heritages_file){
			$roles_json = file_get_contents($path_heritages_file);
		}else
			$roles_json = '';
		
		$heritage_role  = json_decode($roles_json);
		if(is_object($heritage_role)){
			$heritage_role  = get_object_vars($heritage_role->HERITAGE_ROLES);
		}else{
			$heritage_role  = array(
					'ROLE_SUBSCRIBER'       => array('ROLE_ALLOWED_TO_SWITCH'),
					'ROLE_MEMBER'	        => array('ROLE_SUBSCRIBER', 'ROLE_ALLOWED_TO_SWITCH'),
						
					'ROLE_USER'       		=> array('ROLE_ALLOWED_TO_SWITCH'),
						
					'ROLE_EDITOR'      		=> array('ROLE_MEMBER', 'ROLE_USER', 'ROLE_ALLOWED_TO_SWITCH'),
					'ROLE_MODERATOR'   		=> array('ROLE_EDITOR',  'ROLE_ALLOWED_TO_SWITCH'),
						
					'ROLE_DESIGNER'      	=> array('ROLE_MEMBER', 'ROLE_USER', 'ROLE_ALLOWED_TO_SWITCH'),
			
					'ROLE_CONTENT_MANAGER'  => array('ROLE_DESIGNER', 'ROLE_MODERATOR', 'ROLE_ALLOWED_TO_SWITCH'),
					'ROLE_ADMIN'       		=> array('ROLE_CONTENT_MANAGER', 'ROLE_ALLOWED_TO_SWITCH'),
			
					'SONATA'		   		=> array('ROLE_SONATA_PAGE_ADMIN_PAGE_EDIT ', 'ROLE_SONATA_PAGE_ADMIN_BLOCK_EDIT', 'ROLE_ALLOWED_TO_SWITCH'),
			
					'ROLE_SUPER_ADMIN' 		=> array('ROLE_ADMIN', 'ROLE_ALLOWED_TO_SWITCH', 'ROLE_SONATA_ADMIN', 'SONATA'),
			);
		}
		//print_r($heritage_role);exit;

		// Security
		$container->loadFromExtension('security', array(
				'role_hierarchy' => $heritage_role,
				'providers' => array(
						'in_memory' => array(
								'users' => array(
										'etienne' => array('password' => 'coincoin', 'roles' => 'ROLE_USER'),
										'admin'   => array('password' => 'adminpsw', 'roles' => 'ROLE_ADMIN'),
								),
						),
						#
						# the bundle's packaged user provider service available
						# The id of the bundle's user provider service is fos_user.user_manager.
						#
						'fos_userbundle' => array(
						'id'			 => 'fos_user.user_manager'
						),	
				),
				#
				# The access_control section is where you specify the credentials necessary for users trying to access specific parts of your application.
				#
				'access_control' => array(
						#
						#  The bundle requires that the login form and all the routes used to create a user
						#  and reset the password be available to unauthenticated users but use the same firewall
						#  as the pages you want to secure with the bundle. This is why you have specified that
						#  the any request matching the /login pattern or starting with /register or /resetting have been made available to anonymous users.
						#  You have also specified that any request beginning with /admin will require a user to have the ROLE_ADMIN role.
						#
		
						# The WDT has to be allowed to anonymous users to avoid requiring the login with the AJAX request
						array('path' => '^/_wdt/', 'role' => 'IS_AUTHENTICATED_ANONYMOUSLY'),
						array('path' => '^/_profiler/', 'role' => 'IS_AUTHENTICATED_ANONYMOUSLY'),
						# AsseticBundle paths used when using the controller for assets
						array('path' => '^/js/', 'role' => 'IS_AUTHENTICATED_ANONYMOUSLY'),
						array('path' => '^/css/', 'role' => 'IS_AUTHENTICATED_ANONYMOUSLY'),
						# URL of FOSUserBundle which need to be available to anonymous users
						array('path' => '^/login$', 'role' => 'IS_AUTHENTICATED_ANONYMOUSLY', 'requires_channel' => self::HTTP_TYPE),
						array('path' => '^/login_check$', 'role' => 'IS_AUTHENTICATED_ANONYMOUSLY', 'requires_channel' => self::HTTP_TYPE),
						array('path' => '^/user/change-password$', 'role' => 'IS_AUTHENTICATED_ANONYMOUSLY', 'requires_channel' => self::HTTP_TYPE),
						array('path' => '^/user/profile$', 'role' => 'IS_AUTHENTICATED_ANONYMOUSLY', 'requires_channel' => self::HTTP_TYPE),
						array('path' => '^/user/profile/edit$', 'role' => 'IS_AUTHENTICATED_ANONYMOUSLY', 'requires_channel' => self::HTTP_TYPE),
						array('path' => '^/user/register$', 'role' => 'IS_AUTHENTICATED_ANONYMOUSLY', 'requires_channel' => self::HTTP_TYPE),
						array('path' => '^/user/register/check-email$', 'role' => 'IS_AUTHENTICATED_ANONYMOUSLY', 'requires_channel' => self::HTTP_TYPE),
						array('path' => '^/user/register/confirm/', 'role' => 'IS_AUTHENTICATED_ANONYMOUSLY', 'requires_channel' => self::HTTP_TYPE),
						array('path' => '^/user/register/confirmed$', 'role' => 'IS_AUTHENTICATED_ANONYMOUSLY', 'requires_channel' => self::HTTP_TYPE),
						array('path' => '^/user/resseting/request$', 'role' => 'IS_AUTHENTICATED_ANONYMOUSLY', 'requires_channel' => self::HTTP_TYPE),
						array('path' => '^/user/resseting/send-email$', 'role' => 'IS_AUTHENTICATED_ANONYMOUSLY', 'requires_channel' => self::HTTP_TYPE),
						array('path' => '^/user/resseting/check-email$', 'role' => 'IS_AUTHENTICATED_ANONYMOUSLY', 'requires_channel' => self::HTTP_TYPE),
						array('path' => '^/user/resseting/reset/', 'role' => 'IS_AUTHENTICATED_ANONYMOUSLY', 'requires_channel' => self::HTTP_TYPE),
						# -> custom access control for the admin area of the URL
						array('path' => '^/admin/', 'role' => 'ROLE_USER', 'requires_channel' => self::HTTP_TYPE),
						array('path' => '^/adminsonata/', 'role' => 'ROLE_SUPER_ADMIN', 'requires_channel' => self::HTTP_TYPE),
						# PAGES ACCESSIBLES A TOUS
						array('path' => '^/.*', 'role' => 'IS_AUTHENTICATED_ANONYMOUSLY', 'requires_channel' => 'http'),
				),				
		));
		
	}
	
	/**
	 * Boots the Bundle.
	 */
	public function boot()
	{
	}
	
	/**
	 * Shutdowns the Bundle.
	 */
	public function shutdown()
	{
	}
	
}
