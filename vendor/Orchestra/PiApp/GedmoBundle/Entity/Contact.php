<?php
/**
 * This file is part of the <Gedmo> project.
 *
 * @category   Gedmo_Entities
 * @package    Entity
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-07-11
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
 * PiApp\GedmoBundle\Entity\Contact
 *
 * @ORM\Table(name="gedmo_contact")
 * @ORM\Entity(repositoryClass="PiApp\GedmoBundle\Repository\ContactRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\TranslationEntity(class="PiApp\GedmoBundle\Entity\Translation\ContactTranslation")
 * 
 * @category   Gedmo_Entities
 * @package    Entity
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class Contact extends AbstractDefault 
{
    /**
     * List of al translatable fields
     * 
     * @var array
     * @access  protected
     */
    protected $_fields  = array('title', 'descriptif', 'url_title', 'email_subject', 'email_body');

    /**
     * Name of the Translation Entity
     * 
     * @var array
     * @access  protected
     */
    protected $_translationClass = 'PiApp\GedmoBundle\Entity\Translation\ContactTranslation';
    
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="PiApp\GedmoBundle\Entity\Translation\ContactTranslation", mappedBy="object", cascade={"persist", "remove"})
     */
    protected $translations;    
    
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var \PiApp\GedmoBundle\Entity\Category $category
     * 
     * @ORM\ManyToOne(targetEntity="PiApp\GedmoBundle\Entity\Category", inversedBy="items_contact")
     * @ORM\JoinColumn(name="category", referencedColumnName="id", nullable=true)
     */
    protected $category;   
    
    /**
     * @var \PiApp\GedmoBundle\Entity\Ads $ads
     * 
     * @ORM\ManyToOne(targetEntity="PiApp\GedmoBundle\Entity\Ads", inversedBy="responses", cascade={"persist"})
     * @ORM\JoinColumn(name="ads", referencedColumnName="id", nullable=true)
     */
    protected $ads;    
    
    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="text", nullable = true)
     */
    protected $name;
    
    /**
     * @var string $nickname
     *
     * @ORM\Column(name="nickname", type="text", nullable = true)
     */
    protected $nickname;    
    
    /**
     * @var string $title
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="string", length=255, nullable = true)
     */
    protected $title;
    
    /**
     * @var text $descriptif
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="descriptif", type="text", nullable=true)
     */
    protected $descriptif;    
    
    /**
     * @var string $address
     *
     * @ORM\Column(name="address", type="text", length=255, nullable = true)
     */
    protected $address;    
    
    /**
     * @var string $address
     *
     * @ORM\Column(name="address1", type="text", length=255, nullable = true)
     */
    protected $address1;

    /**
     * @var string $address
     *
     * @ORM\Column(name="address2", type="text", length=255, nullable = true)
     */
    protected $address2;

    /**
     * @var string $address
     *
     * @ORM\Column(name="address3", type="text", length=255, nullable = true)
     */
    protected $address3;    
    
    /**
     * @var string $cp
     *
     * @ORM\Column(name="cp", type="text", length=255, nullable = true)
     */
    protected $cp;    
    
    /**
     * @var string $city
     *
     * @ORM\Column(name="city", type="text", length=255, nullable = true)
     */
    protected $city;    
    
    /**
     * @var string $country
     *
     * @ORM\Column(name="country", type="string", length=2, nullable=true)
     */
    protected $country;    

    /**
     * @var string $phone
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable = true)
     */
    protected $phone;
    
    /**
     * @var string $mobile
     *
     * @ORM\Column(name="mobile", type="string", length=255, nullable = true)
     */
    protected $mobile;    

    /**
     * @var string $fax
     *
     * @ORM\Column(name="fax", type="string", length=255, nullable = true)
     */
    protected $fax;
    
    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=255, nullable = true)
     * @Assert\Email()
     */
    protected $email;  

    /**
     * @var string $email_subject
     * 
     * @Gedmo\Translatable
     * @ORM\Column(name="email_subject", type="string", length=255, nullable = true)
     */
    protected $email_subject; 

    /**
     * @var string $email_body
     * 
     * @Gedmo\Translatable
     * @ORM\Column(name="email_body", type="string", length=255, nullable = true)
     */
    protected $email_body; 

    /**
     * @var string $email_cc
     *
     * @ORM\Column(name="email_cc", type="text", nullable = true)
     */
    protected $email_cc;   

    /**
     * @var string $email_bcc
     *
     * @ORM\Column(name="email_bcc", type="text", nullable = true)
     */
    protected $email_bcc;    

    /**
     * @var string $url
     *
     * @ORM\Column(name="url", type="string", length=255, nullable = true)
     */
    protected $url;

    /**
     * @var string $url_title
     * @Gedmo\Translatable
     * @ORM\Column(name="url_title", type="string", length=255, nullable = true)
     */
    protected $url_title;
    
    /**
     * @var integer $media
     *
     * @ORM\OneToOne(targetEntity="PiApp\GedmoBundle\Entity\Media" , cascade={"all"}, inversedBy="contact1");
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id", nullable=true)
     */
    protected $media;
    
    //     /**
    //      * @var integer $image
    //      *
    //      * @ORM\ManyToOne(targetEntity="BootStrap\MediaBundle\Entity\Media", cascade={"persist"})
    //      * @ORM\JoinColumn(name="image2", referencedColumnName="id", nullable=true)
    //      */
    //     protected $image2;
    
    /**
     * @var integer $media1
     *
     * @ORM\OneToOne(targetEntity="PiApp\GedmoBundle\Entity\Media" , cascade={"all"}, inversedBy="contact2");
     * @ORM\JoinColumn(name="media1_id", referencedColumnName="id", nullable=true)
     */
    protected $media1;
     
    
    /**
     * @var string $coordinates
     *
     * @ORM\Column(name="coordinates", type="string", length=255, nullable = true)
     */
    protected $coordinates ;    

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
    	 
    }    
    
    /**
     * Get id
     *
     * @return integer 
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
     * Set Ads
     *
     * @param string \PiApp\GedmoBundle\Entity\Ads $Ads
     */
    public function setAds(\PiApp\GedmoBundle\Entity\Ads $Ads)
    {
    	$this->ads = $Ads;
    	return $this;
    }
    
    /**
     * Get Ads
     *
     * @return string
     */
    public function getAds()
    {
    	return $this->ads;
    }    
    
    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
    	$this->name = $name;
    	return $this;
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
     * Set nickname
     *
     * @param string $nickname
     */
    public function setNickname($nickname)
    {
    	$this->nickname = $nickname;
    	return $this;
    }
    
    /**
     * Get nickname
     *
     * @return string
     */
    public function getNickname()
    {
    	return $this->nickname;
    }    
    
    /**
     * Set title
     *
     * @param string $title
     * @return this
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
     * Set address
     *
     * @param string $address
     * @return this
     */
    public function setAddress($address)
    {
    	$this->address = $address;
    	return $this;
    }
    
    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
    	return $this->address;
    }
    
    /**
     * Set address1
     *
     * @param string $address
     * @return this
     */
    public function setAddress1($address)
    {
    	$this->address1 = $address;
    	return $this;
    }
    
    /**
     * Get address1
     *
     * @return string
     */
    public function getAddress1()
    {
    	return $this->address1;
    }    
    
    /**
     * Set address2
     *
     * @param string $address
     * @return this
     */
    public function setAddress2($address)
    {
    	$this->address2 = $address;
    	return $this;
    }
    
    /**
     * Get address2
     *
     * @return string
     */
    public function getAddress2()
    {
    	return $this->address2;
    }    
    
    /**
     * Set address3
     *
     * @param string $address
     * @return this
     */
    public function setAddress3($address)
    {
    	$this->address3 = $address;
    	return $this;
    }
    
    /**
     * Get address3
     *
     * @return string
     */
    public function getAddress3()
    {
    	return $this->address3;
    }    
    
    /**
     * Set cp
     *
     * @param string $cp
     * @return this
     */
    public function setCp($cp)
    {
    	$this->cp = $cp;
    	return $this;
    }
    
    /**
     * Get cp
     *
     * @return string
     */
    public function getCp()
    {
    	return $this->cp;
    }    
    
    /**
     * Set city
     *
     * @param string $city
     * @return this
     */
    public function setCity($city)
    {
    	$this->city = $city;
    	return $this;
    }
    
    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
    	return $this->city;
    }    
    
    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
    	return $this->country;
    }
    
    /**
     * Set country
     *
     * @param string $country
     */
    public function setCountry($country)
    {
    	$this->country = $country;
    	return $this;
    }    
        
    /**
     * Set phone
     *
     * @param string $phone
     * @return this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }
    
    /**
     * Set mobile
     *
     * @param string $mobile
     * @return this
     */
    public function setMobile($mobile)
    {
    	$this->mobile = $mobile;
    	return $this;
    }
    
    /**
     * Get phone
     *
     * @return string
     */
    public function getMobile()
    {
    	return $this->mobile;
    }    

    /**
     * Set fax
     *
     * @param string $fax
     * @return this
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }
    
    /**
     * Set email
     *
     * @param string $email
     * @return this
     */
    public function setEmail($email)
    {
    	$this->email = $email;
    	return $this;
    }    
    
    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
    	return $this->email;
    }    

    /**
     * Set email subject
     *
     * @param string $email_subject
     * @return this
     */
    public function setEmailSubject($email_subject)
    {
    	$this->email_subject = $email_subject;
    	return $this;
    }
    
    /**
     * Get email subject
     *
     * @return string
     */
    public function getEmailSubject()
    {
    	return $this->email_subject;
    }
    
    /**
     * Set email body
     *
     * @param string $email_body
     * @return this
     */
    public function setEmailBody($email_body)
    {
    	$this->email_body = $email_body;
    	return $this;
    }
    
    /**
     * Get email body
     *
     * @return string
     */
    public function getEmailBody()
    {
    	return $this->email_body;
    }  

    /**
     * Set email cc
     *
     * @param string $email_cc
     * @return this
     */
    public function setEmailCc($email_cc)
    {
    	$this->email_cc = $email_cc;
    	return $this;
    }
    
    /**
     * Get email cc
     *
     * @return string
     */
    public function getEmailCc()
    {
    	return $this->email_cc;
    } 

    /**
     * Set email bcc
     *
     * @param string $email_bcc
     * @return this
     */
    public function setEmailBcc($email_bcc)
    {
    	$this->email_bcc = $email_bcc;
    	return $this;
    }
    
    /**
     * Get email bcc
     *
     * @return string
     */
    public function getEmailBcc()
    {
    	return $this->email_bcc;
    }    
        
    /**
     * Set url
     *
     * @param string $url
     * @return this
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set url_title
     *
     * @param string $urlTitle
     * @return this
     */
    public function setUrlTitle($urlTitle)
    {
        $this->url_title = $urlTitle;
        return $this;
    }

    /**
     * Get url_title
     *
     * @return string 
     */
    public function getUrlTitle()
    {
        return $this->url_title;
    }

    /**
     * Set media
     *
     * @param \PiApp\GedmoBundle\Entity\Media $media
     */
    public function setMedia($media)
    {
    	//     	if (($media instanceof \PiApp\GedmoBundle\Entity\Media) && ($media->getImage()->getName() == ""))
    		// 	    	$this->media = null;
    		//     	else{
    		//     		$this->media = $media;
    		//     	}
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
     * Set media1
     *
     * @param \PiApp\GedmoBundle\Entity\Media $media
     */
    public function setMedia1($media)
    {
    	//     	if (($media instanceof \PiApp\GedmoBundle\Entity\Media) && ($media->getImage()->getName() == ""))
    		// 	    	$this->media1 = null;
    		//     	else{
    		//     		$this->media1 = $media;
    		//     	}
    	$this->media1 = $media;
    	return $this;
    }
    
    /**
     * Get media1
     *
     * @return \PiApp\GedmoBundle\Entity\Media
     */
    public function getMedia1()
    {
    	return $this->media1;
    }
    
    /**
     * Set Coordinates
     *
     * @param string $address
     * @return this
     */
    public function setCoordinates($Coordinates)
    {
    	$this->coordinates = $Coordinates;
    	return $this;
    }
    
    /**
     * Get Coordinates
     *
     * @return string
     */
    public function getCoordinates()
    {
    	return $this->coordinates;
    }

}