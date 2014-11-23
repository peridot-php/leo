<?php
namespace Peridot\Leo\Matcher;

/**
 * @package Peridot\Leo\Matcher
 */
class {{name}}Matcher extends AbstractBaseMatcher
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
            return "NEGATED MESSAGE";
        }
        return "POSITIVE MESSAGE";
    }

    /**
     * {@inheritdoc}
     *
     * @param $subject
     * @return $this|mixed
     */
    public function setSubject($subject)
    {
        $this->actual = ACTUAL;
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
        return true or false;
    }
}
