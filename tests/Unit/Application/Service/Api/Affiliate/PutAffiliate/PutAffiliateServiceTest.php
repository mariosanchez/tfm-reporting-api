<?php

namespace ParkimeterAffiliates\Tests\Unit\Application\Service\Api\Affiliate\PutAffiliate;

use Faker\Factory;
use Mockery\MockInterface;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\AffiliateApiException;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\PutAffiliate\PutAffiliateRequest;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\PutAffiliate\PutAffiliateService;
use ParkimeterAffiliates\Domain\Model\Affiliate\Affiliate;
use ParkimeterAffiliates\Domain\Model\Affiliate\AffiliateRepository;
use ParkimeterAffiliates\Tests\Infrastructure\UnitTestCase;
use ParkimeterAffiliates\Tests\Stub\AffiliateStub;

final class PutAffiliateServiceTest extends UnitTestCase
{
    /** @var MockInterface|AffiliateRepository */
    private $affiliateRepository;

    /**
     * @var PutAffiliateService
     */
    private $putAffiliateService;

    protected function setUp()
    {
        parent::setUp();

        $this->affiliateRepository = $this->mock(AffiliateRepository::class);
        $this->putAffiliateService = new PutAffiliateService($this->affiliateRepository);
    }

    /**
     * @test
     */
    public function itShouldUpdateAnAffiliate()
    {
        $affiliateId = Factory::create()->numberBetween();
        $affiliate = AffiliateStub::random();

        $request = new PutAffiliateRequest(
            $affiliateId,
            $affiliate->getName(),
            $affiliate->getLastName(),
            $affiliate->getEmail()
        );

        $this->shouldFindAffiliate($affiliateId, $affiliate);
        $this->shouldFindAffiliateByEmail(null);
        $this->shouldSaveAffiliate();

        ($this->putAffiliateService)($request);
    }

    /**
     * @test
     */
    public function itShouldThrowAnExceptionIfTheUserDoesNotExist()
    {
        $this->expectException(AffiliateApiException::class);

        $affiliateId = Factory::create()->numberBetween();
        $affiliate = AffiliateStub::random();

        $request = new PutAffiliateRequest(
            $affiliateId,
            $affiliate->getName(),
            $affiliate->getLastName(),
            $affiliate->getEmail()
        );

        $this->shouldFindAffiliate($affiliateId, $affiliate);

        ($this->putAffiliateService)($request);
    }

    /**
     * @test
     */
    public function itShouldThrowAnExceptionIfTheUserEmailAlreadyExists()
    {
        $this->expectException(AffiliateApiException::class);

        $affiliateId = Factory::create()->numberBetween();
        $affiliate = AffiliateStub::random();

        $request = new PutAffiliateRequest(
            $affiliateId,
            $affiliate->getName(),
            $affiliate->getLastName(),
            $affiliate->getEmail()
        );

        $this->shouldFindAffiliate($affiliateId, $affiliate);
        $this->shouldFindAffiliateByEmail($affiliate);
        $this->shouldSaveAffiliate();

        ($this->putAffiliateService)($request);
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
