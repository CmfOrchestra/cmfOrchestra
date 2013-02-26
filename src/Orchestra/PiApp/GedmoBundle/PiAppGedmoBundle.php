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
$GLOBALS['ENTITIES']['RESTRICTION_BY_MEDIA']= array(
//		'getBlock',
//		'getContent',
//		'getNew',
//		'getPartner',
//		'getPressrelease',
//		'getContact',
);
$GLOBALS['ENTITIES']['RESTRICTION_BY_ROLES']= array(
		'Proxies\PiAppGedmoBundleEntityMediaProxy' => true,
		'Proxies\BootStrapMediaBundleEntityMediaProxy' => true,
		
// 		'PiApp\GedmoBundle\Entity\Block' => true,
// 		'PiApp\GedmoBundle\Entity\Translation\BlockTranslation' => true,
// 		'PiApp\GedmoBundle\Entity\Content' => true,
// 		'PiApp\GedmoBundle\Entity\Translation\ContentTranslation' => true,
// 		'PiApp\GedmoBundle\Entity\News' => true,
// 		'PiApp\GedmoBundle\Entity\Translation\NewsTranslation' => true,
// 		'PiApp\GedmoBundle\Entity\Partner' => true,
// 		'PiApp\GedmoBundle\Entity\Translation\PartnerTranslation' => true,
// 		'PiApp\GedmoBundle\Entity\Pressrelease' => true,
// 		'PiApp\GedmoBundle\Entity\Translation\PressreleaseTranslation' => true,
// 		'PiApp\GedmoBundle\Entity\Contact' => true,
// 		'PiApp\GedmoBundle\Entity\Translation\ContactTranslation' => true,
);

$GLOBALS['ENTITIES']['AUTHORIZATION_PREPERSIST']= array(
		'BootStrap\MediaBundle\Entity\Media'	=> true,
		'PiApp\GedmoBundle\Entity\Media'	=> true,
		'Proxies\PiAppGedmoBundleEntityMediaProxy'	=> true,
		'Proxies\BootStrapMediaBundleEntityMediaProxy'	=> true,	
		
		'BootStrap\UserBundle\Entity\User' => true,
		'Proxies\BootStrapUserBundleEntityUserProxy'=> true,
		'PiApp\GedmoBundle\Entity\Individual'=> true,
		'PiApp\GedmoBundle\Entity\Translation\IndividualTranslation'=> true,
		'PiApp\GedmoBundle\Entity\Corporation'=> true,
		'PiApp\GedmoBundle\Entity\Translation\CorporationTranslation'=> true,
);
$GLOBALS['ENTITIES']['AUTHORIZATION_PREUPDATE']= array(
		'BootStrap\MediaBundle\Entity\Media'	=> true,
		'PiApp\GedmoBundle\Entity\Media'	=> true,
		'Proxies\PiAppGedmoBundleEntityMediaProxy'	=> true,
		'Proxies\BootStrapMediaBundleEntityMediaProxy'	=> true,	
		
		'BootStrap\UserBundle\Entity\User' => true,
		'Proxies\BootStrapUserBundleEntityUserProxy'=> true,
		'PiApp\GedmoBundle\Entity\Individual'=> true,
		'PiApp\GedmoBundle\Entity\Translation\IndividualTranslation'=> true,
		'PiApp\GedmoBundle\Entity\Corporation'=> true,
		'PiApp\GedmoBundle\Entity\Translation\CorporationTranslation'=> true,
);
$GLOBALS['ENTITIES']['AUTHORIZATION_PREREMOVE']= array(
		'BootStrap\MediaBundle\Entity\Media'	=> true,
		'PiApp\GedmoBundle\Entity\Media'	=> true,
		'Proxies\PiAppGedmoBundleEntityMediaProxy'	=> true,
		'Proxies\BootStrapMediaBundleEntityMediaProxy'	=> true,	
		
		'BootStrap\UserBundle\Entity\User' => true,
		'Proxies\BootStrapUserBundleEntityUserProxy'=> true,
		'PiApp\GedmoBundle\Entity\Individual'=> true,
		'PiApp\GedmoBundle\Entity\Translation\IndividualTranslation'=> true,
		'PiApp\GedmoBundle\Entity\Corporation'=> true,
		'PiApp\GedmoBundle\Entity\Translation\CorporationTranslation'=> true,
);

