<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Eventlistener
 * @package    EventListener
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2011-02-23
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\EventListener;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\ORM\Tools\Event\GenerateSchemaEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;

use PiApp\AdminBundle\EventListener\CoreListener;

/**
 * Custom post load entities listener.
 * The loadClassMetadata event occurs after the mapping metadata for a class has been loaded
 * from a mapping source (annotations/xml/yaml).
 *
 * @category   Admin_Eventlistener
 * @package    EventListener
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class SchemaListener extends CoreListener
{
	/**
	 * Constructs a new instance of SecurityListener.
	 *
	 * @param ContainerInterface        $container
	 */
	public function __construct(ContainerInterface $container)
	{
		parent::__construct($container);
	}
		
	/**
	 * Methos which will be called when the event is thrown.
	 *
	 *
	 * @param \Doctrine\ORM\Event\GenerateSchemaEventArgs $eventArgs
	 *
	 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
	 */	
    public function postGenerateSchema(GenerateSchemaEventArgs $eventArgs)
    {
        $this->_addRoutingTable($eventArgs);
    }
    
}
