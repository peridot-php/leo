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
    public function isMatch($expected);

    /**
     * Validation throws an exception if a match fails.
     *
     * @param mixed $expected
     * @param bool $negated whether or not the match should be negated
     * @param string $message
     * @return mixed
     * @throws \Exception
     */
    public function validate($expected, $negated, $message = '');

    /**
     * Return a formatted message for this matcher.
     *
     * @param mixed $expected the expected value
     * @param mixed $actual the actual value
     * @param bool $negated weather the assertion has been negated
     * @return string
     */
    public function getMessage($expected, $actual, $negated);

    /**
     * Given a subject this method sets the actual value being
     * matched against.
     *
     * @param $value
     * @return mixed
     */
    public function setSubject($subject);

    /**
     * Return the value to match against.
     *
     * @return mixed
     */
    public function getActual();
} 
