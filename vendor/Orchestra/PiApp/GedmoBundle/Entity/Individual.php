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
 * @ORM\Table(name="gedmo_individual",
 *          indexes={@ORM\Index(name="name_idx", columns={"user_name"})}
 * )
 * @ORM\Entity(repositoryClass="PiApp\GedmoBundle\Repository\IndividualRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\TranslationEntity(class="PiApp\GedmoBundle\Entity\Translation\IndividualTranslation")
 * @UniqueEntity({"UserName", "Email"})
 * 
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
    protected $_fields    = array('DetailActivity', 'ArgumentActivity');

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
     * @ORM\ManyToMany(targetEntity="PiApp\GedmoBundle\Entity\Corporation", mappedBy="individuals")
     */
    protected $corporations;    
    
    /**
     * @var \BootStrap\UserBundle\Entity\User $user
     *
     * @ORM\OneToOne(targetEntity="BootStrap\UserBundle\Entity\User", cascade={"all"}, inversedBy="individual")
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
     * @var boolean $highlighted
     *
     * @ORM\Column(name="highlighted", type="boolean", nullable=true)
     */
    protected $highlighted;  
    
    /**
     * @var string $Name
     *
     * @ORM\Column(name="name", type="string", nullable = true)
     * @Assert\NotBlank()
     */
    protected $Name;

    /**
     * @var string $UserName
     *
     * @ORM\Column(name="user_name", type="string", nullable = true)
     * @Assert\NotBlank()
     */
    protected $UserName;
    
    /**
     * @var string $Nickname
     *
     * @ORM\Column(name="nickname", type="string", nullable = true)
     * @Assert\NotBlank()
     */
    protected $Nickname;
    
    /**
     * @var string $Civility
     *
     * @ORM\Column(name="civility", type="string", nullable = true)
     */
    protected $Civility;
    
    /**
     * @var string $Email
     *
     * @ORM\Column(name="email", type="string", nullable = true)
     * @Assert\NotBlank()
     * @Assert\Email(message="erreur.lamelee.mail.existed")
     */
    protected $Email;
    
    /**
     * @var string $EmailPerso
     *
     * @ORM\Column(name="email_perso", type="string", nullable = true)
     * 
     */
    protected $EmailPerso;
    
    /**
     * @var string $Phone
     *
     * @ORM\Column(name="phone", type="string", nullable = true)
     */
    protected $Phone;
    
    /**
     * @var integer $CP
     *
     * @ORM\Column(name="cp", type="integer", length=255, nullable = true)
     * 
     */
    protected $CP ;
    
    /**
     * @var string $Job
     *
     * @ORM\Column(name="job", type="string", nullable = true)
     * 
     */
    protected $Job;
    
    /**
     * @var string $Profile
     *
     * @ORM\Column(name="profile", type="string", nullable = true)
     */
    protected $Profile;
    
    /**
     * @var string $ProfileOther
     *
     * @ORM\Column(name="profile_other", type="string", nullable = true)
     * 
     */
    protected $ProfileOther;
    
    /**
     * @var string $Company
     *
     * @ORM\Column(name="company", type="string", nullable = true)
     * 
     */
    protected $Company;
    
    /**
     * @var integer $Effectif
     *
     * @ORM\Column(name="effectif", type="integer", length=255, nullable = true)
     * 
     */
    protected $Effectif ;   
    
    /**
     * @var string $Activity
     *
     * @ORM\Column(name="activity", type="string", nullable = true)
     */
    protected $Activity;
    
    /**
     * @var string $Engineering
     *
     * @ORM\Column(name="engineering", type="string", nullable = true)
     */
    protected $Engineering;
    
    /**
     * @var string $DetailActivity
     * 
     * @Gedmo\Translatable
     * @ORM\Column(name="detail_activity", type="string", nullable = true)
     */
    protected $DetailActivity;
    
    /**
     * @var string $ArgumentActivity
     * 
     * @Gedmo\Translatable
     * @ORM\Column(name="argument_activity", type="string", nullable = true)
     */
    protected $ArgumentActivity;
    
    /**
     * @var string $Expertise
     *
     * @ORM\Column(name="expertise", type="string", nullable = true)
     */
    protected $Expertise;
    
    /**
     * @var string $Speaker
     *
     * @ORM\Column(name="speaker", type="string", nullable = true)
     */
    protected $Speaker;    
    
    /**
     * @var string $OriginContact
     *
     * @ORM\Column(name="origin_contact", type="string", length=255, nullable = true)
     * 
     */
    protected $OriginContact;    
    
    /**
     * @var string $OriginContactOther
     *
     * @ORM\Column(name="origin_contact_other", type="string", nullable = true)
     * 
     */
    protected $OriginContactOther;
    
    /**
     * @var string $OriginContactSponsor
     *
     * @ORM\Column(name="origin_contact_sponsor", type="string", nullable = true)
     * 
     */
    protected $OriginContactSponsor;
    
    /**
     * @var string $Facebook
     *
     * @ORM\Column(name="facebook", type="string", nullable = true)
     */
    protected $Facebook;
    
    /**
     * @var string $GooglePlus
     *
     * @ORM\Column(name="google_plus", type="string", nullable = true)
     */
    protected $GooglePlus;
    
    /**
     * @var string $Twitter
     *
     * @ORM\Column(name="twitter", type="string", nullable = true)
     */
    protected $Twitter;
    
    /**
     * @var string $LinkedIn
     *
     * @ORM\Column(name="linkedin", type="string", nullable = true)
     */
    protected $LinkedIn;
    
    /**
     * @var string $Viadeo
     *
     * @ORM\Column(name="viadeo", type="string", nullable = true)
     */
    protected $Viadeo;
    
    /**
     * @var boolean $paymentstatus
     *
     * @ORM\Column(name="paymentstatus", type="boolean", nullable=false)
     */
    protected $paymentstatus = false; 
    
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
        return (string) $this->getNickname() . ' ' . $this->getName();
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
     * Set highlighted
     *
     * @param string $highlighted
     */
    public function setHighlighted($highlighted)
    {
        $this->highlighted = $highlighted;
    }
    
    /**
     * Get highlighted
     *
     * @return string
     */
    public function getHighlighted()
    {
        return $this->highlighted;
    }   
    
    /**
     * Set Name
     *
     * @param text $Name
     */
    public function setName($Name)
    {
        $this->Name = $Name;
    }

    /**
     * Get Name
     *
     * @return text 
     */
    public function getName()
    {
        return $this->Name;
    }
    
    /**
     * Set UserName
     *
     * @param text $UserName
     */
    public function setUserName($UserName)
    {
        $this->UserName = $UserName;
    }

    /**
     * Get UserName
     *
     * @return text 
     */
    public function getUserName()
    {
        return $this->UserName;
    }
    
    /**
     * Set Nickname
     *
     * @param text $Nickname
     */
    public function setNickname($Nickname)
    {
        $this->Nickname = $Nickname;
    }

    /**
     * Get Nickname
     *
     * @return text 
     */
    public function getNickname()
    {
        return $this->Nickname;
    }
    
    /**
     * Set Civility
     *
     * @param text $Civility
     */
    public function setCivility($Civility)
    {
        $this->Civility = $Civility;
    }

    /**
     * Get Civility
     *
     * @return string 
     */
    public function getCivility()
    {
        return $this->Civility;
    }
    
    /**
     * Set Email
     *
     * @param string $Email
     * @return this
     */
    public function setEmail($Email)
    {
        $this->Email = $Email;
        return $this;
    }    
    
    /**
     * Get Email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->Email;
    }    
    
    /**
     * Set EmailPerso
     *
     * @param string $EmailPerso
     * @return this
     */
    public function setEmailPerso($EmailPerso)
    {
        $this->EmailPerso = $EmailPerso;
        return $this;
    }    
    
    /**
     * Get EmailPerso
     *
     * @return string
     */
    public function getEmailPerso()
    {
        return $this->EmailPerso;
    }    
    
    /**
     * Set Phone
     *
     * @param text $Phone
     */
    public function setPhone($Phone)
    {
        $this->Phone = $Phone;
    }

    /**
     * Get Phone
     *
     * @return text 
     */
    public function getPhone()
    {
        return $this->Phone;
    }
        
    /**
     * Set CP
     *
     * @param integer $CP
     */
    public function setCP($CP)
    {
        $this->CP = $CP;
    }
    
    /**
     * Get CP
     *
     * @return integer
     */
    public function getCP()
    {
        return $this->CP;
    }   
    
    /**
     * Set Job
     *
     * @param string $Job
     */
    public function setJob($Job)
    {
        $this->Job = $Job;
    }

    /**
     * Get Job
     *
     * @return string 
     */
    public function getJob()
    {
        return $this->Job;
    }

    /**
     * Set Profile
     *
     * @param string $Profile
     */
    public function setProfile($Profile)
    {
        $this->Profile = $Profile;
    }

    /**
     * Get Profile
     *
     * @return string 
     */
    public function getProfile()
    {
        return $this->Profile;
    }

    /**
     * Set ProfileOther
     *
     * @param string $ProfileOther
     */
    public function setProfileOther($ProfileOther)
    {
        $this->ProfileOther = $ProfileOther;
    }

    /**
     * Get ProfileOther
     *
     * @return string 
     */
    public function getProfileOther()
    {
        return $this->ProfileOther;
    }
    
    /**
     * Set Company
     *
     * @param text $Company
     */
    public function setCompany($Company)
    {
        $this->Company = $Company;
    }

    /**
     * Get Company
     *
     * @return text 
     */
    public function getCompany()
    {
        return $this->Company;
    }
        
    /**
     * Set Effectif
     *
     * @param integer $Effectif
     */
    public function setEffectif ($Effectif)
    {
        $this->Effectif = $Effectif;
    }
    
    /**
     * Get Effectif
     *
     * @return integer
     */
    public function getEffectif ()
    {
        return $this->Effectif;
    }   
        
    /**
     * Set Activity
     *
     * @param text $Activity
     */
    public function setActivity($Activity)
    {
        $this->Activity = $Activity;
    }

    /**
     * Get Activity
     *
     * @return string 
     */
    public function getActivity()
    {
        return $this->Activity;
    }

    /**
     * Set Engineering
     *
     * @param text $Engineering
     */
    public function setEngineering($Engineering)
    {
        $this->Engineering = $Engineering;
    }

    /**
     * Get Engineering
     *
     * @return string 
     */
    public function getEngineering()
    {
        return $this->Engineering;
    }
    
    /**
     * Set DetailActivity
     *
     * @param text $DetailActivity
     */
    public function setDetailActivity($DetailActivity)
    {
        $this->DetailActivity = $DetailActivity;
    }

    /**
     * Get DetailActivity
     *
     * @return string 
     */
    public function getDetailActivity()
    {
        return $this->DetailActivity;
    }

    /**
     * Get ArgumentActivity
     *
     * @return string 
     */
    public function getArgumentActivity()
    {
        return $this->ArgumentActivity;
    }

    /**
     * Set ArgumentActivity
     *
     * @param text $ArgumentActivity
     */
    public function setArgumentActivity($ArgumentActivity)
    {
        $this->ArgumentActivity = $ArgumentActivity;
    }
    
    /**
     * Set Expertise
     *
     * @param text $Expertise
     */
    public function setExpertise($Expertise)
    {
        $this->Expertise = $Expertise;
    }

    /**
     * Get Expertise
     *
     * @return text 
     */
    public function getExpertise()
    {
        return $this->Expertise;
    }

    /**
     * Set Speaker
     *
     * @param text $Speaker
     */
    public function setSpeaker($Speaker)
    {
        $this->Speaker = $Speaker;
    }

    /**
     * Get Speaker
     *
     * @return text 
     */
    public function getSpeaker()
    {
        return $this->Speaker;
    }
    
    /**
     * Set OriginContact
     *
     * @param string $OriginContact
     * @return this
     */
    public function setOriginContact($OriginContact)
    {
        $this->OriginContact = $OriginContact;
        return $this;
    }
    
    /**
     * Get OriginContact
     *
     * @return string
     */
    public function getOriginContact()
    {
        return $this->OriginContact;
    }
    
    /**
     * Set OriginContactOther
     *
     * @param string $OriginContactOther
     * @return this
     */
    public function setOriginContactOther($OriginContactOther)
    {
        $this->OriginContactOther = $OriginContactOther;
        return $this;
    }
    
    /**
     * Get OriginContactOther
     *
     * @return string
     */
    public function getOriginContactOther()
    {
        return $this->OriginContactOther;
    }
    
    /**
     * Set OriginContactSponsor
     *
     * @param string $OriginContactSponsor
     * @return this
     */
    public function setOriginContactSponsor($OriginContactSponsor)
    {
        $this->OriginContactSponsor = $OriginContactSponsor;
        return $this;
    }
    
    /**
     * Get OriginContactSponsor
     *
     * @return string
     */
    public function getOriginContactSponsor()
    {
        return $this->OriginContactSponsor;
    }
    
    /**
     * Set Facebook
     *
     * @param string $Facebook
     * @return this
     */
    public function setFacebook($Facebook)
    {
        $this->Facebook = $Facebook;
        return $this;
    }
    
    /**
     * Get Facebook
     *
     * @return string
     */
    public function getFacebook()
    {
        return $this->Facebook;
    }   
    
    /**
     * Set GooglePlus
     *
     * @param string $GooglePlus
     * @return this
     */
    public function setGooglePlus($GooglePlus)
    {
        $this->GooglePlus = $GooglePlus;
        return $this;
    }
    
    /**
     * Get GooglePlus
     *
     * @return string
     */
    public function getGooglePlus()
    {
        return $this->GooglePlus;
    }   
    
    /**
     * Set Twitter
     *
     * @param string $Twitter
     * @return this
     */
    public function setTwitter($Twitter)
    {
        $this->Twitter = $Twitter;
        return $this;
    }
    
    /**
     * Get Twitter
     *
     * @return string
     */
    public function getTwitter()
    {
        return $this->Twitter;
    }   
    
    /**
     * Set LinkedIn
     *
     * @param string $LinkedIn
     * @return this
     */
    public function setLinkedIn($LinkedIn)
    {
        $this->LinkedIn = $LinkedIn;
        return $this;
    }
    
    /**
     * Get LinkedIn
     *
     * @return string
     */
    public function getLinkedIn()
    {
        return $this->LinkedIn;
    }   
    
    /**
     * Set Viadeo
     *
     * @param string $Viadeo
     * @return this
     */
    public function setViadeo($Viadeo)
    {
        $this->Viadeo = $Viadeo;
        return $this;
    }
    
    /**
     * Get Viadeo
     *
     * @return string
     */
    public function getViadeo()
    {
        return $this->Viadeo;
    }   
    
    /**
     * Set payment status
     *
     * @param string $paymentstatus
     * @return this
     */
    public function setPaymentstatus($paymentstatus)
    {
        $this->paymentstatus = $paymentstatus;
        return $this;
    }
    
    /**
     * Get payment status
     *
     * @return string
     */
    public function getPaymentstatus()
    {
        return $this->paymentstatus;
    }
}