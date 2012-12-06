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

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use PiApp\AdminBundle\Twig\Extension\PiWidgetExtension;

/**
 * PiApp\AdminBundle\Entity\Widget
 *
 * @ORM\Table(name="pi_widget")
 * @ORM\Entity(repositoryClass="PiApp\AdminBundle\Repository\WidgetRepository")
 * @ORM\HasLifecycleCallbacks()
 * 
 * @category   Admin_Entities
 * @package    Entity
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class Widget
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
     * @var \PiApp\AdminBundle\Entity\Block $block
     * 
     * @ORM\ManyToOne(targetEntity="PiApp\AdminBundle\Entity\Block", inversedBy="widgets", cascade={"persist"})
     * @ORM\JoinColumn(name="block_id", referencedColumnName="id")
     */
    protected $block;    
    
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection $translations
     *
     * @ORM\OneToMany(targetEntity="PiApp\AdminBundle\Entity\TranslationWidget", mappedBy="widget", cascade={"all"})
     */
    protected $translations;    
    
    /**
     * @var string $plugin
     *
     * @ORM\Column(name="plugin", type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     */
    protected $plugin;

    /**
     * @var string $action
     *
     * @ORM\Column(name="action", type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     */
    protected $action; 

    /**
     * @var boolean $cacheable
     *
     * @ORM\Column(name="is_cacheable", type="boolean", nullable=true)
     */
    protected $cacheable;
    
    /**
     * @var boolean $public
     *
     * @ORM\Column(name="is_public", type="boolean", nullable=true)
     */
    protected $public;
    
    /**
     * @var integer $lifetime
     *
     * @ORM\Column(name="lifetime", type="integer", nullable=true)
     */
    protected $lifetime;    
    
    /**
     * @var string $configCssClass
     *
     * @ORM\Column(name="config_css_class", type="string", nullable=true)
     */
    protected $configCssClass;
    
    /**
     * @var text $configXml
     *
     * @ORM\Column(name="config_xml", type="text", nullable=true)
     */
    protected $configXml;    

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

    /**
     * @var integer $position
     * 
     * @ORM\Column(name="position", type="integer", nullable=true)
     */
    protected $position;
    

    public function __construct()
    {
    	$this->translations = new \Doctrine\Common\Collections\ArrayCollection();
    
    	$this->setEnabled(true);
    	$this->setConfigXml(PiWidgetExtension::getDefaultConfigXml());
    	$this->setLifetime('84600');
    }

    /**
     *
     * This method is used when you want to convert to string an object of
     * this Entity
     * ex: $value = (string)$entity;
     *
     */
    public function __toString() {
    	return (string) $this->id;
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
     * Set plugin
     *
     * @param string $plugin
     */
    public function setPlugin($plugin)
    {
        $this->plugin = $plugin;
    }

    /**
     * Get plugin
     *
     * @return string 
     */
    public function getPlugin()
    {
        return $this->plugin;
    }

    /**
     * Set action
     *
     * @param string $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * Get action
     *
     * @return string 
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set configCssClass
     *
     * @param string $configCssClass
     */
    public function setConfigCssClass($configCssClass)
    {
        $this->configCssClass = $configCssClass;
    }

    /**
     * Get configCssClass
     *
     * @return string 
     */
    public function getConfigCssClass()
    {
        return $this->configCssClass;
    }

    /**
     * Set configXml
     *
     * @param text $configXml
     */
    public function setConfigXml($configXml)
    {
        $this->configXml = $configXml;
    }

    /**
     * Get configXml
     *
     * @return text 
     */
    public function getConfigXml()
    {
        return $this->configXml;
    }
    
    /**
     * Set cacheable
     *
     * @param boolean $cacheable
     */
    public function setCacheable($cacheable)
    {
    	$this->cacheable = $cacheable;
    }
    
    /**
     * Get cacheable
     *
     * @return boolean
     */
    public function getCacheable()
    {
    	return $this->cacheable;
    }
    
    /**
     * Set public
     *
     * @param boolean $public
     */
    public function setPublic($public)
    {
    	$this->public = $public;
    }
    
    /**
     * Get public
     *
     * @return boolean
     */
    public function getPublic()
    {
    	return $this->public;
    }
    
    /**
     * Set lifetime
     *
     * @param integer $lifetime
     */
    public function setLifetime($lifetime)
    {
    	$this->lifetime = $lifetime;
    }
    
    /**
     * Get lifetime
     *
     * @return integer
     */
    public function getLifetime()
    {
    	return $this->lifetime;
    }
    

    /**
     * Set position
     *
     * @param integer $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set block
     *
     * @param \PiApp\AdminBundle\Entity\Block $block
     */
    public function setBlock(\PiApp\AdminBundle\Entity\Block $block)
    {
        $this->block = $block;
    }

    /**
     * Get block
     *
     * @return \PiApp\AdminBundle\Entity\Block 
     */
    public function getBlock()
    {
        return $this->block;
    }
    
    /**
     * Set the collection of related translations
     *
     * @param \Doctrine\Common\Collections\ArrayCollection		$translations
     */
    public function setTranslations(\Doctrine\Common\Collections\ArrayCollection $translations)
    {
    	$this->translations = $translations;
    }    

    /**
     * Add translations
     *
     * @param \PiApp\AdminBundle\Entity\TranslationWidget		$translation
     */
    public function addTranslation(\PiApp\AdminBundle\Entity\TranslationWidget $translation)
    {
        $this->translations->add($translation);
        $translation->setWidget($this);        
    }

    /**
     * Get translations
     *
     * @return \Doctrine\Common\Collections\ArrayCollection 
     */
    public function getTranslations()
    {
        return $this->translations;
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