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
        if ($negated) {
            return "Expected values to be different";
        }
        return "Expected values to be the same";
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
