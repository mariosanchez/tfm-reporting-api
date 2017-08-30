<?php

namespace ParkimeterAffiliates\Infrastructure\Persistence\Repository\Doctrine\Utils;

use ParkimeterAffiliates\Application\Service\Api\ClickTrack\GetManyClickTrack\GetManyClickTrackRequest;
use ParkimeterAffiliates\Domain\Model\Affiliate\Affiliate;

class TrackFilterListBuilder
{
    public function __invoke($request): array
    {
        $filters = [];
        $filters = $this->buildAffiliateIdFilter($request->affiliateId(), $filters);
        $filters = $this->buildFromDateFilter($request->fromDate(), $filters);
        $filters = $this->buildToDateFilter($request->toDate(), $filters);

        return $filters;
    }

    /**
     * @param string $value
     * @param array $filters
     * @return array
     */
    private function buildAffiliateIdFilter(string $value, array $filters): array
    {
        if (empty($value)) {
            return $filters;
        }

        $statusEnabled = Affiliate::AFFILIATE_STATUS_DISABLED;

        $filters['affiliateId'] = new TrackFilter(
            $value,
            " AND c.affiliateId = :affiliateId
AND (SELECT 1 
FROM ParkimeterAffiliates\\Domain\\Model\\Affiliate\\Affiliate a
WHERE a.statusId != $statusEnabled
AND a.id = :affiliateId) = 1 "
        );

        return $filters;
    }

    /**
     * @param string $value
     * @param array $filters
     * @return array
     */
    private function buildFromDateFilter(string $value, array $filters): array
    {
        if (empty($value)) {
            return $filters;
        }

        $filters['dateFrom'] = new TrackFilter(
            date('Ymd', strtotime($value)),
            " AND c.createdAt >= :dateFrom "
        );

        return $filters;
    }

    /**
     * @param string $value
     * @param array $filters
     * @return array
     */
    private function buildToDateFilter(string $value, array $filters): array
    {
        if (empty($value)) {
            return $filters;
        }

        $filters['toFrom'] = new TrackFilter(
            date('Ymd', strtotime($value)),
            " AND c.createdAt <= :toFrom "
        );

        return $filters;
    }
}
