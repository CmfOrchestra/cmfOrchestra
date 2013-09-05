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
class PiTinyAccordeonManager extends PiJqueryExtension
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
     * Sets init.
     *
     * @access protected
     * @return void
     *
     * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     */    
    protected function init($options = null) {
        // css
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/js/tiny_accordion/css/style.css");
        // js
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/tiny_accordion/js/script.js");
    }    
    
    /**
      * Set tiny accordeon with tiny lists .
      *
      * <code>
      *         // tree management
      *         $self = &$this;
      *         $self->category = $category;
      *         $self->NoLayout = $NoLayout;
      *         $self->translator = $this->container->get('translator');
      *         $options = array(
      *                 'decorate' => true,
      *                 'rootOpen' => "\n <div class='acc-section'><div class='acc-content'><ul class='acc'> \n",
      *                 'rootClose' => "\n </ul></div></div> \n",
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
      *                     $linkNode     = '<h3>'
      *                     . '<img src="'.$Urlpath0.'" height="21px" />&nbsp;&nbsp;&nbsp;' . str_replace('<br>', ' ', $tree->getTitle())
      *                     . '&nbsp;&nbsp;&nbsp; (node: ' .  $node['id'] . ', level : ' .  $node['lvl'] . ')'
      *                     . '</h3>';
      *                     
      *                     if ( ($node['lft'] == -1) && ($node['rgt'] == 0) )   $linkNode .= '<div class="acc-section"><div class="acc-content">';
      *                     if ( ($node['lft'] !== -1) && ($node['rgt'] !== 0) ) $linkNode .= '<div class="acc-section"><div class="acc-content">';
      *                     if ( ($node['lft'] == -1) && ($node['rgt'] !== 0) )  $linkNode .= '<div class="acc-section"><div class="acc-content">';
      *                                         
      *                     $linkAdd    = '<a href="#" class="tree-action" data-url="' . $self->generateUrl('admin_gedmo_menu_new', array("NoLayout" => true, 'category'=>$self->category, 'parent' => $node['id'])) . '" ><img src="'.$UrlpathAdd.'" title="'.$self->translator->trans('pi.add').'"  width="16" /></a>';
      *                     $linkEdit   = '<a href="#" class="tree-action" data-url="' . $self->generateUrl('admin_gedmo_menu_edit', array('id' => $node['id'], "NoLayout" => true)) . '" ><img src="'.$Urlpath1.'" title="'.$self->translator->trans('pi.edit').'"  width="16" /></a>';
      *                     $linkUp        = '<a href="' . $self->generateUrl('admin_gedmo_menu_move_up', array('id' => $node['id'], 'category'=>$self->category, 'NoLayout'=> $self->NoLayout)) . '"><img src="'.$Urlpath2.'" title="'.$self->translator->trans('pi.move-up').'" width="16" /></a>';
      *                     $linkDown     = '<a href="' . $self->generateUrl('admin_gedmo_menu_move_down', array('id' => $node['id'], 'category'=>$self->category, 'NoLayout'=> $self->NoLayout)) . '"><img src="'.$Urlpath3.'" title="'.$self->translator->trans('pi.move-down').'" width="16" /></a>';
      *                     $linkDelete    = '<a href="' . $self->generateUrl('admin_gedmo_menu_node_remove', array('id' => $node['id'], 'category'=>$self->category, 'NoLayout'=> $self->NoLayout)) . '"><img src="'.$Urlpath4.'" title="'.$self->translator->trans('pi.delete').'"  width="16" /></a>';
      *                     
      *                     $linkNode .= $linkAdd . '&nbsp;&nbsp;&nbsp;' . $linkEdit . '&nbsp;&nbsp;&nbsp;' . $linkUp . '&nbsp;&nbsp;&nbsp;' . $linkDown . '&nbsp;&nbsp;&nbsp;' . $linkDelete;
      * 
      *                     if ( ($node['lft'] == -1) && ($node['rgt'] == 0) )  $linkNode .= '</div></div>'; // if ( ($node['lft'] == -1) && ($node['rgt'] !== 0) )
      *                     if ( ($node['lft'] == -1) && ($node['rgt'] !== 0) ) $linkNode .= '</div></div>'; // if ( ($node['lft'] == -1) && ($node['rgt'] !== 0) )
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
      *     {% initJquery 'ACCORDEON:tiny' %}
      *     
      * 	{% if tree %}
      * 		<div id="tree">
      * 		    {{ tree|raw }}
      * 		</div>
      * 	{% else %}
      * 		<div class="alert-message info"><p>There are no nodes in tree to display</p></div>
      * 	{% endif %}
      * 	
      * 	{% set options_tiny = {'id': 'acc_'} %}
      * 	{{ renderJquery('ACCORDEON', 'tiny', options_tiny )|raw }}
      * <code/>
      *
      * @param    $options    tableau d'options.
      * @access protected
      * @return void
      *
      * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com> 
      */
    protected function render($options = null)
    {        

/* exemple code html
 
<ul class="acc" id="acc">
	<li>
		<h3>About</h3>
		<div class="acc-section">
			<div class="acc-content">
				<ul class="acc" id="nested">
					<li>
						<h3>Nested One</h3>
						<div class="acc-section">
							<div class="acc-content">
								Donec elementum lobortis lorem. Sed aliquet lacus vitae nibh. Sed ullamcorper pharetra augue. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
							</div>
						</div>
					</li>
					<li>
						<h3>Nested Two</h3>
						<div class="acc-section">
							<div class="acc-content">
								Vestibulum blandit mauris elementum mauris.
							</div>
						</div>
					</li>
					<li>
						<h3>Nested Three</h3>
						<div class="acc-section">
							<div class="acc-content">
								Morbi felis libero, porta non, sagittis ac, consectetur in, sem.
							</div>
						</div>
					</li>
				</ul>
				This lightweight (1.2 KB) JavaScript accordion can easily be customized to integrate with any website. For more information visit <a href="http://www.leigeber.com">leigeber.com</a>.
			</div>
		</div>
	</li><li>
		<h3>Instructions</h3>
		<div class="acc-section">
			<div class="acc-content">
				To initialize an accordion use the following code:<br /><br />
				<code>
					var accordion=new TINY.accordion.slider(&quot;accordion&quot;);<br />
					accordion.init(&quot;accordion&quot;,&quot;h3&quot;,false,0,&quot;selected&quot;);
				</code><br /><br />
				You must create a new accordion object before initialization. The parameter taken by accordion.slider is the variable name used for the object. The object.init function takes 5 parameters: the id of the accordion �ul�, the header element tag, whether the panels should be expandable independently (optional), the index of the initially expanded section (optional) and the class for the active header (optional).
			</div>
		</div>
	</li>
	<li>
		<h3>Licensing &amp; Support</h3>
		<div class="acc-section">
			<div class="acc-content">
				This script is provided as-is with no warranty or guarantee. It is available at no cost for any project, non-commercial or commercial. Paid support is available by <a href="http://www.leigeber.com/contact/">clicking here</a>
			</div>
		</div>
	</li>
</ul>
 
 
 */        
        
        // Options management
        if (!isset($options['id']) || empty($options['id'])) {
            throw ExtensionException::optionValueNotSpecified('id', __CLASS__);
        }
        if (!isset($options['menu']) || ($options['menu'] == false) ) {
        	$options['menu'] = false;
        }
        $Urlpath_Moins     = $this->container->get('templating.helper.assets')->getUrl('bundles/piappadmin/images/icons/tree/moins.png');
        $Urlpath_Plus     = $this->container->get('templating.helper.assets')->getUrl('bundles/piappadmin/images/icons/tree/plus.png');
        // We open the buffer.
        ob_start ();        
        ?>
            <?php if ($options['menu']): ?>
            <div class="tinyoptions">
                <a href='javascript:accordeon_tab["0"].pr(1)'>Exand All</a> | <a href='javascript:accordeon_tab["0"].pr(-1)'>Collapse All</a>
            </div>
            <?php endif; ?>
       
            <script type="text/javascript">
            //<![CDATA[
                var accordeon_tab = [];
                //var array           = new Array();
                $("#tree ul.acc").each(function(index) {
                        $(this).attr('id','acc_'+index);
                        accordeon_tab[index] = 'acc_'+index;
                });
                for (Val in accordeon_tab){ 
                    //var tinyy = new TINY.accordion.slider("acc_"+Val);
                    //console.log(array[Val]);
                    //array.push(tinyy);
                    //array[Val].init('acc_'+Val,"h3",0,0);
                    var id_name = accordeon_tab[Val];            
                    accordeon_tab[Val] = new TINY.accordion.slider("accordeon_tab["+Val+"]");
                    accordeon_tab[Val].init(id_name,"h3",0,0);
                }
                //var Accordion0=new TINY.accordion.slider("Accordion0");
                //Accordion0.init("acc_0","h3",0,0);
                //var Accordion1=new TINY.accordion.slider("Accordion1");
                //Accordion1.init("acc_1","h3",0,0);        
                jQuery(document).ready(function() {
                    // preload img
                    var moins = '<?php echo $Urlpath_Moins; ?>';
                    var plus  = '<?php echo $Urlpath_Plus; ?>';
                    var choosImg = moins;
                    
                    temp1 = new Image();
                    temp2 = new Image();
                    temp1.src = moins;
                    temp2.src = plus;

                  
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