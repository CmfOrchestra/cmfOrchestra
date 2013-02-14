<?php
/**
 * This file is part of the <PI_CRUD> project.
 *
 * @category   PI_CRUD_Controllers
 * @package    Controller
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since XXXX-XX-XX
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\GedmoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BootStrap\TranslationBundle\Controller\abstractController;
use PiApp\AdminBundle\Exception\ControllerException;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use JMS\SecurityExtraBundle\Annotation\Secure;

use PiApp\GedmoBundle\Entity\Media;
use PiApp\GedmoBundle\Form\MediaType;
use PiApp\GedmoBundle\Entity\Translation\MediaTranslation;

/**
 * Media controller.
 *
 *
 * @category   PI_CRUD_Controllers
 * @package    Controller
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class MediaController extends abstractController
{
	protected $_entityName = "PiAppGedmoBundle:Media";

	/**
     * Enabled Media entities.
     *
     * @Route("/admin/gedmo/media/enabled", name="admin_gedmo_media_enabledentity_ajax")
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
     * Disable Media entities.
     * 
     * @Route("/admin/gedmo/media/disable", name="admin_gedmo_media_disablentity_ajax")
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
     * Position Media entities.
     *
     * @Route("/admin/gedmo/media/position", name="admin_gedmo_media_position_ajax")
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
     * Delete Media entities.
     *
     * @Route("/admin/gedmo/media/delete", name="admin_gedmo_media_deletentity_ajax")
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access  public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function deleteajaxAction()
    {
    	return parent::deletajaxAction();
    }
    
    /**
     * Archive a Media entity.
     *
     * @Route("/admin/gedmo/media/archive", name="admin_gedmo_media_archiveentity_ajax")
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
        
    /**
     * Lists all Media entities.
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
    
    	$NoLayout   = $this->container->get('request')->query->get('NoLayout');
    	if(!$NoLayout) 	$template = "index.html.twig"; else $template = "index.html.twig";
    
    	$category   = $this->container->get('request')->query->get('category');
    	if(is_array($category) && isset($category['__isInitialized__']))
    		$category = $category['__isInitialized__'];
    
    	if($NoLayout){
    		//$entities 	= $em->getRepository("PiAppGedmoBundle:Media")->getAllEnableByCatAndByPosition($locale, $category, 'object');
    		$query		= $em->getRepository("PiAppGedmoBundle:Media")->getAllByCategory($category, null, '', 'ASC', false)->getQuery();
    		$entities   = $em->getRepository("PiAppGedmoBundle:Media")->findTranslationsByQuery($locale, $query, 'object', false);
    	}else
    		$entities	= $em->getRepository("PiAppGedmoBundle:Media")->findAllByEntity($locale, 'object');    	
    
    	return $this->render("PiAppGedmoBundle:Media:$template", array(
    			'entities' => $entities,
    			'NoLayout'	=> $NoLayout,
    			'category' => $category,
    	));
    }
    
    /**
     * Finds and displays a Media entity.
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
        $entity = $em->getRepository("PiAppGedmoBundle:Media")->findOneByEntity($locale, $id, 'object');
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout) 	$template = "show.html.twig"; else $template = "show.html.twig";

        $category   = $this->container->get('request')->query->get('category');
        if(is_array($category) && isset($category['__isInitialized__']))
        	$category = $category['__isInitialized__'];

        if (!$entity) {
            throw ControllerException::NotFoundException('Media');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render("PiAppGedmoBundle:Media:$template", array(
            'entity'      => $entity,
            'NoLayout'	  => $NoLayout,
        	'category'	  => $category,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    /**
     * Displays a form to create a new Media entity.
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
    	$locale	= $this->container->get('session')->getLocale();
    	$status = $this->container->get('request')->query->get('status');
    	$entity = new Media();
    	$entity->setStatus($status);
    	$form   = $this->createForm(new MediaType($em, $status), $entity, array('show_legend' => false));
    
    	$NoLayout   = $this->container->get('request')->query->get('NoLayout');
    	if(!$NoLayout)	$template = "new.html.twig";  else 	$template = "new.html.twig";
    	
    	$category   = $this->container->get('request')->query->get('category');
    	if(is_array($category) && isset($category['__isInitialized__']))
    		$category = $category['__isInitialized__'];
    
    	return $this->render("PiAppGedmoBundle:Media:$template", array(
    			'entity' => $entity,
    			'form'   => $form->createView(),
    			'NoLayout'  => $NoLayout,
    			'category'	  => $category,
    			'status'	=> $status,
    	));
    }
    
    /**
     * Creates a new Media entity.
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
    	$status = $this->container->get('request')->query->get('status');
    
    	$NoLayout   = $this->container->get('request')->query->get('NoLayout');
    	if(!$NoLayout)	$template = "new.html.twig";  else 	$template = "new.html.twig";
    	
    	$category   = $this->container->get('request')->query->get('category');
    	if(is_array($category) && isset($category['__isInitialized__']))
    		$category = $category['__isInitialized__'];
    
    	$entity  = new Media();
    	$entity->setStatus($status);
    	$request = $this->getRequest();
    	$form    = $this->createForm(new MediaType($em, $status), $entity, array('show_legend' => false));
    	$form->bindRequest($request);
    
    	if ($form->isValid()) {
    		$entity->setTranslatableLocale($locale);
    		$em->persist($entity);
    		$em->flush();
    		return $this->redirect($this->generateUrl('admin_gedmo_media_show', array('id' => $entity->getId(), 'NoLayout' => $NoLayout, 'category' => $category)));
    	}
    
    	return $this->render("PiAppGedmoBundle:Media:$template", array(
    			'entity' 	=> $entity,
    			'form'   	=> $form->createView(),
    			'NoLayout'  => $NoLayout,
    			'category'	  => $category,
    			'status'	=> $status,
    	));
    }    

    /**
     * Displays a form to edit an existing Media entity.
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
        $entity = $em->getRepository("PiAppGedmoBundle:Media")->findOneByEntity($locale, $id, 'object');
        
        $status	    = $this->container->get('request')->query->get('status');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout)	$template = "edit.html.twig";  else	$template = "edit.html.twig";

        $category   = $this->container->get('request')->query->get('category');
        if(is_array($category) && isset($category['__isInitialized__']))
        	$category = $category['__isInitialized__'];

        if (!$entity) {
        	$entity = $em->getRepository("PiAppGedmoBundle:Media")->find($id);
        	$entity->addTranslation(new MediaTranslation($locale));            
        }

        $editForm   = $this->createForm(new MediaType($em, $status), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);

        return $this->render("PiAppGedmoBundle:Media:$template", array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'NoLayout' 	  => $NoLayout,
        	'category'	  => $category,
        	'status'	  => $status,
        ));
    }

    /**
     * Edits an existing Media entity.
     *
     * @Secure(roles="ROLE_USER")
	 * @return \Symfony\Component\HttpFoundation\Response
     *
	 * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>   
     */
    public function updateAction($id)
    {
        $em 	= $this->getDoctrine()->getEntityManager();
    	$locale	= $this->container->get('session')->getLocale();
        $entity = $em->getRepository("PiAppGedmoBundle:Media")->findOneByEntity($locale, $id, "object"); 
        
        $status	    = $this->container->get('request')->query->get('status');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout)	$template = "edit.html.twig";  else	$template = "edit.html.twig";

        $category   = $this->container->get('request')->query->get('category');
        if(is_array($category) && isset($category['__isInitialized__']))
        	$category = $category['__isInitialized__'];

        if (!$entity) {
        	$entity = $em->getRepository("PiAppGedmoBundle:Media")->find($id);
        }

        $editForm   = $this->createForm(new MediaType($em, $status), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);

        $editForm->bindRequest($this->getRequest(), $entity);
        if ($editForm->isValid()) {
            $entity->setTranslatableLocale($locale);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_gedmo_media_edit', array('id' => $id, 'NoLayout' => $NoLayout, 'category' => $category, 'status' => $status)));
        }

        return $this->render("PiAppGedmoBundle:Media:$template", array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'NoLayout' 	  => $NoLayout,
        	'status'	=> $status,
        ));
    }

    /**
     * Deletes a Media entity.
     *
     * @Secure(roles="ROLE_USER")
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *     
	 * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>     
     */
    public function deleteAction($id)
    {
        $em 	 = $this->getDoctrine()->getEntityManager();
	    $locale	 = $this->container->get('session')->getLocale();
	    
	    $NoLayout   = $this->container->get('request')->query->get('NoLayout');	   
	    $category   = $this->container->get('request')->query->get('category');
    
        $form 	 = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
    	    $entity = $em->getRepository("PiAppGedmoBundle:Media")->findOneByEntity($locale, $id, 'object');

            if (!$entity) {
                throw ControllerException::NotFoundException('Media');
            }

        	try {
            	$em->remove($entity);
            	$em->flush();
            } catch (\Exception $e) {
            	$this->container->get('session')->setFlash('notice', 'pi.session.flash.right.undelete');
            }
        }

        return $this->redirect($this->generateUrl('admin_gedmo_media', array('NoLayout' => $NoLayout, 'category' => $category)));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    /**
     * Template : Finds and displays a Media entity.
     * 
     * @Cache(maxage="86400")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access	public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com> 
     */
    public function _template_showAction($id, $template = '_tmp_show.html.twig', $lang = "")
    {
    	$em 	= $this->getDoctrine()->getEntityManager();
    	
    	if(empty($lang))
    		$lang	= $this->container->get('session')->getLocale();
    	
    	$entity = $em->getRepository("PiAppGedmoBundle:Media")->findOneByEntity($lang, $id, 'object', false);
    	
    	if (!$entity) {
    		throw ControllerException::NotFoundException('Media');
    	}
    
    	return $this->render("PiAppGedmoBundle:Media:$template", array(
    			'entity'      => $entity,
    			'locale'   => $lang,
    			'lang'	   => $lang,
    	));
    }

	/**
     * Template : Finds and displays a list of Media entity.
     * 
     * @Cache(maxage="86400")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access	public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com> 
     */
    public function _template_listAction($category = '', $MaxResults = null, $template = '_tmp_list.html.twig', $order = 'DESC', $lang = "")
    {
    	$em 		= $this->getDoctrine()->getEntityManager();

    	if(empty($lang))
    		$lang	= $this->container->get('session')->getLocale();
    	
    	$query		= $em->getRepository("PiAppGedmoBundle:Media")->getAllByCategory($category, $MaxResults, '', $order)->getQuery();
        $entities   = $em->getRepository("PiAppGedmoBundle:Media")->findTranslationsByQuery($lang, $query, 'object', false);                   

        return $this->render("PiAppGedmoBundle:Media:$template", array(
            'entities' => $entities,
            'cat'	   => ucfirst($category),
        	'locale'   => $lang,
        	'lang'	   => $lang,
        ));
    }     
    
}
