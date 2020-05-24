<?php

declare(strict_types=1);


namespace Percas\Core\Component\Grid\Column;


use Percas\Core\Component\Grid\Header;

abstract class AbstractColumn implements ColumnInterface
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $dataSourceKey;

    /**
     * @var Header
     */
    protected $header;

    public function __construct(string $key, string $name, string $dataSourceKey)
    {
        $this->key = $key;
        $this->dataSourceKey = $dataSourceKey ?: $key;
        $this->header = new Header($key, $name);
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getDataSourceKey(): string
    {
        return $this->dataSourceKey;
    }

    public function getHeader(): Header
    {
        return $this->header;
    }

    /**
     * @inheritDoc
     */
    public function getDisplayValue($value)
    {
        return $value;
    }
}
