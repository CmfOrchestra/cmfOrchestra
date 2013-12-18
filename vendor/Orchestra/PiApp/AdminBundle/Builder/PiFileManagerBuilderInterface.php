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
 * PiFileManagerBuilderInterface interface.
 *
 * @category   Admin_Builders
 * @package    Builder
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
interface PiFileManagerBuilderInterface
{
    public static function getFileContent($path);
    public static function getFileExtension($filename);
    public static function getFileName($path);
    public static function GlobFiles($dirRegex, $options = null);
    public static function getFilesByType($path, $type = false, $appendPath = false, $includeExtension = true);
    public static function ListFiles($dir, $type = false);
    public static function directoryScan($dir, $onlyfiles = false, $onlyDir = false, $fullpath = false, $ignorDirName = array());
    public function getContentCodeFile($file_code);
    public static function mkdirr($pathname, $mode = null);
    public static function rmdirr($dir);
    public static function save($path, $content = '',  $mode = 0777);
    public static function rename($source, $newName);
    public static function copy( $source, $target);
    public static function move($source, $target);
    public static function delete($path);
    public static function create($path, $filecontent = '');
    public static function InsererContent($path, $filecontent);
    public static function readfileChunked ($filename, $retbytes=false);
    public static function getFile($file, $cacheTime, $mime=null, $name=null);
    public static function getMimeContentType($fileName);
    public static function urlPathEncode($value);
    public static function generatePath($mode, $id);
}