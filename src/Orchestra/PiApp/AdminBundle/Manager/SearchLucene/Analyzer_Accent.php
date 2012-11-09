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

/**
 * Analyzer removes all accents and round the string lowercase.
 *
 * @uses	\Zend_Search_Lucene_Exception
 * @uses	\Zend_Search_Lucene_Analysis_Token
 * @category   Admin_Managers
 * @package    Search
 * @subpackage Indexation
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-06-11
 */
class Analyzer_Accent extends \Zend_Search_Lucene_Analysis_Analyzer
{
    /**
     * Current char position in an UTF-8 stream
     *
     * @var integer
     */
    private $_position;

    /**
     * Current binary position in an UTF-8 stream
     *
     * @var integer
     */
    private $_bytePosition;
    
    /**
     * The set of Token filters applied to the Token stream.
     * Array of Zend_Search_Lucene_Analysis_TokenFilter objects.
     *
     * @var array
     */
    private $_filters = array();    

    /**
     * Object constructor
     *
     * @throws Zend_Search_Lucene_Exception
     */
    public function __construct()
    {
        if (@preg_match('/\pL/u', 'a') != 1) {
            // PCRE unicode support is turned off
            throw new \Zend_Search_Lucene_Exception('Utf8 analyzer needs PCRE unicode support to be enabled.');
        }
    }

    /**
     * Reset token stream
     */
    public function reset()
    {
        $this->_position     = 0;
        $this->_bytePosition = 0;

        // convert input into UTF-8
        if (strcasecmp($this->_encoding, 'utf8' ) != 0  &&
            strcasecmp($this->_encoding, 'utf-8') != 0 ) {
                $this->_input = iconv($this->_encoding, 'UTF-8', $this->_input);
                $this->_encoding = 'UTF-8';
        }
    }

    /**
     * Tokenization stream API
     * Get next token
     * Returns null at the end of stream
     *
     * @return Zend_Search_Lucene_Analysis_Token|null
     */
    public function nextToken()
    {
        if ($this->_input === null) {
            return null;
        }

        //$match = $this->deleteAccent($match);
        //$this->_input = $this->deleteAccent($this->_input);
        $this->_input = strtolower($this->_input);
        
        do {
            if (! preg_match('/[\p{L}]+/u', $this->_input, $match, PREG_OFFSET_CAPTURE, $this->_bytePosition)) {
                // It covers both cases a) there are no matches (preg_match(...) === 0)
                // b) error occured (preg_match(...) === FALSE)
                return null;
            }

            // matched string
            $matchedWord = $match[0][0];

            // binary position of the matched word in the input stream
            $binStartPos = $match[0][1];

            // character position of the matched word in the input stream
            $startPos = $this->_position +
                        iconv_strlen(substr($this->_input,
                                            $this->_bytePosition,
                                            $binStartPos - $this->_bytePosition),
                                     'UTF-8');
            // character postion of the end of matched word in the input stream
            $endPos = $startPos + iconv_strlen($matchedWord, 'UTF-8');

            $this->_bytePosition = $binStartPos + strlen($matchedWord);
            $this->_position     = $endPos;

            $token = $this->normalize(new \Zend_Search_Lucene_Analysis_Token($matchedWord, $startPos, $endPos));
        } while ($token === null); // try again if token is skipped

        return $token;
    } 

    /**
     * Add Token filter to the Analyzer
     *
     * @param Zend_Search_Lucene_Analysis_TokenFilter $filter
     */
    public function addFilter(\Zend_Search_Lucene_Analysis_TokenFilter $filter)
    {
    	$this->_filters[] = $filter;
    }
    
    /**
     * Apply filters to the token. Can return null when the token was removed.
     *
     * @param Zend_Search_Lucene_Analysis_Token $token
     * @return Zend_Search_Lucene_Analysis_Token
     */
    public function normalize(\Zend_Search_Lucene_Analysis_Token $token)
    {
    	foreach ($this->_filters as $filter) {
    		$token = $filter->normalize($token);
    
    		// resulting token can be null if the filter removes it
    		if ($token === null) {
    			return null;
    		}
    	}
    
    	return $token;
    } 
    
    private function deleteAccent($str)
    {
    	return iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $str);
    }           
}