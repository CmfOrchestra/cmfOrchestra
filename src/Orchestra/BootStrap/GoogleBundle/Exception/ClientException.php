<?php
/**
 * This file is part of the <Google> project.
 *
 * @category   BootStrap_Exception
 * @package    Exception
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2011-04-23
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\GoogleBundle\Exception;

/**
 * Extension Exception
 *
 * @category   BootStrap_Exception
 * @package    Exception
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class ClientException extends \Exception
{
	public static function NotFoundException($name)
	{
		return new self(sprintf('Unable to find %s.', $name));
	}
	
	public static function callMethodNotSupported($method)
	{
		return new self(sprintf('Method %s doesn\'t call correctly.', $method));
	}
	
	public static function serviceNotSupported($serviceName)
    {
        return new self(sprintf('The %s service selected is not yet supported.', $serviceName));
    }
    
    public static function clientNotSupported($clienteName, $className)
    {
    	return new self(sprintf('The %s client %s is not yet supported in the bundle %s.', $clienteName, $className));
    }
    
    public static function MethodUnDefined($method)
    {
    	return new self(sprintf('Method %s not defined in the util class !', $method));
    }

    public static function initParameterUndefined($Param)
    {
    	return new self(sprintf('Service parameter (%s) not defined correctly ! ', $Param));
    }    
    
    public static function serviceNotConfiguredCorrectly()
    {
    	return new self('Service not configured correctly.');
    }  

    public static function optionValueNotSpecified($optionName, $className)
    {
    	return new self(sprintf('Option %s not specified in parameters in the class %s ', $optionName, $className));
    }  

    
  
    
}