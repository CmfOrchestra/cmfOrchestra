<?php
/**
 * This file is part of the <Google> project.
 *
 * @category   BootStrap_Extension
 * @package    Google
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-04-23
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\GoogleBundle\Extension;

use BootStrap\GoogleBundle\Helper\AnalyticsHelper;

/**
 * Analytics Extension
 *
 * @category   BootStrap_Extension
 * @package    Google
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class AnalyticsExtension extends \Twig_Extension
{
	/**
	 * @var \BootStrap\GoogleBundle\Helper\AnalyticsHelper
	 */	
    private $Helper;

    /**
     * Constructor.
     *
     * @param \BootStrap\GoogleBundle\Helper\AnalyticsHelper $Helper
     */    
    public function __construct(AnalyticsHelper $Helper)
    {
        $this->Helper = $Helper;
    }

    public function getGlobals()
    {
        return array(
            'pi_google_analytics' => $this->Helper
        );
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'pi_google_analytics';
    }
}
