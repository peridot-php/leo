<?php
namespace Peridot\Leo\Matcher;

class InclusionMatcher extends AbstractBaseMatcher
{
    private static $bddPattern = '/^include|contain$/';

    private static $assertPattern = '/^(not)?(?:i|I)nclude$/';

    /**
     * {@inheritdoc}
     *
     * @param $methodName
     * @param $arguments
     * @return mixed
     */
    protected function asBdd($methodName, $arguments)
    {
        if (preg_match(self::$bddPattern, $methodName)) {
            return call_user_func_array([$this, 'validate'], $arguments);
        }
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
    public function getMessage($expected, $actual, $negated = false)
    {
        if ($negated) {
            return "Expected $actual not to contain $expected";
        }
        return "Expected $actual to contain $expected";
    }

    /**
     * {@inheritdoc}
     *
     * @param mixed $needle
     * @return bool
     */
    public function isMatch($needle)
    {
        $subject = $this->getInterface()->getSubject();
        $isHaystack = is_array($subject) || is_string($subject);
        if (! $isHaystack) {
            throw new \InvalidArgumentException("Subject must be an array or string");
        }

        $result = false;
        if (is_array($subject)) {
            $this->actual = 'array';
            $result = in_array($needle, $subject);
        }

        if (is_string($subject)) {
            $this->actual = 'string';
            $result = strpos($subject, $needle) !== false;
        }

        return $result;
    }
}
