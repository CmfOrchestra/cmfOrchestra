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
use PiApp\AdminBundle\Entity\TranslationWidget;

/**
 * Translation Pages DataFixtures.
 *
 * @category   Admin_DataFixtures
 * @package    ORM
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class TranslationWidgetsFixtures extends AbstractFixture implements OrderedFixtureInterface
{
	/**
	 * Load language fixtures
	 *
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 * @since 2012-01-23
	 */
    public function load(ObjectManager $manager)
    {
        $field3 = new TranslationWidget();
        $field3->setLangCode($this->getReference('lang-fr'));
        $field3->setWidget($this->getReference('widget-error'));
        $field3->setContent("Le widget n'existe pas !");
        $field3->setEnabled(true);
        $manager->persist($field3);
        
        $field4 = new TranslationWidget();
        $field4->setLangCode($this->getReference('lang-en'));
        $field4->setWidget($this->getReference('widget-error'));
        $field3->setContent("The widget doesn't exist !");
        $field4->setEnabled(true);
        $manager->persist($field4);        

        $manager->flush();
        
        $this->addReference('transwidget-error-fr-404', $field3);
        $this->addReference('transwidget-error-en-404', $field4);
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
    	return 4;
    }    
}