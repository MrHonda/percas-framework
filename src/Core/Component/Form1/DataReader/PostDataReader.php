<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form1\DataReader;


class PostDataReader implements DataReaderInterface
{
    public function read(): array
    {
        return $_POST['fields'] ?? [];
    }

    public function hasData(): bool
    {
        return isset($_POST['action']) && !empty($_POST['action']);
    }

    public function getAction(): string
    {
        return $_POST['action'] ?? '';
    }
}
