<?php
/**
 * This Locale is part of the <Admin> project.
 *
 * @category   Admin_Builders
 * @package    Builder
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-01-18
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Builder;

/**
 * PiFileManagerBuilderInterface interface.
 *
 * @category   Admin_Builders
 * @package    Builder
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
interface PiLocaleManagerBuilderInterface
{
	public function parseDefaultLanguage($deflang = "fr");
}