<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form1\Response;


class Invalid implements ResponseInterface
{
    /** @var array */
    private $errors;

    /**
     * Invalid constructor.
     * @param array $errors
     */
    public function __construct(array $errors)
    {
        $this->errors = $errors;
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
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
