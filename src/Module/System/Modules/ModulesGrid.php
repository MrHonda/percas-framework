<?php

declare(strict_types=1);


namespace Percas\Module\System\Modules;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Percas\Core\Component\Grid\DataSource\DoctrineDataSource;
use Percas\Core\Component\Grid\Grid;
use Percas\Core\Component\Grid\GridBuilder;
use Percas\Entity\System\Module;

class ModulesGrid
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function create(): Grid
    {
        $builder = new GridBuilder(new DoctrineDataSource($this->queryBuilder()));

        $builder->addTextColumn('name', 'Name');
        $builder->addTextColumn('link', 'Link');

        $builder->addRowEditAction();
        $builder->addRowDeleteAction();

        return $builder->build();
    }

    private function queryBuilder(): QueryBuilder
    {
        return $this->em
            ->createQueryBuilder()
            ->from(Module::class, 'e');
    }
}
