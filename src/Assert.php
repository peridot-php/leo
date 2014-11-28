<?php
namespace Peridot\Leo;

class Assert extends LeoInterface
{
    public function __construct()
    {
    }

    public function equal($actual, $expected)
    {
        if ($actual == $expected) {
            return;
        }
        throw new \Exception("nope");
    }

    public function throws(callable $fn, $exceptionType) {
        $this->setActual($fn);
        parent::err($exceptionType);
    }
}
