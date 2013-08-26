<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Validators
 * @package    Validator
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2013-02-21
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class MaxEntitiesByQuery extends Constraint
{
    public $field;
    public $max;
    public $message;
    public $entity;
    
    public function validatedBy()
    {
        return 'pi_app_admin.validator.partner';
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
        return array('entity', 'field', 'max', 'message');
    }
   
}