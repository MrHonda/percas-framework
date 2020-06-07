<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form\Button;


use Percas\Core\Component\Form\Form;

interface ButtonInterface
{
    public function getKey(): string;

    public function getName(): string;

    public function handle(Form $form): void;
}
