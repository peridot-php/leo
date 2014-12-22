<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;
use Peridot\Leo\ObjectPath\ObjectPath;
use Peridot\Leo\ObjectPath\ObjectPathValue;

/**
 * PropertyMatcher determines if the actual array or object has the expected property, and optionally matches
 * an expected value for that property.
 *
 * @package Peridot\Leo\Matcher
 */
class PropertyMatcher extends AbstractMatcher
{
    /**
     * @var string|int
     */
    protected $key;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var mixed
     */
    protected $actualValue;

    /**
     * @var bool
     */
    protected $actualValueSet = false;

    /**
     * @var bool
     */
    protected $isDeep = false;

    /**
     * @param mixed $key
     * @param string $value
     */
    public function __construct($key, $value = "")
    {
        $this
            ->setKey($key)
            ->setValue($value);
    }

    /**
     * Return the expected object or array key.
     *
     * @return int|string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set the expected object or array key.
     *
     * @param int|string $key
     * @return $this
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * Return the expected property value.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the expected property value.
     *
     * @param mixed $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return TemplateInterface
     */
    public function getDefaultTemplate()
    {
        list($default, $negated) = $this->getTemplateStrings();

        $template = new ArrayTemplate([
            'default' => $default,
            'negated' => $negated
        ]);

        return $template->setTemplateVars([
            'key' => $this->getKey(),
            'value' => $this->getValue(),
            'actualValue' => $this->getActualValue()
        ]);
    }

    /**
     * Return the actual value given to the matcher.
     *
     * @return mixed
     */
    public function getActualValue()
    {
        return $this->actualValue;
    }

    /**
     * Set the actual value given to the matcher. Used to
     * store whether or not the actual value was set.
     *
     * @param mixed $actualValue
     * @return $this
     */
    public function setActualValue($actualValue)
    {
        $this->actualValue = $actualValue;
        $this->actualValueSet = true;
        return $this;
    }

    /**
     * Return if the actual value has been set.
     *
     * @return bool
     */
    public function isActualValueSet()
    {
        return $this->actualValueSet;
    }

    /**
     * Tell the property matcher to match deep properties.
     *
     * return $this
     */
    public function setIsDeep($isDeep)
    {
        $this->isDeep = $isDeep;
        return $this;
    }

    /**
     * Return whether or not the matcher is matching deep properties.
     *
     * @return bool
     */
    public function isDeep()
    {
        return $this->isDeep;
    }

    /**
     * Matches if the actual value has a property, optionally matching
     * the expected value of that property. If the deep flag is set,
     * the matcher will use the ObjectPath utility to parse deep expressions.
     *
     * @code
     *
     * $this->doMatch('child->name->first', 'brian');
     *
     * @endcode
     *
     * @param mixed $actual
     * @return mixed
     */
    protected function doMatch($actual)
    {
        $this->validateActual($actual);

        if ($this->isDeep()) {
            return $this->matchDeep($actual);
        }

        $actual = $this->actualToArray($actual);

        return $this->matchArrayIndex($actual);
    }

    /**
     * Convert the actual value to an array, whether it is an object or an array.
     *
     * @param object|array $actual
     * @return array|object
     */
    protected function actualToArray($actual)
    {
        if (is_object($actual)) {
            return get_object_vars($actual);
        }
        return $actual;
    }

    /**
     * Match that an array index exists, and matches
     * the expected value if set.
     *
     * @param $actual
     * @return bool
     */
    protected function matchArrayIndex($actual)
    {
        if (isset($actual[$this->getKey()])) {
            $this->assertion->setActual($actual[$this->getKey()]);
            return $this->isExpected($actual[$this->getKey()]);
        }

        return false;
    }

    /**
     * Uses ObjectPath to parse an expression if the deep flag
     * is set.
     *
     * @param $actual
     * @return bool
     */
    protected function matchDeep($actual)
    {
        $path = new ObjectPath($actual);
        $value = $path->get($this->getKey());

        if (is_null($value)) {
            return false;
        }

        $this->assertion->setActual($value->getPropertyValue());

        return $this->isExpected($value->getPropertyValue());
    }

    /**
     * Check if the given value is expected.
     *
     * @param $value
     * @return bool
     */
    protected function isExpected($value)
    {
        if ($expected = $this->getValue()) {
            $this->setActualValue($value);
            return $this->getActualValue() === $expected;
        }

        return true;
    }

    /**
     * Ensure that the actual value is an object or an array.
     *
     * @param $actual
     */
    protected function validateActual($actual)
    {
        if (!is_object($actual) && !is_array($actual)) {
            throw new \InvalidArgumentException("PropertyMatcher expects an object or an array");
        }
    }

    /**
     * Returns the strings used in creating the template for the matcher.
     *
     * @return array
     */
    protected function getTemplateStrings()
    {
        $default = "Expected {{actual}} to have a{{deep}}property {{key}}";
        $negated = "Expected {{actual}} to not have a{{deep}}property {{key}}";
        
        if ($this->getValue() && $this->isActualValueSet()) {
            $default = "Expected {{actual}} to have a{{deep}}property {{key}} of {{value}}, but got {{actualValue}}";
            $negated = "Expected {{actual}} to not have a{{deep}}property {{key}} of {{value}}";
        }

        $deep = ' ';
        if ($this->isDeep()) {
            $deep = ' deep ';
        }

        return str_replace('{{deep}}', $deep, [$default, $negated]);
    }
}
