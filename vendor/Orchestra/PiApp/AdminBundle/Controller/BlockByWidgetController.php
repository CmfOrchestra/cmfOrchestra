<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Controllers
 * @package    Controller
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-01
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

use PiApp\AdminBundle\Entity\Block;
use PiApp\AdminBundle\Form\BlockByWidgetType;

/**
 * BlockByWidget controller.
 * 
 * @category   Admin_Controllers
 * @package    Controller
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class BlockByWidgetController extends abstractController
{
    protected $_entityName = "PiAppAdminBundle:Block";
    
    /**
     * Enabled Block entities.
     *
     * @Route("/admin/block/enabled", name="admin_page_block_enabledentity_ajax")
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
     * Disable Block  entities.
     *
     * @Route("/admin/block/disable", name="admin_page_block_disablentity_ajax")
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
     * Position entities.
     *
     * @Route("/admin/block/position", name="admin_page_block_position_ajax")
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
     * Lists all Block entities.
     *
     * @Secure(roles="IS_AUTHENTICATED_ANONYMOUSLY")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function indexAction($page)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
    
        if (is_null($page))
            $entities = $em->getRepository('PiAppAdminBundle:Block')->findAll();
        else
            $entities = $em->getRepository('PiAppAdminBundle:Block')->findBy(array('page'=>$page));
    
        return $this->render('PiAppAdminBundle:BlockByWidget:index.html.twig', array(
                'entities' => $entities,
                'NoLayout'       => $NoLayout,
        ));
    }    
    
    /**
     * Finds and displays a Block entity.
     * 
     * @Secure(roles="IS_AUTHENTICATED_ANONYMOUSLY")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');

        $entity = $em->getRepository('PiAppAdminBundle:Block')->find($id);

        if (!$entity) {
            throw ControllerException::NotFoundException('Block');
        }
        
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PiAppAdminBundle:BlockByWidget:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'NoLayout'       => $NoLayout,
        ));
    }

    /**
     * Displays a form to create a new Block entity.
     * 
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function newAction()
    {
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        $entity = new Block();
        $form   = $this->createForm(new BlockByWidgetType(), $entity, array('show_legend' => false));

        return $this->render('PiAppAdminBundle:BlockByWidget:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'NoLayout'       => $NoLayout,
        ));
    }

    /**
     * Creates a new Block entity.
     * 
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function createAction()
    {
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        $entity  = new Block();
        $request = $this->getRequest();
        $form    = $this->createForm(new BlockByWidgetType(), $entity, array('show_legend' => false));
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            // On persiste tous les widgets d'un block.
            foreach($entity->getWidgets() as $block) {
                $entity->addWidget($block);
            }            
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_blockbywidget_show', array('id' => $entity->getId(), 'NoLayout' => $NoLayout)));            
        }

        return $this->render('PiAppAdminBundle:BlockByWidget:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'NoLayout'       => $NoLayout,
        ));
    }

    /**
     * Displays a form to edit an existing Block entity.
     * 
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function editAction($id)
    {
        $em     = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('PiAppAdminBundle:Block')->find($id);
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)
            $template = "edit.html.twig";
        else
            $template = "edit_ajax.html.twig";        

        if (!$entity) {
            throw ControllerException::NotFoundException('Block');
        }

        $editForm   = $this->createForm(new BlockByWidgetType(), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);

        return $this->render("PiAppAdminBundle:BlockByWidget:$template", array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'NoLayout'       => $NoLayout,
        ));
    }

    /**
     * Edits an existing Block entity.
     * 
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function updateAction($id)
    {
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        $em     = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('PiAppAdminBundle:Block')->find($id);
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)
            $template = "edit.html.twig";
        else
            $template = "edit_ajax.html.twig";        
        
        if (!$entity) {
            throw ControllerException::NotFoundException('Block');
        }
        
        $originalWidgets = array();
        // Create an array of the current Widget objects in the database
        foreach ($entity->getWidgets() as $widget) {
            $originalWidgets[] = $widget;
        }

        $editForm   = $this->createForm(new BlockByWidgetType(), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);
        
        $request = $this->getRequest();
        $editForm->bind($request);
        
        if ($editForm->isValid()) {            
            // filter $originalWidgets to contain tags no longer present
            foreach ($entity->getWidgets() as $widget) {
                foreach ($originalWidgets as $key => $toDel) {
                    if ($toDel->getId() === $widget->getId()) {
                        unset($originalWidgets[$key]);
                    }
                }
            }
            // remove the relationship between the widget and the block
            foreach ($originalWidgets as $widget) {
                $widget->setBlock(null);            
                $em->remove($widget);
            }
            
            // On persiste tous les widgets d'un block.
            foreach($entity->getWidgets() as $widget) {
                $entity->addWidget($widget);
            }
            $em->persist($entity);
            $em->flush();
            
            return $this->redirect($this->generateUrl('admin_blockbywidget_edit', array('id' => $id, 'NoLayout' => $NoLayout)));
        }

        return $this->render("PiAppAdminBundle:BlockByWidget:$template", array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'NoLayout'       => $NoLayout,
        ));
    }

    /**
     * Deletes a Block entity.
     * 
     * @Secure(roles="ROLE_SUPER_ADMIN")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * 
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function deleteAction($id)
    {
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('PiAppAdminBundle:Block')->find($id);
            
            $id_page = $entity->getPage()->getId();

            if (!$entity) {
                throw ControllerException::NotFoundException('Block');
            }
            
            try {
                $em->remove($entity);
                $em->flush();
            } catch (\Exception $e) {
                $this->container->get('request')->getSession()->getFlashBag()->add('notice', 'pi.session.flash.wrong.undelete');
            }
        }

        return $this->redirect($this->generateUrl('admin_pagebyblock_show', array('id' => $id_page, 'NoLayout' => $NoLayout)));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
