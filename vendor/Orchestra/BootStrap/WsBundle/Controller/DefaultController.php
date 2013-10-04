<?php

/**
 * This file is part of the <mappy shopping> project.
 *
 * @category Ws_Controller
 * @package  Controller
 * @author   Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @copyright Copyright (c) 2013, Mappy
 * @since 2013-03-26
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BootStrap\WsBundle\Controller;

use BootStrap\WsBundle\Exception\ClientException;
use BootStrap\TranslationBundle\Controller\abstractController;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * This controller is made for define all webservices.
 * 
 * @category Ws_Controller
 * @package Controller
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class DefaultController extends abstractController
{
    /**
     * Template : test
     *
     * @Route("/ws/test", name="ws_request_test")
     * @return \Symfony\Component\HttpFoundation\Response
     * @access  public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function indexAction()
    {
    	return $this->render('BootStrapWsBundle:Default:index.html.twig');
    }
        
    /**
     * Check the demand management of authentication permission.
     *
     * @Route("/ws/auth/get/permisssion", name="ws_auth_getpermission")
     * @return \Symfony\Component\HttpFoundation\Response
     * @access  public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function getAuthPermisssionAction()
    {
        $request        = $this->container->get('request');
    	$em             = $this->getDoctrine()->getEntityManager();
    	
    	if (!$request->get('ws_key', false) || !$request->get('ws_format', false) || !$request->get('ws_user_id', false) || !$request->get('ws_application', false)) {
    	    throw ClientException::callBadAuthRequest(__CLASS__);
    	}

    	$key            = $request->get('ws_key', '');
    	$format         = $request->get('ws_format', 'json');
    	$userId         = $this->container->get('pi_app_admin.twig.extension.tool')->decryptFilter($request->get('ws_user_id', null), $key);
    	$application    = $this->container->get('pi_app_admin.twig.extension.tool')->decryptFilter($request->get('ws_application', null), $key);
    	
    	// we check if the user ID exists in the authentication service.
    	// If the user ID doesn't exist, we generate.
    	if (!$this->isUserdIdExisted($userId)) {
    	    throw ClientException::callBadAuthRequest(__CLASS__);
    	} else {
    	    // else we get the token associated to the user ID.
    	    $token           = $this->getTokenByUserIdAndApplication($userId, $application);
    	    if ($token) {
    	        $isAuthorization = true;
    	    } else {
    	        $token            = strtoupper(\PiApp\AdminBundle\Util\PiStringManager::random(24));
    	        $isAuthorization  = false;
    	    }
    	}
    	
    	if ($format == 'json') {
        	$tab                  = array();
        	$tab['authorization'] = $isAuthorization;
        	$tab['token']         = $this->container->get('pi_app_admin.twig.extension.tool')->encryptFilter($token, $key);
        	
        	$response = new Response(json_encode($tab));
        	$response->headers->set('Content-Type', 'application/json');
    	}
    	
    	return $response;    	
    }
    
    /**
     * Check the demand management of authentication permission.
     *
     * @Route("/ws/auth/validate/token", name="ws_auth_validatetoken")
     * @return \Symfony\Component\HttpFoundation\Response
     * @access  public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function validateTokenAction()
    {
    	$request = $this->container->get('request');
    	$em = $this->getDoctrine()->getEntityManager();
    	
        if (!$request->get('ws_key', false) || !$request->get('ws_format', false) || !$request->get('ws_user_id', false) || !$request->get('ws_token', false) || !$request->get('ws_application', false)) {
    	    throw ClientException::callBadAuthRequest(__CLASS__);
    	}  	

    	$key     = $request->get('ws_key', '');
    	$format     = $request->get('ws_format', 'json');
    	$userId     = $this->container->get('pi_app_admin.twig.extension.tool')->decryptFilter($request->get('ws_user_id', null), $key);
    	$token     = $this->container->get('pi_app_admin.twig.extension.tool')->decryptFilter($request->get('ws_token', null), $key);
    	$application    = $this->container->get('pi_app_admin.twig.extension.tool')->decryptFilter($request->get('ws_application', null), $key);
    	
    	// If the user ID exists,
    	// we associate the token to the userId
    	if ($this->isUserdIdExisted($userId)) {
    		$success = $this->setAssociationUserIdWithApplicationToken($userId, $token, $application);
    	} else {
    		$success = false;
    	}
            	 
    	if ( $success && ($format == 'json') ) {
    	    $tab= array();
    	    $tab['access_token'] = true;
    
        	$response = new Response(json_encode($tab));
    	    $response->headers->set('Content-Type', 'application/json');
    	}
    	 
    	return $response;
    }    
    
    /**
     * Check the result request of a socloz url.
     *
     * @Route("/ws/auth/ajax/get", name="ws_auth_ajax")
     * @return \Symfony\Component\HttpFoundation\Response
     * @access  public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function _ajax_getAuthAction()
    {
    	$request = $this->container->get('request');
    	$em = $this->getDoctrine()->getEntityManager();
    	$result = array();
    
    	$handler     = $request->get('handler', '');
    	$getParams     = $request->get('getParams', null);
    	// we set the ws request
    	if ($handler == 'getpermisssion') {
   		    $result = $this->container->get('ws.client.auth')->getPermission($handler, $getParams);
    	} elseif ($handler == 'validatetoken') {
    	    $result = $this->container->get('ws.client.auth')->getPermission($handler, $getParams);
    	}
    	// we throw an exception if ws return false
    	$get_http_response_code = intval(substr($result['header'][0], 9, 3));
    	if ($get_http_response_code != 200){
    		//-----we initialize de logger-----
    		$this->_logger = $this->container->get('pi_app_admin.log_manager');
    		$this->_logger->setInit('log_client_auth_bad_request', date("YmdH"));
    		//-----we set info in the logger-----
    		$this->_logger->setInfo(date("Y-m-d H:i:s") . " [BEGIN BAD AUTH REQUEST]");
    		//-----we set errors in the logger-----
    		$this->_logger->setErr(date("Y-m-d H:i:s") . " [LOG] mappy url :" . $request->getUri());
    		$this->_logger->setErr(date("Y-m-d H:i:s") . " [LOG] param url :" . $result['url']);
    		//-----we set info in the logger-----
    		$this->_logger->setInfo(date("Y-m-d H:i:s") . " [END]");
    		//-----we save in the file log-----
    		$this->_logger->save();
    		throw ClientException::callBadAuthRequest(__CLASS__);
    	} else {
    		// we hide the value of the url
    		if (isset($result['url'])) {
    			unset($result['url']);
    		}
    		if (isset($result['header'])) {
    			unset($result['header']);
    		}
    		$response = new Response(json_encode($result));
    		$response->headers->set('Content-Type', 'application/json');
    
    		return $response;
    	}
    }    
}