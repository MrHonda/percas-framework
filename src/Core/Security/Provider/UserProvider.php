<?php

declare(strict_types=1);


namespace Percas\Core\Security\Provider;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Percas\Entity\Admin\Role;
use Percas\Entity\Admin\User;
use Symfony\Bridge\Doctrine\Security\User\EntityUserProvider;
use Symfony\Component\Security\Core\User\UserInterface;

class UserProvider extends EntityUserProvider
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * UserProvider constructor.
     * @param ManagerRegistry $registry
     * @param EntityManagerInterface $em
     */
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $em)
    {
        parent::__construct($registry, User::class, 'username', null);
        $this->em = $em;
    }

    /**
     * @inheritDoc
     */
    public function refreshUser(UserInterface $user)
    {
        /** @var User $refreshedUser */
        $refreshedUser = parent::refreshUser($user);

        if($refreshedUser) {
            $this->em->getRepository(Role::class)->findByUserRoles($refreshedUser->getUserRoles()->toArray());
            $refreshedUser->initializeRoles($refreshedUser->getUserRoles()->toArray());
        }

        return $refreshedUser;
    }
}
