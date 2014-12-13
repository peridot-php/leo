<?php
namespace Peridot\Leo\Matcher;

use Peridot\Leo\Matcher\Template\TemplateInterface;

/**
 * CountableMatcher a matcher is a matcher that matches numeric values,
 * or reduces a countable value - like array, string, or Countable - to a single
 * numeric value.
 *
 * @package Peridot\Leo\Matcher
 */
abstract class CountableMatcher extends AbstractMatcher
{
    /**
     * @var mixed
     */
    protected $countable;

    /**
     * Set the countable value used by the CountableMatcher.
     *
     * @param mixed $countable
     * @return $this
     */
    public function setCountable($countable)
    {
        $this->countable = $countable;
        return $this;
    }

    /**
     * Return the countable used by the CountableMatcher.
     *
     * @return mixed
     */
    public function getCountable()
    {
        return $this->countable;
    }

    /**
     * Get the count of the countable value.
     * @return int
     */
    public function getCount()
    {
        if (is_string($this->countable)) {
            return strlen($this->countable);
        }

        return count($this->countable);
    }

    /**
     * {@inheritdoc}
     *
     * Returns a default countable interface if the countable is set.
     *
     * @return TemplateInterface
     */
    public function getTemplate()
    {
        if (isset($this->countable)) {
            return $this->getDefaultCountableTemplate();
        }

        return parent::getTemplate();
    }

    /**
     * {@inheritdoc}
     *
     * @param $actual
     * @return mixed
     */
    protected function doMatch($actual = null)
    {
        if (isset($this->countable)) {
            $actual = $this->getCount();
        }

        if (!is_numeric($actual)) {
            throw new \InvalidArgumentException(get_class($this) . " requires a numeric value");
        }

        return $this->matchNumeric($actual);
    }

    /**
     * Return a default template for when a countable has been set.
     *
     * @return TemplateInterface
     */
    abstract public function getDefaultCountableTemplate();

    /**
     * Determine if a number matches a specified condition
     *
     * @param $number
     * @return bool
     */
    abstract protected function matchNumeric($number);
}
