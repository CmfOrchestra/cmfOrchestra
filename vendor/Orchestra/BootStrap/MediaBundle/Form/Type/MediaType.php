<?php

/*
 * This file is part of the Sonata project.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BootStrap\MediaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Sonata\MediaBundle\Provider\Pool;
use Sonata\MediaBundle\Form\DataTransformer\ProviderDataTransformer;

class MediaType extends AbstractType
{
    protected $pool;

    protected $class;

    /**
     * @param Pool   $pool
     * @param string $class
     */
    public function __construct(Pool $pool)
    {
        $this->pool  = $pool;
        $this->class = "BootStrap\MediaBundle\Entity\Media";
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->setAttribute('label', $options['label'])
        ->setAttribute('attr', $options['attr'])
        ->setAttribute('label_attr', $options['label_attr'])        
        ->addModelTransformer(new ProviderDataTransformer($this->pool, array(
            'provider' => $options['provider'],
            'context'  => $options['context'],
        )));

        $this->pool->getProvider($options['provider'])->buildMediaType($builder);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
            'provider'   => null,
            'context'    => null
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'form';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'orchestra_media_type';
    }
}
