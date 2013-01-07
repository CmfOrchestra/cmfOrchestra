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
 * Backstretch Jquery plugin
 *
 * @category   Admin_Util
 * @package    Extension_jquery 
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiLanguageChoiceManager extends PiJqueryExtension
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
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/js/languagechoice/css/languagechoice.css");
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
		if(!isset($options['class']) || empty($options['class']))
			throw ExtensionException::optionValueNotSpecified('class', __CLASS__);
		if(!isset($options['img-arrow']) || empty($options['img-arrow']))
			throw ExtensionException::optionValueNotSpecified('img-arrow', __CLASS__);
		
		
		$em 		= $this->container->get('doctrine')->getEntityManager();
		$locale		= $this->container->get('session')->getLocale();
		$entities 	= $em->getRepository("PiAppAdminBundle:Langue")->getAllEnabled($locale, 'object', false);	

		// if the file doesn't exist, we call an exception
		$img = "bundles/piappadmin/images/arrow/".$options['img-arrow'];
		$is_file_exist = realpath($this->container->get('kernel')->getRootDir(). '/../web/' . $img);
		if(!$is_file_exist)
			throw ExtensionException::FileUnDefined('img', __CLASS__);
		
		$Urlpath = $this->container->get('templating.helper.assets')->getUrl($img);		

	    // We open the buffer.
	    ob_start ();		
		?>		
				<div class="<?php echo $options['class']; ?>" id="language_menu" style="background:#238BDB url('<?php echo $Urlpath; ?>') no-repeat 95% 10px;">
					<div id="selected_language">
						<?php echo locale_get_display_name(strtolower($locale), strtolower($locale)); ?>
					</div>
					<ul>
						<!-- <li id="selected_language"><?php echo locale_get_display_name(strtolower($locale), strtolower($locale)); ?></li> -->
						<?php foreach($entities as $key=>$entity){ 
				            $url = $this->container->get('router')->generate('pi_layout_choisir_langue', array('langue' => $entity->getId()));
				            if($entity->getId() != $locale){
							
							$name_language = locale_get_display_name(strtolower($entity->getId()), strtolower($locale));
				        ?>
						<li>
							<a href="<?php echo $url; ?>"  id="lang_select_<?php echo $entity->getId(); ?>" title="<?php echo $name_language; ?>"><?php echo $name_language; ?></a>
						</li>
						<?php } } ?>
					</ul>
					<!-- <span id="language_menu_scroll" style="background:url('<?php echo $Urlpath; ?>') no-repeat left center;"></span> -->
				</div>						
		
				<script type="text/javascript">
				//<![CDATA[			
				$("#selected_language").bind("click", function(){
                    $(this).next('ul').toggle();	//.slideToggle();
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