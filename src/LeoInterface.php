<?php
namespace Peridot\Leo;

use \Exception;

class LeoInterface
{
    public $to;

    protected $args = [];

    protected $actual;

    public function __construct($actual)
    {
        $this->to = $this;
        $this->actual = $actual;
    }

    public function equal($expected)
    {
        if ($expected === $this->actual) {
            return;
        }
        throw new Exception("nope");
    }

    public function err($exceptionType)
    {
        try {
            call_user_func_array($this->actual, $this->args);
        } catch (Exception $e) {
            if (!$e instanceof $exceptionType) {
                throw new Exception("no exception");
            }
        }
    }

    public function with()
    {
        $this->args = func_get_args();
        return $this;
    }

    public function __call($method, $args)
    {
        if ($method == "throw") {
            return call_user_func_array([$this, 'err'], $args);
        }
    }

    public function setActual($actual)
    {
        $this->actual = $actual;
        return $this;
    }
}

