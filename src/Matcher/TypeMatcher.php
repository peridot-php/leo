<?php
namespace Peridot\Leo\Matcher;

/**
 * @package Peridot\Leo\Matcher
 */
class TypeMatcher extends AbstractBaseMatcher
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
            return "Expected a type other than $expected";
        }
        return "Expected $expected, got $actual";
    }

    /**
     * {@inheritdoc}
     *
     * @param $subject
     * @return $this|mixed
     */
    public function setSubject($subject)
    {
        $this->actual = gettype($subject);
        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @param mixed $expected
     * @return bool
     */
    public function isMatch($expected)
    {
        $this->actual = $this->getActual();
        return $this->actual === $expected;
    }
}
