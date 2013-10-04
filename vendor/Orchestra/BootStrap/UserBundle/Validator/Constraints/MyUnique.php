<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BootStrap\UserBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * 
 * // http://symfony.com/fr/doc/2.2/cookbook/validation/custom_constraint.html
 * // http://knpuniversity.com/screencast/question-answer-day/custom-validation-property-path
 * // Symfony\Bundle\FrameworkBundle\DependencyInjection\Compiler\AddConstraintValidatorsPass 
 * 
 * // tags : Tag name validator.constraint_validator not working
 * // Why Symfony2 Validation Constraint is not taken into account ?
 */
class MyUnique extends Constraint
{
    public $message = 'The value for "%property%" already exists.';
    public $property;
    public $groups = array('registration');

    public function validatedBy()
    {
    	return 'bootstrap.user.validator.unique';
    }
    
    /**
     * {@inheritDoc}
     */
    public function getTargets()
    {
    	return self::CLASS_CONSTRAINT;
    }
    
    public function getRequiredOptions()
    {
    	return array('property');
    }
    
    public function getDefaultOption()
    {
    	return 'property';
    }    
        
}
