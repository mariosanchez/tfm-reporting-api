<?php

namespace ParkimeterAffiliates\Application\Service\Api\Affiliate\PostAffiliate;

use ParkimeterAffiliates\Application\Service\Api\Affiliate\AffiliateApiException;
use ParkimeterAffiliates\Domain\Model\Affiliate;
use ParkimeterAffiliates\Domain\Model\AffiliateRepository;

final class PostAffiliateService
{
    /**
     * @var AffiliateRepository
     */
    private $repository;

    /**
     * PostAffiliateService constructor
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
     * @param PostAffiliateRequest $request
     * @throws AffiliateApiException
     */
    public function __invoke(PostAffiliateRequest $request)
    {
        try {
            $affiliate = new Affiliate(
                $request->name(),
                $request->lastName(),
                $request->email()
            );

            $affiliate->generateAffiliateKey();
            $affiliate->verify();

            $this->repository->save($affiliate);
        } catch (\Exception $e) {
            throw AffiliateApiException::fromException($e);
        }
    }
}
