<?php

namespace ParkimeterAffiliates\Application\Service\Api\CancellationTrack;

abstract class CancellationTrackRequest
{
    /**
     * @var string
     */
    private $cancellationTrackId;

    /**
     * @param string|null $cancellationTrackId
     */
    public function __construct(?string $cancellationTrackId)
    {
        $this->cancellationTrackId = (string) $cancellationTrackId;
    }

    /**
     * @return string|null
     */
    public function cancellationTrackId(): ?string
    {
        return $this->cancellationTrackId;
    }
}
