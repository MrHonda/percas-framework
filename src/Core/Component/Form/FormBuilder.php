<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form;


use Percas\Core\Component\Form\Button\Button;
use Percas\Core\Component\Form\Button\ButtonInterface;
use Percas\Core\Component\Form\DataMapper\DataMapperInterface;
use Percas\Core\Component\Form\DataMapper\DoctrineDataMapper;
use Percas\Core\Component\Form\Field;
use Percas\Core\Component\Form\RequestReader\DefaultRequestReader;
use Percas\Core\Component\Form\RequestReader\RequestReaderInterface;

class FormBuilder
{
    /**
     * @var object|array|\stdClass
     */
    private $data;

    /**
     * @var Field\FieldInterface[]
     */
    private $fields = [];

    /**
     * @var ButtonInterface[]
     */
    private $buttons = [];

    /**
     * @var DataMapperInterface
     */
    private $dataMapper;

    /**
     * @var RequestReaderInterface
     */
    private $requestReader;

    /**
     * @var object|array|\stdClass $data
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->dataMapper = new DoctrineDataMapper();
        $this->requestReader = new DefaultRequestReader();
    }

    public function build(): Form
    {
        $this->initialize();

        return new Form($this->requestReader->getAction(), $this->data, $this->fields, $this->buttons);
    }

    private function initialize(): void
    {
        $this->requestReader->read();

        $isSubmitted = $this->requestReader->isSubmitted();

        foreach ($this->fields as $field) {
            if ($isSubmitted) {
                $value = $this->requestReader->getValue($field->getKey());
            } else {
                $value = $this->dataMapper->getValue($this->data, $field->getDataKey());
            }
            $field->setValue($value);
        }

        if ($isSubmitted) {
            foreach ($this->fields as $field) {
                $this->dataMapper->setValue($this->data, $field->getDataKey(), $field->getValue());
            }
        }
    }

    /**
     * @param DataMapperInterface $dataMapper
     */
    public function setDataMapper(DataMapperInterface $dataMapper): void
    {
        $this->dataMapper = $dataMapper;
    }

    /**
     * @param RequestReaderInterface $requestReader
     */
    public function setRequestReader(RequestReaderInterface $requestReader): void
    {
        $this->requestReader = $requestReader;
    }

    public function addField(Field\FieldInterface $field): void
    {
        $this->fields[] = $field;
    }

    public function addTextField(string $key, string $name, string $dataKey = ''): Field\Text
    {
        $field = new Field\Text($key, $name, $dataKey);
        $this->addField($field);
        return $field;
    }

    public function addButton(ButtonInterface $button): void
    {
        $this->buttons[] = $button;
    }

    /**
     * @param callable $handler
     * @param string $name
     * @return Button
     */
    public function addSaveButton($handler, string $name = 'Save'): Button
    {
        $button = new Button('save', $name, $handler);
        $this->addButton($button);
        return $button;
    }

    /**
     * @param callable|null $handler
     * @param string $name
     * @return Button
     */
    public function addCancelButton($handler = null, string $name = 'Cancel'): Button
    {
        $button = new Button('cancel', $name, $handler);
        $this->addButton($button);
        return $button;
    }
}
