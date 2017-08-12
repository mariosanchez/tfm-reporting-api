<?php

namespace ParkimeterAffiliates\Application\Service\Api\Affiliate;

use ParkimeterAffiliates\Domain\Model\Affiliate\Affiliate;
use ParkimeterAffiliates\Domain\Model\Affiliate\AffiliateException;

class GuardAffiliateDisabled
{
    /**
     * @param Affiliate $result
     * @throws AffiliateException
     */
    public static function guard(Affiliate $result)
    {
        if ($result->isDisabled()) {
            throw AffiliateException::notFound($result->getId());
        }
    }
}
