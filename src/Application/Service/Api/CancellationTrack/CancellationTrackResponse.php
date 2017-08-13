<?php

namespace ParkimeterAffiliates\Application\Service\Api\CancellationTrack;

abstract class CancellationTrackResponse
{
    /** @var string */
    protected $cancellationTrackId;

    /** @var string */
    protected $affiliateId;

    /** @var string */
    protected $affiliateKey;

    /** @var string */
    protected $cancellationId;

    /** @var \DateTime */
    protected $cratedAt;

    /**
     * CancellationTrackResponse constructor.
     * @param null|string $cancellationTrackId
     * @param null|string $affiliateId
     * @param null|string $affiliateKey
     * @param null|string $cancellationId
     * @param \DateTime|null $cratedAt
     */
    public function __construct(
        ?string $cancellationTrackId,
        ?string $affiliateId,
        ?string $affiliateKey,
        ?string $cancellationId,
        ?\DateTime $cratedAt
    ) {
        $this->cancellationTrackId = $cancellationTrackId;
        $this->affiliateId = $affiliateId;
        $this->affiliateKey = $affiliateKey;
        $this->cancellationId = $cancellationId;
        $this->cratedAt = $cratedAt;
    }

    /**
     * @return string|null
     */
    public function cancellationTrackId(): ?string
    {
        return $this->cancellationTrackId;
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
    public function cancellationId(): ?string
    {
        return $this->cancellationId;
    }

    /**
     * @return \DateTime
     */
    public function cratedAt(): ?\DateTime
    {
        return $this->cratedAt;
    }
}
