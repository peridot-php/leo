<?php
namespace Peridot\Leo;

use Peridot\Scope\ScopeTrait;

/**
 * The subject stores an actual value to assert against and delegates
 * most functionality to Scope
 *
 * @property Scope $to
 * @property Scope $be
 * @property Scope $been
 * @property Scope $is
 * @property Scope $that
 * @property Scope $and
 * @property Scope $has
 * @property Scope $have
 * @property Scope $with
 * @property Scope $at
 * @property Scope $of
 * @property Scope $same
 * @property Scope $not
 * @property bool $negated
 */
class Subject 
{
    use ScopeTrait;

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
        $scope = new Scope();
        $this->setScope($scope);
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

    /**
     * @param $property
     */
    public function &__get($property)
    {
        return $this->getScope()->$property;
    }
} 
