<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;
use Peridot\Leo\Utility\ObjectPath;

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
     * @return int|string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param int|string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Return a default template if none was set.
     *
     * @return TemplateInterface
     */
    public function getDefaultTemplate()
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

        $template = new ArrayTemplate([
            'default' => str_replace('{{deep}}', $deep, $default),
            'negated' => str_replace('{{deep}}', $deep, $negated)
        ]);

        return $template->setTemplateVars([
            'key' => $this->getKey(),
            'value' => $this->getValue(),
            'actualValue' => $this->getActualValue()
        ]);
    }

    /**
     * @return mixed
     */
    public function getActualValue()
    {
        return $this->actualValue;
    }

    /**
     * @param mixed $actualValue
     */
    public function setActualValue($actualValue)
    {
        $this->actualValue = $actualValue;
        $this->actualValueSet = true;
        return $this;
    }

    /**
     * @return bool
     */
    public function isActualValueSet()
    {
        return $this->actualValueSet;
    }

    /**
     * return $this
     */
    public function setIsDeep($isDeep)
    {
        $this->isDeep = $isDeep;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDeep()
    {
        return $this->isDeep;
    }

    /**
     * The actual matching algorithm for the matcher.
     *
     * @param $actual
     * @return mixed
     */
    protected function doMatch($actual)
    {
        if (!is_object($actual) && !is_array($actual)) {
            throw new \InvalidArgumentException("PropertyMatcher expects an object or an array");
        }

        if ($this->isDeep()) {
            return $this->matchDeep($actual);
        }

        $actual = is_object($actual) ? get_object_vars($actual) : $actual;
        return $this->matchArrayIndex($actual);
    }

    /**
     * @param $actual
     * @return bool
     */
    protected function matchArrayIndex($actual)
    {
        if (isset($actual[$this->getKey()])) {
            if ($expected = $this->getValue()) {
                $this->setActualValue($actual[$this->getKey()]);
                return $this->getActualValue() === $expected;
            }
            return true;
        }

        return false;
    }

    /**
     * @param $actual
     * @return bool
     */
    protected function matchDeep($actual)
    {
        $path = new ObjectPath($actual);
        $value = $path->get($this->getKey());

        if ($value && $this->isNegated()) {
            return true;
        }

        if (is_null($value)) {
            return false;
        }

        if ($expected = $this->getValue()) {
            $this->setActualValue($value->getPropertyValue());
            return $this->getActualValue() === $expected;
        }

        return false;
    }
}
