<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   BootStrap_Entities
 * @package    Entity
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2011-12-28
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * BootStrap\UserBundle\Entity\Ressource
 * 
 * @ORM\Table(name="fos_ressource")
 * @ORM\Entity(repositoryClass="BootStrap\UserBundle\Repository\RessourceRepository")
 * @ORM\HasLifecycleCallbacks()
 * 
 * @category   BootStrap_Entities
 * @package    Entity
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class Ressource
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
     * @var string $route_name
     * 
     * @ORM\Column(name="route_name", type="text", nullable=true)
     * @Assert\MinLength(limit = 3, message = "Le route name doit avoir au moins {{ limit }} caractères")
     */
    protected $route_name;
    
    /**
     * @var string $slug
     * 
     * @ORM\Column(name="slug", type="text", nullable=false)
     * @Assert\NotBlank(message = "You must enter a slug")
     * @Assert\MinLength(limit = 3, message = "Le slug name doit avoir au moins {{ limit }} caractères")
     */
    protected $slug;
    
    /**
     * @var string $url
     * 
     * @ORM\Column(name="url", type="text", nullable=true)
     */
    protected $url;  
    
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
     * @var datetime $archive_at
     *
     * @ORM\Column(name="archive_at", type="datetime", nullable=true)
     */
    protected $archive_at;

    /**
     * @var boolean $enabled
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=true)
     */
    protected $enabled;    


    public function __construct()
    {
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
    }
    
    public function __toString()
    {
        return (string) $this->getName();
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
     * Set route_name
     *
     * @param text $routeName
     */
    public function setRouteName($routeName)
    {
        $this->route_name = $routeName;
    }
    
    /**
     * Get route_name
     *
     * @return text
     */
    public function getRouteName()
    {
        return $this->route_name;
    }
    
    /**
     * Set slug
     *
     * @param text $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $this->slugify($slug);
    }
    
    /**
     * Get slug
     *
     * @return text
     */
    public function getSlug()
    {
        return $this->slug;
    }
    
    /**
     * Set url
     *
     * @param text $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
    
    /**
     * Get url
     *
     * @return text
     */
    public function getUrl()
    {
        return $this->url;
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
     * Set archive_at
     *
     * @param datetime $archiveAt
     */
    public function setArchiveAt($archiveAt)
    {
        $this->archive_at = $archiveAt;
    }

    /**
     * Get archive_at
     *
     * @return datetime 
     */
    public function getArchiveAt()
    {
        return $this->archive_at;
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