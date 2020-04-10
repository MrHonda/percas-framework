<?php

declare(strict_types=1);


namespace Percas\Core\Layout;

use Doctrine\ORM\EntityManagerInterface;
use Percas\Entity\System\Module;
use Percas\Entity\System\User;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Security;

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
     * @param Security $security
     * @param EntityManagerInterface $em
     */
    public function __construct(Security $security, EntityManagerInterface $em)
    {
        $this->user = $security->getUser();
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
