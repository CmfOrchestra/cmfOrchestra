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
    	$em		 = $this->getDoctrine()->getEntityManager();
    	
    	if($request->isXmlHttpRequest()){
    		$data		= $request->get('data', null);
    		$new_data	= null;    		
    		   		
    		foreach ($data as $key => $value) {
    			$values 	= explode('_', $value);
    			$id	    	= $values[2];
    			$position	= $values[0];    

    			$new_data[$key] = array('position'=>$position, 'id'=>$id);
    			$new_pos[$key]  = $position;
    		}
    		array_multisort($new_pos, SORT_ASC, $new_data);
    		
    		krsort($new_data);
    		foreach ($new_data as $key => $value) {
    			$entity = $em->getRepository($this->_entityName)->find($value['id']);
    			$entity->setEnabled(true);
    			
    			if(method_exists($entity, 'setPosition'))
    				$entity->setPosition(1);
    			
    			$em->persist($entity);
    			$em->flush();
    		}
    		$em->clear();

    		// we disable all flash message
    		$this->container->get('session')->setFlashes(array());
    		
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
    	$em		 = $this->getDoctrine()->getEntityManager();
    	
    	if($request->isXmlHttpRequest()){
    		$data		= $request->get('data', null);
    		$new_data	= null;
    		
    		foreach ($data as $key => $value) {
    			$values 	= explode('_', $value);
    			$id	    	= $values[2];
    			$position	= $values[0];    

    			$new_data[$key] = array('position'=>$position, 'id'=>$id);
    			$new_pos[$key]  = $position;
    		}
    		array_multisort($new_pos, SORT_ASC, $new_data);
    		
    		foreach ($new_data as $key => $value) {
    			$entity = $em->getRepository($this->_entityName)->find($value['id']);
    			$entity->setEnabled(false);
    			
    			if(method_exists($entity, 'setPosition'))
    				$entity->setPosition(null);
    			
    			$em->persist($entity);
    			$em->flush();
    		}
    		$em->clear();
    		
    		// we disable all flash message
    		$this->container->get('session')->setFlashes(array());
    		
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
     * @access	public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function deletajaxAction()
    {
    	$request = $this->container->get('request');
    	$em 	 = $this->getDoctrine()->getEntityManager();
    	 
    	if($request->isXmlHttpRequest()){
    		$data		= $request->get('data', null);
    		$new_data	= null;
    		
    		foreach ($data as $key => $value) {
    			$values 	= explode('_', $value);
    			$id	    	= $values[2];
    			$position	= $values[0];    

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
            $this->container->get('session')->setFlashes(array());
            
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
    	$em		 = $this->getDoctrine()->getEntityManager();
    	 
    	if($request->isXmlHttpRequest()){
    		$old_position 	= $request->get('fromPosition', null);
    		$new_position 	= $request->get('toPosition', null);
    		$direction 		= $request->get('direction', null);
    		
    		$data			= $request->get('id', null);
   			$values 		= explode('_', $data);
   			$id	    		= $values[2];
   			
   			if(!is_null($id)){
	    		if( ($new_position == "NaN") || is_null($new_position) || empty($new_position) )	$new_position 	= 1;
	
				$entity = $em->getRepository($this->_entityName)->find($id);
				$entity->setPosition($new_position);
				$em->persist($entity);
				$em->flush();
				$em->clear();	
   			}		
   			
    		// we disable all flash message
    		$this->container->get('session')->setFlashes(array());
    
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
     * @access	public
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 20012-10-05
     */
    public function SortDisabledFieldsAction()
    {
    	$em         = $this->getDoctrine()->getEntityManager();
    	$table 		= $em->getRepository($this->_entityName)->getClassName();
    	$entities	= $em->getRepository($this->_entityName)->getAllOrderByField('created_at', 'ASC', 0)->getQuery()->getArrayResult();
    	
    	// we get the max value of all enabled fields.
    	$max = $em->getRepository($entity_name)->getMaxOrMinValueOfColumn('position', 'MAX', 1)->getQuery()->getSingleScalarResult();
    		
    	$count = count($entities);
    	for($i=1;$i<$count;$i++){
    		foreach($entities as $key => $entity){
    			if(isset($entities[$key+1])){
    				$entity_pos 	= $entity['position'];
    				$entity_next	= $entities[$key+1];
    				$entity_next_pos= $entity_next['position'];
    
    				if(($entity_pos > $entity_next_pos) ){
    					$entity_next_pos = $max + $entity_next_pos;
    					$entity_pos		 = $max + $entity_pos;
    					
    					$query = "UPDATE $table mytable SET mytable.position='{$entity_next_pos}' WHERE mytable.id = '{$entity['id']}'";
    					$em->createQuery($query)->getSingleScalarResult();
    					$entities[$key]['position'] = $entity_next_pos;
    
    					$query = "UPDATE $table mytable SET mytable.position='{$entity_pos}' WHERE mytable.id = '{$entity_next['id']}'";
    					$em->createQuery($query)->getSingleScalarResult();
    					$entities[$key+1]['position'] = $entity_pos;
    				}elseif(($entity_pos == $entity_next_pos) ){
    					$entity_next_pos = $max + $entity_next_pos;
    					$entity_pos		 = $max + $entity_pos;
    					
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
    
    public function getContainer(){
    	return $this->container;
    }    
    
}