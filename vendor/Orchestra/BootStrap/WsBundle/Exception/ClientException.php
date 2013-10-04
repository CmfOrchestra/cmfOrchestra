<?php

/**
 * This file is part of the <web service> project.
 *
 * @category Ws_Exception
 * @package Exception
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @copyright Copyright (c) 2013, Mappy
 * @since 2013-03-26
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BootStrap\WsBundle\Exception;

/**
 * Extension Exception
 *
 * @category Ws_Exception
 * @package Exception
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class ClientException extends \Exception {

    /**
     * Returns the <Not Found Exception> Exception.
     *
     * @param string $name
     * @return \Exception
     * @access public
     * @static
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public static function NotFoundException($name) {
        return new self(sprintf('Unable to find %s.', $name));
    }
    
    /**
     * Returns the <call Method Not Supported> Exception.
     *
     * @param string $method
     * @return \Exception
     * @access public
     * @static
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public static function callBadAuthRequest($class) {
    	return new self(sprintf('Authentication request doesn\'t call correctly in %s class.', $class));
    }    

    /**
     * Returns the <call Method Not Supported> Exception.
     *
     * @param string $method
     * @return \Exception
     * @access public
     * @static
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public static function callMethodNotSupported($method) {
        return new self(sprintf('Method %s doesn\'t call correctly.', $method));
    }

    /**
     * Returns the <service Not Supported> Exception.
     *
     * @param string $serviceName
     * @return \Exception
     * @access public
     * @static
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public static function serviceNotSupported($serviceName) {
        return new self(sprintf('The %s service selected is not yet supported.', $serviceName));
    }

    /**
     * Returns the <client Not Supported> Exception.
     * 
     * @param string $clienteName
     * @param string $className
     * @return \Exception
     * @access public
     * @static
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public static function clientNotSupported($clienteName, $className) {
        return new self(sprintf('The %s client %s is not yet supported in the bundle %s.', $clienteName, $className));
    }

    /**
     * Returns the <Method UnDefined> Exception.
     * 
     * @param string $method
     * @return \Exception
     * @access public
     * @static
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public static function MethodUnDefined($method) {
        return new self(sprintf('Method %s not defined in the util class !', $method));
    }

    /**
     * Returns the <init Parameter Undefined> Exception.
     * 
     * @param string $Param
     * @return \Exception
     * @access public
     * @static
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public static function initParameterUndefined($Param) {
        return new self(sprintf('Service parameter (%s) not defined correctly ! ', $Param));
    }

    /**
     * Returns the <service Not Configured Correctly> Exception.
     *
     * @return \Exception
     * @access public
     * @static
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public static function serviceNotConfiguredCorrectly() {
        return new self('Service not configured correctly.');
    }

    /**
     * Returns the <option Value Not Specified> Exception.
     * 
     * @param string $optionName
     * @param string $className
     * @return \Exception
     * @access public
     * @static
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public static function optionValueNotSpecified($optionName, $className) {
        return new self(sprintf('Option %s not specified in parameters in the class %s ', $optionName, $className));
    }

}