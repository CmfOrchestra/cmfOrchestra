<?php
/**
 * This file is part of the <Gedmo> project.
 *
 * @category   Gedmo_Entities
 * @package    Entity
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
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
 * PiApp\GedmoBundle\Entity\Partner
 *
 * @ORM\Table(name="gedmo_partner")
 * @ORM\Entity(repositoryClass="PiApp\GedmoBundle\Repository\PartnerRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\TranslationEntity(class="PiApp\GedmoBundle\Entity\Translation\PartnerTranslation")
 *
 * @category   Gedmo_Entities
 * @package    Entity
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class Partner extends AbstractDefault 
{
	/**
	 * List of al translatable fields
	 * 
	 * @var array
	 * @access  protected
	 */
	protected $_fields	= array('title', 'subtitle', 'descriptif', 'content');

	/**
	 * Name of the Translation Entity
	 * 
	 * @var array
	 * @access  protected
	 */
	protected $_translationClass = 'PiApp\GedmoBundle\Entity\Translation\PartnerTranslation';
	
	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection
	 *
	 * @ORM\OneToMany(targetEntity="PiApp\GedmoBundle\Entity\Translation\PartnerTranslation", mappedBy="object", cascade={"persist", "remove"})
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
     * @ORM\Column(name="subtitle", type="string", length=128, nullable=true)
     */
    protected $subtitle;
    
    /**
     * @var text $descriptif
     * 
     * @Gedmo\Translatable
     * @ORM\Column(name="descriptif", type="text", nullable=true)
     */
    protected $descriptif;    

    /**
     * @var string
     * 
     * @Gedmo\Translatable
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    protected $content;   

    /**
     * @var integer $media
     *
     * @ORM\OneToOne(targetEntity="PiApp\GedmoBundle\Entity\Media" , cascade={"all"}, inversedBy="partner");
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id", nullable=true)
     */
    protected $media; 

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
     * @var string $status
     *
     * @ORM\Column(name="status", type="string", nullable=false)
     * @Assert\NotBlank(message = "erreur.status.notblank")
     */
    protected $status;   
    
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
     * Set $title
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
     * Set $subtitle
     *
     * @param string $subtitle
     */    
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }

    /**
     * Get subtitle
     *
     * @return string
     */    
    public function getSubtitle()
    {
        return $this->subtitle;
    }
    
    /**
     * Set descriptif
     *
     * @param text $descriptif
     */
    public function setDescriptif($descriptif)
    {
    	$this->descriptif = $descriptif;
    }
    
    /**
     * Get descriptif
     *
     * @return text
     */
    public function getDescriptif()
    {
    	return $this->descriptif;
    }    

    /**
     * Set $content
     *
     * @param string $content
     */    
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Get content
     *
     * @return string
     */    
    public function getContent()
    {
        return $this->content;
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

}