<?php
/**
 * This file is part of the <Translator> project.
 *
 * @category   Translator_Controllers
 * @package    Controller
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-11-14
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
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

use Symfony\Component\Form\FormError;


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
     * @Route("/admin/users/enabled", name="users_enabledentity_ajax")
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
    
    /**
     * Archive a Media entity.
     *
     * @Route("/users/archive", name="users_archiventity_ajax")
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
    
    public function indexAction()
    {
        $request = $this->container->get('request');
        $em  = $this->getDoctrine()->getManager();
        $locale = $this->container->get('request')->getLocale();
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)     $template = "index.html.twig"; else $template = "index.html.twig";
        // we define the type Ajax or not
        $is_Server_side = true;
        if ( ($request->isXmlHttpRequest() && $is_Server_side) ||  !$is_Server_side) {
            $query	= $em->getRepository("BootStrapUserBundle:User")->createQueryBuilder('a')
            ->andWhere("a.roles NOT LIKE '%ROLE_SUBSCRIBER%'")
            ->andWhere("a.roles NOT LIKE '%ROLE_MEMBER%'")
            ->andWhere("a.roles NOT LIKE '%ROLE_PROVIDER%'")
            ->andWhere("a.roles NOT LIKE '%ROLE_CUSTOMER%'");
        }
        
        if ($request->isXmlHttpRequest() && $is_Server_side) {
           $aColumns    = array(
           		'a.id',
           		'a.nickname',
           		'a.name',
           		'a.email',
           		"case when a.roles LIKE '%ROLE_SUPER_ADMIN%' then 'ROLE_SUPER_ADMIN' when a.roles LIKE '%ROLE_ADMIN%' then 'ROLE_ADMIN' when a.roles LIKE '%ROLE_USER%' then 'ROLE_USER' when a.roles LIKE '%ROLE_EDITOR%' then 'ROLE_EDITOR' when a.roles LIKE '%ROLE_MODERATOR%' then 'ROLE_MODERATOR' when a.roles LIKE '%ROLE_DESIGNER%' then 'ROLE_DESIGNER' when a.roles LIKE '%ROLE_CONTENT_MANAGER%' then 'ROLE_CONTENT_MANAGER' else 'Autres' end",
           		'a.created_at',
           		'a.updated_at',
           		"case when a.enabled = 1 then 'Actif' when a.archive_at IS NOT NULL and a.archived = 1  then 'Supprime' else 'En attente dactivation' end",
           		"a.enabled"
           );
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
              $row[] = $e->getId() . '_row_' . $e->getId();
              $row[] = $e->getId();
              
              $row[] = (string) $e->getNickname();
              
              $row[] = (string) $e->getName();

              $row[] = (string) $e->getEmail();           
              
              if (is_array($e->getRoles())) {
                $best_roles = $this->container->get('bootstrap.Role.factory')->getBestRoles($e->getRoles());
                if (is_string($best_roles) && !in_array($best_roles, array('ROLE_SUPER_ADMIN', 'ROLE_ADMIN', 'ROLE_USER', 'ROLE_SUBSCRIBER', 'ROLE_MEMBER', 'ROLE_CUSTOMER', 'ROLE_PROVIDER'))) {
                    $best_roles = 'Autres';
                }
              	$row[] = (string) implode(",", $best_roles);
              } else {
              	$row[] = "";
              }             
              
              if (is_object($e->getCreatedAt())) {
                  $row[] = (string) $e->getCreatedAt()->format('Y-m-d');
              } else {
                  $row[] = "";
              }
              
              if (is_object($e->getUpdatedAt())) {
              	$row[] = (string) $e->getUpdatedAt()->format('Y-m-d');
              } else {
              	$row[] = "";
              }              
              
              $row[] = (string) $this->container->get('pi_app_admin.twig.extension.tool')->statusFilter($e);
              
              // create action links
              $route_path_edit = $this->container->get('pi_app_admin.twig.extension.route')->getUrlByRouteFunction('users_edit', array('id'=>$e->getId(), 'NoLayout'=>$NoLayout, 'category'=>''));
              $actions = '<a href="'.$route_path_edit.'" title="'.$this->container->get('translator')->trans('pi.grid.action.edit').'" class="button-ui-edit info-tooltip" >'.$this->container->get('translator')->trans('pi.grid.action.edit').'</a>'; //actions
              $row[] = (string) $actions;     
              
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
        $entity->setPermissions(array('VIEW', 'EDIT', 'CREATE', 'DELETE'));        
        $form   = $this->createForm(new UsersNewFormType(), $entity);

        return $this->render('PiAppTemplateBundle:Template\\Login\\Users:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entity  = new User();
        $form = $this->createForm(new UsersNewFormType(),$entity);
        $form->bind($request);
        
        $data = $request->get($form->getName(), array());
        $user  = $em->getRepository('BootStrapUserBundle:User')->findOneBy(array('email' => $data["email"]));
        if ($user) {
        	$form->get('email')->addError(new FormError($this->container->get('translator')->trans('erreur.email.unique')));
        }
        
        if ($form->isValid()) {
            $entity->setUsernameCanonical($data["username"]);
            $entity->setEmailCanonical($data["email"]);
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
        $editForm = $this->createForm(new UsersFormType(), $entity);

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
        $editForm = $this->createForm(new UsersFormType(), $entity);
        $editForm->bind($request);
        
        $old_email  = $entity->getEmail();
        $data = $request->get($editForm->getName(), array());
        $user  = $em->getRepository('BootStrapUserBundle:User')->findOneBy(array('email' => $data["email"]));
        if ($user) {
        	if($data["email"] != $old_email) {
        		$editForm->get('email')->addError(new FormError($this->container->get('translator')->trans('erreur.email.unique')));
        	}
        }    
        if(empty($data["plainPassword"]['first']) && empty($data["plainPassword"]['second'])) {
        	unset($data["plainPassword"]);
        }
        if ($editForm->isValid()) {
            $entity->setUsernameCanonical($data["username"]);
            $entity->setEmailCanonical($data["email"]);
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('users_edit', array('id'=>$id)));
        }

        return $this->render('PiAppTemplateBundle:Template\\Login\\Users:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
}
