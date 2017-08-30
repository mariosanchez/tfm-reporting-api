<?php

namespace ParkimeterAffiliates\Tests\Unit\Application\Service\Api\Affiliate\GetAffiliate;

use Faker\Factory;
use Mockery\MockInterface;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\AffiliateApiException;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\GetAffiliate\GetAffiliateRequest;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\GetAffiliate\GetAffiliateResponse;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\GetAffiliate\GetAffiliateService;
use ParkimeterAffiliates\Domain\Model\Affiliate\Affiliate;
use ParkimeterAffiliates\Domain\Model\Affiliate\AffiliateRepository;
use ParkimeterAffiliates\Tests\Infrastructure\UnitTestCase;
use ParkimeterAffiliates\Tests\Stub\AffiliateStub;

final class GetAffiliateServiceTest extends UnitTestCase
{
    /** @var MockInterface|AffiliateRepository */
    private $affiliateRepository;

    /**
     * @var GetAffiliateService
     */
    private $getAffiliateService;

    protected function setUp()
    {
        parent::setUp();

        $this->affiliateRepository = $this->mock(AffiliateRepository::class);
        $this->getAffiliateService = new GetAffiliateService($this->affiliateRepository);
    }

    /**
     * @test
     */
    public function itShouldFindAnAffiliateGivenAnAffiliateId()
    {
        $affiliateId = Factory::create()->numberBetween();
        $affiliate = AffiliateStub::random();
        $affiliate->generateAffiliateKey();
        $affiliate->verify();

        $request = new GetAffiliateRequest($affiliateId);
        $response = new GetAffiliateResponse(
            null,
            $affiliate->getStatusId(),
            $affiliate->getAffiliateKey(),
            $affiliate->getName(),
            $affiliate->getLastName(),
            $affiliate->getEmail()
        );

        $this->shouldFindAffiliate($affiliateId, $affiliate);

        $this->assertEquals($response, ($this->getAffiliateService)($request));
    }

    /**
     * @test
     */
    public function itShouldThrowAnExceptionIfTheUserIsDisabled()
    {
        $this->expectException(AffiliateApiException::class);

        $affiliateId = Factory::create()->numberBetween();
        $affiliate = AffiliateStub::random();
        $affiliate->generateAffiliateKey();
        $affiliate->disable();

        $request = new GetAffiliateRequest($affiliateId);

        $this->shouldFindAffiliate($affiliateId, $affiliate);

        ($this->getAffiliateService)($request);
    }

    /**
     * @test
     */
    public function itShouldThrowAnExceptionIfTheUserDoesNotExist()
    {
        $this->expectException(AffiliateApiException::class);

        $affiliateId = Factory::create()->numberBetween();
        $affiliate = null;

        $request = new GetAffiliateRequest($affiliateId);

        $this->shouldFindAffiliate($affiliateId, $affiliate);

        ($this->getAffiliateService)($request);
    }


    /**
     * @param int $id
     * @param Affiliate|null $affiliate
     */
    private function shouldFindAffiliate(int $id, ?Affiliate $affiliate)
    {
        $this->affiliateRepository
            ->shouldReceive('findById')
            ->once()
            ->with(equalTo($id))
            ->andReturn($affiliate);
    }
}
