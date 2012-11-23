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
namespace BootStrap\DatabaseBundle\Manager\Database;

/**
 * Simple class for outputting information.
 *
 * @category   BootStrap_Manager
 * @package    Database
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class OutputWriter
{
	/**
	 * @var \Closure
	 */	
    private $closure;

    /**
     * Constructor
     *
     * @var \Closure $closure
     */    
    public function __construct(\Closure $closure = null)
    {
        if ($closure === null) {
            $closure = function($message) {};
        }
        $this->closure = $closure;
    }

    /**
     * Write output using the configured closure.
     *
     * @param string $message  The message to write.
     * 
     * @return void
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-03
     */
    public function write($message)
    {
        $closure = $this->closure;
        $closure($message);
    }
}