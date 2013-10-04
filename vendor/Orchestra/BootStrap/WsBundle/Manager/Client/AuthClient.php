<?php

/**
 * This file is part of the <web service> project.
 *
 * @category Ws_Manager
 * @package  Manager
 * @author   Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @copyright Copyright (c) 2013, Mappy
 * @since 2013-03-26
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BootStrap\WsBundle\Manager\Client;

use Symfony\Component\DependencyInjection\ContainerInterface;
use BootStrap\WsBundle\Manager\Client\AbstractClient;
use phpbrowscap\Browscap;

/**
 * Authentification client
 * 
 * @category Ws_Manager
 * @package  Manager 
 * @author   Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class AuthClient extends AbstractClient
{
    /**
     * @var string
     */
    private $_key;

    /**
     * @var string
     */
    private $_url;
    
    /**
     * @var string
     */
    private $_method;    

    /**
     * @var string
     */
    private $_format;

    /**
     * @var string
     */
    private $_getparams;

    /**
     * @var \PiApp\AdminBundle\Util\PiLogManager
     */
    private $_logger;

    /**
     * Constructor.
     *
     * @param \Symfony\Component\DependencyInjection\ContainerInterface    $container
     * @param string $clientname
     * @access public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function __construct(ContainerInterface $container, $clientname)
    {
        parent::__construct($container, $clientname);
    }

    /**
     * Gets socloz request with parameters.
     *
     * Here is an inline example:
     * <code>
     *         {% set resultat_default_handler = ws_auth.getDefault('getpermisssion', 'GET', {'q':'jup', 'lat':48.866667, 'long':2.333333}) %}
     * </code>
     *
     * @param string $handler
     * @param string $method
     * @param string $slug
     * @param array $getparams
     * @return mixed
     * @access public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function getPermission($handler, $getparams = null)
    {
        //-----we initialize de logger-----
        $this->_logger = $this->getContainer()->get('pi_app_admin.log_manager');
        $this->_logger->setInit('log_client_auth', date("YmdH"));        
        //-----we set info in the logger-----
        $this->_logger->setInfo(date("Y-m-d H:i:s") . " [BEGIN GET PERMISSION AUTH REQUEST]");
        //-----we set the url-----
        $this->setParams($handler, $getparams);
        //-----we return the content of the socloz request-----
        switch ($this->_method) {
            case "GET":
                $result = $this->getRest()->setUrl($this->_url)->get($this->_getparams);
                break;
            case "POST":
                $result = $this->getRest()->setUrl($this->_url)->post($this->_getparams);
                break;
            case "PUT":
                $result = $this->getRest()->setUrl($this->_url)->put($this->_getparams);
                break;
            case "DELETE":
                $result = $this->getRest()->setUrl($this->_url)->delete($this->_getparams);
                break;
            default:
                $result = $this->getRest()->setUrl($this->_url)->get($this->_getparams);
                break;
        }
        
        //-----we set errors in the logger-----
        if (!isset($result['content']) || (isset($result['content']) && isset($result['url']) && ($result['content'] == false))) {
            $this->_logger->setErr(date("Y-m-d H:i:s") . " [LOG] Error default request with following params : ");
            $this->_logger->setErr(date("Y-m-d H:i:s") . " [LOG] param handler :" . $handler);
            $this->_logger->setErr(date("Y-m-d H:i:s") . " [LOG] param method :" . $this->_method);
            $this->_logger->setErr(date("Y-m-d H:i:s") . " [LOG] auth url :" . $this->getContainer()->get('request')->getUri());
            if (isset($result['url'])) {
                $this->_logger->setErr(date("Y-m-d H:i:s") . " [LOG] param url :" . $result['url']);
            }
        } else {
            $this->_logger->setInfo(date("Y-m-d H:i:s") . " [URL] " . $result['url']);
        }
        //-----we set info in the logger-----
        $this->_logger->setInfo(date("Y-m-d H:i:s") . " [END]");
        //-----we save in the file log-----
        $env = $this->getContainer()->get("kernel")->getEnvironment();
        $clientname = $this->getClient();
        $is_debug = $this->config[$clientname]['log'][$env];
        if ($is_debug){
            $this->_logger->save();
        }
        
        return $result;
    }

    /**
     * Sets the url
     *
     * @param string $handler name of the handler.
     * @param array    $getparams
     * @return void
     * @access private
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    private function setParams($handler, $getparams = null)
    {
        $clientname = $this->getClient();
        if (isset($this->config[$clientname]['handlers'][$handler])) {
            $this->_key = $this->config[$clientname]['handlers'][$handler]['key'];
            $this->_method = $this->config[$clientname]['handlers'][$handler]['method'];
            $this->_format = $this->config[$clientname]['handlers'][$handler]['format'];
            $this->_getparams = array_merge($getparams, array('ws_key' => $this->_key, 'ws_format' => $this->_format));
            $this->_url = $this->config[$clientname]['handlers'][$handler]['api'];
        } else {
            //-----we set info in the logger-----
            $this->_logger->setErr(date("Y-m-d H:i:s") . " [LOG] Error with the config handler <" . $handler . "> in the config.yml file.");
        }
    }
}