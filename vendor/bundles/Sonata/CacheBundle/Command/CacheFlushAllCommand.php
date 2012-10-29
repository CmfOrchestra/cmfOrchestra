<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\CacheBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Output\Output;

class CacheFlushAllCommand extends BaseCacheCommand
{
    public function configure()
    {
        $this->setName('sonata:cache:flush-all');
        $this->setDescription('Flush all information set in cache managers');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>clearing cache information</info>');

        foreach ($this->getManager()->getCacheServices() as $name => $cache) {
            $output->write(sprintf(' > %s : starting .... ', $name));
            if ($cache->flushAll() === true) {
                $output->writeln("<info>OK</info>");
            } else {
                $output->writeln("<error>FAILED!</error>");
            }
        }

        $output->writeln('<info>done!</info>');
    }
}