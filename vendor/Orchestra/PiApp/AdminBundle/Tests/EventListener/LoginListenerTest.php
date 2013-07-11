<?php

namespace PiApp\AdminBundle\Tests\EventListener;

use PiApp\AdminBundle\EventListener\LoginListener;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginListenerTest extends WebTestCase
{
    public function testSubscribedEvents()
    {
        $loginEvent = new LoginListener();
        $this->assertEquals(array('onSecurityInteractiveLogin'), $loginEvent->getSubscribedEvents());
    }

    public function testOnSecurityInteractiveLogin()
    {
        $loginListener = new LoginListenerStub();

        $event = $this->getMockBuilder('Symfony\Component\Security\Http\Event\InteractiveLoginEvent')
            ->disableOriginalConstructor()
            ->getMock();

        $session = $this->getMockBuilder('Symfony\Component\HttpFoundation\Session')
            ->disableOriginalConstructor()
            ->getMock();

        $session->expects($this->once())
            ->method('setFlash')
            ->with(
                $this->equalTo('notice'),
                $this->equalTo('Welcome MyUser, you have successfully logged in.')
            );

        $loginListener->setUsername('MyUser');
        $loginListener->setSession($session);

        $loginListener->onSecurityInteractiveLogin($event);
    }

}

class LoginListenerStub extends LoginListener
{
    protected $username = null;
    protected $session = null;

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setSession($session)
    {
        $this->session = $session;
    }

    public function getSession()
    {
        return $this->session;
    }
}