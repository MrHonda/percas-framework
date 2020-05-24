<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form\DataReader;


interface DataReaderInterface
{
    /**
     * @return mixed
     */
    public function read();

    public function hasData(): bool;

    public function getAction(): string;
}
