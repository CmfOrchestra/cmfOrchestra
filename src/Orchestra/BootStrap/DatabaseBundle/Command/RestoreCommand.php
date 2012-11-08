<?php
/**
 * This file is part of the <Database> project.
 *
 * @category   Bootstrap_Command
 * @package    Command
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
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
 * Command to restore a backup of the database.
 * !!! IMPORTANT !!!
 * we have to be connected for restore the databse otherwhise the database server has gone away.
 *
 * <code>
 * 		php app/console orchestra:database:restore C:\xampp\htdocs\symf_orchestra\app\cache\Backup doctrine_backup_database-symforchestra_default.sql
 * 		php app/console orchestra:database:restore /home/www/orchestra/app/cache/Backup doctrine_backup_database-symforchestra_default.sql
 * </code>
 * 
 * @category   Bootstrap_Command
 * @package    Command
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class RestoreCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('orchestra:database:restore')
            ->setDefinition(array(
                new InputArgument('path', InputArgument::OPTIONAL, 'The directory where the restore file will be done.'),
                new InputArgument('filename', InputArgument::OPTIONAL, 'The name for the restore file.')
            ))
            ->setHelp(<<<EOT
The <info>database:restore</info> command restore a backup of a 
database. Note that the database platform 
must be supported by the bundle. Check if the database platform you want 
to generate a backup from is supported.

An example of usage of the command:

<info>./app/console orchestra:database:restore "my-connection-service-id" "/var/tmp" [my_sql_file_name.sql]</info>

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
        $output 			= $DatabaseManager->getRestoreFactory()->run($output, array('path'=>$path, 'filename'=>$fileName));        
    }
}
