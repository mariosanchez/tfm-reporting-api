<?php

namespace ParkimeterAffiliates\Tests\Unit\Application\Service\Api\Affiliate\PostAffiliate;

use Mockery\MockInterface;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\AffiliateApiException;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\PostAffiliate\PostAffiliateRequest;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\PostAffiliate\PostAffiliateService;
use ParkimeterAffiliates\Domain\Model\Affiliate\Affiliate;
use ParkimeterAffiliates\Domain\Model\Affiliate\AffiliateRepository;
use ParkimeterAffiliates\Tests\Infrastructure\UnitTestCase;
use ParkimeterAffiliates\Tests\Stub\AffiliateStub;

final class PostAffiliateServiceTest extends UnitTestCase
{
    /** @var MockInterface|AffiliateRepository */
    private $affiliateRepository;

    /**
     * @var PostAffiliateService
     */
    private $postAffiliateService;

    protected function setUp()
    {
        parent::setUp();

        $this->affiliateRepository = $this->mock(AffiliateRepository::class);
        $this->postAffiliateService = new PostAffiliateService($this->affiliateRepository);
    }

    /**
     * @test
     */
    public function itShouldSaveAnAffiliate()
    {
        $affiliate = AffiliateStub::random();

        $request = new PostAffiliateRequest(
            $affiliate->getName(),
            $affiliate->getLastName(),
            $affiliate->getEmail()
        );

        $this->shouldFindAffiliateByEmail(null);
        $this->shouldSaveAffiliate();

        ($this->postAffiliateService)($request);
    }


    /**
     * @test
     */
    public function itShouldThrowAnExceptionIfTheUserAlreadyExists()
    {
        $this->expectException(AffiliateApiException::class);

        $affiliate = AffiliateStub::random();

        $request = new PostAffiliateRequest(
            $affiliate->getName(),
            $affiliate->getLastName(),
            $affiliate->getEmail()
        );

        $this->shouldFindAffiliateByEmail($affiliate);
        $this->shouldSaveAffiliate();

        ($this->postAffiliateService)($request);
    }


    /**
     * @param Affiliate|null $affiliate
     */
    private function shouldFindAffiliateByEmail(?Affiliate $affiliate)
    {
        $this->affiliateRepository
            ->shouldReceive('findOneByColumn')
            ->once()
            ->andReturn($affiliate);
    }

    private function shouldSaveAffiliate()
    {
        $this->affiliateRepository
            ->shouldReceive('save')
            ->once();
    }
}
