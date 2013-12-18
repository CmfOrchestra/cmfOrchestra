<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Util
 * @package    Extension_jquery 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-11
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Util\PiJquery;

use Symfony\Component\DependencyInjection\ContainerInterface;

use PiApp\AdminBundle\Twig\Extension\PiJqueryExtension;
use PiApp\AdminBundle\Exception\ExtensionException;

/**
 * MultiSelect Jquery plugin
 *
 * @category   Admin_Util
 * @package    Extension_jquery 
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiPrototypeByTabsManager extends PiJqueryExtension
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
    protected function init($options = null)
    {
        // radio and checkbox managment
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/js/jquery/iCheck/skins/all.css");
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/jquery/iCheck/jquery.icheck.min.js");
        
        // simple and multiselect managment
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/js/jquery/multiselect/css/jquery.multiselect.filter.css");
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/js/jquery/multiselect/css/jquery.multiselect.css");
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/jquery/multiselect/js/jquery.multiselect.js");
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/jquery/multiselect/js/jquery.multiselect.filter.js");
        
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
      * Sets render for prototype links in the form.
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
        if (!isset($options['prototype-name']) || empty($options['prototype-name'])) {
            throw ExtensionException::optionValueNotSpecified('prototype-name', __CLASS__);
        }
        if (!isset($options['prototype-tab-title']) || empty($options['prototype-tab-title'])) {
            throw ExtensionException::optionValueNotSpecified('prototype-tab-title', __CLASS__);
        }
        if (!isset($options['prototype-tab-idForm']) || empty($options['prototype-tab-idForm'])) {
            $options['prototype-idForm'] = ".myform";
        }
        // we set all roots
        $url_css  = '/css/layout.css';
        $url_root = 'http://'. $this->container->get('Request')->getHttpHost() . $this->container->get('Request')->getBasePath();
        $url_base = $url_root . "/bundles/piappadmin/js/tiny_mce";
        $root_upload = $this->container->get("kernel")->getRootDir()."/../web/uploads/tinymce/";
        $root_web = $this->container->get("kernel")->getRootDir()."/../web";
        // we set the locale date format of datepicker
        $locale = strtolower(substr($this->locale, 0, 2));
        $root_file         = realpath($this->container->getParameter("kernel.root_dir") . "/../web/bundles/piappadmin/js/ui/i18n/jquery.ui.datepicker-{$locale}.js");
        if (!$root_file) {
        	$locale = "en-GB";
        }
        // We open the buffer.
        ob_start ();        
        ?>
            <div class="demo-options">
                <!-- Begin options markup -->
                <div id="dialog" title="<?php echo $this->translator->trans('pi.form.tab.box.title'); ?>">
                    <fieldset class="ui-helper-reset">
                        <label>
                            <?php echo $this->translator->trans('pi.form.tab.box.click'); ?>
                        </label>
                    </fieldset>
                </div>
                <!-- End options markup -->
            </div>    
            
            <div id="form-error-dialog" >&nbsp;</div>
            
            <div id="dialog-confirm" title="<?php echo $this->container->get('translator')->trans('pi.grid.action.delete.confirmation.title'); ?>">
    		    <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
    			<?php echo $this->container->get('translator')->trans('pi.grid.action.delete.confirmation.message'); ?></p>
    		</div>			         
            
            <script type="text/javascript">
            //<![CDATA[
            
            	var id_form_delete = "";
            
                // we create the animations.
                var j_prototype_bytabs = new function()
                {
                    var tab_counter         = 2;
                    var name_prototype         = '';
                    var $prototype_content     = '';
                    var name_idForm            = '';
                    var tabTemplate            = '<li><a href="#{href}">#{label}</a> <span class="ui-icon ui-icon-close">Remove Tab</span></li>';

                    // tabs init with a custom tab template and an "add" callback filling in the content
                    // http://jqueryui.com/tabs/#manipulation
                    var tabs = $('#tabs').tabs({
                        tabTemplate: tabTemplate,
                        create: function (event, ui) {
                            // On enregistre le contenu du prototype dans le nouveau tab.
                            $(ui.panel).append('<p>' + $prototype_content + '</p>');
                        },
                        select: function (event, ui) { 
                            //$(".pi_simpleselect").delay(2000).data("wijdropdown").refresh();
                             //$(".pi_simpleselect").wijdropdown();
                        }
                    });

                    // modal dialog init: custom buttons and a "close" callback reseting the form inside
                    var $dialog = $('#dialog').dialog({
                        showStatus: false,
                        showControlBox: false,
                        autoOpen: false,
                        modal: true,
                        buttons: {
                            '<?php echo $this->translator->trans('pi.form.tab.box.add'); ?>': function () {
                                j_prototype_bytabs.ftc_add_tag();
                                $(this).dialog('close');
                            },
                            '<?php echo $this->translator->trans('pi.form.tab.box.cancel'); ?>': function () {
                                $(this).dialog('close');
                            }
                        },
                        open: function () {
                        },
                        close: function () {
                        }
                    });                
    
                    // We inject the error messages via a dialog
                    var value_message = '';

                    $(".symfony-form-errors").each(function(index) {
                        value_message = value_message + $(this).html();
                    });
                    
                    this.ftc_init = function(idForm, var_prototype){
                                                // We initialize the variables.
                                                name_prototype = var_prototype;
                                                name_idForm       = idForm;

                                                if (value_message.length != 0) {
                                                    // modal dialog for the error form
                                                    $('#form-error-dialog').dialog({
                                                        autoOpen: true,
                                                        height: 300,
                                                        width: 400,
                                                        modal: true,
                                                        buttons: {
                                                            Ok: function () {
                                                                $(this).dialog("close");
                                                            }
                                                        },
                                                        open: function () {
                                                            $(this).attr('title', 'Error form');
                                                            $(this).html(value_message);
                                                        },
                                                        captionButtons: {
                                                            pin: { visible: false },
                                                            refresh: { visible: false },
                                                            toggle: { visible: false },
                                                            minimize: { visible: false },
                                                            maximize: { visible: false }
                                                        }
                                                    });
                                                }                    
                                                    
                                                // Tags with onglet management
                                                $("#tabs").tabs({ 
                                                    scrollable: true,
                                                    alignment: 'top',
                                                    showOption: {
                                                        blind: false,
                                                        fade: true,
                                                        duration: 400,
                                                    },
                                                    hideOption: {
                                                        blind: false,
                                                        fade: true,
                                                        duration: 200,
                                                    }
                                                });

                                                // close icon: removing the tab on click
                                                tabs.delegate( "span.ui-icon-close", "click", function() {
                                                  var panelId = $( this ).closest( "li" ).remove().attr( "aria-controls" );
                                                  $( "#" + panelId ).remove();
                                                  tabs.tabs( "refresh" );
                                                });
                                    
                                                // addTab form: calls addTab function on submit and closes the dialog
                                                $('fieldset', $dialog).submit(function () {
                                                    j_prototype_bytabs.ftc_addTab();
                                                    $dialog.dialog('close');
                                                    return false;
                                                });

                                                // http://jquery-ui.googlecode.com/svn/tags/1.6rc5/tests/static/icons.html
                                                $("button.button-ui-create").button({icons: {primary: "ui-icon-circle-plus"}});
                                                $("button.button-ui-save").button({icons: {primary: "ui-icon-disk"}});
                                                $("a.button-ui-mediatheque").button({icons: {primary: "ui-icon-image"}}).css('padding', '6px');
                                                $("a.button-ui-delete").button({icons: {primary: "ui-icon-trash"}}).click(function( event ) {
                                                	event.preventDefault();
                                                	id_form_delete = $(this).data('id');
                                                	$("#dialog-confirm").dialog("open");
                                                });
                                                $("a.button-ui-back-list").button({icons: {primary: "ui-icon-arrowreturn-1-w"}});

                                             /*
                                              *  ->add('media', 'entity', array(
                                              *   		'class' => 'PiAppGedmoBundle:Media',
                                              *   		'query_builder' => function(EntityRepository $er) {
                                              *   			return $er->createQueryBuilder('a')
                                              *   			->select('a')
                                              *   			//->where("a.id = {$id}")
                                              *				->where("a.status = 'image'")
            								  * 			->ansWhere("a.image IS NOT NULL")
                                              *   			->andWhere("a.enabled = 1")
                                              *   			->orderBy('a.id', 'ASC');
                                              *   		},
                                              *   		//'property' => 'title',
                                              *   		'empty_value' => 'pi.form.label.select.choose.media',
                                              *   		'multiple' => false,
                                              *   		'required'  => true,
                                              *   		'constraints' => array(
                                              *   				new Constraints\NotBlank(),
                                              *   		),             		
                                              *   		"label_attr" => array(
                                              *   				"class"=> 'image_collection',
                                              *   		),
                                              *   		"attr" => array(
                                              *   				"class"=>"pi_simpleselect", // ajaxselect
                                              *					"data-url"=>$this->_container->get('bootstrap.RouteTranslator.factory')->getRoute("admin_gedmo_media_selectentity_ajax", array('type'=>'image')),
                              				  *					//"data-selectid" => $id
                                              *   		),
                                              *   		'label' => "Media",
                                              *   		'widget_suffix' => '<a class="button-ui-mediatheque button-ui-dialog" 
                                              *   				title="Ajouter une image à la médiatheque"
                                              *   				data-title="Mediatheque"
                                              *   				data-href="'.$this->_container->get('bootstrap.RouteTranslator.factory')->getRoute("admin_gedmo_media_new", array("NoLayout"=>"false", "category"=>'', 'status'=>'image')).'"
                                              *   				data-selectid="#piapp_gedmobundle_mediatype_id"
                                              *   				data-selecttitle="#piapp_gedmobundle_mediatype_title"
                                              *   				data-insertid="#m1m_providerbundle_rubbloctype_media"
                                              *   				data-inserttype="multiselect"
                                              *   				></a>',
                                              *   ))
                                              */                                                   
                                                $("a.button-ui-dialog").on('click', function (event) {
                                                	event.preventDefault();
                                                	var _url = $(this).data('href');
                                                	var _title = $(this).data('title');
                                                	var _selectId = $(this).data('selectid');
                                                	var _selectTitle = $(this).data('selecttitle');
                                                	var _insertId = $(this).data('insertid');
                                                	var _insertType = $(this).data('inserttype');
                                                	$('<div id="iframe-dialog" title="'+_title+'">&nbsp;</div>').html('<iframe id="modalIframeId" width="100%" height="99%" style="overflow-x: hidden; overflow-y: hidden" scrolling="no" marginWidth="0" marginHeight="0" frameBorder="0" src="'+_url+'" />').dialog({
                                                        width: 421,
                                                        height: 600,
                                                        open: function () {
                                                        	$(this).find("iframe").contents().find('body').attr('scrolling', 'no');
                                                        },
                                                        beforeClose: function () {
                                                            if (_insertType == "select") {
                                                                var _id_ = $(this).find('iframe').contents().find(_selectId).val();
                                                                var _title_ = $(this).find('iframe').contents().find(_selectTitle).val();
                                                            	$(_insertId).append('<option value="'+_id_+'" selected="selected">'+_id_+' - '+_title_+'</option>');
                                                            } else if (_insertType == "multiselect") { 
                                                                var _id_ = $(this).find('iframe').contents().find(_selectId).val();
                                                                var _title_ = $(this).find('iframe').contents().find(_selectTitle).val();
                                                            	$(_insertId).append('<option value="'+_id_+'" selected="selected">'+_id_+' - '+_title_+'</option>');
                                                            	$(_insertId).multiselect( 'refresh' );
                                                            } else {
                                                            	$(_insertId).val(_id_)
                                                            }
                                                        },                                                        
                                                        close: function () {
                                                        	$(this).dialog("close");
                                                        }
                                                    });
                                                });
                                                                                                
                                                // addTab button: just opens the dialog
                                                $('button.button-ui-add-tab').button({icons: {primary: "ui-icon-newwin"}}).on('click', function (event) {
                                                    event.preventDefault();
                                                    $dialog.dialog('open');
                                                });
                                    
                                                // close icon: removing the tab on click
                                                // note: closable tabs gonna be an option in the future - see http://dev.jqueryui.com/ticket/3924
                                                $('#tabs span.ui-icon-close').on('click', function () {
                                                    var index = $('li', tabs).index($(this).parent());
                                                    tabs.tabs('remove', index);
                                                });    
    
                                                // We run the "get start" of construction.
                                                j_prototype_bytabs.ftc_addGetStart(name_idForm);

                                                // we remove each number of all tabs
                                                $("[id^='"+var_prototype+"']").each(function(i){
                                                	var currentId = $(this).attr('id');
                                                	$(this).find('div:first-child > label').remove();
                                                }); 

                                                // we remove each first label of all fieldsets
                                                $("fieldset.no-accordion > div > label:first-child").each(function(i){
                                                	var myclass = $(this).parent().attr('class');
                                                	if( (typeof(myclass) == "undefined") && (myclass != "clearfix") ){
                                                	    $(this).remove();
                                                	}
                                                }); 
                    };
        
                    // actual addTab function: adds new tab using the title input from the form above
                    this.ftc_addGetStart = function(idForm){
                                                $("div[id^='"+name_prototype+"_']").each(function(index) {
                                                    // It retrieves the content.
                                                    var $dataprototype = $(this).html();
                                                    
                                                    // We tag the prototype with the corresponding class.
                                                    $prototype_content = '<fieldset class="no-accordion"><div id="'+name_prototype+'_' + index + '" >' + $dataprototype + '</div></fieldset>';
                                                    
                                                    // We add the contents into a new tab.
                                                    j_prototype_bytabs.ftc_addTab(index+1);
                                                });
                                                
                                                // It deletes the contents of all collections of such translation.
                                                $("#prototype_all_widgets_"+name_prototype).remove();

                                                // Applying the widgets plugin "wijmo" on the new collection.
                                                j_prototype_bytabs.ftc_add_render_form(idForm);
                                                
                    };
                    
                    // We define a function that will add a field.
                    this.ftc_add_tag = function(){
                                                var index    = $("div[id^='"+name_prototype+"_']").length;

                                                // On récupère la balise <script> en question qui contient le contenu « data-prototype ».
                                                var $prototype     = $('script#prototype_script_'+name_prototype);

                                                // On remplace la variable $$name$$ ou __name__ qu'il contient par le numéro du champ.
                                                //var $dataprototype = $prototype.html().replace(/\$\$name\$\$/g, index);
                                                var $dataprototype = $prototype.html().replace('<label class="required">__name__label__</label>', '');
                                                $dataprototype     = $dataprototype.replace(/__name__/g, index);
                                                
                                                // On balise le prototype avec la class correspondant
                                                $prototype_content = '<fieldset><div id="'+name_prototype+'_' + index + '" >' + $dataprototype + '</div></fieldset>';
                                                
                                                // On ajoute le contenu dans un nouveau onglet
                                                j_prototype_bytabs.ftc_addTab(index+1);

                                                // On applique les widget du plugin wijmo sur la nouvelle collection
                                                j_prototype_bytabs.ftc_add_render_form("#"+name_prototype+"_" + index);
                    };
                    
                    // actual addTab function: adds new tab using the title input from the form above
                    this.ftc_addTab = function(index){
                                                //tabs.tabs('add', '#tabs-' + tab_counter, '<?php echo $options['prototype-tab-title']; ?> ' + index);
                                                var label = "<?php echo $options['prototype-tab-title']; ?> " + index;
                                                var id = "tabs-" + tab_counter;
                                                var li = $( tabTemplate.replace( /#\{href\}/g, "#" + id ).replace( /#\{label\}/g, label ) );
                                                tabs.find( ".ui-tabs-nav" ).append( li );
                                                tabs.find('form').prepend( "<div id='" + id + "'><p>" + $prototype_content + "</p></div>" );
                                                tabs.tabs( "refresh" );
                                                tab_counter++;
                    };            

                    // Applying the widgets.
                    this.ftc_add_render_form = function(prototype_widget){

                    							function descrypt(){
	                    							$("[id^='ui-multiselect-']").each(function(i){
	                                                     	var string = $(this).next('span').html();
	                                                     	string = string.toString().replace(/&lt;/g, '<').replace(/&gt;/g, '>');
	                                                     	string = string.replace(/&#0*39;/g, "'");
	                                                     	string = string.replace(/&quot;/g, '"');
	                                                     	string = string.replace(/&amp;/g, '&');
	                                                     	$(this).next('span').html(string);
	                                                     	$(this).click(function(){ 
	                                                     		var id = $(this).attr('id').toString().replace(/-option-(.+)/ig,'').replace('ui-multiselect-','');
	                                                    		var string = $(this).val();
	                                                         	string = string.toString().replace(/&amp;lt;img.*?\/&amp;gt;/ig,'');
	                                                    		$("#"+id).next("button.ui-multiselect").html(string); 
	                                                    	});
	                                                }); 

	                                                $("button.ui-multiselect").each(function(i){
	                                                 	var string = $(this).find('span:last').html();
	                                                 	string = string.toString().replace(/&amp;lt;img.*?\/&amp;gt;/ig,'');
	                                                 	$(this).find('span:last').html(string);                                                 	 
	                                            	});
                    							}

                                                $(prototype_widget + " input[type='radio']").iCheck({
                                                    handle: 'radio',
                                                    radioClass: 'iradio_square-blue',
                                                });
                                                $(prototype_widget + " input[type='checkbox']").iCheck({
                                                    handle: 'checkbox',
                                                    checkboxClass: 'icheckbox_square-blue',
                                                });
												// multiselect
                                                $(prototype_widget + " select.pi_simpleselect").multiselect({
                                                   multiple: false,
                                                   header: true,
                                                   noneSelectedText: "<?php echo $this->translator->trans('pi.form.label.select.choose.option'); ?>",
                                                   selectedList: 1,
                                                   click: function(event, ui){
                                                   }
                                                }).multiselectfilter();

                                                $(prototype_widget + " select.pi_multiselect").multiselect({
                                                   multiple: true,
                                                   header: true,
                                                   noneSelectedText: "<?php echo $this->translator->trans('pi.form.label.select.choose.options'); ?>",
                                                   selectedList: 4
                                                }).multiselectfilter();

                                                // http://stackoverflow.com/questions/7252633/populate-multiselect-box-using-jquery
                                                // https://drupal.org/node/1124052
                                                // jquery multiselect I don't get the values that are selected in the multiselect field when performing an AJAX callback triggered
                                                // http://www.erichynds.com/blog/jquery-ui-multiselect-widget
                                                $(prototype_widget + " select.pi_simpleselect.ajaxselect, " + prototype_widget + " select.pi_multiselect.ajaxselect").each(function(i){
													var el = $(this).multiselect('disable'); //disable it initially
													var _selectId = $(this).data('selectid');

											        $.ajax({
														type: "POST",
											            url: $(this).data('url'),
											            data: "",
											            contentType: "application/json; charset=utf-8",
											            dataType: "json",
													}).done(function(response){
														el.multiselect('enable');
														if (response.length > 0) {
															$.each(response, function(key, value){
																if(el.find('option[value='+value.id+']').length == 0){
															    	var opt = $('<option />', {
																		value: value.id,
																		text: value.text
																	});
																	opt.appendTo( el );
															  	} 															  	
															  	if (_selectId instanceof Array) {
															  		_selectId.forEach(function(entry) {
																	    if (entry == value.id) {
																	  		el.find(value.id).attr( "selected","selected")
																	  	}
																	});																	
																} else if (_selectId == value.id) {
															  		el.find(value.id).attr( "selected","selected")
															  	}
														    })
														}														
													}).complete(function(){
														el.multiselect('refresh');
														descrypt();		
													});

                                                });  
                                                descrypt();                                                
                                                
                                                // date picker
                                                $(prototype_widget + " .pi_datepicker").datepicker({
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
                                                $(prototype_widget + " .pi_datetimepicker").datepicker({
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
                                                j_prototype_bytabs.ftc_tinymce_editor($(prototype_widget + " .pi_editor"));                                                
                                                j_prototype_bytabs.ftc_tinymce_editor_simple($(prototype_widget + " .pi_editor_simple"));
                                                j_prototype_bytabs.ftc_tinymce_editor_simple_easy($(prototype_widget + " .pi_editor_simple_easy"));
                                                j_prototype_bytabs.ftc_tinymce_editor_easy($(prototype_widget + " .pi_editor_easy"));
                    };    

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
                            style_formats : <?php echo $this->TINYMCEstyleformats(); ?>,
                            formats : <?php echo $this->TINYMCEformats(); ?>,
                            font_size_classes : "<?php echo $this->TINYMCEsize(); ?>",
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
                            style_formats : <?php echo $this->TINYMCEstyleformats(); ?>,
                            formats : <?php echo $this->TINYMCEformats(); ?>,
                            font_size_classes : "<?php echo $this->TINYMCEsize(); ?>",
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
                            // don't replace encoding character like : Ã© to &eacutes;
                            entity_encoding : "raw",  
                         	// clean up the content
                            cleanup_callback : this.fct_tinymce_xhtml_transform,                          
                            // Theme options
                            theme_advanced_buttons1 : "fullscreen,bold,italic,underline,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,forecolor,backcolor",
                            theme_advanced_buttons2 : "removeformat,styleselect,fontsizeselect,outdent,indent,undo,redo",
                            theme_advanced_buttons3 : "code,link,unlink,search,replace,insertdate,inserttime,blockquote,charmap,image,media",
                            theme_advanced_toolbar_location : "top",
                            theme_advanced_toolbar_align : "left",
                            theme_advanced_statusbar_location : "bottom",
                            theme_advanced_resizing : true,
                            // Exemple content CSS (should be your site CSS)
                            content_css : "<?php echo $url_css ?>",
                            // Style formats for 'styleselect'
                            style_formats : <?php echo $this->TINYMCEstyleformats(); ?>,
                            formats : <?php echo $this->TINYMCEformats(); ?>,
                            font_size_classes : "<?php echo $this->TINYMCEsize(); ?>",
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
                            // don't replace encoding character like : Ã© to &eacutes;
                            entity_encoding : "raw",
                            // clean up the content
                            cleanup_callback : this.fct_tinymce_xhtml_transform,                        
                            // Theme options
                            theme_advanced_buttons1 : "fullscreen,bold,italic,underline,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,hr,sub,sup,forecolor,backcolor",
                            theme_advanced_buttons2 : "code,formatselect,styleselect,fontsizeselect,removeformat,visualchars,outdent,indent,undo,redo,image",
                            theme_advanced_buttons3 : "", 
                            theme_advanced_toolbar_location : "top",
                            theme_advanced_toolbar_align : "left",
                            theme_advanced_statusbar_location : "bottom",
                            theme_advanced_resizing : true,
                            // Exemple content CSS (should be your site CSS)
                            content_css : "<?php echo $url_css ?>",
                            // Style formats for 'styleselect'
                            style_formats : <?php echo $this->TINYMCEstyleformats(); ?>,
                            formats : <?php echo $this->TINYMCEformats(); ?>,
                            font_size_classes : "<?php echo $this->TINYMCEsize(); ?>",
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
                    	//console.log(type)	
                    	switch (type) {
		                        case "get_from_editor":
			                			value = value.replace(/&nbsp;/ig, " ");		     
			                			value = value.replace(/\s/ig, " ");			                
		                                break;
		                        case "insert_to_editor":
										//value = value.replace(/<p[^>]*><span[^>]*> <\/span><\/p>/g,"<p><span> </span></p>");
		                    			//value = value.replace(/<p[^>]*> <\/p>/g, "<p> </p>");
		                    			//value = value.replace(/<\/?[^<]+>/g,'');
		                    			//value = value.replace(/<\w+>(\w+)<\/\w+>/g,'');
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
                            $('#'+accordionId+' legend').on('click', function (event, dataObject) { 
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

                        button.on('click', function (event) { 
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
                                
                            $dialog_form.dialog('open');
                        });                        
                    };

                };

                $(document).ready(function() {
                    <?php foreach($options['prototype-name'] as $key => $value){ ?>
	                    // We run the function.
                        j_prototype_bytabs.ftc_init('<?php echo $options['prototype-idForm']; ?>', '<?php echo $value; ?>');
                    <?php } ?>
                    
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
     * Sets style formats of the TINYMCE.
     *
     * @access protected
     * @return void
     *
     * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com> 
     */
    protected function TINYMCEstyleformats()
    {    
        // We open the buffer.
        ob_start ();        
        ?>

        [
          {title : 'Liste point rose', selector : 'ul', classes : 'roseDisc'},
          {title : 'Titre rose', block : 'h3', classes : 'tt-5 tt-clr'},
          {title : 'Titre 1', block : 'h3', classes : 'tt-1'},
          {title : 'Titre 2', block : 'h3', classes : 'tt-2'},
          {title : 'Titre 3', block : 'h3', classes : 'tt-3'},
          {title : 'Titre 4', block : 'h4', classes : 'tt-4'},
          {title : 'Titre 5', block : 'h4', classes : 'tt-red'},
          {title : 'Titre 6', block : 'h4', classes : 'tt-purple'}
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
     * Sets style formats of the TINYMCE.
     *
     * @access protected
     * @return void
     *
     * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com> 
     */
    protected function TINYMCEformats()
    {    
        // We open the buffer.
        ob_start ();        
        ?>

          {
              alignleft : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'txtleft'},
              aligncenter : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'txtcenter'},
              alignright : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'txtright'},
              alignfull : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'txtjustify'},
              bold : {inline : 'span', 'classes' : 'bold'},
              italic : {inline : 'span', 'classes' : 'italic'},
              underline : {inline : 'span', 'classes' : 'underline', exact : true},
              strikethrough : {inline : 'del'},
          }    

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
     * Sets style formats of the TINYMCE.
     *
     * @access protected
     * @return void
     *
     * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com> 
     */
    protected function TINYMCEsize()
    {    
        return "tt-10,tt-9,tt-8,tt-7,tt-6,tt-4,tt-2";
    }     
}