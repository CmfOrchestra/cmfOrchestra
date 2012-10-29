<?php
/**
 * This file is part of the <Admin> project.
 * 
 * @category   Admin_Form
 * @package    Form
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2011-11-17
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\AdminBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Sonata\AdminBundle\Admin\Pool;
use BootStrap\UserBundle\Repository\PermissionRepository;

/**
 * Security Permissions
 *
 * @category   Admin_Form
 * @package    Form
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class SecurityPermissionsType extends ChoiceType
{
    protected $pool;

    public function __construct(Pool $pool)
    {
        $this->pool = $pool;
    }

    public function getDefaultOptions(array $options)
    {
        $options = parent::getDefaultOptions($options);

        $permissions = array();
        if (count($options['choices']) == 0) {
        	
        	//$query = $this->pool->getContainer()->get('bootstrap.user.repository')->findAllEnabled('permission');
        	$query = $this->pool->getContainer()->get('bootstrap.user.repository')->getRepository('permission')->getAvailablePermissions();

            foreach ($query as $field => $value) {
               if (isset($value['name']) && !isset($permission[ $value['name'] ])) {
                   $permissions[ $value['name'] ] = $value['name'];
               }
            }
        	
            $options['choices'] = $permissions;
        }
        return $options;
    }
    
}