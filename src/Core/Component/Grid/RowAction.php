<?php

declare(strict_types=1);


namespace Percas\Core\Component\Grid;


class RowAction
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $name;

    /**
     * @param int|null $id
     * @param string $type
     * @param string $name
     */
    public function __construct(?int $id, string $type, string $name)
    {
        $this->id = $id;
        $this->type = $type;
        $this->name = $name;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
