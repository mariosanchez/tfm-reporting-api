<?php

namespace ParkimeterAffiliates\Application\Service\Api\ClickTrack;

use ParkimeterAffiliates\Domain\Model\ClickTrack\ClickTrack;
use ParkimeterAffiliates\Domain\Model\ClickTrack\ClickTrackException;

class GuardClickTrackNotFound
{
    /**
     * @param null|ClickTrack $result
     * @param int $id
     * @throws ClickTrackException
     */
    public static function guard(?ClickTrack $result, int $id)
    {
        if (!isset($result)) {
            throw ClickTrackException::notFound($id);
        }
    }
}
