<?php
namespace Peridot\Leo;

use \Exception;
use Peridot\Leo\Formatter\Formatter;
use Peridot\Leo\Matcher\EqualMatcher;
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

    public function throws(callable $actual, $exceptionType, $exceptionMessage = '')
    {
        try {
            call_user_func_array($actual, $this->arguments);
        } catch (Exception $e) {
            $message = $e->getMessage();
            if ($exceptionMessage && $exceptionMessage != $message) {
                throw new Exception("wrong exception message");
            }
            if (!$e instanceof $exceptionType) {
                throw new Exception("no exception");
            }
        }
    }
    
    public function with()
    {
        $this->arguments = func_get_args();
        return $this;
    }
}
