<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_DataFixtures
 * @package    ORM
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2011-12-28
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use PiApp\AdminBundle\Entity\KeyWord;

/**
 * KeyWords DataFixtures.
 *
 * @category   Admin_DataFixtures
 * @package    ORM
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class KeyWordsFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Load language fixtures
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2011-12-28
     */
    public function load(ObjectManager $manager)
    {
        $field1 = new KeyWord();
        $field1->setGroupname('Group Rubrique');
        $field1->setName('visible');
        $field1->setEnabled(true);
        $manager->persist($field1);

        $field2 = new KeyWord();
        $field2->setGroupname('Groupe Page');
        $field2->setName('visible');
        $field2->setEnabled(true);
        $manager->persist($field2);
        
        $field3 = new KeyWord();
        $field3->setGroupname('Group Rubrique');
        $field3->setName('invisible');
        $field3->setEnabled(true);
        $manager->persist($field3);
        
        $field4 = new KeyWord();
        $field4->setGroupname('Groupe Page');
        $field4->setName('invisible');
        $field4->setEnabled(true);
        $manager->persist($field4);        
        
        $manager->flush();
        
        $this->addReference('KeyWord-1', $field1);
        $this->addReference('KeyWord-2', $field2);
        $this->addReference('KeyWord-3', $field3);
        $this->addReference('KeyWord-4', $field4);
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