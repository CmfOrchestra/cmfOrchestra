<?php
/**
 * This file is part of the <Translation> project.
 *
 * @category   BootStrap_Command
 * @package    Command
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-03-08
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BootStrap\TranslationBundle\Command;

use Sensio\Bundle\GeneratorBundle\Generator\DoctrineCrudGenerator;
use Sensio\Bundle\GeneratorBundle\Generator\DoctrineFormGenerator;
use Sensio\Bundle\GeneratorBundle\Command\GenerateDoctrineCrudCommand as BaseGenerator;

/**
 * Command CRUD.
 *
 * <code>
 *         php app/console orchestra:generate:crud
 * </code>
 * 
 * @category   BootStrap_Command
 * @package    Command
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class DoctrineCrudCommand extends BaseGenerator
{
    /**
     * @var \PiApp\AdminBundle\Util\PiLogManager
     */
    private $_logger;
    
    /**
     * Constructor.
     *
     * @param    $kernel    HttpKernelInterface A HttpKernelInterface instance
     * @access    public
     * @author    Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function __construct($kernel = null)
    {
        parent::__construct();
    
        //-----we initialize the container-----
        if (is_object($kernel) && method_exists($kernel, 'getContainer'))
            $this->setContainer($kernel->getContainer());
    }

    /**
     * configure the command.
     *
     * @return void
     * @access protected
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */    
    protected function configure()
    {
        parent::configure();
        $this->setName('orchestra:generate:crud');
    }

    protected function getGenerator($bundle = null)
    {
        $generator_crud = new DoctrineCrudGenerator($this->getContainer()->get('filesystem'), __DIR__.'/../Resources/views/skeleton/crud');
        $this->setGenerator($generator_crud);
        
        $generator_form = new DoctrineFormGenerator($this->getContainer()->get('filesystem'), __DIR__.'/../Resources/views/skeleton/form');
        $this->setFormGenerator($generator_form);
        
        return parent::getGenerator();
    }
}