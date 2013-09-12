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

use PiApp\GedmoBundle\Entity\Media;
use PiApp\GedmoBundle\Form\MediaType;
use PiApp\GedmoBundle\Entity\Translation\MediaTranslation;

/**
 * Media controller.
 *
 *
 * @category   PI_CRUD_Controllers
 * @package    Controller
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class MediaController extends abstractController
{
    protected $_entityName = "PiAppGedmoBundle:Media";

    /**
     * Enabled Media entities.
     *
     * @Route("/admin/gedmo/media/enabled", name="admin_gedmo_media_enabledentity_ajax")
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
     * Disable Media entities.
     * 
     * @Route("/admin/gedmo/media/disable", name="admin_gedmo_media_disablentity_ajax")
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
     * Position Media entities.
     *
     * @Route("/admin/gedmo/media/position", name="admin_gedmo_media_position_ajax")
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
     * Delete Media entities.
     *
     * @Route("/admin/gedmo/media/delete", name="admin_gedmo_media_deletentity_ajax")
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
     * Archive a Media entity.
     *
     * @Route("/admin/gedmo/media/archive", name="admin_gedmo_media_archiveentity_ajax")
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
     * Lists all Media entities.
     *
     * @Secure(roles="IS_AUTHENTICATED_ANONYMOUSLY")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function indexAction()
    {
        $request = $this->container->get('request');
        $em  = $this->getDoctrine()->getManager();
        $locale = $this->container->get('request')->getLocale();
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)     $template = "index.html.twig"; else $template = "index.html.twig";
        
        $category   = $this->container->get('request')->query->get('category');
        if (is_array($category) && isset($category['__isInitialized__'])) {
            $category = $category['__isInitialized__'];
        }

        $query                = $em->getRepository("PiAppGedmoBundle:Media")->getAllByCategory($category, null, '', '', false);
        $query
        ->leftJoin('a.image', 'm')
        ->andWhere('a.image IS NOT NULL')
        ->orderBy('a.updated_at', 'DESC');
        
        $is_Server_side = true;
        
        if ($request->isXmlHttpRequest() && $is_Server_side) {
           $aColumns    = array('a.position','a.id','a.status','m.name','a.updated_at','a.enabled');
           $q1 = clone $query;
           $q2 = clone $query;
           $result    = $this->createAjaxQuery('select',$aColumns, $q1, 'a', null, array(
                            0 =>array('column'=>'a.created_at', 'format'=>'Y-m-d', 'idMin'=>'minc', 'idMax'=>'maxc'),
                            1 =>array('column'=>'a.updated_at', 'format'=>'Y-m-d', 'idMin'=>'minu', 'idMax'=>'maxu')
                      )
           );
           $total    = $this->createAjaxQuery('count',$aColumns, $q2, 'a', null, array(
                            0 =>array('column'=>'a.created_at', 'format'=>'Y-m-d', 'idMin'=>'minc', 'idMax'=>'maxc'),
                            1 =>array('column'=>'a.updated_at', 'format'=>'Y-m-d', 'idMin'=>'minu', 'idMax'=>'maxu')
                      )
           );
        
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
              
              $row[] = $e->getStatus();
              
              if (is_object($e->getImage())) {
                  $row[] = $e->getImage()->getName();
                  $url = $this->container->get('pi_app_admin.twig.extension.route')->getMediaUrlFunction($e->getImage(), 'reference', true, $e->getUpdatedAt(), 'media_');
              } else {
                  $row[] = "";
                  $url = "#";
              }
              
              if ($e->getStatus() == 'image') {
              	$UrlPicture = $this->container->get('pi_app_admin.twig.extension.route')->getMediaUrlFunction($e->getImage(), 'reference', true, $e->getUpdatedAt(), 'gedmo_media_');
              	$row[] = '<a href="#" title=\'<img src="'.$UrlPicture.'" class="info-tooltip-image" >\' class="info-tooltip"><img width="20px" src="'.$UrlPicture.'"></a>';
              } else {
              	$row[] = "";
              }
              
              if (is_object($e->getCreatedAt())) {
              	$row[] = $e->getCreatedAt()->format('Y-m-d');
              } else {
              	$row[] = "";
              }
              
              if (is_object($e->getUpdatedAt())) {
                  $row[] = $e->getUpdatedAt()->format('Y-m-d');
              } else {
                  $row[] = "";
              }
              // create enabled/disabled buttons
              $Urlenabled     = $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/css/themes/img/enabled.png");
              $Urldisabled     = $this->container->get('templating.helper.assets')->getUrl("bundles/piappadmin/css/themes/img/disabled.png");
              if ($e->getEnabled()) {
                  $row[] = '<img width="17px" src="'.$Urlenabled.'">';
              } else {
                  $row[] = '<img width="17px" src="'.$Urldisabled.'">';
              }
              // create action links
              $route_path_show = $this->container->get('pi_app_admin.twig.extension.route')->getUrlByRouteFunction('admin_gedmo_media_show', array('id'=>$e->getId(), 'NoLayout'=>$NoLayout, 'category'=>$category, 'status'=>$e->getStatus()));
              $route_path_edit = $this->container->get('pi_app_admin.twig.extension.route')->getUrlByRouteFunction('admin_gedmo_media_edit', array('id'=>$e->getId(), 'NoLayout'=>$NoLayout, 'category'=>$category, 'status'=>$e->getStatus()));
              if (is_object($e->getImage()) && ($e->getStatus() == 'image')) {
                  $actions = '<a href="'.$route_path_show.'" title="'.$this->container->get('translator')->trans('pi.grid.action.show').'" class="button-ui-show info-tooltip" >'.$this->container->get('translator')->trans('pi.grid.action.show').'</a>'; //actions
              } else {
                  $actions = '<a href="'.$url.'" target="_blank" title="'.$this->container->get('translator')->trans('pi.grid.action.show').'" class="button-ui-show info-tooltip" >'.$this->container->get('translator')->trans('pi.grid.action.show').'</a>'; //actions
              }              
              $actions .= '<a href="'.$route_path_edit.'" title="'.$this->container->get('translator')->trans('pi.grid.action.edit').'" class="button-ui-edit info-tooltip" >'.$this->container->get('translator')->trans('pi.grid.action.edit').'</a>'; //actions
              $row[] = $actions;
              
              $output['aaData'][] = $row ;
            }
            $response = new Response(json_encode( $output ));
            $response->headers->set('Content-Type', 'application/json');
            
            return $response;
        }
        
        if (!$is_Server_side) {
           $entities   = $em->getRepository("PiAppGedmoBundle:Media")->findTranslationsByQuery($locale, $query->getQuery(), 'object', false);
        } else {
           $entities   = null;
        }
        
        //print_r(count($entities));exit;
        
        return $this->render("PiAppGedmoBundle:Media:$template", array(
        'isServerSide' => $is_Server_side,
        'entities' => $entities,
        'NoLayout'    => $NoLayout,
        'category' => $category,
        ));
    }
    
    /**
     * Finds and displays a Media entity.
     *
     * @Secure(roles="IS_AUTHENTICATED_ANONYMOUSLY")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>    
     */
    public function showAction($id)
    {
        $em     = $this->getDoctrine()->getManager();
        $locale    = $this->container->get('request')->getLocale();
        $entity = $em->getRepository("PiAppGedmoBundle:Media")->findOneByEntity($locale, $id, 'object');
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)     $template = "show.html.twig"; else $template = "show.html.twig";

        $category   = $this->container->get('request')->query->get('category');
        if (is_array($category) && isset($category['__isInitialized__']))
            $category = $category['__isInitialized__'];

        if (!$entity) {
            throw ControllerException::NotFoundException('Media');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render("PiAppGedmoBundle:Media:$template", array(
            'entity'      => $entity,
            'NoLayout'      => $NoLayout,
            'category'      => $category,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    /**
     * Displays a form to create a new Media entity.
     *
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function newAction()
    {
        $em     = $this->getDoctrine()->getManager();
        $locale    = $this->container->get('request')->getLocale();
        $status = $this->container->get('request')->query->get('status');
        $entity = new Media();
        $entity->setStatus($status);
        $form   = $this->createForm(new MediaType($this->container, $em, $status), $entity, array('show_legend' => false));
    
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)    $template = "new.html.twig";  else     $template = "new.html.twig";
        
        $category   = $this->container->get('request')->query->get('category');
        if (is_array($category) && isset($category['__isInitialized__']))
            $category = $category['__isInitialized__'];
    
        return $this->render("PiAppGedmoBundle:Media:$template", array(
                'entity' => $entity,
                'form'   => $form->createView(),
                'NoLayout'  => $NoLayout,
                'category'      => $category,
                'status'    => $status,
        ));
    }
    
    /**
     * Creates a new Media entity.
     *
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function createAction()
    {
        $em     = $this->getDoctrine()->getManager();
        $locale    = $this->container->get('request')->getLocale();
        $status = $this->container->get('request')->query->get('status');
    
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)    $template = "new.html.twig";  else     $template = "new.html.twig";
        
        $category   = $this->container->get('request')->query->get('category');
        if (is_array($category) && isset($category['__isInitialized__']))
            $category = $category['__isInitialized__'];
    
        $entity  = new Media();
        $entity->setStatus($status);
        $request = $this->getRequest();
        $form    = $this->createForm(new MediaType($this->container, $em, $status), $entity, array('show_legend' => false));
        $form->bind($request);
    
        if ($form->isValid()) {
            $entity->setTranslatableLocale($locale);
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('admin_gedmo_media_show', array('id' => $entity->getId(), 'NoLayout' => $NoLayout, 'category' => $category)));
        }
    
        return $this->render("PiAppGedmoBundle:Media:$template", array(
                'entity'     => $entity,
                'form'       => $form->createView(),
                'NoLayout'  => $NoLayout,
                'category'      => $category,
                'status'    => $status,
        ));
    }    

    /**
     * Displays a form to edit an existing Media entity.
     *
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>    
     */
    public function editAction($id)
    {
        $em     = $this->getDoctrine()->getManager();
        $locale    = $this->container->get('request')->getLocale();
        $entity = $em->getRepository("PiAppGedmoBundle:Media")->findOneByEntity($locale, $id, 'object');
        
        $status        = $this->container->get('request')->query->get('status');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)    $template = "edit.html.twig";  else    $template = "edit.html.twig";

        $category   = $this->container->get('request')->query->get('category');
        if (is_array($category) && isset($category['__isInitialized__']))
            $category = $category['__isInitialized__'];

        if (!$entity) {
            $entity = $em->getRepository("PiAppGedmoBundle:Media")->find($id);
            $entity->addTranslation(new MediaTranslation($locale));            
        }

        $editForm   = $this->createForm(new MediaType($this->container, $em, $status), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);

        return $this->render("PiAppGedmoBundle:Media:$template", array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'NoLayout'       => $NoLayout,
            'category'      => $category,
            'status'      => $status,
        ));
    }

    /**
     * Edits an existing Media entity.
     *
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>   
     */
    public function updateAction($id)
    {
        $em     = $this->getDoctrine()->getManager();
        $locale    = $this->container->get('request')->getLocale();
        $entity = $em->getRepository("PiAppGedmoBundle:Media")->findOneByEntity($locale, $id, "object"); 
        
        $status        = $this->container->get('request')->query->get('status');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)    $template = "edit.html.twig";  else    $template = "edit.html.twig";

        $category   = $this->container->get('request')->query->get('category');
        if (is_array($category) && isset($category['__isInitialized__']))
            $category = $category['__isInitialized__'];

        if (!$entity) {
            $entity = $em->getRepository("PiAppGedmoBundle:Media")->find($id);
        }

        $editForm   = $this->createForm(new MediaType($this->container, $em, $status), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);

        $editForm->bind($this->getRequest(), $entity);
        if ($editForm->isValid()) {
            $entity->setTranslatableLocale($locale);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_gedmo_media_edit', array('id' => $id, 'NoLayout' => $NoLayout, 'category' => $category, 'status' => $status)));
        }

        return $this->render("PiAppGedmoBundle:Media:$template", array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'NoLayout'       => $NoLayout,
            'status'    => $status,
        ));
    }

    /**
     * Deletes a Media entity.
     *
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *     
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>     
     */
    public function deleteAction($id)
    {
        $em      = $this->getDoctrine()->getManager();
        $locale     = $this->container->get('request')->getLocale();
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');       
        $category   = $this->container->get('request')->query->get('category');
    
        $form      = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $entity = $em->getRepository("PiAppGedmoBundle:Media")->findOneByEntity($locale, $id, 'object');

            if (!$entity) {
                throw ControllerException::NotFoundException('Media');
            }

            try {
                $em->remove($entity);
                $em->flush();
            } catch (\Exception $e) {
                $this->container->get('request')->getSession()->getFlashBag()->add('notice', 'pi.session.flash.wrong.undelete');
            }
        }

        return $this->redirect($this->generateUrl('admin_gedmo_media', array('NoLayout' => $NoLayout, 'category' => $category)));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    /**
     * Template : Finds and displays a Media entity.
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
        
        $entity = $em->getRepository("PiAppGedmoBundle:Media")->findOneByEntity($lang, $id, 'object', false);
        
        if (!$entity) {
            throw ControllerException::NotFoundException('Media');
        }
    
        return $this->render("PiAppGedmoBundle:Media:$template", array(
                'entity'      => $entity,
                'locale'   => $lang,
                'lang'       => $lang,
        ));
    }

    /**
     * Template : Finds and displays a list of Media entity.
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
        
        $query        = $em->getRepository("PiAppGedmoBundle:Media")->getAllByCategory($category, $MaxResults, '', $order)->getQuery();
        $entities   = $em->getRepository("PiAppGedmoBundle:Media")->findTranslationsByQuery($lang, $query, 'object', false);                   

        return $this->render("PiAppGedmoBundle:Media:$template", array(
            'entities' => $entities,
            'cat'       => ucfirst($category),
            'locale'   => $lang,
            'lang'       => $lang,
        ));
    }     
    
}
