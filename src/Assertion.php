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
     * Arguments to pass along to an actual value
     * that is a callable
     *
     * @var array $arguments
     */
    protected $arguments = [];

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
        include __DIR__ . '/assertions.definition.php';
    }

    /**
     * @return ResponderInterface
     */
    public function getResponder()
    {
        return $this->responder;
    }

    /**
     * @return $this
     */
    public function with()
    {
        $this->arguments = func_get_args();
        return $this;
    }

    /**
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
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
        $matcher = call_user_func_array($method, $args);

        if ($this->flag('not')) {
            $matcher->invert();
        }

        if (!$matcher instanceof MatcherInterface) {
            throw new \RuntimeException("Assertion methods must return an instanceof MatcherInterface");
        }

        $this->responder->respond(
            $matcher->match($this->getActual()),
            $matcher->getTemplate(),
            $this->flag('message')
        );
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
}
