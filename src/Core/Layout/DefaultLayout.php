<?php

declare(strict_types=1);


namespace Percas\Core\Layout;

use Doctrine\ORM\EntityManagerInterface;
use Percas\Entity\Admin\Module;
use Percas\Entity\Admin\User;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class DefaultLayout extends AbstractLayout
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var Module[]
     */
    private $modules = [];

    /**
     * @param TokenStorageInterface $tokenStorage
     * @param EntityManagerInterface $em
     */
    public function __construct(TokenStorageInterface $tokenStorage, EntityManagerInterface $em)
    {
        $this->user = $this->getUserFromTokenStorage($tokenStorage);
//        $this->modules = $em->getRepository(Module::class)->findAll();
    }

    /**
     * @inheritDoc
     */
    public function getPath(): string
    {
        return 'layouts/default/layout.html.twig';
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return Module[]
     */
    public function getModules(): array
    {
        return $this->modules;
    }
}
