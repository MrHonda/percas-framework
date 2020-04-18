<?php

declare(strict_types=1);


namespace Percas\Core\Security\Autherization;

use Doctrine\ORM\EntityManagerInterface;
use Percas\Entity\System\Application;
use Percas\Entity\System\Module;
use Percas\Entity\System\Permission;
use Percas\Entity\System\User;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Security;

class AutherizationChecker implements AutherizationCheckerInterface
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
     * @var Module|null
     */
    private $module = null;

    /**
     * @var Application|null
     */
    private $application = null;

    /**
     * @var Permission[][]
     */
    private $appPermissions = [];

    /**
     * @var Permission[][]
     */
    private $modulePermissions = [];

    /**
     * AutherizationService constructor.
     * @param EntityManagerInterface $em
     * @param Security $security
     * @param RequestStack $requestStack
     */
    public function __construct(EntityManagerInterface $em, Security $security, RequestStack $requestStack)
    {
        $this->em = $em;
        $this->user = $security->getUser();

        $request = $requestStack->getCurrentRequest();
        $parsedLink = $this->parseLink($request ? $request->getPathInfo() : '');

        if ($parsedLink->modulePath) {
            $this->module = $this->findModule($parsedLink->modulePath);
        }

        if ($this->module && $parsedLink->applicationPath) {
            $this->application = $this->findApplication($this->module, $parsedLink->applicationPath);
        }

        if ($this->application && $this->user) {
            $this->appPermissions[$this->application->getId()] = $this->findAppPermissions($this->application, $this->user);
        }
    }

    /**
     * @param string $link
     * @return \stdClass
     */
    private function parseLink(string $link): \stdClass
    {
        $result = new \stdClass();
        $result->modulePath = null;
        $result->applicationPath = null;

        $parsed = explode('/', trim($link, '/'));
        $parsedCnt = count($parsed);

        if ($parsedCnt >= 1) {
            $result->modulePath = '/' . $parsed[0];
        }

        if ($parsedCnt >= 2) {
            $result->applicationPath = '/' . $parsed[1];
        }

        return $result;
    }

    /**
     * @param string $link
     * @return Module|null
     */
    private function findModule(string $link): ?Module
    {
        return $this->em->getRepository(Module::class)->findOneBy(['link' => $link]);
    }

    /**
     * @param Module $module
     * @param string $link
     * @return Application|null
     */
    private function findApplication(Module $module, string $link): ?Application
    {
        return $this->em->getRepository(Application::class)->findByLinkAndModule($module, $link);
    }

    /**
     * @param Module $module
     * @param User $user
     * @return Permission[]
     */
    private function findModulePermissions(Module $module, User $user): array
    {
        $result = [];
        $permissions = $this->em->getRepository(Permission::class)->findByModuleAndRoles($module, $user->getAllRoles());

        foreach ($permissions as $permission) {
            $result[$permission->getKey()] = $permission;
        }

        return $result;
    }

    /**
     * @param Application $application
     * @param User $user
     * @return Permission[]
     */
    private function findAppPermissions(Application $application, User $user): array
    {
        $result = [];
        $permissions = $this->em->getRepository(Permission::class)->findByApplicationAndRoles($application, $user->getAllRoles());

        foreach ($permissions as $permission) {
            $result[$permission->getKey()] = $permission;
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function denyUnlessGranted(string $permKey): void
    {
        if ($this->application) {
            if (!$this->isGrantedApplication($this->application, $permKey)) {
                throw new AccessDeniedException();
            }
        } else if ($this->module) {
            if (!$this->isGrantedModule($this->module, $permKey)) {
                throw new AccessDeniedException();
            }
        }
    }

    public function isGrantedModule(Module $module, string $permKey): bool
    {
        $id = $module->getId();

        if (!isset($this->modulePermissions[$id])) {
            $this->modulePermissions[$id] = $this->findModulePermissions($module, $this->user);
        }

        return isset($this->modulePermissions[$id][$permKey]);
    }

    public function isGrantedApplication(Application $application, string $permKey): bool
    {
        $id = $application->getId();

        if (!isset($this->appPermissions[$id])) {
            $this->appPermissions[$id] = $this->findAppPermissions($application, $this->user);
        }

        return isset($this->appPermissions[$id][$permKey]);
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @return Module|null
     */
    public function getModule(): ?Module
    {
        return $this->module;
    }

    /**
     * @return Application|null
     */
    public function getApplication(): ?Application
    {
        return $this->application;
    }
}
