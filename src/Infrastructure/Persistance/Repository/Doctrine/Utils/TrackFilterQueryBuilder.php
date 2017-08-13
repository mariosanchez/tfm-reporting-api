<?php

namespace ParkimeterAffiliates\Infrastructure\Persistance\Repository\Doctrine\Utils;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;

class TrackFilterQueryBuilder
{
    /**
     * @param string $dql
     * @param array $filters
     * @param EntityManager $entityManager
     * @return Query
     */
    public function __invoke(string $dql, array $filters, EntityManager $entityManager)
    {
        if (count($filters) > 0 && strpos($dql, 'WHERE') === false) {
            $dql = $dql . ' WHERE 1=1 ';
        }

        foreach ($filters as $filter) {
            /**
             * @var TrackFilter $filter
             */
            $dql = $dql . $filter->query();
        }

        $query = $entityManager->createQuery($dql);

        foreach ($filters as $key => $filter) {
            /**
             * @var TrackFilter $filter
             */
            $query->setParameter($key, $filter->value());
        }

        return $query;
    }
}
