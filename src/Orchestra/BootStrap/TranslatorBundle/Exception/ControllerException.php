<?php
/**
 * This file is part of the <Translator> project.
 *
 * @category   Translator_Exception
 * @package    Exception
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2011-11-14
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\TranslatorBundle\Exception;

/**
 * Controller Exception
 *
 * @category   Translator_Exception
 * @package    Exception
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
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