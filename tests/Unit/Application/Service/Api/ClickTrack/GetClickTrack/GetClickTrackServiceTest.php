<?php

namespace ParkimeterAffiliates\Tests\Unit\Application\Service\Api\ClickTrack\GetClickTrack;

use Faker\Factory;
use Mockery\MockInterface;
use ParkimeterAffiliates\Application\Service\Api\ClickTrack\ClickTrackApiException;
use ParkimeterAffiliates\Application\Service\Api\ClickTrack\GetClickTrack\GetClickTrackRequest;
use ParkimeterAffiliates\Application\Service\Api\ClickTrack\GetClickTrack\GetClickTrackResponse;
use ParkimeterAffiliates\Application\Service\Api\ClickTrack\GetClickTrack\GetClickTrackService;
use ParkimeterAffiliates\Domain\Model\ClickTrack\ClickTrack;
use ParkimeterAffiliates\Domain\Model\ClickTrack\ClickTrackRepository;
use ParkimeterAffiliates\Tests\Infrastructure\UnitTestCase;
use ParkimeterAffiliates\Tests\Stub\ClickTrackStub;

final class GetClickTrackServiceTest extends UnitTestCase
{
    /** @var MockInterface|ClickTrackRepository */
    private $clickTrackRepository;

    /**
     * @var GetClickTrackService
     */
    private $getClickTrackService;

    protected function setUp()
    {
        parent::setUp();

        $this->clickTrackRepository = $this->mock(ClickTrackRepository::class);
        $this->getClickTrackService = new GetClickTrackService($this->clickTrackRepository);
    }

    /**
     * @test
     */
    public function itShouldFindAClickTrackGivenAnClickTrackId()
    {
        $clickTrack = ClickTrackStub::random();
        $clickTrackId = $clickTrack->getId();

        $request = new GetClickTrackRequest($clickTrackId);
        $response = new GetClickTrackResponse(
            $clickTrackId,
            $clickTrack->getAffiliateId(),
            $clickTrack->getAffiliateKey(),
            $clickTrack->getClickId(),
            $clickTrack->getCreatedAt()
        );

        $this->shouldFindClickTrack($clickTrackId, $clickTrack);

        $this->assertEquals($response, ($this->getClickTrackService)($request));
    }

    /**
     * @test
     */
    public function itShouldThrowAnExceptionIfTheUserDoesNotExist()
    {
        $this->expectException(ClickTrackApiException::class);

        $clickTrackId = Factory::create()->numberBetween();
        $clickTrack = null;

        $request = new GetClickTrackRequest($clickTrackId);

        $this->shouldFindClickTrack($clickTrackId, $clickTrack);

        ($this->getClickTrackService)($request);
    }


    /**
     * @param int $id
     * @param ClickTrack|null $clickTrack
     */
    private function shouldFindClickTrack(int $id, ?ClickTrack $clickTrack)
    {
        $this->clickTrackRepository
            ->shouldReceive('findById')
            ->once()
            ->with(equalTo($id))
            ->andReturn($clickTrack);
    }
}
