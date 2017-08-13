<?php

namespace ParkimeterAffiliates\Domain\Model\CancellationTrack;

use Doctrine\ORM\Tools\Pagination\Paginator;

interface CancellationTrackRepository
{
    /**
     * Returns entity with given id
     *
     * @param int $id
     * @return null|CancellationTrack
     */
    public function findById(int $id);

    /**
     * Returns all entities
     *
     * @param array $orderBy
     * @return array
     */
    public function findAll(array $orderBy = null);

    /**
     * @param int $firstResult
     * @param int $maxResult
     * @param array $filters
     * @return Paginator
     */
    public function findAllPaginated(int $firstResult, int $maxResult, array $filters): Paginator;
}
