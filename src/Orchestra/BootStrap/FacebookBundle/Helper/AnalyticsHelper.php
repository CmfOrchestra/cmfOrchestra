<?php
/**
 * This file is part of the <Facebook> project.
 *
 * @category   BootStrap_Helper
 * @package    Facebook
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-04-23
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\FacebookBundle\Helper;

use Symfony\Component\Templating\Helper\Helper;
use BootStrap\FacebookBundle\Manager\Client\AnalyticsClient;

/**
 * Analytics Helper
 * 
 * @category   BootStrap_Helper
 * @package    Google 
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class AnalyticsHelper extends Helper
{
	/**
	 * @var \BootStrap\FacebookBundle\Manager\Client\AnalyticsClient
	 */	
    private $client;

    /**
     * Constructor.
     *
     * @param \BootStrap\FacebookBundle\Manager\Client\AnalyticsClient
     */    
    public function __construct(AnalyticsClient $analytics)
    {
        $this->client = $analytics;
    }

    /**
     * Gets api.
     * 
     * @param string    $permissions
     * @param string    $type
     * @return array
     * @access public
     *
     * @author (c) <Adel Oustad> <adel.oustad@gmail.com>
     */    
    public function getApi($permissions="", $type="")
    {
        return $this->client->getApi($permissions, $type);
    }

    public function getName()
    {
        return 'pi_facebook_analytics';
    }
    
}
