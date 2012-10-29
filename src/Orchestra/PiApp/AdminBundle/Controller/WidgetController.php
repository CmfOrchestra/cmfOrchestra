<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Controllers
 * @package    Controller
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
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

use PiApp\AdminBundle\Entity\Widget;
use PiApp\AdminBundle\Form\WidgetByTransType;

/**
 * Widget controller.
 * 
 * @category   Admin_Controllers
 * @package    Controller
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class WidgetController extends abstractController
{
	protected $_entityName = "PiAppAdminBundle:Widget";
	
    /**
     * Lists all Widget entities.
     * 
     * @Secure(roles="IS_AUTHENTICATED_ANONYMOUSLY")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function indexAction($block)
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        if(is_null($block))
        	$entities = $em->getRepository('PiAppAdminBundle:Widget')->findAll(array('position'=> "ASC"));
        else
        	$entities = $em->getRepository('PiAppAdminBundle:Widget')->findBy(array('block'=>$block), array('position'=> "ASC"));
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');

        return $this->render('PiAppAdminBundle:Widget:index.html.twig', array(
            'entities' => $entities,
        	'NoLayout' 	  => $NoLayout,
        ));
    }
    
    /**
     * Enabled Widget entities.
     *
     * @Route("/admin/widget/enabled", name="admin_widget_enabledentity_ajax")
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
     * Disable Widget  entities.
     *
     * @Route("/admin/widget/disable", name="admin_widget_disablentity_ajax")
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
     * Position entities.
     *
     * @Route("/admin/widget/position", name="admin_widget_position_ajax")
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access  public
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function positionajaxAction()
    {
    	return parent::positionajaxAction();
    }    

    /**
     * Finds and displays a Widget entity.
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
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');

        $entity = $em->getRepository('PiAppAdminBundle:Widget')->find($id);

        if (!$entity) {
        	throw ControllerException::NotFoundException('Widget');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PiAppAdminBundle:Widget:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        	'NoLayout' 	  => $NoLayout,
        ));
    }

    /**
     * Displays a form to create a new Widget entity.
     * 
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function newAction()
    {
    	$NoLayout   = $this->container->get('request')->query->get('NoLayout');
    	
        $entity = new Widget();
        $form   = $this->createForm(new WidgetByTransType(), $entity, array('show_legend' => false));

        return $this->render('PiAppAdminBundle:Widget:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        	'NoLayout' 	  => $NoLayout,
        ));
    }

    /**
     * Creates a new Widget entity.
     * 
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function createAction()
    {
    	$NoLayout   = $this->container->get('request')->query->get('NoLayout');
        $entity  = new Widget();
        $request = $this->getRequest();
        $form    = $this->createForm(new WidgetByTransType(), $entity, array('show_legend' => false));
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            
            // On persiste tous les translations d'une page.
            foreach($entity->getTranslations() as $translationPage) {
            	$entity->addTranslation($translationPage);
            }
                        
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_widget_show', array('id' => $entity->getId(), 'NoLayout' => $NoLayout)));
            
        }

        return $this->render('PiAppAdminBundle:Widget:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        	'NoLayout' 	  => $NoLayout,
        ));
    }

    /**
     * Displays a form to edit an existing Widget entity.
     * 
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function editAction($id)
    {
        $em 	= $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('PiAppAdminBundle:Widget')->find($id);
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout)
        	$template = "edit.html.twig";
        else
        	$template = "edit_ajax.html.twig";        

        if (!$entity) {
            throw ControllerException::NotFoundException('Widget');
        }

        $editForm 	= $this->createForm(new WidgetByTransType(), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);

        return $this->render("PiAppAdminBundle:Widget:$template", array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        	'NoLayout' 	  => $NoLayout,
        ));
    }

    /**
     * Edits an existing Widget entity.
     * 
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function updateAction($id)
    {
        $em 	= $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('PiAppAdminBundle:Widget')->find($id);
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout)
        	$template = "edit.html.twig";
        else
        	$template = "edit_ajax.html.twig";        

        if (!$entity) {
            throw ControllerException::NotFoundException('Widget');
        }

        $editForm   = $this->createForm(new WidgetByTransType(), $entity, array('show_legend' => false));
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
            
            return $this->redirect($this->generateUrl('admin_widget_edit', array('id' => $id, 'NoLayout' => $NoLayout)));
        }

        return $this->render("PiAppAdminBundle:Widget:$template", array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        	'NoLayout' 	  => $NoLayout,
        ));
    }

    /**
     * Deletes a Widget entity.
     * 
     * @Secure(roles="ROLE_SUPER_ADMIN")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * 
     * @access	public
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function deleteAction($id)
    {
    	$NoLayout   = $this->container->get('request')->query->get('NoLayout');
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('PiAppAdminBundle:Widget')->find($id);

            if (!$entity) {
                throw ControllerException::NotFoundException('Widget');
            }
            
            $idBlock = $entity->getBlock()->getId();

            $em->remove($entity);
            $em->flush();
        }
        
        return $this->redirect($this->generateUrl('admin_blockbywidget_show', array('id' => $idBlock, 'NoLayout' => $NoLayout)));
    }    

    private function createDeleteForm($id)
    {
    	return $this->createFormBuilder(array('id' => $id))
    	->add('id', 'hidden')
    	->getForm()
    	;
    }    
    
    /**
     * Deletes a Widget entity.
     *
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     * @access	public
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     */
    public function deleteajaxAction()
    {
    	$request = $this->container->get('request');
    	$em 	 = $this->getDoctrine()->getEntityManager();
    	
    	if($request->isXmlHttpRequest()){

	   		if($request->query->has('id'))	$id	= $request->query->get('id');	else	$id	= null;
	   		
	   		if(!is_null($id)){
		   		$entity = $em->getRepository('PiAppAdminBundle:Widget')->find($id);
		   		
		   		if ($entity) {
		   			$em->remove($entity);
		   			$em->flush();
		   		}
    		}
    		
    		// we return the desired url
    		$values[0]['request'] = true;
    		 
    		$response = new Response(json_encode($values));
    		$response->headers->set('Content-Type', 'application/json');
    		return $response;    		
    	}else
    		throw ControllerException::callAjaxOnlySupported('deleteajax');
    }
    
    /**
     * Move widget action
     *
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-07-05
     */
    public function movewidgetajaxAction()
    {
    	$request = $this->container->get('request');
    	$em 	 = $this->getDoctrine()->getEntityManager();
    		
    	if($request->isXmlHttpRequest()){
    
    		if($request->query->has('id_start_block'))	$id_start_block	= $request->query->get('id_start_block');	else	$id_start_block = null;
    		if($request->query->has('id_end_block'))	$id_end_block	= $request->query->get('id_end_block');		else	$id_end_block 	= null;
    		if($request->query->has('id_widget'))		$id_widget		= $request->query->get('id_widget');		else	$id_widget 		= null;
    			
    		if(!is_null($id_start_block) && !is_null($id_end_block)){
    			$entity_end_block = $em->getRepository('PiAppAdminBundle:Block')->find($id_end_block);
    			$entity_widget	  = $em->getRepository('PiAppAdminBundle:Widget')->find($id_widget);
    
    			$all_widget_block = $entity_end_block->getWidgets();
    
    			foreach($all_widget_block as $key => $widget){
    				$old_pos = $widget->getPosition();
    				if($old_pos != null)
    					$new_pos = $old_pos +1;
    				else
    					$new_pos = 1;
    
    				$widget->setPosition($new_pos);
    				$em->persist($widget);
    				//$em->flush();
    			}
    
    			$entity_widget->setBlock($entity_end_block);
    			$entity_widget->setPosition("1");
    			$entity_widget->setEnabled(true);
    			$em->persist($entity_widget);
    
    			$em->flush();
    		}

    		// we return the desired url
    		$values[0]['request'] = true;
    		
    		$response = new Response(json_encode($values));
    		$response->headers->set('Content-Type', 'application/json');
    		return $response;    		
    	}else
    		throw ControllerException::callAjaxOnlySupported('movewidgetajax');
    }
    
    /**
     * Move up/down widget action
     *
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-07-05
     */
    public function moveajaxAction()
    {
    	$request = $this->container->get('request');
    	$em 	 = $this->getDoctrine()->getEntityManager();
    
    	if($request->isXmlHttpRequest()){
    
    		if($request->query->has('id'))		$id		= $request->query->get('id');	else	$id		= null;
    		if($request->query->has('type'))	$type	= $request->query->get('type');	else	$type	= null;
    		 
    		if(!is_null($id) && !is_null($type) && in_array($type, array('up', 'down')) ){
    			$entity_widget		= $em->getRepository('PiAppAdminBundle:Widget')->find($id);
    			$entity_block 		= $entity_widget->getBlock();
    			$entity_widget_pos  = $entity_widget->getPosition();
    			$break 				= false;
    			
    			if(is_null($entity_widget_pos)){
    				$entity_widget_pos = 1;
    				$entity_widget->setPosition($entity_widget_pos);
    				$em->persist($entity_widget);
    				$em->flush();
    			}

    			if($type == 'up'){
    				$all_widget_block 	= $em->getRepository('PiAppAdminBundle:Widget')->getAllWidgetsByBlock($entity_block->getId(), "DESC")->getResult(); //$entity_block->getWidgets();
	    			foreach($all_widget_block as $key => $widget){
	    				$widg_pos = $widget->getPosition();
	    				if(!$break && ($widg_pos < $entity_widget_pos) ){
	    					$widget->setPosition($entity_widget_pos);
	    					$em->persist($widget);
	    					
	    					$entity_widget->setPosition($widg_pos);
	    					$em->persist($entity_widget);
	    					$em->flush();
	    					$break= true;
	    				}
	    			}
	    		}
	    		elseif($type == 'down'){
	    			$all_widget_block 	= $em->getRepository('PiAppAdminBundle:Widget')->getAllWidgetsByBlock($entity_block->getId(), "ASC")->getResult(); //$entity_block->getWidgets();
	    			foreach($all_widget_block as $key => $widget){
	    				$widg_pos = $widget->getPosition();
	    				if(!$break && ($widg_pos > $entity_widget_pos) ){
	    					$widget->setPosition($entity_widget_pos);
	    					$em->persist($widget);
	    		
	    					$entity_widget->setPosition($widg_pos);
	    					$em->persist($entity_widget);
	    					$em->flush();
	    					$break= true;
	    				}
	    			}
	    		}	    		
	    		
    		}
    		// we return the desired url
    		$values[0]['request'] = true;
    		
    		$response = new Response(json_encode($values));
    		$response->headers->set('Content-Type', 'application/json');
    		return $response;
    	}else
    		throw ControllerException::callAjaxOnlySupported('moveajax');
    }
    
}
