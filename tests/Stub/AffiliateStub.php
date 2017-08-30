<?php

namespace ParkimeterAffiliates\Tests\Stub;

use Faker\Factory;
use ParkimeterAffiliates\Domain\Model\Affiliate\Affiliate;

final class AffiliateStub
{
    public static function create($name, $lastName, $email)
    {
        return Affiliate::create($name, $lastName, $email);
    }

    public static function random()
    {
        return self::create(
            Factory::create()->name,
            Factory::create()->lastName,
            Factory::create()->email
        );
    }
}