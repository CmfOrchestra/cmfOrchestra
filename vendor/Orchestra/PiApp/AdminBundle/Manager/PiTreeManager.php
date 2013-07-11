<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Managers
 * @package    Manager
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-04-19
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Manager;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response as Response;

use PiApp\AdminBundle\Builder\PiTreeManagerBuilderInterface;
use PiApp\AdminBundle\Manager\PiCoreManager;
use PiApp\AdminBundle\Entity\Widget;

/**
 * Description of the Tree Widget manager
 *
 * @category   Admin_Managers
 * @package    Manager
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiTreeManager extends PiCoreManager implements PiTreeManagerBuilderInterface 
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
     * Call the tree render source method.
     *
     * @param string $id
     * @param string $lang
     * @param string $params
     * @return string
     * @access    public
     *
     * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     * @since 2012-04-19
     */
    public function renderSource($id, $lang = '', $params = null)
    {
        str_replace('~', '~', $id, $count);
        if ($count == 2)
            list($entity, $method, $category) = explode('~', $this->_Decode($id));
        elseif ($count == 1)
            list($entity, $method) = explode('~', $this->_Decode($id));
        else
            throw new \InvalidArgumentException("you have not configure correctly the attibute id");
        
        if (!is_array($params))
            $params        = $this->paramsDecode($params);
        else
            $this->recursive_map($params);
        
        $params['locale']    = $lang;
        
        if (isset($category) && ($method == "_navigation_default"))
            return $this->defaultNavigation($lang, $entity, $category,$params['template'], $params['separatorClass'], $params['ulClass'], $params['liClass'], $params);
        elseif ( isset($GLOBALS['JQUERY']['MENU'][$method]) && $this->container->has($GLOBALS['JQUERY']['MENU'][$method]) )
            return $this->container->get('pi_app_admin.twig.extension.jquery')->FactoryFunction('MENU', $method, $params);
        else
            throw new \InvalidArgumentException("you have not configure correctly the attibute id");
    }
    
    /**
     * Return the build tree result of a gedmo tree entity, with class options.
     *
     * @param string    $locale
     * @param string    $entity
     * @param string    $category
     * @param string    $separatorClass
     * @param string    $ulClass
     * @param string    $liClass
     * @param array        $options
     * @access    public
     * @return string
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function defaultNavigation($locale, $entity, $category, $template, $separatorClass = "", $ulClass = "", $liClass = "", $params = null)
    {
        $em      = $this->container->get('doctrine')->getEntityManager();        
        
//         if (count(explode(':', $entity)) < 2){
//             $entity             = ucfirst(strtolower($entity));
//             $entity             = "PiAppGedmoBundle:$entity";
//         }
        
        if (isset($params['node']) && !empty($params['node']) ){
            $node  = $em->getRepository($entity)->findNodeOr404($params['node'], $locale,'object');
        } else {
            $node = null;
        }
            
        try {
            if (isset($params['enabledonly']) && ($params['enabledonly'] == "false")){
                if (!empty($template))
                    $nodes         = $em->getRepository($entity)->setContainer($this->container)->getAllTree($locale, $category, 'object', false, false, $node);
                else
                    $nodes         = $em->getRepository($entity)->setContainer($this->container)->getAllTree($locale, $category, 'array', false, false, $node);
            } else {
                if (!empty($template)){
                    $nodes         = $em->getRepository($entity)->setContainer($this->container)->getAllTree($locale, $category, 'object', false, true, $node);
                }else
                    $nodes         = $em->getRepository($entity)->setContainer($this->container)->getAllTree($locale, $category, 'array', false, true, $node);
            }            
        } catch (\Exception $e) {
            $nodes = null;
        }
        
        if (!empty($template)){
            $params['locale']        = $locale;
            $params['nodes']        = $nodes;
            $params['repository']    = $em->getRepository($entity);
            $response                 = $this->container->get('templating')->renderResponse("PiAppTemplateBundle:Template\\Tree:$template", $params);
            $tree                     = $response->getContent() . " \n";
            $tree                    = $this->container->get('pi_app_admin.string_manager')->closetags($tree);
            $tree                    = utf8_decode(mb_convert_encoding($tree, "UTF-8", "HTML-ENTITIES"));
        } else {
            $self                        = &$this;
            $self->entity              = $entity;
            $self->locale              = $locale;
            $self->root_level       = null;
            $self->nodes               = null;
            $self->ulClass             = $ulClass;
            $self->liClass             = $liClass;
            
            if (isset($params['counter']) && $params['counter'])
                $self->counter = $params['counter'];
            else
                $self->counter = 'true';
            
            if (isset($params['separatorText']) && $params['separatorText'])
                $self->separatorText = $params['separatorText'];
            else
                $self->separatorText = "";
            
            if (isset($params['separatorFirst']) && $params['separatorFirst'])
                $self->separatorFirst = $params['separatorFirst'];
            else
                $self->separatorFirst = 'false';
            
            if (isset($params['separatorLast']) && $params['separatorLast'])
                $self->separatorLast = $params['separatorLast'];
            else
                $self->separatorLast = 'false';
            
            if (!empty($separatorClass))
                $self->separator = "<li class='$separatorClass'>{$self->separatorText}</li>";
            else
                $self->separator = "";
            
            $params_default = array(
                    'routeActifMenu' => array(
                            'liActiveClass'     => 'menuContainer_highlight',
                            'liInactiveClass'     => '',
                            'aActiveClass'         => 'tblanc',
                            'aInactiveClass'     => 'tnoir',
                            'enabledonly'        => "true",
                    ),
                    'lvlActifMenu' => array(
                            'liActiveClass'     => '',
                            'liInactiveClass'     => '',
                            'aActiveClass'         => 'tnoir',
                            'aInactiveClass'     => 'tnoir',
                            'enabledonly'        => "true",
                    )
            );
            
            if (is_array($params))
                $self->params      = array_merge($params_default, $params);
            else
                $self->params     = $params_default;
            
            $options = array(
                    'decorate' => true,
                    'rootOpen' => function($nodes) use (&$self) {
                        $self->nodes = $nodes;
                        $first_node     = current($nodes);
            
                        if (is_null($self->root_level)){
                            if (!empty($first_node['lvl']))
                                $self->root_level = $first_node['lvl'];
                            else
                                $self->root_level = 0;
                        }
                            
                        if (($first_node['lvl'] == $self->root_level) || empty($first_node['lvl'])){
                            $content = "\n <ul class='".$self->ulClass."' > \n";
                        } else {
                            $content = "\n <ul class='".$self->ulClass." niveau".($first_node['lvl']-$self->root_level)."' > \n";
                        }
                        return $content;
                    },
                    'rootClose' => "\n </ul> \n",
                    'childOpen' => " \n",    // 'childOpen' => "    <li class='collapsed' > \n",
                    'childClose' => "    </li> \n",
                    'nodeDecorator' => function($node) use (&$self) {
                        // if the node is disable
                        if ( ( ($node['lvl']-$self->root_level) == 0 ) && isset($node["enabled"]) && ($node["enabled"] == 0) && isset($self->params['routeActifMenu']['enabledonly']) && ($self->params['routeActifMenu']['enabledonly'] == "true") ){
                            return "";
                        }
                        if ( ( ($node['lvl']-$self->root_level) != 0 ) && isset($node["enabled"]) && ($node["enabled"] == 0) && isset($self->params['lvlActifMenu']['enabledonly']) && ($self->params['lvlActifMenu']['enabledonly'] == "true") ){
                            return "";
                        }
            
                        // we get the url of the page associated to the menu.
                        $menu   = $self->getContainer()->get('doctrine')->getEntityManager()->getRepository($self->entity)->findOneById($node['id']);
                        if ( method_exists($menu, 'getPage') && ($menu->getPage() InstanceOf \PiApp\AdminBundle\Entity\Page) ) {
                            $routename     = $menu->getPage()->getRouteName();
                            $url        = $self->getContainer()->get('bootstrap.RouteTranslator.factory')->getRoute($menu->getPage()->getRouteName(), array('locale'=>$self->locale));
                        }elseif ( method_exists($menu, 'getUrl') && ($menu->getUrl() != "") ) {
                            $routename     = '';
                            $url         = $menu->getUrl();
                        } else {
                            $routename     = '';
                            $url         = "#"; //$self->getContainer()->get('router')->generate($routename);
                        }
                        
                        if ( method_exists($menu, 'getTitle'))
                            $title    = $menu->getTitle();
                        else
                            $title    = "Undefined title";
            
                        // we get the image of the menu if it exists.
                        $img_balise = "";
                        if (method_exists($menu, 'getMedia')  && ($menu->getMedia() instanceof \PiApp\GedmoBundle\Entity\Media)){
                            $id      = $menu->getMedia()->getId();
                            if ( !is_null($menu->getMedia()) && ($menu->getMedia()->getImage()->getName() != $self->getContainer()->getParameter("pi_app_admin.page.media_pixel")) ){
                                $img_balise = $self->getContainer()->get('sonata.media.twig.extension')->media($menu->getMedia()->getImage(), 'default_small', array('width'=>'20', 'alt'=>"") );
                            }
                        }
            
                        // we get all route name of all childs of the menu.
                        $childs_routesnames = $self->getContainer()->get('doctrine')->getEntityManager()->getRepository($self->entity)->findChildsRouteByParentId($node['id'], $self->locale, 'string');
            
                        //print_r($self->nodes);
                        //print_r("<br /><br />");
            
                        $first_node        = reset($self->nodes);
                        $last_node        = end($self->nodes);
                        $separator        = $self->separator;
                        $separatorlast  = "";
            
                        if ( ($self->separatorFirst == "false") && ($first_node['id'] == $node['id']) ){
                            $separator = "";
                            //print_r('first ' . $node['lft']);
                            //print_r("<br /><br />");
                        }
                        if ( ($self->separatorLast == "true") && ($last_node['id'] == $node['id']) ){
                            $separatorlast =  $self->separator;
                            //print_r('last ' . $node['lft']);
                            //print_r("<br /><br />");
                        }
            
                        // we create the decorator.
                        if ( ( ($node['lvl']-$self->root_level) == 0 ) ){
                            if (!empty($img_balise))
                                $content = $separator . '<li class="'.$self->liClass.' {{ in_paths("'.$childs_routesnames.'", "'.$self->params['routeActifMenu']['liActiveClass'].'", "'.$self->params['routeActifMenu']['liInactiveClass'].'")|raw }}" ><a class="menu-item {{ in_paths("'.$childs_routesnames.'", "'.$self->params['routeActifMenu']['aActiveClass'].'", "'.$self->params['routeActifMenu']['aInactiveClass'].'")|raw }} " href="'.$url.'" data-node="'.$node['id'].'" >'.$img_balise."</a>".$separatorlast." \n";
                            else
                                $content = $separator . '<li class="'.$self->liClass.' {{ in_paths("'.$childs_routesnames.'", "'.$self->params['routeActifMenu']['liActiveClass'].'", "'.$self->params['routeActifMenu']['liInactiveClass'].'")|raw }}" ><a class="menu-item {{ in_paths("'.$childs_routesnames.'", "'.$self->params['routeActifMenu']['aActiveClass'].'", "'.$self->params['routeActifMenu']['aInactiveClass'].'")|raw }} " href="'.$url.'" data-node="'.$node['id'].'" >'.$title."</a>".$separatorlast." \n";
                        } else {
                            // we initialize the counter
                            if ($self->counter == 'true'){
                                $counter = '-' . ($node['lvl']-$self->root_level);
                            } else {
                                $counter = "";
                            }
                                
                            if (!empty($img_balise))
                                $content = $separator . '<li class="'.$self->liClass.$counter.' {{ in_paths("'.$childs_routesnames.'", "'.$self->params['lvlActifMenu']['liActiveClass'].'", "'.$self->params['lvlActifMenu']['liInactiveClass'].'")|raw }}" ><a class="menu-item {{ in_paths("'.$childs_routesnames.'", "'.$self->params['lvlActifMenu']['aActiveClass'].'", "'.$self->params['lvlActifMenu']['aInactiveClass'].'")|raw }} " href="'.$url.'" data-node="'.$node['id'].'" >'.$img_balise."</a>".$separatorlast." \n";
                            else
                                $content = $separator . '<li class="'.$self->liClass.$counter.' {{ in_paths("'.$childs_routesnames.'", "'.$self->params['lvlActifMenu']['liActiveClass'].'", "'.$self->params['lvlActifMenu']['liInactiveClass'].'")|raw }}" ><a class="menu-item {{ in_paths("'.$childs_routesnames.'", "'.$self->params['lvlActifMenu']['aActiveClass'].'", "'.$self->params['lvlActifMenu']['aInactiveClass'].'")|raw }} " href="'.$url.'" data-node="'.$node['id'].'" >'.$title."</a>".$separatorlast." \n";
                        }
            
                        return $content;
                    }
            );
            
            //         $all_routes_nodes = $em->getRepository($entity)->getRootNodes();
            //         foreach($all_routes_nodes as $key=> $node){
            //             $node  = $em->getRepository($entity)->findNodeOr404($node->getId(), $locale,'object');
            //             $query = $em->getRepository($entity)->reorder($node);
            //         }
            
            // we repair the tree
            //$em->getRepository($entity)->setRecover();
            //$result = $em->getRepository($entity)->verify();            

            $tree        = $em->getRepository($entity)->buildTree($nodes, $options);
        }
        
        return $tree;
    }
    
    /**
     * Return the build tree result of a gedmo tree entity, without class options.
     * 
     * @param string    $locale
     * @param string    $entity
     * @param string    $category
     * @param array        $params
     * @return string
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-04-19
     */
    public function defaultOrganigram($locale, $entity, $category, $params = null)
    {
        $em               = $this->container->get('doctrine')->getEntityManager();
        $self            = &$this;        
        
//         if (count(explode(':', $entity)) < 2){
//             $entity = ucfirst(strtolower($entity));
//             $entity = "PiAppGedmoBundle:$entity";
//         }
        
        $self->entity = $entity;
        $self->locale = $locale;
        if (isset($params['fields'])) $self->fields = $params['fields']; else  $self->fields = null;
        
        $options = array(
                'decorate' => true,
                'rootOpen' => "\n <ul> \n",
                'rootClose' => "\n </ul> \n",
                'childOpen' => "    <li class='collapsed' > \n",        // 'childOpen' => "    <li class='collapsed' > \n",
                'childClose' => "    </li> \n",
                'nodeDecorator' => function($node) use (&$self) {                                    
                    // we get the url of the page associated to the menu.
                    $tree   = $self->getContainer()->get('doctrine')->getEntityManager()->getRepository($self->entity)->findOneById($node['id']);
                    if ( method_exists($tree, 'getPage') && ($tree->getPage() InstanceOf \PiApp\AdminBundle\Entity\Page) ) {
                        $routename     = $tree->getPage()->getRouteName();
                        $url        = $self->getContainer()->get('bootstrap.RouteTranslator.factory')->getRoute($tree->getPage()->getRouteName(), array('locale'=>$self->locale));
                    } else {
                        $routename     = '';
                        $url         = "#"; //$self->getContainer()->get('router')->generate($routename);
                    }                
                    
                    $content = '';
                    if (is_array($self->fields)){
                        foreach($self->fields as $key => $field){
                            if ( isset($field['content']) && !empty($field['content']) ){
                                if ($field['content'] == "leftright" ){
                                    if ( isset($field['class']) && !empty($field['class']) )
                                        $class = $field['class'];
                                    else
                                        $class = "pi_tree_desc";
                                    
                                    $content .= "<p class='$class'>" . $node["lft"] . ' - '. $node["rgt"] . ' (n'. $node["id"] .', lvl '. $node["lvl"] .')' ."</p> \n";
                                } else {
                                    if ( isset($field['class']) && !empty($field['class']) )
                                        $class = $field['class'];
                                    else
                                        $class = "pi_tree_desc";
                                    
                                    $method     = 'get' . ucfirst(strtolower($field['content']));
                                    if ( method_exists($tree, $method))
                                        $field_content    = $tree->$method();
                                    else
                                        $field_content    = "Undefined content";
                                    
                                    if ($key == 0)
                                        $content .= '<a href="'.$url.'" data-rub="'.$node['id'].'" class="'.$class.'">'.$field_content."</a><p class='$class'>$routename<p> \n";
                                    else
                                        $content .= "<p class='$class'>".$field_content."</p> \n";
                                }
                            }
                        }
                    }                
                    return  $content;
                }
        );
        
        // we repair the tree
        //$em->getRepository($entity)->setRecover();
        //$result = $em->getRepository($entity)->verify();
        
        //$node = $em->getRepository($entity)->findNodeOr404(4, $locale,'object');
        //$left = $em->getRepository($entity)->children($node);
        //print_r($left);exit;
        
        if (isset($params['node']) && !empty($params['node']) ){
            $node  = $em->getRepository($entity)->findNodeOr404($params['node'], $locale,'object');
        } else {
            $node = null;
        }
        
        $category    = utf8_decode($category);
        
        try {
            if (isset($params['enabledonly']) && ($params['enabledonly'] == "false")){
                if (!empty($category))
                    $nodes         = $em->getRepository($entity)->setContainer($this->container)->getAllTree($locale, $category, 'array', false, false, $node);
                else
                    $nodes         = $em->getRepository($entity)->setContainer($this->container)->getAllTree($locale, '', 'array', false, false, $node);
            } else {
                if (!empty($category))
                    $nodes         = $em->getRepository($entity)->setContainer($this->container)->getAllTree($locale, $category, 'array', false, true, $node);
                else
                    $nodes         = $em->getRepository($entity)->setContainer($this->container)->getAllTree($locale, '', 'array', false, true, $node);
            }            
        } catch (\Exception $e) {
            $nodes = null;
        }

        $tree        = $em->getRepository($entity)->buildTree($nodes, $options);
        
        return $tree;
    }    
}