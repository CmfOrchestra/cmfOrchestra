<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Entities
 * @package    Entity
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2011-12-28
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * PiApp\AdminBundle\Entity\Layout
 *
 * @ORM\Table(name="pi_layout")
 * @ORM\Entity(repositoryClass="PiApp\AdminBundle\Repository\LayoutRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity("name")
 * 
 * @category   Admin_Entities
 * @package    Entity
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class Layout
{
    /**
     * @var bigint $id
     * 
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Page", mappedBy="layout", cascade={"persist"})
     */
    protected $pages;  

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="BootStrap\UserBundle\Entity\Role", mappedBy="layout", cascade={"persist"})
     */
    protected $roles;    
    
    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false, unique=true)
     * @Assert\NotBlank()
     * @Assert\MinLength(limit = 3, message = "Le nom doit avoir au moins {{ limit }} caractères")
     */
    protected $name;
    
    /**
     * @var string $filePc
     *
     * @ORM\Column(name="file_pc", type="string", nullable=false)
     * @Assert\NotBlank(message = "You must enter a name file")
     * @Assert\MinLength(limit = 5, message = "Le nom du fichier doit avoir au moins {{ limit }} caractères")
     */
    protected $filePc;   

    /**
     * @var string $fileMobile
     *
     * @ORM\Column(name="file_mobile", type="string", nullable=false)
     * @Assert\NotBlank(message = "You must enter a name file")
     * @Assert\MinLength(limit = 5, message = "Le nom du fichier doit avoir au moins {{ limit }} caractères")
     */
    protected $fileMobile;    

    /**
     * @var text $configXml
     *
     * @ORM\Column(name="configXml", type="text", nullable=true)
     */
    protected $configXml;
    
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
    
    /**
     * @var boolean $archived
     *
     * @ORM\Column(name="archived", type="boolean", nullable=false)
     */
    protected $archived = false;  
    
    public function __construct()
    {
        $this->pages    = new \Doctrine\Common\Collections\ArrayCollection();
        $this->setEnabled(true);
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
     * Get id
     *
     * @return bigint 
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set the collection of related pages
     *
     * @param \Doctrine\Common\Collections\ArrayCollection $pages
     */
    public function setPages(\Doctrine\Common\Collections\ArrayCollection $pages)
    {
        $this->pages = $pages;
    }
        
    /**
     * Add a translation to the collection of related Page
     *
     * @param \PiApp\AdminBundle\Entity\TranslationPage    $page
     */
    public function addPage(\PiApp\AdminBundle\Entity\Page $page)
    {
          $this->pages->add($page);
           $page->setLayout($this);
    }
    
    /**
     * Remove a translation from the collection of related Page
     *
     * @param  \PiApp\AdminBundle\Entity\TranslationPage    $page
     */
    public function removePage(\PiApp\AdminBundle\Entity\Page $page)
    {
        //if ($this->translations->contains($translation)) {
            $this->pages->removeElement($page);
        //}
    }    

    /**
     *  Get the collection of related pages
     *
     * @return \Doctrine\Common\Collections\ArrayCollection 
     */
    public function getPages()
    {
        return $this->pages;
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
     * Set pc layout file name
     *
     * @param string $filePc
     */
    public function setFilePc($filePc)
    {
        $this->filePc = $filePc;
    }

    /**
     * Get pc layout file name
     *
     * @return string 
     */
    public function getFilePc()
    {
        return $this->filePc;
    }
    
    /**
     * Set mobile layout file name
     *
     * @param string $fileMobile
     */
    public function setFileMobile($fileMobile)
    {
        $this->fileMobile = $fileMobile;
    }
    
    /**
     * Get mobile layout file name
     *
     * @return string
     */
    public function getFileMobile()
    {
        return $this->fileMobile;
    }    

    /**
     * Set configXml
     *
     * @param text $configXml
     */
    public function setConfigXml($configXml)
    {
        $this->configXml = $configXml;
    }

    /**
     * Get configXml
     *
     * @return text 
     */
    public function getConfigXml()
    {
        return $this->configXml;
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
    
    /**
     * Set archived
     *
     * @param boolean $enabled
     */
    public function setArchived($archived)
    {
        $this->archived = $archived;
        return $this;
    }
    
    /**
     * Get archived
     *
     * @return boolean
     */
    public function getArchived()
    {
        return $this->archived;
    }    
}