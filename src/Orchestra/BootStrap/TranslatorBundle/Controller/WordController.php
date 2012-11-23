<?php
/**
 * This file is part of the <Translator> project.
 *
 * @category   Translator_Controllers
 * @package    Controller
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-11-14
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\TranslatorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BootStrap\TranslationBundle\Controller\abstractController;
use BootStrap\TranslatorBundle\Exception\ControllerException;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use JMS\SecurityExtraBundle\Annotation\Secure;

use BootStrap\TranslatorBundle\Entity\Word;
use BootStrap\TranslatorBundle\Form\WordType;
use BootStrap\TranslatorBundle\Entity\Translation\WordTranslation;

/**
 * Word controller.
 *
 *
 * @category   Translator_Controllers
 * @package    Controller
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class WordController extends abstractController
{
	protected $_entityName = "BootStrapTranslatorBundle:Word";

	/**
     * Enabled Word entities.
     *
     * @Route("/bootstrap/translator/enabled", name="bootstrap_translator_enabledentity_ajax")
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
     * Disable Word entities.
     * 
     * @Route("/bootstrap/translator/disable", name="bootstrap_translator_disablentity_ajax")
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
     * Change the position of a Word entity.
     *
     * @Route("/bootstrap/translator/position", name="bootstrap_translator_position_ajax")
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
     * Delete a Word entity.
     *
     * @Route("/bootstrap/translator/delete", name="bootstrap_translator_deletentity_ajax")
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
     * Lists all Word entities.
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
        $entities 	= $em->getRepository("BootStrapTranslatorBundle:Word")->findAllByEntity($locale, 'object');        
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout) 	$template = "index.html.twig"; else $template = "index.html.twig";

        return $this->render("BootStrapTranslatorBundle:Word:$template", array(
            'entities' => $entities,
            'NoLayout'	=> $NoLayout,
        ));
    }

    /**
     * Finds and displays a Word entity.
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
        $entity = $em->getRepository("BootStrapTranslatorBundle:Word")->findOneByEntity($locale, $id, 'object');
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout) 	$template = "show.html.twig"; else $template = "show.html.twig";        

        if (!$entity) {
            throw ControllerException::NotFoundException('Word');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render("BootStrapTranslatorBundle:Word:$template", array(
            'entity'      => $entity,
            'NoLayout'	  => $NoLayout,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Word entity.
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
    	$entity = new Word();
    	$locale	= $this->container->get('session')->getLocale();
        $form   = $this->createForm(new WordType($em, $locale, $this->container), $entity, array('show_legend' => false));
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout)	$template = "new.html.twig";  else 	$template = "new.html.twig";        

        return $this->render("BootStrapTranslatorBundle:Word:$template", array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'NoLayout'  => $NoLayout,
        ));
    }

    /**
     * Creates a new Word entity.
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
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout)	$template = "new.html.twig";  else 	$template = "new.html.twig";        
    
        $entity  = new Word();
        $request = $this->getRequest();
        $form    = $this->createForm(new WordType($em, $locale, $this->container), $entity, array('show_legend' => false));
        $form->bindRequest($request);

        if ($form->isValid()) {
            $entity->setTranslatableLocale($locale);
            $em->persist($entity);
            $em->flush();

            $this->_wordsTranslation();
            
            return $this->redirect($this->generateUrl('admin_word_show', array('id' => $entity->getId(), 'NoLayout' => $NoLayout)));
                        
        }

        return $this->render("BootStrapTranslatorBundle:Word:$template", array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'NoLayout'  => $NoLayout,
        ));
    }

    /**
     * Displays a form to edit an existing Word entity.
     *
     * @Secure(roles="ROLE_USER")
	 * @return \Symfony\Component\HttpFoundation\Response
     *
	 * @access	public
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>    
     */
    public function editAction($id)
    {
        $em 	  = $this->getDoctrine()->getEntityManager();
    	  $locale	= $this->container->get('session')->getLocale();
        $entity = $em->getRepository("BootStrapTranslatorBundle:Word")->findOneByEntity($locale, $id, 'object');
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout)	$template = "edit.html.twig";  else	$template = "edit.html.twig";        

        if (!$entity) {
        	$entity = $em->getRepository("BootStrapTranslatorBundle:Word")->find($id);
        	$entity->addTranslation(new WordTranslation($locale));            
        }

        $editForm   = $this->createForm(new WordType($em, $locale, $this->container), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);

        return $this->render("BootStrapTranslatorBundle:Word:$template", array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'NoLayout' 	  => $NoLayout,
        ));
    }

    /**
     * Edits an existing Word entity.
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
        $entity = $em->getRepository("BootStrapTranslatorBundle:Word")->findOneByEntity($locale, $id, "object"); 
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if(!$NoLayout)	$template = "edit.html.twig";  else	$template = "edit.html.twig";        

        if (!$entity) {
        	$entity = $em->getRepository("BootStrapTranslatorBundle:Word")->find($id);
        }

        $editForm   = $this->createForm(new WordType($em, $locale, $this->container), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);

        $editForm->bindRequest($this->getRequest(), $entity);
        if ($editForm->isValid()) {
            $entity->setTranslatableLocale($locale);
            $em->persist($entity);
            $em->flush();
						
            $this->_wordsTranslation();
            
            return $this->redirect($this->generateUrl('admin_word_edit', array('id' => $id, 'NoLayout' => $NoLayout)));
        }

        return $this->render("BootStrapTranslatorBundle:Word:$template", array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'NoLayout' 	  => $NoLayout,
        ));
    }

    /**
     * Deletes a Word entity.
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
    
        $form 	 = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
    	    $entity = $em->getRepository("BootStrapTranslatorBundle:Word")->findOneByEntity($locale, $id, 'object');

            if (!$entity) {
                throw ControllerException::NotFoundException('Word');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_word', array('NoLayout' => $NoLayout)));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    /**
     * Sets the specific sortOrders.
     *
     * @param EventArgs		$eventArgs
     * @access private
     * @return array
     *
     * @author (c) <riad hellal> <r.helal@novediagroup.com>
     */
    private function _wordsTranslation()
    {

    	$entityManager 	= $this->getDoctrine()->getEntityManager();
    	$locale	= $this->container->get('session')->getLocale();

    	$basePath 		= $this->container->getParameter("kernel.cache_dir"). '/../translation/';
    	$dir 			= \PiApp\AdminBundle\Util\PiFileManager::mkdirr($basePath);
    	$all_files 		= \PiApp\AdminBundle\Util\PiFileManager::getFilesByType($basePath, "yml");
    	$languages 		= $entityManager->getRepository("PiAppAdminBundle:Langue")->findAllByEntity($locale, 'object', false);
    	 
    	$array = array();
    	foreach($languages as $language){
    		$filename 	= $basePath."messages.".$language->getId().".yml";
    		$Words 		= $entityManager->getRepository("BootStrapTranslatorBundle:Word")->findAllByEntity($language->getId(), 'object', false);
    		foreach ($Words as $word){
    			$array["{$word->getKeyword()}"] = $word->translate($language->getId())->getLabel()? $word->translate($language->getId())->getLabel():' ';
    		}
    		$yaml = \Symfony\Component\Yaml\Yaml::dump($array, 2);
    		file_put_contents($filename, $yaml);
    	}
    }    
}
