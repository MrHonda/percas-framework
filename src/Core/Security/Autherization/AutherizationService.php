<?php

declare(strict_types=1);


namespace Percas\Core\Security\Autherization;


use Doctrine\ORM\EntityManagerInterface;
use Percas\Entity\Admin\Application;
use Percas\Entity\Admin\Module;
use Percas\Entity\Admin\User;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AutherizationService implements AutherizationServiceInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var User|null
     */
    private $user = null;

    /**
     * @var Application|null
     */
    private $application = null;

    /**
     * AutherizationService constructor.
     * @param EntityManagerInterface $em
     * @param User|null $user
     * @param string $link
     */
    public function __construct(EntityManagerInterface $em, ?User $user, string $link)
    {
        $this->em = $em;
        $this->user = $user;

        $this->initializeUser();
        $this->findApplication($link);
    }

    private function initializeUser(): void
    {
        if ($this->user) {

        }
    }

    private function findApplication(string $link): void
    {
        $this->application = $this->em->getRepository(Application::class)->findByLink($link);
    }

    /**
     * @return Module[]
     */
    public function getAllAccessibleModules(): array
    {
        return $this->em->getRepository(Module::class)->findAllAccessibleModulesByRoles([]);
    }
}
