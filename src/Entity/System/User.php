<?php

namespace Percas\Entity\System;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="Percas\Repository\System\UserRepository")
 * @ORM\Table(name="sys_users")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50, nullable=false, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="Percas\Entity\System\UserRole", mappedBy="user", cascade={"persist"})
     */
    private $userRoles;

    /**
     * @var Role
     */
    private $mainRole;

    /**
     * @var Role[]
     */
    private $subRoles = [];

    public function __construct()
    {
        $this->userRoles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Required for symfony security bundle
     * @inheritDoc
     */
    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials(): void
    {
    }

    /**
     * @inheritDoc
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|UserRole[]
     */
    public function getUserRoles(): Collection
    {
        return $this->userRoles;
    }

    public function addUserRole(UserRole $userRole): self
    {
        if (!$this->userRoles->contains($userRole)) {
            $this->userRoles[] = $userRole;
            $userRole->setUser($this);
        }

        return $this;
    }

    public function removeUserRole(UserRole $userRole): self
    {
        if ($this->userRoles->contains($userRole)) {
            $this->userRoles->removeElement($userRole);
            // set the owning side to null (unless already changed)
            if ($userRole->getUser() === $this) {
                $userRole->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Role
     */
    public function getMainRole(): Role
    {
        return $this->mainRole;
    }

    /**
     * @param Role $mainRole
     * @return $this
     */
    public function setMainRole(Role $mainRole): self
    {
        $this->mainRole = $mainRole;
        return $this;
    }

    /**
     * @return Role[]
     */
    public function getSubRoles(): array
    {
        return $this->subRoles;
    }

    /**
     * @param Role[] $subRoles
     * @return $this
     */
    public function setSubRoles(array $subRoles): self
    {
        $this->subRoles = $subRoles;
        return $this;
    }

    /**
     * @param UserRole[] $userRoles
     */
    public function initializeRoles(array $userRoles): void
    {
        $this->mainRole = null;
        $this->subRoles = [];

        foreach ($userRoles as $userRole) {
            if ($userRole->getIsMain()) {
                $this->mainRole = $userRole->getRole();
            } else {
                $this->subRoles[] = $userRole->getRole();
            }
        }
    }

    /**
     * @return Role[]
     */
    public function getAllRoles(): array
    {
        return $this->mainRole ? array_merge([$this->mainRole], $this->subRoles) : $this->subRoles;
    }
}
