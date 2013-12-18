<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Util
 * @package    Extension_jquery 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2013-10-15
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Util\PiJquery;

use Symfony\Component\DependencyInjection\ContainerInterface;

use PiApp\AdminBundle\Twig\Extension\PiJqueryExtension;
use PiApp\AdminBundle\Exception\ExtensionException;

/**
 * Dialog Jquery UI plugin
 *
 * @category   Admin_Util
 * @package    Extension_jquery 
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiDialogManager extends PiJqueryExtension
{
    /**
     * @var array
     * @static
     */
    static $actions = array('confirmdelete');
        
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
        //$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/");
        
        //css
        //$this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/");
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
        // Options management
        // Options management
        if (!isset($options['id']) || empty($options['id'])) {
        	throw ExtensionException::optionValueNotSpecified('id', __CLASS__);
        }        
        if (!isset($options['action']) || empty($options['action']) || (isset($options['action']) && !in_array(strtolower($options['action']), self::$actions)) ) {
            throw ExtensionException::optionValueNotSpecified('action', __CLASS__);
        }
        // set action name
        $action = strtolower($options['action']) . "Action";
        if (method_exists($this, $action)) {
            return $this->$action($options);
        } else {
            throw ExtensionException::MethodUnDefined($method);
        }        
    }
        
    /**
      * Set progress text for Progress flash dialog.
      * 
      * <code>
      *   <a href="#" title="{{ 'pi.grid.action.delete'|trans }}" class="confirm-dialog button-ui-delete2 info-tooltip"
      *        data-title="{{ 'pi.grid.action.delete.confirmation.title'|trans }}"
      *        data-msg="Etes-vous sure de vouloir supprimer le produit ?"
      *        data-url="{{ path('admin_provider_product_delete', { 'id': product.id, 'NoLayout':NoLayout, 'provider':entity.id}) }}">{{ 'pi.grid.action.delete'|trans }}
      *   </a> 
      *   {{ renderJquery('TOOL', 'dialog', {'id':'.confirm-dialog','action':'confirmdelete'})|raw }}
      * </code>
      *
      * @param    $options    tableau d'options.
      * @access protected
      * @return void
      *
      * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
      */
    protected function confirmdeleteAction($options = null)
    {        
        // We open the buffer.
        ob_start ();        
        ?>
            <script type="text/javascript">
            //<![CDATA[
                jQuery(document).ready(function() {                    
                	$('body').append('<div id="confirm-dialog-delete"><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><p></p></div>');
                    $ ("<?php echo $options['id']; ?>").click(function(e) {
                       	 e.preventDefault();
                       	 var confirm_url_redirection = $(this).data('url');
                       	 var confirm_title = $(this).data('title');
                       	 var confirm_msg = $(this).data('msg');
                       	 $("#confirm-dialog-delete").find('p').html(confirm_msg);
                       	 $("#confirm-dialog-delete").data('url', confirm_url_redirection);
                       	 $("#confirm-dialog-delete").dialog("option", "title", confirm_title);
                       	 $("#confirm-dialog-delete").dialog('open');
                    });
                    $("#confirm-dialog-delete").dialog({
                 		 autoOpen: false,
                 		 resizable: false,
                 		 height:140,
                 		 modal: true,
                 		 buttons: {
                     		 "<?php echo $this->container->get('translator')->trans('pi.form.tab.box.delete'); ?>": function() {
                     			window.location.href = $(this).data('url');
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
}