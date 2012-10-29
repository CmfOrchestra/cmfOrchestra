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
use PiApp\AdminBundle\Entity\TranslationPage;
use PiApp\AdminBundle\Repository\TranslationPageRepository;

/**
 * Translation Pages DataFixtures.
 *
 * @category   Admin_DataFixtures
 * @package    ORM
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class TranslationPagesFixtures extends AbstractFixture implements OrderedFixtureInterface
{
	/**
	 * Load language fixtures
	 *
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 * @since 2012-01-23
	 */
    public function load(ObjectManager $manager)
    {
        $field1 = new TranslationPage();
        $field1->setSlug('');
        $field1->setLangCode($this->getReference('lang-fr'));
        $field1->setStatus(TranslationPageRepository::STATUS_PUBLISH);
        $field1->setLangStatus(TranslationPageRepository::LANG_REFERENCE);
        $field1->setPage($this->getReference('page-homepage'));
        $field1->setEnabled(true);
        $field1->setPublishedAt(new \DateTime());
        $manager->persist($field1);
        
        $field2 = new TranslationPage();
        $field2->setSlug('');
        $field2->setLangCode($this->getReference('lang-en'));
        $field2->setStatus(TranslationPageRepository::STATUS_PUBLISH);
        $field2->setLangStatus(TranslationPageRepository::LANG_TRADUCTION);
        $field2->setPage($this->getReference('page-homepage'));
        $field2->setEnabled(true);
        $field2->setPublishedAt(new \DateTime());
        $manager->persist($field2);        

        $field3 = new TranslationPage();
        $field3->setSlug('error404-fr');
        $field3->setLangCode($this->getReference('lang-fr'));
        $field3->setStatus(TranslationPageRepository::STATUS_PUBLISH);
        $field3->setLangStatus(TranslationPageRepository::LANG_REFERENCE);
        $field3->setPage($this->getReference('page-error'));
        $field3->setEnabled(true);
        $field3->setPublishedAt(new \DateTime());
        $manager->persist($field3);
        
        $field4 = new TranslationPage();
        $field4->setSlug('error404-en');
        $field4->setLangCode($this->getReference('lang-en'));
        $field4->setStatus(TranslationPageRepository::STATUS_PUBLISH);
        $field4->setLangStatus(TranslationPageRepository::LANG_TRADUCTION);
        $field4->setPage($this->getReference('page-error'));
        $field4->setEnabled(true);
        $field4->setPublishedAt(new \DateTime());
        $manager->persist($field4);        

        $manager->flush();
        
        $this->addReference('transpage-homepage-fr', $field1);
        $this->addReference('transpage-homepage-en', $field2);
        $this->addReference('transpage-error-fr-404', $field3);
        $this->addReference('transpage-error-en-404', $field4);
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