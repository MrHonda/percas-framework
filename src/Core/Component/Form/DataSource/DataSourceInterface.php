<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form\DataSource;


interface DataSourceInterface
{
    public function getData(string $primaryKeyName, int $primaryKeyValue): array;
}
