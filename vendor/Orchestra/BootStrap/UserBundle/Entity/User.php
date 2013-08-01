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
 * @ORM\Entity(repositoryClass="BootStrap\UserBundle\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks() 
 * 
 * @category   BootStrap_Entities
 * @package    Entity
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class User extends BaseUser
{
    const ROLE_DEFAULT = 'ROLE_ALLOWED_TO_SWITCH';
    
    /**
     * @var bigint $id
     * 
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    
    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", nullable = true)
     */
    protected $name;
        
    /**
     * @var string $nickname
     *
     * @ORM\Column(name="nickname", type="string", nullable = true)
     */
    protected $nickname;    
    
    /**
     * @var array of \Doctrine\Common\Collections\ArrayCollection newsletters
     *
     * @ORM\ManyToMany(targetEntity="PiApp\GedmoBundle\Entity\Newsletter", mappedBy="users")
     */
    protected $newsletters;
    
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="PiApp\GedmoBundle\Entity\Ads", mappedBy="user", cascade={"all"})
     */
    protected $ads;  

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
     * @ORM\ManyToOne(targetEntity="PiApp\AdminBundle\Entity\Langue", cascade={"persist", "detach"})
     * @ORM\JoinColumn(name="lang_code", referencedColumnName="id", nullable=true)
     */
    protected $langCode; 
    
    /**
     * @var \PiApp\GedmoBundle\Entity\Individual $individual
     *
     * @ORM\OneToOne(targetEntity="PiApp\GedmoBundle\Entity\Individual", mappedBy="user")
     */
    protected $individual;    
    
    /**
     * @var \PiApp\GedmoBundle\Entity\Corporation $corporation
     *
     * @ORM\OneToOne(targetEntity="PiApp\GedmoBundle\Entity\Corporation", mappedBy="user")
     */
    protected $corporation;    
    
    /**
     * @var array
     * @ORM\Column(type="array")
     */
    protected $permissions = array();    
    
    /**
     * @var \DateTime
     */
    public $expiresAt;
    
    /**
     * @var \DateTime
     */
    public $credentialsExpireAt;    
    
    /**
     * @var datetime $created_at
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $created_at;    
    

    public function __construct()
    {
        parent::__construct();
        
        $this->groups        = new \Doctrine\Common\Collections\ArrayCollection();
        $this->newsletters    = new \Doctrine\Common\Collections\ArrayCollection();
        $this->typocommissions    = new \Doctrine\Common\Collections\ArrayCollection();
        $this->events    = new \Doctrine\Common\Collections\ArrayCollection();      
        $this->rssneeds        = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ads          = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add newsletters
     *
     * @param \PiApp\GedmoBundle\Entity\Newsletter $newsletters
     */
    public function addNewsletter(\PiApp\GedmoBundle\Entity\Newsletter $newsletters)
    {
        $newsletters->addUser($this);
        $this->newsletters[] = $newsletters;
    }
    
    /**
     * Remove newsletter
     *
     * @param \PiApp\GedmoBundle\Entity\Newsletter $newsletter
     */
    public function removeNewsletter(\PiApp\GedmoBundle\Entity\Newsletter $newsletter)
    {
       return $newsletter->removeUser($this);
    }

    /**
     * Add ads
     *
     * @param \PiApp\GedmoBundle\Entity\Ads $ads
     */
    public function addAds(\PiApp\GedmoBundle\Entity\Ads $ads)
    {
        $this->ads[] = $ads;
    }
    
    /**
     * Get all ads
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getAds()
    {
        return $this->ads;
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
     * Remove a permission to the user.
     *
     * @param string $permission
     */
    public function removePermission($permission)
    {
        $permission = strtoupper($permission);
    
        if (in_array($permission, $this->permissions, true)) {
            $key = array_search($permission, $this->permissions);
            unset($this->permissions[$key]);
        }
    }     

    /**
     * Adds a role to the user.
     *
     * @param string $role
     */
    public function addRole($role)
    {
        $role = strtoupper($role);
        if ($role === static::ROLE_DEFAULT) {
            return;
        }
    
        if (!in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }
    }

    /**
     * Returns the user roles
     *
     * Implements SecurityUserInterface
     *
     * @return array The roles
     */
    public function getRoles()
    {
        $roles = $this->roles;
    
        foreach ($this->getGroups() as $group) {
            $roles = array_merge($roles, $group->getRoles());
        }
        
        // we need to make sure to have at least one role
        $roles[] = static::ROLE_DEFAULT;
        
        return array_unique($roles);
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
     * Get newsletters
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getNewsletters()
    {
        return $this->newsletters;
    }
    
    /**
     * Get rssneeds
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getRssneeds()
    {
        return $this->rssneeds;
    }    
    
    /**
     * Get corporation
     *
     * @return \PiApp\GedmoBundle\Entity\Corporation
     */
    public function getCorporation()
    {
        return $this->corporation;
    }   

    /**
     * Get individual
     *
     * @return \PiApp\GedmoBundle\Entity\Individual
     */
    public function getIndividual()
    {
        return $this->individual;
    }    
    
    /**
     * Set name
     *
     * @param text $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    
    /**
     * Get name
     *
     * @return text
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set nickname
     *
     * @param text $nickname
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }
    
    /**
     * Get nickname
     *
     * @return text
     */
    public function getNickname()
    {
        return $this->nickname;
    }
    
    /**
     * Set created_at
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
        return $this;
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
    

}