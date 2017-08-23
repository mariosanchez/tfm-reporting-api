<?php

namespace ParkimeterAffiliates\Application\Service\Api\Affiliate\PostAffiliate;

use ParkimeterAffiliates\Application\Service\Api\Affiliate\AffiliateApiException;
use ParkimeterAffiliates\Domain\Model\Affiliate\Affiliate;
use ParkimeterAffiliates\Domain\Model\Affiliate\AffiliateException;
use ParkimeterAffiliates\Domain\Model\Affiliate\AffiliateRepository;

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
            $this->prePostGuard($request);

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

    private function prePostGuard(PostAffiliateRequest $request)
    {
        $affiliate = $this->repository->findOneByColumn('email.address', $request->email());
        if (isset($affiliate)) {
            throw AffiliateException::emailIsInvalid($request->email());
        }
    }
}
