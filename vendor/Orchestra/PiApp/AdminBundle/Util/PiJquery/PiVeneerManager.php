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
 * Veneer Jquery UI plugin
 *
 * @category   Admin_Util
 * @package    Extension_jquery 
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiVeneerManager extends PiJqueryExtension
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
    protected function init($options = null) {
        // js
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/ui/veneer/js/jquery.ui.veneer.js");
        
        //css
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/js/ui/veneer/css/jquery.ui.veneer.css");
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
        // Options management
        if (!isset($options['id']) || empty($options['id']))
            throw ExtensionException::optionValueNotSpecified('id', __CLASS__);

        // We open the buffer.
        ob_start ();        
        ?>
        
            <script type="text/javascript">
            //<![CDATA[
            
                jQuery(document).ready(function() {                    

                    $(".block_action_menu").css("display", 'none');
                    $(".widget_action_menu").css("display", 'none');

                    $("<?php echo $options['id']; ?>").click( function() {       
                        if ($(':ui-veneer').is(':visible')){
                            $("orchestra[id^='block__'] h6").css("display", 'none');
                            $(":ui-veneer").veneer( "destroy" );
                            $("orchestra[id^='block__']").off();
                            $("orchestra[id^='widget__']").off();
                        } else {
                            $(".captcha").remove();
                            // we set up the venner on all blocks
                            //$(".block_action_menu").css("display", 'inline-block');
                            //$("orchestra[id^='block__'] h6").css("display", 'block');
                            $("orchestra[id^='block__']").veneer( {disabled: true, title: "<span></span>"} );
                            $("orchestra[id^='block__'] h6").veneer( {collapsible: true, uiBorder: true, title: "WIDGET" } ).parent().css("display", 'both');

                            // we add the admin block Template to all widget
                            $("orchestra[id^='block__']").each(function(index) {
                                var id_block      = $(this).data('id');
                                var id_name_block = $(this).data("name");
                                /* Allow to draggable the block */
                                $("#ui-dialog-title-block__"+id_block+" span").html("ZONE " + id_name_block);
                            });

                            $( "orchestra[id^='block__']" )
                            .mouseenter(function() {
                                $( this ).find("h5.block_action_menu").attr("style", 'display:inline-block !important');
                            })
                            .mouseleave(function() {
                                $( this ).find("h5.block_action_menu").attr("style", 'display:none !important;');
                            });
                            $( "orchestra[id^='widget__']" )
                            .mouseenter(function() {
                                console.log('enter')
                                $( this ).find("h6.widget_action_menu").attr("style", 'display:block !important');
                            })
                            .mouseleave(function() {
                                console.log('out')
                                $( this ).find("h6.widget_action_menu").attr("style", 'display:none !important;');
                            });


                            /********************************
                             * copy widget action with draggable/droppable
                             ********************************/     
                            // we draggable all block
                            $("[data-drag^='dragmap_block']").draggable({ zIndex: 99999999999999999 });
                            // we set the tooltip on all titles of block actions.
                            $(".block_action_menu  [title]").tooltip({
                                  position: {
                                      track: true,
                                      my: "center bottom-20",
                                      at: "center top",
                                    }
                            });    
                            $(".widget_action_menu [title]").tooltip({
                                  position: {
                                      track: true,
                                      my: "center bottom-20",
                                      at: "center top",
                                    }
                            });
                                                 
                            var id_start_block = 0;
                            var id_end_block;
                            var id_widget;
                            $("[data-drag^='dragmap_widget']").draggable({
                                // axis: "y", // Le sortable ne s'applique que sur l'axe vertical
                                //containment: ".shoppingList", // Le drag ne peut sortir de l'élément qui contient la liste
                                //handle: ".item", // Le drag ne peut se faire que sur l'élément .item (le texte)
                                distance: 10, // Le drag ne commence qu'à partir de 10px de distance de l'élément
                                // This event is triggered when dragging starts.
                                start: function(event, ui){
                                    id_start_block = $(this).parent().parent().data('id');
                                    id_widget      = $(this).data('id');

                                    $(this).width('227px');
                                    $("[data-drag^='dragmap_block']").css('min-height', '100px');
                                    $("[data-overflow^='visible']").css("overflow","visible") ;
                                    $(".mcontentwrapper, .flexcroll").css("overflow","visible") ;

                                },
                                // This event is triggered when dragging stop.
                                stop: function(event, ui){
                                },
                                zIndex: 99999999999999999
                            });

                            $("[data-drag^='dragmap_block']").droppable({
                                // Lorsque l'on relache un élément sur un block
                                drop: function(event, ui){

                                    if (id_start_block != 0) {
                                        id_end_block = $(this).data("id");    
                                        //alert(id_start_block);
                                        //alert(id_end_block);

                                        // On supprimer l'élément de la page, le setTimeout est un fix pour IE (http://dev.jqueryui.com/ticket/4088)
                                        setTimeout(function() { ui.draggable.remove(); }, 1);                                

                                        $("#hProBar").progressbar({ 
                                            value: 100, 
                                            animationOptions: {
                                                duration: 10000
                                            }
                                        });

                                        $.ajax({
                                            url: "<?php echo $this->container->get('router')->generate('admin_widget_movewidget_page') ?>",
                                            data: "id_start_block=" + id_start_block + "&id_end_block=" + id_end_block + "&id_widget=" + id_widget,
                                            datatype: "json",
                                            //type: "POST",
                                            cache: false,
                                            "beforeSend": function ( xhr ) {
                                                //xhr.overrideMimeType("text/plain; charset=x-user-defined");
                                            },
                                            "statusCode": {
                                                404: function() {
                                                }
                                            }            
                                        }).done(function ( response ) {
                                            //var request = response[0].request;
                                            //alert(response);
                                            $("#hProBar").progressbar( "destroy" );
                                            window.location.href= "<?php echo $this->container->get('router')->generate('public_refresh_page') ?>";
                                 	    });
                                    }
                                },
                                // Lorsque l'on passe un élément au dessus d'un block
                                over: function(event, ui){
                                },
                                // Lorsque l'on quitte un block
                                out: function(event, ui){
                                }
                            });    
                                                        
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