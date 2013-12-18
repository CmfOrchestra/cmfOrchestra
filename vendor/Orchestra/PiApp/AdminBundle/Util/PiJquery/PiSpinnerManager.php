<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Util
 * @package    Extension_jquery 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2013-11-05
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Util\PiJquery;

use Symfony\Component\DependencyInjection\ContainerInterface;

use PiApp\AdminBundle\Twig\Extension\PiJqueryExtension;
use PiApp\AdminBundle\Exception\ExtensionException;

/**
 * Spinner Jquery UI plugin
 *
 * @category   Admin_Util
 * @package    Extension_jquery 
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiSpinnerManager extends PiJqueryExtension
{
    /**
     * @var array
     * @static
     */
    static $actions = array('spinner');
        
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
    	// spinner
    	$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/spinner/spin.min.js");    	
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
      *   {{ renderJquery('TOOL', 'spinner', {'id':'spin','action':'spinner'})|raw }}
      * </code>
      *
      * @param    $options    tableau d'options.
      * @access protected
      * @return void
      *
      * @author (c) Etienne de Longeaux <etienne_delongeaux@hotmail.com>
      */
    protected function spinnerAction($options = null)
    {        
        // We open the buffer.
        ob_start ();        
        ?>
        	<div id='<?php echo $options['id']; ?>'></div>
            <script type="text/javascript">
            //<![CDATA[
                /* 
				 * JQUERY.SPIN.JS PLUGIN BY FGNASS
				 */
				(function(factory) {
				  if (typeof exports == 'object') {
				    // CommonJS
				    factory(require('jquery'), require('spin'))
				  }else if (typeof define == 'function' && define.amd) {
				    // AMD, register as anonymous module
				    define(['jquery', 'spin'], factory)
				  }else {
				    // Browser globals
				    if (!window.Spinner) throw new Error('Spin.js not present')
				    factory(window.jQuery, window.Spinner)
				  }
				}(function($, Spinner) {
				  $.fn.spin = function(opts, color) {
				    return this.each(function() {
				      var $this = $(this),data = $this.data();
				      if (data.spinner) {
				        data.spinner.stop();
				        delete data.spinner;
				      }
				      if (opts !== false) {
				        opts = $.extend(
				          { color: color || $this.css('color') },
				          $.fn.spin.presets[opts] || opts
				        )
				        data.spinner = new Spinner(opts).spin(this)
				      }
				    })
				  }
				  $.fn.spin.presets = {
				    tiny: { lines: 8, length: 2, width: 2, radius: 3 },
				    small: { lines: 8, length: 4, width: 3, radius: 5 },
				    large: { lines: 10, length: 8, width: 4, radius: 8 }
				  }
				}));
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