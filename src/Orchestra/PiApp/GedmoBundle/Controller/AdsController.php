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

use PiApp\GedmoBundle\Entity\Ads;
use PiApp\GedmoBundle\Form\AdsType;
use PiApp\GedmoBundle\Entity\Translation\AdsTranslation;

/**
 * Ads controller.
 *
 *
 * @category   PI_CRUD_Controllers
 * @package    Controller
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class AdsController extends abstractController
{
	protected $_entityName = "PiAppGedmoBundle:Ads";

	/**
     * Enabled Ads entities.
     *
     * @Route("/admin/gedmo/ads/enabled", name="admin_gedmo_ads_enabledentity_ajax")
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
     * Disable Ads entities.
     * 
     * @Route("/admin/gedmo/ads/disable", name="admin_gedmo_ads_disablentity_ajax")
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
     * Change the position of a Ads entity.
     *
     * @Route("/admin/gedmo/ads/position", name="admin_gedmo_ads_position_ajax")
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
     * Delete a Ads entity.
     *
     * @Route("/admin/gedmo/ads/delete", name="admin_gedmo_ads_deletentity_ajax")
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
     * Lists all Ads entities.
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
    		$entities 	= $em->getRepository("PiAppGedmoBundle:Ads")->getAllEnableByCatAndByPosition($locale, $category, 'object');
    	else
    		$entities	= $em->getRepository("PiAppGedmoBundle:Ads")->findAllByEntity($locale, 'object');

        return $this->render("PiAppGedmoBundle:Ads:$template", array(
            'entities'	=> $entities,
            'NoLayout'	=> $NoLayout,
            'category'	=> $category,
        ));
    }

    /**
     * Finds and displays a Ads entity.
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
        $entity 	= $em->getRepository("PiAppGedmoBundle:Ads")->findOneByEntity($locale, $id, 'object');
        
        $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout) 	$template = "show.html.twig"; else $template = "show.html.twig";        

        if (!$entity) {
            throw ControllerException::NotFoundException('Ads');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render("PiAppGedmoBundle:Ads:$template", array(
            'entity'      => $entity,
            'NoLayout'	  => $NoLayout,
            'category'	  => $category,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to create a new Ads entity.
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
    	$entity 	= new Ads();
        $form   	= $this->createForm(new AdsType($em, $this->container), $entity, array('show_legend' => false));
        
        $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout)	$template = "new.html.twig";  else 	$template = "new.html.twig";   
        
         if($category)
        	$entity->setCategory($category);     

        return $this->render("PiAppGedmoBundle:Ads:$template", array(
            'entity' 	=> $entity,
            'form'   	=> $form->createView(),
            'NoLayout'  => $NoLayout,
            'category'	=> $category,
        ));
    }

    /**
     * Creates a new Ads entity.
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
    
        $entity 	= new Ads();
        $request 	= $this->getRequest();
        $form    	= $this->createForm(new AdsType($em, $this->container), $entity, array('show_legend' => false));
        $form->bindRequest($request);

        if ($form->isValid()) {
            $entity->setTranslatableLocale($locale);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_gedmo_ads_show', array('id' => $entity->getId(), 'NoLayout' => $NoLayout, 'category' => $category)));
                        
        }

        return $this->render("PiAppGedmoBundle:Ads:$template", array(
            'entity' 	=> $entity,
            'form'   	=> $form->createView(),
            'NoLayout'  => $NoLayout,
            'category'	=> $category,
        ));
    }

    /**
     * Displays a form to edit an existing Ads entity.
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
        $entity 	= $em->getRepository("PiAppGedmoBundle:Ads")->findOneByEntity($locale, $id, 'object');
        
        $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout)	$template = "edit.html.twig";  else	$template = "edit.html.twig";        

        if (!$entity) {
        	$entity = $em->getRepository("PiAppGedmoBundle:Ads")->find($id);
        	$entity->addTranslation(new AdsTranslation($locale));            
        }

        $editForm   = $this->createForm(new AdsType($em, $this->container), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);

        return $this->render("PiAppGedmoBundle:Ads:$template", array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'NoLayout' 	  => $NoLayout,
            'category'	  => $category,
        ));
    }

    /**
     * Edits an existing Ads entity.
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
        $entity 	= $em->getRepository("PiAppGedmoBundle:Ads")->findOneByEntity($locale, $id, "object"); 
        
        $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout)	$template = "edit.html.twig";  else	$template = "edit.html.twig";        

        if (!$entity) {
        	$entity = $em->getRepository("PiAppGedmoBundle:Ads")->find($id);
        }

        $editForm   = $this->createForm(new AdsType($em, $this->container), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);

        $editForm->bindRequest($this->getRequest(), $entity);
        if ($editForm->isValid()) {
            $entity->setTranslatableLocale($locale);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_gedmo_ads_edit', array('id' => $id, 'NoLayout' => $NoLayout, 'category' => $category)));
        }

        return $this->render("PiAppGedmoBundle:Ads:$template", array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'NoLayout' 	  => $NoLayout,
            'category'	  => $category,
        ));
    }

    /**
     * Deletes a Ads entity.
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
    	    $entity = $em->getRepository("PiAppGedmoBundle:Ads")->findOneByEntity($locale, $id, 'object');

            if (!$entity) {
                throw ControllerException::NotFoundException('Ads');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_gedmo_ads', array('NoLayout' => $NoLayout, 'category' => $category)));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    /**
     * Template : Finds and displays a Ads entity.
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
    		
    	$entity = $em->getRepository("PiAppGedmoBundle:Ads")->findOneByEntity($lang, $id, 'object', false);
    	
    	if (!$entity) {
    		throw ControllerException::NotFoundException('Ads');
    	}
    	
    	if(method_exists($entity, "getTemplate") && $entity->getTemplate() != "")
    		$template = $entity->getTemplate();     	
    
    	return $this->render("PiAppGedmoBundle:Ads:$template", array(
    			'entity'	=> $entity,
    			'locale'	=> $lang,
    	));
    }

	/**
     * Template : Finds and displays a list of Ads entity.
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
    		
    	$query		= $em->getRepository("PiAppGedmoBundle:Ads")->getAllByCategory($category, $MaxResults, $order)->getQuery();
        $entities   = $em->getRepository("PiAppGedmoBundle:Ads")->findTranslationsByQuery($lang, $query, 'object', false);                   

        return $this->render("PiAppGedmoBundle:Ads:$template", array(
            'entities' => $entities,
            'cat'	   => ucfirst($category),
        	'locale'   => $lang,
        ));
    }     
    
}