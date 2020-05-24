<?php

declare(strict_types=1);


namespace Percas\Core\Component\Grid;


class Header
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $name;

    public function __construct(string $key, string $name)
    {
        $this->key = $key;
        $this->name = $name;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
