<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form2\Renderer;


use Percas\Core\Component\Form2\Form;

class Renderer
{
    public function render(Form $form)
    {
        if ($form->isSubmitted()) {
            if (!$form->isValid()) {
                dd('Invalid', $form);
            }

            dd('Save success', $form);
        }

        dd($form);
    }
}
