<?php
/**
 * This file is part of the <Facebook> project.
 *
 * @category   BootStrap_Manager
 * @package    Facebook
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-04-23
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\FacebookBundle\Manager\Client;

use Symfony\Component\DependencyInjection\ContainerInterface;
use BootStrap\FacebookBundle\Manager\Client\AbstractClient;

require_once "facebook.php";
/**
 * Analytics client
 * 
 * @category   BootStrap_Manager
 * @package    Facebook 
 * 
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
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
     * Gets api.
     * 
     * @return array
     * @access public
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * 
     * Exemple d'appel dans un twig : 
     *           
     *           {% set resultat = pi_facebook_analytics.getApi('read','home') %} ou getApi('publish','feed') ou getApi()
     *           {% if resultat.user %}
     *               <a href="{{ resultat.logUrl }}">Logout</a>
     *               <h3>You</h3>
     *               <img src="https://graph.facebook.com/{{ resultat.user }}/picture">
     *               
     *               <h3>Your User Object (/me)</h3>
     *               <pre>{{ resultat.user_profile|print_r }}</pre>
     *           {% else %}
     *               <div>
     *                   <a href="{{ resultat.logUrl }}">Login with Facebook</a>
     *               </div>
     *               <strong><em>You are not Connected.</em></strong>
     *           {% endif %}
     *
     */
    public function getApi($permissions="", $type="")
    {
        $facebook = new \Facebook(array(
          'appId'  => $this->config[ $this->getClient() ]['api']['appId'],
          'secret' => $this->config[ $this->getClient() ]['api']['secret'],
        ));
        $user = $facebook->getUser();
        if ($user) {
            try {
                // Proceed knowing you have a logged in user who's authenticated.
                $user_profile = $facebook->api('/me/'.$type);
            } catch (FacebookApiException $e) {
                error_log($e);
                $user = null;
            }
        }
        
        // Login or logout url will be needed depending on current user state.
        if ($user) {
            $logUrl = $facebook->getLogoutUrl();
        } else {
            if($permissions==""){
                $logUrl = $facebook->getLoginUrl(array('scope' => $this->config[ $this->getClient() ]['api']['permissions_basique']));
            }else{
                $logUrl = $facebook->getLoginUrl(array('scope' => $this->config[ $this->getClient() ]['api']['permissions_'.$permissions]));
            }         
            $user_profile = null;
        }       
        return array('user' => $user, 'logUrl' => $logUrl, 'user_profile' => $user_profile);
    }
}