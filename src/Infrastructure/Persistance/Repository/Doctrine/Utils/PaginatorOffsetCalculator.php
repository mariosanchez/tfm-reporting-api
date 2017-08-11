<?php

namespace ParkimeterAffiliates\Infrastructure\Persistance\Repository\Doctrine\Utils;

class PaginatorOffsetCalculator
{
    /**
     * @param int $page
     * @param int $perPage
     * @return int
     */
    public function __invoke(int $page, int $perPage): int
    {
        $offsetIndex = $page - 1;
        $offset = ($offsetIndex * $perPage);

        if ($offset < 0) {
            $offset = 0;
        }

        return $offset;
    }
}
