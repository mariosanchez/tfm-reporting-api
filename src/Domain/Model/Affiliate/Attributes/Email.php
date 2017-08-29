<?php

namespace ParkimeterAffiliates\Domain\Model\Affiliate\Attributes;

use Exception;
use Assert\Assertion;
use ParkimeterAffiliates\Domain\Model\Affiliate\AffiliateException;

final class Email
{
    /**
     * @var string
     */
    private $address;

    /**
     * Email constructor.
     * @param $address
     * @throws AffiliateException
     */
    public function __construct($address)
    {
        try {
            Assertion::email($address);
            Assertion::notEmpty($address);
        } catch (Exception $e) {
            throw AffiliateException::emailIsInvalid($address);
        }

        $this->address = $address;
    }

    /**
     * @param $email
     * @return Email
     */
    public static function fromString($email): Email
    {
        return new self((string) $email);
    }

    /**
     * @return null|string
     */
    public function get(): ?string
    {
        return $this->address;
    }

    /**
     * @return null|string
     */
    public function getAddress(): ?string
    {
        return $this->get();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->address;
    }
}
