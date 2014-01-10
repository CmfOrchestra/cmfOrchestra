<?php
/**
 * This file is part of the <PI_CRUD> project.
 *
 * @category   PI_CRUD_Controllers
 * @package    Controller
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-10-01
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\TranslationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PiApp\AdminBundle\Exception\ControllerException;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

use FOS\UserBundle\Model\UserInterface;

/**
 * abstract controller.
 *
 *
 * @category   PI_CRUD_Controllers
 * @package    Controller
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
abstract class abstractController extends Controller
{
    /**
     * Enabled entities.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *     
     * @access  public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function enabledajaxAction()
    {
        $request = $this->container->get('request');
        $em         = $this->getDoctrine()->getManager();
        
        if ($request->isXmlHttpRequest()) {
            $data        = $request->get('data', null);
            $new_data    = null;            
                       
            foreach ($data as $key => $value) {
                $values     = explode('_', $value);
                $id            = $values[2];
                $position    = $values[0];    

                $new_data[$key] = array('position'=>$position, 'id'=>$id);
                $new_pos[$key]  = $position;
            }
            array_multisort($new_pos, SORT_ASC, $new_data);
            
            krsort($new_data);
            foreach ($new_data as $key => $value) {
                $entity = $em->getRepository($this->_entityName)->find($value['id']);
                if (method_exists($entity, 'setArchived')) {
                    $entity->setArchived(false);
                }
                if (method_exists($entity, 'setEnabled')) {
                    $entity->setEnabled(true);
                }
                if (method_exists($entity, 'setArchiveAt')) {
                    $entity->setArchiveAt(null);
                }
                if (method_exists($entity, 'setPosition')) {
                    $entity->setPosition(1);
                }
                $em->persist($entity);
                $em->flush();
            }
            $em->clear();

            // we disable all flash message
            $this->container->get('session')->clearFlashes();
            
            $tab= array();
            $tab['id'] = '-1';
            $tab['error'] = '';
            $tab['fieldErrors'] = '';
            $tab['data'] = '';
             
            $response = new Response(json_encode($tab));
            $response->headers->set('Content-Type', 'application/json');
            return $response;            
        } else {
            throw ControllerException::callAjaxOnlySupported('enabledajax');
        } 
    }

    /**
     * Disable entities.
     * 
     * @return \Symfony\Component\HttpFoundation\Response
     *     
     * @access  public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function disableajaxAction()
    {
        $request = $this->container->get('request');
        $em         = $this->getDoctrine()->getManager();
        
        if ($request->isXmlHttpRequest()) {
            $data        = $request->get('data', null);
            $new_data    = null;
            
            foreach ($data as $key => $value) {
                $values     = explode('_', $value);
                $id            = $values[2];
                $position    = $values[0];    

                $new_data[$key] = array('position'=>$position, 'id'=>$id);
                $new_pos[$key]  = $position;
            }
            array_multisort($new_pos, SORT_ASC, $new_data);
            
            foreach ($new_data as $key => $value) {
                $entity = $em->getRepository($this->_entityName)->find($value['id']);
                if (method_exists($entity, 'setEnabled')) {
                    $entity->setEnabled(false);
                }
                if (method_exists($entity, 'setPosition')) {
                    $entity->setPosition(null);
                }
                $em->persist($entity);
                $em->flush();
            }
            $em->clear();
            // we disable all flash message
            $this->container->get('session')->clearFlashes();
            // we encode results            
            $tab= array();
            $tab['id'] = '-1';
            $tab['error'] = '';
            $tab['fieldErrors'] = '';
            $tab['data'] = '';
            $response = new Response(json_encode($tab));
            $response->headers->set('Content-Type', 'application/json');
            
            return $response;            
        } else {
            throw ControllerException::callAjaxOnlySupported('disableajax');
        } 
    } 
    
    /**
     * Deletes a entity.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function deletajaxAction()
    {
        $request = $this->container->get('request');
        $em      = $this->getDoctrine()->getManager();
         
        if ($request->isXmlHttpRequest()) {
            $data        = $request->get('data', null);
            $new_data    = null;
            
            foreach ($data as $key => $value) {
                $values     = explode('_', $value);
                $id            = $values[2];
                $position    = $values[0];    

                $new_data[$key] = array('position'=>$position, 'id'=>$id);
                $new_pos[$key]  = $position;
            }
            array_multisort($new_pos, SORT_ASC, $new_data);
            
            foreach ($new_data as $key => $value) {
                $entity = $em->getRepository($this->_entityName)->find($value['id']);
                $em->remove($entity);
                $em->flush();
            }
            $em->clear();
            // we disable all flash message
            $this->container->get('session')->clearFlashes();
            // we encode results            
            $tab= array();
            $tab['id'] = '-1';
            $tab['error'] = '';
            $tab['fieldErrors'] = '';
            $tab['data'] = '';
            $response = new Response(json_encode($tab));
            $response->headers->set('Content-Type', 'application/json');
            
            return $response;
        } else {
            throw ControllerException::callAjaxOnlySupported('deleteajax');
        }
    }    
    
    /**
     * Archive entities.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access  public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function archiveajaxAction()
    {
        $request = $this->container->get('request');
        $em         = $this->getDoctrine()->getManager();
         
        if ($request->isXmlHttpRequest()) {
            $data        = $request->get('data', null);
            $new_data    = null;
    
            foreach ($data as $key => $value) {
                $values     = explode('_', $value);
                $id            = $values[2];
                $position    = $values[0];
    
                $new_data[$key] = array('position'=>$position, 'id'=>$id);
                $new_pos[$key]  = $position;
            }
            array_multisort($new_pos, SORT_ASC, $new_data);
    
            foreach ($new_data as $key => $value) {
                $entity = $em->getRepository($this->_entityName)->find($value['id']);
                if (method_exists($entity, 'setArchived')) {
                    $entity->setArchived(true);
                }
                if (method_exists($entity, 'setEnabled')) {
                    $entity->setEnabled(false);
                }
                if (method_exists($entity, 'setArchiveAt')) {
                    $entity->setArchiveAt(new \DateTime());
                }                 
                if (method_exists($entity, 'setPosition')) {
                    $entity->setPosition(null);
                }                                
                $em->persist($entity);
                $em->flush();
            }
            $em->clear();
            // we disable all flash message
            $this->container->get('session')->clearFlashes();
            // we encode results    
            $tab= array();
            $tab['id'] = '-1';
            $tab['error'] = '';
            $tab['fieldErrors'] = '';
            $tab['data'] = '';
            $response = new Response(json_encode($tab));
            $response->headers->set('Content-Type', 'application/json');
            
            return $response;
        } else {
            throw ControllerException::callAjaxOnlySupported('disableajax');
        }
    }    

    /**
     * Change the posistion of a entity .
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *     
     * @access  public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function positionajaxAction()
    {
        $request = $this->container->get('request');
        $em         = $this->getDoctrine()->getManager();
         
        if ($request->isXmlHttpRequest()) {
            $old_position     = $request->get('fromPosition', null);
            $new_position     = $request->get('toPosition', null);
            $direction        = $request->get('direction', null);
            $data             = $request->get('id', null);
            $values           = explode('_', $data);
            $id               = $values[2];
               
            if (!is_null($id)){
                if ( ($new_position == "NaN") || is_null($new_position) || empty($new_position) )    $new_position     = 1;
                $entity = $em->getRepository($this->_entityName)->find($id);
                if (method_exists($entity, 'setPosition')) {
                	$entity->setPosition($new_position);
                }
                $em->persist($entity);
                $em->flush();
                $em->clear();    
            }        
            // we disable all flash message
            $this->container->get('session')->clearFlashes();
            // we encode results    
            $tab= array();
            $tab['id'] = '-1';
            $tab['error'] = '';
            $tab['fieldErrors'] = '';
            $tab['data'] = '';
            $response = new Response(json_encode($tab));
            $response->headers->set('Content-Type', 'application/json');
            
            return $response;
        } else {
            throw ControllerException::callAjaxOnlySupported('positionajax');
        }
    } 
    
    /**
     * Create Ajax query
     *
     * @param string $type        ["select","count"]
     * @param string $table
     * @param string $aColumns
     * @return array
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function createAjaxQuery($type, $aColumns, $qb = null, $tablecode = 'u', $table = null, $dateSearch = null)
    {
        $request = $this->container->get('request');
        $locale = $this->container->get('request')->getLocale();
        $em     = $this->getDoctrine()->getManager();
        
        if (is_null($qb)) {
            $qb     = $em->createQueryBuilder();
            if ($type == 'select') {
                $qb->add('select', $tablecode);
            } elseif($type == "count") {
                $qb->add('select', $tablecode.'.id');
            } else {
                throw ControllerException::NotFoundOptionException('type');
            }
            if (isset($this->_entityName) && !empty($this->_entityName)) {
                $qb->add('from', $this->_entityName.' '.$tablecode);
            } elseif (!is_null($table)) {
                $qb->add('from', $table.' '.$tablecode);
            } else {
                throw ControllerException::NotFoundOptionException('table');
            }
        } elseif($type == "count") {
            $qb->add('select', $tablecode.'.id');
        }
        
        /**
         * Date
         */    
        if (!is_null($dateSearch) && is_array($dateSearch)) {
            foreach ($dateSearch as $k => $columnSearch) {
                $idMin = "date-{$columnSearch['idMin']}";
                $idMax = "date-{$columnSearch['idMax']}";
                if ( $request->get($idMin) != '' ) {
                    $date = \DateTime::createFromFormat($columnSearch['format'], $request->get($idMin));
                    $dateMin = $date->format('Y-m-d 00:00:00');
                    //$dateMin = $this->container->get('pi_app_admin.date_manager')->format($date->getTimestamp(), 'long','medium', $locale, "yyyy-MM-dd 00:00:00");
               		$qb->andWhere("{$columnSearch['column']} >= '" . $dateMin . "'");
                }
                if ( $request->get($idMax) != '') {
                    $date = \DateTime::createFromFormat($columnSearch['format'], $request->get($idMax));
                    $dateMax = $date->format('Y-m-d 23:59:59');
                	$qb->andWhere("{$columnSearch['column']} <= '" . $dateMax . "'");
                }
            }
        }
    
        /**
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
        $and = $qb->expr()->andx();
        for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
            if ( $request->get('bSearchable_'.$i) == "true" && $request->get('sSearch_'.$i) != '' ) {
                $expression = str_replace("(^|\s*/+\s*)(","",$request->get('sSearch_'.$i));
                $search = str_replace(")(\s*/+\s*|$)","",$expression);
                $search_tab = explode("|", $search);

                $or = $qb->expr()->orx();
                foreach ($search_tab as $s) {
                    if (is_numeric($s)) {
                        $or->add($qb->expr()->eq($aColumns[(intval($i)-1)], (int)$s));
                    }else{
                        $or->add($qb->expr()->like('LOWER('.$aColumns[(intval($i)-1)].')', $qb->expr()->literal('%'.strtolower(\PiApp\AdminBundle\Util\PiStringManager::withoutaccent($s)).'%')));
                    }
                }
                $and->add($or);
            }
        }
        if ($and!= "") {
        	$qb->andWhere($and); 
        }        
        
        $or = $qb->expr()->orx();
        for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
        	if ( $request->get('bSearchable_'.$i) == "true" && $request->get('sSearch') != '' ) {
        		$keywords = preg_split("/\s+/", strtolower(\PiApp\AdminBundle\Util\PiStringManager::withoutaccent($request->get('sSearch'))));
        		foreach ($keywords as $keyword) {
        			if(!empty($keyword)){
                            $or->add($qb->expr()->like('LOWER('.$aColumns[$i].')', $qb->expr()->literal('%'.$keyword.'%')));
        			}
        		}
        	}
        }
        if ($or!= "") {
        	$qb->andWhere($or);
        }
        
        /**
         * Grouping
         */        
        $qb->groupBy($tablecode.'.id');
            
        /**
         * Ordering
          */
        $iSortingCols = $request->get('iSortingCols', '');
        if ( !empty($iSortingCols) ) {
            for ( $i=0 ; $i<intval($request->get('iSortingCols') ) ; $i++ ) {
                $iSortCol_ = $request->get('iSortCol_'.$i, '');
                $iSortCol_col = (intval($iSortCol_)-1);
                if (!empty($iSortCol_) && ( $request->get('bSortable_'.intval($iSortCol_) ) == "true" ) && isset($aColumns[ $iSortCol_col ])) {
                    $column = $aColumns[ $iSortCol_col ];
                    $sort = $request->get('sSortDir_'.$i)==='asc' ? 'ASC' : 'DESC';
                    $qb->addOrderBy($column, $sort);
                }
            }
        }
        
        /**
         * Paging 
         */
        if ($type == 'select') {
            $iDisplayStart = $request->get('iDisplayStart', 0);
            $iDisplayLength = $request->get('iDisplayLength', 25);
            $qb->setFirstResult($iDisplayStart);
            $qb->setMaxResults($iDisplayLength);
            //$query_sql = $qb->getQuery()->getSql();
            //var_dump($query_sql);
            //exit;            
            $result = $em->getRepository("BootStrapUserBundle:User")->setTranslatableHints($qb->getQuery(), $locale, false, true)->getResult();
        } else {
            //$query_sql = $qb->getQuery()->getSql();
            //var_dump($query_sql);
            //exit;
        	$result = count($em->getRepository("BootStrapUserBundle:User")->setTranslatableHints($qb->getQuery(), $locale, false, true)->getResult());
        }
        
        return $result;
    }    

    /**
     * Get all error messages after binding form.
     *
     * @param \Symfony\Component\Form\Form $form	
     * @return array	The list of all the errors
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */    
    protected function getErrorMessages(\Symfony\Component\Form\Form $form, $type = 'array') {
    	$errors = array();
    	foreach ($form->getErrors() as $key => $error) {
    		if($error->getMessagePluralization() !== null) {
    			$errors[$key] = $this->get('translator')->transChoice($error->getMessage(), $error->getMessagePluralization(), $error->getMessageParameters());
    		} else {
    			$errors[$key] = $this->get('translator')->trans($error->getMessage());
    		}    		
    	}
    	if ($form->hasChildren()) {
    		foreach ($form->getChildren() as $child) {
    			if (!$child->isValid()) {
    				$errors[$child->getName()] = $this->getErrorMessages($child, 'array');
    			}
    		}
    	}
    	if ($type == 'array') {
      		return $errors;
     	} else {
     		return \PiApp\AdminBundle\Util\PiArrayManager::convertArrayToString($errors, $this->get('translator'), 'pi.form.label.field.', '', "<br />");
     	}
    }
    
    /**
     * Set all error messages in flash.
     *
     * @param \Symfony\Component\Form\Form $form
     * @return array	The list of all the errors
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function setFlashErrorMessages(\Symfony\Component\Form\Form $form) {
    	return $this->container->get('request')->getSession()->getFlashBag()->add('errorform', $this->getErrorMessages($form, 'string' ));
    }    
    
    /**
     * Set all messages in flash.
     *
     * @param \Symfony\Component\Form\Form $form
     * @return array	The list of all the errors
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function setFlashMessages($messages, $param = 'notice') {
    	return $this->container->get('request')->getSession()->getFlashBag()->add($param, $messages);
    }    
        
    /**
     * Authenticate a user with Symfony Security.
     *
     * @param $user
     * @return void
     * @access protected
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function authenticateUser(UserInterface $user, $deleteToken = true, &$response = null)
    {
    	$em 		 = $this->getDoctrine()->getEntityManager();
        $providerKey = $this->container->getParameter('fos_user.firewall_name');
        $userManager = $this->container->get('fos_user.user_manager');
        //
        $token       = new UsernamePasswordToken($user, null, $providerKey, $user->getRoles());
        $this->container->get('security.context')->setToken($token);
	    // we delete token user
        if ($deleteToken) {
	        $user->setConfirmationToken(null);
	        $userManager->updateUser($user);
	        $em->persist($user);
	        $em->flush();	                
        }
        //
        if ($response instanceof Response) {
	        // Record all cookies in relation with ws.
	        $dateExpire          = $this->container->getParameter('pi_app_admin.cookies.date_expire');
	        $date_interval       = $this->container->getParameter('pi_app_admin.cookies.date_interval');
	        $app_id			     = $this->container->getParameter('pi_app_admin.cookies.application_id');
	        // Record the layout variable in cookies.
	        if ($dateExpire && !empty($date_interval)) {
	        	$dateExpire = new \DateTime("NOW");
	        	$dateExpire->add(new \DateInterval($date_interval)); // we add 4 hour
	        } else {
	        	$dateExpire = 0;
	        }
	        if($app_id && !empty($app_id) && $this->container->hasParameter('ws.auth')) {
	        	$response->headers->set('Content-Type', 'application/json');
	        	$config_ws 		= $this->container->getParameter('ws.auth');
	        	$key       		= $config_ws['handlers']['getpermisssion']['key'];
	        	$userId    		= $this->container->get('pi_app_admin.twig.extension.tool')->encryptFilter($this->getUser()->getId(), $key);
	        	$applicationId  = $this->container->get('pi_app_admin.twig.extension.tool')->encryptFilter($app_id, $key);
	        	$response->headers->setCookie(new \Symfony\Component\HttpFoundation\Cookie('orchestra-ws-user-id', $userId, $dateExpire));
	        	$response->headers->setCookie(new \Symfony\Component\HttpFoundation\Cookie('orchestra-ws-application-id', $applicationId, $dateExpire));
	        	$response->headers->setCookie(new \Symfony\Component\HttpFoundation\Cookie('orchestra-ws-key', $key, $dateExpire));
	        }
	        // set layout param
	        $BEST_ROLE_NAME = $this->container->get('bootstrap.Role.factory')->getBestRoleUser();
	        if (!empty($BEST_ROLE_NAME)) {
	        	$role         = $em->getRepository("BootStrapUserBundle:Role")->findOneBy(array('name' => $BEST_ROLE_NAME));
	        	if ($role instanceof \BootStrap\UserBundle\Entity\Role) {
	        		if ($role->getLayout() instanceof \PiApp\AdminBundle\Entity\Layout) {
	        			$template = $role->getLayout()->getFilePc();
	        			$response->headers->setCookie(new \Symfony\Component\HttpFoundation\Cookie('orchestra-layout', 'PiAppTemplateBundle::Template\\Layout\\Pc\\'.$template, $dateExpire));
	        		}
	        	}
	        } 
        }    
    }   
    
    /**
     * Disconnect a user with Symfony Security.
     *
     * @param $user
     * @return void
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function disconnectUser()
    {
    	$this->get('request')->getSession()->invalidate();
    }   
    
    /**
     * Return the token object.
     *
     * @return \Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function getToken()
    {
        return  $this->container->get('security.context')->getToken();
    }  
    
    /**
     * Return the token object.
     *
     * @return \Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function tokenUser(UserInterface $user)
    {
    	return $this->container->get("pi_app_admin.manager.authentication")->tokenUser($user);
    }    
    
    /**
     * Send mail to reset user password (return link with url)
     * @return string
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function sendResettingEmailMessage(UserInterface $user, $route_reset_connexion, $title = '', $parameters = array())
    {  
    	return $this->container->get("pi_app_admin.manager.authentication")->sendResettingEmailMessage($user, $route_reset_connexion, $title, $parameters);
    }  
    
    /**
     * Send mail to reset user password (return URL)
     * @return string
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function sendResettingEmailMessageURL(UserInterface $user, $route_reset_connexion, $parameters = array())
    {
    	return $this->container->get("pi_app_admin.manager.authentication")->sendResettingEmailMessageURL($user, $route_reset_connexion, $parameters);
    }    

    /**
     * Return the connected user name.
     *
     * @return string    user name
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function getUserName()
    {
        return $this->getToken()->getUser()->getUsername();
    }
    
    /**
     * Return the user permissions.
     *
     * @return array    user permissions
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function getUserPermissions()
    {
        return $this->getToken()->getUser()->getPermissions();
    }
    
    /**
     * Return the user roles.
     *
     * @return array    user roles
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function getUserRoles()
    {
        return $this->getToken()->getUser()->getRoles();
    }

    /**
     * Return if yes or no the user is anonymous token.
     *
     * @return boolean
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function isAnonymousToken()
    {
        if ($this->getToken() instanceof \Symfony\Component\Security\Core\Authentication\Token\AnonymousToken) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Return if yes or no the user is UsernamePassword token.
     *
     * @return boolean
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function isUsernamePasswordToken()
    {
        if ($this->getToken() instanceof \Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken) {
            return true;
        } else {
            return false;
        }
    }    
    
    /**
     * we check if the user ID exists in the authentication service.
     *
     * @param integer    $userId
     * @return boolean
     * @access protected
     *
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function isUserdIdExisted($userId)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BootStrapUserBundle:User')->find($userId);
        
        if ($entity instanceof \BootStrap\UserBundle\Entity\User) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * we return the token associated to the user ID.
     * 
     * @param integer    $userId
     * @param string    $application
     * @return string
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function getTokenByUserIdAndApplication($userId, $application)
    {
    	$em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BootStrapUserBundle:User')->find($userId);
        
        if ($entity instanceof \BootStrap\UserBundle\Entity\User) {
        	$all_applications =  $entity->getApplicationTokens();
        	if (!is_null($all_applications)) {
            	foreach ($all_applications as $applicationToken) {
            	    $string = strtoupper($applicationToken); 
            	    $replace = strtoupper($application.'::');
            	    $token = str_replace($replace, '', $string, $count);
            	    if ($count == 1) {
            	    	return strtoupper($token);
            	    }
            	}
        	}
        }
        return false;
    }

    /**
     * we associate the token to the userId.
     * 
     * @param integer    $userId
     * @param string    $token
     * @param string    $application
     * @return boolean
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function setAssociationUserIdWithApplicationToken($userId, $token, $application)
    {
    	$em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BootStrapUserBundle:User')->find($userId);
        
        if ($entity instanceof \BootStrap\UserBundle\Entity\User) {
        	$entity->setApplicationTokens(array(strtoupper($application.'::'.$token)));
        	$em->persist($entity);
            $em->flush();
        	return true;
        } else {
        	return false;
        }
    }    
    
    public function getContainer(){
        return $this->container;
    }
}