<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Bundle
 * @package    DependencyInjection
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-01-11
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * @category   Bundle
 * @package    DependencyInjection
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('pi_app_admin');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
        $this->addAdminConfig($rootNode);
        $this->addLayoutConfig($rootNode);
        $this->addPageConfig($rootNode);
        $this->addFormConfig($rootNode);

        return $treeBuilder;
    }
    
    /**
     * Admin config
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition
     *
     * @return void
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */    
    protected function addAdminConfig(ArrayNodeDefinition $rootNode){
    	$rootNode
	    	->children()
		    	->arrayNode('admin')
		    	->addDefaultsIfNotSet()
		    	->children()
		    	
			    	->scalarNode('context_menu_theme')
			    		->defaultValue('pi2')
			    		->cannotBeEmpty()
			    		->end()

			    	->scalarNode('grid_index_css')
			    		->defaultValue('style-grid-7.css')
			    		->cannotBeEmpty()
			    		->end()
			    		
			    	->scalarNode('grid_show_css')
			    		->defaultValue('style-grid-5.css')
			    		->cannotBeEmpty()
			    		->end()
			    		
			    	->scalarNode('grid_theme_css')
			    		->defaultValue('rocket')
			    		->cannotBeEmpty()
			    		->end()
			    		
		    	->end()
	    
	    	->end()
    	->end();
    }    
    
    /**
     * Page config
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition
     *
     * @return void
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */    
    protected function addPageConfig(ArrayNodeDefinition $rootNode){
    	$rootNode
	    	->children()
		    	->arrayNode('page')
		    	->addDefaultsIfNotSet()
		    	->children()

		    		->booleanNode('homepage_deletewidget')
		    			->defaultValue(true)
		    			->end()
		    			
		    		->booleanNode('page_management_by_user_only')
		    			->defaultValue(false)
		    			->end()		    			
		    	
			    	->booleanNode('single_slug')
			    		->defaultValue(false)
			    		->end()
			    	
			    	->booleanNode('refresh_allpage_containing_snippet')
			    		->defaultValue(true)
			    		->end()
			    		
			    	->booleanNode('refresh_css_js_cache_file')
			    		->defaultValue(true)
			    		->end()			    		
			    		
			    	->booleanNode('indexation_authorized_automatically')
			    		->defaultValue(false)
			    		->end()			    		

			    	->booleanNode('switch_page_other_language_if_doesnt_exist')
			    		->defaultValue(false)
			    		->end()
			    					    		
			    	->booleanNode('switch_layout_mobile_authorized')
			    		->defaultValue(false)
			    		->end()
			    	
			    	->booleanNode('switch_layout_init_redirection_authorized')
			    		->defaultValue(false)
			    		->end()
			    		 
			    	->booleanNode('switch_language_browser_authorized')
			    		->defaultValue(false)
			    		->end()
			    		 
		    		->booleanNode('memcache_enable')
			    		->defaultValue(false)
			    		->end()

			    	->scalarNode('media_pixel')
			    		->defaultValue("Translucent_50%_white.png")
			    		->cannotBeEmpty()
			    		->end()

			    	->booleanNode('google_analytic')
			    		->defaultValue(false)
			    		->end()
			    		
			    	->scalarNode('google_analytic_tracker')
			    		->defaultValue("default")
			    		->end()

			    	->scalarNode('google_analytic_template')
			    		->defaultValue("BootStrapGoogleBundle:Analytics:default.html.twig")
			    		->end()
			    		

			    	->scalarNode('google_analytic_template2')
			    		->defaultValue("BootStrapGoogleBundle:Analytics:api.html.twig")
			    		->end()
			    		
			    		
		    	->end()
	    
	    	->end()
    	->end();
    }
        
    /**
     * Form config
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition
     *
     * @return void
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */    
    protected function addFormConfig(ArrayNodeDefinition $rootNode){
        $rootNode
            ->children()
                ->arrayNode('form')
                    ->addDefaultsIfNotSet()                    
                    ->children()
                    
                        ->booleanNode('show_legend')
                            ->defaultValue(true)
                            ->end()
                            
                        ->booleanNode('show_child_legend')
                            ->defaultValue(false)
                            ->end()
                            
                        ->scalarNode('error_type')
                            ->defaultValue('inline')
                            ->cannotBeEmpty()
                        	->end()
                        
                    ->end()
                    
                ->end()
            ->end();
    }
    
    /**
     * Layout config
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition
     *
     * @return void
     * @access protected
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */    
    protected function addLayoutConfig(ArrayNodeDefinition $rootNode){
    	$rootNode
	    	->children()
		    	->arrayNode('layout')
		    		->addDefaultsIfNotSet()
			    	->children()
			    	
			    		->arrayNode('init_pc')
			    			->addDefaultsIfNotSet()
			    			->children()
			    			
						    	->scalarNode('template_name')
						    		->defaultValue('layout-pi-page1.html.twig')
						    		->cannotBeEmpty()
						    		->end()
						    		
						    	->scalarNode('route_redirection_name')
						    		->defaultValue('home_page')
						    		->cannotBeEmpty()
						    		->end()
						    		
						    ->end()
					    ->end()
					    
					    ->arrayNode('init_mobile')
					    	->addDefaultsIfNotSet()
						    ->children()
						    
							    ->scalarNode('template_name')
								    ->defaultValue('Default')
								    ->cannotBeEmpty()
								    ->end()
								    
							    ->scalarNode('route_redirection_name')
								    ->defaultValue('public_page_mobile')
								    ->cannotBeEmpty()
								    ->end()
								    
						    ->end()
					    ->end()

					    
					    ->arrayNode('login_role')
						    ->addDefaultsIfNotSet()
						    ->children()
						    
							    ->scalarNode('redirection_admin')
								    ->defaultValue('admin_homepage')
								    ->cannotBeEmpty()
								    ->end()
							    
							    ->scalarNode('redirection_user')
								    ->defaultValue('home_page')
								    ->cannotBeEmpty()
								    ->end()
								    
								->scalarNode('redirection_subscriber')
								    ->defaultValue('home_page')
								    ->cannotBeEmpty()
								    ->end()
								    
								->scalarNode('template_admin')
								    ->defaultValue('layout-pi-admin.html.twig')
								    ->cannotBeEmpty()
								    ->end()

								->scalarNode('template_user')
								    ->defaultValue('layout-pi-page2.html.twig')
								    ->cannotBeEmpty()
								    ->end()

								->scalarNode('template_subscriber')
								    ->defaultValue('layout-pi-page2.html.twig')
								    ->cannotBeEmpty()
								    ->end()
								    
								    
						    ->end()
					    ->end()
					    
					    ->arrayNode('template')
						    ->addDefaultsIfNotSet()
						    ->children()
						    
							    ->scalarNode('template_connection')
								    ->defaultValue('layout-security.html.twig')
								    ->cannotBeEmpty()
								    ->end()
							    
							    ->scalarNode('template_form')
								    ->defaultValue('fields.html.twig')
								    ->cannotBeEmpty()
								    ->end()
							    
							    ->scalarNode('template_grid')
								    ->defaultValue('grid.theme.html.twig')
								    ->cannotBeEmpty()
								    ->end()

								->scalarNode('template_flash')
								    ->defaultValue('flash.html.twig')
								    ->cannotBeEmpty()
								    ->end()
								    
						    ->end()
					    ->end()
					    

					    ->arrayNode('meta_head')
						    ->addDefaultsIfNotSet()
						    ->children()
						    
							    ->scalarNode('author')
								    ->defaultValue('Orchestra')
								    ->cannotBeEmpty()
								    ->end()
							    
							    ->scalarNode('copyright')
								    ->defaultValue('Orchestra')
								    ->cannotBeEmpty()
								    ->end()
								    
								->scalarNode('title')
								    ->defaultValue('')
								    ->end()								    
								    
								->scalarNode('description')
								    ->defaultValue('')
								    ->end()
								    
								->scalarNode('keywords')
								    ->defaultValue('')
								    ->end()
								    
								->scalarNode('og_type')
								    ->defaultValue('')
								    ->cannotBeEmpty()
								    ->end()

								->scalarNode('og_image')
								    ->defaultValue('')
								    ->cannotBeEmpty()
								    ->end()

								->scalarNode('og_site_name')
								    ->defaultValue('')
								    ->cannotBeEmpty()
								    ->end()								    
						    
						    ->end()
					    ->end()					    
					    
					    
					    
			    	->end()
		    	->end()
	    	->end();
    }    
        
}
