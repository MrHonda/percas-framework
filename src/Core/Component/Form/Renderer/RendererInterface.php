<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form\Renderer;


use Percas\Core\Component\Form\Form;

interface RendererInterface
{
    /**
     * @param Form $form
     * @return mixed
     */
    public function render(Form $form);
}
