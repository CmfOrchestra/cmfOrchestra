<?php
/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Sonata\AdminBundle\Form\DataTransformer;

use Symfony\Component\Form\Exception\InvalidPropertyException;
use Symfony\Component\Form\Exception\PropertyAccessDeniedException;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\Exception\TransformationFailedException;

use Sonata\AdminBundle\Model\ModelManagerInterface;

/**
 *
 * @author Thomas Rabaix <thomas.rabaix@sonata-project.org>
 */
class ModelToIdTransformer implements DataTransformerInterface
{
    protected $modelManager;

    protected $className;

    public function __construct(ModelManagerInterface $modelManager, $className)
    {
        $this->modelManager = $modelManager;
        $this->className    = $className;
    }

    /**
     * Reverse Transforming the selected id value to an Doctrine Entity.
     *
     * This handles NULL, the EntityManager#find method returns null if no entity was found.
     *
     * @param  int|string $newId
     * @param  object $oldEntity
     * @return object
     */
    public function reverseTransform($newId)
    {
        if (empty($newId)) {
            return null;
        }

        return $this->modelManager->find($this->className, $newId);
    }

    /**
     * @param  object $entity
     * @return int|string
     */
    public function transform($entity)
    {
        if (empty($entity)) {
            return 0;
        }

        return current( $this->modelManager->getIdentifierValues($entity) );
    }
}