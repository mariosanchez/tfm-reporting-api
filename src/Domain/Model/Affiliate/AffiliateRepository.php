<?php

namespace ParkimeterAffiliates\Domain\Model\Affiliate;

interface AffiliateRepository
{
    /**
     * Returns entity with given id
     *
     * @param int $id
     * @return null|Affiliate
     */
    public function findById(int $id): ?Affiliate;

    /**
     * @param string $column
     * @param string $value
     * @return null|Affiliate
     */
    public function findOneByColumn(string $column, string $value): ?Affiliate;

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
     * @return \Traversable
     */
    public function findAllPaginated(int $firstResult, int $maxResult): \Traversable;

    /**
     * Persists a affiliate
     *
     * @param Affiliate $affiliate
     * @return Affiliate
     */
    public function save(Affiliate $affiliate): Affiliate;

    /**
     * Removes a affiliate
     *
     * @param Affiliate $affiliate
     */
    public function remove(Affiliate $affiliate);
}
