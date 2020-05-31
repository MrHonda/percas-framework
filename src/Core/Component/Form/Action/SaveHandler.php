<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form\Action;


use Percas\Core\Component\Form\Form;

class SaveHandler implements HandlerInterface
{
    public function handle(Form $form): void
    {
        $form->save();
    }
}
