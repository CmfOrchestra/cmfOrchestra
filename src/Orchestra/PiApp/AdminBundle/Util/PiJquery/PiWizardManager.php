<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Util
 * @package    Extension_jquery 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-02-29
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Util\PiJquery;

use Symfony\Component\DependencyInjection\ContainerInterface;

use PiApp\AdminBundle\Twig\Extension\PiJqueryExtension;
use PiApp\AdminBundle\Exception\ExtensionException;

/**
 * Wizard Wijmo plugin
 *
 * @category   Admin_Util
 * @package    Extension_jquery 
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiWizardManager extends PiJqueryExtension
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
	protected function init() {
		// css
		//$this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/css/themes/wijmo/jquery.wijmo.wijwizard.css", "prepend");
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/css/themes/wijmo/jquery.wijmo-complete.2.1.2.css", "prepend");

		// js
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/wijmo/external/jquery.wijmo-complete.all.2.1.2.min.js");
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/wijmo/external/jquery.wijmo-open.all.2.1.2.min.js");
		//$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/wijmo/minified/jquery.wijmo.wijwizard.min.js");
	}	
	
    /**
      * Set wizard onglet.
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
		if( !isset($options['wizard-urls']) || empty($options['wizard-urls']) || !is_array($options['wizard-urls']) )
			throw ExtensionException::optionValueNotSpecified('wizard-urls', __CLASS__);		
		
		$all_url 	= null;
		$all_title	= null;
		foreach($options['wizard-urls'] as $key => $infos){

			if(!isset($infos['title']) || empty($infos['title']))
				throw ExtensionException::optionValueNotSpecified('title', __CLASS__);
			if(!isset($infos['route_name']) || empty($infos['route_name']))
				throw ExtensionException::optionValueNotSpecified('route_name', __CLASS__);
			if(!isset($infos['params']) || empty($infos['params']))
				throw ExtensionException::optionValueNotSpecified('params', __CLASS__);
			
			$all_url[$key]		= $this->container->get('bootstrap.RouteTranslator.factory')->getRoute($infos['route_name'], $infos['params'] );
			$all_title[$key]	= $infos['title'];
		}

	    // We open the buffer.
	    ob_start ();		
		?>
			<div id="<?php echo $options['id']; ?>">
				<ul>
					<li data-id="0" >
						<h1><a style="color:#238BDB">»</a></h1>
						...
					</li>				
					<?php $p = 0 ; foreach($all_title as $key => $title){ $p++; ?>
					<li data-id="<?php echo $p; ?>" >
						<h1><?php echo $this->translator->trans($title); ?></h1>
						...
					</li>
					<?php } ?>
				</ul>
				<div>
					<p>
						<?php echo $this->translator->trans("pi.wizard.intro"); ?>
					</p>
				</div>
				<?php foreach($all_url as $key => $url){ ?>
					<div src="<?php echo $url; ?>"></div>
				<?php } ?>
			</div>
			<div id="pager" style="position:relative;width:100px;float:right"> 
            </div>
		
		
			<script id="scriptInit" type="text/javascript">
			//<![CDATA[
			
				$(document).ready(function () {
						var wizard_obj = $("#<?php echo $options['id']; ?>").wijwizard({
							navButtons: 'none',
							cache:false,
							showOption: {blind: false,fade: true,duration: 200},
							hideOption: {blind: false,fade: true,duration: 200},
						});		

						$("#pager").wijpager({ 
			                pageCount: $("#<?php echo $options['id']; ?>").wijwizard('count'), 
			                pageIndex: $("#<?php echo $options['id']; ?>").wijwizard('option', 'activeIndex'), 
			                mode: "nextPreviousFirstLast", 
			                pageIndexChanged: function () { 
			                    var pageIndex = $("#pager").wijpager("option", "pageIndex"); 
			                    $("#<?php echo $options['id']; ?>").wijwizard({ activeIndex: pageIndex }); 
			                } 
			            }); 		

						$("#pager").prependTo('#<?php echo $options['id']; ?>');

						$("#<?php echo $options['id']; ?> li").bind("click", function(){
							var id_target = $(this).data("id");
							var id_source = $("#<?php echo $options['id']; ?> li[aria-selected='true']").data("id");

							if(id_target > id_source){
								var steps = id_target - id_source;
								$(".ui-icon-seek-next").trigger("click");
							}
							if(id_target < id_source){
								var steps = id_target - id_source;
								$(".ui-icon-seek-prev").trigger("click");
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
}