<?php

namespace ParkimeterAffiliates\Application\Service\Api\Affiliate\GetAffiliate;

use ParkimeterAffiliates\Application\Service\Api\Affiliate\AffiliateApiException;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\GuardAffiliateNotFound;
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
     * @throws AffiliateApiException
     */
    public function __invoke(GetAffiliateRequest $request): GetAffiliateResponse
    {
        try {
            $result = $this->repository->find($request->affiliateId());

            GuardAffiliateNotFound::guard($result, $request->affiliateId());

            return new GetAffiliateResponse(
                $result->getId(),
                $result->getStatusId(),
                $result->getAffiliateKey(),
                $result->getName(),
                $result->getLastName(),
                $result->getEmail()
            );
        } catch (\Exception $e) {
            throw AffiliateApiException::fromException($e);
        }
    }
}
