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

/**
 * PiApp\AdminBundle\Entity\TranslationWidget
 *
 * @ORM\Table(name="pi_widget_translation")
 * @ORM\Entity(repositoryClass="PiApp\AdminBundle\Repository\TranslationWidgetRepository")
 * @ORM\HasLifecycleCallbacks()
 * 
 * @category   Admin_Entities
 * @package    Entity
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class TranslationWidget
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
     * @var \PiApp\AdminBundle\Entity\Widget $widget
     * 
     * @ORM\ManyToOne(targetEntity="PiApp\AdminBundle\Entity\Widget", inversedBy="translations", cascade={"persist"})
     * @ORM\JoinColumn(name="widget_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $widget;
    
    /**
     * @var \PiApp\AdminBundle\Entity\Langue $langCode
     *
     * @ORM\ManyToOne(targetEntity="PiApp\AdminBundle\Entity\Langue", cascade={"persist", "refresh"})
     * @ORM\JoinColumn(name="lang_code", referencedColumnName="id", nullable=false)
     */
    protected $langCode;
    
    /**
     * @var text $content
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    protected $content;    
    
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
    	$this->setEnabled(true);
    	
    	//$this->setCreatedAt(new \DateTime());
    	//$this->setUpdatedAt(new \DateTime());
    }   
    
    public function __toString()
    {
    	return (string) $this->id;
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
     * Set content
     *
     * @param text $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Get content
     *
     * @return text 
     */
    public function getContent()
    {
        return $this->content;
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
     * Set widget
     *
     * @param \PiApp\AdminBundle\Entity\Widget
     */
    public function setWidget(\PiApp\AdminBundle\Entity\Widget $widget)
    {
        $this->widget = $widget;
    }

    /**
     * Get widget
     *
     * @return \PiApp\AdminBundle\Entity\Widget 
     */
    public function getWidget()
    {
        return $this->widget;
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