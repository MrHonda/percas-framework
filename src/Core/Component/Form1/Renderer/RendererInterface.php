<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form1\Renderer;


use Percas\Core\Component\Form1\Form;
use Percas\Core\Component\Form1\Response\ResponseInterface;

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
