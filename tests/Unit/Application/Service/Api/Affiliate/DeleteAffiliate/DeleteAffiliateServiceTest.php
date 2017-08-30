<?php

namespace ParkimeterAffiliates\Tests\Unit\Application\Service\Api\Affiliate\DeleteAffiliate;

use Faker\Factory;
use Mockery\MockInterface;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\AffiliateApiException;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\DeleteAffiliate\DeleteAffiliateRequest;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\DeleteAffiliate\DeleteAffiliateService;
use ParkimeterAffiliates\Domain\Model\Affiliate\Affiliate;
use ParkimeterAffiliates\Domain\Model\Affiliate\AffiliateRepository;
use ParkimeterAffiliates\Tests\Infrastructure\UnitTestCase;
use ParkimeterAffiliates\Tests\Stub\AffiliateStub;

final class DeleteAffiliateServiceTest extends UnitTestCase
{
    /** @var MockInterface|AffiliateRepository */
    private $affiliateRepository;

    /**
     * @var DeleteAffiliateService
     */
    private $deleteAffiliateService;

    protected function setUp()
    {
        parent::setUp();

        $this->affiliateRepository = $this->mock(AffiliateRepository::class);
        $this->deleteAffiliateService = new DeleteAffiliateService($this->affiliateRepository);
    }

    /**
     * @test
     */
    public function itShouldDeleteAnAffiliate()
    {
        $affiliateId = Factory::create()->numberBetween();
        $affiliate = AffiliateStub::random();

        $request = new DeleteAffiliateRequest($affiliateId);

        $this->shouldFindAffiliate($affiliateId, $affiliate);
        $this->shouldSaveAffiliate();

        ($this->deleteAffiliateService)($request);
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

        $request = new DeleteAffiliateRequest($affiliateId);

        $this->shouldFindAffiliate($affiliateId, $affiliate);

        ($this->deleteAffiliateService)($request);
    }

    /**
     * @test
     */
    public function itShouldThrowAnExceptionIfTheUserDoesNotExist()
    {
        $this->expectException(AffiliateApiException::class);

        $affiliateId = Factory::create()->numberBetween();
        $affiliate = AffiliateStub::random();

        $request = new DeleteAffiliateRequest($affiliateId);

        $this->shouldFindAffiliate($affiliateId, $affiliate);

        ($this->deleteAffiliateService)($request);
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

    private function shouldSaveAffiliate()
    {
        $this->affiliateRepository
            ->shouldReceive('save')
            ->once();
    }
}