/**************************  MATRIX LISTENER ***************************/
$GLOBALS['GEDMO_WIDGET_LISTENER']['PiAppGedmoBundle:Media'] = array(
		'method' => array('_template_show', '_template_list'),
		'_template_show'	 => array(
				'edit'		=> 'admin_gedmo_media_edit',
		),
		'_template_list'	 => array(
				'edit'		=> 'admin_gedmo_media',
		),
);
$GLOBALS['GEDMO_WIDGET_LISTENER']['PiAppGedmoBundle:Block'] = array(
		'method' => array('_template_show', '_template_list'),
		'_template_show'	 => array(
				'edit'		=> 'admin_gedmo_block_edit',
		),
		'_template_list'	 => array(
				'edit'		=> 'admin_gedmo_block',
		),
);
$GLOBALS['GEDMO_WIDGET_LISTENER']['PiAppGedmoBundle:Content'] = array(
		'method' => array('_template_show', '_template_list'),
		'_template_show'	 => array(
				'edit'		=> 'admin_gedmo_content_edit',
		),
		'_template_list'	 => array(
				'edit'		=> 'admin_gedmo_content',
		),
);
$GLOBALS['GEDMO_WIDGET_LISTENER']['PiAppGedmoBundle:News'] = array(
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
$GLOBALS['GEDMO_WIDGET_LISTENER']['PiAppGedmoBundle:Partner'] = array(
		'method' => array('_template_show', '_template_list', '_template_annuaire'),
		'_template_show'	 => array(
				'edit'		=> 'admin_gedmo_partner_edit',
		),
		'_template_archive'	 => array(
				'edit'		=> 'admin_gedmo_partner',
		),
		'_template_annuaire'	 => array(
				'edit'		=> 'admin_gedmo_partner',
		),
);
$GLOBALS['GEDMO_WIDGET_LISTENER']['PiAppGedmoBundle:Pressrelease'] = array(
		'method' => array('_template_show', '_template_list', '_template_archive'),
		'_template_show'	 => array(
				'edit'		=> 'admin_gedmo_pressrelease_edit',
		),
		'_template_list'	 => array(
				'edit'		=> 'admin_gedmo_pressrelease',
		),
		'_template_archive'	 => array(
				'edit'		=> 'admin_gedmo_pressrelease',
		),
);
$GLOBALS['GEDMO_WIDGET_LISTENER']['PiAppGedmoBundle:Contact'] = array(
		'method' => array('_template_show', '_template_list'),
		'_template_show'	 => array(
				'edit'		=> 'admin_gedmo_contact_edit',
		),
		'_template_list'	 => array(
				'edit'		=> 'admin_gedmo_contact',
		),
);
$GLOBALS['GEDMO_WIDGET_LISTENER']['PiAppGedmoBundle:Individual'] = array(
		'method' => array('_template_show', '_template_list', '_template_inscription','_template_adhesion'),
		'_template_show'	 => array(
				'edit'		=> 'admin_gedmo_individual_edit',
		),
		'_template_list'	 => array(
				'edit'		=> 'admin_gedmo_individual',
		),
);
$GLOBALS['GEDMO_WIDGET_LISTENER']['PiAppGedmoBundle:Corporation'] = array(
		'method' => array('_template_show', '_template_list', '_template_adhesion'),
		'_template_show'	 => array(
				'edit'		=> 'admin_gedmo_corporation_edit',
		),
		'_template_list'	 => array(
				'edit'		=> 'admin_gedmo_corporation',
		),
);

$GLOBALS['GEDMO_WIDGET_LISTENER']['PiAppGedmoBundle:Monespace'] = array(
		'method' => array('_template_monespace'),
);
$GLOBALS['GEDMO_WIDGET_LISTENER']['PiAppGedmoBundle:Ads'] = array(
		'method' => array('_template_show', '_template_list'),
		'_template_show'	 => array(
				'edit'		=> 'admin_gedmo_ads_edit',
		),
		'_template_list'	 => array(
				'edit'		=> 'admin_gedmo_ads',
		),
);
$GLOBALS['GEDMO_WIDGET_LISTENER']['PiAppGedmoBundle:Adherant'] = array(
		'method' => array('_template_annuaire'),
		'_template_annuaire'	 => array(
				'edit'		=> 'admin_gedmo_individual_edit',
		),
);
$GLOBALS['GEDMO_WIDGET_LISTENER']['PiAppGedmoBundle:Team'] = array(
		'method' => array('_template_show', '_template_list'),
		'_template_show'	 => array(
				'edit'		=> 'admin_gedmo_team_edit',
		),
		'_template_list'	 => array(
				'edit'		=> 'admin_gedmo_team',
		),
);
/**************************  MATRIX NAVIGATION ***************************/
$GLOBALS['GEDMO_WIDGET_NAVIGATION']['PiAppGedmoBundle:Menu'] = array(
		'method' => array('_navigation_default'),
		'_navigation_default' => array(
				'edit'		=> 'admin_gedmo_menu_tree',
		)
);
$GLOBALS['GEDMO_WIDGET_NAVIGATION']['PiAppGedmoBundle:Organigram'] = array(
		'method' => array('_navigation_default'),
		'_navigation_default' => array(
				'edit'		=> 'admin_gedmo_organigram_tree',
		)
);
/**************************  MATRIX ORGANIGRAM ***************************/
$GLOBALS['GEDMO_WIDGET_ORGANIGRAM']['PiAppAdminBundle:Rubrique'] = array(
		'method' => array('org-chart-page')
);
$GLOBALS['GEDMO_WIDGET_ORGANIGRAM']['PiAppGedmoBundle:Menu'] = array(
		'method' => array('org-chart-page'),
		'org-chart-page' => array(
				'edit'		=> 'admin_gedmo_menu_tree',
		)
);
$GLOBALS['GEDMO_WIDGET_ORGANIGRAM']['PiAppGedmoBundle:Organigram'] = array(
		'method' => array('org-chart-page', 'org-tree-semantique'),
		'org-chart-page' => array(
				'edit'		=> 'admin_gedmo_organigram_tree',
		),
		'org-tree-semantique' => array(
				'edit'		=> 'admin_gedmo_organigram_semantique',
		)
);
/**************************  MATRIX SLIDER ***************************/
$GLOBALS['GEDMO_WIDGET_SLIDER']['BootStrapUserBundle:User'] = array(
		'method' => array('slide-default'),
		'slide-default'	 => array(
				'edit'		=> 'admin_gedmo_individual',
		)
);
$GLOBALS['GEDMO_WIDGET_SLIDER']['PiAppGedmoBundle:Slider'] = array(
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