<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Controllers
 * @package    Controller
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-02-10
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BootStrap\TranslationBundle\Controller\abstractController;
use PiApp\AdminBundle\Exception\ControllerException;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use JMS\SecurityExtraBundle\Annotation\Secure;

use PiApp\AdminBundle\Entity\TranslationWidget;
use PiApp\AdminBundle\Form\TranslationWidgetType;

/**
 * Widget controller.
 * 
 * @category   Admin_Controllers
 * @package    Controller
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class TranslationWidgetController extends abstractController
{
	protected $_entityName = "PiAppAdminBundle:TranslationWidget";
	
    /**
     * Lists all TranslationWidget entities.
     * 
     * @Secure(roles="IS_AUTHENTICATED_ANONYMOUSLY")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function indexAction($widget)
    {
        $em = $this->getDoctrine()->getEntityManager();

        if(is_null($widget))
        	$entities = $em->getRepository('PiAppAdminBundle:TranslationWidget')->findAll();
        else
        	$entities = $em->getRepository('PiAppAdminBundle:TranslationWidget')->findBy(array('widget'=>$widget));        

        return $this->render('PiAppAdminBundle:TranslationWidget:index.html.twig', array(
            'entities' => $entities
        ));
    }
    
    /**
     * Enabled TranslationWidget entities.
     *
     * @Route("/admin/translationwidget/enabled", name="admin_translationwidget_enabledentity_ajax")
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
     * Disable TranslationWidget  entities.
     *
     * @Route("/admin/translationwidget/disable", name="admin_translationwidget_disablentity_ajax")
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
     * Finds and displays a TranslationWidget entity.
     * 
     * @Secure(roles="IS_AUTHENTICATED_ANONYMOUSLY")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PiAppAdminBundle:TranslationWidget')->find($id);

        if (!$entity) {
            throw ControllerException::NotFoundException('TranslationWidget');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PiAppAdminBundle:TranslationWidget:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new TranslationWidget entity.
     * 
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function newAction()
    {
        $entity = new TranslationWidget();
        $form   = $this->createForm(new TranslationWidgetType($this->container), $entity);

        return $this->render('PiAppAdminBundle:TranslationWidget:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new TranslationWidget entity.
     * 
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function createAction()
    {
        $entity  = new TranslationWidget();
        $request = $this->getRequest();
        $form    = $this->createForm(new TranslationWidgetType($this->container), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_transwidget_show', array('id' => $entity->getId())));
            
        }

        return $this->render('PiAppAdminBundle:TranslationWidget:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing TranslationWidget entity.
     * 
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PiAppAdminBundle:TranslationWidget')->find($id);

        if (!$entity) {
            throw ControllerException::NotFoundException('TranslationWidget');
        }

        $editForm = $this->createForm(new TranslationWidgetType($this->container), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PiAppAdminBundle:TranslationWidget:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing TranslationWidget entity.
     * 
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PiAppAdminBundle:TranslationWidget')->find($id);

        if (!$entity) {
            throw ControllerException::NotFoundException('TranslationWidget');
        }

        $editForm   = $this->createForm(new TranslationWidgetType($this->container), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_transwidget_edit', array('id' => $id)));
        }

        return $this->render('PiAppAdminBundle:TranslationWidget:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a TranslationWidget entity.
     * 
     * @Secure(roles="ROLE_SUPER_ADMIN")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * 
     * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('PiAppAdminBundle:TranslationWidget')->find($id);

            if (!$entity) {
                throw ControllerException::NotFoundException('TranslationWidget');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_transwidget'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
