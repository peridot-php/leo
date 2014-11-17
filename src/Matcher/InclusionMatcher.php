<?php
namespace Peridot\Leo\Matcher;

class InclusionMatcher extends AbstractBaseMatcher
{

    /**
     * Define how a matcher responds to a Bdd interface.
     *
     * @param $methodName
     * @param $arguments
     * @return mixed
     */
    protected function asBdd($methodName, $arguments)
    {
        // TODO: Implement asBdd() method.
    }

    /**
     * Define how a matcher responds to an Assert interface.
     *
     * @param $methodName
     * @param $arguments
     * @return mixed
     */
    protected function asAssert($methodName, $arguments)
    {
        // TODO: Implement asAssert() method.
    }

    /**
     * Return a formatted message for this matcher.
     *
     * @param mixed $expected the expected value
     * @param mixed $actual the actual value
     * @param bool $negated weather the assertion has been negated
     * @return string
     */
    public function getMessage($expected, $actual, $negated)
    {
        // TODO: Implement getMessage() method.
    }

    /**
     * {@inheritdoc}
     *
     * @param mixed $expected
     * @return bool
     */
    public function isMatch($expected)
    {
        $subject = $this->getInterface()->getSubject();
        $isHaystack = is_array($subject) || is_string($subject);
        if (! $isHaystack) {
            throw new \InvalidArgumentException("Subject must be an array or string");
        }

        if (is_array($subject)) {
            return in_array($expected, $subject);
        }
    }
}
