<?php

declare(strict_types=1);


namespace Percas\Core\Component\Grid\RowAction;


interface RowActionInterface
{
    public function getKey(): string;

    public function getText(): string;
}
