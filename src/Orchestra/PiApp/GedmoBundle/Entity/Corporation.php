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
 * PiApp\GedmoBundle\Entity\Corporation
 *
 * @ORM\Table(
 * 			name="gedmo_corporation",
 *          indexes={@ORM\Index(name="name_idx", columns={"name"})}
 * )
 * @ORM\Entity(repositoryClass="PiApp\GedmoBundle\Repository\CorporationRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\TranslationEntity(class="PiApp\GedmoBundle\Entity\Translation\CorporationTranslation")
 *
 * @category   Gedmo_Entities
 * @package    Entity
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class Corporation extends AbstractDefault 
{
	/**
	 * List of al translatable fields
	 * 
	 * @var array
	 * @access  protected
	 */
	protected $_fields	= array('DetailActivity', 'ArgumentCommercial');

	/**
	 * Name of the Translation Entity
	 * 
	 * @var array
	 * @access  protected
	 */
	protected $_translationClass = 'PiApp\GedmoBundle\Entity\Translation\CorporationTranslation';
	
	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection
	 *
	 * @ORM\OneToMany(targetEntity="PiApp\GedmoBundle\Entity\Translation\CorporationTranslation", mappedBy="object", cascade={"persist", "remove"})
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
     * @var \Doctrine\Common\Collections\ArrayCollection $individuals
     *
     * @ORM\ManyToMany(targetEntity="PiApp\GedmoBundle\Entity\Individual",  inversedBy="corporations")
     * @ORM\JoinTable(name="gedmo_lamelee_corporation_has_individual",
     *      joinColumns={@ORM\JoinColumn(name="corporation_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="individual_id", referencedColumnName="id")}
     *      )
     */
    protected $individuals;    
    
    /**
     * @var \BootStrap\UserBundle\Entity\User $user
     *
     * @ORM\OneToOne(targetEntity="BootStrap\UserBundle\Entity\User", cascade={"all"}, inversedBy="corporation")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
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
     * @ORM\OneToOne(targetEntity="PiApp\GedmoBundle\Entity\Media" , cascade={"all"}, inversedBy="corporation");
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id", nullable=true)
     */
    protected $media;

    /**
     * @var \PiApp\GedmoBundle\Entity\Media $media2
     *
     * @ORM\OneToOne(targetEntity="PiApp\GedmoBundle\Entity\Media" , cascade={"all"}, inversedBy="corporation2");
     * @ORM\JoinColumn(name="media2_id", referencedColumnName="id", nullable=true)
     */
    protected $media2;    
    
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
     * @var string $UserPhone
     *
     * @ORM\Column(name="user_phone", type="string", nullable = true)
     */
    protected $UserPhone;
    
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
     * @var string $ArgumentCommercial
     * 
     * @Gedmo\Translatable
     * @ORM\Column(name="argument_commercial", type="string", nullable = true)
     */
    protected $ArgumentCommercial;
    
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
     * @var string $CorporationName
     *
     * @ORM\Column(name="corporation_name", type="string", length=255, nullable = true)
     * 
     */
    protected $CorporationName ;
    
    /**
     * @var string $CommercialName
     *
     * @ORM\Column(name="commercial_name", type="string", length=255, nullable = true)
     * 
     */
    protected $CommercialName ;
    
    /**
     * @var string $Address
     *
     * @ORM\Column(name="address", type="string", length=255, nullable = true)
     * 
     */
    protected $Address ;
    
    /**
     * @var string $CP
     *
     * @ORM\Column(name="cp", type="string", length=255, nullable = true)
     * 
     */
    protected $CP ;
    
    /**
     * @var string $City
     *
     * @ORM\Column(name="city", type="string", length=255, nullable = true)
     * 
     */
    protected $City ;
    
    /**
     * @var string $Country
     *
     * @ORM\Column(name="country", type="string", length=255, nullable = true)
     * 
     */
    protected $Country ;
    
    /**
     * @var integer $Phone
     *
     * @ORM\Column(name="phone", type="integer", nullable = true)
     * 
     */
    protected $Phone ;
    
    /**
     * @var integer $Fax
     *
     * @ORM\Column(name="fax", type="integer", nullable = true)
     * 
     */
    protected $Fax ;
    
    /**
     * @var string $InvoiceAddress
     *
     * @ORM\Column(name="invoice_address", type="string", length=255, nullable = true)
     * 
     */
    protected $InvoiceAddress ;
    
    /**
     * @var integer $InvoiceCP
     *
     * @ORM\Column(name="invoice_cp", type="integer", nullable = true)
     * 
     */
    protected $InvoiceCP ;
    
    /**
     * @var string $InvoiceCity
     *
     * @ORM\Column(name="invoice_city", type="string", length=255, nullable = true)
     * 
     */
    protected $InvoiceCity ;
    
    /**
     * @var string $InvoiceCountry
     *
     * @ORM\Column(name="invoice_country", type="string", length=255, nullable = true)
     * 
     */
    protected $InvoiceCountry ;
    
    /**
     * @var string $InvoicePhone
     *
     * @ORM\Column(name="invoice_phone", type="string", length=255, nullable = true)
     * 
     */
    protected $InvoicePhone ;
    
    /**
     * @var string $InvoiceFax
     *
     * @ORM\Column(name="invoice_fax", type="string", length=255, nullable = true)
     * 
     */
    protected $InvoiceFax ;
    
    /**
     * @var string $MotherAddress
     *
     * @ORM\Column(name="mother_address", type="string", length=255, nullable = true)
     * 
     */
    protected $MotherAddress ;
    
    /**
     * @var string $MotherCP
     *
     * @ORM\Column(name="mother_cp", type="string", length=255, nullable = true)
     * 
     */
    protected $MotherCP ;
    
    /**
     * @var string $MotherCity
     *
     * @ORM\Column(name="mother_city", type="string", length=255, nullable = true)
     * 
     */
    protected $MotherCity ;
    
    /**
     * @var string $MotherCountry
     *
     * @ORM\Column(name="mother_country", type="string", length=255, nullable = true)
     * 
     */
    protected $MotherCountry ;
    
    /**
     * @var string $MotherPhone
     *
     * @ORM\Column(name="mother_phone", type="string", length=255, nullable = true)
     * 
     */
    protected $MotherPhone ;
    
    /**
     * @var string $MotherFax
     *
     * @ORM\Column(name="mother_fax", type="string", length=255, nullable = true)
     * 
     */
    protected $MotherFax ;
    
    /**
     * @var string $EffectifNational
     *
     * @ORM\Column(name="effectif_national", type="string", length=255, nullable = true)
     * 
     */
    protected $EffectifNational ;
    
    /**
     * @var string $EffectifRegional
     *
     * @ORM\Column(name="effectif_regional", type="string", length=255, nullable = true)
     * 
     */
    protected $EffectifRegional ;
    
    /**
     * @var string $LegalForm
     *
     * @ORM\Column(name="legal_form", type="string", length=255, nullable = true)
     * 
     */
    protected $LegalForm ;
    
    /**
     * @var string $CodeNAF
     *
     * @ORM\Column(name="code_naf", type="string", length=255, nullable = true)
     * 
     */
    protected $CodeNAF ;
    
    /**
     * @var integer $Siret
     *
     * @ORM\Column(name="siret", type="integer", nullable = true)
     * 
     */
    protected $Siret ;
    
    /**
     * @var string $CaNational
     *
     * @ORM\Column(name="ca_national", type="string", length=255, nullable = true)
     * 
     */
    protected $CaNational;

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
    	
    	$this->individuals			= new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set all individuals links
     *
     * @param \Doctrine\Common\Collections\ArrayCollection $Individuals
     */
    public function setIndividuals(\Doctrine\Common\Collections\ArrayCollection $Individuals)
    {
    	$this->individuals = $Individuals;
    	return $this;
    }
    
    /**
     * Get all individuals links
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getIndividuals()
    {
    	return $this->individuals;
    }
    
    /**
     * Add individual
     *
     * @param \PiApp\GedmoBundle\Entity\Individual $Individual
     */
    public function addIndividual(\PiApp\GedmoBundle\Entity\Individual $Individual)
    {
    	$this->individuals[] = $Individual;
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
     * Set UserPhone
     *
     * @param integer $UserPhone
     */
    public function setUserPhone($UserPhone)
    {
    	$this->UserPhone = $UserPhone;
    }
    
    /**
     * Get Phone
     *
     * @return integer
     */
    public function getUserPhone()
    {
    	return $this->UserPhone;
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
     * Set media2
     *
     * @param \PiApp\GedmoBundle\Entity\Media $media2
     */
    public function setMedia2($media2)
    {
    	$this->media2 = $media2;    	
    	return $this;
    }
    
    /**
     * Get media2
     *
     * @return \PiApp\GedmoBundle\Entity\Media
     */
    public function getMedia2()
    {
    	return $this->media2;
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
     * Set CorporationName
     *
     * @param string $CorporationName
     */
    public function setCorporationName($CorporationName)
    {
    	$this->CorporationName = $CorporationName;
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
     * Get ArgumentCommercial
     *
     * @return string 
     */
    public function getArgumentCommercial()
    {
        return $this->ArgumentCommercial;
    }

    /**
     * Set ArgumentCommercial
     *
     * @param text $ArgumentCommercial
     */
    public function setArgumentCommercial($ArgumentCommercial)
    {
        $this->ArgumentCommercial = $ArgumentCommercial;
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
     * Get CorporationName
     *
     * @return string
     */
    public function getCorporationName()
    {
    	return $this->CorporationName;
    }   
        
    /**
     * Set CommercialName
     *
     * @param string $CommercialName
     */
    public function setCommercialName($CommercialName)
    {
    	$this->CommercialName = $CommercialName;
    }
    
    /**
     * Get CommercialName
     *
     * @return string
     */
    public function getCommercialName()
    {
    	return $this->CommercialName;
    }   
        
    /**
     * Set Address
     *
     * @param string $Address
     */
    public function setAddress($Address)
    {
    	$this->Address = $Address;
    }
    
    /**
     * Get Address
     *
     * @return string
     */
    public function getAddress()
    {
    	return $this->Address;
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
     * Set City
     *
     * @param string $City
     */
    public function setCity($City)
    {
    	$this->City = $City;
    }
    
    /**
     * Get City
     *
     * @return string
     */
    public function getCity()
    {
    	return $this->City;
    }   
        
    /**
     * Set Country
     *
     * @param string $Country
     */
    public function setCountry($Country)
    {
    	$this->Country = $Country;
    }
    
    /**
     * Get Country
     *
     * @return string
     */
    public function getCountry()
    {
    	return $this->Country;
    }   
        
    /**
     * Set Phone
     *
     * @param integer $Phone
     */
    public function setPhone($Phone)
    {
    	$this->Phone = $Phone;
    }
    
    /**
     * Get Phone
     *
     * @return integer
     */
    public function getPhone()
    {
    	return $this->Phone;
    }   
        
    /**
     * Set Fax
     *
     * @param integer $Fax
     */
    public function setFax($Fax)
    {
    	$this->Fax = $Fax;
    }
    
    /**
     * Get Fax
     *
     * @return integer
     */
    public function getFax()
    {
    	return $this->Fax;
    }   
        
    /**
     * Set InvoiceAddress
     *
     * @param string $InvoiceAddress
     */
    public function setInvoiceAddress($InvoiceAddress)
    {
    	$this->InvoiceAddress = $InvoiceAddress;
    }
    
    /**
     * Get InvoiceAddress
     *
     * @return string
     */
    public function getInvoiceAddress()
    {
    	return $this->InvoiceAddress;
    }   
        
    /**
     * Set InvoiceCP
     *
     * @param integer $InvoiceCP
     */
    public function setInvoiceCP($InvoiceCP)
    {
    	$this->InvoiceCP = $InvoiceCP;
    }
    
    /**
     * Get InvoiceCP
     *
     * @return integer
     */
    public function getInvoiceCP()
    {
    	return $this->InvoiceCP;
    }   
        
    /**
     * Set InvoiceCity
     *
     * @param string $InvoiceCity
     */
    public function setInvoiceCity($InvoiceCity)
    {
    	$this->InvoiceCity = $InvoiceCity;
    }
    
    /**
     * Get InvoiceCity
     *
     * @return string
     */
    public function getInvoiceCity()
    {
    	return $this->InvoiceCity;
    }   
        
    /**
     * Set InvoiceCountry
     *
     * @param string $InvoiceCountry
     */
    public function setInvoiceCountry($InvoiceCountry)
    {
    	$this->InvoiceCountry = $InvoiceCountry;
    }
    
    /**
     * Get InvoiceCountry
     *
     * @return string
     */
    public function getInvoiceCountry()
    {
    	return $this->InvoiceCountry;
    }   
        
    /**
     * Set InvoicePhone
     *
     * @param integer $InvoicePhone
     */
    public function setInvoicePhone($InvoicePhone)
    {
    	$this->InvoicePhone = $InvoicePhone;
    }
    
    /**
     * Get InvoicePhone
     *
     * @return integer
     */
    public function getInvoicePhone()
    {
    	return $this->InvoicePhone;
    }   
        
    /**
     * Set InvoiceFax
     *
     * @param integer $InvoiceFax
     */
    public function setInvoiceFax($InvoiceFax)
    {
    	$this->InvoiceFax = $InvoiceFax;
    }
    
    /**
     * Get InvoiceFax
     *
     * @return integer
     */
    public function getInvoiceFax()
    {
    	return $this->InvoiceFax;
    }   
        
    /**
     * Set MotherAddress
     *
     * @param string $MotherAddress
     */
    public function setMotherAddress($MotherAddress)
    {
    	$this->MotherAddress = $MotherAddress;
    }
    
    /**
     * Get MotherAddress
     *
     * @return string
     */
    public function getMotherAddress()
    {
    	return $this->MotherAddress;
    }   
        
    /**
     * Set MotherCP
     *
     * @param integer $MotherCP
     */
    public function setMotherCP($MotherCP)
    {
    	$this->MotherCP = $MotherCP;
    }
    
    /**
     * Get MotherCP
     *
     * @return integer
     */
    public function getMotherCP()
    {
    	return $this->MotherCP;
    }   
        
    /**
     * Set MotherCity
     *
     * @param string $MotherCity
     */
    public function setMotherCity($MotherCity)
    {
    	$this->MotherCity = $MotherCity;
    }
    
    /**
     * Get MotherCity
     *
     * @return string
     */
    public function getMotherCity()
    {
    	return $this->MotherCity;
    }   
        
    /**
     * Set MotherCountry
     *
     * @param string $MotherCountry
     */
    public function setMotherCountry($MotherCountry)
    {
    	$this->MotherCountry = $MotherCountry;
    }
    
    /**
     * Get MotherCountry
     *
     * @return string
     */
    public function getMotherCountry()
    {
    	return $this->MotherCountry;
    }   
        
    /**
     * Set MotherPhone
     *
     * @param integer $MotherPhone
     */
    public function setMotherPhone($MotherPhone)
    {
    	$this->MotherPhone = $MotherPhone;
    }
    
    /**
     * Get MotherPhone
     *
     * @return integer
     */
    public function getMotherPhone()
    {
    	return $this->MotherPhone;
    }   
        
    /**
     * Set MotherFax
     *
     * @param integer $MotherFax
     */
    public function setMotherFax($MotherFax)
    {
    	$this->MotherFax = $MotherFax;
    }
    
    /**
     * Get MotherFax
     *
     * @return integer
     */
    public function getMotherFax()
    {
    	return $this->MotherFax;
    }   
        
    /**
     * Set EffectifNational
     *
     * @param string $EffectifNational
     */
    public function setEffectifNational($EffectifNational)
    {
    	$this->EffectifNational = $EffectifNational;
    }
    
    /**
     * Get EffectifNational
     *
     * @return string
     */
    public function getEffectifNational()
    {
    	return $this->EffectifNational;
    }   
        
    /**
     * Set EffectifRegional
     *
     * @param string $EffectifRegional
     */
    public function setEffectifRegional($EffectifRegional)
    {
    	$this->EffectifRegional = $EffectifRegional;
    }
    
    /**
     * Get EffectifRegional
     *
     * @return string
     */
    public function getEffectifRegional()
    {
    	return $this->EffectifRegional;
    }   
        
    /**
     * Set LegalForm
     *
     * @param string $LegalForm
     */
    public function setLegalForm($LegalForm)
    {
    	$this->LegalForm = $LegalForm;
    }
    
    /**
     * Get LegalForm
     *
     * @return string
     */
    public function getLegalForm()
    {
    	return $this->LegalForm;
    }   
        
    /**
     * Set CodeNAF
     *
     * @param string $CodeNAF
     */
    public function setCodeNAF($CodeNAF)
    {
    	$this->CodeNAF = $CodeNAF;
    }
    
    /**
     * Get CodeNAF
     *
     * @return string
     */
    public function getCodeNAF()
    {
    	return $this->CodeNAF;
    }   
        
    /**
     * Set Siret
     *
     * @param string $Siret
     */
    public function setSiret($Siret)
    {
    	$this->Siret = $Siret;
    }
    
    /**
     * Get Siret
     *
     * @return integer
     */
    public function getSiret()
    {
    	return $this->Siret;
    }   
        
    /**
     * Set CaNational
     *
     * @param string $CaNational
     */
    public function setCaNational($CaNational)
    {
    	$this->CaNational = $CaNational;
    }
    
    /**
     * Get CaNational
     *
     * @return string
     */
    public function getCaNational()
    {
    	return $this->CaNational;
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