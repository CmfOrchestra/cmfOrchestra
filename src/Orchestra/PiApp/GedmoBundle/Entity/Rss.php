<?php
/**
 * This file is part of the <Gedmo> project.
 *
 * @category   Gedmo_Entities
 * @package    Entity
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
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
 * PiApp\GedmoBundle\Entity\Rss
 *
 * @ORM\Table(name="gedmo_rss")
 * @ORM\Entity(repositoryClass="PiApp\GedmoBundle\Repository\RssRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\TranslationEntity(class="PiApp\GedmoBundle\Entity\Translation\RssTranslation")
 *
 * @category   Gedmo_Entities
 * @package    Entity
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class Rss extends AbstractDefault 
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
	protected $_translationClass = 'PiApp\GedmoBundle\Entity\Translation\RssTranslation';
	
	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection
	 *
	 * @ORM\OneToMany(targetEntity="PiApp\GedmoBundle\Entity\Translation\RssTranslation", mappedBy="object", cascade={"persist", "remove"})
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
     * @var \Doctrine\Common\Collections\ArrayCollection $users
     *
     * @ORM\ManyToMany(targetEntity="BootStrap\UserBundle\Entity\User",  inversedBy="rssneeds")
     * @ORM\JoinTable(name="gedmo_rss_has_user",
     *      joinColumns={@ORM\JoinColumn(name="rss_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}
     *      )
     */
    protected $users;
    
    
    /**
     * @var \PiApp\GedmoBundle\Entity\Category $category
     * 
     * @ORM\ManyToOne(targetEntity="PiApp\GedmoBundle\Entity\Category", inversedBy="items_rss")
     * @ORM\JoinColumn(name="category", referencedColumnName="id", nullable=true)
     */
    protected $category;    
    
    /**
     * @var string $configCssClass
     *
     * @ORM\Column(name="config_css_class", type="string", nullable=true)
     */
    protected $configCssClass;    
    
    /**
     * @var string
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="string", length=128, nullable=false)
     */
    protected $title;
    
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
     * @var \PiApp\GedmoBundle\Entity\Media $media
     *
     * @ORM\OneToOne(targetEntity="PiApp\GedmoBundle\Entity\Media" , cascade={"all"}, inversedBy="rss");
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id", nullable=true)
     */
    protected $media;    
    
    /**
     * Constructor
     */    
    public function __construct()
    {
    	parent::__construct();
    	
    	$this->users			= new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set all users
     *
     * @param \Doctrine\Common\Collections\ArrayCollection $users
     */
    public function setUsers(\Doctrine\Common\Collections\ArrayCollection $users)
    {
    	$this->users = $users;
    	return $this;
    }
    
    /**
     * Get all users
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getUsers()
    {
    	return $this->users;
    }
    
    /**
     * Add users
     *
     * @param \BootStrap\UserBundle\Entity\User $users
     */
    public function addUser(\BootStrap\UserBundle\Entity\User $users)
    {
    	if(!$this->users->contains($users)){
    		$this->users->add($users);
    	}
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
     * Set configCssClass
     *
     * @param string $configCssClass
     */
    public function setConfigCssClass($configCssClass)
    {
        $this->configCssClass = $configCssClass;
    }

    /**
     * Get configCssClass
     *
     * @return string 
     */
    public function getConfigCssClass()
    {
        return $this->configCssClass;
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