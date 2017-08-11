<?php

namespace ParkimeterAffiliates\Application\Service\Api\Affiliate\GetManyAffiliate;

class GetManyAffiliateRequest
{
    /**
     * @var int
     */
    private $page;

    /**
     * @var int
     */
    private $perPage;

    /**
     * GetManyRequest constructor.
     * @param int|null $page
     * @param int|null $perPage
     */
    public function __construct(?int $page, ?int $perPage)
    {
        $this->page = (int) $page;
        $this->perPage = (int) $perPage;
    }

    /**
     * @return int|null
     */
    public function page(): ?int
    {
        return $this->page;
    }

    /**
     * @return int|null
     */
    public function perPage(): ?int
    {
        return $this->perPage;
    }
}
