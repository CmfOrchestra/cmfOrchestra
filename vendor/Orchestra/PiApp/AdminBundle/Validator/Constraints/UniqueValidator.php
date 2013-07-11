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

use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of the unique validator
 *
 * <code>
 *  use PiApp\AdminBundle\Validator\Constraints as MyAssert;
 *  /**
 *   * @MyAssert\Unique(entity="AdminBundle:TranslationPage", property="slug")
 *   *
 *   protected $slug;
 * <code>
 * 
 * @category   Admin_Validators
 * @package    Validator
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class UniqueValidator extends ConstraintValidator
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
    	// if the config autorize that the page slug is not unique.
    	$is_unique_slug = $this->container->getParameter('pi_app_admin.page.single_slug');
    	if (!$is_unique_slug)
    		return true;
    	
        // try to get one entity that matches the constraint
        $entity = $this->container->get('pi_app_admin.repository')->getRepository($constraint->entity)
                ->findBy(array($constraint->property => $value));
        
        // if there is already an entity
        if ( ($entity != null) && !empty($value) && (count($entity)>=2) ){
            // the constraint does not pass
            $this->setMessage($constraint->message);
            return false;
        }
        // the constraint passes
        return true;
    }
}