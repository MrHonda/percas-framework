<?php

declare(strict_types=1);


namespace Percas\Core\Component\Grid\Action;


abstract class AbstractAction implements ActionInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $key;

    /**
     * AbstractAction constructor.
     * @param string $name
     * @param string $key
     */
    public function __construct(string $name, string $key)
    {
        $this->name = $name;
        $this->key = $key;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function getKey(): string
    {
        return $this->key;
    }
}
