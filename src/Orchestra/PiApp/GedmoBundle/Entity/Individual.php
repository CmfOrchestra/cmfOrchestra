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
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity as UniqueEntity;

use BootStrap\TranslationBundle\Model\AbstractDefault;

/**
 * PiApp\GedmoBundle\Entity\Individual
 *
 * @ORM\Table(name="gedmo_individual")
 * @ORM\Entity(repositoryClass="PiApp\GedmoBundle\Repository\IndividualRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\TranslationEntity(class="PiApp\GedmoBundle\Entity\Translation\IndividualTranslation")
 * @UniqueEntity({"InscrUserName", "InscrEmail"})
 * @category   Gedmo_Entities
 * @package    Entity
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class Individual extends AbstractDefault 
{
	/**
	 * List of al translatable fields
	 * 
	 * @var array
	 * @access  protected
	 */
	protected $_fields	= array();

	/**
	 * Name of the Translation Entity
	 * 
	 * @var array
	 * @access  protected
	 */
	protected $_translationClass = 'PiApp\GedmoBundle\Entity\Translation\IndividualTranslation';
	
	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection
	 *
	 * @ORM\OneToMany(targetEntity="PiApp\GedmoBundle\Entity\Translation\IndividualTranslation", mappedBy="object", cascade={"persist", "remove"})
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
     * @var \Doctrine\Common\Collections\ArrayCollection corporations
     *
     * @ORM\ManyToMany(targetEntity="PiApp\GedmoBundle\Entity\Corporation", mappedBy="partners")
     */
    protected $corporations;    
    
    /**
     * @var \BootStrap\UserBundle\Entity\User $user
     *
     * @ORM\OneToOne(targetEntity="BootStrap\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $user;    

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
     * @ORM\OneToOne(targetEntity="PiApp\GedmoBundle\Entity\Media" , cascade={"all"}, inversedBy="individual");
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id", nullable=true)
     */
    protected $media;

    /**
     * @var string $InscrName
     *
     * @ORM\Column(name="inscr_name", type="string", nullable = true)
     * @Assert\NotBlank()
     */
    protected $InscrName;

    /**
     * @var string $InscrUserName
     *
     * @ORM\Column(name="inscr_user_name", type="string", nullable = true)
     * @Assert\NotBlank()
     */
    protected $InscrUserName;
    
    /**
     * @var string $InscrNickname
     *
     * @ORM\Column(name="inscr_nickname", type="string", nullable = true)
     * @Assert\NotBlank()
     */
    protected $InscrNickname;
    
    /**
     * @var string $InscrEmail
     *
     * @ORM\Column(name="inscr_email", type="string", nullable = true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    protected $InscrEmail;
    
    /**
     * @var string $InscrPhone
     *
     * @ORM\Column(name="inscr_phone", type="string", nullable = true)
     */
    protected $InscrPhone;
    
    /**
     * @var string $InscrJob
     *
     * @ORM\Column(name="inscr_job", type="string", nullable = true)
     * @Assert\NotBlank()
     */
    protected $InscrJob;
    
    /**
     * @var string $EntrCompany
     *
     * @ORM\Column(name="entr_company", type="string", nullable = true)
     * 
     */
    protected $EntrCompany;
    
    /**
     * @var string $EntrActivity
     *
     * @ORM\Column(name="entr_activity", type="string", nullable = true)
     */
    protected $EntrActivity;
    
    /**
     * @var string $EntrBusiness
     *
     * @ORM\Column(name="entr_business", type="string", nullable = true)
     */
    protected $EntrBusiness;
    
    /**
     * @var string $EntrStaff
     *
     * @ORM\Column(name="entr_staff", type="string", nullable = true)
     */
    protected $EntrStaff;    
    
    /**
     * @var string $InscrCp
     *
     * @ORM\Column(name="inscr_cp", type="text", length=255, nullable = true)
     * @Assert\NotBlank()
     */
    protected $InscrCp;    
    
    /**
     * @var string $InscrFacebook
     *
     * @ORM\Column(name="inscr_facebook", type="string", nullable = true)
     */
    protected $InscrFacebook;
    
    /**
     * @var string $InscrGooglePlus
     *
     * @ORM\Column(name="inscr_google_plus", type="string", nullable = true)
     */
    protected $InscrGooglePlus;
    
    /**
     * @var string $InscrTwitter
     *
     * @ORM\Column(name="inscr_twitter", type="string", nullable = true)
     */
    protected $InscrTwitter;
    
    /**
     * @var string $InscrLinkedIn
     *
     * @ORM\Column(name="inscr_linkedin", type="string", nullable = true)
     */
    protected $InscrLinkedIn;
    
    /**
     * @var string $InscrViadeo
     *
     * @ORM\Column(name="inscr_viadeo", type="string", nullable = true)
     */
    protected $InscrViadeo;
    
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
    	return (string) $this->getTradeName();
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
    public function setUser($user)
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
     * Set InscrName
     *
     * @param text $inscrName
     */
    public function setInscrName($inscrName)
    {
        $this->InscrName = $inscrName;
    }

    /**
     * Get InscrName
     *
     * @return text 
     */
    public function getInscrName()
    {
        return $this->InscrName;
    }
    
    /**
     * Set InscrUserName
     *
     * @param text $inscrUserName
     */
    public function setInscrUserName($inscrUserName)
    {
        $this->InscrUserName = $inscrUserName;
    }

    /**
     * Get InscrUserName
     *
     * @return text 
     */
    public function getInscrUserName()
    {
        return $this->InscrUserName;
    }
    
    /**
     * Set InscrNickname
     *
     * @param text $inscrNickname
     */
    public function setInscrNickname($inscrNickname)
    {
        $this->InscrNickname = $inscrNickname;
    }

    /**
     * Get InscrNickname
     *
     * @return text 
     */
    public function getInscrNickname()
    {
        return $this->InscrNickname;
    }
    
    /**
     * Set InscrEmail
     *
     * @param string $InscrEmail
     * @return this
     */
    public function setInscrEmail($InscrEmail)
    {
    	$this->InscrEmail = $InscrEmail;
    	return $this;
    }    
    
    /**
     * Get InscrEmail
     *
     * @return string
     */
    public function getInscrEmail()
    {
    	return $this->InscrEmail;
    }    
    
    /**
     * Set InscrPhone
     *
     * @param text $inscrPhone
     */
    public function setInscrPhone($inscrPhone)
    {
        $this->InscrPhone = $inscrPhone;
    }

    /**
     * Get InscrPhone
     *
     * @return text 
     */
    public function getInscrPhone()
    {
        return $this->InscrPhone;
    }

    /**
     * Set InscrJob
     *
     * @param text $inscrJob
     */
    public function setInscrJob($inscrJob)
    {
        $this->InscrJob = $inscrJob;
    }

    /**
     * Get InscrJob
     *
     * @return text 
     */
    public function getInscrJob()
    {
        return $this->InscrJob;
    }

    /**
     * Set EntrCompany
     *
     * @param text $entrCompany
     */
    public function setEntrCompany($entrCompany)
    {
        $this->EntrCompany = $entrCompany;
    }

    /**
     * Get EntrCompany
     *
     * @return text 
     */
    public function getEntrCompany()
    {
        return $this->EntrCompany;
    }

    /**
     * Set EntrActivity
     *
     * @param text $entrActivity
     */
    public function setEntrActivity($entrActivity)
    {
        $this->EntrActivity = $entrActivity;
    }

    /**
     * Get EntrActivity
     *
     * @return text 
     */
    public function getEntrActivity()
    {
        return $this->EntrActivity;
    }

    /**
     * Set EntrBusiness
     *
     * @param text $entrBusiness
     */
    public function setEntrBusiness($entrBusiness)
    {
        $this->EntrBusiness = $entrBusiness;
    }

    /**
     * Get EntrBusiness
     *
     * @return text 
     */
    public function getEntrBusiness()
    {
        return $this->EntrBusiness;
    }

    /**
     * Set EntrStaff
     *
     * @param text $entrStaff
     */
    public function setEntrStaff($entrStaff)
    {
        $this->EntrStaff = $entrStaff;
    }

    /**
     * Get EntrStaff
     *
     * @return text 
     */
    public function getEntrStaff()
    {
        return $this->EntrStaff;
    }
    
    /**
     * Set InscrCp
     *
     * @param string $InscrCp
     * @return this
     */
    public function setInscrCp($InscrCp)
    {
    	$this->InscrCp = $InscrCp;
    	return $this;
    }
    
    /**
     * Get InscrCp
     *
     * @return string
     */
    public function getInscrCp()
    {
    	return $this->InscrCp;
    }
    
    /**
     * Set InscrFacebook
     *
     * @param string $InscrFacebook
     * @return this
     */
    public function setInscrFacebook($InscrFacebook)
    {
    	$this->InscrFacebook = $InscrFacebook;
    	return $this;
    }
    
    /**
     * Get InscrFacebook
     *
     * @return string
     */
    public function getInscrFacebook()
    {
    	return $this->InscrFacebook;
    }   
    
    /**
     * Set InscrGooglePlus
     *
     * @param string $InscrGooglePlus
     * @return this
     */
    public function setInscrGooglePlus($InscrGooglePlus)
    {
    	$this->InscrGooglePlus = $InscrGooglePlus;
    	return $this;
    }
    
    /**
     * Get InscrGooglePlus
     *
     * @return string
     */
    public function getInscrGooglePlus()
    {
    	return $this->InscrGooglePlus;
    }   
    
    /**
     * Set InscrTwitter
     *
     * @param string $InscrTwitter
     * @return this
     */
    public function setInscrTwitter($InscrTwitter)
    {
    	$this->InscrTwitter = $InscrTwitter;
    	return $this;
    }
    
    /**
     * Get InscrTwitter
     *
     * @return string
     */
    public function getInscrTwitter()
    {
    	return $this->InscrTwitter;
    }   
    
    /**
     * Set InscrLinkedIn
     *
     * @param string $InscrLinkedIn
     * @return this
     */
    public function setInscrLinkedIn($InscrLinkedIn)
    {
    	$this->InscrLinkedIn = $InscrLinkedIn;
    	return $this;
    }
    
    /**
     * Get InscrLinkedIn
     *
     * @return string
     */
    public function getInscrLinkedIn()
    {
    	return $this->InscrLinkedIn;
    }   
    
    /**
     * Set InscrViadeo
     *
     * @param string $InscrViadeo
     * @return this
     */
    public function setInscrViadeo($InscrViadeo)
    {
    	$this->InscrViadeo = $InscrViadeo;
    	return $this;
    }
    
    /**
     * Get InscrViadeo
     *
     * @return string
     */
    public function getInscrViadeo()
    {
    	return $this->InscrViadeo;
    }   
}