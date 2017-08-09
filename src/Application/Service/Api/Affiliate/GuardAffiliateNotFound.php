<?php

namespace ParkimeterAffiliates\Application\Service\Api\Affiliate;

use ParkimeterAffiliates\Domain\Model\AffiliateException;

class GuardAffiliateNotFound
{
    public static function guard($result, $id)
    {
        if (!isset($result)) {
            throw AffiliateException::notFound($id);
        }
    }
}
