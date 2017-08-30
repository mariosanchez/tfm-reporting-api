<?php

namespace ParkimeterAffiliates\Infrastructure\Persistence\Repository\Doctrine\Utils;

class TrackFilter
{
    /**
     * @var string $value
     */
    private $value;

    /**
     * @var string $query
     */
    private $query;

    /**
     * TrackFilter constructor.
     * @param string $value
     * @param string $query
     */
    public function __construct(string $value, string $query)
    {
        $this->value = (string) $value;
        $this->query = (string) $query;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function query(): string
    {
        return $this->query;
    }
}
