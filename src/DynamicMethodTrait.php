<?php
namespace Peridot\Leo;

trait DynamicMethodTrait
{
    protected $methods = [];

    /**
     * @param $name
     * @param callable $method
     */
    public function addMethod($name, callable $method)
    {
        $this->methods[$name] = \Closure::bind($method, $this, $this);
        return $this;
    }
} 
