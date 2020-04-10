<?php

namespace Percas\Repository\System;

use Percas\Entity\System\Application;
use Percas\Entity\System\Module;
use Percas\Entity\System\Permission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Percas\Entity\System\Role;

/**
 * @method Permission|null find($id, $lockMode = null, $lockVersion = null)
 * @method Permission|null findOneBy(array $criteria, array $orderBy = null)
 * @method Permission[]    findAll()
 * @method Permission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PermissionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Permission::class);
    }

    /**
     * @param Module $module
     * @param Role[] $roles
     * @return Permission[]
     */
    public function findByModuleAndRoles(Module $module, array $roles): array
    {
        return $this->_em
            ->createQuery('
                SELECT perm
                FROM Percas\Entity\System\Permission perm
                JOIN perm.roles role
                WHERE perm.module = :module AND role.id IN (:roles)
            ')
            ->setParameters(['module' => $module, 'roles' => $roles])
            ->getResult();
    }

    /**
     * @param Application $application
     * @param Role[] $roles
     * @return Permission[]
     */
    public function findByApplicationAndRoles(Application $application, array $roles): array
    {
        return $this->_em
            ->createQuery('
                SELECT perm
                FROM Percas\Entity\System\Permission perm
                JOIN perm.roles role
                WHERE perm.application = :application AND role.id IN (:roles)
            ')
            ->setParameters(['application' => $application, 'roles' => $roles])
            ->getResult();
    }
}
