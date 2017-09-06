<?php

namespace ParkimeterAffiliates\Infrastructure\Persistence\Repository\Doctrine\Utils;

class AffiliateFilterListBuilder
{
    public function __invoke($request): array
    {
        $filters = [];
        $filters = $this->buildEmailFilter($request->email(), $filters);

        return $filters;
    }

    /**
     * @param string $value
     * @param array $filters
     * @return array
     */
    private function buildEmailFilter(string $value, array $filters): array
    {
        if (empty($value)) {
            return $filters;
        }

        $filters['email'] = new Filter(
            $value,
            " AND a.email.address = :email "
        );

        return $filters;
    }
}
