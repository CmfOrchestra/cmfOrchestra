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

use PiApp\AdminBundle\Entity\Translation\LangueTranslation;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BootStrap\TranslationBundle\Controller\abstractController;
use PiApp\AdminBundle\Exception\ControllerException;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use JMS\SecurityExtraBundle\Annotation\Secure;

use PiApp\AdminBundle\Entity\Langue;
use PiApp\AdminBundle\Form\LangueType;

/**
 * Langue controller.
 * 
 * @category   Admin_Controllers
 * @package    Controller
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class LangueController extends abstractController
{
	protected $_entityName = "PiAppAdminBundle:Langue";
	
    /**
     * Lists all Langue entities.
     * 
     * @Secure(roles="IS_AUTHENTICATED_ANONYMOUSLY")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function indexAction()
    {
        $em 		= $this->getDoctrine()->getEntityManager();
        $locale		= $this->container->get('session')->getLocale();
        $entities 	= $em->getRepository("PiAppAdminBundle:Langue")->findAllByEntity($locale, 'object', false);        

        return $this->render('PiAppAdminBundle:Langue:index.html.twig', array(
            'entities' => $entities
        ));
    }
    
    /**
     * Enabled Langue entities.
     *
     * @Route("/admin/langue/enabled", name="admin_langue_enabledentity_ajax")
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
     * Disable Langue  entities.
     *
     * @Route("/admin/langue/disable", name="admin_langue_disablentity_ajax")
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
     * Finds and displays a Langue entity.
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
        $locale	= $this->container->get('session')->getLocale();
        $entity = $em->getRepository("PiAppAdminBundle:Langue")->findOneByEntity($locale, $id, 'object');        

        if (!$entity) {
            throw ControllerException::NotFoundException('Langue');
        }
        $deleteForm = $this->createDeleteForm($id);
        
        $locale_id 		= explode('_', strtolower($entity->getId()));
        if(count($locale_id)==2)
        	$locale_id = $locale_id[1];
        else
        	$locale_id = strtolower($entity->getId());
        
        return $this->render('PiAppAdminBundle:Langue:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        	'locale_id'	  => $locale_id,
        ));
    }

    /**
     * Displays a form to create a new Langue entity.
     * 
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function newAction()
    {
        $entity = new Langue();
        $locale	= $this->container->get('session')->getLocale();
        $form   = $this->createForm(new LangueType($locale), $entity, array('show_legend' => false));

        return $this->render('PiAppAdminBundle:Langue:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Langue entity.
     * 
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function createAction()
    {
    	$em 	= $this->getDoctrine()->getEntityManager();
    	$locale	= $this->container->get('session')->getLocale();
        $entity = new Langue();
        
        $request = $this->getRequest();
        $form    = $this->createForm(new LangueType($locale), $entity, array('show_legend' => false));
        $form->bindRequest($request);

        if ($form->isValid()) {
            $entity->setTranslatableLocale($locale);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_langue_show', array('id' => $entity->getId())));
            
        }

        return $this->render('PiAppAdminBundle:Langue:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Langue entity.
     * 
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function editAction($id)
    {
        $em 	= $this->getDoctrine()->getEntityManager();
        $locale	= $this->container->get('session')->getLocale();
        $entity = $em->getRepository("PiAppAdminBundle:Langue")->findOneByEntity($locale, $id, 'object');

        if (!$entity) {
        	$entity = $em->getRepository("PiAppAdminBundle:Langue")->find($id);
        	$entity->addTranslation(new LangueTranslation($locale));
        }        

        $editForm = $this->createForm(new LangueType($locale), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);
        
        return $this->render('PiAppAdminBundle:Langue:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Langue entity.
     * 
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function updateAction($id)
    {
        $em		= $this->getDoctrine()->getEntityManager();
        $locale	= $this->container->get('session')->getLocale();
        $entity = $em->getRepository("PiAppAdminBundle:Langue")->findOneByEntity($locale, $id, 'object');
        
        if (!$entity) {
        	$entity = $em->getRepository("PiAppAdminBundle:Langue")->find($id);
        }        

        $editForm   = $this->createForm(new LangueType($locale), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $editForm->bindRequest($request = $this->getRequest(), $entity);
        if ($editForm->isValid()) {
        	$entity->setTranslatableLocale($locale);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_langue_edit', array('id' => $id)));
        }

        return $this->render('PiAppAdminBundle:Langue:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Langue entity.
     * 
     * @Secure(roles="ROLE_ADMIN")
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
            $entity = $em->getRepository('PiAppAdminBundle:Langue')->find($id);

            if (!$entity) {
                throw ControllerException::NotFoundException('Langue');
            }

            try {
            	$em->remove($entity);
            	$em->flush();
            } catch (\Exception $e) {
            	$this->container->get('session')->setFlash('notice', 'pi.session.flash.right.undelete');
            }
        }

        return $this->redirect($this->generateUrl('admin_langue'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
