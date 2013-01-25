<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Managers
 * @package    Manager
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-06-13
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Manager;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response as Response;

use PiApp\AdminBundle\Builder\PiJqextManagerBuilderInterface;
use PiApp\AdminBundle\Manager\PiCoreManager;

/**
 * Description of the jquery Extension manager
 *
 * @category   Admin_Managers
 * @package    Manager
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiJqextManager extends PiCoreManager implements PiJqextManagerBuilderInterface 
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
	 * Call the slider render source method.
	 *
	 * @param string $id
	 * @param string $lang
	 * @param string $params
	 * @return string
	 * @access	public
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-04-25
	 */
	public function renderSource($id, $lang = '', $params = null)
	{
		str_replace('~', '~', $id, $count);
		
		if($count == 1)
			list($JQcontainer, $JQservice) = explode('~', $this->_Decode($id));
		else
			throw new \InvalidArgumentException("you have not configure correctly the attibute id");
		
		if(!is_array($params))
			$params			= $this->paramsDecode($params);
		else
			$this->recursive_map($params);
		
		$params['locale']	= $lang;
		
		if( isset($GLOBALS['JQUERY'][$JQcontainer][$JQservice]) && $this->container->has($GLOBALS['JQUERY'][$JQcontainer][$JQservice]) )
			return $this->container->get('pi_app_admin.twig.extension.jquery')->FactoryFunction($JQcontainer, $JQservice, $params);
		else
			throw new \InvalidArgumentException("you have not configure correctly the attibute id");
	}	
}