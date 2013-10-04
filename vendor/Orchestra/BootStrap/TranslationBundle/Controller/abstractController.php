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
                $qb->add('select', 'COUNT('.$tablecode.'.id)');
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
            $qb->add('select', 'COUNT('.$tablecode.'.id)');
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

                foreach ($search_tab as $s) {
                    $and->add($qb->expr()->like('LOWER('.$aColumns[(intval($i)-1)].')', $qb->expr()->literal('%'.strtolower(\PiApp\AdminBundle\Util\PiStringManager::withoutaccent($s)).'%')));
                }
            }
            if ( $request->get('bSearchable_'.($i+1)) == "true" && $request->get('sSearch') != '' ) {
                $and->add($qb->expr()->like('LOWER('.$aColumns[$i].')', $qb->expr()->literal('%'.strtolower(\PiApp\AdminBundle\Util\PiStringManager::withoutaccent($request->get('sSearch'))).'%')));
            }
        }
        if ($and!= "") {
            $qb->andWhere($and);
        }
    
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
            
            $result = $qb->getQuery()->getResult();
        } else {
            //$query_sql = $qb->getQuery()->getSql();
            //var_dump($query_sql);
            //exit;
            
            $result = $qb->getQuery()->getSingleScalarResult();
        }
        
        return $result;
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
    protected function authenticateUser(\BootStrap\UserBundle\Entity\User $user)
    {
        $providerKey = $this->container->getParameter('fos_user.firewall_name');
        $token          = new UsernamePasswordToken($user, null, $providerKey, $user->getRoles());

        $this->container->get('security.context')->setToken($token);
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
            	    } else {
            	    	return false;
            	    }
            	}
        	}
        } else {
        	return false;
        }
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