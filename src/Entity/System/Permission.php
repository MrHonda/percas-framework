<?php

namespace Percas\Entity\System;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Percas\Repository\System\PermissionRepository")
 * @ORM\Table(name="sys_permissions")
 */
class Permission
{
    public const PERMISSION_ACCESS = 'access';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=20, nullable=false)
     */
    private $key;

    /**
     * @var Module
     *
     * @ORM\ManyToOne(targetEntity="Percas\Entity\System\Module", inversedBy="permissions")
     */
    private $module;

    /**
     * @var Application
     *
     * @ORM\ManyToOne(targetEntity="Percas\Entity\System\Application", inversedBy="permissions")
     */
    private $application;

    /**
     * @var Role[]
     *
     * @ORM\ManyToMany(targetEntity="Percas\Entity\System\Role", inversedBy="permissions")
     * @ORM\JoinTable(name="sys_permissions_roles")
     */
    private $roles = [];

    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKey(): ?string
    {
        return $this->key;
    }

    public function setKey(string $key): self
    {
        $this->key = $key;

        return $this;
    }

    public function getApplication(): ?Application
    {
        return $this->application;
    }

    public function setApplication(?Application $application): self
    {
        $this->application = $application;

        return $this;
    }

    /**
     * @return Collection|Role[]
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function addRole(Role $role): self
    {
        if (!$this->roles->contains($role)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    public function removeRole(Role $role): self
    {
        if ($this->roles->contains($role)) {
            $this->roles->removeElement($role);
        }

        return $this;
    }

    public function getModule(): ?Module
    {
        return $this->module;
    }

    public function setModule(?Module $module): self
    {
        $this->module = $module;

        return $this;
    }
}
