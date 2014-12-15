<?php
namespace Peridot\Leo\Interfaces\Assert;

/**
 * ObjectAssertTrait contains assertions that deal
 * primarily with objects.
 *
 * @package Peridot\Leo\Interfaces\Assert
 */
trait ObjectAssertTrait
{
    /**
     * Perform an instanceof assertion.
     *
     * @param object $object
     * @param string $class
     * @param string $message
     */
    public function isInstanceOf($object, $class, $message = "")
    {
        $this->assertion->setActual($object);
        return $this->assertion->is->instanceof($class, $message);
    }

    /**
     * Perform a negated instanceof assertion.
     *
     * @param object $object
     * @param string $class
     * @param string $message
     */
    public function notInstanceOf($object, $class, $message = "")
    {
        $this->assertion->setActual($object);
        return $this->assertion->is->not->instanceof($class, $message);
    }

    /**
     * Perform a property assertion.
     *
     * @param array|object $actual
     * @param string $property
     * @param string $message
     */
    public function property($object, $property, $message = "")
    {
        $this->assertion->setActual($object);
        return $this->assertion->to->have->property($property, null, $message);
    }

    /**
     * Perform a negated property assertion.
     *
     * @param array|object $actual
     * @param string $property
     * @param string $message
     */
    public function notProperty($object, $property, $message = "")
    {
        $this->assertion->setActual($object);
        return $this->assertion->to->not->have->property($property, null, $message);
    }

    /**
     * Perform a deep property assertion.
     *
     * @param array|object $object
     * @param string $property
     * @param string $message
     */
    public function deepProperty($object, $property, $message = "")
    {
        $this->assertion->setActual($object);
        return $this->assertion->to->have->deep->property($property, null, $message);
    }

    /**
     * Perform a negated deep property assertion.
     *
     * @param array|object $actual
     * @param string $property
     * @param string $message
     */
    public function notDeepProperty($object, $property, $message = "")
    {
        $this->assertion->setActual($object);
        return $this->assertion->to->not->have->deep->property($property, null, $message);
    }

    /**
     * Perform a property value assertion.
     *
     * @param array|object $object
     * @param string $property
     * @param mixed $value
     * @param string $message
     */
    public function propertyVal($object, $property, $value, $message = "")
    {
        $this->assertion->setActual($object);
        return $this->assertion->to->have->property($property, $value, $message);
    }

    /**
     * Perform a negated property value assertion.
     *
     * @param array|object $object
     * @param string $property
     * @param mixed $value
     * @param string $message
     */
    public function propertyNotVal($object, $property, $value, $message = "")
    {
        $this->assertion->setActual($object);
        return $this->assertion->to->not->have->property($property, $value, $message);
    }

    /**
     * Perform a deep property value assertion.
     *
     * @param array|object $object
     * @param string $property
     * @param mixed $value
     * @param string $message
     */
    public function deepPropertyVal($object, $property, $value, $message = "")
    {
        $this->assertion->setActual($object);
        return $this->assertion->to->have->deep->property($property, $value, $message);
    }

    /**
     * Perform a negated deep property value assertion.
     *
     * @param array|object $object
     * @param string $property
     * @param mixed $value
     * @param string $message
     */
    public function deepPropertyNotVal($object, $property, $value, $message = "")
    {
        $this->assertion->setActual($object);
        return $this->assertion->to->not->have->deep->property($property, $value, $message);
    }
}
