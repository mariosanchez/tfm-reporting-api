<?php

namespace ParkimeterAffiliates\Tests\Stub;

use Faker\Factory;
use ParkimeterAffiliates\Domain\Model\ClickTrack\ClickTrack;

final class ClickTrackStub
{

    public static function create(
        ?int $id,
        ?int $affiliateId,
        ?string $affiliateKey,
        ?string $clickId,
        ?\DateTime $createdAt
    ) {
        return ClickTrack::create(
            $id,
            $affiliateId,
            $affiliateKey,
            $clickId,
            $createdAt
        );
    }

    public static function random()
    {
        return self::create(
            Factory::create()->numberBetween(),
            Factory::create()->numberBetween(),
            Factory::create()->uuid,
            Factory::create()->uuid,
            Factory::create()->dateTime
        );
    }
}
