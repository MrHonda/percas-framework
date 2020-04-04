<?php

declare(strict_types=1);


namespace Percas\Core\Layout;

interface LayoutInterface
{
    /**
     * @return string
     */
    public function getPath(): string;
}
