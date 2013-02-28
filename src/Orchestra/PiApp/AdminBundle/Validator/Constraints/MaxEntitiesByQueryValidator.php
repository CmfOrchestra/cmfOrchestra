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

use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of the unique validator
 *
 * <code>
 *  /**
 *   * @MyAssert\Partnerhighlighted(field="highlighted2", max="12", message="pi.partner.form.field.highlighted2.max")
 *   *
 *   protected $highlighted2;
 * <code>
 * 
 * @category   Admin_Validators
 * @package    Validator
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class MaxEntitiesByQueryValidator extends ConstraintValidator
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
    
    public function isValid($value, Constraint $constraint) 
    {
    	$em 		= $this->container->get('doctrine')->getEntityManager();
    	
        // try to get one entity that matches the constraint
        $entities	= $em->getRepository($constraint->entity)->findBy(json_decode(str_replace("'",'"',$constraint->field), true));
        $max		= $constraint->max;
        
        // if there is already an entity
        if( ($entities != null) && !empty($value) && (count($entities) > $max) ){
            // the constraint does not pass
            $this->setMessage($this->container->get('translator')->trans($constraint->message));
            return false;
        }
        // the constraint passes
        return true;
    }
}