<?php

namespace ParkimeterAffiliates\Tests\Unit\Application\Service\Api\ConversionTrack\GetManyConversionTrack;

use Mockery\MockInterface;
use ParkimeterAffiliates\Application\Service\Api\ConversionTrack\GetConversionTrack\GetConversionTrackResponse;
use ParkimeterAffiliates\Application\Service\Api\ConversionTrack\GetManyConversionTrack\GetManyConversionTrackRequest;
use ParkimeterAffiliates\Application\Service\Api\ConversionTrack\GetManyConversionTrack\GetManyConversionTrackResponse;
use ParkimeterAffiliates\Application\Service\Api\ConversionTrack\GetManyConversionTrack\GetManyConversionTrackService;
use ParkimeterAffiliates\Domain\Model\ConversionTrack\ConversionTrack;
use ParkimeterAffiliates\Domain\Model\ConversionTrack\ConversionTrackRepository;
use ParkimeterAffiliates\Infrastructure\Persistence\Repository\Doctrine\Utils\PaginatorOffsetCalculator;
use ParkimeterAffiliates\Infrastructure\Persistence\Repository\Doctrine\Utils\TrackFilterListBuilder;
use ParkimeterAffiliates\Tests\Infrastructure\UnitTestCase;
use ParkimeterAffiliates\Tests\Stub\ConversionTrackStub;
use ParkimeterAffiliates\Tests\Stub\TraversableStub;

final class GetManyConversionTrackServiceTest extends UnitTestCase
{
    /** @var MockInterface|ConversionTrackRepository */
    private $conversionTrackRepository;

    /** @var MockInterface|ConversionTrackRepository */
    private $offsetCalculator;

    /** @var MockInterface|TrackFilterListBuilder */
    private $filterListBuilder;

    /**
     * @var GetManyConversionTrackService
     */
    private $getManyConversionTrackService;

    protected function setUp()
    {
        parent::setUp();

        $this->conversionTrackRepository = $this->mock(ConversionTrackRepository::class);
        $this->offsetCalculator = $this->mock(PaginatorOffsetCalculator::class);
        $this->filterListBuilder = $this->mock(TrackFilterListBuilder::class);
        $this->getManyConversionTrackService = new GetManyConversionTrackService(
            $this->conversionTrackRepository,
            $this->offsetCalculator,
            $this->filterListBuilder
        );
    }

    /**
     * @test
     */
    public function itShouldFindAnConversionTrackGivenAnConversionTrackId()
    {
        $conversionTrack = ConversionTrackStub::random();
        $conversionTrackId = $conversionTrack->getId();

        $page = 1;
        $perPage = 1;
        $totalElements = 1;

        $request = new GetManyConversionTrackRequest($page, $perPage, null, null, null);
        $response = new GetManyConversionTrackResponse(
            [new GetConversionTrackResponse(
                $conversionTrackId,
                $conversionTrack->getAffiliateId(),
                $conversionTrack->getAffiliateKey(),
                $conversionTrack->getConversionId(),
                $conversionTrack->getCreatedAt()
            )],
            $page,
            $perPage,
            $totalElements
        );

        $this->shouldCalculateOffset();
        $this->shouldBuildFilterList();
        $this->shouldFindConversionTracks($conversionTrack);

        $this->assertEquals($response, ($this->getManyConversionTrackService)($request));
    }

    /**
     * @param ConversionTrack|null $conversionTrack
     */
    private function shouldFindConversionTracks(?ConversionTrack $conversionTrack)
    {
        $this->conversionTrackRepository
            ->shouldReceive('findAllPaginated')
            ->once()
            ->andReturn(TraversableStub::create([$conversionTrack]));
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
