<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form;


use Percas\Core\Component\Form\Action\ActionInterface;
use Percas\Core\Component\Form\Action;
use Percas\Core\Component\Form\DataReader\DataReaderInterface;
use Percas\Core\Component\Form\DataReader\PostDataReader;
use Percas\Core\Component\Form\DataSource\DataSourceInterface;
use Percas\Core\Component\Form\Field;
use Percas\Core\Component\Form\Field\FieldInterface;

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

        return new Form($this->fields, $this->actions, $this->dataReader->getAction());
    }

    private function readData(): void
    {
        if ($this->dataReader->hasData()) {
            $this->data = $this->dataReader->read();
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
        $action = new Action\Save($text);
        $this->addAction($action);
        return $action;
    }

    public function addCloseAction(string $text = 'Close'): Action\Close
    {
        $action = new Action\Close($text);
        $this->addAction($action);
        return $action;
    }
}
