<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form\DataMapper;


interface DataMapperInterface
{
    /**
     * @param object|array|\stdClass $data
     * @param string $key
     * @return mixed
     */
    public function getValue($data, string $key);

    /**
     * @param object|array|\stdClass $data
     * @param string $key
     * @param mixed $value
     */
    public function setValue(&$data, string $key, $value): void;
}
