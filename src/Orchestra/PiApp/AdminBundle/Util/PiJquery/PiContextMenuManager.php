<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Util
 * @package    Extension_jquery 
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-02-29
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Util\PiJquery;

use Symfony\Component\DependencyInjection\ContainerInterface;

use PiApp\AdminBundle\Twig\Extension\PiJqueryExtension;
use PiApp\AdminBundle\Exception\ExtensionException;
use PiApp\AdminBundle\Entity\Page;
use PiApp\AdminBundle\Entity\TranslationPage;


/**
 * Active the context menu of the admin.
 *
 * @category   Admin_Util
 * @package    Extension_jquery 
 * 
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class PiContextMenuManager extends PiJqueryExtension
{
	/**
	 * @var array
	 * @static
	 */
	static $thems = array('xp', 'default', 'vista', 'osx', 'human', 'gloss', 'gloss,gloss-cyan', 'gloss,gloss-semitransparent', 'pi', 'pi2');
	
	/**
	 * @var array
	 * @static
	 */	
	static $menus = array('exemple', 'admin');
		
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
	protected function init() 
	{
		// css
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/js/contextmenu/css/blockpage.css");
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/js/contextmenu/css/contextmenu.css");
		
		// js
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/contextmenu/js/jquery.contextmenu.js");
	}	
	
    /**
      * Set progress text for Progress flash dialog.
      *
      * @param	$options	tableau d'options.
      * @access protected
      * @return void
      *
      * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com> 
      */
	protected function render($options = null)
	{        
		// Options management
		if(!isset($options['id']) || empty($options['id']))
			throw ExtensionException::optionValueNotSpecified('id', __CLASS__);
		if(!isset($options['menu']) || empty($options['menu']) || (isset($options['menu']) && !in_array($options['menu'], self::$menus)) )
			throw ExtensionException::optionValueNotSpecified('id', __CLASS__);		
		if(!isset($options['them']) || empty($options['them']) || (isset($options['them']) && !in_array($options['them'], self::$thems)) )
			$options['them'] = 'human';
		
		$method = strtolower($options['menu']) . "Menu";
		
		if(method_exists($this, $method))
			$var_menu = $this->$method();
		else
			throw ExtensionException::MethodUnDefined($method);		
		
	    // We open the buffer.
	    ob_start ();		
		?>
			<script type="text/javascript">
			//<![CDATA[
		        jQuery(document).ready(function() {

		        	var id	  = "<?php echo $options['id']; ?>";
		        	var menu  = <?php echo $var_menu; ?>;

		        	$(id).contextMenu(menu,{

						<?php if(isset($options['theme']) && !empty($options['theme'])){ ?>
						theme: '<?php echo $options['theme']; ?>',
				    	<?php }else{ ?>	
				    	theme:'human',
				    	<?php } ?>				        	
				    	
						<?php if(isset($options['options']['shadow']) && !empty($options['options']['shadow'])){ ?>
						shadow:<?php echo $options['options']['shadow']; ?>,
				    	<?php } ?>
						<?php if(isset($options['options']['shadowOpacity']) && !empty($options['options']['shadowOpacity'])){ ?>
						shadowOpacity:<?php echo $options['options']['shadowOpacity']; ?>,
				    	<?php } ?>
						<?php if(isset($options['options']['shadowColor']) && !empty($options['options']['shadowColor'])){ ?>
				    	shadowColor:'<?php echo $options['options']['shadowColor']; ?>',
				    	<?php } ?>
						<?php if(isset($options['options']['shadowOffset']) && !empty($options['options']['shadowOffset'])){ ?>
						shadowOffset: <?php echo $options['options']['shadowOffset']; ?>,
				    	<?php } ?>
						<?php if(isset($options['options']['shadowWidthAdjust']) && !empty($options['options']['shadowWidthAdjust'])){ ?>
						shadowWidthAdjust: <?php echo $options['options']['shadowWidthAdjust']; ?>,
				    	<?php } ?>
						<?php if(isset($options['options']['shadowHeightAdjust']) && !empty($options['options']['shadowHeightAdjust'])){ ?>
						shadowHeightAdjust: <?php echo $options['options']['shadowHeightAdjust']; ?>,
				    	<?php } ?>
						<?php if(isset($options['options']['shadowOffsetX']) && !empty($options['options']['shadowOffsetX'])){ ?>
						shadowOffsetX: <?php echo $options['options']['shadowOffsetX']; ?>,
				    	<?php } ?>
						<?php if(isset($options['options']['shadowOffsetY']) && !empty($options['options']['shadowOffsetY'])){ ?>
						shadowOffsetY: <?php echo $options['options']['shadowOffsetY']; ?>,
				    	<?php } ?>

				    	<?php if(isset($options['options']['direction']) && !empty($options['options']['direction'])){  // {'up', 'down'} ?>
						direction: '<?php echo $options['options']['direction']; ?>',
				    	<?php } ?>
						<?php if(isset($options['options']['offsetX']) && !empty($options['options']['offsetX'])){ ?>
						offsetX: <?php echo $options['options']['offsetX']; ?>,
				    	<?php } ?>
						<?php if(isset($options['options']['offsetY']) && !empty($options['options']['offsetY'])){ ?>
						offsetY: <?php echo $options['options']['offsetY']; ?>,
				    	<?php } ?>				    	
				    	
						<?php if(isset($options['options']['showSpeed']) && !empty($options['options']['showSpeed'])){ ?>
						showSpeed: <?php echo $options['options']['showSpeed']; ?>,
				    	<?php }else{ ?>	
				    	showSpeed:1000,
				    	<?php } ?>	
						<?php if(isset($options['options']['hideSpeed']) && !empty($options['options']['hideSpeed'])){ ?>
						hideSpeed: <?php echo $options['options']['hideSpeed']; ?>,
				    	<?php }else{ ?>	
				    	hideSpeed:1000,
				    	<?php } ?>	

						<?php if(isset($options['options']['showTransition']) && !empty($options['options']['showTransition'])){ ?>
						showTransition: '<?php echo $options['options']['showTransition']; ?>',
				    	<?php }else{ ?>	
				    	showTransition:'fadeIn',
				    	<?php } ?>		
						<?php if(isset($options['options']['hideTransition']) && !empty($options['options']['hideTransition'])){ ?>
						hideTransition: '<?php echo $options['options']['hideTransition']; ?>',
				    	<?php }else{ ?>	
				    	hideTransition:'fadeOut',
				    	<?php } ?>					    			    				    	

					    showCallback:function() {
							<?php
							if(isset($options['options']['showCallback']) && !empty($options['options']['showCallback']))
					    		echo $options['options']['showCallback'];
					    	?>
						},
					    hideCallback:function() {
							<?php
							if(isset($options['options']['hideCallback']) && !empty($options['options']['hideCallback']))
									echo $options['options']['hideCallback'];
					    	?>
						},
					    beforeShow:function() {
							<?php
							if(isset($options['options']['beforeShow']) && !empty($options['options']['beforeShow']))
									echo $options['options']['beforeShow'];
							?>
						},			    
					});

		        	// add the left click mouse for tablette.
			        $(id).click(function(e){
				        var element = e.target;
			            var evt 	= element.ownerDocument.createEvent('MouseEvents');
			            var RIGHT_CLICK_BUTTON_CODE = 2; // the same for FF and IE

			            evt.initMouseEvent('contextmenu', true, true,
			                 element.ownerDocument.defaultView, 1, e.screenX, e.screenY, e.clientX, e.clientY, false,
			                 false, false, false, RIGHT_CLICK_BUTTON_CODE, null);

			            if (document.createEventObject){
			                // dispatch for IE
			               return element.fireEvent('onclick', evt)
			             }
			            else{
			               // dispatch for firefox + others
			              return element.dispatchEvent(evt);
			            }
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
	 * Define admin context menu.
	 *
	 * @param	array $options
	 * @access public
	 * @return void
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 */
	public function adminMenu()
	{
		// We open the buffer.
		ob_start ();
		?>
			[
		    	{ "<?php echo $this->translator->trans('pi.contextmenu.go_homepage'); ?>": 
		    		{
				    	onclick:function() {
				    			window.location.href= "<?php echo $this->container->get('router')->generate('home_page') ?>"; 
				    	},
				    	icon:'<?php echo $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/images/icons/contextmenu/rotation-16.png"); ?>'
		    		}
		    	},
		    	{ "<?php echo $this->translator->trans('pi.contextmenu.go_admin'); ?>":
		    		{
				    	onclick:function() {
				    			window.location.href= "<?php echo $this->container->get('router')->generate('admin_homepage') ?>"; 
				    	},
				    	icon:'<?php echo $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/images/icons/contextmenu/rotation-16-inverse.png"); ?>'
		    		}
		    	},
		    	$.contextMenu.separator,
		    	{ '<span class="org-chart-page"><?php echo $this->translator->trans('pi.contextmenu.page.organigram'); ?></span>':  
					{
				    	onclick:function() {
				    	},
				    	icon:'<?php echo $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/images/icons/contextmenu/organigramme-16.png"); ?>'
		    		}
		    	},
		    	{ '<span class="org-tree-page" ><?php echo $this->translator->trans('pi.contextmenu.page.tree'); ?></span>':  
					{
				    	onclick:function() {
				    	},
				    	icon:'<?php echo $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/images/icons/contextmenu/tree-16.png"); ?>'
		    		}
		    	},
		    	$.contextMenu.separator,
		    	{ '<?php echo $this->translator->trans('pi.contextmenu.page.refresh'); ?>': 
					{
				    	onclick:function() {
				   			window.location.href= "<?php echo $this->container->get('router')->generate('public_refresh_page') ?>"; 
				    	},
				    	icon:'<?php echo $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/images/icons/contextmenu/maj-16.png"); ?>'
		    		}
		    	},		    	
		    	{ '<span class="veneer_blocks_widgets" ><?php echo $this->translator->trans('pi.contextmenu.page.structure'); ?></span>': 
					{
				    	onclick:function() {
				    	},
				    	icon:'<?php echo $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/images/icons/contextmenu/block-16.png"); ?>'
		    		}
		    	},
		    	{ '<span class="page_action_new" ><?php echo $this->translator->trans('pi.contextmenu.page.add'); ?></span>': 
					{
				    	onclick:function() {
				    	},
				    	icon:'<?php echo $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/images/icons/contextmenu/add-page-16.png"); ?>'
		    		}
		    	},
		    	{ '<span class="page_action_edit" ><?php echo $this->translator->trans('pi.contextmenu.page.update'); ?></span>': 
					{
				    	onclick:function() {
				    	},
				    	icon:'<?php echo $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/images/icons/contextmenu/update-page-16.png"); ?>'
		    		}
		    	},	
		    	$.contextMenu.separator,
		    	{ '<span class="page_action_archivage" ><?php echo $this->translator->trans('pi.contextmenu.page.indexation'); ?></span>': 
					{
				    	onclick:function() {
				    	},
				    	icon:'<?php echo $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/images/icons/contextmenu/archivage-16.png"); ?>'
		    		}
		    	},	
		    	{ '<span class="page_action_desarchivage" ><?php echo $this->translator->trans('pi.contextmenu.page.desindexation'); ?></span>': 
					{
				    	onclick:function() {
				    	},
				    	icon:'<?php echo $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/images/icons/contextmenu/desarchivage-16.png"); ?>'
		    		}
		    	},	
		    	$.contextMenu.separator,
		    	{ '<span class="img_action_viewer" ><?php echo $this->translator->trans('pi.contextmenu.image.view'); ?></span>': 
					{
				    	onclick:function() {
				    	},
				    	icon:'<?php echo $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/images/icons/contextmenu/viewer-16.gif"); ?>'
		    		}
		    	},		    	
		    	$.contextMenu.separator,
		    	{ '<?php echo $this->translator->trans('pi.contextmenu.disconnection'); ?>': 
		    		{
				    	onclick:function() {
				    			window.location.href= "<?php echo $this->container->get('router')->generate('fos_user_security_logout') ?>"; 
				    	},
				    	icon:'<?php echo $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/images/icons/contextmenu/quitter-16.png"); ?>'
		    		}
		    	}
		    ]
		    
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
	 * Define admin context menu.
	 *
	 * @param	array $options
	 * @access public
	 * @return void
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 */
	public function exempleMenu()
	{
		// We open the buffer.
		ob_start ();
		?>
		
			[
				{ 'Show an alert': function() { alert('This is an alert!'); } },
				{ 'Turn me red (try it)': function() { this.style.backgroundColor='red'; } },
				{ '<b>HTML</b> <i>can be</i> <u>used in</u> <span style="background-color:white">options</span>': function() { } },
				$.contextMenu.separator,
				{ 'Just above me was a separator!':function(){} },
				{ 'Option with icon (for themes that support it)':
					{
						onclick:function(){},
						icon:'i_save.gif'
					}
				},
				{'Disabled option':
					{
						onclick:function(){},
						disabled:true
					}
				},
				{'<div><div style="float:left;">Choose a color (don\'t close):</div><div class="swatch" style="background-color:red"></div><div class="swatch" style="background-color:green"></div><div class="swatch" style="background-color:blue"></div><div class="swatch" style="background-color:yellow"></div><div class="swatch" style="background-color:black"></div></div><br>':
					function(menuItem,cmenu,e) {
						$t = $(e.target);
						if ($t.is('.swatch')) {
							this.style.backgroundColor = $t.css('backgroundColor');
							$t.parent().find('.swatch').removeClass('swatch-selected');
							$t.addClass('swatch-selected');
						}
						return false;
					}
				},
				{'Use fadeOut for hide transition':function(menuItem,cmenu) { cmenu.hideTransition='fadeOut'; cmenu.hideSpeed='fast'; } },
				{'Use slideUp for hide transition (quirky in IE)':function(menuItem,cmenu) { cmenu.hideTransition='slideUp'; } },
				{'Use normal hide transition':function(menuItem,cmenu) { cmenu.hideTransition='hide'; } },
				{'Increments each time menu is displayed using beforeShow hook: #<span class="option-count">1</span>': function() { } },
				{'Custom menu item class and hover class for this item only':
					{
						onclick:function() { },
						className:'context-menu-item-custom',
						hoverClassName:'context-menu-item-custom-hover'
					}
				},
				{'Custom Hover Functions':{
	  					hoverItem:function(c) { $(this).addClass(c).find('div').html('You just hovered over me!'); },
	  					hoverItemOut:function(c) { $(this).removeClass(c).find('div').html('Sorry to see you go!'); }
					}
  				}				
			]
	
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