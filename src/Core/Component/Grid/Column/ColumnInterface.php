<?php

declare(strict_types=1);


namespace Percas\Core\Component\Grid\Column;


use Percas\Core\Component\Grid\Header;

interface ColumnInterface
{
    public function getKey(): string;

    public function getDataSourceKey(): string;

    public function getHeader(): Header;

    /**
     * @param mixed $value
     * @return mixed
     */
    public function getDisplayValue($value);
}
