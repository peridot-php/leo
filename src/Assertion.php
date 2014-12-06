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
    public function __construct(ResponderInterface $responder, $actual)
    {
        $this->responder = $responder;
        $this->actual = $actual;
        include __DIR__ . '/Core/Definitions.php';
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

        $method = $this->methods[$method];
        $result = call_user_func_array($method, $args);

        if ($result instanceof MatcherInterface) {
            $this->assert($result);
        }

        return $result;
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
     */
    public function assert(MatcherInterface $matcher)
    {
        if ($this->flag('not')) {
            $matcher->invert();
        }

        $this->responder->respond(
            $matcher->match($this->getActual()),
            $matcher->getTemplate(),
            $this->flag('message')
        );
    }
}
