<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form1\DataSource;


use Percas\Core\Component\Form1\Field\FieldInterface;

interface DataSourceInterface
{
    public function getData(string $primaryKeyName, int $primaryKeyValue): array;

    /**
     * @param FieldInterface[] $fields
     * @param int $primaryKeyValue
     */
    public function update(array $fields, int $primaryKeyValue): void;
}
