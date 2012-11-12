<?php
// src/Bootstrap/UserBundle/UserBundle/Form/Handler/RegistrationFormHandler.php
namespace Bootstrap\UserBundle\Form\Handler;

use FOS\UserBundle\Form\Handler\RegistrationFormHandler as BaseHandler;
use FOS\UserBundle\Model\UserInterface;

class RegistrationFormHandler extends BaseHandler
{
    protected function onSuccess(UserInterface $user, $confirmation)
    {
        if ($confirmation) {
        	$user->setEnabled(false);
        	$this->mailer->sendConfirmationEmailMessage($user);
        } else {
        	$user->setConfirmationToken(null);
        	$user->setEnabled(true);
        }
        $user->setRoles(array('ROLE_ADMIN'));
        $user->setPermissions(array('VIEW', 'EDIT', 'CREATE', 'DELETE'));

        $this->userManager->updateUser($user, true);
    }   
}