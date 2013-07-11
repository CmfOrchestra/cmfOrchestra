<?php
/**
 * This file is part of the <User> project.
 *
 * @category   BootStrap_Builders
 * @package    Builder
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-02
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\UserBundle\Builder;

/**
 * RepositoryBuilderInterface interface.
 *
 * @category   BootStrap_Builders
 * @package    Builder
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
interface RepositoryBuilderInterface
{
    public function getRepository($nameEntity = '');
    public function remove($object = null);
    public function create($object = null);
    public function findOneById($id, $type = 'page');
    public function findAll($type = 'page');
    public function findAllEnabled($nameEntity = '');
}