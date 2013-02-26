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
 * 		php app/console orchestra:database:backup C:\xampp\htdocs\symf_lamelee\app\cache\Backup doctrine_backup_database-symflamelee_default.sql
 * 		php app/console orchestra:database:backup /home/www/lamelee-rec/app/cache/Backup
 * </code>
 *
 * @category   Bootstrap_Command
 * @package    Command
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class BackupCommand extends ContainerAwareCommand
{
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

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $path 				= $input->getArgument('path');
        $fileName			= $input->getArgument('filename') ? $input->getArgument('filename') : null;
    	
        $container 			= $this->getContainer();
        $DatabaseManager 	= $container->get('bootstrap.database.factory');
        $output 			= $DatabaseManager->getBackupFactory()->run($output, array('path'=>$path, 'filename'=>$fileName));        
    }
}
