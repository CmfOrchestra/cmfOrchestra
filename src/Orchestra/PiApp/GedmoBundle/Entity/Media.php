<?php
/**
 * This file is part of the <Gedmo> project.
 *
 * @category   Gedmo_Entities
 * @package    Entity
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-07-31
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\GedmoBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use BootStrap\TranslationBundle\Model\AbstractDefault;

/**
 * PiApp\GedmoBundle\Entity\Media
 *
 * @ORM\Table(name="gedmo_media")
 * @ORM\Entity(repositoryClass="PiApp\GedmoBundle\Repository\MediaRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\TranslationEntity(class="PiApp\GedmoBundle\Entity\Translation\MediaTranslation")
 *
 * @category   Gedmo_Entities
 * @package    Entity
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class Media extends AbstractDefault 
{
	/**
	 * List of al translatable fields
	 *
	 * @var array
	 * @access  protected
	 */
	protected $_fields	= array('title');
	
	/**
	 * Name of the Translation Entity
	 *
	 * @var array
	 * @access  protected
	*/
	protected $_translationClass = 'PiApp\GedmoBundle\Entity\Translation\MediaTranslation';
	
	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection
	 *
	 * @ORM\OneToMany(targetEntity="PiApp\GedmoBundle\Entity\Translation\MediaTranslation", mappedBy="object", cascade={"persist", "remove"})
	 */
	protected $translations;
		
    /**
     * @var bigint
     * 
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="PiApp\GedmoBundle\Entity\Category", inversedBy="items_medias")
     * @ORM\JoinColumn(name="category", referencedColumnName="id", nullable=true)
     */
    protected $category;    
    
    /**
     * @var string $status
     *
     * @ORM\Column(name="status", type="string", nullable=false)
     * @Assert\NotBlank(message = "erreur.status.notblank")
     */
    protected $status;    

    /**
     * @var string $title
     * 
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="string", length=255, nullable = true)
     */
    protected $title;      
    
    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=314, nullable=true)
     */
    protected $url;    
    
    /**
     * @var integer $image
     *
     * @ORM\ManyToOne(targetEntity="BootStrap\MediaBundle\Entity\Media", cascade={"all"})
     * @ORM\JoinColumn(name="media", referencedColumnName="id", nullable=true)
     */
    protected $image;
    
    /**
     * @var integer $image
     *
     * @ORM\Column(name="mediaId", type="integer", nullable=true)
     */
    protected $mediaId;    
    
    /**
     * @var boolean $mediadelete
     *
     * @ORM\Column(name="mediadelete", type="boolean", nullable=true)
     */
    protected $mediadelete; 

    
    
    
    
    /**
     * @ORM\OneToOne(targetEntity="PiApp\GedmoBundle\Entity\Individual", mappedBy="media");
     */
    protected $individual;
        
    /**
     * @ORM\OneToOne(targetEntity="PiApp\GedmoBundle\Entity\Corporation", mappedBy="media");
     */
    protected $corporation;
        
    /**
     * @ORM\OneToOne(targetEntity="PiApp\GedmoBundle\Entity\Newsletter", mappedBy="media");
     */
    protected $newsletter;    
    
    /**
     * @ORM\OneToOne(targetEntity="PiApp\GedmoBundle\Entity\Rss", mappedBy="media");
     */
    protected $rss;    

    /**
     * @ORM\OneToOne(targetEntity="PiApp\GedmoBundle\Entity\Ads", mappedBy="media");
     */
    protected $ads;
        
    /**
     * @ORM\OneToOne(targetEntity="PiApp\GedmoBundle\Entity\Partner", mappedBy="media");
     */
    protected $partner;
    /**
     * @ORM\OneToOne(targetEntity="PiApp\GedmoBundle\Entity\Pressrelease", mappedBy="media");
     */
    protected $pressrelease;    
    /**
     * @ORM\OneToOne(targetEntity="PiApp\GedmoBundle\Entity\News", mappedBy="media");
     */
    protected $news;    
    /**
     * @ORM\OneToOne(targetEntity="PiApp\GedmoBundle\Entity\Contact", mappedBy="media");
     */
    protected $contact1;
    
    /**
     * @ORM\OneToOne(targetEntity="PiApp\GedmoBundle\Entity\Contact", mappedBy="media1");
     */
    protected $contact2;
    /**
     * @ORM\OneToOne(targetEntity="PiApp\GedmoBundle\Entity\Menu", mappedBy="media");
     */
    protected $menu;    
    
    /**
     * @ORM\OneToOne(targetEntity="PiApp\GedmoBundle\Entity\Menu", mappedBy="media");
     */
    protected $slider;    
    
    /**
     * @ORM\OneToOne(targetEntity="PiApp\GedmoBundle\Entity\Menu", mappedBy="media");
     */
    protected $block; 

    /**
     * @ORM\OneToOne(targetEntity="PiApp\GedmoBundle\Entity\Menu", mappedBy="media");
     */
    protected $organigram; 
    
    
    /**
     * Constructor
     */    
    public function __construct()
    {
    	parent::__construct();
    }    
    
    /**
     *
     * This method is used when you want to convert to string an object of
     * this Entity
     * ex: $value = (string)$entity;
     *
     */    
    public function __toString()
    {
    	return (string) $this->getCategory() . " > " .$this->getTitle();
    }   
    
	/**
     * @ORM\PrePersist
     * @ORM\preUpdate
     */
    public function setUpdatedValue()
    {
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
     * Set category
     *
     * @param string $category
     */
    public function setCategory($category)
    {
    	$this->category = $category;
    	return $this;
    }
    
    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
    	return $this->category;
    }    
    
    /**
     * Set status
     *
     * @param string $status
     */
    public function setStatus($status)
    {
    	$this->status = $status;
    	return $this;
    }
    
    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
    	return $this->status;
    }    
    
    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
    	$this->title = $title;
    	return $this;
    }
    
    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
    	return $this->title;
    }   

    /**
     * Set $url
     *
     * @param string $url
     */
    public function setUrl($url)
    {
    	$this->url = $url;
    }
    
    /**
     * Get $url
     *
     * @return string
     */
    public function getUrl()
    {
    	return $this->url;
    }

    /**
     * Set image
     *
     * @param \BootStrap\MediaBundle\Entity\Media $image
     */
    public function setImage(\BootStrap\MediaBundle\Entity\Media $image)
    {
    	$this->image 	= $image;
    	$this->mediaId 	= $image->getId();
    	return $this;
    }
    
    /**
     * Get image
     *
     * @return \BootStrap\MediaBundle\Entity\Media
     */
    public function getImage()
    {
    	return $this->image;
    }    
    
    /**
     * Get media ID
     *
     * @return integer
     */
    public function setMediaId($mediaId)
    {
    	$this->mediaId = $mediaId;
    }    
    
    /**
     * Get media ID
     *
     * @return integer
     */
    public function getMediaId()
    {
    	return $this->mediaId;
    }    
    
    /**
     * Set mediadelete
     *
     * @param boolean $mediadelete
     */
    public function setMediadelete($mediadelete)
    {
    	$this->mediadelete = $mediadelete;
    	return $this;
    }
    
    /**
     * Get mediadelete
     *
     * @return boolean
     */
    public function getMediadelete()
    {
    	return $this->mediadelete;
    }  

    
    /**
     * Get image
     *
     * @return \BootStrap\MediaBundle\Entity\Media
     */
    public function getIndividual()
    {
    	return $this->individual;
    }
    public function getCorporation()
    {
    	return $this->corporation;
    }
    public function getNewsletter()
    {
    	return $this->newsletter;
    }
    public function getRss()
    {
    	return $this->rss;
    }
    public function getAds()
    {
    	return $this->ads;
    }

    
    public function getPartner()
    {
    	return $this->partner;
    }    
    public function getPressrelease()
    {
    	return $this->pressrelease;
    }    
    public function getNews()
    {
    	return $this->news;
    }    
    public function getContact1()
    {
    	return $this->contact1;
    }
    public function getContact2()
    {
    	return $this->contact2;
    }    
    public function getMenu()
    {
    	return $this->menu;
    }
    public function getSlider()
    {
    	return $this->slider;
    }
    public function getBlock()
    {
    	return $this->block;
    }
    public function getOrganigram()
    {
    	return $this->organigram;
    }        
  
    
}