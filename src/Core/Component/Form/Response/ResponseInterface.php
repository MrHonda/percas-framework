<?php


namespace Percas\Core\Component\Form\Response;


interface ResponseInterface
{
    public function isSuccess(): bool;

    public function getCode(): int;
}
