<?php

namespace ParkimeterAffiliates\Domain\Model\Attributes;

use Exception;
use Assert\Assertion;
use ParkimeterAffiliates\Domain\Model\AffiliateException;

class Email
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
     * @return string
     */
    public function __toString()
    {
        return $this->address;
    }
}
