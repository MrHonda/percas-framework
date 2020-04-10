<?php

declare(strict_types=1);


namespace Percas\Core\Security\Autherization;


interface AutherizationCheckerInterface
{
    /**
     * @param string $permKey
     */
    public function denyUnlessGranted(string $permKey): void;
}
