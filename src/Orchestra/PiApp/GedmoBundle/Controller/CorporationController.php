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
use PiApp\GedmoBundle\Entity\Individual;
use PiApp\GedmoBundle\Form\CorporationType;
use PiApp\GedmoBundle\Form\AdhesionType;
use PiApp\GedmoBundle\Form\Adhesion\AdhesionCorporationType;
use PiApp\GedmoBundle\Entity\Translation\CorporationTranslation;
use Symfony\Component\Form\FormError;
use BootStrap\UserBundle\Entity\User;

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
    		
    	$query		= $em->getRepository("PiAppGedmoBundle:Corporation")->getAllByCategory($category, $MaxResults, $order)->getQuery();
        $entities   = $em->getRepository("PiAppGedmoBundle:Corporation")->findTranslationsByQuery($lang, $query, 'object', false);                   

        return $this->render("PiAppGedmoBundle:Corporation:$template", array(
            'entities' => $entities,
            'cat'	   => ucfirst($category),
        	'locale'   => $lang,
        ));
    }     
    
    /**
     * Template : adhesion of Corporation or Individual.
     *
     * @Cache(maxage="86400")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access	public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function _template_adhesionAction($template = '_template_form_adhesion_step1.html.twig', $lang = "", $type = 'lamelee')
    {

        $em 		= $this->getDoctrine()->getEntityManager();
        $request = $this->container->get('request')->get('GET');
        if(isset($request['new']))
            $new   = $request['new'];
        else
            $new   = $this->container->get('request')->query->get('new');
        
        if(isset($request['step']))
            $step   = $request['step'];
        else
            $step   = $this->container->get('request')->query->get('step');        
        //print_r($this->container->get('request'));
        if(empty($lang))
          $lang	= $this->container->get('session')->getLocale();
        
        if(empty($step))
          $step	= 1;
        
        $params['step'] = $step;
        $params['type'] = $type;
        $params['template'] = $template;
        
    	  $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        
        $entity   = new Corporation();

        $render = '';
        //print_r($new);print_r($step);exit;
        //
        if (!empty($new)){
              if($step == 1){
                $render = $this->container->get('http_kernel')->render('PiAppGedmoBundle:Corporation:_template_adhesionValidation', array('attributes'=>$params));
              
              }
              elseif($step==2){
                  
                  $data = array();
                  $data['Civility'] = $request['Civility'];
                  $data['Name'] = $request['Name'];
                  $data['Nickname'] = $request['Nickname'];
                  $data['Job'] = $request['Job'];
                  $data['Email'] = $request['Email'];
                  $data['EmailPerso'] = $request['EmailPerso'];
                  $data['UserPhone'] = $request['UserPhone'];
                  $data['Profile'] = $request['Profile'];
                  $data['UserName'] = $request['UserName'];  
                  //array_merge($data, $request['piapp_gedmobundle_adhesion_corporationtype']);

                  $data['CorporationName'] = $request['piapp_gedmobundle_adhesion_corporationtype']['CorporationName'];
                  $data['CommercialName'] = $request['piapp_gedmobundle_adhesion_corporationtype']['CommercialName'];
                  $data['Address'] = $request['piapp_gedmobundle_adhesion_corporationtype']['Address'];
                  $data['CP'] = $request['piapp_gedmobundle_adhesion_corporationtype']['CP'];
                  $data['City'] = $request['piapp_gedmobundle_adhesion_corporationtype']['City'];
                  $data['Country'] = $request['piapp_gedmobundle_adhesion_corporationtype']['Country'];
                  $data['Phone'] = $request['piapp_gedmobundle_adhesion_corporationtype']['Phone'];
                  $data['Fax'] = $request['piapp_gedmobundle_adhesion_corporationtype']['Fax'];
                  $data['InvoiceAddress'] = $request['piapp_gedmobundle_adhesion_corporationtype']['InvoiceAddress'];
                  $data['InvoiceCP'] = $request['piapp_gedmobundle_adhesion_corporationtype']['InvoiceCP'];
                  $data['InvoiceCity'] = $request['piapp_gedmobundle_adhesion_corporationtype']['InvoiceCity'];
                  $data['InvoiceCountry'] = $request['piapp_gedmobundle_adhesion_corporationtype']['InvoiceCountry'];
                  $data['InvoicePhone'] = $request['piapp_gedmobundle_adhesion_corporationtype']['InvoicePhone'];
                  $data['InvoiceFax'] = $request['piapp_gedmobundle_adhesion_corporationtype']['InvoiceFax'];
                  $data['MotherAddress'] = $request['piapp_gedmobundle_adhesion_corporationtype']['MotherAddress'];
                  $data['MotherCP'] = $request['piapp_gedmobundle_adhesion_corporationtype']['MotherCP'];
                  $data['MotherCity'] = $request['piapp_gedmobundle_adhesion_corporationtype']['MotherCity'];
                  $data['MotherCountry'] = $request['piapp_gedmobundle_adhesion_corporationtype']['MotherCountry'];
                  $data['MotherPhone'] = $request['piapp_gedmobundle_adhesion_corporationtype']['MotherPhone'];
                  $data['MotherFax'] = $request['piapp_gedmobundle_adhesion_corporationtype']['MotherFax'];                
                  $data['EffectifNational'] = $request['piapp_gedmobundle_adhesion_corporationtype']['EffectifNational'];
                  $data['EffectifRegional'] = $request['piapp_gedmobundle_adhesion_corporationtype']['EffectifRegional'];
                  $data['LegalForm'] = $request['piapp_gedmobundle_adhesion_corporationtype']['LegalForm'];
                  $data['CodeNAF'] = $request['piapp_gedmobundle_adhesion_corporationtype']['CodeNAF'];
                  $data['CaNational'] = $request['piapp_gedmobundle_adhesion_corporationtype']['CaNational'];
                  $data['Siret'] = $request['piapp_gedmobundle_adhesion_corporationtype']['Siret'];                

                  $entity->setUrl('Site Internet');                
                  
                  $form   	= $this->createForm(new AdhesionCorporationType($em, $this->container), $entity, array('show_legend' => false));

                  $template = '_template_form_adhesion_step3.html.twig';
                  
                  return $this->render("PiAppGedmoBundle:Corporation:$template", array(
                      'entity'      => $entity,
                      'data'      => $data,
                      'form'        => $form->createView(),
                      'NoLayout'    => $NoLayout,
                      'category'    => $category,
                      'new'	=> '1',
                      'render'	=> '',
                  ));
              }
              elseif($step==3){

                $data = array();
                $data['Civility'] = $request['Civility'];
                $data['Name'] = $request['Name'];
                $data['Nickname'] = $request['Nickname'];
                $data['Job'] = $request['Job'];
                $data['Email'] = $request['Email'];
                $data['EmailPerso'] = $request['EmailPerso'];
                $data['UserPhone'] = $request['UserPhone'];
                $data['Profile'] = $request['Profile'];
                $data['UserName'] = $request['UserName'];  

                $data['CorporationName'] = $request['CorporationName'];
                $data['CommercialName'] = $request['CommercialName'];
                $data['Address'] = $request['Address'];
                $data['CP'] = $request['CP'];
                $data['City'] = $request['City'];
                $data['Country'] = $request['Country'];
                $data['Phone'] = $request['Phone'];
                $data['Fax'] = $request['Fax'];
                $data['InvoiceAddress'] = $request['InvoiceAddress'];
                $data['InvoiceCP'] = $request['InvoiceCP'];
                $data['InvoiceCity'] = $request['InvoiceCity'];
                $data['InvoiceCountry'] = $request['InvoiceCountry'];
                $data['InvoicePhone'] = $request['InvoicePhone'];
                $data['InvoiceFax'] = $request['InvoiceFax'];
                $data['MotherAddress'] = $request['MotherAddress'];
                $data['MotherCP'] = $request['MotherCP'];
                $data['MotherCity'] = $request['MotherCity'];
                $data['MotherCountry'] = $request['MotherCountry'];
                $data['MotherPhone'] = $request['MotherPhone'];
                $data['MotherFax'] = $request['MotherFax'];                
                $data['EffectifNational'] = $request['EffectifNational'];
                $data['EffectifRegional'] = $request['EffectifRegional'];
                $data['LegalForm'] = $request['LegalForm'];
                 
                $data['Facebook'] = $request['piapp_gedmobundle_adhesion_corporationtype']['Facebook'];
                $data['GooglePlus'] = $request['piapp_gedmobundle_adhesion_corporationtype']['GooglePlus'];
                $data['Twitter'] = $request['piapp_gedmobundle_adhesion_corporationtype']['Twitter'];
                $data['LinkedIn'] = $request['piapp_gedmobundle_adhesion_corporationtype']['LinkedIn'];
                $data['Viadeo'] = $request['piapp_gedmobundle_adhesion_corporationtype']['Viadeo'];
                $data['ArgumentCommercial'] = $request['piapp_gedmobundle_adhesion_corporationtype']['ArgumentCommercial'];
                $data['url'] = $request['piapp_gedmobundle_adhesion_corporationtype']['url'];

                  $form   	= $this->createForm(new AdhesionCorporationType($em, $this->container), $entity, array('show_legend' => false));

                  $template = '_template_form_adhesion_step4.html.twig';
                  
                  return $this->render("PiAppGedmoBundle:Corporation:$template", array(
                      'entity'      => $entity,
                      'data'      => $data,
                      'form'        => $form->createView(),
                      'NoLayout'    => $NoLayout,
                      'category'    => $category,
                      'new'	=> '1',
                      'render'	=> '',
                  ));
              }              
              else {
                  $render = $this->container->get('http_kernel')->render('PiAppGedmoBundle:Corporation:_template_adhesionSave', array('attributes'=>$params));
              }
        }

        $entity->setName('Nom*');  
        $entity->setNickname('Prénom*');
        $entity->setUserName('Identifiant');
        $entity->setEmail('Email pro*');
        $entity->setEmailPerso('Email perso');       
        $entity->setUserPhone('Téléphone*');
        $entity->setJob('Fonction*');

        $form   	= $this->createForm(new AdhesionCorporationType($em, $this->container), $entity, array('show_legend' => false));

        return $this->render("PiAppGedmoBundle:Corporation:$template", array(
            'entity' 	=> $entity,
            'form'   	=> $form->createView(),
            'NoLayout'  => $NoLayout,
            'category'	=> $category,
            'new'	=> 1,
            'render'	=> $render,
        ));  
    }

    public function _template_adhesionValidationAction($template = '_template_form_adhesion_step1.html.twig', $lang = "", $type = 'lamelee', $step = 1)
    {

      $em        = $this->getDoctrine()->getEntityManager();
      $request   = $this->container->get('request');

      if(empty($lang))
              $lang   = $this->container->get('session')->getLocale();
       
      $category   = $this->container->get('request')->query->get('category');

      $NoLayout   = $this->container->get('request')->query->get('NoLayout');

      $entity   = new Corporation();

      $form     = $this->createForm(new AdhesionCorporationType($em, $this->container), $entity, array('show_legend' => false));

      $data = $request->get($form->getName(), array());
      $form->bind($data);

      $user_name  = $em->getRepository('BootStrapUserBundle:User')->findOneByName($form["UserName"]->getData());
      if($user_name != null){
        $form->addError(new FormError('error message : username already exists!'));
      }
      
      $user_email = $em->getRepository('BootStrapUserBundle:User')->findOneByEmail($form["Email"]->getData());

      if($user_email != null){
        $form->addError(new FormError('error message : email already exists!'));
      }

      if (!$form->hasErrors()) {

        $data = array();
        $data['Civility'] = $form['Civility']->getData();
        $data['Name'] = $form['Name']->getData();
        $data['Nickname'] = $form['Nickname']->getData();
        $data['Job'] = $form['Job']->getData();
        $data['Email'] = $form['Email']->getData();
        $data['EmailPerso'] = $form['EmailPerso']->getData();
        $data['UserPhone'] = $form['UserPhone']->getData();
        $data['Profile'] = $form['Profile']->getData();
        $data['UserName'] = $form['UserName']->getData();        

        $entity->setDetailActivity('Détails activité*');  
    
        $entity->setCorporationName('Raison sociale *');
        $entity->setCommercialName('Nom commercial *');
        $entity->setAddress('Adresse*');
        $entity->setCP('Code postal*');
        $entity->setCity('Ville*');
        $entity->setPhone('Téléphone*');
        $entity->setFax('Fax*');
        $entity->setInvoiceAddress('Adresse*');
        $entity->setInvoiceCP('Code postal*');
        $entity->setInvoiceCity('Ville*');
        $entity->setInvoicePhone('Téléphone*');
        $entity->setInvoiceFax('Fax*');
        $entity->setMotherAddress('Adresse*');
        $entity->setMotherCP('Code postal*');
        $entity->setMotherCity('Ville*');
        $entity->setMotherPhone('Téléphone*');
        $entity->setMotherFax('Fax*');
        $entity->setEffectifNational('Effectif national en cours *');
        $entity->setEffectifRegional('Effectif regional en cours *');
        $entity->setCodeNAF('Code NAF*');  
        $entity->setSiret('Siret*');  
        $entity->setCaNational('Ca National *');  

        $form   	= $this->createForm(new AdhesionCorporationType($em, $this->container), $entity, array('show_legend' => false));

        $template = '_template_form_adhesion_step2.html.twig';

        return $this->render("PiAppGedmoBundle:Corporation:$template", array(
            'entity'      => $entity,
            'data'      => $data,
            'form'        => $form->createView(),
            'NoLayout'    => $NoLayout,
            'category'    => $category,
            'new'	=> '1',
            'render'	=> '',
        ));
      }

      return $this->render("PiAppGedmoBundle:Corporation:$template", array(
              'entity'      => $entity,
              'form'        => $form->createView(),
              'NoLayout'    => $NoLayout,
              'category'    => $category,
              'new'	=> 1,
              'render'	=> '',
          )); 

    }   
    

    public function _template_adhesionSaveAction($template = '_template_form_adhesion_step4.html.twig', $lang = "", $type = 'lamelee', $step = 3)
    {
      $em        = $this->getDoctrine()->getEntityManager();
      $request   = $this->container->get('request');

      if(empty($lang))
              $lang   = $this->container->get('session')->getLocale();
       
      $category   = $this->container->get('request')->query->get('category');

      $NoLayout   = $this->container->get('request')->query->get('NoLayout');

      $entity   = new Corporation();

      $form     = $this->createForm(new AdhesionCorporationType($em, $this->container), $entity, array('show_legend' => false));

      $data = $request->get($form->getName(), array());
      $form->bind($data);

      if (!$form->hasErrors()) {
          $password = \PiApp\AdminBundle\Util\PiStringManager::random(8);

          $user = new User();
          $user->setUsername($request->get('UserName'));
          $user->getUsernameCanonical($password);
          $user->setPlainPassword($password);
          $user->setEmail($request->get('Email'));
          $user->setEmailCanonical($request->get('Email'));
          $user->setEnabled(true);
          $user->setRoles(array('ROLE_MEMBER'));
          $user->setPermissions(array('VIEW', 'EDIT', 'CREATE', 'DELETE'));

          $user->setLangCode($em->getRepository('PiAppAdminBundle:Langue')->findOneById('fr_FR'));

          $em->persist($user);
          $em->flush();	          

          $entity->setTranslatableLocale($lang);
          $entity->setUser($user);
          $entity->setCivility($request->get('Civility'));
          $entity->setName($request->get('Name'));
          $entity->setNickname($request->get('Nickname'));
          $entity->setJob($request->get('Job'));
          $entity->setEmail($request->get('Email'));
          $entity->setEmailPerso($request->get('EmailPerso'));
          $entity->setUserPhone($request->get('UserPhone'));
          $entity->setProfile($request->get('Profile'));
          $entity->setUserName($request->get('UserName'));
          $entity->setDetailActivity($request->get('Engineering'));
          $entity->setDetailActivity($request->get('Activity'));
          $entity->setDetailActivity($request->get('DetailActivity'));
          $entity->setCorporationName($request->get('CorporationName'));
          $entity->setCommercialName($request->get('CommercialName'));
          $entity->setAddress($request->get('Address'));
          $entity->setCP($request->get('CP'));
          $entity->setCity($request->get('City'));
          $entity->setInvoiceCountry($request->get('InvoiceCountry'));              
          $entity->setPhone($request->get('Phone'));
          $entity->setFax($request->get('Fax'));
          $entity->setInvoiceAddress($request->get('InvoiceAddress'));
          $entity->setInvoiceCP($request->get('InvoiceCP'));
          $entity->setInvoiceCity($request->get('InvoiceCity'));
          $entity->setInvoiceCountry($request->get('InvoiceCountry'));            
          $entity->setInvoicePhone($request->get('InvoicePhone'));
          $entity->setInvoiceFax($request->get('InvoiceFax'));
          $entity->setMotherAddress($request->get('MotherAddress'));
          $entity->setMotherCP($request->get('MotherCP'));
          $entity->setMotherCity($request->get('MotherCity'));
          $entity->setMotherCountry($request->get('MotherCountry'));              
          $entity->setMotherPhone($request->get('MotherPhone'));
          $entity->setMotherFax($request->get('MotherFax'));
          $entity->setEffectifNational($request->get('EffectifNational'));
          $entity->setEffectifRegional($request->get('EffectifRegional'));                   
          $entity->setLegalForm($request->get('LegalForm'));
          $entity->setCodeNAF($request->get('CodeNAF'));  
          $entity->setSiret($request->get('Siret'));  
          $entity->setCaNational($request->get('CaNational')); 
          $entity->setArgumentCommercial($request->get('ArgumentCommercial'));          
          $entity->setFacebook($request->get('Facebook'));
          $entity->setGooglePlus($request->get('GooglePlus'));
          $entity->setTwitter($request->get('Twitter'));
          $entity->setLinkedIn($request->get('LinkedIn'));
          $entity->setViadeo($request->get('Viadeo')); 
          $entity->setUrl($request->get('url'));    
          $entity->setExpertise($form['Expertise']->getData());
          $entity->setSpeaker($form['Speaker']->getData());
          $entity->setOriginContact($form['OriginContact']->getData());            
          $entity->setOriginContactOther($form['OriginContactOther']->getData());
          $entity->setOriginContactSponsor($form['OriginContactSponsor']->getData());           
          $em->persist($entity);
          $em->flush();

          $flash = $this->get('translator')
                         ->trans('adhesion.flash.user_created',
                                  array('%email%' => $request->get('Email')));

          $this->get('session')->setFlash('success', $flash);
            
          return new Response('');
          
      }
          return $this->render("PiAppGedmoBundle:Corporation:$template", array(
              'entity'      => $entity,
              'form'        => $form->createView(),
              'NoLayout'    => $NoLayout,
              'category'    => $category,
              'new'	=> 1,
              'render'	=> '',
          )); 
    }   
    
    private function _send_mail($from, $to, $subject, $body) {
        $mail = \Swift_Message::newInstance();
     
        $mail
            ->setTo($to)
            ->setFrom($from)
            ->setSubject($subject)           
            ->setBody($body);

        $this->get('mailer')->send($mail);
    }
      
}