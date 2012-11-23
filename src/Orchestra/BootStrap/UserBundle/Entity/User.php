<?php
/**
 * This file is part of the <User> project.
 * 
 * @category   BootStrap_Entities
 * @package    Entity
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2011-11-28
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use BootStrap\UserBundle\Repository\PermissionRepository;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @ORM\HasLifecycleCallbacks()
 * 
 * @category   BootStrap_Entities
 * @package    Entity
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class User extends BaseUser
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
	 * @var array of \Doctrine\Common\Collections\ArrayCollection newsletters
	 *
	 * @ORM\ManyToMany(targetEntity="PiApp\GedmoBundle\Entity\Newsletter", mappedBy="users")
	 */
	protected $newsletters;
	
	/**
	 * @var array of \Doctrine\Common\Collections\ArrayCollection $rssneeds
	 *
	 * @ORM\ManyToMany(targetEntity="PiApp\GedmoBundle\Entity\Rss", mappedBy="users")
	 */
	protected $rssneeds;	

 	/**
     * @ORM\ManyToMany(targetEntity="BootStrap\UserBundle\Entity\Group")
     * @ORM\JoinTable(name="fos_user_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;
    
    /**
     * @var string $langCode
     *
     * @ORM\ManyToOne(targetEntity="PiApp\AdminBundle\Entity\Langue", cascade={"persist", "update"})
     * @ORM\JoinColumn(name="lang_code", referencedColumnName="id", nullable=true)
     */
    protected $langCode; 
    
    /**
     * @var array
     * @ORM\Column(type="array")
     */
    protected $permissions;    
    

    public function __construct()
    {
    	parent::__construct();
    	
    	$this->groups		= new \Doctrine\Common\Collections\ArrayCollection();
    	$this->newsletters	= new \Doctrine\Common\Collections\ArrayCollection();
    	$this->rssneeds		= new \Doctrine\Common\Collections\ArrayCollection();
    }    
    
    /**
     *
     * This method is used when you want to convert to string an object of
     * this Entity
     * ex: $value = (string)$entity;
     *
     */
    public function __toString() {
    	return (string) $this->username;
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
     * Add groups
     *
     * @param \BootStrap\UserBundle\Entity\Group $groups
     */
    public function addGroupUser(\BootStrap\UserBundle\Entity\Group $groups)
    {
        $this->groups[] = $groups;
    }

    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getGroupsUser()
    {
        return $this->groups;
    }
    
    /**
     * Set permissions
     *
     * @param array $permissions
     */
    public function setPermissions(array $permissions)
    {
    	$this->permissions = array();
    
    	foreach ($permissions as $permission) {
    		$this->addPermission($permission);
    	}
    }
    
    /**
     * Get permissions
     *
     * @return array
     */
    public function getPermissions()
    {
    	$permissions = $this->permissions;
    
    	// we need to make sure to have at least one role
    	$permissions[] = PermissionRepository::ShowDefaultPermission();
    
    	return array_unique($permissions);
    }   

    /**
     * Adds a permission to the user.
     *
     * @param string $permission
     */
    public function addPermission($permission)
    {
    	$permission = strtoupper($permission);
    
    	if (!in_array($permission, $this->permissions, true)) {
    		$this->permissions[] = $permission;
    	}
    }    

    /**
     * Set langCode
     *
     * @param \PiApp\AdminBundle\Entity\Langue $langCode
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
     * Get events
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getNewsletters()
    {
    	return $this->newsletters;
    }
    
    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getRssneeds()
    {
    	return $this->rssneeds;
    }    

}