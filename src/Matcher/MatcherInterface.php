<?php
namespace Peridot\Leo\Matcher;

interface MatcherInterface
{
    /**
     * Match the actual value against the expected value
     *
     * @param mixed $expected
     * @return bool
     */
    public function isMatch($expected, $actual);

    /**
     * Return a formatted message for this matcher.
     *
     * @param mixed $expected the expected value
     * @param mixed $actual the actual value
     * @param bool $negated weather the assertion has been negated
     * @return string
     */
    public function getMessage($expected, $actual, $negated);
} 
