<?php

declare(strict_types=1);


namespace Percas\Core\Component\Grid\Column;


use Percas\Core\Component\Grid\Header;

interface ColumnInterface
{
    /**
     * @return string
     */
    public function getKey(): string;

    /**
     * @return string
     */
    public function getDataSourceKey(): string;

    /**
     * @return Header
     */
    public function getHeader(): Header;

    /**
     * @param mixed $value
     * @return string
     */
    public function getDisplayValue($value): string;
}
