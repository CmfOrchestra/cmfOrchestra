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
	static $types = array('simple', 'server-side');
		
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
	protected function init()
	{
		// plugin Reordering
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/datatable/plugins/RowReordering/jquery.dataTables.rowReordering.js");
		
		// plugin RowGrouping
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/datatable/plugins/RowGrouping/media/js/jquery.dataTables.rowGrouping.js");
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/js/datatable/plugins/RowGrouping/media/css/dataTables.rowGrouping.default.css", "append");
		
		// plugin Editor
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/datatable/plugins/Editor/js/dataTables.editor.js");
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/js/datatable/plugins/Editor/css/dataTables.editor.css", "append");
		
		// plugin colvis
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/datatable/extras/TableTools/media/js/TableTools.min.js");
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/datatable/extras/TableTools/media/js/ZeroClipboard.js");
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/js/datatable/extras/TableTools/media/css/TableTools_JUI.css");
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/js/datatable/extras/TableTools/media/css/TableTools.css");
		
		// plugin ColumnFilterWidgets
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/datatable/extras/ColumnFilterWidgets/media/js/ColumnFilterWidgets.js");
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/js/datatable/extras/ColumnFilterWidgets/media/css/ColumnFilterWidgets.css");
		
		// plugin colreorder
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/datatable/extras/ColReorder/media/js/ColReorder.min.js");
		
		// plugin ColVis
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/datatable/extras/ColVis/media/js/ColVis.min.js");
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/js/datatable/extras/ColVis/media/css/ColVisAlt.css", "prepend");
		
		// datatable core
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/datatable/media/js/jquery.dataTables.min.js");
		
		// wijmo
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/wijmo/external/jquery.wijmo-open.all.2.1.2.min.js");
	}	
	
    /**
      * Sets the grid render.
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
		if(!isset($options['grid-name']) || empty($options['grid-name']))
			throw ExtensionException::optionValueNotSpecified('grid-name', __CLASS__);
		if(!isset($options['grid-type']) || empty($options['grid-type']) || (isset($options['grid-type']) && !in_array($options['grid-type'], self::$types)))
			throw ExtensionException::optionValueNotSpecified('grid-type', __CLASS__);
		
		if(!isset($options['grid-paginate']) || empty($options['grid-paginate']))
			$options['grid-paginate'] = true;
		
		
		if( $options['grid-type'] == "server-side" )
			return $this->gridServer($options);
		elseif( $options['grid-type'] == "simple" )
			return $this->gridSimple($options);
	}
	
	/**
	 * Sets the grid server render.
	 *
	 * @param	$options	tableau d'options.
	 * @access private
	 * @return string
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 */
	private function gridSimple($options = null)
	{
		$Urlpath 		= $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/js/datatable/extras/TableTools/media/swf/copy_csv_xls_pdf.swf");
		$Urlenabled 	= $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/images/grid/button-green.png");
		$Urldisabled 	= $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/images/grid/button-red.png");
		
		// We open the buffer.
		ob_start ();
		?>

			<div id="blocksearch_content">
				<div id="blocksearch" style="display:none" >
					<table class="filter">
						<thead>
						<tr>
							<th>Target</th>
							<th>Filter text</th>
							<th>Treat as regex</th>
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
							<?php if(isset($options['grid-filters']) && !empty($options['grid-filters']) && is_array($options['grid-filters'])){ ?>
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

				var enabled;
				var disablerow;
				var deleterow;
				$(document).ready(function() {

					$("td.enabled").each(function(index) {
						var value = $(this).html();
						if(value == 1)
							$(this).html('<img width="17px" src="<?php echo $Urlenabled ?>">');
						if(value == 0)
							$(this).html('<img width="17px" src="<?php echo $Urldisabled ?>">');						
					});				    					

					$('#<?php echo $options['grid-name']; ?> tbody tr').each(function(index) {
					    $(this).find("td.position").prependTo(this);
					});
					$('#<?php echo $options['grid-name']; ?> thead tr').each(function(index) {
					    $(this).find("th.position").prependTo(this);
					});					

					var envelopeConf = $.fn.dataTable.Editor.display.envelope.conf;
				    envelopeConf.attach = 'head';
				    envelopeConf.windowScroll = false;

					<?php if(isset($options['grid-actions']) && !empty($options['grid-actions']) && is_array($options['grid-actions'])): ?>
						<?php foreach($options['grid-actions'] as $actionName => $params): ?>
						

							<?php if( ($actionName == "rows_enabled") && isset($params['route']) && !empty($params['route']) ) : ?>
							// Set up enabled row
						    enabled = new $.fn.dataTable.Editor( {
						        "domTable": "#<?php echo $options['grid-name']; ?>",
						        "display": "envelope",
						        "ajaxUrl": "<?php echo $this->container->get('router')->generate($params['route']) ?>"			        
						    } );

						    <?php endif; ?>		

						    <?php if( ($actionName == "rows_disable") && isset($params['route']) && !empty($params['route']) ): ?>
							// Set up disable row
						    disablerow = new $.fn.dataTable.Editor( {
						        "domTable": "#<?php echo $options['grid-name']; ?>",
						        "display": "envelope",
						        "ajaxUrl": "<?php echo $this->container->get('router')->generate($params['route']) ?>"
						    } );

						    <?php endif; ?>	

						    <?php if( ($actionName == "rows_delete") && isset($params['route']) && !empty($params['route']) ): ?>
							// Set up delete row
						    deleterow = new $.fn.dataTable.Editor( {
						        "domTable": "#<?php echo $options['grid-name']; ?>",
						        "display": "envelope",
						        "ajaxUrl": "<?php echo $this->container->get('router')->generate($params['route']) ?>"
						    } );

						    <?php endif; ?>		

						<?php endforeach; ?>
					<?php endif; ?>	
									    
				
					var <?php echo $options['grid-name']; ?>oTable = $('#<?php echo $options['grid-name']; ?>').dataTable({
						"bPaginate":<?php echo $options['grid-paginate']; ?>,
						"bRetrieve":true,
						"sPaginationType": "full_numbers",
						"bJQueryUI":true,

						<?php if(isset($options['grid-sorting']) && !empty($options['grid-sorting']) && is_array($options['grid-sorting'])): ?>
						"aaSorting": 
							[
								<?php foreach($options['grid-sorting'] as $id => $odrer): ?>
									[<?php echo $id; ?>,'<?php echo $odrer; ?>'],				
								<?php endforeach; ?>									
							],
						<?php endif; ?>
							
						"aLengthMenu": [[1, 5, 10, 25, 50, 100, 500, 1000, 5000 -1], [1, 5, 10, 25, 50, 100, 500, 1000, 5000, "All"]],
						<?php if( isset($options['grid-LengthMenu']) && !empty($options['grid-LengthMenu']) ): ?>
						"iDisplayLength": <?php echo $options['grid-LengthMenu']; ?>,
						<?php else: ?>
						"iDisplayLength": 25,
						<?php endif; ?>		
							
						"oLanguage": {
							"sProcessing": "<?php echo $this->translator->trans('pi.grid.action.waiting'); ?>waiting...",
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
						"sDom": '<"block_filter"><"H"RTfr<"clear"><?php if(isset($options["grid-filters-select"])){ echo "W"; } ?>>tC<"F"lpi>',
						"oTableTools": {
							"sSwfPath": "<?php echo $Urlpath; ?>",
							"sRowSelect": "multi",
							"aButtons": [


						<?php if(isset($options['grid-actions']) && !empty($options['grid-actions']) && is_array($options['grid-actions'])): ?>
							<?php foreach($options['grid-actions'] as $actionName => $params): ?>
										

									<?php if($actionName == "rows_enabled"): ?>

											<?php if(!isset($params['grid-sButtonText']) || empty($params['sButtonText']) ) $params['sButtonText'] = 'pi.grid.action.row_enabled'; ?>
									
											{
												"sExtends": "editor_remove",
												"sButtonText": "<?php echo $this->translator->trans($params['sButtonText']); ?>",
												"editor": enabled,
												"formButtons": [
				        							{
				        								"label": "Valider",
							                            "className": "save",
							                            "fn": function (e) {
							                            	this.submit(function(){
							                                	window.location.reload();
							                                });
							                                $("tr.DTTT_selected td.enabled").html('<img width="17px" src="<?php echo $Urlenabled ?>">');
				
						                                    // dinf all selected rows
						                                    //var tt = window.TableTools.fnGetInstance('<?php echo $options['grid-name']; ?>');
						                                    //var row = tt.fnGetSelected()[0];
						                                    //var index = <?php echo $options['grid-name']; ?>oTable.$('tr').index(row);
						                                    //console.log(index);
							                            }
							                        }
							                    ],
							                    "formTitle": "Activer donnée",
							                    "question": function(b) {
											      return "Voulez-vous activer " + b.length + " ligne" + (b.length === 1 ? " ?" : "s ?")
											    }
											},
											
									<?php endif; ?>	
				
									<?php if($actionName == "rows_disable"): ?>

											<?php if(!isset($params['grid-sButtonText']) || empty($params['sButtonText']) ) $params['sButtonText'] = 'pi.grid.action.row_disable'; ?>
									
											{
												"sExtends": "editor_remove",
												"sButtonText": "<?php echo $this->translator->trans($params['sButtonText']); ?>",
												"editor": disablerow,
												"formButtons": [
				        							{
				        								"label": "Valider",
							                            "className": "save",
							                            "fn": function (e) {
							                            	this.submit(function(){
							                                	window.location.reload();
							                                });
							                                $("tr.DTTT_selected td.enabled").html('<img width="17px" src="<?php echo $Urldisabled ?>">');
							                            }
							                        }
							                    ],
							                    "formTitle": "Désactiver donnée",
							                    "question": function(b) {
											      return "Voulez-vous désactiver " + b.length + " ligne" + (b.length === 1 ? " ?" : "s ?")
											    }
											},
											
									<?php endif; ?>	
				
									<?php if($actionName == "rows_delete"): ?>

											<?php if(!isset($params['grid-sButtonText']) || empty($params['sButtonText']) ) $params['sButtonText'] = 'pi.grid.action.row_delete'; ?>
									
											{
												"sExtends": "editor_remove",
												"sButtonText": "<?php echo $this->translator->trans($params['sButtonText']); ?>",
												"editor": deleterow,
												"formButtons": [
				        							{
				        								"label": "Valider",
				        								"className": "save",
							                            "fn": function (e) {
							                            	this.submit(function(){
							                                	window.location.reload();
							                                });
							                            },
							                        }
							                    ],
							                    "formTitle": "Suppression de donnée",
							                    "question": function(b) {
											      return "Voulez-vous supprimer " + b.length + " ligne" + (b.length === 1 ? " ?" : "s ?")
											    }
											},
											
									<?php endif; ?>	
				
									<?php if($actionName == "select_all"): ?>		

											<?php if(!isset($params['grid-sButtonText']) || empty($params['sButtonText']) ) $params['sButtonText'] = 'pi.grid.action.select_all'; ?>										
											
											{
												"sExtends": "select_all",
												"sButtonText": "<?php echo $this->translator->trans($params['sButtonText']); ?>"
											},
											
									<?php endif; ?>	
											
									<?php if($actionName == "select_none"): ?>

											<?php if(!isset($params['grid-sButtonText']) || empty($params['sButtonText']) ) $params['sButtonText'] = 'pi.grid.action.select_none'; ?>	
									
											{
												"sExtends": "select_none",
												"sButtonText": "<?php echo $this->translator->trans($params['sButtonText']); ?>"
											},	

									<?php endif; ?>	
											
								
							<?php endforeach; ?>
						<?php endif; ?>	
						<?php if(isset($options['grid-copy']) && !empty($options['grid-copy']) && is_array($options['grid-copy'])): ?>						
											
											{
												"sExtends": "copy",
												"sButtonText": "<?php echo $this->translator->trans('pi.grid.action.copy'); ?>"
											},
											{
												"sExtends": "print",
												"sButtonText": "<?php echo $this->translator->trans('pi.grid.action.print'); ?>"
											},	
											{
												"sExtends":    "collection",
												"sButtonText": "<?php echo $this->translator->trans('pi.grid.action.export'); ?>",
												"aButtons":    [ "csv", "xls", 
												    {
														"sExtends": "pdf",
														"sPdfOrientation": "landscape",
														"sPdfMessage": "PDF export (<?php echo date("Y/m/d"); ?>)"
													}
												 ]
											}
						<?php endif; ?>
										]							
						},

						"oColVis": {
							"buttonText": "&nbsp;",
							"bRestore": true,
							"sAlign": "right"
						},
						"aoColumnDefs": [
				<?php if(isset($options['grid-visible']) && !empty($options['grid-visible']) && is_array($options['grid-visible'])): ?>
					<?php foreach($options['grid-visible'] as $idColumn => $boolean): ?>
							{ "bVisible": <?php echo $boolean; ?>, "aTargets": [ <?php echo $idColumn; ?> ] },				
					<?php endforeach; ?>
				<?php else: ?>
							{ "bVisible": false, "aTargets": [ 0 ] },											
					<?php if(isset($options['grid-actions']) && !empty($options['grid-actions']) && is_array($options['grid-actions'])): ?>
						<?php foreach($options['grid-actions'] as $actionName => $params): ?>
							<?php if( ($actionName == "rows_position") && isset($params['route']) && !empty($params['route']) ) : ?>											
								{ "bVisible": false, "aTargets": [ 1 ] },
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
						
				<?php endif; ?>						
					
						],
						"oColumnFilterWidgets": {
							"sSeparator": "\\s*/+\\s*",
							"aiExclude": [ 
				<?php if(isset($options['grid-filters-select']) && !empty($options['grid-filters-select']) && is_array($options['grid-filters-select'])): ?>
					<?php foreach($options['grid-filters-select'] as $idColumn => $boolean): ?>
							<?php echo $boolean; ?>,				
					<?php endforeach; ?>
				<?php else: ?>
							0,1			
				<?php endif; ?>						
							]
						},

					});


				<?php if(isset($options['grid-actions']) && !empty($options['grid-actions']) && is_array($options['grid-actions'])): ?>
					<?php foreach($options['grid-actions'] as $actionName => $params): ?>
					
					    <?php if( ($actionName == "rows_position") && isset($params['route']) && !empty($params['route']) ) : ?>
							<?php echo $options['grid-name']; ?>oTable.rowReordering({ 
			                  	sURL:"<?php echo $this->container->get('router')->generate($params['route']) ?>",
			                  	sRequestType: "GET",
			                  	fnAlert: function(message) {
		                       	}
			                });	
						<?php endif; ?>

					    <?php if( $actionName == "rows_grouping" ) : ?>
							<?php echo $options['grid-name']; ?>oTable.rowGrouping({ 
								<?php if( isset($params['columnIndex']) && is_integer($params['columnIndex'])) : ?>
								iGroupingColumnIndex: <?php echo $params['columnIndex']; ?>,
								<?php endif; ?>		
								<?php if( isset($params['SortDirection']) && in_array($params['SortDirection'], array('asc', 'desc') )) : ?>
								sGroupingColumnSortDirection: "<?php echo $params['SortDirection']; ?>",
								<?php endif; ?>
								<?php if( isset($params['OrderByColumnIndex']) && is_integer($params['OrderByColumnIndex'])) : ?>
								iGroupingOrderByColumnIndex: <?php echo $params['OrderByColumnIndex']; ?>,
								<?php endif; ?>																								
								<?php if( isset($params['HideColumn']) && in_array($params['HideColumn'], array('true', 'false') )) : ?>
								bHideGroupingColumn: <?php echo $params['HideColumn']; ?>,
								<?php endif; ?>
								<?php if( isset($params['HideOrderByColumn']) && in_array($params['HideOrderByColumn'], array('true', 'false') )) : ?>
								bHideGroupingColumn: <?php echo $params['HideOrderByColumn']; ?>,
								<?php endif; ?>
								<?php if( isset($params['GroupBy']) && in_array($params['GroupBy'], array('name', 'year', 'letter', 'month') )) : ?>
								sGroupBy: "<?php echo $params['GroupBy']; ?>",
								<?php endif; ?>
								
								
								<?php if( isset($params['columnIndex2']) && is_integer($params['columnIndex2'])) : ?>
								iGroupingColumnIndex2: <?php echo $params['columnIndex2']; ?>,
								<?php endif; ?>
								<?php if( isset($params['SortDirection2']) && in_array($params['SortDirection2'], array('asc', 'desc') )) : ?>
								sGroupingColumnSortDirection2: "<?php echo $params['SortDirection2']; ?>",
								<?php endif; ?>								
								<?php if( isset($params['OrderByColumnIndex2']) && is_integer($params['OrderByColumnIndex2'])) : ?>
								iGroupingOrderByColumnIndex2: <?php echo $params['OrderByColumnIndex2']; ?>,
								<?php endif; ?>																								
								<?php if( isset($params['HideColumn2']) && in_array($params['HideColumn2'], array('true', 'false') )) : ?>
								bHideGroupingColumn2: <?php echo $params['HideColumn2']; ?>,
								<?php endif; ?>
								<?php if( isset($params['HideOrderByColumn2']) && in_array($params['HideOrderByColumn2'], array('true', 'false') )) : ?>
								bHideGroupingColumn2: <?php echo $params['HideOrderByColumn2']; ?>,
								<?php endif; ?>
								<?php if( isset($params['GroupBy2']) && in_array($params['GroupBy2'], array('name', 'year', 'letter', 'month') )) : ?>
								sGroupBy2:"<?php echo $params['GroupBy2']; ?>",
								<?php endif; ?>
								
								
								<?php if( isset($params['DateFormat']) ) : ?>
								sDateFormat: "<?php echo $params['DateFormat']; ?>",	
								<?php else: ?>
								sDateFormat: "yyyy-MM-dd",	
								<?php endif; ?>
																								
								bExpandableGrouping: true, 
								bExpandableGrouping2: true,
								
								oHideEffect: { method: "hide", duration: "fast", easing: "linear" },
					            oShowEffect: { method: "show", duration: "slow", easing: "linear" },
					            
								<?php if( isset($params['Collapsible']) && ($params['Collapsible'] == 'true') ) : ?>
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

					<?php if(isset($options['grid-filters']) && !empty($options['grid-filters']) && is_array($options['grid-filters'])){ ?>
						<?php foreach($options['grid-filters'] as $id => $colName){ ?>

					$("#col<?php echo $id; ?>_filter").keyup( function() { fnFilterColumn( <?php echo $id-1; ?> ); } );
					$("#col<?php echo $id; ?>_regex").click(  function() { fnFilterColumn( <?php echo $id-1; ?> ); } );
					$("#col<?php echo $id; ?>_smart").click(  function() { fnFilterColumn( <?php echo $id-1; ?> ); } );
												
						<?php } ?>
					<?php } ?>	
				     
					$('.block_filter').click(function() {
						$("#blocksearch").slideToggle("slow");
					});

			    	$("a.info-tooltip").wijtooltip();	
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
	 * Sets the grid server render.
	 *
	 * @param	$options	tableau d'options.
	 * @access private
	 * @return string
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 */
	private function gridServer($options = null)
	{
		if( !isset($options['grid-entity']) || empty($options['grid-entity']) )
			throw ExtensionException::optionValueNotSpecified('grid-entity', __CLASS__);
		if( !isset($options['grid-fields']) || empty($options['grid-fields']) )
			throw ExtensionException::optionValueNotSpecified('grid-fields', __CLASS__);
	
		$url_server = $this->getContainer()->get('router')->generate('admin_crud_grid', array(
				'entity' => $options['grid-entity'],
				'fields' => $options['grid-fields']
		));
		
		// We open the buffer.
		ob_start ();
		?>
		
			<script type="text/javascript">
			//<![CDATA[
			
				$(document).ready(function() {

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

										
					$('#<?php echo $options['grid-name']; ?>').dataTable( {
						"bPaginate": true,
						"bRetrieve":true,						
						"sPaginationType": "full_numbers",
						"bJQueryUI": true,
						"aLengthMenu": [[1, 5, 10, 25, 50, 100, 500, 1000, 5000 -1], [1, 5, 10, 25, 50, 100, 500, 1000, 5000, "All"]],						
						"bProcessing": true,
						"bServerSide": true,
						"sAjaxSource": "<?php echo $url_server; ?>",
						"sServerMethod": "POST",
						"oLanguage": {
							"sProcessing": "<?php echo $this->translator->trans('pi.grid.action.waiting'); ?>waiting...",
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
						"sDom": '<"block_filter"><?php if(isset($options["grid-filters-select"])){ echo "W"; } ?><"H"RTfr>tC<"F"lpi>',
						"oTableTools": {
							"sSwfPath": "<?php echo $Urlpath; ?>",
							<?php if(isset($options['grid-copy']) && !empty($options['grid-copy']) && is_array($options['grid-copy'])): ?>	
							"aButtons": [
											{
												"sExtends": "copy",
												"sButtonText": "<?php echo $this->translator->trans('pi.grid.action.copy'); ?>"
											},
											{
												"sExtends": "print",
												"sButtonText": "<?php echo $this->translator->trans('pi.grid.action.print'); ?>"
											},											
											{
												"sExtends":    "collection",
												"sButtonText": "<?php echo $this->translator->trans('pi.grid.action.export'); ?>",
												"aButtons":    [ "csv", "xls", 
												    {
														"sExtends": "pdf",
														"sPdfOrientation": "landscape",
														"sPdfMessage": "PDF export (<?php echo date("Y/m/d"); ?>)"
													}
												 ]
											}
										]	
							<?php endif; ?>							
						},

						"oColVis": {
							"buttonText": "&nbsp;",
							"bRestore": true,
							"sAlign": "right"
						},
						"aoColumnDefs": [
							{ "bVisible": false, "aTargets": [ 0 ] }
						],
																						
					});


					$("#global_filter").keyup( fnFilterGlobal );
				    $("#global_regex").click( fnFilterGlobal );
				    $("#global_smart").click( fnFilterGlobal );
				     
					$("#col1_filter").keyup( function() { fnFilterColumn( 0 ); } );
					$("#col1_regex").click(  function() { fnFilterColumn( 0 ); } );
					$("#col1_smart").click(  function() { fnFilterColumn( 0 ); } );
					
					$("#col2_filter").keyup( function() { fnFilterColumn( 1 ); } );
					$("#col2_regex").click(  function() { fnFilterColumn( 1 ); } );
					$("#col2_smart").click(  function() { fnFilterColumn( 1 ); } );
					
					$("#col3_filter").keyup( function() { fnFilterColumn( 2 ); } );
					$("#col3_regex").click(  function() { fnFilterColumn( 2 ); } );
					$("#col3_smart").click(  function() { fnFilterColumn( 2 ); } );
					
					$("#col4_filter").keyup( function() { fnFilterColumn( 3 ); } );
					$("#col4_regex").click(  function() { fnFilterColumn( 3 ); } );
					$("#col4_smart").click(  function() { fnFilterColumn( 3 ); } );
					
					$("#col5_filter").keyup( function() { fnFilterColumn( 4 ); } );
					$("#col5_regex").click(  function() { fnFilterColumn( 4 ); } );
					$("#col5_smart").click(  function() { fnFilterColumn( 4 ); } );					

					$("a.info-tooltip").wijtooltip();

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