<?php
namespace Peridot\Leo\Interfaces;

use Countable;
use Peridot\Leo\Assertion;
use Peridot\Leo\Leo;
use Peridot\Leo\Responder\ResponderInterface;

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
        '!==' => 'not->equal'
    ];

    /**
     * @var Assertion
     */
    protected $assertion;

    /**
     * @param ResponderInterface $responder
     */
    public function __construct(Assertion $assertion = null)
    {
        if (is_null($assertion)) {
            $assertion = Leo::instance()->getAssertion();
        }
        $this->assertion = $assertion;
    }

    /**
     * Perform an a loose equality assertion.
     *
     * @param mixed $actual
     * @param mixed $expected
     * @param string $message
     */
    public function equal($actual, $expected, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->to->loosely->equal($expected, $message);
    }

    /**
     * Perform a negated loose equality assertion.
     *
     * @param mixed $actual
     * @param mixed $expected
     * @param string $message
     */
    public function notEqual($actual, $expected, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->to->not->equal($expected, $message);
    }

    /**
     * Performs a throw assertion.
     *
     * @param callable $fn
     * @param $exceptionType
     * @param string $exceptionMessage
     * @param string $message
     */
    public function throws(callable $fn, $exceptionType, $exceptionMessage = "", $message = "")
    {
        $this->assertion->setActual($fn);
        $this->assertion->to->throw($exceptionType, $exceptionMessage, $message);
    }

    /**
     * Performs a negated throw assertion.
     *
     * @param callable $fn
     * @param $exceptionType
     * @param string $exceptionMessage
     * @param string $message
     */
    public function doesNotThrow(callable $fn, $exceptionType, $exceptionMessage = "", $message = "")
    {
        $this->assertion->setActual($fn);
        $this->assertion->not->to->throw($exceptionType, $exceptionMessage, $message);
    }

    /**
     * Performs a type assertion.
     *
     * @param $actual
     * @param $expected
     * @param string $message
     */
    public function typeOf($actual, $expected, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->to->be->a($expected, $message);
    }

    /**
     * Performs a negated type assertion.
     *
     * @param $actual
     * @param $expected
     * @param string $message
     */
    public function notTypeOf($actual, $expected, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->to->not->be->a($expected, $message);
    }

    /**
     * Perform an ok assertion.
     *
     * @param mixed $object
     * @param string $message
     */
    public function ok($object, $message = "")
    {
        $this->assertion->setActual($object);
        $this->assertion->to->be->ok($message);
    }

    /**
     * Perform a negated assertion.
     *
     * @param mixed $object
     * @param string $message
     */
    public function notOk($object, $message = "")
    {
        $this->assertion->setActual($object);
        $this->assertion->to->not->be->ok($message);
    }

    /**
     * Perform a strict equality assertion.
     *
     * @param mixed $actual
     * @param mixed $expected
     * @param string $message
     */
    public function strictEqual($actual, $expected, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->to->equal($expected, $message);
    }

    /**
     * Perform a negated strict equality assertion.
     *
     * @param mixed $actual
     * @param mixed $expected
     * @param string $message
     */
    public function notStrictEqual($actual, $expected, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->to->not->equal($expected, $message);
    }

    /**
     * Perform a true assertion.
     *
     * @param mixed $actual
     * @param string $message
     */
    public function isTrue($value, $message = "")
    {
        $this->assertion->setActual($value);
        $this->assertion->to->be->true($message);
    }

    /**
     * Perform a false assertion.
     *
     * @param mixed $value
     * @param string $message
     */
    public function isFalse($value, $message = "")
    {
        $this->assertion->setActual($value);
        $this->assertion->to->be->false($message);
    }

    /**
     * Perform a null assertion.
     *
     * @param mixed $value
     * @param string $message
     */
    public function isNull($value, $message = "")
    {
        $this->assertion->setActual($value);
        $this->assertion->to->be->null($message);
    }

    /**
     * Perform a negated null assertion.
     *
     * @param mixed $actual
     * @param string $message
     */
    public function isNotNull($value, $message = "")
    {
        $this->assertion->setActual($value);
        $this->assertion->to->not->be->null($message);
    }

    /**
     * Performs a predicate assertion to check if actual
     * value is callable.
     *
     * @param mixed $value
     * @param string $message
     */
    public function isCallable($value, $message = "")
    {
        $this->assertion->setActual($value);
        $this->assertion->to->satisfy('is_callable', $message);
    }

    /**
     * Performs a negated predicate assertion to check if actual
     * value is not a callable.
     *
     * @param mixed $value
     * @param string $message
     */
    public function isNotCallable($value, $message = "")
    {
        $this->assertion->setActual($value);
        $this->assertion->to->not->satisfy('is_callable', $message);
    }

    /**
     * Perform a type assertion for type "object."
     *
     * @param mixed $value
     * @param string $message
     */
    public function isObject($value, $message = "")
    {
        $this->typeOf($value, 'object', $message);
    }

    /**
     * Perform a negative type assertion for type "object."
     *
     * @param mixed $value
     * @param string $message
     */
    public function isNotObject($value, $message = "")
    {
        $this->notTypeOf($value, 'object', $message);
    }

    /**
     * Perform a type assertion for type "array."
     *
     * @param mixed $value
     * @param string $message
     */
    public function isArray($value, $message = "")
    {
        $this->typeOf($value, 'array', $message);
    }

    /**
     * Performs a negative type assertion for type "array."
     *
     * @param mixed $value
     * @param string $message
     */
    public function isNotArray($value, $message = "")
    {
        $this->notTypeOf($value, 'array', $message);
    }

    /**
     * Perform a type assertion for type "string."
     *
     * @param mixed $value
     * @param string $message
     */
    public function isString($value, $message = "")
    {
        $this->typeOf($value, 'string', $message);
    }

    /**
     * Perform a negated type assertion for type "string."
     *
     * @param mixed $value
     * @param string $message
     */
    public function isNotString($value, $message = "")
    {
        $this->notTypeOf($value, 'string', $message);
    }

    /**
     * Performs a predicate assertion to check if actual
     * value is numeric.
     *
     * @param mixed $value
     * @param string $message
     */
    public function isNumeric($value, $message = "")
    {
        $this->assertion->setActual($value);
        $this->assertion->to->satisfy('is_numeric', $message);
    }

    /**
     * Performs a negated predicate assertion to check if actual
     * value is numeric.
     *
     * @param mixed $value
     * @param string $message
     */
    public function isNotNumeric($value, $message = "")
    {
        $this->assertion->setActual($value);
        $this->assertion->not->to->satisfy('is_numeric', $message);
    }

    /**
     * Perform a type assertion for type "integer."
     *
     * @param $value
     * @param string $message
     */
    public function isInteger($value, $message = "")
    {
        $this->typeOf($value, 'integer', $message);
    }

    /**
     * Perform a negated type assertion for type "integer."
     *
     * @param mixed $value
     * @param string $message
     */
    public function isNotInteger($value, $message = "")
    {
        $this->notTypeOf($value, 'integer', $message);
    }

    /**
     * Perform a type assertion for type "double."
     *
     * @param mixed $value
     * @param string $message
     */
    public function isDouble($value, $message = "")
    {
        $this->typeOf($value, 'double', $message);
    }

    /**
     * Perform a negated type assertion for type "double."
     *
     * @param mixed $value
     * @param string $message
     */
    public function isNotDouble($value, $message = "")
    {
        $this->notTypeOf($value, 'double', $message);
    }

    /**
     * Perform a type assertion for type "resource."
     *
     * @param mixed $value
     * @param string $message
     */
    public function isResource($value, $message = "")
    {
        $this->typeOf($value, 'resource', $message);
    }

    /**
     * Perform a negated type assertion for type "resource."
     *
     * @param mixed $value
     * @param string $message
     */
    public function isNotResource($value, $message = "")
    {
        $this->notTypeOf($value, 'resource', $message);
    }

    /**
     * Perform a type assertion for type "boolean."
     *
     * @param mixed $value
     * @param string $message
     */
    public function isBoolean($value, $message = "")
    {
        $this->typeOf($value, 'boolean', $message);
    }

    /**
     * Perform a negated type assertion for type "boolean."
     *
     * @param mixed $value
     * @param string $message
     */
    public function isNotBoolean($value, $message = "")
    {
        $this->notTypeOf($value, 'boolean', $message);
    }

    /**
     * Perform an instanceof assertion.
     *
     * @param object $object
     * @param string $class
     * @param string $message
     */
    public function isInstanceOf($object, $class, $message = "")
    {
        $this->assertion->setActual($object);
        $this->assertion->is->instanceof($class, $message);
    }

    /**
     * Perform a negated instanceof assertion.
     *
     * @param object $object
     * @param string $class
     * @param string $message
     */
    public function notInstanceOf($object, $class, $message = "")
    {
        $this->assertion->setActual($object);
        $this->assertion->is->not->instanceof($class, $message);
    }

    /**
     * Perform an inclusion assertion.
     *
     * @param array|string $haystack
     * @param mixed $needle
     * @param string $message
     */
    public function isIncluded($haystack, $needle, $message = "")
    {
        $this->assertion->setActual($haystack);
        $this->assertion->to->include($needle, $message);
    }

    /**
     * Perform a negated inclusion assertion.
     *
     * @param array|string $haystack
     * @param mixed $needle
     * @param string $message
     */
    public function notInclude($haystack, $needle, $message = "")
    {
        $this->assertion->setActual($haystack);
        $this->assertion->to->not->include($needle, $message);
    }

    /**
     * Perform a pattern assertion.
     *
     * @param string $value
     * @param string $pattern
     * @param string $message
     */
    public function match($value, $pattern, $message = "")
    {
        $this->assertion->setActual($value);
        $this->assertion->to->match($pattern, $message);
    }

    /**
     * Perform a negated pattern assertion.
     *
     * @param string $value
     * @param string $pattern
     * @param string $message
     */
    public function notMatch($value, $pattern, $message = "")
    {
        $this->assertion->setActual($value);
        $this->assertion->to->not->match($pattern, $message);
    }

    /**
     * Perform a property assertion.
     *
     * @param array|object $actual
     * @param string $property
     * @param string $message
     */
    public function property($object, $property, $message = "")
    {
        $this->assertion->setActual($object);
        $this->assertion->to->have->property($property, null, $message);
    }

    /**
     * Perform a negated property assertion.
     *
     * @param array|object $actual
     * @param string $property
     * @param string $message
     */
    public function notProperty($object, $property, $message = "")
    {
        $this->assertion->setActual($object);
        $this->assertion->to->not->have->property($property, null, $message);
    }

    /**
     * Perform a deep property assertion.
     *
     * @param array|object $object
     * @param string $property
     * @param string $message
     */
    public function deepProperty($object, $property, $message = "")
    {
        $this->assertion->setActual($object);
        $this->assertion->to->have->deep->property($property, null, $message);
    }

    /**
     * Perform a negated deep property assertion.
     *
     * @param array|object $actual
     * @param string $property
     * @param string $message
     */
    public function notDeepProperty($object, $property, $message = "")
    {
        $this->assertion->setActual($object);
        $this->assertion->to->not->have->deep->property($property, null, $message);
    }

    /**
     * Perform a property value assertion.
     *
     * @param array|object $object
     * @param string $property
     * @param mixed $value
     * @param string $message
     */
    public function propertyVal($object, $property, $value, $message = "")
    {
        $this->assertion->setActual($object);
        $this->assertion->to->have->property($property, $value, $message);
    }

    /**
     * Perform a negated property value assertion.
     *
     * @param array|object $object
     * @param string $property
     * @param mixed $value
     * @param string $message
     */
    public function propertyNotVal($object, $property, $value, $message = "")
    {
        $this->assertion->setActual($object);
        $this->assertion->to->not->have->property($property, $value, $message);
    }

    /**
     * Perform a deep property value assertion.
     *
     * @param array|object $object
     * @param string $property
     * @param mixed $value
     * @param string $message
     */
    public function deepPropertyVal($object, $property, $value, $message = "")
    {
        $this->assertion->setActual($object);
        $this->assertion->to->have->deep->property($property, $value, $message);
    }

    /**
     * Perform a negated deep property value assertion.
     *
     * @param array|object $object
     * @param string $property
     * @param mixed $value
     * @param string $message
     */
    public function deepPropertyNotVal($object, $property, $value, $message = "")
    {
        $this->assertion->setActual($object);
        $this->assertion->to->not->have->deep->property($property, $value, $message);
    }

    /**
     * Compare two values using the given operator.
     *
     * @param mixed $left
     * @param string $operator
     * @param mixed $right
     * @param string $message
     */
    public function operator($left, $operator, $right, $message = "")
    {
        if (!isset(static::$operators[$operator])) {
            throw new \InvalidArgumentException("Invalid operator $operator");
        }
        $this->assertion->setActual($left);
        $this->assertion->{static::$operators[$operator]}($right, $message);
    }

    /**
     * Perform a length assertion.
     *
     * @param string|array|Countable $countable
     * @param $length
     * @param string $message
     */
    public function lengthOf($countable, $length, $message = "")
    {
        $this->assertion->setActual($countable);
        $this->assertion->to->have->length($length, $message);
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
                call_user_func_array([$this, 'isInstanceOf'], $args);
                break;
            case 'include':
                call_user_func_array([$this, 'isIncluded'], $args);
                break;
            default:
                throw new \BadMethodCallException("Call to undefined method $method");
        }
    }
}
