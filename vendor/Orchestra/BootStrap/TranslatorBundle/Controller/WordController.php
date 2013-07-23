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
use BootStrap\TranslatorBundle\Form\WordTranslateType;
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
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>   
     */
    public function indexAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $locale        = $this->container->get('request')->getLocale();
        $entities     = $em->getRepository("BootStrapTranslatorBundle:Word")->setContainer($this->container)->findAllByEntity($locale, 'object');        
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)     $template = "index.html.twig"; else $template = "index.html.twig";

        return $this->render("BootStrapTranslatorBundle:Word:$template", array(
            'entities' => $entities,
            'NoLayout'    => $NoLayout,
        ));
    }

    /**
     * Finds and displays a Word entity.
     *
     * @Secure(roles="IS_AUTHENTICATED_ANONYMOUSLY")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>    
     */
    public function showAction($id)
    {
        $em     = $this->getDoctrine()->getManager();
        $locale    = $this->container->get('request')->getLocale();
        $entity = $em->getRepository("BootStrapTranslatorBundle:Word")->findOneByEntity($locale, $id, 'object');
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)     $template = "show.html.twig"; else $template = "show.html.twig";        

        if (!$entity) {
            throw ControllerException::NotFoundException('Word');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render("BootStrapTranslatorBundle:Word:$template", array(
            'entity'      => $entity,
            'NoLayout'      => $NoLayout,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Word entity.
     *
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>    
     */
    public function newAction()
    {
        $em     = $this->getDoctrine()->getManager();
        $entity = new Word();
        $locale    = $this->container->get('request')->getLocale();
        $form   = $this->createForm(new WordType($em, $locale, $this->container), $entity, array('show_legend' => false));
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)    $template = "new.html.twig";  else     $template = "new.html.twig";        

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
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>     
     */
    public function createAction()
    {
        $em     = $this->getDoctrine()->getManager();
        $locale    = $this->container->get('request')->getLocale();
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)    $template = "new.html.twig";  else     $template = "new.html.twig";        
    
        $entity  = new Word();
        $request = $this->getRequest();
        $form    = $this->createForm(new WordType($em, $locale, $this->container), $entity, array('show_legend' => false));
        $form->bind($request);

        if ($form->isValid()) {
            $entity->setTranslatableLocale($locale);
            $em->persist($entity);
            $em->flush();

            $this->container->get("bootstrap_translator.translation_cache")->wordsTranslation();
            
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
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>    
     */
    public function editAction($id)
    {
        $em       = $this->getDoctrine()->getManager();
          $locale    = $this->container->get('request')->getLocale();
        $entity = $em->getRepository("BootStrapTranslatorBundle:Word")->findOneByEntity($locale, $id, 'object');
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)    $template = "edit.html.twig";  else    $template = "edit.html.twig";        

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
            'NoLayout'       => $NoLayout,
        ));
    }

    /**
     * Edits an existing Word entity.
     *
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>   
     */
    public function updateAction($id)
    {
        $em     = $this->getDoctrine()->getManager();
            $locale    = $this->container->get('request')->getLocale();
        $entity = $em->getRepository("BootStrapTranslatorBundle:Word")->findOneByEntity($locale, $id, "object"); 
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)    $template = "edit.html.twig";  else    $template = "edit.html.twig";        

        if (!$entity) {
            $entity = $em->getRepository("BootStrapTranslatorBundle:Word")->find($id);
        }

        $editForm   = $this->createForm(new WordType($em, $locale, $this->container), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);

        $editForm->bind($this->getRequest(), $entity);
        if ($editForm->isValid()) {
            $entity->setTranslatableLocale($locale);
            $em->persist($entity);
            $em->flush();
                        
            $this->container->get("bootstrap_translator.translation_cache")->wordsTranslation();
            
            return $this->redirect($this->generateUrl('admin_word_edit', array('id' => $id, 'NoLayout' => $NoLayout)));
        }

        return $this->render("BootStrapTranslatorBundle:Word:$template", array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'NoLayout'       => $NoLayout,
        ));
    }
    
    /**
     * Lists all Word entities.
     *
     * @Secure(roles="IS_AUTHENTICATED_ANONYMOUSLY")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>   
     */
    public function translateAction($id)
    {
        $em                 = $this->getDoctrine()->getManager();
        $locale                = $this->container->get('request')->getLocale();
        $NoLayout           = $this->container->get('request')->query->get('NoLayout');
        $entity             = $em->getRepository("BootStrapTranslatorBundle:Word")->findOneByEntity($locale, $id, 'object');
        $locales             = $em->getRepository("PiAppAdminBundle:Langue")->findAllByEntity($locale, 'object');        
        $translations         = $em->getRepository("BootStrapTranslatorBundle:Word")->getTranslationsByObjectId($id);

        $entities = array();
        foreach($locales as $lang){
            $langs[$lang->getId()] = $lang->getLabel();
        }
        foreach($translations as $trans){
            $entities[$trans->getLocale()] = $trans;
        }

        return $this->render("BootStrapTranslatorBundle:Word:translate.html.twig", array(
            'entities'     => $entities,
            'source'     =>$entity,
            'locale'    => $locale,
            'langs'     => $langs,
            'NoLayout'     => $NoLayout,
        ));
    }
    
    /**
     * Displays a form to edit an existing Word entity.
     *
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>    
     */
    public function editTranslateAction($id, $lang)
    {
        $em           = $this->getDoctrine()->getManager();
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        $entity     = $em->getRepository("BootStrapTranslatorBundle:Word")->findOneByEntity($lang, $id, 'object');
        
        if (!$entity) {
            $entity = $em->getRepository("BootStrapTranslatorBundle:Word")->find($id);
            $entity->addTranslation(new WordTranslation($lang));            
        }

        $editForm   = $this->createForm(new WordTranslateType($em, $lang, $this->container), $entity, array('show_legend' => false));

        return $this->render("BootStrapTranslatorBundle:Word:editTranslate.html.twig", array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'NoLayout'       => $NoLayout,         
            'lang'             => $lang,         
        ));
    }

    /**
     * Edits an existing Word entity.
     *
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>   
     */
    public function updateTranslateAction($id, $lang)
    {
        $em         = $this->getDoctrine()->getManager();
        $entity     = $em->getRepository("BootStrapTranslatorBundle:Word")->findOneByEntity($lang, $id, "object"); 
        $NoLayout     = $this->container->get('request')->query->get('NoLayout');

        if (!$entity) {
            $entity = $em->getRepository("BootStrapTranslatorBundle:Word")->find($id);
        }

        $editForm   = $this->createForm(new WordTranslateType($em, $lang, $this->container), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);
        
        $editForm->bind($this->getRequest(), $entity);
        if ($editForm->isValid()) {
            $entity->setTranslatableLocale($lang);
            $em->persist($entity);
            $em->flush();
                        
            $this->container->get("bootstrap_translator.translation_cache")->wordsTranslation();
            
            return $this->redirect($this->generateUrl('admin_word_edit_translate', array('id' => $id, 'lang' => $lang, 'NoLayout' => $NoLayout)));
        }

        return $this->render("BootStrapTranslatorBundle:Word:editTranslate.html.twig", array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'NoLayout'       => $NoLayout,
            'lang'             => $lang,              
        ));
    }

    /**
     * Deletes a Word entity.
     *
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *     
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>     
     */
    public function deleteAction($id)
    {
        $em      = $this->getDoctrine()->getManager();
        $locale     = $this->container->get('request')->getLocale();
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');        
    
        $form      = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

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
     * Sync word entity from file.
     * 
     * @Route("/bootstrap/translator/sync", name="bootstrap_translator_sync")
     * @Secure(roles="ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function syncAction()
    {
        $em         = $this->getDoctrine()->getManager();
    
        $locale    = $this->container->get('request')->getLocale();
        if(!$locale){
            $locale = $this->container->getParameter("locale");
        }
        $languages         = $entityManager->getRepository("PiAppAdminBundle:Langue")->findAllByEntity($locale, 'object', false);
        //Récupération des fichiers
        foreach($languages as $language){
            $basePath = $this->container->get('kernel')->getRootDir() . '/../' . $this->container->parameters["translations"]["file"];
            $filepath_messages = $basePath."messages.".$language->getId().".yml";
            $filepath_category = $basePath."category.".$language->getId().".yml";
            //Si le fichier existe, on part de lui
            if(file_exists($filepath_messages) && file_exists($filepath_category) ){
                $yaml = new \Symfony\Component\Yaml\Parser();
                $value_messages = $yaml->parse(file_get_contents($filepath_messages));
                $value_category = $yaml->parse(file_get_contents($filepath_category));
                ${"messages_".$langue} = $value_messages;
                ${"category_".$langue} = $value_category;
            } //Sinon on le recré depuis la bdd
        }
        //On vide la table
        $em->getConnection()->executeQuery('SET FOREIGN_KEY_CHECKS = 0;');
        $truncateSql = $em->getConnection()->getDatabasePlatform()->getTruncateTableSQL('pi_word');
        $em->getConnection()->executeUpdate($truncateSql);
        $truncateSqlTranslation = $em->getConnection()->getDatabasePlatform()->getTruncateTableSQL('pi_word_translations');
        $em->getConnection()->executeUpdate($truncateSqlTranslation);
        //On rerempli la table à partir des fichiers
        foreach(${"messages_".$locale} as $cle=>$valeur){
            $entity  = new Word();
            foreach($languages as $langue){
                $translate = new WordTranslation();
                $translate->setContent(${"messages_".$langue}[$cle]);
                $translate->setField('label');
                $translate->setCategory(${"category_".$langue}[$cle]);
                $translate->setLocale($langue);
                $entity->addTranslation($translate);
            }
            $entity->setkeyword($cle);
            $entity->setLabel($valeur);
            $entity->setCategory(${"category_".$locale}[$cle]);
            $em->persist($entity);
        }
        $em->flush();
        $this->container->get('request')->getSession()->getFlashBag()->set('success', 'pi.session.flash.right.update');
        
        return $this->redirect($this->generateUrl('admin_word'));
    }    
  
}
