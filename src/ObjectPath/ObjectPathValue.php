<?php
namespace Peridot\Leo\ObjectPath;

/**
 * An ObjectPathValue is the result of parsing a path expression via ObjectPath.
 *
 * @package Peridot\Leo\Utility
 */
class ObjectPathValue
{
    /**
     * @var string
     */
    protected $propertyName;

    /**
     * @var mixed
     */
    protected $propertyValue;

    /**
     * @param $name
     * @param $value
     */
    public function __construct($name, $value)
    {
        $this->propertyName = $name;
        $this->propertyValue = $value;
    }

    /**
     * @return string
     */
    public function getPropertyName()
    {
        return $this->propertyName;
    }

    /**
     * @return mixed
     */
    public function getPropertyValue()
    {
        return $this->propertyValue;
    }
}
