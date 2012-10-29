<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Managers
 * @package    Manager
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-02-15
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Manager;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response as Response;

use PiApp\AdminBundle\Builder\PiTransWidgetManagerBuilderInterface;
use PiApp\AdminBundle\Manager\PiCoreManager;
use PiApp\AdminBundle\Entity\Widget;

/**
 * Description of the Translation Widget manager
 *
 * @category   Admin_Managers
 * @package    Manager
 * 
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class PiTransWidgetManager extends PiCoreManager implements PiTransWidgetManagerBuilderInterface 
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
	 * Returns the render source of a translation widget.
	 *
	 * @param string $id
	 * @param string $lang
	 * @param array	 $params
	 * @return string
	 * @access	public
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-02-15
	 */
	public function renderSource($id, $lang = '', $params = null)
	{
		// we get the translation of the current TranslationWidget.
		$widgetTrans	 = $this->getRepository('TranslationWidget')->find($id);

		if( ($widgetTrans instanceof \PiApp\AdminBundle\Entity\TranslationWidget) && $widgetTrans->getEnabled())
			return $widgetTrans->getContent();
		else
			return '&nbsp;';
	}	
	
}