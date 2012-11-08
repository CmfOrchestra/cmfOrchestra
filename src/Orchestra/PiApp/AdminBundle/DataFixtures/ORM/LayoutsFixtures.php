<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_DataFixtures
 * @package    ORM
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2011-12-28
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use PiApp\AdminBundle\Entity\Layout;

/**
 * Layout DataFixtures.
 *
 * @category   Admin_DataFixtures
 * @package    ORM
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class LayoutsFixtures extends AbstractFixture implements OrderedFixtureInterface
{
	/**
	 * Load language fixtures
	 *
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 * @since 2011-12-28
	 */
    public function load(ObjectManager $manager)
    {
        $field1 = new Layout();
        $field1->setName('pi-admin');
        $field1->setFilePc('layout-pi-admin.html.twig');
        $field1->setFileMobile('Default');
        $field1->setConfigXml('<?xml version="1.0"?><config></config>');
        $field1->setEnabled(true);
        $manager->persist($field1);

        $field4 = new Layout();
        $field4->setName('pi-orchestra');
        $field4->setFilePc('layout-pi-orchestra.html.twig');
        $field4->setFileMobile('Default');
        $field4->setConfigXml('<?xml version="1.0"?><config></config>');
        $field4->setEnabled(true);
        $manager->persist($field4);    

        $field5 = new Layout();
        $field5->setName('pi-error');
        $field5->setFilePc('layout-pi-error.html.twig');
        $field5->setFileMobile('Default');
        $field5->setConfigXml('<?xml version="1.0"?><config></config>');
        $field5->setEnabled(true);
        $manager->persist($field5);        
        
        
        
        $field6 = new Layout();
        $field6->setName('pi-model-head-two-columns-fixed-foot');
        $field6->setFilePc("models\layout-pi-model-head-two-columns-fixed-foot.html.twig");
        $field6->setFileMobile('Default');
        $field6->setConfigXml('<?xml version="1.0"?>
<config>
	<blocks>
		<name>pc_header</name>
		<name>pc_menuwrapper</name>
		<name>content</name>
		<name>pc_footer</name>
		<name>mobile_novHeader</name>
		<name>mobile_content</name>
		<name>mobile_novFooter</name>
	</blocks>
</config>');
        $field6->setEnabled(true);
        $manager->persist($field6);
        
        $field7 = new Layout();
        $field7->setName('pi-model-left-menu-fluid-column');
        $field7->setFilePc("models\layout-pi-model-left-menu-fluid-column.html.twig");
        $field7->setFileMobile('Default');
        $field7->setConfigXml('<?xml version="1.0"?>
<config>
	<blocks>
		<name>pc_header</name>
		<name>pc_menuwrapper</name>
		<name>content</name>
		<name>pc_footer</name>
		<name>mobile_novHeader</name>
		<name>mobile_content</name>
		<name>mobile_novFooter</name>
	</blocks>
</config>');
        $field7->setEnabled(true);
        $manager->persist($field7);   

        $field8 = new Layout();
        $field8->setName('pi-model-one-column-fixed-central');
        $field8->setFilePc("models\layout-pi-model-one-column-fixed-central.html.twig");
        $field8->setFileMobile('Default');
        $field8->setConfigXml('<?xml version="1.0"?>
<config>
	<blocks>
		<name>pc_header</name>
		<name>pc_menuwrapper</name>
		<name>content</name>
		<name>pc_footer</name>
		<name>mobile_novHeader</name>
		<name>mobile_content</name>
		<name>mobile_novFooter</name>
	</blocks>
</config>');
        $field8->setEnabled(true);
        $manager->persist($field8);      

        $field9 = new Layout();
        $field9->setName('pi-model-one-column-fixed-left');
        $field9->setFilePc("models\layout-pi-model-one-column-fixed-left.html.twig");
        $field9->setFileMobile('Default');
        $field9->setConfigXml('<?xml version="1.0"?>
<config>
	<blocks>
		<name>pc_header</name>
		<name>pc_menuwrapper</name>
		<name>content</name>
		<name>pc_footer</name>
		<name>mobile_novHeader</name>
		<name>mobile_content</name>
		<name>mobile_novFooter</name>
	</blocks>
</config>');
        $field9->setEnabled(true);
        $manager->persist($field9);  

        $field10 = new Layout();
        $field10->setName('pi-model-one-column');
        $field10->setFilePc("models\layout-pi-model-one-column.html.twig");
        $field10->setFileMobile('Default');
        $field10->setConfigXml('<?xml version="1.0"?>
<config>
	<blocks>
		<name>pc_header</name>
		<name>pc_menuwrapper</name>
		<name>content</name>
		<name>pc_footer</name>
		<name>mobile_novHeader</name>
		<name>mobile_content</name>
		<name>mobile_novFooter</name>
	</blocks>
</config>');
        $field10->setEnabled(true);
        $manager->persist($field10);  

        $field11 = new Layout();
        $field11->setName('pi-model-three-columns-main-fluid');
        $field11->setFilePc("models\layout-pi-model-three-columns-main-fluid.html.twig");
        $field11->setFileMobile('Default');
        $field11->setConfigXml('<?xml version="1.0"?>
<config>
	<blocks>
		<name>pc_header</name>
		<name>pc_menuwrapper</name>
		<name>content_secondaire</name>
		<name>content</name>
		<name>pc_footer</name>
		<name>mobile_novHeader</name>
		<name>mobile_content</name>
		<name>mobile_novFooter</name>
	</blocks>
</config>');
        $field11->setEnabled(true);
        $manager->persist($field11);       

        $field12 = new Layout();
        $field12->setName('pi-model-three-fixed-columns');
        $field12->setFilePc("models\layout-pi-model-three-fixed-columns.html.twig");
        $field12->setFileMobile('Default');
        $field12->setConfigXml('<?xml version="1.0"?>
<config>
	<blocks>
		<name>pc_header</name>
		<name>pc_menuwrapper</name>
		<name>content</name>
		<name>content_secondaire</name>
		<name>pc_footer</name>
		<name>mobile_novHeader</name>
		<name>mobile_content</name>
		<name>mobile_novFooter</name>
	</blocks>
</config>');
        $field12->setEnabled(true);
        $manager->persist($field12);      

        $field13 = new Layout();
        $field13->setName('pi-model-three-fluid-columns');
        $field13->setFilePc("models\layout-pi-model-three-fluid-columns.html.twig");
        $field13->setFileMobile('Default');
        $field13->setConfigXml('<?xml version="1.0"?>
<config>
	<blocks>
		<name>pc_header</name>
		<name>pc_menuwrapper</name>
		<name>content</name>
        <name>content_secondaire</name>
		<name>pc_footer</name>
		<name>mobile_novHeader</name>
		<name>mobile_content</name>
		<name>mobile_novFooter</name>
	</blocks>
</config>');
        $field13->setEnabled(true);
        $manager->persist($field13);    

        $field14 = new Layout();
        $field14->setName('pi-model-two-columns-fixed-horiz-menu');
        $field14->setFilePc("models\layout-pi-model-two-columns-fixed-horiz-menu.html.twig");
        $field14->setFileMobile('Default');
        $field14->setConfigXml('<?xml version="1.0"?>
<config>
	<blocks>
		<name>pc_header</name>
		<name>pc_menuwrapper</name>
		<name>content</name>
		<name>pc_footer</name>
		<name>mobile_novHeader</name>
		<name>mobile_content</name>
		<name>mobile_novFooter</name>
	</blocks>
</config>');
        $field14->setEnabled(true);
        $manager->persist($field14);   

        $field15 = new Layout();
        $field15->setName('pi-model-two-fluid-columns');
        $field15->setFilePc("models\layout-pi-model-two-fluid-columns.html.twig");
        $field15->setFileMobile('Default');
        $field15->setConfigXml('<?xml version="1.0"?>
<config>
	<blocks>
		<name>pc_header</name>
		<name>pc_menuwrapper</name>
		<name>content</name>
		<name>mobile_novHeader</name>
		<name>mobile_content</name>
		<name>mobile_novFooter</name>
	</blocks>
</config>');
        $field15->setEnabled(true);
        $manager->persist($field15);     

        $field16 = new Layout();
        $field16->setName('pi-model-two-fluid-intelligent-columns');
        $field16->setFilePc("models\layout-pi-model-two-fluid-intelligent-columns.html.twig");
        $field16->setFileMobile('Default');
        $field16->setConfigXml('<?xml version="1.0"?>
<config>
	<blocks>
		<name>pc_header</name>
		<name>pc_menuwrapper</name>
		<name>content</name>
		<name>pc_footer</name>
		<name>mobile_novHeader</name>
		<name>mobile_content</name>
		<name>mobile_novFooter</name>
	</blocks>
</config>');
        $field16->setEnabled(true);
        $manager->persist($field16);        

        
        $manager->flush();
        
        $this->addReference('layout-pi-admin', $field1);
        $this->addReference('layout-pi-orchestra', $field4);
        $this->addReference('layout-pi-error', $field5);
        
        $this->addReference('layout-pi-model-head-two-columns-fixed-foot', $field6);
        $this->addReference('layout-pi-model-left-menu-fluid-column', $field7);
        $this->addReference('layout-pi-model-one-column-fixed-central', $field8);
        $this->addReference('layout-pi-model-one-column-fixed-left', $field9);
        $this->addReference('layout-pi-model-one-column', $field10);
        $this->addReference('layout-pi-model-three-columns-main-fluid', $field11);
        $this->addReference('layout-pi-model-three-fixed-columns', $field12);
        $this->addReference('layout-pi-model-three-fluid-columns', $field13);
        $this->addReference('layout-pi-model-two-columns-fixed-horiz-menu', $field14);
        $this->addReference('layout-pi-model-two-fluid-columns', $field15);
        $this->addReference('layout-pi-model-two-fluid-intelligent-columns', $field16);
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
    	return 2;
    }    
}