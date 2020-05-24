<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form\Action;


interface ActionInterface
{
    public function getName(): string;

    public function getText(): string;
}
