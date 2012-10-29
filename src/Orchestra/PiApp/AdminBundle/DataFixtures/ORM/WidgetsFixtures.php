<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_DataFixtures
 * @package    ORM
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-01-23
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use PiApp\AdminBundle\Entity\Widget;

/**
 * Widget DataFixtures.
 *
 * @category   Admin_DataFixtures
 * @package    ORM
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class WidgetsFixtures extends AbstractFixture implements OrderedFixtureInterface
{
	/**
	 * Load language fixtures
	 *
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 * @since 2012-01-23
	 */
    public function load(ObjectManager $manager)
    {
        $field1 = new Widget();
        $field1->setPlugin('content');
        $field1->setAction('-');
        $field1->setConfigCssClass('error');
        $field1->setCacheable(true);
        $field1->setLifetime("86400");
        $field1->setPublic(true);
        $field1->setEnabled(true);
        $manager->persist($field1);

        $manager->flush();
        
        $this->addReference('widget-error', $field1);
    }
    
    /**
     * Retrieve the order number of current fixture
     *
     * @return integer 
     * 
     * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
     * @since 2012-01-23
     */
    public function getOrder()
    {
    	// The order in which fixtures will be loaded
    	return 3;
    }    
}