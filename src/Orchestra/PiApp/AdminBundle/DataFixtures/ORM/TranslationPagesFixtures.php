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

        $field6 = new TranslationPage();
        $field6->setSlug('');
        $field6->setLangCode($this->getReference('lang-ar'));
        $field6->setStatus(TranslationPageRepository::STATUS_PUBLISH);
        $field6->setLangStatus(TranslationPageRepository::LANG_TRADUCTION);
        $field6->setPage($this->getReference('page-homepage'));
        $field6->setEnabled(true);
        $field6->setPublishedAt(new \DateTime());
        $manager->persist($field6);        

        $field3 = new TranslationPage();
        $field3->setSlug('error-fr');
        $field3->setLangCode($this->getReference('lang-fr'));
        $field3->setStatus(TranslationPageRepository::STATUS_PUBLISH);
        $field3->setLangStatus(TranslationPageRepository::LANG_REFERENCE);
        $field3->setPage($this->getReference('page-error'));
        $field3->setEnabled(true);
        $field3->setPublishedAt(new \DateTime());
        $manager->persist($field3);
        
        $field4 = new TranslationPage();
        $field4->setSlug('error-en');
        $field4->setLangCode($this->getReference('lang-en'));
        $field4->setStatus(TranslationPageRepository::STATUS_PUBLISH);
        $field4->setLangStatus(TranslationPageRepository::LANG_TRADUCTION);
        $field4->setPage($this->getReference('page-error'));
        $field4->setEnabled(true);
        $field4->setPublishedAt(new \DateTime());
        $manager->persist($field4);     

        $field5 = new TranslationPage();
        $field5->setSlug('error-ar');
        $field5->setLangCode($this->getReference('lang-ar'));
        $field5->setStatus(TranslationPageRepository::STATUS_PUBLISH);
        $field5->setLangStatus(TranslationPageRepository::LANG_TRADUCTION);
        $field5->setPage($this->getReference('page-error'));
        $field5->setEnabled(true);
        $field5->setPublishedAt(new \DateTime());
        $manager->persist($field5);        

        $manager->flush();
        
        $this->addReference('transpage-homepage-fr', $field1);
        $this->addReference('transpage-homepage-en', $field2);
        $this->addReference('transpage-homepage-ar', $field6);
        $this->addReference('transpage-error-fr-404', $field3);
        $this->addReference('transpage-error-en-404', $field4);
        $this->addReference('transpage-error-ar-404', $field5);
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