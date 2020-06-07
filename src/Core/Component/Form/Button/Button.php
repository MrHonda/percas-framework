<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form\Button;


use Percas\Core\Component\Form\Form;

class Button implements ButtonInterface
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var callable|null
     */
    protected $handler;

    /**
     * @param string $key
     * @param string $name
     * @param callable|null $handler
     */
    public function __construct(string $key, string $name, ?callable $handler)
    {
        $this->key = $key;
        $this->name = $name;
        $this->handler = $handler;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function handle(Form $form): void
    {
        if ($this->handler) {
            call_user_func($this->handler, $form);
        }
    }
}
