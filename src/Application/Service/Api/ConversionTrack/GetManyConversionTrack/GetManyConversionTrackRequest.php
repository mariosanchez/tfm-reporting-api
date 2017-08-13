<?php

namespace ParkimeterAffiliates\Application\Service\Api\ConversionTrack\GetManyConversionTrack;

class GetManyConversionTrackRequest
{
    /**
     * @var int
     */
    private $page;

    /**
     * @var int
     */
    private $perPage;

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

    /**
     * GetManyRequest constructor.
     * @param int|null $page
     * @param int|null $perPage
     * @param string|null $affiliateId
     * @param string|null $fromDate
     * @param string|null $toDate
     */
    public function __construct(
        ?int $page,
        ?int $perPage,
        ?string $affiliateId,
        ?string $fromDate,
        ?string $toDate
    ) {
        $this->page = (int) $page;
        $this->perPage = (int) $perPage;
        $this->affiliateId = (string) $affiliateId;
        $this->fromDate = (string) $fromDate;
        $this->toDate = (string) $toDate;
    }

    /**
     * @return int|null
     */
    public function page(): ?int
    {
        return $this->page;
    }

    /**
     * @return int|null
     */
    public function perPage(): ?int
    {
        return $this->perPage;
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
