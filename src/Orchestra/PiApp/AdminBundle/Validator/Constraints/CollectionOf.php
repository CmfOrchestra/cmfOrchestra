<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Validators
 * @package    Validator
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 * @since 2012-01-24
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class CollectionOf extends Constraint {
    public $message = 'This value should be a collection of type {{ type }}';
    public $type;
    
    /**
     * {@inheritDoc}
     */
    public function getTargets()
    {
    	return self::PROPERTY_CONSTRAINT;
    }    

    public function getDefaultOption() {
        return 'type';
    }

    public function getRequiredOptions() {
        return array('type');
    }
}