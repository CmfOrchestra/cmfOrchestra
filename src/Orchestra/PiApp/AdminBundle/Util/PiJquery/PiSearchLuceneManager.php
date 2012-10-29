<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Util
 * @package    Extension_jquery 
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-01-11
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Util\PiJquery;

use Symfony\Component\DependencyInjection\ContainerInterface;
use PiApp\AdminBundle\Twig\Extension\PiJqueryExtension;
use PiApp\AdminBundle\Exception\ExtensionException;
use PiApp\AdminBundle\Manager\PiLuceneManager;

/**
 * Search lucene of all pages.
 *
 * @category   Admin_Util
 * @package    Extension_jquery 
 * 
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class PiSearchLuceneManager extends PiJqueryExtension
{
	/**
	 * @var array
	 * @static
	 */
	static $menus = array('searchpage');
	
	/**
	 * @var array
	 * @static
	 */
	static $actions = array('renderpage');	
		
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
		// css
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile('bundles/piappadmin/css/themes/rocket/jquery-wijmo.css');
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addCssFile("bundles/piappadmin/css/themes/wijmo/jquery.wijmo-open.2.1.2.css");
		
		// wijmo
		$this->container->get('pi_app_admin.twig.extension.layouthead')->addJsFile("bundles/piappadmin/js/wijmo/external/jquery.wijmo-open.all.2.1.2.min.js");
	}	
	
    /**
      * Render proxy.
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
		if(!isset($options['action']) || empty($options['action']) || (isset($options['action']) && !in_array(strtolower($options['action']), self::$actions)) )
			throw ExtensionException::optionValueNotSpecified('action', __CLASS__);
		if(!isset($options['menu']) || empty($options['menu']) || (isset($options['menu']) && !in_array(strtolower($options['menu']), self::$menus)) )
			throw ExtensionException::optionValueNotSpecified('menu', __CLASS__);
		
		$method = strtolower($options['menu']) . "Menu";
		$action = strtolower($options['action']) . "Action";
		
		if(method_exists($this, $method))
			$result = $this->$method($options);
		else
			throw ExtensionException::MethodUnDefined($method);		
		
		return $this->$action($result, $options);
	}
	
	/**
	 * Render of th page based on the template.
	 *
	 * @param array		$archive
	 * @param array		$options
	 * @access private
	 * @return string
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 */
	private function renderpageAction($archive, $options = null)
	{
		if( isset($options['locale']) )
			$this->locale	= $options['locale'];
		
		// Options management
		if( !isset($options['template']) || empty($options['template']) )
			$template   = "searchlucene-result.html.twig";
		else
			$template	= $options['template'];
		
		// pagination management
		$page   		= intval($this->container->get('request')->get('page'));
		$max			= intval($this->container->get('request')->get('max', 5));
		$query_search 	= $this->container->get('request')->get('query_search');
		$count  		= count($archive);
		$paginator 		= array();
		$pagination		= null;
		
		// we get all pages by id
		if(is_array($archive)){			
			// We classify the table in descending order based on the timestamp of the date of publication.
			foreach($archive as $key => $result){
				$publish[$key]	= $result['ModDate'];
			}
			array_multisort($publish, SORT_DESC, $archive);
			
			// If the pagination is enabled.
			if(!empty($page) &&  !empty($max) && ($page>=1)){
				$archive		= array_slice($archive, ($page-1)*$max, $max);
				$paginator		= array_fill(0, ($count - ($count % $max))/$max +1, '');
			}	
			
			foreach($archive as $key => $tags){
					$date		 = date("Y-m", $tags['ModDate']);
					$datetime	 = new \DateTime($date.'-00');
					$year 		 = $this->container->get('pi_app_admin.date_manager')->format($datetime, 'long', 'medium', $this->locale.'_'.$this->locale, 'Y');
					$Timestamp	 = $datetime->getTimestamp();
					
					$pagination[$year][$Timestamp][] =  $tags;
			}			
		}
		
		//print_r($pagination);exit;
		
		$response	= $this->container->get('templating')->renderResponse("PiAppTemplateBundle:Template\\Search:$template", array(
				'archive'		=> $archive,
				'pagination'	=> $pagination,
				'page'	  		=> $page,
				'max'	 		=> $max,
				'count'	  		=> $count,
				'paginator' 	=> $paginator,
				'query_search'	=> $query_search,
		));
		
		return	$response->getContent();	
	}	
	
	/**
	 * Search all page based on the query.
	 *
	 * <code>
	 *		{% set options_searchlucene = {
	 *				'action':'renderpage',
	 *				'menu': 'searchpage' 
	 *				'template': 'searchlucene-result.html.twig',
	 *				'locale': "fr",
	 *				"MaxResults":0
	 *				'searchBool': "true",
	 *				'searchBoolType': "AND",
	 *				'searchByMotif': "true",
	 *				'setMinPrefixLength': "0",
	 *				'getResultSetLimit': "0",
	 *				"searchFields": [
	 *									{"sortField":"Contents","sortType":"SORT_STRING","sortOrder":"SORT_ASC"},
	 *									{"sortField":"Key","sortType":"SORT_NUMERIC","sortOrder":"SORT_DESC"}
	 *								]
	 *				} 
	 *		%}
	 *		{{ renderJquery('SEARCH', 'search-lucene', options_searchlucene )|raw }}
	 * </code>
	 * 
	 * @param	array $options
	 * @access public
	 * @return array
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 */
	public function searchpageMenu($options = null)
	{
		// Options management
		if( isset($options['locale']) )
			$this->locale	= $options['locale'];
		
		$query			= $this->container->get('request')->query->get('query_search');	
		$searchManager	= $this->container->get('pi_app_admin.manager.search_lucene');
		
		if($searchManager instanceof PiLuceneManager){
			return $result_searchpage =  $searchManager->searchPage($query, $options, $this->locale);
		}else
			throw ExtensionException::serviceUndefined('PiSearchLuceneManager');		
	}
	
}