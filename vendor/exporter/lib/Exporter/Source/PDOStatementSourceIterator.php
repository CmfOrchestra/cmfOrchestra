<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Exporter\Source;

use Exporter\Exception\InvalidMethodCallException;

class PDOStatementSourceIterator implements SourceIteratorInterface
{
    protected $statement;

    protected $current;

    protected $position;

    protected $rewinded;

    /**
     * @param array $data
     */
    public function __construct(\PDOStatement $statement)
    {
        $this->statement = $statement;
        $this->position = 0;
        $this->rewinded = false;
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        return $this->current;
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        $this->current = $this->statement->fetch(\PDO::FETCH_ASSOC);
        $this->position++;
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * {@inheritdoc}
     */
    public function valid()
    {
        return is_array($this->current);
    }

    /**
     * {@inheritdoc}
     */
    public function rewind()
    {
        if ($this->rewinded) {
           throw new InvalidMethodCallException('Cannot rewind a PDOStatement');
        }

        $this->current = $this->statement->fetch(\PDO::FETCH_ASSOC);
        $this->rewinded = true;
    }
}