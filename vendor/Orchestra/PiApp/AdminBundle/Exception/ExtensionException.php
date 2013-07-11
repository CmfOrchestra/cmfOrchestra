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
 * Extension Exception
 *
 * @category   Admin_Exception
 * @package    Exception
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class ExtensionException extends \Exception
{

	public static function serviceNotSupported($serviceName)
    {
        return new self(sprintf('The %s service selected is not yet supported.', $serviceName));
    }
    
    public static function serviceUndefined($serviceName, $matrixName, $className)
    {
    	return new self(sprintf('The %s service selected is not yet defined in the grid $GLOBALS["%s"] in the class %s.', $serviceName, $matrixName, $className));
    }
    
    public static function MethodUnDefined($method)
    {
    	return new self(sprintf('Method %s not defined in the util class !', $method));
    }
    
    public static function FileUnDefined($file)
    {
    	return new self(sprintf('File %s doesn\'t exist in the web/bundle !', $file));
    }

    public static function initParameterUndefined($Param)
    {
    	return new self(sprintf('Service parameter (%s) not defined correctly ! try like this: "contenaireName:NameServiceValidator"', $Param));
    }    
    
    public static function serviceNotConfiguredCorrectly()
    {
    	return new self('Service not configured correctly.');
    }  

    public static function optionValueNotSpecified($optionName, $className)
    {
    	return new self(sprintf('Option %s not specified in parameters in the class %s ', $optionName, $className));
    }    
    
    public static function renderWidgetMethodUndefined($matrixName)
    {
    	return new self(sprintf('Bad %s render service method !', $matrixName));
    }
    
    public static function IdWidgetUnDefined($id)
    {
    	return new self(sprintf('Id %s widget not defined !', $id));
    }
    
    public static function MethodWidgetUnDefined($method)
    {
    	return new self(sprintf('Method %s widget not defined in the util widget extension class !', $method));
    }   
    
    public static function MediaUnDefined($entity)
    {
    	return new self(sprintf('Entity %s is not \BootStrap\MediaBundle\Entity\Media entity !', get_class($entity)));
    }    
    
  
    
}