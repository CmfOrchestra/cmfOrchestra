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
use PiApp\AdminBundle\Validator\Constraints as MyAssert;

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
     * @var \PiApp\GedmoBundle\Entity\Category $category
     * 
     * @ORM\ManyToOne(targetEntity="PiApp\GedmoBundle\Entity\Category", inversedBy="items_partner")
     * @ORM\JoinColumn(name="category", referencedColumnName="id", nullable=true)
     */
    protected $category;    

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
     * @var \PiApp\GedmoBundle\Entity\Media $media
     *
     * @ORM\OneToOne(targetEntity="PiApp\GedmoBundle\Entity\Media" , cascade={"all"}, inversedBy="partner");
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id", nullable=true)
     */
    protected $media; 

    /**
     * @var \PiApp\AdminBundle\Entity\Page $pageurl
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
     * @var boolean $highlighted1
     *
     * @ORM\Column(name="highlighted1", type="boolean", nullable=true)
     * @MyAssert\MaxEntitiesByQuery(entity="PiAppGedmoBundle:Partner", field="{'highlighted1':true,'enabled':true}", max="4", message="pi.partner.form.field.highlighted1.max")
     */
    protected $highlighted1;   

    /**
     * @var boolean $highlighted2
     *
     * @ORM\Column(name="highlighted2", type="boolean", nullable=true)
     * @MyAssert\MaxEntitiesByQuery(entity="PiAppGedmoBundle:Partner", field="{'highlighted2':true,'enabled':true}", max="12", message="pi.partner.form.field.highlighted2.max")
     */
    protected $highlighted2;    

    /**
     * @var boolean $highlighted3
     *
     * @ORM\Column(name="highlighted3", type="boolean", nullable=true)
     * @MyAssert\MaxEntitiesByQuery(entity="PiAppGedmoBundle:Partner", field="{'highlighted3':true,'enabled':true}", max="4", message="pi.partner.form.field.highlighted3.max")
     */
    protected $highlighted3;    
    
    /**
     * Constructor
     */    
    public function __construct()
    {
    	parent::__construct();
    	
    	$this->events	= new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param \PiApp\GedmoBundle\Entity\Category $category
     */
    public function setCategory($category)
    {
    	$this->category = $category;
    	return $this;
    }
    
    /**
     * Get category
     *
     * @return \PiApp\GedmoBundle\Entity\Category
     */
    public function getCategory()
    {
    	return $this->category;
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
    public function setDescriptif ($descriptif)
    {
    	$this->descriptif = $descriptif;
    }
    
    /**
     * Get descriptif
     *
     * @return text
     */
    public function getDescriptif ()
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
     * Set highlighted1
     *
     * @param string $highlighted
     */
    public function setHighlighted1($highlighted)
    {
    	$this->highlighted1 = $highlighted;
    }
    
    /**
     * Get highlighted
     *
     * @return string
     */
    public function getHighlighted1()
    {
    	return $this->highlighted1;
    }    
    
    /**
     * Set highlighted2
     *
     * @param string $highlighted
     */
    public function setHighlighted2($highlighted)
    {
    	$this->highlighted2 = $highlighted;
    }
    
    /**
     * Get highlighted2
     *
     * @return string
     */
    public function getHighlighted2()
    {
    	return $this->highlighted2;
    }    
    
    /**
     * Set highlighted3
     *
     * @param string $highlighted
     */
    public function setHighlighted3($highlighted)
    {
    	$this->highlighted3 = $highlighted;
    }
    
    /**
     * Get highlighted3
     *
     * @return string
     */
    public function getHighlighted3()
    {
    	return $this->highlighted3;
    }    
    
    

}