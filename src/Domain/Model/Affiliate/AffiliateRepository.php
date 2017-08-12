<?php

namespace ParkimeterAffiliates\Domain\Model\Affiliate;

use Doctrine\ORM\Tools\Pagination\Paginator;

interface AffiliateRepository
{
    /**
     * Returns entity with given id
     *
     * @param int $id
     * @return null|Affiliate
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
     * @return Paginator
     */
    public function findAllPaginated(int $firstResult, int $maxResult): Paginator;

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
