<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Util
 * @package    Extension_jquery 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-27
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Util\PiJquery;

use Symfony\Component\DependencyInjection\ContainerInterface;

use PiApp\AdminBundle\Twig\Extension\PiJqueryExtension;
use PiApp\AdminBundle\Exception\ExtensionException;

/**
 * Simple Grid Jquery plugin
 *
 * @category   Admin_Util
 * @package    Extension_jquery 
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiGridSimpleManager extends PiJqueryExtension
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
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile('bundles/piappadmin/css/themes/rocket/jquery-wijmo.css');
		
		// js
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/wijmo/minified/jquery.wijmo.wijtooltip.min.js");
		
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/ui/ui.checkbox.js");
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/jquery/jquery.usermode.js");
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/jquery/jquery.ui.widget.js");
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
		if(!isset($options['grid-name']) || empty($options['grid-name']))
			throw ExtensionException::optionValueNotSpecified('grid-name', __CLASS__);

	    // We open the buffer.
	    ob_start ();		
		?>
			<script type="text/javascript">
			//<![CDATA[
			
				$(document).ready(function() {
					$('<?php echo $options['grid-name']; ?> > thead tr:first').prepend('<th id="checkbox-menu" ><a id="toggle-all" ><span>Toggle</span></a><a id="check-all" ><span>Check</span></a><a id="uncheck-all" ><span>Uncheck</span></a></th>');
					$('<?php echo $options['grid-name']; ?> > tbody tr').prepend('<td><input  type="checkbox" /></td>');
					$('<?php echo $options['grid-name']; ?> > tbody tr td:last-child').addClass('options-width');
					
					$('<?php echo $options['grid-name']; ?> > thead tr:first th').addClass('table-header-repeat line-left');
					$('<?php echo $options['grid-name']; ?> > thead tr:first th:first').removeClass().addClass('table-header-check');
					$('<?php echo $options['grid-name']; ?> > thead tr:last th:last').removeClass().addClass('table-header-options line-left');
					

					$("input[type='checkbox']").checkBox();
					$("button[type='submit']").button();
					
					<!-- toggle all -->
			    	$('#toggle-all').click(function(){
						$('input[type=checkbox]').checkBox('toggle');
						return false;
					});		
					
			    	<!-- check all -->
			    	$('#check-all').click(function(){
			    		$('input[type=checkbox]').checkBox('changeCheckStatus', true);
			    		return false;
			    	});
			    	
			    	<!-- uncheck all -->
			    	$('#uncheck-all').click(function(){
			    		$('input[type=checkbox]').checkBox('changeCheckStatus', false);
			    		return false;
			    	});

			    	$("a.info-tooltip").wijtooltip();	        
			        
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