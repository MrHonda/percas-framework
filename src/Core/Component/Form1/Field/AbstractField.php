<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form1\Field;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints as Assert;

abstract class AbstractField implements FieldInterface
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
     * @var string
     */
    protected $dataSourceKey;

    /**
     * @var Constraint[]
     */
    protected $baseConstraints = [];

    /**
     * @var Constraint[]
     */
    protected $constraints = [];

    public function __construct(string $key, string $name, string $dataSourceKey = '')
    {
        $this->key = $key;
        $this->name = $name;
        $this->dataSourceKey = $dataSourceKey ?: $key;
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
    public function getDataSourceKey(): string
    {
        return $this->dataSourceKey;
    }

    public function addConstraint(Constraint $constraint): void
    {
        $this->constraints[] = $constraint;
    }

    /**
     * @inheritDoc
     */
    public function getConstraints(): array
    {
        return array_merge($this->baseConstraints, $this->constraints);
    }

    public function required(): void
    {
        $this->addConstraint(new Assert\NotBlank());
    }
}
