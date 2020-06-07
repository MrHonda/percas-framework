<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form2\Field;


use Symfony\Component\Validator\Constraint;

class Field
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
     * @var string
     */
    private $value;

    /**
     * @var array
     */
    private $constraints = [];

    /**
     * Field constructor.
     * @param string $key
     * @param string $name
     */
    public function __construct(string $key, string $name)
    {
        $this->key = $key;
        $this->name = $name;
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

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    /**
     * @return array
     */
    public function getConstraints(): array
    {
        return $this->constraints;
    }

    public function addConstraint(Constraint $constraint): void
    {
        $this->constraints[] = $constraint;
    }
}
