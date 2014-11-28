<?php
namespace Peridot\Leo;

class BddInterface extends AssertInterface
{
    public $to;
    protected $actual;

    public function __construct($actual)
    {
        parent::__construct();
        $this->to = $this;
        $this->setActual($actual);
    }

    public function equal($expected)
    {
        parent::same($this->actual, $expected);
    }

    public function setActual($actual)
    {
        $this->actual = $actual;
        return $this;
    }
   
    public function __call($method, $args)
    {
        if ($method == "throw") {
            return call_user_func_array([$this, 'throws'], array_merge([$this->actual], $args));
        }
    }
}

