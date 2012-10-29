<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appdevUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appdevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = urldecode($pathinfo);

        // _demo_login
        if ($pathinfo === '/demo/secured/login') {
            return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::loginAction',  '_route' => '_demo_login',);
        }

        // _security_check
        if ($pathinfo === '/demo/secured/login_check') {
            return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::securityCheckAction',  '_route' => '_security_check',);
        }

        // _demo_logout
        if ($pathinfo === '/demo/secured/logout') {
            return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::logoutAction',  '_route' => '_demo_logout',);
        }

        // acme_demo_secured_hello
        if ($pathinfo === '/demo/secured/hello') {
            return array (  'name' => 'World',  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::helloAction',  '_route' => 'acme_demo_secured_hello',);
        }

        // _demo_secured_hello
        if (0 === strpos($pathinfo, '/demo/secured/hello') && preg_match('#^/demo/secured/hello/(?P<name>[^/]+?)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::helloAction',)), array('_route' => '_demo_secured_hello'));
        }

        // _demo_secured_hello_admin
        if (0 === strpos($pathinfo, '/demo/secured/hello/admin') && preg_match('#^/demo/secured/hello/admin/(?P<name>[^/]+?)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::helloadminAction',)), array('_route' => '_demo_secured_hello_admin'));
        }

        if (0 === strpos($pathinfo, '/demo')) {
            // _demo
            if (rtrim($pathinfo, '/') === '/demo') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', '_demo');
                }
                return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\DemoController::indexAction',  '_route' => '_demo',);
            }

            // _demo_hello
            if (0 === strpos($pathinfo, '/demo/hello') && preg_match('#^/demo/hello/(?P<name>[^/]+?)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Acme\\DemoBundle\\Controller\\DemoController::helloAction',)), array('_route' => '_demo_hello'));
            }

            // _demo_contact
            if ($pathinfo === '/demo/contact') {
                return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\DemoController::contactAction',  '_route' => '_demo_contact',);
            }

        }

        // _wdt
        if (preg_match('#^/_wdt/(?P<token>[^/]+?)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::toolbarAction',)), array('_route' => '_wdt'));
        }

        if (0 === strpos($pathinfo, '/_profiler')) {
            // _profiler_search
            if ($pathinfo === '/_profiler/search') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::searchAction',  '_route' => '_profiler_search',);
            }

            // _profiler_purge
            if ($pathinfo === '/_profiler/purge') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::purgeAction',  '_route' => '_profiler_purge',);
            }

            // _profiler_import
            if ($pathinfo === '/_profiler/import') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::importAction',  '_route' => '_profiler_import',);
            }

            // _profiler_export
            if (0 === strpos($pathinfo, '/_profiler/export') && preg_match('#^/_profiler/export/(?P<token>[^/\\.]+?)\\.txt$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::exportAction',)), array('_route' => '_profiler_export'));
            }

            // _profiler_search_results
            if (preg_match('#^/_profiler/(?P<token>[^/]+?)/search/results$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::searchResultsAction',)), array('_route' => '_profiler_search_results'));
            }

            // _profiler
            if (preg_match('#^/_profiler/(?P<token>[^/]+?)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::panelAction',)), array('_route' => '_profiler'));
            }

        }

        if (0 === strpos($pathinfo, '/_configurator')) {
            // _configurator_home
            if (rtrim($pathinfo, '/') === '/_configurator') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', '_configurator_home');
                }
                return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',  '_route' => '_configurator_home',);
            }

            // _configurator_step
            if (0 === strpos($pathinfo, '/_configurator/step') && preg_match('#^/_configurator/step/(?P<index>[^/]+?)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',)), array('_route' => '_configurator_step'));
            }

            // _configurator_final
            if ($pathinfo === '/_configurator/final') {
                return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',  '_route' => '_configurator_final',);
            }

        }

        if (0 === strpos($pathinfo, '/admin/group')) {
            // fos_user_group_list
            if ($pathinfo === '/admin/group/list') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_group_list;
                }
                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\GroupController::listAction',  '_route' => 'fos_user_group_list',);
            }
            not_fos_user_group_list:

            // fos_user_group_new
            if ($pathinfo === '/admin/group/new') {
                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\GroupController::newAction',  '_route' => 'fos_user_group_new',);
            }

            // fos_user_group_show
            if (preg_match('#^/admin/group/(?P<groupname>[^/]+?)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_group_show;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'FOS\\UserBundle\\Controller\\GroupController::showAction',)), array('_route' => 'fos_user_group_show'));
            }
            not_fos_user_group_show:

            // fos_user_group_edit
            if (preg_match('#^/admin/group/(?P<groupname>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'FOS\\UserBundle\\Controller\\GroupController::editAction',)), array('_route' => 'fos_user_group_edit'));
            }

            // fos_user_group_delete
            if (preg_match('#^/admin/group/(?P<groupname>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_group_delete;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'FOS\\UserBundle\\Controller\\GroupController::deleteAction',)), array('_route' => 'fos_user_group_delete'));
            }
            not_fos_user_group_delete:

        }

        // fos_user_security_login
        if ($pathinfo === '/login') {
            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::loginAction',  '_route' => 'fos_user_security_login',);
        }

        // fos_user_security_check
        if ($pathinfo === '/login_check') {
            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::checkAction',  '_route' => 'fos_user_security_check',);
        }

        // fos_user_security_logout
        if ($pathinfo === '/logout') {
            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::logoutAction',  '_route' => 'fos_user_security_logout',);
        }

        if (0 === strpos($pathinfo, '/user/profile')) {
            // fos_user_profile_show
            if (rtrim($pathinfo, '/') === '/user/profile') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_profile_show;
                }
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'fos_user_profile_show');
                }
                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ProfileController::showAction',  '_route' => 'fos_user_profile_show',);
            }
            not_fos_user_profile_show:

            // fos_user_profile_edit
            if ($pathinfo === '/user/profile/edit') {
                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ProfileController::editAction',  '_route' => 'fos_user_profile_edit',);
            }

        }

        if (0 === strpos($pathinfo, '/user/register')) {
            // fos_user_registration_register
            if (rtrim($pathinfo, '/') === '/user/register') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'fos_user_registration_register');
                }
                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::registerAction',  '_route' => 'fos_user_registration_register',);
            }

            // fos_user_registration_check_email
            if ($pathinfo === '/user/register/check-email') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_registration_check_email;
                }
                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::checkEmailAction',  '_route' => 'fos_user_registration_check_email',);
            }
            not_fos_user_registration_check_email:

            // fos_user_registration_confirm
            if (0 === strpos($pathinfo, '/user/register/confirm') && preg_match('#^/user/register/confirm/(?P<token>[^/]+?)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_registration_confirm;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::confirmAction',)), array('_route' => 'fos_user_registration_confirm'));
            }
            not_fos_user_registration_confirm:

            // fos_user_registration_confirmed
            if ($pathinfo === '/user/register/confirmed') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_registration_confirmed;
                }
                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::confirmedAction',  '_route' => 'fos_user_registration_confirmed',);
            }
            not_fos_user_registration_confirmed:

        }

        if (0 === strpos($pathinfo, '/user/resetting')) {
            // fos_user_resetting_request
            if ($pathinfo === '/user/resetting/request') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_resetting_request;
                }
                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::requestAction',  '_route' => 'fos_user_resetting_request',);
            }
            not_fos_user_resetting_request:

            // fos_user_resetting_send_email
            if ($pathinfo === '/user/resetting/send-email') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_fos_user_resetting_send_email;
                }
                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::sendEmailAction',  '_route' => 'fos_user_resetting_send_email',);
            }
            not_fos_user_resetting_send_email:

            // fos_user_resetting_check_email
            if ($pathinfo === '/user/resetting/check-email') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_resetting_check_email;
                }
                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::checkEmailAction',  '_route' => 'fos_user_resetting_check_email',);
            }
            not_fos_user_resetting_check_email:

            // fos_user_resetting_reset
            if (0 === strpos($pathinfo, '/user/resetting/reset') && preg_match('#^/user/resetting/reset/(?P<token>[^/]+?)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_fos_user_resetting_reset;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::resetAction',)), array('_route' => 'fos_user_resetting_reset'));
            }
            not_fos_user_resetting_reset:

        }

        // fos_user_change_password
        if ($pathinfo === '/user/change-password/change-password') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_fos_user_change_password;
            }
            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ChangePasswordController::changePasswordAction',  '_route' => 'fos_user_change_password',);
        }
        not_fos_user_change_password:

        // home_page
        if (rtrim($pathinfo, '/') === '') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_home_page;
            }
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'home_page');
            }
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\FrontendController::pageAction',  '_route' => 'home_page',);
        }
        not_home_page:

        // error_404.fr_FR
        if ($pathinfo === '/error/error404-fr') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_error_404fr_FR;
            }
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\FrontendController::pageAction',  '_locale' => 'fr_FR',  '_route' => 'error_404.fr_FR',);
        }
        not_error_404fr_FR:

        // error_404.en_GB
        if ($pathinfo === '/error/error404-en') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_error_404en_GB;
            }
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\FrontendController::pageAction',  '_locale' => 'en_GB',  '_route' => 'error_404.en_GB',);
        }
        not_error_404en_GB:

        // unauthorized
        if ($pathinfo === '/unauthorized') {
            return array (  '_controller' => 'BootStrap\\UserBundle\\Controller\\ErrorController::unauthorizedAction',  '_route' => 'unauthorized',);
        }

        if (0 === strpos($pathinfo, '/adminsonata')) {
            // sonata_admin_dashboard
            if ($pathinfo === '/adminsonata/dashboard') {
                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CoreController::dashboardAction',  '_route' => 'sonata_admin_dashboard',);
            }

            // sonata_admin_retrieve_form_element
            if ($pathinfo === '/adminsonata/core/get-form-field-element') {
                return array (  '_controller' => 'sonata.admin.controller.admin:retrieveFormFieldElementAction',  '_route' => 'sonata_admin_retrieve_form_element',);
            }

            // sonata_admin_append_form_element
            if ($pathinfo === '/adminsonata/core/append-form-field-element') {
                return array (  '_controller' => 'sonata.admin.controller.admin:appendFormFieldElementAction',  '_route' => 'sonata_admin_append_form_element',);
            }

            // sonata_admin_short_object_information
            if ($pathinfo === '/adminsonata/core/get-short-object-description') {
                return array (  '_controller' => 'sonata.admin.controller.admin:getShortObjectDescriptionAction',  '_route' => 'sonata_admin_short_object_information',);
            }

            // sonata_admin_set_object_field_value
            if ($pathinfo === '/adminsonata/core/set-object-field-value') {
                return array (  '_controller' => 'sonata.admin.controller.admin:setObjectFieldValueAction',  '_route' => 'sonata_admin_set_object_field_value',);
            }

            // admin_bootstrap_media_media_list
            if ($pathinfo === '/adminsonata/bootstrap/media/media/list') {
                return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::listAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_bootstrap_media_media_list',  '_route' => 'admin_bootstrap_media_media_list',);
            }

            // admin_bootstrap_media_media_create
            if ($pathinfo === '/adminsonata/bootstrap/media/media/create') {
                return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::createAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_bootstrap_media_media_create',  '_route' => 'admin_bootstrap_media_media_create',);
            }

            // admin_bootstrap_media_media_batch
            if ($pathinfo === '/adminsonata/bootstrap/media/media/batch') {
                return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::batchAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_bootstrap_media_media_batch',  '_route' => 'admin_bootstrap_media_media_batch',);
            }

            // admin_bootstrap_media_media_edit
            if (0 === strpos($pathinfo, '/adminsonata/bootstrap/media/media') && preg_match('#^/adminsonata/bootstrap/media/media/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::editAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_bootstrap_media_media_edit',)), array('_route' => 'admin_bootstrap_media_media_edit'));
            }

            // admin_bootstrap_media_media_delete
            if (0 === strpos($pathinfo, '/adminsonata/bootstrap/media/media') && preg_match('#^/adminsonata/bootstrap/media/media/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::deleteAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_bootstrap_media_media_delete',)), array('_route' => 'admin_bootstrap_media_media_delete'));
            }

            // admin_bootstrap_media_media_show
            if (0 === strpos($pathinfo, '/adminsonata/bootstrap/media/media') && preg_match('#^/adminsonata/bootstrap/media/media/(?P<id>[^/]+?)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::showAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_bootstrap_media_media_show',)), array('_route' => 'admin_bootstrap_media_media_show'));
            }

            // admin_bootstrap_media_media_export
            if ($pathinfo === '/adminsonata/bootstrap/media/media/export') {
                return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::exportAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_bootstrap_media_media_export',  '_route' => 'admin_bootstrap_media_media_export',);
            }

            // admin_bootstrap_media_media_view
            if (0 === strpos($pathinfo, '/adminsonata/bootstrap/media/media') && preg_match('#^/adminsonata/bootstrap/media/media/(?P<id>[^/]+?)/view$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::viewAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_bootstrap_media_media_view',)), array('_route' => 'admin_bootstrap_media_media_view'));
            }

            // admin_bootstrap_media_gallery_list
            if ($pathinfo === '/adminsonata/bootstrap/media/gallery/list') {
                return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::listAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_bootstrap_media_gallery_list',  '_route' => 'admin_bootstrap_media_gallery_list',);
            }

            // admin_bootstrap_media_gallery_create
            if ($pathinfo === '/adminsonata/bootstrap/media/gallery/create') {
                return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::createAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_bootstrap_media_gallery_create',  '_route' => 'admin_bootstrap_media_gallery_create',);
            }

            // admin_bootstrap_media_gallery_batch
            if ($pathinfo === '/adminsonata/bootstrap/media/gallery/batch') {
                return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::batchAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_bootstrap_media_gallery_batch',  '_route' => 'admin_bootstrap_media_gallery_batch',);
            }

            // admin_bootstrap_media_gallery_edit
            if (0 === strpos($pathinfo, '/adminsonata/bootstrap/media/gallery') && preg_match('#^/adminsonata/bootstrap/media/gallery/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::editAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_bootstrap_media_gallery_edit',)), array('_route' => 'admin_bootstrap_media_gallery_edit'));
            }

            // admin_bootstrap_media_gallery_delete
            if (0 === strpos($pathinfo, '/adminsonata/bootstrap/media/gallery') && preg_match('#^/adminsonata/bootstrap/media/gallery/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::deleteAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_bootstrap_media_gallery_delete',)), array('_route' => 'admin_bootstrap_media_gallery_delete'));
            }

            // admin_bootstrap_media_gallery_show
            if (0 === strpos($pathinfo, '/adminsonata/bootstrap/media/gallery') && preg_match('#^/adminsonata/bootstrap/media/gallery/(?P<id>[^/]+?)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::showAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_bootstrap_media_gallery_show',)), array('_route' => 'admin_bootstrap_media_gallery_show'));
            }

            // admin_bootstrap_media_gallery_export
            if ($pathinfo === '/adminsonata/bootstrap/media/gallery/export') {
                return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::exportAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_bootstrap_media_gallery_export',  '_route' => 'admin_bootstrap_media_gallery_export',);
            }

            // admin_bootstrap_media_galleryhasmedia_list
            if ($pathinfo === '/adminsonata/bootstrap/media/galleryhasmedia/list') {
                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_bootstrap_media_galleryhasmedia_list',  '_route' => 'admin_bootstrap_media_galleryhasmedia_list',);
            }

            // admin_bootstrap_media_galleryhasmedia_create
            if ($pathinfo === '/adminsonata/bootstrap/media/galleryhasmedia/create') {
                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_bootstrap_media_galleryhasmedia_create',  '_route' => 'admin_bootstrap_media_galleryhasmedia_create',);
            }

            // admin_bootstrap_media_galleryhasmedia_batch
            if ($pathinfo === '/adminsonata/bootstrap/media/galleryhasmedia/batch') {
                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_bootstrap_media_galleryhasmedia_batch',  '_route' => 'admin_bootstrap_media_galleryhasmedia_batch',);
            }

            // admin_bootstrap_media_galleryhasmedia_edit
            if (0 === strpos($pathinfo, '/adminsonata/bootstrap/media/galleryhasmedia') && preg_match('#^/adminsonata/bootstrap/media/galleryhasmedia/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_bootstrap_media_galleryhasmedia_edit',)), array('_route' => 'admin_bootstrap_media_galleryhasmedia_edit'));
            }

            // admin_bootstrap_media_galleryhasmedia_delete
            if (0 === strpos($pathinfo, '/adminsonata/bootstrap/media/galleryhasmedia') && preg_match('#^/adminsonata/bootstrap/media/galleryhasmedia/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_bootstrap_media_galleryhasmedia_delete',)), array('_route' => 'admin_bootstrap_media_galleryhasmedia_delete'));
            }

            // admin_bootstrap_media_galleryhasmedia_show
            if (0 === strpos($pathinfo, '/adminsonata/bootstrap/media/galleryhasmedia') && preg_match('#^/adminsonata/bootstrap/media/galleryhasmedia/(?P<id>[^/]+?)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_bootstrap_media_galleryhasmedia_show',)), array('_route' => 'admin_bootstrap_media_galleryhasmedia_show'));
            }

            // admin_bootstrap_media_galleryhasmedia_export
            if ($pathinfo === '/adminsonata/bootstrap/media/galleryhasmedia/export') {
                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_bootstrap_media_galleryhasmedia_export',  '_route' => 'admin_bootstrap_media_galleryhasmedia_export',);
            }

            // admin_bootstrap_user_group_list
            if ($pathinfo === '/adminsonata/group/list') {
                return array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\GroupAdminController::listAction',  '_sonata_admin' => 'bootstrap.admin.admin.group',  '_sonata_name' => 'admin_bootstrap_user_group_list',  '_route' => 'admin_bootstrap_user_group_list',);
            }

            // admin_bootstrap_user_group_create
            if ($pathinfo === '/adminsonata/group/create') {
                return array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\GroupAdminController::createAction',  '_sonata_admin' => 'bootstrap.admin.admin.group',  '_sonata_name' => 'admin_bootstrap_user_group_create',  '_route' => 'admin_bootstrap_user_group_create',);
            }

            // admin_bootstrap_user_group_batch
            if ($pathinfo === '/adminsonata/group/batch') {
                return array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\GroupAdminController::batchAction',  '_sonata_admin' => 'bootstrap.admin.admin.group',  '_sonata_name' => 'admin_bootstrap_user_group_batch',  '_route' => 'admin_bootstrap_user_group_batch',);
            }

            // admin_bootstrap_user_group_edit
            if (0 === strpos($pathinfo, '/adminsonata/group') && preg_match('#^/adminsonata/group/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\GroupAdminController::editAction',  '_sonata_admin' => 'bootstrap.admin.admin.group',  '_sonata_name' => 'admin_bootstrap_user_group_edit',)), array('_route' => 'admin_bootstrap_user_group_edit'));
            }

            // admin_bootstrap_user_group_delete
            if (0 === strpos($pathinfo, '/adminsonata/group') && preg_match('#^/adminsonata/group/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\GroupAdminController::deleteAction',  '_sonata_admin' => 'bootstrap.admin.admin.group',  '_sonata_name' => 'admin_bootstrap_user_group_delete',)), array('_route' => 'admin_bootstrap_user_group_delete'));
            }

            // admin_bootstrap_user_group_show
            if (0 === strpos($pathinfo, '/adminsonata/group') && preg_match('#^/adminsonata/group/(?P<id>[^/]+?)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\GroupAdminController::showAction',  '_sonata_admin' => 'bootstrap.admin.admin.group',  '_sonata_name' => 'admin_bootstrap_user_group_show',)), array('_route' => 'admin_bootstrap_user_group_show'));
            }

            // admin_bootstrap_user_group_export
            if ($pathinfo === '/adminsonata/group/export') {
                return array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\GroupAdminController::exportAction',  '_sonata_admin' => 'bootstrap.admin.admin.group',  '_sonata_name' => 'admin_bootstrap_user_group_export',  '_route' => 'admin_bootstrap_user_group_export',);
            }

            // admin_bootstrap_user_user_list
            if ($pathinfo === '/adminsonata/user/list') {
                return array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\UserAdminController::listAction',  '_sonata_admin' => 'bootstrap.admin.admin.user',  '_sonata_name' => 'admin_bootstrap_user_user_list',  '_route' => 'admin_bootstrap_user_user_list',);
            }

            // admin_bootstrap_user_user_create
            if ($pathinfo === '/adminsonata/user/create') {
                return array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\UserAdminController::createAction',  '_sonata_admin' => 'bootstrap.admin.admin.user',  '_sonata_name' => 'admin_bootstrap_user_user_create',  '_route' => 'admin_bootstrap_user_user_create',);
            }

            // admin_bootstrap_user_user_batch
            if ($pathinfo === '/adminsonata/user/batch') {
                return array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\UserAdminController::batchAction',  '_sonata_admin' => 'bootstrap.admin.admin.user',  '_sonata_name' => 'admin_bootstrap_user_user_batch',  '_route' => 'admin_bootstrap_user_user_batch',);
            }

            // admin_bootstrap_user_user_edit
            if (0 === strpos($pathinfo, '/adminsonata/user') && preg_match('#^/adminsonata/user/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\UserAdminController::editAction',  '_sonata_admin' => 'bootstrap.admin.admin.user',  '_sonata_name' => 'admin_bootstrap_user_user_edit',)), array('_route' => 'admin_bootstrap_user_user_edit'));
            }

            // admin_bootstrap_user_user_delete
            if (0 === strpos($pathinfo, '/adminsonata/user') && preg_match('#^/adminsonata/user/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\UserAdminController::deleteAction',  '_sonata_admin' => 'bootstrap.admin.admin.user',  '_sonata_name' => 'admin_bootstrap_user_user_delete',)), array('_route' => 'admin_bootstrap_user_user_delete'));
            }

            // admin_bootstrap_user_user_show
            if (0 === strpos($pathinfo, '/adminsonata/user') && preg_match('#^/adminsonata/user/(?P<id>[^/]+?)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\UserAdminController::showAction',  '_sonata_admin' => 'bootstrap.admin.admin.user',  '_sonata_name' => 'admin_bootstrap_user_user_show',)), array('_route' => 'admin_bootstrap_user_user_show'));
            }

            // admin_bootstrap_user_user_export
            if ($pathinfo === '/adminsonata/user/export') {
                return array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\UserAdminController::exportAction',  '_sonata_admin' => 'bootstrap.admin.admin.user',  '_sonata_name' => 'admin_bootstrap_user_user_export',  '_route' => 'admin_bootstrap_user_user_export',);
            }

            // admin_bootstrap_user_role_list
            if ($pathinfo === '/adminsonata/role/list') {
                return array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\RoleAdminController::listAction',  '_sonata_admin' => 'bootstrap.admin.admin.role',  '_sonata_name' => 'admin_bootstrap_user_role_list',  '_route' => 'admin_bootstrap_user_role_list',);
            }

            // admin_bootstrap_user_role_create
            if ($pathinfo === '/adminsonata/role/create') {
                return array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\RoleAdminController::createAction',  '_sonata_admin' => 'bootstrap.admin.admin.role',  '_sonata_name' => 'admin_bootstrap_user_role_create',  '_route' => 'admin_bootstrap_user_role_create',);
            }

            // admin_bootstrap_user_role_batch
            if ($pathinfo === '/adminsonata/role/batch') {
                return array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\RoleAdminController::batchAction',  '_sonata_admin' => 'bootstrap.admin.admin.role',  '_sonata_name' => 'admin_bootstrap_user_role_batch',  '_route' => 'admin_bootstrap_user_role_batch',);
            }

            // admin_bootstrap_user_role_edit
            if (0 === strpos($pathinfo, '/adminsonata/role') && preg_match('#^/adminsonata/role/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\RoleAdminController::editAction',  '_sonata_admin' => 'bootstrap.admin.admin.role',  '_sonata_name' => 'admin_bootstrap_user_role_edit',)), array('_route' => 'admin_bootstrap_user_role_edit'));
            }

            // admin_bootstrap_user_role_delete
            if (0 === strpos($pathinfo, '/adminsonata/role') && preg_match('#^/adminsonata/role/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\RoleAdminController::deleteAction',  '_sonata_admin' => 'bootstrap.admin.admin.role',  '_sonata_name' => 'admin_bootstrap_user_role_delete',)), array('_route' => 'admin_bootstrap_user_role_delete'));
            }

            // admin_bootstrap_user_role_show
            if (0 === strpos($pathinfo, '/adminsonata/role') && preg_match('#^/adminsonata/role/(?P<id>[^/]+?)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\RoleAdminController::showAction',  '_sonata_admin' => 'bootstrap.admin.admin.role',  '_sonata_name' => 'admin_bootstrap_user_role_show',)), array('_route' => 'admin_bootstrap_user_role_show'));
            }

            // admin_bootstrap_user_role_export
            if ($pathinfo === '/adminsonata/role/export') {
                return array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\RoleAdminController::exportAction',  '_sonata_admin' => 'bootstrap.admin.admin.role',  '_sonata_name' => 'admin_bootstrap_user_role_export',  '_route' => 'admin_bootstrap_user_role_export',);
            }

            // admin_bootstrap_user_permission_list
            if ($pathinfo === '/adminsonata/permission/list') {
                return array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\PermissionAdminController::listAction',  '_sonata_admin' => 'bootstrap.admin.admin.permission',  '_sonata_name' => 'admin_bootstrap_user_permission_list',  '_route' => 'admin_bootstrap_user_permission_list',);
            }

            // admin_bootstrap_user_permission_create
            if ($pathinfo === '/adminsonata/permission/create') {
                return array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\PermissionAdminController::createAction',  '_sonata_admin' => 'bootstrap.admin.admin.permission',  '_sonata_name' => 'admin_bootstrap_user_permission_create',  '_route' => 'admin_bootstrap_user_permission_create',);
            }

            // admin_bootstrap_user_permission_batch
            if ($pathinfo === '/adminsonata/permission/batch') {
                return array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\PermissionAdminController::batchAction',  '_sonata_admin' => 'bootstrap.admin.admin.permission',  '_sonata_name' => 'admin_bootstrap_user_permission_batch',  '_route' => 'admin_bootstrap_user_permission_batch',);
            }

            // admin_bootstrap_user_permission_edit
            if (0 === strpos($pathinfo, '/adminsonata/permission') && preg_match('#^/adminsonata/permission/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\PermissionAdminController::editAction',  '_sonata_admin' => 'bootstrap.admin.admin.permission',  '_sonata_name' => 'admin_bootstrap_user_permission_edit',)), array('_route' => 'admin_bootstrap_user_permission_edit'));
            }

            // admin_bootstrap_user_permission_delete
            if (0 === strpos($pathinfo, '/adminsonata/permission') && preg_match('#^/adminsonata/permission/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\PermissionAdminController::deleteAction',  '_sonata_admin' => 'bootstrap.admin.admin.permission',  '_sonata_name' => 'admin_bootstrap_user_permission_delete',)), array('_route' => 'admin_bootstrap_user_permission_delete'));
            }

            // admin_bootstrap_user_permission_show
            if (0 === strpos($pathinfo, '/adminsonata/permission') && preg_match('#^/adminsonata/permission/(?P<id>[^/]+?)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\PermissionAdminController::showAction',  '_sonata_admin' => 'bootstrap.admin.admin.permission',  '_sonata_name' => 'admin_bootstrap_user_permission_show',)), array('_route' => 'admin_bootstrap_user_permission_show'));
            }

            // admin_bootstrap_user_permission_export
            if ($pathinfo === '/adminsonata/permission/export') {
                return array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\PermissionAdminController::exportAction',  '_sonata_admin' => 'bootstrap.admin.admin.permission',  '_sonata_name' => 'admin_bootstrap_user_permission_export',  '_route' => 'admin_bootstrap_user_permission_export',);
            }

            // admin_piapp_admin_historicalstatus_list
            if ($pathinfo === '/adminsonata/historicalpage/list') {
                return array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\HistoricalPageCMSController::listAction',  '_sonata_admin' => 'bootstrap.admin.admin.historicalpage',  '_sonata_name' => 'admin_piapp_admin_historicalstatus_list',  '_route' => 'admin_piapp_admin_historicalstatus_list',);
            }

            // admin_piapp_admin_historicalstatus_create
            if ($pathinfo === '/adminsonata/historicalpage/create') {
                return array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\HistoricalPageCMSController::createAction',  '_sonata_admin' => 'bootstrap.admin.admin.historicalpage',  '_sonata_name' => 'admin_piapp_admin_historicalstatus_create',  '_route' => 'admin_piapp_admin_historicalstatus_create',);
            }

            // admin_piapp_admin_historicalstatus_batch
            if ($pathinfo === '/adminsonata/historicalpage/batch') {
                return array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\HistoricalPageCMSController::batchAction',  '_sonata_admin' => 'bootstrap.admin.admin.historicalpage',  '_sonata_name' => 'admin_piapp_admin_historicalstatus_batch',  '_route' => 'admin_piapp_admin_historicalstatus_batch',);
            }

            // admin_piapp_admin_historicalstatus_edit
            if (0 === strpos($pathinfo, '/adminsonata/historicalpage') && preg_match('#^/adminsonata/historicalpage/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\HistoricalPageCMSController::editAction',  '_sonata_admin' => 'bootstrap.admin.admin.historicalpage',  '_sonata_name' => 'admin_piapp_admin_historicalstatus_edit',)), array('_route' => 'admin_piapp_admin_historicalstatus_edit'));
            }

            // admin_piapp_admin_historicalstatus_delete
            if (0 === strpos($pathinfo, '/adminsonata/historicalpage') && preg_match('#^/adminsonata/historicalpage/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\HistoricalPageCMSController::deleteAction',  '_sonata_admin' => 'bootstrap.admin.admin.historicalpage',  '_sonata_name' => 'admin_piapp_admin_historicalstatus_delete',)), array('_route' => 'admin_piapp_admin_historicalstatus_delete'));
            }

            // admin_piapp_admin_historicalstatus_show
            if (0 === strpos($pathinfo, '/adminsonata/historicalpage') && preg_match('#^/adminsonata/historicalpage/(?P<id>[^/]+?)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\HistoricalPageCMSController::showAction',  '_sonata_admin' => 'bootstrap.admin.admin.historicalpage',  '_sonata_name' => 'admin_piapp_admin_historicalstatus_show',)), array('_route' => 'admin_piapp_admin_historicalstatus_show'));
            }

            // admin_piapp_admin_historicalstatus_export
            if ($pathinfo === '/adminsonata/historicalpage/export') {
                return array (  '_controller' => 'BootStrap\\AdminBundle\\Controller\\HistoricalPageCMSController::exportAction',  '_sonata_admin' => 'bootstrap.admin.admin.historicalpage',  '_sonata_name' => 'admin_piapp_admin_historicalstatus_export',  '_route' => 'admin_piapp_admin_historicalstatus_export',);
            }

        }

        if (0 === strpos($pathinfo, '/media/gallery')) {
            // sonata_media_gallery_index
            if (rtrim($pathinfo, '/') === '/media/gallery') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'sonata_media_gallery_index');
                }
                return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryController::indexAction',  '_route' => 'sonata_media_gallery_index',);
            }

            // sonata_media_gallery_view
            if (0 === strpos($pathinfo, '/media/gallery/view') && preg_match('#^/media/gallery/view/(?P<id>[^/]+?)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryController::viewAction',)), array('_route' => 'sonata_media_gallery_view'));
            }

        }

        if (0 === strpos($pathinfo, '/media')) {
            // sonata_media_view
            if (0 === strpos($pathinfo, '/media/view') && preg_match('#^/media/view/(?P<id>[^/]+?)(?:/(?P<format>[^/]+?))?$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaController::viewAction',  'format' => 'reference',)), array('_route' => 'sonata_media_view'));
            }

            // sonata_media_download
            if (0 === strpos($pathinfo, '/media/download') && preg_match('#^/media/download/(?P<id>[^/]+?)(?:/(?P<format>[^/]+?))?$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaController::downloadAction',  'format' => 'reference',)), array('_route' => 'sonata_media_download'));
            }

        }

        // sonata_media_pixlr_edit
        if (0 === strpos($pathinfo, '/pixlr/edit') && preg_match('#^/pixlr/edit/(?P<id>[^/]+?)/(?P<mode>[^/]+?)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'sonata.media.extra.pixlr:editAction',)), array('_route' => 'sonata_media_pixlr_edit'));
        }

        // sonata_media_pixlr_target
        if (0 === strpos($pathinfo, '/pixlr/target') && preg_match('#^/pixlr/target/(?P<hash>[^/]+?)/(?P<id>[^/]+?)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'sonata.media.extra.pixlr:targetAction',)), array('_route' => 'sonata_media_pixlr_target'));
        }

        // sonata_media_pixlr_exit
        if (0 === strpos($pathinfo, '/pixlr/exit') && preg_match('#^/pixlr/exit/(?P<hash>[^/]+?)/(?P<id>[^/]+?)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'sonata.media.extra.pixlr:exitAction',)), array('_route' => 'sonata_media_pixlr_exit'));
        }

        // sonata_media_pixlr_open_editor
        if (0 === strpos($pathinfo, '/pixlr/open') && preg_match('#^/pixlr/open/(?P<id>[^/]+?)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'sonata.media.extra.pixlr:openEditorAction',)), array('_route' => 'sonata_media_pixlr_open_editor'));
        }

        // admin_gedmo_block_enabledentity_ajax
        if ($pathinfo === '/admin/gedmo/block/enabled') {
            return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\BlockController::enabledajaxAction',  '_route' => 'admin_gedmo_block_enabledentity_ajax',);
        }

        // admin_gedmo_block_disablentity_ajax
        if ($pathinfo === '/admin/gedmo/block/disable') {
            return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\BlockController::disableajaxAction',  '_route' => 'admin_gedmo_block_disablentity_ajax',);
        }

        // admin_gedmo_block_position_ajax
        if ($pathinfo === '/admin/gedmo/block/position') {
            return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\BlockController::positionajaxAction',  '_route' => 'admin_gedmo_block_position_ajax',);
        }

        // admin_gedmo_category_enabledentity_ajax
        if ($pathinfo === '/admin/gedmo/category/enabled') {
            return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\CategoryController::enabledajaxAction',  '_route' => 'admin_gedmo_category_enabledentity_ajax',);
        }

        // admin_gedmo_category_disablentity_ajax
        if ($pathinfo === '/admin/gedmo/category/disable') {
            return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\CategoryController::disableajaxAction',  '_route' => 'admin_gedmo_category_disablentity_ajax',);
        }

        // admin_gedmo_category_position_ajax
        if ($pathinfo === '/admin/gedmo/category/position') {
            return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\CategoryController::positionajaxAction',  '_route' => 'admin_gedmo_category_position_ajax',);
        }

        // admin_gedmo_content_enabledentity_ajax
        if ($pathinfo === '/admin/gedmo/content/enabled') {
            return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\ContentController::enabledajaxAction',  '_route' => 'admin_gedmo_content_enabledentity_ajax',);
        }

        // admin_gedmo_content_disablentity_ajax
        if ($pathinfo === '/admin/gedmo/content/disable') {
            return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\ContentController::disableajaxAction',  '_route' => 'admin_gedmo_content_disablentity_ajax',);
        }

        // admin_gedmo_content_position_ajax
        if ($pathinfo === '/admin/gedmo/content/position') {
            return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\ContentController::positionajaxAction',  '_route' => 'admin_gedmo_content_position_ajax',);
        }

        // admin_gedmo_media_enabledentity_ajax
        if ($pathinfo === '/admin/gedmo/media/enabled') {
            return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MediaController::enabledajaxAction',  '_route' => 'admin_gedmo_media_enabledentity_ajax',);
        }

        // admin_gedmo_media_disablentity_ajax
        if ($pathinfo === '/admin/gedmo/media/disable') {
            return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MediaController::disableajaxAction',  '_route' => 'admin_gedmo_media_disablentity_ajax',);
        }

        // admin_gedmo_media_position_ajax
        if ($pathinfo === '/admin/gedmo/media/position') {
            return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MediaController::positionajaxAction',  '_route' => 'admin_gedmo_media_position_ajax',);
        }

        // admin_gedmo_menu_enabledentity_ajax
        if ($pathinfo === '/admin/gedmo/menu/enabled') {
            return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MenuController::enabledajaxAction',  '_route' => 'admin_gedmo_menu_enabledentity_ajax',);
        }

        // admin_gedmo_menu_disablentity_ajax
        if ($pathinfo === '/admin/gedmo/menu/disable') {
            return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MenuController::disableajaxAction',  '_route' => 'admin_gedmo_menu_disablentity_ajax',);
        }

        // admin_gedmo_menu_position_ajax
        if ($pathinfo === '/admin/gedmo/menu/position') {
            return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MenuController::positionajaxAction',  '_route' => 'admin_gedmo_menu_position_ajax',);
        }

        // admin_gedmo_organigram_enabledentity_ajax
        if ($pathinfo === '/admin/gedmo/organigram/enabled') {
            return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\OrganigramController::enabledajaxAction',  '_route' => 'admin_gedmo_organigram_enabledentity_ajax',);
        }

        // admin_gedmo_organigram_disablentity_ajax
        if ($pathinfo === '/admin/gedmo/organigram/disable') {
            return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\OrganigramController::disableajaxAction',  '_route' => 'admin_gedmo_organigram_disablentity_ajax',);
        }

        // admin_gedmo_organigram_position_ajax
        if ($pathinfo === '/admin/gedmo/organigram/position') {
            return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\OrganigramController::positionajaxAction',  '_route' => 'admin_gedmo_organigram_position_ajax',);
        }

        // admin_gedmo_slider_enabledentity_ajax
        if ($pathinfo === '/admin/gedmo/slider/enabled') {
            return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\SliderController::enabledajaxAction',  '_route' => 'admin_gedmo_slider_enabledentity_ajax',);
        }

        // admin_gedmo_slider_disablentity_ajax
        if ($pathinfo === '/admin/gedmo/slider/disable') {
            return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\SliderController::disableajaxAction',  '_route' => 'admin_gedmo_slider_disablentity_ajax',);
        }

        // admin_gedmo_slider_position_ajax
        if ($pathinfo === '/admin/gedmo/slider/position') {
            return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\SliderController::positionajaxAction',  '_route' => 'admin_gedmo_slider_position_ajax',);
        }

        // admin_page_block_enabledentity_ajax
        if ($pathinfo === '/admin/block/enabled') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\BlockByWidgetController::enabledajaxAction',  '_route' => 'admin_page_block_enabledentity_ajax',);
        }

        // admin_page_block_disablentity_ajax
        if ($pathinfo === '/admin/block/disable') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\BlockByWidgetController::disableajaxAction',  '_route' => 'admin_page_block_disablentity_ajax',);
        }

        // admin_page_block_position_ajax
        if ($pathinfo === '/admin/block/position') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\BlockByWidgetController::positionajaxAction',  '_route' => 'admin_page_block_position_ajax',);
        }

        // admin_page_comment_enabledentity_ajax
        if ($pathinfo === '/admin/pagecomment/enabled') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\CommentController::enabledajaxAction',  '_route' => 'admin_page_comment_enabledentity_ajax',);
        }

        // admin_page_comment_disablentity_ajax
        if ($pathinfo === '/admin/pagecomment/disable') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\CommentController::disableajaxAction',  '_route' => 'admin_page_comment_disablentity_ajax',);
        }

        // admin_page_comment_position_ajax
        if ($pathinfo === '/admin/pagecomment/position') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\CommentController::positionajaxAction',  '_route' => 'admin_page_comment_position_ajax',);
        }

        // admin_keyword_enabledentity_ajax
        if ($pathinfo === '/admin/keyWord/enabled') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\KeyWordController::enabledajaxAction',  '_route' => 'admin_keyword_enabledentity_ajax',);
        }

        // admin_keyword_disablentity_ajax
        if ($pathinfo === '/admin/keyWord/disable') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\KeyWordController::disableajaxAction',  '_route' => 'admin_keyword_disablentity_ajax',);
        }

        // admin_langue_enabledentity_ajax
        if ($pathinfo === '/admin/langue/enabled') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LangueController::enabledajaxAction',  '_route' => 'admin_langue_enabledentity_ajax',);
        }

        // admin_langue_disablentity_ajax
        if ($pathinfo === '/admin/langue/disable') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LangueController::disableajaxAction',  '_route' => 'admin_langue_disablentity_ajax',);
        }

        // admin_layout_enabledentity_ajax
        if ($pathinfo === '/admin/layout/enabled') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LayoutController::enabledajaxAction',  '_route' => 'admin_layout_enabledentity_ajax',);
        }

        // admin_layout_disablentity_ajax
        if ($pathinfo === '/admin/layout/disable') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LayoutController::disableajaxAction',  '_route' => 'admin_layout_disablentity_ajax',);
        }

        // admin_pagebyblock_enabledentity_ajax
        if ($pathinfo === '/admin/pagebyblock/enabled') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByBlockController::enabledajaxAction',  '_route' => 'admin_pagebyblock_enabledentity_ajax',);
        }

        // admin_pagebyblock_disablentity_ajax
        if ($pathinfo === '/admin/pagebyblock/disable') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByBlockController::disableajaxAction',  '_route' => 'admin_pagebyblock_disablentity_ajax',);
        }

        // admin_pagebytrans_enabledentity_ajax
        if ($pathinfo === '/admin/pagebytrans/enabled') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByTransController::enabledajaxAction',  '_route' => 'admin_pagebytrans_enabledentity_ajax',);
        }

        // admin_pagebytrans_disablentity_ajax
        if ($pathinfo === '/admin/pagebytrans/disable') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByTransController::disableajaxAction',  '_route' => 'admin_pagebytrans_disablentity_ajax',);
        }

        // admin_pagecssjs_enabledentity_ajax
        if ($pathinfo === '/admin/pagecssjs/enabled') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageCssJsController::enabledajaxAction',  '_route' => 'admin_pagecssjs_enabledentity_ajax',);
        }

        // admin_pagecssjs_disablentity_ajax
        if ($pathinfo === '/admin/pagecssjs/disable') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageCssJsController::disableajaxAction',  '_route' => 'admin_pagecssjs_disablentity_ajax',);
        }

        // admin_rubrique_enabledentity_ajax
        if ($pathinfo === '/admin/rubrique/enabled') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\RubriqueController::enabledajaxAction',  '_route' => 'admin_rubrique_enabledentity_ajax',);
        }

        // admin_rubrique_disablentity_ajax
        if ($pathinfo === '/admin/rubrique/disable') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\RubriqueController::disableajaxAction',  '_route' => 'admin_rubrique_disablentity_ajax',);
        }

        // admin_snippet_enabledentity_ajax
        if ($pathinfo === '/admin/widget/enabled') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\SnippetController::enabledajaxAction',  '_route' => 'admin_snippet_enabledentity_ajax',);
        }

        // admin_snippet_disablentity_ajax
        if ($pathinfo === '/admin/widget/disable') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\SnippetController::disableajaxAction',  '_route' => 'admin_snippet_disablentity_ajax',);
        }

        // admin_tag_enabledentity_ajax
        if ($pathinfo === '/admin/tag/enabled') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TagController::enabledajaxAction',  '_route' => 'admin_tag_enabledentity_ajax',);
        }

        // admin_tag_disablentity_ajax
        if ($pathinfo === '/admin/tag/disable') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TagController::disableajaxAction',  '_route' => 'admin_tag_disablentity_ajax',);
        }

        // admin_translationpage_enabledentity_ajax
        if ($pathinfo === '/admin/translationpage/enabled') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationPageController::enabledajaxAction',  '_route' => 'admin_translationpage_enabledentity_ajax',);
        }

        // admin_translationpage_disablentity_ajax
        if ($pathinfo === '/admin/translationpage/disable') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationPageController::disableajaxAction',  '_route' => 'admin_translationpage_disablentity_ajax',);
        }

        // admin_translationwidget_enabledentity_ajax
        if ($pathinfo === '/admin/translationwidget/enabled') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationWidgetController::enabledajaxAction',  '_route' => 'admin_translationwidget_enabledentity_ajax',);
        }

        // admin_translationwidget_disablentity_ajax
        if ($pathinfo === '/admin/translationwidget/disable') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationWidgetController::disableajaxAction',  '_route' => 'admin_translationwidget_disablentity_ajax',);
        }

        // admin_widget_enabledentity_ajax
        if ($pathinfo === '/admin/widget/enabled') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\WidgetController::enabledajaxAction',  '_route' => 'admin_widget_enabledentity_ajax',);
        }

        // admin_widget_disablentity_ajax
        if ($pathinfo === '/admin/widget/disable') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\WidgetController::disableajaxAction',  '_route' => 'admin_widget_disablentity_ajax',);
        }

        // admin_widget_position_ajax
        if ($pathinfo === '/admin/widget/position') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\WidgetController::positionajaxAction',  '_route' => 'admin_widget_position_ajax',);
        }

        if (0 === strpos($pathinfo, '/admin/gedmo/category')) {
            // admin_gedmo_category
            if (rtrim($pathinfo, '/') === '/admin/gedmo/category') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_gedmo_category');
                }
                return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\CategoryController::indexAction',  '_route' => 'admin_gedmo_category',);
            }

            // admin_gedmo_category_show
            if (preg_match('#^/admin/gedmo/category/(?P<id>[^/]+?)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\CategoryController::showAction',)), array('_route' => 'admin_gedmo_category_show'));
            }

            // admin_gedmo_category_new
            if ($pathinfo === '/admin/gedmo/category/new') {
                return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\CategoryController::newAction',  '_route' => 'admin_gedmo_category_new',);
            }

            // admin_gedmo_category_create
            if ($pathinfo === '/admin/gedmo/category/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_gedmo_category_create;
                }
                return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\CategoryController::createAction',  '_route' => 'admin_gedmo_category_create',);
            }
            not_admin_gedmo_category_create:

            // admin_gedmo_category_edit
            if (preg_match('#^/admin/gedmo/category/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\CategoryController::editAction',)), array('_route' => 'admin_gedmo_category_edit'));
            }

            // admin_gedmo_category_update
            if (preg_match('#^/admin/gedmo/category/(?P<id>[^/]+?)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_gedmo_category_update;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\CategoryController::updateAction',)), array('_route' => 'admin_gedmo_category_update'));
            }
            not_admin_gedmo_category_update:

            // admin_gedmo_category_delete
            if (preg_match('#^/admin/gedmo/category/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_gedmo_category_delete;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\CategoryController::deleteAction',)), array('_route' => 'admin_gedmo_category_delete'));
            }
            not_admin_gedmo_category_delete:

        }

        if (0 === strpos($pathinfo, '/admin/gedmo/block')) {
            // admin_gedmo_block
            if (rtrim($pathinfo, '/') === '/admin/gedmo/block') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_gedmo_block');
                }
                return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\BlockController::indexAction',  '_route' => 'admin_gedmo_block',);
            }

            // admin_gedmo_block_show
            if (preg_match('#^/admin/gedmo/block/(?P<id>[^/]+?)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\BlockController::showAction',)), array('_route' => 'admin_gedmo_block_show'));
            }

            // admin_gedmo_block_new
            if ($pathinfo === '/admin/gedmo/block/new') {
                return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\BlockController::newAction',  '_route' => 'admin_gedmo_block_new',);
            }

            // admin_gedmo_block_create
            if ($pathinfo === '/admin/gedmo/block/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_gedmo_block_create;
                }
                return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\BlockController::createAction',  '_route' => 'admin_gedmo_block_create',);
            }
            not_admin_gedmo_block_create:

            // admin_gedmo_block_edit
            if (preg_match('#^/admin/gedmo/block/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\BlockController::editAction',)), array('_route' => 'admin_gedmo_block_edit'));
            }

            // admin_gedmo_block_update
            if (preg_match('#^/admin/gedmo/block/(?P<id>[^/]+?)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_gedmo_block_update;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\BlockController::updateAction',)), array('_route' => 'admin_gedmo_block_update'));
            }
            not_admin_gedmo_block_update:

            // admin_gedmo_block_delete
            if (preg_match('#^/admin/gedmo/block/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_gedmo_block_delete;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\BlockController::deleteAction',)), array('_route' => 'admin_gedmo_block_delete'));
            }
            not_admin_gedmo_block_delete:

        }

        if (0 === strpos($pathinfo, '/admin/gedmo/content')) {
            // admin_gedmo_content
            if (rtrim($pathinfo, '/') === '/admin/gedmo/content') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_gedmo_content');
                }
                return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\ContentController::indexAction',  '_route' => 'admin_gedmo_content',);
            }

            // admin_gedmo_content_show
            if (preg_match('#^/admin/gedmo/content/(?P<id>[^/]+?)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\ContentController::showAction',)), array('_route' => 'admin_gedmo_content_show'));
            }

            // admin_gedmo_content_new
            if ($pathinfo === '/admin/gedmo/content/new') {
                return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\ContentController::newAction',  '_route' => 'admin_gedmo_content_new',);
            }

            // admin_gedmo_content_create
            if ($pathinfo === '/admin/gedmo/content/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_gedmo_content_create;
                }
                return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\ContentController::createAction',  '_route' => 'admin_gedmo_content_create',);
            }
            not_admin_gedmo_content_create:

            // admin_gedmo_content_edit
            if (preg_match('#^/admin/gedmo/content/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\ContentController::editAction',)), array('_route' => 'admin_gedmo_content_edit'));
            }

            // admin_gedmo_content_update
            if (preg_match('#^/admin/gedmo/content/(?P<id>[^/]+?)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_gedmo_content_update;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\ContentController::updateAction',)), array('_route' => 'admin_gedmo_content_update'));
            }
            not_admin_gedmo_content_update:

            // admin_gedmo_content_delete
            if (preg_match('#^/admin/gedmo/content/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_gedmo_content_delete;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\ContentController::deleteAction',)), array('_route' => 'admin_gedmo_content_delete'));
            }
            not_admin_gedmo_content_delete:

        }

        if (0 === strpos($pathinfo, '/admin/gedmo/media')) {
            // admin_gedmo_media
            if (rtrim($pathinfo, '/') === '/admin/gedmo/media') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_gedmo_media');
                }
                return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MediaController::indexAction',  '_route' => 'admin_gedmo_media',);
            }

            // admin_gedmo_media_show
            if (preg_match('#^/admin/gedmo/media/(?P<id>[^/]+?)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MediaController::showAction',)), array('_route' => 'admin_gedmo_media_show'));
            }

            // admin_gedmo_media_new
            if ($pathinfo === '/admin/gedmo/media/new') {
                return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MediaController::newAction',  '_route' => 'admin_gedmo_media_new',);
            }

            // admin_gedmo_media_create
            if ($pathinfo === '/admin/gedmo/media/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_gedmo_media_create;
                }
                return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MediaController::createAction',  '_route' => 'admin_gedmo_media_create',);
            }
            not_admin_gedmo_media_create:

            // admin_gedmo_media_edit
            if (preg_match('#^/admin/gedmo/media/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MediaController::editAction',)), array('_route' => 'admin_gedmo_media_edit'));
            }

            // admin_gedmo_media_update
            if (preg_match('#^/admin/gedmo/media/(?P<id>[^/]+?)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_gedmo_media_update;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MediaController::updateAction',)), array('_route' => 'admin_gedmo_media_update'));
            }
            not_admin_gedmo_media_update:

            // admin_gedmo_media_delete
            if (preg_match('#^/admin/gedmo/media/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_gedmo_media_delete;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MediaController::deleteAction',)), array('_route' => 'admin_gedmo_media_delete'));
            }
            not_admin_gedmo_media_delete:

        }

        if (0 === strpos($pathinfo, '/admin/gedmo/menu')) {
            // admin_gedmo_menu
            if (rtrim($pathinfo, '/') === '/admin/gedmo/menu') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_gedmo_menu');
                }
                return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MenuController::indexAction',  '_route' => 'admin_gedmo_menu',);
            }

            // admin_gedmo_menu_show
            if (preg_match('#^/admin/gedmo/menu/(?P<id>[^/]+?)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MenuController::showAction',)), array('_route' => 'admin_gedmo_menu_show'));
            }

            // admin_gedmo_menu_new
            if ($pathinfo === '/admin/gedmo/menu/new') {
                return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MenuController::newAction',  '_route' => 'admin_gedmo_menu_new',);
            }

            // admin_gedmo_menu_create
            if ($pathinfo === '/admin/gedmo/menu/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_gedmo_menu_create;
                }
                return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MenuController::createAction',  '_route' => 'admin_gedmo_menu_create',);
            }
            not_admin_gedmo_menu_create:

            // admin_gedmo_menu_edit
            if (preg_match('#^/admin/gedmo/menu/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MenuController::editAction',)), array('_route' => 'admin_gedmo_menu_edit'));
            }

            // admin_gedmo_menu_update
            if (preg_match('#^/admin/gedmo/menu/(?P<id>[^/]+?)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_gedmo_menu_update;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MenuController::updateAction',)), array('_route' => 'admin_gedmo_menu_update'));
            }
            not_admin_gedmo_menu_update:

            // admin_gedmo_menu_delete
            if (preg_match('#^/admin/gedmo/menu/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_gedmo_menu_delete;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MenuController::deleteAction',)), array('_route' => 'admin_gedmo_menu_delete'));
            }
            not_admin_gedmo_menu_delete:

            // admin_gedmo_menu_knp
            if ($pathinfo === '/admin/gedmo/menu/knp') {
                return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MenuController::knpAction',  '_route' => 'admin_gedmo_menu_knp',);
            }

            // admin_gedmo_menu_tree
            if (preg_match('#^/admin/gedmo/menu/(?P<category>.*)/tree$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MenuController::treeAction',)), array('_route' => 'admin_gedmo_menu_tree'));
            }

            // admin_gedmo_menu_move_up
            if (preg_match('#^/admin/gedmo/menu/(?P<id>[^/]+?)/node/(?P<category>.*)/move\\-up$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MenuController::moveUpAction',)), array('_route' => 'admin_gedmo_menu_move_up'));
            }

            // admin_gedmo_menu_move_down
            if (preg_match('#^/admin/gedmo/menu/(?P<id>[^/]+?)/(?P<category>.*)/node/move\\-down$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MenuController::moveDownAction',)), array('_route' => 'admin_gedmo_menu_move_down'));
            }

            // admin_gedmo_menu_node_remove
            if (preg_match('#^/admin/gedmo/menu/(?P<id>[^/]+?)/(?P<category>.*)/node/remove$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\MenuController::removeAction',)), array('_route' => 'admin_gedmo_menu_node_remove'));
            }

        }

        if (0 === strpos($pathinfo, '/admin/gedmo/slider')) {
            // admin_gedmo_slider
            if (rtrim($pathinfo, '/') === '/admin/gedmo/slider') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_gedmo_slider');
                }
                return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\SliderController::indexAction',  '_route' => 'admin_gedmo_slider',);
            }

            // admin_gedmo_slider_show
            if (preg_match('#^/admin/gedmo/slider/(?P<id>[^/]+?)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\SliderController::showAction',)), array('_route' => 'admin_gedmo_slider_show'));
            }

            // admin_gedmo_slider_new
            if ($pathinfo === '/admin/gedmo/slider/new') {
                return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\SliderController::newAction',  '_route' => 'admin_gedmo_slider_new',);
            }

            // admin_gedmo_slider_create
            if ($pathinfo === '/admin/gedmo/slider/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_gedmo_slider_create;
                }
                return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\SliderController::createAction',  '_route' => 'admin_gedmo_slider_create',);
            }
            not_admin_gedmo_slider_create:

            // admin_gedmo_slider_edit
            if (preg_match('#^/admin/gedmo/slider/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\SliderController::editAction',)), array('_route' => 'admin_gedmo_slider_edit'));
            }

            // admin_gedmo_slider_update
            if (preg_match('#^/admin/gedmo/slider/(?P<id>[^/]+?)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_gedmo_slider_update;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\SliderController::updateAction',)), array('_route' => 'admin_gedmo_slider_update'));
            }
            not_admin_gedmo_slider_update:

            // admin_gedmo_slider_delete
            if (preg_match('#^/admin/gedmo/slider/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_gedmo_slider_delete;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\SliderController::deleteAction',)), array('_route' => 'admin_gedmo_slider_delete'));
            }
            not_admin_gedmo_slider_delete:

        }

        if (0 === strpos($pathinfo, '/admin/gedmo/organigram')) {
            // admin_gedmo_organigram
            if (rtrim($pathinfo, '/') === '/admin/gedmo/organigram') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_gedmo_organigram');
                }
                return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\OrganigramController::indexAction',  '_route' => 'admin_gedmo_organigram',);
            }

            // admin_gedmo_organigram_show
            if (preg_match('#^/admin/gedmo/organigram/(?P<id>[^/]+?)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\OrganigramController::showAction',)), array('_route' => 'admin_gedmo_organigram_show'));
            }

            // admin_gedmo_organigram_new
            if ($pathinfo === '/admin/gedmo/organigram/new') {
                return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\OrganigramController::newAction',  '_route' => 'admin_gedmo_organigram_new',);
            }

            // admin_gedmo_organigram_create
            if ($pathinfo === '/admin/gedmo/organigram/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_gedmo_organigram_create;
                }
                return array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\OrganigramController::createAction',  '_route' => 'admin_gedmo_organigram_create',);
            }
            not_admin_gedmo_organigram_create:

            // admin_gedmo_organigram_edit
            if (preg_match('#^/admin/gedmo/organigram/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\OrganigramController::editAction',)), array('_route' => 'admin_gedmo_organigram_edit'));
            }

            // admin_gedmo_organigram_update
            if (preg_match('#^/admin/gedmo/organigram/(?P<id>[^/]+?)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_gedmo_organigram_update;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\OrganigramController::updateAction',)), array('_route' => 'admin_gedmo_organigram_update'));
            }
            not_admin_gedmo_organigram_update:

            // admin_gedmo_organigram_delete
            if (preg_match('#^/admin/gedmo/organigram/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_gedmo_organigram_delete;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\OrganigramController::deleteAction',)), array('_route' => 'admin_gedmo_organigram_delete'));
            }
            not_admin_gedmo_organigram_delete:

            // admin_gedmo_organigram_tree
            if (preg_match('#^/admin/gedmo/organigram/(?P<category>.*)/tree$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\OrganigramController::treeAction',)), array('_route' => 'admin_gedmo_organigram_tree'));
            }

            // admin_gedmo_organigram_move_up
            if (preg_match('#^/admin/gedmo/organigram/(?P<id>[^/]+?)/(?P<category>.*)/node/move\\-up$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\OrganigramController::moveUpAction',)), array('_route' => 'admin_gedmo_organigram_move_up'));
            }

            // admin_gedmo_organigram_move_down
            if (preg_match('#^/admin/gedmo/organigram/(?P<id>[^/]+?)/(?P<category>.*)/node/move\\-down$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\OrganigramController::moveDownAction',)), array('_route' => 'admin_gedmo_organigram_move_down'));
            }

            // admin_gedmo_organigram_node_remove
            if (preg_match('#^/admin/gedmo/organigram/(?P<id>[^/]+?)/(?P<category>.*)/node/remove$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\GedmoBundle\\Controller\\OrganigramController::removeAction',)), array('_route' => 'admin_gedmo_organigram_node_remove'));
            }

        }

        if (0 === strpos($pathinfo, '/admin/layout')) {
            // admin_layout
            if (rtrim($pathinfo, '/') === '/admin/layout') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_layout');
                }
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LayoutController::indexAction',  '_route' => 'admin_layout',);
            }

            // admin_layout_show
            if (preg_match('#^/admin/layout/(?P<id>[^/]+?)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LayoutController::showAction',)), array('_route' => 'admin_layout_show'));
            }

            // admin_layout_new
            if ($pathinfo === '/admin/layout/new') {
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LayoutController::newAction',  '_route' => 'admin_layout_new',);
            }

            // admin_layout_create
            if ($pathinfo === '/admin/layout/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_layout_create;
                }
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LayoutController::createAction',  '_route' => 'admin_layout_create',);
            }
            not_admin_layout_create:

            // admin_layout_edit
            if (preg_match('#^/admin/layout/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LayoutController::editAction',)), array('_route' => 'admin_layout_edit'));
            }

            // admin_layout_update
            if (preg_match('#^/admin/layout/(?P<id>[^/]+?)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_layout_update;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LayoutController::updateAction',)), array('_route' => 'admin_layout_update'));
            }
            not_admin_layout_update:

            // admin_layout_delete
            if (preg_match('#^/admin/layout/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_layout_delete;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LayoutController::deleteAction',)), array('_route' => 'admin_layout_delete'));
            }
            not_admin_layout_delete:

        }

        if (0 === strpos($pathinfo, '/admin/rubrique')) {
            // admin_rubrique
            if (rtrim($pathinfo, '/') === '/admin/rubrique') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_rubrique');
                }
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\RubriqueController::indexAction',  '_route' => 'admin_rubrique',);
            }

            // admin_rubrique_show
            if (preg_match('#^/admin/rubrique/(?P<id>[^/]+?)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\RubriqueController::showAction',)), array('_route' => 'admin_rubrique_show'));
            }

            // admin_rubrique_new
            if ($pathinfo === '/admin/rubrique/new') {
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\RubriqueController::newAction',  '_route' => 'admin_rubrique_new',);
            }

            // admin_rubrique_create
            if ($pathinfo === '/admin/rubrique/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_rubrique_create;
                }
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\RubriqueController::createAction',  '_route' => 'admin_rubrique_create',);
            }
            not_admin_rubrique_create:

            // admin_rubrique_edit
            if (preg_match('#^/admin/rubrique/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\RubriqueController::editAction',)), array('_route' => 'admin_rubrique_edit'));
            }

            // admin_rubrique_update
            if (preg_match('#^/admin/rubrique/(?P<id>[^/]+?)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_rubrique_update;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\RubriqueController::updateAction',)), array('_route' => 'admin_rubrique_update'));
            }
            not_admin_rubrique_update:

            // admin_rubrique_delete
            if (preg_match('#^/admin/rubrique/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_rubrique_delete;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\RubriqueController::deleteAction',)), array('_route' => 'admin_rubrique_delete'));
            }
            not_admin_rubrique_delete:

            // admin_rubrique_tree
            if ($pathinfo === '/admin/rubrique/tree') {
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\RubriqueController::treeAction',  '_route' => 'admin_rubrique_tree',);
            }

            // admin_rubrique_move_up
            if (preg_match('#^/admin/rubrique/(?P<id>[^/]+?)/node/move\\-up$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\RubriqueController::moveUpAction',)), array('_route' => 'admin_rubrique_move_up'));
            }

            // admin_rubrique_move_down
            if (preg_match('#^/admin/rubrique/(?P<id>[^/]+?)/node/move\\-down$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\RubriqueController::moveDownAction',)), array('_route' => 'admin_rubrique_move_down'));
            }

            // admin_rubrique_node_remove
            if (preg_match('#^/admin/rubrique/(?P<id>[^/]+?)/node/remove$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\RubriqueController::removeAction',)), array('_route' => 'admin_rubrique_node_remove'));
            }

        }

        if (0 === strpos($pathinfo, '/admin/pagebytrans')) {
            // admin_pagebytrans
            if (rtrim($pathinfo, '/') === '/admin/pagebytrans') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_pagebytrans');
                }
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByTransController::indexAction',  '_route' => 'admin_pagebytrans',);
            }

            // admin_pagebytrans_wizard
            if (preg_match('#^/admin/pagebytrans/(?P<status>all|draft|reviewed|published|hidden|trash|refused)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByTransController::wizardAction',)), array('_route' => 'admin_pagebytrans_wizard'));
            }

            // admin_pagebytrans_show
            if (preg_match('#^/admin/pagebytrans/(?P<id>[^/]+?)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByTransController::showAction',)), array('_route' => 'admin_pagebytrans_show'));
            }

            // admin_pagebytrans_new
            if ($pathinfo === '/admin/pagebytrans/new') {
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByTransController::newAction',  '_route' => 'admin_pagebytrans_new',);
            }

            // admin_pagebytrans_create
            if ($pathinfo === '/admin/pagebytrans/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_pagebytrans_create;
                }
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByTransController::createAction',  '_route' => 'admin_pagebytrans_create',);
            }
            not_admin_pagebytrans_create:

            // admin_pagebytrans_edit
            if (preg_match('#^/admin/pagebytrans/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByTransController::editAction',)), array('_route' => 'admin_pagebytrans_edit'));
            }

            // admin_pagebytrans_update
            if (preg_match('#^/admin/pagebytrans/(?P<id>[^/]+?)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_pagebytrans_update;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByTransController::updateAction',)), array('_route' => 'admin_pagebytrans_update'));
            }
            not_admin_pagebytrans_update:

            // admin_pagebytrans_delete
            if (preg_match('#^/admin/pagebytrans/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_pagebytrans_delete;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByTransController::deleteAction',)), array('_route' => 'admin_pagebytrans_delete'));
            }
            not_admin_pagebytrans_delete:

        }

        if (0 === strpos($pathinfo, '/admin/pagebyblock')) {
            // admin_pagebyblock
            if (rtrim($pathinfo, '/') === '/admin/pagebyblock') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_pagebyblock');
                }
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByBlockController::indexAction',  '_route' => 'admin_pagebyblock',);
            }

            // admin_pagebyblock_show
            if (preg_match('#^/admin/pagebyblock/(?P<id>[^/]+?)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByBlockController::showAction',)), array('_route' => 'admin_pagebyblock_show'));
            }

            // admin_pagebyblock_new
            if ($pathinfo === '/admin/pagebyblock/new') {
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByBlockController::newAction',  '_route' => 'admin_pagebyblock_new',);
            }

            // admin_pagebyblock_create
            if ($pathinfo === '/admin/pagebyblock/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_pagebyblock_create;
                }
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByBlockController::createAction',  '_route' => 'admin_pagebyblock_create',);
            }
            not_admin_pagebyblock_create:

            // admin_pagebyblock_edit
            if (preg_match('#^/admin/pagebyblock/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByBlockController::editAction',)), array('_route' => 'admin_pagebyblock_edit'));
            }

            // admin_pagebyblock_update
            if (preg_match('#^/admin/pagebyblock/(?P<id>[^/]+?)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_pagebyblock_update;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByBlockController::updateAction',)), array('_route' => 'admin_pagebyblock_update'));
            }
            not_admin_pagebyblock_update:

            // admin_pagebyblock_delete
            if (preg_match('#^/admin/pagebyblock/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_pagebyblock_delete;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageByBlockController::deleteAction',)), array('_route' => 'admin_pagebyblock_delete'));
            }
            not_admin_pagebyblock_delete:

        }

        if (0 === strpos($pathinfo, '/admin/pagecssjs')) {
            // admin_pagecssjs
            if (rtrim($pathinfo, '/') === '/admin/pagecssjs') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_pagecssjs');
                }
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageCssJsController::indexAction',  '_route' => 'admin_pagecssjs',);
            }

            // admin_pagecssjs_show
            if (preg_match('#^/admin/pagecssjs/(?P<id>[^/]+?)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageCssJsController::showAction',)), array('_route' => 'admin_pagecssjs_show'));
            }

            // admin_pagecssjs_new
            if ($pathinfo === '/admin/pagecssjs/new') {
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageCssJsController::newAction',  '_route' => 'admin_pagecssjs_new',);
            }

            // admin_pagecssjs_create
            if ($pathinfo === '/admin/pagecssjs/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_pagecssjs_create;
                }
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageCssJsController::createAction',  '_route' => 'admin_pagecssjs_create',);
            }
            not_admin_pagecssjs_create:

            // admin_pagecssjs_edit
            if (preg_match('#^/admin/pagecssjs/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageCssJsController::editAction',)), array('_route' => 'admin_pagecssjs_edit'));
            }

            // admin_pagecssjs_update
            if (preg_match('#^/admin/pagecssjs/(?P<id>[^/]+?)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_pagecssjs_update;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageCssJsController::updateAction',)), array('_route' => 'admin_pagecssjs_update'));
            }
            not_admin_pagecssjs_update:

            // admin_pagecssjs_delete
            if (preg_match('#^/admin/pagecssjs/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_pagecssjs_delete;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\PageCssJsController::deleteAction',)), array('_route' => 'admin_pagecssjs_delete'));
            }
            not_admin_pagecssjs_delete:

        }

        if (0 === strpos($pathinfo, '/admin/transpage')) {
            // admin_transpage
            if (rtrim($pathinfo, '/') === '/admin/transpage') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_transpage');
                }
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationPageController::indexAction',  '_route' => 'admin_transpage',);
            }

            // admin_transpage_show
            if (preg_match('#^/admin/transpage/(?P<id>[^/]+?)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationPageController::showAction',)), array('_route' => 'admin_transpage_show'));
            }

            // admin_transpage_new
            if ($pathinfo === '/admin/transpage/new') {
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationPageController::newAction',  '_route' => 'admin_transpage_new',);
            }

            // admin_transpage_create
            if ($pathinfo === '/admin/transpage/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_transpage_create;
                }
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationPageController::createAction',  '_route' => 'admin_transpage_create',);
            }
            not_admin_transpage_create:

            // admin_transpage_edit
            if (preg_match('#^/admin/transpage/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationPageController::editAction',)), array('_route' => 'admin_transpage_edit'));
            }

            // admin_transpage_update
            if (preg_match('#^/admin/transpage/(?P<id>[^/]+?)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_transpage_update;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationPageController::updateAction',)), array('_route' => 'admin_transpage_update'));
            }
            not_admin_transpage_update:

            // admin_transpage_delete
            if (preg_match('#^/admin/transpage/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_transpage_delete;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationPageController::deleteAction',)), array('_route' => 'admin_transpage_delete'));
            }
            not_admin_transpage_delete:

        }

        if (0 === strpos($pathinfo, '/admin/blockbywidget')) {
            // admin_blockbywidget
            if (rtrim($pathinfo, '/') === '/admin/blockbywidget') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_blockbywidget');
                }
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\BlockByWidgetController::indexAction',  '_route' => 'admin_blockbywidget',);
            }

            // admin_blockbywidget_show
            if (preg_match('#^/admin/blockbywidget/(?P<id>[^/]+?)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\BlockByWidgetController::showAction',)), array('_route' => 'admin_blockbywidget_show'));
            }

            // admin_blockbywidget_new
            if ($pathinfo === '/admin/blockbywidget/new') {
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\BlockByWidgetController::newAction',  '_route' => 'admin_blockbywidget_new',);
            }

            // admin_blockbywidget_create
            if ($pathinfo === '/admin/blockbywidget/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_blockbywidget_create;
                }
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\BlockByWidgetController::createAction',  '_route' => 'admin_blockbywidget_create',);
            }
            not_admin_blockbywidget_create:

            // admin_blockbywidget_edit
            if (preg_match('#^/admin/blockbywidget/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\BlockByWidgetController::editAction',)), array('_route' => 'admin_blockbywidget_edit'));
            }

            // admin_blockbywidget_update
            if (preg_match('#^/admin/blockbywidget/(?P<id>[^/]+?)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_blockbywidget_update;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\BlockByWidgetController::updateAction',)), array('_route' => 'admin_blockbywidget_update'));
            }
            not_admin_blockbywidget_update:

            // admin_blockbywidget_delete
            if (preg_match('#^/admin/blockbywidget/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_blockbywidget_delete;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\BlockByWidgetController::deleteAction',)), array('_route' => 'admin_blockbywidget_delete'));
            }
            not_admin_blockbywidget_delete:

        }

        if (0 === strpos($pathinfo, '/admin/widget')) {
            // admin_widget
            if (rtrim($pathinfo, '/') === '/admin/widget') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_widget');
                }
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\WidgetController::indexAction',  '_route' => 'admin_widget',);
            }

            // admin_widget_show
            if (preg_match('#^/admin/widget/(?P<id>[^/]+?)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\WidgetController::showAction',)), array('_route' => 'admin_widget_show'));
            }

            // admin_widget_new
            if ($pathinfo === '/admin/widget/new') {
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\WidgetController::newAction',  '_route' => 'admin_widget_new',);
            }

            // admin_widget_create
            if ($pathinfo === '/admin/widget/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_widget_create;
                }
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\WidgetController::createAction',  '_route' => 'admin_widget_create',);
            }
            not_admin_widget_create:

            // admin_widget_edit
            if (preg_match('#^/admin/widget/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\WidgetController::editAction',)), array('_route' => 'admin_widget_edit'));
            }

            // admin_widget_update
            if (preg_match('#^/admin/widget/(?P<id>[^/]+?)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_widget_update;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\WidgetController::updateAction',)), array('_route' => 'admin_widget_update'));
            }
            not_admin_widget_update:

            // admin_widget_delete
            if (preg_match('#^/admin/widget/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_widget_delete;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\WidgetController::deleteAction',)), array('_route' => 'admin_widget_delete'));
            }
            not_admin_widget_delete:

            // admin_widget_delete_ajax
            if ($pathinfo === '/admin/widget/ajax-delete') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_admin_widget_delete_ajax;
                }
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\WidgetController::deleteajaxAction',  '_route' => 'admin_widget_delete_ajax',);
            }
            not_admin_widget_delete_ajax:

            // admin_widget_movewidget_page
            if ($pathinfo === '/admin/widget/movewidget-page') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_admin_widget_movewidget_page;
                }
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\WidgetController::movewidgetajaxAction',  '_route' => 'admin_widget_movewidget_page',);
            }
            not_admin_widget_movewidget_page:

            // admin_widget_move_ajax
            if ($pathinfo === '/admin/widget/move-page') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_admin_widget_move_ajax;
                }
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\WidgetController::moveajaxAction',  '_route' => 'admin_widget_move_ajax',);
            }
            not_admin_widget_move_ajax:

        }

        if (0 === strpos($pathinfo, '/admin/snippet')) {
            // admin_snippet
            if (rtrim($pathinfo, '/') === '/admin/snippet') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_snippet');
                }
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\SnippetController::indexAction',  '_route' => 'admin_snippet',);
            }

            // admin_snippet_show
            if (preg_match('#^/admin/snippet/(?P<id>[^/]+?)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\SnippetController::showAction',)), array('_route' => 'admin_snippet_show'));
            }

            // admin_snippet_new
            if ($pathinfo === '/admin/snippet/new') {
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\SnippetController::newAction',  '_route' => 'admin_snippet_new',);
            }

            // admin_snippet_create
            if ($pathinfo === '/admin/snippet/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_snippet_create;
                }
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\SnippetController::createAction',  '_route' => 'admin_snippet_create',);
            }
            not_admin_snippet_create:

            // admin_snippet_edit
            if (preg_match('#^/admin/snippet/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\SnippetController::editAction',)), array('_route' => 'admin_snippet_edit'));
            }

            // admin_snippet_update
            if (preg_match('#^/admin/snippet/(?P<id>[^/]+?)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_snippet_update;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\SnippetController::updateAction',)), array('_route' => 'admin_snippet_update'));
            }
            not_admin_snippet_update:

            // admin_snippet_delete
            if (preg_match('#^/admin/snippet/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_snippet_delete;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\SnippetController::deleteAction',)), array('_route' => 'admin_snippet_delete'));
            }
            not_admin_snippet_delete:

        }

        if (0 === strpos($pathinfo, '/admin/transwidget')) {
            // admin_transwidget
            if (rtrim($pathinfo, '/') === '/admin/transwidget') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_transwidget');
                }
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationWidgetController::indexAction',  '_route' => 'admin_transwidget',);
            }

            // admin_transwidget_show
            if (preg_match('#^/admin/transwidget/(?P<id>[^/]+?)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationWidgetController::showAction',)), array('_route' => 'admin_transwidget_show'));
            }

            // admin_transwidget_new
            if ($pathinfo === '/admin/transwidget/new') {
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationWidgetController::newAction',  '_route' => 'admin_transwidget_new',);
            }

            // admin_transwidget_create
            if ($pathinfo === '/admin/transwidget/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_transwidget_create;
                }
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationWidgetController::createAction',  '_route' => 'admin_transwidget_create',);
            }
            not_admin_transwidget_create:

            // admin_transwidget_edit
            if (preg_match('#^/admin/transwidget/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationWidgetController::editAction',)), array('_route' => 'admin_transwidget_edit'));
            }

            // admin_transwidget_update
            if (preg_match('#^/admin/transwidget/(?P<id>[^/]+?)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_transwidget_update;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationWidgetController::updateAction',)), array('_route' => 'admin_transwidget_update'));
            }
            not_admin_transwidget_update:

            // admin_transwidget_delete
            if (preg_match('#^/admin/transwidget/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_transwidget_delete;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TranslationWidgetController::deleteAction',)), array('_route' => 'admin_transwidget_delete'));
            }
            not_admin_transwidget_delete:

        }

        if (0 === strpos($pathinfo, '/admin/tag')) {
            // admin_tag
            if (rtrim($pathinfo, '/') === '/admin/tag') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_tag');
                }
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TagController::indexAction',  '_route' => 'admin_tag',);
            }

            // admin_tag_show
            if (preg_match('#^/admin/tag/(?P<id>[^/]+?)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TagController::showAction',)), array('_route' => 'admin_tag_show'));
            }

            // admin_tag_new
            if ($pathinfo === '/admin/tag/new') {
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TagController::newAction',  '_route' => 'admin_tag_new',);
            }

            // admin_tag_create
            if ($pathinfo === '/admin/tag/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_tag_create;
                }
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TagController::createAction',  '_route' => 'admin_tag_create',);
            }
            not_admin_tag_create:

            // admin_tag_edit
            if (preg_match('#^/admin/tag/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TagController::editAction',)), array('_route' => 'admin_tag_edit'));
            }

            // admin_tag_update
            if (preg_match('#^/admin/tag/(?P<id>[^/]+?)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_tag_update;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TagController::updateAction',)), array('_route' => 'admin_tag_update'));
            }
            not_admin_tag_update:

            // admin_tag_delete
            if (preg_match('#^/admin/tag/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_tag_delete;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\TagController::deleteAction',)), array('_route' => 'admin_tag_delete'));
            }
            not_admin_tag_delete:

        }

        if (0 === strpos($pathinfo, '/admin/keyword')) {
            // admin_keyword
            if (rtrim($pathinfo, '/') === '/admin/keyword') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_keyword');
                }
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\KeyWordController::indexAction',  '_route' => 'admin_keyword',);
            }

            // admin_keyword_show
            if (preg_match('#^/admin/keyword/(?P<id>[^/]+?)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\KeyWordController::showAction',)), array('_route' => 'admin_keyword_show'));
            }

            // admin_keyword_new
            if ($pathinfo === '/admin/keyword/new') {
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\KeyWordController::newAction',  '_route' => 'admin_keyword_new',);
            }

            // admin_keyword_create
            if ($pathinfo === '/admin/keyword/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_keyword_create;
                }
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\KeyWordController::createAction',  '_route' => 'admin_keyword_create',);
            }
            not_admin_keyword_create:

            // admin_keyword_edit
            if (preg_match('#^/admin/keyword/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\KeyWordController::editAction',)), array('_route' => 'admin_keyword_edit'));
            }

            // admin_keyword_update
            if (preg_match('#^/admin/keyword/(?P<id>[^/]+?)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_keyword_update;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\KeyWordController::updateAction',)), array('_route' => 'admin_keyword_update'));
            }
            not_admin_keyword_update:

            // admin_keyword_delete
            if (preg_match('#^/admin/keyword/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_keyword_delete;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\KeyWordController::deleteAction',)), array('_route' => 'admin_keyword_delete'));
            }
            not_admin_keyword_delete:

        }

        if (0 === strpos($pathinfo, '/admin/langue')) {
            // admin_langue
            if (rtrim($pathinfo, '/') === '/admin/langue') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_langue');
                }
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LangueController::indexAction',  '_route' => 'admin_langue',);
            }

            // admin_langue_show
            if (preg_match('#^/admin/langue/(?P<id>[^/]+?)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LangueController::showAction',)), array('_route' => 'admin_langue_show'));
            }

            // admin_langue_new
            if ($pathinfo === '/admin/langue/new') {
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LangueController::newAction',  '_route' => 'admin_langue_new',);
            }

            // admin_langue_create
            if ($pathinfo === '/admin/langue/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_langue_create;
                }
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LangueController::createAction',  '_route' => 'admin_langue_create',);
            }
            not_admin_langue_create:

            // admin_langue_edit
            if (preg_match('#^/admin/langue/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LangueController::editAction',)), array('_route' => 'admin_langue_edit'));
            }

            // admin_langue_update
            if (preg_match('#^/admin/langue/(?P<id>[^/]+?)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_langue_update;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LangueController::updateAction',)), array('_route' => 'admin_langue_update'));
            }
            not_admin_langue_update:

            // admin_langue_delete
            if (preg_match('#^/admin/langue/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_langue_delete;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\LangueController::deleteAction',)), array('_route' => 'admin_langue_delete'));
            }
            not_admin_langue_delete:

        }

        if (0 === strpos($pathinfo, '/admin/comment')) {
            // admin_comment
            if (rtrim($pathinfo, '/') === '/admin/comment') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_comment');
                }
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\CommentController::indexAction',  '_route' => 'admin_comment',);
            }

            // admin_comment_show
            if (preg_match('#^/admin/comment/(?P<id>[^/]+?)/show$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\CommentController::showAction',)), array('_route' => 'admin_comment_show'));
            }

            // admin_comment_new
            if ($pathinfo === '/admin/comment/new') {
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\CommentController::newAction',  '_route' => 'admin_comment_new',);
            }

            // admin_comment_create
            if ($pathinfo === '/admin/comment/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_comment_create;
                }
                return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\CommentController::createAction',  '_route' => 'admin_comment_create',);
            }
            not_admin_comment_create:

            // admin_comment_edit
            if (preg_match('#^/admin/comment/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\CommentController::editAction',)), array('_route' => 'admin_comment_edit'));
            }

            // admin_comment_update
            if (preg_match('#^/admin/comment/(?P<id>[^/]+?)/update$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_comment_update;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\CommentController::updateAction',)), array('_route' => 'admin_comment_update'));
            }
            not_admin_comment_update:

            // admin_comment_delete
            if (preg_match('#^/admin/comment/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_admin_comment_delete;
                }
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\CommentController::deleteAction',)), array('_route' => 'admin_comment_delete'));
            }
            not_admin_comment_delete:

        }

        // pi_layout_choisir_langue
        if (0 === strpos($pathinfo, '/local') && preg_match('#^/local/(?P<langue>[^/]+?)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\FrontendController::setLocalAction',)), array('_route' => 'pi_layout_choisir_langue'));
        }

        // admin_homepage
        if ($pathinfo === '/home') {
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\FrontendController::indexAction',  '_route' => 'admin_homepage',);
        }

        // public_refresh_page
        if ($pathinfo === '/refresh-page') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_public_refresh_page;
            }
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\FrontendController::refreshpageAction',  '_route' => 'public_refresh_page',);
        }
        not_public_refresh_page:

        // public_indexation_page
        if (0 === strpos($pathinfo, '/indexation-page') && preg_match('#^/indexation\\-page/(?P<action>archiving||delete)$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_public_indexation_page;
            }
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\FrontendController::indexationAction',)), array('_route' => 'public_indexation_page'));
        }
        not_public_indexation_page:

        // public_urlmanagement_page
        if ($pathinfo === '/urlmanagement-page') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_public_urlmanagement_page;
            }
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\FrontendController::urlmanagementAction',  '_route' => 'public_urlmanagement_page',);
        }
        not_public_urlmanagement_page:

        // public_importmanagement_widget
        if ($pathinfo === '/importmanagement-page') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_public_importmanagement_widget;
            }
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\FrontendController::importmanagementAction',  '_route' => 'public_importmanagement_widget',);
        }
        not_public_importmanagement_widget:

        // public_head_file
        if (preg_match('#^/(?P<filetype>css|js)/(?P<file>[^/]+?)$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_public_head_file;
            }
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\FrontendController::contentfileAction',)), array('_route' => 'public_head_file'));
        }
        not_public_head_file:

        // public_chained
        if ($pathinfo === '/chained') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_public_chained;
            }
            return array (  '_controller' => 'PiApp\\AdminBundle\\Controller\\FrontendController::chainedAction',  '_route' => 'public_chained',);
        }
        not_public_chained:

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
