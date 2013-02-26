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
		
		
		$Urlpath_Moins 	= $this->container->get('templating.helper.assets')->getUrl('bundles/piappadmin/images/icons/tree/moins.png');
		$Urlpath_Plus 	= $this->container->get('templating.helper.assets')->getUrl('bundles/piappadmin/images/icons/tree/plus.png');

	    // We open the buffer.
	    ob_start ();		
		?>
		
			<div class="tinyoptions">
				<a href='javascript:accordeon_tab["0"].pr(1)'>Exand All</a> | <a href='javascript:accordeon_tab["0"].pr(-1)'>Collapse All</a>
			</div>
	
   	
			<script type="text/javascript">
			//<![CDATA[
			
				var accordeon_tab = [];
				//var array 		  = new Array();

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
										
					$("#tree h3.tree-node").click(function (){
						$(this).children('img').attr('src', choosImg);

						if( choosImg == plus)
							choosImg = moins;
						else
							choosImg = plus;						
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