<?php
/**
 * Created by PhpStorm.
 * User: mario
 * Date: 8/08/17
 * Time: 20:32
 */

namespace ParkimeterAffiliates\Domain\Model;

final class Error
{
    private $key;
    private $value;

    public function __construct($key, $value)
    {
        $this->key = (string) $key;
        $this->value = (string) $value;
    }

    public function key(): string
    {
        return $this->key;
    }

    public function value(): ?string
    {
        return $this->value;
    }
}
