<?php
/**
 * This file is part of the <User> project.
 *
 * @category BootStrap_phpunit
 * @package PhpUnit
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2013-03-29
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */
namespace BootStrap\DatabaseBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

use BootStrap\UserBundle\Command\RoutesCommand;

/**
 * Default Controller Test
 *
 * @category BootStrap_phpunit
 * @package PhpUnit
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class DefaultControllerTest extends WebTestCase
{
    /**
     * Sets the result of the Restore BDD Command.
     *
     * @return boolean
     * @access public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * 
     * @link http://symfony.com/doc/2.0/components/console/introduction.html#calling-an-existing-command
     */
    public function testCommandeBackup()
    {
    	//$container = $this->getApplication()->getKernel()->getContainer();
    	
    	$kernel = $this->createKernel();
    	$kernel->boot();
    	
    	$application 	= new Application($kernel);
		$application->add(new RoutesCommand($kernel));
		
		//-----we initialize command value-----
		$command 		= $application->find('orchestra:database:backup');  //   --env=test
		$commandTester 	= new CommandTester($command);
		//-----we executes the command-----
		$commandTester->execute(
				array(
						'command' 	=> $command->getName(),
						'path'		=> 'app\cache\Backup',
				)
		);
		
		$this->assertRegExp('/END/', $commandTester->getDisplay());
		
		return true;
    }    
    
    /**
     * Sets the result of the Restore BDD Command.
     *
     * @return boolean
     * @access public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     *
     * @link http://symfony.com/doc/2.0/components/console/introduction.html#calling-an-existing-command
     */
    public function testCommandeRestore()
    {
    	//$container = $this->getApplication()->getKernel()->getContainer();
    	 
    	$kernel = $this->createKernel();
    	$kernel->boot();
    	 
    	$application 	= new Application($kernel);
    	$application->add(new RoutesCommand($kernel));
    
    	//-----we initialize command value-----
    	$command 		= $application->find('orchestra:database:restore');  //   --env=test
    	$commandTester 	= new CommandTester($command);
    	//-----we executes the command-----
    	$commandTester->execute(
    			array(
    					'command' 	=> $command->getName(),
						'path'		=> 'app\cache\Backup',
						'filename'	=> 'doctrine_backup_database-symflamelee_rec_2013-04-04-18-40-23.sql'
    			)
    	);
    
    	$this->assertRegExp('/END/', $commandTester->getDisplay());
    
    	return true;
    }    
}