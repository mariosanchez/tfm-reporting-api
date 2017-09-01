<?php

namespace ParkimeterAffiliates\Domain\Model\ConversionTrack;

interface ConversionTrackRepository
{
    /**
     * Returns entity with given id
     *
     * @param int $id
     * @return null|ConversionTrack
     */
    public function findById(int $id);

    /**
     * Finds a single entity by a set of criteria.
     *
     * @param array $criteria
     * @param array|null $orderBy
     *
     * @return object|null The entity instance or NULL if the entity can not be found.
     */
    public function findOneBy(array $criteria, array $orderBy = null);

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

    /**
     * @param array $values
     * @return mixed
     */
    public function saveMany(array $values);
}
