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

/**
 * PiApp\AdminBundle\Entity\HistoricalStatus
 *
 * @ORM\Table(name="pi_page_historical_status")
 * @ORM\Entity(repositoryClass="PiApp\AdminBundle\Repository\HistoricalStatusRepository")
 * @ORM\HasLifecycleCallbacks
 * 
 * @category   Admin_Entities
 * @package    Entity
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class HistoricalStatus
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
 
    /**
     * @var object $order
     *
     * @ORM\ManyToOne(targetEntity="TranslationPage", inversedBy="historicalStatus", cascade={"all"})
     * @ORM\JoinColumn(name="pagetrans_id", referencedColumnName="id")
     */
    protected $pageTranslation;
 
 
    /**
     * @var string $status
     *
     * @ORM\Column(name="status", type="string", nullable=false)
     */
    protected $status; 
 
    /**
     * @var text $comment
     *
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    protected $comment;
 
    /**
     * @var datetime $created_at
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $created_at;
    
    /**
     * @var boolean $enabled
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=true)
     */
    protected $enabled; 
 
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
     * Set comment
     *
     * @param text $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get comment
     *
     * @return text 
     */
    public function getComment()
    {
        return $this->comment;
    }
    
    /**
     * Set pageTranslation
     *
     * @param \PiApp\AdminBundle\Entity\TranslationPage	$pageTranslation
     */
    public function setPageTranslation(\PiApp\AdminBundle\Entity\TranslationPage $pageTranslation)
    {
    	$this->pageTranslation = $pageTranslation;
    }
    
    /**
     * Get pageTranslation
     *
     * @return \PiApp\AdminBundle\Entity\TranslationPage
     */
    public function getPageTranslation()
    {
    	return $this->pageTranslation;
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