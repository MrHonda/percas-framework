<?php

declare(strict_types=1);


namespace Percas\Core\Component\Grid\DataSource;

interface DataSourceInterface
{
    /**
     * @param array $keyPairs
     * @return array
     */
    public function getData(array $keyPairs): array;
}
