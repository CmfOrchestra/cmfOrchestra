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
 * PiApp\GedmoBundle\Entity\Ads
 *
 * @ORM\Table(name="gedmo_ads")
 * @ORM\Entity(repositoryClass="PiApp\GedmoBundle\Repository\AdsRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\TranslationEntity(class="PiApp\GedmoBundle\Entity\Translation\AdsTranslation")
 *
 * @category   Gedmo_Entities
 * @package    Entity
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class Ads extends AbstractDefault 
{
	/**
	 * List of al translatable fields
	 * 
	 * @var array
	 * @access  protected
	 */
	protected $_fields	= array('title',  'content');

	/**
	 * Name of the Translation Entity
	 * 
	 * @var array
	 * @access  protected
	 */
	protected $_translationClass = 'PiApp\GedmoBundle\Entity\Translation\AdsTranslation';
	
	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection
	 *
	 * @ORM\OneToMany(targetEntity="PiApp\GedmoBundle\Entity\Translation\AdsTranslation", mappedBy="object", cascade={"persist", "remove"})
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
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="PiApp\GedmoBundle\Entity\Contact", mappedBy="ads")
     */
    protected $responses;
        
    /**
     * @var integer $user
     *
     * @ORM\ManyToOne(targetEntity="BootStrap\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    protected $user;    
    
    /**
     * @var string $status
     *
     * @ORM\Column(name="status", type="string", nullable=false)
     * @Assert\NotBlank(message = "erreur.status.notblank")
     */
    protected $status;    
    
    /**
     * @var string $typology
     *
     * @ORM\Column(name="typology", type="string", nullable=false)
     * @Assert\NotBlank(message = "erreur.status.notblank")
     */
    protected $typology;    
    
    /**
     * @var string $title
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="text", nullable = true)
     */
    protected $title;   
    
    /**
     * @var string
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    protected $content;
    
    /**
     * @var string $author
     *
     * @ORM\Column(name="author", type="string", length=255, nullable = true)
     */
    protected $author;    
    
    /**
     * @var integer $media
     *
     * @ORM\OneToOne(targetEntity="PiApp\GedmoBundle\Entity\Media" , cascade={"all"}, inversedBy="ads");
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id", nullable=true)
     */
    protected $media;   

    /**
     * @var datetime $expired_at
     *
     * @ORM\Column(name="expired_at", type="datetime", nullable=true)
     */
    protected $expired_at;    
    
    /**
     * Constructor
     */    
    public function __construct()
    {
    	parent::__construct();
    	
    	$this->responses 	 = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set user
     *
     * @param \BootStrap\UserBundle\Entity\User
     */
    public function setUser(\BootStrap\UserBundle\Entity\User $user)
    {
    	$this->user = $user;
    }
    
    /**
     * Get user
     *
     * @return \BootStrap\UserBundle\Entity\User
     */
    public function getUser()
    {
    	return $this->user;
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
     * Set typology
     *
     * @param string $typology
     */
    public function setTypology($typology)
    {
    	$this->typology = $typology;
    	return $this;
    }
    
    /**
     * Get typology
     *
     * @return string
     */
    public function getTypology()
    {
    	return $this->typology;
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
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
    	return $this->content;
    }
    
    /**
     * Set content
     *
     * @param string $text
     */
    public function setContent($text)
    {
    	$this->content = $text;
    	return $this;
    }
    
    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
    	return $this->author;
    }
    
    /**
     * Set author
     *
     * @param string $author
     */
    public function setAuthor($author)
    {
    	$this->author = $author;
    	return $this;
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
     * Set expired_at
     *
     * @param datetime $expiredAt
     */
    public function setExpiredAt($expiredAt)
    {
    	$this->expired_at = $expiredAt;
    	return $this;
    }
    
    /**
     * Get expired_at
     *
     * @return datetime
     */
    public function getExpiredAt()
    {
    	return $this->expired_at;
    }    
    
    /**
     * Get responses
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getResponses()
    {
    	return $this->responses;
    }    

    /**
     * Add responses
     *
     * @param PiApp\GedmoBundle\Entity\Contact $responses
     */
    public function addResponse(\PiApp\GedmoBundle\Entity\Contact $responses)
    {
        $this->responses[] = $responses;
    }
}