<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Bundle
 * @package    DependencyInjection
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-11
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension,
    Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\DependencyInjection\Loader,
    Symfony\Component\Config\FileLocator;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * @category   Bundle
 * @package    DependencyInjection
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiAppAdminExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config  = $this->processConfiguration($configuration, $configs);
        
        $loaderYaml  = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config/service'));
        $loaderYaml->load('services_twig_extension.yml');
        $loaderYaml->load('services_util.yml');
        $loaderYaml->load('services.yml');
        $loaderYaml->load("services_form_validator.yml");
        $loaderYaml->load('services_listener.yml');
        

//         $PROXY_HOST = "proxy.example.com"; // Proxy server address
//         $PROXY_PORT = "1234";    // Proxy server port
//         $PROXY_USER = "LOGIN";    // Username
//         $PROXY_PASS = "PASSWORD";   // Password
//         // Username and Password are required only if your proxy server needs basic authentication
//         $auth = base64_encode("$PROXY_USER:$PROXY_PASS");
//         stream_context_set_default(
//          array(
//           'http' => array(
//            'proxy' => "tcp://$PROXY_HOST:$PROXY_PORT",
//            'request_fulluri' => true,
//            'header' => "Proxy-Authorization: Basic $auth"
//            // Remove the 'header' option if proxy authentication is not required
//           )
//          )
//         );
        
        /**
         * Admin config parameter
         */
        if (isset($config['admin'])){
            if (isset($config['admin']['context_menu_theme']))
                $container->setParameter('pi_app_admin.admin.context_menu_theme', $config['admin']['context_menu_theme']);
            if (isset($config['admin']['grid_index_css']))
                $container->setParameter('pi_app_admin.admin.grid_index_css', 'bundles/piappadmin/css/grid/' . $config['admin']['grid_index_css']);
            if (isset($config['admin']['grid_show_css']))
                $container->setParameter('pi_app_admin.admin.grid_show_css', 'bundles/piappadmin/css/grid/' . $config['admin']['grid_show_css']);
            if (isset($config['admin']['theme_css']))
                $container->setParameter('pi_app_admin.admin.theme_css', 'bundles/piappadmin/css/themes/'.$config['admin']['theme_css'].'/jquery-ui.css');
        }        
        
        /**
         * Page config parameter
         */
        if (isset($config['page'])){
            if (isset($config['page']['homepage_deletewidget']))
                $container->setParameter('pi_app_admin.page.homepage_deletewidget', $config['page']['homepage_deletewidget']);
            if (isset($config['page']['page_management_by_user_only']))
                $container->setParameter('pi_app_admin.page.management_by_user_only', $config['page']['page_management_by_user_only']);
            if (isset($config['page']['single_slug']))
                $container->setParameter('pi_app_admin.page.single_slug', $config['page']['single_slug']);
            if (isset($config['page']['refresh_allpage_containing_snippet']))
                $container->setParameter('pi_app_admin.page.refresh_allpage_containing_snippet', $config['page']['refresh_allpage_containing_snippet']);
            if (isset($config['page']['refresh_css_js_cache_file']))
                $container->setParameter('pi_app_admin.page.refresh_css_js_cache_file', $config['page']['refresh_css_js_cache_file']);
            if (isset($config['page']['indexation_authorized_automatically']))
                $container->setParameter('pi_app_admin.page.indexation_authorized_automatically', $config['page']['indexation_authorized_automatically']);
            if (isset($config['page']['switch_layout_mobile_authorized']))
                $container->setParameter('pi_app_admin.page.switch_layout_mobile_authorized', $config['page']['switch_layout_mobile_authorized']);
            if (isset($config['page']['switch_layout_init_redirection_authorized']))
                $container->setParameter('pi_app_admin.page.switch_layout_init_redirection_authorized', $config['page']['switch_layout_init_redirection_authorized']);
            if (isset($config['page']['switch_language_browser_authorized']))
                $container->setParameter('pi_app_admin.page.switch_language_browser_authorized', $config['page']['switch_language_browser_authorized']);
            if (isset($config['page']['memcache_enable']))
                $container->setParameter('pi_app_admin.page.memcache_enable', $config['page']['memcache_enable']);
        }    

        /**
         * Cookies config parameter
         */
        if (isset($config['cookies'])){
            if (isset($config['cookies']['date_expire']))
                $container->setParameter('pi_app_admin.cookies.date_expire', $config['cookies']['date_expire']);
            if (isset($config['cookies']['date_interval']))
                $container->setParameter('pi_app_admin.cookies.date_interval',$config['cookies']['date_interval']);
        }        
        
        /**
         * Form config parameter
         */
        if (isset($config['form'])){
            if (isset($config['form']['show_legend']))
                $container->setParameter('pi_app_admin.form.show_legend', $config['form']['show_legend']);
            if (isset($config['form']['show_child_legend']))
                $container->setParameter('pi_app_admin.form.show_child_legend',$config['form']['show_child_legend']);
            if (isset($config['form']['error_type']))
                $container->setParameter('pi_app_admin.form.error_type',$config['form']['error_type']);
        }
        
        /**
         * Layout config parameter
         */
        if (isset($config['layout'])){
            // PC init config
            if (isset($config['layout']['init_pc'])){
                if (isset($config['layout']['init_pc']['template_name']))
                    $container->setParameter('pi_app_admin.layout.init.pc.template', $config['layout']['init_pc']['template_name']);
                if (isset($config['layout']['init_pc']['route_redirection_name']))
                    $container->setParameter('pi_app_admin.layout.init.pc.redirection', $config['layout']['init_pc']['route_redirection_name']);
            }
            
            // Mobile init config
            if (isset($config['layout']['init_mobile'])){
                if (isset($config['layout']['init_mobile']['template_name']))
                    $container->setParameter('pi_app_admin.layout.init.mobile.template', $config['layout']['init_mobile']['template_name']);
                if (isset($config['layout']['init_mobile']['route_redirection_name']))
                    $container->setParameter('pi_app_admin.layout.init.mobile.redirection', $config['layout']['init_mobile']['route_redirection_name']);
            }

            // Redirection login config
            if (isset($config['layout']['login_role'])){
                if (isset($config['layout']['login_role']['redirection_admin']))
                    $container->setParameter('pi_app_admin.layout.login.admin_redirect', $config['layout']['login_role']['redirection_admin']);
                if (isset($config['layout']['login_role']['redirection_user']))
                    $container->setParameter('pi_app_admin.layout.login.user_redirect', $config['layout']['login_role']['redirection_user']);
                if (isset($config['layout']['login_role']['redirection_subscriber']))
                    $container->setParameter('pi_app_admin.layout.login.subscriber_redirect', $config['layout']['login_role']['redirection_subscriber']);

                if (isset($config['layout']['login_role']['redirection_admin']))
                    $container->setParameter('pi_app_admin.layout.login.admin_template', $config['layout']['login_role']['template_admin']);
                if (isset($config['layout']['login_role']['redirection_user']))
                    $container->setParameter('pi_app_admin.layout.login.user_template', $config['layout']['login_role']['template_user']);
                if (isset($config['layout']['login_role']['redirection_subscriber']))
                    $container->setParameter('pi_app_admin.layout.login.subscriber_template', $config['layout']['login_role']['template_subscriber']);
            }
            
            // Redirection template config
            if (isset($config['layout']['template'])){
                if (isset($config['layout']['template']['template_connection']))
                    $container->setParameter('pi_app_admin.layout.template.connexion', "PiAppTemplateBundle::Template\\Layout\\Connexion\\".$config['layout']['template']['template_connection']);
                if (isset($config['layout']['template']['template_form']))
                    $container->setParameter('pi_app_admin.layout.template.form', "PiAppTemplateBundle:Template\\Form:".$config['layout']['template']['template_form']);
                if (isset($config['layout']['template']['template_grid']))
                    $container->setParameter('pi_app_admin.layout.template.grid', "PiAppTemplateBundle:Template\\Grid:".$config['layout']['template']['template_grid']);
                if (isset($config['layout']['template']['template_flash']))
                    $container->setParameter('pi_app_admin.layout.template.flash', "PiAppTemplateBundle:Template\\Flash:".$config['layout']['template']['template_flash']);
            }
            
            // Layout meta config
            if (isset($config['layout']['meta_head'])){
                if (isset($config['layout']['meta_head']['author']))
                    $container->setParameter('pi_app_admin.layout.meta.author', $config['layout']['meta_head']['author']);
                if (isset($config['layout']['meta_head']['copyright']))
                    $container->setParameter('pi_app_admin.layout.meta.copyright', $config['layout']['meta_head']['copyright']);
                if (isset($config['layout']['meta_head']['og_type']))
                    $container->setParameter('pi_app_admin.layout.meta.og_type', $config['layout']['meta_head']['og_type']);
                if (isset($config['layout']['meta_head']['og_image']))
                    $container->setParameter('pi_app_admin.layout.meta.og_image', $config['layout']['meta_head']['og_image']);
                if (isset($config['layout']['meta_head']['og_site_name']))
                    $container->setParameter('pi_app_admin.layout.meta.og_site_name', $config['layout']['meta_head']['og_site_name']);
                if (isset($config['layout']['meta_head']['title']))
                    $container->setParameter('pi_app_admin.layout.meta.title', $config['layout']['meta_head']['title']);
                if (isset($config['layout']['meta_head']['description']))
                    $container->setParameter('pi_app_admin.layout.meta.description', $config['layout']['meta_head']['description']);
                if (isset($config['layout']['meta_head']['keywords']))
                    $container->setParameter('pi_app_admin.layout.meta.keywords', $config['layout']['meta_head']['keywords']);
            }
            
        }          
    
        /**
         * LayoutHead config parameter
         */
        $container->setParameter('js_files', array());
        $container->setParameter('css_files', array());
    }
  
    public function getAlias()
    {
        return 'pi_app_admin';
    }    
   
}
