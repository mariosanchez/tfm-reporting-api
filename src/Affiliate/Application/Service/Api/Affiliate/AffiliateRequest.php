<?php

namespace ParkimeterAffiliates\Affiliate\Application\Service\Api\Affiliate;

abstract class AffiliateRequest
{
    /**
     * @var string
     */
    private $affiliateId;

    /**
     * @param string|null $affiliateId
     */
    public function __construct(?string $affiliateId)
    {
        $this->affiliateId = (string) $affiliateId;
    }

    /**
     * @return string|null
     */
    public function affiliateId(): ?string
    {
        return $this->affiliateId;
    }
}
