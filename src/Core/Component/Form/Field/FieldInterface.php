<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form\Field;


interface FieldInterface
{
    public function getType(): string;

    public function getKey(): string;

    public function getName(): string;

    public function getDataSourceKey(): string;

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @param mixed $value
     */
    public function setValue($value);
}
