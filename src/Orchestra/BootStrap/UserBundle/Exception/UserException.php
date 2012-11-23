<?php
/**
 * This file is part of the <User> project.
 *
 * @category   BootStrap_Exception
 * @package    Exception
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2011-01-30
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\UserBundle\Exception;

/**
 * Database Exception
 *
 * @category   BootStrap_Exception
 * @package    Exception
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class UserException extends \Exception
{

	public static function serviceNotSupported()
    {
        return new self("The service selected is not yet supported.");
    }
    
    public static function notSupported($method)
    {
    	return new self("Operation '$method' is not supported by platform.");
    }    

}