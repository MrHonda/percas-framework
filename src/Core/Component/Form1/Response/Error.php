<?php


namespace Percas\Core\Component\Form1\Response;


class Error implements ResponseInterface
{
    /**
     * @var string
     */
    private $error;

    /**
     * Error constructor.
     * @param string $error
     */
    public function __construct(string $error)
    {
        $this->error = $error;
    }

    public function isSuccess(): bool
    {
        return false;
    }

    public function getCode(): int
    {
        return 400;
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }
}
