<?php
/**
 * This file is part of the <Translation> project.
 *
 * @category   BootStrap_Builders
 * @package    Builder
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-03-09
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\TranslationBundle\Builder;

use Doctrine\ORM\Query;

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
    public function findAllByEntity($locale, $result = "array", $INNER_JOIN = true, $MaxResults = null);
    public function findOneByEntity($locale, $id, $result = "array", $INNER_JOIN = true);
    public function findTranslationsByQuery($locale, Query $query, $result = "array", $INNER_JOIN = true);
    public function findTranslations($entity);
    public function findTranslationsByObjectId($id);
    public function translate($entity, $field, $locale, $value);
    public function findObjectByTranslatedField($field, $value, $class);
    public function getArrayAllByField($field);
    public function getAllByCategory($category = '', $MaxResults = null, $ORDER_PublishDate = '', $ORDER_Position = '', $enabled = true, $is_checkRoles = true);
    public function getAllByFields($fields = array(), $MaxResults = null, $ORDER_PublishDate = '', $ORDER_Position = '', $is_checkRoles = true);
    public function getAllOrderByField($field = 'createat', $ORDER = "DESC", $enabled = null);
    public function getAllBetweenPosition($FirstPosition = null, $LastPosition = null, $enabled = null);
    public function getMaxOrMinValueOfColumn($field, $type = 'MAX', $enabled = null);
    public function getAllEnableByCatAndByPosition($locale, $category, $result = "object", $INNER_JOIN = false);
    public function getContentByField($locale, array $fields, $INNER_JOIN = false);
    public function getEntityByField($locale, array $fields, $result = "object", $INNER_JOIN = false);    
}