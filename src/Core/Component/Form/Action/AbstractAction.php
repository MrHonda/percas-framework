<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form\Action;


abstract class AbstractAction implements ActionInterface
{
    /**
     * @var string
     */
    protected $text;

    /**
     * AbstractAction constructor.
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }
}
