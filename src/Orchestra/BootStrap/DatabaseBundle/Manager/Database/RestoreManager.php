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

use BootStrap\DatabaseBundle\Manager\Database\AbstractManager;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Database factory for backup database.
 *
 * @category   BootStrap_Manager
 * @package    Database
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class RestoreManager extends AbstractManager
{
	/**
	 * Constructor.
	 *
	 * @param \Doctrine\DBAL\Connection $connection
	 */
    public function __construct(Connection $connection, ContainerInterface $container)
    {
    	parent::__construct($connection, $container);
    }
    
    /**
     * Run the restore database.
     *
     * @param array $options
     * @return \Symfony\Component\Console\Output\OutputInterface
     * @access public
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */
    public function run(OutputInterface $output, Array $options = null)
    {
    	// Execute the drop database command
    	$this->_executeDropDatabase();
    	// Execute the create database command
    	$this->_executeCreateDatabase();
    	// Execute the create table command
    	$this->_executeCreateTable();
    	
    	$this->setOutputWriter($output);
		$this->setDatabase($this->getConnection()->getDatabase());
		$this->setPath($options);
		
    	$data   	= file_get_contents($this->getPath());
		$convert 	= explode("\r\n", $data); //create array separate by new line
		
		for ($i=0;$i<count($convert);$i++)
		{
			$line = $convert[$i];
			$isCommentLine = str_replace("###", "", $line, $count);
			if(!empty($line) && ($count==0) ){
				//$line = stripslashes($line);
				
				$this->getOutputWriter()->writeln(sprintf("  %s ", $line));
				$this->getOutputWriter()->writeln(sprintf("  "));
				$this->getOutputWriter()->writeln(sprintf("  "));
				$this->getOutputWriter()->writeln(sprintf("  "));
				
				$this->getConnection()->executeQuery($line);
			}
		}

		try {
			$this->getConnection()->commit();
			$this->getOutputWriter()->writeln(sprintf('<comment>></comment> <info>Restoring the database was successfully with the file "%s".</info>', $options['filename']));
		} catch (\Exception $e) {
			$this->getOutputWriter()->writeln(sprintf('<comment>></comment> <info>Restoring the database failed with the file "%s".</info>', $options['filename']));
		}
		
		return $this->getOutputWriter();
    }  


	// split_sql_file will split an uploaded sql file into single sql statements.
	// Note: expects trim() to have already been run on $sql.
	//
	private function split_sql_file($sql, $delimiter)
	{
	   // Split up our string into "possible" SQL statements.
	   $tokens = explode($delimiter, $sql);
	
	   // try to save mem.
	   $sql = "";
	   $output = array();
	
	   // we don't actually care about the matches preg gives us.
	   $matches = array();
	
	   // this is faster than calling count($oktens) every time thru the loop.
	   $token_count = count($tokens);
	   for ($i = 0; $i < $token_count; $i++)
	   {
	      // Don't wanna add an empty string as the last thing in the array.
	      if (($i != ($token_count - 1)) || (strlen($tokens[$i] > 0)))
	      {
	         // This is the total number of single quotes in the token.
	         $total_quotes = preg_match_all("/'/", $tokens[$i], $matches);
	         // Counts single quotes that are preceded by an odd number of backslashes,
	         // which means they're escaped quotes.
	         $escaped_quotes = preg_match_all("/(?<!\\\\)(\\\\\\\\)*\\\\'/", $tokens[$i], $matches);
	
	         $unescaped_quotes = $total_quotes - $escaped_quotes;
	
	         // If the number of unescaped quotes is even, then the delimiter did NOT occur inside a string literal.
	         if (($unescaped_quotes % 2) == 0)
	         {
	            // It's a complete sql statement.
	            $output[] = $tokens[$i];
	            // save memory.
	            $tokens[$i] = "";
	         }
	         else
	         {
	            // incomplete sql statement. keep adding tokens until we have a complete one.
	            // $temp will hold what we have so far.
	            $temp = $tokens[$i] . $delimiter;
	            // save memory..
	            $tokens[$i] = "";
	
	            // Do we have a complete statement yet?
	            $complete_stmt = false;
	
	            for ($j = $i + 1; (!$complete_stmt && ($j < $token_count)); $j++)
	            {
	               // This is the total number of single quotes in the token.
	               $total_quotes = preg_match_all("/'/", $tokens[$j], $matches);
	               // Counts single quotes that are preceded by an odd number of backslashes,
	               // which means they're escaped quotes.
	               $escaped_quotes = preg_match_all("/(?<!\\\\)(\\\\\\\\)*\\\\'/", $tokens[$j], $matches);
	
	               $unescaped_quotes = $total_quotes - $escaped_quotes;
	
	               if (($unescaped_quotes % 2) == 1)
	               {
	                  // odd number of unescaped quotes. In combination with the previous incomplete
	                  // statement(s), we now have a complete statement. (2 odds always make an even)
	                  $output[] = $temp . $tokens[$j];
	
	                  // save memory.
	                  $tokens[$j] = "";
	                  $temp = "";
	
	                  // exit the loop.
	                  $complete_stmt = true;
	                  // make sure the outer loop continues at the right point.
	                  $i = $j;
	               }
	               else
	               {
	                  // even number of unescaped quotes. We still don't have a complete statement.
	                  // (1 odd and 1 even always make an odd)
	                  $temp .= $tokens[$j] . $delimiter;
	                  // save memory.
	                  $tokens[$j] = "";
	               }
	
	            } // for..
	         } // else
	      }
	   }
	
	   return $output;
	}
    

}