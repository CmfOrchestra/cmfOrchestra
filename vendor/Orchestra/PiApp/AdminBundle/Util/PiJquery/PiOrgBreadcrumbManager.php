<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Util
 * @package    Extension_jquery 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-11
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Util\PiJquery;

use Symfony\Component\DependencyInjection\ContainerInterface;

use PiApp\AdminBundle\Twig\Extension\PiJqueryExtension;
use PiApp\AdminBundle\Exception\ExtensionException;
use PiApp\AdminBundle\Manager\PiPageManager;
use PiApp\AdminBundle\Manager\PiTreeManager;

/**
 * Semantique tree of all pages according to the section.
 *
 * @category   Admin_Util
 * @package    Extension_jquery 
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiOrgBreadcrumbManager extends PiJqueryExtension
{
    /**
     * @var array
     * @static
     */
    static $menus = array('breadcrumb');
    
    /**
     * @var array
     * @static
     */
    static $actions = array('renderdefault');
    
        
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
     * Sets init.
     *
     * @access protected
     * @return void
     *
     * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     */    
    protected function init($options = null)
    {
    }    
    
    /**
      * Render proxy.
      *
      * @param    $options    tableau d'options.
      * @access protected
      * @return void
      *
      * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com> 
      */
    protected function render($options = null)
    {        
        // Options management
        if (!isset($options['action']) || empty($options['action']) || (isset($options['action']) && !in_array(strtolower($options['action']), self::$actions)) )
            throw ExtensionException::optionValueNotSpecified('action', __CLASS__);
        if (!isset($options['menu']) || empty($options['menu']) || (isset($options['menu']) && !in_array(strtolower($options['menu']), self::$menus)) )
            throw ExtensionException::optionValueNotSpecified('menu', __CLASS__);
        
        $method = strtolower($options['menu']) . "Menu";
        $action = strtolower($options['action']) . "Action";
        
        if (method_exists($this, $method))
            $nodes = $this->$method($options);
        else
            throw ExtensionException::MethodUnDefined($method);        
        
        return $this->$action($nodes, $options);
    }
    
    /**
     * Default render
     *
     * @param array        $parameters
     * @param array        $options
     * @access private
     * @return string
     *
     * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     */
    private function renderdefaultAction($parameters, $options = null)
    {
        // Options management
        if ( !isset($options['template']) || empty($options['template']) )
            throw ExtensionException::optionValueNotSpecified('template', __CLASS__);
        if ( !isset($options['entity']) || empty($options['entity']) )
            throw ExtensionException::optionValueNotSpecified('entity', __CLASS__);
        
        if ( !isset($options['locale']) )
            $locale    = $this->container->get('request')->getLocale();
        else
            $locale = $options['locale'];        
        
        $_content = "";
        if (!is_null($parameters['node'])){
            $em        = $this->container->get('doctrine')->getEntityManager();
            $nodes    = $em->getRepository($options['entity'])->getPath($parameters['node']);
            
            // we construct all boucles.
            $_boucle          = array();
            $RouteNames      = array();
            $template         = $options['template'];
            $templateContent = $this->container->get('twig')->loadTemplate("PiAppTemplateBundle:Template\\Breadcrumb:$template");
            
            end($nodes);
            $last_key_value = key($nodes);
            reset($nodes);
            foreach($nodes as $key => $node){
                    $parameters['node']   = $node;
                    $parameters['lang']      = $locale;
                    $parameters['locale'] = $locale;
                    $parameters['key']      = $key;
                    $parameters['last']      = $last_key_value;
                        
                    if ($templateContent->hasBlock("boucle")){
                        $_boucle[]    = $templateContent->renderBlock("boucle", $parameters) . " \n";
                    } else {
                        $response     = $this->container->get('templating')->renderResponse("PiAppTemplateBundle:Template\\Breadcrumb:$template", $parameters);
                        $_boucle[]     = $response->getContent() . " \n";
                    }    
            }

            if ($templateContent->hasBlock("body")){
                $_content    = $templateContent->renderBlock("body", array( 'nodes' => array_merge($options, array('boucle'=>$_boucle, 'content'=>implode(" \n", $_boucle))))) . " \n";
            } else {
                $_content    = implode(" \n", $_boucle);
            }
        }        
        
        return $_content;
    }    
    
    /**
     * Define semantique tree html FORMULAIRE.
     *
     * <code>
     *        {% set options_breadcrumbe = {
     *                'entity':'Menu',
     *                 'template':'organigram-breadcrumb.html.twig',
     *                'action':'renderDefault',
     *                'menu': 'breadcrumb' } 
     *        %}
     *        {{ renderJquery('MENU', 'org-tree-breadcrumb', options_breadcrumbe )|raw }}
     * </code>
     * 
     * @param    array $options
     * @access public
     * @return array
     *
     * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     */
    public function breadcrumbMenu($options = null)
    {
        // Options management
        if ( !isset($options['entity']) || empty($options['entity']) )
            throw ExtensionException::optionValueNotSpecified('entity', __CLASS__);
        if ( !isset($options['node']) )
            throw ExtensionException::optionValueNotSpecified('node', __CLASS__);
                
        if ( !isset($options['locale']) )
            $locale    = $this->container->get('request')->getLocale();
        else        
            $locale = $options['locale'];
        
        $em         = $this->container->get('doctrine')->getEntityManager();
           $node          = $em->getRepository($options['entity'])->findNodeOr404($options['node'], $locale,'object');
           //$query         = $em->getRepository($options['entity'])->childrenQuery($node, true);
           //$nodes         = $em->getRepository($options['entity'])->findTranslationsByQuery($locale, $query, 'object');
        
        return array(
            'node'         => $node,
            //'childs'     => $nodes,        
        );
    }    
}