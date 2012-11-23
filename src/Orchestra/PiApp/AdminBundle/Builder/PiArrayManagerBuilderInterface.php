<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Builders
 * @package    Builder
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-18
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Builder;

/**
 * PiArrayManagerBuilderInterface interface.
 *
 * @category   Admin_Builders
 * @package    Builder
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
interface PiArrayManagerBuilderInterface
{
	public function recursive_method(array &$array, $method, $curlevel=0);
	public function TrimArray($Input);
	public static function dump($_ARRAY);
	public static function splitOnValue($array, $value);
	public static function makeHashFromArray($array);
	public static function splitGroups($groups);
	public static function arrayFromGet($getParams);
	public static function writeArray($aInput, $jsVarName, $eol=PHP_EOL);
	public static function InnerHTML($HTML,$Balise,$Prem_val='',$Affiche_prems=true,$Nbre_bal=0);
	public static function findIndice($Tableau,$Val);
	public static function Xmlobject2json($object);
	public static function Xmlobject2array($object);
	public static function array_to_object($array);
	public static function init($version = '1.0', $encoding = 'UTF-8', $format_output = true);
	public static function &createXML($node_name, $arr=array());
}