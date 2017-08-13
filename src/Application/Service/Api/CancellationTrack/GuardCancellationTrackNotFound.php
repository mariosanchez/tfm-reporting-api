<?php

namespace ParkimeterAffiliates\Application\Service\Api\CancellationTrack;

use ParkimeterAffiliates\Domain\Model\CancellationTrack\CancellationTrack;
use ParkimeterAffiliates\Domain\Model\CancellationTrack\CancellationTrackException;

class GuardCancellationTrackNotFound
{
    /**
     * @param null|CancellationTrack $result
     * @param int $id
     * @throws CancellationTrackException
     */
    public static function guard(?CancellationTrack $result, int $id)
    {
        if (!isset($result)) {
            throw CancellationTrackException::notFound($id);
        }
    }
}
