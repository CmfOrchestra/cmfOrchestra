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

use PiApp\GedmoBundle\Entity\Individual;
use PiApp\GedmoBundle\Form\IndividualType;
use PiApp\GedmoBundle\Form\InscriptionType;
use PiApp\GedmoBundle\Entity\Translation\IndividualTranslation;
use Symfony\Component\Form\FormError;
use BootStrap\UserBundle\Entity\User;
/**
 * Adherant Controller.
 *
 *
 * @category   PI_CRUD_Controllers
 * @package    Controller
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class AdherantController extends abstractController
{
	/**
     * Template : Finds and displays a list of Individual entity.
     * 
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access	public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com> 
     */
    public function _template_annuaireAction($MaxResults = null, $template = '_template_adherent_annuaire.html.twig', $order = 'DESC', $lang = "")
    {
    	$em 		= $this->getDoctrine()->getEntityManager();

    	if(empty($lang))
    		$lang	= $this->container->get('session')->getLocale();
    	
    	if(isset($_GET['type']) && !empty($_GET['type']))
    		$type	=	$_GET['type'];
    	else
    		$type = "person";
    	
    	if(isset($_GET['lettre']) && !empty($_GET['lettre']))
    		$lettre	=	$_GET['lettre'];
    	else
    		$lettre = "A";
    	
    	if(isset($_GET['filtre1']) && !empty($_GET['filtre1']))
    		$filtre1 =	$_GET['filtre1'];
    	else
    		$filtre1 = "";
    	
    	if(isset($_GET['filtre2']) && !empty($_GET['filtre2']))
    		$filtre2 =	$_GET['filtre2'];
    	else
    		$filtre2 = ""; 				
    	
    	if($type == "person"){
    		$query		= $em->getRepository("PiAppGedmoBundle:Individual")->getAllByCategory("", $MaxResults, $order);
    		$query->leftJoin('a.user', 'u')
    			  ->andWhere($query->expr()->like('LOWER(a.UserName)', $query->expr()->literal(strtolower($lettre).'%')))    			  
    			  ->andWhere($query->expr()->like('u.roles', $query->expr()->literal('%"ROLE_MEMBER"%')));
    		if(!empty($filtre1))
    			$query->andWhere($query->expr()->like('LOWER(a.Activity)', $query->expr()->literal(strtolower($filtre1).'%')));
    		if(!empty($filtre2))
    			$query->andWhere($query->expr()->like('LOWER(a.Engineering)', $query->expr()->literal(strtolower($filtre2).'%')));    		
    		$entities   = $em->getRepository("PiAppGedmoBundle:Individual")->findTranslationsByQuery($lang, $query->getQuery(), 'object', false);
    		
    		$Activities = $em->getRepository("PiAppGedmoBundle:Individual")->getArrayAllByField("Activity");
    		if(!isset($Activities) || !count($Activities))
    			$Activities = array();
    		$Engineering = $em->getRepository("PiAppGedmoBundle:Individual")->getArrayAllByField("Engineering");
    		if(!isset($Engineering) || !count($Engineering))
    			$Engineering = array();    
    	}elseif($type == "company"){
      		$query		= $em->getRepository("PiAppGedmoBundle:Corporation")->getAllByCategory("", $MaxResults, $order);
      		$query->andWhere($query->expr()->like('LOWER(a.UserName)', $query->expr()->literal(strtolower($lettre).'%')));
      		if(!empty($filtre1))
      			$query->andWhere($query->expr()->like('LOWER(a.Activity)', $query->expr()->literal(strtolower($filtre1).'%')));
      		if(!empty($filtre2))
      			$query->andWhere($query->expr()->like('LOWER(a.Engineering)', $query->expr()->literal(strtolower($filtre2).'%')));
     		$entities   = $em->getRepository("PiAppGedmoBundle:Corporation")->findTranslationsByQuery($lang, $query->getQuery(), 'object', false);
     		
     		$Activities = $em->getRepository("PiAppGedmoBundle:Corporation")->getArrayAllByField("Activity");
     		if(!isset($Activities) || !count($Activities))
     			$Activities = array();
     		$Engineering = $em->getRepository("PiAppGedmoBundle:Corporation")->getArrayAllByField("Engineering");
     		if(!isset($Engineering) || !count($Engineering))
     			$Engineering = array();     		
    	}     

    	$query2			= $em->getRepository("BootStrapUserBundle:User")->getAllByParams("", 4, 'DESC');
    	$query2->where($query->expr()->like('a.roles', $query2->expr()->literal('%"ROLE_MEMBER"%')));
    	$entities_last  = $em->getRepository("BootStrapUserBundle:User")->findTranslationsByQuery($lang, $query2->getQuery(), 'object', false);
    	
        return $this->render("PiAppGedmoBundle:Adherant:$template", array(
            'entities' 	=> $entities,
        	'locale'   	=> $lang,
        	'type'   	=> $type,
        	'lettre'   	=> $lettre,
        	'filtre1'   => $filtre1,
        	'filtre2'   => $filtre2,
        	'Activities'   => $Activities,
        	'Engineering'  => $Engineering,
        	'entities_last'	=> $entities_last        		
        ));
    }

    /**
     * Change the posistion of a entity .
     *
     * @Route("/adherant/detail/{lang}", name="admin_gedmo_adherent_detail_ajax")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access  public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function detailadherantajaxAction()
    {
    	$request = $this->container->get('request');
    	$em		 = $this->getDoctrine()->getEntityManager();
    
    	if($request->isXmlHttpRequest()){
    		$id_individual	= $request->get('id_individual', '');
    		$id_corporation	= $request->get('id_corporation', '');
    		$lang			= $request->get('lang', null);
    
    		if(!empty($id_individual)){
    			$entity = $em->getRepository("PiAppGedmoBundle:Individual")->find($id_individual);
    		}elseif(!empty($id_corporation)){
    			$entity = $em->getRepository("PiAppGedmoBundle:Corporation")->find($id_corporation);
    		}
    		
    		// we disable all flash message
    		$this->container->get('session')->setFlashes(array());
    		
    		return $this->render("PiAppGedmoBundle:Adherant:_template_adherant_detail.html.twig", array(
    				'entity' => $entity,
    				'locale' => $lang,
    		));    		
    	}else
    		throw ControllerException::callAjaxOnlySupported('detailtypoeventajax');
    }    
}