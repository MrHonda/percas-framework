<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form2;


use Percas\Core\Component\Form2\Action\Action;
use Percas\Core\Component\Form2\Field\Field;

class Form
{
    /**
     * @var Field[]
     */
    private $fields;

    /**
     * @var string
     */
    private $action;

    /**
     * @var array
     */
    private $errors;

    /**
     * @var Action[]
     */
    private $actions;

    /**
     * @var mixed
     */
    private $data;

    public function __construct(array $fields, array $actions, string $action, array $errors, $data)
    {
        $this->fields = $fields;
        $this->actions = $actions;
        $this->action = $action;
        $this->errors = $errors;
        $this->data = $data;
    }

    public function handleSubmit()
    {
        if ($this->isSubmitted() && $this->isValid()) {
            $this->handleAction();
        }
    }

    public function isSubmitted(): bool
    {
        return $this->action !== '';
    }

    public function isValid(): bool
    {
        return count($this->errors) === 0;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    public function handleAction()
    {
        foreach ($this->actions as $action) {
            if ($action->getKey() === $this->action) {
                $action->handle($this);
                return;
            }
        }
    }
}
