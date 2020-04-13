<?php

declare(strict_types=1);


namespace Percas\Core\Component\Grid\Action;


interface ActionInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getKey(): string;

    /**
     * @return string
     */
    public function getType(): string;
}
