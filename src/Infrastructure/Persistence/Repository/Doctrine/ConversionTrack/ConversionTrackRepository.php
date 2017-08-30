<?php

namespace ParkimeterAffiliates\Infrastructure\Persistence\Repository\Doctrine\ConversionTrack;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use ParkimeterAffiliates\Domain\Model\ConversionTrack\ConversionTrackRepository as ConversionTrackRepositoryInterface;
use ParkimeterAffiliates\Domain\Model\ConversionTrack\ConversionTrack;
use ParkimeterAffiliates\Infrastructure\Persistence\Repository\Doctrine\Utils\TrackFilterQueryBuilder;

/**
 * ConversionTrackRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ConversionTrackRepository extends EntityRepository implements ConversionTrackRepositoryInterface
{

    /**
     * Returns entity with given id
     *
     * @param int $id
     * @return null|ConversionTrack
     */
    public function findById(int $id): ?ConversionTrack
    {
        return $this->find($id);
    }

    /**
     * Returns all entities
     *
     * @param array $orderBy
     * @return array
     */
    public function findAll(array $orderBy = null): array
    {
        return $this->findBy(
            array(),
            isset($orderBy) ? $orderBy : array()
        );
    }

    /**
     * @param int $firstResult
     * @param int $maxResult
     * @param array $filters
     * @return \Traversable
     */
    public function findAllPaginated(int $firstResult, int $maxResult, array $filters): \Traversable
    {
        $entityManager = $this->getEntityManager();

        $dql = "SELECT c 
                FROM ParkimeterAffiliates\Domain\Model\ConversionTrack\ConversionTrack c
                ";

        $filterQueryBuilder = new TrackFilterQueryBuilder();
        $query = $filterQueryBuilder($dql, $filters, $entityManager);
        $query->setFirstResult($firstResult)
            ->setMaxResults($maxResult);

        return new Paginator($query, $fetchJoinCollection = true);
    }
}
