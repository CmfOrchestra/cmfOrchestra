<?php
/**
 * This file is part of the <Gedmo> project.
 *
 * @category   Gedmo_Entities
 * @package    Entity
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-03-08
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
 * PiApp\DemoBundle\Entity\Pressrelease
 *
 * @ORM\Table(name="gedmo_pressrelease")
 * @ORM\Entity(repositoryClass="PiApp\GedmoBundle\Repository\PressreleaseRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\TranslationEntity(class="PiApp\GedmoBundle\Entity\Translation\PressreleaseTranslation")
 *
 * @category   Gedmo_Entities
 * @package    Entity
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class Pressrelease extends AbstractDefault
{
	/**
	 * List of al translatable fields
	 *
	 * @var array
	 * @access  protected
	 */
	protected $_fields	= array('title', 'pressemedia');
	
	/**
	 * Name of the Translation Entity
	 *
	 * @var array
	 * @access  protected
	 */
	protected $_translationClass = 'PiApp\GedmoBundle\Entity\Translation\PressreleaseTranslation';	
	
	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection
	 *
	 * @ORM\OneToMany(targetEntity="PiApp\GedmoBundle\Entity\Translation\PressreleaseTranslation", mappedBy="object", cascade={"persist", "remove"})
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
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=128, nullable=true)
     */
    protected $category;  

    /**
     * @var string
     * 
     * @ORM\Column(name="categoryother", type="string", length=128, nullable=true)
     */
    protected $categoryother; 
        
    /**
     * @var string
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="string", length=128, nullable=false)
     */
    protected $title;
    
    /**
     * @var string
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="pressmedia", type="string", length=128, nullable=true)
     */
    protected $pressmedia;
    
    /**
     * @var integer $pageurl
     *
     * @ORM\ManyToOne(targetEntity="PiApp\AdminBundle\Entity\Page")
     * @ORM\JoinColumn(name="page_intro_id", referencedColumnName="id", nullable=true)
     */
    protected $pageurl;    
    
    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=314, nullable=true)
     */
    protected $url;
    
    /**
     * @var integer $media
     *
     * @ORM\OneToOne(targetEntity="PiApp\GedmoBundle\Entity\Media" , cascade={"all"}, inversedBy="pressrelease");
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id", nullable=true)
     */
    protected $media;    
    
    /**
     * Constructor
     */    
    public function __construct()
    {
    	parent::__construct();
    }    
    
    public function __toString()
    {
    	return (string) $this->getTitle();
    }    
    
    /**
     * @ORM\PrePersist
     * @ORM\preUpdate
     */
    public function setUpdatedValue()
    {
    	$other  = $this->getCategoryother();
    	if(!empty($other)){
    		$this->setCategory($other);
    		$this->setCategoryother('');
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
     * Set category
     *
     * @param string $category
     */
    public function setCategory($category)
    {
   		$this->category = $category;
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
     * Set category
     *
     * @param string $category
     */
    public function setCategoryother($category)
    {
   		$this->categoryother = $category;
    }
    
    /**
     * Get category
     *
     * @return string
     */
    public function getCategoryother()
    {
    	return $this->categoryother;
    }    
        
    /**
     * Set title
     *
     * @param string $title
     */    
    public function setTitle($title)
    {
        $this->title = $title;
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
     * Set pressmedia
     *
     * @param string $pressmedia
     */
    public function setPressmedia($pressmedia)
    {
    	$this->pressmedia = $pressmedia;
    }
    
    /**
     * Get pressmedia
     *
     * @return string
     */
    public function getPressmedia()
    {
    	return $this->pressmedia;
    }    

    /**
     * Set page url
     *
     * @param \PiApp\AdminBundle\Entity\Page
     */
    public function setPageurl($pageurl)
    {
    	$this->pageurl = $pageurl;
    	return $this;
    }
    
    /**
     * Get page url
     *
     * @return \PiApp\AdminBundle\Entity\Page
     */
    public function getPageurl()
    {
    	return $this->pageurl;
    }    

    /**
     * Set $url
     *
     * @param string $url
     */
    public function setUrl($url)
    {
    	$this->url = $url;
    	return $this;
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
     * Set media
     *
     * @param \PiApp\GedmoBundle\Entity\Media $media
     */
    public function setMedia($media)
    {
    	$this->media = $media;    	
    	return $this;
    }
    
    /**
     * Get media
     *
     * @return \PiApp\GedmoBundle\Entity\Media
     */
    public function getMedia()
    {
    	return $this->media;
    }    
            
}