<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form1\Field;


class Text extends AbstractField
{
    /**
     * @var string
     */
    private $value;

    public function getType(): string
    {
        return 'text';
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->value = (string)$value;
    }
}
