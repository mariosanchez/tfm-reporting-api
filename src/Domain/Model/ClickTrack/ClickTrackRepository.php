<?php

namespace ParkimeterAffiliates\Domain\Model\ClickTrack;

interface ClickTrackRepository
{
    /**
     * Returns entity with given id
     *
     * @param int $id
     * @return null|ClickTrack
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
     * @return \Traversable
     */
    public function findAllPaginated(int $firstResult, int $maxResult, array $filters): \Traversable;
}
