<?php

declare(strict_types=1);


namespace Percas\Core\Controller;


use Percas\Entity\Admin\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class AbstractFrameworkController extends AbstractController
{
    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        $user = parent::getUser();

        if ($user instanceof User) {
            return $user;
        }

        return null;
    }
}
