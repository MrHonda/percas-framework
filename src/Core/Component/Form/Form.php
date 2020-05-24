<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form;


use Percas\Core\Component\Form\Action\ActionInterface;
use Percas\Core\Component\Form\Field\FieldInterface;

class Form
{
    /**
     * @var FieldInterface[]
     */
    private $fields;

    /**
     * @var ActionInterface[]
     */
    private $actions;

    /**
     * @var string
     */
    private $action;

    /**
     * Form constructor.
     * @param FieldInterface[] $fields
     * @param ActionInterface[] $actions
     * @param string $action
     */
    public function __construct(array $fields, array $actions, string $action)
    {
        $this->fields = $fields;
        $this->actions = $actions;
        $this->action = $action;
    }

    /**
     * @return FieldInterface[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @return ActionInterface[]
     */
    public function getActions(): array
    {
        return $this->actions;
    }
}
