<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form\Action;


use Percas\Core\Component\Form\Form;

interface HandlerInterface
{
    public function handle(Form $form);
}
