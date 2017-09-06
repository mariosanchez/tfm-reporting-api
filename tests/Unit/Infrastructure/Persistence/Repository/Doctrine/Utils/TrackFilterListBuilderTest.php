<?php
namespace ParkimeterAffiliates\Tests\Unit\Infrastructure\Persistence\Repository;

use ParkimeterAffiliates\Domain\Model\Affiliate\Affiliate;
use ParkimeterAffiliates\Infrastructure\Persistence\Repository\Doctrine\Utils\Filter;
use ParkimeterAffiliates\Tests\Stub\TrackRequestFilteredStub;
use ParkimeterAffiliates\Tests\Infrastructure\UnitTestCase;
use ParkimeterAffiliates\Infrastructure\Persistence\Repository\Doctrine\Utils\TrackFilterListBuilder;

final class TrackFilterListBuilderTest extends UnitTestCase
{
    /**
     * @var TrackFilterListBuilder
     */
    private $trackFilterListBuilder;

    protected function setUp()
    {
        parent::setUp();
        $this->trackFilterListBuilder = new TrackFilterListBuilder();
    }

    /**
     * @test
     * @dataProvider filterDataProvider
     */
    public function itCanBuildATrackFilterList($request, $expected)
    {
        $trackFilterList = ($this->trackFilterListBuilder)($request);
        $this->assertEquals($expected, $trackFilterList);
    }

    public function filterDataProvider()
    {
        $statusEnabled = Affiliate::AFFILIATE_STATUS_DISABLED;

        return [
            'noFilterReturnsEmptyArray' => [
                'request' => TrackRequestFilteredStub::create(null, null, null),
                'expected' => []
            ],
            'withAffiliateIdFilterWillReturnOneFilterArray' => [
                'request' => TrackRequestFilteredStub::create(1, null, null),
                'expected' => [
                    'affiliateId' => new Filter(
                        1,
                        " AND c.affiliateId = :affiliateId
AND (SELECT 1 
FROM ParkimeterAffiliates\\Domain\\Model\\Affiliate\\Affiliate a
WHERE a.statusId != $statusEnabled
AND a.id = :affiliateId) = 1 "
                    )
                ]
            ],
            'withFromDateFilterWillReturnOneFilterArray' => [
                'request' => TrackRequestFilteredStub::create(null, '20170705', null),
                'expected' => [
                    'dateFrom' => new Filter(
                        date('Ymd', strtotime('20170705')),
                        " AND c.createdAt >= :dateFrom "
                    )
                ]
            ],
            'withToDateFilterWillReturnOneFilterArray' => [
                'request' => TrackRequestFilteredStub::create(null, null, '20170705'),
                'expected' => [
                    'toFrom' => new Filter(
                        date('Ymd', strtotime('20170705')),
                        " AND c.createdAt <= :toFrom "
                    )
                ]
            ],
            'withAllFiltersWillReturnOneFilterArray' => [
                'request' => TrackRequestFilteredStub::create(1, '20170705', '20170705'),
                'expected' => [
                    'affiliateId' => new Filter(
                        1,
                        " AND c.affiliateId = :affiliateId
AND (SELECT 1 
FROM ParkimeterAffiliates\\Domain\\Model\\Affiliate\\Affiliate a
WHERE a.statusId != $statusEnabled
AND a.id = :affiliateId) = 1 "
                    ),
                    'dateFrom' => new Filter(
                        date('Ymd', strtotime('20170705')),
                        " AND c.createdAt >= :dateFrom "
                    ),
                    'toFrom' => new Filter(
                        date('Ymd', strtotime('20170705')),
                        " AND c.createdAt <= :toFrom "
                    )
                ]
            ],
        ];
    }
}
