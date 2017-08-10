<?php

namespace ParkimeterAffiliates\Application\Service\Api\Affiliate\GetAffiliate;

use ParkimeterAffiliates\Application\Service\Api\Affiliate\AffiliateApiException;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\GuardAffiliateDisabled;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\GuardAffiliateNotFound;
use ParkimeterAffiliates\Domain\Model\Affiliate;
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
            $affiliate = $this->repository->findById($request->affiliateId());

            $this->getGuard($request->affiliateId(), $affiliate);

            return new GetAffiliateResponse(
                $affiliate->getId(),
                $affiliate->getStatusId(),
                $affiliate->getAffiliateKey(),
                $affiliate->getName(),
                $affiliate->getLastName(),
                $affiliate->getEmail()
            );
        } catch (\Exception $e) {
            throw AffiliateApiException::fromException($e);
        }
    }

    /**
     * @param int $id
     * @param Affiliate $affiliate
     */
    private function getGuard(int $id, Affiliate $affiliate):void
    {
        GuardAffiliateNotFound::guard($affiliate, $id);
        GuardAffiliateDisabled::guard($affiliate);
    }
}
