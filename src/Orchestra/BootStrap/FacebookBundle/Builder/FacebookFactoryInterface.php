<?php
/**
 * This file is part of the <Facebook> project.
 *
 * @category   BootStrap_Builders
 * @package    Builder
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-04-23
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\FacebookBundle\Builder;

use BootStrap\FacebookBundle\Builder\FacebookClientInterface;

/**
 * GoogleFactoryInterface interface.
 *
 * @category   BootStrap_Builders
 * @package    Builder
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
interface FacebookFactoryInterface
{
	public function setClient( FacebookClientInterface $client );
}