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

use PiApp\GedmoBundle\Entity\Corporation;
use PiApp\GedmoBundle\Form\CorporationType;
use PiApp\GedmoBundle\Entity\Translation\CorporationTranslation;

/**
 * Corporation controller.
 *
 *
 * @category   PI_CRUD_Controllers
 * @package    Controller
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class CorporationController extends abstractController
{
	protected $_entityName = "PiAppGedmoBundle:Corporation";

	/**
     * Enabled Corporation entities.
     *
     * @Route("/admin/gedmo/corporation/enabled", name="admin_gedmo_corporation_enabledentity_ajax")
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
     * Disable Corporation entities.
     * 
     * @Route("/admin/gedmo/corporation/disable", name="admin_gedmo_corporation_disablentity_ajax")
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
     * Change the position of a Corporation entity.
     *
     * @Route("/admin/gedmo/corporation/position", name="admin_gedmo_corporation_position_ajax")
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
     * Delete a Corporation entity.
     *
     * @Route("/admin/gedmo/corporation/delete", name="admin_gedmo_corporation_deletentity_ajax")
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
     * Lists all Corporation entities.
     *
     * @Secure(roles="IS_AUTHENTICATED_ANONYMOUSLY")
	 * @return \Symfony\Component\HttpFoundation\Response
     *
	 * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>   
     */
    public function indexAction()
    {
    	$em			= $this->getDoctrine()->getEntityManager();
    	$locale		= $this->container->get('session')->getLocale();
        
        $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout) 	$template = "index.html.twig"; else $template = "index.html.twig";
        
        if($NoLayout && $category && !empty($category))
    		$entities 	= $em->getRepository("PiAppGedmoBundle:Corporation")->getAllEnableByCatAndByPosition($locale, $category, 'object');
    	else
    		$entities	= $em->getRepository("PiAppGedmoBundle:Corporation")->findAllByEntity($locale, 'object');

        return $this->render("PiAppGedmoBundle:Corporation:$template", array(
            'entities'	=> $entities,
            'NoLayout'	=> $NoLayout,
            'category'	=> $category,
        ));
    }

    /**
     * Finds and displays a Corporation entity.
     *
     * @Secure(roles="IS_AUTHENTICATED_ANONYMOUSLY")
	 * @return \Symfony\Component\HttpFoundation\Response
     *
	 * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>    
     */
    public function showAction($id)
    {
        $em 		= $this->getDoctrine()->getEntityManager();
        $locale		= $this->container->get('session')->getLocale();
        $entity 	= $em->getRepository("PiAppGedmoBundle:Corporation")->findOneByEntity($locale, $id, 'object');
        
        $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout) 	$template = "show.html.twig"; else $template = "show.html.twig";        

        if (!$entity) {
            throw ControllerException::NotFoundException('Corporation');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render("PiAppGedmoBundle:Corporation:$template", array(
            'entity'      => $entity,
            'NoLayout'	  => $NoLayout,
            'category'	  => $category,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to create a new Corporation entity.
     *
     * @Secure(roles="ROLE_USER")
	 * @return \Symfony\Component\HttpFoundation\Response
     *
	 * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>    
     */
    public function newAction()
    {
    	$em 		= $this->getDoctrine()->getEntityManager();
    	$entity 	= new Corporation();
        $form   	= $this->createForm(new CorporationType($em, $this->container), $entity, array('show_legend' => false));
        
        $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout)	$template = "new.html.twig";  else 	$template = "new.html.twig";   
        
         if($category)
        	$entity->setCategory($category);     

        return $this->render("PiAppGedmoBundle:Corporation:$template", array(
            'entity' 	=> $entity,
            'form'   	=> $form->createView(),
            'NoLayout'  => $NoLayout,
            'category'	=> $category,
        ));
    }

    /**
     * Creates a new Corporation entity.
     *
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     *
	 * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>     
     */
    public function createAction()
    {
        $em 		= $this->getDoctrine()->getEntityManager();
        $locale		= $this->container->get('session')->getLocale();
        
        $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout)	$template = "new.html.twig";  else 	$template = "new.html.twig";        
    
        $entity 	= new Corporation();
        $request 	= $this->getRequest();
        $form    	= $this->createForm(new CorporationType($em, $this->container), $entity, array('show_legend' => false));
        $form->bindRequest($request);

        if ($form->isValid()) {
            $entity->setTranslatableLocale($locale);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_gedmo_corporation_show', array('id' => $entity->getId(), 'NoLayout' => $NoLayout, 'category' => $category)));
                        
        }

        return $this->render("PiAppGedmoBundle:Corporation:$template", array(
            'entity' 	=> $entity,
            'form'   	=> $form->createView(),
            'NoLayout'  => $NoLayout,
            'category'	=> $category,
        ));
    }

    /**
     * Displays a form to edit an existing Corporation entity.
     *
     * @Secure(roles="ROLE_USER")
	 * @return \Symfony\Component\HttpFoundation\Response
     *
	 * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>    
     */
    public function editAction($id)
    {
        $em 		= $this->getDoctrine()->getEntityManager();
    	$locale		= $this->container->get('session')->getLocale();
        $entity 	= $em->getRepository("PiAppGedmoBundle:Corporation")->findOneByEntity($locale, $id, 'object');
        
        $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout)	$template = "edit.html.twig";  else	$template = "edit.html.twig";        

        if (!$entity) {
        	$entity = $em->getRepository("PiAppGedmoBundle:Corporation")->find($id);
        	$entity->addTranslation(new CorporationTranslation($locale));            
        }

        $editForm   = $this->createForm(new CorporationType($em, $this->container), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);

        return $this->render("PiAppGedmoBundle:Corporation:$template", array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'NoLayout' 	  => $NoLayout,
            'category'	  => $category,
        ));
    }

    /**
     * Edits an existing Corporation entity.
     *
     * @Secure(roles="ROLE_USER")
	 * @return \Symfony\Component\HttpFoundation\Response
     *
	 * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>   
     */
    public function updateAction($id)
    {
        $em 		= $this->getDoctrine()->getEntityManager();
    	$locale		= $this->container->get('session')->getLocale();
        $entity 	= $em->getRepository("PiAppGedmoBundle:Corporation")->findOneByEntity($locale, $id, "object"); 
        
        $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout)	$template = "edit.html.twig";  else	$template = "edit.html.twig";        

        if (!$entity) {
        	$entity = $em->getRepository("PiAppGedmoBundle:Corporation")->find($id);
        }

        $editForm   = $this->createForm(new CorporationType($em, $this->container), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);

        $editForm->bindRequest($this->getRequest(), $entity);
        if ($editForm->isValid()) {
            $entity->setTranslatableLocale($locale);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_gedmo_corporation_edit', array('id' => $id, 'NoLayout' => $NoLayout, 'category' => $category)));
        }

        return $this->render("PiAppGedmoBundle:Corporation:$template", array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'NoLayout' 	  => $NoLayout,
            'category'	  => $category,
        ));
    }

    /**
     * Deletes a Corporation entity.
     *
     * @Secure(roles="ROLE_USER")
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *     
	 * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>     
     */
    public function deleteAction($id)
    {
        $em 	 	= $this->getDoctrine()->getEntityManager();
	    $locale	 	= $this->container->get('session')->getLocale();
	    
	    $NoLayout   = $this->container->get('request')->query->get('NoLayout');	    
	    $category   = $this->container->get('request')->query->get('category');
    
        $form 	 	= $this->createDeleteForm($id);
        $request 	= $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
    	    $entity = $em->getRepository("PiAppGedmoBundle:Corporation")->findOneByEntity($locale, $id, 'object');

            if (!$entity) {
                throw ControllerException::NotFoundException('Corporation');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_gedmo_corporation', array('NoLayout' => $NoLayout, 'category' => $category)));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    /**
     * Template : Finds and displays a Corporation entity.
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
    		
    	$entity = $em->getRepository("PiAppGedmoBundle:Corporation")->findOneByEntity($lang, $id, 'object', false);
    	
    	if (!$entity) {
    		throw ControllerException::NotFoundException('Corporation');
    	}
    	
    	if(method_exists($entity, "getTemplate") && $entity->getTemplate() != "")
    		$template = $entity->getTemplate();     	
    
    	return $this->render("PiAppGedmoBundle:Corporation:$template", array(
    			'entity'	=> $entity,
    			'locale'	=> $lang,
    	));
    }

	/**
     * Template : Finds and displays a list of Corporation entity.
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
    		
    	if(method_exists($entity, "getTemplate") && $entity->getTemplate() != "")
    		$template = $entity->getTemplate();    		
    		
    	$query		= $em->getRepository("PiAppGedmoBundle:Corporation")->getAllByCategory($category, $MaxResults, $order)->getQuery();
        $entities   = $em->getRepository("PiAppGedmoBundle:Corporation")->findTranslationsByQuery($lang, $query, 'object', false);                   

        return $this->render("PiAppGedmoBundle:Corporation:$template", array(
            'entities' => $entities,
            'cat'	   => ucfirst($category),
        	'locale'   => $lang,
        ));
    }     
    
}