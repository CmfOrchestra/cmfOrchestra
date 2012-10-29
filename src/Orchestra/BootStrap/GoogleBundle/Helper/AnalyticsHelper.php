<?php
/**
 * This file is part of the <Google> project.
 *
 * @category   BootStrap_Helper
 * @package    Google
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-04-23
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\GoogleBundle\Helper;

use Symfony\Component\Templating\Helper\Helper;
use BootStrap\GoogleBundle\Manager\Client\AnalyticsClient;

/**
 * Analytics Helper
 * 
 * @category   BootStrap_Helper
 * @package    Google 
 * 
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class AnalyticsHelper extends Helper
{
	/**
	 * @var \BootStrap\GoogleBundle\Manager\Client\AnalyticsClient
	 */	
    private $client;

    /**
     * Constructor.
     *
     * @param \BootStrap\GoogleBundle\Manager\Client\AnalyticsClient
     */    
    public function __construct(AnalyticsClient $analytics)
    {
        $this->client = $analytics;
    }

    /**
     * Gets trackers.
     * 
     * @param string	$trackerKey
     * @return array
     * @access public
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */    
    public function getTrackers($trackerKey = "")
    {
        return $this->client->getTrackers($trackerKey);
    }
    
    /**
     * Gets trackers.
     *
     * @param string	$trackerKey
     * @return boolean
     * @access public
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */    
    public function isAllowHash($trackerKey)
    {
    	return $this->client->isAllowHash($trackerKey);
    }    
    
    /**
     * Gets trackers.
     *
     * @param string	$trackerKey
     * @return boolean
     * @access public
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */    
    public function isAllowLinker($trackerKey)
    {
    	return $this->client->isAllowLinker($trackerKey);
    }

    /**
     * Gets trackers.
     *
     * @param string	$trackerKey
     * @return boolean
     * @access public
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */    
    public function isTrackPageLoadTime($trackerKey)
    {
    	return $this->client->isTrackPageLoadTime($trackerKey);
    }   

    /**
     * Gets api.
     * 
     * @param string    $name
     * @param string    $options
     * @return array
     * @access public
     *
     * @author (c) <Adel Oustad> <adel.oustad@gmail.com>
     */    
    public function getApi($name = "", $options = "")
    {
        return $this->client->getApi($name, $options);
    }

    public function getName()
    {
        return 'pi_google_analytics';
    }
    
}
