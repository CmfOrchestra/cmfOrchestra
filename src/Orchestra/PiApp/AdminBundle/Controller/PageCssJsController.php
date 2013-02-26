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

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BootStrap\TranslationBundle\Controller\abstractController;
use PiApp\AdminBundle\Exception\ControllerException;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use JMS\SecurityExtraBundle\Annotation\Secure;

use PiApp\AdminBundle\Entity\Page;
use PiApp\AdminBundle\Repository\PageRepository;
use PiApp\AdminBundle\Form\PageCssJsType as PageType;

/**
 * PageByTrans controller.
 * 
 * @category   Admin_Controllers
 * @package    Controller
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PageCssJsController extends abstractController
{
	protected $_entityName = "PiAppAdminBundle:Page";
	
    /**
     * Lists all Page entities.
     * 
     * @Secure(roles="IS_AUTHENTICATED_ANONYMOUSLY")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('PiAppAdminBundle:Page')->getAllPageCssJs()->getQuery()->getResult();

        return $this->render('PiAppAdminBundle:PageCssJs:index.html.twig', array(
            'entities' => $entities
        ));
    }
    
    /**
     * Enabled Page entities.
     *
     * @Route("/admin/pagecssjs/enabled", name="admin_pagecssjs_enabledentity_ajax")
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
     * Disable Page  entities.
     *
     * @Route("/admin/pagecssjs/disable", name="admin_pagecssjs_disablentity_ajax")
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
     * Finds and displays a Page entity.
     * 
     * @Secure(roles="IS_AUTHENTICATED_ANONYMOUSLY")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function showAction($id)
    {
        $em 	= $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('PiAppAdminBundle:Page')->find($id);

        if (!$entity) {
            throw ControllerException::NotFoundException('Page');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PiAppAdminBundle:PageCssJs:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Page entity.
     * 
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function newAction()
    {
        $entity = new Page();
        $entity->setMetaContentType(PageRepository::TYPE_TEXT_CSS);
        $form   = $this->createForm(new PageType($this->container), $entity, array('show_legend' => false));

        return $this->render('PiAppAdminBundle:PageCssJs:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Page entity.
     * 
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function createAction()
    {
        $entity  = new Page();
        $request = $this->getRequest();
        $form    = $this->createForm(new PageType($this->container), $entity, array('show_legend' => false));
        $form->bindRequest($request);

        if ('POST' === $request->getMethod()) {
        
        	$form->bindRequest($request);  
        	      
	        if ($form->isValid()) {
	            $em = $this->getDoctrine()->getEntityManager();
	
	            // On persiste tous les translations d'une page.
	            foreach($entity->getTranslations() as $translationPage) {
	            	$entity->addTranslation($translationPage);
	            }
	            $em->persist($entity);
	            $em->flush();
	
	            return $this->redirect($this->generateUrl('admin_pagecssjs_show', array('id' => $entity->getId())));
	            
	        }
	
	        return $this->render('PiAppAdminBundle:PageCssJs:new.html.twig', array(
	            'entity' => $entity,
	            'form'   => $form->createView()
	        ));
        }
        
        return array('form' => $form->createView());
    }

    /**
     * Displays a form to edit an existing Page entity.
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

        $entity = $em->getRepository('PiAppAdminBundle:Page')->find($id);

        if (!$entity) {
            throw ControllerException::NotFoundException('Page');
        }

        $editForm = $this->createForm(new PageType($this->container), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);
        
        return $this->render('PiAppAdminBundle:PageCssJs:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Page entity.
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

        $entity = $em->getRepository('PiAppAdminBundle:Page')->find($id);
        
        if (!$entity) {
            throw ControllerException::NotFoundException('Page');
        }

        $editForm   = $this->createForm(new PageType($this->container), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            // On persiste tous les translations d'une page.
            foreach($entity->getTranslations() as $translationPage) {
            	$entity->addTranslation($translationPage);
            }
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_pagecssjs_edit', array('id' => $id)));
        }

        return $this->render('PiAppAdminBundle:PageCssJs:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Page entity.
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
            $entity = $em->getRepository('PiAppAdminBundle:Page')->find($id);

            if (!$entity) {
                throw ControllerException::NotFoundException('Page');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_pagecssjs'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
