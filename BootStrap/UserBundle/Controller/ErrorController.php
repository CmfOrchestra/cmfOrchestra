<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   BootStrap_Controllers
 * @package    Controller
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-24
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * Frontend controller.
 *
 * @category   BootStrap_Controllers
 * @package    Controller
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class ErrorController extends BaseController
{
    /**
     * @Secure(roles="IS_AUTHENTICATED_ANONYMOUSLY")
     * @Template()
     */
    public function unauthorizedAction()
    {
        $requiredRoles = $this->container->getParameter('security.role_hierarchy.roles');
        
        return array('requiredRoles' => $requiredRoles);
    }    
}