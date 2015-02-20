<?php
namespace Peridot\Leo;

use Peridot\Leo\Matcher\MatcherInterface;
use Peridot\Leo\Responder\ResponderInterface;

/**
 * Assertion is responsible for asserting it's actual value
 * against a MatcherInterface and responding to the results of a match.
 *
 * @method Assertion equal() equal(mixed $expected, string $message = "") Asserts that actual and expected values are strictly equal
 * @method Assertion with() with(array $args) Stores an array of values to be used with callable assertions
 * @method Assertion throw() throw(string $exceptionType, string $exceptionMessage = "", $message = "") Invokes the actual value as a function and matches the exception type was thrown, and optionally matches the exception message
 * @method Assertion a() a(string $expected, string $message = "") Asserts that the actual value given has the same type as the expected type string
 * @method Assertion an() an(string $expected, string $message = "") Asserts that the actual value given has the same type as the expected type string
 * @method Assertion include() include(mixed $expected, string $message = "") Asserts that the actual string or array includes the expected value
 * @method Assertion contain() contain(mixed $expected, string $message = "") Asserts that the actual string or array includes the expected value
 * @method Assertion ok() ok(string $message = "") Asserts that the actual value is truthy - that is true when cast to (bool)
 * @method Assertion true() true(string $message = "") Asserts that the actual value is strictly equal to true
 * @method Assertion false() false(string $message = "") Asserts that the actual value is strictly equal to false
 * @method Assertion null() null(string $message = "") Asserts that the actual value is null
 * @method Assertion empty() empty(string $message = "") Asserts that the actual value is empty
 * @method Assertion above() above(mixed $expected, string $message = "") Asserts that the actual value is greater than the expected value
 * @method Assertion least() least(mixed $expected, string $message = "") Asserts that the actual value is greater than or equal to the expected value
 * @method Assertion below() below(mixed $expected, string $message = "") Asserts that the actual value is less than the expected value
 * @method Assertion most() most(mixed $expected, string $message = "") Asserts that the actual value is less than or equal to the expected value
 * @method Assertion within() within(int $lowerBound, int $upperBound, string $message = "") Asserts that the actual value is between the upper and lower bounds (inclusive)
 * @method Assertion instanceof() instanceof(string $expected, string $message = "") Asserts that the actual value is an instance of the expected class string
 * @method Assertion property() property(string $name, mixed $value = "", string $message = "") Asserts that the actual array or object has the expected property and optionally asserts the property value against an expected value
 * @method Assertion length() length(mixed $expected, string $message = "") Asserts the actual array, string, or Countable has the expected length
 * @method Assertion match() match(string $pattern, string $message = "") Asserts that the actual value matches the expected regular expression
 * @method Assertion string() string(string $expected, string $message = "") Asserts that the actual string contains the expected substring
 * @method Assertion keys() keys(array $keys, string $message = "") Asserts the actual object or array has keys equivalent to the expected keys
 * @method Assertion satisfy() satisfy(callable $predicate, string $message = "") Asserts that the actual value satisfies the expected predicate. The expected predicate will be passed the actual value and should return true or false
 *
 * @property-read Assertion $to a language chain
 * @property-read Assertion $be a language chain
 * @property-read Assertion $been a language chain
 * @property-read Assertion $is a language chain
 * @property-read Assertion $and a language chain
 * @property-read Assertion $has a language chain
 * @property-read Assertion $have a language chain
 * @property-read Assertion $with a language chain
 * @property-read Assertion $that a language chain
 * @property-read Assertion $at a language chain
 * @property-read Assertion $of a language chain
 * @property-read Assertion $same a language chain
 * @property-read Assertion $an a language chain
 * @property-read Assertion $a a language chain
 * @property-read Assertion $not flags the Assertion as negated
 * @property-read Assertion $loosely enables loose equality assertion using the ->equal() assertion
 * @property-read Assertion $contain enables the contain flag for use with the ->keys() assertion
 * @property-read Assertion $include enables the contain flag for use with the ->keys() assertion
 * @property-read Assertion $ok a lazy property that performs an ->ok() assertion
 * @property-read Assertion $true a lazy property that performs a ->true() assertion
 * @property-read Assertion $false a lazy property that performs a ->false() assertion
 * @property-read Assertion $null a lazy property that performs a ->null() assertion
 * @property-read Assertion $empty a lazy property that performs an ->empty() assertion
 * @property-read Assertion $length enables the length flag for use with countable assertions such as ->above(), ->least(), ->below(), ->most(), and ->within()
 * @property-read Assertion $deep enables the deep flag for use with assertions that need to traverse structures like the ->property() assertion
 *
 * @package Peridot\Leo
 */
