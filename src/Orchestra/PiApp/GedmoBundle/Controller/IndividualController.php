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
use PiApp\GedmoBundle\Form\Adhesion\AdhesionIndividualType as InscriptionType;
use PiApp\GedmoBundle\Form\Adhesion\AdhesionIndividualType;
use PiApp\GedmoBundle\Entity\Translation\IndividualTranslation;
use Symfony\Component\Form\FormError;
use BootStrap\UserBundle\Entity\User;
/**
 * Individual controller.
 *
 *
 * @category   PI_CRUD_Controllers
 * @package    Controller
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class IndividualController extends abstractController
{
	protected $_entityName = "PiAppGedmoBundle:Individual";

	/**
     * Enabled Individual entities.
     *
     * @Route("/admin/gedmo/individual/enabled", name="admin_gedmo_individual_enabledentity_ajax")
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
     * Disable Individual entities.
     * 
     * @Route("/admin/gedmo/individual/disable", name="admin_gedmo_individual_disablentity_ajax")
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
     * Change the position of a Individual entity.
     *
     * @Route("/admin/gedmo/individual/position", name="admin_gedmo_individual_position_ajax")
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
     * Delete a Individual entity.
     *
     * @Route("/admin/gedmo/individual/delete", name="admin_gedmo_individual_deletentity_ajax")
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
     * Lists all Individual entities.
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
    		//$entities 	= $em->getRepository("PiAppGedmoBundle:Individual")->getAllEnableByCatAndByPosition($locale, $category, 'object');
    		$query		= $em->getRepository("PiAppGedmoBundle:Individual")->getAllByCategory($category, null, '', 'ASC', false)->getQuery();
    		$entities   = $em->getRepository("PiAppGedmoBundle:Individual")->findTranslationsByQuery($locale, $query, 'object', false);
    	}else
    		$entities	= $em->getRepository("PiAppGedmoBundle:Individual")->findAllByEntity($locale, 'object');    	

        return $this->render("PiAppGedmoBundle:Individual:$template", array(
            'entities'	=> $entities,
            'NoLayout'	=> $NoLayout,
            'category'	=> $category,
        ));
    }

    /**
     * Finds and displays a Individual entity.
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
        $entity 	= $em->getRepository("PiAppGedmoBundle:Individual")->findOneByEntity($locale, $id, 'object');
        
        $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout) 	$template = "show.html.twig"; else $template = "show.html.twig";        

        if (!$entity) {
            throw ControllerException::NotFoundException('Individual');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render("PiAppGedmoBundle:Individual:$template", array(
            'entity'      => $entity,
            'NoLayout'	  => $NoLayout,
            'category'	  => $category,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to create a new Individual entity.
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
    	  $entity 	= new Individual();
        $form   	= $this->createForm(new IndividualType($em, $this->container), $entity, array('show_legend' => false));
        
        $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout)	$template = "new.html.twig";  else 	$template = "new.html.twig";   
        
        if($category)
        	$entity->setCategory($category);     

        return $this->render("PiAppGedmoBundle:Individual:$template", array(
            'entity' 	=> $entity,
            'form'   	=> $form->createView(),
            'NoLayout'  => $NoLayout,
            'category'	=> $category,
        ));
    }

    /**
     * Creates a new Individual entity.
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
    
        $entity 	= new Individual();
        $request 	= $this->getRequest();
        $form    	= $this->createForm(new IndividualType($em, $this->container), $entity, array('show_legend' => false));
        $form->bindRequest($request);

        if ($form->isValid()) {
            $entity->setTranslatableLocale($locale);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_gedmo_individual_show', array('id' => $entity->getId(), 'NoLayout' => $NoLayout, 'category' => $category)));
                        
        }

        return $this->render("PiAppGedmoBundle:Individual:$template", array(
            'entity' 	=> $entity,
            'form'   	=> $form->createView(),
            'NoLayout'  => $NoLayout,
            'category'	=> $category,
        ));
    }

    /**
     * Displays a form to edit an existing Individual entity.
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
        $entity 	= $em->getRepository("PiAppGedmoBundle:Individual")->findOneByEntity($locale, $id, 'object');
        
        $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout)	$template = "edit.html.twig";  else	$template = "edit.html.twig";        

        if (!$entity) {
        	$entity = $em->getRepository("PiAppGedmoBundle:Individual")->find($id);
        	$entity->addTranslation(new IndividualTranslation($locale));            
        }

        $editForm   = $this->createForm(new IndividualType($em, $this->container), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);

        return $this->render("PiAppGedmoBundle:Individual:$template", array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'NoLayout' 	  => $NoLayout,
            'category'	  => $category,
        ));
    }

    /**
     * Edits an existing Individual entity.
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
        $entity 	= $em->getRepository("PiAppGedmoBundle:Individual")->findOneByEntity($locale, $id, "object"); 
        
        $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout)	$template = "edit.html.twig";  else	$template = "edit.html.twig";        

        if (!$entity) {
        	$entity = $em->getRepository("PiAppGedmoBundle:Individual")->find($id);
        }

        $editForm   = $this->createForm(new IndividualType($em, $this->container), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);

        $editForm->bindRequest($this->getRequest(), $entity);
        if ($editForm->isValid()) {
            $entity->setTranslatableLocale($locale);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_gedmo_individual_edit', array('id' => $id, 'NoLayout' => $NoLayout, 'category' => $category)));
        }

        return $this->render("PiAppGedmoBundle:Individual:$template", array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'NoLayout' 	  => $NoLayout,
            'category'	  => $category,
        ));
    }

    /**
     * Deletes a Individual entity.
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
    	    $entity = $em->getRepository("PiAppGedmoBundle:Individual")->findOneByEntity($locale, $id, 'object');

            if (!$entity) {
                throw ControllerException::NotFoundException('Individual');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_gedmo_individual', array('NoLayout' => $NoLayout, 'category' => $category)));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    /**
     * Template : Finds and displays a Individual entity.
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
    		
    	$entity = $em->getRepository("PiAppGedmoBundle:Individual")->findOneByEntity($lang, $id, 'object', false);
    	
    	if (!$entity) {
    		throw ControllerException::NotFoundException('Individual');
    	}
    	
    	if(method_exists($entity, "getTemplate") && $entity->getTemplate() != "")
    		$template = $entity->getTemplate();     	
    
    	return $this->render("PiAppGedmoBundle:Individual:$template", array(
    			'entity'	=> $entity,
    			'locale'	=> $lang,
    	));
    }

	/**
     * Template : Finds and displays a list of Individual entity.
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
    		
    	$query		= $em->getRepository("PiAppGedmoBundle:Individual")->getAllByCategory($category, $MaxResults, $order)->getQuery();
      	$entities   = $em->getRepository("PiAppGedmoBundle:Individual")->findTranslationsByQuery($lang, $query, 'object', false);                   

        return $this->render("PiAppGedmoBundle:Individual:$template", array(
            'entities' => $entities,
            'cat'	   => ucfirst($category),
        	'locale'   => $lang,
        ));
    }     
    
    /**
     * Template : Finds and displays a Individual entity.
     *
     * @Cache(maxage="86400")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access	public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function _template_inscriptionAction($template = '_template_form_inscription.html.twig', $lang = "", $type = 'lamelee')
    {
        $em 		= $this->getDoctrine()->getEntityManager();
        $new   = $this->container->get('request')->get('new');

        if(empty($lang))
          $lang	= $this->container->get('session')->getLocale();
        $params['type'] = $type;
        $params['template'] = $template;
    	  $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        $entity 	= new Individual();
        $render = '';
        if (!empty($new)){
            $render = $this->container->get('http_kernel')->render('PiAppGedmoBundle:Individual:_template_inscriptionValidation', array('attributes'=>$params));
        }
        
        $entity->setName('Nom*');  
        $entity->setNickname('Prénom*');
        $entity->setJob('Fonction*');        
        $entity->setCompany('Société*');         
        $entity->setEmail('Email pro*');
        $entity->setPhone('Téléphone*');
        $entity->setUrl('site Web');
        $entity->setUserName('Identifiant');
        $form   	= $this->createForm(new InscriptionType($em, $this->container), $entity, array('show_legend' => false));

        return $this->render("PiAppGedmoBundle:Individual:$template", array(
            'entity' 	=> $entity,
            'form'   	=> $form->createView(),
            'NoLayout'  => $NoLayout,
            'category'	=> $category,
            'new'	=> 1,
            'render'	=> $render,
        ));  
    }
    
    public function _template_inscriptionValidationAction($template = '_template_form_inscription.html.twig', $lang = "", $type = 'lamelee')
    {
	      $em               = $this->getDoctrine()->getEntityManager();
	      $request   = $this->container->get('request');
	
	      if(empty($lang))
	              $lang   = $this->container->get('session')->getLocale();
	       
	      $category   = $this->container->get('request')->query->get('category');
	
	      $NoLayout   = $this->container->get('request')->query->get('NoLayout');
	      $entity   = new Individual();
	
	      $form     = $this->createForm(new InscriptionType($em, $this->container), $entity, array('show_legend' => false));
	
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
	
	      if ($form->isValid()) {
	          $password = \PiApp\AdminBundle\Util\PiStringManager::random(8);
	
	          $user = new User();
	          $user->setUsername($form["UserName"]->getData());
	          $user->getUsernameCanonical($password);
	          $user->setPlainPassword($password);
	          $user->setEmail($form["Email"]->getData());
	          $user->setEmailCanonical($form["Email"]->getData());
	          $user->setEnabled(true);
	          $user->setRoles(array('ROLE_SUBSCRIBER'));
	          $user->setPermissions(array('VIEW', 'EDIT', 'CREATE', 'DELETE'));
	
	          $user->addGroupUser($em->getRepository('BootStrapUserBundle:Group')->findOneByName('Groupe User'));
	          $user->setLangCode($em->getRepository('PiAppAdminBundle:Langue')->findOneById('fr_FR'));
	
	          $em->persist($user);
	          $em->flush();	          
	
	          $entity->setTranslatableLocale($lang);
	          $entity->setUser($user);
	
	          $em->persist($entity);
	          $em->flush();
	          
	          $flash = $this->get('translator')
	                         ->trans('Abonnement.flash.user_created',
	                                  array('%email%' => $form["Email"]->getData()));
	                      
	          $this->get('session')->setFlash('success', $flash);
	          
	          //send mail
	          $templateFile = "PiAppGedmoBundle:Individual:email_subscribe_".$type.".html.twig";
	          $templateContent = $this->get('twig')->loadTemplate($templateFile);
	          
	          $subject = ($templateContent->hasBlock("subject")
	              ? $templateContent->renderBlock("subject", array(
	              'confirmationUrl' =>  $user->getConfirmationToken(),
	              'password' => $password,
	              'form'	 => $data
	              ))
	              : "Default subject here");
	          $body = ($templateContent->hasBlock("body")
	              ? $templateContent->renderBlock("body", array(
	              'confirmationUrl' =>  $user->getConfirmationToken(),
	              'password' => $password,
	              'form'	 => $data
	              ))
	              : "Default body here");  
	
	          $this->_send_mail('inscription@lamelee.fr', $user->getEmail(), $subject, $body);
	        
	          return new Response('');
	      }
	      
          return $this->render("PiAppGedmoBundle:Individual:$template", array(
              'entity'      => $entity,
              'form'        => $form->createView(),
              'NoLayout'    => $NoLayout,
              'category'    => $category,
              'new'	=> 1,
              'render'	=> '',
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
             
        if(empty($lang))
          $lang	= $this->container->get('session')->getLocale();
        
        if(empty($step))
          $step	= 1;
       
        $params['step'] = $step;
        $params['type'] = $type;
        $params['template'] = $template;
        
    	  $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        
        $entity   = new Individual();

        $render = '';
        
        //
        if (!empty($new)){
              if($step == 1){
                $render = $this->container->get('http_kernel')->render('PiAppGedmoBundle:Individual:_template_adhesionValidation', array('attributes'=>$params));
              }
              elseif($step==2){

                $data = array();
                $data['Civility'] = $request['Civility'];
                $data['Name'] = $request['Name'];
                $data['Nickname'] = $request['Nickname'];
                $data['Job'] = $request['Job'];
                $data['Email'] = $request['Email'];
                $data['EmailPerso'] = $request['EmailPerso'];
                $data['Phone'] = $request['Phone'];
                $data['Profile'] = $request['Profile'];
                $data['ProfileOther'] = $request['ProfileOther'];
                $data['UserName'] = $request['UserName'];  
                $data['Facebook'] = $request['piapp_gedmobundle_adhesion_individualtype']['Facebook'];
                $data['GooglePlus'] = $request['piapp_gedmobundle_adhesion_individualtype']['GooglePlus'];
                $data['Twitter'] = $request['piapp_gedmobundle_adhesion_individualtype']['Twitter'];
                $data['LinkedIn'] = $request['piapp_gedmobundle_adhesion_individualtype']['LinkedIn'];
                $data['Viadeo'] = $request['piapp_gedmobundle_adhesion_individualtype']['Viadeo'];
                $data['DetailActivity'] = $request['piapp_gedmobundle_adhesion_individualtype']['DetailActivity'];
                $data['ArgumentActivity'] = $request['piapp_gedmobundle_adhesion_individualtype']['ArgumentActivity'];
                $data['url'] = $request['piapp_gedmobundle_adhesion_individualtype']['url'];
                $media_tmp = $_FILES['piapp_gedmobundle_adhesion_individualtype']['tmp_name']['media'];
                $media_name = $_FILES['piapp_gedmobundle_adhesion_individualtype']['name']['media'];
                $dir = $this->container->get('kernel')->getRootDir(). '/../web/uploads/media/tmp/';
                move_uploaded_file($media_tmp,$dir.$media_name);
                $data['media'] = $dir.$media_name;

                  $form   	= $this->createForm(new AdhesionIndividualType($em, $this->container), $entity, array('show_legend' => false));

                  $template = '_template_form_adhesion_step3.html.twig';
                  
                  return $this->render("PiAppGedmoBundle:Individual:$template", array(
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
                  $render = $this->container->get('http_kernel')->render('PiAppGedmoBundle:Individual:_template_adhesionSave', array('attributes'=>$params));
              }
        }

        $form   	= $this->createForm(new AdhesionIndividualType($em, $this->container), $entity, array('show_legend' => false));

        return $this->render("PiAppGedmoBundle:Individual:$template", array(
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

      $entity   = new Individual();

      $form     = $this->createForm(new AdhesionIndividualType($em, $this->container), $entity, array('show_legend' => false));

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
        $data['Phone'] = $form['Phone']->getData();
        $data['Profile'] = $form['Profile']->getData();
        $data['ProfileOther'] = $form['ProfileOther']->getData();
        $data['UserName'] = $form['UserName']->getData();  

        $form   	= $this->createForm(new AdhesionIndividualType($em, $this->container), $entity, array('show_legend' => false));

        $template = '_template_form_adhesion_step2.html.twig';

        return $this->render("PiAppGedmoBundle:Individual:$template", array(
            'entity'      => $entity,
            'data'      => $data,
            'form'        => $form->createView(),
            'NoLayout'    => $NoLayout,
            'category'    => $category,
            'new'	=> '1',
            'render'	=> '',
        ));
      }

      return $this->render("PiAppGedmoBundle:Individual:$template", array(
              'entity'      => $entity,
              'form'        => $form->createView(),
              'NoLayout'    => $NoLayout,
              'category'    => $category,
              'new'	=> 1,
              'render'	=> '',
          )); 

    }   
    

    public function _template_adhesionSaveAction($template = '_template_form_adhesion_step3.html.twig', $lang = "", $type = 'lamelee', $step = 3)
    {
      $em        = $this->getDoctrine()->getEntityManager();
      $request   = $this->container->get('request');

      if(empty($lang))
              $lang   = $this->container->get('session')->getLocale();
       
      $category   = $this->container->get('request')->query->get('category');

      $NoLayout   = $this->container->get('request')->query->get('NoLayout');

      $entity   = new Individual();

      $form     = $this->createForm(new AdhesionIndividualType($em, $this->container), $entity, array('show_legend' => false));

      $data = $request->get($form->getName(), array());
      $form->bind($data);

      if (!$form->hasErrors()) {
	          $password = \PiApp\AdminBundle\Util\PiStringManager::random(8);

	          $user = new User();
	          $user->setUsername($request->get('UserName'));
            $user->setName($request->get('Name'));
            $user->setNickname($request->get('Nickname'));            
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
            $entity->setUser($user);
        
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
        
	          $entity->setTranslatableLocale($lang);
            $entity->setCivility($request->get('Civility'));
            $entity->setName($request->get('Name'));
            $entity->setNickname($request->get('Nickname'));
            $entity->setJob($request->get('Job'));
            $entity->setEmail($request->get('Email'));
            $entity->setEmailPerso($request->get('EmailPerso'));
            $entity->setPhone($request->get('Phone'));
            $entity->setProfile($request->get('Profile'));
            $entity->setProfileOther($request->get('ProfileOther'));
            $entity->setUserName($request->get('UserName'));
            $entity->setFacebook($request->get('Facebook'));
            $entity->setGooglePlus($request->get('GooglePlus'));
            $entity->setTwitter($request->get('Twitter'));
            $entity->setLinkedIn($request->get('LinkedIn'));
            $entity->setViadeo($request->get('Viadeo'));
            $entity->setDetailActivity($request->get('Engineering'));
            $entity->setDetailActivity($request->get('Activity'));
            $entity->setDetailActivity($request->get('DetailActivity'));
            $entity->setArgumentActivity($request->get('ArgumentActivity'));
            $entity->setUrl($request->get('url'));            
            $entity->setExpertise($form['Expertise']->getData());
            $entity->setSpeaker($form['Speaker']->getData());
            $entity->setOriginContact($form['OriginContact']->getData());            
            $entity->setOriginContactOther($form['OriginContactOther']->getData());
            $entity->setOriginContactSponsor($form['OriginContactSponsor']->getData());            
	          $em->persist($entity);
	          $em->flush();
	          
            //clear tmp media files 
            $this->_clear_media_tmp();
            
	          $flash = $this->get('translator')
	                         ->trans('adhesion.flash.user_created',
	                                  array('%email%' => $request->get('Email')));
	                      
	          $this->get('session')->setFlash('success', $flash);
          return new Response('');
          
      }
          return $this->render("PiAppGedmoBundle:Individual:$template", array(
              'entity'      => $entity,
              'form'        => $form->createView(),
              'NoLayout'    => $NoLayout,
              'category'    => $category,
              'new'	=> 1,
              'render'	=> '',
          )); 
    }   
    
    private function _send_mail($from, $to, $subject, $body) {
    	try {
    		$mail = \Swift_Message::newInstance();
    		$mail
    		->setTo($to)
    		->setFrom($from)
    		->setSubject($subject)
    		->setBody($body,'text/html');
    		
    		return $this->get('mailer')->send($mail);
    	} catch (\Exception $e) {
    		return false;
    	}
        
    }
    
    private function _clear_media_tmp() {
    	try {
        $path = $this->container->get('kernel')->getRootDir(). '/../web/uploads/media/tmp';
        $all_files = \PiApp\AdminBundle\Util\PiFileManager::ListFiles($path);
        foreach ($all_files as $filename ) {
                if(filemtime($filename) < time() - 60 * 60 * 24)
                  unlink ($filename);
        }        

    	} catch (\Exception $e) {
    		return false;
    	}
        
    }
}