<?php


namespace Percas\Core\Component\Form1\Response;


interface ResponseInterface
{
    public function isSuccess(): bool;

    public function getCode(): int;
}
