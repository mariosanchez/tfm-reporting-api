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
     * CancellationTrack constructor.
     * @param int $id
     * @param int $affiliateId
     * @param string $affiliateKey
     * @param string $cancellationId
     * @param \DateTime $createdAt
     */
    public function __construct(
        int $id,
        int $affiliateId,
        string $affiliateKey,
        string $cancellationId,
        \DateTime $createdAt
    ) {
        $this->id = $id;
        $this->affiliateId = $affiliateId;
        $this->affiliateKey = $affiliateKey;
        $this->cancellationId = $cancellationId;
        $this->createdAt = $createdAt;
    }

    public static function create(
        int $id,
        int $affiliateId,
        string $affiliateKey,
        string $cancellationId,
        \DateTime $createdAt
    ) {
        return new self(
            $id,
            $affiliateId,
            $affiliateKey,
            $cancellationId,
            $createdAt
        );
    }

    /**
     * @return int
     */
    public function getId(): int
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
}
