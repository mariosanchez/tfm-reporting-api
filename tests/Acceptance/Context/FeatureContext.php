<?php

namespace ParkimeterAffiliates\Tests\Acceptance\Context;

use Behat\Behat\Context\Context;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FeatureContext extends WebTestCase implements Context
{
    /**
     * @BeforeScenario
     */
    public static function before()
    {
        self::clearCache();
        self::setupTestDatabase();
    }

    private static function clearCache():void
    {
        exec('chmod -Rf 777 app/var/cache');
    }

    private static function setupTestDatabase():void
    {
        exec('mysql < database/0-2clearTestDb.sql -u root -h mysql -proot');
        exec('mysql reporting_test < database/1schema.sql -u worker -h mysql -pworker');
        exec('mysql reporting_test < database/2dummy_data.sql -u worker -h mysql -pworker');
    }
}
