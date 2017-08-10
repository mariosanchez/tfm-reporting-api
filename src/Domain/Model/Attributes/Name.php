<?php

namespace ParkimeterAffiliates\Domain\Model\Attributes;

use Exception;
use Assert\Assertion;
use ParkimeterAffiliates\Domain\Model\AffiliateException;

final class Name
{
    /**
     * @var string
     */
    private $name;

    /**
     * Name constructor.
     * @param $name
     * @throws AffiliateException
     */
    public function __construct($name)
    {
        try {
            Assertion::notEmpty($name);
        } catch (Exception $e) {
            throw AffiliateException::nameIsInvalid($name);
        }

        $this->name = $name;
    }

    /**
     * @param $name
     * @return Name
     */
    public static function fromString($name): Name
    {
        return new self((string) $name);
    }

    /**
     * @return null|string
     */
    public function get(): ?string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
