<?php

namespace ParkimeterAffiliates\Domain\Model;

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
