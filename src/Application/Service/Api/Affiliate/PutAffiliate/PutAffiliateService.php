<?php

namespace ParkimeterAffiliates\Application\Service\Api\Affiliate\PutAffiliate;

use ParkimeterAffiliates\Application\Service\Api\Affiliate\AffiliateApiException;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\GuardAffiliateNotFound;
use ParkimeterAffiliates\Application\Service\Api\Affiliate\GuardAffiliateDisabled;
use ParkimeterAffiliates\Domain\Model\Affiliate\Affiliate;
use ParkimeterAffiliates\Domain\Model\Affiliate\AffiliateException;
use ParkimeterAffiliates\Domain\Model\Affiliate\AffiliateRepository;
use ParkimeterAffiliates\Domain\Model\Affiliate\Attributes\Email;
use ParkimeterAffiliates\Domain\Model\Affiliate\Attributes\LastName;
use ParkimeterAffiliates\Domain\Model\Affiliate\Attributes\Name;

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
            $this->prePostGuard($request);

            $affiliate = $this->repository->findById($request->affiliateId());

            $this->putGuard($request->affiliateId(), $affiliate);

            $affiliate->setName(Name::fromString($request->name()));
            $affiliate->setLastName(LastName::fromString($request->lastName()));
            $affiliate->setEmail(Email::fromString($request->email()));

            $this->repository->save($affiliate);
        } catch (\Exception $e) {
            throw AffiliateApiException::fromException($e);
        }
    }

    /**
     * @param PutAffiliateRequest $request
     * @throws AffiliateException
     */
    private function prePostGuard(PutAffiliateRequest $request)
    {
        $affiliate = $this->repository->findOneByColumn('email.address', $request->email());
        if (isset($affiliate)) {
            throw AffiliateException::emailIsInvalid($request->email());
        }
    }

    /**
     * @param int $id
     * @param null|Affiliate $affiliate
     */
    private function putGuard(int $id, ?Affiliate $affiliate):void
    {
        GuardAffiliateNotFound::guard($affiliate, $id);
        GuardAffiliateDisabled::guard($affiliate);
    }
}
