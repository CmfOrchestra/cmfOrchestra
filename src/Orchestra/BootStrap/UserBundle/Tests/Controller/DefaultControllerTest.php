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
namespace BootStrap\UserBundle\Tests\Controller;

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
     * Sets the result of the route Command.
     *
     * @return boolean
     * @access public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * 
     * @link http://symfony.com/doc/2.0/components/console/introduction.html#calling-an-existing-command
     */
    public function testCommandeRoute()
    {
    	//$container = $this->getApplication()->getKernel()->getContainer();
    	
    	$kernel = $this->createKernel();
    	$kernel->boot();
    	
    	$application 	= new Application($kernel);
		$application->add(new RoutesCommand($kernel));
		
		//-----we initialize command value-----
		$command 		= $application->find('orchestra:database:routes:parse');  //   --env=test
		$commandTester 	= new CommandTester($command);
		//-----we executes the command-----
		$commandTester->execute(
				array(
						'command' 	=> $command->getName(),
						//'arg1'		=> 'val1',
						//'arg2'		=> 'val2'
				)
		);
		
		$this->assertRegExp('/END/', $commandTester->getDisplay());
		
		return true;
    }    
}
