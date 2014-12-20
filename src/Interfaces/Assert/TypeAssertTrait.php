<?php
namespace Peridot\Leo\Interfaces\Assert;

/**
 * TypeAssertTrait contains assertions that primarily deal
 * with making assertions about a value's type.
 *
 * @package Peridot\Leo\Interfaces\Assert
 */
trait TypeAssertTrait
{
    /**
     * Performs a type assertion.
     *
     * @param mixed $actual
     * @param string $expected
     * @param string $message
     */
    public function typeOf($actual, $expected, $message = "")
    {
        $this->assertion->setActual($actual);
        return $this->assertion->to->be->a($expected, $message);
    }

    /**
     * Performs a negated type assertion.
     *
     * @param mixed $actual
     * @param string $expected
     * @param string $message
     */
    public function notTypeOf($actual, $expected, $message = "")
    {
        $this->assertion->setActual($actual);
        return $this->assertion->to->not->be->a($expected, $message);
    }

    /**
     * Perform a true assertion.
     *
     * @param mixed $actual
     * @param string $message
     */
    public function isTrue($value, $message = "")
    {
        $this->assertion->setActual($value);
        return $this->assertion->to->be->true($message);
    }

    /**
     * Perform a false assertion.
     *
     * @param mixed $value
     * @param string $message
     */
    public function isFalse($value, $message = "")
    {
        $this->assertion->setActual($value);
        return $this->assertion->to->be->false($message);
    }

    /**
     * Perform a null assertion.
     *
     * @param mixed $value
     * @param string $message
     */
    public function isNull($value, $message = "")
    {
        $this->assertion->setActual($value);
        return $this->assertion->to->be->null($message);
    }

    /**
     * Perform a negated null assertion.
     *
     * @param mixed $actual
     * @param string $message
     */
    public function isNotNull($value, $message = "")
    {
        $this->assertion->setActual($value);
        return $this->assertion->to->not->be->null($message);
    }

    /**
     * Performs a predicate assertion to check if actual
     * value is callable.
     *
     * @param mixed $value
     * @param string $message
     */
    public function isCallable($value, $message = "")
    {
        $this->assertion->setActual($value);
        return $this->assertion->to->satisfy('is_callable', $message);
    }

    /**
     * Performs a negated predicate assertion to check if actual
     * value is not a callable.
     *
     * @param mixed $value
     * @param string $message
     */
    public function isNotCallable($value, $message = "")
    {
        $this->assertion->setActual($value);
        return $this->assertion->to->not->satisfy('is_callable', $message);
    }

    /**
     * Perform a type assertion for type "object."
     *
     * @param mixed $value
     * @param string $message
     */
    public function isObject($value, $message = "")
    {
        return $this->typeOf($value, 'object', $message);
    }

    /**
     * Perform a negative type assertion for type "object."
     *
     * @param mixed $value
     * @param string $message
     */
    public function isNotObject($value, $message = "")
    {
        return $this->notTypeOf($value, 'object', $message);
    }

    /**
     * Perform a type assertion for type "array."
     *
     * @param mixed $value
     * @param string $message
     */
    public function isArray($value, $message = "")
    {
        return $this->typeOf($value, 'array', $message);
    }

    /**
     * Performs a negative type assertion for type "array."
     *
     * @param mixed $value
     * @param string $message
     */
    public function isNotArray($value, $message = "")
    {
        return $this->notTypeOf($value, 'array', $message);
    }

    /**
     * Perform a type assertion for type "string."
     *
     * @param mixed $value
     * @param string $message
     */
    public function isString($value, $message = "")
    {
        return $this->typeOf($value, 'string', $message);
    }

    /**
     * Perform a negated type assertion for type "string."
     *
     * @param mixed $value
     * @param string $message
     */
    public function isNotString($value, $message = "")
    {
        return $this->notTypeOf($value, 'string', $message);
    }

    /**
     * Performs a predicate assertion to check if actual
     * value is numeric.
     *
     * @param mixed $value
     * @param string $message
     */
    public function isNumeric($value, $message = "")
    {
        $this->assertion->setActual($value);
        return $this->assertion->to->satisfy('is_numeric', $message);
    }

    /**
     * Performs a negated predicate assertion to check if actual
     * value is numeric.
     *
     * @param mixed $value
     * @param string $message
     */
    public function isNotNumeric($value, $message = "")
    {
        $this->assertion->setActual($value);
        return $this->assertion->not->to->satisfy('is_numeric', $message);
    }

    /**
     * Perform a type assertion for type "integer."
     *
     * @param $value
     * @param string $message
     */
    public function isInteger($value, $message = "")
    {
        return $this->typeOf($value, 'integer', $message);
    }

    /**
     * Perform a negated type assertion for type "integer."
     *
     * @param mixed $value
     * @param string $message
     */
    public function isNotInteger($value, $message = "")
    {
        return $this->notTypeOf($value, 'integer', $message);
    }

    /**
     * Perform a type assertion for type "double."
     *
     * @param mixed $value
     * @param string $message
     */
    public function isDouble($value, $message = "")
    {
        return $this->typeOf($value, 'double', $message);
    }

    /**
     * Perform a negated type assertion for type "double."
     *
     * @param mixed $value
     * @param string $message
     */
    public function isNotDouble($value, $message = "")
    {
        return $this->notTypeOf($value, 'double', $message);
    }

    /**
     * Perform a type assertion for type "resource."
     *
     * @param mixed $value
     * @param string $message
     */
    public function isResource($value, $message = "")
    {
        return $this->typeOf($value, 'resource', $message);
    }

    /**
     * Perform a negated type assertion for type "resource."
     *
     * @param mixed $value
     * @param string $message
     */
    public function isNotResource($value, $message = "")
    {
        return $this->notTypeOf($value, 'resource', $message);
    }

    /**
     * Perform a type assertion for type "boolean."
     *
     * @param mixed $value
     * @param string $message
     */
    public function isBoolean($value, $message = "")
    {
        return $this->typeOf($value, 'boolean', $message);
    }

    /**
     * Perform a negated type assertion for type "boolean."
     *
     * @param mixed $value
     * @param string $message
     */
    public function isNotBoolean($value, $message = "")
    {
        return $this->notTypeOf($value, 'boolean', $message);
    }
}
