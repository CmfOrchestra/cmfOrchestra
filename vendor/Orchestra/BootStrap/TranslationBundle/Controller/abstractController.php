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
     * index entities.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @access  public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */    
    public function indexAjaxAction()
    {
        $request = $this->container->get('request');
    
        if ($request->isXmlHttpRequest())
        {
            $service_grid     = $this->container->get('pi_app_admin.manager.datatables');
            
            $aColumns         = array('position','id','input','upload','date_list','enabled');
            $result         = $this->createAjaxQuery('select','ProjetProjetBundle:Recette',$aColumns);
            $total             = $this->createAjaxQuery('count','ProjetProjetBundle:Recette',$aColumns);
            $output         = array(
                    "sEcho" => intval($request->get('sEcho')),
                    "iTotalRecords" => $total,
                    "iTotalDisplayRecords" => $total,
                    "aaData" => array()
            );
    
            $row = array();
            foreach ($result as $e) {
                //var_dump($e);
                $row = array();
                $row[] = $e->getId();//checkbox
                $row[] = $e->getPosition();
                $row[] = $e->getId();
                $row[] = $e->getInput();
                $row[] = $e->getUpload();
                $row[] = $e->getDateList();
                $row[] = $e->getEnabled();
                $row[] = $e->getId();//actions
                $output['aaData'][] = $row ;
            }
    
            $response = new Response(json_encode( $output ));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }else
            throw ControllerException::callAjaxOnlySupported('indexajax'); 
    }
        
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
        $em         = $this->getDoctrine()->getEntityManager();
        
        if ($request->isXmlHttpRequest()){
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
                $entity->setEnabled(true);
                
                if (method_exists($entity, 'setPosition'))
                    $entity->setPosition(1);
                
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
        }else
            throw ControllerException::callAjaxOnlySupported('enabledajax'); 
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
        $em         = $this->getDoctrine()->getEntityManager();
        
        if ($request->isXmlHttpRequest()){
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
                $entity->setEnabled(false);
                
                if (method_exists($entity, 'setPosition'))
                    $entity->setPosition(null);
                
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
        }else
            throw ControllerException::callAjaxOnlySupported('disableajax'); 
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
        $em      = $this->getDoctrine()->getEntityManager();
         
        if ($request->isXmlHttpRequest()){
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
            
            $tab= array();
            $tab['id'] = '-1';
            $tab['error'] = '';
            $tab['fieldErrors'] = '';
            $tab['data'] = '';
             
            $response = new Response(json_encode($tab));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }else
            throw ControllerException::callAjaxOnlySupported('deleteajax');
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
        $em         = $this->getDoctrine()->getEntityManager();
         
        if ($request->isXmlHttpRequest()){
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
                $entity->setArchived(true);
                $entity->setEnabled(false);
                $entity->setArchiveAt(new \DateTime());
                 
                if (method_exists($entity, 'setPosition'))
                    $entity->setPosition(null);
                                
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
        }else
            throw ControllerException::callAjaxOnlySupported('disableajax');
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
        $em         = $this->getDoctrine()->getEntityManager();
         
        if ($request->isXmlHttpRequest()){
            $old_position     = $request->get('fromPosition', null);
            $new_position     = $request->get('toPosition', null);
            $direction         = $request->get('direction', null);
            
            $data            = $request->get('id', null);
               $values         = explode('_', $data);
               $id                = $values[2];
               
               if (!is_null($id)){
                if ( ($new_position == "NaN") || is_null($new_position) || empty($new_position) )    $new_position     = 1;
    
                $entity = $em->getRepository($this->_entityName)->find($id);
                $entity->setPosition($new_position);
                $em->persist($entity);
                $em->flush();
                $em->clear();    
               }        
               
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
        }else
            throw ControllerException::callAjaxOnlySupported('positionajax');
    } 
    
    /**
     * Sorts all fields off the table in ascending order of creation date and aligns the position of this sort.
     *
     * @return void
     *
     * @access    public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 20012-10-05
     */
    public function SortDisabledFieldsAction()
    {
        $em         = $this->getDoctrine()->getEntityManager();
        $table         = $em->getRepository($this->_entityName)->getClassName();
        $entities    = $em->getRepository($this->_entityName)->getAllOrderByField('created_at', 'ASC', 0)->getQuery()->getArrayResult();
        
        // we get the max value of all enabled fields.
        $max = $em->getRepository($entity_name)->getMaxOrMinValueOfColumn('position', 'MAX', 1)->getQuery()->getSingleScalarResult();
            
        $count = count($entities);
        for($i=1;$i<$count;$i++){
            foreach($entities as $key => $entity){
                if (isset($entities[$key+1])){
                    $entity_pos     = $entity['position'];
                    $entity_next    = $entities[$key+1];
                    $entity_next_pos= $entity_next['position'];
    
                    if (($entity_pos > $entity_next_pos) ){
                        $entity_next_pos = $max + $entity_next_pos;
                        $entity_pos         = $max + $entity_pos;
                        
                        $query = "UPDATE $table mytable SET mytable.position='{$entity_next_pos}' WHERE mytable.id = '{$entity['id']}'";
                        $em->createQuery($query)->getSingleScalarResult();
                        $entities[$key]['position'] = $entity_next_pos;
    
                        $query = "UPDATE $table mytable SET mytable.position='{$entity_pos}' WHERE mytable.id = '{$entity_next['id']}'";
                        $em->createQuery($query)->getSingleScalarResult();
                        $entities[$key+1]['position'] = $entity_pos;
                    }elseif (($entity_pos == $entity_next_pos) ){
                        $entity_next_pos = $max + $entity_next_pos;
                        $entity_pos         = $max + $entity_pos;
                        
                        $query = "UPDATE $table mytable SET mytable.position='{$entity_next_pos}' WHERE mytable.id = '{$entity['id']}'";
                        $em->createQuery($query)->getSingleScalarResult();
                        $entities[$key]['position'] = $entity_next_pos;
        
                        $query = "UPDATE $table mytable SET mytable.position='{($entity_pos+1)}' WHERE mytable.id = '{$entity_next['id']}'";
                        $em->createQuery($query)->getSingleScalarResult();
                        $entities[$key+1]['position'] = $entity_pos+1;
                    }
                }
            }
        }
        $em->flush();
        $em->clear();
                
        return new Response('');
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
    public function createAjaxQuery($type, $aColumns, $qb = null, $tablecode = 'u', $table = null)
    {
        $request = $this->container->get('request');
        $em     = $this->getDoctrine()->getEntityManager();
        
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
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
        $or = $qb->expr()->orx();
        for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
            if ( $request->get('bSearchable_'.$i) == "true" && $request->get('sSearch_'.$i) != '' ) {
                $expression = str_replace("(^|\s*/+\s*)(","",$request->get('sSearch_'.$i));
                $search = str_replace(")(\s*/+\s*|$)","",$expression);
                $search_tab = explode("|", $search);

                foreach ($search_tab as $s) {
                    $or->add($qb->expr()->like('LOWER('.$aColumns[(intval($i)-1)].')', $qb->expr()->literal('%'.strtolower($s).'%')));
                }
            }
            if ( $request->get('bSearchable_'.($i+1)) == "true" && $request->get('sSearch') != '' ) {
                $or->add($qb->expr()->like('LOWER('.$aColumns[$i].')', $qb->expr()->literal('%'.strtolower($request->get('sSearch')).'%')));
            }
        }
        if ($or!= "") {
            $qb->andWhere($or);
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
     * Authenticate a user with Symfony Security
     *
     * @param $user
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
        if ($this->getToken() instanceof \Symfony\Component\Security\Core\Authentication\Token\AnonymousToken)
            return true;
        else
            return false;
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
        if ($this->getToken() instanceof \Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken)
            return true;
        else
            return false;
    }    
    
    public function getContainer(){
        return $this->container;
    }
}