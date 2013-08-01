<?php

namespace BootStrap\UserBundle\Controller;


use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Model\UserInterface;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BootStrap\TranslationBundle\Controller\abstractController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\Response;

use BootStrap\UserBundle\Entity\User;
use BootStrap\UserBundle\Form\Type\UsersFormType;
use BootStrap\UserBundle\Form\Type\UsersNewFormType;


/**
 * Userscontroller.
 *
 */
class UsersController extends abstractController
{
    protected $_entityName = "BootStrapUserBundle:User";
    

    /**
     * Enabled Recette entities.
     *
     * @Route("/users/enabled", name="users_enabledentity_ajax")
     * @Secure(roles="ROLE_USER")
	 * @return \Symfony\Component\HttpFoundation\Response
     *     
     * @access  public
     */
    public function enabledajaxAction()
    {
    	return parent::enabledajaxAction();
    }

    /**
     * Disable Recette entities.
     * 
     * @Route("/users/disable", name="users_disablentity_ajax")
     * @Secure(roles="ROLE_USER")
	 * @return \Symfony\Component\HttpFoundation\Response
     *     
     * @access  public

     */
    public function disableajaxAction()
    {
		return parent::disableajaxAction();
    } 

	/**
     * Change the position of a Recette entity.
     *
     * @Route("/users/position", name="users_position_ajax")
     * @Secure(roles="ROLE_USER")
	 * @return \Symfony\Component\HttpFoundation\Response
     *     
     * @access  public
     */
    public function positionajaxAction()
    {
    	return parent::positionajaxAction();
    }   

	/**
     * Delete a Recette entity.
     *
     * @Route("/users/delete", name="users_deletentity_ajax")
     * @Secure(roles="ROLE_USER")
	 * @return \Symfony\Component\HttpFoundation\Response
     *     
     * @access  public
     */
    public function deleteajaxAction()
    {
    	return parent::deletajaxAction();
    }  
    
    public function indexAction()
    {
        $request = $this->container->get('request');
        $em  = $this->getDoctrine()->getManager();
        $locale = $this->container->get('request')->getLocale();
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)     $template = "index.html.twig"; else $template = "index.html.twig";
        
        $query                = $em->getRepository("BootStrapUserBundle:User")->getAllByParams('', null, 'ASC', '', false);
        
        $is_Server_side = false;
        
        if ($request->isXmlHttpRequest() && $is_Server_side) {
        	$aColumns    = array('a.position','a.id','a.published_at','a.enabled');
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
        
        		$row[] = $e->getStatus();
        
        		if (is_object($e->getImage())) {
        			$row[] = $e->getImage()->getName();
        		} else {
        			$row[] = "";
        		}
        
        		$UrlPicture = $this->container->get('pi_app_admin.twig.extension.route')->getMediaUrlFunction($e->getImage(), 'reference', true, $e->getUpdatedAt(), 'gedmo_media_');
        		$row[] = '<a href="#" title=\'<img width="450px" src="'.$UrlPicture.'">\' class="info-tooltip"><img width="20px" src="'.$UrlPicture.'"></a>';
        
        		if (is_object($e->getUpdatedAt())) {
        			$row[] = $e->getUpdatedAt()->format('d-m-Y');
        		} else {
        			$row[] = "";
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
        		//$route_path_show = $this->container->get('pi_app_admin.twig.extension.route')->getUrlByRouteFunction('admin_gedmo_media_show', array('id'=>$e->getId(), 'NoLayout'=>$NoLayout, 'category'=>$category));
        		$route_path_edit = $this->container->get('pi_app_admin.twig.extension.route')->getUrlByRouteFunction('admin_gedmo_media_edit', array('id'=>$e->getId(), 'NoLayout'=>$NoLayout, 'category'=>$category, 'status'=>$e->getStatus()));
        		//$actions = '<a href="'.$route_path_show.'" title="'.$this->container->get('translator')->trans('pi.grid.action.show').'" class="icon-3 info-tooltip" >&nbsp;</a>'; //actions
        		$actions = '<a href="'.$route_path_edit.'" title="'.$this->container->get('translator')->trans('pi.grid.action.edit').'" class="icon-1 info-tooltip" >&nbsp;</a>'; //actions
        		$row[] = $actions;
        
        		$output['aaData'][] = $row ;
        	}
        	$response = new Response(json_encode( $output ));
        	$response->headers->set('Content-Type', 'application/json');
        
        	return $response;
        }
        
        if (!$is_Server_side) {
        	$entities   = $em->getRepository("BootStrapUserBundle:User")->findTranslationsByQuery($locale, $query->getQuery(), 'object', false);
        } else {
        	$entities   = null;
        }
        
        return $this->render("PiAppTemplateBundle:Template\\Login\\Users:index.html.twig", array(
        		'isServerSide' => $is_Server_side,
        		'entities' => $entities,
        		'NoLayout'    => $NoLayout,
        ));
    }
    
    public function newAction()
    {
        $entity = new User();
        $form   = $this->createForm(new UsersNewFormType(), $entity);

        return $this->render('PiAppTemplateBundle:Template\\Login\\Users:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    
    public function createAction(Request $request)
    {
        $entity  = new User();
        $form = $this->createForm(new UsersNewFormType(),$entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('users'));
        }

        return $this->render('PiAppTemplateBundle:Template\\Login\\Users:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BootStrapUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recette entity.');
        }


        return $this->render('PiAppTemplateBundle:Template\\Login\\Users:show.html.twig', array(
            'entity' => $entity,
        ));
    }
    
    public function editAction($id)
    {
        
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BootStrapUserBundle:User')->find($id);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recette entity.');
        }
        
        
        //$editForm = $this->container->get('fos_user.profile.form');
        $editForm = $this->createForm(new UsersFormType(), $entity);
        //$formHandler = $this->container->get('fos_user.profile.form.handler');

        return $this->container->get('templating')->renderResponse(
            'PiAppTemplateBundle:Template\\Login\\Users:edit.html.twig',
            array(
                'entity' => $entity,
                'edit_form' => $editForm->createView()
            ));
        
    }    
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BootStrapUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recette entity.');
        }

        //$deleteForm = $this->createDeleteForm($id);
       /* $user = $this->userManager->createUser();
        $this->form->setData($user);
        var_dump($user);die();*/
        
        $editForm = $this->createForm(new UsersFormType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            //return $this->redirect($this->generateUrl('recette_edit', array('id' => $id)));
            //$this->setFlash('pi.session.flash.right.update','success');
            return $this->redirect($this->generateUrl('users'));
        }

        return $this->render('ProjetProjetBundle:Recette:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
}
