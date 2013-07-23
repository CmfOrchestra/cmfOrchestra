<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Twig
 * @package    Extension
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-11
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\GedmoBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;
use PiApp\AdminBundle\Exception\ExtensionException;

/**
 * Tool Filters and Functions used in twig
 *
 * @category   Admin_Twig
 * @package    Extension
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class PiToolExtension extends \Twig_Extension
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;
    
    /**
     * Constructor.
     *
     * @param ContainerInterface $container The service container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
        
    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function getName() {
        return 'gedmo_tool_extension';
    }
        
    /**
     * Returns a list of functions to add to the existing list.
     * 
     * <code>
     * </code>
     * 
     * @return array An array of functions
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function getFunctions() {
        return array(
                'getProfilByUser'        => new \Twig_Function_Method($this, 'getProfilByUserFunction'),
        );
    }
    
    
    /**
     * Functions
     */
        
    public function getProfilByUserFunction($idUser) {
        $locale         = $this->container->get('request')->getLocale();
            
        $Individual  = $this->container->get('doctrine')->getManager()->getRepository("PiAppGedmoBundle:Individual")->findOneByUser($idUser, $locale);
        $Corporation = $this->container->get('doctrine')->getManager()->getRepository("PiAppGedmoBundle:Corporation")->findOneByUser($idUser, $locale);
        
        if (!is_null($Individual))
            return $Individual;
        elseif (!is_null($Corporation))
            return $Corporation;
        else 
            return null; 
    }

}