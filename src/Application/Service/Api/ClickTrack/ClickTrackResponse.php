<?php

namespace ParkimeterAffiliates\Application\Service\Api\ClickTrack;

abstract class ClickTrackResponse
{
    /** @var string */
    protected $clickTrackId;

    /** @var string */
    protected $affiliateId;

    /** @var string */
    protected $affiliateKey;

    /** @var string */
    protected $clickId;

    /** @var \DateTime */
    protected $cratedAt;

    /**
     * ClickTrackResponse constructor.
     * @param null|string $clickTrackId
     * @param null|string $affiliateId
     * @param null|string $affiliateKey
     * @param null|string $clickId
     * @param \DateTime|null $cratedAt
     */
    public function __construct(
        ?string $clickTrackId,
        ?string $affiliateId,
        ?string $affiliateKey,
        ?string $clickId,
        ?\DateTime $cratedAt
    ) {
        $this->clickTrackId = $clickTrackId;
        $this->affiliateId = $affiliateId;
        $this->affiliateKey = $affiliateKey;
        $this->clickId = $clickId;
        $this->cratedAt = $cratedAt;
    }

    /**
     * @return string|null
     */
    public function clickTrackId(): ?string
    {
        return $this->clickTrackId;
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
    public function clickId(): ?string
    {
        return $this->clickId;
    }

    /**
     * @return \DateTime
     */
    public function cratedAt(): ?\DateTime
    {
        return $this->cratedAt;
    }
}
