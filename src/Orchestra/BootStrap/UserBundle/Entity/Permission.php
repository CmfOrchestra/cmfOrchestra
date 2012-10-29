<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   BootStrap_Entities
 * @package    Entity
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-01-04
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * BootStrap\UserBundle\Entity\Permission
 * 
 * @ORM\Table(name="fos_permission")
 * @ORM\Entity(repositoryClass="BootStrap\UserBundle\Repository\PermissionRepository")
 * @ORM\HasLifecycleCallbacks()
 * 
 * @category   BootStrap_Entities
 * @package    Entity
 * 
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class Permission
{
    /**
     * @var bigint $id
     * 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     * @Assert\MinLength(limit = 3, message = "Le nom doit avoir au moins {{ limit }} caractères")
     */
    protected $name;    
    
    /**
     * @var text $comment
     *
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank(message = "You must enter a comment")
     * @Assert\MinLength(limit = 25, message = "Le commentaire doit avoir au moins {{ limit }} caractères")
     */
    protected $comment;  

    /**
     * @var boolean $enabled
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=true)
     */
    protected $enabled;    


    public function __construct()
    {
    }
    
    public function __toString()
    {
    	return (string) $this->getName();
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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
    	$this->name = $name;
    }
    
    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
    	return $this->name;
    }  

    /**
     * Set comment
     *
     * @param text $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get comment
     *
     * @return text 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set enabled
     *
     * @param integer $enabled
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