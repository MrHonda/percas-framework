<?php

declare(strict_types=1);


namespace Percas\Core\Component\Grid\RowAction;


abstract class AbstractRowAction implements RowActionInterface
{
    /**
     * @var string
     */
    protected $text;

    /**
     * AbstractRowAction constructor.
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function getText(): string
    {
        return $this->text;
    }
}
