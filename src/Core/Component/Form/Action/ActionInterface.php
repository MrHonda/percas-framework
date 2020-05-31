<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form\Action;


use Percas\Core\Component\Form\Form;

interface ActionInterface
{
    public function getName(): string;

    public function getText(): string;

    public function handle(Form $form): void;
}
