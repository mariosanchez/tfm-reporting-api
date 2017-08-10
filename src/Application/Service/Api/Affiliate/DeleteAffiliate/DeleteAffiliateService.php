<?php

namespace ParkimeterAffiliates\Application\Service\Api\Affiliate\DeleteAffiliate;

use ParkimeterAffiliates\Application\Service\Api\Affiliate\AffiliateApiException;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\GuardAffiliateNotFound;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\GuardAffiliateDisabled;
use ParkimeterAffiliates\Domain\Model\Affiliate;
use ParkimeterAffiliates\Domain\Model\AffiliateRepository;

final class DeleteAffiliateService
{
    /**
     * @var AffiliateRepository
     */
    private $repository;

    /**
     * DeleteAffiliateService constructor
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
     * @param DeleteAffiliateRequest $request
     * @throws AffiliateApiException
     */
    public function __invoke(DeleteAffiliateRequest $request)
    {
        try {
            $affiliate = $this->repository->findById($request->affiliateId());

            $this->deleteGuard($request->affiliateId(), $affiliate);

            $affiliate->disable();

            $this->repository->save($affiliate);
        } catch (\Exception $e) {
            throw AffiliateApiException::fromException($e);
        }
    }

    /**
     * @param int $id
     * @param Affiliate $affiliate
     */
    private function deleteGuard(int $id, Affiliate $affiliate):void
    {
        GuardAffiliateNotFound::guard($affiliate, $id);
        GuardAffiliateDisabled::guard($affiliate);
    }
}
