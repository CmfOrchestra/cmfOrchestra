<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Entities
 * @package    Entity
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2011-12-28
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use PiApp\AdminBundle\Validator\Constraints as MyAssert;
use BootStrap\UserBundle\Repository\RoleRepository;

/**
 * PiApp\AdminBundle\Entity\TranslationPage
 *
 * @ORM\Table(name="pi_page_translation")
 * @ORM\Entity(repositoryClass="PiApp\AdminBundle\Repository\TranslationPageRepository")
 * @ORM\HasLifecycleCallbacks()
 * 
 * @category   Admin_Entities
 * @package    Entity
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class TranslationPage
{
    /**
     * @var bigint $id
     * 
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;   

    /**
     * @var \PiApp\AdminBundle\Entity\Page $page
     * 
     * @ORM\ManyToOne(targetEntity="PiApp\AdminBundle\Entity\Page", inversedBy="translations", cascade={"persist"})
     * @ORM\JoinColumn(name="page_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $page;
    
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection $tags
     * 
     * @ORM\ManyToMany(targetEntity="PiApp\AdminBundle\Entity\Tag")
     * @ORM\JoinTable(name="pi_tag_page",
     *      joinColumns={@ORM\JoinColumn(name="page_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")}
     *      )
     */
    protected $tags;
    
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection $comments
     * 
     * @ORM\OneToMany(targetEntity="PiApp\AdminBundle\Entity\Comment", mappedBy="pageTranslation", cascade={"all"})
     */
    protected $comments;   

    /**
     * @var \PiApp\AdminBundle\Entity\Langue $langCode
     *
     * @ORM\ManyToOne(targetEntity="PiApp\AdminBundle\Entity\Langue", cascade={"persist", "detach"})
     * @ORM\JoinColumn(name="lang_code", referencedColumnName="id", nullable=false)
     */
    protected $langCode;
    
    /**
     * @var string $langStatus
     *
     * @ORM\Column(name="lang_status", type="string", nullable=true)
     */
    protected $langStatus;
    
    /**
     * @var string $status
     *
     * @ORM\Column(name="status", type="string", nullable=false)
     * @Assert\NotBlank(message = "erreur.status.notblank")
     */
    protected $status; 

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection $historicalStatus
     * 
     * @ORM\OneToMany(targetEntity="PiApp\AdminBundle\Entity\HistoricalStatus", mappedBy="pageTranslation", cascade={"all"})
     */
    protected $historicalStatus;    

    /**
     * @var boolean $secure
     *
     * @ORM\Column(name="is_secure", type="boolean", nullable=true)
     */
    protected $secure;   
    
    /**
     * @var array
     * @ORM\Column(name="secure_roles", type="array", nullable=true)
     */
    protected $heritage;    

    /**
     * @var boolean $indexable
     *
     * @ORM\Column(name="is_indexable", type="boolean", nullable=true)
     */
    protected $indexable;    
    
    /**
     * @var string $breadcrumb
     * 
     * @ORM\Column(name="breadcrumb", type="string", nullable=true)
     * @Assert\MinLength(limit = 3, message = "Le breadcrumb doit avoir au moins {{ limit }} caractères")
     */
    protected $breadcrumb;    
    
    /**
     * @var string $slug
     * 
     * @ORM\Column(name="slug", type="string", nullable=true)
     * @Assert\MinLength(limit = 2, message = "erreur.slug.minlength")
     * @MyAssert\Unique(entity="TranslationPage", property="slug")
     */
    protected $slug;
    
    /**
     * @var text $meta_title
     *
     * @ORM\Column(name="meta_title", type="string", nullable=true)
     */
    protected $meta_title;    
    
    /**
     * @var text $meta_keywords
     * 
     * @ORM\Column(name="meta_keywords", type="text", nullable=true)
     */
    protected $meta_keywords;
    
    /**
     * @var text $meta_description
     * 
     * @ORM\Column(name="meta_description", type="text", nullable=true)
     */
    protected $meta_description;    
    
    /**
     * @var string $surtitre
     *
     * @ORM\Column(name="surtitre", type="string", nullable=true)
     * @Assert\MinLength(limit = 3, message = "Le surtitre name doit avoir au moins {{ limit }} caractères")
     */
    protected $surtitre;

    /**
     * @var string $titre
     *
     * @ORM\Column(name="titre", type="string", nullable=true)
     * @Assert\MinLength(limit = 3, message = "Le titre name doit avoir au moins {{ limit }} caractères")
     */
    protected $titre;

    /**
     * @var string $soustitre
     *
     * @ORM\Column(name="soustitre", type="string", nullable=true)
     * @Assert\MinLength(limit = 3, message = "Le soustitre name doit avoir au moins {{ limit }} caractères")
     */
    protected $soustitre;

    /**
     * @var text $descriptif
     *
     * @ORM\Column(name="descriptif", type="text", nullable=true)
     * @Assert\MinLength(limit = 25, message = "Le descriptif name doit avoir au moins {{ limit }} caractères")
     */
    protected $descriptif;

    /**
     * @var text $chapo
     *
     * @ORM\Column(name="chapo", type="text", nullable=true)
     * @Assert\MinLength(limit = 25, message = "Le chapo name doit avoir au moins {{ limit }} caractères")
     */
    protected $chapo;

    /**
     * @var text $texte
     *
     * @ORM\Column(name="texte", type="text", nullable=true)
     */
    protected $texte;

    /**
     * @var text $ps
     *
     * @ORM\Column(name="ps", type="text", nullable=true)
     */
    protected $ps;

    /**
     * @var datetime $created_at
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $created_at;

    /**
     * @var datetime $updated_at
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    protected $updated_at;
    
    /**
     * @var date $published_at
     * 
     * @ORM\Column(name="published_at", type="date", nullable=true)
     */
    protected $published_at;    

    /**
     * @var datetime $archive_at
     * 
     * @ORM\Column(name="archive_at", type="datetime", nullable=true)
     */
    protected $archive_at;
    
    /**
     * @var boolean $enabled
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=true)
     */
    protected $enabled;  
    
    /**
     * @var boolean $archived
     *
     * @ORM\Column(name="archived", type="boolean", nullable=false)
     */
    protected $archived = false;
      

    public function __construct()
    {
        $this->tags                 = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments             = new \Doctrine\Common\Collections\ArrayCollection();
        $this->historical_status     = new \Doctrine\Common\Collections\ArrayCollection();
    
        $this->setEnabled(true);
        //$this->setCreatedAt(new \DateTime());
        //$this->setUpdatedAt(new \DateTime());
    
    }
    
    public function __toString()
    {
        $meta_title = $this->getMetaTitle();
        if (!empty($meta_title))
            $meta_title = ' ('.$meta_title.')';
        return (string) $this->getId() . '. ' . $this->getSlug() . $meta_title;
    }    

