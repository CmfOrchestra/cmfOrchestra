<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Twig
 * @package    Extension
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-03
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Action Functions used in twig
 *
 * @category   Admin_Twig
 * @package    Extension
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiForwardExtension extends \Twig_Extension
{
	/**
	 * @var \Symfony\Component\DependencyInjection\ContainerInterface
	 */	
    private $container;

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
     * Returns the name of the extension.
     *
     * @return string The extension name
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function getName()
    {
    	return 'admin_forward_extension';
    }    
    
    /**
     * Returns a list of functions to add to the existing list.
     *
     * <code>
     *  {{ renderForward('PiAppAdminBundle:Page:new') }}
     * </code>
     *
     * @return array An array of functions
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function getFunctions()
    {
    	return array(
    			'renderForward'  => new \Twig_Function_Method($this, 'renderForwardFunction'),
    	);
    }    

    /**
     * Returns the Response content for a given controller or URI.
     *
     * @param string $controller The controller name
     * @param array  $params    An array of params
     * 
     * @return string
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function renderForwardFunction($controller, $params = array())
    {
        if (strpos($controller, ':') == false)
            $controller = 'PiAppAdminBundle:Frontend:index';
        
        $response = $this->container->get('http_kernel')->forward($controller, $params);        

        return $response->getContent();
    }
}