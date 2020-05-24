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
    protected $dataSourceKey;

    public function __construct(string $key, string $name, string $dataSourceKey = '')
    {
        $this->key = $key;
        $this->name = $name;
        $this->dataSourceKey = $dataSourceKey ?: $key;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDataSourceKey(): string
    {
        return $this->dataSourceKey;
    }
}
