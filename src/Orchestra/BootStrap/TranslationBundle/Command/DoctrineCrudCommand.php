<?php
/**
 * This file is part of the <Translation> project.
 *
 * @category   BootStrap_Command
 * @package    Command
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
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
 * 		php app/console orchestra:generate:crud
 * </code>
 * 
 * @category   BootStrap_Command
 * @package    Command
 *
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class DoctrineCrudCommand extends BaseGenerator
{
    protected function configure()
    {
        parent::configure();
        $this->setName('orchestra:generate:crud');
    }

    protected function getGenerator()
    {
        $generator_crud = new DoctrineCrudGenerator($this->getContainer()->get('filesystem'), __DIR__.'/../Resources/views/skeleton/crud');
        $this->setGenerator($generator_crud);
        
        $generator_form = new DoctrineFormGenerator($this->getContainer()->get('filesystem'), __DIR__.'/../Resources/views/skeleton/form');
        $this->setFormGenerator($generator_form);
        
        return parent::getGenerator();
    }
}