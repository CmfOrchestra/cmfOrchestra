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
 * PiStringManagerBuilderInterface interface.
 *
 * @category   Admin_Builders
 * @package    Builder
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
interface PiStringManagerBuilderInterface
{
    public static function random($length = 8);
    public static function trimUltime($chaine);
    public static function filtreString($string);
    public static function splitHtml($string);
    public static function splitText($string);
    public static function LimiteCaractere($letexte, $mincara, $nbr_cara);
    public static function truncate($text, $length = 100, $ending = "...", $exact = false, $html = false);
    public static function closetags($string);
    public static function addHyphens($string);
    public static function stripHyphens($string);
    public static function addUnderscores($string, $relative = false);
    public static function stripUnderscores($string, $relative = false);
    public static function stripLeading($replace, $string);
    public static function slugify($string);
    public static function bitly($url, $login, $appkey, $format = 'xml', $version = '2.0.1');
    public static function cleanFilename($fileName);
    public static function cleanString($string);
    public static function cleanContent($string);
    public static function cleanWhitespace($string);
    public static function remove_doublewhitespace($string = null);
    public static function remove_whitespace($string = null);
    public static function remove_whitespace_feed( $string = null);
    public static function remove_comment_in_css_file($string = null);
    public static function json_encodeDecToUTF8($array);
    public static function minusculesSansAccents($texte);
    public static function withoutaccent($chaine, $e ='utf-8');
    public static function ucfirst($string, $e ='utf-8');
    public static function uniqueWord($text);
    public static function filtreConvertUTF8ToDec($string);
    public static function taille_content($text);
    public static function stopWord($text, $locale);
    public static function allLocales($locale);
    public static function allCountries($locale, $strtolowerKeys = true);
    public static function allCurrencies();
    public static function pluralize($string, $number = null);
    public static function depluralize($string, $number = null);
    public static function sanitize($string, $force_lowercase = true, $anal = false, $trunc = 100);
}