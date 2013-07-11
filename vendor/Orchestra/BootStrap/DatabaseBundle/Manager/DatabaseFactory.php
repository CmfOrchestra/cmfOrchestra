<?php
/**
 * This file is part of the <Database> project.
 *
 * @category   BootStrap_Manager
 * @package    Database
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-02-03
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\DatabaseBundle\Manager;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\DBAL\Platforms\DB2Platform;
use Doctrine\DBAL\Platforms\DrizzlePlatform;
use Doctrine\DBAL\Platforms\MySqlPlatform;
use Doctrine\DBAL\Platforms\OraclePlatform;
use Doctrine\DBAL\Platforms\PostgreSqlPlatform;
use Doctrine\DBAL\Platforms\SqlitePlatform;
use Doctrine\DBAL\Platforms\SQLServerPlatform;
use Doctrine\DBAL\Platforms\SQLServer2005Platform;
use Doctrine\DBAL\Platforms\SQLServer2008Platform;

use BootStrap\TranslationBundle\Route\AbstractFactory;
use BootStrap\DatabaseBundle\Exception\DatabaseException;

use BootStrap\DatabaseBundle\Manager\Database\BackupDB2Platform;
use BootStrap\DatabaseBundle\Manager\Database\BackupDrizzlePlatform;
use BootStrap\DatabaseBundle\Manager\Database\BackupMySqlPlatform;
use BootStrap\DatabaseBundle\Manager\Database\BackupOraclePlatform;
use BootStrap\DatabaseBundle\Manager\Database\BackupPostgreSqlPlatform;
use BootStrap\DatabaseBundle\Manager\Database\BackupSqlitePlatform;
use BootStrap\DatabaseBundle\Manager\Database\BackupSQLServerPlatform;

use BootStrap\DatabaseBundle\Manager\Database\RestoreManager as Restore;
use BootStrap\DatabaseBundle\Builder\DatabaseFactoryInterface;

/**
 * Database factory for backup, restore, ... database.
 *
 * @category   BootStrap_Manager
 * @package    Database
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class DatabaseFactory extends AbstractFactory implements DatabaseFactoryInterface
{
	/**
	 * Constructor.
	 *
	 * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
	 */
	public function __construct(ContainerInterface $container)
	{
		parent::__construct($container);
	}
    
	/**
	 * Return the backup factory.
	 *
	 * @return \BootStrap\DatabaseBundle\Manager\Database\AbstractManager
	 * @access public
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-02-03
	 */	
    public function getBackupFactory()
    {
        static $instance;
        if (!isset($instance))
        {
        	// we get the DatabasePlatform for the connection.
        	$platform	= $this->getDatabasePlatform();
        	
	        switch (true) {
	        	case ($platform instanceof MySqlPlatform) :
	        		$instance =  new BackupMySqlPlatform($this->getConnection(), $this->getContainer());
	        		break;
	        	case ($platform instanceof OraclePlatform) :
	        		$instance =  new BackupOraclePlatform($this->getConnection(), $this->getContainer());
	        		break;
        		case ( ($platform instanceof SQLServerPlatform) || ($platform instanceof SQLServer2005Platform) || ($platform instanceof SQLServer2008Platform)):
        			$instance =  new BackupSQLServerPlatform($this->getConnection(), $this->getContainer());
        			break;
       			case ($platform instanceof PostgreSqlPlatform) :
       				$instance =  new BackupPostgreSqlPlatform($this->getConnection(), $this->getContainer());
       				break;
// 	        	case ($platform instanceof DB2Platform ):
// 	        		$instance =  new BackupDB2Platform($this->getConnection(), $this->getContainer());
// 	        		break;
// 	        	case ($platform instanceof DrizzlePlatform) :
// 	        		$instance =  new BackupDrizzlePlatform($this->getConnection(), $this->getContainer());
// 	        		break;
// 	        	case ($platform instanceof SqlitePlatform) :
// 	        		$instance =  new BackupSqlitePlatform($this->getConnection(), $this->getContainer());
// 	        		break;
	        	default :
	        		throw DatabaseException::databasePlatformNotSupported();
	        		break;
	        }	        
	        
        }
        
        return $instance;        
    }
    
    /**
     * Return the Restore factory.
     *
     * @return \BootStrap\DatabaseBundle\Manager\Database\AbstractManager
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */    
    public function getRestoreFactory()
    {
        static $instance;
        if (!isset($instance))
        {
        	// we get the DatabasePlatform for the connection.
        	$platform	= $this->getDatabasePlatform();
        	
	        switch (true) {
	        	case ($platform instanceof DB2Platform ):
	        		$instance =  new Restore($this->getConnection(), $this->getContainer());
	        		break;
	        	case ($platform instanceof DrizzlePlatform) :
	        		$instance =  new Restore($this->getConnection(), $this->getContainer());
	        		break;
	        	case ($platform instanceof MySqlPlatform) :
	        		$instance =  new Restore($this->getConnection(), $this->getContainer());
	        		break;
	        	case ($platform instanceof OraclePlatform) :
	        		$instance =  new Restore($this->getConnection(), $this->getContainer());
	        		break;
	        	case ($platform instanceof PostgreSqlPlatform) :
	        		$instance =  new Restore($this->getConnection(), $this->getContainer());
	        		break;
	        	case ($platform instanceof SqlitePlatform) :
	        		$instance =  new Restore($this->getConnection(), $this->getContainer());
	        		break;
        		case ( ($platform instanceof SQLServerPlatform) || ($platform instanceof SQLServer2005Platform) || ($platform instanceof SQLServer2008Platform)):
        			$instance =  new Restore($this->getConnection(), $this->getContainer());
        			break;
	        	default :
	        		throw DatabaseException::databasePlatformNotSupported();
	        		break;
	        }
	         
        }
        
        return $instance;        
     }
	
}