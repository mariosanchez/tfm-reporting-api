<?php

namespace ParkimeterAffiliates\Domain\Model\ConversionTrack;

class ConversionTrack
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
    private $conversionId;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * ConversionTrack constructor.
     * @param int $id
     * @param int $affiliateId
     * @param string $affiliateKey
     * @param string $conversionId
     * @param \DateTime $createdAt
     */
    public function __construct(
        int $id,
        int $affiliateId,
        string $affiliateKey,
        string $conversionId,
        \DateTime $createdAt
    ) {
        $this->id = $id;
        $this->affiliateId = $affiliateId;
        $this->affiliateKey = $affiliateKey;
        $this->conversionId = $conversionId;
        $this->createdAt = $createdAt;
    }

    public static function create(
        int $id,
        int $affiliateId,
        string $affiliateKey,
        string $conversionId,
        \DateTime $createdAt
    ) {
        return new self(
            $id,
            $affiliateId,
            $affiliateKey,
            $conversionId,
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
    public function getConversionId(): string
    {
        return $this->conversionId;
    }

    /**
     * @param string $conversionId
     */
    public function setConversionId(string $conversionId)
    {
        $this->conversionId = $conversionId;
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
