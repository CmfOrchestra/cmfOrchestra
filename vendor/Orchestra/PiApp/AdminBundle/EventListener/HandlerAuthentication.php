<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Eventlistener
 * @package    EventListener
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2011-01-25
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\EventListener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;

/**
 * Custom logout handler.
 *
 * @category   Admin_Eventlistener
 * @package    EventListener
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class HandlerAuthentication implements AuthenticationSuccessHandlerInterface 
{
	/**
	 * @var \Symfony\Component\Routing\Router $router
	 */
	protected $router;
		
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;
    
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;    
    
    /**
     * Constructs a new instance of SecurityListener.
     * 
     * @param Router $router The router
     * @param ContainerInterface $container The service container
     */
    public function __construct(ContainerInterface $container, Doctrine $doctrine)
    {
    	$this->router        = $container->get('bootstrap.RouteTranslator.factory');
    	$this->container     = $container;
    	$this->em            = $doctrine->getManager();
    }
    
    /**
     * Sets the information in cookies (orchestra-layout, orchestra-browser)
     * and redirects with the right url.
     * 
     * Invoked after the response has been created.
     * Invoked to allow the system to modify or replace the Response object after its creation.
     *
     * @param FilterResponseEvent $event The event
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
		if (isset($_POST['roles']) && !empty($_POST['roles']))
	    {
	    	$all_authorization_roles = json_decode($_POST['roles'], true);
	    	$best_roles_name = $this->container->get('bootstrap.Role.factory')->getBestRoleUser();
	    	if (is_array($all_authorization_roles) && !in_array($best_roles_name, $all_authorization_roles)) {
	    		// Set a flash message
	    		$request->getSession()->getFlashBag()->add('notice', "Vous n'êtes pas autorisé à vous connecté !");
	    		// we disconnect user
	    		$request->getSession()->invalidate();
	    	}
	    }
	    $response = new Response(json_encode('ok'));
	    $response->headers->set('Content-Type', 'application/json');
	    return $response;
    }    
    
}