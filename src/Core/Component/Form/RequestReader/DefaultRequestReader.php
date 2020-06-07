<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form\RequestReader;


class DefaultRequestReader implements RequestReaderInterface
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @var string
     */
    private $action = '';

    public function read(): void
    {
        if (isset($_POST['action']) && $_POST['action'] !== '') {
            $this->action = $_POST['action'];
            $this->data = $_POST['fields'];
        }
    }

    /**
     * @inheritDoc
     */
    public function getValue(string $key)
    {
        return $this->data[$key];
    }

    /**
     * @inheritDoc
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @inheritDoc
     */
    public function isSubmitted(): bool
    {
        return $this->action !== '';
    }
}
