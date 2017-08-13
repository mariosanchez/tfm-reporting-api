<?php

namespace ParkimeterAffiliates\Application\Service\Api\ClickTrack;

abstract class ClickTrackRequest
{
    /**
     * @var string
     */
    private $clickTrackId;

    /**
     * @param string|null $clickTrackId
     */
    public function __construct(?string $clickTrackId)
    {
        $this->clickTrackId = (string) $clickTrackId;
    }

    /**
     * @return string|null
     */
    public function clickTrackId(): ?string
    {
        return $this->clickTrackId;
    }
}
