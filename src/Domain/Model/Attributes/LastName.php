<?php

namespace ParkimeterAffiliates\Domain\Model\Attributes;

use Exception;
use Assert\Assertion;
use ParkimeterAffiliates\Domain\Model\AffiliateException;

final class LastName
{
    /**
     * @var string
     */
    private $lastName;

    /**
     * LastName constructor.
     * @param $lastName
     * @throws AffiliateException
     */
    public function __construct($lastName)
    {
        try {
            Assertion::notEmpty($lastName);
        } catch (Exception $e) {
            throw AffiliateException::lastNameIsInvalid($lastName);
        }

        $this->lastName = $lastName;
    }

    /**
     * @param $lastName
     * @return LastName
     */
    public static function fromString($lastName): LastName
    {
        return new self((string) $lastName);
    }

    /**
     * @return null|string
     */
    public function get(): ?string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->lastName;
    }
}
