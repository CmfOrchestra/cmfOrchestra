<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Twig
 * @package    Cache
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-12
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Twig;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Twig cache config.
 *
 * @category   Admin_Twig
 * @package    Cache
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiTwigCache
{
    /**
     *
     * @var \Twig_Environment
     */
    protected $twig_environment = null;
    
	/**
	 * @var \Symfony\Component\DependencyInjection\ContainerInterface
	 */
	protected $container;  

    /**
     *
     * @param \Twig_Environment $twig_environment
     */
    public function __construct(\Twig_Environment $twig_environment, ContainerInterface $container)
    {
        $this->twig_environment = $twig_environment;
        $this->container		= $container;
    }

    /**
     *
     * @return \Twig_Environment
     */
    public function getTwigEnvironment()
    {
        return $this->twig_environment;
    }

    /**
     *
     * @param \Twig_Environment $twig_environment
     */
    public function setTwigEnvironment(\Twig_Environment $twig_environment)
    {
        $this->twig_environment = $twig_environment;
    }

    /**
     * Delete the cache filename for a given template.
     * 
     * @param string $name
     */
    public function invalidate($name)
    {
        @unlink($this->getTwigEnvironment()->getCacheFilename($name));
    }

    /**
     * Loads and warms up a template by name.
     * 
     * @param string $name
     */
    public function warmup($name/*, $ext*/)
    {
        $this->getTwigEnvironment()->loadTemplate($name);
        
        $isMemCacheEnable = $this->container->getParameter("pi_app_admin.page.memcache_enable");
        if($isMemCacheEnable && $this->container->has("pi_memcache")){
        	$this->container->get("pi_memcache")->clear($name);
        }
    }
    
    /**
     * Renders a view and returns a Response.
     *
     * @param string   $view       The view name
     * @param array    $parameters An array of parameters to pass to the view
     * @param Response $response   A Response instance
     *
     * @return Response A Response instance
     */
    public function renderResponse($name, array $parameters = array(), Response $response = null)
    {
        if (null === $response) {
            $response = new Response();
        }
        
        $isMemCacheEnable = $this->container->getParameter("pi_app_admin.page.memcache_enable");
        
        // if the memcache service is disable
        // OR MemCache service doesn't exist
        // OR the content name isn't register in the memcache 
        if( !$isMemCacheEnable || !$this->container->has("pi_memcache") || ($this->container->has("pi_memcache") && !$this->container->get("pi_memcache")->get($name)) ){
        	//$response->setContent($this->getTwigEnvironment()->loadTemplate($name)->render($parameters));
        	$response = $this->container->get('pi_app_admin.templating')->renderResponse($name, $parameters, $response);
        	
        	// if the memcache service does exist, we register the content page in the memcache
        	if($isMemCacheEnable){
        		//$source =  $this->getTwigEnvironment()->getLoader()->getSource($name);
       			$this->container->get("pi_memcache")->set($name, $response);
        	}
        }elseif($isMemCacheEnable){
        	$response = $this->container->get("pi_memcache")->get($name);
        }
                
        return $response;
    } 
    
    /**
     * Return if yes or no the user is UsernamePassword token.
     *
     * @return boolean
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function isUsernamePasswordToken()
    {
    	if ($this->container->get('security.context')->getToken() instanceof \Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken)
    		return true;
    	else
    		return false;
    }    
     
}