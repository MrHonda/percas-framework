<?php

declare(strict_types=1);


namespace Percas\Core\Component\Grid\DataSource;


interface DataSourceInterface
{
    public function getData(array $keyPairs): array;
}
