<?php

namespace Percas\Entity\Admin;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Percas\Repository\Admin\PermissionRepository")
 * @ORM\Table(name="adm_permissions")
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
     * @var Application
     *
     * @ORM\ManyToOne(targetEntity="Percas\Entity\Admin\Application", inversedBy="permissions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $application;

    /**
     * @var Role
     *
     * @ORM\ManyToOne(targetEntity="Percas\Entity\Admin\Role", inversedBy="permissions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $role;

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

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }
}
