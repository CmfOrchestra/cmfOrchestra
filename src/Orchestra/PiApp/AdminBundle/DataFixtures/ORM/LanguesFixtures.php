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
use PiApp\AdminBundle\Entity\Langue;

/**
 * Langues DataFixtures.
 *
 * @category   Admin_DataFixtures
 * @package    ORM
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class LanguesFixtures extends AbstractFixture implements OrderedFixtureInterface
{
	/**
	 * Load language fixtures
	 *
	 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
	 * @since 2011-12-28
	 */
    public function load(ObjectManager $manager)
    {
        $field1 = new Langue();
        $field1->setId('en_GB');
        $field1->setTranslatableLocale('fr_FR');
        $field1->setLabel('Anglais');
        $field1->translate('fr_FR')->setLabel('Anglais');
        $field1->translate('en_GB')->setLabel('English');
        $field1->translate('ar_SA')->setLabel('الإنجليزية');
        $field1->setEnabled(true);
        $manager->persist($field1);

        $field2 = new Langue();
        $field2->setId('fr_FR');
        $field2->setTranslatableLocale('fr_FR');
        $field2->setLabel('Français');
        $field2->translate('fr_FR')->setLabel('Français');
        $field2->translate('en_GB')->setLabel('French');
        $field2->translate('ar_SA')->setLabel('الفرنسية');
        $field2->setEnabled(true);
        $manager->persist($field2);
        
        $field3 = new Langue();
        $field3->setId('ar_SA');
        $field3->setTranslatableLocale('fr_FR');
        $field3->setLabel('Arabe');
        $field3->translate('fr_FR')->setLabel('Arabe');
        $field3->translate('en_GB')->setLabel('Arabic');
        $field3->translate('ar_SA')->setLabel('العربية');
        $field3->setEnabled(true);
        $manager->persist($field3);        

        $manager->flush();
        
        $this->addReference('lang-en', $field1);
        $this->addReference('lang-fr', $field2);
        $this->addReference('lang-ar', $field3);
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