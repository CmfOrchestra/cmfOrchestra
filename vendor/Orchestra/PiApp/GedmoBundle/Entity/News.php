<?php
/**
 * This file is part of the <Gedmo> project.
 *
 * @category   Gedmo_Entities
 * @package    Entity
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-07-18
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
 * PiApp\GedmoBundle\Entity\News
 *
 * @ORM\Table(name="gedmo_news")
 * @ORM\Entity(repositoryClass="PiApp\GedmoBundle\Repository\NewsRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\TranslationEntity(class="PiApp\GedmoBundle\Entity\Translation\NewsTranslation")
 *
 * @category   Gedmo_Entities
 * @package    Entity
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class News extends AbstractDefault 
{
    /**
     * List of al translatable fields
     * 
     * @var array
     * @access  protected
     */
    protected $_fields    = array('title', 'descriptif', 'content', 'contentdetail', 'slug', 'meta_keywords', 'meta_description');

    /**
     * Name of the Translation Entity
     * 
     * @var array
     * @access  protected
     */
    protected $_translationClass = 'PiApp\GedmoBundle\Entity\Translation\NewsTranslation';
    
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="PiApp\GedmoBundle\Entity\Translation\NewsTranslation", mappedBy="object", cascade={"persist", "remove"})
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
     * @var string $title
     * 
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="string", length=128, nullable=false)
     * @Assert\NotBlank()
     */
    protected $title;
    
    /**
     * @var text $descriptif
     * 
     * @Gedmo\Translatable
     * @ORM\Column(name="descriptif", type="text", nullable=true)
     * @Assert\NotBlank()
     */
    protected $descriptif;    

    /**
     * @var string $content
     * 
     * @Gedmo\Translatable
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    protected $content;
    
    /**
     * @var string $content
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="contentdetail", type="text", nullable=true)
     */
    protected $contentdetail;    
    
    /**
     * @var \PiApp\AdminBundle\Entity\Page $page
     * 
     * @ORM\ManyToOne(targetEntity="PiApp\AdminBundle\Entity\Page")
     * @ORM\JoinColumn(name="page_intro_id", referencedColumnName="id", nullable=true)
     */
    protected $page;

    /**
     * @var \PiApp\AdminBundle\Entity\Page $pagedetail
     *
     * @ORM\ManyToOne(targetEntity="PiApp\AdminBundle\Entity\Page")
     * @ORM\JoinColumn(name="page_detail_id", referencedColumnName="id", nullable=true)
     */
    protected $pagedetail;    
    
//     /**
//      * @var integer $image
//      *
//      * @ORM\ManyToOne(targetEntity="BootStrap\MediaBundle\Entity\Media", cascade={"persist"})
//      * @ORM\JoinColumn(name="image", referencedColumnName="id", nullable=true)
//      */
//     protected $image;

    //
    // * @Assert\File(
    //        *     maxSize = "10M",
    //        *     mimeTypes = {
    //    "image/gif","image/jpeg","image/png"},
        //    *     mimeTypesMessage = "Please upload a valid image"
        //    * )    
    
    /**
     * @var \PiApp\GedmoBundle\Entity\Media $media
     *
     * @ORM\OneToOne(targetEntity="PiApp\GedmoBundle\Entity\Media" , cascade={"all"}, inversedBy="news");
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id", nullable=true)
     */
    protected $media;   

    /**
     * @var string $slug
     *
     * @Gedmo\Translatable
     * @Gedmo\Slug(separator="-", fields={"id", "title"})
     * @ORM\Column(name="slug", length=128, unique=false, nullable=true)
     */
    protected $slug;    
    
    /**
     * @var text $meta_keywords
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="meta_keywords", type="text", nullable=true)
     */
    protected $meta_keywords;
    
    /**
     * @var text $meta_description
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="meta_description", type="text", nullable=true)
     */
    protected $meta_description;    
    
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
        return (string) 'Actu : ' . $this->getTitle();
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
     * Set page
     *
     * @param \PiApp\AdminBundle\Entity\Page
     */
    public function setPage($page)
    {
        $this->page = $page;
        return $this;
    }
    
    /**
     * Get page
     *
     * @return \PiApp\AdminBundle\Entity\Page
     */
    public function getPage()
    {
        return $this->page;
    } 

    /**
     * Set page detail
     *
     * @param \PiApp\AdminBundle\Entity\Page
     */
    public function setPagedetail($page)
    {
        $this->pagedetail = $page;
        return $this;
    }
    
    /**
     * Get page detail
     *
     * @return \PiApp\AdminBundle\Entity\Page
     */
    public function getPagedetail()
    {
        return $this->pagedetail;
    }    

    /**
     * Set title
     *
     * @param string $title
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
     * Set content
     *
     * @param string $content
     */    
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
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
     * Set content detail
     *
     * @param string $contentdetail
     */
    public function setContentdetail($contentdetail)
    {
        $this->contentdetail = $contentdetail;
        return $this;
    }
    
    /**
     * Get content detail
     *
     * @return string
     */
    public function getContentdetail()
    {
        return $this->contentdetail;
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
     * Get slug
     *
     * @return string
     */    
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set meta_keywords
     *
     * @param text $metaKeywords
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->meta_keywords = $metaKeywords;
    }
    
    /**
     * Get meta_keywords
     *
     * @return text
     */
    public function getMetaKeywords()
    {
        return $this->meta_keywords;
    }
    
    /**
     * Set meta_description
     *
     * @param text $metaDescription
     */
    public function setMetaDescription($metaDescription)
    {
        $this->meta_description = $metaDescription;
    }
    
    /**
     * Get meta_description
     *
     * @return text
     */
    public function getMetaDescription()
    {
        return $this->meta_description;
    }    

}