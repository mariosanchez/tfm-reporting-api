<?php

namespace ParkimeterAffiliates\Application\Service\Api\ConversionTrack;

use ParkimeterAffiliates\Domain\Model\ConversionTrack\ConversionTrack;
use ParkimeterAffiliates\Domain\Model\ConversionTrack\ConversionTrackException;

class GuardConversionTrackNotFound
{
    /**
     * @param null|ConversionTrack $result
     * @param int $id
     * @throws ConversionTrackException
     */
    public static function guard(?ConversionTrack $result, int $id)
    {
        if (!isset($result)) {
            throw ConversionTrackException::notFound($id);
        }
    }
}
