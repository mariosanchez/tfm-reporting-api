<?php

namespace ParkimeterAffiliates\Tests\Unit\Application\Service\Api\CancellationTrack\GetManyCancellationTrack;

use Mockery\MockInterface;
use ParkimeterAffiliates\Application\Service\Api\CancellationTrack\GetCancellationTrack\GetCancellationTrackResponse;
// @codingStandardsIgnoreStart
use ParkimeterAffiliates\Application\Service\Api\CancellationTrack\GetManyCancellationTrack\GetManyCancellationTrackRequest;
use ParkimeterAffiliates\Application\Service\Api\CancellationTrack\GetManyCancellationTrack\GetManyCancellationTrackResponse;
use ParkimeterAffiliates\Application\Service\Api\CancellationTrack\GetManyCancellationTrack\GetManyCancellationTrackService;
// @codingStandardsIgnoreEnd
use ParkimeterAffiliates\Domain\Model\CancellationTrack\CancellationTrack;
use ParkimeterAffiliates\Domain\Model\CancellationTrack\CancellationTrackRepository;
use ParkimeterAffiliates\Infrastructure\Persistence\Repository\Doctrine\Utils\PaginatorOffsetCalculator;
use ParkimeterAffiliates\Infrastructure\Persistence\Repository\Doctrine\Utils\TrackFilterListBuilder;
use ParkimeterAffiliates\Tests\Infrastructure\UnitTestCase;
use ParkimeterAffiliates\Tests\Stub\CancellationTrackStub;
use ParkimeterAffiliates\Tests\Stub\TraversableStub;

final class GetManyCancellationTrackServiceTest extends UnitTestCase
{
    /** @var MockInterface|CancellationTrackRepository */
    private $cancellationTrackRepository;

    /** @var MockInterface|CancellationTrackRepository */
    private $offsetCalculator;

    /** @var MockInterface|TrackFilterListBuilder */
    private $filterListBuilder;

    /**
     * @var GetManyCancellationTrackService
     */
    private $getManyCancellationTrackService;

    protected function setUp()
    {
        parent::setUp();

        $this->cancellationTrackRepository = $this->mock(CancellationTrackRepository::class);
        $this->offsetCalculator = $this->mock(PaginatorOffsetCalculator::class);
        $this->filterListBuilder = $this->mock(TrackFilterListBuilder::class);
        $this->getManyCancellationTrackService = new GetManyCancellationTrackService(
            $this->cancellationTrackRepository,
            $this->offsetCalculator,
            $this->filterListBuilder
        );
    }

    /**
     * @test
     */
    public function itShouldFindAnCancellationTrackGivenAnCancellationTrackId()
    {
        $cancellationTrack = CancellationTrackStub::random();
        $cancellationTrackId = $cancellationTrack->getId();

        $page = 1;
        $perPage = 1;
        $totalElements = 1;

        $request = new GetManyCancellationTrackRequest($page, $perPage, null, null, null);
        $response = new GetManyCancellationTrackResponse(
            [new GetCancellationTrackResponse(
                $cancellationTrackId,
                $cancellationTrack->getAffiliateId(),
                $cancellationTrack->getAffiliateKey(),
                $cancellationTrack->getCancellationId(),
                $cancellationTrack->getCreatedAt()
            )],
            $page,
            $perPage,
            $totalElements
        );

        $this->shouldCalculateOffset();
        $this->shouldBuildFilterList();
        $this->shouldFindCancellationTracks($cancellationTrack);

        $this->assertEquals($response, ($this->getManyCancellationTrackService)($request));
    }

    /**
     * @param CancellationTrack|null $cancellationTrack
     */
    private function shouldFindCancellationTracks(?CancellationTrack $cancellationTrack)
    {
        $this->cancellationTrackRepository
            ->shouldReceive('findAllPaginated')
            ->once()
            ->andReturn(TraversableStub::create([$cancellationTrack]));
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
