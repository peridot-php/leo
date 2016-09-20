<?php

namespace Peridot\Leo\Interfaces;

use Peridot\Leo\Assertion;
use Peridot\Leo\Interfaces\Assert\CollectionAssertTrait;
use Peridot\Leo\Interfaces\Assert\ObjectAssertTrait;
use Peridot\Leo\Interfaces\Assert\TypeAssertTrait;
use Peridot\Leo\Leo;

/**
 * Assert is a non-chainable, object oriented interface
 * on top of a Leo Assertion.
 *
 * @method instanceOf() instanceOf(object $actual, string $expected, string $message = "") Perform an instanceof assertion.
 * @method include() include(array $haystack, string $expected, string $message = "") Perform an inclusion assertion.
 *
 * @package Peridot\Leo\Interfaces
 */
class Assert
{
    use TypeAssertTrait;
    use ObjectAssertTrait;
    use CollectionAssertTrait;

    /**
     * An array of operators mapping to assertions.
     *
     * @var array
     */
    public static $operators = [
        '==' => 'loosely->equal',
        '===' => 'equal',
        '>' => 'above',
        '>=' => 'least',
        '<' => 'below',
        '<=' => 'most',
        '!=' => 'not->loosely->equal',
        '!==' => 'not->equal',
    ];

    /**
     * @var Assertion
     */
    protected $assertion;

    /**
     * @param Assertion $assertion
     */
    public function __construct(Assertion $assertion = null)
    {
        if ($assertion === null) {
            $assertion = Leo::assertion();
        }
        $this->assertion = $assertion;
    }

    /**
     * Perform an a loose equality assertion.
     *
     * @param mixed  $actual
     * @param mixed  $expected
     * @param string $message
     */
    public function equal($actual, $expected, $message = '')
    {
        $this->assertion->setActual($actual);

        return $this->assertion->to->loosely->equal($expected, $message);
    }

    /**
     * Perform a negated loose equality assertion.
     *
     * @param mixed  $actual
     * @param mixed  $expected
     * @param string $message
     */
    public function notEqual($actual, $expected, $message = '')
    {
        $this->assertion->setActual($actual);

        return $this->assertion->to->not->equal($expected, $message);
    }

    /**
     * Performs a throw assertion.
     *
     * @param callable $fn
     * @param $exceptionType
     * @param string $exceptionMessage
     * @param string $message
     */
    public function throws(callable $fn, $exceptionType, $exceptionMessage = '', $message = '')
    {
        $this->assertion->setActual($fn);

        return $this->assertion->to->throw($exceptionType, $exceptionMessage, $message);
    }

    /**
     * Performs a negated throw assertion.
     *
     * @param callable $fn
     * @param $exceptionType
     * @param string $exceptionMessage
     * @param string $message
     */
    public function doesNotThrow(callable $fn, $exceptionType, $exceptionMessage = '', $message = '')
    {
        $this->assertion->setActual($fn);

        return $this->assertion->not->to->throw($exceptionType, $exceptionMessage, $message);
    }

    /**
     * Perform an ok assertion.
     *
     * @param mixed  $object
     * @param string $message
     */
    public function ok($object, $message = '')
    {
        $this->assertion->setActual($object);

        return $this->assertion->to->be->ok($message);
    }

    /**
     * Perform a negated assertion.
     *
     * @param mixed  $object
     * @param string $message
     */
    public function notOk($object, $message = '')
    {
        $this->assertion->setActual($object);

        return $this->assertion->to->not->be->ok($message);
    }

    /**
     * Perform a strict equality assertion.
     *
     * @param mixed  $actual
     * @param mixed  $expected
     * @param string $message
     */
    public function strictEqual($actual, $expected, $message = '')
    {
        $this->assertion->setActual($actual);

        return $this->assertion->to->equal($expected, $message);
    }

    /**
     * Perform a negated strict equality assertion.
     *
     * @param mixed  $actual
     * @param mixed  $expected
     * @param string $message
     */
    public function notStrictEqual($actual, $expected, $message = '')
    {
        $this->assertion->setActual($actual);

        return $this->assertion->to->not->equal($expected, $message);
    }

    /**
     * Perform a pattern assertion.
     *
     * @param string $value
     * @param string $pattern
     * @param string $message
     */
    public function match($value, $pattern, $message = '')
    {
        $this->assertion->setActual($value);

        return $this->assertion->to->match($pattern, $message);
    }

    /**
     * Perform a negated pattern assertion.
     *
     * @param string $value
     * @param string $pattern
     * @param string $message
     */
    public function notMatch($value, $pattern, $message = '')
    {
        $this->assertion->setActual($value);

        return $this->assertion->to->not->match($pattern, $message);
    }

    /**
     * Compare two values using the given operator.
     *
     * @param mixed  $left
     * @param string $operator
     * @param mixed  $right
     * @param string $message
     */
    public function operator($left, $operator, $right, $message = '')
    {
        if (!isset(static::$operators[$operator])) {
            throw new \InvalidArgumentException("Invalid operator $operator");
        }
        $this->assertion->setActual($left);

        return $this->assertion->{static::$operators[$operator]}($right, $message);
    }

    /**
     * Defined to allow use of reserved words for methods.
     *
     * @param $method
     * @param $args
     */
    public function __call($method, $args)
    {
        switch ($method) {
            case 'instanceOf':
                return call_user_func_array([$this, 'isInstanceOf'], $args);
            case 'include':
                return call_user_func_array([$this, 'isIncluded'], $args);
            default:
                throw new \BadMethodCallException("Call to undefined method $method");
        }
    }
}
