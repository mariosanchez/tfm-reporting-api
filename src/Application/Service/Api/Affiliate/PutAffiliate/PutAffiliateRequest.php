<?php

namespace ParkimeterAffiliates\Application\Service\Api\Affiliate\PutAffiliate;

use ParkimeterAffiliates\Application\Service\Api\Affiliate\AffiliateRequest;

class PutAffiliateRequest extends AffiliateRequest
{
    private $name;
    private $lastName;
    private $email;

    /**
     * PutAffiliateRequest constructor.
     * @param null|string $affiliateId
     * @param null|string $name
     * @param null|string $lastName
     * @param null|string $email
     */
    public function __construct(
        ?string $affiliateId,
        ?string $name,
        ?string $lastName,
        ?string $email
    ) {
        parent::__construct($affiliateId);
        $this->name = (string) $name;
        $this->lastName = (string) $lastName;
        $this->email = (string) $email;
    }

    /**
     * @return null|string
     */
    public function name(): ?string
    {
        return $this->name;
    }

    /**
     * @return null|string
     */
    public function lastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @return null|string
     */
    public function email(): ?string
    {
        return $this->email;
    }
}
