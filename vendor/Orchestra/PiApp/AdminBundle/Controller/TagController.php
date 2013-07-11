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

use PiApp\AdminBundle\Entity\Translation\TagTranslation;
use PiApp\AdminBundle\Entity\Tag;
use PiApp\AdminBundle\Form\TagType;

/**
 * Tag controller.
 * 
 * @category   Admin_Controllers
 * @package    Controller
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class TagController extends abstractController
{
	protected $_entityName = "PiAppAdminBundle:Tag";
	
    /**
     * Lists all Tag entities.
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
    	$locale		= $this->container->get('request')->getLocale();
        $entities 	= $em->getRepository("PiAppAdminBundle:Tag")->findAllByEntity($locale, 'object');      

        return $this->render('PiAppAdminBundle:Tag:index.html.twig', array(
            'entities' => $entities
        ));
    }
    
    /**
     * Enabled Tag entities.
     *
     * @Route("/admin/tag/enabled", name="admin_tag_enabledentity_ajax")
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
     * Disable Tag  entities.
     *
     * @Route("/admin/tag/disable", name="admin_tag_disablentity_ajax")
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
     * Finds and displays a Tag entity.
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
        $locale	= $this->container->get('request')->getLocale();
        $entity = $em->getRepository("PiAppAdminBundle:Tag")->findOneByEntity($locale, $id, 'object');        

        if (!$entity) {
            throw ControllerException::NotFoundException('Tag');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PiAppAdminBundle:Tag:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Tag entity.
     * 
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function newAction()
    {
    	$em 	= $this->getDoctrine()->getEntityManager();
    	$locale	= $this->container->get('request')->getLocale();
    	
        $entity = new Tag();
        $form   = $this->createForm(new TagType($em, $locale), $entity, array('show_legend' => false));

        return $this->render('PiAppAdminBundle:Tag:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Tag entity.
     * 
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function createAction()
    {
    	$em		 = $this->getDoctrine()->getEntityManager();
    	$locale	= $this->container->get('request')->getLocale();
    	
        $entity  = new Tag();
        $request = $this->getRequest();
        $form    = $this->createForm(new TagType($em, $locale), $entity, array('show_legend' => false));
        $form->bind($request);

        if ($form->isValid()) {
            $entity->setTranslatableLocale($locale);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_tag_show', array('id' => $entity->getId())));
        }

        return $this->render('PiAppAdminBundle:Tag:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Tag entity.
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
        $locale	= $this->container->get('request')->getLocale();
        $entity = $em->getRepository("PiAppAdminBundle:Tag")->findOneByEntity($locale, $id, 'object');

        if (!$entity) {
        	$entity = $em->getRepository("PiAppAdminBundle:Tag")->find($id);
        	$entity->addTranslation(new TagTranslation($locale));            
        }

        $editForm 	= $this->createForm(new TagType($em, $locale), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PiAppAdminBundle:Tag:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Tag entity.
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
        $locale	= $this->container->get('request')->getLocale();
        $entity = $em->getRepository("PiAppAdminBundle:Tag")->findOneByEntity($locale, $id, 'object');

        if (!$entity) {
            $entity = $em->getRepository("PiAppAdminBundle:Tag")->find($id);
        }

        $editForm   = $this->createForm(new TagType($em, $locale), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $editForm->bind($request = $this->getRequest(), $entity);
        if ($editForm->isValid()) {
            $entity->setTranslatableLocale($locale);
            
            $other  = $entity->getGroupnameother();
            if (!empty($other)){
            	$entity->setGroupname($other);
            	$entity->setGroupnameother('');
            	$entity->translate($locale)->setGroupname($other);
            	$entity->translate($locale)->setGroupnameother('');
            }          
            
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_tag_edit', array('id' => $id)));
        }

        return $this->render('PiAppAdminBundle:Tag:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Tag entity.
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

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('PiAppAdminBundle:Tag')->find($id);

            if (!$entity) {
                throw ControllerException::NotFoundException('Tag');
            }

            try {
            	$em->remove($entity);
            	$em->flush();
            } catch (\Exception $e) {
            	$this->container->get('request')->getSession()->getFlashBag()->add('notice', 'pi.session.flash.wrong.undelete');
            }
        }

        return $this->redirect($this->generateUrl('admin_tag'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
}