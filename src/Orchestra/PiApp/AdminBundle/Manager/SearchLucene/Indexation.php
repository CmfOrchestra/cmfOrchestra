<?php 
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Managers
 * @package    Search
 * @subpackage Indexation
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-06-11
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Manager\SearchLucene;

use PiApp\AdminBundle\Manager\SearchLucene\Modele;

/**
 * Classe pour l'ajout d'un document et ses champs dans l'index.
 *
 * @uses    \Zend_Search_Lucene_Index_Term
 * @uses 	\Zend_Search_Lucene_Proxy
 * @uses	\Zend_Search_Lucene_Document
 * @uses	\Zend_Search_Lucene_Document_Docx
 * @uses	\Zend_Search_Lucene_Document_Html
 * @uses	\Zend_Search_Lucene_Document_Xlsx
 * @uses	\Zend_Search_Lucene_Document_Pptx
 * @category   Admin_Managers
 * @package    Search
 * @subpackage Indexation
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-06-11
 */
class Indexation
{
	/**
	 * @var \Zend_Search_Lucene_Proxy
	 */	
	private static $_index;
	
	/**
	 * @var \Zend_Search_Lucene_Document
	 */	
	private static $_doc;
	
    /**
     * Extract data from a PDF document and add this to the Lucene index.
     *
     * @param \Zend_Search_Lucene_Proxy $Index	 		The Lucene index object.
	 * @param string					$type			['html', 'docx', 'xsls', 'pptx', 'content']
	 * @param array						$indexValues
	 * @param string					$locale
	 * @param object					$obj
     * @param string 					$pathFile		The path to the PDF document.
     * @return \Zend_Search_Lucene_Proxy
     * @access	public
     * @static
     * 
     * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     * @since 2012-06-11
     */
    public static function index(\Zend_Search_Lucene_Proxy $Index, $type, $indexValues = null, $locale = '', $obj = null, $pathFile = '')
    {
    	self::$_index = $Index;
    	self::$_doc	  = null;
    	
        switch ($type){
			case "html":
				self::$_doc = \Zend_Search_Lucene_Document_Html::loadHtmlFile($pathFile, false);
				$indexValues['Key']		 = filemtime($pathFile);
				$indexValues['Contents'] = self::$_doc->getFieldUtf8Value('body');
				break;		
			case "docx":
				self::$_doc = \Zend_Search_Lucene_Document_Docx::loadDocxFile($pathFile, false);
				$indexValues['Key']		 = filemtime($pathFile);
				$indexValues['Contents'] = self::$_doc->getFieldUtf8Value('body');
				break;
			case "xsls":
				self::$_doc = \Zend_Search_Lucene_Document_Xlsx::loadXlsxFile($pathFile, false);
				$indexValues['Key']		 = filemtime($pathFile);
				$indexValues['Contents'] = self::$_doc->getFieldUtf8Value('body');
				break;	
			case "pptx":
				self::$_doc = \Zend_Search_Lucene_Document_Pptx::loadPptxFile($pathFile, false);
				$indexValues['Key']		 = filemtime($pathFile);
				$indexValues['Contents'] = self::$_doc->getFieldUtf8Value('body');
				break;	
			case "page":
				// we create a new instance of Zend_Search_Lucene_Document
				self::$_doc = \Zend_Search_Lucene_Document_Html::loadHTML($indexValues['Contents'], false);	
				$indexValues['Contents'] = self::$_doc->getFieldUtf8Value('body');
				break;				
		}   
		 	
        if( self::$_doc instanceof \Zend_Search_Lucene_Document ) {
        	// Remove all accens
        	$indexValues['Contents'] = \PiApp\AdminBundle\Util\PiStringManager::minusculesSansAccents($indexValues['Contents']);
        	// Remove all doublons
        	$indexValues['Contents'] = \PiApp\AdminBundle\Util\PiStringManager::uniqueWord($indexValues['Contents']);
        	// clean the content
        	$indexValues['Contents'] = \PiApp\AdminBundle\Util\PiStringManager::cleanContent($indexValues['Contents']);        	
        	// Delete all stop words
        	$stopWord 				 = \PiApp\AdminBundle\Util\PiStringManager::stopWord("", strtolower($locale));
        	if($stopWord){
        		$wordsIndex 			 = explode(' ', $indexValues['Contents']);
        		$diff 					 = array_diff($wordsIndex, $stopWord);
        		$indexValues['Contents'] = implode(' ', $diff);
        	}
        	
        	
//         	print_r($locale);
//         	print_r('<br /><br /><br />');
        	
//         	print_r(implode(' ', $wordsIndex));
//         	print_r('<br /><br /><br />');
        	
//         	print_r(implode(' ', $stopWord));
//         	print_r('<br /><br /><br />');
        	
//         	print_r($indexValues['Contents']);
//         	print_r('<br /><br /><br />');
        	        	
        	
            // If the document creation was sucessful then add it to our index.
        	try {
        		setlocale(LC_ALL, $locale);
        		self::defaultAddFields($indexValues);
        		self::addDocument();
        		
//         		print_r($indexValues['Key']);
//         		print_r('<br />');
//         		print_r($indexValues['Contents']);
//         		print_r('<br /><br /><br />');

        		
        	} catch (\Exception $e) {
        		setlocale(LC_ALL, 'fr_FR');
        		self::defaultAddFields($indexValues);
        		try {
        			self::addDocument();        			
        		} catch (\Exception $e) {
        		}
        	}

        }
  
        // Return the Lucene index object.
        return self::$_index;
    }   
    
