<?php

namespace ParkimeterAffiliates\Tests\Stub;

final class TrackRequestFilteredStub
{

    /**
     * @var string
     */
    private $affiliateId;

    /**
     * @var string
     */
    private $fromDate;

    /**
     * @var string
     */
    private $toDate;

    private function __construct(
        ?string $affiliateId,
        ?string $fromDate,
        ?string $toDate
    ) {
        $this->affiliateId = (string) $affiliateId;
        $this->fromDate = (string) $fromDate;
        $this->toDate = (string) $toDate;
    }

    public static function create(
        ?string $affiliateId,
        ?string $fromDate,
        ?string $toDate
    ) {
        return new self($affiliateId, $fromDate, $toDate );
    }


    /**
     * @return string|null
     */
    public function affiliateId(): ?string
    {
        return $this->affiliateId;
    }

    /**
     * @return string|null
     */
    public function fromDate(): ?string
    {
        return $this->fromDate;
    }

    /**
     * @return string|null
     */
    public function toDate(): ?string
    {
        return $this->toDate;
    }
}