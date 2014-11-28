<?php
namespace Peridot\Leo\Matcher;

class SameMatcher 
{
    /**
     * @var mixed
     */
    protected $expected;

    /**
     * @var bool
     */
    protected $negated = false;

    /**
     * @param mixed $expected
     */
    public function __construct($expected)
    {
        $this->expected = $expected;
    }

    /**
     * @param mixed $actual
     * @return bool
     */
    public function match($actual)
    {
        $match = $this->expected === $actual;
        if ($this->isNegated()) {
            return !$match;
        }
        return $match;
    }

    /**
     * @return bool
     */
    public function isNegated()
    {
        return $this->negated;
    }

    /**
     * @return $this
     */
    public function invert()
    {
        $this->negated = !$this->negated;
        return $this;
    }
} 
