<?php
/**
 * This file is part of the <User> project.
 *
 * @category   BootStrap_DataFixtures
 * @package    ORM
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2011-12-28
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\UserBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use BootStrap\UserBundle\Entity\Permission;

/**
 * Permissions DataFixtures.
 *
 * @category   BootStrap_DataFixtures
 * @package    ORM
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class PermissionsFixtures extends AbstractFixture implements OrderedFixtureInterface
{
	/**
	 * Load user fixtures
	 *
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2011-12-28
	 */	
    public function load(ObjectManager $manager)
    {
        $field1 = new Permission();
        $field1->setName('VIEW');
        $field1->setComment('Utilisateur autorisé à voir l\'objet de domaine.');
        $field1->setEnabled(true);
        $manager->persist($field1);
        
        $field2 = new Permission();
        $field2->setName('EDIT');
        $field2->setComment('Utilisateur autorisé à apporter des changements à l\'objet de domaine.');
        $field2->setEnabled(true);
        $manager->persist($field2);    

        $field3 = new Permission();
        $field3->setName('CREATE');
        $field3->setComment('Utilisateur autorisé à créer l\'objet de domaine.');
        $field3->setEnabled(true);
        $manager->persist($field3);       

        $field4 = new Permission();
        $field4->setName('DELETE');
        $field4->setComment('Utilisateur autorisé à supprimer l\'objet de domaine.');
        $field4->setEnabled(true);
        $manager->persist($field4); 

        $field5 = new Permission();
        $field5->setName('UNDELETE');
        $field5->setComment('Utilisateur autorisé à restaurer un objet de domaine précédemment supprimé.');
        $field5->setEnabled(true);
        $manager->persist($field5);

        $field6 = new Permission();
        $field6->setName('OPERATOR');
        $field6->setComment('Utilisateur autorisé à effectuer toutes les actions possibles sur les objets de domaine.');
        $field6->setEnabled(true);
        $manager->persist($field6);        
        
        $field7 = new Permission();
        $field7->setName('MASTER');
        $field7->setComment('Utilisateur disposant des mêmes permissions qu\'un OPERATOR, étant en plus autorisé à accorder les autorisations des actions à d\'autres.');
        $field7->setEnabled(true);
        $manager->persist($field7);  

        $field8 = new Permission();
        $field8->setName('OWNER');
        $field8->setComment('Utilisateur disposant des mêmes permissions qu\'un MASTER, et possédant le domaine est en plus autorisé à accorder les autorisations de MASTER ET OWNER.');
        $field8->setEnabled(true);
        $manager->persist($field8);   

        $manager->flush();
        
        $this->addReference('permission-view', $field1);
        $this->addReference('permission-edit', $field2);
        $this->addReference('permission-create', $field3);
        $this->addReference('permission-delete', $field4);
        $this->addReference('permission-undelete', $field5);
        $this->addReference('permission-operator', $field6);
        $this->addReference('permission-master', $field7);
        $this->addReference('permission-owner', $field8); 
    }
    
    /**
     * Retrieve the order number of current fixture
     *
     * @return integer
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2011-12-28
     */
    public function getOrder()
    {
    	// The order in which fixtures will be loaded
    	return 1;
    }
}