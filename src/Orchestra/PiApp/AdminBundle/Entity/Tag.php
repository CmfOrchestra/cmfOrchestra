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

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

use BootStrap\TranslationBundle\Model\AbstractTranslation;

/**
 * PiApp\AdminBundle\Entity\Tag
 *
 * @ORM\Table(name="pi_tag")
 * @ORM\Entity(repositoryClass="PiApp\AdminBundle\Repository\TagRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\TranslationEntity(class="PiApp\AdminBundle\Entity\Translation\TagTranslation")
 * 
 * @category   Admin_Entities
 * @package    Entity
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class Tag extends AbstractTranslation
{
	/**
	 * List of al translatable fields
	 *
	 * @var array
	 * @access  protected
	 */
	protected $_fields	= array('groupname', '');
	
	/**
	 * Name of the Translation Entity
	 *
	 * @var array
	 * @access  protected
	 */
	protected $_translationClass = 'PiApp\AdminBundle\Entity\Translation\TagTranslation';
	
	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection
	 *
	 * @ORM\OneToMany(targetEntity="PiApp\AdminBundle\Entity\Translation\TagTranslation", mappedBy="object", cascade={"persist", "remove"})
	 */
	protected $translations;
	
    /**
     * @var bigint $id
     * 
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;  

    /**
     * @var string $groupname
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="groupname", type="string", length=255, nullable=true)
     * @Assert\MinLength(limit = 2, message = "Le nom doit avoir au moins {{ limit }} caractères")
     */
    protected $groupname;
    
    /**
     * @var string
     *
     * @ORM\Column(name="groupnameother", type="string", length=128, nullable=true)
     */
    protected $groupnameother;    
        
    /**
     * @var string $name
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     * @Assert\MinLength(limit = 2, message = "Le nom doit avoir au moins {{ limit }} caractères")
     */
    protected $name;

    /**
     * @var string $color
     *
     * @ORM\Column(name="color", type="string", length=7, nullable=true)
     * @Assert\MinLength(limit = 7, message = "La couleur doit avoir {{ limit }} caractères")
     * @Assert\MaxLength(limit = 7, message = "La couleur doit avoir {{ limit }} caractères")
     */
    protected $color;

    /**
     * @var string $Hicolor
     *
     * @ORM\Column(name="Hicolor", type="string", length=7, nullable=true)
     * @Assert\MinLength(limit = 7, message = "La couleur Hi doit avoir {{ limit }} caractères")
     * @Assert\MaxLength(limit = 7, message = "La couleur Hi doit avoir {{ limit }} caractères")
     */
    protected $Hicolor;
    
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
     * Constructor
     */    
    public function __construct()
    {
    	parent::__construct();
    	
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
     * @ORM\PrePersist
     * @ORM\preUpdate
     */
    public function setUpdatedValue()
    {
    	$other  = $this->getGroupnameother();
    	//print_r($other);exit;
    	if(!empty($other)){
    		$this->setGroupname($other);
    		$this->setGroupnameother('');
    		$this->translate($this->locale)->setGroupname($other);
    		$this->translate($this->locale)->setGroupnameother('');
    	}
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
     * Set groupname
     *
     * @param string $groupname
     */
    public function setGroupname($groupname)
    {
        $this->groupname = $groupname;
    }

    /**
     * Get groupname
     *
     * @return string 
     */
    public function getGroupname()
    {
        return $this->groupname;
    }
    
    /**
     * Set groupname other
     *
     * @param string $groupnameother
     */
    public function setGroupnameother($groupnameother)
    {
    	$this->groupnameother = $groupnameother;
    }
    
    /**
     * Get groupname other
     *
     * @return string
     */
    public function getGroupnameother()
    {
    	return $this->groupnameother;
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
     * Set color
     *
     * @param string $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set Hicolor
     *
     * @param string $hicolor
     */
    public function setHicolor($hicolor)
    {
        $this->Hicolor = $hicolor;
    }

    /**
     * Get Hicolor
     *
     * @return string 
     */
    public function getHicolor()
    {
        return $this->Hicolor;
    }

    /**
     * Set langCode
     *
     * @param \PiApp\AdminBundle\Entity\Langue
     */
    public function setLangCode(\PiApp\AdminBundle\Entity\Langue $langCode)
    {
        $this->langCode = $langCode;
    }

    /**
     * Get langCode
     *
     * @return \PiApp\AdminBundle\Entity\Langue 
     */
    public function getLangCode()
    {
        return $this->langCode;
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