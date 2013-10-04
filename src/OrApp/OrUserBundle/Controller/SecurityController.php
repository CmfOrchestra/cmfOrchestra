<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OrApp\OrUserBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use BootStrap\UserBundle\Controller\SecurityController as baseSecurityController;

class SecurityController extends baseSecurityController
{
    /**
     * @Route("/login_check2", name="_front_security_check_2")
     */
    public function checkAction()
    {
        //throw new \RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
    }   

    /**
     * @Route("/logout2", name="_front_security_logout_2")
     */
    public function logoutAction()
    {
        //throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    } 
}