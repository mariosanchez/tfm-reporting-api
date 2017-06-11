<?php

namespace ParkimeterAffiliates\Affiliate\Application\Service;

use ParkimeterAffiliates\Affiliate\Domain\Model\AffiliateRepository;

class GetAffiliateService
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
     * @param $data
     * @return mixed
     */
    public function __invoke($data)
    {

        return $this->repository->find($data['id']);
    }
}
