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
     * Archive a Corporation entity.
     *
     * @Route("/admin/gedmo/corporation/archive", name="admin_gedmo_corporation_archiveentity_ajax")
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
        
    	if($NoLayout && $category && !empty($category)){
    		//$entities 	= $em->getRepository("PiAppGedmoBundle:Corporation")->getAllEnableByCatAndByPosition($locale, $category, 'object');
    		$query		= $em->getRepository("PiAppGedmoBundle:Corporation")->getAllByCategory($category, null, "DESC", "", false)->getQuery();
    		$entities   = $em->getRepository("PiAppGedmoBundle:Corporation")->findTranslationsByQuery($locale, $query, 'object', false);
    	}else
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

        	try {
            	$em->remove($entity);
            	$em->flush();
            } catch (\Exception $e) {
            	$this->container->get('session')->setFlash('notice', 'pi.session.flash.right.undelete');
            }
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

        $entity   = new Corporation();
        
        if (true === $this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {        
            $connexion = $this->get('security.context')->getToken()->getUser();
            $user = $em->getRepository("BootStrapUserBundle:User")->findOneById($connexion->getId());

            if($user->getIndividual()){
              $entity->setName($user->getIndividual()->getName());
              $entity->setNickname($user->getIndividual()->getNickname());
              $entity->setEmail($user->getIndividual()->getEmail());
              $entity->setUserPhone($user->getIndividual()->getPhone());
              $entity->setJob($user->getIndividual()->getJob());
              $entity->setUserName($user->getIndividual()->getUserName());
            }
        }
        
        $form   	= $this->createForm(new AdhesionCorporationType($em, $this->container), $entity, array('show_legend' => false));
          
        $request = $_POST;
        
        if(isset($request['new']))
            $new   = $request['new'];
        else
            $new   = $this->container->get('request')->request->get('new');
        
        if(isset($request['step']))
            $step   = $request['step'];
        else
            $step   = $this->container->get('request')->request->get('step');        

        if(empty($lang))
          $lang	= $this->container->get('session')->getLocale();
        
        if(empty($step))
          $step	= 1;
        
        $params['step'] = $step;
        $params['type'] = $type;
        $params['template'] = $template;
        
    	  $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');

        $render = '';

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
                  $data['media'] = $request['media'];
                  
                  $request_form = $request[$form->getName()];
                  $data['CorporationName'] = $request_form['CorporationName'];
                  $data['CommercialName'] = $request_form['CommercialName'];
                  $data['Address'] = $request_form['Address'];
                  $data['CP'] = $request_form['CP'];
                  $data['City'] = $request_form['City'];
                  $data['Country'] = $request_form['Country'];
                  $data['Phone'] = $request_form['Phone'];
                  $data['Fax'] = $request_form['Fax'];
                  $data['InvoiceAddress'] = $request_form['InvoiceAddress'];
                  $data['InvoiceCP'] = $request_form['InvoiceCP'];
                  $data['InvoiceCity'] = $request_form['InvoiceCity'];
                  $data['InvoiceCountry'] = $request_form['InvoiceCountry'];
                  $data['InvoicePhone'] = $request_form['InvoicePhone'];
                  $data['InvoiceFax'] = $request_form['InvoiceFax'];
                  $data['MotherAddress'] = $request_form['MotherAddress'];
                  $data['MotherCP'] = $request_form['MotherCP'];
                  $data['MotherCity'] = $request_form['MotherCity'];
                  $data['MotherCountry'] = $request_form['MotherCountry'];
                  $data['MotherPhone'] = $request_form['MotherPhone'];
                  $data['MotherFax'] = $request_form['MotherFax'];    
                  $data['Activity'] = $request_form['Activity'];
                  $data['DetailActivity'] = $request_form['DetailActivity'];
                  $data['Engineering'] = $request_form['Engineering'];                
                  $data['EffectifNational'] = $request_form['EffectifNational'];
                  $data['EffectifRegional'] = $request_form['EffectifRegional'];
                  $data['LegalForm'] = $request_form['LegalForm'];
                  $data['CodeNAF'] = $request_form['CodeNAF'];
                  $data['CaNational'] = $request_form['CaNational'];
                  $data['Siret'] = $request_form['Siret'];                

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
                $data['media'] = $request['media'];
                
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
                $data['Engineering'] = $request['Engineering'];
                $data['Activity'] = $request['Activity'];
                $data['DetailActivity'] = $request['DetailActivity'];
                $data['EffectifNational'] = $request['EffectifNational'];
                $data['EffectifRegional'] = $request['EffectifRegional'];
                $data['LegalForm'] = $request['LegalForm'];                
                $data['CodeNAF'] = $request['CodeNAF'];
                $data['CaNational'] = $request['CaNational'];
                $data['Siret'] = $request['Siret'];
                  
                $request_form = $request[$form->getName()];
                $data['Facebook'] = $request_form['Facebook'];
                $data['GooglePlus'] = $request_form['GooglePlus'];
                $data['Twitter'] = $request_form['Twitter'];
                $data['LinkedIn'] = $request_form['LinkedIn'];
                $data['Viadeo'] = $request_form['Viadeo'];
                $data['ArgumentCommercial'] = $request_form['ArgumentCommercial'];
                $data['url'] = $request_form['url'];

                $media2_tmp = $_FILES[$form->getName()]['tmp_name']['media2'];
                $media2_name = $_FILES[$form->getName()]['name']['media2'];

                $dir = $this->container->get('kernel')->getRootDir(). '/../web/uploads/media/tmp/';
                move_uploaded_file($media2_tmp,$dir.$media2_name);
                $data['media2'] = $dir.$media2_name;  

                  $template = '_template_form_adhesion_step4.html.twig';
                  
                  $newsletters = $this->_get_newsletters_categories($lang, $user);
                  $commissions = $this->_get_commissions($lang); 
                  
                  return $this->render("PiAppGedmoBundle:Corporation:$template", array(
                      'entity'      => $entity,
                      'data'      => $data,
                      'form'        => $form->createView(),
                      'NoLayout'    => $NoLayout,
                      'category'    => $category,
                      'new'	=> '1',
                      'render'	=> '',
                      'newsletters'	=> $newsletters,
                      'commissions' => $commissions,
                  ));
              }              
              else {
                  $render = $this->container->get('http_kernel')->render('PiAppGedmoBundle:Corporation:_template_adhesionSave', array('attributes'=>$params));
              }
        }

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
      if (false === $this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {        
          $user_name  = $em->getRepository('BootStrapUserBundle:User')->findOneByName($form["UserName"]->getData());
          if($user_name != null){
            $form->addError(new FormError('error message : username already exists!'));
          }

          $user_email = $em->getRepository('BootStrapUserBundle:User')->findOneByEmail($form["Email"]->getData());

          if($user_email != null){
            $form->addError(new FormError('error message : email already exists!'));
          }
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
        $media_tmp = $_FILES[$form->getName()]['tmp_name']['media'];
        $media_name = $_FILES[$form->getName()]['name']['media'];
        $dir = $this->container->get('kernel')->getRootDir(). '/../web/uploads/media/tmp/';
        move_uploaded_file($media_tmp,$dir.$media_name);
        $data['media'] = $dir.$media_name;

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
          if (true === $this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {  
              $connexion = $this->get('security.context')->getToken()->getUser();
              $user = $em->getRepository("BootStrapUserBundle:User")->findOneById($connexion->getId());
              $password = $user->getPassword();
              $individual = $user->getIndividual();
              $em->remove($individual);
              $em->flush();
          }
          else{
              $password = \PiApp\AdminBundle\Util\PiStringManager::random(8);
              //$password = $request->get('UserName');
          }

          $user = new User();
          $user->setUsername($request->get('UserName'));
          $user->setName($request->get('Name'));
          $user->setNickname($request->get('Nickname'));            
          $user->getUsernameCanonical($request->get('UserName'));
          $user->setPlainPassword($password);
          $user->setEmail($request->get('Email'));
          $user->setEmailCanonical($request->get('Email'));
          $user->setEnabled(true);
          $user->setRoles(array('ROLE_MEMBER'));
          $user->setPermissions(array('VIEW', 'EDIT', 'CREATE', 'DELETE'));
          $user->setLangCode($em->getRepository('PiAppAdminBundle:Langue')->findOneById('fr_FR'));

          if(isset($_POST['newsletters']) && !empty($_POST['newsletters'])){
            $newsletters = $_POST['newsletters'];          
            foreach (array_keys($newsletters)  as $newsletter ) {
                $nl  = $em->getRepository('PiAppGedmoBundle:Newsletter')->findOneById($newsletter);
                $user->addNewsletter($nl);
            }
          }
          if(isset($_POST['commissions']) && !empty($_POST['commissions'])){
            $commissions = $_POST['commissions'];          
            foreach (array_keys($commissions)  as $commission ) {
                $com  = $em->getRepository('PiAppGedmoBundle:Lamelee\TypoCommission')->findOneById($commission);
                $user->addTypoCommission($com);
            }
          }
          $em->persist($user);
          $em->flush();
          
          $entity->setUser($user);   
          $entity->setTranslatableLocale($lang);
          $entity->setEmail($request->get('Email'));      
          $entity->setUserName($request->get('UserName'));
   
          $media_pixel = new \BootStrap\MediaBundle\Entity\Media();
          $media_pixel->setProviderName('sonata.media.provider.image');
          $media_pixel->setContext("default");  
          $media_pixel->setBinaryContent($request->get('media'));
          $em->persist($media_pixel);
          $em->flush();
          
          
          $media_gedmo = new \PiApp\GedmoBundle\Entity\Media();
          $media_gedmo->setImage($media_pixel);
          $media_gedmo->setStatus('image');
          $em->persist($media_gedmo);
          $em->flush();
          $entity->setMedia($media_gedmo);

          $media_pixel = new \BootStrap\MediaBundle\Entity\Media();
          $media_pixel->setProviderName('sonata.media.provider.image');
          $media_pixel->setContext("default");  
          $media_pixel->setBinaryContent($request->get('media2'));
          $em->persist($media_pixel);
          $em->flush();

          $media_gedmo = new \PiApp\GedmoBundle\Entity\Media();
          $media_gedmo->setImage($media_pixel);
          $media_gedmo->setStatus('image');
          $em->persist($media_gedmo);
          $em->flush();        
          $entity->setMedia2($media_gedmo);
        
          $entity->setTranslatableLocale($lang);
          
          $entity->setCivility($request->get('Civility'));
          $entity->setName($request->get('Name'));
          $entity->setNickname($request->get('Nickname'));
          $entity->setJob($request->get('Job'));
          $entity->setEmail($request->get('Email'));
          $entity->setEmailPerso($request->get('EmailPerso'));
          $entity->setUserPhone($request->get('UserPhone'));
          $entity->setProfile($request->get('Profile'));
          $entity->setUserName($request->get('UserName'));
          $entity->setEngineering($request->get('Engineering'));
          $entity->setActivity($request->get('Activity'));
          $entity->setDetailActivity($request->get('DetailActivity'));
          $entity->setCorporationName($request->get('CorporationName'));
          $entity->setCommercialName($request->get('CommercialName'));
          $entity->setAddress($request->get('Address'));
          $entity->setCP($request->get('CP'));
          $entity->setCity($request->get('City'));
          $entity->setCountry($request->get('Country')); 
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
          
          //send mail
          $templateFile = "PiAppGedmoBundle:Corporation:email_adhesion.html.twig";
          $templateContent = $this->get('twig')->loadTemplate($templateFile);
          $subject = ($templateContent->hasBlock("subject")
              ? $templateContent->renderBlock("subject", array(
              'form'	 => $entity, 
              'password'	 => $password,
              ))
              : "Default subject here");
          $body = ($templateContent->hasBlock("body")
              ? $templateContent->renderBlock("body", array(
              'form'	 => $entity, 
              'password'	 => $password,
              ))
              : "Default body here");   

          $this->get("pi_app_admin.mailer_manager")->send('mailinfo@lamelee.fr', $user->getEmail(), $subject, $body);
            
          return new Response('');
          
      }
          $newsletters = $this->_get_newsletters_categories($lang);
          $commissions = $this->_get_commissions($lang);
          
          return $this->render("PiAppGedmoBundle:Corporation:$template", array(
              'entity'      => $entity,
              'form'        => $form->createView(),
              'NoLayout'    => $NoLayout,
              'category'    => $category,
              'new'	=> 1,
              'render'	=> '',
              'categories' => $newsletters,
              'commissions' => $commissions,
          )); 
    }   

    private function _get_newsletters_categories($lang ='' ,$user ='') {
      $em        = $this->getDoctrine()->getEntityManager();
      if(empty($lang))
              $lang   = $this->container->get('session')->getLocale();
      
        $newsletters	= $em->getRepository("PiAppGedmoBundle:Newsletter")->findAllByEntity($lang, 'object'); 

        $categories = array();
        foreach ($newsletters as $newsletter) {
          $checked ='';
          if($user){
            if(in_array($user, $newsletter->getUsers()->toArray())){
              $checked ='checked';
            }
          }
          $categories[$newsletter->getCategory()->getPosition() ][] = array(
            $newsletter->getCategory()->translate($lang)->getName(),
            $newsletter->getId(),
            $newsletter->translate($lang)->getTitle(),
            $checked,
          );
        }
        ksort($categories);
        
        return $categories;
    }
    
    private function _get_commissions($lang ="") {
      $em        = $this->getDoctrine()->getEntityManager();
      if(empty($lang))
              $lang   = $this->container->get('session')->getLocale();
      
        $coms	= $em->getRepository("PiAppGedmoBundle:Lamelee\TypoCommission")->findAllByEntity($lang, 'object'); 

        foreach ($coms as $com) {
          $commissions[] = array(
            $com->getId(),
            $com->translate($lang)->getTitle()
          );
        }
        return $commissions;
    }    
}