<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form2;


use Percas\Core\Component\Form2\Action\Action;
use Percas\Core\Component\Form2\Field\Field;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ValidatorBuilder;

class FormBuilder
{
    /**
     * @var Field[]
     */
    private $fields = [];

    /**
     * @var mixed
     */
    private $data;

    /**
     * @var string
     */
    private $action = '';

    /**
     * @var array
     */
    private $errors = [];

    /**
     * @var Action[]
     */
    private $actions = [];

    /**
     * FormBuilder constructor.
     * @param mixed $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function addField(Field $field)
    {
        $this->fields[] = $field;
    }

    public function addAction(Action $action)
    {
        $this->actions[] = $action;
    }

    public function build(): Form
    {
        $this->handleRequest();

        return new Form($this->fields, $this->actions, $this->action, $this->errors, $this->data);
    }

    private function handleRequest()
    {
        if (isset($_POST['action']) && $_POST['action'] !== '') {
            $this->action = $_POST['action'];
        }

        $isSubmitted = $this->action !== '';
        $validator = (new ValidatorBuilder())->getValidator();

        foreach ($this->fields as $field) {
            $key = $field->getKey();
            $value = $isSubmitted ? $_POST['fields'][$key] : $this->getDataValue($key);
            $field->setValue($value);

            if ($isSubmitted) {
                $errors = $validator->validate($value, $field->getConstraints());
                /** @var ConstraintViolationInterface $error */
                foreach ($errors as $error) {
                    $this->errors[$key][] = $error->getMessage();
                }
            }
        }

        if ($isSubmitted && count($this->errors) === 0) {
            foreach ($this->fields as $field) {
                $this->setDataValue($field->getKey(), $field->getValue());
            }
        }
    }

    private function getDataValue(string $key): string
    {
        $method = 'get' . ucfirst($key);
        return $this->data->$method();
    }

    private function setDataValue(string $key, string $value)
    {
        $method = 'set' . ucfirst($key);
        $this->data->$method($value);
    }
}
