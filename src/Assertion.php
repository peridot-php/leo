<?php
namespace Peridot\Leo;

use Peridot\Leo\Matcher\EqualMatcher;
use Peridot\Leo\Matcher\ExceptionMatcher;
use Peridot\Leo\Matcher\SameMatcher;
use Peridot\Leo\Responder\ResponderInterface;

/**
 * Class Assertion
 * @package Peridot\Leo
 */
class Assertion
{
    use DynamicMethodTrait;

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
     */
    public function __construct(ResponderInterface $responder, $actual)
    {
        $this->responder = $responder;
        $this->actual = $actual;
        $this->to = $this;

        $this->addMethod('equal', function($expected) {
            return new SameMatcher($expected);
        });

        $this->addMethod('throw', function($exceptionType, $exceptionMessage = '') {
            $matcher = new ExceptionMatcher($exceptionType);
            $matcher->setExpectedMessage($exceptionMessage);
            $matcher->setArguments($this->getArguments());
            return $matcher;
        });
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
        $method = $this->methods[$method];
        $matcher = call_user_func_array($method, $args);
        $this->responder->respond(
            $matcher->match($this->getActual()),
            $matcher->getTemplate()
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
