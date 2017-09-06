<?php

namespace ParkimeterAffiliates\Tests\Stub;

final class AffiliateRequestFilteredStub
{

    /**
     * @var string
     */
    private $email;

    private function __construct(
        ?string $email
    ) {
        $this->email = (string) $email;
    }

    public static function create(
        ?string $email
    ) {
        return new self($email);
    }


    /**
     * @return string|null
     */
    public function email(): ?string
    {
        return $this->email;
    }
}
