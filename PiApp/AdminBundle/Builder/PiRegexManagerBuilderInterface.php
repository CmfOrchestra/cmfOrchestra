<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Builders
 * @package    Builder
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-09-20
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Builder;

/**
 * PiRegexManagerBuilderInterface interface.
 *
 * @category   Admin_Builders
 * @package    Builder
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
interface PiRegexManagerBuilderInterface
{
    public static function stripTrailingSlash($string);
    public static function replaceTag($tag, $replacement, $content, $attributes = null);
    public static function simplifyDatetime($string);
    public static function isDateTime($_string);
    public static function isMd5($_string);
    public static function findinside($start, $end, $string);
    public static function verifByRegularExpression($chaine, $typeExpression = "no");
    public static function searchIdByTag($chaine,$balise);
    public static function searchLinkByParam($chaine,$balise);
    public static function deleteDisplayNoneTag($w_var, $tag, $replaceTerm = '');
    public static function hex2rgb($color);
}