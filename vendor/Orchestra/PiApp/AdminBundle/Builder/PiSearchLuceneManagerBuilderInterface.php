<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Builders
 * @package    Builder
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-06-11
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Builder;

/**
 * PiSearchLuceneManagerBuilderInterface interface.
 *
 * @category   Admin_Builders
 * @package    Builder
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
interface PiSearchLuceneManagerBuilderInterface
{
    public function renderSource($id, $lang = '', $params = null);
    public static function create($directory);
    public static function open($directory);
    public static function commit();
    public function contentPage($Etag, $locale, $Query = null, $MaxLimitWord = 0);
    public function indexPage(\PiApp\AdminBundle\Entity\Page $page);
    public function deletePage(\PiApp\AdminBundle\Entity\Page $page);
    public function searchPage($query, $options = null, $locale = '');
    public function searchPagesByQuery($query = "Key:*", $options = null);
}