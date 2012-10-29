<?php
/*
 * This file is part of the Sonata project.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\CacheBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Sonata\CacheBundle\DependencyInjection\Compiler\CacheCompilerPass;

class SonataCacheBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new CacheCompilerPass());
    }

    public function boot()
    {
        $options = $this->container->getParameter('twig.options');

        if (!isset($options['base_template_class'])) {
            return;
        }

        if (method_exists($options['base_template_class'], 'attachRecorder')) {
            call_user_func(array($options['base_template_class'], 'attachRecorder'), $this->container->get('sonata.cache.recorder'));
        }
    }
}
