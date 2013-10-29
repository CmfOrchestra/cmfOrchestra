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
    protected function init($options = null) {
        
        // theme form + wijmo rocket
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile($this->container->getParameter('pi_app_admin.admin.theme_css'));
        
        // radio and checkbox managment
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/js/jquery/iCheck/skins/all.css");
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/jquery/iCheck/jquery.icheck.min.js");
        
        // simple and multiselect managment
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/js/jquery/multiselect/css/jquery.multiselect.filter.css");
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/js/jquery/multiselect/css/jquery.multiselect.css");
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/jquery/multiselect/js/jquery.multiselect.js");
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/jquery/multiselect/js/jquery.multiselect.filter.js");
        
        // multi-select chained management
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/jquery/jquery.chained.remote.js");
        
        // editor managment
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/tiny_mce/jquery.tinymce.js");
        
        // datepicker region
        $locale = strtolower(substr($this->locale, 0, 2));
        $root_file         = realpath($this->container->getParameter("kernel.root_dir") . "/../web/bundles/piappadmin/js/ui/i18n/jquery.ui.datepicker-{$locale}.js");
        if (!$root_file) {
        	$locale = "en-GB";
        }
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/ui/i18n/jquery.ui.datepicker-{$locale}.js");
        
        // jcrop
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/jquery/jcrop/jquery.Jcrop.min.js");
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/js/jquery/jcrop/jquery.Jcrop.min.css");        
    }    
    
    /**
      * Set progress text for Progress flash dialog.
      *
      * @param    $options    tableau d'options.
      * @access protected
      * @return void
      *
      * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com> 
      */
    protected function render($options = null)
    {        
        // Option management
        if (!isset($options['form-name']) || empty($options['form-name']))
            throw ExtensionException::optionValueNotSpecified('form-name', __CLASS__);
        
        $url_css  = '/css/layout.css';
        $url_base = 'http://'. $this->container->get('Request')->getHttpHost() . $this->container->get('Request')->getBasePath() . "/bundles/piappadmin/js/tiny_mce";        

        // We open the buffer.
        ob_start ();        
        ?>        
            <div id="dialog-confirm" title="<?php echo $this->container->get('translator')->trans('pi.grid.action.delete.confirmation.title'); ?>">
    		    <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
    			<?php echo $this->container->get('translator')->trans('pi.grid.action.delete.confirmation.message'); ?></p>
    		</div>		
			        
            <script type="text/javascript">
            //<![CDATA[
            
            	var id_form_delete = "";
            
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
                            plugins : "openmanager,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
                            // url convertion : http://www.tinymce.com/tryit/url_conversion.php
                            relative_urls : true,
                            document_base_url: '',
                            remove_script_host : true,
                            convert_urls : true,
                            //FILE UPLOAD MODS
                            file_browser_callback: "openmanager",
                            open_manager_upload_path: "<?php echo $root_upload; ?>",
                            open_manager_web_path: "<?php echo $root_web; ?>",
                            /*SBLA 20130211*/
                            // forced_root_block : false,         // Needed for 3.x
                            // forced_root_block : '',
                            extended_valid_elements : "-p",   // suprime les <p></p>
                            force_br_newlines : true,
                            //force_p_newlines : false,
                            convert_newlines_to_brs : true,
                            //remove_linebreaks : true,
                            convert_fonts_to_spans : true,
                            font_size_classes : "tt-10,tt-9,tt-8,tt-7,tt-6,tt-4,tt-2",
                            // don't replace encoding character like : Ã© to &eacutes;
                            entity_encoding : "raw",  
                         	// clean up the content
                            cleanup_callback : this.fct_tinymce_xhtml_transform,                    
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
                                {title : 'Titre rose', block : 'h3', classes : 'tt-5 tt-clr'},
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
                                strikethrough : {inline : 'del'},
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
                                    //if (strip.length > ("<?php if ($this->container->get('Request')->get('_route')== 'gedmo_admin_social_edit'){ ?>"+245+"<?php } else { ?>"+475+"<?php } ?>")) {
                                    //      strip = strip.substring(0,("<?php if ($this->container->get('Request')->get('_route')== 'gedmo_admin_social_edit'){ ?>"+245+"<?php } else { ?>"+475+"<?php } ?>"));
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
                            plugins : "openmanager,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
                            // url convertion : http://www.tinymce.com/tryit/url_conversion.php
                            relative_urls : true,
                            document_base_url: '',
                            remove_script_host : true,
                            convert_urls : true,
                            //FILE UPLOAD MODS
                            file_browser_callback: "openmanager",
                            open_manager_upload_path: "<?php echo $root_upload; ?>",
                            open_manager_web_path: "<?php echo $root_web; ?>",
                            /*SBLA 20130211*/
                            // forced_root_block : false,         // Needed for 3.x
                            // forced_root_block : '',
                            extended_valid_elements : "-p",   // suprime les <p></p>
                            force_br_newlines : true,
                            //force_p_newlines : false,
                            convert_newlines_to_brs : true,
                            //remove_linebreaks : true,
                            convert_fonts_to_spans : true,
                            font_size_classes : "tt-10,tt-9,tt-8,tt-7,tt-6,tt-4,tt-2",
                            // don't replace encoding character like : Ã© to &eacutes;
                            entity_encoding : "raw",  
                         	// clean up the content
                            cleanup_callback : this.fct_tinymce_xhtml_transform,                    
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
                                {title : 'Titre rose', block : 'h3', classes : 'tt-5 tt-clr'},
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
                                strikethrough : {inline : 'del'},
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
                                    //if (strip.length > ("<?php if ($this->container->get('Request')->get('_route')== 'gedmo_admin_social_edit'){ ?>"+245+"<?php } else { ?>"+475+"<?php } ?>")) {
                                    //      strip = strip.substring(0,("<?php if ($this->container->get('Request')->get('_route')== 'gedmo_admin_social_edit'){ ?>"+245+"<?php } else { ?>"+475+"<?php } ?>"));
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
                            plugins : "openmanager,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
                            // url convertion : http://www.tinymce.com/tryit/url_conversion.php
                            relative_urls : true,
                            document_base_url: '',
                            remove_script_host : true,
                            convert_urls : true,
                            //FILE UPLOAD MODS
                            file_browser_callback: "openmanager",
                            open_manager_upload_path: "<?php echo $root_upload; ?>",
                            open_manager_web_path: "<?php echo $root_web; ?>",
                            /*SBLA 20130211*/
                            // forced_root_block : false,         // Needed for 3.x
                            // forced_root_block : '',
                            extended_valid_elements : "-p",   // suprime les <p></p>
                            force_br_newlines : true,
                            //force_p_newlines : false,
                            convert_newlines_to_brs : true,
                            //remove_linebreaks : true,
                            convert_fonts_to_spans : true,
                            font_size_classes : "tt-10,tt-9,tt-8,tt-7,tt-6,tt-4,tt-2",
                            // don't replace encoding character like : Ã© to &eacutes;
                            entity_encoding : "raw",  
                         	// clean up the content
                            cleanup_callback : this.fct_tinymce_xhtml_transform,                    
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
                                {title : 'Titre rose', block : 'h3', classes : 'tt-5 tt-clr'},
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
                                strikethrough : {inline : 'del'},
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
                                    //if (strip.length > ("<?php if ($this->container->get('Request')->get('_route')== 'gedmo_admin_social_edit'){ ?>"+245+"<?php } else { ?>"+475+"<?php } ?>")) {
                                    //      strip = strip.substring(0,("<?php if ($this->container->get('Request')->get('_route')== 'gedmo_admin_social_edit'){ ?>"+245+"<?php } else { ?>"+475+"<?php } ?>"));
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
                            plugins : "openmanager,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
                            // url convertion : http://www.tinymce.com/tryit/url_conversion.php
                            relative_urls : true,
                            document_base_url: '',
                            remove_script_host : true,
                            convert_urls : true,
                            //FILE UPLOAD MODS
                            file_browser_callback: "openmanager",
                            open_manager_upload_path: "<?php echo $root_upload; ?>",
                            open_manager_web_path: "<?php echo $root_web; ?>",
                            /*SBLA 20130211*/
                            // forced_root_block : false,         // Needed for 3.x
                            // forced_root_block : '',
                            extended_valid_elements : "-p",   // suprime les <p></p>
                            force_br_newlines : true,
                            //force_p_newlines : false,
                            convert_newlines_to_brs : true,
                            //remove_linebreaks : true,
                            convert_fonts_to_spans : true,
                            font_size_classes : "tt-10,tt-9,tt-8,tt-7,tt-6,tt-4,tt-2",
                            // don't replace encoding character like : Ã© to &eacutes;
                            entity_encoding : "raw",  
                         	// clean up the content
                            cleanup_callback : this.fct_tinymce_xhtml_transform,                    
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
                                {title : 'Titre rose', block : 'h3', classes : 'tt-5 tt-clr'},
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
                                strikethrough : {inline : 'del'},
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
                                    //if (strip.length > ("<?php if ($this->container->get('Request')->get('_route')== 'gedmo_admin_social_edit'){ ?>"+245+"<?php } else { ?>"+475+"<?php } ?>")) {
                                    //      strip = strip.substring(0,("<?php if ($this->container->get('Request')->get('_route')== 'gedmo_admin_social_edit'){ ?>"+245+"<?php } else { ?>"+475+"<?php } ?>"));
                                    //      tinymce.execCommand('mceSetContent',false,strip);
                                    //}
                                });
                            }
                        });
                    };    
                 	// This function allows to convert the entered text
                    this.fct_tinymce_xhtml_transform = function xhtml_transform(type, value) {
                    	switch (type) {
		                        case "get_from_editor":
		                        	 	value = value.replace(/&nbsp;/ig, " ");	
		                        		value = value.replace(/\s/ig, " ");
		                                break;
		                        case "insert_to_editor":
										//value = value.replace(/<p[^>]*><span[^>]*> <\/span><\/p>/g,"<p><span> </span></p>");
		                    			//value = value.replace(/<p[^>]*> <\/p>/g, "<p> </p>");
		                    			value = value.replace(/&nbsp;/ig, " ");		     
		                    			value = value.replace(/\s/ig, " ");		                                    
		                                break;
		                        case "submit_content":
		                                break;
		                        case "get_from_editor_dom":
		                                break;
		                        case "insert_to_editor_dom":
		                                break;
		                        case "setup_content_dom":
		                                break;
		                        case "submit_content_dom":
		                                break;
		                }
		                return value;				
		            },                     
                    // THIS FUNCTION ALLOW TO INJECT SEVERAL FIELDS IN A ACCORDION MENU.
                    // exemple : j_prototype_bytabs.ftc_accordion_form("meta_definition", "SEO", ".myform");
                    // exemple : j_prototype_bytabs.ftc_accordion_form("meta_definition", "SEO", ".myform", 'questionLi0');
                    // exemple : j_prototype_bytabs.ftc_accordion_form("meta_definition", "SEO", ".myform", 'questionLi1');
                    this.ftc_accordion_form = function(className, title, idForm, addClass){
                        var addClassBis;
                        var tabsToProcess = $(idForm+" .ui-tabs-panel");

                        if (typeof(addClass) == "undefined") { addClass = '';addClassBis = ''; }
                        else addClassBis = '.' + addClass;
                        
                        $(tabsToProcess).each(function(indTab,tabProcessed){
                            var tabProcessedId = $(tabProcessed).attr("id");

                            if ( $("#"+tabProcessedId+" ."+className).length ==0 ) {
                                // Process next $.each()
                                return;
                            }
                            
                            $("#"+tabProcessedId+" fieldset:first").addClass("no-accordion");
                            if ( $("#"+tabProcessedId+" .accordion-form").length == 0 ) {
                                $("<div class='accordion-form'>").insertAfter("#"+tabProcessedId+" fieldset");
                            }
                            
                            var accordionId = "accordion_" + tabProcessedId + "_" + addClass +"_"+ className;
                            $("<fieldset id='"+accordionId+"' class='accordion'><legend>"+title+"</legend></fieldset>").appendTo("#"+tabProcessedId+" .accordion-form");

                            $("#"+tabProcessedId+" "+addClassBis+" ."+className).each(function(indClass) {
                                //$(this).parent('.clearfix').detach().appendTo("#"+accordionId);
                                $(this).closest('.clearfix').detach().appendTo("#"+accordionId);
                            });    
                        
                            $('#'+accordionId+' legend').click(function(event, dataObject) {  
                            	event.preventDefault(); 
                                var that = $(this);
                                var newHeight = function(){
                                    var h=16;    //initial height when closed
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
                        });
                    };
                        
                    // this function allow to inject several fields in a dialog.
                    // exemple : j_prototype_bytabs.ftc_dialog_form("solution_descriptif", "Descriptif", ".myform", 400, 366, "center");
                    this.ftc_dialog_form = function(className, title, idForm, height, width, position){
                        // We inject the testimonial fields via a dialog
                        // var button     = $("<a href='#' style='margin-right:30px' class=' dialog_link_"+className+"' title='"+title+"'>"+title+"</a>").appendTo(idForm+" fieldset"); SBLA
                        var button     = $("<a href='#' style='margin-right:30px' class=' dialog_link_"+className+"' title='"+title+"'>"+title+"</a>");
                        $(idForm+" fieldset:first").append(button);
                        var form     = "form_"+className;
                        var obj_form = null;
                        var dialogId = "dialog_"+className;

                        $("<div id='"+dialogId+"' class='dialog_form' ><span id='"+form+"'></span></div>").appendTo(idForm);
                    
                        $("."+className).each(function(index) {
                            $(this).parent().attr('style', "display:none");
                        });    

                        // modal dialog init: custom buttons and a "close" callback reseting the form inside
                        var $dialog_form = $('#'+dialogId).dialog({
                            autoOpen: false,
                            modal:true,
                            height: height,
                            width: width,
                            position: position,
                            buttons: {
                                '<?php echo $this->translator->trans('pi.form.tab.box.close'); ?>': function () {
                                    $(this).dialog('close');
                                },
                            },
                            open: function () {
                                $(this).dialog({title: title + ' form'});
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
                            if (obj_form != null){
                                obj_form = $("#"+form).detach();
                                obj_form.appendTo($dialog_form);
                                obj_form.attr('style', "display:block");
                            } else {
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

                    $("#dialog-confirm").dialog({
	               		 autoOpen: false,
	               		 resizable: false,
	               		 height:140,
	               		 modal: true,
	               		 buttons: {
	                   		 "<?php echo $this->container->get('translator')->trans('pi.form.tab.box.delete'); ?>": function() {
	                           	$('#'+id_form_delete).trigger('submit');
	                           	$( this ).dialog( "close" );
	                   		 },
	                   		 "<?php echo $this->container->get('translator')->trans('pi.form.tab.box.cancel'); ?>": function() {
	                   		 	$( this ).dialog( "close" );
	                   		 }
	               		 }
              	 	});                    
                
                    $("<?php echo $options['form-name']; ?> input[type='radio']").iCheck({
                        handle: 'radio',
                        radioClass: 'iradio_square-blue',
                    });
                    $("<?php echo $options['form-name']; ?> input[type='checkbox']").iCheck({
                        handle: 'checkbox',
                        checkboxClass: 'icheckbox_square-blue',
                    });

                    $("<?php echo $options['form-name']; ?> button.button-ui-create").button({icons: {primary: "ui-icon-circle-plus"}});
                    $("<?php echo $options['form-name']; ?> button.button-ui-save").button({icons: {primary: "ui-icon-disk"}});
                    $("<?php echo $options['form-name']; ?> a.button-ui-delete").button({icons: {primary: "ui-icon-trash"}}) .click(function( event ) {
                    	 event.preventDefault();
                    	 id_form_delete = $(this).data('id');
                    	 $("#dialog-confirm").dialog("open");
                    });
                    $(<?php echo $options['form-name']; ?> "a.button-ui-back-list").button({icons: {primary: "ui-icon-arrowreturn-1-w"}});
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
                    
                    $("<?php echo $options['form-name']; ?> .pi_datepicker").datepicker({
                    	changeMonth: true,
                        changeYear: true,
                        yearRange: "-71:+11",
                        reverseYearRange: true,
                        showOtherMonths: true,
                        showButtonPanel: true,
                        showAnim: "fade",  // blind fade explode puff fold
                        showWeek: true,
                        showOptions: { 
                            direction: "up" 
                        },
                        numberOfMonths: [ 1, 2 ],
                        buttonText: "<?php echo $this->translator->trans('pi.form.label.select.choose.date'); ?>",
                        showOn: "both",
                        buttonImage: "/bundles/piappadmin/images/icons/form/picto-calendar.png"
                    });
                    $("<?php echo $options['form-name']; ?> .pi_datetimepicker").datepicker({
                        formatDate: 'g',
                        buttonText: "<?php echo $this->translator->trans('pi.form.label.select.choose.hour'); ?>",
                        showOn: "both",
                        buttonImage: "/bundles/piappadmin/images/icons/form/Clock_4-64.png"
                    });
                    $.datepicker.setDefaults( $.datepicker.regional[ "<?php echo strtolower(substr($locale, 0, 2)); ?>" ] );

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