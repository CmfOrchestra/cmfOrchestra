<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BootStrap\TranslatorBundle\Manager\Loader;

use BootStrap\TranslatorBundle\Model\MessageCatalogue;

/**
 * Loader Interface for the bundle.
 *
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
interface LoaderInterface
{
    /**
     * Loads a MessageCatalogue from the file.
     *
     * The difference to Symfony's interface is that any loader is
     * expected to return the MessageCatalogue from the bundle which
     * contains more translation information.
     *
     * @param mixed  $resource A resource
     * @param string $locale   A locale
     * @param string $domain   The domain
     *
     * @return MessageCatalogue A MessageCatalogue instance
     */
    function load($resource, $locale, $domain = 'messages');
}