<?php
/**
 * This file is part of the <Translation> project.
 *
 * @category   BootStrap_Builders
 * @package    Builder
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-02-23
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\TranslationBundle\Builder;

/**
 * RoleFactory interface.
 *
 * @category   BootStrap_Builders
 * @package    Builder
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
interface RoleFactoryInterface
{
	public function getAllUserRoles();
	public function getBestRoles($ROLES);
	public function getAllHeritageByRoles($ROLES);
	public function buildRoleMap();
}