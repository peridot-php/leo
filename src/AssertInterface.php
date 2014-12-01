<?php
namespace Peridot\Leo;

use Peridot\Leo\Matcher\EqualMatcher;
use Peridot\Leo\Matcher\ExceptionMatcher;
use Peridot\Leo\Matcher\SameMatcher;
use Peridot\Leo\Responder\ResponderInterface;

class AssertInterface
{
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

    public function __construct(ResponderInterface $responder)
    {
        $this->responder = $responder;
    }

    public function equal($actual, $expected)
    {
        $matcher = new EqualMatcher($expected);
        $this->responder->respond(
            $matcher->match($actual),
            $matcher->getTemplate()
        );
    }

    public function same($actual, $expected)
    {
        $matcher = new SameMatcher($expected);
        $this->responder->respond(
            $matcher->match($actual),
            $matcher->getTemplate()
        );
    }

    public function throws(callable $func, $exceptionType, $exceptionMessage = '')
    {
        $matcher = new ExceptionMatcher($func);
        $matcher->setArguments($this->arguments);
        $matcher->setExpectedMessage($exceptionMessage);
        $this->responder->respond(
            $matcher->match($exceptionType),
            $matcher->getTemplate()
        );
    }
    
    public function with()
    {
        $this->arguments = func_get_args();
        return $this;
    }
}
