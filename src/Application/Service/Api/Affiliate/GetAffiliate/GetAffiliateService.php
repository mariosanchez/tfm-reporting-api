<?php

namespace ParkimeterAffiliates\Application\Service\Api\Affiliate\GetAffiliate;

use ParkimeterAffiliates\Domain\Model\AffiliateRepository;

final class GetAffiliateService
{
    /**
     * @var AffiliateRepository
     */
    private $repository;

    /**
     * GetAffiliateService constructor.
     * @param AffiliateRepository $repository
     */
    public function __construct(
        AffiliateRepository $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Returns a affiliate by given data
     *
     * @param GetAffiliateRequest $request
     * @return GetAffiliateResponse
     */
    public function __invoke(GetAffiliateRequest $request): GetAffiliateResponse
    {
        $result = $this->repository->find($request->affiliateId());

        return new GetAffiliateResponse(
            $result->getId(),
            $result->getAffiliateKey(),
            $result->getName(),
            $result->getLastName(),
            $result->getEmail()
        );
    }
}
