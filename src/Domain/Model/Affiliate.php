<?php

namespace ParkimeterAffiliates\Domain\Model;

use ParkimeterAffiliates\Domain\Model\Attributes\Email;
use ParkimeterAffiliates\Domain\Model\Attributes\LastName;
use ParkimeterAffiliates\Domain\Model\Attributes\Name;

/**
 * Affiliate
 */
class Affiliate
{
    const AFFILIATE_STATUS_ENABLED = 1;

    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $statusId;

    /**
     * @var string
     */
    private $affiliateKey;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var Email
     */
    private $email;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    public function __construct(
        string $name,
        string $lastName,
        string $email
    ) {
        $this->setName(Name::fromString($name));
        $this->setLastName(LastName::fromString($lastName));
        $this->setEmail(Email::fromString($email));
        $this->createdAt = new \DateTime('now');
        $this->updatedAt = $this->createdAt;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAffiliateKey(): ?string
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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param Name $name
     */
    public function setName(Name $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param LastName $lastName
     */
    public function setLastName(LastName $lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return Email
     */
    public function getEmail(): ?Email
    {
        return $this->email;
    }

    /**
     * @param Email $email
     */
    public function setEmail(Email $email)
    {
        $this->email = $email;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): ?\DateTime
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
     * @return \DateTime
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return int
     */
    public function getStatusId(): int
    {
        return $this->statusId;
    }

    /**
     * Updates updatedAt value on update
     */
    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new \DateTime('now'));
    }

    /**
     * Generates the affiliate key hashing a given word (by default the email combined with current microtime)
     *
     * @param string|null $word
     */
    public function generateAffiliateKey(string $word = null)
    {
        $this->affiliateKey = hash(
            'sha256',
            isset($word) ? $word : $this->email . microtime()
        );
    }

    public function verify()
    {
        $this->statusId = self::AFFILIATE_STATUS_ENABLED;
    }
}
