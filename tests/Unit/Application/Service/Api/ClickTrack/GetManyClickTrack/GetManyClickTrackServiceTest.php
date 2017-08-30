<?php

namespace ParkimeterAffiliates\Tests\Unit\Application\Service\Api\ClickTrack\GetManyClickTrack;

use Mockery\MockInterface;
use ParkimeterAffiliates\Application\Service\Api\ClickTrack\GetClickTrack\GetClickTrackResponse;
use ParkimeterAffiliates\Application\Service\Api\ClickTrack\GetManyClickTrack\GetManyClickTrackRequest;
use ParkimeterAffiliates\Application\Service\Api\ClickTrack\GetManyClickTrack\GetManyClickTrackResponse;
use ParkimeterAffiliates\Application\Service\Api\ClickTrack\GetManyClickTrack\GetManyClickTrackService;
use ParkimeterAffiliates\Domain\Model\ClickTrack\ClickTrack;
use ParkimeterAffiliates\Domain\Model\ClickTrack\ClickTrackRepository;
use ParkimeterAffiliates\Infrastructure\Persistence\Repository\Doctrine\Utils\PaginatorOffsetCalculator;
use ParkimeterAffiliates\Infrastructure\Persistence\Repository\Doctrine\Utils\TrackFilterListBuilder;
use ParkimeterAffiliates\Tests\Infrastructure\UnitTestCase;
use ParkimeterAffiliates\Tests\Stub\ClickTrackStub;
use ParkimeterAffiliates\Tests\Stub\TraversableStub;

final class GetManyClickTrackServiceTest extends UnitTestCase
{
    /** @var MockInterface|ClickTrackRepository */
    private $clickTrackRepository;

    /** @var MockInterface|ClickTrackRepository */
    private $offsetCalculator;

    /** @var MockInterface|TrackFilterListBuilder */
    private $filterListBuilder;

    /**
     * @var GetManyClickTrackService
     */
    private $getManyClickTrackService;

    protected function setUp()
    {
        parent::setUp();

        $this->clickTrackRepository = $this->mock(ClickTrackRepository::class);
        $this->offsetCalculator = $this->mock(PaginatorOffsetCalculator::class);
        $this->filterListBuilder = $this->mock(TrackFilterListBuilder::class);
        $this->getManyClickTrackService = new GetManyClickTrackService(
            $this->clickTrackRepository,
            $this->offsetCalculator,
            $this->filterListBuilder
        );
    }

    /**
     * @test
     */
    public function itShouldFindAnClickTrackGivenAnClickTrackId()
    {
        $clickTrack = ClickTrackStub::random();
        $clickTrackId = $clickTrack->getId();

        $page = 1;
        $perPage = 1;
        $totalElements = 1;

        $request = new GetManyClickTrackRequest($page, $perPage, null, null, null);
        $response = new GetManyClickTrackResponse(
            [new GetClickTrackResponse(
                $clickTrackId,
                $clickTrack->getAffiliateId(),
                $clickTrack->getAffiliateKey(),
                $clickTrack->getClickId(),
                $clickTrack->getCreatedAt()
            )],
            $page,
            $perPage,
            $totalElements
        );

        $this->shouldCalculateOffset();
        $this->shouldBuildFilterList();
        $this->shouldFindClickTracks($clickTrack);

        $this->assertEquals($response, ($this->getManyClickTrackService)($request));
    }

    /**
     * @param ClickTrack|null $clickTrack
     */
    private function shouldFindClickTracks(?ClickTrack $clickTrack)
    {
        $this->clickTrackRepository
            ->shouldReceive('findAllPaginated')
            ->once()
            ->andReturn(TraversableStub::create([$clickTrack]));
    }

    private function shouldCalculateOffset()
    {
        $this->offsetCalculator
            ->shouldReceive('__invoke')
            ->once();
    }

    private function shouldBuildFilterList()
    {
        $this->filterListBuilder
            ->shouldReceive('__invoke')
            ->once();
    }
}
