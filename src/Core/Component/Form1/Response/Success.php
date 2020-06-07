<?php


namespace Percas\Core\Component\Form1\Response;


class Success implements ResponseInterface
{
    public function isSuccess(): bool
    {
        return true;
    }

    public function getCode(): int
    {
        return 200;
    }
}
