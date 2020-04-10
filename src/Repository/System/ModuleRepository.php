<?php

namespace Percas\Repository\System;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\PersistentCollection;
use Doctrine\ORM\Query;
use Percas\Entity\System\Application;
use Percas\Entity\System\Module;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Percas\Entity\System\Permission;
use Percas\Entity\System\Role;

/**
 * @method Module|null find($id, $lockMode = null, $lockVersion = null)
 * @method Module|null findOneBy(array $criteria, array $orderBy = null)
 * @method Module[]    findAll()
 * @method Module[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Module::class);
    }

    /**
     * @param Role[] $roles
     * @return array
     */
    public function findAllAccessibleByRoles(array $roles): array
    {
        /** @var Module[] $modules */
        $modules = $this->_em
            ->createQuery('
                SELECT mod
                FROM Percas\Entity\System\Module mod
                JOIN mod.permissions perm WITH perm.key = :key
                JOIN perm.roles role WITH role.id IN (:roles)
            ')
            ->setParameters(['key' => Permission::PERMISSION_ACCESS, 'roles' => $roles])
            ->getResult();

        $this->_em
            ->createQuery('
                SELECT PARTIAL mod.{id}, app
                FROM Percas\Entity\System\Module mod
                JOIN mod.applications app
                JOIN app.permissions perm WITH perm.key = :key
                JOIN perm.roles role WITH role.id IN (:roles)
            ')
            ->setParameters(['key' => Permission::PERMISSION_ACCESS, 'roles' => $roles])
            ->getResult();

        foreach ($modules as $module) {
            $applications = $module->getApplications();

            if ($applications instanceof PersistentCollection) {
                $applications->setInitialized(true);
            }
        }

        return $modules;
    }
}
