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
use BootStrap\UserBundle\Entity\Role;

/**
 * Roles DataFixtures.
 *
 * @category   BootStrap_DataFixtures
 * @package    ORM
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class RolesFixtures extends AbstractFixture implements OrderedFixtureInterface
{
	/**
	 * Load user fixtures
	 *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2011-12-28
	 */	
    public function load(ObjectManager $manager)
    {
    	$field0 = new Role();
    	$field0->setLabel('Default');
    	$field0->setName('ROLE_ALLOWED_TO_SWITCH');
    	$field0->setComment('Utilisateur disposant du droit par default');
    	$field0->setEnabled(true);
    	$manager->persist($field0);
    	
    	$field1 = new Role();
    	$field1->setLabel('Subscriber');
    	$field1->setName('ROLE_SUBSCRIBER');
    	$field1->setComment('Utilisateur enregistré sur le site.');
    	$field1->setEnabled(true);
    	$field1->setHeritage(array('ROLE_ALLOWED_TO_SWITCH'));
    	$manager->persist($field1);

    	$field2 = new Role();
    	$field2->setLabel('Member');
    	$field2->setName('ROLE_MEMBER');
    	$field2->setComment('Utilisateur enregistré sur le site et identifié comme membre.');
    	$field2->setEnabled(true);
    	$field2->setHeritage(array('ROLE_SUBSCRIBER', 'ROLE_ALLOWED_TO_SWITCH'));
    	$manager->persist($field2);    	
    	    	
        $field3 = new Role();
        $field3->setLabel('User');
        $field3->setName('ROLE_USER');
        $field3->setComment('Utilisateur disposant d\'un accès à un espace.');
        $field3->setEnabled(true);
        $field3->setHeritage(array('ROLE_ALLOWED_TO_SWITCH'));
        $manager->persist($field3);  

        $field4 = new Role();
        $field4->setLabel('Editor');
        $field4->setName('ROLE_EDITOR');
        $field4->setComment('Utilisateur ayant un accès restreint du backoffice, et pouvant ecrire, modifier des pages sans les publier.');
        $field4->setEnabled(true);
        $field4->setHeritage(array('ROLE_MEMBER', 'ROLE_USER', 'ROLE_ALLOWED_TO_SWITCH'));
        $manager->persist($field4); 

        $field5 = new Role();
        $field5->setLabel('Moderator');
        $field5->setName('ROLE_MODERATOR');
        $field5->setComment('Utilisateur disposant des mêmes droits qu\'un redacteur, et capable en plus de publier une page et de la supprimer.');
        $field5->setEnabled(true);
        $field5->setHeritage(array('ROLE_EDITOR', 'ROLE_ALLOWED_TO_SWITCH'));
        $manager->persist($field5);

        $field6 = new Role();
        $field6->setLabel('Designer');
        $field6->setName('ROLE_DESIGNER');
        $field6->setComment('Utilisateur ayant un accès restreint du backoffice, et capable de modifier seulement le code des block des pages, des css et layout.');
        $field6->setEnabled(true);
        $field6->setHeritage(array('ROLE_MEMBER', 'ROLE_USER', 'ROLE_ALLOWED_TO_SWITCH'));
        $manager->persist($field6);        
        
        $field7 = new Role();
        $field7->setLabel('Content manager');
        $field7->setName('ROLE_CONTENT_MANAGER');
        $field7->setComment('Utilisateur disposant des mêmes droits qu\'un designer et un modérateur mais ayant un accès total des services CMS du backoffice.');
        $field7->setEnabled(true);
        $field7->setHeritage(array('ROLE_DESIGNER', 'ROLE_MODERATOR', 'ROLE_ALLOWED_TO_SWITCH'));
        $manager->persist($field7);  

        $field8 = new Role();
        $field8->setLabel('Administrator');
        $field8->setName('ROLE_ADMIN');
        $field8->setComment('Utilisateur ayant un accès total du backoffice sans l\'accès à l\'admin SONATA.');
        $field8->setEnabled(true);
        $field8->setHeritage(array('ROLE_CONTENT_MANAGER', 'ROLE_ALLOWED_TO_SWITCH'));
        $manager->persist($field8);   

        $field9 = new Role();
        $field9->setLabel('Sonata');
        $field9->setName('SONATA');
        $field9->setComment('Utilisateur ayant un accès à SONATA.');
        $field9->setEnabled(true);
        $field9->setHeritage(array('ROLE_SONATA_PAGE_ADMIN_PAGE_EDIT ', 'ROLE_SONATA_PAGE_ADMIN_BLOCK_EDIT', 'ROLE_ALLOWED_TO_SWITCH'));
        $manager->persist($field9);        
        
        $field10 = new Role();
        $field10->setLabel('Super administrator');
        $field10->setName('ROLE_SUPER_ADMIN');
        $field10->setComment('Utilisateur ayant un accès total du backoffice avec l\'accès à l\'admin SONATA.');
        $field10->setEnabled(true);
        $field10->setHeritage(array('ROLE_ADMIN', 'ROLE_ALLOWED_TO_SWITCH', 'ROLE_SONATA_ADMIN', 'SONATA'));
        $manager->persist($field10);        


        $manager->flush();
        
        $this->addReference('role-default', $field0);
        $this->addReference('role-subscriber', $field1);
        $this->addReference('role-member', $field2);
        $this->addReference('role-user', $field3);
        $this->addReference('role-editor', $field4);
        $this->addReference('role-moderator', $field5);
        $this->addReference('role-designer', $field6);
        $this->addReference('role-manager', $field7);
        $this->addReference('role-admin', $field8);
        $this->addReference('role-sonata', $field9);
        $this->addReference('role-superadmin', $field10);
        
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
    	return 1;
    }
}