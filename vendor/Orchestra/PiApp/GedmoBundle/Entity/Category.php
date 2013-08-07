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
 * PiApp\GedmoBundle\Entity\Category
 * 
 * @ORM\Table(name="gedmo_category")
 * @ORM\Entity(repositoryClass="PiApp\GedmoBundle\Repository\CategoryRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\TranslationEntity(class="PiApp\GedmoBundle\Entity\Translation\CategoryTranslation")
 *
 * @category   Gedmo_Entities
 * @package    Entity
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class Category extends AbstractDefault
{
    /**
     * List of al translatable fields
     *
     * @var array
     * @access  protected
     */
    protected $_fields    = array('name', 'subtitle', 'descriptif');
    
    /**
     * Name of the Translation Entity
     *
     * @var array
     * @access  protected
    */
    protected $_translationClass = 'PiApp\GedmoBundle\Entity\Translation\CategoryTranslation';
    
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="PiApp\GedmoBundle\Entity\Translation\CategoryTranslation", mappedBy="object", cascade={"persist", "remove"})
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
    * @ORM\Column(name="type", type="string", length=255, nullable = true)
    */
    protected $type;    

    /**
     * @Gedmo\Translatable
     * @ORM\Column(name="name", type="string", length=255, nullable = true)
     */
    protected $name;
    
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
     * @var \PiApp\GedmoBundle\Entity\Media $media
     *
     * @ORM\OneToOne(targetEntity="PiApp\GedmoBundle\Entity\Media" , cascade={"all"}, inversedBy="entitycategory");
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id", nullable=true)
     */
    protected $media;    

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="PiApp\GedmoBundle\Entity\Contact", mappedBy="category")
     */
    protected $items_contact;
    
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="PiApp\GedmoBundle\Entity\Block", mappedBy="category")
     */
    protected $items_block;    
    
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="PiApp\GedmoBundle\Entity\Media", mappedBy="category")
     */
    protected $items_media; 

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="PiApp\GedmoBundle\Entity\Content", mappedBy="category")
     */
    protected $items_content;    
    
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="PiApp\GedmoBundle\Entity\Slider", mappedBy="category")
     */
    protected $items_slider;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="PiApp\GedmoBundle\Entity\Menu", mappedBy="category")
     */
    protected $items_menu;  
    
    public function __construct()
    {
        parent::__construct();
        
        $this->items_contact      = new \Doctrine\Common\Collections\ArrayCollection();
        $this->items_block          = new \Doctrine\Common\Collections\ArrayCollection();
        $this->items_media          = new \Doctrine\Common\Collections\ArrayCollection();
        $this->items_content      = new \Doctrine\Common\Collections\ArrayCollection();
        $this->items_slider      = new \Doctrine\Common\Collections\ArrayCollection();
        $this->items_menu          = new \Doctrine\Common\Collections\ArrayCollection();        
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
        return (string) $this->getName();
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
     * Set type
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
    
    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
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
        return $this;
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
     * Set media
     *
     * @param \PiApp\GedmoBundle\Entity\Media $media
     */
    public function setMedia($media)
    {
        //         if (($media instanceof \PiApp\GedmoBundle\Entity\Media) && ($media->getImage()->getName() == ""))
            //             $this->media = null;
            //         else{
            //             $this->media = $media;
            //         }
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
     * Add items_contact
     *
     * @param \PiApp\GedmoBundle\Entity\Contact $itemsContacts
     */
    public function addContact(\PiApp\GedmoBundle\Entity\Contact $itemsContacts)
    {
        if (!$this->items_contact->contains($itemsContacts)){
            $this->items_contact->add($itemsContacts);
        }
    }
    
    /**
     * Get all items_contact
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getItemsContact()
    {
        return $this->items_contact;
    }
    
    /**
     * Add items_block
     *
     * @param \PiApp\GedmoBundle\Entity\Block $itemsBlocks
     */
    public function addBlock(\PiApp\GedmoBundle\Entity\Block $itemsBlocks)
    {
        $this->items_block[] = $itemsBlocks;
    }
    
    /**
     * Get all items_block
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getItemsBlock()
    {
        return $this->items_block;
    }
    
    /**
     * Add items_media
     *
     * @param \PiApp\GedmoBundle\Entity\Media $itemsMedias
     */
    public function addMedia(\PiApp\GedmoBundle\Entity\Media $itemsMedias)
    {
        $this->items_media[] = $itemsMedias;
    }
    
    /**
     * Get all items_media
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getItemsMedia()
    {
        return $this->items_media;
    }
    
    /**
     * Add items_content
     *
     * @param  \PiApp\GedmoBundle\Entity\Content $items_content
     */
    public function addContent(\PiApp\GedmoBundle\Entity\Content $items_content)
    {
        $this->items_content[] = $items_content;
    }
    
    /**
     * Get all items_content
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getItemsContent()
    {
        return $this->items_content;
    }
    
    /**
     * Add items_slider
     *
     * @param \PiApp\GedmoBundle\Entity\Slider $items_slider
     */
    public function addSlider(\PiApp\GedmoBundle\Entity\Slider $items_slider)
    {
        $this->items_slider[] = $items_slider;
    }
    
    /**
     * Get all items_slider
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getItemsSlider()
    {
        return $this->items_slider;
    }
    
    /**
     * Add items_menu
     *
     * @param \PiApp\GedmoBundle\Entity\Menu $items_menu
     */
    public function addMenu(\PiApp\GedmoBundle\Entity\Menu $items_menu)
    {
        $this->items_menu[] = $items_menu;
    }
    
    /**
     * Get all items_menu
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getItemsMenu()
    {
        return $this->items_menu;
    } 
 
}