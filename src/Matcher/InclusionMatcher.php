<?php
namespace Peridot\Leo\Matcher;

class InclusionMatcher extends AbstractBaseMatcher
{
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
        $label = 'array';
        if (is_string($actual)) {
            $label = 'string';
        }

        if ($negated) {
            return "Expected $label not to contain $expected";
        }
        return "Expected $label to contain $expected";
    }

    /**
     * {@inheritdoc}
     *
     * @param mixed $needle
     * @return bool
     */
    public function isMatch($needle)
    {
        $subject = $this->getActual();
        $result = false;
        if (is_array($subject)) {
            $result = in_array($needle, $subject);
        }

        if (is_string($subject)) {
            $result = strpos($subject, $needle) !== false;
        }

        return $result;
    }

    /**
     * Ensures the subject is an array or string and returns
     * it.
     *
     * @return array|string
     */
    public function getActual()
    {
        $subject = parent::getActual();
        $isHaystack = is_array($subject) || is_string($subject);
        if (! $isHaystack) {
            throw new \InvalidArgumentException("Subject must be an array or string");
        }
        return $subject;
    }
}
