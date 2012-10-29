<?php
/**
 * AF Application
 *
 * @category   Library
 * @package    FormeElement
 * @subpackage Fckeditor
 * @version    $Id: Fckeditor.php 2009-11-19 00:00:00 pi_etienne $
 *
 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
 */


/**
 * Classe Element Fckeditor.
 *
 * @category   Library
 * @package    FormeElement
 * @subpackage Fckeditor
 *
 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
 */
class Zend_Form_Element_Fckeditor extends Zend_Form_Element_Textarea
{
	public function init()
	{
		$this->setAttrib('class', 'fckeditor');
		$this->setDecorators(array('Composite'));
	}
}
?>