<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form1\Action;


use Percas\Core\Component\Form1\Form;

abstract class AbstractAction implements ActionInterface
{
    /**
     * @var string
     */
    protected $text;

    /**
     * @var HandlerInterface
     */
    protected $handler;

    /**
     * AbstractAction constructor.
     * @param string $text
     * @param HandlerInterface $handler
     */
    public function __construct(string $text, HandlerInterface $handler)
    {
        $this->text = $text;
        $this->handler = $handler;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    public function handle(Form $form): void
    {
        $this->handler->handle($form);
    }
}
