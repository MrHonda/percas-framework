<?php

declare(strict_types=1);


namespace Percas\Core\Layout;

use Percas\Entity\Admin\User;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

abstract class AbstractLayout implements LayoutInterface
{
    /**
     * @param TokenStorageInterface $tokenStorage
     * @return User|null
     */
    protected function getUserFromTokenStorage(TokenStorageInterface $tokenStorage): ?User
    {
        $token = $tokenStorage->getToken();

        if (!$token) {
            return null;
        }

        $user = $token->getUser();

        if (!\is_object($user)) {
            return null;
        }

        /** @var User $user */
        return $user;
    }
}
