<?php
namespace Peridot\Leo\Matcher;

/**
 * @package Peridot\Leo\Matcher
 */
class EqualMatcher extends AbstractBaseMatcher
{
    /**
     * {@inheritdoc}
     *
     * @param mixed $expected the expected value
     * @param mixed $actual the actual value
     * @param bool $negated weather the assertion has been negated
     * @return string
     */
    public function getMessage($expected, $actual, $negated = false)
    {
        $expected = $this->formatter->format($expected);
        $actual = $this->formatter->format($actual);
        if ($negated) {
            return "Expected $expected not to equal $actual";
        }
        return "Expected $expected, got $actual";
    }

    /**
     * {@inheritdoc}
     *
     * @param mixed $expected
     * @return bool
     */
    public function isMatch($expected)
    {
        return $this->getActual() === $expected;
    }
}
