<?php
/**
 * This file is part of the <Admin> project.
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

use PiApp\AdminBundle\Entity\Page;
use PiApp\AdminBundle\Entity\Widget;
use PiApp\AdminBundle\Entity\TranslationWidget;

/**
 * PiCoreManagerBuilderInterface interface.
 *
 * @category   Admin_Builders
 * @package    Builder
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
interface PiCoreManagerBuilderInterface
{
	public function run($tag, $id, $lang, $params = null);
	public function render($lang = '');
	public function renderSource($id, $lang = '', $params = null);
	public function cacheRefreshByname($name);
	
	public function getPageById($idpage);
	public function getBlocksByPageId($idpage);
	public function getWidgetById($idWidget);
	public function getBlockById($idBlock);
	public function getTranslationByPageId($idpage);
	public function getTranslationByWidgetId($idwidget, $lang = '');
	public function getResponseByIdAndType($type, $id);
	public function getCurrentPage();
	public function setCurrentPage(Page $page = null);
	public function setCurrentWidget(Widget $widget = null);
	public function getCurrentWidget();
	public function getCurrentTransWidget();
	public function setCurrentTransWidget(TranslationWidget $transWidget = null);
	public function parseTemplateParam($RenderResponseParam);
	public function getScript($script, $type = 'string');
}