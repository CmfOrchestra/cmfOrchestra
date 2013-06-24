<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Managers
 * @package    Manager
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-06-11
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Manager;

use Symfony\Component\DependencyInjection\ContainerInterface;

use PiApp\AdminBundle\Builder\PiSearchLuceneManagerBuilderInterface;
use PiApp\AdminBundle\Manager\PiCoreManager;
use PiApp\AdminBundle\Manager\SearchLucene\Indexation;

/**
 * Description of the search lucnene manager
 *
 * @category   Admin_Managers
 * @package    Manager
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiLuceneManager extends PiCoreManager implements PiSearchLuceneManagerBuilderInterface 
{
	/**
	 * @var string
	 */	
	const NAME_INDEX = "log_index"; 
	
	/**
	 * @var string
	 */
	private $_indexPath;

	/**
	 * @var \Zend_Search_Lucene_Proxy
	 */
	public static $_index;	
	
	/**
	 * @var array
	 */	
	public static $_delete_tags = array('searchlucene', 'footer');
		
	/**
	 * Constructor.
	 *
	 * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
	 */
	public function __construct(ContainerInterface $container)
	{
		parent::__construct($container);
		$this->_indexPath = $container->get('kernel')->getRootDir() . '/cache/Indexation/' . self::NAME_INDEX;
	}
	
	/**
	 * Call the slider render source method.
	 *
	 * @param string $id
	 * @param string $lang
	 * @param string $params
	 * @return string
	 * @access	public
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-04-25
	 */
	public function renderSource($id, $lang = '', $params = null)
	{
		str_replace('~', '~', $id, $count);
	
		if($count == 1)
			list($JQcontainer, $JQservice) = explode('~', $this->_Decode($id));
		else
			throw new \InvalidArgumentException("you have not configure correctly the attibute id");
	
		if(!is_array($params))
			$params			= $this->paramsDecode($params);
		else
			$this->recursive_map($params);
	
		$params['locale']	= $lang;
		
		if( isset($GLOBALS['JQUERY'][$JQcontainer][$JQservice]) && $this->container->has($GLOBALS['JQUERY'][$JQcontainer][$JQservice]) )
			return $this->container->get('pi_app_admin.twig.extension.jquery')->FactoryFunction($JQcontainer, $JQservice, $params);
		else
			throw new \InvalidArgumentException("you have not configure correctly the attibute id");
	}	
		
	/**
	 * Create a new index and return the lucene index.
	 *
	 * @param string $directory         The location of the Lucene index.
	 * @return void
	 * @access	public
	 * @static
	 * 
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-06-11 
	 */
	public static function create($directory)
	{
		self::$_index = new \Zend_Search_Lucene_Proxy(new \Zend_Search_Lucene($directory, true));
	}
	
	/**
	 * Open the index and return the lucene index.
	 * If the index does not exist then one will be created and returned.
	 *
	 * @param string $directory         The location of the Lucene index.
	 * @return void
	 * @access	public
	 * @static
	 * 
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-06-11 
	 */
	public static function open($directory)
	{
		try {
			// Attempt to open the index.
			self::$_index = new \Zend_Search_Lucene_Proxy(new \Zend_Search_Lucene($directory, false));
		} catch (\Exception $e) {
			// Return a newly created index using the create method of this class.
			self::create($directory);
		}
	}
	
	/**
	 * Commit the index
	 *
	 * @param string $directory         The location of the Lucene index.
	 * @return void
	 * @access	public
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-06-11
	 */	
	public static function commit()
	{
		self::$_index->optimize();
		self::$_index->commit();
	}	

	/**
	 * Indexes a page.
	 *
	 * @param \PiApp\AdminBundle\Entity\Page
	 * @return void
	 * @access	public
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-06-11
	 */
	public function indexPage(\PiApp\AdminBundle\Entity\Page $page)
	{
		// Open the index
		self::open($this->_indexPath);
		// we get the page manager
		$pageManager  	= $this->container->get('pi_app_admin.manager.page');
		// we set the object Translation Page by route
		$pageManager->setPageByRoute($page->getRouteName());	

		// we set the indexation of the locale translations of the page.
		$translationPage = $page->getTranslationByLocale($this->language);
		if($translationPage instanceof \PiApp\AdminBundle\Entity\TranslationPage){
			$pathInfo	= str_replace($this->container->get('request')->getUriForPath(''), '', $this->container->get('request')->headers->get('referer'));
			$match		= $this->container->get('i18n_routing.router')->match($pathInfo);
			$route		= $match['_route'];
			
			if(isset($GLOBALS['ROUTE']['SLUGGABLE'][ $route ]) && !empty($GLOBALS['ROUTE']['SLUGGABLE'][ $route ])){
				$sluggable_entity 		= $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['entity'];
				$sluggable_field_search = $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['field_search'];
				$sluggable_title 		= $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['field_title'];
				$sluggable_resume 		= $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['field_resume'];
				$sluggable_keywords		= $GLOBALS['ROUTE']['SLUGGABLE'][ $route ]['field_keywords'];
				
				$sluggable_title_tab = array_map(function($value) {
					return ucwords($value);
				}, array_values(explode('_', $sluggable_title)));
				$sluggable_resume_tab = array_map(function($value) {
					return ucwords($value);
				}, array_values(explode('_', $sluggable_resume)));
				$sluggable_keywords_tab = array_map(function($value) {
					return ucwords($value);
				}, array_values(explode('_', $sluggable_keywords)));					
				
				$method_title	 	= "get".implode('', $sluggable_title_tab);
				$method_resume 		= "get".implode('', $sluggable_resume_tab);
				$method_keywords 	= "get".implode('', $sluggable_keywords_tab);			
				
				if(array_key_exists($sluggable_field_search, $match)){
					$entity	= $this->container->get('doctrine')->getEntityManager()->getRepository($sluggable_entity)->getEntityByField($this->language, array('content_search' => array($sluggable_field_search =>$match[$sluggable_field_search])), 'object');
					if(is_object($entity) && method_exists($entity, $method_title)){
						$indexValues['Title']	 = $entity->$method_title();
					}
					if(is_object($entity) && method_exists($entity, "getPublishedAt") && ($entity->getPublishedAt() instanceof \DateTime)){
						$indexValues['ModDate']	 = $entity->getPublishedAt()->getTimestamp();
					} elseif (is_object($entity) && method_exists($entity, "getUpdatedAt") && ($entity->getUpdatedAt()  instanceof \DateTime)){
						$indexValues['ModDate']	 = $entity->getUpdatedAt()->getTimestamp();
					}	
				}else{
					$indexValues['ModDate']	 = $translationPage->getPublishedAt()->getTimestamp();
					$indexValues['Title']	 = $translationPage->getMetaTitle();
				}
			}else{
				$indexValues['ModDate']	 = $translationPage->getPublishedAt()->getTimestamp();
				$indexValues['Title']	 = $translationPage->getMetaTitle();
			}

			$indexValues['Key']		 = "page:{$page->getId()}:{$this->language}:{$pathInfo}";
			$indexValues['Route']	 = $page->getRouteName();
			$indexValues['Contents'] = $this->deleteTags($pageManager->render($this->language)->getContent());		
			$indexValues['Keywords'] = $translationPage->getMetaKeywords();
			$indexValues['Subject']	 = $translationPage->getMetaDescription();	

			self::$_index = Indexation::index(self::$_index, 'page', $indexValues, $this->language);
		}		
		
		// Commit the index
		self::commit();
	}	
	
	/**
	 * Deletes an indexed page.
	 *
	 * @param \PiApp\AdminBundle\Entity\Page
	 * @return void
	 * @access	public
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-06-11
	 */
	public function deletePage(\PiApp\AdminBundle\Entity\Page $page)
	{
		// Open the index
		self::open($this->_indexPath);
		
		// Search for documents with the same route_name.
		$hits	= self::$_index->find('Route:'.$page->getRouteName());
			
		// Delete any documents found.
		foreach ($hits as $hit) {
			self::$_index->delete($hit->id);
			//print_r($hit->getDocument()->Route);
			//print_r('<br />');
		}			
		
		// Commit the index
		self::commit();
	}

	/**
	 * Search all pages that match the query based on the lang..
	 *
	 * @param string $query		The search query index file
	 * @param array	 $options	Options of the search query of the index file
	 * @param string $locale
	 * @return array			All Etags from pages that match the query.
	 * @access	public
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-06-11
	 */
	public function searchPage($query, $options = null, $locale = '')
	{
		$ids		  = null;
    	$all_tag_page = $this->searchPagesByQuery($query, $options, $locale);
    	
    	if(is_array($all_tag_page)){
	    	foreach($all_tag_page as $key => $tags){
	    		str_replace(':'.$locale.':', ':'.$locale.':', $tags['Key'], $count);
	    		$values = explode(':', $tags['Key']);
	    		if( (!empty($locale) && ($count == 1 )) || empty($locale)){
	    			$ids[] = array_merge($tags, array(
	    				'Id'   	=> $values[1], 	// we set the id of the page.
	    				'Lang' 	=> $values[2], 	// we set the lang of the page.
	    				'Query' => $query, 		// we set The search query index file.
	    				'Path'	=> end($values),
	    				'Etag'	=> str_replace(':'.end($values), '', $tags['Key'])
	    			));
	    		}
	    	}
    	}
    	
    	return $ids;
	}	
	
	/**
	 * Search all pages that match the query.
	 *
	 * <code>
	 *  //$query = '(pi AND groupe AND partner*) OR pi-groupe';
	 *	$query   = " travers projet ference coin";
	 *	$options = array(
	 *		'searchBool' 		=> true,
	 *		'searchBoolType' 	=> 'AND',
	 *		'searchByMotif' 	=> true,
	 *		'setMinPrefixLength'=> 0,
	 *		'getResultSetLimit' => 0,
	 *		'searchFields'	 	=> array(
	 *			    					0=> array('sortField'=>'Contents', 'sortType'=> SORT_STRING, 'sortOrder' => SORT_ASC),
	 *									1=> array('sortField'=>'Key', 'sortType'=> SORT_NUMERIC, 'sortOrder' => SORT_DESC)
	 *								),
	 *	);
	 *	$result = $this->container->get('pi_app_admin.manager.search_lucene')->searchPagesByQuery($query, $options);
	 * </code>
	 *
	 * @link http://framework.zend.com/manual/fr/zend.search.lucene.searching.html
	 * @link http://framework.zend.com/manual/fr/learning.lucene.queries.html
	 * @link http://framework.zend.com/manual/1.12/fr/zend.search.lucene.query-api.html
	 * @param string $query		The search query index file
	 * @param array	 $options	Options of the search query of the index file
	 * @return array			All Etags from pages that match the query.
	 * @access	public
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-06-11
	 */
	public function searchPagesByQuery($query = "Key:*", $options = null, $locale = '')
	{
		try {
			if(isset($options) && is_array($options) && (count($options) >= 1) ){
				$options_values = array_map(function($key, $value) {
					if(in_array($value, array("true")))
						return 1;
					elseif(in_array($value, array("false")))
					return 0;
					elseif(!is_array($value) && (preg_match_all("/[0-9]+/",$value, $nbrs, PREG_SET_ORDER)) )
					return intval($value);
					else
						return $value;
				}, array_keys($options),array_values($options));
				$options = array_combine(array_keys($options), $options_values);
			}
			
			if(empty($query))
				return null;
			else
				$query = $this->container->get('pi_app_admin.string_manager')->minusculesSansAccents($query);
			
			if(empty($locale))
				$locale = $this->container->get('session')->getLocale();
			
			$options_default = array(
					'searchBool' 		=> true,
					'searchBoolType' 	=> 'OR',
					'searchByMotif' 	=> true,
					'setMinPrefixLength'=> 0,
					'getResultSetLimit' => 0,
					'searchFields'	 	=> '*',
					'searchMaxResultByWord' => 5,
			);
			
			if(is_array($options))
				$options	 = array_merge($options_default, $options);
			else
				$options	 = $options_default;
			
			if($options['searchBool']){
				$q_string 	 = $this->container->get('pi_app_admin.string_manager')->cleanWhitespace($query);
				$q_array	 = explode(' ', $q_string);
			
				if($options['searchByMotif']){
					print_r($options['searchByMotif']);
					$q_array = array_map(function($value) {
						return $value.'*';
					}, array_values($q_array));
				}
			
				switch ($options['searchBoolType']) {
					case ('OR') :
						$new_query = implode(' OR ', $q_array);
						break;
					case ('AND') :
						$new_query = implode(' AND ', $q_array);
						break;
					default:
						break;
				}
					
			}else
				$new_query = $query;
			
			// Open the index.
			self::open($this->_indexPath);
			
			// Set minimum prefix length.
			\Zend_Search_Lucene_Search_Query_Wildcard::setMinPrefixLength($options['setMinPrefixLength']);
			
			// Set result set limit.
			\Zend_Search_Lucene::setResultSetLimit($options['getResultSetLimit']);
			
			// Performs a query against the index.
			if(is_array($options['searchFields']) && ($query != "Key:*")){
			
				$fields_vars = "\$hits = self::\$_index->find(\$new_query,";
				$i = 0;
					
				foreach($options['searchFields'] as $key => $valuesField){
					$sortField 	= $valuesField["sortField"];
			
					if(isset($valuesField["sortType"]) && !empty($valuesField["sortType"]))
						$sortType = $valuesField["sortType"];
					else
						$sortType = SORT_STRING;
			
					if(isset($valuesField["sortOrder"]) && !empty($valuesField["sortOrder"]))
						$sortOrder 	= $valuesField["sortOrder"];
					else
						$sortOrder 	= $valuesField["sortOrder"];
			
					if($i == 0)
						$fields_vars .=  " \"$sortField\", $sortType, $sortOrder";
					else
						$fields_vars .=  ", \"$sortField\", $sortType, $sortOrder";
					$i++;
				}
				$fields_vars .= ");";
					
				try {
					setlocale(LC_ALL, $locale);
					eval($fields_vars);
			
					//				print_r($options);
					// 				print_r($new_query);
					// 				print_r('<br />');
					// 				print_r($fields_vars);
					// 				//exit;
				} catch (\Exception $e) {
					setlocale(LC_ALL, 'fr_FR');
					eval($fields_vars);
				}
				//eval("\$hits = self::\$_index->find(\$query, \"\$sortField\", \$sortType, \$sortOrder);");
				//$hits = self::$_index->find($query, "Contents", SORT_STRING, SORT_DESC);
				//$hits = self::$_index->find(' *"férence"* ', "Contents", SORT_STRING, SORT_ASC);
				//$hits = self::$_index->find(' *"MOTIVTelecommunication"* OR *"Sophisticated"* ', "Contents", SORT_STRING, SORT_ASC);
			}else{
				try {
					setlocale(LC_ALL, $locale);
					$hits = self::$_index->find($new_query);
				} catch (\Exception $e) {
					setlocale(LC_ALL, 'fr_FR');
					$hits = self::$_index->find($new_query);
				}
			}
			
			$result_search = null;
			if(isset($hits) && is_array($hits)){
				foreach ($hits as $hit) {
					$field	  = $hit->getDocument()->getFieldNames();
			
					if(in_array('Key', $field))
						$data['Key']		= $hit->getDocument()->Key;
					else
						$data['Key']		= "";
			
					if(in_array('Route', $field))
						$data['Route']		= $hit->getDocument()->Route;
					else
						$data['Route']		= "";
			
					if(in_array('Title', $field))
						$data['Title']		= utf8_decode($hit->getDocument()->Title);
					else
						$data['Title']		= "";
			
					if(in_array('Keywords', $field))
						$data['Keywords']	= utf8_decode($hit->getDocument()->Keywords);
					else
						$data['Keywords']		= "";
			
					if(in_array('ModDate', $field))
						$data['ModDate']	= $hit->getDocument()->ModDate;
					else
						$data['ModDate']		= "";
			
					$data['MaxResultByWord'] = $options['searchMaxResultByWord'];
			
					$result_search[] = $data;
				}
			}
			
			return $result_search;			
		} catch (\Exception $e) {
			return array();
		}
	}
	
	/**
	 * Gets the indexed page content.
	 *
	 * @param string $Etag		Etag of the page
	 * @param string $match_path
	 * @param string $Query		The search query index file
	 * @return string
	 * @access	public
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-06-11
	 */
	public function contentPage($Etag, $match_path, $Query = null, $MaxResultByWord = 5, $class = "", $MaxLimitCara = 0)
	{
		$body = "";		
		
		$searchWords	= explode(' ', strtolower($Query));
		$result_search	= null;		

		// IMPORTANT! we need these values ​​in another controller for example.
		$_GET = array_merge($match_path, $_GET);
		
		try {
			// we get the content of the page.
			$body = $this->container->get('pi_app_admin.caching')->renderResponse($Etag)->getContent();
			
			// we delete all contents of tags which are given in params (and all tags which are inside).
			$body = $this->deleteTags($body);
			
			// we get the only words of the body content of the page.
			$body = \Zend_Search_Lucene_Document_Html::loadHTML($body, false)->getFieldUtf8Value('body');
			
			foreach($searchWords as $key => $word){
				$new_word = strtolower($word);
				$new_word = str_replace("e", "#@@@#", $new_word);
				$new_word = str_replace("é", "[ée]{1,2}", $new_word);
				$new_word = str_replace("è", "[èe]{1,2}", $new_word);
				$new_word = str_replace("ê", "[êe]{1,2}", $new_word);
				$new_word = str_replace("ë", "[ëe]{1,2}", $new_word);
				$new_word = str_replace("#@@@#", "[éèeêë]{1,2}", $new_word);
			
				$matches_word	 	 = preg_split("#$new_word#i", $body);
					
				if(($MaxLimitCara - strlen($word)) % 2 == 0)
					$maxLimitSegment = ($MaxLimitCara - strlen($word)) / 2;
				else
					$maxLimitSegment = ($MaxLimitCara - strlen($word) +1) / 2;
			
				foreach($matches_word as $key => $value)
				{
					if($key < intval($MaxResultByWord))
					{
						if($MaxLimitCara != 0){
							$words			= explode(' ', $value);
							$words_inverse	= array_reverse($words);
							$inverse_chaine = implode(' ', $words_inverse);
								
							$inverse_chaine	= $this->container->get('pi_app_admin.string_manager')->truncate($inverse_chaine, $maxLimitSegment, '...');
								
							$words_inverse	= explode(' ', $inverse_chaine);
							$words			= array_reverse($words_inverse);
							$Contents		= implode(' ', $words);
						}else
							$Contents		= $value;
			
						if(isset($matches_word[$key+1])){
							if(!empty($class))
								$Contents		.= "<span class='$class' >" . strtoupper($word) . '</span>';
							else
								$Contents		.= "<span style='color:white;background-color:black;font-size:13;font-weight:bold;' >" . strtoupper($word) . '</span>';
								
							if($MaxLimitCara == 0)
								$Contents	    .= $matches_word[$key+1];
							else{
								$Contents	    .= $this->container->get('pi_app_admin.string_manager')->truncate($matches_word[$key+1], $maxLimitSegment, '');
							}
						}
						$result_search[] = $Contents;
					} // end if
				} // end foreach
					
			}
			
			return implode(' ', $result_search);			
		} catch (\Exception $e) {
			return '';
		}
		
	}	
	
	/**
	 * we delete all contents of tags which are given in params (and all tags which are inside).
	 *
	 * @param string $body
	 * @return void
	 * @access	public
	 * @static
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-06-11
	 */
	public static function deleteTags($body)
	{
		$tags = self::$_delete_tags;
		
		foreach($tags as $key => $tag){
			if(preg_match_all("/<{$tag}[^>]*>([^`]*?)<\/{$tag}>/i", $body, $allTags, PREG_SET_ORDER)){
				$body = preg_replace("/<{$tag}[^>]*>([^`]*?)<\/{$tag}>/i", '', $body);
			}
		}		
		
		return $body;
	}	
}