<?php

namespace ParkimeterAffiliates\Tests\Stub;

final class TraversableStub implements \Iterator
{
    /**
     * @var array
     */
    private $elements;

    /**
     * @var int
     */
    private $key;

    /**
     * TraversableStub constructor.
     * @param array $elements
     */
    public function __construct(array $elements)
    {
        $this->key = 0;
        $this->elements = $elements;
    }

    /**
     * @param array $elements
     * @return TraversableStub
     */
    public static function create(array $elements)
    {
        return new self($elements);
    }

    public function current()
    {
        return $this->elements[$this->key];
    }

    public function key()
    {
        return $this->key;
    }

    public function next()
    {
        $this->key++;
    }

    public function rewind()
    {
        $this->key = 0;
    }

    public function valid()
    {
        return $this->key < count($this->elements);
    }
}
