<?php
/**
 * AF Application
 *
 * @category   Library
 * @package    FormeElement
 * @subpackage Xml
 * @version    $Id: Xml.php 2009-11-19 00:00:00 pi_etienne $
 *
 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
 */

require_once ('Zend/Form/Element.php');

/**
 * Classe Element Xml.
 *
 * @category   Library
 * @package    FormeElement
 * @subpackage Xml
 *
 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
 */
class Zend_Form_Element_Xml extends Zend_Form_Element
{
	public function getValue ($toString = true)
	{
		$value = parent::getValue();
		if (is_array($value)) {
			$xml = new SimpleXMLElement('<elementData />');
			foreach ($value as $k => $v) {
				$xml->$k = $v;
			}
		} else {
			$xml = simplexml_load_string($value);
		}
		if (is_object($xml)) {
			if ($toString) {
				return $xml->asXML();
			} else {
				return $xml;
			}
		} else {
			return null;
		}
	}
	public function getXml ()
	{
		return $this->getValue(false);
	}
}
?>