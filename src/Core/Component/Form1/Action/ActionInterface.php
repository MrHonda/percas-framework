<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form1\Action;


use Percas\Core\Component\Form1\Form;

interface ActionInterface
{
    public function getName(): string;

    public function getText(): string;

    public function handle(Form $form): void;
}
