<?php

namespace Percas\Repository\Admin;

use Doctrine\ORM\NonUniqueResultException;
use Percas\Entity\Admin\Application;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Percas\Entity\Admin\Module;

/**
 * @method Application|null find($id, $lockMode = null, $lockVersion = null)
 * @method Application|null findOneBy(array $criteria, array $orderBy = null)
 * @method Application[]    findAll()
 * @method Application[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplicationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Application::class);
    }

    public function findByLinkAndModule(Module $module, string $link): ?Application
    {
        try {
            return $this->_em
                ->createQuery('
                    SELECT app
                    FROM Percas\Entity\Admin\Application app
                    WHERE app.module = :module AND app.link = :link
                ')
                ->setParameters(['module' => $module, 'link' => $link])
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }
}
