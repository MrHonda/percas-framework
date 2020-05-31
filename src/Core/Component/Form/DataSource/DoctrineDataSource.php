<?php

declare(strict_types=1);


namespace Percas\Core\Component\Form\DataSource;


use Doctrine\ORM\EntityManagerInterface;

class DoctrineDataSource implements DataSourceInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var string
     */
    private $entityClass;

    /**
     * DoctrineDataSource constructor.
     * @param EntityManagerInterface $em
     * @param string $entityClass
     */
    public function __construct(EntityManagerInterface $em, string $entityClass)
    {
        $this->em = $em;
        $this->entityClass = $entityClass;
    }

    public function getData(string $primaryKeyName, int $primaryKeyValue): array
    {
        $data = $this->em
            ->createQueryBuilder()
            ->select('e')
            ->from($this->entityClass, 'e')
            ->where('e.' . $primaryKeyName . ' = :primaryKey')
            ->setParameter(':primaryKey', $primaryKeyValue)
            ->getQuery()
            ->getArrayResult();

        return count($data) > 0 ? $data[0] : [];
    }

    /**
     * @inheritDoc
     */
    public function update(array $fields, int $primaryKeyValue): void
    {
        $query = $this->em
            ->createQueryBuilder()
            ->update($this->entityClass, 'e')
            ->where('e.id = :id')
            ->setParameter(':id', $primaryKeyValue);

        foreach ($fields as $field) {
            $key = $field->getDataSourceKey();
            $query
                ->set('e.' . $key, ':' . $key)
                ->setParameter(':' . $key, $field->getValue());
        }

        $query
            ->getQuery()
            ->execute();
    }
}
