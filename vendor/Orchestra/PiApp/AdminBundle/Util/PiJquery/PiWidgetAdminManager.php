<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Util
 * @package    Extension_jquery 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-04-27
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Util\PiJquery;

use Symfony\Component\DependencyInjection\ContainerInterface;

use PiApp\AdminBundle\Twig\Extension\PiJqueryExtension;
use PiApp\AdminBundle\Exception\ExtensionException;

/**
 * Widget Admin Jquery UI plugin
 *
 * @category   Admin_Util
 * @package    Extension_jquery 
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiWidgetAdminManager extends PiJqueryExtension
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
     * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     */    
    protected function init($options = null)
    {
        // template management
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/jquery/jquery.tmpl.min.js");
        
        // viewer management
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/viewer/js/jquery.mousewheel.min.js");
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/viewer/js/jquery.iviewer.js");
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/js/viewer/css/jquery.iviewer.css");
        
        // zoomer management
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/zoomer/js/jquery.anythingzoomer.js");
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/js/zoomer/css/anythingzoomer.css");
    }    
    
    /**
      * Set progress text for Progress flash dialog.
      *
      * @param    $options    tableau d'options.
      * @access protected
      * @return void
      *
      * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
      * @author (c) Pedro Felix <contactpfelix@gmail.com>
      */
    protected function render($options = null)
    {        
        // We open the buffer.
        ob_start ();        
        ?>
            <script id="adminblockTemplate" type="text/x-jquery-tmpl">
            <h5 class='block_action_menu' >
                <a href='#' class='block_action_admin'    data-action='admin'        data-id='${id}' title='<?php echo $this->translator->trans("pi.admin"); ?>' >&nbsp;</a>
                <a href='#' class='block_action_import'    data-action='import'    data-id='${id}' title='<?php echo $this->translator->trans("pi.allwidgets"); ?>' >&nbsp;</a>
            </h5>
            </script>
            <script id="adminwidgetTemplate" type="text/x-jquery-tmpl">
            <h6 class='widget_action_menu' >&nbsp; 
                <a href='#' class='widget_action_move_up'    data-action='move_up'    data-id='${id}' title='<?php echo $this->translator->trans("pi.move-up"); ?>' >&nbsp;</a> 
                <a href='#' class='widget_action_move_down'    data-action='move_down'    data-id='${id}' title='<?php echo $this->translator->trans("pi.move-down"); ?>' >&nbsp;</a> 
                <a href='#' class='widget_action_edit'        data-action='edit'        data-id='${id}' title='<?php echo $this->translator->trans("pi.edit"); ?>' >&nbsp;</a> 
                <a href='#' class='widget_action_delete'    data-action='delete'    data-id='${id}' title='<?php echo $this->translator->trans("pi.delete"); ?>' >&nbsp;</a> 
                <a href='#' class='widget_action_admin'        data-action='admin'        data-id='${id}' title='<?php echo $this->translator->trans("pi.admin"); ?>' >&nbsp;</a> 
            </h6> 
            </script>
            <div id="hProBar"></div>        
        
            <script type="text/javascript">
            //<![CDATA[
            
                jQuery(document).ready(function() {

                    // we add the admin block Template to all widget
                    $("orchestra[id^='block__']").each(function(index) {
                        id_block = $(this).data("id");

                        var movies = [
                                      { id: id_block},
                                    ];

                        /* Render the adminblockTemplate with the "movies" data */ 
                        $("#adminblockTemplate").tmpl( movies ).prependTo(this);
                        /* Allow to draggable the block */
                        $(this).attr('data-drag', 'dragmap_block');
                    });    
                    // we add the admin widget Template to all widget
                    $("orchestra[id^='widget__']").each(function(index) {
                        id_widget = $(this).data("id");
                        var movies = [
                                      { id: id_widget},
                                    ];
                        /* Render the adminwidgetTemplate with the "movies" data */ 
                        $("#adminwidgetTemplate").tmpl( movies ).prependTo(this);
                        /* Allow to sortable the block */
                        $(this).attr('data-drag', 'dragmap_widget');
                    });
                    
                    /********************************
                     * start page action with click
                     ********************************/                     
                    $("span[class^='page_action_']").click( function() {
                        var _class    = $(this).attr('class');
                        var height = jQuery(window).height();
            
                        if (_class == "page_action_archivage"){
                            // start ajax 
                            $.ajax({
                                url: "<?php echo $this->container->get('router')->generate('public_indexation_page', array('action'=>'archiving')); ?>",
                                data: "",
                                datatype: "json",
                                cache: false,
                                "beforeSend": function ( xhr ) {
                                    //xhr.overrideMimeType("text/plain; charset=x-user-defined");
                                },
                                "statusCode": {
                                    404: function() {
                                    }
                                }                                              
                            }).done(function ( response ) {
                                //$('#page-action-dialog').html(response);
                                $('#page-action-dialog').html("<?php echo $this->translator->trans("pi.page.indexation.success"); ?>");
                                $('#page-action-dialog').attr('title', '<?php echo $this->translator->trans("pi.contextmenu.page.indexation"); ?>');
                                $('#page-action-dialog').dialog({
                                      height: 180,
                                      width: 400,
                                        open: function () {
                                       },
                                       beforeClose: function () {
                                           $('#page-action-dialog').html(' ');
                                       },
                                      buttons: {
                                          Ok: function () {
                                              $(this).dialog("close");
                                          }
                                      },
                                      captionButtons: {
                                          //pin: { visible: false },
                                          refresh: { visible: false },
                                          //toggle: { visible: false },
                                          minimize: { visible: false },
                                          maximize: { visible: false }
                                      },
                                    show: 'scale',
                                    hide: 'scale',
                                    collapsingAnimation: { animated: "scale", duration: 1000000, easing: "easeOutExpo" },
                                    expandingAnimation: { animated: "scale", duration: 1000000, easing: "easeOutExpo" },
                                });                            
                     	    });
                            // end ajax    
                        }

                        if (_class == "page_action_desarchivage"){
                            // start ajax 
                            $.ajax({
                                url: "<?php echo $this->container->get('router')->generate('public_indexation_page', array('action'=>'delete')); ?>",
                                data: "",
                                datatype: "json",
                                cache: false,
                                "beforeSend": function ( xhr ) {
                                    //xhr.overrideMimeType("text/plain; charset=x-user-defined");
                                },
                                "statusCode": {
                                    404: function() {
                                    }
                                }               
                            }).done(function ( response ) {
                                $('#page-action-dialog').html("<?php echo $this->translator->trans("pi.page.indexation.delete.success"); ?>");
                                $('#page-action-dialog').attr('title', '<?php echo $this->translator->trans("pi.contextmenu.page.desindexation"); ?>');
                                $('#page-action-dialog').dialog({
                                      height: 180,
                                      width: 400,
                                        open: function () {
                                       },
                                       beforeClose: function () {
                                           $('#page-action-dialog').html(' ');
                                       },
                                      buttons: {
                                          Ok: function () {
                                              $(this).dialog("close");
                                          }
                                      },
                                      captionButtons: {
                                          //pin: { visible: false },
                                          refresh: { visible: false },
                                          //toggle: { visible: false },
                                          minimize: { visible: false },
                                          maximize: { visible: false }
                                      },
                                    show: 'scale',
                                    hide: 'scale',
                                    collapsingAnimation: { animated: "scale", duration: 1000000, easing: "easeOutExpo" },
                                    expandingAnimation: { animated: "scale", duration: 1000000, easing: "easeOutExpo" },
                                });                            
                     	    });
                            // end ajax    
                        }                        
                        
                        if (_class == "page_action_edit"){
                            // start ajax 
                            $.ajax({
                                url: "<?php echo $this->container->get('router')->generate('public_urlmanagement_page'); ?>",
                                data: "type=page&action=edit&routename=<?php echo $this->container->get('request')->get('_route'); ?>",
                                datatype: "json",
                                cache: false,
                                cache: false,
                                "beforeSend": function ( xhr ) {
                                    //xhr.overrideMimeType("text/plain; charset=x-user-defined");
                                },
                                "statusCode": {
                                    404: function() {
                                    }
                                }             
                            }).done(function ( response ) {
                                var url = response[0].url;
                                $("#page-action-dialog").html('<iframe id="modalIframeId" width="100%" height="100%" marginWidth="0" marginHeight="0" frameBorder="0" scrolling="auto" src="'+url+'" />').dialog({
                                     width: 840,
                                     height: height/1.5,
                                     open: function () {
                                         $(this).attr('title', '<?php echo $this->translator->trans("pi.page.update"); ?>');
                                         $(this).find('iframe').attr('style', 'width: 99%;height: 99%');
                                     },
                                     beforeClose: function () {
                                         window.location.href= "<?php echo $this->container->get('router')->generate('public_refresh_page') ?>";
                                     },
                                     captionButtons: {
                                        //pin: { visible: true },
                                        refresh: { visible: true },
                                        //toggle: { visible: true },
                                        minimize: { visible: true },
                                        maximize: { visible: true }
                                     },                                           
                                     show: 'scale',
                                     hide: 'scale',
                                     collapsingAnimation: { animated: "scale", duration: 1000000, easing: "easeOutExpo" },
                                     expandingAnimation: { animated: "scale", duration: 1000000, easing: "easeOutExpo" },
                                });                            
                     	    });
                            // end ajax    
                        }

                        if (_class == "page_action_new"){
                            // start ajax 
                            $.ajax({
                                url: "<?php echo $this->container->get('router')->generate('public_urlmanagement_page') ?>",
                                data: "type=page&action=new",
                                datatype: "json",
                                cache: false,
                                "beforeSend": function ( xhr ) {
                                    //xhr.overrideMimeType("text/plain; charset=x-user-defined");
                                },
                                "statusCode": {
                                    404: function() {
                                    }
                                }  
                            }).done(function ( response ) {
                                var url = response[0].url;
                                $("#page-action-dialog").html('<iframe id="modalIframeId" width="100%" height="100%" marginWidth="0" marginHeight="0" frameBorder="0" scrolling="auto" src="'+url+'" />').dialog({
                                     width: 840,
                                     height: height/1.5,
                                     open: function () {
                                         $(this).attr('title', '<?php echo $this->translator->trans("pi.page.create"); ?>');
                                         $(this).find('iframe').attr('style', 'width: 99%;height: 99%');                                               
                                     },
                                     beforeClose: function () {
                                         var routename = $(this).find('iframe').contents().find("#piapp_adminbundle_pagetype_route_name").val();
                                         //console.log(routename);
                                         $.ajax({
                                          url: "<?php echo $this->container->get('router')->generate('public_urlmanagement_page') ?>",
                                          data: "type=routename" + "&routename=" + routename + "&action=url",
                                          datatype: "json",
                                          cache: false,
                                          error: function(msg){ alert( "Error !: " + msg );},            
                                          success: function(response){
                                              var url = response[0].url;
                                              window.location.href= url;
                                          }
                                      });
                                      // end ajax    
                                     },
                                     captionButtons: {
                                        //pin: { visible: true },
                                        refresh: { visible: true },
                                        //toggle: { visible: true },
                                        minimize: { visible: true },
                                        maximize: { visible: true }
                                     },                                           
                                     show: 'scale',
                                     hide: 'scale',
                                     collapsingAnimation: { animated: "scale", duration: 1000000, easing: "easeOutExpo" },
                                     expandingAnimation: { animated: "scale", duration: 1000000, easing: "easeOutExpo" },
                                });                             
                     	    });
                            // end ajax    
                        }    
                                            
                    });
                    // end click                        
                    
                    /********************************
                     * start block action with click
                     ********************************/ 
                    $("a[class^='block_action_']").click( function() {
                        var id         = $(this).data('id');
                        var action    = $(this).data('action');
                        var title    = $(this).attr('title');
                        var _class    = $(this).attr('class');
                        var height = jQuery(window).height();
                        // start ajax 
                        $.ajax({
                            url: "<?php echo $this->container->get('router')->generate('public_urlmanagement_page') ?>",
                            data: "id=" + id + "&action=" + action + "&type=block",
                            datatype: "json",
                            cache: false,
                            "beforeSend": function ( xhr ) {
                                //xhr.overrideMimeType("text/plain; charset=x-user-defined");
                            },
                            "statusCode": {
                                404: function() {
                                }
                            } 
                        }).done(function ( response ) {
                            var url = response[0].url;
                            $("#block-action-dialog").html('<iframe id="modalIframeId" width="100%" height="100%" marginWidth="0" marginHeight="0" frameBorder="0" scrolling="auto" src="'+url+'" />').dialog({
                                 width: 840,
                                 height: height/1.5,
                                 open: function () {
                                     $(this).attr('title', '<?php echo $this->translator->trans('pi.form'); ?> ' + title);
                                     $(this).find('iframe').attr('style', 'width: 99%;height: 99%');
                                 },
                                 beforeClose: function () {
                                     window.location.href= "<?php echo $this->container->get('router')->generate('public_refresh_page') ?>"; 
                                 },
                                 captionButtons: {
                                    //pin: { visible: true },
                                    refresh: { visible: true },
                                    //toggle: { visible: true },
                                    minimize: { visible: true },
                                    maximize: { visible: true }
                                 },                                       
                                 show: 'scale',
                                 hide: 'scale',
                                 collapsingAnimation: { animated: "scale", duration: 1000000, easing: "easeOutExpo" },
                                 expandingAnimation: { animated: "scale", duration: 1000000, easing: "easeOutExpo" },
                             });                        
                 	    });
                        // end ajax        
                    });
                    // end click
                    
                    /********************************
                     * start widget action with click
                     ********************************/                     
                    $("a[class^='widget_action_']").click( function() {
                        var id         = $(this).data('id');
                        var action    = $(this).data('action');
                        var title    = $(this).attr('title');
                        var _class    = $(this).attr('class');
                        var height = jQuery(window).height();
                        // start ajax 
                        $.ajax({
                            url: "<?php echo $this->container->get('router')->generate('public_urlmanagement_page') ?>",
                            data: "id=" + id + "&action=" + action + "&type=widget",
                            datatype: "json",
                            cache: false,
                            "beforeSend": function ( xhr ) {
                                //xhr.overrideMimeType("text/plain; charset=x-user-defined");
                            },
                            "statusCode": {
                                404: function() {
                                }
                            } 
                        }).done(function ( response ) {
                            var url = response[0].url;
                            if ( (_class == "widget_action_delete") || (_class== "widget_action_move_up") || (_class== "widget_action_move_down") ){
                                $('#widget-action-dialog').dialog({
                                    height: 180,
                                    width: 400,
                                    open: function () {
                                        $(this).attr('title', '<?php echo $this->translator->trans('pi.form'); ?> ' + title);
                                        if (_class == "widget_action_delete")
                                            $(this).html('<?php echo $this->translator->trans('pi.widget.ajaxaction.widget_action_delete'); ?>');
                                        if (_class == "widget_action_move_up")
                                            $(this).html('<?php echo $this->translator->trans('pi.widget.ajaxaction.widget_action_move_up'); ?>');
                                        if (_class == "widget_action_move_down")
                                            $(this).html('<?php echo $this->translator->trans('pi.widget.ajaxaction.widget_action_move_down'); ?>');
                                        
                                        $(this).find('iframe').attr('style', 'width: 99%;height: 99%');
                                    },
                                    buttons: {
                                        Cancel: function () {
                                            $(this).dialog("close");
                                        },
                                        Ok: function () {
                                            $.ajax({
                                                url: url,
                                                data:"",
                                                datatype: "json",
                                                cache: false,
                                                error: function(msg){ alert( "Error !: " + msg );},                 
                                                success: function(response){
                                                    //console.log(response);
                                                    window.location.href= "<?php echo $this->container->get('router')->generate('public_refresh_page') ?>";
                                                }
                                            });
                                        }
                                    },
                                    captionButtons: {
                                        close: { visible: false },
                                        //pin: { visible: false },
                                        refresh: { visible: false },
                                        //toggle: { visible: false },
                                        minimize: { visible: false },
                                        maximize: { visible: false }
                                    },
                                    show: 'scale',
                                    hide: 'scale',
                                    collapsingAnimation: { animated: "scale", duration: 1000000, easing: "easeOutExpo" },
                                    expandingAnimation: { animated: "scale", duration: 1000000, easing: "easeOutExpo" },
                                });
                            } else {
                                $('#widget-action-dialog').html('<iframe id="modalIframeId" width="100%" height="100%" marginWidth="0" marginHeight="0" frameBorder="0" scrolling="auto" src="'+url+'" />').dialog({
                                    width: 971,
                                    height: height/1.5,
                                    overlay: {
                                        backgroundColor: '#000',
                                        opacity: 0.5
                                    },
                                    open: function () {
                                        $(this).attr('title', 'Formulaire ' + title);
                                        $(this).find('iframe').attr('style', 'width: 99%;height: 99%');
                                    },
                                    beforeClose: function () {
                                        window.location.href= "<?php echo $this->container->get('router')->generate('public_refresh_page') ?>"; 
                                    },
                                    captionButtons: {
                                          //pin: { visible: true },
                                          refresh: { visible: true },
                                          //toggle: { visible: true },
                                          minimize: { visible: true },
                                          maximize: { visible: true }
                                    },                                        
                                    show: 'scale',
                                    hide: 'scale',
                                    collapsingAnimation: { animated: "scale", duration: 1000000, easing: "easeOutExpo" },
                                    expandingAnimation: { animated: "scale", duration: 1000000, easing: "easeOutExpo" },
                                });                    
                            }                        
                 	    });
                        // end ajax                        
                    });
                    // end click    

                    $(".img_action_viewer").click( function() {
                        $("img").each(function(index) {
                            var scr = $(this).attr("src");
                            var height = $(this).height();
                            var width  = $(this).width();
                            if ($("#viewer_"+index).is(':visible')){
                                $(this).show();
                                $("#viewer_"+index).remove();
                            } else {
                                $(this).before('<div id="viewer_'+index+'" class="viewer" style="height:'+height+'px;width:'+width+'px" ></div>');
                                $(this).hide();
                                $("#viewer_"+index).iviewer({
                                   src: scr,
                                   update_on_resize: true,
                                   zoom_animation: true,
                                   onMouseMove: function(ev, coords) { },
                                   onStartDrag: function(ev, coords) { return true; }, //this image will be dragged
                                   onDrag: function(ev, coords) { }
                               });    
                           }                   
                        });
                    });
                    
                });

            //]]>
            </script>
            
            <div id="page-action-dialog" >&nbsp;</div>
            <div id="block-action-dialog" >&nbsp;</div>
            <div id="widget-action-dialog" >&nbsp;</div>
            
            <script type="text/javascript">
            //<![CDATA[
            $(function() {    
                $(".texte_desc2:first").anythingZoomer({
                    clone : true
                });

                //SBLA - AJOUT EQUIVALENT POSITION:FIXED SUR DIALOGBOX. 
                dialogs = [];
                var ids = ["#page-action-dialog","#block-action-dialog","#widget-action-dialog"];
                //CLASSE
                function Diag(id){ this.id = $(id); }
                Diag.prototype.isVisible = function(){ return this.id.parent('.ui-dialog.wijmo-wijdialog').is(':visible')==true; };
                Diag.prototype.isFixed = function(){ return this.id.parent('.ui-dialog.wijmo-wijdialog').css('position')=='fixed'; };
                Diag.prototype.top = function(){ return this.isVisible() ? this.id.parent('.ui-dialog.wijmo-wijdialog').offset().top : null; };
                Diag.prototype.left = function(){ return this.isVisible() ? this.id.parent('.ui-dialog.wijmo-wijdialog').offset().left : null; };
                Diag.prototype.fixed = function(offset){
                    if (!this.isFixed()){
                        this.id.parent('.ui-dialog.wijmo-wijdialog').css( {position:'fixed', left: this.left(), top: this.top()-offset });
                    }
                };
                //INSTANCES
                $.each(ids,function(i,id){ dialogs[i] = new Diag(id); });
                //SCROLL HANDLER
                var scrollOffset;
                $(window).bind('scroll',function(){
                    scrollOffset = $(window).scrollTop();
                    $.each(dialogs,function(i){ dialogs[i].fixed(scrollOffset) });
                });
                //BUTTONS HANDLER
                $.each(dialogs,function(i,diag){    
                    //RESTORE & MAXIMISE HANDLER
                    diag.id.bind('wijdialogstatechanged',function(e,data){
                        // console.log('wijdialog.stateChanged',data);
                        // console.log( 'fixed?',diag.isFixed(), 'pos:', diag.top()+'/'+diag.left() );
                        if (data.state=='normal') {
                            //IF POS. STILL ABSOLUTE
                            if (diag.top()>400){
                                scrollOffset = $(window).scrollTop();
                                diag.id.parent('.ui-dialog.wijmo-wijdialog').css({ position:'fixed', left: diag.left(), top: diag.top()-scrollOffset });
                            } else {
                                diag.id.parent('.ui-dialog.wijmo-wijdialog').css({ position:'fixed', left: diag.left(), top: diag.top() });
                            }
                        } else if (data.state=='maximized') {
                            diag.id.parent('.ui-dialog.wijmo-wijdialog').css({ position:'absolute' });
                        }
                    });
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