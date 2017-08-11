<?php

namespace ParkimeterAffiliates\Infrastructure\Persistance\Repository\Doctrine;

use Doctrine\ORM\Tools\Pagination\Paginator;
use ParkimeterAffiliates\Domain\Model\AffiliateRepository as AffiliateRepositoryInterface;
use ParkimeterAffiliates\Domain\Model\Affiliate;
use \Doctrine\ORM\EntityRepository;

/**
 * AffiliateRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AffiliateRepository extends EntityRepository implements AffiliateRepositoryInterface
{

    /**
     * Returns entity with given id
     *
     * @param int $id
     * @return null|Affiliate
     */
    public function findById(int $id): ?Affiliate
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
     * @return Paginator
     */
    public function findAllPaginated(int $firstResult, int $maxResult): Paginator
    {
        $entityManager = $this->getEntityManager();

        $statusEnabled = Affiliate::AFFILIATE_STATUS_DISABLED;

        $dql = "SELECT a 
                FROM ParkimeterAffiliates\Domain\Model\Affiliate a
                WHERE a.statusId != $statusEnabled";

        $query = $entityManager->createQuery($dql)
            ->setFirstResult($firstResult)
            ->setMaxResults($maxResult);

        return new Paginator($query, $fetchJoinCollection = true);
    }

    /**
     * Persists a affiliate
     *
     * @param Affiliate $affiliate
     * @return Affiliate
     */
    public function save(Affiliate $affiliate): Affiliate
    {
        $entityManager = $this->getEntityManager();
        $id = $affiliate->getId();
        if (!isset($id)) {
            $entityManager->persist($affiliate);
        }
        $entityManager->flush($affiliate);

        return $affiliate;
    }

    /**
     * Removes a affiliate
     *
     * @param Affiliate $affiliate
     */
    public function remove(Affiliate $affiliate)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($affiliate);
        $entityManager->flush($affiliate);
    }
}
