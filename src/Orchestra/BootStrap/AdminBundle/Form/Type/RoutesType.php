<?php
/**
 * This file is part of the <Admin> project.
 * 
 * @category   Admin_Form
 * @package    Form
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2011-11-17
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\AdminBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Sonata\AdminBundle\Admin\Pool;
use BootStrap\UserBundle\Repository\PermissionRepository;

/**
 * Routes
 *
 * @category   Admin_Form
 * @package    Form
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class RoutesType extends ChoiceType
{
    protected $pool;

    public function __construct(Pool $pool)
    {
        $this->pool = $pool;
    }

    public function getDefaultOptions(array $options)
    {
        $options = parent::getDefaultOptions($options);
        if (count($options['choices']) == 0) {
        	
	        $routeCollection = $this->pool->getContainer()->get('router')->getRouteCollection();
	    	$routes = array();
	    
	    	foreach ($routeCollection->all() as $name => $route) {
	    		$routes[$name] = $name; // $route->compile();
	    	}
        	
	    	krsort($routes);
            $options['choices'] = $routes;
        }
        return $options;
    }
    
}