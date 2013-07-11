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

/**
 * PiApp\AdminBundle\Entity\Comment
 * 
 * @ORM\Table(name="pi_comment")
 * @ORM\Entity(repositoryClass="PiApp\AdminBundle\Repository\CommentRepository")
 * @ORM\HasLifecycleCallbacks()
 * 
 * @category   Admin_Entities
 * @package    Entity
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class Comment
{
    /**
     * @var bigint $id
     * 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string $user
     * 
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message = "You must enter your name")
     */
    protected $user;

    /**
     * @var \PiApp\AdminBundle\Entity\TranslationPage $pageTranslation
     * 
     * @ORM\ManyToOne(targetEntity="PiApp\AdminBundle\Entity\TranslationPage", inversedBy="comments", cascade={"persist"})
     * @ORM\JoinColumn(name="pagetrans_id", referencedColumnName="id")
     */
    protected $pageTranslation;    

    /**
     * @var text $comment
     * 
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message = "You must enter a comment")
     * @Assert\MinLength(limit = 25, message = "Le commentaire doit avoir au moins {{ limit }} caractères")
     */
    protected $comment;
    
    /**
     * @var text $email
     * 
     * @ORM\Column(name="email", type="text",  nullable=true)
     * @Assert\Email()
     */
    protected $email;    

    /**
     * @var boolean $approved
     * 
     * @ORM\Column(name="is_approved", type="boolean",  nullable=true)
     */
    protected $approved;

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
     * @var boolean $archived
     *
     * @ORM\Column(name="archived", type="boolean", nullable=false)
     */
    protected $archived = false;

    /**
     * @var integer $position
     *
     * @ORM\Column(name="position", type="integer", nullable=true)
     */
    protected $position;    

    
    public function __construct()
    {
    	//$this->setCreatedAt(new \DateTime());
    	//$this->setUpdatedAt(new \DateTime());
    
    	$this->setApproved(true);
    	$this->setEnabled(true);
    }
    
    public function __toString()
    {
    	return (string) $this->getUser();
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
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param string $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return string 
     */
    public function getUser()
    {
        return $this->user;
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
     * Set email
     *
     * @param text $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return text 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set approved
     *
     * @param boolean $approved
     */
    public function setApproved($approved)
    {
        $this->approved = $approved;
    }

    /**
     * Get approved
     *
     * @return boolean 
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * Set pageTranslation
     *
     * @param \PiApp\AdminBundle\Entity\TranslationPage
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
}