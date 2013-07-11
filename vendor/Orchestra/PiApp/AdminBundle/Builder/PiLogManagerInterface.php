<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category Admin_Builders
 * @package Builder
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2013-03-28
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Builder;

/**
 * Log Manager Interface.
 *
 * @category Admin_Builders
 * @package Builder
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
interface PiLogManagerInterface
{
	public function setPath($path);
	public function setName($name);
	public function setFile($filePath, $mode = 0777);
	public function setInit($id, $format = "YmdHis", $flag = FILE_APPEND, $path = "");
	public function setInfo($info, $inLogger = true);
	public function clearInfo();
	public function setErr($err, $inLogger = true);
	public function delete();
	public function save($flag = FILE_APPEND, $mode = 0777);
}