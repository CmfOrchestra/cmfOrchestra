<?php
/**
 * This file is part of the <Admin> project.
 * 
 * @category   Admin_Utils
 * @package    Util
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
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
 *  $dateFormatter    = $container->get('pi_app_admin.date_manager');
 *  $result            = $dateFormatter->parse('December 20, 2011', 'en_GB'); // obtains a datetime instance
 *  echo $dateFormatter->format($result, 'long', 'none', 'fr'); // echoes : "20 décembre 2011"
 * </code>
 * 
 * @category   Admin_Utils
 * @package    Util
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
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
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
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
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function format($date, $dateType = 'medium', $timeType = 'none', $locale = null, $pattern = null)
    {    
        if (is_string($date)) {
            $date = intval($date);
        }
        if (version_compare(\PHP_VERSION, '5.3.4', '<') && !is_int($date) && is_object($date)) {
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
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function parseTimestamp($date, $locale = null)
    {
        if ($date == 'now'){
            $result = new \DateTime();
            return $result->getTimestamp();
        } else {
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
    }
    
    /**
     * Retourne litteralement une date.
     *
     * @param  \DateTime $dateTime
     *
     * @return string
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function createdAgoFilter(\DateTime $dateTime)
    {
    	$delta = time() - $dateTime->getTimestamp();
    	if ($delta < 0) {
    		return '';
    	}
    	$duration = "";
    	if ($delta < 60) {
    		// Seconds
    		$time = $delta;
    		$duration = $time . " second" . (($time === 0 || $time > 1) ? "s" : "") . " ago";
    	} elseif ($delta < 3600) {
    		// Mins
    		$time = floor($delta / 60);
    		$duration = $time . " minute" . (($time > 1) ? "s" : "") . " ago";
    	} else if ($delta < 86400) {
    		// Hours
    		$time = floor($delta / 3600);
    		$duration = $time . " hour" . (($time > 1) ? "s" : "") . " ago";
    	} else {
    		// Days
    		$time = floor($delta / 86400);
    		$duration = $time . " day" . (($time > 1) ? "s" : "") . " ago";
    	}
    
    	return $duration;
    }    
    
    /**
     * Returns the difference between the given timestamps and now or from.
     *
     * @param  \DateTime $dateTime    Timestamp to compare to.
     * @param  \DateTime $from        Timestamp to compare from. If not specified, defaults to now.
     * @return strgin                 Duration
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */     
    public function RelativeTime(\DateTime $dateTime, $from = null)
    {
        if (is_null($from)) {
            $from = time();
        }
    	$delta = $dateTime->getTimestamp() - $from ;
    	if ($delta < 0) {
    		return '';
    	}
    	$duration = "";
    
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
    
    	$year = false; $month = false;
    
    	if ($delta > $units["year"]) {
    		// Années
    		$time = floor($delta /  $units["year"]);
    		$duration .= " <span>".$time . "</span> an" . (($time > 1) ? "s" : "");
    		$year = true;
    		$delta = $delta - (floor($delta /  $units["year"]) * $units["year"]);
    	}
    	if ($delta > $units["month"]) {
    		// Mois
    		$time = floor($delta /  $units["month"]);
    		if ($year) {
    			$duration .= ", <span>".$time . "</span> mois";
    		} else {
    			$duration .= " <span>".$time . "</span> mois";
    		}
    		$month = true;
    		$delta = $delta - (floor($delta /  $units["month"]) * $units["month"]);
    	}
    	if ($delta > $units["day"]) {
    		// Jours
    		$time = floor($delta / $units["day"]);
    		if ($month) {
    			$duration .= " et <span>".$time . "</span> jour" . (($time > 1) ? "s" : "");
    		} else {
    			$duration .= " <span>".$time . "</span> jour" . (($time > 1) ? "s" : "");
    		}
    	}
    	    
    	return $duration;
    }
    
    
    /**
     * List of all months.
     *
     * @param string $locale
     * @access public
     * @return array
     * @static
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function allMonths($locale)
    {
        $month_name = array();
        for($i=1;$i<=12;$i++){
            if ($i<=9) $key = '0'.$i; else $key = $i;
            $month_name[$key] = $this->format(new \DateTime(date( 'Y-m-d', mktime(0, 0, 0, $i))), 'long','medium', $locale, 'MMMM');
        }
        return    $month_name;
    } 
    
    /**
     * List of all days.
     *
     * @param string $locale
     * @access public
     * @return array
     * @static
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function allDays($locale)
    {
        $day_name = array();
        for($i=1;$i<=7;$i++){
            if ($i<=9) $key = '0'.$i; else $key = $i;
            $day_name[$key] = $this->format(new \DateTime( date('Y-m-d', strtotime("+$i day", strtotime("2013-02-17")))), 'long','medium', $locale, 'EEEE');
        }
        return    $day_name;
    }    
    
    /**
     * List of the x next/last year/months/day of a date.
     *
     * @param string $year
     * @param string $month
     * @param string $day
     * @param string $order        ['last','next']
     * @param string $number    
     * @param string $type        ['year','month','day']
     * @param string $format
     * @access public
     * @return array
     * @static
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function nextOrLastList($year, $month, $day, $order, $number, $type = 'month', $format = 'Y-m-d')
    {
        $month         = str_replace(array('00','01','02','03','04','05','06','07','08','09'),array('0','1','2','3','4','5','6','7','8','9'),$month);
        $day         = str_replace(array('00','01','02','03','04','05','06','07','08','09'),array('0','1','2','3','4','5','6','7','8','9'),$day);
        $date         = "{$year}-{$month}-{$day}";
        
        $first      = strtotime($date);
        $results     = array();
        
        if ($order == 'next') {
            for ($i = 0; $i < $number; $i++) {
                array_push($results, date($format, strtotime("+$i $type", $first)));
            }
        } else {
            for ($i = $number-1; $i >= 0; $i--) {
                array_push($results, date($format, strtotime("-$i $type", $first)));
            }
        }
        return $results;
    }    

}