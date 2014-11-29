<?php
namespace Peridot\Leo\Matcher;

abstract class AbstractMatcher
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

    /**
     * @param $actual
     * @return Match
     */
    public function match($actual)
    {
        $isMatch = $this->doMatch($actual);
        if ($this->isNegated()) {
            $isMatch = !$isMatch;
        }
        return new Match($isMatch, $this->expected, $actual, $this->isNegated());
    }

    /**
     * The actual matching algorithm for the matcher.
     *
     * @param $actual
     * @return mixed
     */
    abstract protected function doMatch($actual);
} 
