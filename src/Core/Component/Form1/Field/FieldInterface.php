<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form1\Field;


use Symfony\Component\Validator\Constraint;

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

    /**
     * @return Constraint[]
     */
    public function getConstraints(): array;

    public function addConstraint(Constraint $constraint): void;

    public function required(): void;
}
