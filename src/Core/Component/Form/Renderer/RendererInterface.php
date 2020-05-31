<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form\Renderer;


use Percas\Core\Component\Form\Form;
use Percas\Core\Component\Form\Response\ResponseInterface;

interface RendererInterface
{
    /**
     * @param Form $form
     * @return mixed
     */
    public function render(Form $form);

    /**
     * @param ResponseInterface $response
     * @return mixed
     */
    public function renderResponse(ResponseInterface $response);
}
