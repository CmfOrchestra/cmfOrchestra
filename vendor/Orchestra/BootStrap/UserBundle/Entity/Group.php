<?php
/**
 * This file is part of the <User> project.
 *
 * @category   BootStrap_Entities
 * @package    Entity
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2011-11-28
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\UserBundle\Entity;

use FOS\UserBundle\Entity\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_group")
 * 
 * @category   BootStrap_Entities
 * @package    Entity
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class Group extends BaseGroup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\generatedValue(strategy="AUTO")
     */
     protected $id;
     
     /**
      * @var datetime $created_at
      *
      * @ORM\Column(name="created_at", type="datetime", nullable=false)
      */
     protected $created_at;
     
     /**
      * @var datetime $updated_at
      *
      * @ORM\Column(name="updated_at", type="datetime", nullable=true)
      */
     protected $updated_at;
   
     
     /**
      * @var boolean $enabled
      *
      * @ORM\Column(name="enabled", type="boolean", nullable=true)
      */
     protected $enabled;

     public function __construct($name, $roles = array())
     {
         parent::__construct($name, $roles);
         
         $this->setCreatedAt(new \DateTime());
         $this->setUpdatedAt(new \DateTime());
     }
     
    /**
     * 
     * This method is used when you want to convert to string an object of
     * this Entity
     * ex: $value = (string)$entity;
     * 
     */    
    public function __toString() {
        return (string) $this->name;
    }

    /**
     * @ORM\PrePersist()
     */
    public function setCreatedValue()
    {
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
    }
    
    /**
     * @ORM\PreUpdate()
     */
    public function setUpdatedValue()
    {
        $this->setUpdatedAt(new \DateTime());
    } 

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }    
    
    /**
     * Set created_at
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }
    
    /**
     * Get created_at
     *
     * @return datetime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    
    /**
     * Set updated_at
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    }
    
    /**
     * Get updated_at
     *
     * @return datetime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
    
}