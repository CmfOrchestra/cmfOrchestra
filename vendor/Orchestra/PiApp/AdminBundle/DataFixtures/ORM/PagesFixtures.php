<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_DataFixtures
 * @package    ORM
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-23
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use PiApp\AdminBundle\Entity\Page;
use PiApp\AdminBundle\Repository\PageRepository;

/**
 * Page DataFixtures.
 *
 * @category   Admin_DataFixtures
 * @package    ORM
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PagesFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Load language fixtures
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-01-23
     */
    public function load(ObjectManager $manager)
    {
        $field1 = new Page();
        $field1->setRouteName('home_page');
        $field1->setUrl('');
        $field1->setLayout($this->getReference('layout-pi-orchestra'));
        $field1->setUser($this->getReference('user-admin'));
        $field1->setMetaContentType(PageRepository::TYPE_TEXT_HTML);
        $field1->setCacheable(false);
        $field1->setLifetime("86400");
        $field1->setPublic(false);
        $field1->setEnabled(true);
        $manager->persist($field1);

        $field2 = new Page();
        $field2->setRouteName('error_404');
        $field2->setUrl('error');
        $field2->setLayout($this->getReference('layout-pi-error'));
        $field2->setUser($this->getReference('user-admin'));
        $field2->setMetaContentType(PageRepository::TYPE_TEXT_HTML);
        $field2->setCacheable(false);
        $field2->setLifetime("86400");
        $field2->setPublic(false);
        $field2->setEnabled(true);
        $manager->persist($field2);

        $field3 = new Page();
        $field3->setRouteName('page_route_name_reset');
        $field3->setUrl('reset');
        $field3->setLayout($this->getReference('layout-pi-orchestra'));
        $field3->setUser($this->getReference('user-admin'));
        $field3->setMetaContentType(PageRepository::TYPE_TEXT_HTML);
        $field3->setCacheable(false);
        $field3->setLifetime("86400");
        $field3->setPublic(false);
        $field3->setEnabled(true);
        $manager->persist($field3);        
        
        $manager->flush();
        
        $this->addReference('page-homepage', $field1);
        $this->addReference('page-error', $field2);
        $this->addReference('page-reset', $field3);
    }
    
    /**
     * Retrieve the order number of current fixture
     *
     * @return integer 
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-01-23
     */
    public function getOrder()
    {
        // The order in which fixtures will be loaded
        return 3;
    }    
}