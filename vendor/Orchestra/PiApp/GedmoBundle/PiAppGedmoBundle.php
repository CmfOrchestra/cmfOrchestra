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
        'snippet'            => 'pi_app_admin.formbuilder_manager.model.snippet',
        'block'                => 'pi_app_admin.formbuilder_manager.model.block',
        'content'            => 'pi_app_admin.formbuilder_manager.model.content',
        'contact'            => 'pi_app_admin.formbuilder_manager.model.contact',
        'breadcrumb'        => 'pi_app_admin.formbuilder_manager.model.breadcrumb',
        'connexion'            => 'pi_app_admin.formbuilder_manager.model.connexion',
        'reset'            => 'pi_app_admin.formbuilder_manager.model.reset',
        //'slide'                => 'pi_app_admin.formbuilder_manager.model.slide',
);

/**************************  MATRIX SLUGGABLE ROUTE ***************************/
$GLOBALS['ROUTE']['SLUGGABLE'] = array(
        'page_new_detail'    => array(
                'entity'        => 'PiAppGedmoBundle:News',
                'field_search'    => 'slug',
                'field_title'    => 'title',
                'field_resume'    => 'meta_description',
                'field_keywords'=> 'meta_keywords',
        ),
);

/**************************  MATRIX ENTITIES of RESTRICTION ROLES ***************************/
$GLOBALS['ENTITIES']['RESTRICTION_BY_MEDIA']= array(
//        'getBlock',
//        'getContent',
//        'getNew',
//        'getPartner',
//        'getPressrelease',
//        'getContact',
);
$GLOBALS['ENTITIES']['RESTRICTION_BY_ROLES']= array(
        'Proxies\PiAppGedmoBundleEntityMediaProxy' => true,
        'Proxies\BootStrapMediaBundleEntityMediaProxy' => true,
        
//         'PiApp\GedmoBundle\Entity\Block' => true,
//         'PiApp\GedmoBundle\Entity\Translation\BlockTranslation' => true,
//         'PiApp\GedmoBundle\Entity\Content' => true,
//         'PiApp\GedmoBundle\Entity\Translation\ContentTranslation' => true,
//         'PiApp\GedmoBundle\Entity\Contact' => true,
//         'PiApp\GedmoBundle\Entity\Translation\ContactTranslation' => true,
);

$GLOBALS['ENTITIES']['AUTHORIZATION_PREPERSIST']= array(
        'BootStrap\MediaBundle\Entity\Media'    => true,
        'PiApp\GedmoBundle\Entity\Media'    => true,
        'Proxies\PiAppGedmoBundleEntityMediaProxy'    => true,
        'Proxies\BootStrapMediaBundleEntityMediaProxy'    => true,    
        
		'BootStrap\UserBundle\Entity\User' => true,
		'Proxies\__CG__\BootStrap\UserBundle\Entity\User'=> true,
        'Proxies\BootStrapUserBundleEntityUserProxy'=> true,
        
        'PiApp\AdminBundle\Entity\Contact'=> true,
        'PiApp\GedmoBundle\Entity\Translation\ContactTranslation'=> true,
);

$GLOBALS['ENTITIES']['AUTHORIZATION_PREUPDATE']= array(
        'BootStrap\MediaBundle\Entity\Media'    => true,
        'PiApp\GedmoBundle\Entity\Media'    => true,
        'Proxies\PiAppGedmoBundleEntityMediaProxy'    => true,
        'Proxies\BootStrapMediaBundleEntityMediaProxy'    => true,    
        
		'BootStrap\UserBundle\Entity\User' => true,
		'Proxies\__CG__\BootStrap\UserBundle\Entity\User'=> true,
        'Proxies\BootStrapUserBundleEntityUserProxy'=> true,
        
        'PiApp\AdminBundle\Entity\Contact'=> true,
        'PiApp\GedmoBundle\Entity\Translation\ContactTranslation'=> true,
);
$GLOBALS['ENTITIES']['PROHIBITION_PREUPDATE']= array(
        //         'PiApp\GedmoBundle\Entity\Contact'                                => array(1,2,19),
        //         'PiApp\GedmoBundle\Entity\Translation\ContactTranslation'        => true,        
);

