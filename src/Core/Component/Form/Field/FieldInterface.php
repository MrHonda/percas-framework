<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form\Field;


interface FieldInterface
{
    public function getKey(): string;

    public function getName(): string;

    public function getDataKey(): string;

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @return string|int|float
     */
    public function getDisplayValue();

    /**
     * @param mixed $value
     */
    public function setValue($value): void;
}
