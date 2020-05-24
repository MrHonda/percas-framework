<?php

declare(strict_types=1);


namespace Percas\Core\Component\Grid\DataSource;


use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class DoctrineDataSource implements DataSourceInterface
{
    /**
     * @var QueryBuilder
     */
    private $queryBuilder;

    public function __construct(QueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    public function getData(array $keyPairs): array
    {
        return $this->queryBuilder
            ->select($this->prepareSelect($keyPairs))
            ->getQuery()
            ->getResult(AbstractQuery::HYDRATE_SCALAR);
    }

    private function prepareKeyPairs(array $keyPairs): array
    {
        foreach ($keyPairs as $index => $pair) {
            if (strpos($pair['key'], '.') === false) {
                $keyPairs[$index]['key'] = $this->queryBuilder->getRootAliases()[0] . '.' . $pair['key'];
            }
        }

        return $keyPairs;
    }

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
