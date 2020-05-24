<?php

declare(strict_types=1);


namespace Percas\Core\Component\Grid\Renderer;


use Percas\Core\Component\Grid\Grid;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class JsonRenderer implements RendererInterface
{
    /**
     * @param Grid $grid
     * @return string
     */
    public function render(Grid $grid): string
    {
        $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
        return $serializer->serialize($grid, 'json');
    }
}
