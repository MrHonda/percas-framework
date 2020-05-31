<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form;


use Percas\Core\Component\Form\Action\ActionInterface;
use Percas\Core\Component\Form\DataSource\DataSourceInterface;
use Percas\Core\Component\Form\Field\FieldInterface;

class Form
{
    /**
     * @var DataSourceInterface
     */
    private $dataSource;

    /**
     * @var int
     */
    private $primaryKeyValue;

    /**
     * @var FieldInterface[]
     */
    private $fields;

    /**
     * @var ActionInterface[]
     */
    private $actions;

    /**
     * @var string
     */
    private $action;

    /**
     * Form constructor.
     * @param DataSourceInterface $dataSource
     * @param int $primaryKeyValue
     * @param FieldInterface[] $fields
     * @param ActionInterface[] $actions
     * @param string $action
     */
    public function __construct(DataSourceInterface $dataSource, int $primaryKeyValue, array $fields, array $actions, string $action)
    {
        $this->dataSource = $dataSource;
        $this->primaryKeyValue = $primaryKeyValue;
        $this->fields = $fields;
        $this->actions = $actions;
        $this->action = $action;

        $this->handleSubmit();
    }

    private function handleSubmit(): void
    {
        if ($this->isSubmitted()) {
            foreach ($this->actions as $action) {
                if ($this->action === $action->getName()) {
                    $action->handle($this);
                    break;
                }
            }
        }
    }

    public function isSubmitted(): bool
    {
        return $this->action !== '';
    }

    public function save(): void
    {
        $this->dataSource->update($this->fields, $this->primaryKeyValue);
    }

    /**
     * @return int
     */
    public function getPrimaryKeyValue(): int
    {
        return $this->primaryKeyValue;
    }

    /**
     * @return DataSourceInterface
     */
    public function getDataSource(): DataSourceInterface
    {
        return $this->dataSource;
    }

    /**
     * @return FieldInterface[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @return ActionInterface[]
     */
    public function getActions(): array
    {
        return $this->actions;
    }
}
