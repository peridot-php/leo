<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Interfaces\AbstractBaseInterface;

/**
 * TypeMatcher supports 'a' and 'an' validations for type
 * assertions, as well as adds 'a' and 'an' language chains.
 *
 * @property AbstractBaseInterface $a
 * @property AbstractBaseInterface $an
 *
 * @package Peridot\Leo\Matcher
 */
class TypeMatcher extends AbstractBaseMatcher
{
    /**
     * Assert that the passed in type is the same
     * as the assertion subject.
     *
     * @param $type
     * @throws \Exception
     */
    public function a($type)
    {
        $this->validate($type, gettype($this->getInterface()->getSubject()));
    }

    /**
     * An alias for the 'a' validation.
     *
     * @param $type
     */
    public function an($type)
    {
        $this->a($type);
    }

    /**
     * Adds 'a' and 'an' as language chains.
     *
     * @param string $name
     * @return mixed|\Peridot\Leo\Interfaces\AbstractBaseInterface
     */
    public function &__get($name)
    {
        if (preg_match('/an?/', $name)) {
            return $this->getInterface();
        }
        return parent::__get($name);
    }

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
}
