<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Twig
 * @package    Extension 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-11
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Locale\Locale;

/**
 * Date Filters used in twig
 *
 * @category   Admin_Twig
 * @package    Extension 
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiDateExtension extends \Twig_Extension
{
	/**
	 * @var \Symfony\Component\DependencyInjection\ContainerInterface
	 */
	protected $container;
	
	/**
	 * Constructor.
	 *
	 * @param ContainerInterface $container The service container
	 */
	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}
		
    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
	public function getName() {
		return 'admin_date_extension';
	}
		
	/**
	 * Returns a list of filters to add to the existing list.
	 * 
	 * <code>
	 * 	{{ comment.created|created_ago }}
	 *  {{ comment.created|localedate('long','medium', 'fr', 'MMMM YYYY') }}  to have a long date and medium time, in the current locale
	 *  {{ comment.created|localedate }} to have a medium date and no time, in the current locale
	 *  {{ comment.country|country }} to have the country, in the current locale
	 *  {{ comment.country|country('c ountry does not exist') }} Define the returned value if the country does not exist
	 *  {{ 'now' | convertToTimestamp  }}
	 *  {{ 'December 20, 2011' | convertToTimestamp('en_GB')  }}
	 * </code>
	 * 
	 * @return array An array of filters
	 * @access public
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
    public function getFilters()
    {
        return array(
            'created_ago' 		=> new \Twig_Filter_Method($this, 'createdAgoFilter'),
        	'relativetime_ago' 	=> new \Twig_Filter_Method($this, 'relativetimeAgoFilter'),
       		'country'     		=> new \Twig_Filter_Method($this, 'countryFilter'),
       		'localedate'  		=> new \Twig_Filter_Method($this, 'localeDateFilter'),
        	'convertToDateTime'	=> new \Twig_Filter_Method($this, 'convertToDattimeFilter'),
        	'convertMonthNumberToString'	=> new \Twig_Filter_Method($this, 'convertMonthNumberToStringFilter'),
        	'convertToTimestamp'=> new \Twig_Filter_Method($this, 'convertToTimestampFilter'),
        );
    }
    
    /**
     * Callbacks
     */   
    
    public function convertToDattimeFilter($string)
    {
    	return new \DateTime($string);
    }
    
    public function convertMonthNumberToStringFilter($month_number)
    {
    	return date( 'F', mktime(0, 0, 0, $month_number) );
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
        if ($delta < 0)
            //throw new \Exception("createdAgo is unable to handle dates in the future");
        	return '';

        $duration = "";
        if ($delta < 60)
        {
            // Seconds
            $time = $delta;
            $duration = $time . " second" . (($time === 0 || $time > 1) ? "s" : "") . " ago";
        }
        else if ($delta < 3600)
        {
            // Mins
            $time = floor($delta / 60);
            $duration = $time . " minute" . (($time > 1) ? "s" : "") . " ago";
        }
        else if ($delta < 86400)
        {
            // Hours
            $time = floor($delta / 3600);
            $duration = $time . " hour" . (($time > 1) ? "s" : "") . " ago";
        }
        else
        {
            // Days
            $time = floor($delta / 86400);
            $duration = $time . " day" . (($time > 1) ? "s" : "") . " ago";
        }

        return $duration;
    }
    
    /**
     * Translate a country indicator to its locale full name
     * Uses default system locale by default. Pass another locale string to force a different translation
     *
     * @param string $country The contry indicator
     * @param string $default The default value is the country does not exist (optionnal)
     * @param mixed $locale
     * 
     * @return string The localized string
     * @access public
     * @static
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function countryFilter($country, $default = '', $locale = null)
    {
    	$locale    = $locale == null ? \Locale::getDefault() : $locale;
    	$countries = Locale::getDisplayCountries($locale);
    
    	return array_key_exists($country, $countries) ? $countries[$country] : $default;
    }
    
    /**
     * Translate a timestamp to a localized string representation.
     * Parameters dateType and timeType defines a kind of format. Allowed values are (none|short|medium|long|full).
     * Default is medium for the date and no time.
     * Uses default system locale by default. Pass another locale string to force a different translation.
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
     * @static
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function localeDateFilter($date, $dateType = 'medium', $timeType = 'none', $locale = null, $pattern = null)
    {
    	if(is_string($date))
    		$date = intval($date);
    	
    	if (version_compare(\PHP_VERSION, '5.3.4', '<') && !is_int($date)) {
    		$date = $date->getTimestamp();
    	}    	
    	
    	$DateFormatter	= $this->container->get('pi_app_admin.date_manager');
    	
    	return $DateFormatter->format($date, $dateType, $timeType, $locale, $pattern);
    }  

    /**
     * Returns the difference between the given timestamps or now.
     *
     * Parameters:
     * @param mixed		$time - Timestamp to compare to.
     * @param mixed		$from - Timestamp to compare from. If not specified, defaults to now.
     *
     * @return string A string formatted like "3 days ago" or "3 days from now".
     * @access public
     * @static
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */    
    public function relativetimeAgoFilter($when, $from = null)
    {
    	return $this->container->get('pi_app_admin.date_manager')->relative_time($when, $from);
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
    public function convertToTimestampFilter($date, $locale = null){
    	if($date == 'now'){
    		$result = new \DateTime();
    		return $result->getTimestamp();
    	}else
    		return $this->container->get('pi_app_admin.date_manager')->parseTimestamp($date, $locale);
    }    
}