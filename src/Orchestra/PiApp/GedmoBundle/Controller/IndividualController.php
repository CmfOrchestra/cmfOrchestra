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
        
        if($NoLayout && $category && !empty($category))
    		$entities 	= $em->getRepository("PiAppGedmoBundle:Individual")->getAllEnableByCatAndByPosition($locale, $category, 'object');
    	else
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
        
        $entity->setInscrName('Nom*');  
        $entity->setInscrNickname('Prénom*');
        $entity->setInscrUserName('Identifiant');
        $entity->setInscrEmail('Email pro*');
        $entity->setInscrCp('Code postal');
        $entity->setInscrPhone('Téléphone');
        $entity->setEntrActivity('Activité*');
        $entity->setInscrJob('Fonction*');
        $entity->setEntrCompany('Société*');
        $entity->setEntrStaff('Effectif*');
        $entity->setUrl('Site web'); 

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
    
    private function _template_inscriptionValidationAction($template = '_template_form_inscription.html.twig', $lang = "", $type = 'lamelee')
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
	
	      $user_name  = $em->getRepository('BootStrapUserBundle:User')->findOneByName($form["InscrUserName"]->getData());
	      if($user_name != null){
	        $form->addError(new FormError('error message : username already exists!'));
	      }
	      $user_email = $em->getRepository('BootStrapUserBundle:User')->findOneByEmail($form["InscrEmail"]->getData());
	
	      if($user_email != null){
	        $form->addError(new FormError('error message : email already exists!'));
	      }
	
	      if ($form->isValid()) {
	          $password = \PiApp\AdminBundle\Util\PiStringManager::random(8);
	
	          $user = new User();
	          $user->setUsername($form["InscrUserName"]->getData());
	          $user->getUsernameCanonical($password);
	          $user->setPlainPassword($password);
	          $user->setEmail($form["InscrEmail"]->getData());
	          $user->setEmailCanonical($form["InscrEmail"]->getData());
	          $user->setEnabled(false);
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
	                                  array('%email%' => $form["InscrEmail"]->getData()));
	                      
	          $this->get('session')->setFlash('success', $flash);
	          
	          //send mail
	          $templateFile = "PiAppGedmoBundle:Individual:email_subscribe_".$type.".html.twig";
	          $templateContent = $this->get('twig')->loadTemplate($templateFile);
	
	          $subject = ($templateContent->hasBlock("subject")
	              ? $templateContent->renderBlock("subject", array(
	              'confirmationUrl' =>  $user->getConfirmationToken(),
	              'password' => $password
	              ))
	              : "Default subject here");
	          $body = ($templateContent->hasBlock("body")
	              ? $templateContent->renderBlock("body", array(
	              'confirmationUrl' =>  $user->getConfirmationToken(),
	              'password' => $password
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