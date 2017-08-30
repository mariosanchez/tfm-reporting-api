<?php

namespace ParkimeterAffiliates\Tests\Unit\Application\Service\Api\ConversionTrack\GetConversionTrack;

use Faker\Factory;
use Mockery\MockInterface;
use ParkimeterAffiliates\Application\Service\Api\ConversionTrack\ConversionTrackApiException;
use ParkimeterAffiliates\Application\Service\Api\ConversionTrack\GetConversionTrack\GetConversionTrackRequest;
use ParkimeterAffiliates\Application\Service\Api\ConversionTrack\GetConversionTrack\GetConversionTrackResponse;
use ParkimeterAffiliates\Application\Service\Api\ConversionTrack\GetConversionTrack\GetConversionTrackService;
use ParkimeterAffiliates\Domain\Model\ConversionTrack\ConversionTrack;
use ParkimeterAffiliates\Domain\Model\ConversionTrack\ConversionTrackRepository;
use ParkimeterAffiliates\Tests\Infrastructure\UnitTestCase;
use ParkimeterAffiliates\Tests\Stub\ConversionTrackStub;

final class GetConversionTrackServiceTest extends UnitTestCase
{
    /** @var MockInterface|ConversionTrackRepository */
    private $conversionTrackRepository;

    /**
     * @var GetConversionTrackService
     */
    private $getConversionTrackService;

    protected function setUp()
    {
        parent::setUp();

        $this->conversionTrackRepository = $this->mock(ConversionTrackRepository::class);
        $this->getConversionTrackService = new GetConversionTrackService($this->conversionTrackRepository);
    }

    /**
     * @test
     */
    public function itShouldFindAConversionTrackGivenAnConversionTrackId()
    {
        $conversionTrack = ConversionTrackStub::random();
        $conversionTrackId = $conversionTrack->getId();

        $request = new GetConversionTrackRequest($conversionTrackId);
        $response = new GetConversionTrackResponse(
            $conversionTrackId,
            $conversionTrack->getAffiliateId(),
            $conversionTrack->getAffiliateKey(),
            $conversionTrack->getConversionId(),
            $conversionTrack->getCreatedAt()
        );

        $this->shouldFindConversionTrack($conversionTrackId, $conversionTrack);

        $this->assertEquals($response, ($this->getConversionTrackService)($request));
    }

    /**
     * @test
     */
    public function itShouldThrowAnExceptionIfTheUserDoesNotExist()
    {
        $this->expectException(ConversionTrackApiException::class);

        $conversionTrackId = Factory::create()->numberBetween();
        $conversionTrack = null;

        $request = new GetConversionTrackRequest($conversionTrackId);

        $this->shouldFindConversionTrack($conversionTrackId, $conversionTrack);

        ($this->getConversionTrackService)($request);
    }


    /**
     * @param int $id
     * @param ConversionTrack|null $conversionTrack
     */
    private function shouldFindConversionTrack(int $id, ?ConversionTrack $conversionTrack)
    {
        $this->conversionTrackRepository
            ->shouldReceive('findById')
            ->once()
            ->with(equalTo($id))
            ->andReturn($conversionTrack);
    }
}
