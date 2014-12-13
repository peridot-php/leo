<?php
namespace Peridot\Leo;

use Peridot\Leo\Matcher\MatcherInterface;
use Peridot\Leo\Responder\ResponderInterface;

/**
 * Class Assertion
 * @package Peridot\Leo
 */
class Assertion
{
    use DynamicObjectTrait;

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
     * @param string $actual
     * @param string $message
     */
    public function __construct(ResponderInterface $responder)
    {
        $this->responder = $responder;
    }

    /**
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

        return $this->request($this->properties[$name]);
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
            $this->assert($result);
        }

        return $result;
    }

    /**
     * @param callable $fn
     */
    public function extend(callable $fn)
    {
        call_user_func($fn, $this);
    }

    /**
     * @param $actual
     * @return $this
     */
    public function setActual($actual)
    {
        $this->actual = $actual;
        return $this;
    }

    /**
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
