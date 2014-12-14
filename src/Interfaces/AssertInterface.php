<?php
namespace Peridot\Leo\Interfaces;

use Peridot\Leo\Assertion;
use Peridot\Leo\Leo;
use Peridot\Leo\Responder\ResponderInterface;

/**
 * AssertInterface is a non-chainable, object oriented interface
 * on top of a Leo Assertion.
 *
 * @method instanceOf() instanceOf(object $actual, string $expected, string $message = "") Perform an instanceof assertion.
 * @method include() include(array $haystack, string $expected, string $message = "") Perform an inclusion assertion.
 *
 * @package Peridot\Leo\Interfaces
 */
class AssertInterface
{
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
     * @param $actual
     * @param $expected
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
     * @param $actual
     * @param $expected
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
     * @param $actual
     * @param string $message
     */
    public function ok($actual, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->to->be->ok($message);
    }

    /**
     * Perform a negated assertion.
     *
     * @param $actual
     * @param string $message
     */
    public function notOk($actual, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->to->not->be->ok($message);
    }

    /**
     * Perform a strict equality assertion.
     *
     * @param $actual
     * @param $expected
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
     * @param $actual
     * @param $expected
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
     * @param $actual
     * @param string $message
     */
    public function isTrue($actual, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->to->be->true($message);
    }

    /**
     * Perform a false assertion.
     *
     * @param $actual
     * @param string $message
     */
    public function isFalse($actual, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->to->be->false($message);
    }

    /**
     * Perform a null assertion.
     *
     * @param $actual
     * @param string $message
     */
    public function isNull($actual, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->to->be->null($message);
    }

    /**
     * Perform a negated null assertion.
     *
     * @param $actual
     * @param string $message
     */
    public function isNotNull($actual, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->to->not->be->null($message);
    }

    /**
     * Performs a predicate assertion to check if actual
     * value is callable.
     *
     * @param $actual
     * @param string $message
     */
    public function isCallable($actual, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->to->satisfy('is_callable', $message);
    }

    /**
     * Performs a negated predicate assertion to check if actual
     * value is not a callable.
     *
     * @param $actual
     * @param string $message
     */
    public function isNotCallable($actual, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->to->not->satisfy('is_callable', $message);
    }

    /**
     * Perform a type assertion for type "object."
     *
     * @param mixed $actual
     * @param string $message
     */
    public function isObject($actual, $message = "")
    {
        $this->typeOf($actual, 'object', $message);
    }

    /**
     * Perform a negative type assertion for type "object."
     *
     * @param mixed $actual
     * @param string $message
     */
    public function isNotObject($actual, $message = "")
    {
        $this->notTypeOf($actual, 'object', $message);
    }

    /**
     * Perform a type assertion for type "array."
     *
     * @param $actual
     * @param string $message
     */
    public function isArray($actual, $message = "")
    {
        $this->typeOf($actual, 'array', $message);
    }

    /**
     * Performs a negative type assertion for type "array."
     *
     * @param $actual
     * @param string $message
     */
    public function isNotArray($actual, $message = "")
    {
        $this->notTypeOf($actual, 'array', $message);
    }

    /**
     * Perform a type assertion for type "string."
     *
     * @param $actual
     * @param string $message
     */
    public function isString($actual, $message = "")
    {
        $this->typeOf($actual, 'string', $message);
    }

    /**
     * Perform a negated type assertion for type "string."
     *
     * @param $actual
     * @param string $message
     */
    public function isNotString($actual, $message = "")
    {
        $this->notTypeOf($actual, 'string', $message);
    }

    /**
     * Performs a predicate assertion to check if actual
     * value is numeric.
     *
     * @param mixed $actual
     * @param string $message
     */
    public function isNumeric($actual, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->to->satisfy('is_numeric', $message);
    }

    /**
     * Performs a negated predicate assertion to check if actual
     * value is numeric.
     *
     * @param mixed $actual
     * @param string $message
     */
    public function isNotNumeric($actual, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->not->to->satisfy('is_numeric', $message);
    }

    /**
     * Perform a type assertion for type "integer."
     *
     * @param $actual
     * @param string $message
     */
    public function isInteger($actual, $message = "")
    {
        $this->typeOf($actual, 'integer', $message);
    }

