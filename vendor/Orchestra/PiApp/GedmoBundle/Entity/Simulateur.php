<?php

namespace PiApp\GedmoBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use BootStrap\TranslationBundle\Model\AbstractDefault;


/**
 * PiApp\GedmoBundle\Entity\Simulateur
 *
 * @ORM\Table(name="gedmo_simulateur")
 * @ORM\Entity(repositoryClass="PiApp\GedmoBundle\Repository\SimulateurRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\TranslationEntity(class="PiApp\GedmoBundle\Entity\Translation\SimulateurTranslation")
 *
 * @category   Gedmo_Entities
 * @package    Entity
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class Simulateur extends AbstractDefault 
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
	protected $_translationClass = 'PiApp\GedmoBundle\Entity\Translation\SimulateurTranslation';
	
	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection
	 *
	 * @ORM\OneToMany(targetEntity="PiApp\GedmoBundle\Entity\Translation\SimulateurTranslation", mappedBy="object", cascade={"persist", "remove"})
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
     * @ORM\ManyToOne(targetEntity="PiApp\GedmoBundle\Entity\Category", inversedBy="items_simulateur")
     * @ORM\JoinColumn(name="category", referencedColumnName="id", nullable=true)
     */
    protected $category; 
	
    /**
     * @var string $title
     * 
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="string", length=128, nullable=false)
     * @Assert\NotBlank()
     */
    protected $title;
    
    /**
     * @var decimal $tfs
     *
     * @ORM\Column(name="tfs", type="decimal", scale=3, nullable=true)
     */
    protected $tfs; 
    
    /**
     * @var decimal $t
     *
     * @ORM\Column(name="t", type="decimal", scale=3, nullable=true)
     */
    protected $t; 
    
    /**
     * @var decimal $ps
     *
     * @ORM\Column(name="ps", type="decimal", scale=3, nullable=true)
     */
    protected $ps; 
    
    /**
     * @var decimal $ps0
     *
     * @ORM\Column(name="ps0", type="decimal", scale=3, nullable=true)
     */
    protected $ps0;
	
    /**
     * @var decimal $tfsv
     *
     * @ORM\Column(name="tfsv", type="decimal", scale=3, nullable=true)
     */
    protected $tfsv; 	

    /**
     * @var integer
     * 
     * @ORM\Column(name="versement_initial_min", type="integer", nullable=true)
     */
    protected $versement_initial_min;	

    /**
     * @var integer
     * 
     * @ORM\Column(name="mensualite_min", type="integer", nullable=true)
     */
    protected $mensualite_min;	
	
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
     * Set produit
     *
     * @param \PiApp\GedmoBundle\Entity\Produit $produit
     */
    public function setProduit($produit)
    {
    	$this->produit = $produit;
    	return $this;
    }
    
    /**
     * Get produit
     *
     * @return \PiApp\GedmoBundle\Entity\Produit
     */
    public function getProduit()
    {
    	return $this->produit;
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
     * Get mensualite_min
     *
     * @return integer 
     */
    public function getMensualiteMin()
    {
        return $this->mensualite_min;
    }	
	
    /**
     * Set mensualite_min
     *
     * @param integer $mensualite_min
     */
    public function setMensualiteMin($mensualite_min)
    {
        $this->mensualite_min = $mensualite_min;
    }

    /**
     * Get versement_initial_min
     *
     * @return integer 
     */
    public function getVersementInitialMin()
    {
        return $this->versement_initial_min;
    }	
	
    /**
     * Set versement_initial_min
     *
     * @param integer $versement_initial_min
     */
    public function setVersementInitialMin($versement_initial_min)
    {
        $this->versement_initial_min = $versement_initial_min;
    }
	
    /**
     * Set ps
     *
     * @param integer $ps
     */
    public function setPs($ps)
    {
        $this->ps = $ps;
    }
	
    /**
     * Get ps
     *
     * @return integer 
     */
    public function getPs()
    {
        return $this->ps;
    }	
	
    /**
     * Set ps0
     *
     * @param integer $ps0
     */
    public function setPs0($ps0)
    {
        $this->ps0 = $ps0;
    }
	
    /**
     * Get ps0
     *
     * @return integer 
     */
    public function getPs0()
    {
        return $this->ps0;
    }	
	
    /**
     * Set tfs
     *
     * @param integer $tfs
     */
    public function setTfs($tfs)
    {
        $this->tfs = $tfs;
    }

    /**
     * Get tfs
     *
     * @return integer 
     */
    public function getTfs()
    {
        return $this->tfs;
    }
	
    /**
     * Set tfsv
     *
     * @param integer $tfsv
     */
    public function setTfsv($tfsv)
    {
        $this->tfsv = $tfsv;
    }

    /**
     * Get tfsv
     *
     * @return integer 
     */
    public function getTfsv()
    {
        return $this->tfsv;
    }	
	
    /**
     * Set t
     *
     * @param integer $t
     */
    public function setT($t)
    {
        $this->t = $t;
    }

    /**
     * Get t
     *
     * @return integer 
     */
    public function getT()
    {
        return $this->t;
    }	
}