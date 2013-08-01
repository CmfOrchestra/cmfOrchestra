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

use PiApp\GedmoBundle\Entity\Simulateur;
use PiApp\GedmoBundle\Form\SimulateurType;
use PiApp\GedmoBundle\Entity\Translation\SimulateurTranslation;

/**
 * Simulateur controller.
 *
 *
 * @category   PI_CRUD_Controllers
 * @package    Controller
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class SimulateurController extends abstractController
{
    protected $_entityName = "PiAppGedmoBundle:Simulateur";

    /**
     * Enabled Simulateur entities.
     *
     * @Route("/admin/gedmo/simulateur/enabled", name="admin_gedmo_simulateur_enabledentity_ajax")
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     *     
     * @access  public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function enabledajaxAction()
    {
        return parent::enabledajaxAction();
    }

    /**
     * Disable Simulateur entities.
     * 
     * @Route("/admin/gedmo/simulateur/disable", name="admin_gedmo_simulateur_disablentity_ajax")
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     *     
     * @access  public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function disableajaxAction()
    {
        return parent::disableajaxAction();
    } 

    /**
     * Change the position of a Simulateur entity.
     *
     * @Route("/admin/gedmo/simulateur/position", name="admin_gedmo_simulateur_position_ajax")
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     *     
     * @access  public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function positionajaxAction()
    {
        return parent::positionajaxAction();
    }   

    /**
     * Delete a Simulateur entity.
     *
     * @Route("/admin/gedmo/simulateur/delete", name="admin_gedmo_simulateur_deletentity_ajax")
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     *     
     * @access  public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function deleteajaxAction()
    {
        return parent::deletajaxAction();
    }   

    /**
     * archive Simulateur entities.
     *
     * @Route("/admin/gedmo/simulateur/archive", name="admin_gedmo_simulateur_archiventity_ajax")
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     *     
     * @access  public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function archiveajaxAction()
    {
        return parent::archiveajaxAction();
    }
    /**
     * Lists all Simulateur entities.
     *
     * @Secure(roles="IS_AUTHENTICATED_ANONYMOUSLY")
	 * @return \Symfony\Component\HttpFoundation\Response
     *
	 * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>   
     */
    public function indexAction()
    {
        $request    = $this->container->get('request');
    	$em        = $this->getDoctrine()->getManager();
    	$locale    = $this->container->get('request')->getLocale();
        
        $category    = $this->container->get('request')->query->get('category');
        $NoLayout    = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout) 	$template = "index.html.twig"; else $template = "index.html.twig";
        
        if ($NoLayout){
    		$query    = $em->getRepository("PiAppGedmoBundle:Simulateur")->setContainer($this->container)->getAllByCategory($category, null, '', 'DESC', false);
    	} else {
    		$query    = $em->getRepository("PiAppGedmoBundle:Simulateur")->getAllByCategory($category, null, '', 'ASC', false);
    	}
    	
        $is_Server_side = true;
        
        if ($request->isXmlHttpRequest() && $is_Server_side) {
           $aColumns    = array('a.position','a.id','a.status','m.name','a.published_at','a.enabled');
           $q1 = clone $query;
           $q2 = clone $query;
           $result    = $this->createAjaxQuery('select',$aColumns, $q1, 'a');
           $total    = $this->createAjaxQuery('count',$aColumns, $q2, 'a');
        
           $output = array(
               "sEcho" => intval($request->get('sEcho')),
                "iTotalRecords" => $total,
                "iTotalDisplayRecords" => $total,
                "aaData" => array()
           );
        
           foreach ($result as $e) {
              $row = array();
              $row[] = $e->getPosition();
              $row[] = $e->getId();
              
              if (is_object($e->getCategory())) {
                  $row[] = $e->getCategory()->getName();
              } else {
                  $row[] = "";
              }
              
              if (is_object($e->getImage())) {
                  $row[] = $e->getImage()->getName();
              } else {
                  $row[] = "";
              }
        
              if (is_object($e->getImage())) {
                  $UrlPicture = $this->container->get('pi_app_admin.twig.extension.route')->getMediaUrlFunction($e->getImage(), 'reference', true, $e->getUpdatedAt(), 'gedmo_Simulateur');
                  $row[] = '<a href="#" title=\'<img width="450px" src="'.$UrlPicture.'">\' class="info-tooltip"><img width="20px" src="'.$UrlPicture.'"></a>';
                  
                  if (is_object($e->getUpdatedAt())) {
                      $row[] = $e->getUpdatedAt()->format('d-m-Y');
                  } else {
                      $row[] = "";
                  }
              }
              
              // create enabled/disabled buttons
              $Urlenabled     = $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/images/grid/button-green.png");
              $Urldisabled     = $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/images/grid/button-red.png");
              if ($e->getEnabled()) {
                  $row[] = '<img width="17px" src="'.$Urlenabled.'">';
              } else {
                  $row[] = '<img width="17px" src="'.$Urldisabled.'">';
              }
              // create action links
              $route_path_show = $this->container->get('pi_app_admin.twig.extension.route')->getUrlByRouteFunction('admin_gedmo_media_show', array('id'=>$e->getId(), 'NoLayout'=>$NoLayout, 'category'=>$category));
              $route_path_edit = $this->container->get('pi_app_admin.twig.extension.route')->getUrlByRouteFunction('admin_gedmo_media_edit', array('id'=>$e->getId(), 'NoLayout'=>$NoLayout, 'category'=>$category, 'status'=>$e->getStatus()));
              $actions = '<a href="'.$route_path_show.'" title="'.$this->container->get('translator')->trans('pi.grid.action.show').'" class="icon-3 info-tooltip" >&nbsp;</a>'; //actions
              $actions = '<a href="'.$route_path_edit.'" title="'.$this->container->get('translator')->trans('pi.grid.action.edit').'" class="icon-1 info-tooltip" >&nbsp;</a>'; //actions
              $row[] = $actions;
              
              $output['aaData'][] = $row ;
            }
            $response = new Response(json_encode( $output ));
            $response->headers->set('Content-Type', 'application/json');
            
            return $response;
        }
        
        if (!$is_Server_side) {
           $entities    = $em->getRepository("PiAppGedmoBundle:Simulateur")->findTranslationsByQuery($locale, $query->getQuery(), 'object', false);
        } else {
           $entities   = null;
        }    	

        return $this->render("PiAppGedmoBundle:Simulateur:$template", array(
            'isServerSide' => $is_Server_side,
            'entities'	=> $entities,
            'NoLayout'	=> $NoLayout,
            'category'	=> $category,
        ));
    }

    /**
     * Finds and displays a Simulateur entity.
     *
     * @Secure(roles="IS_AUTHENTICATED_ANONYMOUSLY")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>    
     */
    public function showAction($id)
    {
        $em         = $this->getDoctrine()->getManager();
        $locale        = $this->container->get('request')->getLocale();
        $entity     = $em->getRepository("PiAppGedmoBundle:Simulateur")->findOneByEntity($locale, $id, 'object');
        
        $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)     $template = "show.html.twig"; else $template = "show.html.twig";        

        if (!$entity) {
            throw ControllerException::NotFoundException('Simulateur');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render("PiAppGedmoBundle:Simulateur:$template", array(
            'entity'      => $entity,
            'NoLayout'      => $NoLayout,
            'category'      => $category,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to create a new Simulateur entity.
     *
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>    
     */
    public function newAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $entity     = new Simulateur();
        $form       = $this->createForm(new SimulateurType($em, $this->container), $entity, array('show_legend' => false));
        
        $category   = $this->container->get('request')->query->get('category', '');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)    $template = "new.html.twig";  else     $template = "new.html.twig";   
        
        $entity_cat = $em->getRepository("PiAppGedmoBundle:Category")->find($category);
        if (($entity_cat instanceof \PiApp\GedmoBundle\Entity\Category) && method_exists($entity, 'setCategory'))
            $entity->setCategory($entity_cat);     
        elseif (!empty($category) && method_exists($entity, 'setCategory'))
            $entity->setCategory($category);
            
        return $this->render("PiAppGedmoBundle:Simulateur:$template", array(
            'entity'     => $entity,
            'form'       => $form->createView(),
            'NoLayout'  => $NoLayout,
            'category'    => $category,
        ));
    }

    /**
     * Creates a new Simulateur entity.
     *
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>     
     */
    public function createAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $locale        = $this->container->get('request')->getLocale();
        
        $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)    $template = "new.html.twig";  else     $template = "new.html.twig";        
    
        $entity     = new Simulateur();
        $request     = $this->getRequest();
        $form        = $this->createForm(new SimulateurType($em, $this->container), $entity, array('show_legend' => false));
        $form->bind($request);

        if ($form->isValid()) {
            $entity->setTranslatableLocale($locale);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_gedmo_simulator_show', array('id' => $entity->getId(), 'NoLayout' => $NoLayout, 'category' => $category)));
                        
        }

        return $this->render("PiAppGedmoBundle:Simulateur:$template", array(
            'entity'     => $entity,
            'form'       => $form->createView(),
            'NoLayout'  => $NoLayout,
            'category'    => $category,
        ));
    }

    /**
     * Displays a form to edit an existing Simulateur entity.
     *
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>    
     */
    public function editAction($id)
    {
        $em         = $this->getDoctrine()->getManager();
        $locale        = $this->container->get('request')->getLocale();
        
        if (!empty($id)){
            $entity    = $em->getRepository("PiAppGedmoBundle:Simulateur")->findOneByEntity($locale, $id, 'object');
        } else {
            $slug    = $this->container->get('bootstrap.RouteTranslator.factory')->getMatchParamOfRoute('slug', $locale, true);
            $entity    = $this->container->get('doctrine')->getManager()->getRepository("PiAppGedmoBundle:Simulateur")->getEntityByField($locale, array('content_search' => array('slug' =>$slug)), 'object');
        }        
        
        $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)    $template = "edit.html.twig";  else    $template = "edit.html.twig";        

        if (!$entity) {
            $entity = $em->getRepository("PiAppGedmoBundle:Simulateur")->find($id);
            $entity->addTranslation(new SimulateurTranslation($locale));            
        }

        $editForm   = $this->createForm(new SimulateurType($em, $this->container), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);

        return $this->render("PiAppGedmoBundle:Simulateur:$template", array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'NoLayout'       => $NoLayout,
            'category'      => $category,
        ));
    }

    /**
     * Edits an existing Simulateur entity.
     *
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>   
     */
    public function updateAction($id)
    {
        $em         = $this->getDoctrine()->getManager();
        $locale        = $this->container->get('request')->getLocale();
        $entity     = $em->getRepository("PiAppGedmoBundle:Simulateur")->findOneByEntity($locale, $id, "object"); 
        
        $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)    $template = "edit.html.twig";  else    $template = "edit.html.twig";        

        if (!$entity) {
            $entity = $em->getRepository("PiAppGedmoBundle:Simulateur")->find($id);
        }

        $editForm   = $this->createForm(new SimulateurType($em, $this->container), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);

        $editForm->bind($this->getRequest(), $entity);
        if ($editForm->isValid()) {
            $entity->setTranslatableLocale($locale);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_gedmo_simulator_edit', array('id' => $id, 'NoLayout' => $NoLayout, 'category' => $category)));
        }

        return $this->render("PiAppGedmoBundle:Simulateur:$template", array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'NoLayout'       => $NoLayout,
            'category'      => $category,
        ));
    }

    /**
     * Deletes a Simulateur entity.
     *
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *     
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>     
     */
    public function deleteAction($id)
    {
        $em          = $this->getDoctrine()->getManager();
        $locale         = $this->container->get('request')->getLocale();
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');        
        $category   = $this->container->get('request')->query->get('category');
    
        $form          = $this->createDeleteForm($id);
        $request     = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $entity = $em->getRepository("PiAppGedmoBundle:Simulateur")->findOneByEntity($locale, $id, 'object');

            if (!$entity) {
                throw ControllerException::NotFoundException('Simulateur');
            }

            try {
                $em->remove($entity);
                $em->flush();
            } catch (\Exception $e) {
                $this->container->get('request')->getSession()->getFlashBag()->add('notice', 'pi.session.flash.wrong.undelete');
            }
        }

        return $this->redirect($this->generateUrl('admin_gedmo_simulator', array('NoLayout' => $NoLayout, 'category' => $category)));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    /**
     * Template : Finds and displays a Simulateur entity.
     * 
     * @Cache(maxage="86400")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com> 
     */
    public function _template_showAction($id, $template = '_tmp_show.html.twig', $lang = "")
    {
        $em     = $this->getDoctrine()->getManager();
        
        if (empty($lang))
            $lang    = $this->container->get('request')->getLocale();
            
        $entity = $em->getRepository("PiAppGedmoBundle:Simulateur")->findOneByEntity($lang, $id, 'object', false);
        
        if (!$entity) {
            throw ControllerException::NotFoundException('Simulateur');
        }
        
        if (method_exists($entity, "getTemplate") && $entity->getTemplate() != "")
            $template = $entity->getTemplate();         
    
        return $this->render("PiAppGedmoBundle:Simulateur:$template", array(
                'entity'    => $entity,
                'locale'    => $lang,
        ));
    }

    /**
     * Template : Finds and displays a list of Simulateur entity.
     * 
     * @Cache(maxage="86400")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com> 
     */
    public function _template_listAction($category = '', $MaxResults = null, $template = '_tmp_list.html.twig', $order = 'DESC', $lang = "")
    {
        $em         = $this->getDoctrine()->getManager();

        if (empty($lang))
            $lang    = $this->container->get('request')->getLocale();
            
        $query        = $em->getRepository("PiAppGedmoBundle:Simulateur")->getAllByCategory($category, $MaxResults, $order)->getQuery();
        $entities   = $em->getRepository("PiAppGedmoBundle:Simulateur")->findTranslationsByQuery($lang, $query, 'object', false);                   

        return $this->render("PiAppGedmoBundle:Simulateur:$template", array(
            'entities' => $entities,
            'cat'       => ucfirst($category),
            'locale'   => $lang,
        ));
    } 

    /**
     * Template : Finds and displays an archive of Simulateur entity.
     * 
     * @Cache(maxage="86400")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com> 
     */
    public function _template_archiveAction($MaxResults = null, $template = '_tmp_archive.html.twig', $order = 'DESC', $lang = "")
    {
        $em         = $this->getDoctrine()->getManager();
    
        if (empty($lang))
            $lang    = $this->container->get('request')->getLocale();
         
        if (isset($_GET['page']) && !empty($_GET['page']))
            $page     = $_GET['page'];
        else
            $page     = 1;
         
        $paginator             = $this->container->get('knp_paginator');
    
        $count                 = $em->getRepository("PiAppGedmoBundle:Simulateur")->count(1);
        $query_pagination    = $em->getRepository("PiAppGedmoBundle:Simulateur")->getAllByCategory('', null, $order)->getQuery();
        $query_pagination->setHint('knp_paginator.count', $count);
         
        $pagination = $paginator->paginate(
                $query_pagination,
                $page,    /*page number*/
                $MaxResults        /*limit per page*/
        );
         
        //print_r($pagination);exit;
         
        $query_pagination->setFirstResult(($page-1)*$MaxResults);
        $query_pagination->setMaxResults($MaxResults);
        $query_pagination    = $em->getRepository("PiAppGedmoBundle:Simulateur")->setTranslatableHints($query_pagination, $lang, false);
        $entities            = $em->getRepository("PiAppGedmoBundle:Simulateur")->findTranslationsByQuery($lang, $query_pagination, 'object', false);
         
        return $this->render("PiAppGedmoBundle:Simulateur:$template", array(
                'entities'        => $entities,
                'pagination'    => $pagination,
                'locale'        => $lang,
                'lang'            => $lang,
        ));        
    }        
    
}