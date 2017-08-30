<?php

namespace ParkimeterAffiliates\Tests\Unit\Application\Service\Api\CancellationTrack\GetCancellationTrack;

use Faker\Factory;
use Mockery\MockInterface;
use ParkimeterAffiliates\Application\Service\Api\CancellationTrack\CancellationTrackApiException;
use ParkimeterAffiliates\Application\Service\Api\CancellationTrack\GetCancellationTrack\GetCancellationTrackRequest;
use ParkimeterAffiliates\Application\Service\Api\CancellationTrack\GetCancellationTrack\GetCancellationTrackResponse;
use ParkimeterAffiliates\Application\Service\Api\CancellationTrack\GetCancellationTrack\GetCancellationTrackService;
use ParkimeterAffiliates\Domain\Model\CancellationTrack\CancellationTrack;
use ParkimeterAffiliates\Domain\Model\CancellationTrack\CancellationTrackRepository;
use ParkimeterAffiliates\Tests\Infrastructure\UnitTestCase;
use ParkimeterAffiliates\Tests\Stub\CancellationTrackStub;

final class GetCancellationTrackServiceTest extends UnitTestCase
{
    /** @var MockInterface|CancellationTrackRepository */
    private $cancellationTrackRepository;

    /**
     * @var GetCancellationTrackService
     */
    private $getCancellationTrackService;

    protected function setUp()
    {
        parent::setUp();

        $this->cancellationTrackRepository = $this->mock(CancellationTrackRepository::class);
        $this->getCancellationTrackService = new GetCancellationTrackService($this->cancellationTrackRepository);
    }

    /**
     * @test
     */
    public function itShouldFindACancellationTrackGivenAnCancellationTrackId()
    {
        $cancellationTrack = CancellationTrackStub::random();
        $cancellationTrackId = $cancellationTrack->getId();

        $request = new GetCancellationTrackRequest($cancellationTrackId);
        $response = new GetCancellationTrackResponse(
            $cancellationTrackId,
            $cancellationTrack->getAffiliateId(),
            $cancellationTrack->getAffiliateKey(),
            $cancellationTrack->getCancellationId(),
            $cancellationTrack->getCreatedAt()
        );

        $this->shouldFindCancellationTrack($cancellationTrackId, $cancellationTrack);

        $this->assertEquals($response, ($this->getCancellationTrackService)($request));
    }

    /**
     * @test
     */
    public function itShouldThrowAnExceptionIfTheUserDoesNotExist()
    {
        $this->expectException(CancellationTrackApiException::class);

        $cancellationTrackId = Factory::create()->numberBetween();
        $cancellationTrack = null;

        $request = new GetCancellationTrackRequest($cancellationTrackId);

        $this->shouldFindCancellationTrack($cancellationTrackId, $cancellationTrack);

        ($this->getCancellationTrackService)($request);
    }


    /**
     * @param int $id
     * @param CancellationTrack|null $cancellationTrack
     */
    private function shouldFindCancellationTrack(int $id, ?CancellationTrack $cancellationTrack)
    {
        $this->cancellationTrackRepository
            ->shouldReceive('findById')
            ->once()
            ->with(equalTo($id))
            ->andReturn($cancellationTrack);
    }
}
