<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Builders
 * @package    Builder
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-06-26
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
interface PiFormBuilderManagerInterface
{
	public function XmlConfigWidget(array $data);
	public function preEventActionForm(array $data);
	public function postEventActionForm(array $data);	
	public function setIndexBlock($index);
	public function setIndexWidget($index);
	public function setIndexForm($index);
	public function getTypeForm();
	public function executeAllFormByContainer($container);
	public function execute($options);
}