//     /**
//      * @ORM\prePersist
//      */
//     public function setCreatedValue()
//     {
//         $this->setCreatedAt(new \DateTime());
//         $this->setUpdatedAt(new \DateTime());
//     }
    
//     /**
//      * @ORM\preUpdate
//      */
//     public function setUpdatedValue()
//     {
//         $this->setUpdatedAt(new \DateTime());
//     }
    
    public function slugify($text)
    {
        // replace non letter or digits by -
        //$text = preg_replace('#[^\\pL\d]+#u', '-', $text);
        $text = preg_replace('#[^\\pL\/\d]+#u', '-', $text);

        // delete all accent
        $translit = array('Á'=>'A','À'=>'A','Â'=>'A','Ä'=>'A','Ã'=>'A','Å'=>'A','Ç'=>'C','É'=>'E','È'=>'E','Ê'=>'E','Ë'=>'E','Í'=>'I','Ï'=>'I','Î'=>'I','Ì'=>'I','Ñ'=>'N','Ó'=>'O','Ò'=>'O','Ô'=>'O','Ö'=>'O','Õ'=>'O','Ú'=>'U','Ù'=>'U','Û'=>'U','Ü'=>'U','Ý'=>'Y','á'=>'a','à'=>'a','â'=>'a','ä'=>'a','ã'=>'a','å'=>'a','ç'=>'c','é'=>'e','è'=>'e','ê'=>'e','ë'=>'e','í'=>'i','ì'=>'i','î'=>'i','ï'=>'i','ñ'=>'n','ó'=>'o','ò'=>'o','ô'=>'o','ö'=>'o','õ'=>'o','ú'=>'u','ù'=>'u','û'=>'u','ü'=>'u','ý'=>'y','ÿ'=>'y');
        $text       = strtr($text, $translit);
        
        // trim
        $text = trim($text, '-');
    
        // transliterate
        if (function_exists('iconv'))
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    
        // lowercase
        $text = strtolower($text);
    
        // remove unwanted characters
        //$text = preg_replace('#[^-\w]+#', '', $text);
    
        if (empty($text))
            return '';
        else
            return $text;
    }    
    
    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $this->slugify($slug);
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
     * Get id
     *
     * @return bigint 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set langStatus
     *
     * @param string $langStatus
     */
    public function setLangStatus($langStatus)
    {
        $this->langStatus = $langStatus;
    }

    /**
     * Get langStatus
     *
     * @return string 
     */
    public function getLangStatus()
    {
        return $this->langStatus;
    }

    /**
     * Set status
     *
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
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
     * Set secure
     *
     * @param boolean $secure
     */
    public function setSecure($secure)
    {
        $this->secure = $secure;
    }

    /**
     * Get secure
     *
     * @return boolean 
     */
    public function getSecure()
    {
        return $this->secure;
    }
    
    /**
     * Set Role
     *
     * @param array $heritage
     */
    public function setHeritage( array $heritage)
    {
        $this->heritage = array();
    
        foreach ($heritage as $role) {
            $this->addRoleInHeritage($role);
        }
    }
    
    /**
     * Get heritage
     *
     * @return array
     */
    public function getHeritage()
    {
        return $this->heritage;
    }    
    
    /**
     * Adds a role heritage.
     *
     * @param string $role
     */
    public function addRoleInHeritage($role)
    {
        $role = strtoupper($role);
    
        if (!in_array($role, $this->heritage, true)) {
            $this->heritage[] = $role;
        }
    }    

    /**
     * Set indexable
     *
     * @param boolean $indexable
     */
    public function setIndexable($indexable)
    {
        $this->indexable = $indexable;
    }

    /**
     * Get indexable
     *
     * @return boolean 
     */
    public function getIndexable()
    {
        return $this->indexable;
    }

    /**
     * Set breadcrumb
     *
     * @param string $breadcrumb
     */
    public function setBreadcrumb($breadcrumb)
    {
        $this->breadcrumb = $breadcrumb;
    }

    /**
     * Get breadcrumb
     *
     * @return string 
     */
    public function getBreadcrumb()
    {
        return $this->breadcrumb;
    }
    
    /**
     * Set meta_Title
     *
     * @param text $metaTitle
     */
    public function setMetaTitle($metaTitle)
    {
        $this->meta_title = $metaTitle;
    }
    
    /**
     * Get meta_Title
     *
     * @return text
     */
    public function getMetaTitle()
    {
        return $this->meta_title;
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

    /**
     * Set surtitre
     *
     * @param string $surtitre
     */
    public function setSurtitre($surtitre)
    {
        $this->surtitre = $surtitre;
    }

    /**
     * Get surtitre
     *
     * @return string 
     */
    public function getSurtitre()
    {
        return $this->surtitre;
    }

    /**
     * Set titre
     *
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set soustitre
     *
     * @param string $soustitre
     */
    public function setSoustitre($soustitre)
    {
        $this->soustitre = $soustitre;
    }

    /**
     * Get soustitre
     *
     * @return string 
     */
    public function getSoustitre()
    {
        return $this->soustitre;
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
     * Set chapo
     *
     * @param text $chapo
     */
    public function setChapo($chapo)
    {
        $this->chapo = $chapo;
    }

    /**
     * Get chapo
     *
     * @return text 
     */
    public function getChapo()
    {
        return $this->chapo;
    }

    /**
     * Set texte
     *
     * @param text $texte
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;
    }

    /**
     * Get texte
     *
     * @return text 
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set ps
     *
     * @param text $ps
     */
    public function setPs($ps)
    {
        $this->ps = $ps;
    }

    /**
     * Get ps
     *
     * @return text 
     */
    public function getPs()
    {
        return $this->ps;
    }
    
    
    /**
     * Set page
     *
     * @param \PiApp\AdminBundle\Entity\Page
     */
    public function setPage($page)
    {
        $this->page = $page;
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
     * Add tag
     *
     * @param \PiApp\AdminBundle\Entity\Tag
     */
    public function addTag(\PiApp\AdminBundle\Entity\Tag $tag)
    {
        $this->tags[] = $tag;
    }
    
    public function setTags($tags)
    {
        $this->tags = $tags;
    }
    
    /**
     * remove tag
     *
     * @param  \PiApp\AdminBundle\Entity\Tag $tag
     */
    public function removeTag(\PiApp\AdminBundle\Entity\Tag $tag)
    {
        return $this->tags->removeElement($tag);
    }
    
    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getTags()
    {
        return $this->tags;
    }
    
    /**
     * Add comments
     *
     * @param \PiApp\AdminBundle\Entity\Comment
     */
    public function addComment(\PiApp\AdminBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;
    }
    
    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getComments()
    {
        return $this->comments;
    }
    
    /**
     * Set langCode
     *
     * @param \PiApp\AdminBundle\Entity\Langue
     */
    public function setLangCode(\PiApp\AdminBundle\Entity\Langue $langCode)
    {
        $this->langCode = $langCode;
    }
    
    /**
     * Get langCode
     *
     * @return \PiApp\AdminBundle\Entity\Langue
     */
    public function getLangCode()
    {
        return $this->langCode;
    }
    
    /**
     * Add historical_status
     *
     * @param \PiApp\AdminBundle\Entity\HistoricalStatus
     */
    public function addHistoricalStatus(\PiApp\AdminBundle\Entity\HistoricalStatus $historicalStatus)
    {
        $this->historical_status[] = $historicalStatus;
    }
    
    /**
     * Get historical_status
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getHistoricalStatus()
    {
        return $this->historical_status;
    }    

    /**
     * Set created_at
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }

    /**
     * Get created_at
     *
     * @return datetime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    }

    /**
     * Get updated_at
     *
     * @return datetime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set published_at
     *
     * @param date $publishedAt
     */
    public function setPublishedAt($publishedAt)
    {
        $this->published_at = $publishedAt;
    }

    /**
     * Get published_at
     *
     * @return date 
     */
    public function getPublishedAt()
    {
        return $this->published_at;
    }

    /**
     * Set archive_at
     *
     * @param datetime $archiveAt
     */
    public function setArchiveAt($archiveAt)
    {
        $this->archive_at = $archiveAt;
    }

    /**
     * Get archive_at
     *
     * @return datetime 
     */
    public function getArchiveAt()
    {
        return $this->archive_at;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
    
    /**
     * Set archived
     *
     * @param boolean $enabled
     */
    public function setArchived($archived)
    {
        $this->archived = $archived;
        return $this;
    }
    
    /**
     * Get archived
     *
     * @return boolean
     */
    public function getArchived()
    {
        return $this->archived;
    }    

}