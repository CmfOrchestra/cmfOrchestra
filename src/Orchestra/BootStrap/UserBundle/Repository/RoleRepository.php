<?php
/**
 * This file is part of the <User> project.
 *
 * @category   BootStrap_Repositories
 * @package    Repository
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-02
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\UserBundle\Repository;

use Doctrine\ORM\EntityRepository;
use BootStrap\TranslationBundle\Repository\TranslationRepository;

/**
 * Role Repository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 * 
 * @category   BootStrap_Repositories
 * @package    Repository
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class RoleRepository extends TranslationRepository
{
	const ROLE_DEFAULT 		= 'ROLE_VISITOR';
	const ROLE_SUPER_ADMIN 	= 'ROLE_SUPER_ADMIN';
	
	/**
	 * Return the default role value
	 *
	 * @return array
	 * @static
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2011-12-28
	 */
	public static function ShowDefaultRole()
	{
		return self::ROLE_DEFAULT;
	}	
	
	/**
	 * Return the super admin role value
	 *
	 * @return array
	 * @static
	 * 
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2011-12-28
	 */
	public static function ShowSuperAdminRole()
	{
		return self::ROLE_SUPER_ADMIN;
	}

	/**
	 * Gets all roles with heritages.
	 *
	 * @return array
	 * @access public
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2012-03-16
	 */
	public function getAllHeritageRoles()
	{
		$query = $this->createQueryBuilder('r')
		->select('r.name, r.heritage')
		->where('r.enabled = :enabled')
		->setParameters(array(
				'enabled'	=> 1,
		));
		//return $query->getQuery()->setMaxResults(1)->getArrayResult();
	
		$result = array();
		$data	= $query->getQuery()->getArrayResult();
		if ($data && is_array($data) && count($data)) {
			foreach ($data as $row) {
				if(!empty($row['name']))
					$result[ $row['name'] ] = unserialize( $row['heritage'] );
			}
		}
		return $result;
				
	}	
}