$GLOBALS['ENTITIES']['AUTHORIZATION_PREREMOVE']= array(
        'BootStrap\MediaBundle\Entity\Media'    => true,
        'PiApp\GedmoBundle\Entity\Media'    => true,
        'Proxies\PiAppGedmoBundleEntityMediaProxy'    => true,
        'Proxies\BootStrapMediaBundleEntityMediaProxy'    => true,    
        
		'BootStrap\UserBundle\Entity\User' => true,
		'Proxies\__CG__\BootStrap\UserBundle\Entity\User'=> true,
        'Proxies\BootStrapUserBundleEntityUserProxy'=> true,
        
        'PiApp\AdminBundle\Entity\Contact'=> true,
        'PiApp\GedmoBundle\Entity\Translation\ContactTranslation'=> true,
);
$GLOBALS['ENTITIES']['PROHIBITION_PREREMOVE']= array(
//         'PiApp\GedmoBundle\Entity\Contact'                                => true,
//         'PiApp\GedmoBundle\Entity\Translation\ContactTranslation'        => true,
);

/**************************  MATRIX LISTENER ***************************/
$GLOBALS['GEDMO_WIDGET_LISTENER']['PiAppGedmoBundle:Media'] = array(
        'method' => array('_template_show', '_template_list'),
        '_template_show'     => array(
                'edit'        => 'admin_gedmo_media_edit',
        ),
        '_template_list'     => array(
                'edit'        => 'admin_gedmo_media',
        ),
);
$GLOBALS['GEDMO_WIDGET_LISTENER']['PiAppGedmoBundle:Block'] = array(
        'method' => array('_template_show', '_template_list'),
        '_template_show'     => array(
                'edit'        => 'admin_gedmo_block_edit',
        ),
        '_template_list'     => array(
                'edit'        => 'admin_gedmo_block',
        ),
);
$GLOBALS['GEDMO_WIDGET_LISTENER']['PiAppGedmoBundle:Content'] = array(
        'method' => array('_template_show', '_template_list'),
        '_template_show'     => array(
                'edit'        => 'admin_gedmo_content_edit',
        ),
        '_template_list'     => array(
                'edit'        => 'admin_gedmo_content',
        ),
);
$GLOBALS['GEDMO_WIDGET_LISTENER']['PiAppGedmoBundle:Contact'] = array(
        'method' => array('_template_show', '_template_list'),
        '_template_show'     => array(
                'edit'        => 'admin_gedmo_contact_edit',
        ),
        '_template_list'     => array(
                'edit'        => 'admin_gedmo_contact',
        ),
);

/**************************  MATRIX NAVIGATION ***************************/
$GLOBALS['GEDMO_WIDGET_NAVIGATION']['PiAppGedmoBundle:Menu'] = array(
        'method' => array('_navigation_default'),
        '_navigation_default' => array(
                'edit'        => 'admin_gedmo_menu_tree',
        )
);
$GLOBALS['GEDMO_WIDGET_NAVIGATION']['PiAppGedmoBundle:Organigram'] = array(
        'method' => array('_navigation_default'),
        '_navigation_default' => array(
                'edit'        => 'admin_gedmo_organigram_tree',
        )
);
/**************************  MATRIX ORGANIGRAM ***************************/
$GLOBALS['GEDMO_WIDGET_ORGANIGRAM']['PiAppAdminBundle:Rubrique'] = array(
        'method' => array('org-chart-page')
);
$GLOBALS['GEDMO_WIDGET_ORGANIGRAM']['PiAppGedmoBundle:Menu'] = array(
        'method' => array('org-chart-page'),
        'org-chart-page' => array(
                'edit'        => 'admin_gedmo_menu_tree',
        )
);
$GLOBALS['GEDMO_WIDGET_ORGANIGRAM']['PiAppGedmoBundle:Organigram'] = array(
        'method' => array('org-chart-page', 'org-tree-semantique'),
        'org-chart-page' => array(
                'edit'        => 'admin_gedmo_organigram_tree',
        ),
        'org-tree-semantique' => array(
                'edit'        => 'admin_gedmo_organigram_semantique',
        )
);
/**************************  MATRIX SLIDER ***************************/
$GLOBALS['GEDMO_WIDGET_SLIDER']['PiAppGedmoBundle:Slider'] = array(
        'method' => array('slide-default'),
        'slide-default'     => array(
                'edit'        => 'admin_gedmo_slider',
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