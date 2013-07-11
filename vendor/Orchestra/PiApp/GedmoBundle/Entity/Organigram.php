<?php
/**
 * This file is part of the <Gedmo> project.
 *
 * @category   Gedmo_Entities
 * @package    Entity
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-03-08
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
 * PiApp\GedmoBundle\Entity\Organigram
 *
 * @Gedmo\Tree(type="nested")
 * @ORM\Table(name="gedmo_organigram")
 * @ORM\Entity(repositoryClass="PiApp\GedmoBundle\Repository\OrganigramRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\TranslationEntity(class="PiApp\GedmoBundle\Entity\Translation\OrganigramTranslation")
 *
 * @category   Gedmo_Entities
 * @package    Entity
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class Organigram extends AbstractDefault 
{
    /**
     * List of al translatable fields
     * 
     * @var array
     * @access  protected
     */
    protected $_fields    = array('slug', 'title', 'content', 'descriptif', 'question');

    /**
     * Name of the Translation Entity
     * 
     * @var array
     * @access  protected
     */
    protected $_translationClass = 'PiApp\GedmoBundle\Entity\Translation\OrganigramTranslation';    
    
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="PiApp\GedmoBundle\Entity\Translation\OrganigramTranslation", mappedBy="object", cascade={"persist", "remove"})
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
     * @Gedmo\Translatable
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(name="slug", length=64, unique=true)
     */
    private $slug;    
    
    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=128, nullable=true)
     */
    protected $category;  

    /**
     * @var string
     * 
     * @ORM\Column(name="categoryother", type="string", length=128, nullable=true)
     */
    protected $categoryother;    

    /**
     * @var string
     * 
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="string", length=128, nullable=true)
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
     * @var string
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="question", type="string", length=128, nullable=true)
     */
    protected $question;    
    
    /**
     * @var string
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    protected $content;    
    
    /**
     * @var \PiApp\AdminBundle\Entity\Page $page
     * 
     * @ORM\ManyToOne(targetEntity="PiApp\AdminBundle\Entity\Page")
     * @ORM\JoinColumn(name="page_id", referencedColumnName="id", nullable=true)
     */
    protected $page;
    
    /**
     * @var \PiApp\GedmoBundle\Entity\Media $media
     *
     * @ORM\OneToOne(targetEntity="PiApp\GedmoBundle\Entity\Media" , cascade={"all"}, inversedBy="organigram");
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id", nullable=true)
     */
    protected $media;    

    
    /**
     * Constructor
     */    
    public function __construct()
    {
        parent::__construct();
        
        $this->childrens = new \Doctrine\Common\Collections\ArrayCollection();
        $this->setEnabled(true);        
    }    
    
    public function __toString()
    {
        return (string) $this->getTitle() . ' - ' . $this->getQuestion();
    }    
    
    /**
     * @ORM\PrePersist
     * @ORM\preUpdate
     */
    public function setUpdatedValue()
    {
        $other  = $this->getCategoryother();
        if (!empty($other)){
            $this->setCategory($other);
            $this->setCategoryother('');
        }
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
    
    public function getSlug()
    {
        return $this->slug;
    }    
    
    /**
     * Set page
     *
     * @param \PiApp\AdminBundle\Entity\Page    $page
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
     * Set category
     *
     * @param string $category
     */
    public function setCategory($category)
    {
           $this->category = $category;
    }
    
    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }
    
    /**
     * Set category
     *
     * @param string $category
     */
    public function setCategoryother($category)
    {
           $this->categoryother = $category;
    }
    
    /**
     * Get category
     *
     * @return string
     */
    public function getCategoryother()
    {
        return $this->categoryother;
    }    

    /**
     * Set $title
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
     * Set $content
     *
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
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
     * Set question
     *
     * @param string $title
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }
    
    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
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
    
    /*******************************************************************************************************
     *
     * Tree definition
     *
     *******************************************************************************************************/
    
    
    /**
     * @var integer $parent
     *
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Organigram", inversedBy="childrens", cascade={"all"})
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     */
    protected $parent;
    
    /**
     * @var array $childrens
     *
     * @ORM\OneToMany(targetEntity="Organigram", mappedBy="parent", cascade={"persist"})
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    protected $childrens;
    
    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(name="lft", type="integer", nullable=true)
     */
    private $lft;
    
    /**
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt", type="integer", nullable=true)
     */
    private $rgt;
    
    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer", nullable=true)
     */
    private $lvl;
    
    /**
     * @Gedmo\TreeRoot
     * @ORM\Column(name="root", type="integer", nullable=true)
     */
    private $root;
    
    /**
     * @var array parents_tree
     */
    protected $parents_tree = null;
    
    /**
     * Get childrens
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getChildrens()
    {
        return $this->childrens;
    }
    
    /**
     * Set parent
     *
     * @param \PiApp\GedmoBundle\Entity\Organigram    $parent
     */
    public function setParent(\PiApp\GedmoBundle\Entity\Organigram $parent)
    {
        $this->parent = $parent;
    }
    
    /**
     * Get parent
     *
     * @return \PiApp\GedmoBundle\Entity\Organigram
     */
    public function getParent()
    {
        return $this->parent;
    }
    
    /**
     * Set the parent tree
     *
     * @param array $parents
     */
    public function setTreeParents(array $parents)
    {
        $this->parents_tree = $parents;
    }
    
    /**
     * get the tree of the page, build it from the parent if the tree does not exist
     *
     * @return array\Sonata\PageBundle\Model\PageInterface
     */
    public function getTreeParents()
    {
        if (!$this->parents_tree) {
    
            $page = $this;
            $parents = array();
    
            while ($page->getParent()) {
                $page = $page->getParent();
                $parents[] = $page;
            }
    
            $this->setTreeParents(array_reverse($parents));
        }
    
        return $this->parents_tree;
    }
    
    /**
     * Get root
     *
     * @return integer
     */
    public function getRoot()
    {
        return $this->root;
    }
    
    /**
     * Get level
     *
     * @return integer
     */
    public function getLevel()
    {
        return $this->level;
    }
    
    /**
     * Get lft
     *
     * @return integer
     */
    public function getLeft()
    {
        return $this->lft;
    }
    
    /**
     * Get rgt
     *
     * @return integer
     */
    public function getRight()
    {
        return $this->rgt;
    }
    
    /**
     * Set lft
     *
     * @param integer $lft
     */
    public function setLft($lft)
    {
        $this->lft = $lft;
    }
    
    /**
     * Get lft
     *
     * @return integer
     */
    public function getLft()
    {
        return $this->lft;
    }
    
    /**
     * Set lvl
     *
     * @param integer $lvl
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;
    }
    
    /**
     * Get lvl
     *
     * @return integer
     */
    public function getLvl()
    {
        return $this->lvl;
    }
    
    /**
     * Set rgt
     *
     * @param integer $rgt
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;
    }
    
    /**
     * Get rgt
     *
     * @return integer
     */
    public function getRgt()
    {
        return $this->rgt;
    } 
    
}