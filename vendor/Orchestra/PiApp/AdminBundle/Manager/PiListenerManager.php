<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Managers
 * @package    Manager
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-04-25
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Manager;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Response as Response;

use PiApp\AdminBundle\Builder\PiListenerManagerBuilderInterface;
use PiApp\AdminBundle\Manager\PiCoreManager;
use PiApp\AdminBundle\Entity\Widget;

/**
 * Description of the listener Widget manager
 *
 * @category   Admin_Managers
 * @package    Manager
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiListenerManager extends PiCoreManager implements PiListenerManagerBuilderInterface 
{    
    /**
     * Constructor.
     *
     * @param ContainerInterface $container The service container
     */
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
    }

    /**
     * Call the tree render source method.
     *
     * @param string $id
     * @param string $lang
     * @param string $params
     * @return string
     * @access    public
     *
     * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     * @since 2012-04-25
     */
    public function renderSource($id, $lang = '', $params = null)
    {
        $id                = $this->_Decode($id);
        
        if (!is_array($params))
            $params        = $this->paramsDecode($params);
        else
            $this->recursive_map($params);
        
        $params['lang']     = $lang;
        $params['_route']    = $this->container->get('request')->get('_route');
        
        // this allow Redirect Response in controller action
        $params['_controller'] = $id;
        $subRequest = $this->container->get('request')->duplicate(array(), null, $params);
        $response =  $this->container->get('http_kernel')->handle($subRequest, HttpKernelInterface::SUB_REQUEST);
        
        if ($response instanceof \Symfony\Component\HttpFoundation\RedirectResponse) {
        	return "<div style='visibility:hidden'>".$response."</div>";
        } else {
        	//return utf8_decode(mb_convert_encoding($response->getContent(), "UTF-8", "HTML-ENTITIES"));
        	$response->getContent();
        }        
        
// 		if (isset($params['isRedirect']) && ( ($params['isRedirect'] == true) || ($params['isRedirect'] == 'true') ) ) {
// 		    // this allow Redirect Response in controller action
// 	        $params['_controller'] = $id;
// 	        $subRequest = $this->container->get('request')->duplicate(array(), null, $params);
// 	        $response =  $this->container->get('http_kernel')->handle($subRequest, HttpKernelInterface::SUB_REQUEST);
	         
// 	        if ($response instanceof \Symfony\Component\HttpFoundation\RedirectResponse) {
// 	        	return "<div style='visibility:hidden'>".$response."</div>";
// 	        } else {
// 	        	return utf8_decode(mb_convert_encoding($response->getContent(), "UTF-8", "HTML-ENTITIES"));
// 	        }
// 		} else {
// 			$strategy = ( isset($params['strategy']) && in_array($params['strategy'], array('inline', 'hinclude')) ) ? $params['strategy'] : 'inline';  //
// 			unset($params['strategy']);
// 			$response =  $this->container->get('fragment.handler')->render($id, $strategy, $params);
// 		}
//		
//		return utf8_decode(mb_convert_encoding($response->getContent(), "UTF-8", "HTML-ENTITIES"));
    }    
}