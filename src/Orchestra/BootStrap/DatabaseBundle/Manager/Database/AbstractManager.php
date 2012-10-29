<?php
/**
 * This file is part of the <Database> project.
 *
 * @category   BootStrap_Manager
 * @package    Database
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-02-03
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\DatabaseBundle\Manager\Database;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\DBAL\Connection;
use Symfony\Component\Console\Output\OutputInterface;
use BootStrap\DatabaseBundle\Builder\DatabaseManagerInterface;
use BootStrap\DatabaseBundle\Exception\DatabaseException;

/**
 * Database factory for backup database.
 *
 * @category   BootStrap_Manager
 * @package    Database
 * @abstract
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
abstract class AbstractManager implements DatabaseManagerInterface
{
	/**
	 * SQL Delimitor of the end of a new line.
	 */
	const DELIMITOR_END_SQL_LINE = "  \n  ";
	
	/**
	 * Delimitor of the strat of a comment line.
	 */
	const DELIMITOR_START_COMMENT_LINE = "### COMMENT ###";	
	
	/**
	 * OutputWriter instance for writing output during backup
	 *
	 * @var \Symfony\Component\Console\Output\OutputInterface
	 */
	private $outputWriter;
	
	/**
	 * @var string content file of the backup.
	 */
	protected $contentFile = '';
	
		
	/**
	 * @var \Symfony\Component\DependencyInjection\ContainerInterface
	 */
	private $container;
		
	/**
	 * @var \Doctrine\DBAL\Connection
	 */
    private $connection;

    /**
     * @var string database name of the backup operation.
     */
    private $databaseName = '';  

    /**
     * @var string database path of the backup file.
     */
    private $path = '';    
    
	/**
	 * Constructor.
	 *
	 * @param \Doctrine\DBAL\Connection $connection
	 * 
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 */
    public function __construct(Connection $connection, ContainerInterface $container)
    {
    	$this->container = $container;    	
        $this->setConnection($connection);
    }

    /**
     * Run the backup/restore database.
     *
     * @param \Symfony\Component\Console\Output\OutputInterface
     * @param array $options
     * @return \Symfony\Component\Console\Output\OutputInterface
     * @access public
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */
    public function run(OutputInterface $output, Array $options = null){
    	throw DatabaseException::notSupported(__METHOD__);
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
    	throw DatabaseException::notSupported(__METHOD__);
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
    	throw DatabaseException::notSupported(__METHOD__);
    }   

    /**
     * Sets the head of the backup file.
     *
     * @return void
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */
    protected function _setHead()
    {
    	$this->contentFile  .= sprintf("###################################### \r\n");
    	$this->contentFile  .= sprintf("### Doctrine Backup File Generated on %s \r\n", date('Y-m-d H:m:s'));
    	$this->contentFile  .= sprintf("### Backup DATABASE %s \r\n", $this->getDatabase() );
    	$this->contentFile  .= sprintf("###################################### \r\n");
    	$this->disableForeignKeys();
    
    	$this->getOutputWriter()->writeln(sprintf('Writing head file information to "<info>%s</info>" ABOUT THE database %s \n', $this->getPath(), $this->getDatabase()));
    }
    
    /**
     * Sets the footer of the backup file.
     *
     * @return void
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */
    protected function _setFooter()
    {
    	$this->EnabledForeignKeys();
    	$this->getOutputWriter()->writeln(sprintf('Writing footer file information to "<info>%s</info>" ABOUT THE database %s \n', $this->getPath(), $this->getDatabase()));
    }
    
    /**
     * Execute the drop database command
     *
     * @return string		status of the executed command
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */
    protected function _executeDropDatabase()
    {
    	return exec(sprintf('php app/console doctrine:database:drop --force'));
    } 

    /**
     * Execute the create database command
     *
     * @return string		status of the executed command
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */
    protected function _executeCreateDatabase()
    {
    	return exec(sprintf('php app/console doctrine:database:create'));
    }  

    /**
     * Execute the create table command
     *
     * @return string		status of the executed command
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */
    protected function _executeCreateTable()
    {
    	return exec(sprintf('php app/console doctrine:schema:create'));
    }    
    
    /**
     * Write in the content file all selected rows of a table.
     *
     * @return void
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */
    protected function _writeSelectTable($tableName)
    {
    	// Gets all columns of the table.
    	$colomns = $this->getColumns($tableName);
    	
    	// Gets all rows of a the table.
    	$query	= $this->createQueryBuilder('u')
    	->select('*')
    	->from($tableName, 'u');
    	$rows = $query->execute()->fetchAll(); //$rows = $this->getConnection()->executeQuery($query->getSQL())->fetchAll();
    
    	// Register all insert result query
    	foreach($rows as $key => $row){
    		//Applies the addslashes callback to the elements of the given arrays
    		$row = array_map('addslashes', $row);
    		
   			$all_values = null;
   			$all_colName= null;
    		foreach($colomns as $col => $col_obj){
    			$col_details   = $col_obj->toArray();
    			$colName	   = $col_details['name'];
    			$all_colName[] = $col_details['name'];
    			$type		   = $col_details['type'];
    			
    			if(isset($row[$colName])){
    				$row[$colName] = str_replace("\n", '\n', $row[$colName]);
    				$row[$colName] = str_replace("\r", '\r', $row[$colName]);
	    			switch (true) {
	    				case ( ($type instanceof \Doctrine\DBAL\Types\StringType) 
	    						|| ($type instanceof \Doctrine\DBAL\Types\TextType)
	    						|| ($type instanceof \Doctrine\DBAL\Types\ArrayType)
	    					) :
	    					if(!empty($row[$colName]))
								$all_values[] =  "'" .$row[$colName] . "'";
	    					else
	    						$all_values[] =  'NULL';
	    					break;
	    				case ( ($type instanceof \Doctrine\DBAL\Types\DateTimeType)
	    						|| ($type instanceof \Doctrine\DBAL\Types\DateTimeTzType)
	    						|| ($type instanceof \Doctrine\DBAL\Types\DateType)
	    						|| ($type instanceof \Doctrine\DBAL\Types\TimeType)
	    					) :
	    					if(!empty($row[$colName]))
								$all_values[] =  "'" .$row[$colName] . "'";
	    					else
	    						$all_values[] =  'NULL';
	    					break;
	    				case (($type instanceof \Doctrine\DBAL\Types\BigIntType) 
	    						|| ($type instanceof \Doctrine\DBAL\Types\SmallIntType)
	    						|| ($type instanceof \Doctrine\DBAL\Types\IntegerType)
	    						|| ($type instanceof \Doctrine\DBAL\Types\FloatType)
	    						|| ($type instanceof \Doctrine\DBAL\Types\DecimalType)
	    					) :
	    					if(!empty($row[$colName]))
	    						$all_values[] =  $row[$colName];
	    					else
	    						$all_values[] =  'NULL';
	    					break;
	    				case ($type instanceof \Doctrine\DBAL\Types\BooleanType) :
	    					if(!empty($row[$colName]))
	    						$all_values[] =  $row[$colName];
	    					else
	    						$all_values[] =  '0';
	    					break;
	    				case (is_numeric($row[$colName])) :
	    					if(!empty($row[$colName]))
	    						$all_values[] =  $row[$colName];
	    					else
	    						$all_values[] =  'NULL';
	    					break;
	    				default :
	    					$all_values[] =  "'" .$row[$colName] . "'";
	    					break;
	    			}
    			}
    		}
    		$this->contentFile  .= sprintf("INSERT INTO %s (`%s`) VALUES(%s); \r\n", $tableName,  implode("`, `", $all_colName), implode(", ", $all_values));
    	}
    	
    	$this->contentFile  .= sprintf("\r\n");
    	
    	$this->getOutputWriter()->writeln(sprintf('Writing select lines of the table ', $tableName));
    }
    
    /**
     * Gets container.
     *
     * @return \Symfony\Component\DependencyInjection\ContainerInterface
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */
    protected function getContainer()
    {
    	return $this->container;
    }    

    /**
     * Sets the connection service.
     *
     * @param \Doctrine\DBAL\Connection $connection
     * @return void
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */    
    protected function setConnection(Connection $connection)
    {
        $this->connection = $connection;
    }
    
    /**
     * Sets the Output object.
     *
     * @param \Symfony\Component\Console\Output\OutputInterface
     * @return void
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */
    protected function setOutputWriter(OutputInterface $output)
    {
    	$this->outputWriter = $output;
    } 

    /**
     * Gets the Output object.
     *
     * @return \Symfony\Component\Console\Output\OutputInterface
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */
    protected function getOutputWriter()
    {
    	return $this->outputWriter;
    }    

    /**
     * Gets the connection service
     *
     * @return \Doctrine\DBAL\Connection
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */    
    protected function getConnection()
    {
        return $this->connection;
    }
    
    /**
     * Sets the database value.
     * 
     * @param string $database	Database name
     * @return void
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */    
    protected function setDatabase($database)
    {
    	$this->databaseName = $database;
    }   

    /**
     * Gets the database value.
     * 
     * @return void
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */    
    protected function getDatabase()
    {
    	return $this->databaseName;
    }    
    
    /**
     * Gets the getDatabasePlatform service of the connexion
     *
     * @return \Doctrine\DBAL\Platforms\AbstractPlatform
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */
    protected function getDatabasePlatform()
    {
    	return $this->getConnection()->getDatabasePlatform();
    }   

    /**
     * Gets the getSchemaManager service of the connexion
     *
     * @return \Doctrine\DBAL\Schema\AbstractSchemaManager
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */
    protected function getSchemaManager()
    {
    	return $this->getConnection()->getSchemaManager();
    }   

    /**
     * Gets the createQueryBuilder service of the connexion
     *
     * @return \Doctrine\DBAL\Query\QueryBuilder
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */
    protected function createQueryBuilder()
    {
    	return $this->getConnection()->createQueryBuilder();
    }   
    
    /**
     * Sets the the path where will be write the backup file.
     * 
     * @param array $options
     * @return void
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */
    protected function setPath(Array $options = null)
    {
    	if( isset($options['path']) && !empty($options['path']) )
    		$path = $options['path'];
    	else
    		$path = $this->getContainer()->get('kernel')->getRootDir() . '\cache\Backup';
    	
    	if( isset($options['filename']) && !empty($options['filename']) )
    		$filename = '/' . $options['filename'];
    	else
    		$filename = '/doctrine_backup_database-' . $this->getDatabase() . '_' . date('Y-m-d-H-i-s') . '.sql';
    	
    	if (is_dir($path)) {
    		$this->path = realpath($path);
    		$this->path = $this->path . $filename;
    	}
    }

    /**
     * Gets the database value.
     *
     * @return void
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */
    protected function getPath()
    {
    	return $this->path;
    } 

    /**
     * Gets all details of a table.
     *
     * @access protected
     * @param  string		$nameTable		Nom de la table.
     * @return \Doctrine\DBAL\Schema\Table
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-06-29
     */
    protected function getTableDetails($nameTable)
    {
    	return $this->getSchemaManager()->listTableDetails($nameTable);
    }
    
    /**
     * Gets all indexes of a table.
     *
     * @access protected
     * @param  string		$nameTable		Nom de la table.
     * @return array		les clés primaires de la table.
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-06-29
     */
    protected function getIndexes($nameTable)
    {
    	$listTableDetails = $this->getSchemaManager()->listTableDetails($nameTable);
    	return $listTableDetails->getIndexes();
    }
    
    /**
     * Gets all Foreign Keys of a table.
     *
     * @access protected
     * @param  string		$nameTable		Nom de la table.
     * @return \Doctrine\DBAL\Schema\ForeignKeyConstraint|array
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-06-29
     */
    protected function getForeignKeys($nameTable)
    {
    	$listTableDetails = $this->getSchemaManager()->listTableDetails($nameTable);
    	return $listTableDetails->getForeignKeys();
    }
    
    /**
     * Gets all columns of a table.
     *
     * @access protected
     * @param  string		$nameTable
     * @return \Doctrine\DBAL\Schema\Column|array
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-06-29
     */
    protected function getColumns($nameTable)
    {
    	$listTableDetails = $this->getSchemaManager()->listTableDetails($nameTable);
    	return $listTableDetails->getColumns();
    }    


}