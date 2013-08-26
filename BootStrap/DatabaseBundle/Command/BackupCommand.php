<?php
/**
 * This file is part of the <Database> project.
 *
 * @category   Bootstrap_Command
 * @package    Command
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-01
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\DatabaseBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Command to create a new backup of the database.
 *
 * <code>
 *         php app/console orchestra:database:backup app\cache\Backup doctrine_backup_database-symflamelee_default.sql
 *         php app/console orchestra:database:backup app/cache/Backup
 * </code>
 *
 * @category   Bootstrap_Command
 * @package    Command
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class BackupCommand extends ContainerAwareCommand
{
    /**
     * @var \PiApp\AdminBundle\Util\PiLogManager
     */
    private $_logger;
    
    /**
     * Constructor.
     *
     * @param    $kernel    HttpKernelInterface A HttpKernelInterface instance
     * @access    public
     * @author    Etienne de Longeaux <etienne.delongeaux@gmail.com>
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
            ->setName('orchestra:database:backup')
            ->setDefinition(array(
                new InputArgument('path', InputArgument::OPTIONAL, 'The directory where the backup file will be saved.'),
                new InputArgument('filename', InputArgument::OPTIONAL, 'The name for the backup file.')
            ))
            ->setHelp(<<<EOT
The <info>database:backup</info> command generates a backup of a 
database. Note that the database platform 
must be supported by the bundle. Check if the database platform you want 
to generate a backup from is supported.

An example of usage of the command:

<info>./app/console orchestra:database:backup "my-connection-service-id" "/var/tmp" [my_sql_file_name.sql]</info>

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
        $this->_logger    = $this->getContainer()->get('pi_app_admin.log_manager');
        $this->_logger->setPath($this->getContainer()->getParameter("kernel.logs_dir"));
        $this->_logger->setInit('log_databasebundle_backup', date("YmdH"));
        $this->_logger->setInfo(date("Y-m-d H:i:s")." [LOG BACKUP] Begin launch  :");
                
        $path                 = $input->getArgument('path');
        $fileName            = $input->getArgument('filename') ? $input->getArgument('filename') : null;
        
        $container             = $this->getContainer();
        $DatabaseManager     = $container->get('bootstrap.database.factory');
        $output             = $DatabaseManager->getBackupFactory()->run($output, array('path'=>$path, 'filename'=>$fileName));

        //-----we close the logger-----
        $this->_logger->setInfo(date("Y-m-d H:i:s")." [END] End launch");
        $this->_logger->save();        
    }
}