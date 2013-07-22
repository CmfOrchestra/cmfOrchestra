<?php
/**
 * This file is part of the <Wurfl> project.
 *
 * @category   BootStrap_Eventlistener
 * @package    EventListener
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2011-01-25
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;

use PiApp\AdminBundle\Lib\Browscap;
use PiApp\AdminBundle\Lib\MobileDetect;

/**
 * Custom mobile listener.
 * Register the mobile/desktop format.
 *
 * @category   BootStrap_Eventlistener
 * @package    EventListener
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class RequestListener
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;
    
    /**
     * @var \PiApp\AdminBundle\Lib\Browscap
     */
    protected $browscap;    
    
    /**
     * @var \PiApp\AdminBundle\Lib\MobileDetect
     */
    protected $mobiledetect;    
    
    /**
     * Constructor.
     *
     * @param ContainerInterface $container The service container
     */
    public function __construct(ContainerInterface $container, Browscap $Browscap, MobileDetect $mobiledetect)
    {
        $this->container         = $container;
        $this->mobiledetect     = $mobiledetect;
        $this->browscap         = $Browscap;
    }    

    /**
     * Invoked to modify the controller that should be executed.
     *
     * @param FilterControllerEvent $event The event
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */    
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request     = $event->getRequest($event);
        $locale        = $request->getLocale();
        $globals     = $this->container->get("twig")->getGlobals();
        // we get params        
        $this->date_expire        = $this->container->getParameter('pi_app_admin.cookies.date_expire');
        $this->date_interval    = $this->container->getParameter('pi_app_admin.cookies.date_interval');
        // we set the browser information
        $browser    =    $this->browscap->getBrowser();
//         if ($this->date_expire && !empty($this->date_interval)) {
//             $dateExpire = new \DateTime("NOW");
//             $dateExpire->add(new \DateInterval($this->date_interval)); // we add 4 hour
//         } else {
//             $dateExpire = 0;
//         }
        // we add browser info in the request
        $request->attributes->set('orchestra-browser', $browser);
        $request->attributes->set('orchestra-mobiledetect', $this->mobiledetect);
        // we stop the website content if the navigator is not configurate correctly.
        $nav_desktop    = strtolower($browser->Browser);
        $nav_mobile        = strtolower($browser->Platform);
        $isNoScope = false;
        if ( 
            (!$browser->isMobileDevice) 
            &&
            (!isset($globals["navigator"][$nav_desktop]) || floatval($browser->Version)  <= $globals["navigator"][$nav_desktop]) 
        ){
            $isNoScope = true;
        }elseif ( 
            ($browser->isMobileDevice && !$this->mobiledetect->isTablet())
            &&  
            (!isset($globals["mobile"][$nav_mobile]) || floatval($browser->Platform_Version)  <= $globals["mobile"][$nav_mobile] )
        ){
            $isNoScope = true;
        }elseif ( 
            ($browser->isMobileDevice && $this->mobiledetect->isTablet())
            &&  
            (!isset($globals["tablet"][$nav_mobile]) || floatval($browser->Platform_Version)  <= $globals["tablet"][$nav_mobile] )
        ){
            $isNoScope = true;
        }
        if ( ($browser->Version == 0.0) || ($browser->Platform_Version == 0.0) ) {
            $isNoScope = false;
        }
        if ($isNoScope){
            if (!$browser->isMobileDevice) {
                if ( isset($globals["navigator"][$nav_desktop]) && (floatval($browser->Version)  <= $globals["navigator"][$nav_desktop]) ) $isNav = false; else $isNav = true;
            }elseif ($bc->getBrowser()->isMobileDevice) {
                if ( isset($globals["navigator"][$nav_mobile]) && (floatval($browser->Platform_Version)  <= $globals["navigator"][$nav_mobile]) ) $isNav = false; else $isNav = true;
            }
            $isCookies     = $browser->Cookies;
            $isJs         = $browser->JavaScript;
            // we set response
            $response     = new \Symfony\Component\HttpFoundation\Response($request->getUri());
            $response->headers->set('Content-Type', 'text/html');
            $response     = $this->container->get('templating')->renderResponse('PiAppTemplateBundle:Template\\Nonav:nonav.html.twig', array('locale' => $locale, 'isCookies'=>$isCookies, 'isJs'=>$isJs, 'isNav'=>$isNav), $response);
            $event->setResponse($response);
        } else {
            // we add browser info in the request
            $request->attributes->set('orchestra-browser', $browser);
            $request->attributes->set('orchestra-mobiledetect', $this->mobiledetect);
            // we add orchestra-layout info in the request
            if ($request->cookies->has('orchestra-layout')){
                $request->attributes->set('orchestra-layout', $request->cookies->get('orchestra-layout'));
            }
            $request->attributes->set('orchestra-screen', "layout");                
        }
    }     
}