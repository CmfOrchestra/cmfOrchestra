<?php
/**
 * This file is part of the <Gedmo> project.
 *
 * @category   Bundle
 * @package    PiApp
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\GedmoBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;


/**************************  MATRIX FORM BUILDER ***************************/
$GLOBALS['FORM']['WIDGET'] = array(
		'snippet'			=> 'pi_app_admin.formbuilder_manager.model.snippet',
		'block'				=> 'pi_app_admin.formbuilder_manager.model.block',
		'content'			=> 'pi_app_admin.formbuilder_manager.model.content',
		//'slide'				=> 'pi_app_admin.formbuilder_manager.model.slide',
);

/**************************  MATRIX SLUGGABLE ROUTE ***************************/
$GLOBALS['ROUTE']['SLUGGABLE'] = array();

/**************************  MATRIX LISTENER ***************************/
$GLOBALS['GEDMO_WIDGET_LISTENER']['media'] = array(
		'method' => array('_template_show', '_template_list'),
		'_template_show'	 => array(
				'edit'		=> 'admin_gedmo_media_edit',
		),
		'_template_list'	 => array(
				'edit'		=> 'admin_gedmo_media',
		),
);
$GLOBALS['GEDMO_WIDGET_LISTENER']['block'] = array(
		'method' => array('_template_show', '_template_list'),
		'_template_show'	 => array(
				'edit'		=> 'admin_gedmo_block_edit',
		),
		'_template_list'	 => array(
				'edit'		=> 'admin_gedmo_block',
		),
);
$GLOBALS['GEDMO_WIDGET_LISTENER']['content'] = array(
		'method' => array('_template_show', '_template_list'),
		'_template_show'	 => array(
				'edit'		=> 'admin_gedmo_content_edit',
		),
		'_template_list'	 => array(
				'edit'		=> 'admin_gedmo_content',
		),
);
/**************************  MATRIX NAVIGATION ***************************/
$GLOBALS['GEDMO_WIDGET_NAVIGATION']['menu'] = array(
		'method' => array('_navigation_default'),
		'_navigation_default' => array(
				'edit'		=> 'admin_gedmo_menu_tree',
		)
);
$GLOBALS['GEDMO_WIDGET_NAVIGATION']['organigram'] = array(
		'method' => array('_navigation_default'),
		'_navigation_default' => array(
				'edit'		=> 'admin_gedmo_organigram_tree',
		)
);
/**************************  MATRIX ORGANIGRAM ***************************/
$GLOBALS['GEDMO_WIDGET_ORGANIGRAM']['rubrique'] = array(
		'method' => array('org-chart-page')
);
$GLOBALS['GEDMO_WIDGET_ORGANIGRAM']['menu'] = array(
		'method' => array('org-chart-page'),
		'org-chart-page' => array(
				'edit'		=> 'admin_gedmo_menu_tree',
		)
);
$GLOBALS['GEDMO_WIDGET_ORGANIGRAM']['organigram'] = array(
		'method' => array('org-chart-page', 'org-tree-semantique'),
		'org-chart-page' => array(
				'edit'		=> 'admin_gedmo_organigram_tree',
		),
		'org-tree-semantique' => array(
				'edit'		=> 'admin_gedmo_organigram_semantique',
		)
);
/**************************  MATRIX SLIDER ***************************/
$GLOBALS['GEDMO_WIDGET_SLIDER']['slider'] = array(
		'method' => array('slide-default'),
		'slide-default'	 => array(
				'edit'		=> 'admin_gedmo_slider',
		)
);

/**
 * BootStrap configuration and managment Bundle
 *
 * @category   Bundle
 * @package    PiApp
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class PiAppGedmoBundle extends Bundle
{
	/**
	 * Builds the bundle.
	 *
	 * It is only ever called once when the cache is empty.
	 *
	 * This method can be overridden to register compilation passes,
	 * other extensions, ...
	 *
	 * @param ContainerBuilder $container A ContainerBuilder instance
	 */
	public function build(ContainerBuilder $container)
	{
		parent::build($container);
		//print_r('PiApptest1');
	}
	
	/**
	 * Boots the Bundle.
	 */
	public function boot()
	{
		//print_r('PiApptest2');
	}	
	
	/**
	 * Shutdowns the Bundle.
	 */
	public function shutdown()
	{
	}	
		
}
