<?php

namespace Percas\Repository\Admin;

use Percas\Entity\Admin\Module;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Percas\Entity\Admin\Permission;
use Percas\Entity\Admin\Role;
use function Doctrine\ORM\QueryBuilder;

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
    public function findAllAccessibleModulesByRoles(array $roles): array
    {
        $qb = $this->createQueryBuilder('mod');
        $modules = $qb
            ->select('mod')
            ->innerJoin('mod.applications', 'apps')
            ->innerJoin('apps.permissions', 'perms')
            ->andWhere('perms.key = :key')
            ->andWhere(
                $qb->expr()->in('perms.role', ':roles')
            )
            ->setParameters(['key' => Permission::PERMISSION_ACCESS, 'roles' => $roles])
            ->getQuery()
            ->getResult();

        $qb
            ->select('PARTIAL mod.{id}, apps2')
            ->innerJoin('mod.applications', 'apps2')
            ->getQuery()
            ->getResult();

        return $modules;
    }

    // /**
    //  * @return Module[] Returns an array of Module objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Module
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
