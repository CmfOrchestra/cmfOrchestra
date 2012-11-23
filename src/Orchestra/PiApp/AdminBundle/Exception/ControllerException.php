<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Exception
 * @package    Exception
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2011-02-10
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Exception;

/**
 * Controller Exception
 *
 * @category   Admin_Exception
 * @package    Exception
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class ControllerException extends \Exception
{

	public static function NotFoundException($entity)
    {
        return new self(sprintf('Unable to find %s entity.', $entity));
    }
    
    public static function NotFoundOptionException($option)
    {
    	return new self(sprintf('Unable to find %s option.', $option));
    }    
    
    public static function callMethodNotSupported($method)
    {
    	return new self(sprintf('Method %s doesn\'t call correctly.', $method));
    }   

    public static function callAjaxOnlySupported($method)
    {
    	return new self(sprintf('The method %s can be called only in ajax..', $method));
    }    

}