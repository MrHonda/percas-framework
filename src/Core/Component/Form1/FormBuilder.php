<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form1;


use Percas\Core\Component\Form1\Action\ActionInterface;
use Percas\Core\Component\Form1\Action;
use Percas\Core\Component\Form1\DataReader\DataReaderInterface;
use Percas\Core\Component\Form1\DataReader\PostDataReader;
use Percas\Core\Component\Form1\DataSource\DataSourceInterface;
use Percas\Core\Component\Form1\Field;
use Percas\Core\Component\Form1\Field\FieldInterface;

class FormBuilder
{
    /**
     * @var DataSourceInterface
     */
    private $dataSource;

    /**
     * @var DataReaderInterface
     */
    private $dataReader;

    /**
     * @var string
     */
    private $primaryKeyName = 'id';

    /**
     * @var int
     */
    private $primaryKeyValue;

    /**
     * @var FieldInterface[]
     */
    private $fields = [];

    /**
     * @var ActionInterface[]
     */
    private $actions = [];

    /**
     * @var array
     */
    private $data = [];

    /**
     * FormBuilder constructor.
     * @param DataSourceInterface $dataSource
     * @param int $primaryKeyValue
     */
    public function __construct(DataSourceInterface $dataSource, int $primaryKeyValue)
    {
        $this->dataSource = $dataSource;
        $this->dataReader = new PostDataReader();
        $this->primaryKeyValue = $primaryKeyValue;
    }

    public function build(): Form
    {
        $this->readData();
        $this->prepareFields();

        return new Form($this->dataSource, $this->primaryKeyValue, $this->fields, $this->actions, $this->dataReader->getAction());
    }

    private function readData(): void
    {
        if ($this->dataReader->hasData()) {
            $this->data = [];
            $data = $this->dataReader->read();

            foreach ($this->fields as $field) {
                $this->data[$field->getDataSourceKey()] = $data[$field->getKey()];
            }

        } else if ($this->primaryKeyValue > 0) {
            $this->data = $this->dataSource->getData($this->primaryKeyName, $this->primaryKeyValue);
        }
    }

    private function prepareFields(): void
    {
        foreach ($this->fields as $field) {
            $field->setValue($this->data[$field->getDataSourceKey()]);
        }
    }

    public function addField(FieldInterface $field): FormBuilder
    {
        $this->fields[] = $field;
        return $this;
    }

    public function addTextField(string $key, string $name, string $dataSourceKey = ''): Field\Text
    {
        $field = new Field\Text($key, $name, $dataSourceKey);
        $this->addField($field);
        return $field;
    }

    public function addAction(ActionInterface $action): FormBuilder
    {
        $this->actions[] = $action;
        return $this;
    }

    public function addSaveAction(string $text = 'Save'): Action\Save
    {
        $action = new Action\Save($text, new Action\SaveHandler());
        $this->addAction($action);
        return $action;
    }

    public function addCloseAction(string $text = 'Close'): Action\Close
    {
        $action = new Action\Close($text, new Action\CloseHandler());
        $this->addAction($action);
        return $action;
    }
}