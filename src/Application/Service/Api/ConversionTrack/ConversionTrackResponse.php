<?php

namespace ParkimeterAffiliates\Application\Service\Api\ConversionTrack;

abstract class ConversionTrackResponse
{
    /** @var string */
    protected $conversionTrackId;

    /** @var string */
    protected $affiliateId;

    /** @var string */
    protected $affiliateKey;

    /** @var string */
    protected $conversionId;

    /** @var \DateTime */
    protected $createdAt;

    /**
     * ConversionTrackResponse constructor.
     * @param null|string $conversionTrackId
     * @param null|string $affiliateId
     * @param null|string $affiliateKey
     * @param null|string $conversionId
     * @param \DateTime|null $createdAt
     */
    public function __construct(
        ?string $conversionTrackId,
        ?string $affiliateId,
        ?string $affiliateKey,
        ?string $conversionId,
        ?\DateTime $createdAt
    ) {
        $this->conversionTrackId = $conversionTrackId;
        $this->affiliateId = $affiliateId;
        $this->affiliateKey = $affiliateKey;
        $this->conversionId = $conversionId;
        $this->createdAt = $createdAt;
    }

    /**
     * @return string|null
     */
    public function conversionTrackId(): ?string
    {
        return $this->conversionTrackId;
    }

    /**
     * @return int
     */
    public function affiliateId(): ?int
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
    public function conversionId(): ?string
    {
        return $this->conversionId;
    }

    /**
     * @return \DateTime
     */
    public function createdAt(): ?\DateTime
    {
        return $this->createdAt;
    }
}
