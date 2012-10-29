<?php
/**
 * This file is part of the <Database> project.
 *
 * @category   BootStrap_Builders
 * @package    Builder
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-01-03
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\DatabaseBundle\Builder;

/**
 * DatabaseFactoryInterface interface.
 *
 * @category   BootStrap_Builders
 * @package    Builder
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
interface DatabaseFactoryInterface
{
	public function getBackupFactory();
	public function getRestoreFactory();
}