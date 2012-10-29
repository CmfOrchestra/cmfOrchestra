<?php
/**
 * This file is part of the <Facebook> project.
 *
 * @category   BootStrap_Extension
 * @package    Facebook
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-04-23
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\FacebookBundle\Extension;

use BootStrap\FacebookBundle\Helper\AnalyticsHelper;

/**
 * Analytics Extension
 *
 * @category   BootStrap_Extension
 * @package    Facebook
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class AnalyticsExtension extends \Twig_Extension
{
	/**
	 * @var \BootStrap\FacebookBundle\Helper\AnalyticsHelper
	 */	
    private $Helper;

    /**
     * Constructor.
     *
     * @param \BootStrap\FacebookBundle\Helper\AnalyticsHelper $Helper
     */    
    public function __construct(AnalyticsHelper $Helper)
    {
        $this->Helper = $Helper;
    }

    public function getGlobals()
    {
        return array(
            'pi_facebook_analytics' => $this->Helper
        );
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'pi_facebook_analytics';
    }
}
