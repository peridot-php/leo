<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Interfaces\AbstractBaseInterface;

/**
 * TypeMatcher supports 'a' and 'an' validations for type
 * assertions, as well as adds 'a' and 'an' language chains.
 *
 * @property AbstractBaseInterface $a
 * @property AbstractBaseInterface $an
 * @method void an() an(string $type) validates the type of a subject
 * @method void a() a(string $type) validates the type of a subject
 *
 * @package Peridot\Leo\Matcher
 */
class TypeMatcher extends AbstractBaseMatcher
{
    /**
     * @var string
     */
    private static $pattern = '/an?/';

    /**
     * Adds 'a' and 'an' as language chains.
     *
     * @param string $name
     * @return mixed|\Peridot\Leo\Interfaces\AbstractBaseInterface
     */
    public function &__get($name)
    {
        if (preg_match(self::$pattern, $name)) {
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

    /**
     * Validate the type against the subject.
     *
     * @param string $type
     */
    protected function validateType($type)
    {
        $this->validate($type, gettype($this->getInterface()->getSubject()));
    }

    /**
     * {@inheritdoc}
     *
     * @param $methodName
     * @param $arguments
     * @return mixed
     */
    protected function asBdd($methodName, $arguments)
    {
        if (preg_match(self::$pattern, $methodName)) {
            return call_user_func_array([$this, 'validateType'], $arguments);
        }
    }
}
