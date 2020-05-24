<?php

declare(strict_types=1);


namespace Percas\Core\Component\Grid;


use Percas\Core\Component\Grid\Column\ColumnInterface;
use Percas\Core\Component\Grid\Column\TextColumn;
use Percas\Core\Component\Grid\DataSource\DataSourceInterface;
use Percas\Core\Component\Grid\RowAction;
use Percas\Core\Component\Grid\RowAction\RowActionInterface;

class GridBuilder
{
    /**
     * @var DataSourceInterface
     */
    private $dataSource;

    /**
     * @var ColumnInterface[]
     */
    private $columns = [];

    /**
     * @var RowActionInterface[]
     */
    private $rowActions = [];

    /**
     * @var string
     */
    private $primaryKey = 'id';

    public function __construct(DataSourceInterface $dataSource)
    {
        $this->dataSource = $dataSource;
    }

    public function build(): Grid
    {
        $headers = $this->extractHeaders();
        $rows = $this->getRows();

        return new Grid($headers, $rows);
    }

    /**
     * @return Header[]
     */
    private function extractHeaders(): array
    {
        $headers = [];

        foreach ($this->columns as $column) {
            $headers[] = $column->getHeader();
        }

        return $headers;
    }

    /**
     * @return Row[]
     */
    private function getRows(): array
    {
        $rows = [];
        $data = $this->dataSource->getData($this->prepareKeyPairs());

        foreach ($data as $dataRow) {
            $columns = [];

            foreach ($this->columns as $column) {
                $key = $column->getKey();
                $columns[] = new DisplayColumn($key, $column->getDisplayValue($dataRow[$key]));
            }

            $rows[] = new Row((int)$dataRow[$this->primaryKey], $columns, $this->rowActions);
        }

        return $rows;
    }


    private function prepareKeyPairs(): array
    {
        $pairs = [];

        $pairs[] = [
            'key' => $this->primaryKey,
            'alias' => $this->primaryKey
        ];

        foreach ($this->columns as $column) {
            $key = $column->getKey();
            $pairs[] = [
                'key' => $column->getDataSourceKey(),
                'alias' => $key
            ];
        }

        return $pairs;
    }

    public function addColumn(ColumnInterface $column): GridBuilder
    {
        $this->columns[] = $column;
        return $this;
    }

    public function addTextColumn(string $key, string $name, string $dataSourceKey = ''): TextColumn
    {
        $column = new TextColumn($key, $name, $dataSourceKey);
        $this->addColumn($column);
        return $column;
    }

    public function addRowAction(RowActionInterface $action): GridBuilder
    {
        $this->rowActions[] = $action;
        return $this;
    }

    public function addRowEditAction(string $text = 'Edit'): RowAction\Edit
    {
        $action = new RowAction\Edit($text);
        $this->addRowAction($action);
        return $action;
    }

    public function addRowDeleteAction(string $text = 'Delete'): RowAction\Delete
    {
        $action = new RowAction\Delete($text);
        $this->addRowAction($action);
        return $action;
    }
}
