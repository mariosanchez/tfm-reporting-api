<?php

namespace ParkimeterAffiliates\Domain\Model\ClickTrack;

class ClickTrack
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
    private $clickId;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var int
     */
    private $createdAtEpoch;

    /**
     * ClickTrack constructor.
     * @param null|int $id
     * @param int $affiliateId
     * @param string $affiliateKey
     * @param string $clickId
     * @param \DateTime $createdAt
     * @param int $createdAtEpoch
     */
    public function __construct(
        ?int $id,
        int $affiliateId,
        string $affiliateKey,
        string $clickId,
        \DateTime $createdAt,
        int $createdAtEpoch
    ) {
        $this->id = $id;
        $this->affiliateId = $affiliateId;
        $this->affiliateKey = $affiliateKey;
        $this->clickId = $clickId;
        $this->createdAt = $createdAt;
        $this->createdAtEpoch = $createdAtEpoch;
    }

    /**
     * @param int|null $id
     * @param int $affiliateId
     * @param string $affiliateKey
     * @param string $clickId
     * @param \DateTime $createdAt
     * @param int $createdAtEpoch
     * @return ClickTrack
     */
    public static function create(
        ?int $id,
        int $affiliateId,
        string $affiliateKey,
        string $clickId,
        \DateTime $createdAt,
        int $createdAtEpoch
    ) {
        return new self(
            $id,
            $affiliateId,
            $affiliateKey,
            $clickId,
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
    public function getClickId(): string
    {
        return $this->clickId;
    }

    /**
     * @param string $clickId
     */
    public function setClickId(string $clickId)
    {
        $this->clickId = $clickId;
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
