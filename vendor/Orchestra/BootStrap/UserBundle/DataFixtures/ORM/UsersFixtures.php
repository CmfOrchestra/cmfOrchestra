<?php
/**
 * This file is part of the <User> project.
 *
 * @category   BootStrap_DataFixtures
 * @package    ORM
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2011-12-28
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\UserBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use BootStrap\UserBundle\Entity\User;

/**
 * Users DataFixtures.
 *
 * @category   BootStrap_DataFixtures
 * @package    ORM
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class UsersFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Load user fixtures
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2011-12-28
     */    
    public function load(ObjectManager $manager)
    {
        $field1 = new User();
        $field1->setUsername('admin');
        $field1->getUsernameCanonical('admin');
        $field1->setPlainPassword('admin');
        $field1->setEmail('admin@hotmail.com');
        $field1->setEmailCanonical('admin@hotmail.com');
        $field1->setEnabled(true);
        $field1->setRoles(array('ROLE_ADMIN'));
        $field1->setPermissions(array('VIEW', 'EDIT', 'CREATE', 'DELETE'));
           $field1->addGroupUser($this->getReference('group-admin'));
           $field1->setLangCode($this->getReference('lang-en'));
        $manager->persist($field1);

        $field2 = new User();
        $field2->setUsername('superadmin');
        $field2->getUsernameCanonical('superadmin');
        $field2->setPlainPassword('superadmin');
        $field2->setEmail('superadmin@gmail.com');
        $field2->setEmailCanonical('superadmin@gmail.com');
        $field2->setEnabled(true);
        $field2->setRoles(array('ROLE_ADMIN', 'ROLE_SUPER_ADMIN'));
        $field2->setPermissions(array('VIEW', 'EDIT', 'CREATE', 'DELETE'));
           $field2->addGroupUser($this->getReference('group-superadmin'));
           $field2->setLangCode($this->getReference('lang-en'));
        $manager->persist($field2);
        
        $field3 = new User();
        $field3->setUsername('user');
        $field3->getUsernameCanonical('user');
        $field3->setPlainPassword('user');
        $field3->setEmail('user@gmail.com');
        $field3->setEmailCanonical('user@gmail.com');
        $field3->setEnabled(true);
        $field3->setRoles(array('ROLE_USER'));
        $field3->setPermissions(array('VIEW', 'EDIT', 'CREATE'));
        $field3->addGroupUser($this->getReference('group-user'));
        $field3->setLangCode($this->getReference('lang-fr'));
        $manager->persist($field3);        

        $manager->flush();
        
        $this->addReference('user-admin', $field1);
        $this->addReference('user-superadmin', $field2);
        $this->addReference('user-user', $field3);
    }
    
    /**
     * Retrieve the order number of current fixture
     *
     * @return integer
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2011-12-28
     */
    public function getOrder()
    {
        // The order in which fixtures will be loaded
        return 2;
    }
}