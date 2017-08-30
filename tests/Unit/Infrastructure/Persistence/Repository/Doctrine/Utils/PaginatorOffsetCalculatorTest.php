<?php
namespace ParkimeterAffiliates\Tests\Unit\Infrastructure\Persistence\Repository;

use ParkimeterAffiliates\Tests\Infrastructure\UnitTestCase;
use ParkimeterAffiliates\Infrastructure\Persistence\Repository\Doctrine\Utils\PaginatorOffsetCalculator;

final class PaginatorOffsetCalculatorTest extends UnitTestCase
{
    /**
     * @var PaginatorOffsetCalculator
     */
    private $paginatorOffsetCalculator;

    protected function setUp()
    {
        parent::setUp();
        $this->paginatorOffsetCalculator = new PaginatorOffsetCalculator();
    }

    /**
     * @test
     * @dataProvider filterDataProvider
     */
    public function itCanBuildATrackFilterList($page, $perPage, $expected)
    {
        $trackFilterList = ($this->paginatorOffsetCalculator)($page, $perPage);
        $this->assertEquals($expected, $trackFilterList);
    }

    public function filterDataProvider()
    {
        return [
            'page1PerPage10ShouldBe0' => [
                'page' => 1,
                'perPage' => 10,
                'expected' => 0
            ],
            'page0PerPage10ShouldBe' => [
                'page' => 0,
                'perPage' => 10,
                'expected' => 0
            ],
            'page0PerPage0ShouldBe' => [
                'page' => 0,
                'perPage' => 0,
                'expected' => 0
            ],
            'page2PerPage10ShouldBe' => [
                'page' => 2,
                'perPage' => 10,
                'expected' => 10
            ],
            'page3PerPage100ShouldBe' => [
                'page' => 3,
                'perPage' => 100,
                'expected' => 200
            ],
        ];
    }
}
