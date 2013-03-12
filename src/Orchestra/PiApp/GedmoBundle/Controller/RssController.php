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

use PiApp\GedmoBundle\Entity\Rss;
use PiApp\GedmoBundle\Form\RssType;
use PiApp\GedmoBundle\Entity\Translation\RssTranslation;

/**
 * Rss controller.
 *
 *
 * @category   PI_CRUD_Controllers
 * @package    Controller
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class RssController extends abstractController
{
	protected $_entityName = "PiAppGedmoBundle:Rss";

	/**
     * Enabled Rss entities.
     *
     * @Route("/admin/gedmo/rss/enabled", name="admin_gedmo_rss_enabledentity_ajax")
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
     * Disable Rss entities.
     * 
     * @Route("/admin/gedmo/rss/disable", name="admin_gedmo_rss_disablentity_ajax")
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
     * Change the position of a Rss entity.
     *
     * @Route("/admin/gedmo/rss/position", name="admin_gedmo_rss_position_ajax")
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
     * Delete a Rss entity.
     *
     * @Route("/admin/gedmo/rss/delete", name="admin_gedmo_rss_deletentity_ajax")
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
     * Archive a Rss entity.
     *
     * @Route("/admin/gedmo/rss/archive", name="admin_gedmo_rss_archiveentity_ajax")
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
     * Lists all Rss entities.
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
        
    	if($NoLayout){
    		//$entities 	= $em->getRepository("PiAppGedmoBundle:Rss")->getAllEnableByCatAndByPosition($locale, $category, 'object');
    		$query		= $em->getRepository("PiAppGedmoBundle:Rss")->getAllByCategory($category, null, '', 'ASC', false)->getQuery();
    		$entities   = $em->getRepository("PiAppGedmoBundle:Rss")->findTranslationsByQuery($locale, $query, 'object', false);
    	}else
    		$entities	= $em->getRepository("PiAppGedmoBundle:Rss")->findAllByEntity($locale, 'object');    	

        return $this->render("PiAppGedmoBundle:Rss:$template", array(
            'entities'	=> $entities,
            'NoLayout'	=> $NoLayout,
            'category'	=> $category,
        ));
    }

    /**
     * Finds and displays a Rss entity.
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
        $entity 	= $em->getRepository("PiAppGedmoBundle:Rss")->findOneByEntity($locale, $id, 'object');
        
        $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout) 	$template = "show.html.twig"; else $template = "show.html.twig";        

        if (!$entity) {
            throw ControllerException::NotFoundException('Rss');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render("PiAppGedmoBundle:Rss:$template", array(
            'entity'      => $entity,
            'NoLayout'	  => $NoLayout,
            'category'	  => $category,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to create a new Rss entity.
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
    	$entity 	= new Rss();
        $form   	= $this->createForm(new RssType($em, $this->container), $entity, array('show_legend' => false));
        
        $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout)	$template = "new.html.twig";  else 	$template = "new.html.twig";   
        
        $entity_cat = $em->getRepository("PiAppGedmoBundle:Category")->find($category);
        if( !empty($category) && ($entity_cat instanceof \PiApp\GedmoBundle\Entity\Category))
        	$entity->setCategory($entity_cat);
        elseif(!empty($category))
        	$entity->setCategory($category);  

        return $this->render("PiAppGedmoBundle:Rss:$template", array(
            'entity' 	=> $entity,
            'form'   	=> $form->createView(),
            'NoLayout'  => $NoLayout,
            'category'	=> $category,
        ));
    }

    /**
     * Creates a new Rss entity.
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
    
        $entity 	= new Rss();
        $request 	= $this->getRequest();
        $form    	= $this->createForm(new RssType($em, $this->container), $entity, array('show_legend' => false));
        $form->bindRequest($request);

        if ($form->isValid()) {
            $entity->setTranslatableLocale($locale);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_gedmo_rss_show', array('id' => $entity->getId(), 'NoLayout' => $NoLayout, 'category' => $category)));
                        
        }

        return $this->render("PiAppGedmoBundle:Rss:$template", array(
            'entity' 	=> $entity,
            'form'   	=> $form->createView(),
            'NoLayout'  => $NoLayout,
            'category'	=> $category,
        ));
    }

    /**
     * Displays a form to edit an existing Rss entity.
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
        $entity 	= $em->getRepository("PiAppGedmoBundle:Rss")->findOneByEntity($locale, $id, 'object');
        
        $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout)	$template = "edit.html.twig";  else	$template = "edit.html.twig";        

        if (!$entity) {
        	$entity = $em->getRepository("PiAppGedmoBundle:Rss")->find($id);
        	$entity->addTranslation(new RssTranslation($locale));            
        }

        $editForm   = $this->createForm(new RssType($em, $this->container), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);

        return $this->render("PiAppGedmoBundle:Rss:$template", array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'NoLayout' 	  => $NoLayout,
            'category'	  => $category,
        ));
    }

    /**
     * Edits an existing Rss entity.
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
        $entity 	= $em->getRepository("PiAppGedmoBundle:Rss")->findOneByEntity($locale, $id, "object"); 
        
        $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout)	$template = "edit.html.twig";  else	$template = "edit.html.twig";        

        if (!$entity) {
        	$entity = $em->getRepository("PiAppGedmoBundle:Rss")->find($id);
        }

        $editForm   = $this->createForm(new RssType($em, $this->container), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);

        $editForm->bindRequest($this->getRequest(), $entity);
        if ($editForm->isValid()) {
            $entity->setTranslatableLocale($locale);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_gedmo_rss_edit', array('id' => $id, 'NoLayout' => $NoLayout, 'category' => $category)));
        }

        return $this->render("PiAppGedmoBundle:Rss:$template", array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'NoLayout' 	  => $NoLayout,
            'category'	  => $category,
        ));
    }

    /**
     * Deletes a Rss entity.
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
    	    $entity = $em->getRepository("PiAppGedmoBundle:Rss")->findOneByEntity($locale, $id, 'object');

            if (!$entity) {
                throw ControllerException::NotFoundException('Rss');
            }

        	try {
            	$em->remove($entity);
            	$em->flush();
            } catch (\Exception $e) {
            	$this->container->get('session')->setFlash('notice', 'pi.session.flash.right.undelete');
            }
        }

        return $this->redirect($this->generateUrl('admin_gedmo_rss', array('NoLayout' => $NoLayout, 'category' => $category)));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    /**
     * Template : Finds and displays a Rss entity.
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
    		
    	$entity = $em->getRepository("PiAppGedmoBundle:Rss")->findOneByEntity($lang, $id, 'object', false);
    	
    	if (!$entity) {
    		throw ControllerException::NotFoundException('Rss');
    	}
    	
    	if(method_exists($entity, "getTemplate") && $entity->getTemplate() != "")
    		$template = $entity->getTemplate();     	
    
    	return $this->render("PiAppGedmoBundle:Rss:$template", array(
    			'entity'	=> $entity,
    			'locale'	=> $lang,
    	));
    }

	/**
     * Template : Finds and displays a list of Rss entity.
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
    		
    	$query		= $em->getRepository("PiAppGedmoBundle:Rss")->getAllByCategory($category, $MaxResults, $order)->getQuery();
        $entities   = $em->getRepository("PiAppGedmoBundle:Rss")->findTranslationsByQuery($lang, $query, 'object', false);                   

        return $this->render("PiAppGedmoBundle:Rss:$template", array(
            'entities' => $entities,
            'cat'	   => ucfirst($category),
        	'locale'   => $lang,
        ));
    }     

    /**
     * Template : Finds and displays feeds.
	 * 
	 * @Route("/feeds", name="gedmo_lamelee_feeds")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access	public
     * @author Riad HELLAL <r.hellal@novediagroup.com>
     */
	
	public function feedAction($type='', $value='', $maxResult = 10, $locale = '')
	{
		$em = $this->getDoctrine()->getEntityManager();
    	if(empty($locale))
    		$locale	= $this->container->get('session')->getLocale();
    	
    	$type		= $_GET['type'];
		if(isset($_GET['value']))
			$value	= $_GET['value'];

		$last_date ='';
		
		$query = $em->getRepository('PiAppGedmoBundle:Lamelee\Article')->createQueryBuilder('a')
			->setFirstResult(0);
		if($type == 'typomidenews' or $type == 'mid'){
			if($type == 'typomidenews'){
				$query->leftJoin('a.typomidenews', 't')
				->where("t.id = :typomidenewsID")
				->setParameter('typomidenewsID', $value);

				$feed_title = $em->getRepository("PiAppGedmoBundle:Lamelee\TypoMideNews")->findOneByEntity($locale, $value, 'object', false)->getTitle();
			}	
			elseif($type == 'mid'){
				$query->leftJoin('a.typomidenews', 't')
				->where("a.typomidenews IS NOT NULL");

				$feed_title = "MID e-news";	
			}
			
			$query->andWhere("a.enabled = 1")
			  ->setMaxResults($maxResult)
			  ->orderBy('a.published_at', 'DESC');

			$output	= $em->getRepository("PiAppGedmoBundle:Lamelee\Article")->findTranslationsByQuery($locale, $query->getQuery(), 'object', false);

			foreach ($output as $entity) {
				$last_date = $entity->getPublishedAt();
				break;
			}
			$template = '_template_midenews_rss.atom.twig';
		}
		else{
			$entities_event = array();
			if($type == 'typothematic'){
				$feed_title = $em->getRepository("PiAppGedmoBundle:Lamelee\TypoThematic")->findOneByEntity($locale, $value, 'object', false)->getTitle();
			}
			elseif($type == 'lamelee'){
				$feed_title = 'Lamelee';
			}
			elseif ($type == 'typocommission') {
				$feed_title = $em->getRepository("PiAppGedmoBundle:Lamelee\TypoCommission")->findOneByEntity($locale, $value, 'object', false)->getTitle();
			}
			
			$template = '_template_lamelee_rss_thematic.atom.twig';
			
			$query_thematics	   = $em->getRepository("PiAppGedmoBundle:Lamelee\TypoThematic")->getAllByCategory("", null, '', 'ASC', true, false)->getQuery();
			$entities_thematics    = $em->getRepository("PiAppGedmoBundle:Lamelee\TypoThematic")->findTranslationsByQuery($locale, $query_thematics, 'object', false);   
			
			$request_article   = $this->request("Article", $value);
    		$request_resource  = $this->request("Resource", $value);
    		if ($type != 'typocommission'){
				$request_event     = $this->request("Event", $value);
				$entities_event	   = $em->getRepository("PiAppGedmoBundle:Lamelee\Event")->findTranslationsByQuery($locale, $request_event->getQuery(), 'object', false);
			}
    		$entities_article  = $em->getRepository("PiAppGedmoBundle:Lamelee\Article")->findTranslationsByQuery($locale, $request_article->getQuery(), 'object', false);
    		$entities_resource = $em->getRepository("PiAppGedmoBundle:Lamelee\Resource")->findTranslationsByQuery($locale, $request_resource->getQuery(), 'object', false);
    		
    		$entities		   = array_merge($entities_article, $entities_event, $entities_resource);
			
			$results = array();
			$publish = array();

			if(count($entities) >= 1){
				foreach($entities as $key => $result){
					$results[$key]['title'] 	 	= "";
					$results[$key]['descriptif']	= "";
					$results[$key]['image']			= "";
					$results[$key]['author']		= "Lamelee";

					$results[$key]['id']		= $result->translate($locale)->getId();

					if(method_exists($result, 'getTitle'))
						$results[$key]['title']		= $result->translate($locale)->getTitle();

					if(method_exists($result, 'getDescriptif'))
						$results[$key]['descriptif']= $result->translate($locale)->getDescriptif();
					elseif(method_exists($result, 'getContent1'))
						$results[$key]['descriptif']	= $result->translate($locale)->getContent1();

					if(method_exists($result, 'getAuthor'))
						$results[$key]['author']= $result->translate($locale)->getAuthor();

					$results[$key]['publishedat']	= $result->getPublishedAt();
					$results[$key]['tri'] 			= $result->getPublishedAt()->getTimestamp();
					$results[$key]['url']			= "#";

					if($result instanceof \PiApp\GedmoBundle\Entity\Lamelee\Article){
						if($result->getTypomidenews() instanceof \PiApp\GedmoBundle\Entity\Lamelee\TypoMideNews){
							$results[$key]['url']	= $this->container->get('bootstrap.RouteTranslator.factory')->getRoute("page_midenews_article", array("locale"=>$locale, "slug"=>$result->translate($locale)->getSlug(), "thema"=>$result->getTypomidenews()->getTitle()));
						}elseif(($result->getTypocommission() instanceof \PiApp\GedmoBundle\Entity\Lamelee\TypoCommission) && ($result->getTypocommission()->getTypothematic() instanceof \PiApp\GedmoBundle\Entity\Lamelee\TypoThematic)){
							$results[$key]['url']	= $this->container->get('bootstrap.RouteTranslator.factory')->getRoute("page_lamelee_menuwrapper_thematic_article", array("locale"=>$locale, "slug"=>$result->getSlug(), "thema"=>$result->getTypocommission()->getTypothematic()->getTitle()));
						}else{
							$thema = current($entities_thematics);
							$results[$key]['url']	= $this->container->get('bootstrap.RouteTranslator.factory')->getRoute("page_lamelee_menuwrapper_thematic_article", array("locale"=>$locale, "slug"=>$result->translate($locale)->getSlug(), "thema"=>$thema->getTitle()));
						}
					}elseif($result instanceof \PiApp\GedmoBundle\Entity\Lamelee\Event){
						$results[$key]['url']		= $this->container->get('bootstrap.RouteTranslator.factory')->getRoute("page_lamelee_menuwrapper_evenements_detail", array("locale"=>$locale, "slug"=>$result->translate($locale)->getSlug()));
					}elseif($result instanceof \PiApp\GedmoBundle\Entity\Lamelee\Resource){
						if(($result->getMedia() instanceof \PiApp\GedmoBundle\Entity\Media) && ($result->getMedia()->getImage() instanceof \BootStrap\MediaBundle\Entity\Media)){
							$results[$key]['url']	= $this->container->get('sonata.media.twig.extension')->path($result->getMedia()->getImage()->getId(), 'reference');
						}else{
							$results[$key]['url']	= "#";
						}
					}

					if(($result->getMedia() instanceof \PiApp\GedmoBundle\Entity\Media) && ($result->getMedia()->getImage() instanceof \BootStrap\MediaBundle\Entity\Media) && ($result->getMedia()->getStatus() == 'image')){
						$results[$key]['image']	= $this->container->get('sonata.media.twig.extension')->path($result->getMedia()->getImage()->getId(), 'reference');
					}					
				}
    		 }

			if(count($results) >= 1){
				foreach($results as $key => $result){
					$publish[$key]  = $result['tri'];
				}
				array_multisort($publish, SORT_DESC, $results);
				$output = array_slice($results, 0, $maxResult);;
			}else
				$output = null;			
			

			if(count($output) >= 1){
				foreach ($output as $entity) {
					$last_date = $entity['publishedat'];
					break;
				}
			}
    	}

		return $this->render("PiAppGedmoBundle:Rss:$template", array(
			'entities' => $output,
			'locale' => $locale,
			'value' => $value,
			'type' => $type,
			'title' => $feed_title,
			'lastUpdated' => $last_date,
			'feedId' => sha1($this->get('router')->generate('gedmo_lamelee_feeds', array('type'=> $type,'value'=> $value), true)),
		));
	}
	
    /**
     * Create the request of search
     *
     * @return array
     *
     * @access	private
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    private function request($entity, $typothematic)
    {
    	$em 		= $this->getDoctrine()->getEntityManager();

		$query	= $em->getRepository("PiAppGedmoBundle:Lamelee\\".$entity)->createQueryBuilder('a')->select('a');
		$query->orderBy('a.published_at', 'DESC');

		$query->andWhere('a.enabled = 1');

		if(!empty($typothematic)){
			$query
			->leftJoin('a.typothematics', 't')
			->andWhere("t.id = :typothematicsID")
			->setParameter('typothematicsID', $typothematic);
		}

    	return $query;
    }	
}