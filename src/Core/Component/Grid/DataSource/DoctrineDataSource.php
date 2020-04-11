<?php

declare(strict_types=1);


namespace Percas\Core\Component\Grid\DataSource;


use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class DoctrineDataSource implements DataSourceInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var QueryBuilder
     */
    private $queryBuilder;

    /**
     * DoctrineDataSource constructor.
     * @param EntityManagerInterface $em
     * @param QueryBuilder $queryBuilder
     */
    public function __construct(EntityManagerInterface $em, QueryBuilder $queryBuilder)
    {
        $this->em = $em;
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * @inheritDoc
     */
    public function getData(array $keyPairs): array
    {
        return $this->queryBuilder
            ->select($this->prepareSelect($keyPairs))
            ->getQuery()
            ->getResult(AbstractQuery::HYDRATE_SCALAR);
    }

    /**
     * @param array $keyPairs
     * @return string[]
     */
    private function prepareKeyPairs(array $keyPairs): array
    {
        foreach ($keyPairs as $index => $pair) {
            if (strpos($pair['key'], '.') === false) {
                $keyPairs[$index]['key'] = $this->queryBuilder->getRootAliases()[0] . '.' . $pair['key'];
            }
        }

        return $keyPairs;
    }

    /**
     * @param string[] $keyPairs
     * @return string
     */
    private function prepareSelect(array $keyPairs): string
    {
        $keyPairs = $this->prepareKeyPairs($keyPairs);
        $result = [];

        foreach ($keyPairs as $keyPair) {
            $result[] = $keyPair['key'] . ' as ' . $keyPair['alias'];
        }

        return implode(',', $result);
    }
}
