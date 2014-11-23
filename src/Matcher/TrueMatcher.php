<?php
namespace Peridot\Leo\Matcher;

/**
 * @package Peridot\Leo\Matcher
 */
class TrueMatcher extends AbstractBaseMatcher
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
            return "Expected value to not be true";
        }
        return "Expected value to be true";
    }

    /**
     * {@inheritdoc}
     *
     * @param mixed $expected
     * @return bool
     */
    public function isMatch($expected = null)
    {
        return $this->getActual() === true;
    }
}
