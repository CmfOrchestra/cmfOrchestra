<?php
/**
 * This file is part of the <Translation> project.
 *
 * @category   BootStrap_Manager
 * @package    Route
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-02-03
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\TranslationBundle\Route;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RequestContext;

use BootStrap\TranslationBundle\Route\AbstractFactory;
use BootStrap\TranslationBundle\Builder\RoleFactoryInterface;

use BeSimple\I18nRoutingBundle\Routing\Generator\UrlGenerator;
use BeSimple\I18nRoutingBundle\Routing\I18nRoute;

use PiApp\AdminBundle\Entity\TranslationPage;
use PiApp\AdminBundle\Entity\Page;


/**
 * role factory.
 *
 * @category   BootStrap_Manager
 * @package    Route
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class RoleFactory extends AbstractFactory implements RoleFactoryInterface
{
    /**
     * Constructor.
     *
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
    }
    
    /**
     * Gets all user roles.
     *
     * @param array     $ROLES
     * @return array    the best roles of all roles.
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function getAllUserRoles()
    {
        if ($this->isUsernamePasswordToken()) {
            return array_unique(array_merge($this->getAllHeritageByRoles($this->getBestRoles($this->getUserRoles())), $this->getUserRoles()));
        } else {
            return null;
        }
    }    
    
    /**
     * Gets the best role of all user roles.
     *
     * @return string    the best role of all user roles.
     * @access protected
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function getBestRoleUser()
    {
    	// we get all user roles.
    	$ROLES_USER    = $this->getUserRoles();
    	// we get the map of all roles.
    	$roleMap = $this->buildRoleMap();
    	foreach ($roleMap as $role => $heritage) {
    		if (in_array($role, $ROLES_USER)) {
    			$intersect    = array_intersect($heritage, $ROLES_USER);
    			$ROLES_USER    = array_diff($ROLES_USER, $intersect);  // =  $ROLES_USER -  $intersect
    		}
    	}
    
    	return end($ROLES_USER);
    }    
    
    /**
     * Gets the best roles of many of roles.
     *
     * @param array     $ROLES
     * @return array    the best roles of all roles.
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function getBestRoles($ROLES)
    {
        if ($this->isUsernamePasswordToken()){
            if (is_null($ROLES)) {
                return null;
            }
            // we get the map of all roles.
            $roleMap = $this->buildRoleMap();
            foreach ($roleMap as $role => $heritage) {
                if (in_array($role, $ROLES)){
                    $intersect    = array_intersect($heritage, $ROLES);
                    $ROLES        = array_diff($ROLES, $intersect);  // =  $ROLES_USER -  $intersect
                }
            }
            
            return $ROLES;
        } else {
            return null;
        }
    }
    
    /**
     * Gets all heritage roles of many of roles.
     *
     * @param array     $ROLES
     * @return array    the best roles of all user roles.
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function getAllHeritageByRoles($ROLES)
    {
        if ($this->isUsernamePasswordToken()) {
            if (is_null($ROLES)) {
                return null;
            }
            $results = array();
            // we get the map of all roles.
            $roleMap = $this->buildRoleMap();
            foreach ($ROLES as $key => $role) {
                if (isset($roleMap[$role]))
                    $results = array_unique(array_merge($results, $roleMap[$role]));
            }
        
            return $results;
        } else {
            return null;
        }
    }
    
    /**
     * Sets the map of all roles.
     *
     * @return array    role map
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function buildRoleMap()
    {
        $hierarchy     = $this->getContainer()->getParameter('security.role_hierarchy.roles');
        $map        = array();
        foreach ($hierarchy as $main => $roles) {
            $map[$main] = $roles;
            $visited = array();
            $additionalRoles = $roles;
            while ($role = array_shift($additionalRoles)) {
                if (!isset($hierarchy[$role])) {
                    continue;
                }

                $visited[]          = $role;
                $map[$main]      = array_unique(array_merge($map[$main], $hierarchy[$role]));
                $additionalRoles = array_merge($additionalRoles, array_diff($hierarchy[$role], $visited));
            }
            if (($key = array_search($main, $map[$main])) !== false) {
                unset($map[$main][$key]);
            }
        }
        return $map;
    }
}