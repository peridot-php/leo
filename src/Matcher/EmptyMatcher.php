<?php
namespace Peridot\Leo\Matcher;

/**
 * @package Peridot\Leo\Matcher
 */
class EmptyMatcher extends AbstractBaseMatcher
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
            return "Expected value to not be empty";
        }
        return "Expected value to be empty";
    }

    /**
     * {@inheritdoc}
     *
     * @param mixed $expected
     * @return bool
     */
    public function isMatch($expected = null)
    {
        $actual = $this->getActual();
        return empty($actual);
    }
}
