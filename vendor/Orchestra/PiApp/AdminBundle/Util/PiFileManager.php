<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Utils
 * @package    Util
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-18
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Util;

use PiApp\AdminBundle\Builder\PiFileManagerBuilderInterface;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of the file manager
 *
 * <code>
 *     $fileFormatter    = $this-container->get('pi_app_admin.file_manager');
 * </code>
 * 
 * @category   Admin_Utils
 * @package    Util
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiFileManager implements PiFileManagerBuilderInterface 
{    
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;
    
    /**
     * Constructor.
     *
     * @param ContainerInterface $container The service container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    
    /**
     * Returns the file in binary.
     *
     * @param  str    $path  path du fichier
     *
     * @return string
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public static function getFileContent($path)
    {
        if (!empty($path)) {
            return file_get_contents($path);
        }
    }    
        
    /**
     * Retrieves the extension of a file.
     *
     * @param  $filename    $filename  nom du fichier
     * 
     * @return string
     * @access public
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public static function getFileExtension($filename)
    {
        return strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    }
    
    /**
     * Returns the file name from full path.
     *
     * @param  str    $path  path du fichier
     * 
     * @return string
     * @access public
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public static function getFileName($path)
    {
        if (!empty($path))
            return basename($path);
    }
    
    /**
     * Find pathnames matching a pattern
     *
     * @param string $dirRegex    regex path (ex: 'my/dir/*.xml', 'my/dir/*.[cC][sS][vV]', "/path/to/images/{*.jpg,*.JPG}", '[a-z]+\.txt', "upload/.*\.php")
     * @param string $options    option value :
     * GLOB_MARK - Adds a slash to each directory returned
     * GLOB_NOSORT - Return files as they appear in the directory (no sorting)
     * GLOB_NOCHECK - Return the search pattern if no files matching it were found
     * GLOB_NOESCAPE - Backslashes do not quote metacharacters
     * GLOB_BRACE - Expands {a,b,c} to match 'a', 'b', or 'c'
     * GLOB_ONLYDIR - Return only directory entries which match the pattern
     * GLOB_ERR - Stop on read errors (like unreadable directories), by default errors are ignored. 
     *
     * @return array    array list of all files.
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public static function GlobFiles($dirRegex, $options = null)
    {
        if(is_null($options))
            return glob($dirRegex);
        else
            return glob($dirRegex, $options);
    }
    
    /**
     * Returns the names of files contained in a directory.
     *
     * @param    string    $path  path
     * @param    string    $type
     * @param    string    $appendPath
     * @param    boolean    $includeExtension
     *
     * @return array    array list of all files.
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */    
    public static function getFilesByType($path, $type = false, $appendPath = false, $includeExtension = true)
    {
        if (is_dir($path)) {
            $dir = scandir($path); //open directory and get contents
            if (is_array($dir)) { //it found files
                $returnFiles = false;
                foreach ($dir as $file) {
                    if (!is_dir($path . '/' . $file)) {
                        if ($type) { //validate the type
                            $fileParts = explode('.', $file);
                            if (is_array($fileParts)) {
                                $fileType = array_pop($fileParts);
                                $file = implode('.', $fileParts);
                                    
                                //check whether the filetypes were passed as an array or string
                                if (is_array($type)) {
                                    if (in_array($fileType, $type)) {
                                        $filePath =  $appendPath . $file;
                                        if ($includeExtension == true) {
                                            $filePath .= '.' . $fileType;
                                        }
                                        $returnFiles[] = $filePath;
                                    }
                                } else {
                                    if ($fileType == $type) {
                                        $filePath =  $appendPath . $file;
                                        if ($includeExtension == true) {
                                            $filePath .= '.' . $fileType;
                                        }
                                        $returnFiles[] = $filePath;
                                    }
                                }
                            }
                        } else { //the type was not set.  return all files and directories
                            $returnFiles[] = $file;
                        }
                    }
                }
    
                if ($returnFiles) {
                    sort($returnFiles);
                    return $returnFiles;
                }
            }
        }
    }
    
    /**
     * Returns the names of files contained in a directory ans all subdirectories.
     *
     * @param    string    $dir  path
     * @param    string    $type
     *
     * @return array    array list of all files.
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */    
    public static function ListFiles($dir, $type = false)
    {
        if ($dh = opendir($dir)) {
    
            $files = Array();
            $inner_files = Array();
    
            while($file = readdir($dh)) {
                if ($file != "." && $file != ".." && $file[0] != '.') {
                    if (is_dir($dir . "/" . $file)) {
                        $inner_files = self::ListFiles($dir . "/" . $file, $type);
                        if (is_array($inner_files)) 
                            $files = array_merge($files, $inner_files);
                    } else {
                        if ($type) { //validate the type
                            $fileParts = explode('.', $file);
                            if (is_array($fileParts)) {
                                $fileType = array_pop($fileParts);
                                
                                //check whether the filetypes were passed as an array or string
                                if (is_array($type)) {
                                    if (in_array($fileType, $type)) {
                                        array_push($files, $dir . "/" . $file);
                                    }
                                } else {
                                    if ($fileType == $type) {
                                        array_push($files, $dir . "/" . $file);
                                    }
                                }
                            }
                        } else{
                            array_push($files, $dir . "/" . $file);
                        }
                    }
                }
            }
    
            closedir($dh);
            return $files;
        }
    }    
    
    /**
     * Returns the names of all directories ans all subdirectories.
     *
     * @param    string    $dir
     * @param    string    $onlyfiles
     * @param    string    $onlyDir
     * @param    string    $fullpath
     * @param    string    $ignorDirName
     *
     * @return array    array list of all directories and subdirectories.
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public static function directoryScan($dir, $onlyfiles = false, $onlyDir = false, $fullpath = false, $ignorDirName = array()) {
        if (isset($dir) && is_readable($dir)) {
                
            $dlist = Array();
            $dir = realpath($dir);
            if ($onlyfiles) {
                $objects = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir));
            } else {
                $objects = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir), \RecursiveIteratorIterator::SELF_FIRST);
            }
            foreach($objects as $entry => $object){
                if (!$fullpath) {
                    $entry = str_replace($dir, '', $entry);
                }
                if ($onlyDir) {
                    $basename = basename($entry);
                    str_replace('.','.',$entry,$cpt);
                    if ( ($cpt == 0) && !in_array($basename, $ignorDirName) ) {
                        $dlist[] = $entry;
                    }
                } else {
                    $dlist[] = $entry;
                }
            }
            return $dlist;
        }
    }    
    
     /**
     * Parse a file and returns the contents
     * 
     * @param string $file_code        file name consists of: bundle_piappadmin_css_screen__css for express this path : bundle/piappadmin/css/screen.css
     *  
     * @return string content of the file given in parameter.
     * @access public
     * @throws \InvalidArgumentException If fails parsing the string
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function getContentCodeFile($file_code)
    {        
        // We get the real path of the file
        $path               = $this->decodeFilePath($file_code);
        
        // We get the content of the file
        $content_file     = self::getFileContent($path);
        $ext_file        = self::getFileExtension($path);
        
        // We send the response
        $response = new Response($content_file, 200);
        if ($ext_file == "css")
            $response->headers->set('Content-Type', 'text/css');
        elseif ($ext_file == "js")
            $response->headers->set('Content-Type', 'text/javascript');
        else
            throw new \InvalidArgumentException('The $file argument "' . $ext_file .'" doesn\'t match a valid extension file');
        
        return $response;        
    }  

    /**
     * Parse a file name coded and returns the real path
     *
     * @param string $file_code        file name consists of: web_bundle_piappadmin_css_screen__css for express this path : web/bundle/piappadmin/css/screen.css
     * 
     * @return string
     * @access private
     * @throws \Exception If fails parsing the string
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */    
    private function decodeFilePath($file_code)
    {
        // dumb replacements
        list($dirs, $ext) = explode('__', $file_code);
        $dirs         = explode('_', $dirs);
    
        // getting file's namespace is set
        $namespace    = array_shift($dirs);
    
        // building to the proper path
        $root_dir    = $this->container->get('kernel')->getRootDir() . '/../' . $namespace . '/';
        
        // returning realpath or throw everything to the trashcan
        $realpath        = realpath($root_dir . implode('/', $dirs) . '.' . $ext);
        
        if ($realpath === false)
            throw new \InvalidArgumentException('The $file argument "' . $file_code .'" doesn\'t match a valid file');
    
        return $realpath;
    }

    /**
     * Create a directory and all subdirectories needed.
     * @param string $pathname
     * @param octal $mode example 0777
     */
    public static function mkdirr($pathname, $mode = null)
    {
        // Check if directory already exists
        if (is_dir($pathname) || empty($pathname)) {
            return true;
        }
        // Ensure a file does not already exist with the same name
        if (is_file($pathname)) {
            return false;
        }
        // Crawl up the directory tree
        $nextPathname = substr($pathname, 0, strrpos($pathname, "/"));
        if (self::mkdirr($nextPathname, $mode)) {
            if (!file_exists($pathname)) {
                if (is_null($mode)) {
                    return mkdir($pathname);
                } else {
                    return mkdir($pathname, $mode);
                }
            }
        } else {
            throw new \Exception (
                    "intermediate mkdirr $nextPathname failed"
            );
        }
        return false;
    }
    
    /**
     * remove recursively directory
     * @param string $dir Physical directory to remove
     */
    public static function rmdirr($dir)
    {
        if ($handle = opendir("$dir")) {
            while ($item = readdir($handle)) {
                if ( ($item != ".") && ($item != "..") ) {
                    if (is_dir("$dir/$item")) {
                        self::rmdirr("$dir/$item");
                    } else {
                        unlink("$dir/$item");
                    }
                }
            }
            closedir($handle);
            rmdir($dir);
        }
    }
    
    /**
     * Save a content in the file given in parameter.
     *
     * @param  string    $path      path file
     * @param  string    $content      content to push in th file
     * @param  int         $mode      mode file
     *
     * @return booean    return 0 if the file is save correctly.    
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public static function save($path, $content = '',  $mode = 0777)
    {
        if (self::mkdirr(dirname($path), $mode)) {
            return file_put_contents($path, $content);
        } else {
            return false;
        }
    }   

    /**
     * rename the selected file
     *
     * @param string $source
     * @param string $newName
     * @access public
     * @static
     *
     * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     */
    public static function rename($source, $newName)
    {
    	if (file_exists($source)) {
    		rename($source, $newName);
    	}
    }
    
    /**
     * copy a file
     *
     * @param string $source
     * @param string $target
     * @return bool
     * @access public
     * @static
     *
     * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     */
    public static function copy( $source, $target)
    {
    	if (file_exists( $source )) {
    		return copy($source, $target);
    	}
    }
    
    /**
     * move a file
     *
     * @param string $source
     * @param string $target
     * @access public
     * @static
     *
     * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     */
    public static function move($source, $target)
    {
    	if (file_exists($source)) {
    		rename($source, $target);
    	}
    }
    
    /**
     * Delete a file.
     *
     * @param  string    $path  path du fichier
     *
     * @return boolean
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public static function delete($path)
    {
        $dirpath = dirname($path);
        if (@mkdir("$dirpath", 0777)) {}
        if (file_exists("$path"))
        {
            unlink($path);
            return true;
        } else
            return false;
    }
    
    /**
     * Create a file.
     *
     * @param  string    $path  path du fichier
     * @param  string	 content à inserer
     * @return void
     * @access public
     * @static
     *
     * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     */
    public static function create($path, $filecontent = '')
    {
    	$dirpath = dirname($path);
    	if(@mkdir("$dirpath", 0777)) {}
    
    	if(!file_exists("$path")) {
    		$fp = fopen($path,"w+");
    		fwrite($fp,$filecontent,strlen($filecontent));
    		fclose($fp);
    	}
    }    
    
    /**
     * Insert content in file.
     *
     * @param  str $path         path du fichier
     * @param  str $filecontent  Contenu à injecter dans le fichier
     * @return void
     * @access public
     * @static
     *
     * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     */
    public static function InsererContent($path, $filecontent)
    {
    	$contents = file_get_contents($path);
    	 
    	$fp = fopen($path,"w+");
    	fwrite($fp,$contents . $contenu,strlen($contents . $contenu));
    	fclose($fp);
    }    
    
    /**
     * send the content of a file to the output by chuncks in order to
     * limite the memory consumption.
     * @param $filename
     * @param $retbytes
     * @return stream of bytes by chunks of 1Mo
     */
    public static function readfileChunked ($filename, $retbytes=false)
    {
        $chunksize = 1*(1024*1024); // how many bytes per chunk
        $buffer = '';
        $cnt =0;
        $handle = fopen($filename, 'rb');
        if ($handle === false) {
            return false;
        }
        while (!feof($handle)) {
            $buffer = fread($handle, $chunksize);
            echo $buffer;
            ob_flush();
            flush();
            if ($retbytes) {
                $cnt += $this->binaryStrLen($buffer);
            }
        }
        $status = fclose($handle);
        if ($retbytes && $status) {
            return $cnt; // return num. bytes delivered like readfile() does.
        }
        return $status;
    }
    
    /**
     *
     * @param $file file to send (typically an image)
     * @param $cacheTime, cache time in seconds for the browser
     * @param $mime mime type
     * @return void
     */
    public static function getFile($file, $cacheTime, $mime=null, $name=null)
    {
        //First, see if the file exists
        if (!is_file($file)) {
            throw new \Exception(
                    "Download Manager : file [$file] doesn't exist"
            );
        }
    
        // ENO modif, required for IE
        if (ini_get('zlib.output_compression')) {
            ini_set('zlib.output_compression', 'Off');
        }
    
        $ctype = $this->getMimeContentType($file);
        if ($mime != null) {
            $ctype = $mime;
        }
    
        header('Cache-Control: public, max-age='.$cacheTime);
        header('Expires: '.gmdate("D, d M Y H:i:s", time()+$cacheTime)." GMT");
        header('Pragma: cache');
        header('Content-type: '.$ctype);
        header('Content-length: '.filesize($file));
        if ($name != null) {
            header("Content-Disposition: attachment; filename=\"" . $name . "\"");
        }
        $this->readfileChunked($file);
        exit;
    }
    
    /**
     * returns the mime content type of a $file. Use file_info if it is
     * installed
     * @param string $fileName
     * @return string mime content type
     */
    public static function getMimeContentType($fileName)
    {
        if (function_exists('mime_content_type')) {
            return mime_content_type($fileName);
        }
    
        $mimeTypes = array(
                'txt' => 'text/plain',
                'htm' => 'text/html',
                'html' => 'text/html',
                'php' => 'text/html',
                'css' => 'text/css',
                'js' => 'application/javascript',
                'json' => 'application/json',
                'xml' => 'application/xml',
                'swf' => 'application/x-shockwave-flash',
                'flv' => 'video/x-flv',
    
                // images
                'png' => 'image/png',
                'jpe' => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'jpg' => 'image/jpeg',
                'gif' => 'image/gif',
                'bmp' => 'image/bmp',
                'ico' => 'image/vnd.microsoft.icon',
                'tiff' => 'image/tiff',
                'tif' => 'image/tiff',
                'svg' => 'image/svg+xml',
                'svgz' => 'image/svg+xml',
    
                // archives
                'zip' => 'application/zip',
                'rar' => 'application/x-rar-compressed',
                'exe' => 'application/x-msdownload',
                'msi' => 'application/x-msdownload',
                'cab' => 'application/vnd.ms-cab-compressed',
    
                // audio/video
                'mp3' => 'audio/mpeg',
                'qt' => 'video/quicktime',
                'mov' => 'video/quicktime',
                'avi' => "video/x-msvideo",
    
                // adobe
                'pdf' => 'application/pdf',
                'psd' => 'image/vnd.adobe.photoshop',
                'ai' => 'application/postscript',
                'eps' => 'application/postscript',
                'ps' => 'application/postscript',
    
                // ms office
                'doc' => 'application/msword',
                'rtf' => 'application/rtf',
                'xls' => 'application/vnd.ms-excel',
                'ppt' => 'application/vnd.ms-powerpoint',
    
                // open office
                'odt' => 'application/vnd.oasis.opendocument.text',
                'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
    
                // application store
        // over the air blackberry
                'jad' => 'text/vnd.sun.j2me.app-descriptor',
                // over the air blackberry
                'cod' => 'application/vnd.rim.cod',
                // over the air Android
                'apk' => 'application/vnd.android.package-archive',
                // blackberry over the air
                'jar' => 'application/java-archive'
        );
    
        $ext = strtolower(pathinfo("$fileName", PATHINFO_EXTENSION));
        if (array_key_exists($ext, $mimeTypes)) {
            return $mimeTypes[$ext];
        } elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $fileName);
            finfo_close($finfo);
            return $mimetype;
        }
        return 'application/octet-stream';
    }
    
    /**
     * returns encode a sring in url
     * @param string $value
     * @return string
     */
    public static function urlPathEncode($value)
    {
        // cas de la valeur null
        if (is_null($value)) {
            return "";
        }
        // plus d'accents
        $a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕç';
        $b = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRrc';
        $value = utf8_decode($value);
        $value = strtr($value, utf8_decode($a), $b);
        $value = strtolower($value);
        // ponctuation
        $value = strtr($value, utf8_decode("'\""), "__");
        // autres caracteres
        $value = preg_replace("/[^a-z0-9\-\_]/","-",$value);
        return $value;
    }
    
    /**
     * generate a file path from an id.
     * 
     *  @param string $mode
     *   @param int $id
     * @access public
     * @return string
     */
    public static function generatePath($mode, $id)
    {
    	$input=''.$id;
    	// 15567    => /7/15/56/7/@/
    	// 6871985  => /5/68/71/98/5/@/
    	// 687198565   /5/68/71/98/56/5/@/
    	// 68719856    /6/68/71/98/56/@/
    	// 21          /1/21/@/
    	// 2121        /1/21/21/@/
    	// 1           /1/1/@
    	// antix       /x/an/ti/x/@/
    	$len=strlen($input);
    	if ($len==0) {
    		return $mode.'/';
    	} elseif ($len==1) {
    		$output=$input . '/' . $input;
    	} else {
    		$output=$input{$len-1} . '/';
    		for ($i=0; $i<$len-1; $i++) {
    			$output.=substr($input, $i, 1);
    			if ($i%2) {
    				$trailing='/';
    			} else {
    				$trailing='';
    			}
    			$output.=$trailing;
    		}
    		$output.=$input{$len-1};
    	}
    	$output.='/';
    	
    	return $mode.'/' . $output;
    }    
}