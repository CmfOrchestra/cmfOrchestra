<?php
/**
 * This file is part of the <Google> project.
 *
 * @category   BootStrap_Builders
 * @package    Builder
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-04-23
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\GoogleBundle\Builder;

use BootStrap\GoogleBundle\Builder\GoogleClientInterface;

/**
 * GoogleFactoryInterface interface.
 *
 * @category   BootStrap_Builders
 * @package    Builder
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
interface GoogleFactoryInterface
{
	public function setClient( GoogleClientInterface $client );
}