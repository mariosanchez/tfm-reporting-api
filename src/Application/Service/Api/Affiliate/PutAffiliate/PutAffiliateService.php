<?php

namespace ParkimeterAffiliates\Application\Service\Api\Affiliate\PutAffiliate;

use ParkimeterAffiliates\Application\Service\Api\Affiliate\AffiliateApiException;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\GuardAffiliateNotFound;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\GuardAffiliateDisabled;
use ParkimeterAffiliates\Domain\Model\AffiliateRepository;
use ParkimeterAffiliates\Domain\Model\Attributes\Email;
use ParkimeterAffiliates\Domain\Model\Attributes\LastName;
use ParkimeterAffiliates\Domain\Model\Attributes\Name;

final class PutAffiliateService
{
    /**
     * @var AffiliateRepository
     */
    private $repository;

    /**
     * PutAffiliateService constructor
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
     * @param PutAffiliateRequest $request
     * @throws AffiliateApiException
     */
    public function __invoke(PutAffiliateRequest $request)
    {
        try {
            $affiliate = $this->repository->find($request->affiliateId());

            GuardAffiliateNotFound::guard($affiliate, $request->affiliateId());
            GuardAffiliateDisabled::guard($affiliate);

            $affiliate->setName(Name::fromString($request->name()));
            $affiliate->setLastName(LastName::fromString($request->lastName()));
            $affiliate->setEmail(Email::fromString($request->email()));

            $this->repository->save($affiliate);
        } catch (\Exception $e) {
            throw AffiliateApiException::fromException($e);
        }
    }
}
