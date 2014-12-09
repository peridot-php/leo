<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\ArrayTemplate;
use Peridot\Leo\Matcher\Template\TemplateInterface;

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
        $default = "Expected {{actual}} to have property {{key}}";
        $negated = "Expected {{actual}} to not have property {{key}}";
        if ($this->getValue() && $this->isActualValueSet()) {
            $default = "Expected {{actual}} to have a property {{key}} of {{value}}, but got {{actualValue}}";
            $negated = "Expected {{actual}} to not have a property {{key}} of {{value}}";
        }
        $template = new ArrayTemplate(['default' => $default, 'negated' => $negated]);
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
     * The actual matching algorithm for the matcher.
     *
     * @param $actual
     * @return mixed
     */
    protected function doMatch($actual)
    {
        if (is_object($actual)) {
            return $this->matchArrayIndex(get_object_vars($actual));
        }

        if (is_array($actual)) {
            return $this->matchArrayIndex($actual);
        }

        throw new \InvalidArgumentException("PropertyMatcher expects an object or an array");
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
}
