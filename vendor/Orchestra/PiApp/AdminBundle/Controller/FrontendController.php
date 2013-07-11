<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Controllers
 * @package    Controller
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-03
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use PiApp\AdminBundle\Exception\ControllerException;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use JMS\SecurityExtraBundle\Annotation\Secure;

use PiApp\AdminBundle\Entity\Enquiry;
use PiApp\AdminBundle\Form\EnquiryType;
use PiApp\AdminBundle\Entity\Page as Page;
use PiApp\AdminBundle\Entity\TranslationPage;


/**
 * Frontend controller.
 *
 * @category   Admin_Controllers
 * @package    Controller
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class FrontendController extends BaseController
{
    /**
     * Parse a file and returns the contents
     *
     * @param string    $file         file name consists of: web_bundle_piappadmin_css_screen__css for express this path : web/bundle/piappadmin/css/screen.css
     * @return string    content of the file
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-01-12
     */
    public function contentfileAction($file)
    {
        $fileFormatter    = $this->container->get('pi_app_admin.file_manager');
        return $fileFormatter->getContentCodeFile($file);
    }
        
    /**
     * Configures the local language
     *
     * @param string $langue
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
      * @since 2011-12-29
     */    
    public function setLocalAction($langue = '')
    {
        // It tries to redirect to the original page.
        $new_url = $this->container->get('bootstrap.RouteTranslator.factory')->getRefererRoute($langue);
        return new RedirectResponse($new_url);
    }    
    
    /**
     * Displays a page
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-01-24
     */
    public function pageAction()
    {
        $route   = $this->container->get('request')->get('route_name');
        
        // we get the page manager
        $pageManager      = $this->get('pi_app_admin.manager.page');
        // we get the route name
        if (empty($route))
            $route = $this->container->get('request')->get('_route');
        // we set the object Translation Page by route
        $pageManager->setPageByRoute($route);
        // we return the render (cache or not)
        $response = $pageManager->render();
        
        return $response;
    }
    
    /**
     * Refresh a page with all these languages
     *
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-04-02
     */
    public function refreshpageAction()
    {
        try {
            $lang          = $this->container->get('request')->getLocale();
            $data         = $this->container->get('bootstrap.RouteTranslator.factory')->getRefererRoute($lang, array('result' => 'match'));
            $new_url     = $this->container->get('bootstrap.RouteTranslator.factory')->getRefererRoute($lang);
            
            // we get the page manager
            $pageManager  = $this->get('pi_app_admin.manager.page');
            // we get the object Page by route
            $page        = $pageManager->setPageByRoute($data['_route'], true);
            // we set the result
            if ($page instanceof Page){
                $pageManager->cacheRefresh();
            }
            $this->container->get('request')->setLocale($lang);            
        } catch (\Exception $e) {
            $new_url = $this->container->get('router')->generate('home_page');
        }        
        return new RedirectResponse($new_url);
    }
    
    /**
     * Indexation mamanger of a page (archiving or delete)
     *
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-06-02
     */
    public function indexationAction($action)
    {
        $lang          = $this->container->get('request')->getLocale();
        $data         = $this->container->get('bootstrap.RouteTranslator.factory')->getRefererRoute($lang, array('result' => 'match'));
        $new_url     = $this->container->get('bootstrap.RouteTranslator.factory')->getRefererRoute($lang);
    
        // we get the page manager
        $pageManager  = $this->get('pi_app_admin.manager.page');
        // we get the object Page by route
        $page        = $pageManager->setPageByRoute($data['_route'], true);
        
        // we set the result
        if ($page instanceof Page){
            switch ($action) {
                case ('archiving') :
                    $this->container->get('pi_app_admin.manager.search_lucene')->indexPage($page);
                    break;
                case ('delete') :
                    $this->container->get('pi_app_admin.manager.search_lucene')->deletePage($page);
                    break;
                default:
                    // deafault
                    break;
            }
        }
        
        return new Response();
    }

    /**
     * Admin Ajax action management of all blocks and widgets of a page
     * 
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-05-04
     */    
    public function urlmanagementAction()
    {
        $request = $this->container->get('request');
    
        if ($request->isXmlHttpRequest()){
            $urls        = null;
            
            if ($request->query->has('id'))            $id         = $request->query->get('id');        else    $id            = null;
            if ($request->query->has('type'))        $type        = $request->query->get('type');     else    $type        = null;
            if ($request->query->has('routename'))    $routename    = $request->query->get('routename');else    $routename  = "";            
            if ($request->query->has('action'))        $action     = $request->query->get('action');    else    $action        = "no";
            
            // we get the page manager
            $pageManager      = $this->get('pi_app_admin.manager.page');
            
            switch ($type){
                case 'routename':
                    // we return the url result of the routename
                    $urls[$action]    = $this->get('bootstrap.RouteTranslator.factory')->getRoute($routename);
                    break;                
                case 'page':
                    // we get the object Translation Page by route
                    $page        = $pageManager->setPageByRoute($routename);
                    if ($page instanceof Page) 
                        $urls    = $pageManager->getUrlByType('page', $page);
                    else
                        $urls    = $pageManager->getUrlByType('page');
                    // we get all the urls in order to the management of widgets.
                    $urls    = $pageManager->getUrlByType('page', $page);
                    break;                
                case 'block':
                    // we get the object block by id
                    $block    = $pageManager->getBlockById($id);                    
                    // we get all the urls in order to the management of a block.
                    $urls    = $pageManager->getUrlByType('block', $block);                    
                    break;
                case 'widget':
                    // we get the object widget by id
                    $widget    = $pageManager->getWidgetById($id);                    
                    // we get all the urls in order to the management of a widget.
                    $urls    = $pageManager->getUrlByType('widget', $widget);                    
                    break;
            }
            
            // we return the desired url
               $values[0]['url'] = $urls[$action];
               
               $response = new Response(json_encode($values));
               $response->headers->set('Content-Type', 'application/json');
               return $response;               
        } else {
            throw ControllerException::callAjaxOnlySupported('urlmanagement');
        }
    }
    
    /**
     * Import action of all widgets
     * 
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-06-22
     */
    public function importmanagementAction()
    {
        $em         = $this->getDoctrine()->getEntityManager();
        $locale        = $this->container->get('request')->getLocale();
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)     $template = "importmanagement.html.twig"; else $template = "importmanagement_ajax.html.twig";          
        
        return $this->render("PiAppAdminBundle:Frontend:$template", array(
                'NoLayout'    => $NoLayout,
        ));        
    }   

    /**
     * Main default page
     *
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-01-24
     */    
    public function indexAction()
    {
        $em            = $this->getDoctrine()->getEntityManager();
        
//         $message = \Swift_Message::newInstance()
//         ->setSubject('Hello Email')
//         ->setFrom('send@example.com')
//         ->setTo('etienne_delongeaux@hotmail.com')
//         ->setBody('codicydblciudycdcpi')
//         ;
        
//         //print_r(get_class($this->get('mailer')));exit;        
//         $this->get('mailer')->send($message);

        return $this->render('PiAppAdminBundle:Frontend:index.html.twig', array(
        ));
    }  
    
    /**
     * 
     * @Secure(roles="ROLE_USER")
     * @return json
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-02-22
     */
    public function chainedAction()
    {
        $values[""] = "--";
        //if ($_GET["plugin-remote"]) {
        //    if ("content" == $_GET["plugin-remote"]) {
        $values[""]             = "--";
        $values["text"]         = "text";
        $values["snippet"]         = "snippet";
        //    };
        //}
    
        $response = new Response(json_encode($values));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    /**
     *
     * @author Riad HELLAL <r.hellal@novediagroup.com>
     * @return type
     */
    public function contactAction()
    {
        $enquiry = new Enquiry();
        $form = $this->createForm(new EnquiryType(), $enquiry);
    
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
    
            if ($form->isValid()) {
                // action sending an email
                $message = \Swift_Message::newInstance()
                ->setSubject('Contact enquiry from orchestra')
                ->setFrom('enquiries@orchestra.dev')
                ->setTo('email@email.com')
                ->setBody($this->renderView('PiAppAdminBundle:Frontend:contactEmail.txt.twig', array('enquiry' => $enquiry)));
                
                if ($this->get('mailer')->send($message))
                {
                    // Redirect - This is important to prevent users re-posting
                    // the form if they refresh the page
                    $this->get('request')->getSession()->getFlashBag()->add('success', 'Your contact enquiry was successfully sent. Thank you!');
                }
                else {
                    $this->get('request')->getSession()->getFlashBag()->add('notice', 'Your contact enquiry was NOT sent. Thank you!');
                }
                return $this->redirect($this->generateUrl('public_contact'));
            }
        }
    
        return $this->render('PiAppAdminBundle:Frontend:contact.html.twig', array(
                'form' => $form->createView()
        ));
    
    }    
        
}
