<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Entities
 * @package    Entity
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2011-12-28
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PiApp\AdminBundle\Entity\Rubrique
 *
 * @Gedmo\Tree(type="nested")
 * @ORM\Table(name="pi_rubrique")
 * @ORM\Entity(repositoryClass="PiApp\AdminBundle\Repository\RubriqueRepository")
 * @ORM\HasLifecycleCallbacks()
 * 
 * @category   Admin_Entities
 * @package    Entity
 * 
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class Rubrique
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
     * @var integer $parent
     * 
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Rubrique", inversedBy="childrens")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     */
    protected $parent;
    
    /**
     * @var array $childrens
     *
     * @ORM\OneToMany(targetEntity="Rubrique", mappedBy="parent", cascade={"persist"})
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    protected $childrens;    

    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(name="lft", type="integer", nullable=true)
     */
    private $lft;
    
    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer", nullable=true)
     */
    private $lvl;
    
    /**
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt", type="integer", nullable=true)
     */
    private $rgt;
    
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
     * @var array $keywords
     *
     * @ORM\ManyToMany(targetEntity="KeyWord")
     * @ORM\JoinTable(name="pi_keyword_rubrique",
     *      joinColumns={@ORM\JoinColumn(name="rubrique_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="keyword_id", referencedColumnName="id")}
     *      )
     * @Assert\Valid()
     */
    protected $keywords;    

    /**
     * @var string $titre
     *
     * @ORM\Column(name="titre", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message = "You must enter a title")
     * @Assert\MinLength(limit = 3, message = "Le titre name doit avoir au moins {{ limit }} caractères")
     */
    protected $titre;

    /**
     * @var text $descriptif
     *
     * @ORM\Column(name="descriptif", type="text", nullable=true)
     * @Assert\MinLength(limit = 3, message = "Le descriptif name doit avoir au moins {{ limit }} caractères")
     */
    protected $descriptif;

    /**
     * @var text $texte
     *
     * @ORM\Column(name="texte", type="text", nullable=true)
     */
    protected $texte;

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

    public function __construct()
    {
        $this->childrens = new \Doctrine\Common\Collections\ArrayCollection();
        
        $this->setEnabled(true);
        //$this->setCreatedAt(new \DateTime());
        //$this->setUpdatedAt(new \DateTime());        
    }
    
    public function __toString()
    {
    	return (string) $this->getTitre();
    }  

//     /**
//      * @ORM\prePersist
//      */
//     public function setCreatedValue()
//     {
//     	$this->setCreatedAt(new \DateTime());
//     	$this->setUpdatedAt(new \DateTime());
//     }
    
//     /**
//      * @ORM\preUpdate
//      */
//     public function setUpdatedValue()
//     {
//     	$this->setUpdatedAt(new \DateTime());
//     }    
    
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
     * Set descriptif
     *
     * @param text $descriptif
     */
    public function setDescriptif($descriptif)
    {
        $this->descriptif = $descriptif;
    }

    /**
     * Get descriptif
     *
     * @return text 
     */
    public function getDescriptif()
    {
        return $this->descriptif;
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
     * Add childrens
     *
     * @param \PiApp\AdminBundle\Entity\Rubrique
     */
    public function addRubrique(\PiApp\AdminBundle\Entity\Rubrique $childrens)
    {
        $this->childrens[] = $childrens;
    }

    /**
     * Get childrens
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildrens()
    {
        return $this->childrens;
    }

    /**
     * Set parent
     *
     * @param \PiApp\AdminBundle\Entity\Rubrique $parent
     */
    public function setParent(\PiApp\AdminBundle\Entity\Rubrique $parent)
    {
       	$this->parent = $parent;
    }

    /**
     * Get parent
     *
     * @return \PiApp\AdminBundle\Entity\Rubrique 
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
     * @return array of \Sonata\PageBundle\Model\PageInterface $parents
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

    public function getRoot()
    {
    	return $this->root;
    }
    
    public function getLevel()
    {
    	return $this->level;
    }

    public function getLeft()
    {
    	return $this->lft;
    }
    
    public function getRight()
    {
    	return $this->rgt;
    }    

    /**
     * Add keywords
     *
     * @param \PiApp\AdminBundle\Entity\KeyWord	$keywords
     */
    public function addKeyWord(\PiApp\AdminBundle\Entity\KeyWord $keywords)
    {
    	$this->keywords[] = $keywords;
    }
    
    public function setKeyWords($keywords)
    {
    	$this->keywords = $keywords;
    }
    
    /**
     * Get keywords
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKeywords()
    {
    	return $this->keywords;
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
    
    /**
     * Set root
     *
     * @param integer $root
     */
    public function setRoot($root)
    {
    	$this->root = $root;
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

}