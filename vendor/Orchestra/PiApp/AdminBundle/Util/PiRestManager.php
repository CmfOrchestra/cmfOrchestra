<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category Admin_Utils
 * @package Manager
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2013-03-26
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Util;

use PiApp\AdminBundle\Builder\PiRestManagerInterface;

/**
 * Description of the REST manager.
 *
 * Here is an inline example:
 * <code>
 * $rest = $this->cointainer->get('pi_app_admin.rest_manager');
 * //lecture d'un magasin
 * $magasin = $rest->setUrl('http://api.socloz.com/v2/shop/id/1.xml')->get();
 * //ecriture d'un magasin
 * $rest->setUrl('http://api.socloz.com/v2/shop')->post($unMagasin);
 * //modification d'un magasin
 * $rest->setUrl('http://api.socloz.com/v2/shop/id/1.xml')->put($unMagasin);
 * //supression d'un magasin
 * $rest->setUrl('http://api.socloz.com/v2/shop/id/11.xml')->delete();
 * </code>
 * 
 * @category Admin_Utils
 * @package Manager
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiRestManager implements PiRestManagerInterface
{
    /**
     * @var string
     */    
   private $_url;
   
   /**
    * Constructor.
    * 
    * @access public
    * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
    */
   public function __construct()
   {
   }   

   /**
    * Sets the url
    *
    * @param string    $slug
    * @return \PiApp\AdminBundle\Util\PiRestManager
    * @access public
    * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
    */   
   public function setUrl ($pUrl)
   {
      $this->_url = $pUrl;
      return $this;
   }
 
   /**
    * Launch a url with GET request
    *
    * @param array $pGetParams an array or object containing properties.
    * @return array Content and header result of the request.
    * @access public
    * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
    */   
   public function get ($pGetParams = array())
   {
      return $this->_launch($this->_makeUrl($pGetParams), $this->_createContext('GET'));
   }
 
   /**
    * Launch a url with POST request
    *
    * @param array $pGetParams an array or object containing properties.
    * @param mixed $pPostParams    content or an array or object containing properties.
    * @return array Content and header result of the request.
    * @access public
    * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
    */   
   public function post ($pGetParams = array(), $pPostParams=array())
   {
      return $this->_launch($this->_makeUrl($pGetParams), $this->_createContext('POST', $pPostParams));
   }
    
   /**
    * Launch a url with PUT request
    *
    * @param array $pGetParams an array or object containing properties.
    * @param mixed $pContent content or an array or object containing properties.
    * @return array Content and header result of the request.
    * @access public
    * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
    */   
   public function put ($pGetParams = array(), $pContent = null)
   {
      return $this->_launch($this->_makeUrl($pGetParams), $this->_createContext('PUT', $pContent));
   }
    
   /**
    * Launch a url with DELETE request
    *
    * @param array $pGetParams an array or object containing properties.
    * @param mixed $pContent content or an array or object containing properties.
    * @return array Content and header result of the request.
    * @access public
    * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
    */   
   public function delete ($pGetParams = array(), $pContent = null)
   {
      return $this->_launch($this->_makeUrl($pGetParams), $this->_createContext('DELETE', $pContent));
   }
    
   /**
    * Creation of a call context.
    *
    * @param string $pMethod ['GET','POST','PUT','DELETE']
    * @param mixed $pContent content or an array or object containing properties.
    * @return resources stream context resource
    * @access protected
    * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
    */   
   protected function _createContext($pMethod, $pContent = null)
   {
      $opts = array(
              'http'=>array(
                            'method'=>$pMethod, 
                            'header'=>'Content-type: application/x-www-form-urlencoded',
                          )
      );
      if ($pContent !== null){
         if (is_array($pContent)){
            $pContent = http_build_query($pContent);
         }
         $opts['http']['content'] = $pContent; 
      }
      
      return stream_context_create($opts);
   }
    
   /**
    * Sets the url.
    *
    * @param mixed $pParams an array or object containing properties.
    * @return string the url of the request
    * @access private
    * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
    */   
   protected function _makeUrl($pParams)
   {
      return $this->_url
             . (strpos($this->_url, '?') ? '' : '?')
             . http_build_query($pParams);
   }
    
   /**
    * Launch a url with a GET/PUT/POST/DELETE request
    *
    * @param string $pUrl
    * @param resources $context
    * @return array Content and header result of the request.
    * @access protected
    * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
    */   
   protected function _launch ($pUrl, $context)
   {
        if (($stream = @fopen($pUrl, 'r', false, $context)) !== false) {
            $content = stream_get_contents($stream);
            $header = stream_get_meta_data($stream);
            fclose($stream);
            
            return array('content' => $content, 'header' => $header['wrapper_data'], 'url' => $pUrl);
        } else {
            $header = get_headers($pUrl);
            
            return array('content' => false, 'header' => $header, 'url' => $pUrl);
        }         
   }   
}