<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form1\Renderer;


use Percas\Core\Component\Form1\Form;
use Percas\Core\Component\Form1\Response\ResponseInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ArrayRenderer implements RendererInterface
{
    public function render(Form $form)
    {
        $serializer = new Serializer([new ObjectNormalizer()]);
        return $serializer->normalize($form, null, [
            AbstractNormalizer::ATTRIBUTES => ['fields', 'actions']
        ]);
    }

    public function renderResponse(ResponseInterface $response)
    {
        $serializer = new Serializer([new ObjectNormalizer()]);
        return $serializer->normalize($response);
    }
}
