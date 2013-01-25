<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Managers
 * @package    Manager
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-12-11
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Manager;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response as Response;
use Symfony\Component\Security\Core\SecurityContext;

use PiApp\AdminBundle\Builder\PiTreeManagerBuilderInterface;
use PiApp\AdminBundle\Manager\PiCoreManager;
use PiApp\AdminBundle\Entity\Widget;

/**
 * Description of the Authentication Widget manager
 *
 * @category   Admin_Managers
 * @package    Manager
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiAuthenticationManager extends PiCoreManager implements PiTreeManagerBuilderInterface 
{    
	/**
	 * Constructor.
	 *
	 * @param ContainerInterface $container The service container
	 */
	public function __construct(ContainerInterface $container)
	{
		parent::__construct($container);
	}

	/**
	 * Call the tree render source method.
	 *
	 * @param string $id
	 * @param string $lang
	 * @param string $params
	 * @return string
	 * @access	public
	 *
	 * @author Etienne de Longeaux <etienne_delongeaux@hotmail.com>
	 * @since 2012-04-19
	 */
	public function renderSource($id, $lang = '', $params = null)
	{
		str_replace('~', '~', $id, $count);
		if($count == 2)
			list($entity, $method, $template) = explode('~', $this->_Decode($id));
		elseif($count == 1)
			list($entity, $method) = explode('~', $this->_Decode($id));
		else
			throw new \InvalidArgumentException("you have not configure correctly the attibute id");
		
		if(!is_array($params))
			$params				= $this->paramsDecode($params);
		else
			$this->recursive_map($params);
		
		$params['locale']	= $lang;
		
		if(isset($template) && ($method == "_connexion_default"))
			return $this->defaultConnexion($template);
		else
			throw new \InvalidArgumentException("you have not configure correctly the attibute id");
	}
	
	/**
	 * Return the build tree result of a gedmo tree entity, with class options.
	 *
	 * @param string	$template
	 * @access	public
	 * @return string
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 */
	public function defaultConnexion($template = null)
	{
		$em	  	 = $this->container->get('doctrine')->getEntityManager();		
		$request = $this->container->get('request');
        $session = $request->getSession();
        
        if(is_null($template))
        	$template = "FOSUserBundle:Security:login.html.twig";        

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } elseif (null !== $session && $session->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        if ($error) {
            // TODO: this is a potential security risk (see http://trac.symfony-project.org/ticket/9523)
            $error = $error->getMessage();
        }
        // last username entered by the user
        $lastUsername 	= (null === $session) ? '' : $session->get(SecurityContext::LAST_USERNAME);
        $csrfToken 		= $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');

        $response 		=  $this->container->get('templating')->renderResponse($template, array(
            'last_username' => $lastUsername,
            'error'         => $error,
            'csrf_token' 	=> $csrfToken,
        ));
        
        return $response->getContent();
	}
	
}