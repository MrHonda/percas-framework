<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form;


use Percas\Core\Component\Form\Button\ButtonInterface;
use Percas\Core\Component\Form\Field\FieldInterface;

class Form
{
    /**
     * @var string
     */
    private $action;

    /**
     * @var object|array|\stdClass
     */
    private $data;

    /**
     * @var FieldInterface[]
     */
    private $fields;

    /**
     * @var ButtonInterface[]
     */
    private $buttons;

    /**
     * Form constructor.
     * @param string $action
     * @param array|object|\stdClass $data
     * @param FieldInterface[] $fields
     * @param ButtonInterface[] $buttons
     */
    public function __construct(string $action, $data, array $fields, array $buttons)
    {
        $this->action = $action;
        $this->data = $data;
        $this->fields = $fields;
        $this->buttons = $buttons;
    }

    public function isSubmitted(): bool
    {
        return $this->action !== '';
    }

    public function handleSubmit(): void
    {
        if (!$this->isSubmitted()) {
            return;
        }

        foreach ($this->buttons as $button) {
            if ($button->getKey() === $this->action) {
                $button->handle($this);
                break;
            }
        }
    }

    /**
     * @return array|object|\stdClass
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return FieldInterface[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @return ButtonInterface[]
     */
    public function getButtons(): array
    {
        return $this->buttons;
    }
}
