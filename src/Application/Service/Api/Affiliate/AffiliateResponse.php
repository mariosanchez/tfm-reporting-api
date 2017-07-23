<?php

namespace ParkimeterAffiliates\Application\Service\Api\Affiliate;

abstract class AffiliateResponse
{
    /** @var string */
    protected $affiliateId;

    /** @var string */
    protected $affiliateKey;

    /** @var string */
    protected $name;

    /** @var string */
    protected $lastName;

    /** @var string */
    protected $email;

    /**
     * EmployerResponse constructor.
     * @param string|null $affiliateId
     * @param string|null $affiliateKey
     * @param string|null $name
     * @param string|null $lastName
     * @param string|null $email
     */
    public function __construct(
        ?string $affiliateId,
        ?string $affiliateKey,
        ?string $name,
        ?string $lastName,
        ?string $email
    ) {
        $this->affiliateId = $affiliateId;
        $this->affiliateKey = $affiliateKey;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function affiliateId(): ?string
    {
        return $this->affiliateId;
    }

    /**
     * @return string
     */
    public function affiliateKey(): ?string
    {
        return $this->affiliateKey;
    }

    /**
     * @return string
     */
    public function name(): ?string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function lastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @return string|null
     */
    public function email(): ?string
    {
        return $this->email;
    }
}
