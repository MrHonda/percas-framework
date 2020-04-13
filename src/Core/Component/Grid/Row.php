<?php

declare(strict_types=1);


namespace Percas\Core\Component\Grid;


class Row
{
    /**
     * @var DisplayColumn[]
     */
    private $columns = [];

    /**
     * @var RowAction[]
     */
    private $actions = [];

    /**
     * @param DisplayColumn[] $columns
     * @param array $actions
     */
    public function __construct(array $columns, array $actions)
    {
        $this->columns = $columns;
        $this->actions = $actions;
    }

    /**
     * @return DisplayColumn[]
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    /**
     * @return RowAction[]
     */
    public function getActions(): array
    {
        return $this->actions;
    }
}
