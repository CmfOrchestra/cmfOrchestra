<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Util
 * @package    Extension_jquery 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-03-01
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Util\PiJquery;

use Symfony\Component\DependencyInjection\ContainerInterface;

use PiApp\AdminBundle\Twig\Extension\PiJqueryExtension;
use PiApp\AdminBundle\Exception\ExtensionException;

/**
 * GridTable Jquery plugin
 *
 * @category   Admin_Util
 * @package    Extension_jquery 
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiGridTableManager extends PiJqueryExtension
{
    /**
     * @var array
     * @static
     */
    static $types = array('simple');
        
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
     * <code>
     * 
     * 	{% set options_gridtabale = {'grid-name': 'grid', 'grid-type':'simple', 
     *      'grid-server-side': 'true',
     *      'grid-state-save': 'false',
     * 		'grid-paginate':'true',
     * 		'grid-LengthMenu':10,
     *      'grid-filter-date': {
     * 			'0': {'column' : 7, 'title-start': 'date min crea. ', 'title-end': 'date max crea. ', 'right':'449', 'width':'197', 'format' : 'yy-mm-dd', 'idMin':'minc', 'idMax':'maxc'},
     *          '1': {'column' : 8, 'title-start': 'date min mod. ', 'title-end': 'date max mod. ', 'right':'291', 'width':'179', 'format' : 'yy-mm-dd', 'idMin':'minu', 'idMax':'maxu'},
     *      },
     * 		'grid-filters-select': ['0','4','5', '6'],
     * 		'grid-filters-active':'false',
     * 		'grid-filters': {
     * 				'1':'Identifiant',
     * 			},
     * 		'grid-sorting': { 
     * 				'1':'desc',
     * 			},	
     * 		'grid-visible': {
     * 				'0':'false',
     * 			},	
     * 		'grid-actions': {
     * 				'select_all': {'sButtonText':'pi.grid.action.select_all'},
     * 				'select_none': {'sButtonText':'pi.grid.action.select_none'},
     * 				'rows_enabled': {'sButtonText':'pi.grid.action.row_enabled', 'route':'admin_layout_enabledentity_ajax'},
     * 				'rows_disable': {'sButtonText':'pi.grid.action.row_disable', 'route':'admin_layout_disablentity_ajax'},
     * 				'rows_delete': {'sButtonText':'pi.grid.action.row_delete', 'route':'admin_layout_deletentity_ajax'},
     * 				
     * 				'copy': {'sButtonText':'pi.grid.action.copy'},
     * 				'print': {'sButtonText':'pi.grid.action.print'},
     * 				'export_pdf': {'sButtonText':'pi.grid.action.export'},				
     * 				'export_csv': {'sButtonText':'pi.grid.action.export'},
     * 				'export_xls': {'sButtonText':'pi.grid.action.export'},
     * 
     *              'rows_text_test': {'sButtonText':'test', 'route':'admin_layout_enabledentity_ajax', 'questionTitle':'Titre de mon action', 'questionText':'Etes-vous sûr de vouloir activer toutes les lignes suivantes ?', 'typeResponse':'ajaxResult', 'responseText':'Operation successfully'},
     *              
     *              'rows_grouping': {'Collapsible':'false', 
						'GroupBy':'name', 'columnIndex':2, 'HideColumn':'true', 'SortDirection':'desc',
					},
     * 			}				
     * 		}
     * 	%}
     * 	{{ renderJquery('GRID', 'grid-table', options_gridtabale )|raw }}
     * 
     * </code>
     * 
     * @access protected
     * @return void
     *
     * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     */    
    protected function init($options = null)
    {
        // datatable core
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/datatable/media/js/jquery.dataTables.min.js");
        
        // plugin Reordering
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/datatable/plugins/RowReordering/jquery.dataTables.rowReordering.js");
        
        // plugin RowGrouping
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/datatable/plugins/RowGrouping/media/js/jquery.dataTables.rowGrouping.js");
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/js/datatable/plugins/RowGrouping/media/css/dataTables.rowGrouping.default.css", "append");
        
        // plugin Toolsrows_position
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/datatable/extras/TableTools/media/js/TableTools.min.js");
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/datatable/extras/TableTools/media/js/ZeroClipboard.js");
        
        // plugin ColumnFilterWidgets
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/datatable/plugins/ColumnFilterWidgets/media/js/ColumnFilterWidgets.js");
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/js/datatable/plugins/ColumnFilterWidgets/media/css/ColumnFilterWidgets.css");
        
        // plugin colreorder
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/datatable/plugins/ColReorderWithResize/ColReorderWithResize.js");
        
        // plugin ColVis
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/datatable/extras/ColVis/media/js/ColVis.min.js");
        
        // plugin Editor
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/datatable/plugins/Editor/js/dataTables.editor.js");
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/js/datatable/plugins/Editor/css/dataTables.editor.css", "append");
        
        // plugin fancybox for dialog box
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/fancybox/jquery.fancybox.pack.js");
        
        // spinner
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/spinner/spin.min.js");

        // simple and multiselect managment
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/js/jquery/multiselect/css/jquery.multiselect.filter.css");
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/js/jquery/multiselect/css/jquery.multiselect.css");
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/jquery/multiselect/js/jquery.multiselect.js");
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/jquery/multiselect/js/jquery.multiselect.filter.js");
        
        // multi-select chained management
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/jquery/jquery.chained.remote.js");  

        // datepicker region
        $locale = strtolower(substr($this->locale, 0, 2));
        $root_file         = realpath($this->container->getParameter("kernel.root_dir") . "/../web/bundles/piappadmin/js/ui/i18n/jquery.ui.datepicker-{$locale}.js");
        if (!$root_file) {
        	$locale = "en-GB";
        }
        $this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/ui/i18n/jquery.ui.datepicker-{$locale}.js");        
        
        //http://datatables.net/forums/discussion/12443/scroller-extra-w-server-side-processing/p1
        //http://datatables.net/forums/discussion/14141/confirm-delete-on-tabletools/p1
    }    
    
    /**
      * Sets the grid render.
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
        if (!isset($options['grid-name']) || empty($options['grid-name'])) {
            throw ExtensionException::optionValueNotSpecified('grid-name', __CLASS__);
        }
        if (!isset($options['grid-type']) || empty($options['grid-type']) || (isset($options['grid-type']) && !in_array($options['grid-type'], self::$types))) {
            throw ExtensionException::optionValueNotSpecified('grid-type', __CLASS__);
        }
        
        if (!isset($options['grid-paginate']) || empty($options['grid-paginate'])) {
            $options['grid-paginate'] = true;
        }
        
        if ( $options['grid-type'] == "simple" ) {
            return $this->gridSimple($options);
        }
    }
    
    /**
     * Sets the grid server render.
     *
     * @param    $options    tableau d'options.
     * @access private
     * @return string
     *
     * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     */
    private function gridSimple($options = null)
    {
        $Urlpath         = $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/js/datatable/extras/TableTools/media/swf/copy_csv_xls_pdf.swf");
        $Urlenabled     = $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/css/themes/img/enabled.png");
        $Urldisabled     = $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/css/themes/img/disabled.png");
        $remove         = $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/css/themes/img/remove.png");
        $select_all        = $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/css/themes/img/select_all.png");
        $select_none    = $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/css/themes/img/select_none.png");
        $print            = $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/css/themes/img/print.png");
        $export            = $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/css/themes/img/export.png");
        $export_pdf        = $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/css/themes/img/export_pdf.png");
        $export_csv        = $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/css/themes/img/export_csv.png");
        $export_xls        = $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/css/themes/img/export_xls.png");
        $copy            = $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/css/themes/img/copy.png");
        $archive        = $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/css/themes/img/archive.png");
        $penabled        = $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/css/themes/img/penabled.png");
        $pdisable        = $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/css/themes/img/pdisable.png");
        $action            = $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/css/themes/img/action.png");        
        // we set the locale date format of datepicker
        $locale = strtolower(substr($this->locale, 0, 2));
        $root_file         = realpath($this->container->getParameter("kernel.root_dir") . "/../web/bundles/piappadmin/js/ui/i18n/jquery.ui.datepicker-{$locale}.js");
        if (!$root_file) {
        	$locale = "en-GB";
        }
        
        // We open the buffer.
        ob_start ();
        ?>
        
            <div id="confirm-popup-grid" style="display:none">
                <div class="fancybox-grid">
                    <section id="grid-html">
                        <header class="tt-grey">
                            <h3 id="grid-header">MESSAGE</h3>
                        </header>    
                        <div>&nbsp;</div>
                        <footer class="tt-grey">
                            <button type="button" id="grid-save" class="save"><?php echo $this->translator->trans('pi.grid.action.validate'); ?></button>
                        </footer>    
                    </section>
                </div>
            </div>        

            <div id="blocksearch_content">
                <div id="blocksearch" style="display:none" >
                    <table class="filter">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Filtre</th>
                            <th>Expression régulière</th>
                            <th>Use smart filter</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr id="filter_global">
                                <td>Global filtering</td>
                                <td><input type="text"     name="global_filter" id="global_filter"></td>
                                <td><input type="checkbox" name="global_regex"  id="global_regex" ></td>
                                <td><input type="checkbox" name="global_smart"  id="global_smart"  checked></td>
                            </tr>
                            <?php if (isset($options['grid-filters']) && !empty($options['grid-filters']) && is_array($options['grid-filters'])){ ?>
                                <?php foreach($options['grid-filters'] as $id => $colName){ ?>
                                    <tr id="filter_col<?php echo $id; ?>">
                                        <td><?php echo $colName; ?></td>
                                        <td><input type="text"     name="col<?php echo $id; ?>_filter" id="col<?php echo $id; ?>_filter"></td>
                                        <td><input type="checkbox" name="col<?php echo $id; ?>_regex"  id="col<?php echo $id; ?>_regex"></td>
                                        <td><input type="checkbox" name="col<?php echo $id; ?>_smart"  id="col<?php echo $id; ?>_smart" checked></td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>    
                        </tbody>
                    </table>
                </div>
            </div>
            
            <script type="text/javascript">
            //<![CDATA[
                    function fnFilterGlobal ()
                    {
                        $('#<?php echo $options['grid-name']; ?>').dataTable().fnFilter( 
                            $("#global_filter").val(),
                            null, 
                            $("#global_regex")[0].checked, 
                            $("#global_smart")[0].checked
                        );
                    }
                     
                    function fnFilterColumn ( i )
                    {
                        $('#<?php echo $options['grid-name']; ?>').dataTable().fnFilter( 
                            $("#col"+(i+1)+"_filter").val(),
                            i, 
                            $("#col"+(i+1)+"_regex")[0].checked, 
                            $("#col"+(i+1)+"_smart")[0].checked
                        );
                    }

					function fnCreateSelect( aData, title, myColumnID)
					{
						var mySelectID = 'select_' + myColumnID;
    					var options = $("<select id='"+mySelectID+"' name='"+mySelectID+"' class='filtSelect' style='width:auto' multiple='multiple'  />"),
    				    addOptions = function(opts, container){
    						container.append($("<option />").val('').text('<?php echo $this->translator->trans('pi.page.All'); ?>'));
    				        $.each(opts, function(i, opt) {
    				            if(typeof(opt)=='string'){
    				            	if(typeof(i)=='string'){
    				                container.append($("<option />").val(i).text(opt));
    				            	}else{
    				            		container.append($("<option />").val(opt).text(opt));
    				            	}
    				            } else {
    				                var optgr = $("<optgroup />").attr('label',i);
    				                addOptions(opt, optgr)
    				                container.append(optgr);
    				            }
    				        });
    				    };

    				    options.css('width', '100%')
    					addOptions(aData,options);
    					return options;
					}  

                    $.extend( $.fn.dataTableExt.oSort, {
    				    "num-html-pre": function ( a ) {
    				        var x = a.replace( /<.*?>/g, "" );
    				        x = x.replace( "%", "" );
    				        if(x == " ") { x=-1; }
    				        return parseFloat( x );
    				    },    				 
    				    "num-html-asc": function ( a, b ) {
    				        return ((a < b) ? -1 : ((a > b) ? 1 : 0));
    				    },
    				 
    				    "num-html-desc": function ( a, b ) {
    				        return ((a < b) ? 1 : ((a > b) ? -1 : 0));
    				    }
    				} );

    				$.fn.dataTableExt.oSort['numeric-comma-asc']  = function(a,b) {
    					var x = (a == "-") ? 0 : a.replace( /,/, "." );
    					var y = (b == "-") ? 0 : b.replace( /,/, "." );
    					x = parseFloat( x );
    					y = parseFloat( y );
    					return ((x < y) ? -1 : ((x > y) ?  1 : 0));
    				};
    				
    				$.fn.dataTableExt.oSort['numeric-comma-desc'] = function(a,b) {
    					var x = (a == "-") ? 0 : a.replace( /,/, "." );
    					var y = (b == "-") ? 0 : b.replace( /,/, "." );
    					x = parseFloat( x );
    					y = parseFloat( y );
    					return ((x < y) ?  1 : ((x > y) ? -1 : 0));
    				}; 


    				var $tfoot_grid;

    				
    				(function($) {
    					/*
    					 * Function: fnGetColumnData
    					 * Purpose:  Return an array of table values from a particular column.
    					 * Returns:  array string: 1d data array
    					 * Inputs:   object:oSettings - dataTable settings object. This is always the last argument past to the function
    					 *           int:iColumn - the id of the column to extract the data from
    					 *           bool:bUnique - optional - if set to false duplicated values are not filtered out
    					 *           bool:bFiltered - optional - if set to false all the table data is used (not only the filtered)
    					 *           bool:bIgnoreEmpty - optional - if set to false empty values are not filtered from the result array
    					 * Author:   Benedikt Forchhammer <b.forchhammer /AT\ mind2.de>
    					 */
    					$.fn.dataTableExt.oApi.fnGetColumnData = function ( oSettings, iColumn, bUnique, bFiltered, bIgnoreEmpty ) {
    					    // check that we have a column id
    					    if ( typeof iColumn == "undefined" ) return new Array();
    					     
    					    // by default we only want unique data
    					    if ( typeof bUnique == "undefined" ) bUnique = true;
    					     
    					    // by default we do want to only look at filtered data
    					    if ( typeof bFiltered == "undefined" ) bFiltered = true;
    					     
    					    // by default we do not want to include empty values
    					    if ( typeof bIgnoreEmpty == "undefined" ) bIgnoreEmpty = true;
    					     
    					    // list of rows which we're going to loop through
    					    var aiRows;
    					     
    					    // use only filtered rows
    					    if (bFiltered == true) aiRows = oSettings.aiDisplay;
    					    // use all rows
    					    else aiRows = oSettings.aiDisplayMaster; // all row numbers
    					 
    					    // set up data array   
    					    var asResultData = new Array();
    					     
    					    for (var i=0,c=aiRows.length; i<c; i++) {
    					        iRow = aiRows[i];
    					        var aData = this.fnGetData(iRow);
    					        var sValue = aData[iColumn];
                                                
    					        // Error lorsque sValue = null
								if(sValue == null) continue;
                                                
                                // ignore empty values?
    					        else if (bIgnoreEmpty == true && sValue.length == 0) continue;
    					 
    					        // ignore unique values?
    					        else if (bUnique == true && jQuery.inArray(sValue, asResultData) > -1) continue;
    					         
    					        // else push the value onto the result data array
    					        else asResultData.push(sValue);
    					    }
    					     
    					    return asResultData;
    				}}(jQuery));
    					 

    				<?php if(isset($options['grid-filter-date'])): ?>
    				    <?php foreach($options['grid-filter-date'] as $id => $gridDateFilter){ ?>
        				    // http://live.datatables.net/etewoq/4/edit#javascript,html,live
        				    var <?php echo $gridDateFilter['idMin']; ?>DateFilter;
        				    var <?php echo $gridDateFilter['idMax']; ?>DateFilter;
            				$('#<?php echo $options['grid-name']; ?>').before('<div id="filter-grid-date-<?php echo $id; ?>" style="position: absolute;z-index: 1;right: <?php echo $gridDateFilter['right']; ?>px;width: <?php echo $gridDateFilter['width']; ?>px;margin: 19px 0 0 0;"><span style="margin: 0 7px 0 0;"><?php echo $gridDateFilter['title-start']; ?><input type="text" id="<?php echo $gridDateFilter['idMin']; ?>" name="<?php echo $gridDateFilter['idMin']; ?>" style="width:67px"></span><span style="margin: 0 0 0 0;"><?php echo $gridDateFilter['title-end']; ?><input type="text" id="<?php echo $gridDateFilter['idMax']; ?>" name="<?php echo $gridDateFilter['idMax']; ?>" style="width:67px"></span></div>');
            				$("#<?php echo $gridDateFilter['idMax']; ?>").datepicker({
                                changeMonth: true,
                                changeYear: true,
                                yearRange: "-71:+11",
                                reverseYearRange: true,
                                showOtherMonths: true,
                                showButtonPanel: true,
                                showAnim: "fade",  // blind fade explode puff fold
                                showWeek: true,
                                dateFormat: "<?php echo $gridDateFilter['format']; ?>",
                                showOptions: { 
                                    direction: "up" 
                                },
                                numberOfMonths: [ 1, 2 ],
                                buttonText: "<?php echo $this->translator->trans('pi.form.label.select.choose.date'); ?>",
                                showOn: "both",
                                buttonImage: "/bundles/piappadmin/images/icons/form/picto-calendar.png",
                                "onSelect": function(date) {
                                	<?php echo $gridDateFilter['idMax']; ?>DateFilter = new Date(date).getTime();
                                    <?php echo $options['grid-name']; ?>oTable.fnDraw();
                                  }
                            }).keyup( function () {
                            	<?php echo $gridDateFilter['idMax']; ?>DateFilter = new Date(this.value).getTime();
                                <?php echo $options['grid-name']; ?>oTable.fnDraw();
                            } );
            				$("#<?php echo $gridDateFilter['idMin']; ?>").datepicker({
                                changeMonth: true,
                                changeYear: true,
                                yearRange: "-71:+11",
                                reverseYearRange: true,
                                showOtherMonths: true,
                                showButtonPanel: true,
                                showAnim: "fade",  // blind fade explode puff fold
                                showWeek: true,
                                dateFormat: "<?php echo $gridDateFilter['format']; ?>",
                                showOptions: { 
                                    direction: "up" 
                                },
                                numberOfMonths: [ 1, 2 ],
                                buttonText: "<?php echo $this->translator->trans('pi.form.label.select.choose.date'); ?>",
                                showOn: "both",
                                buttonImage: "/bundles/piappadmin/images/icons/form/picto-calendar.png",
                                "onSelect": function(date) {
                                	<?php echo $gridDateFilter['idMin']; ?>DateFilter = new Date(date).getTime();
                                    <?php echo $options['grid-name']; ?>oTable.fnDraw();
                                  }
                            }).keyup( function () {
                            	<?php echo $gridDateFilter['idMin']; ?>DateFilter = new Date(this.value).getTime();
                                <?php echo $options['grid-name']; ?>oTable.fnDraw();
                            } );
            				$.datepicker.setDefaults( $.datepicker.regional[ "<?php echo strtolower(substr($locale, 0, 2)); ?>" ] );
            				<?php if(isset($options['grid-server-side']) && (($options['grid-server-side'] == 'true') || ($options['grid-server-side'] == true)) ) : ?>
            				<?php else: ?>
            				$.fn.dataTableExt.afnFiltering.push(
            						  function( oSettings, aData, iDataIndex ) {
            						    if ( typeof aData._date == 'undefined' ) {
            						      aData._date = new Date(aData["<?php echo $gridDateFilter['column']; ?>"]).getTime();
            						    }
    
            						    if ( <?php echo $gridDateFilter['idMin']; ?>DateFilter && !isNaN(<?php echo $gridDateFilter['idMin']; ?>DateFilter) ) {
            						      if ( aData._date < <?php echo $gridDateFilter['idMin']; ?>DateFilter ) {
            						        return false;
            						      }
            						    }
            						    
            						    if ( <?php echo $gridDateFilter['idMax']; ?>DateFilter && !isNaN(<?php echo $gridDateFilter['idMax']; ?>DateFilter) ) {
            						      if ( aData._date > <?php echo $gridDateFilter['idMax']; ?>DateFilter ) {
            						        return false;
            						      }
            						    }
            						    
            						    return true;
            						  }
            						);
            				<?php endif; ?>  
        				<?php } ?> 
    				<?php endif; ?> 

                    var enabled;
                    var disablerow;
                    var deleterow;
                    var archiverow;

                    var <?php echo $options['grid-name']; ?>oTable;
                    var envelopeConf = $.fn.dataTable.Editor.display.envelope.conf;
                    envelopeConf.attach = 'head';
                    envelopeConf.windowScroll = false;       

                    $("a.button-ui-show").button({icons: {primary: "ui-icon-show"}});
                    $("a.button-ui-edit").button({icons: {primary: "ui-icon-edit"}});

                    $("td.enabled").each(function(index) {
                        var value = $(this).html();
                        if (value == 1)
                            $(this).html('<img width="17px" src="<?php echo $Urlenabled ?>">');
                        if (value == 0)
                            $(this).html('<img width="17px" src="<?php echo $Urldisabled ?>">');                        
                    });                                        

                    $('#<?php echo $options['grid-name']; ?> tbody tr').each(function(index) {
                        $(this).find("td.position").prependTo(this);
                    });
                    $('#<?php echo $options['grid-name']; ?> thead tr').each(function(index) {
                        $(this).find("th.position").prependTo(this);
                    });

                    /* Add the events etc before DataTables hides a column  Filter on the column (the index) of this element
                    $("tfooter input").keyup( function () {
                        <?php echo $options['grid-name']; ?>oTable.fnFilter( this.value, <?php echo $options['grid-name']; ?>oTable.oApi._fnVisibleToColumnIndex( 
                                <?php echo $options['grid-name']; ?>oTable.fnSettings(), $("thead input").index(this) ) );
                    } );
					*/
                    
                    <?php if (isset($options['grid-actions']) && !empty($options['grid-actions']) && is_array($options['grid-actions'])): ?>
                        <?php foreach($options['grid-actions'] as $actionName => $params): ?>
                            <?php if ( ($actionName == "rows_enabled") && isset($params['route']) && !empty($params['route']) ) : ?>
                            // Set up enabled row
                            enabled = new $.fn.dataTable.Editor( {
                                "domTable": "#<?php echo $options['grid-name']; ?>",
                                //"display": "envelope",
                                "ajaxUrl": "<?php echo $this->container->get('router')->generate($params['route']) ?>",
                                "events": {
                                    "onPreSubmit": function (data) {
                                        console.log(data);
                                    },
                                    "onPostSubmit": function (json, data) {
                                        console.log(json);
                                        console.log(data);
                                    },                                    
                                    "onPreRemove": function (json) {
                                        //console.log(json);
                                    },
                                    "onPostRemove": function (json) {
                                        //console.log(json);
                                    }
                                }                    
                            } );
                            <?php elseif ( ($actionName == "rows_disable") && isset($params['route']) && !empty($params['route']) ): ?>
                            // Set up disable row
                            disablerow = new $.fn.dataTable.Editor( {
                                "domTable": "#<?php echo $options['grid-name']; ?>",
                                //"display": "envelope",
                                "ajaxUrl": "<?php echo $this->container->get('router')->generate($params['route']) ?>",
                                "events": {
                                    "onPreSubmit": function (data) {
                                        console.log(data);
                                    },
                                    "onPostSubmit": function (json, data) {
                                        console.log(json);
                                        console.log(data);
                                    },                                    
                                    "onPreRemove": function (json) {
                                        //console.log(json);
                                    },
                                    "onPostRemove": function (json) {
                                        //console.log(json);
                                    }
                                }    
                            } );
                            <?php elseif ( ($actionName == "rows_delete") && isset($params['route']) && !empty($params['route']) ): ?>
                            // Set up delete row
                            deleterow = new $.fn.dataTable.Editor( {
                                "domTable": "#<?php echo $options['grid-name']; ?>",
                                //"display": "envelope",
                                "ajaxUrl": "<?php echo $this->container->get('router')->generate($params['route']) ?>"
                            } );
                            <?php elseif ( ($actionName == "rows_archive") && isset($params['route']) && !empty($params['route']) ): ?>
                            // Set up archive row
                            archiverow = new $.fn.dataTable.Editor( {
                                "domTable": "#<?php echo $options['grid-name']; ?>",
                                //"display": "envelope",
                                "ajaxUrl": "<?php echo $this->container->get('router')->generate($params['route']) ?>"
                            } );                            
                            <?php elseif ( !empty($actionName) && (strstr($actionName, 'rows_default_') != "") && isset($params['route']) && !empty($params['route']) ): ?>
                            // Set up archive row
                            defaultrow_<?php echo $actionName; ?> = new $.fn.dataTable.Editor( {
                                "domTable": "#<?php echo $options['grid-name']; ?>",
                                //"display": "envelope",fnServerData
                                "ajaxUrl": "<?php echo $this->container->get('router')->generate($params['route']) ?>"
                            } );                            
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>    

                    <?php echo $options['grid-name']; ?>oTable = $('#<?php echo $options['grid-name']; ?>').dataTable({
                        "bPaginate":<?php echo $options['grid-paginate']; ?>,
                        "bRetrieve":true,
                        "bFilter": true,
                        "sPaginationType": "full_numbers",
                        "bJQueryUI":true,
                        "bAutoWidth": false,
                        "bProcessing": true,
                        
                        <?php if(isset($options['grid-state-save']) && ($options['grid-state-save'] == 'true')) : ?>
                        "bStateSave": true,
                        <?php else: ?>
                        "bStateSave": false,
                        <?php endif; ?>

                        <?php if(isset($options['grid-server-side']) && (($options['grid-server-side'] == 'true') || ($options['grid-server-side'] == true)) ) : ?>
                        "bServerSide": true,
                        "sAjaxSource": "<?php echo $this->container->get('request')->getRequestUri(); ?>",
                        'fnServerData' : function ( sSource, aoData, fnCallback ) {
                        	<?php if (isset($options['grid-filter-date'])): ?>
                            	<?php foreach($options['grid-filter-date'] as $id => $gridDateFilter){ ?>
    						    aoData.push( { 'name' : 'date-<?php echo $gridDateFilter['idMin']; ?>', 'value' : $("#<?php echo $gridDateFilter['idMin']; ?>").val() } );
    						    aoData.push( { 'name' : 'date-<?php echo $gridDateFilter['idMax']; ?>', 'value' : $("#<?php echo $gridDateFilter['idMax']; ?>").val() } );
    						    <?php } ?>
						    <?php endif; ?>
					        
					        //$.getJSON( sSource, aoData, function (json) {
					            /* Do whatever additional processing you want on the callback, then tell DataTables */
					        //    fnCallback(json)
					        //} );						    
					        $.ajax({
							    'dataType' : 'json',
							    'data' : aoData,
							    'type' : 'POST',
							    'url' : sSource,
							    'success' : fnCallback
						    });
					    },
					    "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
							/* Append the grade to the default row class name */ 
						    var id = aData[0];
						    $(nRow).attr("id",id);
							return nRow;
						},
                        "fnInfoCallback": function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {  
                            $("a.info-tooltip").tooltip({
                                position: {
                                    track: true,
                                    my: "center bottom-20",
                                    at: "center top",
                                  },
                                content: function () {
                                      return $(this).prop('title');
                                  }                            
                            });
                            $("a.button-ui-show").button({icons: {primary: "ui-icon-show"}});
                            $("a.button-ui-edit").button({icons: {primary: "ui-icon-edit"}});

                            /* Add a select menu for each TH element in the table footer */
                            /* http://datatables.net/forums/discussion/comment/33095 */
                            $tfoot_grid = $("tfoot th").each( function ( i ) {
                                var column = $(this).data('column');
                                var values = $(this).data('values');
                                var type = $(this).data('type');
                                var title = $(this).data('title');
                                if (column != undefined) {
                                	var options = [];
                                	$('select', this).find(':selected').each(function(j,v){
                                		options[j] = $(v).val();
								    });
                                	if (values == undefined) {
                                		values = <?php echo $options['grid-name']; ?>oTable.fnGetColumnData(column) 
    	                            }
    	                            if (type != "input") {
 	                            		$(this).html( fnCreateSelect( values, title, i) ); 
								    }     
								    $('select', this).val(options);
									$('select', this).change( function () {
										var values = $("#select_"+i).val().join('|');
							            <?php echo $options['grid-name']; ?>oTable.fnFilter( values, column, true );
							        });
							        $("#select_"+i).multiselect({
							        	multiple: true,
							        	header: true,
							        	noneSelectedText: title,
								        create: function(){ $(this).next().width('auto');$(this).multiselect("widget").width('auto'); },
								        open: function(){ $(this).next().width('auto');$(this).multiselect("widget").width('auto'); },
								    }).multiselectfilter();	
                                } else {
                                	this.innerHTML = '' ;
                                }
                            });					        
                        },                                               
                        <?php endif; ?>                         

                        <?php if (isset($options['grid-sorting']) && !empty($options['grid-sorting']) && is_array($options['grid-sorting'])): ?>
                        "aaSorting": 
                            [
                                <?php foreach($options['grid-sorting'] as $id => $odrer): ?>
                                    [<?php echo $id; ?>,'<?php echo $odrer; ?>'],                
                                <?php endforeach; ?>                                    
                            ],
                        <?php endif; ?>

                        <?php if (isset($options['grid-columns']) && !empty($options['grid-columns']) && is_array($options['grid-columns'])): ?>
                        "aoColumns": 
                            [
                               <?php foreach($options['grid-columns'] as $key => $value): ?>
                                    <?php echo json_encode($value, true); ?>,                
                                <?php endforeach; ?>             
                            ],
                        <?php endif; ?>                        
                            
                        "aLengthMenu": [[1, 5, 10, 15, 20, 25, 50, 100, 500, 1000, 5000 -1], [1, 5, 10, 15, 20, 25, 50, 100, 500, 1000, 5000, "All"]],
                        <?php if ( isset($options['grid-LengthMenu']) && !empty($options['grid-LengthMenu']) ): ?>
                        "iDisplayLength": <?php echo $options['grid-LengthMenu']; ?>,
                        <?php else: ?>
                        "iDisplayLength": 25,
                        <?php endif; ?>        
                            
                        "oLanguage": {
                            "sLoadingRecords": "<div id='spin'></div><?php echo $this->translator->trans('pi.grid.action.waiting'); ?>",
                            "sProcessing": "<div id='spin' style='display:block;width:24px;height:24px;float:left;margin: 6px 2px;'></div><?php echo $this->translator->trans('pi.grid.action.waiting'); ?>",
                            "sLengthMenu": "<?php echo $this->translator->trans('pi.grid.action.lenghtmenu'); ?>",
                            "sZeroRecords": "Nothing found - sorry",
                            "sInfo": "<?php echo $this->translator->trans('pi.grid.action.info'); ?>",
                            "sInfoEmpty": "<?php echo $this->translator->trans('pi.grid.action.info.empty'); ?>",
                            "sInfoFiltered": "<?php echo $this->translator->trans('pi.grid.action.info.filtered'); ?>",
                            "sInfoPostFix": "",
                            "sSearch": "<?php echo $this->translator->trans('pi.grid.action.search'); ?>",
                            "sUrl": "",
                            "oPaginate": {
                                "sFirst":    "<?php echo $this->translator->trans('pi.grid.action.first'); ?>",
                                "sPrevious": "<?php echo $this->translator->trans('pi.grid.action.previous'); ?>",
                                "sNext":     "<?php echo $this->translator->trans('pi.grid.action.next'); ?>",
                                "sLast":     "<?php echo $this->translator->trans('pi.grid.action.last'); ?>"
                            }
                        },
                        // l - Length changing
                        // f - Filtering input
                        // t - The table!
                        // i - Information
                        // p - Pagination
                        // r - pRocessing
                        // < and > - div elements
                        // <"class" and > - div with a class
                        // Examples: <"wrapper"flipt>, <lf<t>ip>
                        //avec multi-filtre : "sDom": '<"block_filter"><"H"RTfr<"clear"><?php if (isset($options["grid-filters-select"])){ echo "W"; } ?>>tC<"F"lpi>',
                        <?php if(isset($options['grid-filters']) && isset($options['grid-filters-active']) && ($options['grid-filters-active'] == 'true')) : ?>
                        "sDom": '<"block_filter"><"H"RTfr<"clear"><?php if(isset($options["grid-filters-select"])){ echo "W"; } ?><"clear">p<"clear">>tC<"F"lpi>',
                        <?php else: ?>
                            <?php if((isset($options['grid-paginate-top']) && (($options['grid-paginate-top'] == 'false') || ($options['grid-paginate-top'] == false))) ) : ?>
                            "sDom": '<"H"RTfr<"clear"><?php if(isset($options["grid-filters-select"])){ echo "W"; } ?>>tC<"F"lpi>',
                            <?php else: ?>
                            "sDom": '<"H"RTfr<"clear"><?php if(isset($options["grid-filters-select"])){ echo "W"; } ?><"clear">p<"clear">>tC<"F"lpi>',
                            <?php endif; ?>

                        <?php endif; ?>

                        "oTableTools": {
                            "sSwfPath": "<?php echo $Urlpath; ?>",
                            "sRowSelect": "multi",
                            "aButtons": [


                        <?php if (isset($options['grid-actions']) && !empty($options['grid-actions']) && is_array($options['grid-actions'])): ?>
                            <?php foreach($options['grid-actions'] as $actionName => $params): ?>
                                    <?php if ($actionName == "rows_enabled"): ?>
                                            <?php if (!isset($params['sButtonText']) || empty($params['sButtonText']) ) $params['sButtonText'] = 'pi.grid.action.rows_enabled'; ?>
                                            {
                                                "sExtends": "editor_remove",
                                                "sButtonText": "<img class='btn-action' src='<?php echo $penabled ?>' title='<?php echo $this->translator->trans('pi.grid.action.row_enabled'); ?>' alt='<?php echo $this->translator->trans('pi.grid.action.row_enabled'); ?>'  height='28' width='28' />",
                                                "editor": enabled,
                                                "formButtons": [
                                                    {
                                                        "label": "Valider",
                                                        "className": "save",
                                                        "fn": function (e) {
                                                            this.submit(function(){
                                                                <?php if (isset($params['reload']) && ($params['reload'] == 1) ) : ?>
                                                                window.location.reload();
                                                                <?php endif; ?>
                                                            });
                                                            $("tr.DTTT_selected td.enabled").html('<img width="17px" src="<?php echo $Urlenabled ?>">');
                                                        }
                                                    }
                                                ],
                                                <?php if (!isset($params['questionTitle']) || empty($params['questionTitle']) ) : ?>
                                                "formTitle": "Activer données",
                                                  <?php else: ?>
                                                "formTitle": "<?php echo $this->translator->trans($params['questionTitle']); ?>",
                                                  <?php endif; ?>
                                                "question": function(b) {
                                                  <?php if (!isset($params['questionText']) || empty($params['questionText']) ) : ?>
                                                    return "Voulez-vous activer " + b + " ligne" + (b === 1 ? " ?" : "s ?")
                                                      <?php else: ?>
                                                    return "<?php echo $this->translator->trans($params['questionText']); ?>"
                                                      <?php endif; ?>                                                  
                                                },
                                            },
                                    <?php elseif ($actionName == "rows_disable"): ?>
                                            <?php if (!isset($params['sButtonText']) || empty($params['sButtonText']) ) $params['sButtonText'] = 'pi.grid.action.rows_disable'; ?>
                                            {
                                                "sExtends": "editor_remove",
                                                "sButtonText": "<img class='btn-action' src='<?php echo $pdisable ?>' title='<?php echo $this->translator->trans('pi.grid.action.row_disable'); ?>' alt='<?php echo $this->translator->trans('pi.grid.action.row_disable'); ?>'  height='28' width='28' />",
                                                "editor": disablerow,
                                                "formButtons": [
                                                    {
                                                        "label": "Valider",
                                                        "className": "save",
                                                        "fn": function (e) {
                                                            this.submit(function(){
                                                                <?php if (isset($params['reload']) && ($params['reload'] == 1) ) : ?>
                                                                window.location.reload();
                                                                <?php endif; ?>
                                                            });
                                                            $("tr.DTTT_selected td.enabled").html('<img width="17px" src="<?php echo $Urldisabled ?>">');
                                                        }
                                                    }
                                                ],
                                                <?php if (!isset($params['questionTitle']) || empty($params['questionTitle']) ) : ?>
                                                "formTitle": "Désactiver données",
                                                  <?php else: ?>
                                                "formTitle": "<?php echo $this->translator->trans($params['questionTitle']); ?>",
                                                  <?php endif; ?>
                                                "question": function(b) {
                                                  <?php if (!isset($params['questionText']) || empty($params['questionText']) ) : ?>
                                                    return "Voulez-vous désactiver " + b + " ligne" + (b === 1 ? " ?" : "s ?")
                                                      <?php else: ?>
                                                    return "<?php echo $this->translator->trans($params['questionText']); ?>"
                                                      <?php endif; ?>                                                  
                                                }
                                            },                                            
                                    <?php elseif ($actionName == "rows_delete"): ?>
                                            <?php if (!isset($params['sButtonText']) || empty($params['sButtonText']) ) $params['sButtonText'] = 'pi.grid.action.row_delete'; ?>
                                            {
                                                "sExtends": "editor_remove",
                                                "sButtonText": "<img class='btn-action' src='<?php echo $remove; ?>' title='<?php echo $this->translator->trans('pi.grid.action.row_delete'); ?>' alt='<?php echo $this->translator->trans('pi.grid.action.row_delete'); ?>'  height='28' width='28' />",
                                                "editor": deleterow,
                                                "formButtons": [
                                                    {
                                                        "label": "Valider",
                                                        "className": "save",
                                                        "fn": function (e) {
                                                            this.submit(function(){
                                                                <?php if (isset($params['reload']) && ($params['reload'] == 1) ) : ?>
                                                                window.location.reload();
                                                                <?php endif; ?>
                                                                
                                                                <?php if (isset($params['remove']) && ($params['remove'] == 1) ) : ?>
                                                                $("tr.DTTT_selected td").remove();
                                                                <?php endif; ?>
                                                            });
                                                        },
                                                    }
                                                ],
                                                <?php if (!isset($params['questionTitle']) || empty($params['questionTitle']) ) : ?>
                                                "formTitle": "Suppression de données",
                                                  <?php else: ?>
                                                "formTitle": "<?php echo $this->translator->trans($params['questionTitle']); ?>",
                                                  <?php endif; ?>
                                                "question": function(b) {
                                                  <?php if (!isset($params['questionText']) || empty($params['questionText']) ) : ?>
                                                    return "Voulez-vous supprimer " + b + " ligne" + (b === 1 ? " ?" : "s ?")
                                                      <?php else: ?>
                                                    return "<?php echo $this->translator->trans($params['questionText']); ?>"
                                                      <?php endif; ?>                                                  
                                                }
                                            },
                                    <?php elseif ($actionName == "rows_archive"): ?>
                                            <?php if (!isset($params['sButtonText']) || empty($params['sButtonText']) ) $params['sButtonText'] = 'pi.grid.action.row_archive'; ?>
                                            {
                                                "sExtends": "editor_remove",
                                                "sButtonText": "<img class='btn-action' src='<?php echo $archive ?>' title='<?php echo $this->translator->trans('pi.grid.action.row_archive'); ?>' alt='<?php echo $this->translator->trans('pi.grid.action.row_archive'); ?>'  height='28' width='28' />",
                                                "editor": archiverow,
                                                "formButtons": [
                                                    {
                                                        "label": "Valider",
                                                        "className": "save",
                                                        "fn": function (e) {
                                                            this.submit(function(){
                                                                <?php if (isset($params['reload']) && ($params['reload'] == 1) ) : ?>
                                                                window.location.reload();
                                                                <?php endif; ?>

                                                                <?php if (isset($params['remove']) && ($params['remove'] == 1) ) : ?>
                                                                $("tr.DTTT_selected td").remove();
                                                                <?php endif; ?>
                                                            });
                                                        },
                                                    }
                                                ],
                                                <?php if (!isset($params['questionTitle']) || empty($params['questionTitle']) ) : ?>
                                                "formTitle": "Archiver données",
                                                  <?php else: ?>
                                                "formTitle": "<?php echo $this->translator->trans($params['questionTitle']); ?>",
                                                  <?php endif; ?>
                                                "question": function(b) {
                                                  <?php if (!isset($params['questionText']) || empty($params['questionText']) ) : ?>
                                                    return "Voulez-vous archiver " + b + " ligne" + (b === 1 ? " ?" : "s ?")
                                                      <?php else: ?>
                                                    return "<?php echo $this->translator->trans($params['questionText']); ?>"
                                                      <?php endif; ?>                                                  
                                                }
                                            },
                                    <?php elseif ($actionName == "select_all"): ?>
                                            {
                                                "sExtends": "select_all",
                                                "sButtonText": "<img class='btn-action' src='<?php echo $select_all ?>' title='<?php echo $this->translator->trans('pi.grid.action.select_all'); ?>' alt='<?php echo $this->translator->trans('pi.grid.action.select_all'); ?>'  height='28' width='28' />",
                                                "fnComplete": function ( nButton, oConfig, oFlash, sFlash ) {
                                                    $("input[type=checkbox]").prop('checked', false);
                                                },
                                            },    
                                    <?php elseif ($actionName == "select_none"): ?>
                                            {
                                                "sExtends": "select_none",
                                                "sButtonText": "<img class='btn-action' src='<?php echo $select_none ?>' title='<?php echo $this->translator->trans('pi.grid.action.select_none'); ?>' alt='<?php echo $this->translator->trans('pi.grid.action.select_none'); ?>'  height='28' width='28' />",
                                                "fnComplete": function ( nButton, oConfig, oFlash, sFlash ) {
                                                    $("input[type=checkbox]").prop('checked', false);
                                                },
                                            },                                                                                                                                
                                    <?php elseif ($actionName == "copy"): ?>
                                            {
                                                "sExtends": "copy",
                                                "sButtonText": "<img class='btn-action' src='<?php echo $copy ?>' title='<?php echo $this->translator->trans('pi.grid.action.copy'); ?>' alt='<?php echo $this->translator->trans('pi.grid.action.copy'); ?>'  height='28' width='28' />",
                                            },
                                    <?php elseif ($actionName == "print"): ?>
                                            {
                                                "sExtends": "print",
                                                "sButtonText": "<img class='btn-action' src='<?php echo $print; ?>' title='<?php echo $this->translator->trans('pi.grid.action.print'); ?>' alt='<?php echo $this->translator->trans('pi.grid.action.print'); ?>'  height='28' width='28' />",
                                            },
                                    <?php elseif ($actionName == "export"): ?>
                                            <?php if(!isset($params['sTitle']) || empty($params['sTitle']) ) $params['sTitle'] = 'Orchestra'; ?>
                                            {
                                                "sExtends":    "collection",
                                                "sButtonText": "<?php echo $this->translator->trans('pi.grid.action.export'); ?>",
                                                "aButtons":    [ 
                                                                 {
                                                                     "sExtends": "csv",
                                                                     "sTitle": "<?php echo $this->translator->trans($params['sTitle']); ?>"
                                                                 },                                                                     
                                                                 {
                                                                     "sExtends": "xls",
                                                                     "sTitle": "<?php echo $this->translator->trans($params['sTitle']); ?>"
                                                                 },
                                                                 {
                                                                    "sExtends": "pdf",
                                                                    "sPdfOrientation": "landscape",
                                                                    "sPdfMessage": "PDF export (<?php echo date("Y/m/d"); ?>)",
                                                                    "sTitle": "<?php echo $this->translator->trans($params['sTitle']); ?>"
                                                                 }
                                                 ]
                                            },
                                    <?php elseif ($actionName == "export_csv"): ?>
                                            <?php if(!isset($params['sTitle']) || empty($params['sTitle']) ) $params['sTitle'] = 'Orchestra'; ?>
                                            {
                                                "sExtends": "csv",
                                                "sTitle": "<?php echo $this->translator->trans($params['sTitle']); ?>",
                                                "sButtonText": "<img class='btn-action' src='<?php echo $export_csv; ?>' title='<?php echo $this->translator->trans('pi.grid.action.export.csv'); ?>' alt='<?php echo $this->translator->trans('pi.grid.action.export.csv'); ?>'  height='28' width='28' />"
                                            },
                                    <?php elseif ($actionName == "export_pdf"): ?>
                                            <?php if(!isset($params['sTitle']) || empty($params['sTitle']) ) $params['sTitle'] = 'Orchestra'; ?>
                                            {
                                                "sExtends": "pdf",
                                                "sTitle": "<?php echo $this->translator->trans($params['sTitle']); ?>",
                                                "sButtonText": "<img class='btn-action' src='<?php echo $export_pdf; ?>' title='<?php echo $this->translator->trans('pi.grid.action.export.pdf'); ?>' alt='<?php echo $this->translator->trans('pi.grid.action.export.pdf'); ?>'  height='28' width='28' />",
                                                "sPdfOrientation": "landscape",
                                                "sPdfMessage": "PDF export (<?php echo date("Y/m/d"); ?>)"
                                            },
                                    <?php elseif ($actionName == "export_xls"): ?>
                                            <?php if(!isset($params['sTitle']) || empty($params['sTitle']) ) $params['sTitle'] = 'Orchestra'; ?>
                                            {
                                                "sExtends": "xls",
                                                "sTitle": "<?php echo $this->translator->trans($params['sTitle']); ?>",
                                                "sButtonText": "<img class='btn-action' src='<?php echo $export_xls; ?>' title='<?php echo $this->translator->trans('pi.grid.action.export.xls'); ?>' alt='<?php echo $this->translator->trans('pi.grid.action.export.xls'); ?>'  height='28' width='28' />"
                                            },
                                    <?php elseif (!empty($actionName) && (strstr($actionName, 'rows_default_') != "") ): ?>
                                            <?php if (!isset($params['sButtonText']) || empty($params['sButtonText']) ) $params['sButtonText'] = '_new_'; ?>
                                            {
                                                "sExtends": "editor_remove",
                                                "sButtonText": "<?php echo $this->translator->trans($params['sButtonText']); ?>",
                                                "editor": defaultrow_<?php echo $actionName; ?>,
                                                "formButtons": [
                                                    {
                                                        "label": "Valider",
                                                        "className": "save",
                                                        "fn": function (e) {
                                                            this.submit(function(){
                                                                <?php if (isset($params['reload']) && ($params['reload'] == 1) ) : ?>
                                                                window.location.reload();
                                                                <?php endif; ?>

                                                                <?php if (isset($params['remove']) && ($params['remove'] == 1) ) : ?>
                                                                $("tr.DTTT_selected td").remove();
                                                                <?php endif; ?>

                                                                <?php if (isset($params['withImg']) && ($params['withImg'] == 1) ) : ?>
                                                                $("tr.DTTT_selected td.enabled").html('<img width="17px" src="<?php echo $Urlenabled ?>">');
                                                                <?php endif; ?>
                                                            });
                                                        },
                                                    }
                                                ],
                                                <?php if (!isset($params['questionTitle']) || empty($params['questionTitle']) ) : ?>
                                                "formTitle": "",
                                                  <?php else: ?>
                                                "formTitle": "<?php echo $this->translator->trans($params['questionTitle']); ?>",
                                                  <?php endif; ?>
                                                "question": function(b) {
                                                  <?php if (!isset($params['questionText']) || empty($params['questionText']) ) : ?>
                                                    return ""
                                                      <?php else: ?>
                                                      return "<?php echo $this->translator->trans($params['questionText']); ?>"
                                                      <?php endif; ?>                                                  
                                                }
                                            },    
                                    <?php elseif (!empty($actionName) && (strstr($actionName, 'rows_text_') != "") ): ?>
                                    // exemple : 'rows_text_test': {'sButtonText':'test', 'route':'admin_layout_enabledentity_ajax', 'questionTitle':'Titre de mon action', 'questionText':'Etes-vous sûr de vouloir activer toutes les lignes suivantes ?', 'typeResponse':'ajaxResult', 'responseText':'Operation successfully', 'reload':false},
                                            <?php if (!isset($params['sButtonText']) || empty($params['sButtonText']) ) $params['sButtonText'] = '_new_'; ?>
                                            {
                                                "sExtends": "text",
                                                "sButtonText": "<?php echo $this->translator->trans($params['sButtonText']); ?>",
                                                "fnClick": function(nButton, oConfig, nRow){
                                                        var oSelectedRows = this.fnGetSelected();
                                                        var data_id = [];
                                                        var data_HTML = new Array();
                                                        // we register all rows in data
                                                        data_HTML.push( "<br /><br />" );
                                                        for ( var i=0 ; i<oSelectedRows.length ; i++ )
                                                        {
                                                            data_id.push( oSelectedRows[i]['id'] );
                                                            data_HTML.push( oSelectedRows[i] );
                                                            data_HTML.push( "<br />" );
                                                        }
                                                        data_HTML.push( "<br />" );
                                                        // we deselet all selected rows
                                                        this.fnDeselect(oSelectedRows);
                                                        // we empty the content
                                                        $("#grid-html").find("div").empty();
                                                        // Question message are injected into the overlay fancybox
                                                        <?php if (isset($params['questionText']) && !empty($params['questionText'])) : ?>
                                                        $("#grid-html").find("div").prepend("<span class='rows_text_question'><?php echo $params['questionText']; ?></span>");
                                                        <?php endif; ?>
                                                        // all select rows are injected into the overlay fancybox
                                                        $("#grid-html").find("div").append(data_HTML);
                                                        // all select rows are injected into the overlay fancybox
                                                        <?php if (isset($params['questionTitle']) && !empty($params['questionTitle'])) : ?>
                                                        $("#grid-header").html("<?php echo $params['questionTitle']; ?>");
                                                        <?php endif; ?>
                                                        // we run fancybox
                                                        $.fancybox({
                                                        	'wrapCSS': 'fancybox-orchestra',
                                                            'content':$("#confirm-popup-grid").html(),
                                                            'autoDimensions':true,
                                                            'scrolling':'no',
                                                            'transitionIn'    :    'elastic',
                                                            'transitionOut'    :    'elastic',
                                                            'speedIn'        :    600, 
                                                            'speedOut'        :    200, 
                                                            'overlayShow'    :    true,
                                                            'height': 'auto',
                                                            'padding':0,
                                                            'type': 'inline',
                                                            'onComplete'		: function() {
                                                             },
                                                            'onClosed'		: function() {                                                            	
                                                        	}
                                                        });  
                                                        // we set the action button
                                                      	<?php if (isset($params['route']) && !empty($params['route'])) : ?>
                                                        $("button.save").click(function(event, dataObject) {  
                                                            event.preventDefault(); 
                                                            $.ajax( {
                                                               "url": "<?php echo $this->container->get('router')->generate($params['route']) ?>",
                                                               "data": { "data": data_id },
                                                               "dataType": "json",
                                                               "type": "post",
                                                               "beforeSend": function ( xhr ) {
                                                                   //xhr.overrideMimeType("text/plain; charset=x-user-defined");
                                                               	   $('.dataTables_processing').css({'visibility':'visible'});
                                                               },
                                                               "statusCode": {
                                                                   404: function() {
                                                                   }
                                                               }
                                                           }).done(function ( data ) {
                                                        	   <?php if (isset($params['typeResponse']) && ($params['typeResponse']) == "ajaxResult") : ?>
                                                        	      $("#grid-html > div").html(data);
                                                           	   <?php else: ?>
                                                         	      <?php if (isset($params['responseText']) && !empty($params['responseText'])) : ?>
                                                         	      $("#grid-html > div").html("<?php echo $params['responseText']; ?>");
                                                           	      <?php endif; ?>
                                                           	   <?php endif; ?>
                                                           	   
                                                           	   $('.dataTables_processing').css({'visibility':'hidden'});

                                                        	   <?php if (isset($params['reload']) && ($params['reload']) == true) : ?>
                                                        	   window.location.reload();     
                                                        	   <?php endif; ?>                                                           	   
                                                           });
                                                        });
                                                       <?php endif; ?>                                                    	
                                                },
                                                // http://datatables.net/extras/tabletools/button_options
                                                "fninit": function(nButton){
                                                }                                              
                                            },                                                                                        
                                    <?php endif; ?>                                        
                            <?php endforeach; ?>
                        <?php endif; ?>    
                                        ]                            
                        },

                        "oColVis": {
                            "buttonText": "&nbsp;",
                            "bRestore": true,
                            "sAlign": "right"
                        },
                        "aoColumnDefs": [
                <?php if (isset($options['grid-visible']) && !empty($options['grid-visible']) && is_array($options['grid-visible'])): ?>
                    <?php foreach($options['grid-visible'] as $idColumn => $boolean): ?>
                            { "bVisible": <?php echo $boolean; ?>, "aTargets": [ <?php echo $idColumn; ?> ] },                
                    <?php endforeach; ?>
                <?php else: ?>
                            { "bVisible": false, "aTargets": [ 0 ] },                                            
                    <?php if (isset($options['grid-actions']) && !empty($options['grid-actions']) && is_array($options['grid-actions'])): ?>
                        <?php foreach($options['grid-actions'] as $actionName => $params): ?>
                            <?php if ( ($actionName == "rows_position") && isset($params['route']) && !empty($params['route']) ) : ?>                                            
                                { "bVisible": false, "aTargets": [ 1 ] },
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                        
                <?php endif; ?>                        
                    
                        ],
                        "oColumnFilterWidgets": {
                            "sSeparator": "\\s*/+\\s*",
                            "aiExclude": [ 
                <?php if (isset($options['grid-filters-select']) && !empty($options['grid-filters-select']) && is_array($options['grid-filters-select'])): ?>
                    <?php foreach($options['grid-filters-select'] as $idColumn => $boolean): ?>
                            <?php echo $boolean; ?>,                
                    <?php endforeach; ?>
                <?php else: ?>
                            0,1            
                <?php endif; ?>                        
                            ]
                        },

                    });


                <?php if (isset($options['grid-actions']) && !empty($options['grid-actions']) && is_array($options['grid-actions'])): ?>
                    <?php foreach($options['grid-actions'] as $actionName => $params): ?>
                    
                        <?php if ( ($actionName == "rows_position") && isset($params['route']) && !empty($params['route']) ) : ?>
                            <?php echo $options['grid-name']; ?>oTable.rowReordering({ 
                                  sURL:"<?php echo $this->container->get('router')->generate($params['route']) ?>",
                                  sRequestType: "GET",
                                  <?php if (isset($options['grid-actions']['rows_grouping'])) : ?>
                                  bGroupingUsed: true,
                                  <?php endif; ?> 
                                  fnAlert: function(message) {
                                  }
                            });    
                        <?php endif; ?>

                        <?php if ( $actionName == "rows_grouping" ) : ?>
                            <?php echo $options['grid-name']; ?>oTable.rowGrouping({ 
                                <?php if ( isset($params['columnIndex']) && is_integer($params['columnIndex'])) : ?>
                                iGroupingColumnIndex: <?php echo $params['columnIndex']; ?>,
                                <?php endif; ?>        
                                <?php if ( isset($params['SortDirection']) && in_array($params['SortDirection'], array('asc', 'desc') )) : ?>
                                sGroupingColumnSortDirection: "<?php echo $params['SortDirection']; ?>",
                                <?php endif; ?>
                                <?php if ( isset($params['OrderByColumnIndex']) && is_integer($params['OrderByColumnIndex'])) : ?>
                                iGroupingOrderByColumnIndex: <?php echo $params['OrderByColumnIndex']; ?>,
                                <?php endif; ?>                                                                                                
                                <?php if ( isset($params['HideColumn']) && in_array($params['HideColumn'], array('true', 'false') )) : ?>
                                bHideGroupingColumn: <?php echo $params['HideColumn']; ?>,
                                <?php endif; ?>
                                <?php if ( isset($params['HideOrderByColumn']) && in_array($params['HideOrderByColumn'], array('true', 'false') )) : ?>
                                bHideGroupingColumn: <?php echo $params['HideOrderByColumn']; ?>,
                                <?php endif; ?>
                                <?php if ( isset($params['GroupBy']) && in_array($params['GroupBy'], array('name', 'year', 'letter', 'month') )) : ?>
                                sGroupBy: "<?php echo $params['GroupBy']; ?>",
                                <?php endif; ?>
                                
                                
                                <?php if ( isset($params['columnIndex2']) && is_integer($params['columnIndex2'])) : ?>
                                iGroupingColumnIndex2: <?php echo $params['columnIndex2']; ?>,
                                <?php endif; ?>
                                <?php if ( isset($params['SortDirection2']) && in_array($params['SortDirection2'], array('asc', 'desc') )) : ?>
                                sGroupingColumnSortDirection2: "<?php echo $params['SortDirection2']; ?>",
                                <?php endif; ?>                                
                                <?php if ( isset($params['OrderByColumnIndex2']) && is_integer($params['OrderByColumnIndex2'])) : ?>
                                iGroupingOrderByColumnIndex2: <?php echo $params['OrderByColumnIndex2']; ?>,
                                <?php endif; ?>                                                                                                
                                <?php if ( isset($params['HideColumn2']) && in_array($params['HideColumn2'], array('true', 'false') )) : ?>
                                bHideGroupingColumn2: <?php echo $params['HideColumn2']; ?>,
                                <?php endif; ?>
                                <?php if ( isset($params['HideOrderByColumn2']) && in_array($params['HideOrderByColumn2'], array('true', 'false') )) : ?>
                                bHideGroupingColumn2: <?php echo $params['HideOrderByColumn2']; ?>,
                                <?php endif; ?>
                                <?php if ( isset($params['GroupBy2']) && in_array($params['GroupBy2'], array('name', 'year', 'letter', 'month') )) : ?>
                                sGroupBy2:"<?php echo $params['GroupBy2']; ?>",
                                <?php endif; ?>
                                
                                
                                <?php if ( isset($params['DateFormat']) ) : ?>
                                sDateFormat: "<?php echo $params['DateFormat']; ?>",    
                                <?php else: ?>
                                sDateFormat: "yyyy-MM-dd",    
                                <?php endif; ?>
                                                                                                
                                bExpandableGrouping: true, 
                                bExpandableGrouping2: true,
                                
                                oHideEffect: { method: "hide", duration: "fast", easing: "linear" },
                                oShowEffect: { method: "show", duration: "slow", easing: "linear" },
                                
                                <?php if ( isset($params['Collapsible']) && ($params['Collapsible'] == 'true') ) : ?>
                                asExpandedGroups: [],
                                <?php endif; ?>
                            });
                    <?php endif; ?>                                
                            
                        
                    <?php endforeach; ?>
                <?php endif; ?>                        


                    var content = $("#blocksearch_content").html();
                    $("#blocksearch_content").html('');
                    $("#<?php echo $options['grid-name']; ?>").before(content);

                    $("#global_filter").keyup( fnFilterGlobal );
                    $("#global_regex").click( fnFilterGlobal );
                    $("#global_smart").click( fnFilterGlobal );

                    <?php if (isset($options['grid-filters']) && !empty($options['grid-filters']) && is_array($options['grid-filters'])){ ?>
                        <?php foreach($options['grid-filters'] as $id => $colName){ ?>

                    $("#col<?php echo $id; ?>_filter").keyup( function() { fnFilterColumn( <?php echo $id-1; ?> ); } );
                    $("#col<?php echo $id; ?>_regex").click(  function() { fnFilterColumn( <?php echo $id-1; ?> ); } );
                    $("#col<?php echo $id; ?>_smart").click(  function() { fnFilterColumn( <?php echo $id-1; ?> ); } );
                                                
                        <?php } ?>
                    <?php } ?>    

                    $('.block_filter').click(function() {
                        $("#blocksearch").slideToggle("slow");
                    });

                    <?php if (isset($options['grid-actions']['rows_position'])) : ?>
                    $(".ui-state-default div.DataTables_sort_wrapper .ui-icon").css('display', 'none');
                    <?php endif; ?> 

                    // http://fgnass.github.io/spin.js/
                    var opts_spinner = {
                            lines: 11, // The number of lines to draw
                            length: 2, // The length of each line
                            width: 3, // The line thickness
                            radius: 6, // The radius of the inner circle
                            corners: 1, // Corner roundness (0..1)
                            rotate: 0, // The rotation offset
                            direction: 1, // 1: clockwise, -1: counterclockwise
                            color: '#000', // #rgb or #rrggbb
                            speed: 1.3, // Rounds per second
                            trail: 54, // Afterglow percentage
                            shadow: false, // Whether to render a shadow
                            hwaccel: true, // Whether to use hardware acceleration
                            className: 'spinner', // The CSS class to assign to the spinner
                            zIndex: 1049, // The z-index (defaults to 2000000000)
                            top: 0, // Top position relative to parent in px
                            left: 0 // Left position relative to parent in px
                          };
                   var target_spinner = document.getElementById('spin');
                   var spinner = new Spinner(opts_spinner).spin(target_spinner);

                   $(function() {
                        $("a.info-tooltip").tooltip({
                              position: {
                                  track: true,
                                  my: "center bottom-20",
                                  at: "center top",
                                },
                              content: function () {
                                    return $(this).prop('title');
                                }                            
                        });

                        <?php if(!isset($options['grid-server-side']) || ($options['grid-server-side'] == 'false') || ($options['grid-server-side'] == false) ) : ?>
                        /* Add a select menu for each TH element in the table footer
                         *
	                     *   <tfoot>
						 *		<tr>
					     *			<th data-type="input"><input type="text" name="search_grade" value="Position" class="search_init" /></th>
						 *			<th data-type="input"><input type="text" name="search_grade" value="Id" class="search_init" /></th>
						 *			<th data-column='2' data-title="Search"><input type="text" name="search_grade" value="Search grades" class="search_init" /></th>
						 *			<th data-column='3' data-title="Search"><input type="text" name="search_grade" value="Search grades" class="search_init" /></th>
						 *			<th data-column='4' data-title="Search"><input type="text" name="search_grade" value="Search grades" class="search_init" /></th>
						 *			<th data-column='5' data-title="Search" data-values='{{ regions|json_encode }}'><input type="text" name="search_grade" value="Search grades" class="search_init" /></th>
						 *			<th data-column='6' data-title="Search" data-values='{"provider":"Prestataire","customer":"Client"}'><input type="text" name="search_grade" value="Search grades" class="search_init" /></th>
						 *			<th data-column='7' data-title="Search"><input type="text" name="search_grade" value="Search grades" class="search_init" /></th>
						 *			<th data-column='8' data-title="Search"><input type="text" name="search_grade" value="Search grades" class="search_init" /></th>
						 *			<th data-column='9' data-title="Search"data-values='{"Actif":"Actif","Supprime":"Supprimé","En attente dactivation":"En attente d activation"}'><input type="text" name="search_grade" value="Search grades" class="search_init" /></th>
						 *			<th></th>
						 *		</tr>
						 *	</tfoot>
						 */
						 $("tfoot th").each( function ( i ) {
                                var column = $(this).data('column');
                                var values = $(this).data('values');
                                var type = $(this).data('type');
                                var title = $(this).data('title');
                                if (column != undefined) {
                                	var options = [];
                                	$('select', this).find(':selected').each(function(j,v){
                                		options[j] = $(v).val();
								    });
                                	if (values == undefined) {
                                		values = <?php echo $options['grid-name']; ?>oTable.fnGetColumnData(column) 
    	                            }
    	                            if (type != "input") {
 	                            		$(this).html( fnCreateSelect( values, title, i) ); 
								    }     
								    $('select', this).val(options);
									$('select', this).change( function () {
										var values = $("#select_"+i).val().join('|');
							            <?php echo $options['grid-name']; ?>oTable.fnFilter( values, column, true );
							        });
							        $("#select_"+i).multiselect({
							        	multiple: true,
							        	header: true,
							        	noneSelectedText: title,
								        create: function(){ $(this).next().width('auto');$(this).multiselect("widget").width('auto'); },
								        open: function(){ $(this).next().width('auto');$(this).multiselect("widget").width('auto'); },
								    }).multiselectfilter();	
                                } else {
                                	this.innerHTML = '' ;
                                }
                         });
                        <?php endif; ?>
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