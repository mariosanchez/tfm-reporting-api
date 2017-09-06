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
     * @var string
     */
    private $email;

    /**
     * GetManyRequest constructor.
     * @param int|null $page
     * @param int|null $perPage
     * @param string|null $email
     */
    public function __construct(?int $page, ?int $perPage, ?string $email)
    {
        $this->page = (int) $page;
        $this->perPage = (int) $perPage;
        $this->email = (string) $email;
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

    /**
     * @return string|null
     */
    public function email(): ?string
    {
        return $this->email;
    }
}
