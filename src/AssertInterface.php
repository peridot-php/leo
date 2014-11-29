<?php
namespace Peridot\Leo;

use \Exception;
use Peridot\Leo\Formatter\Formatter;
use Peridot\Leo\Matcher\EqualMatcher;
use Peridot\Leo\Matcher\ExceptionMatcher;
use Peridot\Leo\Matcher\SameMatcher;

class AssertInterface
{
    /**
     * Arguments to pass along to an actual value
     * that is a callable
     *
     * @var array $arguments
     */
    protected $arguments = [];

    public function __construct()
    {
        $this->formatter = new Formatter();
    }

    public function equal($actual, $expected)
    {
        $matcher = new EqualMatcher($expected);
        $match = $matcher->match($actual);
        $this->formatter->setMatch($match);
        if (! $match->isMatch()) {
            throw new \Exception($this->formatter->getMessage($matcher->getTemplate()));
        }
    }

    public function same($actual, $expected)
    {
        $matcher = new SameMatcher($expected);
        $match = $matcher->match($actual);
        $this->formatter->setMatch($match);
        if (! $match->isMatch()) {
            throw new Exception($this->formatter->getMessage($matcher->getTemplate()));
        }
    }

    public function throws(callable $func, $exceptionType, $exceptionMessage = '')
    {
        $matcher = new ExceptionMatcher($func);
        $matcher->setExpectedMessage($exceptionMessage);
        $match = $matcher->match($exceptionType);
        $this->formatter->setMatch($match);
        if (! $match->isMatch()) {
            throw new Exception($this->formatter->getMessage($matcher->getTemplate()));
        }
    }
    
    public function with()
    {
        $this->arguments = func_get_args();
        return $this;
    }
}
