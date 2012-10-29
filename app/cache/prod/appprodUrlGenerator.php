<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;


/**
 * appprodUrlGenerator
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appprodUrlGenerator extends BeSimple\I18nRoutingBundle\Routing\Generator\UrlGenerator
{
    static private $declaredRouteNames = array(
       'fos_user_group_list' => true,
       'fos_user_group_new' => true,
       'fos_user_group_show' => true,
       'fos_user_group_edit' => true,
       'fos_user_group_delete' => true,
       'fos_user_security_login' => true,
       'fos_user_security_check' => true,
       'fos_user_security_logout' => true,
       'fos_user_profile_show' => true,
       'fos_user_profile_edit' => true,
       'fos_user_registration_register' => true,
       'fos_user_registration_check_email' => true,
       'fos_user_registration_confirm' => true,
       'fos_user_registration_confirmed' => true,
       'fos_user_resetting_request' => true,
       'fos_user_resetting_send_email' => true,
       'fos_user_resetting_check_email' => true,
       'fos_user_resetting_reset' => true,
       'fos_user_change_password' => true,
       'home_page' => true,
       'error_404.fr_FR' => true,
       'error_404.en_GB' => true,
       'unauthorized' => true,
       'sonata_admin_dashboard' => true,
       'sonata_admin_retrieve_form_element' => true,
       'sonata_admin_append_form_element' => true,
       'sonata_admin_short_object_information' => true,
       'sonata_admin_set_object_field_value' => true,
       'admin_bootstrap_media_media_list' => true,
       'admin_bootstrap_media_media_create' => true,
       'admin_bootstrap_media_media_batch' => true,
       'admin_bootstrap_media_media_edit' => true,
       'admin_bootstrap_media_media_delete' => true,
       'admin_bootstrap_media_media_show' => true,
       'admin_bootstrap_media_media_export' => true,
       'admin_bootstrap_media_media_view' => true,
       'admin_bootstrap_media_gallery_list' => true,
       'admin_bootstrap_media_gallery_create' => true,
       'admin_bootstrap_media_gallery_batch' => true,
       'admin_bootstrap_media_gallery_edit' => true,
       'admin_bootstrap_media_gallery_delete' => true,
       'admin_bootstrap_media_gallery_show' => true,
       'admin_bootstrap_media_gallery_export' => true,
       'admin_bootstrap_media_galleryhasmedia_list' => true,
       'admin_bootstrap_media_galleryhasmedia_create' => true,
       'admin_bootstrap_media_galleryhasmedia_batch' => true,
       'admin_bootstrap_media_galleryhasmedia_edit' => true,
       'admin_bootstrap_media_galleryhasmedia_delete' => true,
       'admin_bootstrap_media_galleryhasmedia_show' => true,
       'admin_bootstrap_media_galleryhasmedia_export' => true,
       'admin_bootstrap_user_group_list' => true,
       'admin_bootstrap_user_group_create' => true,
       'admin_bootstrap_user_group_batch' => true,
       'admin_bootstrap_user_group_edit' => true,
       'admin_bootstrap_user_group_delete' => true,
       'admin_bootstrap_user_group_show' => true,
       'admin_bootstrap_user_group_export' => true,
       'admin_bootstrap_user_user_list' => true,
       'admin_bootstrap_user_user_create' => true,
       'admin_bootstrap_user_user_batch' => true,
       'admin_bootstrap_user_user_edit' => true,
       'admin_bootstrap_user_user_delete' => true,
       'admin_bootstrap_user_user_show' => true,
       'admin_bootstrap_user_user_export' => true,
       'admin_bootstrap_user_role_list' => true,
       'admin_bootstrap_user_role_create' => true,
       'admin_bootstrap_user_role_batch' => true,
       'admin_bootstrap_user_role_edit' => true,
       'admin_bootstrap_user_role_delete' => true,
       'admin_bootstrap_user_role_show' => true,
       'admin_bootstrap_user_role_export' => true,
       'admin_bootstrap_user_permission_list' => true,
       'admin_bootstrap_user_permission_create' => true,
       'admin_bootstrap_user_permission_batch' => true,
       'admin_bootstrap_user_permission_edit' => true,
       'admin_bootstrap_user_permission_delete' => true,
       'admin_bootstrap_user_permission_show' => true,
       'admin_bootstrap_user_permission_export' => true,
       'admin_piapp_admin_historicalstatus_list' => true,
       'admin_piapp_admin_historicalstatus_create' => true,
       'admin_piapp_admin_historicalstatus_batch' => true,
       'admin_piapp_admin_historicalstatus_edit' => true,
       'admin_piapp_admin_historicalstatus_delete' => true,
       'admin_piapp_admin_historicalstatus_show' => true,
       'admin_piapp_admin_historicalstatus_export' => true,
       'sonata_media_gallery_index' => true,
       'sonata_media_gallery_view' => true,
       'sonata_media_view' => true,
       'sonata_media_download' => true,
       'sonata_media_pixlr_edit' => true,
       'sonata_media_pixlr_target' => true,
       'sonata_media_pixlr_exit' => true,
       'sonata_media_pixlr_open_editor' => true,
       'admin_gedmo_block_enabledentity_ajax' => true,
       'admin_gedmo_block_disablentity_ajax' => true,
       'admin_gedmo_block_position_ajax' => true,
       'admin_gedmo_category_enabledentity_ajax' => true,
       'admin_gedmo_category_disablentity_ajax' => true,
       'admin_gedmo_category_position_ajax' => true,
       'admin_gedmo_content_enabledentity_ajax' => true,
       'admin_gedmo_content_disablentity_ajax' => true,
       'admin_gedmo_content_position_ajax' => true,
       'admin_gedmo_media_enabledentity_ajax' => true,
       'admin_gedmo_media_disablentity_ajax' => true,
       'admin_gedmo_media_position_ajax' => true,
       'admin_gedmo_menu_enabledentity_ajax' => true,
       'admin_gedmo_menu_disablentity_ajax' => true,
       'admin_gedmo_menu_position_ajax' => true,
       'admin_gedmo_organigram_enabledentity_ajax' => true,
       'admin_gedmo_organigram_disablentity_ajax' => true,
       'admin_gedmo_organigram_position_ajax' => true,
       'admin_gedmo_slider_enabledentity_ajax' => true,
       'admin_gedmo_slider_disablentity_ajax' => true,
       'admin_gedmo_slider_position_ajax' => true,
       'admin_page_block_enabledentity_ajax' => true,
       'admin_page_block_disablentity_ajax' => true,
       'admin_page_block_position_ajax' => true,
       'admin_page_comment_enabledentity_ajax' => true,
       'admin_page_comment_disablentity_ajax' => true,
       'admin_page_comment_position_ajax' => true,
       'admin_keyword_enabledentity_ajax' => true,
       'admin_keyword_disablentity_ajax' => true,
       'admin_langue_enabledentity_ajax' => true,
       'admin_langue_disablentity_ajax' => true,
       'admin_layout_enabledentity_ajax' => true,
       'admin_layout_disablentity_ajax' => true,
       'admin_pagebyblock_enabledentity_ajax' => true,
       'admin_pagebyblock_disablentity_ajax' => true,
       'admin_pagebytrans_enabledentity_ajax' => true,
       'admin_pagebytrans_disablentity_ajax' => true,
       'admin_pagecssjs_enabledentity_ajax' => true,
       'admin_pagecssjs_disablentity_ajax' => true,
       'admin_rubrique_enabledentity_ajax' => true,
       'admin_rubrique_disablentity_ajax' => true,
       'admin_snippet_enabledentity_ajax' => true,
       'admin_snippet_disablentity_ajax' => true,
       'admin_tag_enabledentity_ajax' => true,
       'admin_tag_disablentity_ajax' => true,
       'admin_translationpage_enabledentity_ajax' => true,
       'admin_translationpage_disablentity_ajax' => true,
       'admin_translationwidget_enabledentity_ajax' => true,
       'admin_translationwidget_disablentity_ajax' => true,
       'admin_widget_enabledentity_ajax' => true,
       'admin_widget_disablentity_ajax' => true,
       'admin_widget_position_ajax' => true,
       'admin_gedmo_category' => true,
       'admin_gedmo_category_show' => true,
       'admin_gedmo_category_new' => true,
       'admin_gedmo_category_create' => true,
       'admin_gedmo_category_edit' => true,
       'admin_gedmo_category_update' => true,
       'admin_gedmo_category_delete' => true,
       'admin_gedmo_block' => true,
       'admin_gedmo_block_show' => true,
       'admin_gedmo_block_new' => true,
       'admin_gedmo_block_create' => true,
       'admin_gedmo_block_edit' => true,
       'admin_gedmo_block_update' => true,
       'admin_gedmo_block_delete' => true,
       'admin_gedmo_content' => true,
       'admin_gedmo_content_show' => true,
       'admin_gedmo_content_new' => true,
       'admin_gedmo_content_create' => true,
       'admin_gedmo_content_edit' => true,
       'admin_gedmo_content_update' => true,
       'admin_gedmo_content_delete' => true,
       'admin_gedmo_media' => true,
       'admin_gedmo_media_show' => true,
       'admin_gedmo_media_new' => true,
       'admin_gedmo_media_create' => true,
       'admin_gedmo_media_edit' => true,
       'admin_gedmo_media_update' => true,
       'admin_gedmo_media_delete' => true,
       'admin_gedmo_menu' => true,
       'admin_gedmo_menu_show' => true,
       'admin_gedmo_menu_new' => true,
       'admin_gedmo_menu_create' => true,
       'admin_gedmo_menu_edit' => true,
       'admin_gedmo_menu_update' => true,
       'admin_gedmo_menu_delete' => true,
       'admin_gedmo_menu_knp' => true,
       'admin_gedmo_menu_tree' => true,
       'admin_gedmo_menu_move_up' => true,
       'admin_gedmo_menu_move_down' => true,
       'admin_gedmo_menu_node_remove' => true,
       'admin_gedmo_slider' => true,
       'admin_gedmo_slider_show' => true,
       'admin_gedmo_slider_new' => true,
       'admin_gedmo_slider_create' => true,
       'admin_gedmo_slider_edit' => true,
       'admin_gedmo_slider_update' => true,
       'admin_gedmo_slider_delete' => true,
       'admin_gedmo_organigram' => true,
       'admin_gedmo_organigram_show' => true,
       'admin_gedmo_organigram_new' => true,
       'admin_gedmo_organigram_create' => true,
       'admin_gedmo_organigram_edit' => true,
       'admin_gedmo_organigram_update' => true,
       'admin_gedmo_organigram_delete' => true,
       'admin_gedmo_organigram_tree' => true,
       'admin_gedmo_organigram_move_up' => true,
       'admin_gedmo_organigram_move_down' => true,
       'admin_gedmo_organigram_node_remove' => true,
       'admin_layout' => true,
       'admin_layout_show' => true,
       'admin_layout_new' => true,
       'admin_layout_create' => true,
       'admin_layout_edit' => true,
       'admin_layout_update' => true,
       'admin_layout_delete' => true,
       'admin_rubrique' => true,
       'admin_rubrique_show' => true,
       'admin_rubrique_new' => true,
       'admin_rubrique_create' => true,
       'admin_rubrique_edit' => true,
       'admin_rubrique_update' => true,
       'admin_rubrique_delete' => true,
       'admin_rubrique_tree' => true,
       'admin_rubrique_move_up' => true,
       'admin_rubrique_move_down' => true,
       'admin_rubrique_node_remove' => true,
       'admin_pagebytrans' => true,
       'admin_pagebytrans_wizard' => true,
       'admin_pagebytrans_show' => true,
       'admin_pagebytrans_new' => true,
       'admin_pagebytrans_create' => true,
       'admin_pagebytrans_edit' => true,
       'admin_pagebytrans_update' => true,
       'admin_pagebytrans_delete' => true,
       'admin_pagebyblock' => true,
       'admin_pagebyblock_show' => true,
       'admin_pagebyblock_new' => true,
       'admin_pagebyblock_create' => true,
       'admin_pagebyblock_edit' => true,
       'admin_pagebyblock_update' => true,
       'admin_pagebyblock_delete' => true,
       'admin_pagecssjs' => true,
       'admin_pagecssjs_show' => true,
       'admin_pagecssjs_new' => true,
       'admin_pagecssjs_create' => true,
       'admin_pagecssjs_edit' => true,
       'admin_pagecssjs_update' => true,
       'admin_pagecssjs_delete' => true,
       'admin_transpage' => true,
       'admin_transpage_show' => true,
       'admin_transpage_new' => true,
       'admin_transpage_create' => true,
       'admin_transpage_edit' => true,
       'admin_transpage_update' => true,
       'admin_transpage_delete' => true,
       'admin_blockbywidget' => true,
       'admin_blockbywidget_show' => true,
       'admin_blockbywidget_new' => true,
       'admin_blockbywidget_create' => true,
       'admin_blockbywidget_edit' => true,
       'admin_blockbywidget_update' => true,
       'admin_blockbywidget_delete' => true,
       'admin_widget' => true,
       'admin_widget_show' => true,
       'admin_widget_new' => true,
       'admin_widget_create' => true,
       'admin_widget_edit' => true,
       'admin_widget_update' => true,
       'admin_widget_delete' => true,
       'admin_widget_delete_ajax' => true,
       'admin_widget_movewidget_page' => true,
       'admin_widget_move_ajax' => true,
       'admin_snippet' => true,
       'admin_snippet_show' => true,
       'admin_snippet_new' => true,
       'admin_snippet_create' => true,
       'admin_snippet_edit' => true,
       'admin_snippet_update' => true,
       'admin_snippet_delete' => true,
       'admin_transwidget' => true,
       'admin_transwidget_show' => true,
       'admin_transwidget_new' => true,
       'admin_transwidget_create' => true,
       'admin_transwidget_edit' => true,
       'admin_transwidget_update' => true,
       'admin_transwidget_delete' => true,
       'admin_tag' => true,
       'admin_tag_show' => true,
       'admin_tag_new' => true,
       'admin_tag_create' => true,
       'admin_tag_edit' => true,
       'admin_tag_update' => true,
       'admin_tag_delete' => true,
       'admin_keyword' => true,
       'admin_keyword_show' => true,
       'admin_keyword_new' => true,
       'admin_keyword_create' => true,
       'admin_keyword_edit' => true,
       'admin_keyword_update' => true,
       'admin_keyword_delete' => true,
       'admin_langue' => true,
       'admin_langue_show' => true,
       'admin_langue_new' => true,
       'admin_langue_create' => true,
       'admin_langue_edit' => true,
       'admin_langue_update' => true,
       'admin_langue_delete' => true,
       'admin_comment' => true,
       'admin_comment_show' => true,
       'admin_comment_new' => true,
       'admin_comment_create' => true,
       'admin_comment_edit' => true,
       'admin_comment_update' => true,
       'admin_comment_delete' => true,
       'pi_layout_choisir_langue' => true,
       'admin_homepage' => true,
       'public_refresh_page' => true,
       'public_indexation_page' => true,
       'public_urlmanagement_page' => true,
       'public_importmanagement_widget' => true,
       'public_head_file' => true,
       'public_chained' => true,
    );

    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function generate($name, $parameters = array(), $absolute = false)
    {
        if (!isset(self::$declaredRouteNames[$name])) {
            throw new RouteNotFoundException(sprintf('Route "%s" does not exist.', $name));
        }

        $escapedName = str_replace('.', '__', $name);

        list($variables, $defaults, $requirements, $tokens) = $this->{'get'.$escapedName.'RouteInfo'}();

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $absolute);
    }

    private function getfos_user_group_listRouteInfo()
    {
        return array(array (), array (  '_controller' => 'FOS\\UserBundle\\Controller\\GroupController::listAction',), array (  '_method' => 'GET',), array (  0 =>   array (    0 => 'text',    1 => '/admin/group/list',  ),));
    }

    private function getfos_user_group_newRouteInfo()
    {
        return array(array (), array (  '_controller' => 'FOS\\UserBundle\\Controller\\GroupController::newAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/group/new',  ),));
    }

    private function getfos_user_group_showRouteInfo()
    {
        return array(array (  0 => 'groupname',), array (  '_controller' => 'FOS\\UserBundle\\Controller\\GroupController::showAction',), array (  '_method' => 'GET',), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'groupname',  ),  1 =>   array (    0 => 'text',    1 => '/admin/group',  ),));
    }

    private function getfos_user_group_editRouteInfo()
    {
        return array(array (  0 => 'groupname',), array (  '_controller' => 'FOS\\UserBundle\\Controller\\GroupController::editAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'groupname',  ),  2 =>   array (    0 => 'text',    1 => '/admin/group',  ),));
    }

    private function getfos_user_group_deleteRouteInfo()
    {
        return array(array (  0 => 'groupname',), array (  '_controller' => 'FOS\\UserBundle\\Controller\\GroupController::deleteAction',), array (  '_method' => 'GET',), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'groupname',  ),  2 =>   array (    0 => 'text',    1 => '/admin/group',  ),));
    }

    private function getfos_user_security_loginRouteInfo()
    {
        return array(array (), array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::loginAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/login',  ),));
    }

    private function getfos_user_security_checkRouteInfo()
    {
        return array(array (), array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::checkAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/login_check',  ),));
    }

    private function getfos_user_security_logoutRouteInfo()
    {
        return array(array (), array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::logoutAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/logout',  ),));
    }

    private function getfos_user_profile_showRouteInfo()
    {
        return array(array (), array (  '_controller' => 'FOS\\UserBundle\\Controller\\ProfileController::showAction',), array (  '_method' => 'GET',), array (  0 =>   array (    0 => 'text',    1 => '/user/profile/',  ),));
    }

    private function getfos_user_profile_editRouteInfo()
    {
        return array(array (), array (  '_controller' => 'FOS\\UserBundle\\Controller\\ProfileController::editAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/user/profile/edit',  ),));
    }

    private function getfos_user_registration_registerRouteInfo()
    {
        return array(array (), array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::registerAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/user/register/',  ),));
    }

    private function getfos_user_registration_check_emailRouteInfo()
    {
        return array(array (), array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::checkEmailAction',), array (  '_method' => 'GET',), array (  0 =>   array (    0 => 'text',    1 => '/user/register/check-email',  ),));
    }

    private function getfos_user_registration_confirmRouteInfo()
    {
        return array(array (  0 => 'token',), array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::confirmAction',), array (  '_method' => 'GET',), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'token',  ),  1 =>   array (    0 => 'text',    1 => '/user/register/confirm',  ),));
    }

    private function getfos_user_registration_confirmedRouteInfo()
    {
        return array(array (), array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::confirmedAction',), array (  '_method' => 'GET',), array (  0 =>   array (    0 => 'text',    1 => '/user/register/confirmed',  ),));
    }

    private function getfos_user_resetting_requestRouteInfo()
    {
        return array(array (), array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::requestAction',), array (  '_method' => 'GET',), array (  0 =>   array (    0 => 'text',    1 => '/user/resetting/request',  ),));
    }

    private function getfos_user_resetting_send_emailRouteInfo()
    {
        return array(array (), array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::sendEmailAction',), array (  '_method' => 'POST',), array (  0 =>   array (    0 => 'text',    1 => '/user/resetting/send-email',  ),));
    }

    private function getfos_user_resetting_check_emailRouteInfo()
    {
        return array(array (), array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::checkEmailAction',), array (  '_method' => 'GET',), array (  0 =>   array (    0 => 'text',    1 => '/user/resetting/check-email',  ),));
    }

    private function getfos_user_resetting_resetRouteInfo()
    {
        return array(array (  0 => 'token',), array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::resetAction',), array (  '_method' => 'GET|POST',), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'token',  ),  1 =>   array (    0 => 'text',    1 => '/user/resetting/reset',  ),));
    }

    private function getfos_user_change_passwordRouteInfo()
    {
        return array(array (), array (  '_controller' => 'FOS\\UserBundle\\Controller\\ChangePasswordController::changePasswordAction',), array (  '_method' => 'GET|POST',), array (  0 =>   array (    0 => 'text',    1 => '/user/change-password/change-password',  ),));
    }

    private function gethome_pageRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\FrontendController::pageAction',), array (  '_method' => 'get|post',), array (  0 =>   array (    0 => 'text',    1 => '/',  ),));
    }

    private function geterror_404__fr_FRRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\FrontendController::pageAction',  '_locale' => 'fr_FR',), array (  '_method' => 'get|post',), array (  0 =>   array (    0 => 'text',    1 => '/error/error404-fr',  ),));
    }

    private function geterror_404__en_GBRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\FrontendController::pageAction',  '_locale' => 'en_GB',), array (  '_method' => 'get|post',), array (  0 =>   array (    0 => 'text',    1 => '/error/error404-en',  ),));
    }

    private function getunauthorizedRouteInfo()
    {
        return array(array (), array (  '_controller' => 'BootStrap\\UserBundle\\Controller\\ErrorController::unauthorizedAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/unauthorized',  ),));
    }

    private function getsonata_admin_dashboardRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CoreController::dashboardAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/dashboard',  ),));
    }

    private function getsonata_admin_retrieve_form_elementRouteInfo()
    {
        return array(array (), array (  '_controller' => 'sonata.admin.controller.admin:retrieveFormFieldElementAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/core/get-form-field-element',  ),));
    }

    private function getsonata_admin_append_form_elementRouteInfo()
    {
        return array(array (), array (  '_controller' => 'sonata.admin.controller.admin:appendFormFieldElementAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/core/append-form-field-element',  ),));
    }

    private function getsonata_admin_short_object_informationRouteInfo()
    {
        return array(array (), array (  '_controller' => 'sonata.admin.controller.admin:getShortObjectDescriptionAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/core/get-short-object-description',  ),));
    }

    private function getsonata_admin_set_object_field_valueRouteInfo()
    {
        return array(array (), array (  '_controller' => 'sonata.admin.controller.admin:setObjectFieldValueAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/core/set-object-field-value',  ),));
    }

    private function getadmin_bootstrap_media_media_listRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::listAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_bootstrap_media_media_list',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/bootstrap/media/media/list',  ),));
    }

    private function getadmin_bootstrap_media_media_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::createAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_bootstrap_media_media_create',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/bootstrap/media/media/create',  ),));
    }

    private function getadmin_bootstrap_media_media_batchRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::batchAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_bootstrap_media_media_batch',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/bootstrap/media/media/batch',  ),));
    }

    private function getadmin_bootstrap_media_media_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::editAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_bootstrap_media_media_edit',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/adminsonata/bootstrap/media/media',  ),));
    }

    private function getadmin_bootstrap_media_media_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::deleteAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_bootstrap_media_media_delete',), array (), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/adminsonata/bootstrap/media/media',  ),));
    }

    private function getadmin_bootstrap_media_media_showRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::showAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_bootstrap_media_media_show',), array (), array (  0 =>   array (    0 => 'text',    1 => '/show',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/adminsonata/bootstrap/media/media',  ),));
    }

    private function getadmin_bootstrap_media_media_exportRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::exportAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_bootstrap_media_media_export',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/bootstrap/media/media/export',  ),));
    }

    private function getadmin_bootstrap_media_media_viewRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::viewAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_bootstrap_media_media_view',), array (), array (  0 =>   array (    0 => 'text',    1 => '/view',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/adminsonata/bootstrap/media/media',  ),));
    }

    private function getadmin_bootstrap_media_gallery_listRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::listAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_bootstrap_media_gallery_list',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/bootstrap/media/gallery/list',  ),));
    }

    private function getadmin_bootstrap_media_gallery_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::createAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_bootstrap_media_gallery_create',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/bootstrap/media/gallery/create',  ),));
    }

    private function getadmin_bootstrap_media_gallery_batchRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::batchAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_bootstrap_media_gallery_batch',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/bootstrap/media/gallery/batch',  ),));
    }

    private function getadmin_bootstrap_media_gallery_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::editAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_bootstrap_media_gallery_edit',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/adminsonata/bootstrap/media/gallery',  ),));
    }

    private function getadmin_bootstrap_media_gallery_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::deleteAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_bootstrap_media_gallery_delete',), array (), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/adminsonata/bootstrap/media/gallery',  ),));
    }

    private function getadmin_bootstrap_media_gallery_showRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::showAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_bootstrap_media_gallery_show',), array (), array (  0 =>   array (    0 => 'text',    1 => '/show',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/adminsonata/bootstrap/media/gallery',  ),));
    }

    private function getadmin_bootstrap_media_gallery_exportRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::exportAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_bootstrap_media_gallery_export',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/bootstrap/media/gallery/export',  ),));
    }

    private function getadmin_bootstrap_media_galleryhasmedia_listRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_bootstrap_media_galleryhasmedia_list',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/bootstrap/media/galleryhasmedia/list',  ),));
    }

    private function getadmin_bootstrap_media_galleryhasmedia_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_bootstrap_media_galleryhasmedia_create',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/bootstrap/media/galleryhasmedia/create',  ),));
    }

    private function getadmin_bootstrap_media_galleryhasmedia_batchRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_bootstrap_media_galleryhasmedia_batch',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/bootstrap/media/galleryhasmedia/batch',  ),));
    }

    private function getadmin_bootstrap_media_galleryhasmedia_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_bootstrap_media_galleryhasmedia_edit',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/adminsonata/bootstrap/media/galleryhasmedia',  ),));
    }

    private function getadmin_bootstrap_media_galleryhasmedia_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_bootstrap_media_galleryhasmedia_delete',), array (), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/adminsonata/bootstrap/media/galleryhasmedia',  ),));
    }

    private function getadmin_bootstrap_media_galleryhasmedia_showRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_bootstrap_media_galleryhasmedia_show',), array (), array (  0 =>   array (    0 => 'text',    1 => '/show',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/adminsonata/bootstrap/media/galleryhasmedia',  ),));
    }

    private function getadmin_bootstrap_media_galleryhasmedia_exportRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_bootstrap_media_galleryhasmedia_export',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/bootstrap/media/galleryhasmedia/export',  ),));
    }

    private function getadmin_bootstrap_user_group_listRouteInfo()
    {
        return array(array (), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\GroupAdminController::listAction',  '_sonata_admin' => 'bootstrap.admin.admin.group',  '_sonata_name' => 'admin_bootstrap_user_group_list',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/group/list',  ),));
    }

    private function getadmin_bootstrap_user_group_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\GroupAdminController::createAction',  '_sonata_admin' => 'bootstrap.admin.admin.group',  '_sonata_name' => 'admin_bootstrap_user_group_create',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/group/create',  ),));
    }

    private function getadmin_bootstrap_user_group_batchRouteInfo()
    {
        return array(array (), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\GroupAdminController::batchAction',  '_sonata_admin' => 'bootstrap.admin.admin.group',  '_sonata_name' => 'admin_bootstrap_user_group_batch',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/group/batch',  ),));
    }

    private function getadmin_bootstrap_user_group_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\GroupAdminController::editAction',  '_sonata_admin' => 'bootstrap.admin.admin.group',  '_sonata_name' => 'admin_bootstrap_user_group_edit',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/adminsonata/group',  ),));
    }

    private function getadmin_bootstrap_user_group_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\GroupAdminController::deleteAction',  '_sonata_admin' => 'bootstrap.admin.admin.group',  '_sonata_name' => 'admin_bootstrap_user_group_delete',), array (), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/adminsonata/group',  ),));
    }

    private function getadmin_bootstrap_user_group_showRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\GroupAdminController::showAction',  '_sonata_admin' => 'bootstrap.admin.admin.group',  '_sonata_name' => 'admin_bootstrap_user_group_show',), array (), array (  0 =>   array (    0 => 'text',    1 => '/show',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/adminsonata/group',  ),));
    }

    private function getadmin_bootstrap_user_group_exportRouteInfo()
    {
        return array(array (), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\GroupAdminController::exportAction',  '_sonata_admin' => 'bootstrap.admin.admin.group',  '_sonata_name' => 'admin_bootstrap_user_group_export',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/group/export',  ),));
    }

    private function getadmin_bootstrap_user_user_listRouteInfo()
    {
        return array(array (), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\UserAdminController::listAction',  '_sonata_admin' => 'bootstrap.admin.admin.user',  '_sonata_name' => 'admin_bootstrap_user_user_list',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/user/list',  ),));
    }

    private function getadmin_bootstrap_user_user_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\UserAdminController::createAction',  '_sonata_admin' => 'bootstrap.admin.admin.user',  '_sonata_name' => 'admin_bootstrap_user_user_create',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/user/create',  ),));
    }

    private function getadmin_bootstrap_user_user_batchRouteInfo()
    {
        return array(array (), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\UserAdminController::batchAction',  '_sonata_admin' => 'bootstrap.admin.admin.user',  '_sonata_name' => 'admin_bootstrap_user_user_batch',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/user/batch',  ),));
    }

    private function getadmin_bootstrap_user_user_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\UserAdminController::editAction',  '_sonata_admin' => 'bootstrap.admin.admin.user',  '_sonata_name' => 'admin_bootstrap_user_user_edit',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/adminsonata/user',  ),));
    }

    private function getadmin_bootstrap_user_user_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\UserAdminController::deleteAction',  '_sonata_admin' => 'bootstrap.admin.admin.user',  '_sonata_name' => 'admin_bootstrap_user_user_delete',), array (), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/adminsonata/user',  ),));
    }

    private function getadmin_bootstrap_user_user_showRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\UserAdminController::showAction',  '_sonata_admin' => 'bootstrap.admin.admin.user',  '_sonata_name' => 'admin_bootstrap_user_user_show',), array (), array (  0 =>   array (    0 => 'text',    1 => '/show',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/adminsonata/user',  ),));
    }

    private function getadmin_bootstrap_user_user_exportRouteInfo()
    {
        return array(array (), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\UserAdminController::exportAction',  '_sonata_admin' => 'bootstrap.admin.admin.user',  '_sonata_name' => 'admin_bootstrap_user_user_export',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/user/export',  ),));
    }

    private function getadmin_bootstrap_user_role_listRouteInfo()
    {
        return array(array (), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\RoleAdminController::listAction',  '_sonata_admin' => 'bootstrap.admin.admin.role',  '_sonata_name' => 'admin_bootstrap_user_role_list',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/role/list',  ),));
    }

    private function getadmin_bootstrap_user_role_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\RoleAdminController::createAction',  '_sonata_admin' => 'bootstrap.admin.admin.role',  '_sonata_name' => 'admin_bootstrap_user_role_create',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/role/create',  ),));
    }

    private function getadmin_bootstrap_user_role_batchRouteInfo()
    {
        return array(array (), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\RoleAdminController::batchAction',  '_sonata_admin' => 'bootstrap.admin.admin.role',  '_sonata_name' => 'admin_bootstrap_user_role_batch',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/role/batch',  ),));
    }

    private function getadmin_bootstrap_user_role_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\RoleAdminController::editAction',  '_sonata_admin' => 'bootstrap.admin.admin.role',  '_sonata_name' => 'admin_bootstrap_user_role_edit',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/adminsonata/role',  ),));
    }

    private function getadmin_bootstrap_user_role_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\RoleAdminController::deleteAction',  '_sonata_admin' => 'bootstrap.admin.admin.role',  '_sonata_name' => 'admin_bootstrap_user_role_delete',), array (), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/adminsonata/role',  ),));
    }

    private function getadmin_bootstrap_user_role_showRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\RoleAdminController::showAction',  '_sonata_admin' => 'bootstrap.admin.admin.role',  '_sonata_name' => 'admin_bootstrap_user_role_show',), array (), array (  0 =>   array (    0 => 'text',    1 => '/show',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/adminsonata/role',  ),));
    }

    private function getadmin_bootstrap_user_role_exportRouteInfo()
    {
        return array(array (), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\RoleAdminController::exportAction',  '_sonata_admin' => 'bootstrap.admin.admin.role',  '_sonata_name' => 'admin_bootstrap_user_role_export',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/role/export',  ),));
    }

    private function getadmin_bootstrap_user_permission_listRouteInfo()
    {
        return array(array (), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\PermissionAdminController::listAction',  '_sonata_admin' => 'bootstrap.admin.admin.permission',  '_sonata_name' => 'admin_bootstrap_user_permission_list',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/permission/list',  ),));
    }

    private function getadmin_bootstrap_user_permission_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\PermissionAdminController::createAction',  '_sonata_admin' => 'bootstrap.admin.admin.permission',  '_sonata_name' => 'admin_bootstrap_user_permission_create',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/permission/create',  ),));
    }

    private function getadmin_bootstrap_user_permission_batchRouteInfo()
    {
        return array(array (), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\PermissionAdminController::batchAction',  '_sonata_admin' => 'bootstrap.admin.admin.permission',  '_sonata_name' => 'admin_bootstrap_user_permission_batch',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/permission/batch',  ),));
    }

    private function getadmin_bootstrap_user_permission_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\PermissionAdminController::editAction',  '_sonata_admin' => 'bootstrap.admin.admin.permission',  '_sonata_name' => 'admin_bootstrap_user_permission_edit',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/adminsonata/permission',  ),));
    }

    private function getadmin_bootstrap_user_permission_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\PermissionAdminController::deleteAction',  '_sonata_admin' => 'bootstrap.admin.admin.permission',  '_sonata_name' => 'admin_bootstrap_user_permission_delete',), array (), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/adminsonata/permission',  ),));
    }

    private function getadmin_bootstrap_user_permission_showRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\PermissionAdminController::showAction',  '_sonata_admin' => 'bootstrap.admin.admin.permission',  '_sonata_name' => 'admin_bootstrap_user_permission_show',), array (), array (  0 =>   array (    0 => 'text',    1 => '/show',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/adminsonata/permission',  ),));
    }

    private function getadmin_bootstrap_user_permission_exportRouteInfo()
    {
        return array(array (), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\PermissionAdminController::exportAction',  '_sonata_admin' => 'bootstrap.admin.admin.permission',  '_sonata_name' => 'admin_bootstrap_user_permission_export',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/permission/export',  ),));
    }

    private function getadmin_piapp_admin_historicalstatus_listRouteInfo()
    {
        return array(array (), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\HistoricalPageCMSController::listAction',  '_sonata_admin' => 'bootstrap.admin.admin.historicalpage',  '_sonata_name' => 'admin_piapp_admin_historicalstatus_list',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/historicalpage/list',  ),));
    }

    private function getadmin_piapp_admin_historicalstatus_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\HistoricalPageCMSController::createAction',  '_sonata_admin' => 'bootstrap.admin.admin.historicalpage',  '_sonata_name' => 'admin_piapp_admin_historicalstatus_create',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/historicalpage/create',  ),));
    }

    private function getadmin_piapp_admin_historicalstatus_batchRouteInfo()
    {
        return array(array (), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\HistoricalPageCMSController::batchAction',  '_sonata_admin' => 'bootstrap.admin.admin.historicalpage',  '_sonata_name' => 'admin_piapp_admin_historicalstatus_batch',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/historicalpage/batch',  ),));
    }

    private function getadmin_piapp_admin_historicalstatus_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\HistoricalPageCMSController::editAction',  '_sonata_admin' => 'bootstrap.admin.admin.historicalpage',  '_sonata_name' => 'admin_piapp_admin_historicalstatus_edit',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/adminsonata/historicalpage',  ),));
    }

    private function getadmin_piapp_admin_historicalstatus_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\HistoricalPageCMSController::deleteAction',  '_sonata_admin' => 'bootstrap.admin.admin.historicalpage',  '_sonata_name' => 'admin_piapp_admin_historicalstatus_delete',), array (), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/adminsonata/historicalpage',  ),));
    }

    private function getadmin_piapp_admin_historicalstatus_showRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\HistoricalPageCMSController::showAction',  '_sonata_admin' => 'bootstrap.admin.admin.historicalpage',  '_sonata_name' => 'admin_piapp_admin_historicalstatus_show',), array (), array (  0 =>   array (    0 => 'text',    1 => '/show',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/adminsonata/historicalpage',  ),));
    }

    private function getadmin_piapp_admin_historicalstatus_exportRouteInfo()
    {
        return array(array (), array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\HistoricalPageCMSController::exportAction',  '_sonata_admin' => 'bootstrap.admin.admin.historicalpage',  '_sonata_name' => 'admin_piapp_admin_historicalstatus_export',), array (), array (  0 =>   array (    0 => 'text',    1 => '/adminsonata/historicalpage/export',  ),));
    }

    private function getsonata_media_gallery_indexRouteInfo()
    {
        return array(array (), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/media/gallery/',  ),));
    }

    private function getsonata_media_gallery_viewRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryController::viewAction',), array (), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  1 =>   array (    0 => 'text',    1 => '/media/gallery/view',  ),));
    }

    private function getsonata_media_viewRouteInfo()
    {
        return array(array (  0 => 'id',  1 => 'format',), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaController::viewAction',  'format' => 'reference',), array (), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'format',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/media/view',  ),));
    }

    private function getsonata_media_downloadRouteInfo()
    {
        return array(array (  0 => 'id',  1 => 'format',), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaController::downloadAction',  'format' => 'reference',), array (), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'format',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/media/download',  ),));
    }

    private function getsonata_media_pixlr_editRouteInfo()
    {
        return array(array (  0 => 'id',  1 => 'mode',), array (  '_controller' => 'sonata.media.extra.pixlr:editAction',), array (), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'mode',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/pixlr/edit',  ),));
    }

    private function getsonata_media_pixlr_targetRouteInfo()
    {
        return array(array (  0 => 'hash',  1 => 'id',), array (  '_controller' => 'sonata.media.extra.pixlr:targetAction',), array (), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'hash',  ),  2 =>   array (    0 => 'text',    1 => '/pixlr/target',  ),));
    }

    private function getsonata_media_pixlr_exitRouteInfo()
    {
        return array(array (  0 => 'hash',  1 => 'id',), array (  '_controller' => 'sonata.media.extra.pixlr:exitAction',), array (), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'hash',  ),  2 =>   array (    0 => 'text',    1 => '/pixlr/exit',  ),));
    }

    private function getsonata_media_pixlr_open_editorRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'sonata.media.extra.pixlr:openEditorAction',), array (), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  1 =>   array (    0 => 'text',    1 => '/pixlr/open',  ),));
    }

    private function getadmin_gedmo_block_enabledentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\BlockController::enabledajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/block/enabled',  ),));
    }

    private function getadmin_gedmo_block_disablentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\BlockController::disableajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/block/disable',  ),));
    }

    private function getadmin_gedmo_block_position_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\BlockController::positionajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/block/position',  ),));
    }

    private function getadmin_gedmo_category_enabledentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\CategoryController::enabledajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/category/enabled',  ),));
    }

    private function getadmin_gedmo_category_disablentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\CategoryController::disableajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/category/disable',  ),));
    }

    private function getadmin_gedmo_category_position_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\CategoryController::positionajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/category/position',  ),));
    }

    private function getadmin_gedmo_content_enabledentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\ContentController::enabledajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/content/enabled',  ),));
    }

    private function getadmin_gedmo_content_disablentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\ContentController::disableajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/content/disable',  ),));
    }

    private function getadmin_gedmo_content_position_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\ContentController::positionajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/content/position',  ),));
    }

    private function getadmin_gedmo_media_enabledentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MediaController::enabledajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/media/enabled',  ),));
    }

    private function getadmin_gedmo_media_disablentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MediaController::disableajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/media/disable',  ),));
    }

    private function getadmin_gedmo_media_position_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MediaController::positionajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/media/position',  ),));
    }

    private function getadmin_gedmo_menu_enabledentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MenuController::enabledajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/menu/enabled',  ),));
    }

    private function getadmin_gedmo_menu_disablentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MenuController::disableajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/menu/disable',  ),));
    }

    private function getadmin_gedmo_menu_position_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MenuController::positionajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/menu/position',  ),));
    }

    private function getadmin_gedmo_organigram_enabledentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\OrganigramController::enabledajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/organigram/enabled',  ),));
    }

    private function getadmin_gedmo_organigram_disablentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\OrganigramController::disableajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/organigram/disable',  ),));
    }

    private function getadmin_gedmo_organigram_position_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\OrganigramController::positionajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/organigram/position',  ),));
    }

    private function getadmin_gedmo_slider_enabledentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\SliderController::enabledajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/slider/enabled',  ),));
    }

    private function getadmin_gedmo_slider_disablentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\SliderController::disableajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/slider/disable',  ),));
    }

    private function getadmin_gedmo_slider_position_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\SliderController::positionajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/slider/position',  ),));
    }

    private function getadmin_page_block_enabledentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\BlockByWidgetController::enabledajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/block/enabled',  ),));
    }

    private function getadmin_page_block_disablentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\BlockByWidgetController::disableajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/block/disable',  ),));
    }

    private function getadmin_page_block_position_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\BlockByWidgetController::positionajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/block/position',  ),));
    }

    private function getadmin_page_comment_enabledentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\CommentController::enabledajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/pagecomment/enabled',  ),));
    }

    private function getadmin_page_comment_disablentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\CommentController::disableajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/pagecomment/disable',  ),));
    }

    private function getadmin_page_comment_position_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\CommentController::positionajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/pagecomment/position',  ),));
    }

    private function getadmin_keyword_enabledentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\KeyWordController::enabledajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/keyWord/enabled',  ),));
    }

    private function getadmin_keyword_disablentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\KeyWordController::disableajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/keyWord/disable',  ),));
    }

    private function getadmin_langue_enabledentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LangueController::enabledajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/langue/enabled',  ),));
    }

    private function getadmin_langue_disablentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LangueController::disableajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/langue/disable',  ),));
    }

    private function getadmin_layout_enabledentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LayoutController::enabledajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/layout/enabled',  ),));
    }

    private function getadmin_layout_disablentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LayoutController::disableajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/layout/disable',  ),));
    }

    private function getadmin_pagebyblock_enabledentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByBlockController::enabledajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/pagebyblock/enabled',  ),));
    }

    private function getadmin_pagebyblock_disablentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByBlockController::disableajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/pagebyblock/disable',  ),));
    }

    private function getadmin_pagebytrans_enabledentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByTransController::enabledajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/pagebytrans/enabled',  ),));
    }

    private function getadmin_pagebytrans_disablentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByTransController::disableajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/pagebytrans/disable',  ),));
    }

    private function getadmin_pagecssjs_enabledentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageCssJsController::enabledajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/pagecssjs/enabled',  ),));
    }

    private function getadmin_pagecssjs_disablentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageCssJsController::disableajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/pagecssjs/disable',  ),));
    }

    private function getadmin_rubrique_enabledentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\RubriqueController::enabledajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/rubrique/enabled',  ),));
    }

    private function getadmin_rubrique_disablentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\RubriqueController::disableajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/rubrique/disable',  ),));
    }

    private function getadmin_snippet_enabledentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\SnippetController::enabledajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/widget/enabled',  ),));
    }

    private function getadmin_snippet_disablentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\SnippetController::disableajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/widget/disable',  ),));
    }

    private function getadmin_tag_enabledentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TagController::enabledajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/tag/enabled',  ),));
    }

    private function getadmin_tag_disablentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TagController::disableajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/tag/disable',  ),));
    }

    private function getadmin_translationpage_enabledentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationPageController::enabledajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/translationpage/enabled',  ),));
    }

    private function getadmin_translationpage_disablentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationPageController::disableajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/translationpage/disable',  ),));
    }

    private function getadmin_translationwidget_enabledentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationWidgetController::enabledajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/translationwidget/enabled',  ),));
    }

    private function getadmin_translationwidget_disablentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationWidgetController::disableajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/translationwidget/disable',  ),));
    }

    private function getadmin_widget_enabledentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\WidgetController::enabledajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/widget/enabled',  ),));
    }

    private function getadmin_widget_disablentity_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\WidgetController::disableajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/widget/disable',  ),));
    }

    private function getadmin_widget_position_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\WidgetController::positionajaxAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/widget/position',  ),));
    }

    private function getadmin_gedmo_categoryRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\CategoryController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/category/',  ),));
    }

    private function getadmin_gedmo_category_showRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\CategoryController::showAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/show',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/gedmo/category',  ),));
    }

    private function getadmin_gedmo_category_newRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\CategoryController::newAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/category/new',  ),));
    }

    private function getadmin_gedmo_category_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\CategoryController::createAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/category/create',  ),));
    }

    private function getadmin_gedmo_category_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\CategoryController::editAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/gedmo/category',  ),));
    }

    private function getadmin_gedmo_category_updateRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\CategoryController::updateAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/update',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/gedmo/category',  ),));
    }

    private function getadmin_gedmo_category_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\CategoryController::deleteAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/gedmo/category',  ),));
    }

    private function getadmin_gedmo_blockRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\BlockController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/block/',  ),));
    }

    private function getadmin_gedmo_block_showRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\BlockController::showAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/show',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/gedmo/block',  ),));
    }

    private function getadmin_gedmo_block_newRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\BlockController::newAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/block/new',  ),));
    }

    private function getadmin_gedmo_block_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\BlockController::createAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/block/create',  ),));
    }

    private function getadmin_gedmo_block_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\BlockController::editAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/gedmo/block',  ),));
    }

    private function getadmin_gedmo_block_updateRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\BlockController::updateAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/update',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/gedmo/block',  ),));
    }

    private function getadmin_gedmo_block_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\BlockController::deleteAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/gedmo/block',  ),));
    }

    private function getadmin_gedmo_contentRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\ContentController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/content/',  ),));
    }

    private function getadmin_gedmo_content_showRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\ContentController::showAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/show',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/gedmo/content',  ),));
    }

    private function getadmin_gedmo_content_newRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\ContentController::newAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/content/new',  ),));
    }

    private function getadmin_gedmo_content_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\ContentController::createAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/content/create',  ),));
    }

    private function getadmin_gedmo_content_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\ContentController::editAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/gedmo/content',  ),));
    }

    private function getadmin_gedmo_content_updateRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\ContentController::updateAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/update',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/gedmo/content',  ),));
    }

    private function getadmin_gedmo_content_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\ContentController::deleteAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/gedmo/content',  ),));
    }

    private function getadmin_gedmo_mediaRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MediaController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/media/',  ),));
    }

    private function getadmin_gedmo_media_showRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MediaController::showAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/show',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/gedmo/media',  ),));
    }

    private function getadmin_gedmo_media_newRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MediaController::newAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/media/new',  ),));
    }

    private function getadmin_gedmo_media_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MediaController::createAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/media/create',  ),));
    }

    private function getadmin_gedmo_media_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MediaController::editAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/gedmo/media',  ),));
    }

    private function getadmin_gedmo_media_updateRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MediaController::updateAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/update',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/gedmo/media',  ),));
    }

    private function getadmin_gedmo_media_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MediaController::deleteAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/gedmo/media',  ),));
    }

    private function getadmin_gedmo_menuRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MenuController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/menu/',  ),));
    }

    private function getadmin_gedmo_menu_showRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MenuController::showAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/show',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/gedmo/menu',  ),));
    }

    private function getadmin_gedmo_menu_newRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MenuController::newAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/menu/new',  ),));
    }

    private function getadmin_gedmo_menu_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MenuController::createAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/menu/create',  ),));
    }

    private function getadmin_gedmo_menu_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MenuController::editAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/gedmo/menu',  ),));
    }

    private function getadmin_gedmo_menu_updateRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MenuController::updateAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/update',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/gedmo/menu',  ),));
    }

    private function getadmin_gedmo_menu_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MenuController::deleteAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/gedmo/menu',  ),));
    }

    private function getadmin_gedmo_menu_knpRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MenuController::knpAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/menu/knp',  ),));
    }

    private function getadmin_gedmo_menu_treeRouteInfo()
    {
        return array(array (  0 => 'category',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MenuController::treeAction',), array (  'category' => '.*',), array (  0 =>   array (    0 => 'text',    1 => '/tree',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '.*',    3 => 'category',  ),  2 =>   array (    0 => 'text',    1 => '/admin/gedmo/menu',  ),));
    }

    private function getadmin_gedmo_menu_move_upRouteInfo()
    {
        return array(array (  0 => 'id',  1 => 'category',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MenuController::moveUpAction',), array (  'category' => '.*',), array (  0 =>   array (    0 => 'text',    1 => '/move-up',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '.*',    3 => 'category',  ),  2 =>   array (    0 => 'text',    1 => '/node',  ),  3 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  4 =>   array (    0 => 'text',    1 => '/admin/gedmo/menu',  ),));
    }

    private function getadmin_gedmo_menu_move_downRouteInfo()
    {
        return array(array (  0 => 'id',  1 => 'category',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MenuController::moveDownAction',), array (  'category' => '.*',), array (  0 =>   array (    0 => 'text',    1 => '/node/move-down',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '.*',    3 => 'category',  ),  2 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  3 =>   array (    0 => 'text',    1 => '/admin/gedmo/menu',  ),));
    }

    private function getadmin_gedmo_menu_node_removeRouteInfo()
    {
        return array(array (  0 => 'id',  1 => 'category',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MenuController::removeAction',), array (  'category' => '.*',), array (  0 =>   array (    0 => 'text',    1 => '/node/remove',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '.*',    3 => 'category',  ),  2 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  3 =>   array (    0 => 'text',    1 => '/admin/gedmo/menu',  ),));
    }

    private function getadmin_gedmo_sliderRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\SliderController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/slider/',  ),));
    }

    private function getadmin_gedmo_slider_showRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\SliderController::showAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/show',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/gedmo/slider',  ),));
    }

    private function getadmin_gedmo_slider_newRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\SliderController::newAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/slider/new',  ),));
    }

    private function getadmin_gedmo_slider_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\SliderController::createAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/slider/create',  ),));
    }

    private function getadmin_gedmo_slider_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\SliderController::editAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/gedmo/slider',  ),));
    }

    private function getadmin_gedmo_slider_updateRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\SliderController::updateAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/update',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/gedmo/slider',  ),));
    }

    private function getadmin_gedmo_slider_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\SliderController::deleteAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/gedmo/slider',  ),));
    }

    private function getadmin_gedmo_organigramRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\OrganigramController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/organigram/',  ),));
    }

    private function getadmin_gedmo_organigram_showRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\OrganigramController::showAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/show',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/gedmo/organigram',  ),));
    }

    private function getadmin_gedmo_organigram_newRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\OrganigramController::newAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/organigram/new',  ),));
    }

    private function getadmin_gedmo_organigram_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\OrganigramController::createAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/admin/gedmo/organigram/create',  ),));
    }

    private function getadmin_gedmo_organigram_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\OrganigramController::editAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/gedmo/organigram',  ),));
    }

    private function getadmin_gedmo_organigram_updateRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\OrganigramController::updateAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/update',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/gedmo/organigram',  ),));
    }

    private function getadmin_gedmo_organigram_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\OrganigramController::deleteAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/gedmo/organigram',  ),));
    }

    private function getadmin_gedmo_organigram_treeRouteInfo()
    {
        return array(array (  0 => 'category',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\OrganigramController::treeAction',), array (  'category' => '.*',), array (  0 =>   array (    0 => 'text',    1 => '/tree',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '.*',    3 => 'category',  ),  2 =>   array (    0 => 'text',    1 => '/admin/gedmo/organigram',  ),));
    }

    private function getadmin_gedmo_organigram_move_upRouteInfo()
    {
        return array(array (  0 => 'id',  1 => 'category',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\OrganigramController::moveUpAction',), array (  'category' => '.*',), array (  0 =>   array (    0 => 'text',    1 => '/node/move-up',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '.*',    3 => 'category',  ),  2 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  3 =>   array (    0 => 'text',    1 => '/admin/gedmo/organigram',  ),));
    }

    private function getadmin_gedmo_organigram_move_downRouteInfo()
    {
        return array(array (  0 => 'id',  1 => 'category',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\OrganigramController::moveDownAction',), array (  'category' => '.*',), array (  0 =>   array (    0 => 'text',    1 => '/node/move-down',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '.*',    3 => 'category',  ),  2 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  3 =>   array (    0 => 'text',    1 => '/admin/gedmo/organigram',  ),));
    }

    private function getadmin_gedmo_organigram_node_removeRouteInfo()
    {
        return array(array (  0 => 'id',  1 => 'category',), array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\OrganigramController::removeAction',), array (  'category' => '.*',), array (  0 =>   array (    0 => 'text',    1 => '/node/remove',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '.*',    3 => 'category',  ),  2 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  3 =>   array (    0 => 'text',    1 => '/admin/gedmo/organigram',  ),));
    }

    private function getadmin_layoutRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LayoutController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/layout/',  ),));
    }

    private function getadmin_layout_showRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LayoutController::showAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/show',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/layout',  ),));
    }

    private function getadmin_layout_newRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LayoutController::newAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/layout/new',  ),));
    }

    private function getadmin_layout_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LayoutController::createAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/admin/layout/create',  ),));
    }

    private function getadmin_layout_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LayoutController::editAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/layout',  ),));
    }

    private function getadmin_layout_updateRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LayoutController::updateAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/update',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/layout',  ),));
    }

    private function getadmin_layout_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LayoutController::deleteAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/layout',  ),));
    }

    private function getadmin_rubriqueRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\RubriqueController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/rubrique/',  ),));
    }

    private function getadmin_rubrique_showRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\RubriqueController::showAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/show',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/rubrique',  ),));
    }

    private function getadmin_rubrique_newRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\RubriqueController::newAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/rubrique/new',  ),));
    }

    private function getadmin_rubrique_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\RubriqueController::createAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/admin/rubrique/create',  ),));
    }

    private function getadmin_rubrique_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\RubriqueController::editAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/rubrique',  ),));
    }

    private function getadmin_rubrique_updateRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\RubriqueController::updateAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/update',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/rubrique',  ),));
    }

    private function getadmin_rubrique_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\RubriqueController::deleteAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/rubrique',  ),));
    }

    private function getadmin_rubrique_treeRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\RubriqueController::treeAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/rubrique/tree',  ),));
    }

    private function getadmin_rubrique_move_upRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\RubriqueController::moveUpAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/node/move-up',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/rubrique',  ),));
    }

    private function getadmin_rubrique_move_downRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\RubriqueController::moveDownAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/node/move-down',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/rubrique',  ),));
    }

    private function getadmin_rubrique_node_removeRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\RubriqueController::removeAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/node/remove',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/rubrique',  ),));
    }

    private function getadmin_pagebytransRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByTransController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/pagebytrans/',  ),));
    }

    private function getadmin_pagebytrans_wizardRouteInfo()
    {
        return array(array (  0 => 'status',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByTransController::wizardAction',), array (  'status' => 'all|draft|reviewed|published|hidden|trash|refused',), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => 'all|draft|reviewed|published|hidden|trash|refused',    3 => 'status',  ),  1 =>   array (    0 => 'text',    1 => '/admin/pagebytrans',  ),));
    }

    private function getadmin_pagebytrans_showRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByTransController::showAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/show',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/pagebytrans',  ),));
    }

    private function getadmin_pagebytrans_newRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByTransController::newAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/pagebytrans/new',  ),));
    }

    private function getadmin_pagebytrans_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByTransController::createAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/admin/pagebytrans/create',  ),));
    }

    private function getadmin_pagebytrans_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByTransController::editAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/pagebytrans',  ),));
    }

    private function getadmin_pagebytrans_updateRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByTransController::updateAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/update',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/pagebytrans',  ),));
    }

    private function getadmin_pagebytrans_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByTransController::deleteAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/pagebytrans',  ),));
    }

    private function getadmin_pagebyblockRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByBlockController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/pagebyblock/',  ),));
    }

    private function getadmin_pagebyblock_showRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByBlockController::showAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/show',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/pagebyblock',  ),));
    }

    private function getadmin_pagebyblock_newRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByBlockController::newAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/pagebyblock/new',  ),));
    }

    private function getadmin_pagebyblock_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByBlockController::createAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/admin/pagebyblock/create',  ),));
    }

    private function getadmin_pagebyblock_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByBlockController::editAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/pagebyblock',  ),));
    }

    private function getadmin_pagebyblock_updateRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByBlockController::updateAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/update',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/pagebyblock',  ),));
    }

    private function getadmin_pagebyblock_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByBlockController::deleteAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/pagebyblock',  ),));
    }

    private function getadmin_pagecssjsRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageCssJsController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/pagecssjs/',  ),));
    }

    private function getadmin_pagecssjs_showRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageCssJsController::showAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/show',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/pagecssjs',  ),));
    }

    private function getadmin_pagecssjs_newRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageCssJsController::newAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/pagecssjs/new',  ),));
    }

    private function getadmin_pagecssjs_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageCssJsController::createAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/admin/pagecssjs/create',  ),));
    }

    private function getadmin_pagecssjs_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageCssJsController::editAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/pagecssjs',  ),));
    }

    private function getadmin_pagecssjs_updateRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageCssJsController::updateAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/update',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/pagecssjs',  ),));
    }

    private function getadmin_pagecssjs_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageCssJsController::deleteAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/pagecssjs',  ),));
    }

    private function getadmin_transpageRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationPageController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/transpage/',  ),));
    }

    private function getadmin_transpage_showRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationPageController::showAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/show',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/transpage',  ),));
    }

    private function getadmin_transpage_newRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationPageController::newAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/transpage/new',  ),));
    }

    private function getadmin_transpage_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationPageController::createAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/admin/transpage/create',  ),));
    }

    private function getadmin_transpage_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationPageController::editAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/transpage',  ),));
    }

    private function getadmin_transpage_updateRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationPageController::updateAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/update',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/transpage',  ),));
    }

    private function getadmin_transpage_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationPageController::deleteAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/transpage',  ),));
    }

    private function getadmin_blockbywidgetRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\BlockByWidgetController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/blockbywidget/',  ),));
    }

    private function getadmin_blockbywidget_showRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\BlockByWidgetController::showAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/show',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/blockbywidget',  ),));
    }

    private function getadmin_blockbywidget_newRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\BlockByWidgetController::newAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/blockbywidget/new',  ),));
    }

    private function getadmin_blockbywidget_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\BlockByWidgetController::createAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/admin/blockbywidget/create',  ),));
    }

    private function getadmin_blockbywidget_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\BlockByWidgetController::editAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/blockbywidget',  ),));
    }

    private function getadmin_blockbywidget_updateRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\BlockByWidgetController::updateAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/update',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/blockbywidget',  ),));
    }

    private function getadmin_blockbywidget_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\BlockByWidgetController::deleteAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/blockbywidget',  ),));
    }

    private function getadmin_widgetRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\WidgetController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/widget/',  ),));
    }

    private function getadmin_widget_showRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\WidgetController::showAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/show',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/widget',  ),));
    }

    private function getadmin_widget_newRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\WidgetController::newAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/widget/new',  ),));
    }

    private function getadmin_widget_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\WidgetController::createAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/admin/widget/create',  ),));
    }

    private function getadmin_widget_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\WidgetController::editAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/widget',  ),));
    }

    private function getadmin_widget_updateRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\WidgetController::updateAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/update',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/widget',  ),));
    }

    private function getadmin_widget_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\WidgetController::deleteAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/widget',  ),));
    }

    private function getadmin_widget_delete_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\WidgetController::deleteajaxAction',), array (  '_method' => 'get|post',), array (  0 =>   array (    0 => 'text',    1 => '/admin/widget/ajax-delete',  ),));
    }

    private function getadmin_widget_movewidget_pageRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\WidgetController::movewidgetajaxAction',), array (  '_method' => 'get|post',), array (  0 =>   array (    0 => 'text',    1 => '/admin/widget/movewidget-page',  ),));
    }

    private function getadmin_widget_move_ajaxRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\WidgetController::moveajaxAction',), array (  '_method' => 'get|post',), array (  0 =>   array (    0 => 'text',    1 => '/admin/widget/move-page',  ),));
    }

    private function getadmin_snippetRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\SnippetController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/snippet/',  ),));
    }

    private function getadmin_snippet_showRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\SnippetController::showAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/show',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/snippet',  ),));
    }

    private function getadmin_snippet_newRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\SnippetController::newAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/snippet/new',  ),));
    }

    private function getadmin_snippet_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\SnippetController::createAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/admin/snippet/create',  ),));
    }

    private function getadmin_snippet_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\SnippetController::editAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/snippet',  ),));
    }

    private function getadmin_snippet_updateRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\SnippetController::updateAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/update',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/snippet',  ),));
    }

    private function getadmin_snippet_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\SnippetController::deleteAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/snippet',  ),));
    }

    private function getadmin_transwidgetRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationWidgetController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/transwidget/',  ),));
    }

    private function getadmin_transwidget_showRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationWidgetController::showAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/show',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/transwidget',  ),));
    }

    private function getadmin_transwidget_newRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationWidgetController::newAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/transwidget/new',  ),));
    }

    private function getadmin_transwidget_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationWidgetController::createAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/admin/transwidget/create',  ),));
    }

    private function getadmin_transwidget_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationWidgetController::editAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/transwidget',  ),));
    }

    private function getadmin_transwidget_updateRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationWidgetController::updateAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/update',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/transwidget',  ),));
    }

    private function getadmin_transwidget_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationWidgetController::deleteAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/transwidget',  ),));
    }

    private function getadmin_tagRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TagController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/tag/',  ),));
    }

    private function getadmin_tag_showRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TagController::showAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/show',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/tag',  ),));
    }

    private function getadmin_tag_newRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TagController::newAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/tag/new',  ),));
    }

    private function getadmin_tag_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TagController::createAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/admin/tag/create',  ),));
    }

    private function getadmin_tag_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TagController::editAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/tag',  ),));
    }

    private function getadmin_tag_updateRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TagController::updateAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/update',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/tag',  ),));
    }

    private function getadmin_tag_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TagController::deleteAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/tag',  ),));
    }

    private function getadmin_keywordRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\KeyWordController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/keyword/',  ),));
    }

    private function getadmin_keyword_showRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\KeyWordController::showAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/show',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/keyword',  ),));
    }

    private function getadmin_keyword_newRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\KeyWordController::newAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/keyword/new',  ),));
    }

    private function getadmin_keyword_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\KeyWordController::createAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/admin/keyword/create',  ),));
    }

    private function getadmin_keyword_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\KeyWordController::editAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/keyword',  ),));
    }

    private function getadmin_keyword_updateRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\KeyWordController::updateAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/update',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/keyword',  ),));
    }

    private function getadmin_keyword_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\KeyWordController::deleteAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/keyword',  ),));
    }

    private function getadmin_langueRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LangueController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/langue/',  ),));
    }

    private function getadmin_langue_showRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LangueController::showAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/show',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/langue',  ),));
    }

    private function getadmin_langue_newRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LangueController::newAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/langue/new',  ),));
    }

    private function getadmin_langue_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LangueController::createAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/admin/langue/create',  ),));
    }

    private function getadmin_langue_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LangueController::editAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/langue',  ),));
    }

    private function getadmin_langue_updateRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LangueController::updateAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/update',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/langue',  ),));
    }

    private function getadmin_langue_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LangueController::deleteAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/langue',  ),));
    }

    private function getadmin_commentRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\CommentController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/comment/',  ),));
    }

    private function getadmin_comment_showRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\CommentController::showAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/show',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/comment',  ),));
    }

    private function getadmin_comment_newRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\CommentController::newAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/admin/comment/new',  ),));
    }

    private function getadmin_comment_createRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\CommentController::createAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/admin/comment/create',  ),));
    }

    private function getadmin_comment_editRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\CommentController::editAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/edit',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/comment',  ),));
    }

    private function getadmin_comment_updateRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\CommentController::updateAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/update',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/comment',  ),));
    }

    private function getadmin_comment_deleteRouteInfo()
    {
        return array(array (  0 => 'id',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\CommentController::deleteAction',), array (  '_method' => 'post',), array (  0 =>   array (    0 => 'text',    1 => '/delete',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'id',  ),  2 =>   array (    0 => 'text',    1 => '/admin/comment',  ),));
    }

    private function getpi_layout_choisir_langueRouteInfo()
    {
        return array(array (  0 => 'langue',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\FrontendController::setLocalAction',), array (), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'langue',  ),  1 =>   array (    0 => 'text',    1 => '/local',  ),));
    }

    private function getadmin_homepageRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\FrontendController::indexAction',), array (), array (  0 =>   array (    0 => 'text',    1 => '/home',  ),));
    }

    private function getpublic_refresh_pageRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\FrontendController::refreshpageAction',), array (  '_method' => 'get|post',), array (  0 =>   array (    0 => 'text',    1 => '/refresh-page',  ),));
    }

    private function getpublic_indexation_pageRouteInfo()
    {
        return array(array (  0 => 'action',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\FrontendController::indexationAction',), array (  'action' => 'archiving||delete',  '_method' => 'get|post',), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => 'archiving||delete',    3 => 'action',  ),  1 =>   array (    0 => 'text',    1 => '/indexation-page',  ),));
    }

    private function getpublic_urlmanagement_pageRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\FrontendController::urlmanagementAction',), array (  '_method' => 'get|post',), array (  0 =>   array (    0 => 'text',    1 => '/urlmanagement-page',  ),));
    }

    private function getpublic_importmanagement_widgetRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\FrontendController::importmanagementAction',), array (  '_method' => 'get|post',), array (  0 =>   array (    0 => 'text',    1 => '/importmanagement-page',  ),));
    }

    private function getpublic_head_fileRouteInfo()
    {
        return array(array (  0 => 'filetype',  1 => 'file',), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\FrontendController::contentfileAction',), array (  'filetype' => 'css|js',  '_method' => 'GET',), array (  0 =>   array (    0 => 'variable',    1 => '/',    2 => '[^/]+?',    3 => 'file',  ),  1 =>   array (    0 => 'variable',    1 => '/',    2 => 'css|js',    3 => 'filetype',  ),));
    }

    private function getpublic_chainedRouteInfo()
    {
        return array(array (), array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\FrontendController::chainedAction',), array (  '_method' => 'get|post',), array (  0 =>   array (    0 => 'text',    1 => '/chained',  ),));
    }
}
