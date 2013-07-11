<?php
/**
 * This file is part of the <Translation> project.
 *
 * @category   Bootstrap_Command
 * @package    Command
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-01
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\TranslationBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Command to parse all routes and register them in the database.
 * 
 * <code>
 * 		php app/console orchestra:database:routes:parse
 * </code>
 * 
 * @category   Bootstrap_Command
 * @package    Command
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class RoutesCommand extends ContainerAwareCommand
{
	/**
	 * @var \PiApp\AdminBundle\Util\PiLogManager
	 */
	private $_logger;
	
	/**
	 * Constructor.
	 *
	 * @param	$kernel	HttpKernelInterface A HttpKernelInterface instance
	 * @access	public
	 * @author	Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public function __construct($kernel = null)
	{
		parent::__construct();
	
		//-----we initialize the container-----
		if (is_object($kernel) && method_exists($kernel, 'getContainer'))
			$this->setContainer($kernel->getContainer());
	}
	
	/**
	 * configure the command.
	 *
	 * @return void
	 * @access protected
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */	
    protected function configure()
    {
        $this
            ->setName('orchestra:database:routes:parse')
            ->setHelp(<<<EOT
The <info>database:routes:parse</info> command parse all routes and register them in the database.
An example of usage of the command:

<info>php app/console database:routes:parse </info>

EOT
            )
        ;
    }

    /**
     * Execute the command.
     *
     * @return void
     * @access protected
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
    	//-----we initialize the logger-----
    	$this->_logger	= $this->getContainer()->get('pi_app_admin.log_manager');
    	$this->_logger->setPath($this->getContainer()->getParameter("kernel.logs_dir"));
    	$this->_logger->setInit('log_userbundle_route', date("YmdH"));
    	$this->_logger->setInfo(date("Y-m-d H:i:s")." [LOG ROUTE] Begin launch  :");
    	    	
        foreach ($this->getAllRoutes() as $name => $route){
        	$output->writeln(sprintf('<comment>></comment> <info>parsing route : </info>'));
        	$output->writeln(sprintf('<info>pattern			%s </info>', $route->getPattern() ));
        	$output->writeln(sprintf('<info>regex 			%s </info>', $route->getRegex() ));
//        	$output->writeln(sprintf('<info>route		  	%s </info>', $route->getRoute()));
        	$output->writeln(sprintf('<info>static prefix 	%s </info>', $route->getStaticPrefix()));
//        	$output->writeln(sprintf('<info>tokens	  		%s </info>', implode('- ',$route->getTokens()) ));
        	$output->writeln(sprintf('<info>variables  		%s </info>', implode('- ',$route->getVariables()) ));
        	$output->writeln(sprintf('<info>options  		%s </info>', implode('- ',$route->getOptions()) ));
        	$output->writeln(sprintf('<info>defaults  		%s </info>', implode('- ',$route->getDefaults()) ));
        	$output->writeln(sprintf('<info>requirements	%s </info>', implode('- ',$route->getRequirements()) ));
        	$output->writeln(sprintf('<info></info>'));
        }
        
        //-----we close the logger-----
        $this->_logger->setInfo(date("Y-m-d H:i:s")." [END] End launch");
        $this->_logger->save();        
    }
    
    /**
     * @return array
     */
    private function getAllRoutes()
    {
    	$routeCollection = $this->getContainer()->get('router')->getRouteCollection();
    	$routes = array();
    
    	foreach ($routeCollection->all() as $name => $route) {
    		$routes[$name] = $route->compile();
    	}
    
    	return $routes;
    }      
}