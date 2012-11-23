<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Utils
 * @package    Util
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-18
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Util;

use PiApp\AdminBundle\Builder\PiLocaleManagerBuilderInterface;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of the locale manager
 *
 * <code>
 * 	$fileFormatter	= $this-container->get('pi_app_admin.locale_manager');
 * </code>
 * 
 * @category   Admin_Utils
 * @package    Util
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiLocaleManager implements PiLocaleManagerBuilderInterface 
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
     * Getting the Browser Default Language.
     *
     * @param string $deflang
     *
     * @return string
     * @access private
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */    
    public function parseDefaultLanguage($deflang = "fr")
    {
		if (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]))
    		$http_accept = $_SERVER["HTTP_ACCEPT_LANGUAGE"];
    	else
    		$http_accept = NULL;
    	
    	if(isset($http_accept) && strlen($http_accept) > 1)  {
    		# Split possible languages into array
    		$x = explode(",",$http_accept);
    	
	    	foreach ($x as $val) {
	    		#check for q-value and create associative array. No q-value means 1 by rule
	    		if(preg_match("/(.*);q=([0-1]{0,1}\.\d{0,4})/i",$val,$matches))
	    			$lang[$matches[1]] = (float)$matches[2];
	    		else
	    			$lang[$val] = 1.0;
	    	}
	    
	    	#return default language (highest q-value)
	    	$qval = 0.0;
	    	foreach ($lang as $key => $value) {
	    		if ($value > $qval) {
			    	$qval = (float)$value;
			    	$deflang = $key;
			    }
		    }
	    }
	    return strtolower(substr($deflang,0,2));
    }
}