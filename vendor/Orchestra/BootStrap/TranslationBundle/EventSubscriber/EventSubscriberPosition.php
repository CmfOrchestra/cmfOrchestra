<?php
/**
 * This file is part of the <Translation> project.
 *
 * @category   BootStrap_EventSubscriber
 * @package    EventSubscriber
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-10-08
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\TranslationBundle\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\EventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;

use BootStrap\TranslationBundle\EventListener\abstractListener;

/**
 * Position Subscriber.
 *
 * @category   BootStrap_EventSubscriber
 * @package    EventSubscriber
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class EventSubscriberPosition  extends abstractListener implements EventSubscriber
{
    /**
     * @return array
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function getSubscribedEvents()
    {
        return array(
            Events::prePersist,
            Events::preUpdate,
            Events::preRemove,
            Events::postUpdate,
            Events::postRemove,
            Events::postPersist,
        );
    }

    /**
     * @param \Doctrine\Common\EventArgs $args
     * @return void
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    protected function recomputeSingleEntityChangeSet(EventArgs $args)
    {
        $em = $args->getEntityManager();

        $em->getUnitOfWork()->recomputeSingleEntityChangeSet(
            $em->getClassMetadata(get_class($args->getEntity())),
            $args->getEntity()
        );
    }
    
    /**
     * @param \Doctrine\Common\EventArgs $args
     * @return void
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function postUpdate(EventArgs $eventArgs)
    {
    }
    
    /**
     * @param \Doctrine\Common\EventArgs $args
     * @return void
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function postRemove(EventArgs $eventArgs)
    {
    }
    
    /**
     * @param \Doctrine\Common\EventArgs $args
     * @return void
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function postPersist(EventArgs $eventArgs)
    {
    }
    
    /**
     * @param \Doctrine\Common\EventArgs $args
     * @return void
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function preUpdate(PreUpdateEventArgs $eventArgs)
    {
        $entity            = $eventArgs->getEntity();
        $entityManager     = $eventArgs->getEntityManager();
        
        $result                    = $this->getSortableOrders($eventArgs);
        $sort_position_by_and    = $result['sort_position_by_and'];
        $sort_position_by_where    = $result['sort_position_by_where'];    

        if ( $this->isUsernamePasswordToken() && method_exists($entity, 'setPosition') && method_exists($entity, 'getPosition') )
        {
            $entity_table     = $this->getOwningTable($eventArgs, $entity);
        
            if ($eventArgs->hasChangedField('position')){
                $old_position     = $eventArgs->getOldValue('position');
                $new_position    = $entity->getPosition();
                 
                // if the position has not been given
                if (is_null($new_position) || empty($new_position) || ($old_position <=0) ){
                    // we select the max value of the table.
                    $query_max     = "SELECT position FROM $entity_table mytable $sort_position_by_where ORDER BY mytable.position DESC LIMIT 1";
                    $max         = $this->_connexion($eventArgs)->fetchColumn($query_max);
        
                    // we set the position value to max
                    $entity->setPosition($max+1);
                }
                // If a field in the table has been moved to the back
                elseif ($old_position > $new_position){
                    // Is incremented by 1 every table field whose position is greater or equal than the new position and strictly smaller that the old position .
                    $query             = "UPDATE $entity_table mytable SET mytable.position = mytable.position + 1 WHERE ( (mytable.position >= ?) AND (mytable.position <= ?) AND (mytable.id != ?) $sort_position_by_and )";
                    $result = $this->_connexion($eventArgs)->executeUpdate($query, array($new_position, $old_position-1, $entity->getId()));
        
                    // We change the position of the entity.
                    $query  = "UPDATE $entity_table mytable SET mytable.position=? WHERE (mytable.id = ?) $sort_position_by_and ";
                    $result = $this->_connexion($eventArgs)->executeUpdate($query, array($new_position, $entity->getId()));
                    // If a field in the table has been moved to the forward
                }elseif ($old_position < $new_position){
                    // Is conversely incremented by 1 every table field whose position is strictly greater than the old position and  smaller or equal that the new position .
                    $query             = "UPDATE $entity_table mytable SET mytable.position = mytable.position - 1 WHERE ( (mytable.position >= ?) AND (mytable.position <= ?) AND (mytable.id != ?) $sort_position_by_and )";
                    $result = $this->_connexion($eventArgs)->executeUpdate($query, array($old_position+1, $new_position, $entity->getId()));
        
                    // We change the position of the entity.
                    $query  = "UPDATE $entity_table mytable SET mytable.position=? WHERE (mytable.id = ?) $sort_position_by_and ";
                    $result = $this->_connexion($eventArgs)->executeUpdate($query, array($new_position, $entity->getId()));
                }
            } else {
                $old_position    = $entity->getPosition();
                 
                // we select all rows that have the same position of the entity.
                $query     = "SELECT id, position FROM $entity_table mytable WHERE (mytable.position = '{$old_position}') AND (mytable.id != '{$entity->getId()}') $sort_position_by_and ORDER BY mytable.position";
                $entities_with_position     = $this->_connexion($eventArgs)->fetchAll($query);
                 
                // If there are other fields with the same position as the entity.
                if (count($entities_with_position) >= 1){
                    // we select all rows that have a position above.
                    $query     = "SELECT id, position FROM $entity_table mytable WHERE (mytable.position > '{$old_position}')  $sort_position_by_and ORDER BY mytable.position";
                    $entities_with_sup_position    = $this->_connexion($eventArgs)->fetchAll($query);
                    $count_pos    = 1;
                        
                    foreach($entities_with_position as $key => $entity_){
                        $new_pos    = $old_position + $count_pos;
                        $query         = "UPDATE $entity_table mytable SET mytable.position = ? WHERE (mytable.id = ?) $sort_position_by_and ";
                        $result     = $this->_connexion($eventArgs)->executeUpdate($query, array($new_pos, $entity_['id']));
                        $count_pos++;
                    }
                        
                    // Incrementing the entity below the other.
                    if (count($entities_with_sup_position) >= 1){
                        // is incremented by 1 every other fields with a position above.
                        foreach($entities_with_sup_position as $key => $entity_){
                            $new_pos    = $old_position + $count_pos;
                            $query         = "UPDATE $entity_table mytable SET mytable.position = ? WHERE (mytable.id = ?) $sort_position_by_and ";
                            $result     = $this->_connexion($eventArgs)->executeUpdate($query, array($new_pos, $entity_['id']));
                            $count_pos++;
                        }
                    }
                }
            } // end else
                
        }        
    }
    
    /**
     * @param \Doctrine\Common\EventArgs $args
     * @return void
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function preRemove(EventArgs $eventArgs)
    {
        $entity            = $eventArgs->getEntity();
        $entityManager     = $eventArgs->getEntityManager();
        
        $result                    = $this->getSortableOrders($eventArgs);
        $sort_position_by_and    = $result['sort_position_by_and'];
        $sort_position_by_where    = $result['sort_position_by_where'];                
        
        if ( $this->isUsernamePasswordToken() && method_exists($entity, 'setPosition') && method_exists($entity, 'getPosition') )
        {
            $entity_table    = $this->getOwningTable($eventArgs, $entity);
            $remove_position = $entity->getPosition();            
            // Is conversely incremented by 1 every table field whose position is greater than the remove position.
            $query     = "UPDATE $entity_table mytable SET mytable.position = mytable.position - 1 WHERE ( (mytable.position >= ?) AND (mytable.id != ?) $sort_position_by_and )";
            $result = $this->_connexion($eventArgs)->executeUpdate($query, array($remove_position, $entity->getId()));
        }
    }
    
    /**
     * @param \Doctrine\Common\EventArgs $args
     * @return void
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function prePersist(EventArgs $eventArgs)
    {
        $entity            = $eventArgs->getEntity();
        $entityManager     = $eventArgs->getEntityManager();
        
        $result                    = $this->getSortableOrders($eventArgs);
        $sort_position_by_and    = $result['sort_position_by_and'];
        $sort_position_by_where    = $result['sort_position_by_where'];   
        
        if ( $this->isUsernamePasswordToken() && method_exists($entity, 'setPosition') && method_exists($entity, 'getPosition') )
        {
            $entity_table   = $this->getOwningTable($eventArgs, $entity);
            $new_position    = $entity->getPosition();
            // if the position has not been given
            if (is_null($new_position) || empty($new_position) ) {
                if (!isset($_GET['_subscriber_position_max'][ get_class($entity) ]) || empty($_GET['_subscriber_position_max'][ get_class($entity) ])) {
                	// we select the max value of the table.
                	$query_max     = "SELECT position FROM $entity_table mytable $sort_position_by_where ORDER BY mytable.position DESC LIMIT 1";
                	$new_max         = intVal($this->_connexion($eventArgs)->fetchColumn($query_max)) + 1;
                } else {
                	$new_max = intVal($_GET['_subscriber_position_max'][ get_class($entity) ]) + 1;
                }
                // we set the position value.
                $entity->setPosition($new_max);
                // we save the new max value.
                $_GET['_subscriber_position_max'][ get_class($entity) ] = $new_max;
            } else {
                // if the position is smaller or equal to zero.
                if ($new_position <= 0){
                    // we set the position value to 1.
                    $entity->setPosition(1);                    
                    // Is incremented by 1 every table field whose position is greater or equal to 1.
                    $query     = "UPDATE $entity_table mytable SET mytable.position = mytable.position + 1 WHERE (mytable.position >= '1') $sort_position_by_and";
                    $result = $this->_connexion($eventArgs)->executeUpdate($query, array());
                } else {
                    // we select all rows that have the same position of the entity.
                    $query     = "SELECT id FROM $entity_table mytable WHERE (mytable.position = '{$new_position}') $sort_position_by_and ORDER BY mytable.position";
                    $rows     = $this->_connexion($eventArgs)->fetchAll($query);                    
                    // If a field in the table has the same position as the new position
                    if (count($rows) >= 1){
                        // Is incremented by 1 every table field whose position is greater than the new position.
                        $query     = "UPDATE $entity_table mytable SET mytable.position = mytable.position + 1 WHERE (mytable.position >= ?) $sort_position_by_and";
                        $result = $this->_connexion($eventArgs)->executeUpdate($query, array($new_position));
                        //$query             = "UPDATE $entity_table mytable SET mytable.position = mytable.position + 1 WHERE ( (mytable.position > '{$new_position}') AND ( EXISTS (SELECT position FROM $entity_table a WHERE a.position =  mytable.position - 1) AND (mytable.position = (SELECT position FROM $entity_table a WHERE a.position =  mytable.position - 1 LIMIT 1) + 1) ) AND (mytable.id != ?) )";
                    }
                }                
            }
        }  
    }    
    
    /**
     * Sets the specific sortOrders.
     *
     * @param EventArgs        $eventArgs
     * @access private
     * @return array
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */    
    private function getSortableOrders($eventArgs)
    {
        $entity            = $eventArgs->getEntity();
        $entityManager     = $eventArgs->getEntityManager();
                
        $results['sort_position_by_and']    = " ";
        $results['sort_position_by_where']    = " ";
         
        if (($entity instanceof \PiApp\AdminBundle\Entity\Block) && method_exists($entity, 'getPage')){
            $Page    = $entity->getPage();
            if ($Page instanceof \PiApp\AdminBundle\Entity\Page){
                $results['sort_position_by_and']     = " AND (mytable.page_id  = '{$Page->getId()}')";
                $results['sort_position_by_where']    = " WHERE (mytable.page_id  = '{$Page->getId()}')";
            }
        }
        if (($entity instanceof \PiApp\AdminBundle\Entity\Widget) && method_exists($entity, 'getBlock')){
            $Block    = $entity->getBlock();
            if ($Block instanceof \PiApp\AdminBundle\Entity\Block){
                $results['sort_position_by_and']     = " AND (mytable.block_id  = '{$Block->getId()}')";
                $results['sort_position_by_where']    = " WHERE (mytable.block_id  = '{$Block->getId()}')";
            }
        }

        
        
        
        if (($entity instanceof \PiApp\GedmoBundle\Entity\Media) && method_exists($entity, 'getCategory')){
            $category    = $entity->getCategory();
            if ($category instanceof \PiApp\GedmoBundle\Entity\Category){
                $results['sort_position_by_and']     = " AND (mytable.category  = '{$category->getId()}')";
                $results['sort_position_by_where']    = " WHERE (mytable.category  = '{$category->getId()}')";
            }
        }  
        if (($entity instanceof \PiApp\GedmoBundle\Entity\Block) && method_exists($entity, 'getCategory')){
            $category    = $entity->getCategory();
            if ($category instanceof \PiApp\GedmoBundle\Entity\Category){
                $results['sort_position_by_and']     = " AND (mytable.category  = '{$category->getId()}')";
                $results['sort_position_by_where']    = " WHERE (mytable.category  = '{$category->getId()}')";
            }
        }        
        if (($entity instanceof \PiApp\GedmoBundle\Entity\Content) && method_exists($entity, 'getCategory')){
            $category    = $entity->getCategory();
            if ($category instanceof \PiApp\GedmoBundle\Entity\Category){
                $results['sort_position_by_and']     = " AND (mytable.category  = '{$category->getId()}')";
                $results['sort_position_by_where']    = " WHERE (mytable.category  = '{$category->getId()}')";
            }
        }
        if (($entity instanceof \PiApp\GedmoBundle\Entity\Contact) && method_exists($entity, 'getCategory')){
            $category    = $entity->getCategory();
            if ($category instanceof \PiApp\GedmoBundle\Entity\Category){
                $results['sort_position_by_and']     = " AND (mytable.category  = '{$category->getId()}')";
                $results['sort_position_by_where']    = " WHERE (mytable.category  = '{$category->getId()}')";
            }
        }
        if (($entity instanceof \PiApp\GedmoBundle\Entity\Slider) && method_exists($entity, 'getCategory')){
            $category    = $entity->getCategory();
            if ($category instanceof \PiApp\GedmoBundle\Entity\Category){
                $results['sort_position_by_and']     = " AND (mytable.category  = '{$category->getId()}')";
                $results['sort_position_by_where']    = " WHERE (mytable.category  = '{$category->getId()}')";
            }
        }
        if (($entity instanceof \PiApp\GedmoBundle\Entity\Menu) && method_exists($entity, 'getCategory')){
            $category    = $entity->getCategory();
            if ($category instanceof \PiApp\GedmoBundle\Entity\Category){
                $results['sort_position_by_and']     = " AND (mytable.category  = '{$category->getId()}')";
                $results['sort_position_by_where']    = " WHERE (mytable.category  = '{$category->getId()}')";
            }
        }          
        
        return $results;
    }
    
}