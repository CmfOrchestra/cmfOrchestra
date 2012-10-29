<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Controllers
 * @package    Controller
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-01-03
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

use PiApp\AdminBundle\Entity\TranslationPage;
use PiApp\AdminBundle\Form\TranslationPageType;

/**
 * TranslationPage controller.
 * 
 * @category   Admin_Controllers
 * @package    Controller
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class TranslationPageController extends abstractController
{
	protected $_entityName = "PiAppAdminBundle:TranslationPage";
	
    /**
     * Lists all TranslationPage entities.
     * 
     * @Secure(roles="IS_AUTHENTICATED_ANONYMOUSLY")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function indexAction($page)
    {
        $em = $this->getDoctrine()->getEntityManager();

        if(is_null($page))
        	$entities = $em->getRepository('PiAppAdminBundle:TranslationPage')->findAll();
        else
        	$entities = $em->getRepository('PiAppAdminBundle:TranslationPage')->findBy(array('page'=>$page));        

        return $this->render('PiAppAdminBundle:TranslationPage:index.html.twig', array(
            'entities' => $entities
        ));
    }
    
    /**
     * Enabled TranslationPage entities.
     *
     * @Route("/admin/translationpage/enabled", name="admin_translationpage_enabledentity_ajax")
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access  public
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function enabledajaxAction()
    {
    	return parent::enabledajaxAction();
    }
    
    /**
     * Disable TranslationPage  entities.
     *
     * @Route("/admin/translationpage/disable", name="admin_translationpage_disablentity_ajax")
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access  public
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function disableajaxAction()
    {
    	return parent::disableajaxAction();
    }

    /**
     * Finds and displays a TranslationPage entity.
     * 
     * @Secure(roles="IS_AUTHENTICATED_ANONYMOUSLY")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PiAppAdminBundle:TranslationPage')->find($id);

        if (!$entity) {
            throw ControllerException::NotFoundException('TranslationPage');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PiAppAdminBundle:TranslationPage:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new TranslationPage entity.
     * 
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function newAction()
    {
        $entity = new TranslationPage();
        $form   = $this->createForm(new TranslationPageType(), $entity, array('show_legend' => false));

        return $this->render('PiAppAdminBundle:TranslationPage:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new TranslationPage entity.
     * 
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function createAction()
    {
        $entity  = new TranslationPage();
        $request = $this->getRequest();
        $form    = $this->createForm(new TranslationPageType(), $entity, array('show_legend' => false));
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_transpage_show', array('id' => $entity->getId())));
            
        }

        return $this->render('PiAppAdminBundle:TranslationPage:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing TranslationPage entity.
     * 
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PiAppAdminBundle:TranslationPage')->find($id);

        if (!$entity) {
            throw ControllerException::NotFoundException('TranslationPage');
        }

        $editForm = $this->createForm(new TranslationPageType(), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PiAppAdminBundle:TranslationPage:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing TranslationPage entity.
     * 
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PiAppAdminBundle:TranslationPage')->find($id);

        if (!$entity) {
            throw ControllerException::NotFoundException('TranslationPage');
        }

        $editForm   = $this->createForm(new TranslationPageType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_transpage_edit', array('id' => $id)));
        }

        return $this->render('PiAppAdminBundle:TranslationPage:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a TranslationPage entity.
     * 
     * @Secure(roles="ROLE_SUPER_ADMIN")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * 
     * @access	public
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('PiAppAdminBundle:TranslationPage')->find($id);

            if (!$entity) {
                throw ControllerException::NotFoundException('TranslationPage');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_transpage'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
