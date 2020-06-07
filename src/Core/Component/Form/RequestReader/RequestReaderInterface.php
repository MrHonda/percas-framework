<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form\RequestReader;


interface RequestReaderInterface
{
    public function read(): void;

    /**
     * @param string $key
     * @return mixed
     */
    public function getValue(string $key);

    /**
     * @return string
     */
    public function getAction(): string;

    /**
     * @return bool
     */
    public function isSubmitted(): bool;
}
