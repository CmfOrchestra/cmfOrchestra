<?php
/**
 * This file is part of the <Gedmo> project.
 *
 * @category   Bundle
 * @package    PiApp
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
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
		'contact'			=> 'pi_app_admin.formbuilder_manager.model.contact',
		//'slide'				=> 'pi_app_admin.formbuilder_manager.model.slide',
);

/**************************  MATRIX SLUGGABLE ROUTE ***************************/
$GLOBALS['ROUTE']['SLUGGABLE'] = array(
		'page_new_detail'	=> array(
				'entity'		=> 'PiAppGedmoBundle:News',
				'field_search'	=> 'slug',
				'field_title'	=> 'title',
				'field_resume'	=> 'meta_description',
				'field_keywords'=> 'meta_keywords',
		),
);

/**************************  MATRIX ENTITIES of RESTRICTION ROLES ***************************/
$GLOBALS['ENTITIES']['RESTRICTION_BY_ROLES']= array(
		'Proxies\PiAppGedmoBundleEntityMediaProxy',
		'Proxies\BootStrapMediaBundleEntityMediaProxy',
		'PiApp\GedmoBundle\Entity\Media',
		'PiApp\GedmoBundle\Entity\Block',
		'PiApp\GedmoBundle\Entity\Translation\BlockTranslation',
		'PiApp\GedmoBundle\Entity\Content',
		'PiApp\GedmoBundle\Entity\Translation\ContentTranslation',
		'PiApp\GedmoBundle\Entity\News',
		'PiApp\GedmoBundle\Entity\Translation\NewsTranslation',
		'PiApp\GedmoBundle\Entity\Partner',
		'PiApp\GedmoBundle\Entity\Translation\PartnerTranslation',
		'PiApp\GedmoBundle\Entity\Pressrelease',
		'PiApp\GedmoBundle\Entity\Translation\PressreleaseTranslation',
		'PiApp\GedmoBundle\Entity\Contact',
		'PiApp\GedmoBundle\Entity\Translation\ContactTranslation',
);

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
$GLOBALS['GEDMO_WIDGET_LISTENER']['news'] = array(
		'method' => array('_template_show', '_template_list', '_template_archive'),
		'_template_show'	 => array(
				'edit'		=> 'admin_gedmo_news_edit',
		),
		'_template_list'	 => array(
				'edit'		=> 'admin_gedmo_news',
		),
		'_template_archive'	 => array(
				'edit'		=> 'admin_gedmo_news',
		),
);
$GLOBALS['GEDMO_WIDGET_LISTENER']['partner'] = array(
		'method' => array('_template_show', '_template_list'),
		'_template_show'	 => array(
				'edit'		=> 'admin_gedmo_partner_edit',
		),
		'_template_archive'	 => array(
				'edit'		=> 'admin_gedmo_partner',
		),
);
$GLOBALS['GEDMO_WIDGET_LISTENER']['pressrelease'] = array(
		'method' => array('_template_show', '_template_list', '_template_archive'),
		'_template_show'	 => array(
				'edit'		=> 'admin_gedmo_pressrelease_edit',
		),
		'_template_archive'	 => array(
				'edit'		=> 'admin_gedmo_pressrelease',
		),
		'_template_archive'	 => array(
				'edit'		=> 'admin_gedmo_pressrelease',
		),
);
$GLOBALS['GEDMO_WIDGET_LISTENER']['contact'] = array(
		'method' => array('_template_show', '_template_list'),
		'_template_show'	 => array(
				'edit'		=> 'admin_gedmo_contact_edit',
		),
		'_template_list'	 => array(
				'edit'		=> 'admin_gedmo_contact',
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
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
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