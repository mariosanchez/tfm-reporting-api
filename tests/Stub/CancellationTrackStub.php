<?php

namespace ParkimeterAffiliates\Tests\Stub;

use Faker\Factory;
use ParkimeterAffiliates\Domain\Model\CancellationTrack\CancellationTrack;

final class CancellationTrackStub
{

    public static function create(
        ?int $id,
        ?int $affiliateId,
        ?string $affiliateKey,
        ?string $cancellationId,
        ?\DateTime $createdAt
    ) {
        return CancellationTrack::create(
            $id,
            $affiliateId,
            $affiliateKey,
            $cancellationId,
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
