<?php

namespace Percas\Repository\Admin;

use Doctrine\Common\Collections\Collection;
use Percas\Entity\Admin\Role;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Percas\Entity\Admin\UserRole;

/**
 * @method Role|null find($id, $lockMode = null, $lockVersion = null)
 * @method Role|null findOneBy(array $criteria, array $orderBy = null)
 * @method Role[]    findAll()
 * @method Role[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Role::class);
    }

    /**
     * @param UserRole[] $userRoles
     * @return Role[]
     */
    public function findByUserRoles(array $userRoles): array
    {
        return $this->_em
            ->createQuery('
                SELECT role
                FROM Percas\Entity\Admin\Role role
                JOIN role.userRoles urole
                WHERE urole.id IN (:userRoles)
            ')
            ->setParameters(['userRoles' => $userRoles])
            ->getResult();
    }
}
