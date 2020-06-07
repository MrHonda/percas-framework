<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form2\Action;


use Percas\Core\Component\Form2\Form;

class Action
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $name;

    /**
     * @var callable
     */
    private $handler;

    /**
     * Action constructor.
     * @param string $key
     * @param string $name
     * @param callable $handler
     */
    public function __construct(string $key, string $name, callable $handler)
    {
        $this->key = $key;
        $this->name = $name;
        $this->handler = $handler;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function handle(Form $form)
    {
        call_user_func($this->handler, $form);
    }
}
