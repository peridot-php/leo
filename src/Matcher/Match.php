<?php
namespace Peridot\Leo\Matcher;

/**
 * A Match is the result of MatcherInterface::match($actual).
 *
 * @package Peridot\Leo\Matcher
 */
class Match
{
    /**
     * @var bool
     */
    protected $match;

    /**
     * @var mixed
     */
    protected $expected;

    /**
     * @var mixed
     */
    protected $actual;

    /**
     * @var bool
     */
    protected $isNegated;

    /**
     * @param bool $isMatch
     * @param mixed $expected
     * @param mixed $actual
     * @param bool $isNegated
     */
    public function __construct($isMatch, $expected, $actual, $isNegated)
    {
        $this->match = $isMatch;
        $this->expected = $expected;
        $this->actual = $actual;
        $this->isNegated = $isNegated;
    }

    /**
     * Return whether or not a match succeeded.
     *
     * @return bool
     */
    public function isMatch()
    {
        return $this->match;
    }

    /**
     * Get the actual value used in the match.
     *
     * @return mixed
     */
    public function getActual()
    {
        return $this->actual;
    }

    /**
     * Get the expected value used in the match.
     *
     * @return mixed
     */
    public function getExpected()
    {
        return $this->expected;
    }

    /**
     * Returns whether or not the match was negated.
     *
     * @return boolean
     */
    public function isNegated()
    {
        return $this->isNegated;
    }

    /**
     * Set the actual value used in the match.
     *
     * @param mixed $actual
     * @return $this
     */
    public function setActual($actual)
    {
        $this->actual = $actual;
        return $this;
    }

    /**
     * Set the expected value used in the match.
     *
     * @param mixed $expected
     * @return $this
     */
    public function setExpected($expected)
    {
        $this->expected = $expected;
        return $this;
    }
}
