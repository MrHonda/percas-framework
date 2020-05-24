<?php

declare(strict_types=1);


namespace Percas\Core\Component\Grid\Renderer;


use Percas\Core\Component\Grid\Grid;

interface RendererInterface
{
    /**
     * @param Grid $grid
     * @return mixed
     */
    public function render(Grid $grid);
}
