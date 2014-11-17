<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Interfaces\AbstractBaseInterface;
use Peridot\Leo\Interfaces\Bdd;

/**
 * TypeMatcher supports 'a' and 'an' validations for type
 * assertions, as well as adds 'a' and 'an' language chains.
 *
 * @property AbstractBaseInterface $a
 * @property AbstractBaseInterface $an
 * @method void an() an(string $type, string $message = "") validates the type of a subject
 * @method void a() a(string $type, string $message = "") validates the type of a subject
 * @method void typeOf() typeOf(mixed $value, string $type, string $message = "") validates the type of the passed in value
 * @method void notTypeOf() notTypeOf(mixed $value, string $type, string $message = "") validates that the type of a subject is not the given type
 *
 * @package Peridot\Leo\Matcher
 */
class TypeMatcher extends AbstractBaseMatcher
{
    /**
     * @var string
     */
    private static $bddPattern = '/^an?$/';

    /**
     * @var string
     */
    private static $assertPattern = '/^(not)?(?:t|T)ypeOf$/';

    /**
     * Adds 'a' and 'an' as language chains.
     *
     * @param string $name
     * @return mixed|\Peridot\Leo\Interfaces\AbstractBaseInterface
     */
    public function &__get($name)
    {
        $isChainable = $this->getInterface() instanceof Bdd && preg_match(self::$bddPattern, $name);
        if ($isChainable) {
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
     * {@inheritdoc}
     *
     * @param mixed $expected
     * @return bool
     */
    public function isMatch($expected)
    {
        $this->actual = gettype($this->getInterface()->getSubject());
        return $this->actual === $expected;
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
        if (! preg_match(self::$assertPattern, $methodName, $matches)) {
            return null;
        }

        if (isset($matches[1])) {
            $this->getInterface()->negated = true;
        }

        $this->getInterface()->setSubject($arguments[0]);
        $arguments = array_slice($arguments, 1);
        return call_user_func_array([$this, 'validate'], $arguments);
    }
}
