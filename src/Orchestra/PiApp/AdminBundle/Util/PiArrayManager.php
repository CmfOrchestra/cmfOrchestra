<?php
/**
 * This file is part of the <Admin> project.
 * 
 * @category   Admin_Utils
 * @package    Util
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-19
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Util;

use PiApp\AdminBundle\Builder\PiArrayManagerBuilderInterface;

/**
 * Description of array manager
 *
 * <code>
 * 	$ArrayFormatter	= $container->get('pi_app_admin.array_manager');
 *  $result			= $ArrayFormatter->dump($array); // obtains a datetime instance
 * </code>
 * 
 * @category   Admin_Utils
 * @package    Util
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiArrayManager implements PiArrayManagerBuilderInterface 
{
	
	/**
	 * set recursivly a method in value of a table.
	 *
	 * @param	array		$array
	 * @param	string		$method
	 * @param	integer		level
	 * @return array
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */	
	public function recursive_method(array &$array, $method, $curlevel=0)
	{
		foreach ($array as $k=>$v) {
			if (is_array($v)) {
				$this->recursive_method($v, $method, $curlevel+1);
			} else {
				$method($array);
			}
		}
	}
		
	/**
	 * Trims a entire array recursivly.
	 *
	 * @param       array      $Input      Input array
	 * @return array
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public function TrimArray($Input)
	{
		if (!is_array($Input))
			return trim($Input);
	
		return array_map(array($this, 'TrimArray'), $Input);
	}
	
	/**
	 * dumps the table
	 *
	 * @param array $_ARRAY
	 * @return string
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function dump($_ARRAY)
	{
		print_r('<pre>');
		print_r($_ARRAY);
		print_r('</pre>');
	}	
		
	/**
	 * finds the selected value, then splits the array on that key, and returns the two arrays
	 * if the value was not found then it returns false
	 *
	 * @param array $array
	 * @param string $value
	 * @return mixed
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function splitOnValue($array, $value)
	{
		if (is_array($array)) {
			$paramPos = array_search($value, $array);

			if ($paramPos) {
				$arrays[] = array_slice($array, 0, $paramPos);
				$arrays[] = array_slice($array, $paramPos + 1);
			} else {
				$arrays = null;
			}
			if (is_array($arrays)) {
				return $arrays;
			}
		}
		return null;
	}

	/**
	 * takes a simple array('value','3','othervalue','4')
	 * and creates a hash using the alternating values:
	 * array(
	 *  'value' => 3,
	 *  'othervalue' => 4
	 * )
	 *
	 * @param array $array
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function makeHashFromArray($array)
	{
		$hash = null;

		if (is_array($array) && count($array) > 1) {
			for ($i = 0; $i <= count($array); $i+= 2) {
				if (isset($array[$i])) {
					$key = $array[$i];
					$value = $array[$i + 1];
					if (!empty($key) && !empty($value)) {
						$hash[$key] = $value;
					}
				}
			}
		}

		if (is_array($hash)) {
			return $hash;
		}
	}

	/**
	 * takes an array:
	 * $groups = array(
	 *     'group1' => "<h2>group1......",
	 *     'group2' => "<h2>group2...."
	 *     );
	 *
	 * and splits it into 2 equal (more or less) groups
	 * @param unknown_type $groups
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function splitGroups($groups)
	{
		foreach ($groups as $k => $v) {
			//set up an array of key = count
			$g[$k] = strlen($v);
			$totalItems += $g[$k];
		}

		//the first half is the larger of the two
		$firstHalfCount = ceil($totalItems / 2);

		//now go through the array and add the items to the two groups.
		$first=true;
		foreach ($g as $k => $v) {
			if ($first) {
				$arrFirst[$k] = $groups[$k];
				$count += $v;
				if ($count > $firstHalfCount) {
					$first = false;
				}
			} else {
				$arrSecond[$k] = $groups[$k];
			}
		}

		$arrReturn['first']=$arrFirst;
		$arrReturn['second']=$arrSecond;
		return $arrReturn;
	}

	/**
	 * this function builds an associative array from a standard get request string
	 * eg: animal=dog&sound=bark
	 * will return
	 * array(
	 *     animal => dog,
	 *     sound => bark
	 * )
	 *
	 * @param string $getParams
	 * @return array
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function arrayFromGet($getParams)
	{
		$parts = explode('&', $getParams);
		if (is_array($parts)) {
			foreach ($parts as $part) {
				$paramParts = explode('=', $part);
				if (is_array($paramParts) && count($paramParts) == 2) {
					$param[$paramParts[0]] = $paramParts[1];
					unset($paramParts);
				}
			}
		}
		return $param;
	}


	/**
	 * Convertir un tableau PHP en Javascript
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function writeArray($aInput, $jsVarName, $eol=PHP_EOL) 
	{
		$js = $jsVarName.'=new Array();'.$eol;
		foreach ($aInput as $key => $value) {
			if (!is_numeric($key)) {
				$key = '"'.$key.'"';
			}
			if (is_array($value)) {
				$js .= self::writeArray($value, $jsVarName.'['.$key.']', $eol);
			} else {
				if (is_null($value)) {
					$value='null';
				} elseif (is_bool($value)) {
					$value = ($value) ? 'true' : 'false';
				} elseif (!is_numeric($value)) {
					$value = '"'.$value.'"';
				}
				$js .= $jsVarName.'['.$key.']='.$value.';'.$eol;
			}
		}
		return $js;
	}
	

	/**
	 * Extraction de contenu d'un tableau HTML. 
	 *
	 * @param string	$HTML			code html contenant la table dont on veut extraire la valeur des cellules
	 * @param string	$Balise	nom 	de la balise dont on veut extraire le contenu
	 * @param string	$Prem_val		valeur qui est prise pour déterminer une nouvelle ligne
	 * @param boolean	$Affiche_prems	permet d'inclure (true) ou non (false) dans le tableau d'extraction $Prem_val si cette option est prise.
	 * @param int		$Nbre_bal		détermine le nombre de contenus de balise composant une ligne.
	 * @return array
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */	
	public static function InnerHTML($HTML,$Balise,$Prem_val='',$Affiche_prems=true,$Nbre_bal=0)
	{
		/*
		 $HTML contient le code html contenant la table dont on veut extraire la valeur des cellules
	
		$Balise correspond à la balise dont on veut extraire le contenu.
		Ne pas mettre les "<" et ">".
		CONTRAINTE : dans le code HTML, la balise doit �tre coll�e � "<"
		<td... est correct et <          td... ne l'est pas.
	
		$Prem_val correspond à la valeur qui est prise pour d�terminer une nouvelle ligne.
		InnerHTML est INSENSIBLE à la casse concernant $Prem_val. Pour changer cela remplacer les stripos par strpos.
	
		$Affiche_prems permet d'inclure (true) ou non (false) dans le tableau d'extraction $Prem_val si cette option est prise.
	
		$Nbre_bal d�termine le nombre de contenus de balise composant une ligne.
		Si $Prem_val et $Nbre_bal sont renseign�s, c'est $Prem_val qui prime.
	
		Si $Nbre_bal est supérieur à 0, $Affiche_prems est toujours true
	
		Sachant qu'entre <td> et </td> il peut y avoir en th�orie n'importe quoi (autres balises, saut de ligne...), on ne peut pas utiliser <td>([[:alnum:]]+)</td> pour le masque
	
		Si on utilise <td>(.+)</td> �a ne marche pas non plus car la partie extraite dans un preg_match_all sera celle comprise entre le premier <td> et le dernier </td>.
		Tous les autres couples <td>...</td> ne seront pas pris en compte.
	
		On décompose donc l'extraction.*/
	
		if(strlen($Prem_val)===0)//On va extraire les valeurs par nombre de ligne
		{                        //==>Si $Nbre_bal n'est pas renseign� il faut qu'il soit sup�rieur � 0
			$Affiche_prems=true;   //par contre, s'il est renseign� on garde la valeur pass�e en param�tre.
			if($Nbre_bal===0) $Nbre_bal=1;
		}
		else//Cela signifie que on va extraire les ligne par une valeur
		{
			$Nbre_bal=0;//Si $Nbre_bal a malencontreusement �t� renseign� en m�me temps que $Prem_val,
		}//On remet cette variable � 0 pour que l'extraction par valeur soit d�tect�e (conf�re **)
	
		$Compteur=$Nbre_bal+1;
		preg_match_all('~<'.$Balise.'[^>]*>~is',$HTML,$Deb_balise);
	
		foreach($Deb_balise[0] as $Val)
		{
			$Val=substr($HTML,strpos($HTML,$Val)+strlen($Val));//On enl�ve tout ce qu'il y a avant le <td> y compris ce dernier
			$Temp=substr($Val,0,stripos($Val,'</'.$Balise.'>'));
			$HTML=substr($HTML,stripos($HTML,'</'.$Balise.'>')+strlen($Balise));//On supprime le code <td>...</td> que l'on vient d'extraire
			$Taille=count($Recup)-1;
	
			if($Nbre_bal>0)//**On traite une ligne par nombre de balise)
			{
				if($Compteur<$Nbre_bal){
					$Recup[$Taille][]=$Temp;
					++$Compteur;
				}else{
					$Recup[$Taille+1][]=$Temp;
					$Compteur=1;
				}
			}
			else//Par valeur de balise commune
			{
				if($Taille===-1)$Taille=0;//C'est que $Prem_val n'est pas en premi�re position
	
				if(stripos($Temp,$Prem_val)===false)
				{
					if(count($Recup[$Taille])===0)
						$Taille2=0;
					else
						$Taille2=count($Recup[$Taille])-1;
	
					if($Recup[$Taille][$Taille2]===NULL)
						$Recup[$Taille][$Taille2]=$Temp;
					else
						$Recup[$Taille][]=$Temp;
				}else{
					if($Compteur==1)
						$Compteur=0;
					else
						$Compteur=$Taille+1;
	
					if($Affiche_prems===true)
						$Recup[$Compteur][]=$Temp;
					else
						$Recup[$Compteur][]=NULL;
					/*
					if($Compteur==1)
						$Compteur=0;
					else
						$Compteur=$Taille+1;
	
					Pour pouvoir ins�rer des contenus de balise se trouvant avant $Prem_val si cette valeur n'est pas en première position,
					on a forcé la taille à 0.
					Si $Prem_val est en premi�re position dans le tableau renvoy� dans $Deb_balise[0] alors $Taille, au lieu d'être à  0 sera à 1
					Pour corriger cela on fait tourner le $Compteur.
					Ainsi, si la premi�re valeur de $Deb_balise[0] est �gale � $Prem_val, le premier indice du tableau de résultat sera 0.
					*/
				}
				++$Compteur;
			}
		}
		return $Recup;
	}

	/**
	 * Cette fonction sert à trouver tous les indices dans un tableau multidimentionnel pour localiser une valeur dans ce tableau
	 *
	 * @param array		$Tableau	
	 * @param string	$Val		
	 * @return array
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function findIndice($Tableau,$Val)
	{
		static $Drapeau=false;static $Compteur=false;static $Result=array(); static $Tbl_origine=array();
	
		if($Compteur==false)    //$Compteur permet d'assigner à $Tbl_origine le tableau pass� en paramètre lors du premier appel de la fonction
		{                       //En effet, lorsque l'on trouve la valeur le tableau en cours est celui contenant cette valeur.
			$Tbl_origine=$Tableau;
			$Compteur=true;
		}
	
		if(in_array($Val,$Tableau))
		{
			$Drapeau	= true;
			$Result[]	= array_search($Val,$Tableau);
			/*On récupère le chemin d'indexation menat � la valeur
			 Afin d'éviter Fatal error: Cannot use string offset as an array in..., on :
	
			- Inverse le tableau de r�sultats
			- Remonte l'arborescence jusqu'� trouver l'indice "racine" menant � la valeur
			- On renvoie la cha�ne de caract�res compos�e */
	
			$Result = array_reverse($Result);
	
			foreach($Result as $Check){
				//Pour gérer les indices associatifs
				$Guillemets	= gettype($Check)=="string" ? "'" : "";
				$Code		= "[".$Guillemets.$Check.$Guillemets."]".$Code;
	
				eval('$Test=$Tbl_origine'.$Code.';');
				if($Test==$Val) break;
			}
			return $Code;
		}
	
		foreach($Tableau as $Cle=>$Valeur)
		{
			if($Drapeau==true) break;//break; Pour remonter l'arborescence d'appel de la fonction en gardant le résultat
	
			if(is_array($Valeur)){
				$Result[]=$Cle; //$Result[]=$Cle: On rajoute l'indice parcouru dans le tableau de r�sultats
				$Result=$this->findIndice($Valeur,$Val);
			}
		}
		return $Result;
	}	
	
	/**
	 * Turns a simplexml object into array.
	 *
	 * @param array $_ARRAY
	 * @return array
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function XmlString2array($string) {
		try {
			$xmlConfig	= new \Zend_Config_Xml($string);
			return $xmlConfig->toArray();
		} catch (\Exception $e) {
			return "  \n";
		}
	}	
	
	/**
	 * 
	 * Turns a simplexml object into json.
	 * 
	 * <code>
	 * $xml_object=simplexml_load_string($contentXmlFile); 
	 * $contentFile =Xmlobject2json($xml_object); 	
	 * </code>
	 *
	 * @param array $_ARRAY
	 * @return string
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */	
	public static function Xmlobject2json($object) {
		return @json_encode($object);
	}	
	
	/**
	 * Turns a simplexml object into array.
	 *
	 * @param array $_ARRAY
	 * @return array
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */	
	public static function Xmlobject2array($object) {
		return @json_decode(@json_encode($object),1);
	}	

	/**
	 * Recursively convert a table into a stdClass object. 
	 *
	 * @param array $_ARRAY
	 * @return array
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */	
	public static function array_to_object($array)
	{
		$data = new \stdClass ;
		if(is_array($array) && !empty($array)){
			foreach($array as $key => $val){
				if(is_array($val))
					$data->$key = $this->array_to_object($val);
				else
					$data->$key = $val ;
			}
		}
		return $data ;
	}	
	
	
	
	
	/**
	 * Array2XML: A class to convert array in PHP to XML
	 * It also takes into account attributes names unlike SimpleXML in PHP
	 * It returns the XML in form of DOMDocument class for further manipulation.
	 * It throws exception if the tag name or attribute name has illegal chars.
	 *
	 * Author : Lalit Patel
	 * Website: http://www.lalit.org/lab/convert-php-array-to-xml-with-attributes
	 * License: Apache License 2.0
	 *          http://www.apache.org/licenses/LICENSE-2.0
	 * <code>
	 *       $xml = PiArrayManager::createXML('root_node_name', $php_array);
	 *       echo $xml->saveXML();
	 * </code>
	 */	
	private static $xml = null;
	private static $encoding = 'UTF-8';
	
	/**
	 * Initialize the root XML node [optional]
	 * @param $version
	 * @param $encoding
	 * @param $format_output
	 */
	public static function init($version = '1.0', $encoding = 'UTF-8', $format_output = true) {
		self::$xml = new \DomDocument($version, $encoding);
		self::$xml->formatOutput = $format_output;
		self::$encoding = $encoding;
	}
	
	/**
	 * Convert an Array to XML
	 * @param string $node_name - name of the root node to be converted
	 * @param array $arr - aray to be converterd
	 * @return DomDocument
	 */
	public static function &createXML($node_name, $arr=array()) {
		$xml = self::getXMLRoot();
		$xml->appendChild(self::convert($node_name, $arr));
	
		self::$xml = null;    // clear the xml node in the class for 2nd time use.
		return $xml;
	}
	
	/**
	 * Convert an Array to XML
	 * @param string $node_name - name of the root node to be converted
	 * @param array $arr - aray to be converterd
	 * @return DOMNode
	 */
	private static function &convert($node_name, $arr=array()) {	
		//print_arr($node_name);
		$xml = self::getXMLRoot();
		$node = $xml->createElement($node_name);
	
		if(is_array($arr)){
			// get the attributes first.;
			if(isset($arr['@attributes'])) {
				foreach($arr['@attributes'] as $key => $value) {
					if(!self::isValidTagName($key)) {
						throw new \Exception('[Array2XML] Illegal character in attribute name. attribute: '.$key.' in node: '.$node_name);
					}
					$node->setAttribute($key, self::bool2str($value));
				}
				unset($arr['@attributes']); //remove the key from the array once done.
			}
	
			// check if it has a value stored in @value, if yes store the value and return
			// else check if its directly stored as string
			if(isset($arr['@value'])) {
				$node->appendChild($xml->createTextNode(self::bool2str($arr['@value'])));
				unset($arr['@value']);    //remove the key from the array once done.
				//return from recursion, as a note with value cannot have child nodes.
				return $node;
			} else if(isset($arr['@cdata'])) {
				$node->appendChild($xml->createCDATASection(self::bool2str($arr['@cdata'])));
				unset($arr['@cdata']);    //remove the key from the array once done.
				//return from recursion, as a note with cdata cannot have child nodes.
				return $node;
			}
		}
	
		//create subnodes using recursion
		if(is_array($arr)){
			// recurse to get the node for that key
			foreach($arr as $key=>$value){
				if(!self::isValidTagName($key)) {
					throw new Exception('[Array2XML] Illegal character in tag name. tag: '.$key.' in node: '.$node_name);
				}
				if(is_array($value) && is_numeric(key($value))) {
					// MORE THAN ONE NODE OF ITS KIND;
					// if the new array is numeric index, means it is array of nodes of the same kind
					// it should follow the parent key name
					foreach($value as $k=>$v){
						$node->appendChild(self::convert($key, $v));
					}
				} else {
					// ONLY ONE NODE OF ITS KIND
					$node->appendChild(self::convert($key, $value));
				}
				unset($arr[$key]); //remove the key from the array once done.
			}
		}
	
		// after we are done with all the keys in the array (if it is one)
		// we check if it has any text value, if yes, append it.
		if(!is_array($arr)) {
			$node->appendChild($xml->createTextNode(self::bool2str($arr)));
		}
	
		return $node;
	}
	
	/**
	 * Get the root XML node, if there isn't one, create it.
	 */
	private static function getXMLRoot(){
		if(empty(self::$xml)) {
			self::init();
		}
		return self::$xml;
	}
	
	/**
	 * Get string representation of boolean value
	 */
	private static function bool2str($v){
		//convert boolean to text value.
		$v = $v === true ? 'true' : $v;
		$v = $v === false ? 'false' : $v;
		return $v;
	}
	
	/**
	 * Check if the tag name or attribute name contains illegal characters
	 * Ref: http://www.w3.org/TR/xml/#sec-common-syn
	 */
	private static function isValidTagName($tag){
		$pattern = '/^[a-z_]+[a-z0-9\:\-\.\_]*[^:]*$/i';
		return preg_match($pattern, $tag, $matches) && $matches[0] == $tag;
	}		
}