<?php
/**
 * This file is part of the <Database> project.
 *
 * @category   BootStrap_Manager
 * @package    Database
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-06-28
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\DatabaseBundle\Manager\Database;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\DBAL\Connection;
use Symfony\Component\Console\Output\OutputInterface;
use BootStrap\DatabaseBundle\Manager\Database\AbstractManager;

/**
 * Database factory for backup database with the BackupSqlite platform.
 *
 * @category   BootStrap_Manager
 * @package    Database
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class BackupSqlitePlatform extends AbstractManager
{
	/**
	 * Constructor.
	 *
	 * @param \Doctrine\DBAL\Connection $connection
	 * @param \Symfony\Component\DependencyInjection\ContainerInterface;
	 * 
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 */
    public function __construct(Connection $connection, ContainerInterface $container)
    {
    	parent::__construct($connection, $container);
    }
    
    /**
     * Print in the content file the query for disable all foreign keys
     *
     * @return void
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-06-28
     */
    protected function disableForeignKeys(){
    	
    }
    
    /**
     * Print in the content file the query for enabled all foreign keys
     *
     * @return void
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-06-28
     */
    protected function EnabledForeignKeys(){
    	
    }

}