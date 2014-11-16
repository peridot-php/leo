<?php
namespace Peridot\Leo\Matcher;

use Peridot\Scope\Scope;

class TypeMatcher extends Scope
{
    public function a($type)
    {
        if ($this->match($type)) {
            return;
        }
        throw new \Exception($this->getMessage($type, $this->actual));
    }

    public function an($type)
    {
        $this->a($type);
    }

    public function match($expected)
    {
        $this->actual = gettype($this->peridotGetParentScope()->getSubject());
        return $this->actual === $expected;
    }

    public function getMessage($expected, $actual)
    {
        return "Expected $expected, got $actual";
    }
} 
