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
 * Simple form Jquery plugin
 *
 * @category   Admin_Util
 * @package    Extension_jquery 
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiFormSimpleManager extends PiJqueryExtension
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
		
		// radio and checkbox management
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/css/themes/wijmo/jquery.wijmo.wijsuperpanel.css");
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/css/themes/wijmo/jquery.wijmo.wijradio.css");
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/css/themes/wijmo/jquery.wijmo.wijcheckbox.css");
		
		// tabs management
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/css/themes/wijmo/jquery.wijmo.wijdialog.css");
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/css/themes/wijmo/jquery.wijmo.wijtabs.css");

		// simple and multiselect management
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/js/jquery/multiselect/css/jquery.multiselect.filter.css");
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/js/jquery/multiselect/css/jquery.multiselect.css");
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/jquery/multiselect/js/jquery.multiselect.filter.min.js");
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/jquery/multiselect/js/jquery.multiselect.min.js");
		
		// multi-select chained management
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/jquery/jquery.chained.remote.js");
		
		// dates management
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/css/themes/wijmo/jquery.wijmo.wijinput.css");
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/wijmo/minified/jquery.wijmo.wijinputdate.min.js");
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/wijmo/minified/jquery.wijmo.wijinputcore.min.js");
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/wijmo/minified/jquery.plugin.wijtextselection.min.js");
		
		// editor management
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/tiny_mce/jquery.tinymce.js");
		
		// main
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/css/themes/wijmo/jquery.wijmo-open.2.1.2.css");
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/wijmo/external/cultures/globalize.cultures.js");
		//$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/wijmo/external/jquery.mousewheel.min.js");
		//$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/wijmo/external/jquery.wijmo-open.all.2.1.2.min.js");
		
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile('bundles/piappadmin/css/form/form.css');
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile('bundles/piappadmin/css/themes/rocket/jquery-wijmo.css');
		
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
		// Option management
		if(!isset($options['form-name']) || empty($options['form-name']))
			throw ExtensionException::optionValueNotSpecified('form-name', __CLASS__);
		
		$url_css  = '/css/layout.css';
		$url_base = 'http://'. $this->container->get('Request')->getHttpHost() . $this->container->get('Request')->getBasePath() . "/bundles/piappadmin/js/tiny_mce";		

	    // We open the buffer.
	    ob_start ();		
		?>
			<script type="text/javascript">
			//<![CDATA[
			
				// we create the animations.
				var j_prototype = new function()
				{
			        this.ftc_tinymce_editor = function(idObj){
			        	idObj.tinymce({
							// Location of TinyMCE script
							script_url : '<?php echo $url_base ?>/tiny_mce.js',
							// General options
							theme : "advanced",
							language : "<?php echo strtolower(current(explode("_", $this->locale))); ?>",
							plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
							/*SBLA 20130211*/
							extended_valid_elements : "-p",
							// forced_root_block : false, 		// Needed for 3.x
							// forced_root_block : '',
							// force_br_newlines : true,
							// force_p_newlines : false,
							convert_fonts_to_spans : true,
							font_size_classes : "tt-10,tt-9,tt-8,tt-7,tt-6,tt-4,tt-2",
							// don't replace encoding character like : Ã© to &eacutes;
							entity_encoding : "raw",
							// Theme options
							theme_advanced_buttons1 : "fullscreen,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,styleselect,fontselect,fontsizeselect",
							theme_advanced_buttons2 : "code,cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,image,anchor,cleanup,help,|,insertdate,inserttime,preview,|,forecolor,backcolor",
							theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl",
							theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
							theme_advanced_toolbar_location : "top",
							theme_advanced_toolbar_align : "left",
							theme_advanced_statusbar_location : "bottom",
							theme_advanced_resizing : true,
							// Exemple content CSS (should be your site CSS)
							content_css : "<?php echo $url_css ?>",
							// Style formats for 'styleselect'
							style_formats : [
								{title : 'Liste point rose', selector : 'ul', classes : 'roseDisc'},
								{title : 'Titre 1', block : 'h3', classes : 'tt-1'},
								{title : 'Titre 2', block : 'h3', classes : 'tt-2'},
								{title : 'Titre 3', block : 'h3', classes : 'tt-3'},
								{title : 'Titre 4', block : 'h4', classes : 'tt-4'},
								{title : 'Titre 5', block : 'h4', classes : 'tt-red'},
								{title : 'Titre 6', block : 'h4', classes : 'tt-purple'}
							],
							formats : {
								alignleft : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'txtleft'},
								aligncenter : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'txtcenter'},
								alignright : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'txtright'},
								alignfull : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'txtjustify'},
								bold : {inline : 'span', 'classes' : 'bold'},
								italic : {inline : 'span', 'classes' : 'italic'},
								underline : {inline : 'span', 'classes' : 'underline', exact : true},
								strikethrough : {inline : 'del'}
							},
							// Drop lists for link/image/media/template dialogs
							template_external_list_url : "<?php echo $url_base ?>/plugins/lists/template_list.js",
							external_link_list_url : "<?php echo $url_base ?>/plugins/lists/link_list.js",
							external_image_list_url : "<?php echo $url_base ?>/plugins/lists/image_list.js",
							media_external_list_url : "<?php echo $url_base ?>/plugins/lists/media_list.js",
							// count without the lenght of html balise
							setup : function(ed) {
                                ed.onKeyUp.add(function(ed, e) {
                                    var strip = (tinymce.activeEditor.getContent()).replace(/(<([^>]+)>)/ig,"").replace(/&[a-z]+;/ig, "");
                                    var text = strip.split(' ').length + " Mots, " +  (10000 - strip.length) + " Caractères "
                                    tinymce.DOM.setHTML(tinymce.DOM.get(tinymce.activeEditor.id + '_path_row'), text);

                                    // limit the lenght of written
                                    //if (strip.length > ("<?php if($this->container->get('Request')->get('_route')== 'gedmo_admin_social_edit'){ ?>"+245+"<?php }else{ ?>"+475+"<?php } ?>")) {
                                    //      strip = strip.substring(0,("<?php if($this->container->get('Request')->get('_route')== 'gedmo_admin_social_edit'){ ?>"+245+"<?php }else{ ?>"+475+"<?php } ?>"));
                                    //      tinymce.execCommand('mceSetContent',false,strip);
                                    //}
                                });
                            }
						});
				    };	

				    this.ftc_tinymce_editor_simple = function(idObj){
			        	idObj.tinymce({
							// Location of TinyMCE script
							script_url : '<?php echo $url_base ?>/tiny_mce.js',
							// General options
							theme : "advanced",
							language : "<?php echo strtolower(current(explode("_", $this->locale))); ?>",
							plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
							/*SBLA 20130211*/
							extended_valid_elements : "-p",
							convert_fonts_to_spans : true,
							font_size_classes : "tt-10,tt-9,tt-8,tt-7,tt-6,tt-4,tt-2",
							// don't replace encoding character like : Ã© to &eacutes;
							entity_encoding : "raw",							
							// Theme options
							theme_advanced_buttons1 : "fullscreen,bold,italic,underline,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,hr,sub,sup,forecolor,backcolor",
							theme_advanced_buttons2 : "removeformat,formatselect,styleselect,fontsizeselect,visualchars,outdent,indent,undo,redo",
							theme_advanced_buttons3 : "code,link,unlink,search,replace,tablecontrols",
							theme_advanced_buttons4 : "visualaid,insertdate,inserttime,anchor,blockquote,charmap,iespell,advhr,nonbreaking,|,insertlayer,moveforward,movebackward,absolute,|,styleprops,|acronym,del,ins,attribs,image,media",
							theme_advanced_toolbar_location : "top",
							theme_advanced_toolbar_align : "left",
							theme_advanced_statusbar_location : "bottom",
							theme_advanced_resizing : true,
							// Exemple content CSS (should be your site CSS)
							content_css : "<?php echo $url_css ?>",
							// Style formats for 'styleselect'
							style_formats : [
								{title : 'Liste point rose', selector : 'ul', classes : 'roseDisc'},
								{title : 'Titre 1', block : 'h3', classes : 'tt-1'},
								{title : 'Titre 2', block : 'h3', classes : 'tt-2'},
								{title : 'Titre 3', block : 'h3', classes : 'tt-3'},
								{title : 'Titre 4', block : 'h4', classes : 'tt-4'},
								{title : 'Titre 5', block : 'h4', classes : 'tt-red'},
								{title : 'Titre 6', block : 'h4', classes : 'tt-purple'}
							],
							formats : {
								alignleft : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'txtleft'},
								aligncenter : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'txtcenter'},
								alignright : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'txtright'},
								alignfull : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'txtjustify'},
								bold : {inline : 'span', 'classes' : 'bold'},
								italic : {inline : 'span', 'classes' : 'italic'},
								underline : {inline : 'span', 'classes' : 'underline', exact : true},
								strikethrough : {inline : 'del'}
							},
							// Drop lists for link/image/media/template dialogs
							template_external_list_url : "<?php echo $url_base ?>/plugins/template_list.js",
							external_link_list_url : "<?php echo $url_base ?>/plugins/lists/link_list.js",
							external_image_list_url : "<?php echo $url_base ?>/plugins/lists/image_list.js",
							media_external_list_url : "<?php echo $url_base ?>/plugins/lists/media_list.js",
							// count without the lenght of html balise
							setup : function(ed) {
                                ed.onKeyUp.add(function(ed, e) {
                                    var strip = (tinymce.activeEditor.getContent()).replace(/(<([^>]+)>)/ig,"").replace(/&[a-z]+;/ig, "");
                                    var text = strip.split(' ').length + " Mots, " +  (10000 - strip.length) + " Caractères "
                                    tinymce.DOM.setHTML(tinymce.DOM.get(tinymce.activeEditor.id + '_path_row'), text);

                                    // limit the lenght of written
                                    //if (strip.length > ("<?php if($this->container->get('Request')->get('_route')== 'gedmo_admin_social_edit'){ ?>"+245+"<?php }else{ ?>"+475+"<?php } ?>")) {
                                    //      strip = strip.substring(0,("<?php if($this->container->get('Request')->get('_route')== 'gedmo_admin_social_edit'){ ?>"+245+"<?php }else{ ?>"+475+"<?php } ?>"));
                                    //      tinymce.execCommand('mceSetContent',false,strip);
                                    //}
                                });
                            }
						});
				    };		

				    this.ftc_tinymce_editor_simple_easy = function(idObj){
			        	idObj.tinymce({
							// Location of TinyMCE script
							script_url : '<?php echo $url_base ?>/tiny_mce.js',
							// General options
							theme : "advanced",
							language : "<?php echo strtolower(current(explode("_", $this->locale))); ?>",
							plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
							/*SBLA 20130211*/
							extended_valid_elements : "-p",
							convert_fonts_to_spans : true,
							font_size_classes : "tt-10,tt-9,tt-8,tt-7,tt-6,tt-4,tt-2",
							// don't replace encoding character like : Ã© to &eacutes;
							entity_encoding : "raw",							
							// Theme options
							theme_advanced_buttons1 : "fullscreen,bold,italic,underline,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,forecolor,backcolor",
							theme_advanced_buttons2 : "removeformat,formatselect,styleselect,fontsizeselect,outdent,indent,undo,redo",
							theme_advanced_buttons3 : "code,link,unlink,search,replace,insertdate,inserttime,blockquote,charmap,image,media",
							theme_advanced_toolbar_location : "top",
							theme_advanced_toolbar_align : "left",
							theme_advanced_statusbar_location : "bottom",
							theme_advanced_resizing : true,
							// Exemple content CSS (should be your site CSS)
							content_css : "<?php echo $url_css ?>",
							// Style formats for 'styleselect'
							style_formats : [
								{title : 'Liste point rose', selector : 'ul', classes : 'roseDisc'},
								{title : 'Titre 1', block : 'h3', classes : 'tt-1'},
								{title : 'Titre 2', block : 'h3', classes : 'tt-2'},
								{title : 'Titre 3', block : 'h3', classes : 'tt-3'},
								{title : 'Titre 4', block : 'h4', classes : 'tt-4'},
								{title : 'Titre 5', block : 'h4', classes : 'tt-red'},
								{title : 'Titre 6', block : 'h4', classes : 'tt-purple'}
							],
							formats : {
								alignleft : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'txtleft'},
								aligncenter : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'txtcenter'},
								alignright : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'txtright'},
								alignfull : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'txtjustify'},
								bold : {inline : 'span', 'classes' : 'bold'},
								italic : {inline : 'span', 'classes' : 'italic'},
								underline : {inline : 'span', 'classes' : 'underline', exact : true},
								strikethrough : {inline : 'del'}
							},
							// Drop lists for link/image/media/template dialogs
							template_external_list_url : "<?php echo $url_base ?>/plugins/template_list.js",
							external_link_list_url : "<?php echo $url_base ?>/plugins/lists/link_list.js",
							external_image_list_url : "<?php echo $url_base ?>/plugins/lists/image_list.js",
							media_external_list_url : "<?php echo $url_base ?>/plugins/lists/media_list.js",
							// count without the lenght of html balise
							setup : function(ed) {
                                ed.onKeyUp.add(function(ed, e) {
                                    var strip = (tinymce.activeEditor.getContent()).replace(/(<([^>]+)>)/ig,"").replace(/&[a-z]+;/ig, "");
                                    var text = strip.split(' ').length + " Mots, " +  (10000 - strip.length) + " Caractères "
                                    tinymce.DOM.setHTML(tinymce.DOM.get(tinymce.activeEditor.id + '_path_row'), text);

                                    // limit the lenght of written
                                    //if (strip.length > ("<?php if($this->container->get('Request')->get('_route')== 'gedmo_admin_social_edit'){ ?>"+245+"<?php }else{ ?>"+475+"<?php } ?>")) {
                                    //      strip = strip.substring(0,("<?php if($this->container->get('Request')->get('_route')== 'gedmo_admin_social_edit'){ ?>"+245+"<?php }else{ ?>"+475+"<?php } ?>"));
                                    //      tinymce.execCommand('mceSetContent',false,strip);
                                    //}
                                });
                            }
						});
				    };					    

				    this.ftc_tinymce_editor_easy = function(idObj){
			        	idObj.tinymce({
							// Location of TinyMCE script
							script_url : '<?php echo $url_base ?>/tiny_mce.js',
							// General options
							theme : "advanced",
							language : "<?php echo strtolower(current(explode("_", $this->locale))); ?>",
							plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
							/*SBLA 20130211*/
							extended_valid_elements : "-p",
							convert_fonts_to_spans : true,
							font_size_classes : "tt-10,tt-9,tt-8,tt-7,tt-6,tt-4,tt-2",
							// don't replace encoding character like : Ã© to &eacutes;
							entity_encoding : "raw",							
							// Theme options
							theme_advanced_buttons1 : "fullscreen,bold,italic,underline,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,hr,sub,sup,forecolor,backcolor",
							theme_advanced_buttons2 : "code,formatselect,styleselect,fontsizeselect,removeformat,visualchars,outdent,indent,undo,redo",
							theme_advanced_buttons3 : "", 
							theme_advanced_toolbar_location : "top",
							theme_advanced_toolbar_align : "left",
							theme_advanced_statusbar_location : "bottom",
							theme_advanced_resizing : true,
							// Exemple content CSS (should be your site CSS)
							content_css : "<?php echo $url_css ?>",
							// Style formats for 'styleselect'
							style_formats : [
								{title : 'Liste point rose', selector : 'ul', classes : 'roseDisc'},
								{title : 'Titre 1', block : 'h3', classes : 'tt-1'},
								{title : 'Titre 2', block : 'h3', classes : 'tt-2'},
								{title : 'Titre 3', block : 'h3', classes : 'tt-3'},
								{title : 'Titre 4', block : 'h4', classes : 'tt-4'},
								{title : 'Titre 5', block : 'h4', classes : 'tt-red'},
								{title : 'Titre 6', block : 'h4', classes : 'tt-purple'}
							],
							formats : {
								alignleft : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'txtleft'},
								aligncenter : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'txtcenter'},
								alignright : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'txtright'},
								alignfull : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'txtjustify'},
								bold : {inline : 'span', 'classes' : 'bold'},
								italic : {inline : 'span', 'classes' : 'italic'},
								underline : {inline : 'span', 'classes' : 'underline', exact : true},
								strikethrough : {inline : 'del'}
							},
							// Drop lists for link/image/media/template dialogs
							template_external_list_url : "<?php echo $url_base ?>/plugins/lists/template_list.js",
							external_link_list_url : "<?php echo $url_base ?>/plugins/lists/link_list.js",
							external_image_list_url : "<?php echo $url_base ?>/plugins/lists/image_list.js",
							media_external_list_url : "<?php echo $url_base ?>/plugins/lists/media_list.js",
							// count without the lenght of html balise
							setup : function(ed) {
                                ed.onKeyUp.add(function(ed, e) {
                                    var strip = (tinymce.activeEditor.getContent()).replace(/(<([^>]+)>)/ig,"").replace(/&[a-z]+;/ig, "");
                                    var text = strip.split(' ').length + " Mots, " +  (10000 - strip.length) + " Caractères "
                                    tinymce.DOM.setHTML(tinymce.DOM.get(tinymce.activeEditor.id + '_path_row'), text);

                                    // limit the lenght of written
                                    //if (strip.length > ("<?php if($this->container->get('Request')->get('_route')== 'gedmo_admin_social_edit'){ ?>"+245+"<?php }else{ ?>"+475+"<?php } ?>")) {
                                    //      strip = strip.substring(0,("<?php if($this->container->get('Request')->get('_route')== 'gedmo_admin_social_edit'){ ?>"+245+"<?php }else{ ?>"+475+"<?php } ?>"));
                                    //      tinymce.execCommand('mceSetContent',false,strip);
                                    //}
                                });
                            }
						});
				    };	
					
					// THIS FUNCTION ALLOW TO INJECT SEVERAL FIELDS IN A ACCORDION MENU.
			        this.ftc_accordion_form = function(className, title, idForm){
			        	$(idForm+" fieldset:first").addClass('no-accordion');
						if ( $('.accordion-form').length == 0 ) $("<div class='accordion-form'>").insertAfter(idForm+" fieldset");
						var accordionId = "accordion_"+className;
						$("<fieldset id='"+accordionId+"' class='accordion'><a href='#' class='accordion_link_"+className+"' title='"+title+"'>"+title+"</a></fieldset>").appendTo('.accordion-form');
						
						$("."+className).each(function(index) {
							$(this).parent('.clearfix').detach().appendTo("#"+accordionId);
						});	
						
						$('#'+accordionId+' a').click(function () {
							// $(this).parent('fieldset').toggleClass('open').siblings('fieldset').removeClass('open');
							var that = $(this);
							var newHeight = function(){
								var h=16;	//initial height when closed
								that.parent('fieldset').children('.clearfix').each(function(ind,el){
									h += $(el).outerHeight(true);
								});
								return (h+80)+'px';
							};
							
							if ( $(this).parent('fieldset').hasClass('open') ){
								$(this).parent('fieldset').removeClass('open');
								$(this).parent('fieldset').animate({
									height: '16px'
								  }, 400, 'swing'
								);
							} else {
								$(this).parent('fieldset').animate({
									height: newHeight()
								  }, 400, 'swing', function() {
									$(this).addClass('open');
								}).siblings('fieldset').removeClass('open').animate({
									height: '16px'
								  }, 400, 'swing'
								);
							}
							return false;
						});
					}					
					
					// this function allow to inject several fields in a dialog.
			        this.ftc_dialog_form = function(className, title, idForm, height, width, position){
						// We inject the testimonial fields via a dialog
						// var button	 = $("<a href='#' style='margin-right:30px' class=' dialog_link_"+className+"' title='"+title+"'>"+title+"</a>").appendTo(idForm+" fieldset"); SBLA
						var button	 = $("<a href='#' style='margin-right:30px' class=' dialog_link_"+className+"' title='"+title+"'>"+title+"</a>");
						$(idForm+" fieldset:first").append(button);
						var form	 = "form_"+className;
						var obj_form = null;
						var dialogId = "dialog_"+className;
		
						$("<div id='"+dialogId+"' class='dialog_form' ><span id='"+form+"'></span></div>").appendTo(idForm);
					
						$("."+className).each(function(index) {
							$(this).parent().attr('style', "display:none");
						});	
		
						// modal dialog init: custom buttons and a "close" callback reseting the form inside
						var $dialog_form = $('#'+dialogId).wijdialog({
							zIndex: 99999,
							autoOpen: false,
							modal:true,
							height: height,
				            width: width,
				            position: position,
							buttons: {
								'<?php echo $this->translator->trans('pi.form.tab.box.close'); ?>': function () {
									$(this).wijdialog('close');
								},
							},
							open: function () {
			                	$(this).wijdialog({title: title + ' form'});
							},
							focus: function () {
								//j_prototype_bytabs.ftc_tinymce_editor($(".pi_editor"));
							},
			                beforeClose: function () {
				                obj_form = $(this).children().detach();
				                obj_form.attr('style', "display:none").appendTo(idForm);
							},
			                captionButtons: {
				                    pin: { visible: false },
				                    refresh: { visible: false },
				                    toggle: { visible: true },
				                    minimize: { visible: false },
				                    maximize: { visible: false }
				                },        								
			                show: 'scale',
			                hide: 'scale',				
						});	
		
						button.click(function () {
							if(obj_form != null){
								obj_form = $("#"+form).detach();
				                obj_form.appendTo($dialog_form);
				                obj_form.attr('style', "display:block");
							}else{
								$("."+className).each(function(index) {
									obj_start = $(this).parent().attr('style', "display:block");
									obj_start.detach().appendTo("#"+form);
									obj_newform = $("#"+form).detach();
									obj_newform.appendTo($dialog_form);
									obj_newform.attr('style', "display:block");
								});	
							}
								
							$dialog_form.wijdialog('open');
						});						
					};		
						
				};
			
				$(document).ready(function() {
				
			        $("<?php echo $options['form-name']; ?> input[type='radio']").wijradio();
			        $("<?php echo $options['form-name']; ?> input[type='checkbox']").wijcheckbox();
			        $("<?php echo $options['form-name']; ?> button[type='submit']").button();
			        $("<?php echo $options['form-name']; ?> input[type='button']").click(function () { return false; });
			        

					$("<?php echo $options['form-name']; ?> select.pi_simpleselect").multiselect({
					   multiple: false,
					   header: true,
					   noneSelectedText: "<?php echo $this->translator->trans('pi.form.label.select.choose.option'); ?>",
					   selectedList: 1
					}).multiselectfilter();										        

					$("<?php echo $options['form-name']; ?> select.pi_multiselect").multiselect({
					   multiple: true,
					   header: true,
					   noneSelectedText: "<?php echo $this->translator->trans('pi.form.label.select.choose.options'); ?>",
					   selectedList: 4
					}).multiselectfilter();										        
					
			        $("<?php echo $options['form-name']; ?> .pi_datepicker").wijinputdate({
			        	showTrigger: true,
			        	culture: '<?php echo str_replace("_", "-", $this->locale); ?>',
	            		//dateFormat: 'MM/dd/yyyy'
			        });

			        $("<?php echo $options['form-name']; ?> .pi_datetimepicker").wijinputdate({
			        	showTrigger: true,
	            		dateFormat: 'g'
			        });

			        $("[class*='limited']").each(function(i){
					    var c = $(this).attr("class");
					    var from = c.indexOf("(");
					    var to = c.indexOf(")");
					    var limit = parseInt(c.substring(from+1,to));

					    $(this).bind("keyup keydown change",function(e){
					      if (this.value.length > limit) {
					      this.value = this.value.substring(0, limit);
					      }
					    });
					});	        

			        j_prototype.ftc_tinymce_editor($("<?php echo $options['form-name']; ?> .pi_editor"));										        
			        j_prototype.ftc_tinymce_editor_simple($("<?php echo $options['form-name']; ?> .pi_editor_simple"));
			        j_prototype.ftc_tinymce_editor_simple_easy($("<?php echo $options['form-name']; ?> .pi_editor_simple_easy"));
			        j_prototype.ftc_tinymce_editor_simple($("<?php echo $options['form-name']; ?> .pi_editor_easy"));
			        
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