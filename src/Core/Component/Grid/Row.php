<?php

declare(strict_types=1);


namespace Percas\Core\Component\Grid;


use Percas\Core\Component\Grid\RowAction\RowActionInterface;

class Row
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var DisplayColumn[]
     */
    private $columns;

    /**
     * @var RowActionInterface[]
     */
    private $actions;

    /**
     * @param int $id
     * @param DisplayColumn[] $columns
     * @param array $actions
     */
    public function __construct(int $id, array $columns, array $actions)
    {
        $this->id = $id;
        $this->columns = $columns;
        $this->actions = $actions;
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return DisplayColumn[]
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    /**
     * @return RowActionInterface[]
     */
    public function getActions(): array
    {
        return $this->actions;
    }
}
