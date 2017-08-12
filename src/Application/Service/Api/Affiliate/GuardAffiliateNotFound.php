<?php

namespace ParkimeterAffiliates\Application\Service\Api\Affiliate;

use ParkimeterAffiliates\Domain\Model\Affiliate\Affiliate;
use ParkimeterAffiliates\Domain\Model\Affiliate\AffiliateException;

class GuardAffiliateNotFound
{
    /**
     * @param Affiliate $result
     * @param int $id
     * @throws AffiliateException
     */
    public static function guard(Affiliate $result, int $id)
    {
        if (!isset($result)) {
            throw AffiliateException::notFound($id);
        }
    }
}
