<?php
/**
 * This file is part of the <PI_CRUD> project.
 *
 * @category   PI_CRUD_Controllers
 * @package    Controller
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since XXXX-XX-XX
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\GedmoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BootStrap\TranslationBundle\Controller\abstractController;
use PiApp\AdminBundle\Exception\ControllerException;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use JMS\SecurityExtraBundle\Annotation\Secure;

use PiApp\GedmoBundle\Entity\Individual;
use PiApp\GedmoBundle\Form\IndividualType;
use PiApp\GedmoBundle\Form\InscriptionType;
use PiApp\GedmoBundle\Entity\Translation\IndividualTranslation;
use Symfony\Component\Form\FormError;
use BootStrap\UserBundle\Entity\User;
/**
 * Adherant Controller.
 *
 *
 * @category   PI_CRUD_Controllers
 * @package    Controller
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class AdherantController extends abstractController
{
    /**
     * List all members entities.
     *
     * @Secure(roles="IS_AUTHENTICATED_ANONYMOUSLY")
     * @Route("/admin/gedmo/adherent/subscribers", name="admin_gedmo_list_adherent")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function membersAction()
    {
        $em         = $this->getDoctrine()->getManager();
    
        if (empty($lang))
            $lang    = $this->container->get('request')->getLocale();
        
        $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)     $template = "adherent.html.twig"; else $template = "adherent.html.twig";        
    
           $query_individuals        = $em->getRepository("PiAppGedmoBundle:Individual")->getAllByCategory("", null, "DESC");
           $query_individuals
                 ->andWhere("a.ArgumentActivity IS NOT NULL");
           $entities_individuals   = $em->getRepository("PiAppGedmoBundle:Individual")->findTranslationsByQuery($lang, $query_individuals->getQuery(), 'object', false);
           
          $query_companies        = $em->getRepository("PiAppGedmoBundle:Corporation")->getAllByCategory("", null, "DESC");
           $entities_companies     = $em->getRepository("PiAppGedmoBundle:Corporation")->findTranslationsByQuery($lang, $query_companies->getQuery(), 'object', false);
           
           $results     = array();
           $publish     = array();
           $entities    = array_merge($entities_individuals, $entities_companies);
           if (count($entities) >= 1){
               foreach($entities as $key => $result){
                   if ($result instanceof \PiApp\GedmoBundle\Entity\Individual)
                       $results[$key]['type']        = "Individual";
                   elseif ($result instanceof \PiApp\GedmoBundle\Entity\Corporation)
                       $results[$key]['type']        = "Corporation";
                   
                   $results[$key]['entity']         = $result;
                   $results[$key]['publishedat']    = $result->getCreatedAt();
                   $results[$key]['tri']             = $result->getCreatedAt()->getTimestamp();
               }
           }
            
           // we create the pagination
           if (count($results) >= 1){
               foreach($results as $key => $result){
                   $publish[$key]  = $result['tri'];
               }
               array_multisort($publish, SORT_DESC, $results);
           }           
             
        return $this->render("PiAppGedmoBundle:Adherant:$template", array(
                'entities'     => $results,
                'locale'       => $lang,
                'NoLayout'    => $NoLayout,
                'category'    => $category,
        ));
    }
    
    /**
     * enabled payment status Individual/corporation entities.
     *
     * @Route("/admin/gedmo/adherent/enabledpaymentstatus", name="admin_gedmo_adherent_enabledpaymentstatus_ajax")
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access  public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function enabledpaymentstatusajaxAction()
    {
        $request = $this->container->get('request');
        $em         = $this->getDoctrine()->getManager();
        
        if ($request->isXmlHttpRequest()){
            $data        = $request->get('data', null);
            $new_data    = null;            
                       
            foreach ($data as $key => $value) {
                $values     = explode('_', $value);
                $id            = $values[2];
                $type        = $values[1];
                $position    = $values[0];               

                $new_data[$key] = array('position'=>$position, 'id'=>$id, 'type'=>$type);
                $new_pos[$key]  = $position;
            }
            array_multisort($new_pos, SORT_ASC, $new_data);
            
            krsort($new_data);
            foreach ($new_data as $key => $value) {
                if ($value['type'] == "Corporation"){
                    $entity = $em->getRepository("PiAppGedmoBundle:Corporation")->find($value['id']);
                } else {
                    $entity = $em->getRepository("PiAppGedmoBundle:Individual")->find($value['id']);
                }
                $entity->setPaymentstatus(true);
                $entity->getUser()->setRoles(array('ROLE_MEMBER'));
                
                $em->persist($entity);
                $em->flush();
                
                //send mail
                $templateFile = "PiAppGedmoBundle:Adherant:email_confirmation_inscription_adherent.html.twig";
                $templateContent = $this->get('twig')->loadTemplate($templateFile);
                $subject = ($templateContent->hasBlock("subject")
                        ? $templateContent->renderBlock("subject", array(
                                'form'      => $entity
                        ))
                        : "Default subject here");
                $body = ($templateContent->hasBlock("body")
                        ? $templateContent->renderBlock("body", array(
                                'form'      => $entity
                        ))
                        : "Default body here");
                $query        = $em->getRepository("PiAppGedmoBundle:Contact")->getAllByFields(array('enabled'=>true), 1, '', 'ASC');
                $query->leftJoin('a.category', 'c')
                ->andWhere("c.id = :catID")
                ->setParameter('catID', 22);
                $entity_cat = current($em->getRepository("PiAppGedmoBundle:Contact")->findTranslationsByQuery($this->container->get('request')->getLocale(), $query->getQuery(), "object", false));
                if ($entity_cat instanceof \PiApp\GedmoBundle\Entity\Contact)
                    $this->get("pi_app_admin.mailer_manager")->send($entity_cat->getEmail(), $entity->getEmail(), $subject, $body, $entity_cat->getEmailCc(), $entity_cat->getEmailBcc());
                else
                    $this->get("pi_app_admin.mailer_manager")->send("confirmationadhesion@gmail.com", $user_email, $subject, $body);
            }
            $em->clear();

            // we disable all flash message
            $this->container->get('session')->clearFlashes();
            
            $tab= array();
            $tab['id'] = '-1';
            $tab['error'] = '';
            $tab['fieldErrors'] = '';
            $tab['data'] = '';
             
            $response = new Response(json_encode($tab));
            $response->headers->set('Content-Type', 'application/json');
            return $response;            
        }else
            throw ControllerException::callAjaxOnlySupported('enabledajax');
    }    
    
    /**
     * disable payment status Individual/corporation entities.
     *
     * @Route("/admin/gedmo/adherent/disablepaymentstatus", name="admin_gedmo_adherent_disablepaymentstatus_ajax")
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access  public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function disablepaymentstatusajaxAction()
    {
        $request = $this->container->get('request');
        $em         = $this->getDoctrine()->getManager();
         
        if ($request->isXmlHttpRequest()){
            $data        = $request->get('data', null);
            $new_data    = null;
                
            foreach ($data as $key => $value) {
                $values     = explode('_', $value);
                $id            = $values[2];
                $type        = $values[1];
                $position    = $values[0];
    
                $new_data[$key] = array('position'=>$position, 'id'=>$id, 'type'=>$type);
                $new_pos[$key]  = $position;
            }
            array_multisort($new_pos, SORT_ASC, $new_data);
    
            krsort($new_data);
            foreach ($new_data as $key => $value) {
                if ($value['type'] == "Corporation")
                    $entity = $em->getRepository("PiAppGedmoBundle:Corporation")->find($value['id']);
                else
                    $entity = $em->getRepository("PiAppGedmoBundle:Individual")->find($value['id']);
                
                $entity->setPaymentstatus(false);
                $entity->getUser()->setRoles(array('ROLE_SUBSCRIBER'));
                
                $em->persist($entity);
                $em->flush();
            }
            $em->clear();
    
            // we disable all flash message
            $this->container->get('session')->clearFlashes();
    
            $tab= array();
            $tab['id'] = '-1';
            $tab['error'] = '';
            $tab['fieldErrors'] = '';
            $tab['data'] = '';
             
            $response = new Response(json_encode($tab));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }else
            throw ControllerException::callAjaxOnlySupported('enabledajax');
    }    
        
    /**
     * Template : Finds and displays a list of Individual entity.
     * 
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com> 
     */
    public function _template_annuaireAction($MaxResults = null, $template = '_template_adherent_annuaire.html.twig', $order = 'DESC', $lang = "")
    {
        $em         = $this->getDoctrine()->getManager();

        if (empty($lang))
            $lang    = $this->container->get('request')->getLocale();
        
        if (isset($_GET['type']) && !empty($_GET['type']))
            $type    =    $_GET['type'];
        else
            $type = "person";
        
        if (isset($_GET['lettre']) && !empty($_GET['lettre']))
            $lettre    =    $_GET['lettre'];
        else
            $lettre = "A";
        
        if (isset($_GET['filtre1']) && !empty($_GET['filtre1']))
            $filtre1 =    $_GET['filtre1'];
        else
            $filtre1 = "";
        
        if (isset($_GET['filtre2']) && !empty($_GET['filtre2']))
            $filtre2 =    $_GET['filtre2'];
        else
            $filtre2 = "";                 
        
        if ($type == "person"){
            $query        = $em->getRepository("PiAppGedmoBundle:Individual")->getAllByCategory("", $MaxResults, $order);
            $query->leftJoin('a.user', 'u')
                  ->andWhere($query->expr()->like('LOWER(a.Name)', $query->expr()->literal(strtolower($lettre).'%')))                  
                  ->andWhere($query->expr()->like('u.roles', $query->expr()->literal('%"ROLE_MEMBER"%')));
            if (!empty($filtre1))
                $query->andWhere($query->expr()->like('LOWER(a.Activity)', $query->expr()->literal(strtolower($filtre1).'%')));
            if (!empty($filtre2))
                $query->andWhere($query->expr()->like('LOWER(a.Engineering)', $query->expr()->literal(strtolower($filtre2).'%')));            
            $entities   = $em->getRepository("PiAppGedmoBundle:Individual")->findTranslationsByQuery($lang, $query->getQuery(), 'object', false);
            
            $Activities = $em->getRepository("PiAppGedmoBundle:Individual")->getArrayAllByField("Activity");
            if (!isset($Activities) || !count($Activities))
                $Activities = array();
            $Engineering = $em->getRepository("PiAppGedmoBundle:Individual")->getArrayAllByField("Engineering");
            if (!isset($Engineering) || !count($Engineering))
                $Engineering = array();    
        }elseif ($type == "company"){
              $query        = $em->getRepository("PiAppGedmoBundle:Corporation")->getAllByCategory("", $MaxResults, $order);
              $query
                  ->leftJoin('a.user', 'u')
                  ->andWhere($query->expr()->like('LOWER(a.CommercialName)', $query->expr()->literal(strtolower($lettre).'%')))
                  ->andWhere($query->expr()->like('u.roles', $query->expr()->literal('%"ROLE_MEMBER"%')));
              if (!empty($filtre1))
                  $query->andWhere($query->expr()->like('LOWER(a.Activity)', $query->expr()->literal(strtolower($filtre1).'%')));
              if (!empty($filtre2))
                  $query->andWhere($query->expr()->like('LOWER(a.Engineering)', $query->expr()->literal(strtolower($filtre2).'%')));
             $entities   = $em->getRepository("PiAppGedmoBundle:Corporation")->findTranslationsByQuery($lang, $query->getQuery(), 'object', false);
             
             $Activities = $em->getRepository("PiAppGedmoBundle:Corporation")->getArrayAllByField("Activity");
             if (!isset($Activities) || !count($Activities))
                 $Activities = array();
             $Engineering = $em->getRepository("PiAppGedmoBundle:Corporation")->getArrayAllByField("Engineering");
             if (!isset($Engineering) || !count($Engineering))
                 $Engineering = array();             
        }     

        $query2            = $em->getRepository("BootStrapUserBundle:User")->getAllByParams("", 4, 'DESC');
        $query2->where($query->expr()->like('a.roles', $query2->expr()->literal('%"ROLE_MEMBER"%')));
        $entities_last  = $em->getRepository("BootStrapUserBundle:User")->findTranslationsByQuery($lang, $query2->getQuery(), 'object', false);
        
        return $this->render("PiAppGedmoBundle:Adherant:$template", array(
            'entities'     => $entities,
            'locale'       => $lang,
            'type'       => $type,
            'lettre'       => $lettre,
            'filtre1'   => $filtre1,
            'filtre2'   => $filtre2,
            'Activities'   => $Activities,
            'Engineering'  => $Engineering,
            'entities_last'    => $entities_last                
        ));
    }

    /**
     * Change the posistion of a entity .
     *
     * @Route("/adherant/detail/{lang}", name="admin_gedmo_adherent_detail_ajax")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access  public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function detailadherantajaxAction()
    {
        $request = $this->container->get('request');
        $em         = $this->getDoctrine()->getManager();
    
        if ($request->isXmlHttpRequest()){
            $id_individual    = $request->get('id_individual', '');
            $id_corporation    = $request->get('id_corporation', '');
            $lang            = $request->get('lang', null);
    
            if (!empty($id_individual)){
                $entity = $em->getRepository("PiAppGedmoBundle:Individual")->find($id_individual);
            }elseif (!empty($id_corporation)){
                $entity = $em->getRepository("PiAppGedmoBundle:Corporation")->find($id_corporation);
            }
            
            // we disable all flash message
            $this->container->get('session')->clearFlashes();
            
            return $this->render("PiAppGedmoBundle:Adherant:_template_adherant_detail.html.twig", array(
                    'entity' => $entity,
                    'locale' => $lang,
            ));            
        }else
            throw ControllerException::callAjaxOnlySupported('detailtypoeventajax');
    }    
}