    /**
     * Perform a negated type assertion for type "integer."
     *
     * @param $actual
     * @param string $message
     */
    public function isNotInteger($actual, $message = "")
    {
        $this->notTypeOf($actual, 'integer', $message);
    }

    /**
     * Perform a type assertion for type "double."
     *
     * @param $actual
     * @param string $message
     */
    public function isDouble($actual, $message = "")
    {
        $this->typeOf($actual, 'double', $message);
    }

    /**
     * Perform a negated type assertion for type "double."
     *
     * @param $actual
     * @param string $message
     */
    public function isNotDouble($actual, $message = "")
    {
        $this->notTypeOf($actual, 'double', $message);
    }

    /**
     * Perform a type assertion for type "resource."
     *
     * @param $actual
     * @param string $message
     */
    public function isResource($actual, $message = "")
    {
        $this->typeOf($actual, 'resource', $message);
    }

    /**
     * Perform a negated type assertion for type "resource."
     *
     * @param $actual
     * @param string $message
     */
    public function isNotResource($actual, $message = "")
    {
        $this->notTypeOf($actual, 'resource', $message);
    }

    /**
     * Perform a type assertion for type "boolean."
     *
     * @param $actual
     * @param string $message
     */
    public function isBoolean($actual, $message = "")
    {
        $this->typeOf($actual, 'boolean', $message);
    }

    /**
     * Perform a negated type assertion for type "boolean."
     *
     * @param $actual
     * @param string $message
     */
    public function isNotBoolean($actual, $message = "")
    {
        $this->notTypeOf($actual, 'boolean', $message);
    }

    /**
     * Perform an instanceof assertion.
     *
     * @param $actual
     * @param $expected
     * @param string $message
     */
    public function isInstanceOf($actual, $expected, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->is->instanceof($expected, $message);
    }

    /**
     * Perform a negated instanceof assertion.
     *
     * @param $actual
     * @param $expected
     * @param string $message
     */
    public function notInstanceOf($actual, $expected, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->is->not->instanceof($expected, $message);
    }

    /**
     * Perform an inclusion assertion.
     *
     * @param $haystack
     * @param $needle
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
     * @param $haystack
     * @param $needle
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
     * @param $actual
     * @param $pattern
     * @param string $message
     */
    public function match($actual, $pattern, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->to->match($pattern, $message);
    }

    /**
     * Perform a negated pattern assertion.
     *
     * @param $actual
     * @param $pattern
     * @param string $message
     */
    public function notMatch($actual, $pattern, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->to->not->match($pattern, $message);
    }

    /**
     * Perform a property assertion.
     *
     * @param $actual
     * @param $property
     * @param string $message
     */
    public function property($actual, $property, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->to->have->property($property, null, $message);
    }

    /**
     * Perform a negated property assertion.
     *
     * @param $actual
     * @param $property
     * @param string $message
     */
    public function notProperty($actual, $property, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->to->not->have->property($property, null, $message);
    }

    /**
     * Perform a deep property assertion.
     *
     * @param $actual
     * @param $property
     * @param string $message
     */
    public function deepProperty($actual, $property, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->to->have->deep->property($property, null, $message);
    }

    /**
     * Perform a negated deep property assertion.
     *
     * @param $actual
     * @param $property
     * @param string $message
     */
    public function notDeepProperty($actual, $property, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->to->not->have->deep->property($property, null, $message);
    }

    /**
     * Perform a property value assertion.
     *
     * @param $actual
     * @param $property
     * @param $value
     * @param string $message
     */
    public function propertyVal($actual, $property, $value, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->to->have->property($property, $value, $message);
    }

    /**
     * Perform a negated property value assertion.
     *
     * @param $actual
     * @param $property
     * @param $value
     * @param string $message
     */
    public function propertyNotVal($actual, $property, $value, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->to->not->have->property($property, $value, $message);
    }

    /**
     * Perform a deep property value assertion.
     *
     * @param $actual
     * @param $property
     * @param $value
     * @param string $message
     */
    public function deepPropertyVal($actual, $property, $value, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->to->have->deep->property($property, $value, $message);
    }

    /**
     * Perform a negated deep property value assertion.
     *
     * @param $actual
     * @param $property
     * @param $value
     * @param string $message
     */
    public function deepPropertyNotVal($actual, $property, $value, $message = "")
    {
        $this->assertion->setActual($actual);
        $this->assertion->to->not->have->deep->property($property, $value, $message);
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
