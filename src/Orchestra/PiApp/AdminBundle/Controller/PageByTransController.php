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

use PiApp\AdminBundle\Entity\Page;
use PiApp\AdminBundle\Repository\PageRepository;
use PiApp\AdminBundle\Form\PageByTransType as PageType;

/**
 * PageByTrans controller.
 * 
 * @category   Admin_Controllers
 * @package    Controller
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class PageByTransController extends abstractController
{
	protected $_entityName = "PiAppAdminBundle:Page";
	
    /**
     * Lists all Page entities.
     * 
     * @Secure(roles="IS_AUTHENTICATED_ANONYMOUSLY")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function indexAction()
    {
        $em 	  = $this->getDoctrine()->getEntityManager();
        $entities = $em->getRepository('PiAppAdminBundle:Page')->getAllPageHtml()->getQuery()->getResult();
        
        return $this->render('PiAppAdminBundle:PageByTrans:index.html.twig', array(
            'entities' => $entities
        ));
    }
    
    /**
     * Enabled Page entities.
     *
     * @Route("/admin/pagebytrans/enabled", name="admin_pagebytrans_enabledentity_ajax")
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
     * Disable Page  entities.
     *
     * @Route("/admin/pagebytrans/disable", name="admin_pagebytrans_disablentity_ajax")
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
     * Lists all Page entities.
     *
     * @Secure(roles="IS_AUTHENTICATED_ANONYMOUSLY")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function wizardAction($status)
    {
    	$locale		= $this->container->get('session')->getLocale();
    	$em 		= $this->getDoctrine()->getEntityManager();
    	$token 		= $this->get('security.context')->getToken();
    	
   		$idUser		= $token->getUser()->getId();
   		$RolesUser 	= $token->getUser()->getRoles();

    	if(in_array('ROLE_ADMIN', $RolesUser) || in_array('ROLE_SUPER_ADMIN', $RolesUser) || in_array('ROLE_CONTENT_MANAGER', $RolesUser)){
	    	if($status != "all")
	    		$entities = $em->getRepository('PiAppAdminBundle:Page')->getAllPageByStatus($locale, $status)->getQuery()->getResult();
	    	else
	    		$entities = $em->getRepository('PiAppAdminBundle:Page')->getAllPageHtml()->getQuery()->getResult();
    	}else{
    		if($status != "all")
    			$entities = $em->getRepository('PiAppAdminBundle:Page')->getAllPageByStatus($locale, $status, $idUser)->getQuery()->getResult();
    		else
    			$entities = $em->getRepository('PiAppAdminBundle:Page')->getAllPageHtml($idUser)->getQuery()->getResult();
    	}
    
    	return $this->render('PiAppAdminBundle:PageByTrans:wizard.html.twig', array(
    			'entities'  => $entities,
    			'id_grid'	=> 'grid_' . $status,
    	));
    }

    /**
     * Finds and displays a Page entity.
     * 
     * @Secure(roles="IS_AUTHENTICATED_ANONYMOUSLY")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function showAction($id)
    {
        $em 	= $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('PiAppAdminBundle:Page')->find($id);
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout)
        	$template = "show.html.twig";
        else
        	$template = "show_ajax.html.twig";        

        if (!$entity) {
            throw ControllerException::NotFoundException('Page');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render("PiAppAdminBundle:PageByTrans:$template", array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        	'NoLayout' 	  => $NoLayout,        		
        ));
    }

    /**
     * Displays a form to create a new Page entity.
     * 
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function newAction()
    {
    	$locale	= $this->container->get('session')->getLocale();
    	$User   = $this->get('security.context')->getToken()->getUser();
    	$entity = new Page();
        $entity->setMetaContentType(PageRepository::TYPE_TEXT_HTML);
        $entity->setUser($User);
        $form   = $this->createForm(new PageType($locale, $User->getRoles(), $this->container), $entity, array('show_legend' => false));
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout)
        	$template = "new.html.twig";
        else
        	$template = "new_ajax.html.twig";        
        
        //$form->remove('page_css');
        //$form->remove('page_js');
        
        return $this->render("PiAppAdminBundle:PageByTrans:$template", array(
            'entity' => $entity,
            'form'   => $form->createView(),
        	'NoLayout' 	  => $NoLayout,        		
        ));
    }

    /**
     * Creates a new Page entity.
     * 
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function createAction()
    {
    	$locale	 = $this->container->get('session')->getLocale();
    	$User 	 = $this->get('security.context')->getToken()->getUser();
        $entity  = new Page();
        $entity->setMetaContentType(PageRepository::TYPE_TEXT_HTML);
        $entity->setUser($User);
        $request = $this->getRequest();
        $form    = $this->createForm(new PageType($locale, $User->getRoles(), $this->container), $entity, array('show_legend' => false));
        $form->bindRequest($request);
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout)
        	$template = "new.html.twig";
        else
        	$template = "new_ajax.html.twig";        

        if ('POST' === $request->getMethod()) {
        
        	$form->bindRequest($request);  
        	      
	        if ($form->isValid()) {
	            $em = $this->getDoctrine()->getEntityManager();
	
	            // We persist all page translations
	            foreach($entity->getTranslations() as $translationPage) {
	            	$entity->addTranslation($translationPage);
	            }	            
	            $em->persist($entity);
	            $em->flush();
	
	            return $this->redirect($this->generateUrl('admin_pagebytrans_show', array('id' => $entity->getId(), 'NoLayout' => $NoLayout)));	            
	        }
	
	        return $this->render("PiAppAdminBundle:PageByTrans:$template", array(
	            'entity' => $entity,
	            'form'   => $form->createView(),
	        	'NoLayout' 	  => $NoLayout,	        		
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
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function editAction($id)
    {
    	$locale	= $this->container->get('session')->getLocale();
    	$User 	= $this->get('security.context')->getToken()->getUser();
        $em 	= $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('PiAppAdminBundle:Page')->find($id);
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout)
        	$template = "edit.html.twig";
        else
        	$template = "edit_ajax.html.twig";        

        if (!$entity) {
            throw ControllerException::NotFoundException('Page');
        }

        $editForm = $this->createForm(new PageType($locale, $User->getRoles(), $this->container), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);
        
        return $this->render("PiAppAdminBundle:PageByTrans:$template", array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        	'NoLayout' 	  => $NoLayout,        		
        ));
    }

    /**
     * Edits an existing Page entity.
     * 
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function updateAction($id)
    {
    	$locale	= $this->container->get('session')->getLocale();
    	$User 	= $this->get('security.context')->getToken()->getUser();
        $em 	= $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('PiAppAdminBundle:Page')->find($id);
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout)
        	$template = "edit.html.twig";
        else
        	$template = "edit_ajax.html.twig";        
        
        if (!$entity) {
            throw ControllerException::NotFoundException('Page');
        }
        
        $editForm   = $this->createForm(new PageType($locale, $User->getRoles(), $this->container), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);
        $editForm->bindRequest($this->getRequest());
        
        if ($editForm->isValid()) {
            // We persist all page translations
            foreach($entity->getTranslations() as $translationPage) {
            	$entity->addTranslation($translationPage);
            }
            $em->persist($entity);
            $em->flush();
            
            return $this->redirect($this->generateUrl('admin_pagebytrans_edit', array('id' => $id, 'NoLayout' => $NoLayout)));
        }

        return $this->render("PiAppAdminBundle:PageByTrans:$template", array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        	'NoLayout' 	  => $NoLayout,        		
        ));
    }

    /**
     * Deletes a Page entity.
     * 
     * @Secure(roles="ROLE_USER")
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
            $entity = $em->getRepository('PiAppAdminBundle:Page')->find($id);

            if (!$entity) {
                throw ControllerException::NotFoundException('Page');
            }
           
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_pagebytrans'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
