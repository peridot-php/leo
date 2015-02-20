<?php
namespace Peridot\Leo;

/**
 * DynamicObjectTrait adds methods for dynamically defining methods, flags, and properties.
 * @package Peridot\Leo
 */
trait DynamicObjectTrait
{
    /**
     * @var array
     */
    protected $methods = [];

    /**
     * @var array
     */
    protected $properties = [];

    /**
     * @var array
     */
    protected $flags = [];

    /**
     * Add a method identified by the given name.
     *
     * @param string $name
     * @param callable $method the body of the method
     * @return $this
     */
    public function addMethod($name, callable $method)
    {
        $this->methods[$name] = \Closure::bind($method, $this, $this);
        return $this;
    }

    /**
     * Adds a lazy property identified by the given name. The property
     * is lazy because it is not evaluated until asked for via __get().
     *
     * @param string $name
     * @param callable $factory
     * @param bool $memoize
     * @return $this
     */
    public function addProperty($name, callable $factory, $memoize = false)
    {
        $this->properties[$name] = ['factory' => \Closure::bind($factory, $this, $this), 'memoize' => $memoize];
        return $this;
    }

    /**
     * A simple mechanism for storing arbitrary flags. Flags are useful
     * for tweaking behavior based on their presence.
     *
     * @return $this|mixed
     */
    public function flag()
    {
        $args = func_get_args();
        $num = count($args);

        if ($num > 1) {
            $this->flags[$args[0]] = $args[1];
            return $this;
        }

        if (array_key_exists($args[0], $this->flags)) {
            return $this->flags[$args[0]];
        }
    }

    /**
     * Reset flags. Flags are generally cleared after an Assertion is made.
     *
     * @return $this
     */
    public function clearFlags()
    {
        $this->flags = [];
        return $this;
    }
}
