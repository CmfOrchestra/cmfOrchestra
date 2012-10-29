<?php
/**
 * AF Application
 *
 * @category   Library
 * @package    FormeElement
 * @subpackage Date
 * @version    $Id: FormElementDate.php 2009-11-19 00:00:00 pi_etienne $
 *
 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
 */


/**
 * Classe Element Date par default.
 *
 *<code>
 *	$date_test = new Zend_Form_Element_FormElementDate('date_test');
 *	$date_test->setLabel('Date test')->setRequired(true);
 *</code>
 * @example	application\modules\admin\forms\Users.php Comment utiliser cette fonction.
 * @uses Zend_Form_Element
 * @uses Zend_Validate_Date
 * @category   Library
 * @package    FormeElement
 * @subpackage Date
 *
 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
 */
class Zend_Form_Element_FormElementDate extends Zend_Form_Element_Text
{
	public $helper = 'formDate';

	public function init()
	{
		$this->addPrefixPath(
            'Zend_Filter',
            'Zend/Filter',
		Zend_Form_Element::FILTER
		);
		$this->addFilter('FiltreLocalDateToMysql');

		$val = new Zend_Validate_Date(App_Tools_Date::MYSQL_DATE);
		$this->addValidator($val);
	}
}