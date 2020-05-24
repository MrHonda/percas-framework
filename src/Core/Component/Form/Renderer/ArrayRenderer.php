<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form\Renderer;


use Percas\Core\Component\Form\Form;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ArrayRenderer implements RendererInterface
{
    public function render(Form $form)
    {
        $serializer = new Serializer([new ObjectNormalizer()]);
        return $serializer->normalize($form);
    }
}
