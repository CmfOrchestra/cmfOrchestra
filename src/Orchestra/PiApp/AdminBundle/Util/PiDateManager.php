<?php
/**
 * This file is part of the <Admin> project.
 * 
 * @category   Admin_Utils
 * @package    Util
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-01-11
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Util;

use PiApp\AdminBundle\Builder\PiDateManagerBuilderInterface;

/**
 * Description of date manager
 *
 * <code>
 * 	$dateFormatter	= $container->get('pi_app_admin.date_manager');
 *  $result			= $dateFormatter->parse('December 20, 2011', 'en_GB'); // obtains a datetime instance
 *  echo $dateFormatter->format($result, 'long', 'none', 'fr'); // echoes : "20 décembre 2011"
 * </code>
 * 
 * @category   Admin_Utils
 * @package    Util
 * 
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class PiDateManager implements PiDateManagerBuilderInterface 
{    
    protected $formats = array(
        'full'   => \IntlDateFormatter::FULL,
        'long'   => \IntlDateFormatter::LONG,
        'medium' => \IntlDateFormatter::MEDIUM,
        'short'  => \IntlDateFormatter::SHORT,
        'none'   => \IntlDateFormatter::NONE,
    );
    
    /**
     * Parse a string representation of a date to a \DateTime
     * 
     * @param string $date
     * @param string $locale
     * 
     * @return \DateTime datetime
     * @access public 
     * @throws \Exception If fails parsing the string
     * 
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function parse($date, $locale = null)
    {
        $result = new \DateTime();
        $result->setTimestamp($this->parseTimestamp($date, $locale));
        
        return $result;
    }
    
    /**
     * Translate a timestamp to a localized string representation.
     * Parameters dateType and timeType defines a kind of format. Allowed values are (none|short|medium|long|full).
     * Default is medium for the date and no time.
     * Uses default system locale by default. Pass another locale string to force a different translation
     * You might not like the default formats, so you can pass a custom pattern as last argument.
     *
     * @param mixed $date
     * @param string $dateType
     * @param string $timeType
     * @param mixed $locale
     * @param string $pattern
     *
     * @return string The string representation
     * @access public
     * 
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function format($date, $dateType = 'medium', $timeType = 'none', $locale = null, $pattern = null)
    {	
    	if(is_string($date))
    		$date = intval($date);
    	
    	if (version_compare(\PHP_VERSION, '5.3.4', '<') && !is_int($date)) {
    		$date = $date->getTimestamp();
    	}
    	
        $dateFormater = \IntlDateFormatter::create($locale ?: \Locale::getDefault(), $this->formats[$dateType], $this->formats[$timeType], date_default_timezone_get(), null, $pattern);

        return $dateFormater->format($date);
    }
    
    /**
     * Parse a string representation of a date to a timestamp.
     * 
     * @param string $date
     * @param string $locale
     * 
     * @return int Timestamp
     * @access public
     * @throws \Exception If fails parsing the string
     * 
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    private function parseTimestamp($date, $locale = null) {
        // try time default formats
        foreach ($this->formats as $timeFormat) {
            // try date default formats
            foreach($this->formats as $dateFormat) {
                $dateFormater = \IntlDateFormatter::create($locale ?: \Locale::getDefault(), $dateFormat, $timeFormat, date_default_timezone_get());
                $timestamp = $dateFormater->parse($date);
                
                if ($dateFormater->getErrorCode() == 0) {
                    return $timestamp;
                }
            }
        }
        
        // try other custom formats
        $formats = array(
            'MMMM yyyy', // november 2011 - nov. 2011
        );
        foreach($formats as $format) {
            $dateFormater = \IntlDateFormatter::create($locale ?: \Locale::getDefault(), $this->formats['none'], $this->formats['none'],  date_default_timezone_get(), \IntlDateFormatter::GREGORIAN, $format);
            $timestamp = $dateFormater->parse($date);
            
            if ($dateFormater->getErrorCode() == 0) {
                return $timestamp;
            }
        }
        
        throw new \Exception('"'.$date.'" could not be converted to \DateTime');
    }
    
    
    /**
     * Function: relative_time
     * Returns the difference between the given timestamps or now.
     *
     * Parameters:
     *     $time - Timestamp to compare to.
     *     $from - Timestamp to compare from. If not specified, defaults to now.
     *
     * Returns:
     *     A string formatted like "3 days ago" or "3 days from now".
     */
    public function relative_time($when, $from = null)
    {
    	fallback($from, time());
    
    	$time = (is_numeric($when)) ? $when : strtotime($when) ;
    
    	$difference = $from - $time;
    
    	if ($difference < 0) {
    		$word = "from now";
    		$difference = -$difference;
    	} elseif ($difference > 0)
    	$word = "ago";
    	else
    		return "just now";
    
    	$units = array("second"     => 1,
    			"minute"     => 60,
    			"hour"       => 60 * 60,
    			"day"        => 60 * 60 * 24,
    			"week"       => 60 * 60 * 24 * 7,
    			"month"      => 60 * 60 * 24 * 30,
    			"year"       => 60 * 60 * 24 * 365,
    			"decade"     => 60 * 60 * 24 * 365 * 10,
    			"century"    => 60 * 60 * 24 * 365 * 100,
    			"millennium" => 60 * 60 * 24 * 365 * 1000);
    
    	$possible_units = array();
    	foreach ($units as $name => $val)
    		if (($name == "week" and $difference >= ($val * 2)) or # Only say "weeks" after two have passed.
    				($name != "week" and $difference >= $val))
    		$unit = $possible_units[] = $name;
    
    	$precision = (int) in_array("year", $possible_units);
    	$amount = round($difference / $units[$unit], $precision);
    
    	return $amount." ".pluralize($unit, $amount)." ".$word;
    }    
}