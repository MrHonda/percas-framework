<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form\DataMapper;


class DoctrineDataMapper implements DataMapperInterface
{
    /**
     * @inheritDoc
     */
    public function getValue($data, string $key)
    {
        $method = 'get' . ucfirst($key);
        return $data->$method();
    }

    /**
     * @inheritDoc
     */
    public function setValue(&$data, string $key, $value): void
    {
        $method = 'set' . ucfirst($key);
        $data->$method($value);
    }
}
