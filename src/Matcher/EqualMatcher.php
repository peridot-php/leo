<?php
namespace Peridot\Leo\Matcher;

/**
 * Class EqualMatcher
 * @package Peridot\Leo\Matcher
 */
class EqualMatcher extends AbstractMatcher
{
    /**
     * Determine if two values are strictly equal.
     *
     * @param mixed $expected
     * @param mixed $actual
     * @return bool
     */
    public function match($expected, $actual)
    {
        $result = $expected === $actual;
        if ($this->isNegated()) {
            return !$result;
        }
        return $result;
    }
}
