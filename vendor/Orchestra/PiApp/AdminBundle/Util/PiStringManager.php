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

use PiApp\AdminBundle\Builder\PiStringManagerBuilderInterface;

/**
 * Description of string manager
 *
 * <code>
 * 	$StringFormatter	= $container->get('pi_app_admin.string_manager');
 *  $result				= $StringFormatter->LimiteCaractere($text, '0', 25); // obtains a datetime instance
 * </code>
 * 
 * @category   Admin_Utils
 * @package    Util
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiStringManager implements PiStringManagerBuilderInterface
{
	/**
	 * returns a randomly generated string
	 * commonly used for password generation
	 *
	 * @param int $length
	 * @return string
	 * @access public
	 * @static
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function random($length = 8)
	{
		// start with a blank string
		$string = "";

		// define possible characters
		$possible = "0123456789abcdfghjkmnpqrstvwxyz";

		// set up a counter
		$i = 0;

		// add random characters to $string until $length is reached
		while ($i < $length) {

			// pick a random character from the possible ones
			$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);

			// we don't want this character if it's already in the string
			if (!strstr($string, $char)) {
				$string .= $char;
				$i++;
			}

		}

		// done!
		return $string;
	}
	
	/**
	 * completely remove the spaces left and right of the chain.
	 * remove multiple occurrences of consecutive spaces.
	 * completely remove the tabs.
	 *
	 * @param string $replace
	 * @param string $string
	 * @return string
	 * @access public
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function trimUltime($chaine)
	{
		$chaine = trim($chaine);
		$chaine = str_replace("\t", "", $chaine);
		$chaine = str_replace("\n", "", $chaine);
		$chaine = str_replace(" <", "<", $chaine);
		$chaine = str_replace("> ", ">", $chaine);
		$chaine = preg_replace("/[ ]+/i", " ", $chaine);
		return $chaine;
	}	
	
	/**
	 * Filter spaces for start and end, and special character.
	 *
	 * @param string $string
	 * @return string
	 * @access public
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function filtreString($string)
	{
		$valeurFiltree = trim($string);
		// Supprime les balises HTML et PHP d'une chaîne , et Autorise <p> et <a>
		//$valeurFiltree = strip_tags($valeurFiltree, '<p><a><b><i><u>');
	
		// Convertit les caractères spéciaux en entités HTML : "&", """, "'", "<", ">"
		$valeurFiltree = htmlspecialchars($valeurFiltree, ENT_QUOTES);
	
		//  Convertit tous les caractères éligibles en entités HTML
		//$valeurFiltree = htmlentities($valeurFiltree, ENT_QUOTES);  // ENT_QUOTES : Convertit les guillemets doubles et les guillemets simples.
	
		return $valeurFiltree;
	}
	
	/**
	 * Splits a html string in order to all <p> tag and returns it in two parts.
	 *
	 * @param string $string
	 * @return array
	 * @access public
	 * @static
	 *
	 * @author riad hellal <r.hellal@novediagroup.com>
	 */	
	public static function splitHtml($string){
		$cpt = 0;    $left = '';    $right = '';
		
		// replace all br tags by "</p><p>"
		$pattern = "/<br[^>]*>/i";
		$replace = "</p><p>";
		$string = preg_replace($pattern, $replace, $string);
		// replace all div tags by p tags
		$pattern = "/div>/i";
		$replace = "p>";
		$string = preg_replace($pattern, $replace, $string);
		
		//count words in $string
		$words = count(preg_split("/[\s\n\r\t ]+/", strip_tags($string), -1, PREG_SPLIT_NO_EMPTY));
		//get all p tag in $string
		preg_match_all("/<p[^>]*>.*?<\/p>/", $string, $matches, PREG_SET_ORDER);
		//get the left text part
		// loop while count words of $left is not reached (<= $words/2) and not last p tag
		while(count(preg_split("/[\s\n\r\t ]+/", strip_tags($left), -1, PREG_SPLIT_NO_EMPTY))<  ($words/2) && ($cpt < count($matches)-1)){
			$left .= $matches[$cpt][0];
			$cpt++;
		}
		//get the right text part
		for($i=$cpt;$i< count($matches);$i++){
			$right .= $matches[$i][0];
		}

		return array('left'=>$left, 'right'=>$right);
	}

	/**
	 * Splits a string without html tags and returns it in two parts.
	 *
	 * @param string $string
	 * @return array
	 * @access public
	 * @static
	 *
	 * @author riad hellal <r.hellal@novediagroup.com>
	 */	
	public static function splitText($string){
		$left = substr($string, 0, strlen($string)/2);
		$spacepos = strrpos($left, ' ');
		if (isset($spacepos)) {
			// ...and cut the text in this position
			$left = substr($left, 0, $spacepos);
		}
		$right = substr($string, strlen($left), strlen($string));
		$spacepos = strpos($right, ' ');
		if (isset($spacepos)) {
			// ...and cut the text in this position
			$right = substr($right, $spacepos);
		}
	
		return array('left'=>$left, 'right'=>$right);
	}	

	/**
	 * Returns the first x words from a text.
	 *
	 * @param  string $letexte
	 * @return string Le resultat
	 * @access public
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function LimiteCaractere($letexte, $mincara, $nbr_cara)
	{
		return self::truncate($letexte, $nbr_cara, '...', false, true);
	}	
	
	/**
	 * Function: truncate
	 * Truncates a string to the given length, optionally taking into account HTML tags, and/or keeping words in tact.
	 *
	 * Parameters:
	 *     $text - String to shorten.
	 *     $length - Length to truncate to.
	 *     $ending - What to place at the end, e.g. "...".
	 *     $exact - Break words?
	 *     $html - Auto-close cut-off HTML tags?
	 *
	 * Author:
	 *     CakePHP team, code style modified.
	 */
	public static function truncate($text, $length = 100, $ending = "...", $exact = false, $html = true)
	{
		if (is_array($ending))
			extract($ending);
	
		if ($html) {
			if (strlen(preg_replace("/<[^>]+>/", "", $text)) <= $length)
				return $text;
	
			$totalLength = strlen($ending);
			$openTags = array();
			$truncate = "";
			preg_match_all("/(<\/?([\w+]+)[^>]*>)?([^<>]*)/", $text, $tags, PREG_SET_ORDER);
			foreach ($tags as $tag) {
				if (!preg_match('/img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param/s', $tag[2])
						and preg_match('/<[\w]+[^>]*>/s', $tag[0]))
					array_unshift($openTags, $tag[2]);
				elseif (preg_match('/<\/([\w]+)[^>]*>/s', $tag[0], $closeTag)) {
					$pos = array_search($closeTag[1], $openTags);
					if ($pos !== false)
						array_splice($openTags, $pos, 1);
				}
	
				$truncate .= $tag[1];
	
				$contentLength = strlen(preg_replace("/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i", " ", $tag[3]));
				if ($contentLength + $totalLength > $length) {
					$left = $length - $totalLength;
					$entitiesLength = 0;
					if (preg_match_all("/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i", $tag[3], $entities, PREG_OFFSET_CAPTURE))
						foreach ($entities[0] as $entity)
						if ($entity[1] + 1 - $entitiesLength <= $left) {
						$left--;
						$entitiesLength += strlen($entity[0]);
					} else
						break;
	
					$truncate .= substr($tag[3], 0 , $left + $entitiesLength);
	
					break;
				} else {
					$truncate .= $tag[3];
					$totalLength += $contentLength;
				}
	
				if ($totalLength >= $length)
					break;
			}
		} else {
			if (strlen($text) <= $length)
				return $text;
			else
				$truncate = substr($text, 0, $length - strlen($ending));
		}
	
		if (!$exact) {
			$spacepos = strrpos($truncate, " ");
	
			if (isset($spacepos)) {
				if ($html) {
					$bits = substr($truncate, $spacepos);
					preg_match_all('/<\/([a-z]+)>/', $bits, $droppedTags, PREG_SET_ORDER);
					if (!empty($droppedTags))
						foreach ($droppedTags as $closingTag)
						if (!in_array($closingTag[1], $openTags))
						array_unshift($openTags, $closingTag[1]);
				}
	
				$truncate = substr($truncate, 0, $spacepos);
			}
		}
	
		$truncate .= $ending;
	
		if ($html)
			foreach ($openTags as $tag)
			$truncate .= '</'.$tag.'>';
	
		return $truncate;
	}	
	
	/**
	 * close all open xhtml tags at the end of the string
	 *
	 * @param string $string
	 * @return string
	 * @access public
	 * @static
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function closetags($string)
	{
		$arr_single_tags = array('meta','img','br','link','area');
		
		// We put all opened tags into an array.
	   	preg_match_all('#<([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $string, $result);
	    $openedtags = $result[1];
	 	
	    // We put all closed tags into an array.
	   	preg_match_all('#</([a-z]+)>#iU', $string, $result);
	 
	   	$closedtags = $result[1];
	   	$len_opened = count($openedtags);
	 
	   	// if all tags are closed
	   	if (count($closedtags) == $len_opened)
	   		return $string;
	 
	   	$openedtags = array_reverse($openedtags);
	 
	   	// close tags
	   	for ($i=0; $i < $len_opened; $i++){
	      if (!in_array($openedtags[$i],$arr_single_tags)){
	          if (!in_array($openedtags[$i], $closedtags)){
	              if ($next_tag = $openedtags[$i+1]){
	              	$string = preg_replace('#</'.$next_tag.'#iU','</'.$openedtags[$i].'></'.$next_tag, $string);
	              } else {
	              	$string .= '</'.$openedtags[$i].'>';
	              }
	          }
	      }
	  	}	 
	   	return $string;
	}	

	/**
	 * replaces spaces with hyphens (used for urls)
	 *
	 * @param string $string
	 * @return string
	 * @access public
	 * @static
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function addHyphens($string)
	{
		return str_replace(' ', '-', trim($string));
	}

	/**
	 * replaces hypens with spaces
	 *
	 * @param string $string
	 * @return string
	 * @access public
	 * @static
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function stripHyphens($string)
	{
		return str_replace('-', ' ', trim($string));
	}

	/**
	 * replace slashes with underscores
	 *
	 * @param string $string
	 * @return string
	 * @access public
	 * @static
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function addUnderscores($string, $relative = false)
	{
		$string = str_replace("_", "[UNDERSCORE]", $string);
		return str_replace('/', '_', trim($string));
	}

	/**
	 * replaces underscores with slashes
	 * if relative is true then return the path as relative
	 *
	 * @param string $string
	 * @param bool $relative
	 * @return string
	 * @access public
	 * @static
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function stripUnderscores($string, $relative = false)
	{
		$string = str_replace('_', '/', trim($string));
		if ($relative) {
			$string = $this->stripLeading('/', $string);
		}
		$string = str_replace("[UNDERSCORE]", "_", $string);
		return $string;
	}

	/**
	 * strips the leading $replace from the $string
	 *
	 * @param string $replace
	 * @param string $string
	 * @access public
	 * @return string
	 * @static
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function stripLeading($replace, $string)
	{
		if (substr($string, 0, strlen($replace)) == $replace) {
			return substr($string, strlen($replace));
		} else {
			return $string;
		}
	}
	
	/**
	 * slugify a text
	 *
	 * @param string $string
	 * @access public
	 * @return string
	 * @static
	 *
	 * @author (c) <Adel Oustad> <adel.oustad@gmail.com>
	 */
	public static function slugify($string)
	{
		$translit = array('Á'=>'A','À'=>'A','Â'=>'A','Ä'=>'A','Ã'=>'A','Å'=>'A','Ç'=>'C','É'=>'E','È'=>'E','Ê'=>'E','Ë'=>'E','Í'=>'I','Ï'=>'I','Î'=>'I','Ì'=>'I','Ñ'=>'N','Ó'=>'O','Ò'=>'O','Ô'=>'O','Ö'=>'O','Õ'=>'O','Ú'=>'U','Ù'=>'U','Û'=>'U','Ü'=>'U','Ý'=>'Y','á'=>'a','à'=>'a','â'=>'a','ä'=>'a','ã'=>'a','å'=>'a','ç'=>'c','é'=>'e','è'=>'e','ê'=>'e','ë'=>'e','í'=>'i','ì'=>'i','î'=>'i','ï'=>'i','ñ'=>'n','ó'=>'o','ò'=>'o','ô'=>'o','ö'=>'o','õ'=>'o','ú'=>'u','ù'=>'u','û'=>'u','ü'=>'u','ý'=>'y','ÿ'=>'y');
	
		$slug = strtr($string, $translit);
		$slug = strtolower($slug);
		$slug = preg_replace('#(.*?)\#.*#ims', '$1', $slug);
		$slug = preg_replace("/[^a-z0-9\s-]/", "", $slug);
		$slug = trim(preg_replace("/[\s-]+/", " ", $slug));
		$slug = preg_replace("/\s/", "-", $slug);
	
		return $slug;
	}	
	
	/**
	 * bitly a text
	 *
	 * @param string $string
	 * @access public
	 * @return string
	 * @static
	 *
	 * @author (c) <Adel Oustad> <adel.oustad@gmail.com>
	 */
	public static function bitly($url, $login, $appkey, $format = 'xml', $version = '2.0.1')
	{
		//create the URL
		$bitly = 'http://api.bit.ly/shorten?version='.$version.'&longUrl='.urlencode($url).'&login='.$login.'&apiKey='.$appkey.'&format='.$format;
		 
		//get the url
		//could also use cURL here		
		try {
			$response = file_get_contents($bitly);
				
			//parse depending on desired format
			if (strtolower($format) == 'json')
			{
				$json = @json_decode($response,true);
				return $json['results'][$url]['shortUrl'];
			}
			else //xml
			{
				$xml = simplexml_load_string($response);
				return 'http://bit.ly/'.$xml->results->nodeKeyVal->hash;
			}
		} catch (\Exception $e) {
			return "";
		}		
	}	
	
	/**
	 * this function cleans up the filename
	 * it strips ../ and ./
	 * it spaces with underscores
	 *
	 * @param string $fileName
	 * @access public
	 * @return string
	 * @static
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function cleanFilename($fileName)
	{
		$fileName = strtolower($fileName);
		$code_entities_match 	= array( '&quot;' ,'!' ,'@' ,'#' ,'$' ,'%' ,'^' ,'&' ,'*' ,'(' ,')' ,'+' ,'{' ,'}' ,'|' ,':' ,'"' ,'<' ,'>' ,'?' ,'[' ,']' ,';' ,"'" ,',' ,'_' ,'/' ,'*' ,'+' ,'~' ,'`' ,'=' ,'---' ,'--', ' ');
		$code_entities_replace 	= array('' ,'-' ,'-' ,'' ,'' ,'' ,'-' ,'-' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'-' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'-' ,'-' ,'-' ,'' ,'' ,'' ,'' ,'' ,'-' ,'-', ''); 
		$name 					= str_replace($code_entities_match, $code_entities_replace, $fileName);
		
		return $name;
	}
	
	/**
	 * this function cleans up the filename
	 * it strips ../ and ./
	 * it spaces with underscores
	 *
	 * @param string $string
	 * @access public
	 * @return string
	 * @static
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function cleanString($string)
	{
		$string = strtolower($string);
		$code_entities_match 	= array('.' ,'&quot;' ,'!' ,'@' ,'#' ,'$' ,'%' ,'^' ,'&' ,'*' ,'(' ,')' ,'+' ,'{' ,'}' ,'|' ,':' ,'"' ,'<' ,'>' ,'?' ,'[' ,']' ,'' ,';' ,',' ,'_' ,'/' ,'*' ,'+' ,'~' ,'`' ,'=' ,'---' ,'--');
		$code_entities_replace 	= array(' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' '); 
		$result					= str_replace($code_entities_match, $code_entities_replace, $string);
		return $result;
	}
	
	/**
	 * this function cleans up the filename
	 * it strips ../ and ./
	 * it spaces with underscores
	 *
	 * @param string $string
	 * @access public
	 * @return string
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function cleanContent($string)
	{
    	$string = preg_replace_callback('/\\\u(\w\w\w\w)/', 
			    function($matches)
			    {
			        return '&#'.hexdec($matches[1]).';';
			    }
			    , $string);
				
		// remove whitespace
		$string 	= self::cleanWhitespace($string);
		
		$string = preg_replace('/([ \t\r\n\v\f])(\d{0,3})([ \t\r\n\v\f])/i', '  ', $string);
		$string = preg_replace('/([ \t\r\n\v\f])(\S{1})([ \t\r\n\v\f])/i', '  ', $string);
		
		$code_entities_match 	= array("'" ,'’' ,'.' ,'&quot;' ,'!' ,'@' ,'#' ,'$' ,'%' ,'^' ,'&' ,'*' ,'(' ,')' ,'+' ,'{' ,'}' ,'|' ,':' ,'"' ,'<' ,'>' ,'?' ,'[' ,']' ,'' ,';' ,',' ,'_' ,'/' ,'*' ,'+' ,'~' ,'`' ,'=' ,'---' ,'--', '“', '”');
		$code_entities_replace 	= array(' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ' ,' ',' ',' ');
		$string					= str_replace($code_entities_match, $code_entities_replace, $string);
		
		return $string;
	}	
	
	/**
	 * Clean whitespace of a string
	 *
	 * @param string $text
	 * @access public
	 * @return string
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function cleanWhitespace($string)
	{
		$string		= str_replace("&nbsp;", ' ', $string);
		return $ret = trim( self::remove_doublewhitespace( self::remove_whitespace_feed($string) ) );
	}
	
	/**
	 * Remove doublewhitespace of a string
	 *
	 * @param string $text
	 * @access public
	 * @return string
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function remove_doublewhitespace($string = null)
	{
		return  $ret = preg_replace('/([\s])\1+/', ' ', $string);
	}
	
	/**
	 * Remove whitespace of a string
	 *
	 * @param string $text
	 * @access public
	 * @return string
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function remove_whitespace($string = null)
	{
		return $ret = preg_replace('/[\s]+/', '', $string );
	}
	
	/**
	 * Remove whitespace feed of a string
	 *
	 * @param string $text
	 * @access public
	 * @return string
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function remove_whitespace_feed( $string = null)
	{
		return $ret = preg_replace('/[\t\n\r\0\x0B]/', '', $string);
	}	
	
	/**
	 * Remove comment of a css string file.
	 *
	 * @param string $text
	 * @access public
	 * @return string
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function remove_comment_in_css_file($string = null)
	{
		return  $ret = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $string);
	}	
	
	/**
	 * This function encoding json with utf8.
	 *
	 * @param array $array
	 * @access public
	 * @return string
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function json_encodeDecToUTF8($array)
	{
    	$json = preg_replace_callback('/\\\u(\w\w\w\w)/', 
			    function($matches)
			    {
			        return '&#'.hexdec($matches[1]).';';
			    }
			    , json_encode($array));
    	
    	$json 	= str_replace("&", "$$$", $json);
    	$json 	= str_replace('\\', "@@", $json);
		$json	= mb_convert_encoding($json, "UTF-8", "HTML-ENTITIES");
		
		return $json;
	}

	/**
	 * This function transforms a string to lowercase without accents.
	 *
	 * @param string $text
	 * @access public
	 * @return string
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */	
	public static function minusculesSansAccents($text)
	{
		$text = mb_strtolower($text, 'UTF-8');
		$text = str_replace(
				array(
						'à', 'â', 'ä', 'á', 'ã', 'å',
						'î', 'ï', 'ì', 'í',
						'ô', 'ö', 'ò', 'ó', 'õ', 'ø',
						'ù', 'û', 'ü', 'ú',
						'é', 'è', 'ê', 'ë',
						'ç', 'ÿ', 'ñ',
				),
				array(
						'a', 'a', 'a', 'a', 'a', 'a',
						'i', 'i', 'i', 'i',
						'o', 'o', 'o', 'o', 'o', 'o',
						'u', 'u', 'u', 'u',
						'e', 'e', 'e', 'e',
						'c', 'y', 'n',
				),
				$text
		);
		return $text;
	}
	
	/**
	 * This function transforms a string without accents.
	 *
	 * @param string $text
	 * @param string $e		encode format
	 * @access public
	 * @return string
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function withoutaccent($chaine, $e ='utf-8')
	{
		if (version_compare(PHP_VERSION, '5.2.3', '>='))
			$str = htmlentities($chaine, ENT_NOQUOTES, $e, false);
		else
			$str = htmlentities($chaine, ENT_NOQUOTES, $e);
	
		// NB : On ne peut pas utiliser strtr qui fonctionne mal avec utf8.
		$str = preg_replace('#\&([A-za-z])(?:acute|cedil|circ|grave|ring|tilde|uml)\;#', '\1', $str);
	
		return $str;
	}	
	
	/**
	 * Tucfirst UTF-8 aware function
	 *
	 * @param string $text
	 * @param string $e		encode format
	 * @access public
	 * @return string
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */	
	public static function ucfirst($string, $e ='utf-8')
	{
		$string = trim($string);
		if (function_exists('mb_strtoupper') && function_exists('mb_substr') && !empty($string)) {
			//$string = mb_strtolower($string, $e);
			$upper 	= mb_strtoupper($string, $e);
			preg_match('#(.)#us', $upper, $matches);
			$string = $matches[1] . mb_substr($string, 1, mb_strlen($string, $e), $e);
		} else {
			$string = ucfirst($string);
		}
		return $string;
	}
	
	/**
	 * This function return an array filtering with a letter
	 *
	 * @param string $fst
	 * @param array $arr
	 * @param string $e		encode format
	 * @access private
	 * @return array
	 * @static
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function filter($fst, $arr, $e ='utf-8', $output){
		$new_arr=array();
	
		for($i=0;$i<=(count($arr)-1);$i++){
			$first_letter_withoutaccent = substr(self::withoutaccent($arr[$i]['label'], $e), 0, 1);
			$fst_letter_withoutaccent	= self::withoutaccent($fst, $e);
	
			if (strcasecmp($first_letter_withoutaccent, $fst_letter_withoutaccent)  == 0){
				$new_arr[] = $arr[$i]['label'];
			}
		}
		 
		return $new_arr;
	}	
	
	/**
	 * This function deletes all doubled words in a string.
	 *
	 * @param string $text
	 * @access public
	 * @return string
	 * @static
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function uniqueWord($string)
	{
		// remove whitespace
		$string 	= self::cleanWhitespace($string);
		
		$wordList 	= explode(' ', $string);
		//print_r(count($wordList));
		//print_r("<br />");
		$wordList   = array_unique($wordList);
		//print_r(count($wordList));
		//print_r("<br />");
		
		$string		= implode(' ', $wordList);
		return $string;
	}	
	

	/**
	 * Filtre convert utf8 string to dec.
	 *
	 * @link http://www.ranks.nl/resources/stopwords.html
	 * @param string $text
	 * @access public
	 * @return string
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function filtreConvertUTF8ToDec($string)
	{
		$valeurFiltree = $string;
	
		$valeurFiltree = str_replace("& ", "&amp; ", $valeurFiltree );
		$valeurFiltree = str_replace('!', "&excl;", $valeurFiltree );
		$valeurFiltree = str_replace('"', "&quot;", $valeurFiltree );
		$valeurFiltree = str_replace('#', "&num;", $valeurFiltree );
		$valeurFiltree = str_replace('$', "&dollar;", $valeurFiltree );
		$valeurFiltree = str_replace('%', "&percnt;", $valeurFiltree );
		$valeurFiltree = str_replace("'", "&apos;", $valeurFiltree );
	
		$valeurFiltree = preg_replace("(è)","&#232;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(é)","&#233;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(ê)","&#234;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(ë)","&#235;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(È)","&#200;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(É)","&#201;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(Ê)","&#202;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(Ë)","&#203;",$valeurFiltree) ;
	
		$valeurFiltree = preg_replace("(ç)","&#231;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(Ç)","&#199;",$valeurFiltree) ;
	
		$valeurFiltree = preg_replace("(à)","&#224;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(á)","&#225;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(â)","&#226;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(ã)","&#227;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(ä)","&#228;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(å)","&#229;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(æ)","&#230;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(À)","&#192;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(Á)","&#193;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(Â)","&#194;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(Ã)","&#195;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(Ä)","&#196;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(Å)","&#197;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(Æ)","&#198;",$valeurFiltree) ;
	
		$valeurFiltree = preg_replace("(ò)","&#242;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(ó)","&#243;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(ô)","&#244;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(õ)","&#245;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(ö)","&#246;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(œ)","&#339;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(Ò)","&#210;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(Ó)","&#211;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(Ô)","&#212;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(Õ)","&#213;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(Ö)","&#214;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(Œ)","&#338;",$valeurFiltree) ;
	
		$valeurFiltree = preg_replace("(ù)","&#249;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(ú)","&#250;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(û)","&#251;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(ü)","&#252;",$valeurFiltree) ;
	
		$valeurFiltree = preg_replace("(Ÿ)","&#376;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(ý)","&#253;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(þ)","&#254;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(ÿ)","&#255;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(Ý)","&#221;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(Þ)","&#222;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(ß)","&#223;",$valeurFiltree) ;
	
		$valeurFiltree = preg_replace("(ì)","&#236;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(í)","&#237;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(î)","&#238;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(ï)","&#239;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(Ì)","&#204;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(Í)","&#205;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(Î)","&#206;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(Ï)","&#207;",$valeurFiltree) ;
	
		$valeurFiltree = preg_replace("(ð)","&#240;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(ñ)","&#241;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(Ð)","&#208;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(Ñ)","&#209;",$valeurFiltree) ;
	
		$valeurFiltree = preg_replace("(÷)","&#247;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(ø)","&#248;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(×)","&#215;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(Ø)","&#216;",$valeurFiltree) ;
	
		$valeurFiltree = preg_replace("(~)","&#126;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(‚)","&#8218;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(ƒ)","&#420;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(„)","&#8222;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(…)","&#8230;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(†)","&#8224;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(‡)","&#8225;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(ˆ)","&#136;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(‰)","&#8240;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(Š)","&#352;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(‹)","&#139;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(‘)","&#8216;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(’)","&#8217;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(“)","&#8220;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(”)","&#8221;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(•)","&#8226;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(–)","&#8211;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(—)","&#8212;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(˜)","&#152;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(™)","&#8482;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(š)","&#353;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(›)","&#155;",$valeurFiltree) ;
	
		$valeurFiltree = preg_replace("(¡)","&#161;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(¢)","&#162;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(£)","&#163;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(¤)","&#164;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(¥)","&#165;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(¦)","&#166;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(§)","&#167;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(¨)","&#168;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(©)","&#169;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(ª)","&#170;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(«)","&#171;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(¬)","&#172;",$valeurFiltree) ;
	
		$valeurFiltree = preg_replace("(®)","&#174;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(¯)","&#175;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(°)","&#176;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(±)","&#177;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(²)","&#178;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(³)","&#179;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(´)","&#180;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(µ)","&#181;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(¶)","&#182;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(·)","&#183;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(¸)","&#184;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(¹)","&#185;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(º)","&#186;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(»)","&#187;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(¼)","&#188;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(½)","&#189;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(¾)","&#190;",$valeurFiltree) ;
		$valeurFiltree = preg_replace("(¿)","&#191;",$valeurFiltree) ;
	
		$valeurFiltree = preg_replace("(€)","&#8364;",$valeurFiltree) ;
	
		return $valeurFiltree;
	}
	
	/**
	 * Returns the size in kilobytes of a text.
	 *
	 * @param	string	$text
	 * @access	public
	 * @return	string
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function taille_content($text)
	{
		$taille_content = strlen ($text);
		// taille en ko
		return round($taille_content / 1024 * 100) / 100;
	}
		
	/**
	 * List of stop words according to the language.
	 *
	 * @link http://www.ranks.nl/resources/stopwords.html
	 * @param string $text
	 * @param string $locale
	 * @access public
	 * @return string
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */	
	public static function stopWord($text, $locale)
	{
		$infos_locale = explode('_', $locale);
		if (count($infos_locale) >= 2)
			$locale = strtolower($infos_locale[0]);
		else
			$locale = strtolower($locale);
		
		// CATALAN
		if ($locale == 'ca'){
			$stopwords_ca 	 = "de es i a o un una unes uns un tot també altre algun alguna alguns algunes ser és soc ets som estic està estem esteu estan com en per perquè per [1] => que estat estava ans abans éssent ambdós però per poder potser puc podem podeu poden vaig va van fer	faig fa fem feu fan cada fi inclòs primer des [2] => de conseguir consegueixo consigueix consigueixes conseguim consigueixen anar haver tenir tinc te tenim teniu tene el la les els seu aquí meu teu ells elles ens nosaltres vosaltres si dins sols solament saber saps sap sabem sabeu saben últim llarg bastant	fas molts aquells aquelles seus llavors sota dalt ús molt era eres erem eren mode bé quant quan on mentre qui amb entre sense jo aquell";
			$stopwords_ca 	 = preg_replace('/\s/i', ' ', $stopwords_ca); // Remove all forms of space
			$stopwords['ca'] = array_unique(explode(' ', $stopwords_ca));
		}

		// CZECH
		if ($locale == 'cz'){
			$stopwords_cz 	 = "dnes cz timto budes budem byli jses muj svym ta tomto tohle tuto tyto jej zda proc mate tato kam tohoto kdo kteri mi nam tom tomuto mit nic proto kterou byla toho protoze asi ho nasi napiste re coz tim takze svych jeji svymi jste aj tu tedy teto bylo kde ke prave ji nad nejsou ci pod tema mezi pres ty pak vam ani kdyz vsak ne jsem tento clanku clanky aby jsme pred pta jejich byl jeste az bez take pouze prvni vase ktera nas novy tipy pokud muze design strana jeho sve jine zpravy nove neni	vas jen podle zde clanek uz email byt vice bude jiz nez ktery by ktere co nebo ten tak ma pri od po jsou jak dalsi ale si ve to jako za zpet ze do pro je na";
			$stopwords_cz 	 = preg_replace('/\s/i', ' ', $stopwords_cz); // Remove all forms of space
			$stopwords['cz'] =  array_unique(explode(' ', $stopwords_cz));
		}
		
		// DANISH
		if ($locale == 'da'){		
			$stopwords_da 	 = "af alle andet andre at begge da de den denne der deres det dette dig din dog du ej eller en end ene eneste enhver et fem fire flere fleste for fordi forrige	fra få før god han hans har hendes her hun hvad hvem hver hvilken hvis hvor hvordan hvorfor hvornår i ikke ind ingen intet jeg jeres kan kom kommer lav lidt lille man	mand mange med meget men mens mere mig ned ni nogen noget ny nyt nær næste næsten og op otte over på se seks ses som stor store syv ti til to tre ud var";
			$stopwords_da 	 = preg_replace('/\s/i', ' ', $stopwords_da); // Remove all forms of space
			$stopwords['da'] =  array_unique(explode(' ', $stopwords_da));
		}
		
		// DUTCH
		if ($locale == 'nl'){
			$stopwords_nl 	 = "aan af al als bij dan dat die dit een en er had heb hem het hij hoe hun ik	in is je kan me men met mij nog nu of ons ook te tot uit van was	wat we wel wij zal ze zei zij zo zou";
			$stopwords_nl	 = preg_replace('/\s/i', ' ', $stopwords_nl); // Remove all forms of space
			$stopwords['nl'] =  array_unique(explode(' ', $stopwords_nl));
		}
		
		// FINNISH
		if ($locale == 'fi'){
			$stopwords_fi  	 = "aiemmin aika aikaa aikaan aikaisemmin aikaisin aikajen aikana aikoina aikoo aikovat aina ainakaan ainakin ainoa ainoat aiomme aion aiotte aist aivan ajan älä alas alemmas älköön alkuisin alkuun alla alle aloitamme aloitan aloitat aloitatte aloitattivat aloitettava aloitettevaksi aloitettu aloitimme aloitin aloitit aloititte aloittaa aloittamatta aloitti aloittivat alta aluksi alussa alusta annettavaksi annetteva annettu antaa antamatta antoi aoua apu asia asiaa asian asiasta asiat asioiden asioihin asioita asti avuksi avulla avun avutta edellä edelle edelleen edeltä edemmäs edes edessä edestä ehkä ei eikä eilen eivät eli ellei elleivät ellemme ellen ellet ellette emme en enää enemmän eniten ennen ensi ensimmäinen ensimmäiseksi ensimmäisen ensimmäisenä ensimmäiset ensimmäisiä ensimmäisiksi ensimmäisinä ensimmäistä ensin entinen entisen entisiä entistä entisten eräät eräiden eräs eri erittäin erityisesti esi esiin esillä esimerkiksi et eteen etenkin että ette ettei halua haluaa haluamatta haluamme haluan haluat haluatte haluavat halunnut halusi halusimme halusin halusit halusitte halusivat halutessa haluton hän häneen hänellä hänelle häneltä hänen hänessä hänestä hänet he hei heidän heihin heille heiltä heissä heistä heitä helposti heti hetkellä hieman huolimatta huomenna hyvä hyvää hyvät hyviä hyvien hyviin hyviksi hyville hyviltä hyvin hyvinä hyvissä hyvistä ihan ilman ilmeisesti itse itseään itsensä ja jää jälkeen jälleen jo johon joiden joihin joiksi joilla joille joilta joissa joista joita joka jokainen jokin joko joku jolla jolle jolloin jolta jompikumpi jonka jonkin jonne joo jopa jos joskus jossa josta jota jotain joten jotenkin jotenkuten jotka jotta jouduimme jouduin jouduit jouduitte joudumme joudun joudutte joukkoon joukossa joukosta joutua joutui joutuivat joutumaan joutuu joutuvat juuri kahdeksan kahdeksannen kahdella kahdelle kahdelta kahden kahdessa kahdesta kahta kahteen kai kaiken kaikille kaikilta kaikkea kaikki kaikkia kaikkiaan kaikkialla kaikkialle kaikkialta kaikkien kaikkin kaksi kannalta kannattaa kanssa kanssaan kanssamme kanssani kanssanne kanssasi kauan kauemmas kautta kehen keiden keihin keiksi keillä keille keiltä keinä keissä keistä keitä keittä keitten keneen keneksi kenellä kenelle keneltä kenen kenenä kenessä kenestä kenet kenettä kennessästä kerran kerta kertaa kesken keskimäärin ketä ketkä kiitos kohti koko kokonaan kolmas kolme kolmen kolmesti koska koskaan kovin kuin kuinka kuitenkaan kuitenkin kuka kukaan kukin kumpainen kumpainenkaan kumpi kumpikaan kumpikin kun kuten kuuden kuusi kuutta kyllä kymmenen kyse lähekkäin lähellä lähelle läheltä lähemmäs lähes lähinnä lähtien läpi liian liki lisää lisäksi luo mahdollisimman mahdollista me meidän meillä meille melkein melko menee meneet menemme menen menet menette menevät meni menimme menin menit menivät mennessä mennyt menossa mihin mikä mikään mikäli mikin miksi milloin minä minne minun minut missä mistä mitä mitään miten moi molemmat mones monesti monet moni moniaalla moniaalle moniaalta monta muassa muiden muita muka mukaan mukaansa mukana mutta muu muualla muualle muualta muuanne muulloin muun muut muuta muutama muutaman muuten myöhemmin myös myöskään myöskin myötä näiden näin näissä näissähin näissälle näissältä näissästä näitä nämä ne neljä neljää neljän niiden niin niistä niitä noin nopeammin nopeasti nopeiten nro nuo nyt ohi oikein ole olemme olen olet olette oleva olevan olevat oli olimme olin olisi olisimme olisin olisit olisitte olisivat olit olitte olivat olla olleet olli ollut oma omaa omaan omaksi omalle omalta oman omassa omat omia omien omiin omiksi omille omilta omissa omista on onkin onko ovat päälle paikoittain paitsi pakosti paljon paremmin parempi parhaillaan parhaiten peräti perusteella pian pieneen pieneksi pienellä pienelle pieneltä pienempi pienestä pieni pienin puolesta puolestaan runsaasti saakka sadam sama samaa samaan samalla samallalta samallassa samallasta saman samat samoin sata sataa satojen se seitsemän sekä sen seuraavat siellä sieltä siihen siinä siis siitä sijaan siksi sillä silloin silti sinä sinne sinua sinulle sinulta sinun sinussa sinusta sinut sisäkkäin sisällä sitä siten sitten suoraan suuntaan suuren suuret suuri suuria suurin suurten taa täällä täältä taas taemmas tähän tahansa tai takaa takaisin takana takia tällä tällöin tämä tämän tänä tänään tänne tapauksessa tässä tästä tätä täten tavalla tavoitteena täysin täytyvät täytyy te tietysti todella toinen toisaalla toisaalle toisaalta toiseen toiseksi toisella toiselle toiselta toisemme toisen toisensa toisessa toisesta toista toistaiseksi toki tosin tuhannen tuhat tule tulee tulemme tulen tulet ";
			$stopwords_fi 	.= "tulette tulevat tulimme tulin tulisi tulisimme tulisin tulisit tulisitte tulisivat tulit tulitte tulivat tulla tulleet tullut tuntuu tuo tuolla tuolloin tuolta tuonne tuskin tykö usea useasti useimmiten usein useita uudeksi uudelleen uuden uudet uusi uusia uusien uusinta uuteen uutta vaan vähän vähemmän vähintään vähiten vai vaiheessa vaikea vaikean vaikeat vaikeilla vaikeille vaikeilta vaikeissa vaikeista vaikka vain välillä varmasti varsin varsinkin varten vasta vastaan vastakkain verran vielä vierekkäin vieri viiden viime viimeinen viimeisen viimeksi viisi voi voidaan voimme voin voisi voit voitte voivat vuoden vuoksi vuosi vuosien vuosina vuotta yhä yhdeksän yhden yhdessä yhtä yhtäällä yhtäälle yhtäältä yhtään yhteen yhteensä yhteydessä yhteyteen yksi yksin yksittäin yleensä ylemmäs yli ylös ympäri";
			$stopwords_fi 	 = preg_replace('/\s/i', ' ', $stopwords_fi); // Remove all forms of space
			$stopwords['fi'] =  array_unique(explode(' ', $stopwords_fi));
		}		
		
		// FRENCH
		if ($locale == 'fr'){
			$stopwords_fr 	 = " un une qu d s a l on de vous ils alors au aucuns aussi autre avant avec avoir bon car ce cela ces ceux chaque ci comme comment dans des du dedans dehors depuis deux devrait doit donc dos droite début elle elles en encore essai est et eu fait faites fois font force haut hors ici il ils je	juste la le les leur là ma maintenant mais mes mine moins mon mot même ni nommés notre nous nouveaux ou où par parce parole pas personnes peut peu pièce plupart pour pourquoi quand que quel quelle quelles quels qui sa sans ses seulement si sien son sont sous soyez	sujet sur ta tandis tellement tels tes ton tous tout trop très tu valeur voie voient vont votre vous vu ça étaient état étions été être";
			$stopwords_fr	 = preg_replace('/\s/i', ' ', $stopwords_fr); // Remove all forms of space
			$stopwords['fr'] =  array_unique(explode(' ', $stopwords_fr));
		}
		
		// GERMAN
		if ($locale == 'de'){
			$stopwords_de 	 = "aber als am an auch auf aus bei bin bis bist da dadurch daher darum das daß dass dein deine dem den der des dessen deshalb die dies dieser dieses doch dort du durch ein eine einem einen einer eines er es euer eure für hatte hatten hattest hattet hier	hinter ich ihr ihre im in ist ja jede jedem jeden jeder jedes jener jenes jetzt kann kannst können könnt machen mein meine mit muß mußt musst müssen müßt nach nachdem nein nicht nun oder seid sein seine sich sie sind soll sollen sollst sollt sonst soweit sowie und unser unsere unter vom von vor wann warum was weiter weitere wenn wer werde werden werdet weshalb wie wieder wieso wir wird wirst wo woher wohin zu zum zur über";
			$stopwords_de	 = preg_replace('/\s/i', ' ', $stopwords_de); // Remove all forms of space
			$stopwords['de'] =  array_unique(explode(' ', $stopwords_de));
		}
		
		// GREEK
		if ($locale == 'gr'){
			$stopwords_gr 	 = "μή ἑαυτοῦ ἄν ἀλλ’ ἀλλά ἄλλοσ ἀπό ἄρα αὐτόσ δ’ δέ δή διά δαί δαίσ ἔτι ἐγώ ἐκ ἐμόσ ἐν ἐπί εἰ εἰμί εἴμι εἰσ γάρ γε γα^ ἡ ἤ καί κατά μέν μετά μή ὁ ὅδε ὅσ ὅστισ ὅτι οὕτωσ οὗτοσ οὔτε οὖν οὐδείσ οἱ οὐ οὐδέ οὐκ περί πρόσ σύ σύν τά τε τήν τῆσ τῇ τι τί	τισ τίσ τό τοί τοιοῦτοσ τόν τούσ τοῦ τῶν τῷ ὑμόσ ὑπέρ ὑπό ὡσ ὦ ὥστε ἐάν παρά σόσ";
			$stopwords_gr	 = preg_replace('/\s/i', ' ', $stopwords_gr); // Remove all forms of space
			$stopwords['gr'] =  array_unique(explode(' ', $stopwords_gr));
		}

		// HUNGARIAN
		if ($locale == 'hu'){
			$stopwords_hu 	 = "a az egy be ki le fel meg el át rá ide oda szét össze vissza de hát és vagy hogy van lesz volt csak nem igen mint én te õ mi ti õk ön";
			$stopwords_hu 	 = preg_replace('/\s/i', ' ', $stopwords_hu); // Remove all forms of space
			$stopwords['hu'] =  array_unique(explode(' ', $stopwords_hu));
		}
		
		// ITALIAN
		if ($locale == 'it'){
			$stopwords_it 	 = "a adesso ai al alla allo allora altre altri altro anche ancora avere aveva avevano ben buono che chi cinque comprare con consecutivi consecutivo cosa cui da del della dello dentro deve devo di doppio due e ecco fare fine fino fra gente giu ha hai hanno ho il indietro	invece io la lavoro le lei lo loro lui lungo ma me meglio molta molti molto nei nella no noi nome nostro nove nuovi nuovo o oltre ora otto peggio pero persone piu poco primo promesso qua quarto quasi quattro quello questo qui quindi quinto rispetto sara secondo sei sembra	sembrava senza sette sia siamo siete solo sono sopra soprattutto sotto stati stato stesso su subito sul sulla tanto te tempo terzo tra tre triplo ultimo un una uno va vai voi volte vostro";
			$stopwords_it	 = preg_replace('/\s/i', ' ', $stopwords_it); // Remove all forms of space
			$stopwords['it'] =  array_unique(explode(' ', $stopwords_it));
		}
		
		// NORWEGIAN
		if ($locale == 'no'){
			$stopwords_no 	 = "alle andre arbeid av begge bort bra bruke da denne der deres det din disse du eller en ene eneste enhver enn er et folk for fordi forsÛke fra fÅ fÛr fÛrst gjorde gjÛre god gÅ ha hadde han hans hennes her hva hvem hver hvilken hvis hvor hvordan hvorfor	i ikke inn innen kan kunne lage lang lik like makt mange med meg meget men mens mer mest min mye mÅ mÅte navn nei ny nÅ nÅr og ogsÅ om opp oss over part punkt pÅ rett riktig samme sant si siden sist skulle slik slutt som start stille	sÅ tid til tilbake tilstand under ut uten var ved verdi vi vil ville vite vÅr vÖre vÖrt Å";
			$stopwords_no	 = preg_replace('/\s/i', ' ', $stopwords_no); // Remove all forms of space
			$stopwords['no'] =  array_unique(explode(' ', $stopwords_no));
		}
		
		// POLISH
		if ($locale == 'pl'){
			$stopwords_pl 	 = "a aby ach acz aczkolwiek aj albo ale ależ aż bardziej bardzo bez bo bowiem by byli bynajmniej być był była było były będzie będą cali cała cały ci cię ciebie co cokolwiek coś czasami czasem czemu czy czyli daleko dla dlaczego dlatego do dobrze dokąd dość dużo dwa dwaj dwie dwoje dziś dzisiaj gdy gdyby gdyż gdzie gdziekolwiek gdzieś go i ich ile im inna inne inny innych iż ja ją jak jakaś jakby jaki jakichś jakie jakiś jakiż jakkolwiek jako jakoś je jeden jedna jedno jednak jednakże jego jej jemu jest jestem jeszcze jeśli jeżeli już ją każdy	 kiedy kilka kimś kto ktokolwiek ktoś która które którego której który których którym którzy ku lat lecz lub ma mają mam mi mimo między mną mnie mogą moi moim moja moje może możliwe można mój mu musi my na nad nam nami nas nasi nasz nasza nasze naszego naszych natomiast natychmiast nawet nią nic nich nie niego niej niemu nigdy nim nimi niż no o obok od około on ona one oni ono oraz owszem pan pana pani po pod podczas pomimo ponad ponieważ powinien powinna powinni powinno poza prawie przecież przed przede przedtem przez przy roku również sam sama	 są się skąd sobie sobą sposób swoje są ta tak taka taki takie także tam te tego tej ten teraz też totobą tobie toteż trzeba tu tutaj twoi twoim twoja twoje twym twój ty tych tylko tym u w wam wami was wasz wasza wasze we według wiele wielu więc więcej wszyscy wszystkich wszystkie wszystkim wszystko wtedy wy właśnie z za zapewne zawsze zeznowu znów został żaden żadna żadne żadnych że żeby";
			$stopwords_pl	 = preg_replace('/\s/i', ' ', $stopwords_pl); // Remove all forms of space
			$stopwords['pl'] =  array_unique(explode(' ', $stopwords_pl));
		}		
		
		// PORTUGUESE
		if ($locale == 'pt'){
			$stopwords_pt	 = "último é acerca agora algmas alguns ali ambos antes apontar aquela aquelas aquele aqueles aqui atrás bem bom cada caminho cima com como comprido conhecido corrente das debaixo dentro desde desligado deve devem deverá direita diz dizer dois dos e ela ele eles em enquanto então está estão estado estar	estará este estes esteve estive estivemos estiveram eu fará faz fazer fazia fez fim foi fora horas iniciar inicio ir irá ista iste isto ligado maioria maiorias mais mas mesmo meu muito muitos nós não nome nosso novo o onde os ou outro para parte pegar pelo pessoas pode poderá	podia por porque povo promeiro quê qual qualquer quando quem quieto são saber sem ser seu somente têm tal também tem tempo tenho tentar tentaram tente tentei teu teve tipo tive todos trabalhar trabalho tu um uma umas uns usa usar valor veja ver verdade verdadeiro você";
			$stopwords_pt	 = preg_replace('/\s/i', ' ', $stopwords_pt); // Remove all forms of space
			$stopwords['pt'] =  array_unique(explode(' ', $stopwords_pt));
		}
		
		// RUSSIAN
		if ($locale == 'ru'){
			$stopwords_ru 	 = "а е и ж м о на не ни об но он мне мои мож она они оно мной много многочисленное многочисленная многочисленные многочисленный мною мой мог могут можно может можхо мор моя моё мочь над нее оба нам нем нами ними мимо немного одной одного менее однажды однако меня нему меньше ней наверху него ниже мало надо один одиннадцать одиннадцатый назад наиболее недавно миллионов недалеко между низко меля нельзя нибудь непрерывно наконец никогда никуда нас наш нет нею неё них мира наша наше наши ничего начала нередко несколько обычно опять около мы ну нх от отовсюду особенно нужно очень отсюда в во вон вниз внизу вокруг вот восемнадцать восемнадцатый восемь восьмой вверх вам вами важное важная важные важный вдали везде ведь вас ваш ваша ваше ваши впрочем весь вдруг вы все второй всем всеми времени время всему всего всегда всех всею всю вся всё всюду г год говорил говорит года году где да ее за из ли же им до по ими под иногда довольно именно долго позже более должно пожалуйста значит иметь больше пока ему имя пор пора потом потому после почему почти посреди ей два две двенадцать двенадцатый двадцать двадцатый двух его дел или без день занят занята занято заняты действительно давно девятнадцать девятнадцатый девять девятый даже алло жизнь далеко близко здесь дальше для лет зато даром первый перед затем зачем лишь десять десятый ею её их бы еще при был про процентов против просто бывает бывь если люди была были было будем будет будете будешь прекрасно буду будь будто будут ещё пятнадцать пятнадцатый друго другое другой другие другая других есть пять быть лучше пятый к ком конечно кому кого когда которой которого которая которые который которых кем каждое каждая каждые каждый кажется как какой какая кто кроме куда кругом с т у я та те уж со то том снова тому совсем того тогда тоже собой тобой собою тобою сначала только уметь тот тою хорошо хотеть хочешь хоть хотя свое свои твой своей своего своих свою твоя твоё раз уже сам там тем чем сама сами теми само рано самом самому самой самого семнадцать семнадцатый самим самими самих саму семь чему раньше сейчас чего сегодня себе тебе сеаой человек разве теперь себя тебя седьмой спасибо слишком так такое такой такие также такая сих тех чаще четвертый через часто шестой шестнадцать шестнадцатый шесть четыре четырнадцать четырнадцатый сколько сказал сказала сказать ту ты три эта эти что это чтоб этом этому этой этого чтобы этот стал туда этим этими рядом тринадцать тринадцатый этих третий тут эту суть чуть тысяч";
			$stopwords_ru	 = preg_replace('/\s/i', ' ', $stopwords_ru); // Remove all forms of space
			$stopwords['ru'] =  array_unique(explode(' ', $stopwords_ru));
		}
		
		// SPANISH
		if ($locale == 'es'){
			$stopwords_es 	 = "un una unas unos uno sobre todo también tras otro algún alguno alguna algunos algunas ser es soy eres somos sois estoy esta estamos estais estan como en para atras porque por qué estado estaba ante antes siendo ambos pero por poder puede puedo podemos podeis pueden fui fue fuimos fueron hacer hago hace hacemos haceis hacen cada fin incluso primero desde conseguir consigo consigue consigues conseguimos consiguen ir voy va vamos vais van vaya gueno ha tener tengo tiene tenemos teneis tienen el la lo las los su aqui mio tuyo ellos ellas nos nosotros vosotros vosotras si dentro solo solamente saber sabes sabe sabemos sabeis saben ultimo largo bastante haces muchos aquellos aquellas sus entonces tiempo verdad verdadero verdadera	cierto ciertos cierta ciertas intentar intento intenta intentas intentamos intentais intentan dos bajo arriba encima usar uso usas usa usamos usais usan emplear empleo empleas emplean ampleamos empleais valor muy era eras eramos eran modo bien cual cuando donde mientras quien con entre sin trabajo trabajar trabajas trabaja trabajamos trabajais trabajan podria podrias podriamos podrian podriais yo aquel";
			$stopwords_es	 = preg_replace('/\s/i', ' ', $stopwords_es); // Remove all forms of space
			$stopwords['es'] =  array_unique(explode(' ', $stopwords_es));
		}
		
		// SWEDISH
		if ($locale == 'sv'){
			$stopwords_sv 	 = "aderton adertonde adjö aldrig alla allas allt alltid alltså än andra andras annan annat ännu artonde artonn åtminstone att åtta åttio åttionde åttonde av även båda bådas bakom bara bäst bättre behöva behövas behövde behövt beslut beslutat beslutit bland blev bli blir blivit bort borta bra då dag dagar dagarna dagen där därför de del delen dem den deras dess det detta dig din dina dit ditt dock du efter eftersom elfte eller elva en enkel enkelt enkla enligt er era ert ett ettusen få fanns får fått fem femte femtio femtionde femton femtonde fick fin finnas finns fjärde fjorton fjortonde fler flera flesta följande för före förlåt förra första fram framför från fyra fyrtio fyrtionde gå gälla gäller gällt går gärna gått genast genom gick gjorde gjort god goda godare godast gör göra gott ha hade haft han hans har här heller hellre helst helt henne hennes hit hög höger högre högst hon honom hundra hundraen hundraett hur i ibland idag igår igen imorgon in inför inga ingen ingenting inget innan inne inom inte inuti ja jag jämfört kan kanske knappast kom komma kommer kommit kr kunde kunna kunnat kvar länge längre långsam långsammare långsammast långsamt längst långt lätt lättare lättast legat ligga ligger lika likställd likställda lilla lite liten litet man många måste med mellan men mer mera mest mig min mina mindre minst mitt mittemot möjlig möjligen möjligt möjligtvis mot mycket någon någonting något några när nästa ned nederst nedersta nedre nej ner ni nio nionde nittio nittionde nitton nittonde nödvändig nödvändiga nödvändigt nödvändigtvis nog noll nr nu nummer och också ofta oftast olika olikt om oss över övermorgon överst övre på rakt rätt redan så sade säga säger sagt samma sämre sämst sedan senare senast sent sex sextio sextionde sexton sextonde sig sin sina sist sista siste sitt sjätte sju sjunde sjuttio sjuttionde sjutton sjuttonde ska skall skulle slutligen små smått snart som stor stora större störst stort tack tidig tidigare tidigast tidigt till tills tillsammans tio tionde tjugo tjugoen tjugoett tjugonde tjugotre tjugotvå tjungo tolfte tolv tre tredje trettio trettionde tretton trettonde två tvåhundra under upp ur ursäkt ut utan utanför ute vad vänster vänstra var vår vara våra varför varifrån varit varken värre varsågod vart vårt vem vems verkligen vi vid vidare viktig viktigare viktigast viktigt vilka vilken vilket vill";
			$stopwords_sv	 = preg_replace('/\s/i', ' ', $stopwords_sv); // Remove all forms of space
			$stopwords['sv'] =  array_unique(explode(' ', $stopwords_sv));
		}
		
		// TURKISH
		if ($locale == 'tr'){
			$stopwords_tr 	 = "acaba altmýþ altý ama bana bazý belki ben benden beni benim beþ bin bir biri birkaç birkez birþey birþeyi biz bizden bizi bizim bu buna bunda bundan bunu bunun da daha dahi de defa diye doksan dokuz dört elli en	gibi hem hep hepsi her hiç iki ile INSERmi ise için katrilyon kez ki kim kimden kime kimi kýrk milyar milyon mu mü mý nasýl ne neden nerde nerede nereye niye niçin on ona ondan onlar onlardan onlari onlarýn onu	otuz sanki sekiz seksen sen senden seni senin siz sizden sizi sizin trilyon tüm ve veya ya yani yedi yetmiþ yirmi yüz çok çünkü üç þey þeyden þeyi þeyler þu þuna þunda þundan þunu";
			$stopwords_tr	 = preg_replace('/\s/i', ' ', $stopwords_tr); // Remove all forms of space
			$stopwords['tr'] =  array_unique(explode(' ', $stopwords_tr));
		}
		
		// ENGLISH
		if ($locale == 'en'){
			$stopwords_en = "a about above after again against all am an and any are aren't as at be because been before being below between both but by can't cannot could couldn't did didn't do does doesn't doing don't down during each few for from further had hadn't has hasn't have haven't having he he'd he'll he's her here here's hers herself him himself his how how's i i'd i'll i'm i've if in into is isn't it it's its itself let's me more most mustn't my myself no nor not of off on once only or other ought our ours ourselves out over own same shan't she she'd she'll she's should shouldn't so some such than that that's the their theirs them themselves then there there's these they they'd they'll they're they've this those through to too under until up very was wasn't we we'd we'll we're we've were weren't what what's when when's where where's which while who who's whom why why's with won't would wouldn't you you'd you'll you're you've your yours yourself yourselves a's able about above according accordingly across actually after afterwards again against ain't all allow allows almost alone along already also although always am among amongst an and another any anybody anyhow anyone anything anyway anyways anywhere apart appear appreciate appropriate are aren't around as aside ask asking associated at available away awfully be became because become becomes becoming been before beforehand behind being believe below beside besides best better between beyond both brief but by c'mon c's came can can't cannot cant cause causes certain certainly changes clearly co com come comes concerning consequently consider considering contain containing contains corresponding could couldn't course currently definitely described despite did didn't different do does doesn't doing don't done down downwards during each edu eg eight either else elsewhere enough entirely especially et etc even ever every everybody everyone everything everywhere ex exactly example except far few fifth first five followed following follows for former formerly forth four from further furthermore get gets getting given gives go goes going gone got gotten greetings had hadn't happens hardly has hasn't have haven't having he he's hello help hence her here here's hereafter hereby herein hereupon hers herself hi him himself his hither hopefully how howbeit however i'd i'll i'm i've ie if ignored immediate in inasmuch inc indeed indicate indicated indicates inner insofar instead into inward is isn't it it'd it'll it's its itself just keep keeps kept know known knows last lately later latter latterly least less lest let let's like liked likely little look looking looks ltd mainly many may maybe me mean meanwhile merely might more moreover most mostly much must my myself name namely nd near nearly necessary need needs neither never nevertheless new next nine no nobody non none noone nor normally not nothing novel now nowhere obviously of off often oh ok okay old on once one ones only onto or other others otherwise ought our ours ourselves out outside over overall own particular particularly per perhaps placed please plus possible presumably probably provides que quite qv rather rd re really reasonably regarding regardless regards relatively respectively right said same saw say saying says second secondly see seeing seem seemed seeming seems seen self selves sensible sent serious seriously seven several shall she should shouldn't since six so some somebody somehow someone something sometime sometimes somewhat somewhere soon sorry specified specify specifying still sub such sup sure t's take taken tell tends th than thank thanks thanx that that's thats the their theirs them themselves then thence there there's thereafter thereby therefore therein theres thereupon these they they'd they'll they're they've think third this thorough thoroughly those though three through throughout thru thus to together too took toward towards tried tries truly try trying twice two un under unfortunately unless unlikely until unto up upon us use used useful uses using usually value various very via viz vs want wants was wasn't way we we'd we'll we're we've welcome well went were weren't what what's whatever when whence whenever where where's whereafter whereas whereby wherein whereupon wherever whether which while whither who who's whoever whole whom whose why will willing wish with within without won't wonder would wouldn't yes yet you you'd you'll you're you've your yours yourself yourselves zero";
			$stopwords_en = preg_replace('/\s/i', ' ', $stopwords_en); // Remove all forms of space
			$stopwords['en'] =  array_unique(explode(' ', $stopwords_en));
		}
		
		if (isset($stopwords[$locale]) && !empty($stopwords[$locale]))
			return $stopwords[$locale];
		else
			return false;
	}
	
	/**
	 * List of all locales.
	 *
	 * @param string $locale
	 * @access public
	 * @return array
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function allLocales($locale)
	{
    	$localelist = \Zend_Locale::getLocaleList();
    	$name_key = array_map(function($key, $locale) {
    		return locale_get_display_name(strtolower($key), strtolower($locale)) . " - ({$key})";
    	}, array_keys($localelist), array_fill(0, count($localelist)-1, $locale));
    	return array_combine(array_keys($localelist), $name_key);	
	}	
	
	/**
	 * List of all countries.
	 *
	 * @link https://github.com/umpirsky/country-list/blob/master/country/cldr/en/country.php
	 * @param string $locale
	 * @access public
	 * @return array
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */	
	public static function allCountries($locale, $strtolowerKeys = true)
	{
// 		// we get the current directory.
// 		$path = realpath(dirname(__FILE__) . "/Countries/cldr");
// 		$all_files = \PiApp\AdminBundle\Util\PiFileManager::ListFiles($path, "json");
// 		foreach($all_files as $key => $path_file){
// 			$dir_path_win 	= explode('\\', realpath(dirname($path_file)));
// 			$dir_path_linux = explode('//', realpath(dirname($path_file)));
			
// 			$local_value_win 	= end($dir_path_win);
// 			$local_value_linux = end($dir_path_linux);
			
// 			if ($local_value_win != realpath(dirname($path_file))){
							
// 				$new_path = realpath(dirname(__FILE__)) . "/Countries/" . $local_value_win . "_country.json";
// 				copy($path_file, $new_path);
				
// 				print_r($local_value_win);
// 				print_r("<br />");
// 			}
// 		}		
// 		exit;

		// we get the current directory.
		$path = realpath(dirname(__FILE__) . "/Countries");
		// we create the file name.
		//$locale = strtolower($locale);
		$file = "{$locale}_country.json";
		// we take all json files existing.
		$all_files = \PiApp\AdminBundle\Util\PiFileManager::getFilesByType($path, "json");
		
		//print_r(file_get_contents($path.'/'.$file));exit;
		//print_r(get_object_vars(json_decode(file_get_contents(realpath($path.'/'.$file)))));exit;
		
		// we return the country.jon content file if it's existed.
		if (in_array($file, $all_files))
			$all_countries =  get_object_vars(json_decode(file_get_contents(realpath($path.'/'.$file))));
		else
			$all_countries =  get_object_vars(json_decode(file_get_contents(realpath($path.'/en_country.json'))));

		asort($all_countries);
		
		if ($strtolowerKeys){
			$news_key = array_map(function($key) {
				return (string)strtolower($key);
			}, array_keys($all_countries));
			
			return array_combine($news_key, array_values($all_countries));
		}else
			return $all_countries;
		
	}
	
	public static function allCurrencies()
	{
		return array(
				'AED' => 'AED',    'AFN' => 'AFN',    'ALL' => 'ALL',
				'AMD' => 'AMD',    'ANG' => 'ANG',    'AOA' => 'AOA',
				'ARS' => 'ARS',    'AUD' => 'AUD',    'AWG' => 'AWG',
				'AZN' => 'AZN',    'BAM' => 'BAM',    'BBD' => 'BBD',
				'BDT' => 'BDT',    'BGN' => 'BGN',    'BHD' => 'BHD',
				'BIF' => 'BIF',    'BMD' => 'BMD',    'BND' => 'BND',
				'BOB' => 'BOB',    'BRL' => 'BRL',    'BSD' => 'BSD',
				'BTN' => 'BTN',    'BWP' => 'BWP',    'BYR' => 'BYR',
				'BZD' => 'BZD',    'CAD' => 'CAD',    'CDF' => 'CDF',
				'CHF' => 'CHF',    'CLP' => 'CLP',    'CNY' => 'CNY',
				'COP' => 'COP',    'CRC' => 'CRC',    'CUC' => 'CUC',
				'CUP' => 'CUP',    'CVE' => 'CVE',    'CZK' => 'CZK',
				'DJF' => 'DJF',    'DKK' => 'DKK',    'DOP' => 'DOP',
				'DZD' => 'DZD',    'EGP' => 'EGP',    'ERN' => 'ERN',
				'ETB' => 'ETB',    'EUR' => 'EUR',    'FJD' => 'FJD',
				'FKP' => 'FKP',    'GBP' => 'GBP',    'GEL' => 'GEL',
				'GGP' => 'GGP',    'GHS' => 'GHS',    'GIP' => 'GIP',
				'GMD' => 'GMD',    'GNF' => 'GNF',    'GTQ' => 'GTQ',
				'GYD' => 'GYD',    'HKD' => 'HKD',    'HNL' => 'HNL',
				'HRK' => 'HRK',    'HTG' => 'HTG',    'HUF' => 'HUF',
				'IDR' => 'IDR',    'ILS' => 'ILS',    'IMP' => 'IMP',
				'INR' => 'INR',    'IQD' => 'IQD',    'IRR' => 'IRR',
				'ISK' => 'ISK',    'JEP' => 'JEP',    'JMD' => 'JMD',
				'JOD' => 'JOD',    'JPY' => 'JPY',    'KES' => 'KES',
				'KGS' => 'KGS',    'KHR' => 'KHR',    'KMF' => 'KMF',
				'KPW' => 'KPW',    'KRW' => 'KRW',    'KWD' => 'KWD',
				'KYD' => 'KYD',    'KZT' => 'KZT',    'LAK' => 'LAK',
				'LBP' => 'LBP',    'LKR' => 'LKR',    'LRD' => 'LRD',
				'LSL' => 'LSL',    'LTL' => 'LTL',    'LVL' => 'LVL',
				'LYD' => 'LYD',    'MAD' => 'MAD',    'MDL' => 'MDL',
				'MGA' => 'MGA',    'MKD' => 'MKD',    'MMK' => 'MMK',
				'MNT' => 'MNT',    'MOP' => 'MOP',    'MRO' => 'MRO',
				'MUR' => 'MUR',    'MVR' => 'MVR',    'MWK' => 'MWK',
				'MXN' => 'MXN',    'MYR' => 'MYR',    'MZN' => 'MZN',
				'NAD' => 'NAD',    'NGN' => 'NGN',    'NIO' => 'NIO',
				'NOK' => 'NOK',    'NPR' => 'NPR',    'NZD' => 'NZD',
				'OMR' => 'OMR',    'PAB' => 'PAB',    'PEN' => 'PEN',
				'PGK' => 'PGK',    'PHP' => 'PHP',    'PKR' => 'PKR',
				'PLN' => 'PLN',    'PYG' => 'PYG',    'QAR' => 'QAR',
				'RON' => 'RON',    'RSD' => 'RSD',    'RUB' => 'RUB',
				'RWF' => 'RWF',    'SAR' => 'SAR',    'SBD' => 'SBD',
				'SCR' => 'SCR',    'SDG' => 'SDG',    'SEK' => 'SEK',
				'SGD' => 'SGD',    'SHP' => 'SHP',    'SLL' => 'SLL',
				'SOS' => 'SOS',    'SPL' => 'SPL',    'SRD' => 'SRD',
				'STD' => 'STD',    'SVC' => 'SVC',    'SYP' => 'SYP',
				'SZL' => 'SZL',    'THB' => 'THB',    'TJS' => 'TJS',
				'TMT' => 'TMT',    'TND' => 'TND',    'TOP' => 'TOP',
				'TRY' => 'TRY',    'TTD' => 'TTD',    'TVD' => 'TVD',
				'TWD' => 'TWD',    'TZS' => 'TZS',    'UAH' => 'UAH',
				'UGX' => 'UGX',    'USD' => 'USD',    'UYU' => 'UYU',
				'UZS' => 'UZS',    'VEF' => 'VEF',    'VND' => 'VND',
				'VUV' => 'VUV',    'WST' => 'WST',    'XAF' => 'XAF',
				'XCD' => 'XCD',    'XDR' => 'XDR',    'XOF' => 'XOF',
				'XPF' => 'XPF',    'YER' => 'YER',    'ZAR' => 'ZAR',
				'ZMK' => 'ZMK',    'ZWD' => 'ZWD',
		);
	}	
	
	/**
	 * Function: pluralize
	 * Returns a pluralized string. This is a port of Rails's pluralizer.
	 *
	 * @param string	$string - The string to pluralize.
	 * @param integer	$number - If passed, and this number is 1, it will not pluralize.
	 *     
	 * @access public
	 * @return string
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public static function pluralize($string, $number = null)
	{
		$uncountable = array("moose", "sheep", "fish", "series", "species",
				"rice", "money", "information", "equipment", "piss");
	
		if (in_array($string, $uncountable) or $number == 1)
			return $string;
	
		$replacements = array("/person/i" => "people",
				"/man/i" => "men",
				"/child/i" => "children",
				"/cow/i" => "kine",
				"/goose/i" => "geese",
				"/(penis)$/i" => "\\1es", # Take that, Rails!
				"/(ax|test)is$/i" => "\\1es",
				"/(octop|vir)us$/i" => "\\1ii",
				"/(cact)us$/i" => "\\1i",
				"/(alias|status)$/i" => "\\1es",
				"/(bu)s$/i" => "\\1ses",
				"/(buffal|tomat)o$/i" => "\\1oes",
				"/([ti])um$/i" => "\\1a",
				"/sis$/i" => "ses",
				"/(hive)$/i" => "\\1s",
				"/([^aeiouy]|qu)y$/i" => "\\1ies",
				"/^(ox)$/i" => "\\1en",
				"/(matr|vert|ind)(?:ix|ex)$/i" => "\\1ices",
				"/(x|ch|ss|sh)$/i" => "\\1es",
				"/([m|l])ouse$/i" => "\\1ice",
				"/(quiz)$/i" => "\\1zes");
	
		$replaced = preg_replace(array_keys($replacements), array_values($replacements), $string, 1);
	
		if ($replaced == $string)
			return $string."s";
		else
			return $replaced;
	}	
	
	/**
	 * Function: depluralize
	 * Returns a depluralized string. This is the inverse of <pluralize>.
	 *
	 * @param string	$string - The string to depluralize.
	 * @param interger	$number - If passed, and this number is not 1, it will not depluralize.
	 *
	 * @access public
	 * @return string
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>     
	 */
	public static function depluralize($string, $number = null) 
	{
		if (isset($number) and $number != 1)
			return $string;
	
		$replacements = array("/people/i" => "person",
				"/^men/i" => "man",
				"/children/i" => "child",
				"/kine/i" => "cow",
				"/geese/i" => "goose",
				"/(penis)es$/i" => "\\1",
				"/(ax|test)es$/i" => "\\1is",
				"/(octopi|viri|cact)i$/i" => "\\1us",
				"/(alias|status)es$/i" => "\\1",
				"/(bu)ses$/i" => "\\1s",
				"/(buffal|tomat)oes$/i" => "\\1o",
				"/([ti])a$/i" => "\\1um",
				"/ses$/i" => "sis",
				"/(hive)s$/i" => "\\1",
				"/([^aeiouy]|qu)ies$/i" => "\\1y",
				"/^(ox)en$/i" => "\\1",
				"/(vert|ind)ices$/i" => "\\1ex",
				"/(matr)ices$/i" => "\\1ix",
				"/(x|ch|ss|sh)es$/i" => "\\1",
				"/([ml])ice$/i" => "\\1ouse",
				"/(quiz)zes$/i" => "\\1");
	
		$replaced = preg_replace(array_keys($replacements), array_values($replacements), $string, 1);
	
		if ($replaced == $string and substr($string, -1) == "s")
			return substr($string, 0, -1);
		else
			return $replaced;
	}	
	
	/**
	 * Function: sanitize
	 * Returns a sanitized string, typically for URLs.
	 *
	 *  @param string	$string - The string to sanitize.
	 *  @param string	$force_lowercase - Force the string to lowercase?
	 *  @param string	$anal - If set to *true*, will remove all non-alphanumeric characters.
	 *  @param string	$trunc - Number of characters to truncate to (default 100, 0 to disable).
	 *     
	 * @access public
	 * @return string
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>     
	 */
	public static function sanitize($string, $force_lowercase = true, $anal = false, $trunc = 100)
	{
		$strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
				"}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
				"—", "–", ",", "<", ".", ">", "/", "?");
		$clean = trim(str_replace($strip, "", strip_tags($string)));
		$clean = preg_replace('/\s+/', "-", $clean);
		$clean = ($anal ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean);
		$clean = ($trunc ? substr($clean, 0, $trunc) : $clean);
		return ($force_lowercase) ?
		(function_exists('mb_strtolower')) ?
		mb_strtolower($clean, 'UTF-8') :
		strtolower($clean) :
		$clean;
	}
}