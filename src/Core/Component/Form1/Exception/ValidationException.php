<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form1\Exception;


use Throwable;

class ValidationException extends \RuntimeException
{
    /** @var array */
    private $errors;

    public function __construct(array $errors, $code = 0, Throwable $previous = null)
    {
        $this->errors = $errors;
        parent::__construct('Invalid', $code, $previous);
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