final class Assertion
{
    use DynamicObjectTrait;

    /**
     * A static cache for memoized properties.
     *
     * @var array
     */
    private static $propertyCache = [];

    /**
     * @var ResponderInterface
     */
    protected $responder;

    /**
     * @var mixed
     */
    protected $actual;

    /**
     * @param ResponderInterface $responder
     */
    public function __construct(ResponderInterface $responder, $actual = null)
    {
        $this->responder = $responder;
        $this->actual = $actual;
    }

    /**
     * Returns the current ResponderInterface assigned to this Assertion.
     *
     * @return ResponderInterface
     */
    public function getResponder()
    {
        return $this->responder;
    }

    /**
     * Delegate methods to assertion methods
     *
     * @param $method
     * @param $args
     * @return mixed
     */
    public function __call($method, $args)
    {
        if (!isset($this->methods[$method])) {
            throw new \BadMethodCallException("Method $method does not exist");
        }

        return $this->request($this->methods[$method], $args);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if (!isset($this->properties[$name])) {
            throw new \DomainException("Property $name not found");
        }

        if (array_key_exists($name, self::$propertyCache)) {
            return self::$propertyCache[$name];
        }

        $property = $this->properties[$name];
        $result = $this->request($property['factory']);

        if ($property['memoize']) {
            self::$propertyCache[$name] = $result;
        }

        return $result;
    }

    /**
     * A request to an Assertion will attempt to resolve
     * the result as an assertion before returning the result.
     *
     * @param callable $fn
     * @return mixed
     */
    public function request(callable $fn, array $arguments = [])
    {
        $result = call_user_func_array($fn, $arguments);

        if ($result instanceof MatcherInterface) {
            return $this->assert($result);
        }

        return $result;
    }

    /**
     * Extend calls the given callable - or file that returns a callable - and passes the current Assertion instance
     * to it. Assertion can be extended via the ->addMethod(), ->flag(), and ->addProperty()
     * methods.
     *
     * @param callable $fn
     */
    public function extend($fn)
    {
        if (is_string($fn) && file_exists($fn)) {
            $fn = include $fn;
        }

        if (is_callable($fn)) {
            return call_user_func($fn, $this);
        }

        throw new \InvalidArgumentException("Assertion::extend requires a callable or a file that returns one");
    }

    /**
     * Set the actual value used for matching expectations against.
     *
     * @param $actual
     * @return $this
     */
    public function setActual($actual)
    {
        $this->actual = $actual;
        return $this;
    }

    /**
     * Return the actual value being asserted against.
     *
     * @return mixed
     */
    public function getActual()
    {
        return $this->actual;
    }

    /**
     * Assert against the given matcher.
     *
     * @param $result
     * @return $this
     */
    public function assert(MatcherInterface $matcher)
    {
        if ($this->flag('not')) {
            $matcher->invert();
        }

        $match = $matcher
            ->setAssertion($this)
            ->match($this->getActual());

        $message = $this->flag('message');

        $this->clearFlags();

        $this->responder->respond($match, $matcher->getTemplate(), $message);

        return $this;
    }
}
