<?php
namespace Peridot\Leo;

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
     * @param $name
     * @param callable $method
     * @return $this
     */
    public function addMethod($name, callable $method)
    {
        $this->methods[$name] = \Closure::bind($method, $this, $this);
        return $this;
    }

    /**
     * @param $name
     * @param callable $factory
     * @return $this
     */
    public function addProperty($name, callable $factory)
    {
        $this->properties[$name] = \Closure::bind($factory, $this, $this);
        return $this;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if (!isset($this->properties[$name])) {
            throw new \DomainException("Property $name not found");
        }

        $factory = $this->properties[$name];
        return $factory();
    }

    /**
     * @return $this
     */
    public function flag()
    {
        $args = func_get_args();
        $num = count($args);
        if ($num > 1) {
            $this->flags[$args[0]] = $args[1];
            return $this;
        }
        return $this->flags[$args[0]];
    }

    /**
     * Reset flags.
     *
     * @return $this
     */
    public function clearFlags()
    {
        $this->flags = [];
        return $this;
    }
}
