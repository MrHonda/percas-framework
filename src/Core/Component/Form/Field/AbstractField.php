<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form\Field;


abstract class AbstractField implements FieldInterface
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $dataKey;

    /**
     * AbstractField constructor.
     * @param string $key
     * @param string $name
     * @param string $dataKey
     */
    public function __construct(string $key, string $name, string $dataKey = '')
    {
        $this->key = $key;
        $this->name = $name;
        $this->dataKey = $dataKey !== '' ? $dataKey : $key;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDataKey(): string
    {
        return $this->dataKey;
    }
}
