<?php
namespace ParkimeterAffiliates\Tests\Unit\Infrastructure\Persistence\Repository;

use Faker\Factory;
use ParkimeterAffiliates\Infrastructure\Persistence\Repository\Doctrine\Utils\Filter;
use ParkimeterAffiliates\Tests\Stub\AffiliateRequestFilteredStub;
use ParkimeterAffiliates\Tests\Infrastructure\UnitTestCase;
use ParkimeterAffiliates\Infrastructure\Persistence\Repository\Doctrine\Utils\AffiliateFilterListBuilder;

final class AffiliateFilterListBuilderTest extends UnitTestCase
{
    /**
     * @var AffiliateFilterListBuilder
     */
    private $affiliateFilterListBuilder;

    protected function setUp()
    {
        parent::setUp();
        $this->affiliateFilterListBuilder = new AffiliateFilterListBuilder();
    }

    /**
     * @test
     * @dataProvider filterDataProvider
     */
    public function itCanBuildAnAffiliateFilterList($request, $expected)
    {
        $trackFilterList = ($this->affiliateFilterListBuilder)($request);
        $this->assertEquals($expected, $trackFilterList);
    }

    public function filterDataProvider()
    {
        $email = Factory::create()->email;

        return [
            'noFilterReturnsEmptyArray' => [
                'request' => AffiliateRequestFilteredStub::create(null),
                'expected' => []
            ],
            'withEmailFilterWillReturnOneFilterArray' => [
                'request' => AffiliateRequestFilteredStub::create($email),
                'expected' => [
                    'email' => new Filter(
                        $email,
                        " AND a.email.address = :email "
                    )
                ]
            ],
        ];
    }
}
