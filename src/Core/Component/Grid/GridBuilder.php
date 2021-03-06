<?php

declare(strict_types=1);


namespace Percas\Core\Component\Grid;

use Percas\Core\Component\Grid\Action\ActionInterface;
use Percas\Core\Component\Grid\Action\EditAction;
use Percas\Core\Component\Grid\Column\ColumnInterface;
use Percas\Core\Component\Grid\Column\IdColumn;
use Percas\Core\Component\Grid\Column\TextColumn;
use Percas\Core\Component\Grid\DataSource\DataSourceInterface;

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
     * @var ActionInterface[]
     */
    private $gridActions = [];

    /**
     * @var ActionInterface[]
     */
    private $rowActions = [];

    /**
     * GridBuilder constructor.
     * @param DataSourceInterface $dataSource
     */
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
            $actions = [];

            foreach ($this->columns as $column) {
                $key = $column->getKey();
                $columns[] = new DisplayColumn($key, $column->getDisplayValue($dataRow[$key]));
            }

            foreach ($this->rowActions as $rowAction) {
                $actions[] = new RowAction((int)$dataRow[$rowAction->getKey()], $rowAction->getType(), $rowAction->getName());
            }

            $rows[] = new Row($columns, $actions);
        }

        return $rows;
    }

    /**
     * @return string[][]
     */
    private function prepareKeyPairs(): array
    {
        $keys = [];
        $pairs = [];

        foreach ($this->columns as $column) {
            $key = $column->getKey();

            if (!$key) {
                continue;
            }

            if (!in_array($key, $keys, true)) {
                $pairs[] = [
                    'key' => $column->getDataSourceKey(),
                    'alias' => $key
                ];
            }
        }

        return $pairs;
    }

    /**
     * @param DataSourceInterface $dataSource
     * @return GridBuilder
     */
    public function setDataSource(DataSourceInterface $dataSource): GridBuilder
    {
        $this->dataSource = $dataSource;
        return $this;
    }

    /**
     * @param ColumnInterface $column
     * @return GridBuilder
     */
    public function addColumn(ColumnInterface $column): GridBuilder
    {
        $this->columns[] = $column;
        return $this;
    }

    /**
     * @param string $key
     * @param string $name
     * @param string $dataSourceKey
     * @return IdColumn
     */
    public function addIdColumn(string $key = 'id', string $name = 'Id', string $dataSourceKey = ''): IdColumn
    {
        $column = new IdColumn($key, $name, $dataSourceKey);
        $this->addColumn($column);
        return $column;
    }

    /**
     * @param string $key
     * @param string $name
     * @param string $dataSourceKey
     * @return TextColumn
     */
    public function addTextColumn(string $key, string $name, string $dataSourceKey = ''): TextColumn
    {
        $column = new TextColumn($key, $name, $dataSourceKey);
        $this->addColumn($column);
        return $column;
    }

    /**
     * @param ActionInterface $action
     * @return GridBuilder
     */
    public function addGridAction(ActionInterface $action): GridBuilder
    {
        $this->gridActions[] = $action;
        return $this;
    }

    /**
     * @param ActionInterface $action
     * @return GridBuilder
     */
    public function addRowAction(ActionInterface $action): GridBuilder
    {
        $this->rowActions[] = $action;
        return $this;
    }

    /**
     * @param string $name
     * @param string $key
     * @return EditAction
     */
    public function addEditRowAction(string $name = 'edit', string $key = 'id'): EditAction
    {
        $action = new EditAction($name, $key);
        $this->addRowAction($action);
        return $action;
    }
}
