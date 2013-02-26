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
class PiWizardFlowplayerManager extends PiJqueryExtension
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
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/flowplayer/jquery.tools.min.js");
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
						<h1>Intro</h1>
						Preload
					</li>				
					<?php $p = 0 ; foreach($all_title as $key => $title){ $p++; ?>
					<li data-id="<?php echo $p; ?>" >
						<h1><?php echo $this->translator->trans($title); ?></h1>
						Ajax
					</li>
					<?php } ?>
				</ul>
				<div>
					<p>
						All pages recorder
					</p>
				</div>
				<?php foreach($all_url as $key => $url){ ?>
					<div src="<?php echo $url; ?>"></div>
				<?php } ?>
			</div>
		
		
			<script id="scriptInit" type="text/javascript">
			//<![CDATA[
			
				$(document).ready(function () {
						var wizard_obj = $("#<?php echo $options['id']; ?>").wijwizard({
							cache:false,
							showOption: {blind: false,fade: true,duration: 200},
							hideOption: {blind: false,fade: true,duration: 200},
						});

						$(".wijmo-wijwizard-buttons").prependTo('#<?php echo $options['id']; ?>');

						$("#<?php echo $options['id']; ?> li").bind("click", function(){
							var id_target = $(this).data("id");
							var id_source = $("#<?php echo $options['id']; ?> li[aria-selected='true']").data("id");
							
							if(id_target > id_source){
								var steps = id_target - id_source;
								$(".wijmo-wijwizard-buttons a:last-child").trigger("click");
							}
							if(id_target < id_source){
								var steps = id_target - id_source;
								$(".wijmo-wijwizard-buttons a:first-child").trigger("click");
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