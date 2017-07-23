<?php

namespace ParkimeterAffiliates\Tests\Affiliate\Acceptance\Context;

use Behat\Behat\Context\Context;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FeatureContext extends WebTestCase implements Context
{
    /**
     * @BeforeScenario
     */
    public static function before()
    {
        exec('chmod -Rf 777 app/var/cache');
    }
}
