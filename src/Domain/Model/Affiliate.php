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
    const AFFILIATE_STATUS_DISABLED = 0;

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
     * @var Name
     */
    private $name;

    /**
     * @var LastName
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
        $this->createdAt = new \DateTimeImmutable('now');
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
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeImmutable $createdAt
     */
    public function setCreatedAt(\DateTimeImmutable $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeImmutable $updatedAt
     */
    public function setUpdatedAt(\DateTimeImmutable $updatedAt)
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
        $this->setUpdatedAt(new \DateTimeImmutable('now'));
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

    public function disable()
    {
        $this->statusId = self::AFFILIATE_STATUS_DISABLED;
    }

    /**
     * @return bool
     */
    public function isDisabled(): bool
    {
        return $this->statusId === self::AFFILIATE_STATUS_DISABLED;
    }
}
