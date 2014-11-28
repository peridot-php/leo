<?php
namespace Peridot\Leo;

use \Exception;

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
    }

    public function equal($actual, $expected)
    {
        if ($actual != $expected) {
            throw new \Exception("nope");
        }
    }

    public function same($actual, $expected)
    {
        if ($actual !== $expected) {
            throw new Exception("nope");
        }
    }

    public function throws(callable $actual, $exceptionType)
    {
        try {
            call_user_func_array($actual, $this->arguments);
        } catch (Exception $e) {
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
