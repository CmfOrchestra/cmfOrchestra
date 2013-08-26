<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Eventlistener
 * @package    EventListener
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2011-01-27
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\EventListener;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;

use PiApp\AdminBundle\EventListener\CoreListener;

/**
 * Custom pre persist entities listener.
 * The preUpdate event occurs before the database update operations to entity data.
 * It is not called for a DQL UPDATE statement.
 *
 * @category   Admin_Eventlistener
 * @package    EventListener
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PreUpdateListener extends CoreListener
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
     * Method which will be called when the event is thrown.
     *
     * @param \Doctrine\ORM\Event\PreUpdateEventArgs $eventArgs
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */    
    public function PreUpdate(PreUpdateEventArgs $eventArgs)
    {
        // Method which will be called when we create the xml content about all layout block information.
        $this->_Layout($eventArgs);
        
        // Method which will be called when we create the historic change of TranslationPage status.
        $this->_TranslationPage($eventArgs); 
        
        // Method which will be called when we link the entity widget type to the page.
        //$this->_widgetListener($eventArgs);
        
        // Method which will be called when we try to update the route name of the home page.
        $this->_NoUpdate_RouteName_HomePage($eventArgs);
        
        // Method which will be called when we check if the url of the page does not already exist.
        $this->_single_SlugByPage($eventArgs);
        
        // Method which will be called when we detach the permission of update a page.
        $this->_Update_Permission_Page_ByUser($eventArgs);
                
        // we set the PreUpdate management
        // BE CAREFUL !!! this method has to be used in the last of your LifecycleEvent management.
        $this->_preUpdate($eventArgs);
    }
    
}