<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Util
 * @package    Extension_jquery 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-03-26
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Util\PiJquery;

use Symfony\Component\DependencyInjection\ContainerInterface;

use PiApp\AdminBundle\Twig\Extension\PiJqueryExtension;
use PiApp\AdminBundle\Exception\ExtensionException;

/**
 * Tiny Accordeon Jquery plugin
 *
 * @category   Admin_Util
 * @package    Extension_jquery 
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiNestedAccordeonManager extends PiJqueryExtension
{
    /**
     * @var array
     * @static
     */
    static $types = array('accordeonUl', 'accordeonDiv', 'accordeonTree');
        
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
    protected function init($options = null) {
        // css
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/js/nested/css/style.css");
        // js
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/nested/js/jquery.nestedAccordion.js");
        
        // demo :: http://www.adipalaz.com/experiments/jquery/nested_accordion_demo.html
        // doc :: http://www.adipalaz.com/experiments/jquery/nested_accordion.html
    }    
    
    /**
     * Sets the nested accordeon render.
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
        if (!isset($options['acc-id-box']) || empty($options['acc-id-box'])) {
        	throw ExtensionException::optionValueNotSpecified('acc-id-box', __CLASS__);
        }
        if (!isset($options['acc-id']) || empty($options['acc-id'])) {
        	throw ExtensionException::optionValueNotSpecified('acc-id', __CLASS__);
        }    	
    	if (!isset($options['acc-type']) || empty($options['acc-type']) || (isset($options['acc-type']) && !in_array($options['acc-type'], self::$types))) {
    		throw ExtensionException::optionValueNotSpecified('acc-type', __CLASS__);
    	}
    
    	if ( $options['acc-type'] == "accordeonUl" ) {
    		return $this->accUlAction($options);
    	} elseif ( $options['acc-type'] == "accordeonDiv" ) {
    		return $this->accDivAction($options);
    	} elseif ( $options['acc-type'] == "accordeonTree" ) {
    		return $this->accTreeAction($options);
    	}
    }
        
    /**
      * Nested Lists + Headings + DIVs
      * 
      * <code>
      *         // tree management
      *         $self = &$this;
      *         $self->category = $category;
      *         $self->NoLayout = $NoLayout;
      *         $self->translator = $this->container->get('translator');
      *         $options = array(
      *                 'decorate' => true,
      *                 'rootOpen' => "\n <div class='inner'><ul> \n",
      *                 'rootClose' => "\n </ul></div> \n",
      *                 'childOpen' => "    <li> \n",        // 'childOpen' => "    <li class='collapsed' > \n",
      *                 'childClose' => "    </li> \n",
      *                 'nodeDecorator' => function($node) use (&$self) {
      *                     
      *                     $tree   = $self->getContainer()->get('doctrine')->getManager()->getRepository($self->_entityName)->findOneById($node['id']);
      *                 
      *                     // define of all url images
      *                     $Urlpath0     = $self->get('templating.helper.assets')->getUrl('bundles/piappadmin/images/icons/tree/plus.png');
      *                     $UrlpathAdd    = $self->get('templating.helper.assets')->getUrl('bundles/piappadmin/images/icons/tree/add.png');
      *                     $Urlpath1     = $self->get('templating.helper.assets')->getUrl('bundles/piappadmin/images/icons/tree/view.png');
      *                     $Urlpath2     = $self->get('templating.helper.assets')->getUrl('bundles/piappadmin/images/icons/tree/up.png');
      *                     $Urlpath3     = $self->get('templating.helper.assets')->getUrl('bundles/piappadmin/images/icons/tree/down.png');
      *                     $Urlpath4     = $self->get('templating.helper.assets')->getUrl('bundles/piappadmin/images/icons/tree/remove.png');
      * 
      *                     $linkNode     = '<h4>'
      *                     . str_replace('<br>', ' ', $tree->getTitle())
      *                     . '&nbsp;&nbsp;&nbsp; (node: ' .  $node['id'] . ', level : ' .  $node['lvl'] . ')'
      *                     . '</h4>';
      *                     
      *                     if ( ($node['lft'] == -1) && ($node['rgt'] == 0) )   $linkNode .= '<div class="inner">';
      *                     if ( ($node['lft'] !== -1) && ($node['rgt'] !== 0) ) $linkNode .= '<div class="inner">';
      *                     if ( ($node['lft'] == -1) && ($node['rgt'] !== 0) )  $linkNode .= '<div class="inner">';
      *                                         
      *                     $linkAdd    = '<a href="#" class="tree-action" data-url="' . $self->generateUrl('admin_gedmo_menu_new', array("NoLayout" => true, 'category'=>$self->category, 'parent' => $node['id'])) . '" ><img src="'.$UrlpathAdd.'" title="'.$self->translator->trans('pi.add').'"  width="16" /></a>';
      *                     $linkEdit   = '<a href="#" class="tree-action" data-url="' . $self->generateUrl('admin_gedmo_menu_edit', array('id' => $node['id'], "NoLayout" => true)) . '" ><img src="'.$Urlpath1.'" title="'.$self->translator->trans('pi.edit').'"  width="16" /></a>';
      *                     $linkUp        = '<a href="' . $self->generateUrl('admin_gedmo_menu_move_up', array('id' => $node['id'], 'category'=>$self->category, 'NoLayout'=> $self->NoLayout)) . '"><img src="'.$Urlpath2.'" title="'.$self->translator->trans('pi.move-up').'" width="16" /></a>';
      *                     $linkDown     = '<a href="' . $self->generateUrl('admin_gedmo_menu_move_down', array('id' => $node['id'], 'category'=>$self->category, 'NoLayout'=> $self->NoLayout)) . '"><img src="'.$Urlpath3.'" title="'.$self->translator->trans('pi.move-down').'" width="16" /></a>';
      *                     $linkDelete    = '<a href="' . $self->generateUrl('admin_gedmo_menu_node_remove', array('id' => $node['id'], 'category'=>$self->category, 'NoLayout'=> $self->NoLayout)) . '"><img src="'.$Urlpath4.'" title="'.$self->translator->trans('pi.delete').'"  width="16" /></a>';
      *                     
      *                     $linkNode .= $linkAdd . '&nbsp;&nbsp;&nbsp;' . $linkEdit . '&nbsp;&nbsp;&nbsp;' . $linkUp . '&nbsp;&nbsp;&nbsp;' . $linkDown . '&nbsp;&nbsp;&nbsp;' . $linkDelete;
      * 
      *                     if ( ($node['lft'] == -1) && ($node['rgt'] == 0) )  $linkNode .= '</div>'; // if ( ($node['lft'] == -1) && ($node['rgt'] !== 0) )
      *                     if ( ($node['lft'] == -1) && ($node['rgt'] !== 0) ) $linkNode .= '</div>'; // if ( ($node['lft'] == -1) && ($node['rgt'] !== 0) )
      *                     return $linkNode;
      *                 }
      *         );
      *         
      *         // we repair the tree
      *         $em->getRepository("PiAppGedmoBundle:Menu")->setRecover();
      *         $result = $em->getRepository("PiAppGedmoBundle:Menu")->verify();
      *         
      *         $node   = $this->container->get('request')->query->get('node');
      *         if (!empty($node) ){
      *             $node  = $em->getRepository("PiAppGedmoBundle:Menu")->findNodeOr404($node, $locale,'object');
      *         } else {
      *             $node = null;
      *         }
      *         
      *         $nodes         = $em->getRepository("PiAppGedmoBundle:Menu")->getAllTree($locale, $category, 'array', false, false, $node);
      *         $tree        = $em->getRepository("PiAppGedmoBundle:Menu")->buildTree($nodes, $options); 
      * </code>
      * 
      * <code>
      *     {% initJquery 'ACCORDEON:nested' %}
      *     
      * 	{% if tree %}
      * 		<div id="tree">
      * 		    {{ tree|raw }}
      * 		</div>
      * 	{% else %}
      * 		<div class="alert-message info"><p>There are no nodes in tree to display</p></div>
      * 	{% endif %}
      * 	
      * 	{% set options_nested = {'acc-id-box': 'tree', 'acc-id': 'acc1', 'acc-type': "accordeonUl"} %}
      * 	{{ renderJquery('ACCORDEON', 'nested', options_nested )|raw }}	
      * <code/> 
      * 
      * @param    $options    tableau d'options.
      * @access protected
      * @return void
      *
      * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com> 
      */
    protected function accUlAction($options = null)
    {        

/* exemple code html
 
                    <ul id="acc1" class="accordion">
                      <li>
                        <h4>Heading 1</h4>
                        <div class="inner">
                          <ul>
                            <li>
                              <h5>Heading a</h5>
                              <div class="inner">
                                  <p>
                                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt 
                                  ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 
                                  laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in 
                                  voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat 
                                  non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                  </p>
                              </div>
                            </li>
                            <li>
                              <h5>Heading b</h5>
                              <div class="inner">
                                  <p>
                                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt 
                                  ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 
                                  laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in 
                                  voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat 
                                  non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                  </p>
                              </div>
                            </li>
                            <li>
                              <h5>Heading c</h5>
                              <div class="inner">
                                  <p>
                                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt 
                                  ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 
                                  laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in 
                                  voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat 
                                  non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                  </p>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </li>
                      <li>
                        <h4>Heading 2</h4>
                        <div class="inner">
                          <ul>
                            <li>
                              <h5>Heading a</h5>
                              <div class="inner">
                                  <p>
                                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt 
                                  ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 
                                  laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in 
                                  voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat 
                                  non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                  </p>
                              </div>
                            </li>
                            <li>
                              <h5>Heading b</h5>
                              <div class="inner">
                                  <p>
                                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt 
                                  ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 
                                  laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in 
                                  voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat 
                                  non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                  </p>
                              </div>
                            </li>
                            <li>
                              <h5>Heading c</h5>
                              <div class="inner">
                                  <p>
                                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt 
                                  ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 
                                  laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in 
                                  voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat 
                                  non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                  </p>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </li>
                    </ul>
 
 
 */        
        
        // We open the buffer.
        ob_start ();        
        ?>
            <script type="text/javascript">
            //<![CDATA[
                $.fn.accordion.defaults.container = false; 
                $(function() {
                    $("#<?php echo $options['acc-id-box']?> ul:first").attr('id', '<?php echo $options['acc-id']?>');
                    $("#<?php echo $options['acc-id-box']?> ul:first").attr('class', 'accordion');
                    $("#<?php echo $options['acc-id']?>").accordion({
                        el: ".h", 
                        head: "h4, h5", 
                        next: "div", 
                        initShow : "div.outer:eq(1)"
                    });
                });
            //]]>
            </script>
        <?php 
        // We retrieve the contents of the buffer.
        $_content = ob_get_contents ();
        // We clean the buffer.
        ob_clean ();
        // We close the buffer.
        ob_end_flush ();
        
        return $_content;
    }    
    
    /**
     * Nested DIVs + Headings
     *
     * @param    $options    tableau d'options.
     * @access protected
     * @return void
     *
     * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     */
    protected function accDivAction($options = null)
    {

/*

                    <div id="acc2" class="accordion">
                        <h4>1<sup>st</sup></h4>
                        <div class="inner">
                            <h5>Heading a <img src="/img/hover.gif" alt="" /></h5>
                            <div class="inner">
                              <p>
                              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt 
                              ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 
                              laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in 
                              voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat 
                              non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                              </p>
                              <p>
                              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt 
                              ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 
                              laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in 
                              voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat 
                              non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                              </p>
                            </div>
                            <h5>Heading b</h5>
                            <div class="inner">
                              <p>
                              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt 
                              ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 
                              laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in 
                              voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat 
                              non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                              </p>
                              <p>
                              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt 
                              ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 
                              laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in 
                              voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat 
                              non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                              </p>
                          </div>
                          </div>
                          <h4>2<sup>nd</sup></h4>
                          <div class="inner shown">
                              <h5>Heading a</h5>
                              <div class="inner">
                                  <p>
                                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt 
                                  ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 
                                  laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in 
                                  voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat 
                                  non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                  </p>
                                  <p>
                                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt 
                                  ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 
                                  laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in 
                                  voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat 
                                  non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                  </p>
                              </div>
                              <h5>Heading b</h5>
                              <div class="inner">
                                  <p>
                                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt 
                                  ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 
                                  laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in 
                                  voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat 
                                  non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                  </p>
                              </div>
                          </div>
                          <h4>3<sup>rd</sup></h4>
                          <div class="inner">
                              <p>
                              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt 
                              ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 
                              laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in 
                              voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat 
                              non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                              </p>
                              <p>
                              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt 
                              ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 
                              laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in 
                              voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat 
                              non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                              </p>
                          </div>
                    </div> 

 */        
        
        
    	// We open the buffer.
    	ob_start ();
    	?>
            <script type="text/javascript">
            //<![CDATA[
                $.fn.accordion.defaults.container = false; 
                $(function() {
                	$("#<?php echo $options['acc-id-box']?> ul:first").attr('id', '<?php echo $options['acc-id']?>');
                    $("#<?php echo $options['acc-id-box']?> ul:first").attr('class', 'accordion');
                    $("#<?php echo $options['acc-id']?>").accordion({
                      obj: "div", 
                      wrapper: "div", 
                      el: ".h", 
                      head: "h4, h5", 
                      next: "div", 
                      showMethod: "slideFadeDown",
                      hideMethod: "slideFadeUp",
                      initShow : "div.shown",
                      elToWrap: "sup, img"
                    });
                });
            //]]>
            </script>
        <?php 
        // We retrieve the contents of the buffer.
        $_content = ob_get_contents ();
        // We clean the buffer.
        ob_clean ();
        // We close the buffer.
        ob_end_flush ();
        
        return $_content;
    } 

    /**
     * Nested tree Lists
     * 
      * <code>
      *     {% initJquery 'ACCORDEON:nested' %}
      *     
      * 	{% if tree %}
      * 		<div id="side">
      * 		    {{ tree|raw }}
      * 		</div>
      * 	{% else %}
      * 		<div class="alert-message info"><p>There are no nodes in tree to display</p></div>
      * 	{% endif %}
      * 	
      * 	{% set options_nested = {'acc-id-box': 'side', 'acc-id': 'acc3', 'acc-type': "accordeonTree"} %}
      * 	{{ renderJquery('ACCORDEON', 'nested', options_nested )|raw }}	
      * <code/> 
      *  
     * @param    $options    tableau d'options.
     * @access protected
     * @return void
     *
     * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     */
    protected function accTreeAction($options = null)
    {
/*
  
                <ul id="acc3" class="accordion">
                    <li><a href="http://www.adipalaz.com/experiments/jquery/nested_accordion_demo.html#item1">Item 1</a>
                        <ul>
                            <li><a href="http://www.adipalaz.com/experiments/jquery/nested_accordion_demo.html#Sub11">Sub 1.1</a>
                                <ul>
                                    <li><a href="http://www.adipalaz.com/experiments/jquery/nested_accordion_demo.html#Sub111">Sub 1.1.1</a>
                                        <ul>
                                            <li><a href="http://www.adipalaz.com/experiments/jquery/nested_accordion_demo.html#link1">Link 1</a></li>
                                            <li><a href="http://www.adipalaz.com/experiments/jquery/nested_accordion_demo.html#link2">Link 2</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="http://www.adipalaz.com/experiments/jquery/nested_accordion_demo.html#Sub112">Sub 1.1.2</a>
                                        <ul>
                                            <li><a href="http://www.adipalaz.com/experiments/jquery/nested_accordion_demo.html#link3">Link 3</a></li>
                                            <li><a href="http://www.adipalaz.com/experiments/jquery/nested_accordion_demo.html#link4">Link 4</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="http://www.adipalaz.com/experiments/jquery/nested_accordion_demo.html#Sub12">Sub 1.2</a>
                                <ul>
                                    <li><a href="http://www.adipalaz.com/experiments/jquery/nested_accordion_demo.html#link5">Link 5</a></li>
                                    <li><a href="http://www.adipalaz.com/experiments/jquery/nested_accordion_demo.html#link6">Link 6</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>Item 2
                        <ul>
                            <li>Sub 2.1
                                <ul>
                                    <li><a href="http://www.adipalaz.com/experiments/jquery/nested_accordion_demo.html#link11">Link 11</a></li>
                                    <li><a href="http://www.adipalaz.com/experiments/jquery/nested_accordion_demo.html#link12">Link 12</a></li>
                                </ul>
                            </li>
                            <li>Sub 2.2
                                <ul>
                                    <li><a href="http://www.adipalaz.com/experiments/jquery/nested_accordion_demo.html#link13">Link 13</a></li>
                                </ul>

                            </li>
                            <li>Sub 2.3
                                <ul>
                                    <li><a href="http://www.adipalaz.com/experiments/jquery/nested_accordion_demo.html#link14">Link 14</a></li>
                                    <li><a href="http://www.adipalaz.com/experiments/jquery/nested_accordion_demo.html#link15">Link 15</a></li>
                                    <li><a href="http://www.adipalaz.com/experiments/jquery/nested_accordion_demo.html#link16">Link 16</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>Item 3
                        <ul>
                            <li><a href="http://www.adipalaz.com/experiments/jquery/nested_accordion_demo.html#link17">Link 17</a></li>
                            <li><a href="http://www.adipalaz.com/experiments/jquery/nested_accordion_demo.html#link18">Link 18</a></li>
                        </ul>
                    </li>
                    <li><a href="http://www.adipalaz.com/experiments/jquery/nested_accordion_demo.html#item4">Item 4</a></li>
                </ul>  
  
 */        
    	// We open the buffer.
    	ob_start ();
    	?>
            <script type="text/javascript">
            //<![CDATA[
                $.fn.accordion.defaults.container = false; 
                $(function() {
                	$("#<?php echo $options['acc-id-box']?> ul:first").attr('id', '<?php echo $options['acc-id']?>');
                    $("#<?php echo $options['acc-id-box']?> ul:first").attr('class', 'accordion');
                    $("#<?php echo $options['acc-id']?>").accordion({
                      initShow: "#current"
                    });
                });
            //]]>
            </script>
        <?php 
        // We retrieve the contents of the buffer.
        $_content = ob_get_contents ();
        // We clean the buffer.
        ob_clean ();
        // We close the buffer.
        ob_end_flush ();
        
        return $_content;
    }     
        
}