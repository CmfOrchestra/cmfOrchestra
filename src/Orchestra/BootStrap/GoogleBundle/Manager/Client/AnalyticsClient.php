<?php
/**
 * This file is part of the <Google> project.
 *
 * @category   BootStrap_Manager
 * @package    Google
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-04-23
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\GoogleBundle\Manager\Client;

use Symfony\Component\DependencyInjection\ContainerInterface;
use BootStrap\GoogleBundle\Manager\Client\AbstractClient;
use BootStrap\GoogleBundle\Lib\GoogleAnalyticsAPI;

/**
 * Analytics client
 * 
 * @category   BootStrap_Manager
 * @package    Google 
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class AnalyticsClient extends AbstractClient
{	
	/**
	 * Constructor.
	 *
	 * @param \Symfony\Component\DependencyInjection\ContainerInterface		$container
	 * @param string	$clientName
	 */
    public function __construct(ContainerInterface $container, $clientName)
    {
    	parent::__construct($container, $clientName);
    }    
    
    /**
     * Get a google API.
     *
     * @param string    $name
     * @param string     $options
     * @return array
     * @access public
     *
     * @author (c) <Adel Oustad> <adel.oustad@gmail.com>
     */
    public function getApi($name = "", $options = "")
    {
        $ga = new GoogleAnalyticsAPI($this->config[ $this->getClient() ]['api']['email'], $this->config[ $this->getClient() ]['api']['pass'], $this->config[ $this->getClient() ]['api']['id'], date('Y-m-d', time()));
        $navigateurs = $ga->getDimensionByMetric($name, $options);
        $visits = $ga->getMetric($name);
        return array('navigateurs' => $navigateurs, 'visits' => $visits); 
    }    

    /**
     * Add a tracker.
     *
     * @param string	$name
     * @param array		$options
     * @return void
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function addTacker($name, array $options)
    {
    	if (!isset($this->config[ $this->getClient() ][$name]) || empty($this->config[ $this->getClient() ][$name])){
    		$this->config[ $this->getClient() ][$name] = $options;
    	}
    }
    
    /**
     * Gets trackers.
     * 
     * @param string	$trackerKey
     * @return array
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function getTrackers($trackerKey = "")
    {
    	if(empty($trackerKey))
    		return $this->config[ $this->getClient() ]['trackers'];
    	elseif(isset($this->config[ $this->getClient() ]['trackers'][$trackerKey]) && !empty($this->config[ $this->getClient() ]['trackers'][$trackerKey]))
    		return array($trackerKey => $this->config[ $this->getClient() ]['trackers'][$trackerKey]);
    }
    
    /**
     * @param string $trackerKey
     * @return boolean $allowHash
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com> 
     */
    public function isAllowHash($trackerKey)
    {
    	if (!array_key_exists($trackerKey, $this->config[ $this->getClient() ]['trackers'])) {
    		return false;
    	}
    	$trackerConfig = $this->config[ $this->getClient() ]['trackers'][$trackerKey];
    	if (!array_key_exists('allowHash', $trackerConfig)) {
    		return false;
    	}
    	return $trackerConfig['allowHash'];
    }    

    /**
     * @param string $trackerKey
     * @return boolean $allowLinker
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com> 
     */
    public function isAllowLinker($trackerKey)
    {
    	if (!array_key_exists($trackerKey, $this->config[ $this->getClient() ]['trackers'])) {
    		return true;
    	}
    	$trackerConfig = $this->config[ $this->getClient() ]['trackers'][$trackerKey];
    	if (!array_key_exists('allowLinker', $trackerConfig)) {
    		return true;
    	}
    	return $trackerConfig['allowLinker'];
    }

    /**
     * @param string $trackerKey
     * @return boolean $trackPageLoadTime
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com> 
     */
    public function isTrackPageLoadTime($trackerKey)
    {
    	if (!array_key_exists($trackerKey, $this->config[ $this->getClient() ]['trackers'])) {
    		return false;
    	}
    	$trackerConfig = $this->config[ $this->getClient() ]['trackers'][$trackerKey];
    	if (!array_key_exists('trackPageLoadTime', $trackerConfig)) {
    		return false;
    	}
    	return $trackerConfig['trackPageLoadTime'];
    }    
   
}