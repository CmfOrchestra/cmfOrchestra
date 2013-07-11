<?php
/**
 * This file is part of the <PI_CRUD> project.
 *
 * @category   PI_CRUD_Controllers
 * @package    Controller
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-07-02
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

use PiApp\GedmoBundle\Entity\Content;
use PiApp\GedmoBundle\Form\ContentType;
use PiApp\GedmoBundle\Entity\Translation\ContentTranslation;

/**
 * Content controller.
 *
 *
 * @category   PI_CRUD_Controllers
 * @package    Controller
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class ContentController extends abstractController
{
	protected $_entityName = "PiAppGedmoBundle:Content";
    
    /**
     * Enabled content entities.
     *
     * @Route("/admin/gedmo/content/enabled", name="admin_gedmo_content_enabledentity_ajax")
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
     * Disable content  entities.
     *
     * @Route("/admin/gedmo/content/disable", name="admin_gedmo_content_disablentity_ajax")
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
     * Position content entities.
     *
     * @Route("/admin/gedmo/content/position", name="admin_gedmo_content_position_ajax")
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
     * Delete Content entities.
     *
     * @Route("/admin/gedmo/content/delete", name="admin_gedmo_content_deletentity_ajax")
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
     * Archive a Content entity.
     *
     * @Route("/admin/gedmo/content/archive", name="admin_gedmo_content_archiveentity_ajax")
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
     * Lists all Content entities.
     *
     * @Secure(roles="IS_AUTHENTICATED_ANONYMOUSLY")
     * @Template()
     * @access	public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function indexAction()
    {
    	$em 		= $this->getDoctrine()->getEntityManager();
    	$locale		= $this->container->get('request')->getLocale();
    
    	$category   = $this->container->get('request')->query->get('category');
    	$NoLayout   = $this->container->get('request')->query->get('NoLayout');
    	if (!$NoLayout) 	$template = "index.html.twig"; else $template = "index_ajax.html.twig";
    
    	if ($NoLayout){
    		//$entities 	= $em->getRepository("PiAppGedmoBundle:Content")->getAllEnableByCatAndByPosition($locale, $category, 'object');
    		$query		= $em->getRepository("PiAppGedmoBundle:Content")->getAllByCategory($category, null, '', 'ASC', false)->getQuery();
    		$entities   = $em->getRepository("PiAppGedmoBundle:Content")->findTranslationsByQuery($locale, $query, 'object', false);
    	}else
    		$entities	= $em->getRepository("PiAppGedmoBundle:Content")->findAllByEntity($locale, 'object');
    
    	return $this->render("PiAppGedmoBundle:Content:$template", array(
    			'entities' => $entities,
    			'NoLayout'	=> $NoLayout,
    			'category'  => $category,
    	));
    }
    
    /**
     * Finds and displays a Content entity.
     *
     * @Secure(roles="IS_AUTHENTICATED_ANONYMOUSLY")
     * @Template()
	 * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>    
     */
    public function showAction($id)
    {
        $em 	= $this->getDoctrine()->getEntityManager();
        $locale	= $this->container->get('request')->getLocale();
        $entity = $em->getRepository("PiAppGedmoBundle:Content")->findOneByEntity($locale, $id, 'object');
        
        $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout) 	$template = "show.html.twig"; else $template = "show_ajax.html.twig";        

        if (!$entity) {
            throw ControllerException::NotFoundException('Content');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render("PiAppGedmoBundle:Content:$template", array(
            'entity'      => $entity,
            'NoLayout'	  => $NoLayout,
            'delete_form' => $deleteForm->createView(),
        	'category'  => $category,
        ));
    }

    /**
     * Displays a form to create a new Content entity.
     *
     * @Secure(roles="ROLE_USER")
     * @Template()
	 * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>    
     */
    public function newAction()
    {
    	$locale	= $this->container->get('request')->getLocale();
    	$em 	= $this->getDoctrine()->getEntityManager();
    	$entity = new Content();
        $form   = $this->createForm(new ContentType($em, $locale, $this->container), $entity, array('show_legend' => false));
        
        $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)	$template = "new.html.twig";  else 	$template = "new_ajax.html.twig";        

        return $this->render("PiAppGedmoBundle:Content:$template", array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'NoLayout'  => $NoLayout,
        	'category'  => $category,
        ));
    }

    /**
     * Creates a new Content entity.
     *
     * @Secure(roles="ROLE_USER")
     * @Template()
	 * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>     
     */
    public function createAction()
    {
        $em 	= $this->getDoctrine()->getEntityManager();
        $locale	= $this->container->get('request')->getLocale();
        
        $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)	$template = "new.html.twig";  else 	$template = "new_ajax.html.twig";        
    
        $entity  = new Content();
        $request = $this->getRequest();
        $form    = $this->createForm(new ContentType($em, $locale, $this->container), $entity, array('show_legend' => false));
        $form->bind($request);

        if ($form->isValid()) {
            $entity->setTranslatableLocale($locale);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_gedmo_content_show', array('id' => $entity->getId(), 'NoLayout' => $NoLayout, 'category' => $category)));
                        
        }

        return $this->render("PiAppGedmoBundle:Content:$template", array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'NoLayout'  => $NoLayout,
        	'category'  => $category,
        ));
    }

    /**
     * Displays a form to edit an existing Content entity.
     *
     * @Secure(roles="ROLE_USER")
     * @Template()
	 * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>    
     */
    public function editAction($id)
    {
        $em 	= $this->getDoctrine()->getEntityManager();
    	$locale	= $this->container->get('request')->getLocale();
        $entity = $em->getRepository("PiAppGedmoBundle:Content")->findOneByEntity($locale, $id, 'object');
        
        $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)	$template = "edit.html.twig";  else	$template = "edit_ajax.html.twig";        

        if (!$entity) {
        	$entity = $em->getRepository("PiAppGedmoBundle:Content")->find($id);
        	$entity->addTranslation(new ContentTranslation($locale));            
        }

        $editForm   = $this->createForm(new ContentType($em, $locale, $this->container), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);

        return $this->render("PiAppGedmoBundle:Content:$template", array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'NoLayout' 	  => $NoLayout,
        	'category'  => $category,
        ));
    }

    /**
     * Edits an existing Content entity.
     *
     * @Secure(roles="ROLE_USER")
     * @Template()
	 * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>   
     */
    public function updateAction($id)
    {
        $em 	= $this->getDoctrine()->getEntityManager();
    	$locale	= $this->container->get('request')->getLocale();
        $entity = $em->getRepository("PiAppGedmoBundle:Content")->findOneByEntity($locale, $id, "object"); 
        
        $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)	$template = "edit.html.twig";  else	$template = "edit_ajax.html.twig";        

        if (!$entity) {
        	$entity = $em->getRepository("PiAppGedmoBundle:Content")->find($id);
        }

        $editForm   = $this->createForm(new ContentType($em, $locale, $this->container), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);

        $editForm->bind($this->getRequest(), $entity);
        if ($editForm->isValid()) {
            $entity->setTranslatableLocale($locale);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_gedmo_content_edit', array('id' => $id, 'NoLayout' => $NoLayout, 'category' => $category)));
        }

        return $this->render("PiAppGedmoBundle:Content:$template", array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'NoLayout' 	  => $NoLayout,
        	'category'  => $category,
        ));
    }

    /**
     * Deletes a Content entity.
     *
     * @Secure(roles="ROLE_SUPER_ADMIN")
	 * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>     
     */
    public function deleteAction($id)
    {
        $em 	 = $this->getDoctrine()->getEntityManager();
	    $locale	 = $this->container->get('request')->getLocale();
	    
	    $category   = $this->container->get('request')->query->get('category');
	    $NoLayout   = $this->container->get('request')->query->get('NoLayout');	    
    
        $form 	 = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
    	    $entity = $em->getRepository("PiAppGedmoBundle:Content")->findOneByEntity($locale, $id, 'object');

            if (!$entity) {
                throw ControllerException::NotFoundException('Content');
            }

        	try {
            	$em->remove($entity);
            	$em->flush();
            } catch (\Exception $e) {
            	$this->container->get('request')->getSession()->getFlashBag()->add('notice', 'pi.session.flash.wrong.undelete');
            }
        }

        return $this->redirect($this->generateUrl('admin_gedmo_content', array('NoLayout' => $NoLayout, 'category' => $category)));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }    
    /**
     * Template : Finds and displays a Content entity.
     * 
     * @Template()
     * @Cache(maxage="86400")
     *
     * @access	public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com> 
     */
    public function _template_showAction($id, $template = '_tmp_show.html.twig', $lang = "")
    {
    	$em 	= $this->getDoctrine()->getEntityManager();
    	
    	if (empty($lang))
    		$lang	= $this->container->get('request')->getLocale();
    	
    	$entity = $em->getRepository("PiAppGedmoBundle:Content")->findOneByEntity($lang, $id, 'object', false);
    	
    	if (!$entity) {
    		throw ControllerException::NotFoundException('Content');
    	}
    
    	return $this->render("PiAppGedmoBundle:Content:$template", array(
    			'entity'      => $entity,
    			'locale'   => $lang,
    			'lang'	   => $lang,
    	));
    }    
    /**
     * Template : Finds and displays a list of Content entity.
     * 
     * @Template()
     * @Cache(maxage="86400")
     *
     * @access	public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com> 
     */
    public function _template_listAction($category = '', $MaxResults = null, $template = '_tmp_list.html.twig', $order = 'DESC', $lang = "")
    {
    	$em 		= $this->getDoctrine()->getEntityManager();

    	if (empty($lang))
    		$lang	= $this->container->get('request')->getLocale();
    	
    	$query		= $em->getRepository("PiAppGedmoBundle:Content")->getAllByCategory($category, $MaxResults, $order)->getQuery();
        $entities   = $em->getRepository("PiAppGedmoBundle:Content")->findTranslationsByQuery($lang, $query, 'object', false);                   

        return $this->render("PiAppGedmoBundle:Content:$template", array(
            'entities' => $entities,
            'cat'	   => ucfirst($category),
        	'locale'   => $lang,
        	'lang'	   => $lang,
        ));
    } 
}
