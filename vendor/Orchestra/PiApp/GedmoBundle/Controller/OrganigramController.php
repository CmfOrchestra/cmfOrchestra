<?php
/**
 * This file is part of the <PI_CRUD> project.
 *
 * @category   PI_CRUD_Controllers
 * @package    Controller
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-04-03
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

use PiApp\GedmoBundle\Entity\Organigram;
use PiApp\GedmoBundle\Form\OrganigramType;
use PiApp\GedmoBundle\Form\CategorySearchForm;
use PiApp\GedmoBundle\Entity\Translation\OrganigramTranslation;

/**
 * Organigram controller.
 *
 *
 * @category   PI_CRUD_Controllers
 * @package    Controller
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class OrganigramController extends abstractController
{
    public $_entityName = "PiAppGedmoBundle:Organigram";
    
    /**
     * Lists all Organigram entities.
     *
     * @Secure(roles="IS_AUTHENTICATED_ANONYMOUSLY")
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>   
     */
    public function indexAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $locale        = $this->container->get('request')->getLocale();
        $entities     = $em->getRepository("PiAppGedmoBundle:Organigram")->getAllTree($locale);    

        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)     $template = "index.html.twig"; else $template = "index_ajax.html.twig";

        return $this->render("PiAppGedmoBundle:Organigram:$template", array(
            'entities' => $entities,
            'NoLayout'      => $NoLayout,
        ));
    }
    
    /**
     * Enabled Organigram entities.
     *
     * @Route("/admin/gedmo/organigram/enabled", name="admin_gedmo_organigram_enabledentity_ajax")
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
     * Disable Organigram  entities.
     *
     * @Route("/admin/gedmo/organigram/disable", name="admin_gedmo_organigram_disablentity_ajax")
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
     * Position Organigram entities.
     *
     * @Route("/admin/gedmo/organigram/position", name="admin_gedmo_organigram_position_ajax")
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
     * Delete Organigram entities.
     *
     * @Route("/admin/gedmo/organigram/delete", name="admin_gedmo_organigram_deletentity_ajax")
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
     * Archive a Organigram entity.
     *
     * @Route("/admin/gedmo/organigram/archive", name="admin_gedmo_organigram_archiveentity_ajax")
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
     * Finds and displays a Organigram entity.
     *
     * @Secure(roles="IS_AUTHENTICATED_ANONYMOUSLY")
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>    
     */
    public function showAction($id)
    {
        $em     = $this->getDoctrine()->getManager();
        $locale    = $this->container->get('request')->getLocale();
        $entity = $em->getRepository("PiAppGedmoBundle:Organigram")->findNodeOr404($id, $locale);
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)
            $template = "show.html.twig";
        else
            $template = "show_ajax.html.twig";        

        if (!$entity) {
            throw ControllerException::NotFoundException('Organigram');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render("PiAppGedmoBundle:Organigram:$template", array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'NoLayout'       => $NoLayout,
        ));
    }

    /**
     * Displays a form to create a new Organigram entity.
     *
     * @Secure(roles="ROLE_USER")
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>    
     */
    public function newAction()
    {
        $em     = $this->getDoctrine()->getManager();
        $locale    = $this->container->get('request')->getLocale();
        $entity = new Organigram();
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)    $template = "new.html.twig";  else     $template = "new_ajax.html.twig";    

        $category   = $this->container->get('request')->query->get('category');
        if ($category)
            $entity->setCategory($category);
        
        $parent_id   = $this->container->get('request')->query->get('parent');
        if ($parent_id){
            $parent = $em->getRepository("PiAppGedmoBundle:Organigram")->findNodeOr404($parent_id, $locale);
            $entity->setParent($parent);
        }      

        $form   = $this->createForm(new OrganigramType($this->container, $em), $entity, array('show_legend' => false));
        return $this->render("PiAppGedmoBundle:Organigram:$template", array(
            'entity'     => $entity,
            'form'       => $form->createView(),
            'NoLayout'  => $NoLayout,
        ));
    }

    /**
     * Creates a new Organigram entity.
     *
     * @Secure(roles="ROLE_USER")
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>     
     */
    public function createAction()
    {
        $em     = $this->getDoctrine()->getManager();
        $locale    = $this->container->get('request')->getLocale();

        $category   = $this->container->get('request')->query->get('category');
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)
            $template = "new.html.twig";
        else
            $template = "new_ajax.html.twig";     
    
        $entity  = new Organigram();
        $request = $this->getRequest();
        $form    = $this->createForm(new OrganigramType($this->container, $em), $entity, array('show_legend' => false));
        $form->bind($request);

        if ($form->isValid()) {
            $entity->setTranslatableLocale($locale);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_gedmo_organigram_show', array('id' => $entity->getId(), 'NoLayout' => $NoLayout)));
        }

        return $this->render("PiAppGedmoBundle:Organigram:$template", array(
            'entity'     => $entity,
            'form'       => $form->createView(),
            'NoLayout'  => $NoLayout,
        ));
    }

    /**
     * Displays a form to edit an existing Organigram entity.
     *
     * @Secure(roles="ROLE_USER")
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>    
     */
    public function editAction($id)
    {
        $em     = $this->getDoctrine()->getManager();
        $locale    = $this->container->get('request')->getLocale();
        $entity = $em->getRepository("PiAppGedmoBundle:Organigram")->findNodeOr404($id, $locale, 'object');

        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)
            $template = "edit.html.twig";
        else
            $template = "edit_ajax.html.twig";
        
        if (!$entity) {
            $entity = $em->getRepository("PiAppGedmoBundle:Organigram")->find($id);
            $entity->addTranslation(new OrganigramTranslation($locale));            
        }

        $editForm   = $this->createForm(new OrganigramType($this->container, $em), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);
        
        return $this->render("PiAppGedmoBundle:Organigram:$template", array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'NoLayout'       => $NoLayout,
        ));
    }

    /**
     * Edits an existing Organigram entity.
     *
     * @Secure(roles="ROLE_USER")
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>   
     */
    public function updateAction($id)
    {
        $em     = $this->getDoctrine()->getManager();
        $locale    = $this->container->get('request')->getLocale();
        $entity = $em->getRepository("PiAppGedmoBundle:Organigram")->findNodeOr404($id, $locale, "object");

        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)
            $template = "edit.html.twig";
        else
            $template = "edit_ajax.html.twig";        
 
        if (!$entity) {
            $entity = $em->getRepository("PiAppGedmoBundle:Organigram")->find($id);
        }

        $editForm   = $this->createForm(new OrganigramType($this->container, $em), $entity, array('show_legend' => false));
        $deleteForm = $this->createDeleteForm($id);

        $editForm->bind($this->getRequest(), $entity);
        if ($editForm->isValid()) {
            $entity->setTranslatableLocale($locale);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_gedmo_organigram_edit', array('id' => $id, 'NoLayout' => $NoLayout)));
        }
        
        return $this->render("PiAppGedmoBundle:Organigram:$template", array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'NoLayout'    => $NoLayout,
        ));
    }

    /**
     * Deletes a Organigram entity.
     *
     * @Secure(roles="ROLE_USER")
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
            $entity = $em->getRepository("PiAppGedmoBundle:Organigram")->findNodeOr404($id, $locale, 'object');

            if (!$entity) {
                throw ControllerException::NotFoundException('Organigram');
            }

            try {
                $em->remove($entity);
                $em->flush();
            } catch (\Exception $e) {
                $this->container->get('request')->getSession()->getFlashBag()->add('notice', 'pi.session.flash.wrong.undelete');
            }
        }

        return $this->redirect($this->generateUrl('admin_gedmo_organigram', array('NoLayout' => $NoLayout)));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    /**
     * Create a tree of the tree
     *
     * @Secure(roles="ROLE_USER")
     * @param string $category
     * @access    public
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function treeAction($category)
    {
        $em        = $this->getDoctrine()->getManager();
        $locale    = $this->container->get('request')->getLocale();
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
        if (!$NoLayout)     $template = "tree.html.twig"; else $template = "tree_ajax.html.twig";
        
        // from search category management        
        $form_search    = $this->createForm(new CategorySearchForm($em, "organigram", $this->container));
        $data = array();
        $data['category'] = $category;
        $form_search->setData($data);
        if ($this->getRequest()->getMethod() == 'POST') {
            $form_search->bind($this->getRequest());
            $data         = $form_search->getData();
            $category     = $data['category'];
            
            return $this->redirect($this->generateUrl('admin_gedmo_organigram_tree', array('NoLayout' => $NoLayout, 'category' => $category)));
        }        

        // tree management
        $self = &$this;
        $self->category = $category;
        $self->NoLayout = $NoLayout;
        $self->translator = $this->container->get('translator');
        $options = array(
                'decorate' => true,
                'rootOpen' => "\n <div class='acc-section'><div class='acc-content'><ul class='acc'> \n",
                'rootClose' => "\n </ul></div></div> \n",
                'childOpen' => "    <li> \n",        // 'childOpen' => "    <li class='collapsed' > \n",
                'childClose' => "    </li> \n",
                'nodeDecorator' => function($node) use (&$self) {
                    
                    $tree   = $self->getContainer()->get('doctrine')->getManager()->getRepository($self->_entityName)->findOneById($node['id']);
                
                    // define of all url images
                    $Urlpath0     = $self->get('templating.helper.assets')->getUrl('bundles/piappadmin/images/icons/tree/plus.png');
                    $UrlpathAdd    = $self->get('templating.helper.assets')->getUrl('bundles/piappadmin/images/icons/tree/add.png');
                    $Urlpath1     = $self->get('templating.helper.assets')->getUrl('bundles/piappadmin/images/icons/tree/view.png');
                    $Urlpath2     = $self->get('templating.helper.assets')->getUrl('bundles/piappadmin/images/icons/tree/up.png');
                    $Urlpath3     = $self->get('templating.helper.assets')->getUrl('bundles/piappadmin/images/icons/tree/down.png');
                    $Urlpath4     = $self->get('templating.helper.assets')->getUrl('bundles/piappadmin/images/icons/tree/remove.png');                
                
                    $linkNode     = '<h3 class="tree-node" >'
                    . '<img src="'.$Urlpath0.'" height="21px" />&nbsp;&nbsp;&nbsp;' . str_replace('<br>', ' ', $tree->getTitle())
                    . '&nbsp;&nbsp;&nbsp; (node: ' .  $node['id'] . ', level : ' .  $node['lvl'] . ')'
                    . '</h3>';                
                
                    if ( ($node['lft'] == -1) && ($node['rgt'] == 0) )   $linkNode .= '<div class="acc-section"><div class="acc-content">';
                    if ( ($node['lft'] !== -1) && ($node['rgt'] !== 0) ) $linkNode .= '<div class="acc-section"><div class="acc-content">';
                    if ( ($node['lft'] == -1) && ($node['rgt'] !== 0) )  $linkNode .= '<div class="acc-section"><div class="acc-content">';

                    $linkAdd    = '<a href="#" class="tree-action" data-url="' . $self->generateUrl('admin_gedmo_organigram_new', array("NoLayout" => true, 'category'=>$self->category, 'parent' => $node['id'])) . '" ><img src="'.$UrlpathAdd.'" title="'.$self->translator->trans('pi.add').'"  width="16" /></a>';
                    $linkEdit   = '<a href="#" class="tree-action" data-url="' . $self->generateUrl('admin_gedmo_organigram_edit', array('id' => $node['id'], "NoLayout" => true)) . '" ><img src="'.$Urlpath1.'" title="'.$self->translator->trans('pi.edit').'"  width="16" /></a>';
                    $linkUp        = '<a href="' . $self->generateUrl('admin_gedmo_organigram_move_up', array('id' => $node['id'], 'category'=>$self->category, 'NoLayout'=> $self->NoLayout)) . '"><img src="'.$Urlpath2.'" title="'.$self->translator->trans('pi.move-up').'" width="16" /></a>';
                    $linkDown     = '<a href="' . $self->generateUrl('admin_gedmo_organigram_move_down', array('id' => $node['id'], 'category'=>$self->category, 'NoLayout'=> $self->NoLayout)) . '"><img src="'.$Urlpath3.'" title="'.$self->translator->trans('pi.move-down').'" width="16" /></a>';
                    $linkDelete    = '<a href="' . $self->generateUrl('admin_gedmo_organigram_node_remove', array('id' => $node['id'], 'category'=>$self->category, 'NoLayout'=> $self->NoLayout)) . '"><img src="'.$Urlpath4.'" title="'.$self->translator->trans('pi.delete').'" width="16" /></a>';
                    
                    $linkNode .= $linkAdd . '&nbsp;&nbsp;&nbsp;' . $linkEdit . '&nbsp;&nbsp;&nbsp;' . $linkUp . '&nbsp;&nbsp;&nbsp;' . $linkDown . '&nbsp;&nbsp;&nbsp;' . $linkDelete;
                    $linkNode .= '<br/>';
                    $linkNode .= $tree->getDescriptif ();
                    $linkNode .= '<hr>';
                    $linkNode .= $tree->getContent();
                    
                    if ( ($node['lft'] == -1) && ($node['rgt'] == 0) )  $linkNode .= '</div></div>'; // if ( ($node['lft'] == -1) && ($node['rgt'] !== 0) )
                    if ( ($node['lft'] == -1) && ($node['rgt'] !== 0) ) $linkNode .= '</div></div>'; // if ( ($node['lft'] == -1) && ($node['rgt'] !== 0) )
                    return $linkNode;
                }
        );
        
        // we repair the tree
        $em->getRepository("PiAppGedmoBundle:Organigram")->setRecover();
        $result = $em->getRepository("PiAppGedmoBundle:Organigram")->verify();
        
        $node   = $this->container->get('request')->query->get('node');
        if (!empty($node) ){
            $node  = $em->getRepository("PiAppGedmoBundle:Organigram")->findNodeOr404($node, $locale,'object');
        } else {
            $node = null;
        }
         
        $nodes         = $em->getRepository("PiAppGedmoBundle:Organigram")->getAllTree($locale, $category, 'array', false, false, $node);
        $tree        = $em->getRepository("PiAppGedmoBundle:Organigram")->buildTree($nodes, $options);
        
        return $this->render("PiAppGedmoBundle:Organigram:$template", array(
                'tree'        => $tree,
                'form_search' => $form_search->createView(),
                'category'    => $category,
                'NoLayout'      => $NoLayout,
        ));
    }
    
       /**
        * Move the node up in the same level
        *
        * @Secure(roles="ROLE_USER")
        * @param int $id
        * @param string $category
        * @access    public
        * 
        * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
        */
    public function moveUpAction($id, $category)
    {
        $em        = $this->getDoctrine()->getManager();
        $locale    = $this->container->get('request')->getLocale();
        $node     = $em->getRepository("PiAppGedmoBundle:Organigram")->findNodeOr404($id, $locale);
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
    
        $em->getRepository("PiAppGedmoBundle:Organigram")->moveUp($node);
        return $this->redirect($this->generateUrl('admin_gedmo_organigram_tree', array('category'=>$category, 'NoLayout' => $NoLayout)));
    }
    
    /**
     * Move the node down in the same level
     *
     * @Secure(roles="ROLE_USER")
        * @param int $id
        * @param string $category
        * @access    public
        * 
        * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function moveDownAction($id, $category)
    {
        $em        = $this->getDoctrine()->getManager();
        $locale    = $this->container->get('request')->getLocale();
        $node    = $em->getRepository("PiAppGedmoBundle:Organigram")->findNodeOr404($id, $locale);
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
    
        $em->getRepository("PiAppGedmoBundle:Organigram")->moveDown($node);
        return $this->redirect($this->generateUrl('admin_gedmo_organigram_tree', array('category'=>$category, 'NoLayout' => $NoLayout)));
    }
    
    /**
     * Removes given $node from the tree and reparents its descendants
     *
     * @Secure(roles="ROLE_USER")
        * @param int $id
        * @param string $category
        * @access    public
        * 
        * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function removeAction($id, $category)
    {
        $em        = $this->getDoctrine()->getManager();
        $locale    = $this->container->get('request')->getLocale();
        $node    = $em->getRepository("PiAppGedmoBundle:Organigram")->findNodeOr404($id, $locale);
        
        $NoLayout   = $this->container->get('request')->query->get('NoLayout');
    
        $em->getRepository("PiAppGedmoBundle:Organigram")->removeFromTree($node);
        return $this->redirect($this->generateUrl('admin_gedmo_organigram_tree', array('category'=>$category, 'NoLayout' => $NoLayout)));
    }
    
}