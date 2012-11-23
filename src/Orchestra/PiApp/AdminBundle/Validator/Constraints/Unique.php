<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Validators
 * @package    Validator
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
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
class Unique extends Constraint
{
    public $message = 'This value is already used';
    public $entity;
    public $property;
    
    public function validatedBy()
    {
        return 'pi_app_admin.validator.unique';
    }
    
    /**
     * {@inheritDoc}
     */
    public function getTargets()
    {
        return self::PROPERTY_CONSTRAINT;
    }
    
    public function requiredOptions()
    {
    	return array('entity', 'property');
    }
   
}