    /**
     * Add a document to the index.
     * 
     * @return void
     * @access	private
     * @static
     *
     * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
     * @since 2012-06-11
     */
    public static function addDocument()
    {
    	// Search for documents with the same Key value.
    	$term	= new \Zend_Search_Lucene_Index_Term(self::$_doc->Key, 'Key');
    	$docIds = self::$_index->termDocs($term);
    
    	// Delete any documents found.
    	foreach ($docIds as $id) {
    		self::$_index->delete($id);
    	}
    
    	if( self::$_doc instanceof \Zend_Search_Lucene_Document )
	    		self::$_index->addDocument(self::$_doc);
    }
    
    /**
     * Add all fields of a lucene document.
     *
     * @param array $values An associative array of values to be used in the document.
     * @return void
     * @access	private
     * @static
     *
     * @link http://framework.zend.com/manual/1.0/fr/zend.search.lucene.overview.html
     *
     * // Le champs n'est pas segmenté, mais est indexé et stocké dans l'index.
     * // Les champs stockés peuvent être récupérés à partir de l'index.
     * $doc->addField(Zend_Search_Lucene_Field::Keyword('doctype', 'autogenerated'));
     * // Le champs n'est ni segmenté ni indexé, mais est stocké dans l'index.
     * $doc->addField(Zend_Search_Lucene_Field::UnIndexed('created', time()));
     * // Le champs contenant des données binaires n'est ni segmenté ni indexé, mais est stocké dans l'index
     * $doc->addField(Zend_Search_Lucene_Field::Binary('icon', $iconData));
     * // Le champs est segmenté et indexé et est stocké avec l'index.
     * $doc->addField(Zend_Search_Lucene_Field::Text('annotation', 'Document annotation text'));
     * // Le champs est segmenté et indexé, mais n'est pas stocké dans l'index.
     * $doc->addField(Zend_Search_Lucene_Field::UnStored('contents', 'My document content'));
     *
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-06-11
     */
    public static function defaultAddFields($values)
    {
    	/////////////// Keyword ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    	if (isset($values['Key']) && !empty($values['Key'])) {
	    	// Add the Key field to the document as a Keyword.
    		self::$_doc->addField(\Zend_Search_Lucene_Field::Keyword('Key', $values['Key']), 'utf-8');
    	}
    	///////////////////////////////////////////////////////////////////////////////////////////////////////////
    	
    
    	/////////////// UnStored ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    	if (isset($values['Contents']) && !empty($values['Contents'])) {
    		// Add the Contents field to the document as an UnStored field.
    		self::$_doc->addField(\Zend_Search_Lucene_Field::UnStored('Contents', $values['Contents']), 'utf-8');
    	}
    	///////////////////////////////////////////////////////////////////////////////////////////////////////////
    	
    
    	/////////////// Text ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    	if (isset($values['Route']) && !empty($values['Route'])) {
    		// Add the Keywords field to the document as a Keyword field.
    		self::$_doc->addField(\Zend_Search_Lucene_Field::Text('Route', $values['Route']), 'utf-8');
    	}  	
        if (isset($values['Keywords']) && !empty($values['Keywords'])) {
    		// Add the Keywords field to the document as a Keyword field.
    		self::$_doc->addField(\Zend_Search_Lucene_Field::Text('Keywords', $values['Keywords']), 'utf-8');
    	}
    	if (isset($values['Title']) && !empty($values['Title'])) {
    		// Add the Title field to the document as a Text field.
    		self::$_doc->addField(\Zend_Search_Lucene_Field::Text('Title', $values['Title']), 'utf-8');
    	}
    	if (isset($values['Subject']) && !empty($values['Subject'])) {
    		// Add the Subject field to the document as a Text field.
    		self::$_doc->addField(\Zend_Search_Lucene_Field::Text('Subject', $values['Subject']), 'utf-8');
    	}
    	if (isset($values['Author']) && !empty($values['Author'])) {
    		// Add the Author field to the document as a Text field.
    		self::$_doc->addField(\Zend_Search_Lucene_Field::Text('Author', $values['Author']), 'utf-8');
    	}
    	if (isset($values['Creator']) && !empty($values['Creator'])) {
    		// Add the Creator field to the document as a Text field.
    		self::$_doc->addField(\Zend_Search_Lucene_Field::Text('Creator', $values['Creator']), 'utf-8');
    	}
    	if (isset($values['Producer']) && !empty($values['Producer'])) {
    		// Add the Producer field to the document as a Text field.
    		self::$_doc->addField(\Zend_Search_Lucene_Field::Text('Producer', $values['Producer']), 'utf-8');
    	}
    	if (isset($values['ModDate']) && !empty($values['ModDate'])) {
    		// Add the ModDate field to the document as a Text field.
    		self::$_doc->addField(\Zend_Search_Lucene_Field::Text('ModDate', $values['ModDate']), 'utf-8');
    	}
    	if (isset($values['CreationDate']) && !empty($values['CreationDate'])) {
    		// Add the CreationDate field to the document as a Text field.
    		self::$_doc->addField(\Zend_Search_Lucene_Field::Text('CreationDate', $values['CreationDate']), 'utf-8');
    	}

    	if (isset($values['Filename']) && !empty($values['Filename'])) {
    		// Add the Filename field to the document as a Text field.
    		self::$_doc->addField(\Zend_Search_Lucene_Field::Text('Filename', $values['Filename']), 'utf-8');
    	}
    	if (isset($values['Extension']) && !empty($values['Extension'])) {
    		// Add the extension field to the document as a Text field.
    		self::$_doc->addField(\Zend_Search_Lucene_Field::Text('Extension', $values['Extension']), 'utf-8');
    	}
    	if (isset($values['Id']) && !empty($values['Id'])) {
    		// Add the identifiant field to the document as a Text field.
    		self::$_doc->addField(\Zend_Search_Lucene_Field::Text('Id', $values['Id']), 'utf-8');
    	}
    	///////////////////////////////////////////////////////////////////////////////////////////////////////////
    	
    }        
}