<?php

namespace ParkimeterAffiliates\Domain\Model\CancellationTrack;

class CancellationTrack
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $affiliateId;

    /**
     * @var string
     */
    private $affiliateKey;

    /**
     * @var string
     */
    private $cancellationId;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var int
     */
    private $createdAtEpoch;

    /**
     * CancellationTrack constructor.
     * @param null|int $id
     * @param int $affiliateId
     * @param string $affiliateKey
     * @param string $cancellationId
     * @param \DateTime $createdAt
     * @param int $createdAtEpoch
     */
    public function __construct(
        ?int $id,
        int $affiliateId,
        string $affiliateKey,
        string $cancellationId,
        \DateTime $createdAt,
        int $createdAtEpoch
    ) {
        $this->id = $id;
        $this->affiliateId = $affiliateId;
        $this->affiliateKey = $affiliateKey;
        $this->cancellationId = $cancellationId;
        $this->createdAt = $createdAt;
        $this->createdAtEpoch = $createdAtEpoch;
    }

    /**
     * @param int|null $id
     * @param int $affiliateId
     * @param string $affiliateKey
     * @param string $cancellationId
     * @param \DateTime $createdAt
     * @param int $createdAtEpoch
     * @return CancellationTrack
     */
    public static function create(
        ?int $id,
        int $affiliateId,
        string $affiliateKey,
        string $cancellationId,
        \DateTime $createdAt,
        int $createdAtEpoch
    ) {
        return new self(
            $id,
            $affiliateId,
            $affiliateKey,
            $cancellationId,
            $createdAt,
            $createdAtEpoch
        );
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getAffiliateId(): int
    {
        return $this->affiliateId;
    }

    /**
     * @param int $affiliateId
     */
    public function setAffiliateId(int $affiliateId)
    {
        $this->affiliateId = $affiliateId;
    }

    /**
     * @return string
     */
    public function getAffiliateKey(): string
    {
        return $this->affiliateKey;
    }

    /**
     * @param string $affiliateKey
     */
    public function setAffiliateKey(string $affiliateKey)
    {
        $this->affiliateKey = $affiliateKey;
    }

    /**
     * @return string
     */
    public function getCancellationId(): string
    {
        return $this->cancellationId;
    }

    /**
     * @param string $cancellationId
     */
    public function setCancellationId(string $cancellationId)
    {
        $this->cancellationId = $cancellationId;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return int
     */
    public function getCreatedAtEpoch(): int
    {
        return $this->createdAtEpoch;
    }

    /**
     * @param int $createdAtEpoch
     */
    public function setCreatedAtEpoch(int $createdAtEpoch)
    {
        $this->createdAtEpoch = $createdAtEpoch;
    }
}
