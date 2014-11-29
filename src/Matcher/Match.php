<?php
namespace Peridot\Leo\Matcher;

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
     * @return bool
     */
    public function isMatch()
    {
        return $this->match;
    }

    /**
     * @return mixed
     */
    public function getActual()
    {
        return $this->actual;
    }

    /**
     * @return mixed
     */
    public function getExpected()
    {
        return $this->expected;
    }

    /**
     * @return boolean
     */
    public function isNegated()
    {
        return $this->isNegated;
    }
}
