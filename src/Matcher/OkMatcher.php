<?php
namespace Peridot\Leo\Matcher;

class OkMatcher extends AbstractBaseMatcher
{
    /**
     * {@inheritdoc}
     *
     * @param mixed $expected
     * @return bool
     */
    public function isMatch($expected = null)
    {
        $cast = (bool) $this->getActual();
        return $cast;
    }

    /**
     * {@inheritdoc}
     *
     * @param mixed $expected the expected value
     * @param mixed $actual the actual value
     * @param bool $negated weather the assertion has been negated
     * @return string
     */
    public function getMessage($expected, $actual, $negated)
    {
        if ($negated) {
            return "Expected value to not be truthy";
        }
        return "Expected value to be truthy";
    }
}
