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
 * PiPageManagerBuilderInterface interface.
 *
 * @category   Admin_Builders
 * @package    Builder
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
interface PiPageManagerBuilderInterface
{
	public function setPageById($idPage);
	public function setPageByParams($url, $slug, $isSetPage = false);
	public function setPageByRoute($route = '', $isSetPage = false);
	
	public function render($lang = '', $isSetPage = false);
	public function renderSource($id, $lang = '', $params = null);	
	
	public function getChildrenHierarchyRub();
	public function setTreeWithPages($htmlTree);
	public function setHomePage($htmlTree);
	public function setNode($htmlTree);
	
	public function cacheRefresh();
	public function getUrlByType($type, $entity = null);
	public function cacheTreeChartPageRefresh();
}