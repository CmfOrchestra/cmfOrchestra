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

use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;


/**
 * Description of the unique validator
 *
 * <code>
 *  use PiApp\AdminBundle\Validator\Constraints as MyAssert;
 *  /**
 *   * @ORM\ManyToOne(...) 
 *   * @MyAssert\CollectionOf("BootStrap\UserBundle\Entity\User")
 *   *
 *   protected $users;
 * <code>
 * 
 * @category   Admin_Validators
 * @package    Validator
 * 
 * @author (c) <etienne de Longeaux> <etienne.delongeaux@gmail.com>
 */
class CollectionOfValidator extends ConstraintValidator {
	
    public function isValid($value, Constraint $constraint)
    {
        if ($value === null)
            return true;

        if (!is_array($value) && !$value instanceof \Traversable)
            throw new UnexpectedTypeException($value, 'collection');

        if (count($value) === 0)
            return true;

        $type = $constraint->type == 'boolean' ? 'bool' : $constraint->type;
        $function = 'is_' . $type;

        $primitiveTest = function_exists($function);

        foreach ($value as $item) {
            if (
                ($primitiveTest && !call_user_func($function, $item)) ||
                (!$primitiveTest && !$item instanceof $type)
            ) {
                $this->setMessage($constraint->message, array(
                    '{{ value }}' => is_object($item) ? get_class($item) : gettype($item),
                    '{{ type }}'  => $constraint->type
                ));

                return false;
            }
        }

        return true;
    }
}