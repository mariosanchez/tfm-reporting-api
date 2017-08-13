<?php

namespace ParkimeterAffiliates\Application\Service\Api\ConversionTrack;

abstract class ConversionTrackRequest
{
    /**
     * @var string
     */
    private $conversionTrackId;

    /**
     * @param string|null $conversionTrackId
     */
    public function __construct(?string $conversionTrackId)
    {
        $this->conversionTrackId = (string) $conversionTrackId;
    }

    /**
     * @return string|null
     */
    public function conversionTrackId(): ?string
    {
        return $this->conversionTrackId;
    }
}
