<?php

declare(strict_types=1);


namespace Percas\Core\Component\Grid\RowAction;


class Delete extends AbstractRowAction
{
    public function getKey(): string
    {
        return 'delete';
    }
}
