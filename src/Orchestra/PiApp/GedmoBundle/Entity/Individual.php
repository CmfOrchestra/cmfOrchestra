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
 * PiApp\GedmoBundle\Entity\Individual
 *
 * @ORM\Table(name="gedmo_individual")
 * @ORM\Entity(repositoryClass="PiApp\GedmoBundle\Repository\IndividualRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\TranslationEntity(class="PiApp\GedmoBundle\Entity\Translation\IndividualTranslation")
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
     * @var integer $user
     *
     * @ORM\ManyToOne(targetEntity="BootStrap\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    protected $user;    

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
     * @ORM\OneToOne(targetEntity="PiApp\GedmoBundle\Entity\Media" , cascade={"all"}, inversedBy="individual");
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id", nullable=true)
     */
    protected $media;

    /**
     * @var string $Inscrname
     *
     * @ORM\Column(name="inscr_name", type="text", nullable = true)
     */
    protected $InscrName;
    
    /**
     * @var string $InscrNickname
     *
     * @ORM\Column(name="inscr_nickname", type="text", nullable = true)
     */
    protected $InscrNickname;
    
    /**
     * @var string $InscrPhone
     *
     * @ORM\Column(name="inscr_phone", type="text", nullable = true)
     */
    protected $InscrPhone;
    
    /**
     * @var string $InscrJob
     *
     * @ORM\Column(name="inscr_entr_job", type="text", nullable = true)
     */
    protected $InscrJob;
    
    /**
     * @var string $EntrCompany
     *
     * @ORM\Column(name="entr_company", type="text", nullable = true)
     */
    protected $EntrCompany;
    
    /**
     * @var string $EntrActivity
     *
     * @ORM\Column(name="entr_activity", type="text", nullable = true)
     */
    protected $EntrActivity;
    
    /**
     * @var string $EntrBusiness
     *
     * @ORM\Column(name="entr_business", type="text", nullable = true)
     */
    protected $EntrBusiness;
    
    /**
     * @var string $EntrStaff
     *
     * @ORM\Column(name="entr_staff", type="text", nullable = true)
     */
    protected $EntrStaff;    
    
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

}