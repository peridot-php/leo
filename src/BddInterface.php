<?php
namespace Peridot\Leo;

use Peridot\Leo\Responder\ResponderInterface;

class BddInterface extends AssertInterface
{
    /**
     * @var BddInterface
     */
    public $to;

    /**
     * @var mixed
     */
    protected $actual;

    /**
     * @param ResponderInterface $responder
     * @param mixed $actual
     */
    public function __construct(ResponderInterface $responder, $actual)
    {
        parent::__construct($responder);
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

