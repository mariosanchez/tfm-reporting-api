<?php

namespace ParkimeterAffiliates\Tests\Unit\Application\Service\Api\Affiliate\GetManyAffiliate;

use Mockery\MockInterface;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\GetAffiliate\GetAffiliateResponse;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\GetManyAffiliate\GetManyAffiliateRequest;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\GetManyAffiliate\GetManyAffiliateResponse;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\GetManyAffiliate\GetManyAffiliateService;
use ParkimeterAffiliates\Domain\Model\Affiliate\Affiliate;
use ParkimeterAffiliates\Domain\Model\Affiliate\AffiliateRepository;
use ParkimeterAffiliates\Infrastructure\Persistence\Repository\Doctrine\Utils\PaginatorOffsetCalculator;
use ParkimeterAffiliates\Tests\Infrastructure\UnitTestCase;
use ParkimeterAffiliates\Tests\Stub\AffiliateStub;
use ParkimeterAffiliates\Tests\Stub\TraversableStub;

final class GetManyAffiliateServiceTest extends UnitTestCase
{
    /** @var MockInterface|AffiliateRepository */
    private $affiliateRepository;

    /** @var MockInterface|AffiliateRepository */
    private $offsetCalculator;

    /**
     * @var GetManyAffiliateService
     */
    private $getManyAffiliateService;

    protected function setUp()
    {
        parent::setUp();

        $this->affiliateRepository = $this->mock(AffiliateRepository::class);
        $this->offsetCalculator = $this->mock(PaginatorOffsetCalculator::class);
        $this->getManyAffiliateService = new GetManyAffiliateService(
            $this->affiliateRepository,
            $this->offsetCalculator
        );
    }

    /**
     * @test
     */
    public function itShouldFindAnAffiliateGivenAnAffiliateId()
    {
        $affiliate = AffiliateStub::random();
        $affiliate->generateAffiliateKey();
        $affiliate->verify();

        $page = 1;
        $perPage = 1;
        $totalElements = 1;

        $request = new GetManyAffiliateRequest($page, $perPage);
        $response = new GetManyAffiliateResponse(
            [new GetAffiliateResponse(
                null,
                $affiliate->getStatusId(),
                $affiliate->getAffiliateKey(),
                $affiliate->getName(),
                $affiliate->getLastName(),
                $affiliate->getEmail()
            )],
            $page,
            $perPage,
            $totalElements
        );

        $this->shouldCalculateOffset();
        $this->shouldFindAffiliates($affiliate);

        $this->assertEquals($response, ($this->getManyAffiliateService)($request));
    }

    /**
     * @param Affiliate|null $affiliate
     */
    private function shouldFindAffiliates(?Affiliate $affiliate)
    {
        $this->affiliateRepository
            ->shouldReceive('findAllPaginated')
            ->once()
            ->andReturn(TraversableStub::create([$affiliate]));
    }

    private function shouldCalculateOffset()
    {
        $this->offsetCalculator
            ->shouldReceive('__invoke')
            ->once();
    }
}
