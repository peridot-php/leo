<?php
namespace Peridot\Leo;

class Subject 
{
    /**
     * @var mixed
     */
    protected $actual;

    /**
     * @param mixed $actual
     */
    public function __construct($actual)
    {
        $this->actual = $actual;
    }

    /**
     * Return the actual value to assert against.
     *
     * @return mixed
     */
    public function getActual()
    {
        return $this->actual;
    }

    /**
     * Set the value to assert against.
     *
     * @param mixed $actual
     */
    public function setActual($actual)
    {
        $this->actual = $actual;
        return $this;
    }
} 
